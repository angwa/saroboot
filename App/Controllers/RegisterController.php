<?php
namespace App\Controllers;
use App\Config\Main;
use App\Helpers\Hash;
use App\Helpers\Request;
use App\Models\UserModel;
use App\Helpers\Validate;
use App\Helpers\Response;

class RegisterController
{
	public static function store()
	{

		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'firstname' => array('required' => true),
			'lastname' => array('required' => true),
			'email' => array('required' => true, 'unique'=>true, 'valid_email'=>true),
			'password' => array('required' => true, 'min'=>6)
		));

		//check if validation is not successful and return back
		if (!$validation->successful()) {
			
			return Response::message(["message"=>"Validation Error", 'errors'=>$validation->errors()]);
		}

		$model = new UserModel();
		$user = $model->create('users', array(
		    'firstname' => Request::input('firstname'),
		    'lastname' => Request::input('lastname'),
		    'email' => Request::input('email'),
		    'secret_key' => Hash::secret(),
		    'password' => Hash::make(Request::input('password')),
		));

		if(!$user){
			header('HTTP/1.0 400 Bad Request');
		 	return Response::message(["message" => "Unable to create account. Try again",'status']);
		 }

		return Response::message(["message" => "New account have been created succesfully", 
		'data'=>$model->data]);




	}
}