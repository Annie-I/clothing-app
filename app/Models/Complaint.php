<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'content',
        'status',
        'status_notes',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
