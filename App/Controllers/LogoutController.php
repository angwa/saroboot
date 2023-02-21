<?php

namespace App\Controllers;

use App\Config\Main;
use App\Helpers\Response;
use App\Middleware\Auth;
use App\Models\UserModel;

/**
 * The logout method first check if there is a header sent
 * This we achieved by extending the Auth class from middleware
 */
class LogoutController extends Auth
{
	public static function logout()
	{
		//Making sure there is an authenticated user before attempting to logout
		if (!self::authenticate()) {
			return Response::message(["message" => self::$status]);
		}

		//getting the id of the current logged in user

		$token = self::$data;
		$id = $token["data"]["id"];

		$logout = new UserModel();

		if ($logout->changeKey($id)) {
			return Response::message(["message" => "User has been logged out succesfully."]);
		}
	}
}
