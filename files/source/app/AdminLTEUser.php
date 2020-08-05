<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

/* {{snippet:begin_class}} */

class AdminLTEUser extends Authenticatable
{

    /* {{snippet:begin_properties}} */

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'adminlteusertable';

    protected $fillable = [
        'profile_img',
        'adminlteusergroup_id',
        'enabled',
        'fullname',
        'username',
        'email',
        'password',
        'passwordHash'
    ];

    public static $property_list = array(
        array(
            'name' => 'id',
            'type' => 'integer'
        ),

        array(
            'name' => 'deleted',
            'type' => 'checkbox'
        ),

        array(
            'name' => 'created_at',
            'type' => 'date'
        ),

        array(
            'name' => 'updated_at',
            'type' => 'date'
        ),

        array(
            'name' => 'profile_img',
            'type' => 'image'
        ),

        array(
            'name' => 'adminlteusergroup_id',
            'type' => 'class_selection_single'
        ),
        
        array(
            'name' => 'enabled',
            'type' => 'checkbox'
        ),

        array(
            'name' => 'fullname',
            'type' => 'text'
        ),

        array(
            'name' => 'username',
            'type' => 'text'
        ),

        array(
            'name' => 'email',
            'type' => 'text'
        ),

        array(
            'name' => 'password',
            'type' => 'text'
        )
    );

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /* {{snippet:end_properties}} */

    /* {{snippet:begin_methods}} */

    public function adminlteusergroup_id()
    {
        return $this->belongsTo(AdminLTEUserGroup::class, 'adminlteusergroup_id');
    }

    /* {{snippet:end_methods}} */
}

/* {{snippet:begin_class}} */
