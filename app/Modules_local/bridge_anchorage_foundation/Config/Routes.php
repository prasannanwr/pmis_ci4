<?php
$routes->group("bridge_design_standard", ["namespace" => "App\Modules\bridge_design_standard\Controllers"], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'Bridge_Design_Standard::index', ['filter' => 'auth']);
	$routes->get('index', 'Bridge_Design_Standard::index', ['filter' => 'auth']);
	$routes->get('lists', 'Bridge_Design_Standard::lists', ['filter' => 'auth']);
	$routes->get('form', 'Bridge_Design_Standard::form', ['filter' => 'auth']);
	$routes->get('form/(:any)', 'Bridge_Design_Standard::form/$1', ['filter' => 'auth']);
	
	$routes->post('form', 'Bridge_Design_Standard::form', ['filter' => 'auth']);
	$routes->post('form/(:any)', 'Bridge_Design_Standard::form/$1', ['filter' => 'auth']);
});