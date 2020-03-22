<?php

namespace App\Http\Controllers\AdminLTE\HTMLDB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminLTE;
use App\HTMLDB;

class LoginController extends Controller
{
    public function get(Request $request)
    {
        $objectHTMLDB = new HTMLDB();

        $objectHTMLDB->columns = [
            'id',
            'email',
            'password',
            'remember'
        ];
		
        $objectHTMLDB->printHTMLDBList();
        return;
    }

    public function post(Request $request)
    {

    }
}
