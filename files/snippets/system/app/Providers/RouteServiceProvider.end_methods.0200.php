
    /**
     * Define the "admin" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        $adminFolder = getenv('ADMIN_FOLDER');

        if ($adminFolder === false)
        {
            $adminFolder = 'admin';
        } // if ($adminFolder === false) {

        Route::prefix($adminFolder)
             ->middleware(AdminMiddleware::class)
             ->namespace('App\Http\Controllers\Admin')
             ->group(base_path('routes/admin.php'));
    }
