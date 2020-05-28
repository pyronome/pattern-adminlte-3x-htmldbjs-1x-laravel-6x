<?php

namespace App\Http\Controllers\AdminLTE\HTMLDB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\AdminLTE;
use App\AdminLTEUser;
use App\HTMLDB;

class ForgotPasswordController extends Controller
{
    public $columns = [
        'id',
        'email'
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
                $this->columns,
                $this->protectedColumns,
                0,
                true);

        $result = $this->check();

        if (1 == $result['messageCount'])
        {   
            $adminLTEUser = AdminLTEUser::where('email', $this->row['email'])->first();

            $params = array();
            $params['emailFromName'] = config('mail.from.name');
            $params['name'] = $adminLTEUser->fullname;
            $params['emailAddress'] = $adminLTEUser->email;
            $params['newPassword'] = $result['lastMessage'];
            $params['emailReplyTo'] = config('mail.from.address');

            Mail::send("email.forgotpassword", $params, function ($message) use ($params) {
               $message->to($params['emailAddress'], $params['name'])->subject("Your New Password");
               $message->from($params['emailReplyTo'], $params['emailFromName']);
            });

            $result['errorCount'] = 0;
            $result['lastError'] = '';
            $result['messageCount'] = 1;
            $result['lastMessage'] = 'UPDATED';
        }

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

        $adminLTE = new AdminLTE();

        /* {{snippet:begin_check_values}} */

        if ('' == $this->row['email'])
        {
            $result['errorCount']++;
            if ($result['lastError'] != '') {
                $result['lastError'] .= '<br>';
            } // if ($result['lastError'] != '') {

            $result['lastError'] .= __('Please specify your email address.');
        }
        else if (!$adminLTE->validateEmailAddress($this->row['email']))
        {
            $result['errorCount']++;
            if ($result['lastError'] != '') {
                $result['lastError'] .= '<br>';
            } // if ($result['lastError'] != '') {

            $result['lastError'] .= __('Please specify a valid email address.');
        }
        else
        {

            $adminLTEUser = AdminLTEUser::where('email', $this->row['email'])->first();

            if (null == $adminLTEUser)
            {
                $result['errorCount']++;
                if ($result['lastError'] != '') {
                    $result['lastError'] .= '<br>';
                } // if ($result['lastError'] != '') {

                $result['lastError'] .= __('Your email address is not recognized. Please check your email address and try again.');
            } else {
                $objectAdminLTE = new AdminLTE();
                $result['lastMessage'] = $objectAdminLTE->resetUserPassword($adminLTEUser);
                $result['messageCount'] = 1;
            } // if (null == $adminLTEUser)

        } // if ('' == $this->row['email']) {

        /* {{snippet:end_check_values}} */

        return $result;

    }

}