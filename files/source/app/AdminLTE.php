<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use App\AdminLTEUser;

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
			'image' => 'img/default_user_image.jpg'
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
				'image' => 'img/default_user_image.jpg'
			];

            $adminLTEUserGroup = \App\AdminLTEUserGroup::find(
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

		$adminLTEUserGroup = \App\AdminLTEUserGroup::find(
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

		$adminLTEUserGroup = \App\AdminLTEUserGroup::find(
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

	/* {{snippet:end_methods}} */
}

/* {{snippet:end_class}} */