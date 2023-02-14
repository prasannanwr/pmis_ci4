<?php
$routes->group("construction", ["namespace" => "App\Modules\construction\Controllers"], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'construction::index', ['filter' => 'auth']);
	$routes->get('index', 'construction::index', ['filter' => 'auth']);
	$routes->get('lists', 'construction::lists', ['filter' => 'auth']);
	$routes->get('create', 'construction::create', ['filter' => 'auth']);
	$routes->get('create/(:any)', 'construction::create/$1', ['filter' => 'auth']);
	
	$routes->post('create', 'construction::create', ['filter' => 'auth']);
	$routes->post('create/(:any)', 'construction::create/$1', ['filter' => 'auth']);
});