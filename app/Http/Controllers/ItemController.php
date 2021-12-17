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
        return view('welcome', [
            'items' => Item::with(['state', 'user'])->get(),
        ]);
    }

}