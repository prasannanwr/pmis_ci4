<?php
$routes->group("bridge", ["namespace" => "App\Modules\bridge\Controllers"], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'bridge::index', ['filter' => 'auth']);
	$routes->get('index', 'Bridge::index', ['filter' => 'auth']);
	$routes->get('lists', 'Bridge::lists', ['filter' => 'auth']);
	$routes->get('ajaxData', 'Bridge::ajaxData', ['filter' => 'auth']);
	$routes->get('form', 'Bridge::form', ['filter' => 'auth']);
	$routes->get('form/(:any)', 'Bridge::form/$1', ['filter' => 'auth']);
	
	$routes->post('form', 'Bridge::form', ['filter' => 'auth']);
	$routes->post('form/(:any)', 'Bridge::form/$1', ['filter' => 'auth']);

	$routes->post('saveCostRef', 'Bridge::saveCostRef', ['filter' => 'auth']);
});