<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Action1;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $viewName = 'admin.home';

        if (view()->exists('admin.custom.home'))
        {
            $viewName = 'admin.custom.home';
        } // if (view()->exists('admin.custom.home'))

        return view($viewName);
    }
}
