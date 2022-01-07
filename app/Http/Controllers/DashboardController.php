<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemState;
use App\Models\Message;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private function getViewWithUserInfo($view, $user)
    {
        $itemCount = $user->items->count();

        return view($view, [
            'user' => $user,
            'itemCount' => $itemCount,
        ]);
    }

    public function getUserProfile()
    {
        $user = Auth::user();
        
        $userActiveItems = Item::where('user_id', $user->id)
                                ->whereNull('deleted_at')
                                ->whereNull('sold_at')
                                ->get();

        $activeItemCount = count($userActiveItems);

        $reviews = Review::where('receiver_id', $user->id)
                        ->whereNull('deleted_at')
                        ->get();

        $allRatingSum = 0;
        foreach ($reviews as $review) {
            $allRatingSum = $allRatingSum + $review->rating;
        }

        return view('dashboard', [
            'user' => $user,
            'activeItemCount' => $activeItemCount,
            'reviews' => $reviews,
            'allRatingSum' => $allRatingSum,
        ]);
    }

    public function getUserData()
    {
        return $this->getViewWithUserInfo('user-data', Auth::user());
    }

    public function getUserDataForUpdate()
    {
        return $this->getViewWithUserInfo('edit-user-data', Auth::user());
    }

    public function postUserDataForUpdate(Request $request)
    {
        $request->validate([
            'firstName' => ['required', 'string', 'max:150'],
            'lastName' => ['required', 'string', 'max:150'],
            'birthDate' => ['required', 'date', 'before:tomorrow', 'after:1900-01-01'],
            'location' => ['nullable', 'string', 'max: 120'],
        ]);

        $user = Auth::user();

        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->birth_date = $request->birthDate;
        $user->location = $request->location;

        $user->save();

        return redirect('user-information')->with('message', 'Dati atjaunoti veiksmīgi!');
    }

    public function getUserFavorites()
    {
        return view('favorites', [
            'userFavorites' => Auth::user()->favorites,
        ]);
    }

    public function addToFavorites(User $user)
    {
        // User can't add himself to his favorite list
        if (Auth::id() === $user->id) {
            return back()->with('error', 'Jūs nevarat pievienot sevi favorītu sarakstam!');
        }
        // Check if user has at least one item added that is not deleted
        $userItems = Item::where('user_id', $user->id)
                            ->whereNull('deleted_at')
                            ->get();

        //Check if user is already added as favorite
        $isFavorited = Auth::user()->favorites()->firstWhere('favorite_id', $user->id);

        //user can be added to favorites only if he has at least one item and is not already added to favorite list
        if (count($userItems) && !$isFavorited) {
            Auth::user()->favorites()->attach($user->id);
            return back()->with('message', 'Lietotājs pievienots favorītiem!');
        } else if (count($userItems) && $isFavorited) {
            return back()->with('error', 'Lietotājs jau ir Jūsu favorītu sarakstā!');
        }

        return back()->with('error', 'Šo lietotāju nevar pievienot favorītiem!');
    }

    public function removeFromFavorites(User $user)
    {
        Auth::user()->favorites()->detach($user->id);
        return back()->with('message', 'Lietotājs izdzēsts no favorītiem!');
    }

    public function addItemToSale(Request $request)
    {
        $request->validate([
            'picture' => ['required', 'image', 'max:10240'], //max image size is 10MB
            'name' => ['required', 'string', 'max:150'],
            'category' => ['required', 'integer', 'min:1', 'max:19'], //1 - 19 are category foreign keys 
            'state' => ['required', 'integer', 'min:1', 'max:3'], //1 - 3 are state foreign keys 
            'price' => ['required', 'numeric', 'min:0', 'max:10000'],
            'description' => ['required', 'string', 'min:10', 'max:2500'],
        ]);

        $path = $request->file('picture')->store('public/images');
        //convert any price to float with 2 digits after comma and then convert it to euro cents
        $price = (number_format((float)$request->price, 2, '.', ''))*100;

        $item = Auth::user()->items()->create([
            'image_path' => $path,
            'name' => $request->name,
            'category_id' => $request->category,
            'state_id' => $request->state,
            'price' => $price ,
            'description' => $request->description,
        ]);

        return redirect('item/'.$item->id)->with('message', 'Sludinājums pievienots veiksmīgi!');
    }

    public function viewFormToAddItemToSale()
    {
        $states = ItemState::all();

        return view('add-item-for-sale', [
            'states' => $states,
            'categories' => Category::all(),
        ]);
    }
    

    public function getUserReceivedMessages()
    {
        $user = Auth::user();
        return view('received-messages', [
            'userMessages' => Message::with(['sender'])
            ->where('receiver_id', $user->id)
            ->whereNull('receiver_deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get(),
        ]);
    }
    
    public function getUserSentMessages()
    {
        $user = Auth::user();
        return view('sent-messages', [
            'userMessages' => Message::with(['receiver'])
            ->where('sender_id', $user->id)
            ->whereNull('sender_deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get(),
        ]);
    }

    public function viewFormToComposeMessage(User $user)
    {
        return view('compose-message', [
            'user' => $user,
        ]);
    }

    public function sendMessage(Request $request, User $user)
    {
        $request->validate([
        'title' => ['required', 'string', 'min:5', 'max:150'],
        'content' => ['required', 'string', 'min:2', 'max:1500'],
        ]);

        $sender = Auth::user();

        $message = Auth::user()->messages()->create([
            // 'sender_id' => $sender->id,
            'receiver_id' => $user->id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/sent-messages')->with('message', 'Ziņa nosūtīta!');
    }

    public function viewSingleMessage(Message $message)
    {
        if ($message->sender_id !==  Auth::id() && $message->receiver_id !==  Auth::id()) {
            abort(403);
        }

        if (!$message->read_at && $message->receiver_id === Auth::id()) {
            $message->read_at = Carbon::now();
            $message->save();
        }

        return view('message-info', [
            'message' => $message,
        ]);
    }

    public function deleteSentMessage(Message $message)
    {
        if ($message->sender_id === Auth::id()) {
            $message->sender_deleted_at = Carbon::now();
            $message->save();
    
            return redirect('/sent-messages')->with('message', 'Ziņa veiksmīgi izdzēsta no jūsu pastkastītes!');
        }
        
        abort(403);
    }
    
    public function deleteReceivedMessage(Message $message)
    {
        if ($message->receiver_id === Auth::id()) {
            $message->receiver_deleted_at = Carbon::now();
            $message->save();
    
            return redirect('/received-messages')->with('message', 'Ziņa veiksmīgi izdzēsta no jūsu pastkastītes!');
        }

        abort(403);
    }

}