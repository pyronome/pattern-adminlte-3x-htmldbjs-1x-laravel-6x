<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLTEUserLayout extends Model
{
    const CREATED_AT = 'creationdate';
    const UPDATED_AT = 'lastupdate';

    protected $table = 'adminlteuserlayouttable';

    protected $fillable = [
		'adminlteuser_id',
		'pagename',
		'widgets'
    ];
}