<?php

namespace App\Http\Controllers\AdminLTE\HTMLDB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\AdminLTE;
use App\AdminLTEUser;
use App\HTMLDB;

class AdminLTEUserController extends Controller
{

    public $columns = [];
    public $protectedColumns = [];
    public $row = [];

    public function get(Request $request)
    {
        
        $this->columns = [
            'id',
            'id/display_text',
            'deleted',
            'deleted/display_text',
            'creationDate',
            'creationDate/display_text',
            'lastUpdate',
            'lastUpdate/display_text',
            'enabled',
            'enabled/display_text',
            '__systemusergroup_id',
            '__systemusergroup_id/display_text',
            'fullname',
            'fullname/display_text',
            'username',
            'username/display_text',
            'email',
            'email/display_text',
            'password',
            'password/display_text',
            'menu_permission',
            'menu_permission/display_text',
            'service_permission',
            'service_permission/display_text',
            'profile_img',
            /*'profile_img/display_text',*/
            'group_menu_permission',
            'group_service_permission'
        ];

        $list = [];

        $parameters = $request->route()->parameters();

        if (isset($parameters['id'])
                && ('new' == htmlspecialchars($parameters['id']))) {
            return false;
        } // if (isset($parameters['id'])
        
        $id = 0;
        if (isset($parameters['id'])) {
            $id = (isset($parameters['id']) ? intval($parameters['id']) : 0);
        } // if (isset($parameters['id'])) {
        
        $adminLTE = new AdminLTE();

        $objectAdminLTEUserGroup = null;
        $objectAdminLTEUsers = null;
        $objectAdminLTEUser = null;

        if ($id > 0)
        {
            $objectAdminLTEUsers = App\AdminLTEUser::where('delete', false)
                    ->where('id', $id)
                    ->get();
        }
        else
        {
            $objectAdminLTEUsers = App\AdminLTEUser::where('delete', false)
                    ->orderBy('created_at', false)
                    ->get();
        } // if ($id > 0)

        $index = 0;

        foreach ($objectAdminLTEUsers as $objectAdminLTEUser)
        {

            $list[$index]['id'] = $objectAdminLTEUser->id;
            $list[$index]['deleted'] = $objectAdminLTEUser->deleted;
            $list[$index]['creationDate'] = $objectAdminLTEUser->creationDate;
            $list[$index]['lastUpdate'] = $objectAdminLTEUser->lastUpdate;
            $list[$index]['enabled'] = $objectAdminLTEUser->enabled;
            $list[$index]['__systemusergroup_id'] = $objectAdminLTEUser->__systemusergroup_id;
            $list[$index]['fullname'] = $objectAdminLTEUser->fullname;
            $list[$index]['username'] = $objectAdminLTEUser->username;
            $list[$index]['email'] = $objectAdminLTEUser->email;
            $list[$index]['password'] = '';
            $list[$index]['menu_permission'] = $adminLTE->base64decode($objectAdminLTEUser->menu_permission);
            $list[$index]['service_permission'] = $adminLTE->base64decode($objectAdminLTEUser->service_permission);
            $list[$index]['profile_img'] = $objectAdminLTEUser->profile_img;

            // Display Texts
            $displayTexts = $adminLTE->getObjectDisplayTexts('__SystemUser', $objectAdminLTEUser);

            $list[$index]['id/display_text'] = $displayTexts['id'];
            $list[$index]['deleted/display_text'] = $displayTexts['deleted'];
            $list[$index]['creationDate/display_text'] = $displayTexts['creationDate'];
            $list[$index]['lastUpdate/display_text'] = $displayTexts['lastUpdate'];
            $list[$index]['enabled/display_text'] = $displayTexts['enabled'];
            $list[$index]['__systemusergroup_id/display_text'] = $displayTexts['__systemusergroup_id'];
            $list[$index]['fullname/display_text'] = $displayTexts['fullname'];
            $list[$index]['username/display_text'] = $displayTexts['username'];
            $list[$index]['email/display_text'] = $displayTexts['email'];
            $list[$index]['password/display_text'] = $displayTexts['password'];
            $list[$index]['menu_permission/display_text'] = $displayTexts['menu_permission'];
            $list[$index]['service_permission/display_text'] = $displayTexts['service_permission'];
            /*$list[$index]['profile_img/display_text'] = $displayTexts['profile_img'];*/
            
            // Other Configuration
            $list[$index]['group_menu_permission'] = '';
            $list[$index]['group_service_permission'] = '';
            
            if (0 != $objectAdminLTEUser->__systemusergroup_id) {
                $objectAdminLTEUserGroup = App\AdminLTEUserGroup::find(
                        $objectAdminLTEUser->__systemusergroup_id);

                if (null == $objectAdminLTEUserGroup)
                {
                    continue;
                } // if (null == $objectAdminLTEUserGroup)
                
                $list[$index]['group_menu_permission'] = $adminLTE->base64decode(
                        $objectAdminLTEUserGroup->menu_permission);
                $list[$index]['group_service_permission'] = $adminLTE->base64decode(
                        $objectAdminLTEUserGroup->service_permission);
            }

            $index++;

        } // foreach ($objectAdminLTEUsers as $objectAdminLTEUser)

        $objectHTMLDB = new HTMLDB();
        $objectHTMLDB->list = $list;
        $objectHTMLDB->columns = $this->columns;
        $objectHTMLDB->printHTMLDBList();
        return;

    }

