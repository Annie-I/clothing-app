<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private function getViewWithUserInfo($view) {
        return view($view, [
            'user' => Auth::user()
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
}