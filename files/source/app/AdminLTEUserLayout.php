<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/* {{snippet:begin_class}} */

class AdminLTEUserLayout extends Model
{

	/* {{snippet:begin_properties}} */

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'adminlteuserlayouttable';

	protected $fillable = [
		'adminlteuser_id',
		'pagename',
		'widgets'
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
            'name' => 'adminlteuser_id',
            'type' => 'integer'
        ),

        array(
            'name' => 'pagename',
            'type' => 'text'
        ),

        array(
            'name' => 'widgets',
            'type' => 'text'
        )
    );
	/* {{snippet:end_properties}} */

	/* {{snippet:begin_methods}} */
	
	/* {{snippet:end_methods}} */
}

/* {{snippet:end_class}} */