    public function get_session(Request $request)
    {
        
        $this->columns = [
            'id',
            'searchText',
            'sortingColumn',
            'sortingASC',
            'page',
            'pageCount',
            'bufferSize'
        ];

        $adminLTE = new AdminLTE();
        $parameters = $request->route()->parameters();

        $list = [];

        $sessionParameters = $adminLTE->getModelSessionParameters(
                $request,
                'AdminLTEUser');
        
        if (!isset($sessionParameters['page'])) {
            $pageName = '';

            if (isset($parameters['pageName'])) {
                $pageName = htmlspecialchars($parameters['pageName']);
            } // if (isset($parameters['pageName'])) {

            $Widgets = $adminLTE->getPageLayout($pageName);
            $bufferSize = $adminLTE->getRecordListLimit(
                    $request,
                    $Widgets,
                    'AdminLTEUser');

            $pageCount = ceil(
                    AdminLTEUser::where('deleted', false)->count()
                    / $bufferSize);

            $adminLTE->setModelSessionParameters($request,
                    'AdminLTEUser',
                    [
                        'searchText' => '',
                        'sortingColumn' => 'id',
                        'sortingASC' => 2,
                        'page' => 0,
                        'pageCount' => $pageCount,
                        'bufferSize' => $bufferSize
                    ]
            );
        }

        $sessionParameters = $adminLTE->getModelSessionParameters(
                $request,
                'AdminLTEUser');

        $sessionParameters['id'] = 1;

        $columnCount = count($columns);

        for ($i = 0; $i < $columnCount; $i++) {
            $list[0][$columns[$i]] = isset($sessionParameters[$columns[$i]])
                    ? $sessionParameters[$columns[$i]]
                    : '';
        } // for ($i = 0; $i < $columnCount; $i++) {

        $objectHTMLDB = new HTMLDB();
        $objectHTMLDB->list = $list;
        $objectHTMLDB->columns = $this->columns;
        $objectHTMLDB->printHTMLDBList();
        return;

    }

