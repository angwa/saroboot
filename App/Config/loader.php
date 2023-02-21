<?php

spl_autoload_register();
$login = new App\Controllers\LoginController();
$model = new App\Models\UserModel();
$database = new App\Models\Database();
$route = new App\Config\Route();
$main =  new App\Config\Main();
$register =  new App\Controllers\RegisterController();
$profile =  new App\Controllers\ProfileController();
$validation =  new App\Helpers\Validate();
$input =  new App\Helpers\Request();
$hash =  new App\Helpers\Hash();
$response =  new App\Helpers\Response();
$header =  new App\Helpers\Header();
$auth =  new App\Middleware\Auth();
$logout =  new App\Controllers\LogoutController();
$config =  new Config();
