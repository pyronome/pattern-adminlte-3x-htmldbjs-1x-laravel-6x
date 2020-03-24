
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

        if ($adminLTEFolder === false
				|| ('' == $adminLTEFolder))
        {
            $adminLTEFolder = 'adminlte';
        } // if ($adminLTEFolder === false) {

		$adminLTEFolder = rtrim($adminLTEFolder, '/');

        Route::prefix($adminLTEFolder)
             ->middleware(['web', AdminLTEMiddleware::class])
             ->namespace('App\Http\Controllers\AdminLTE')
             ->group(base_path('routes/adminlte.php'));
    }