    public function get_recordlist(Request $request) {
        // start: check user get permission
        $directoryName = basename(dirname(__FILE__));
        $fileName = basename(__FILE__);

        includeLibrary('adminlte/checkUserGetPermission');
        $permissionResult = checkUserGetPermission($directoryName, $fileName);

        if ($permissionResult['error']) {
            $controller->errorCount = 1;
            $controller->lastError = $permissionResult['error_msg'];
            return false;
        }
        // end: check user get permission
        
        global $_SPRIT;
        $dateFormat = (isset($_SPRIT['DATE_FORMAT'])) ? $_SPRIT['DATE_FORMAT'] : 'Y-m-d';
        $timeFormat = (isset($_SPRIT['TIME_FORMAT'])) ? $_SPRIT['TIME_FORMAT'] : 'H:i:s';
        $datetimeFormat = $dateFormat . ' ' . $timeFormat;

        $columns = array();
        $list = array();
        
        $pagename = '';
        if (isset($parameters[0])) {
            $pagename = htmlspecialchars($parameters[0]);
        } // if (isset($parameters[0])) {

        includeLibrary('adminlte/getPageLayout');
        $Widgets = getPageLayout($pagename);

        includeLibrary('adminlte/getRecordListValueVariables');
        $variables = getRecordListValueVariables($Widgets, '__SystemUser');

        if (0 == count($variables)) {
            $variables = array();
        } // if (0 == count($variables)) {

        includeLibrary('adminlte/getRecordListLimit');
        $bufferSize = getRecordListLimit($Widgets, '__SystemUser');

        includeLibrary('adminlte/getRecordListType');
        $showLastRecord = getRecordListType($Widgets, '__SystemUser');

        if (0 == $bufferSize) {
            $bufferSize = 10;
        } // if (0 == $bufferSize) {
        
        if ($showLastRecord) {
            $sortingColumn = 'id';
            $sortingAscending = false;
            $searchText = '';
            $page = 0;
        } else {
            includeLibrary('getModelSessionParameters');
            $sessionParameters = getModelSessionParameters('__SystemUser');

            $sortingColumn = isset($sessionParameters['sortingColumn'])
                    ? htmlspecialchars($sessionParameters['sortingColumn'])
                    : 'id';

            if (false !== strpos($sortingColumn, 'DisplayText')) {
                includeLibrary('adminlte/getModelForeignSortColumn');
                $sortingColumn = getModelForeignSortColumn('__SystemUser', $sortingColumn);
            }

            $sortingAscending = isset($sessionParameters['sortingASC'])
                    ? (1 == intval($sessionParameters['sortingASC']))
                    : false;

            $searchText = isset($sessionParameters['searchText'])
                    ? $sessionParameters['searchText']
                    : '';
            
            /*$bufferSize = isset($sessionParameters['bufferSize'])
                    ? $sessionParameters['bufferSize']
                    : 10;*/

            $page = isset($sessionParameters['page'])
                    ? $sessionParameters['page']
                    : 0;
        }

        $defaultColumns = [
            'id/display_text',
            'deleted',
            'deleted/display_text',
            'creationDate',
            'creationDate/display_text',
            'lastUpdate',
            'lastUpdate/display_text',
            'enabled',
            'enabled/display_text',
            '__systemusergroup_id',
            '__systemusergroup_id/display_text',
            'fullname',
            'fullname/display_text',
            'username',
            'username/display_text',
            'email',
            'email/display_text',
            'password',
            'password/display_text',
            'menu_permission',
            'menu_permission/display_text',
            'service_permission',
            'service_permission/display_text',
            'profile_img',
            'profile_img/display_text'
        ];
        
        $countDefaultColumns = count($defaultColumns);
        $columns = array();
        $columns[] = 'id';

        for ($i=0; $i < $countDefaultColumns; $i++) {
            $defaultColumn = $defaultColumns[$i];

            if (in_array($defaultColumn, $variables)) {
                $columns[] = $defaultColumns[$i];
            } // if (in_array($defaultColumn, $variables)) {
        } // for ($i=0; $i < $countDefaultColumns; $i++) {
        
        includeLibrary('adminlte/base64decode');
        includeLibrary('adminlte/getObjectDisplayTexts');
        
        includeModel('__SystemUserGroup');
        $objectAdminLTEUserGroup = new __SystemUserGroup();

        includeModel('__SystemUser');
        $list__SystemUser = new __SystemUser();
        $list__SystemUser->bufferSize = $bufferSize;
        $list__SystemUser->page = $page;
        $list__SystemUser->addFilter('deleted','==', false);
        $list__SystemUser->addSearchText($searchText);
        $list__SystemUser->sortByProperty($sortingColumn, $sortingAscending);
        $list__SystemUser->find();
        
        $count__SystemUser = $list__SystemUser->listCount;
        $objectAdminLTEUser = NULL;
        $index = 0;

        for ($i = 0; $i < $count__SystemUser; $i++) {
            $objectAdminLTEUser = $list__SystemUser->list[$i];

            $list[$index]['id'] = $objectAdminLTEUser->id;

            if (in_array('deleted', $variables)) {
                $list[$index]['deleted'] = $objectAdminLTEUser->deleted;
            } // if (in_array('deleted', $variables)) {
            
            if (in_array('creationDate', $variables)) {
                $list[$index]['creationDate'] = $objectAdminLTEUser->creationDate;
            } // if (in_array('creationDate', $variables)) {
            
            if (in_array('lastUpdate', $variables)) {
                $list[$index]['lastUpdate'] = $objectAdminLTEUser->lastUpdate;
            } // if (in_array('lastUpdate', $variables)) {

            if (in_array('enabled', $variables)) {
                $list[$index]['enabled'] = $objectAdminLTEUser->enabled;
            } // if (in_array('enabled', $variables)) {
            
            if (in_array('__systemusergroup_id', $variables)) {
                $list[$index]['__systemusergroup_id'] = $objectAdminLTEUser->__systemusergroup_id;
            } // if (in_array('__systemusergroup_id', $variables)) {

            if (in_array('fullname', $variables)) {
                $list[$index]['fullname'] = $objectAdminLTEUser->fullname;
            } // if (in_array('fullname', $variables)) {

            if (in_array('username', $variables)) {
                $list[$index]['username'] = $objectAdminLTEUser->username;
            } // if (in_array('username', $variables)) {

            if (in_array('email', $variables)) {
                $list[$index]['email'] = $objectAdminLTEUser->email;
            } // if (in_array('email', $variables)) {

            if (in_array('password', $variables)) {
                $list[$index]['password'] = $objectAdminLTEUser->password;
            } // if (in_array('password', $variables)) {

            if (in_array('menu_permission', $variables)) {
                $list[$index]['menu_permission'] = base64decode($objectAdminLTEUser->menu_permission);
            } // if (in_array('menu_permission', $variables)) {
            
            if (in_array('service_permission', $variables)) {
                $list[$index]['service_permission'] = base64decode($objectAdminLTEUser->service_permission);
            } // if (in_array('service_permission', $variables)) {
            
            if (in_array('profile_img', $variables)) {
                $list[$index]['profile_img'] = $objectAdminLTEUser->profile_img;
            } // if (in_array('profile_img', $variables)) {

            // Display Texts
            $displayTexts = getObjectDisplayTexts('__SystemUser', $objectAdminLTEUser);

            if (in_array('id/display_text', $variables)) {
                $list[$index]['id/display_text'] = $displayTexts['id'];
            } // if (in_array('id/display_text', $variables)) {
            
            if (in_array('creationDate/display_text', $variables)) {
                $list[$index]['creationDate/display_text'] = $displayTexts['creationDate'];
            } // if (in_array('creationDate/display_text', $variables)) {

            if (in_array('lastUpdate/display_text', $variables)) {
                $list[$index]['lastUpdate/display_text'] = $displayTexts['lastUpdate'];
            } // if (in_array('lastUpdate/display_text', $variables)) {

            if (in_array('deleted/display_text', $variables)) {
                $list[$index]['deleted/display_text'] = $displayTexts['deleted'];
            } // if (in_array('deleted/display_text', $variables)) {

            if (in_array('enabled/display_text', $variables)) {
                $list[$index]['enabled/display_text'] = $displayTexts['enabled'];
            } // if (in_array('enabled/display_text', $variables)) {

            if (in_array('__systemusergroup_id/display_text', $variables)) {
                $list[$index]['__systemusergroup_id/display_text'] = $displayTexts['__systemusergroup_id'];
            } // if (in_array('__systemusergroup_id/display_text', $variables)) {

            if (in_array('fullname/display_text', $variables)) {
                $list[$index]['fullname/display_text'] = $displayTexts['fullname'];
            } // if (in_array('fullname/display_text', $variables)) {

            if (in_array('username/display_text', $variables)) {
                $list[$index]['username/display_text'] = $displayTexts['username'];
            } // if (in_array('username/display_text', $variables)) {

            if (in_array('email/display_text', $variables)) {
                $list[$index]['email/display_text'] = $displayTexts['email'];
            } // if (in_array('email/display_text', $variables)) {

            if (in_array('password/display_text', $variables)) {
                $list[$index]['password/display_text'] = $displayTexts['password'];
            } // if (in_array('password/display_text', $variables)) {

            if (in_array('menu_permission/display_text', $variables)) {
                $list[$index]['menu_permission/display_text'] = $displayTexts['menu_permission'];
            } // if (in_array('menu_permission/display_text', $variables)) {

            if (in_array('service_permission/display_text', $variables)) {
                $list[$index]['service_permission/display_text'] = $displayTexts['service_permission'];
            } // if (in_array('service_permission/display_text', $variables)) {

            if (in_array('profile_img/display_text', $variables)) {
                $list[$index]['profile_img/display_text'] = $displayTexts['profile_img'];
            } // if (in_array('profile_img/display_text', $variables)) {

            $index++;
        } // for ($i = 0; $i < $count__SystemUser; $i++) {
    }

