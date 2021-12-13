<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private function getViewWithUserInfo($view)
    {
        return view($view, [
            'user' => Auth::user(),
            'isSeller' => false,
        ]);
    }

    public function getPublicProfile()
    {
        return $this->getViewWithUserInfo('dashboard');
    }

    public function getUserData()
    {
        return $this->getViewWithUserInfo('user-data');
    }

    public function getUserDataForUpdate()
    {
        return $this->getViewWithUserInfo('edit-user-data');
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
}