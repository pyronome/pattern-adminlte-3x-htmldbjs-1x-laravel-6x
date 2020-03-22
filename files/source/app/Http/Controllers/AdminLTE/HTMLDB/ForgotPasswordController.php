<?php

namespace App\Http\Controllers\AdminLTE\HTMLDB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminLTE;
use App\HTMLDB;

class ForgotPasswordController extends Controller
{
    public function get(Request $request)
    {
        $objectHTMLDB = new HTMLDB();

        $objectHTMLDB->columns = [
            'id',
            'email'
        ];
		
        $objectHTMLDB->printHTMLDBList();
        return;
    }

    public function post(Request $request)
    {
        $objectHTMLDB = new HTMLDB();
        $objectHTMLDB->printResponseJSON();
        return;
    }
}
