<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLTELayout extends Model
{
    const CREATED_AT = 'creationdate';
    const UPDATED_AT = 'lastupdate';

    protected $table = 'adminltelayouttable';

    protected $fillable = [
		'pagename',
		'widgets'
    ];
}

?>