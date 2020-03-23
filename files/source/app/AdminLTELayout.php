<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLTELayout extends Model
{
    protected $fillable = [
		'pagename',
		'widgets'
    ];
}