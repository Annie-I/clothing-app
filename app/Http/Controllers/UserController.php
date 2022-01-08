<?php

namespace App\Http\Controllers;

use Auth, Hash;
use App\Models\Item;
use App\Models\Message;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function getPublicProfile(User $user)
    {
        
        if ($user->id === Auth::id()) {
            return redirect('/dashboard');
        }

        $favorites = Auth::user()->favorites;

        $userItems = Item::where('user_id', $user->id)
        ->whereNull('deleted_at')
        ->get();

        $itemCount = count($userItems);

        $userActiveItems = Item::where('user_id', $user->id)
                                ->whereNull('deleted_at')
                                ->whereNull('sold_at')
                                ->get();

        $activeItemCount = count($userActiveItems);

        $sentMessages = Message::where('sender_id', Auth::id())
        ->where('receiver_id', $user->id)
        ->get();

        $receivedMessages = Message::where('sender_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->get();

        $reviews = Review::where('receiver_id', $user->id)
                        ->whereNull('deleted_at')
                        ->get();

        $allRatingSum = 0;
        foreach ($reviews as $review) {
            $allRatingSum = $allRatingSum + $review->rating;
        }

        $rating = 0;
        if (count($reviews)) {
            $rating = (number_format((float)$allRatingSum / count($reviews), 2, '.',));
        }

        return view('user-profile', [
            'user' => $user,
            'isFavorited' => $favorites->contains($user),
            'itemCount' => $itemCount,
            'activeItemCount' => $activeItemCount,
            'hasCommunicated' => count($sentMessages) + count($receivedMessages),
            'review' => Review::where('user_id', Auth::id())
                                ->where('receiver_id', $user->id)
                                ->whereNull('deleted_at')
                                ->first(),
            'reviews' => $reviews,
            'rating' => $rating,
        ]);
    }

    public function deleteUser(User $user, Request $request) {
        if ($user->id === Auth::id()) 
        {
            Auth::guard('web')->logout();
            
            $request->session()->invalidate();
            
            $request->session()->regenerateToken();
            
            $user->delete();

            Item::where('user_id', $user->id)->delete();

            return redirect('/')->with('message', 'Lietotāja konts izdzēsts!');
        }

        return back()->with('error', 'Jūs nevarat izdzēst šo lietotāja kontu!');
    }

    public function getBlockedUsers()
    {
        return view('blocked-users', [
            'blockedUsers' => User::where('is_blocked', 1)->get(),
        ]);
    }

    public function updateSystemAvailability (User $user)
    {
        if (Auth::user()->is_admin) {
            if ($user->is_blocked) {
                $user->is_blocked = '0';
                $user->save();

                return redirect('/blocked-users')->with('message', 'Lietotāja piekļuve sistēmai veiksmīgi atjaunota!');
            } 
            
            $user->is_blocked = '1';
            $user->save();
    
            return redirect('/blocked-users')->with('message', 'Lietotāja piekļuve sistēmai ir liegta!');
        }

        abort(403);
    }

    public function viewFormToAddReview(User $user)
    {
        $sentMessages = Message::where('sender_id', Auth::id())
        ->where('receiver_id', $user->id)
        ->get();

        $receivedMessages = Message::where('sender_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->get();

        $hasCommunicated = count($sentMessages) + count($receivedMessages);

        if ($hasCommunicated) {
            return view('add-or-edit-review', [
                'user' => $user,
                'review' => Review::where('user_id', Auth::id())
                                    ->where('receiver_id', $user->id)
                                    ->whereNull('deleted_at')
                                    ->first(),
            ]);
        }

        abort(403);
    }

    public function postFormToAddReview(Request $request, User $user)
    {
        $sentMessages = Message::where('sender_id', Auth::id())
        ->where('receiver_id', $user->id)
        ->get();

        $receivedMessages = Message::where('sender_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->get();

        $hasCommunicated = count($sentMessages) + count($receivedMessages);

        $review = Review::where('user_id', Auth::id())
                        ->where('receiver_id', $user->id)
                        ->whereNull('deleted_at')
                        ->first();

        if ($hasCommunicated && !$review) {
            $request->validate([
                'rating' => ['required', 'integer', 'min:0', 'max:5'],
                'review' => ['required', 'string', 'min:5', 'max:500'],
            ]);

            $review = Auth::user()->reviews()->create([
                'receiver_id' => $user->id,
                'rating' => $request->rating,
                'review' => $request->review,
            ]);

            return redirect('user/'.$user->id)->with('message', 'Atsauksme veiksmīgi pievienota!');
        }

        abort(403);
    }

    public function viewFormToEditReview(User $user)
    {
        $review = Review::where('user_id', Auth::id())
                        ->where('receiver_id', $user->id)
                        ->whereNull('deleted_at')
                        ->first();

        if ($review) {
            return view('add-or-edit-review', [
                'user' => $user,
                'review' => $review,
            ]);
        }

        abort(403);
    }
    
    public function postFormToEditReview(Request $request, User $user)
    {
        $review = Review::where('user_id', Auth::id())
                ->where('receiver_id', $user->id)
                ->whereNull('deleted_at')
                ->first();

        if ($review) {
            $request->validate([
                'rating' => ['required', 'integer', 'min:0', 'max:5'],
                'review' => ['required', 'string', 'min:5', 'max:500'],
            ]);
    
            $review->rating = $request->rating;
            $review->review = $request->review;
            $review->save();
    
            return redirect('user/'.$review->receiver_id)->with('message', 'Atsauksme veiksmīgi atjaunota!');
        }

        abort(403);
    }

    public function deleteReview(Review $review) 
    {
        $review = Review::where('user_id', $review->user_id)
                        ->where('receiver_id', $review->receiver_id)
                        ->whereNull('deleted_at')
                        ->first();

        if ($review->user_id === Auth::id() || Auth::user()->is_admin) {
            $review->delete();

            return redirect('user/'.$review->receiver_id)->with('message', 'Atsauksme dzēsta!');
        }

        abort(403);
    }
    
    public function getAllReviewsAboutUser(User $user)
    {
        $reviews = Review::with(['user'])
                        ->where('receiver_id', $user->id)
                        ->whereNull('deleted_at')
                        ->get();

        return view('review-list', [
            'reviews' => $reviews,
            'user' => $user,
        ]);
    }

    
    public function viewFormToChangePassword() 
    {
        $user = Auth::user();

        return view('change-password', [
            'user' => $user,
        ]);
    }
    
    public function postFormToChangePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password' => ['required'],
            'new_password' => ['required', 'string', 'confirmed', Rules\Password::min(8)
                                                                                ->mixedCase()
                                                                                ->numbers()
                                                                                ->symbols()],
            'new_password_confirmation' => ['required'],
        ]);

        if (Hash::check($request->password, $user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();
    
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return redirect('/')->with('message', 'Jūsu parole ir veiksmīgi nomainīta! Lūdzu, piesakieties sistēmā.');
        }

        return back()->with('error', 'Jūsu pašreizējā parole ir ievadīta nepareizi!');

    }
    
}
