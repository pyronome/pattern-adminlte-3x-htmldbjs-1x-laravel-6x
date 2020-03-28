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

    public function get(Request $request) {
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

        $list = array();

        // is new ?
        if (isset($parameters[0]) && ("new" == htmlspecialchars($parameters[0]))) {
            return false;
        } // if (isset($parameters[0]) && ("new" == htmlspecialchars($parameters[0]))) {
        
        $id = 0;
        if (isset($parameters[0])) {
            $id = (isset($parameters[0]) ? intval($parameters[0]) : 0);
        } // if (isset($parameters[0])) {
        
        includeLibrary('adminlte/base64decode');
        includeLibrary('adminlte/getObjectDisplayTexts');
        includeModel('__SystemUserGroup');
        $object__SystemUserGroup = new __SystemUserGroup();

        includeModel('__SystemUser');
        $list__SystemUser = new __SystemUser();
        $list__SystemUser->bufferSize = 0;
        $list__SystemUser->page = 0;
        $list__SystemUser->addFilter('deleted','==', false);
        if ($id > 0) {
            $list__SystemUser->addFilter('id','==', $id);     
        } else {
            $list__SystemUser->sortByProperty('creationDate', false);
        } // if ($id > 0) {

        $list__SystemUser->find();

        $count__SystemUser = $list__SystemUser->listCount;
        $object__SystemUser = NULL;
        $index = 0;

        for ($i = 0; $i < $count__SystemUser; $i++) {
            $object__SystemUser = $list__SystemUser->list[$i];
            
            $list[$index]['id'] = $object__SystemUser->id;
            $list[$index]['deleted'] = $object__SystemUser->deleted;
            $list[$index]['creationDate'] = $object__SystemUser->creationDate;
            $list[$index]['lastUpdate'] = $object__SystemUser->lastUpdate;
            $list[$index]['enabled'] = $object__SystemUser->enabled;
            $list[$index]['__systemusergroup_id'] = $object__SystemUser->__systemusergroup_id;
            $list[$index]['fullname'] = $object__SystemUser->fullname;
            $list[$index]['username'] = $object__SystemUser->username;
            $list[$index]['email'] = $object__SystemUser->email;
            $list[$index]['password'] = '';
            $list[$index]['menu_permission'] = base64decode($object__SystemUser->menu_permission);
            $list[$index]['service_permission'] = base64decode($object__SystemUser->service_permission);
            $list[$index]['profile_img'] = $object__SystemUser->profile_img;

            // Display Texts
            $displayTexts = getObjectDisplayTexts('__SystemUser', $object__SystemUser);

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
            
            if (0 != $object__SystemUser->__systemusergroup_id) {
                $object__SystemUserGroup->id = $object__SystemUser->__systemusergroup_id;
                $object__SystemUserGroup->revert();
                
                $list[$index]['group_menu_permission'] = base64decode($object__SystemUserGroup->menu_permission);
                $list[$index]['group_service_permission'] = base64decode($object__SystemUserGroup->service_permission);
            }

            $index++;
        } // for ($i = 0; $i < $count__SystemUser; $i++) {

    }

    public function get_session(Request $request) {
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
            'searchText',
            'sortingColumn',
            'sortingASC',
            'page',
            'pageCount',
            'bufferSize'
        ];

        $list = [];

        includeLibrary('getModelSessionParameters');
        $sessionParameters = getModelSessionParameters('__SystemUser');
        
        if (!isset($sessionParameters['page'])) {
            $pagename = '';
            if (isset($parameters[0])) {
                $pagename = htmlspecialchars($parameters[0]);
            } // if (isset($parameters[0])) {

            includeLibrary('adminlte/getPageLayout');
            $Widgets = getPageLayout($pagename);

            includeLibrary('adminlte/getRecordListLimit');
            $bufferSize = getRecordListLimit($Widgets, '__SystemUser');
            
            includeModel('__SystemUser');
            $list__SystemUser = new __SystemUser();
            $list__SystemUser->bufferSize = 1;
            $list__SystemUser->page = 0;
            $list__SystemUser->addFilter('deleted','==', false);
            $list__SystemUser->addSearchText($sessionParameters['searchText']);
            $list__SystemUser->find();

            $pageCount = ceil($list__SystemUser->getPageCount() / $bufferSize);


            includeLibrary('setModelSessionParameters');
            setModelSessionParameters('__SystemUser', [
                    'searchText' => '',
                    'sortingColumn' => 'id',
                    'sortingASC' => 2,
                    'page' => 0,
                    'pageCount' => $pageCount,
                    'bufferSize' => $bufferSize
            ]);
        }

        $sessionParameters = getModelSessionParameters('__SystemUser');

        $sessionParameters['id'] = 1;

        $columnCount = count($columns);

        for ($i = 0; $i < $columnCount; $i++) {
            $list[0][$columns[$i]] = isset($sessionParameters[$columns[$i]])
                    ? $sessionParameters[$columns[$i]]
                    : '';
        } // for ($i = 0; $i < $columnCount; $i++) {



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
        $object__SystemUserGroup = new __SystemUserGroup();

        includeModel('__SystemUser');
        $list__SystemUser = new __SystemUser();
        $list__SystemUser->bufferSize = $bufferSize;
        $list__SystemUser->page = $page;
        $list__SystemUser->addFilter('deleted','==', false);
        $list__SystemUser->addSearchText($searchText);
        $list__SystemUser->sortByProperty($sortingColumn, $sortingAscending);
        $list__SystemUser->find();
        
        $count__SystemUser = $list__SystemUser->listCount;
        $object__SystemUser = NULL;
        $index = 0;

        for ($i = 0; $i < $count__SystemUser; $i++) {
            $object__SystemUser = $list__SystemUser->list[$i];

            $list[$index]['id'] = $object__SystemUser->id;

            if (in_array('deleted', $variables)) {
                $list[$index]['deleted'] = $object__SystemUser->deleted;
            } // if (in_array('deleted', $variables)) {
            
            if (in_array('creationDate', $variables)) {
                $list[$index]['creationDate'] = $object__SystemUser->creationDate;
            } // if (in_array('creationDate', $variables)) {
            
            if (in_array('lastUpdate', $variables)) {
                $list[$index]['lastUpdate'] = $object__SystemUser->lastUpdate;
            } // if (in_array('lastUpdate', $variables)) {

            if (in_array('enabled', $variables)) {
                $list[$index]['enabled'] = $object__SystemUser->enabled;
            } // if (in_array('enabled', $variables)) {
            
            if (in_array('__systemusergroup_id', $variables)) {
                $list[$index]['__systemusergroup_id'] = $object__SystemUser->__systemusergroup_id;
            } // if (in_array('__systemusergroup_id', $variables)) {

            if (in_array('fullname', $variables)) {
                $list[$index]['fullname'] = $object__SystemUser->fullname;
            } // if (in_array('fullname', $variables)) {

            if (in_array('username', $variables)) {
                $list[$index]['username'] = $object__SystemUser->username;
            } // if (in_array('username', $variables)) {

            if (in_array('email', $variables)) {
                $list[$index]['email'] = $object__SystemUser->email;
            } // if (in_array('email', $variables)) {

            if (in_array('password', $variables)) {
                $list[$index]['password'] = $object__SystemUser->password;
            } // if (in_array('password', $variables)) {

            if (in_array('menu_permission', $variables)) {
                $list[$index]['menu_permission'] = base64decode($object__SystemUser->menu_permission);
            } // if (in_array('menu_permission', $variables)) {
            
            if (in_array('service_permission', $variables)) {
                $list[$index]['service_permission'] = base64decode($object__SystemUser->service_permission);
            } // if (in_array('service_permission', $variables)) {
            
            if (in_array('profile_img', $variables)) {
                $list[$index]['profile_img'] = $object__SystemUser->profile_img;
            } // if (in_array('profile_img', $variables)) {

            // Display Texts
            $displayTexts = getObjectDisplayTexts('__SystemUser', $object__SystemUser);

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
        $object__SystemUser = NULL;
        $index = 0;
            
        if ('daily' == $graphType) {
            for ($i = 0; $i < $count__SystemUser; $i++) {
                $object__SystemUser = $list__SystemUser->list[$i];
                $creationDate = date($dateFormat, $object__SystemUser->creationDate);

                if (!isset($graphData[$creationDate])) {
                    $graphData[$creationDate] = 0;
                }

                $graphData[$creationDate]++;
            } // for ($i = 0; $i < $count__SystemUser; $i++) {
        } else if ('monthly' == $graphType) {
            for ($i = 0; $i < $count__SystemUser; $i++) {
                $object__SystemUser = $list__SystemUser->list[$i];
                $creationDate = date($yearmonthFormat, $object__SystemUser->creationDate);

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
            'model',
            'value'
        ];

        $list = array();
        $list[0]['id'] = 1;
        $list[0]['model'] = '__SystemUser';
        
        includeLibrary('adminlte/getModelObjectCount');
        $list[0]['value'] = getModelObjectCount('__SystemUser');
    }

    public function get_form_delete(Request $request)
    {
        $columns = [
            'id',
            'idcsv'
        ];

        $list = array();
    }

    public function post_session(Request $request) {
        // start: check user post permission
        $directoryName = basename(dirname(__FILE__));
        $fileName = basename(__FILE__);

        includeLibrary('adminlte/checkUserPostPermission');
        $permissionResult = checkUserPostPermission($directoryName, $fileName);

        if ($permissionResult['error']) {
            $controller->errorCount = 1;
            $controller->lastError = $permissionResult['error_msg'];
            return false;
        }
        // end: check user post permission
        
        includeLibrary('getModelSessionParameters');
        $sessionParameters = getModelSessionParameters('__SystemUser');

        $sessionParameters['searchText']
                = isset($_REQUEST['htmldb_row0_searchText'])
                ? htmlspecialchars($_REQUEST['htmldb_row0_searchText'])
                : $sessionParameters['searchText'];

        $sessionParameters['sortingColumn']
                = isset($_REQUEST['htmldb_row0_sortingColumn'])
                ? htmlspecialchars($_REQUEST['htmldb_row0_sortingColumn'])
                : $sessionParameters['sortingColumn'];

        $sessionParameters['sortingASC']
                = isset($_REQUEST['htmldb_row0_sortingASC'])
                ? intval($_REQUEST['htmldb_row0_sortingASC'])
                : $sessionParameters['sortingASC'];

        $sessionParameters['page']
                = isset($_REQUEST['htmldb_row0_page'])
                ? intval($_REQUEST['htmldb_row0_page'])
                : $sessionParameters['page'];

        $sessionParameters['bufferSize']
                = isset($_REQUEST['htmldb_row0_bufferSize'])
                ? intval($_REQUEST['htmldb_row0_bufferSize'])
                : $sessionParameters['bufferSize'];

        
        if (0 == $sessionParameters['bufferSize']) {
            $sessionParameters['pageCount'] = 0;
        } else {
            includeModel('__SystemUser');
            $list__SystemUser = new __SystemUser();
            $list__SystemUser->bufferSize = 1;
            $list__SystemUser->page = 0;
            $list__SystemUser->addFilter('deleted','==', false);
            $list__SystemUser->addSearchText($sessionParameters['searchText']);
            $list__SystemUser->find();

            $sessionParameters['pageCount'] = ceil($list__SystemUser->getPageCount() / $sessionParameters['bufferSize']);
        }    

        includeLibrary('setModelSessionParameters');
        setModelSessionParameters('__SystemUser', $sessionParameters);

    }

    public function post(Request $request) {
        loadLanguageFile('__systemuser', 'adminlte');
        
        $controller->errorCount = 0;
        $controller->messageCount = 0;
        $controller->lastError = '';
        $controller->lastMessage = '';

        // start: check user post permission
        $directoryName = basename(dirname(__FILE__));
        $fileName = basename(__FILE__);

        includeLibrary('adminlte/checkUserPostPermission');
        $permissionResult = checkUserPostPermission($directoryName, $fileName);

        if ($permissionResult['error']) {
            $controller->errorCount = 1;
            $controller->lastError = $permissionResult['error_msg'];
            return false;
        }
        // end: check user post permission

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
        $object__SystemUser = new __SystemUser();
        $object__SystemUser->request($_REQUEST, 'htmldb_row0_');

        $object__SystemUser->username = convertNameToFileName($object__SystemUser->username);
        
        $object__SystemUser->menu_permission = base64encode($object__SystemUser->menu_permission);
        $object__SystemUser->service_permission = base64encode($object__SystemUser->service_permission);

        $password = isset($_REQUEST['htmldb_row0_password'])
            ? htmlspecialchars($_REQUEST['htmldb_row0_password'])
            : '';

        if ('' != $password) {
            $object__SystemUser->password = $password;
        }

        $object__SystemUser->profile_img = 'media/user_images/default.jpg';

        $object__SystemUser->update();

        $_SESSION[sha1('__systemuser_lastid')] = $object__SystemUser->id;

        return;

    }

    public function delete(Request $request)
    {

        // start: check user delete permission
        $directoryName = basename(dirname(__FILE__));
        $fileName = basename(__FILE__);

        includeLibrary('adminlte/checkUserDeletePermission');
        $permissionResult = checkUserDeletePermission($directoryName, $fileName);

        if ($permissionResult['error']) {
            $controller->errorCount = 1;
            $controller->lastError = $permissionResult['error_msg'];
            return false;
        }
        // end: check user delete permission
        
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
        $object__SystemUser = new __SystemUser();

        for ($i=0; $i < $idCount; $i++) { 
            $object__SystemUser->id = $ids[$i];
            $object__SystemUser->revert();
            $object__SystemUser->deleted = 1;
            $object__SystemUser->update();
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
