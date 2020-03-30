<?php

namespace App\Http\Controllers\AdminLTE\HTMLDB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminLTE;
use App\AdminLTEUser;
use App\HTMLDB;

class GeneralSettingsController extends Controller
{
    public $columns = [];
    public $protectedColumns = [];
    public $row = [];

    public function get(Request $request)
    {

        $columns = [
            'id',
            'debug_mode',
            'project_title',
            'main_folder',
            'default_language',
            'timezone',
            'date_format',
            'yearmonth_format',
            'time_format',
            'number_format',
            'google_maps_api_key'
        ];

        $list = [];

        $list[0]['id'] = 1;
        $list[0]['debug_mode'] = (config('app.debug') ? 1 : 0);
        $list[0]['project_title'] = config('adminlte.project_title');
        $list[0]['main_folder'] = config('adminlte.main_folder');
        $list[0]['landing_page'] = config('adminlte.landing_page');
        $list[0]['default_language'] = config('adminlte.default_language');
        $list[0]['timezone'] = config('adminlte.timezone');
        $list[0]['date_format'] = config('adminlte.date_format');
        $list[0]['time_format'] = config('adminlte.time_format');
        $list[0]['year_month_format'] = config('adminlte.year_month_format');
        $list[0]['number_format'] = config('adminlte.number_format');
        $list[0]['google_maps_api_key'] = config('adminlte.google_maps_api_key');

        $objectHTMLDB = new HTMLDB();
        $objectHTMLDB->columns = $columns;
        $objectHTMLDB->list = $list;
        $objectHTMLDB->printHTMLDBList();
        return;

    }

    public function get_languages(Request $request)
    {

        $columns = [
            'id',
            'name',
            'iso'
        ];

        $list = array();
        $index = 0;

        $list[0]['id'] = 1;
        $list[0]['name'] = 'English';
        $list[0]['iso'] = 'en';
        $index++;

        $objectHTMLDB = new HTMLDB();
        $objectHTMLDB->columns = $columns;
        $objectHTMLDB->list = $list;
        $objectHTMLDB->printHTMLDBList();
        return;

    }

    public function get_timezones(Request $request)
    {

        $columns = [
            'id',
            'timezone'
        ];

        $list = array();
        $index = 0;
        
        $timezones = DateTimeZone::listIdentifiers();
        $countTimezone = count($timezones);

        for ($i = 0; $i < $countTimezone; $i++) {
            $list[$index]['id'] = $i;
            $list[$index]['timezone'] = $timezones[$i];
            $index++;
        } // for ($i = 0; $i < $countTimezone; $i++) {

        $objectHTMLDB = new HTMLDB();
        $objectHTMLDB->columns = $columns;
        $objectHTMLDB->list = $list;
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

        if (0 == $result['errorCount'])
        {
            $adminLTEUser = AdminLTEUser::where('email', $this->row['email'])
                    ->first();

            auth()->guard('adminlteuser')->login($adminLTEUser);

            $landingPage = config('adminlte.landing_page');

            if ($landingPage === false)
            {
                $landingPage = 'home';
            } // if ($landingPage === false)

            $result['messageCount'] = 1;
            $result['lastMessage'] = $landingPage;
        } // if (0 == $result['errorCount'])

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

        if (0 == $result['errorCount']) {

            $adminLTEUser = AdminLTEUser::where('email', $this->row['email'])
                    ->first();
            
            $confirmed = false;

            if ($adminLTEUser != null)
            {
                if (password_verify($this->row['password'], $adminLTEUser->password))
                {
                    $confirmed = true;
                }
            } // if (null == $adminLTEUser)

            if (!$confirmed)
            {
                $result['errorCount']++;
                if ($result['lastError'] != '') {
                    $result['lastError'] .= '<br>';
                } // if ($result['lastError'] != '') {

                $result['lastError'] .= __('Your e-mail address or password is not correct. Please check and try again.');

                sleep(2);
            } // if (!$confirmed)

        }



        /* {{snippet:end_check_values}} */

        return $result;

    }

}
