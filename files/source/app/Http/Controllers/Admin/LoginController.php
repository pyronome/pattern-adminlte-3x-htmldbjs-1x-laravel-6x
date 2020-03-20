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

        $viewName = 'admin.login.default';

        if (view()->exists('admin.login'))
        {
            $viewName = 'admin.login';
        } // if (view()->exists('admin.login'))

        return view($viewName);
    }
}
