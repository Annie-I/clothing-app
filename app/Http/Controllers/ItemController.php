<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Item;
use App\Models\ItemState;
use App\Models\User;
use Carbon\Carbon;
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

    public function getItemDataForUpdate(Item $item) {
        return view('edit-item-for-sale', [
            'item' => $item,
            'states' => ItemState::all(),
        ]);
    }

    public function postItemDataForUpdate(Item $item, Request $request) {

        $request->validate([
            'name' => ['required', 'string', 'max:250'],
            'picture' => ['required', 'image', 'max:10240'], //max image size is 10MB
            'description' => ['required', 'string', 'min:10', 'max:2500'],
            'price' => ['required', 'numeric', 'min:0', 'max:10000'],
            'state' => ['required', 'integer', 'min:1', 'max:3'], //1 and 3 are state foreign keys 
        ]);

        $path = $request->file('picture')->store('public/images');
        //convert any price to float with 2 digits after comma and then convert it to euro cents
        $price = (number_format((float)$request->price, 2, '.', ''))*100;

        $item->name = $request->name;
        $item->image_path = $path;
        $item->description = $request->description;
        $item->price = $price ;
        $item->state_id= $request->state;

        $item->save();

    return redirect('item/'.$item->id)->with('message', 'Sludinājums veiksmīgi atjaunots!');
    }

    public function changeItemSaleStatus(Item $item) {
        if ($item->sold_at) {
            $item->sold_at = NULL;
        } else {
            $item->sold_at = Carbon::now();
        }

        $item->save();

        return back()->with('message', 'Sludinājuma statuss ir veiksmīgi nomainīts!');

    }

    public function getUserActiveItems()
    {
        return view('user-active-item-list', [
            'userItems' => Auth::user()->items->whereNull('sold_at'),
        ]);
    }

    
    public function getUserSoldItems()
    {
        return view('user-sold-item-list', [
            'userItems' => Auth::user()->items->whereNotNull('sold_at'),
        ]);
    }
}