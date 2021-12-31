<?php

namespace App\Http\Controllers;

use Auth;
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
            'review' => Review::where('user_id', Auth::id())
                            ->where('receiver_id', $user->id)
                            ->whereNull('deleted_at')
                            ->get(),
        ]);
    }

    public function getUserProfile()
    {
        return $this->getViewWithUserInfo('dashboard', Auth::user());
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
            'birthDate' => ['required', 'date'],
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
        Auth::user()->favorites()->attach($user->id);
        return back()->with('message', 'Lietotājs pievienots favorītiem!');
    }

    public function removeFromFavorites(User $user)
    {
        Auth::user()->favorites()->detach($user->id);
        return back()->with('message', 'Lietotājs izdzēsts no favorītiem!');
    }

    public function addItemToSale(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:250'],
            'picture' => ['required', 'image', 'max:10240'], //max image size is 10MB
            'description' => ['required', 'string', 'min:10', 'max:2500'],
            'price' => ['required', 'numeric', 'min:0', 'max:10000'],
            'state' => ['required', 'integer', 'min:1', 'max:3'], //1 - 3 are state foreign keys 
        ]);

        $path = $request->file('picture')->store('public/images');
        //convert any price to float with 2 digits after comma and then convert it to euro cents
        $price = (number_format((float)$request->price, 2, '.', ''))*100;

        $item = Auth::user()->items()->create([
            'name' => $request->name,
            'image_path' => $path,
            'description' => $request->description,
            'price' => $price ,
            'state_id' => $request->state,
        ]);

        return redirect('item/'.$item->id)->with('message', 'Sludinājums pievienots veiksmīgi!');
    }

    public function viewFormToAddItemToSale()
    {
        $states = ItemState::all();

        return view('add-item-for-sale', [
            'states' => $states,
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
        'content' => ['required', 'string', 'min:10', 'max:1500'],
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
            abort(404);
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
        $message->sender_deleted_at = Carbon::now();
        $message->save();

        return redirect('/sent-messages')->with('message', 'Ziņa veiksmīgi izdzēsta no jūsu pastkastītes!');
    }
    
    public function deleteReceivedMessage(Message $message)
    {
        $message->receiver_deleted_at = Carbon::now();
        $message->save();

        return redirect('/received-messages')->with('message', 'Ziņa veiksmīgi izdzēsta no jūsu pastkastītes!');
    }

}