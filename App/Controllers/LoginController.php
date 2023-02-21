<?php

namespace App\Controllers;

use App\Config\Main;
use \Firebase\JWT\JWT;
use App\Helpers\Request;
use App\Models\UserModel;
use App\Helpers\Validate;
use App\Helpers\Response;
use Config;

class LoginController
{
	public static function login()
	{
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'email' => array('required' => true),
			'password' => array('required' => true)
		));

		if (!$validation->successful()) {
			return Response::message(["message" => "Validation Error", 'errors' => $validation->errors(), 400]);
		}

		//collecting the inputs
		$email = Request::input('email');
		$password = Request::input('password');

		$model = new UserModel();
		$login = $model->authenticate($email, $password);

		if (!$login) {
			return Response::message(["message" => "Wrong credentials. Try again", 401]);
		}

		//passing the successful credientials to JWT for authentification
		$config = new Config();
		$env = json_decode(json_encode($config->env), true);
		$issuer_claim = $env["hostname"]; // this can be the servername
		$issuedat_claim = time(); // issued at
		$expire_claim = $issuedat_claim + (60 * 6000); // expire time in minutes

		$token = array(
			"iat" => $issuedat_claim,
			"exp" => $expire_claim,
			"iss" => $issuer_claim,
			"data" => array(
				"id" => $model->data['id'],
				"firstname" => $model->data['firstname'],
				"lastname" => $model->data['lastname'],
				"email" => $model->data['email'],
			)
		);

		$jwt = JWT::encode($token, $model->data['secret_key']);

		return Response::message([
			"message" => "Login successful",
			"jwt" => $jwt
		]);
	}
}
