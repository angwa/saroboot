<?php
namespace App\Middleware;
use \Firebase\JWT\JWT;
use App\Helpers\Hash;
use App\Helpers\Header;
use App\Models\UserModel;
use Config;

class Auth
{
	public static $status;
	public static $data;

	public static function authenticate()
	{
		if (Header::getAuthorizationHeader() == null) {
		    //header('HTTP/1.0 400 Bad Request');
		    self::$status = "No authorization header sent";
		    return false;
		}
	
		$bearer = Header::getBearerToken();
	
		$jwt = str_replace("Bearer ", "", $bearer);

		$unChecked = @json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $jwt)[1]))));
		$toArray = json_decode(json_encode($unChecked), true);

		//getting id of user from payload to compare key in database

		if(empty($toArray["data"]["id"])){
			header('HTTP/1.0 401 Unathorized access');
		    self::$status = "Unauthorized access";
		    return false;
		}

		$userId = $toArray["data"]["id"];

		$userModel = new UserModel();
		$secretKey  = "";
		$loggedKey = $userModel->checkKey($userId);

		if($loggedKey){
			$secretKey = $loggedKey;
		}

		try{
			$userId = $toArray["data"]["id"];

			$userModel = new UserModel();
			$secretKey  = "";
			$loggedKey = $userModel->checkKey($userId);

			if($loggedKey){
				$secretKey = $loggedKey;
			}
			$token = JWT::decode($bearer, $secretKey, array('HS256'));
			$now =  time();
			
			$config = new Config();
			$env = $env = json_decode(json_encode($config->env),true); 
			$serverName = $env["hostname"];
			if ($token->iss !== $serverName &&
			    $token->exp < $now)
			{
			   header('HTTP/1.1 401 Unauthorized');
			    self::$status = "Unauthorized access";
		    	return false;
			}
			self::$data = json_decode(json_encode($token), true);
			return true;
		}
		catch(\Exception $e)
		{
			//header('HTTP/1.0 401 Unauthorized');
			self::$status= "Token does not exist on the server.";
		    return false;
		}
		

	}


}