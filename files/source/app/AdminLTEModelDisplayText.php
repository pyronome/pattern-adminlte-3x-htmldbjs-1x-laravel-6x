<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLTEModelDisplayText extends Model
{
    const CREATED_AT = 'creationdate';
    const UPDATED_AT = 'lastupdate';

    protected $table = 'adminltemodeldisplaytexttable';

    protected $fillable = [
		'model',
		'display_texts'
    ];
}