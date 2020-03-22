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

        $this->row = $objectHTMLDB->requestPOSTRow(
                $request->all(),
                $this->protectedColumns,
                0,
                true);

        $result = $this->check();

        $objectHTMLDB->errorCount = $result['errorCount'];
        $objectHTMLDB->messageCount = $result['messageCount'];
        $objectHTMLDB->lastError = $result['lastError'];
        $objectHTMLDB->lastMessage = $result['lastMessage'];
        $objectHTMLDB->printResponseJSON();
        return;

    }

    public function check()
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

        if ('' == $this->row['email'])
        {
            $result['errorCount']++;
            if ($result['lastError'] != '') {
                $result['lastError'] .= '<br>';
            } // if ($result['lastError'] != '') {

            $result['lastError'] .= __('Please specify your email address.');
        } // if ('' == $this->row['email'])

        if ('' == $this->row['password'])
        {
            $result['errorCount']++;
            if ($result['lastError'] != '') {
                $result['lastError'] .= '<br>';
            } // if ($result['lastError'] != '') {

            $result['lastError'] .= __('Please specify your password.');
        } // if ('' == $this->row['password'])

        /* {{snippet:end_check_values}} */

        return $result;

    }

}
