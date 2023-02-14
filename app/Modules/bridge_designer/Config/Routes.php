<?php
$routes->group("bridge_designer", ["namespace" => "App\Modules\bridge_designer\Controllers"], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'bridge_designer::index', ['filter' => 'auth']);
	$routes->get('index', 'bridge_designer::index', ['filter' => 'auth']);
	$routes->get('lists', 'bridge_designer::lists', ['filter' => 'auth']);
	$routes->get('create', 'bridge_designer::create', ['filter' => 'auth']);
	$routes->get('create/(:any)', 'bridge_designer::create/$1', ['filter' => 'auth']);
	
	$routes->post('create', 'bridge_designer::create', ['filter' => 'auth']);
	$routes->post('create/(:any)', 'bridge_designer::create/$1', ['filter' => 'auth']);
});