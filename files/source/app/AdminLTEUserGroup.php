<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLTEUserGroup extends Model
{
    protected $fillable = [
		'enabled',
		'title',
		'menu_permission',
		'service_permission',
		'widget_permission'
    ];
}