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

	/* {{snippet:end_properties}} */

	/* {{snippet:begin_methods}} */
	
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

		$property_list[$index]['name'] = 'adminlteuser_id';
		$property_list[$index]['type'] = 'integer';
		$index++;

		$property_list[$index]['name'] = 'pagename';
		$property_list[$index]['type'] = 'text';
		$index++;

		$property_list[$index]['name'] = 'widgets';
		$property_list[$index]['type'] = 'text';
		$index++;

		return $property_list;
	}
	
	/* {{snippet:end_methods}} */
}

/* {{snippet:end_class}} */