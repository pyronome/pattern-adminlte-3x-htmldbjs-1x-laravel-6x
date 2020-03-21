<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Action1;

class ForgotPasswordController extends Controller
{
    public function index(Request $request)
    {

        $viewName = 'admin.forgotpassword';

        if (view()->exists('admin.custom.forgotpassword'))
        {
            $viewName = 'admin.custom.forgotpassword';
        } // if (view()->exists('admin.custom.forgotpassword'))

        return view($viewName);
    }
}
