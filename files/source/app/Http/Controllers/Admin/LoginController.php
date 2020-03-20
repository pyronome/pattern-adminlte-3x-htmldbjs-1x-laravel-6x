<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Action1;

class LoginController extends Controller
{
    public function index(Request $request)
    {

        $viewName = 'admin.login';

        if (view()->exists('admin.custom.login'))
        {
            $viewName = 'admin.custom.login';
        } // if (view()->exists('admin.custom.login'))

        return view($viewName);
    }
}
