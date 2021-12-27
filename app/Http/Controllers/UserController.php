<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Item;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function deleteUser(User $user, Request $request) {
        if ($user->id === Auth::id()) 
        {
            Auth::guard('web')->logout();
            
            $request->session()->invalidate();
            
            $request->session()->regenerateToken();
            
            $user->delete();

            Item::where('user_id', $user->id)->delete();
            // TODO: add delete for all user related stuff

            return redirect('/')->with('message', 'Lietotāja konts izdzēsts!');
        }

        return back()->with('error', 'Jūs nevarat izdzēst šo lietotāja kontu!');
    }
}
