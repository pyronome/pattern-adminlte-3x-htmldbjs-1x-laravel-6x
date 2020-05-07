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
		'menu_permission',
		'service_permission',
		'widget_permission'
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

		$property_list[$index]['name'] = 'enabled';
		$property_list[$index]['type'] = 'checkbox';
		$index++;

		$property_list[$index]['name'] = 'title';
		$property_list[$index]['type'] = 'text';
		$index++;

		$property_list[$index]['name'] = 'menu_permission';
		$property_list[$index]['type'] = 'text';
		$index++;

		$property_list[$index]['name'] = 'service_permission';
		$property_list[$index]['type'] = 'text';
		$index++;

		$property_list[$index]['name'] = 'widget_permission';
		$property_list[$index]['type'] = 'checkbox';
		$index++;

		return $property_list;
	}
	
	/* {{snippet:end_methods}} */
}

/* {{snippet:end_class}} */