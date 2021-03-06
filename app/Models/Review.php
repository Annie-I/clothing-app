<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'rating',
        'user_id',
        'receiver_id',
        'review',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function receiver() 
    {
        return $this->hasOne(User::class, 'id', 'receiver_id');
    }
}
