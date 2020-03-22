<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLTEUser extends Model
{
    const CREATED_AT = 'creationdate';
    const UPDATED_AT = 'lastupdate';

    protected $table = 'adminlteusertable';

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
}

?>