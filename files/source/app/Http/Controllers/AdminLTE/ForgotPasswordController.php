<?php

namespace App\Http\Controllers\AdminLTE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminLTE;
use App\Action1;

class ForgotPasswordController extends Controller
{

    public $controllerName = 'forgotpassword';

    public function index(Request $request)
    {
        $viewName = 'adminlte.forgotpassword';

        if (view()->exists('adminlte.custom.forgotpassword'))
        {
            $viewName = 'adminlte.custom.forgotpassword';
        } // if (view()->exists('adminlte.custom.forgotpassword'))

        $viewData['controllerName'] = $this->controllerName;

        return view($viewName, $viewData);
    }

}
