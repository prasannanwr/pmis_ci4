<?php
$routes->group("bridge_type", ["namespace" => "App\Modules\bridge_type\Controllers"], function ($routes) {

	$routes->get('/', 'bridge_type::index', ['filter' => 'auth']);
	$routes->get('index', 'bridge_type::index', ['filter' => 'auth']);
	//$routes->post('form/(:any)', 'Bridge::form/$1', ['filter' => 'auth']);
	$routes->get('create', 'bridge_type::create', ['filter' => 'auth']);
	$routes->get('create/(:any)', 'bridge_type::create/$1', ['filter' => 'auth']);
	$routes->post('create', 'bridge_type::create', ['filter' => 'auth']);
	$routes->post('create/(:any)', 'bridge_type::create/$1', ['filter' => 'auth']);
	$routes->match(['get','post'],'delete/(:any)', 'bridge_type::delete/$1', ['filter' => 'auth']);
});