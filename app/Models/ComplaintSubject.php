<?php

namespace App\Models;

use App\Models\Complaint;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    
    public function complaints() 
    {
        return $this->belongsTo(Complaint::class);
    }
}
