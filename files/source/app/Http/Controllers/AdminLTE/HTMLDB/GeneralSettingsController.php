<?php

namespace App\Http\Controllers\AdminLTE\HTMLDB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminLTE\AdminLTE;
use App\AdminLTE\AdminLTEUser;
use App\HTMLDB\HTMLDB;

class GeneralSettingsController extends Controller
{
    public $columns = [
        'id',
        'debug_mode',
        'project_title',
        'main_folder',
        'landing_page',
        'default_language',
        'timezone',
        'date_format',
        'year_month_format',
        'time_format',
        'number_format',
        'google_maps_api_key'
    ];
    public $protectedColumns = [];
    public $row = [];

    public function get(Request $request)
    {

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
        $objectHTMLDB->columns = $this->columns;
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
        
        $timezones = \DateTimeZone::listIdentifiers();
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
            $variables = array();
            $variables['adminlte.project_title'] = $this->row['project_title'];
            $variables['adminlte.main_folder'] = $this->row['main_folder'];
            $variables['adminlte.landing_page'] = $this->row['landing_page'];
            $variables['adminlte.default_language'] = $this->row['default_language'];
            $variables['adminlte.timezone'] = $this->row['timezone'];
            $variables['adminlte.date_format'] = $this->row['date_format'];
            $variables['adminlte.time_format'] = $this->row['time_format'];
            $variables['adminlte.year_month_format'] = $this->row['year_month_format'];
            $variables['adminlte.number_format'] = $this->row['number_format'];
            $variables['adminlte.google_maps_api_key'] = $this->row['google_maps_api_key'];

            $root = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
            $source_path = $root . '/config/adminlte.template.json';
            $destination_path = 'config/adminlte.json';
        
            $objectAdminLTE = new AdminLTE();
            $objectAdminLTE->writeTemplateFileToTarget($source_path, $destination_path, $variables);
        } // if (0 == $result['errorCount'])

        if (0 == $result['errorCount']) {
            $result['messageCount'] = 1;
            $result['lastMessage'] = 'UPDATED';
        } // if (0 == $result['errorCount']) {

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

        /* {{snippet:end_check_values}} */

        return $result;

    }

}
