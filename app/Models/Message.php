<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'title',
        'content',
    ];

    public function sender() 
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    public function receiver() 
    {
        return $this->hasOne(User::class, 'id', 'receiver_id');
    }
}