    public function get_recordgraphdata(Request $request)
    {
        // start: check user get permission
        $directoryName = basename(dirname(__FILE__));
        $fileName = basename(__FILE__);

        includeLibrary('adminlte/checkUserGetPermission');
        $permissionResult = checkUserGetPermission($directoryName, $fileName);

        if ($permissionResult['error']) {
            $controller->errorCount = 1;
            $controller->lastError = $permissionResult['error_msg'];
            return false;
        }
        // end: check user get permission
        
        $columns = [
            'id',
            'data'
        ];

        $list = array();

        global $_SPRIT;
        $dateFormat = (isset($_SPRIT['DATE_FORMAT'])) ? $_SPRIT['DATE_FORMAT'] : 'Y-m-d';
        $yearmonthFormat = (isset($_SPRIT['YEARMONTH_FORMAT'])) ? $_SPRIT['YEARMONTH_FORMAT'] : 'Y-m';
        
        $pagename = '';
        if (isset($parameters[0])) {
            $pagename = htmlspecialchars($parameters[0]);
        } // if (isset($parameters[0])) {

        includeLibrary('adminlte/getPageLayout');
        $Widgets = getPageLayout($pagename);

        includeLibrary('adminlte/getRecordGraphProperties');
        $graphProperties = getRecordGraphProperties($Widgets, '__SystemUser');
        
        $graphType = $graphProperties['type'];

        $period = (0 - $graphProperties['period']);
        $fromdate = strtotime($period . ' month');

        $graphData = array();

        includeModel('__SystemUser');
        $list__SystemUser = new __SystemUser();
        $list__SystemUser->bufferSize = 0;
        $list__SystemUser->page = 0;
        $list__SystemUser->addFilter('deleted','==', false);
        $list__SystemUser->addFilter('creationDate','>=', $fromdate);
        $list__SystemUser->sortByProperty('creationDate', true);
        $list__SystemUser->find();
        
        $count__SystemUser = $list__SystemUser->listCount;
        $objectAdminLTEUser = NULL;
        $index = 0;
            
        if ('daily' == $graphType) {
            for ($i = 0; $i < $count__SystemUser; $i++) {
                $objectAdminLTEUser = $list__SystemUser->list[$i];
                $creationDate = date($dateFormat, $objectAdminLTEUser->creationDate);

                if (!isset($graphData[$creationDate])) {
                    $graphData[$creationDate] = 0;
                }

                $graphData[$creationDate]++;
            } // for ($i = 0; $i < $count__SystemUser; $i++) {
        } else if ('monthly' == $graphType) {
            for ($i = 0; $i < $count__SystemUser; $i++) {
                $objectAdminLTEUser = $list__SystemUser->list[$i];
                $creationDate = date($yearmonthFormat, $objectAdminLTEUser->creationDate);

                if (!isset($graphData[$creationDate])) {
                    $graphData[$creationDate] = 0;
                }

                $graphData[$creationDate]++;
            } // for ($i = 0; $i < $count__SystemUser; $i++) {
            } // if ('daily' == $graphType) {
        
        $keys = array_keys($graphData);
        $countKeys = count($keys);
        
        if (0 == $countKeys) {
            return false;
        } // if (0 == $countKeys) {

        $graphJSON = '';
        for ($i=0; $i < $countKeys; $i++) {
            $creationDate = $keys[$i];
            $countRecord = $graphData[$creationDate];

            if ($graphJSON != '') {
                $graphJSON .= ',';
            } // if ($graphJSON != '') {

            $graphJSON .= '{';
            $graphJSON .= ('"date":"' . $creationDate . '",');
            $graphJSON .= ('"record":' . $countRecord . '');
            $graphJSON .= '}';
        }
        $graphJSON = ('[' . $graphJSON . ']');


        $list[0]['id'] = 1;
        $list[0]['data'] = rawurlencode($graphJSON);
        return true;
    }

