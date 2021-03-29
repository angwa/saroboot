<?php
namespace App\Helpers;

class Header{
	/** 
	 * Get header Authorization
	 * */
	public static function getAuthorizationHeader(){
	        $headers = null;
	        if (isset($_SERVER['Authorization'])) {
	            $headers = trim($_SERVER["Authorization"]);
	        }
	        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
	            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
	        } elseif (function_exists('apache_request_headers')) {
	            $requestHeaders = apache_request_headers();
	            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
	            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
	            //print_r($requestHeaders);
	            if (isset($requestHeaders['Authorization'])) {
	                $headers = trim($requestHeaders['Authorization']);
	            }
	        }
	        return $headers;
	    }
	/**
	 * get access token from header
	 * */
	public static function getBearerToken() {
	    $headers = self::getAuthorizationHeader();
	    // HEADER: Get the access token from the header
	    if (!empty($headers)) {
	        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
	            return $matches[1];
	        }
	    }
	    return null;
	}

	public static function convert_utf8($dat)
	{
		//this function converts recursively
		if (is_string($dat)) {
	         return utf8_encode($dat);
	      } elseif (is_array($dat)) {
	         $ret = [];
	         foreach ($dat as $i => $d) $ret[ $i ] = self::convert_utf8($d);

	         return $ret;
	      } elseif (is_object($dat)) {
	         foreach ($dat as $i => $d) $dat->$i = self::convert_utf8($d);

	         return $dat;
	      } else {
	         return $dat;
	      }

	}
   

   
		
}