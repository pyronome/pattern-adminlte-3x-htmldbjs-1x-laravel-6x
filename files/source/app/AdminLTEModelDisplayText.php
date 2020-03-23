<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLTEModelDisplayText extends Model
{
    protected $fillable = [
		'model',
		'display_texts'
    ];
}