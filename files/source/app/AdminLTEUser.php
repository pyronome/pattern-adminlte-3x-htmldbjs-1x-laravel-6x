<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminLTEUser extends Authenticatable
{
    protected $fillable = [
		'adminlteusergroup_id',
		'profile_img',
		'enabled',
		'fullname',
		'username',
		'email',
		'password',
		'passwordHash',
		'menu_permission',
		'service_permission'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];
}