<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLTEVariable extends Model
{
    const CREATED_AT = 'creationdate';
    const UPDATED_AT = 'lastupdate';

    protected $table = 'adminltevariabletable';

    protected $fillable = [
		'title',
		'group',
        'value1',
        'value2',
        'value3',
        '__order'
    ];
}

?>