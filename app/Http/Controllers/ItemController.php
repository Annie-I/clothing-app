<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemState;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // Return items that are for sale
    public function getAllItems(Request $request) 
    {
        // If user selects item a category, return items only from that category
        if ($request->query('category')) {
            return view('welcome', [
                'items' => Item::with(['state', 'user'])->whereNull('sold_at')->where('category_id', $request->query('category'))->get(),
                'category' => Category::find($request->query('category'))
            ]);
        }
        
        // Return all items
        return view('welcome', [
            'items' => Item::with(['state', 'user'])->whereNull('sold_at')->get(),
        ]);
    }

    public function getSingleItem(Item $item) 
    {
        return view('item-info', [
            'item' => $item,
            'user' => $item->user,
            'state' =>$item->state,
            'category' => $item->category,
        ]);
    }

    public function deleteItem(Item $item) 
    {
        if ($item->user_id === Auth::id() || Auth::user()->is_admin) {
            $item->delete();

            return redirect('/')->with('message', 'Sludinājums izdzēsts!');
        }

        abort(403);
    }

    public function getItemDataForUpdate(Item $item) 
    {
        if (Auth::id () === $item->user_id) {
            return view('edit-item-for-sale', [
                'item' => $item,
                'states' => ItemState::all(),
                'categories' => Category::all(),
            ]);
        }

        abort(403);
    }

    public function postItemDataForUpdate(Item $item, Request $request) 
    {
        if (Auth::id () === $item->user_id) {
            $request->validate([
                'name' => ['required', 'string', 'max:150'],
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

        abort(403);
    }

    // Change item status to sold or in sale
    public function changeItemSaleStatus(Item $item) 
    {
        if (Auth::id () === $item->user_id) {
            if ($item->sold_at) {
                $item->sold_at = NULL;
            } else {
                $item->sold_at = Carbon::now();
            }

            $item->save();

            return back()->with('message', 'Sludinājuma statuss ir veiksmīgi nomainīts!');
        }

        abort(403);
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

    public function getSelectedUserItems(User $user)
    {
        return view('any-user-active-items', [
            'userItems' => $user->items->whereNull('sold_at'),
            'user' => $user,
        ]);
    }
}