    public function get_infoboxvalue(Request $request)
    {
        $columns = [
            'id',
            'model',
            'value'
        ];

        $list = array();
        $list[0]['id'] = 1;
        $list[0]['model'] = 'AdminLTEUser';
        
        $list[0]['value'] = AdminLTEUser::where('deleted', false)->count();

        $objectHTMLDB = new HTMLDB();
        $objectHTMLDB->list = $list;
        $objectHTMLDB->columns = $columns;
        $objectHTMLDB->printHTMLDBList();
        return;
    }

    public function get_form_delete(Request $request)
    {
        $columns = [
            'id',
            'idcsv'
        ];

        $list = array();

        $objectHTMLDB = new HTMLDB();
        $objectHTMLDB->list = $list;
        $objectHTMLDB->columns = $columns;
        $objectHTMLDB->printHTMLDBList();
        return;
    }

    public function post_session(Request $request)
    {

        $adminLTE = new AdminLTE();
        $objectHTMLDB = new HTMLDB();

        $sessionParameters = $adminLTE->getModelSessionParameters(
                $request,
                'AdminLTEUser');

        $this->columns = [
            'searchText',
            'sortingColumn',
            'sortingASC',
            'page',
            'bufferSize',
            'pageCount'
        ];

        $this->row = $objectHTMLDB->requestPOSTRow(
                $request->all(),
                $this->columns,
                $this->protectedColumns,
                0,
                true);

        $sessionParameters['searchText']
                = isset($this->row['searchText'])
                ? htmlspecialchars($this->row['searchText'])
                : $sessionParameters['searchText'];

        $sessionParameters['sortingColumn']
                = isset($this->row['sortingColumn'])
                ? htmlspecialchars($this->row['sortingColumn'])
                : $sessionParameters['sortingColumn'];

        $sessionParameters['sortingASC']
                = isset($this->row['sortingASC'])
                ? intval($this->row['sortingASC'])
                : $sessionParameters['sortingASC'];

        $sessionParameters['page']
                = isset($this->row['page'])
                ? intval($this->row['page'])
                : $sessionParameters['page'];

        $sessionParameters['bufferSize']
                = isset($this->row['bufferSize'])
                ? intval($this->row['bufferSize'])
                : $sessionParameters['bufferSize'];
        
        if (0 == $sessionParameters['bufferSize'])
        {
            $sessionParameters['pageCount'] = 0;
        }
        else
        {
            $sessionParameters['pageCount'] = ceil(
                    AdminLTEUser::where('deleted', false)->count()
                    / $sessionParameters['bufferSize']);
        } // if (0 == $sessionParameters['bufferSize'])

        $adminLTE->setModelSessionParameters($request,
                'AdminLTEUser',
                $sessionParameters);

        $objectHTMLDB->printResponseJSON();
        return;

    }

