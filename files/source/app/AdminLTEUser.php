<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
		'adminlteusergroup_id',
		'enabled',
		'fullname',
		'username',
		'email',
		'password',
		'passwordHash'
    ];

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
    
    public function get_property_list() {
        $property_list = array();
        $index = 0;
        
        $property_list[$index]['name'] = 'id';
        $property_list[$index]['type'] = 'integer';
        $index++;

        $property_list[$index]['name'] = 'deleted';
        $property_list[$index]['type'] = 'checkbox';
        $index++;

        $property_list[$index]['name'] = 'created_at';
        $property_list[$index]['type'] = 'date';
        $index++;

        $property_list[$index]['name'] = 'updated_at';
        $property_list[$index]['type'] = 'date';
        $index++;       

        $property_list[$index]['name'] = 'adminlteusergroup_id';
        $property_list[$index]['type'] = 'class_selection_single';
        $index++;

        $property_list[$index]['name'] = 'enabled';
        $property_list[$index]['type'] = 'checkbox';
        $index++;

        $property_list[$index]['name'] = 'fullname';
        $property_list[$index]['type'] = 'text';
        $index++;

        $property_list[$index]['name'] = 'username';
        $property_list[$index]['type'] = 'text';
        $index++;

        $property_list[$index]['name'] = 'email';
        $property_list[$index]['type'] = 'text';
        $index++;

        $property_list[$index]['name'] = 'password';
        $property_list[$index]['type'] = 'text';
        $index++;
        
        return $property_list;
    }

	/* {{snippet:end_methods}} */
}

/* {{snippet:begin_class}} */
