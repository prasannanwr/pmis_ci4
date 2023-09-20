<?php
$routes->group("bridge_design_standard", ["namespace" => "App\Modules\bridge_design_standard\Controllers"], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'Bridge_Design_Standard::index', ['filter' => 'auth']);
	$routes->get('index', 'Bridge_Design_Standard::index', ['filter' => 'auth']);
	$routes->get('lists', 'Bridge_Design_Standard::lists', ['filter' => 'auth']);
	$routes->get('create', 'Bridge_Design_Standard::create', ['filter' => 'auth']);
	$routes->get('create/(:any)', 'Bridge_Design_Standard::create/$1', ['filter' => 'auth']);
	
	$routes->post('create', 'Bridge_Design_Standard::create', ['filter' => 'auth']);
	$routes->post('create/(:any)', 'Bridge_Design_Standard::create/$1', ['filter' => 'auth']);
});