<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Item;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getPublicProfile(User $user)
    {
        $favorites = Auth::user()->favorites;

        $itemCount = $user->items->count();

        return view('user-profile', [
            'user' => $user,
            'isFavorited' => $favorites->contains($user),
            'itemCount' => $itemCount,
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

}
