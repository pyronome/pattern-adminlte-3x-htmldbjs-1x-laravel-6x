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

	public function validateEmailAddress($email) {

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

	public function getUserVariables()
	{
        $adminLTEUser = auth()->guard('adminlteuser')->user();

        $variables = [
            'userName' => ($adminLTEUser->username != '' ? $adminLTEUser->username : $adminLTEUser->email),
            'userImageURL' => ''
        ];

		return $variables;
	}

	public function getAdminLTEFolder() {
        $adminLTEFolder = getenv('ADMINLTE_FOLDER');

        if ($adminLTEFolder === false
				|| ('' == $adminLTEFolder))
        {
            $adminLTEFolder = 'adminlte';
        } // if ($adminLTEFolder === false) {

		$adminLTEFolder = rtrim($adminLTEFolder, '/') . '/';

		return $adminLTEFolder; 
	}

	public function getSideMenu($forceDefault = false) {

		if (!$forceDefault
				&& Storage::disk('local')->exists('adminlte_menu.json'))
		{
			$menuJSON = Storage::disk('local')->get('adminlte_menu.json');
			return json_decode($menuJSON, true);
		}
		else
		{
			return config('adminlte_menu');
		} // if (!$forceDefault

	}

	/* {{snippet:end_methods}} */
}

/* {{snippet:end_class}} */