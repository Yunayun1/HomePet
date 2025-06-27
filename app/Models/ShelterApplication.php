<?php

// app/Models/ShelterApplication.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShelterApplication extends Model
{
    protected $fillable = [
        'organization_name',
         'email',
         'phone',
           'address',
            'proof_document',
             'message',
    ];
}

