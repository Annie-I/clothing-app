<?php

namespace App\Models;

use App\Models\User;
use App\Models\ComplaintStatus;
use App\Models\ComplaintSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'content',
        'status_id',
        'status_notes',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function complaintStatus() 
    {
        return $this->hasOne(ComplaintStatus::class, 'id', 'status_id');
    }

    public function complaintSubject() 
    {
        return $this->hasOne(ComplaintSubject::class, 'id', 'subject_id');
    }
}