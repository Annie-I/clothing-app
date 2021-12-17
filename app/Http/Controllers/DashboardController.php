<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\ItemState;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private function getViewWithUserInfo($view, $user)
    {
        return view($view, [
            'user' => $user,
            'isSeller' => false,
        ]);
    }

    public function getUserProfile()
    {
        return $this->getViewWithUserInfo('dashboard', Auth::user());
    }

    public function getPublicProfile(User $user)
    {
        $favorites = Auth::user()->favorites;

        return view('dashboard', [
            'user' => $user,
            'isFavorited' => $favorites->contains($user),
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
            'state' => ['required', 'integer', 'min:1', 'max:3'], //1 and 3 are state foreign keys 
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

        //return redurect('items/{{$item->id}}')
        return redirect('user-information')->with('message', 'Sludinājums pievienots veiksmīgi!');
    }

    public function viewFormToAddItemToSale()
    {
        $states = ItemState::all();

        return view('add-item-for-sale', [
            'states' => $states,
        ]);
    }
    
}