<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',        // role column
        'address',     // if you store address
        'phone',       // if you store phone
        'is_banned',   // banned flag
        'profile_picture', // Optional profile image
        'last_login_at',  // Last login timestamp
        'created_at',    // Creation timestamp
        'updated_at',    // Update timestamp
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_banned' => 'boolean',
        'password' => 'hashed',
        'last_login_at' => 'datetime',
    ];

    // Relationship with pets (if a user is a shelter)
    public function pets()
    {
        return $this->hasMany(Pet::class, 'shelter_id');
    }

    // Optional: Add scopes for querying
    public function scopeActive($query)
    {
        return $query->where('is_banned', false);
    }

    // Optional: Method to check if user is a shelter
    public function isShelter()
    {
        return $this->role === 'shelter';
    }
}