<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SuperAdmin extends Authenticatable
{
    protected $fillable = [
        'superadmin_fullname',
        'superadmin_email',
        'password',
        'status',
        'last_login',
        'last_login_ip'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'last_login' => 'datetime'
    ];
}
