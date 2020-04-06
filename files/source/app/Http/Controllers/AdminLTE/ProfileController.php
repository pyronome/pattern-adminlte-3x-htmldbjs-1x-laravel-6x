<?php

namespace App\Http\Controllers\AdminLTE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminLTE;
use App\AdminLTEUser;

class ProfileController extends Controller
{

    public $controllerName = 'profile';

    public function index(Request $request)
    {
        $viewName = $this->controllerName;

        if (view()->exists('custom.' . $this->controllerName))
        {
            $viewName = 'custom.' . $this->controllerName;
        } // if (view()->exists('custom.' . $this->controllerName))

        $adminLTE = new AdminLTE();

        $viewData['controllerName'] = $this->controllerName;
        $viewData['user'] = $adminLTE->getUserData();

        return view($viewName, $viewData);
    }

    public function showDetailPage(Request $request)
    {
        return $this->index($request);
    }

    public function showEditPage(Request $request)
    {

        $viewName = ($this->controllerName
                . '_edit');

        if (view()->exists('custom.'
                . $this->controllerName
                . '_edit'))
        {
            $viewName = 'custom.'
                    . $this->controllerName
                    . '_edit';
        } // if (view()->exists('custom.'

        $adminLTE = new AdminLTE();

        $viewData['controllerName'] = $this->controllerName;
        $viewData['user'] = $adminLTE->getUserData();

        return view($viewName, $viewData);

    }

}
