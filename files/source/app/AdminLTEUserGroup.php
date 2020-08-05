<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/* {{snippet:begin_class}} */

class AdminLTEUserGroup extends Model
{

	/* {{snippet:begin_properties}} */

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'adminlteusergrouptable';

	protected $fillable = [
		'enabled',
		'title',
		'widget_permission'
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
            'name' => 'enabled',
            'type' => 'checkbox'
        ),

        array(
            'name' => 'title',
            'type' => 'text'
        ),

        array(
            'name' => 'widget_permission',
            'type' => 'checkbox'
        )
    );

	/* {{snippet:end_properties}} */

	/* {{snippet:begin_methods}} */
	
	public function AdminLTEUser_adminlteusergroup_id()
    {
        return $this->hasMany(AdminLTEUser::class);
    }
	
	/* {{snippet:end_methods}} */
}

/* {{snippet:end_class}} */