    public function post(Request $request)
    {
        loadLanguageFile('__systemuser', 'adminlte');
        
        $controller->errorCount = 0;
        $controller->messageCount = 0;
        $controller->lastError = '';
        $controller->lastMessage = '';

        $current__SystemUser = null;

        includeModel('__SystemUser');
        
        $id = isset($_REQUEST['htmldb_row0_id'])
            ? intval($_REQUEST['htmldb_row0_id'])
            : 0;

        if (0 != $id) {
            $current__SystemUser = new __SystemUser($id);
        }

        $fullname = isset($_REQUEST['htmldb_row0_fullname'])
            ? htmlspecialchars($_REQUEST['htmldb_row0_fullname'])
            : '';
        
        $username = isset($_REQUEST['htmldb_row0_username'])
            ? htmlspecialchars($_REQUEST['htmldb_row0_username'])
            : '';

        includeLibrary('convertNameToFileName');
        $username = convertNameToFileName($username);

        $email = isset($_REQUEST['htmldb_row0_email'])
            ? htmlspecialchars($_REQUEST['htmldb_row0_email'])
            : '';

        $password = isset($_REQUEST['htmldb_row0_password'])
            ? htmlspecialchars($_REQUEST['htmldb_row0_password'])
            : '';

        if ('' == $fullname) {
            $controller->errorCount++;

            if ($controller->lastError != '') {
                $controller->lastError .= '<br>';
            } // if ($controller->lastError != '') {

            $controller->lastError .= __('Please specify fullname.');
        } // if ('' == $fullname) {

        if ('' == $username) {

            $controller->errorCount++;
            if ($controller->lastError != '') {
                $controller->lastError .= '<br>';
            } // if ($controller->lastError != '') {

            $controller->lastError .= __('Please specify username.');
        } else {
            $list__SystemUser = new __SystemUser();
            $list__SystemUser->addFilter('deleted', '==', false);
            $list__SystemUser->addFilter('username', '==', $username);
            if (null !== $current__SystemUser) {
                $list__SystemUser->addFilter('id', '!=', $current__SystemUser->id);
            }
            $list__SystemUser->bufferSize = 1;
            $list__SystemUser->page = 0;
            $list__SystemUser->find();

            if ($list__SystemUser->listCount > 0) {

                $controller->errorCount++;
                if ($controller->lastError != '') {
                    $controller->lastError .= '<br>';
                } // if ($controller->lastError != '') {

                $controller->lastError .= __('Username specified belongs to another user. Please specify another username.');

            } // if ($list__SystemUser->listCount > 0) {
        } // if ('' == $username) {  
        
        if ('' == $email) {

            $controller->errorCount++;
            if ($controller->lastError != '') {
                $controller->lastError .= '<br>';
            } // if ($controller->lastError != '') {

            $controller->lastError .= __('Please specify email address.');
        } else {
            includeLibrary('validateEmailAddress');
            if (!validateEmailAddress($email)) {
                $controller->errorCount++;
                if ($controller->lastError != '') {
                    $controller->lastError .= '<br>';
                } // if ($controller->lastError != '') {

                $controller->lastError .= __('Please specify a valid email address.');
            } else {
                $list__SystemUser = new __SystemUser();
                $list__SystemUser->addFilter('deleted', '==', false);
                $list__SystemUser->addFilter('email', '==', $email);
                if (null !== $current__SystemUser) {
                    $list__SystemUser->addFilter('id', '!=', $current__SystemUser->id);
                }
                $list__SystemUser->bufferSize = 1;
                $list__SystemUser->page = 0;
                $list__SystemUser->find();

                if ($list__SystemUser->listCount > 0) {

                    $controller->errorCount++;
                    if ($controller->lastError != '') {
                        $controller->lastError .= '<br>';
                    } // if ($controller->lastError != '') {

                    $controller->lastError .= __('E-mail address specified belongs to another user. Please specify another e-mail address.');

                } // if ($list__SystemUser->listCount > 0) {
            }
        }

        if ((0 == $id) && ('' == $password)) {
            $controller->errorCount++;
            if ($controller->lastError != '') {
                $controller->lastError .= '<br>';
            } // if ($controller->lastError != '') {

            $controller->lastError .= __('Please specify password.');
        }

        if ($controller->errorCount > 0) {
            return false;
        } // if ($controller->errorCount > 0) {

        includeLibrary('convertNameToFileName');
        includeLibrary('adminlte/base64encode');

        includeModel('__SystemUser');
        $objectAdminLTEUser = new __SystemUser();
        $objectAdminLTEUser->request($_REQUEST, 'htmldb_row0_');

        $objectAdminLTEUser->username = convertNameToFileName($objectAdminLTEUser->username);
        
        $objectAdminLTEUser->menu_permission = base64encode($objectAdminLTEUser->menu_permission);
        $objectAdminLTEUser->service_permission = base64encode($objectAdminLTEUser->service_permission);

        $password = isset($_REQUEST['htmldb_row0_password'])
            ? htmlspecialchars($_REQUEST['htmldb_row0_password'])
            : '';

        if ('' != $password) {
            $objectAdminLTEUser->password = $password;
        }

        $objectAdminLTEUser->profile_img = 'media/user_images/default.jpg';

        $objectAdminLTEUser->update();

        $_SESSION[sha1('__systemuser_lastid')] = $objectAdminLTEUser->id;

        return;

    }

