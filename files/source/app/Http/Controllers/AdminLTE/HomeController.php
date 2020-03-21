<?php

namespace App\Http\Controllers\AdminLTE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminLTE;
use App\Action1;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $viewName = 'adminlte.home';

        if (view()->exists('adminlte.custom.home'))
        {
            $viewName = 'adminlte.custom.home';
        } // if (view()->exists('adminlte.custom.home'))

        return view($viewName);
    }
}
