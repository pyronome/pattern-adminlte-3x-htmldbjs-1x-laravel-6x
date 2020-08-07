<?php

namespace App\AdminLTE;

use Illuminate\Database\Eloquent\Model;

/* {{snippet:begin_class}} */

class AdminLTEModelOption extends Model
{
	/* {{snippet:begin_properties}} */

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'adminltemodeloptiontable';

	protected $fillable = [
		'model',
		'property',
		'value',
		'title'
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
            'name' => 'model',
            'type' => 'text'
        ),

        array(
            'name' => 'property',
            'type' => 'text'
        ),

        array(
            'name' => 'value',
            'type' => 'text'
        ),

        array(
            'name' => 'title',
            'type' => 'text'
        )
    );

	/* {{snippet:end_properties}} */

	/* {{snippet:begin_methods}} */
	
	/* {{snippet:end_methods}} */

}

/* {{snippet:end_class}} */