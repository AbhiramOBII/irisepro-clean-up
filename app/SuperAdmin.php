<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
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
