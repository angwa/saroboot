<?php
namespace App\Controllers;
use App\Config\Main;
use App\Helpers\Response;
use App\Middleware\Auth;

class ProfileController extends Auth
{
	public static function index()
	{
		//making sure user is authenticated before using the method
		if(!self::authenticate()){
			return Response::message(["message"=>self::$status]);
		}

		//You can get details and perform actions an authenticated user can do
		$token = self::$data; // Details of the authenticated user from token

		//for example, first name can simply be gotten below
		$firstname = $token["data"]["firstname"];

		//email can be gotten 
		$email = $token["data"]["email"];

		//id can be gotten 
		$id = $token["data"]["id"]; //This is the primary id, you can use

		/**
		 * You can perform operations and return data  and return data instead of returning just authenticated data
		 */

		return Response::message(["message"=>"User is authenticated", "data"=>$token]);
	}

}