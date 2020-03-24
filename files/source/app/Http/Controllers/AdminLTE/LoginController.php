<?php

namespace App\Http\Controllers\AdminLTE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminLTE;
use App\Action1;

class LoginController extends Controller
{

    public $controllerName = 'login';

    public function index(Request $request)
    {
        $viewName = 'adminlte.login';

        if (view()->exists('adminlte.custom.login'))
        {
            $viewName = 'adminlte.custom.login';
        } // if (view()->exists('adminlte.custom.login'))

        $viewData['controllerName'] = $this->controllerName;

        return view($viewName, $viewData);
    }

}
