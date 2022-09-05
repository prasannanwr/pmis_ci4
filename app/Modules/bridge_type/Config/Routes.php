<?php
$routes->group("bridge_type", ["namespace" => "App\Modules\bridge_type\Controllers"], function ($routes) {

	$routes->get('/', 'bridge_type::index', ['filter' => 'auth']);
	$routes->get('index', 'bridge_type::index', ['filter' => 'auth']);
	//$routes->post('form/(:any)', 'Bridge::form/$1', ['filter' => 'auth']);
});