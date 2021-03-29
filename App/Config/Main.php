<?php
namespace App\Config;

class Main{
	
	public function __construct()
	{	
		header("Access-Control-Allow-Origin: * ");
		header("Content-Type: application/json; charset=UTF-8");
		header("Access-Control-Max-Age: 3600");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
		
		// requiring autoload for jwt
		require __DIR__.'/../../vendor/autoload.php';
		
		// show error reporting
		error_reporting(E_ALL);
		 
		// set your default time-zone
		date_default_timezone_set('Africa/Lagos');
		 
		// variables used for jwt

	}	
}
