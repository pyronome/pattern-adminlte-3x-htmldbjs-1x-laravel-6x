<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLTEUserLayout extends Model
{
    protected $fillable = [
		'adminlteuser_id',
		'pagename',
		'widgets'
    ];
}