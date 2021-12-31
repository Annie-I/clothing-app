<?php

namespace App\Models;

use App\Models\User;
use App\Models\ItemState;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

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
        return $this->hasOne(ItemState::class, 'id', 'state_id');
    }

    public function category() 
    {
        return $this->hasOne(Category::class);
    }
}
