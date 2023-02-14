<?php
$routes->group("walkway_width", ["namespace" => "App\Modules\walkway_width\Controllers"], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'walkway_width::index', ['filter' => 'auth']);
	$routes->get('index', 'walkway_width::index', ['filter' => 'auth']);
	$routes->get('lists', 'walkway_width::lists', ['filter' => 'auth']);
	$routes->get('create', 'walkway_width::create', ['filter' => 'auth']);
	$routes->get('create/(:any)', 'walkway_width::create/$1', ['filter' => 'auth']);
	
	$routes->post('create', 'walkway_width::create', ['filter' => 'auth']);
	$routes->post('create/(:any)', 'walkway_width::create/$1', ['filter' => 'auth']);
});