<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Item;
use App\Models\ItemState;
use App\Models\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function getAllItems() {
        // return item view
        return view('welcome', [
            'items' => Item::with(['state', 'user'])->get(),
        ]);
    }

    public function getSingleItem(Item $item) {
        return view('item-info', [
            'item' => $item,
            'user' => $item->user,
            'state' =>$item->state,
        ]);
    }

    public function deleteItem(Item $item) {
        if ($item->user_id === Auth::id()
        // TODO: || Auth:user()->isAdmin
        ) {
            $item->delete();

            return redirect('dashboard')->with('message', 'Sludinājums izdzēsts!');
        }

        return back()->with('error', 'Jūs nevarat izdzēst šo sludinājumu!');
    }
}