<?php
$routes->group("construction", ["namespace" => "App\Modules\construction\Controllers"], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'construction::index', ['filter' => 'auth']);
	$routes->get('index', 'construction::index', ['filter' => 'auth']);
	$routes->get('lists', 'construction::lists', ['filter' => 'auth']);
	$routes->get('form', 'construction::form', ['filter' => 'auth']);
	$routes->get('form/(:any)', 'construction::form/$1', ['filter' => 'auth']);
	
	$routes->post('form', 'construction::form', ['filter' => 'auth']);
	$routes->post('form/(:any)', 'construction::form/$1', ['filter' => 'auth']);
});