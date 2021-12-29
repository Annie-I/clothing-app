<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\ComplaintSubject;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function viewFormToComposeComplaint() {
        $subjects = ComplaintSubject::all();

        return view('compose-complaint', [
            'subjects' =>$subjects,
        ]);
    }

    public function postComplaint(Request $request)
    {
        $request->validate([
        'subject' => ['required', 'integer', 'min:1', 'max:2'], //1 - 2 are state foreign keys 
        'content' => ['required', 'string', 'min:10', 'max:500'],
        ]);

        $message = Auth::user()->complaints()->create([
            'subject_id' => $request->subject,
            'content' => $request->content,
            'status_id' => '1',
        ]);

        return redirect('/')->with('message', 'Sūdzība nosūtīta izskatīšanai!');
    }
    
}