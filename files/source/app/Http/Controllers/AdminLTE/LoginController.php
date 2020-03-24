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

        $adminLTE = new AdminLTE();
        $adminLTEUser = auth()->guard('adminlteuser')->user();

        if ($adminLTEUser != null)
        {
            return redirect($adminLTE->getAdminLTEFolder() . 'home');
        }
        else
        {

            $viewName = 'adminlte.login';

            if (view()->exists('adminlte.custom.login'))
            {
                $viewName = 'adminlte.custom.login';
            } // if (view()->exists('adminlte.custom.login'))

            $viewData['controllerName'] = $this->controllerName;

            return view($viewName, $viewData);

        } // if ($adminLTEUser != null)

    }

}
