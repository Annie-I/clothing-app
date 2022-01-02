<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Item;
use App\Models\Message;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getPublicProfile(User $user)
    {
        
        if ($user->id === Auth::id()) {
            return redirect('/dashboard');
        }

        $favorites = Auth::user()->favorites;

        $itemCount = $user->items->count();

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

        return view('user-profile', [
            'user' => $user,
            'isFavorited' => $favorites->contains($user),
            'itemCount' => $itemCount,
            'hasCommunicated' => count($sentMessages) + count($receivedMessages),
            'review' => Review::where('user_id', Auth::id())
                                ->where('receiver_id', $user->id)
                                ->whereNull('deleted_at')
                                ->first(),
            'reviews' => $reviews,
            'allRatingSum' => $allRatingSum,
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
    
    public function unblockUser(User $user)
    {
        $user->is_blocked = '0';
        $user->save();

        return redirect('/blocked-users')->with('message', 'Lietotājs veiksmīgi atbloķēts!');
    }

    public function blockUser(User $user)
    {
        $user->is_blocked = '1';
        $user->save();

        return redirect('/blocked-users')->with('message', 'Lietotāja piekļuve sistēmai bloķēta!');
    }

    public function viewFormToAddReview(User $user)
    {
        return view('add-or-edit-review', [
            'user' => $user,
            'review' => Review::where('user_id', Auth::id())
                                ->where('receiver_id', $user->id)
                                ->whereNull('deleted_at')
                                ->first(),
        ]);
    }

    public function postFormToAddReview(Request $request, User $user)
    {
        $request->validate([
            'rating' => ['required', 'integer', 'min:0', 'max:5'],
            'review' => ['required', 'string', 'min:5', 'max:250'],
        ]);

        $review = Auth::user()->reviews()->create([
            'receiver_id' => $user->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect('user/'.$user->id)->with('message', 'Atsauksme veiksmīgi pievienota!');
    }


    public function viewFormToEditReview(User $user)
    {
        $review = Review::where('user_id', Auth::id())
                        ->where('receiver_id', $user->id)
                        ->whereNull('deleted_at')
                        ->first();

        if ($review->user_id !==  Auth::id()) {
            abort(404);
        }

        return view('add-or-edit-review', [
            'user' => $user,
            'review' => $review,
        ]);
    }
    
    public function postFormToEditReview(Request $request, User $user)
    {
        $review = Review::where('user_id', Auth::id())
                ->where('receiver_id', $user->id)
                ->whereNull('deleted_at')
                ->first();

        if ($review->user_id !==  Auth::id()) {
            abort(404);
        }
        
        $request->validate([
            'rating' => ['required', 'integer', 'min:0', 'max:5'],
            'review' => ['required', 'string', 'min:5', 'max:250'],
        ]);

        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->save();

        return redirect('user/'.$review->receiver_id)->with('message', 'Atsauksme veiksmīgi atjaunota!');
    }

    public function deleteReview(User $user) 
    {
        $review = Review::where('user_id', Auth::id())
                        ->where('receiver_id', $user->id)
                        ->whereNull('deleted_at')
                        ->first();

        if ($review->user_id === Auth::id() || Auth::user()->is_admin) 
        {
            $review->delete();

            return redirect('user/'.$review->receiver_id)->with('message', 'Atsauksme dzēsta!');
        }

        return back()->with('error', 'Jūs nevarat dzēst šo atsauksmi!');
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
    
}
