
    /**
     * Define the "adminlte" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminLTERoutes()
    {
        $adminLTEFolder = getenv('ADMINLTE_FOLDER');

        if ($adminLTEFolder === false)
        {
            $adminLTEFolder = 'adminlte';
        } // if ($adminLTEFolder === false) {

        Route::prefix($adminLTEFolder)
             ->middleware(AdminLTEMiddleware::class)
             ->namespace('App\Http\Controllers\AdminLTE')
             ->group(base_path('routes/adminlte.php'));
    }
