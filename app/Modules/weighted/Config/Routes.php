<?php
$routes->group("weighted", ["namespace" => "App\Modules\weighted\Controllers"], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'weighted::index', ['filter' => 'auth']);
	$routes->get('index', 'weighted::index', ['filter' => 'auth']);
	$routes->get('lists', 'weighted::lists', ['filter' => 'auth']);
	$routes->get('create', 'weighted::create', ['filter' => 'auth']);
	$routes->get('create/(:any)', 'weighted::create/$1', ['filter' => 'auth']);
	
	$routes->post('create', 'weighted::create', ['filter' => 'auth']);
	$routes->post('create/(:any)', 'weighted::create/$1', ['filter' => 'auth']);
});