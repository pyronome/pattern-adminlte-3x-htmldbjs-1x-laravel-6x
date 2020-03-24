<?php

namespace App\Http\Middleware;

use Closure;
use App\AdminLTE;
use App\AdminLTEUser;

/* {{snippet:begin_class}} */

class AdminLTEMiddleware
{

	/* {{snippet:begin_properties}} */

	/* {{snippet:end_properties}} */

	/* {{snippet:begin_methods}} */

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* {{snippet:begin_handle_method}} */

        $adminLTE = new AdminLTE();

        if (!$this->isLogin($request)
                && !$this->isLogout($request))
        {
            $adminLTEUser = auth()->guard('adminlteuser')->user();

            if (null == $adminLTEUser)
            {
                return redirect(
                        $adminLTE->getAdminLTEFolder()
                        . 'login');
            } // if (null == $adminLTEUser)
        } // if (!$this->isLogin($request)

        return $next($request);

        /* {{snippet:end_handle_method}} */
    }

    private function isLogin($request) {
        if (strpos($request, '/login') !== false)
        {
            return true;
        } else {
            return false;
        } // if (strpos($request, '/login') !== false)
    }

    private function isLogout($request) {
        if (strpos($request, '/logout') !== false)
        {
            return true;
        } else {
            return false;
        } // if (strpos($request, '/logout') !== false)
    }

    /* {{snippet:end_methods}} */
}

/* {{snippet:end_class}} */