    public function delete(Request $request)
    {
        $idcsv = isset($_REQUEST['htmldb_row0_idcsv'])
            ? htmlspecialchars($_REQUEST['htmldb_row0_idcsv'])
            : '';

        if ('' == $idcsv) {

            $controller->errorCount++;
            if ($controller->lastError != '') {
                $controller->lastError .= '<br>';
            } // if ($controller->lastError != '') {

            $controller->lastError .= __('Please select records.');
            return false;
        } // if ('' == $idcsv) {

        $ids = explode(',', $idcsv);
        $idCount = count($ids);
        
        includeModel('__SystemUser');
        $objectAdminLTEUser = new __SystemUser();

        for ($i=0; $i < $idCount; $i++) { 
            $objectAdminLTEUser->id = $ids[$i];
            $objectAdminLTEUser->revert();
            $objectAdminLTEUser->deleted = 1;
            $objectAdminLTEUser->update();
        }

        if ($idCount > 0) {
            includeLibrary('getModelSessionParameters');
            $sessionParameters = getModelSessionParameters('__SystemUser');

            $list__SystemUser = new __SystemUser();
            $list__SystemUser->bufferSize = 1;
            $list__SystemUser->page = 0;
            $list__SystemUser->addFilter('deleted','==', false);
            $list__SystemUser->addSearchText($sessionParameters['searchText']);
            $list__SystemUser->find();

            $sessionParameters['pageCount'] = ceil($list__SystemUser->getPageCount() / $sessionParameters['bufferSize']);
            
            if ($sessionParameters['page'] == $sessionParameters['pageCount']) {
                if ($sessionParameters['page'] > 0) {
                    $sessionParameters['page']--;
                }
            }

            includeLibrary('setModelSessionParameters');
            setModelSessionParameters('__SystemUser', $sessionParameters);
        }

        $controller->messageCount = 1;
        $controller->lastMessage = 'UPDATED';
        return true;
    }

}
