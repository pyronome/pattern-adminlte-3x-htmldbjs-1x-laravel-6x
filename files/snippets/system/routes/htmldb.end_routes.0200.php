$adminLTEFolder = getenv('ADMINLTE_FOLDER');

if ($adminLTEFolder === false)
{
    $adminLTEFolder = 'adminlte';
} // if ($adminLTEFolder === false) {

Route::prefix($adminLTEFolder)->group(function () {
    Route::prefix('login')->group(function () {
	    Route::get('/get', 'AdminLTE/LoginController@getHTMLDB');
    });
});