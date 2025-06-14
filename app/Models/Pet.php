<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'shelter_id',
        'name', 
        'type', 
        'age', 
        'behavior', 
        'description', 
        'location', 
        'image'
    ];

    public function shelter()
    {
        return $this->belongsTo(User::class, 'shelter_id');
    }
}
