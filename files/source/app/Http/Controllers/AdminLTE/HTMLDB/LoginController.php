<?php

namespace App\Http\Controllers\AdminLTE\HTMLDB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminLTE;
use App\HTMLDB;

class LoginController extends Controller
{
    public $columns = [
        'id',
        'email',
        'password',
        'remember'
    ];

    public $protectedColumns = [];
    public $row = [];

    public function get(Request $request)
    {

        $objectHTMLDB = new HTMLDB();
        $objectHTMLDB->columns = $this->columns;
        $objectHTMLDB->printHTMLDBList();
        return;

    }

    public function post(Request $request)
    {

        $objectHTMLDB = new HTMLDB();

        $this->row = $objectHTMLDB->request(
                $request->all(),
                'htmldb_row0',
                $this->protectedColumns,
                true);

        $result = $this->check();

        $objectHTMLDB->errorCount = $result['errorCount'];
        $objectHTMLDB->messageCount = $result['messageCount'];
        $objectHTMLDB->lastError = $result['lastError'];
        $objectHTMLDB->lastMessage = $result['lastMessage'];
        $objectHTMLDB->printResponseJSON();
        return;

    }

    public function check(Request $request)
    {

        $result = [
            'lastError' => '',
            'errorCount' => 0,
            'lastMessage' => '',
            'messageCount' => 0
        ];

        $rootUserName = getenv('ADMINLTE_ROOT_USERNAME');
        $rootPassword = getenv('ADMINLTE_ROOT_PASSWORD');

        /* {{snippet:begin_check_values}} */

        if (($rootUserName !== false)
                && ($rootPassword !== false)) {

        } // if (($rootUserName !== false)

        /* {{snippet:end_check_values}} */

        return $result;

    }

}
