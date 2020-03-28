<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use App\AdminLTEUser;
use App\AdminLTELayout;
use App\AdminLTEUserGroup;

/* {{snippet:begin_class}} */

class AdminLTE
{

	/* {{snippet:begin_properties}} */

	/* {{snippet:end_properties}} */

	/* {{snippet:begin_methods}} */

	public function validateEmailAddress($email)
	{

		$isValid = true;
		$atIndex = strrpos($email, "@");

		if (is_bool($atIndex) && !$atIndex)
		{
			$isValid = false;
		}
		else
		{
			$domain = substr($email, $atIndex+1);
			$local = substr($email, 0, $atIndex);
			$localLen = strlen($local);
			$domainLen = strlen($domain);
			
			if ($localLen < 1 || $localLen > 64)
			{
				// local part length exceeded
				$isValid = false;
			}
			else if ($domainLen < 1 || $domainLen > 255)
			{
				// domain part length exceeded
				$isValid = false;
			}
			else if ($local[0] == '.' || $local[$localLen-1] == '.')
			{
				// local part starts or ends with '.'
				$isValid = false;
			}
			else if (preg_match('/\\.\\./', $local))
			{
				// local part has two consecutive dots
				$isValid = false;
			}
			else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
			{
				// character not valid in domain part
				$isValid = false;
			}
			else if (preg_match('/\\.\\./', $domain))
			{
				// domain part has two consecutive dots
				$isValid = false;
			}
			else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
					str_replace("\\\\","",$local)))
			{
				// character not valid in local part unless 
				// local part is quoted
				if (!preg_match('/^"(\\\\"|[^"])+"$/',
						str_replace("\\\\","",$local)))
				{
					$isValid = false;
				} // if (!preg_match('/^"(\\\\"|[^"])+"$/',
			} // if ($localLen < 1 || $localLen > 64) {
		} // if (is_bool($atIndex) && !$atIndex) {

		return $isValid;

	}

	public function getUserData()
	{
        $adminLTEUser = auth()->guard('adminlteuser')->user();

		$userData = [
			'id' => 0,
			'type' => 'user',
			'email' => '',
			'username' => '',
			'name' => '',
			'menu_permission' => '',
			'service_permission' => '',
			'widget_permission' => '',
			'image' => '/assets/adminlte/img/default-user-image.png'
		];

		if ($adminLTEUser != null) {

			$userType = 'user';

			if (1 == $adminLTEUser->id) {
				$userType = 'root';
			} // if (1 == $adminLTEUser->id) {

			$userData = [
				'id' => $adminLTEUser->id,
				'type' => $userType,
				'email' => $adminLTEUser->email,
				'username' => $adminLTEUser->username,
				'name' => $adminLTEUser->fullname,
				'menu_permission' => $this->getUserMenuPermission($adminLTEUser),
				'service_permission' => $this->getUserServicePermission($adminLTEUser),
				'widget_permission' => '',
				'image' => '/assets/adminlte/img/default-user-image.png'
			];

            $adminLTEUserGroup = AdminLTEUserGroup::find(
					$adminLTEUser->adminlteusergroup_id);

			if ($adminLTEUserGroup != null)
			{
				$userData['widget_permission']
						= $adminLTEUserGroup->widget_permission;
			} // if ($adminLTEUserGroup != null)

		} // if ($adminLTEUser == null) {

		return $userData;
	}

	public function getAdminLTEFolder()
	{
        $adminLTEFolder = getenv('ADMINLTE_FOLDER');

        if ($adminLTEFolder === false
				|| ('' == $adminLTEFolder))
        {
            $adminLTEFolder = 'adminlte';
        } // if ($adminLTEFolder === false) {

		$adminLTEFolder = rtrim($adminLTEFolder, '/') . '/';

		return $adminLTEFolder; 
	}

	public function getSideMenu($forceDefault = false)
	{

		if (!$forceDefault
				&& Storage::disk('local')->exists('adminlte_menu.json'))
		{
			$menuArray = json_decode(Storage::disk('local')->get('adminlte_menu.json'),
					(JSON_HEX_QUOT
					| JSON_HEX_TAG
					| JSON_HEX_AMP
					| JSON_HEX_APOS));
		}
		else
		{
			$menuArray = config('adminlte_menu');
		} // if (!$forceDefault

		$Menu = array();
		$main_index = 0;

		$countMenuArray = count($menuArray);

		for ($i=0; $i < $countMenuArray; $i++) { 
			if (1 == $menuArray[$i]['visibility']) {
				if (!isset($menuArray[$i]['children'])) {
					$Menu[$main_index]['id'] = 'p' . $i;
					$Menu[$main_index]['permission_token'] = $menuArray[$i]['href'];
					$Menu[$main_index]['url'] = $menuArray[$i]['href'];
					$Menu[$main_index]['href'] = $menuArray[$i]['href'];
					$Menu[$main_index]['title'] = $menuArray[$i]['text'];
					
					$icon = $menuArray[$i]['icon'];
					if ('empty' == $icon) {
						$icon = 'far fa-circle';
					}

					$Menu[$main_index]['icon'] = $icon;
					$Menu[$main_index]['children'] = array();
					$main_index++;
				} else {
					$Menu[$main_index]['id'] = 'p' . $i;
					$Menu[$main_index]['permission_token'] = '';
					$Menu[$main_index]['url'] = '';
					$Menu[$main_index]['href'] = '';
					$Menu[$main_index]['title'] = $menuArray[$i]['text'];
					
					$icon = $menuArray[$i]['icon'];
					if ('empty' == $icon) {
						$icon = 'fas fa-list';
					}

					$Menu[$main_index]['icon'] = $icon;
					$Menu[$main_index]['children'] = array();
					$parentPermissionToken = '';
					$childrenMenu = array();
					$sub_index = 0;

					$subMenuArray = $menuArray[$i]['children'];
					$countSubmenuArray = count($subMenuArray);
					for ($j=0; $j < $countSubmenuArray; $j++) {
						$parentPermissionToken .= $subMenuArray[$j]['href'];
						if (1 == $subMenuArray[$j]['visibility']) {
							$childrenMenu[$sub_index]['id'] = 'c' . $j;
							$childrenMenu[$sub_index]['permission_token'] = $subMenuArray[$j]['href'];
							$childrenMenu[$sub_index]['url'] = $subMenuArray[$j]['href'];
							$childrenMenu[$sub_index]['href'] = $subMenuArray[$j]['href'];
							$childrenMenu[$sub_index]['title'] = $subMenuArray[$j]['text'];

							$icon = $subMenuArray[$j]['icon'];
							if ('empty' == $icon) {
								$icon = 'far fa-circle';
							}

							$childrenMenu[$sub_index]['icon'] = $icon;
							$childrenMenu[$sub_index]['children'] = array();
							$sub_index++;
						} // if($subMenus[$j]['visibility']) {
					} // for ($j=0; $j < $countSubmenuArray; $j++) {

					$Menu[$main_index]['children'] = $childrenMenu;
					$Menu[$main_index]['permission_token'] = $parentPermissionToken;
					$main_index++;
				} // if (0 == count($menuArray[$i]['subMenus'])) {
			} // if ($menuArray[$i]['visibility']) {
		} // for ($i=0; $i < $countMenuArray; $i++) { 

		return $Menu;

	}

	public function getUserMenuPermission($adminLTEUser)
	{
		$permissions = [];
		$joinedPermissions = []; // join group and user permissions
		
		// group permissions
		// add group permissions

		$adminLTEUserGroup = AdminLTEUserGroup::find(
				$adminLTEUser->adminlteusergroup_id);
		
		$decodedPermission = '';

		if ($adminLTEUserGroup != null)
		{
			$decodedPermission = $this->base64Decode(
					$adminLTEUserGroup->menu_permission);
		} // if ($adminLTEUserGroup != null)

		if ('' != $decodedPermission)
		{
			$permissionKeys = explode(',', $decodedPermission);
			$countKeys = count($permissionKeys);

			for ($i=0; $i < $countKeys; $i++)
			{ 
				if (!isset($joinedPermissions[$permissionKeys[$i]]))
				{
					$joinedPermissions[$permissionKeys[$i]] = 1;
				} // if (!isset($joinedPermissions[$permissionKeys[$i]]))
			} // for ($i=0; $i < $countKeys; $i++)
		} // if ('' != $decodedPermission)
		
		// user permissions
		// remove group permissions
		$decodedPermission = $this->base64Decode(
				$adminLTEUser->menu_permission);

		if ('' != $decodedPermission)
		{
			$permissionKeys = explode(',', $decodedPermission);
			$countKeys = count($permissionKeys);

			for ($i=0; $i < $countKeys; $i++)
			{
				$key = $permissionKeys[$i];

				if (false !== strpos($key, '/l'))
				{
					$group_view_key = str_replace('/l', '/v', $key);
					
					if (isset($joinedPermissions[$group_view_key]))
					{
						unset($joinedPermissions[$group_view_key]);
					} // if (isset($joinedPermissions[$group_view_key]))

					$group_edit_key = str_replace('/l', '/e', $key);

					if (isset($joinedPermissions[$group_edit_key]))
					{
						unset($joinedPermissions[$group_edit_key]);
					} // if (isset($joinedPermissions[$group_edit_key]))
				} // if (false !== strpos($key, '/l'))
			} // for ($i=0; $i < $countKeys; $i++)

			// add user permissions
			for ($i=0; $i < $countKeys; $i++)
			{
				$key = $permissionKeys[$i];	

				if (!isset($joinedPermissions[$key]))
				{
					$joinedPermissions[$key] = 1;
				} // if (!isset($joinedPermissions[$key]))
			} // for ($i=0; $i < $countKeys; $i++)
		} // if ('' != $decodedPermission)

		$permissions = array_keys($joinedPermissions);
		
		return $permissions;
	}

	public function getUserServicePermission($adminLTEUser)
	{
		$permissions = [];
		$joinedPermissions = []; // join group and user permissions
		
		// group permissions
		// add group permissions

		$adminLTEUserGroup = AdminLTEUserGroup::find(
				$adminLTEUser->adminlteusergroup_id);
		
		$decodedPermission = '';

		if ($adminLTEUserGroup != null)
		{
			$decodedPermission = $this->base64Decode(
					$adminLTEUserGroup->service_permission);
		} // if ($adminLTEUserGroup != null)

		if ('' != $decodedPermission)
		{
			$permissionKeys = explode(',', $decodedPermission);
			$countKeys = count($permissionKeys);

			for ($i=0; $i < $countKeys; $i++)
			{ 
				if (!isset($joinedPermissions[$permissionKeys[$i]]))
				{
					$joinedPermissions[$permissionKeys[$i]] = 1;
				} // if (!isset($joinedPermissions[$permissionKeys[$i]]))
			} // for ($i=0; $i < $countKeys; $i++)
		} // if ('' != $decodedPermission)
		
		// user permissions
		// remove group permissions
		$decodedPermission = $this->base64Decode(
				$adminLTEUser->service_permission);

		if ('' != $decodedPermission)
		{
			$permissionKeys = explode(',', $decodedPermission);
			$countKeys = count($permissionKeys);

			for ($i=0; $i < $countKeys; $i++)
			{
				$key = $permissionKeys[$i];

				if (false !== strpos($key, '/l'))
				{
					$group_get_key = str_replace('/l', '/g', $key);
					
					if (isset($joinedPermissions[$group_get_key]))
					{
						unset($joinedPermissions[$group_get_key]);
					} // if (isset($joinedPermissions[$group_get_key]))

					$group_post_key = str_replace('/l', '/p', $key);

					if (isset($joinedPermissions[$group_post_key]))
					{
						unset($joinedPermissions[$group_post_key]);
					} // if (isset($joinedPermissions[$group_post_key]))

					$group_delete_key = str_replace('/l', '/d', $key);

					if (isset($joinedPermissions[$group_delete_key]))
					{
						unset($joinedPermissions[$group_delete_key]);
					} // if (isset($joinedPermissions[$group_delete_key]))
				} // if (false !== strpos($key, '/l'))
			} // for ($i=0; $i < $countKeys; $i++)

			// add user permissions
			for ($i=0; $i < $countKeys; $i++)
			{
				$key = $permissionKeys[$i];	

				if (!isset($joinedPermissions[$key]))
				{
					$joinedPermissions[$key] = 1;
				} // if (!isset($joinedPermissions[$key]))
			} // for ($i=0; $i < $countKeys; $i++)
		} // if ('' != $decodedPermission)

		$permissions = array_keys($joinedPermissions);
		
		return $permissions;
	}

	public function base64Decode($data)
	{
		$formattedData = '';

		if ('' != $data) {
			$formattedData = implode(',', unserialize(base64_decode($data)));
		}

		return $formattedData;
	}

	public function base64Encode($data)
	{
		$arrayData = array();

		if ('' != $data) {
			$arrayData = explode(',', $data);
		}
		
		return base64_encode(serialize($arrayData));
	}

	public function getModelList($exceptions = [])
	{
		if (0 == count($exceptions))
		{
			$exceptions = [
				'AdminLTE',
				'AdminLTELayout',
				'AdminLTEModelDisplayText',
				'AdminLTEUser',
				'AdminLTEUserGroup',
				'AdminLTEUserLayout',
				'AdminLTEVariable',
				'HTMLDB'
			];
		} // if (0 == count($exceptions))
		
		$Models = array();
		$index = 0;

		$path = dirname(__FILE__);
		if (is_dir($path))
		{ 
			$files = scandir($path);

			foreach ($files as $file)
			{ 
				if (($file != ".") && ($file != ".."))
				{
					$current_path = ($path . "/" . $file);

					if (is_dir($current_path))
					{
						continue;
					} // if (is_dir($current_path))

					$file_name = basename($current_path);

					$extension = pathinfo($file_name, PATHINFO_EXTENSION);
					$extension = '.' . $extension;

					$file_name = str_replace($extension, '', $file_name);
					
					if (!in_array($file_name, $exceptions))
					{
						$Models[] = $file_name;
					} // if (!in_array($file_name, $exceptions))
				} // if (($file != ".") && ($file != "..")) {
			} // foreach ($files as $file) {
		} // if (is_dir($path))

		return $Models;
	}

	public function getPageLayout($pageName)
	{

		$Widgets = array();

		$layout = AdminLTELayout::where('deleted', false)
				->where('pagename', $pageName)
				->orderBy('id', 'DESC')
				->first();
		
		if (null == $layout)
		{
			return $Widgets;
		} // if (null == $layout)

		$defaultWidgets = json_decode(
				$layout->widgets,
				(JSON_HEX_QUOT
				| JSON_HEX_TAG
				| JSON_HEX_AMP
				| JSON_HEX_APOS));

		$userWidgetsFormatted = $this->getUserWidgetsFormatted($pageName);

		$countWidgets = count($defaultWidgets);
		$emptyIndex = 0;
		$emptyIndexHistory = array();

		for ($i=0; $i < $countWidgets; $i++) { 
			$defaultWidget = $defaultWidgets[$i];

			$type = $defaultWidget['type'];
			$model = $defaultWidget['model'];

			if ('empty' == $type) {
				$userWidgetIndex = $type.$emptyIndex;
				$emptyIndex++;

				$emptyIndexHistory[] = $userWidgetIndex;
			} else {
				$userWidgetIndex = $type.$model;
			}
			
			if (!isset($userWidgetsFormatted[$userWidgetIndex])) {
				/*if ('empty' != $type) {*/
					$Widgets[] = $defaultWidget;
				/*}*/
			} else {
				/*if ('empty' != $type) {*/
					$Widgets[] = $userWidgetsFormatted[$userWidgetIndex];
				/*}*/
			}
		} // for ($i=0; $i < $countWidgets; $i++) {

		// Add User Empty Widgets
		$keys = array_keys($userWidgetsFormatted);
		$countKeys = count($keys);

		for ($i=0; $i < $countKeys; $i++) { 
			$key = $keys[$i];

			if (false === strpos($key, 'empty'))
			{
				continue;
			}
			
			if (in_array($key, $emptyIndexHistory))
			{
				continue;
			}

			$Widgets[] = $userWidgetsFormatted[$key];
		}

		$Widgets = $this->sortListByKey($Widgets, true, 'order');

		return $Widgets;

	}

	public function sortListByKey($arrList, $sortType, $property) {
		if ('title' == $property) {
			usort($arrList, $this->tr_build_sorter($property));
		} else {
			usort($arrList, $this->build_sorter($property));
		}


		if (!$sortType) {
			$arrList = array_reverse($arrList);
		}

		return $arrList;
	}

	private function build_sorter($key) {
		return function ($a, $b) use ($key) {
			return strnatcmp($a[$key], $b[$key]);
		};
	}

	private function tr_build_sorter($key) {
		return function ($a, $b) use ($key) {
			return $this->tr_strcmp($a[$key], $b[$key]);
		};
	}

	private function tr_strcmp ($a , $b) {
		$lcases = array( 'a' , 'b' , 'c' , 'ç' , 'd' , 'e' , 'f' , 'g' , 'ğ' , 'h' , 'ı' , 'i' , 'j' , 'k' , 'l' , 'm' , 'n' , 'o' , 'ö' , 'p' , 'q' , 'r' , 's' , 'ş' , 't' , 'u' , 'ü' , 'w' , 'v' , 'y' , 'z' );
		$ucases = array ( 'A' , 'B' , 'C' , 'Ç' , 'D' , 'E' , 'F' , 'G' , 'Ğ' , 'H' , 'I' , 'İ' , 'J' , 'K' , 'L' , 'M' , 'N' , 'O' , 'Ö' , 'P' , 'Q' , 'R' , 'S' , 'Ş' , 'T' , 'U' , 'Ü' , 'W' , 'V' , 'Y' , 'Z' );
		$am = mb_strlen ( $a , 'UTF-8' );
		$bm = mb_strlen ( $b , 'UTF-8' );
		$maxlen = $am > $bm ? $bm : $am;
		for ( $ai = 0; $ai < $maxlen; $ai++ ) {
			$aa = mb_substr ( $a , $ai , 1 , 'UTF-8' );
			$ba = mb_substr ( $b , $ai , 1 , 'UTF-8' );
			if ( $aa != $ba ) {
				$apos = in_array ( $aa , $lcases ) ? array_search ( $aa , $lcases ) : array_search ( $aa , $ucases );
				$bpos = in_array ( $ba , $lcases ) ? array_search ( $ba , $lcases ) : array_search ( $ba , $ucases );
				if ( $apos !== $bpos ) {
					return $apos > $bpos ? 1 : -1;
				}
			}
		}
		return 0;
	}

	public function getUserWidgetsFormatted($pageName) {
		$userWidgetsFormatted = array();
		
		$currentUser = $this->getUserData();

		$layout = AdminLTEUserLayout::where('deleted', false)
				->where('adminlteuser_id', $currentUser['id'])
				->where('pagename', $pageName)
				->orderBy('id', 'DESC')
				->first();
		
		if (null == $layout)
		{
			return $userWidgetsFormatted;
		} // if (null == $layout)

		$userwidgets = json_decode(
				$layout->widgets,
				(JSON_HEX_QUOT
				| JSON_HEX_TAG
				| JSON_HEX_AMP
				| JSON_HEX_APOS));

		$countWidgets = count($userwidgets);
		$emptyIndex = 0;

		for ($i=0; $i < $countWidgets; $i++)
		{ 
			$widget = $userwidgets[$i];
			
			$type = $widget['type'];
			$model = $widget['model'];
			$userWidgetIndex = $type.$model;

			if ('empty' == $type)
			{
				$userWidgetIndex = 'empty' . $emptyIndex;
				$emptyIndex++;
			} // if ('empty' == $type)

			if (!isset($userWidgetsFormatted[$userWidgetIndex]))
			{
				$userWidgetsFormatted[$userWidgetIndex] = array();
				$userWidgetsFormatted[$userWidgetIndex]['type'] = $widget['type'];
				$userWidgetsFormatted[$userWidgetIndex]['model'] = $widget['model'];
			} // if (!isset($userWidgetsFormatted[$userWidgetIndex]))

			$userWidgetsFormatted[$userWidgetIndex]['text'] = $widget['text'];
			$userWidgetsFormatted[$userWidgetIndex]['href'] = $widget['href'];
			$userWidgetsFormatted[$userWidgetIndex]['size'] = $widget['size'];
			$userWidgetsFormatted[$userWidgetIndex]['visibility'] = $widget['visibility'];
			$userWidgetsFormatted[$userWidgetIndex]['order'] = $i;
			$userWidgetsFormatted[$userWidgetIndex]['icon'] = $widget['icon'];
			$userWidgetsFormatted[$userWidgetIndex]['iconbackground'] = $widget['iconbackground'];

			$userWidgetsFormatted[$userWidgetIndex]['value'] = 0;
			
			$userWidgetsFormatted[$userWidgetIndex]['limit'] = $widget['limit'];
			$userWidgetsFormatted[$userWidgetIndex]['onlylastrecord'] = $widget['onlylastrecord'];
			$userWidgetsFormatted[$userWidgetIndex]['columns'] = $widget['columns'];
			$userWidgetsFormatted[$userWidgetIndex]['values'] = $widget['values'];
			$userWidgetsFormatted[$userWidgetIndex]['graphtype'] = $widget['graphtype'];
			$userWidgetsFormatted[$userWidgetIndex]['graphperiod'] = $widget['graphperiod'];

			$userWidgetIndex++;
		} // for ($i=0; $i < $countWidgets; $i++) { 

		return $userWidgetsFormatted;
	}

	public function checkUserEditPermission($token, $userData) {
		if (1 == $userData['id'])
		{
			return true;
		} // if (1 == $userData['id'])
		
		$permissions = $userData['menu_permission'];
		$permission_token = $token . '/e';
		if (!in_array($permission_token, $permissions))
		{
			return false;
		} // if (!in_array($permission_token, $permissions))

		return true;
	}

	public function checkUserViewPermission($token, $userData) {
		if (1 == $userData['id'])
		{
			return true;
		} // if (1 == $userData['id'])
		
		$permissions = $userData['menu_permission'];
		$permission_token = $token . '/v';
		if (!in_array($permission_token, $permissions))
		{
			return false;
		} // if (!in_array($permission_token, $permissions))

		return true;
	}

	public function updateDotEnv($key, $newValue, $delimiter='')
	{
		$path = base_path('.env');
		// get old value from current env
		$oldValue = env($key);

		// was there any change?
		if ($oldValue === $newValue)
		{
			return;
		} // if ($oldValue === $newValue)

		if (file_exists($path))
		{
			file_put_contents(
				$path, str_replace(
					$key.'='.$delimiter.$oldValue.$delimiter, 
					$key.'='.$delimiter.$newValue.$delimiter, 
					file_get_contents($path)
				)
			);
		} // if (file_exists($path))
	}

	/* {{snippet:end_methods}} */
}

/* {{snippet:end_class}} */