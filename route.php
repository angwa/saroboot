<?php
require_once __DIR__ . '/App/Config/loader.php';

use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Controllers\ProfileController;
use App\Controllers\LogoutController;
use App\Config\Route;

define('BASEPATH','/api');

//adding application routes
Route::add('/login', fn() =>LoginController::login(),'post');

Route::add('/register', fn() =>RegisterController::store(),'post');
Route::add('/logout', fn() =>LogoutController::logout());

//testing authorization (Not part of task. Just want to test if its working)
Route::add('/profile', fn() =>ProfileController::index());

Route::run(BASEPATH);