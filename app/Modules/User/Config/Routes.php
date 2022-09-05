<?php

$routes->group("user", ["namespace" => "App\Modules\User\Controllers"], function ($routes) {

	// welcome page - URL: /student
	$routes->get("/", "User::list", ['filter' => 'auth']);
  
	//$routes->get("/user/login", "User::login");
	$routes->match(['get', 'post'], "list", "User::list", ['filter' => 'auth']);
	$routes->match(['get', 'post'], 'register', 'User::register', ['filter' => 'auth']);
	$routes->match(['get', 'post'], 'register/(:any)', 'User::register/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'login', 'User::login', ['filter' => 'noauth']);
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('logout', 'User::logout', ['filter' => 'auth']);
$routes->get('profile', 'User::profile', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'change_password', 'User::change_password', ['filter' => 'auth']);

});