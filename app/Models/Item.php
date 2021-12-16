<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
        'description',
        'price',
        'state_id',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function state() 
    {
        return $this->hasOne(ItemState::class);
    }
}
