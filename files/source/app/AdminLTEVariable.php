<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLTEVariable extends Model
{
    protected $fillable = [
		'title',
		'group',
		'value1',
		'value2',
		'value3',
		'__order'
    ];
}