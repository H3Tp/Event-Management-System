<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // for auth features
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, Notifiable;

    // explicitly tell Laravel to use 'users' table
    protected $table = 'users';

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
