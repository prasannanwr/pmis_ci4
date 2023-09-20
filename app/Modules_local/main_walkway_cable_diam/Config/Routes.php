<?php
$routes->group("main_walkway_cable_diam", ["namespace" => "App\Modules\main_walkway_cable_diam\Controllers"], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'main_walkway_cable_diam::index', ['filter' => 'auth']);
	$routes->get('index', 'main_walkway_cable_diam::index', ['filter' => 'auth']);
	$routes->get('lists', 'main_walkway_cable_diam::lists', ['filter' => 'auth']);
	$routes->get('create', 'main_walkway_cable_diam::create', ['filter' => 'auth']);
	$routes->get('create/(:any)', 'main_walkway_cable_diam::create/$1', ['filter' => 'auth']);
	
	$routes->post('create', 'main_walkway_cable_diam::create', ['filter' => 'auth']);
	$routes->post('create/(:any)', 'main_walkway_cable_diam::create/$1', ['filter' => 'auth']);
});