<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLTEUserGroup extends Model
{
    const CREATED_AT = 'creationdate';
    const UPDATED_AT = 'lastupdate';

    protected $table = 'adminlteusergrouptable';

    protected $fillable = [
		'enabled',
		'title',
		'menu_permission',
		'service_permission',
		'widget_permission'
    ];
}