<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Complaint;
use App\Models\ComplaintStatus;
use App\Models\ComplaintSubject;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function viewFormToComposeComplaint() 
    {
        $subjects = ComplaintSubject::all();

        return view('compose-complaint', [
            'subjects' =>$subjects,
        ]);
    }

    public function postComplaint(Request $request)
    {
        $request->validate([
        'subject' => ['required', 'integer', 'min:1', 'max:2'], //1 - 2 are state foreign keys 
        'complaintContent' => ['required', 'string', 'min:10', 'max:500'],
        ]);

        $message = Auth::user()->complaints()->create([
            'subject_id' => $request->subject,
            'content' => $request->complaintContent,
            'status_id' => '1',
        ]);

        return redirect('/')->with('message', 'Sūdzība nosūtīta izskatīšanai!');
    }

    public function getNewComplaints()
    {
        return view('complaints', [
            'complaints' => Complaint::with(['user'])
                            ->where('status_id', 1)
                            ->orderBy('created_at', 'DESC')
                            ->get(),
        ]);
    }
    
    public function getInProgressComplaints()
    {
        return view('complaints', [
            'complaints' => Complaint::with(['user'])
                            ->where('status_id', 2)
                            ->orderBy('created_at', 'DESC')
                            ->get(),
        ]);
    }

    public function getClosedComplaints()
    {
        return view('complaints', [
            'complaints' => Complaint::with(['user'])
                            ->where('status_id', 3)
                            ->orderBy('created_at', 'DESC')
                            ->get(),
        ]);
    }
    
    public function getSingleComplaint(Complaint $complaint) 
    {
        return view('complaint-info', [
            'complaint' => $complaint,
        ]);
    }

    public function viewFormToEditComplaint(Complaint $complaint) 
    {
        return view('change-complaint-status', [
            'complaint' => $complaint,
            'statuses' => ComplaintStatus::all(),
        ]);
    }

    public function postFormToEditComplaint(Request $request, Complaint $complaint) 
    {
        $request->validate([
            'status' => ['required', 'integer', 'min:1', 'max:3'], //1 - 3 are status foreign keys 
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $complaint->status_id = $request->status;
        $complaint->status_notes = $request->comment;
        $complaint->save();

    return redirect('/new-complaint-list')->with('message', 'Sūdzības status veiksmīgi atjaunots!');
    }
    
}