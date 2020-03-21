<?php

namespace App\Http\Controllers\AdminLTE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminLTE;
use App\Action1;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $viewName = 'adminlte.login';

        if (view()->exists('adminlte.custom.login'))
        {
            $viewName = 'adminlte.custom.login';
        } // if (view()->exists('adminlte.custom.login'))

        return view($viewName);
    }
}
