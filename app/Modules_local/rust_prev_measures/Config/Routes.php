<?php
$routes->group("rust_prev_measures", ["namespace" => 'App\Modules\rust_prev_measures\Controllers'], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'rust_prev_measures::index', ['filter' => 'auth']);
	$routes->get('index', 'rust_prev_measures::index', ['filter' => 'auth']);
	$routes->get('lists', 'rust_prev_measures::lists', ['filter' => 'auth']);
	$routes->get('create', 'rust_prev_measures::create', ['filter' => 'auth']);
	$routes->get('create/(:any)', 'rust_prev_measures::create/$1', ['filter' => 'auth']);
	
	$routes->post('create', 'rust_prev_measures::create', ['filter' => 'auth']);
	$routes->post('create/(:any)', 'rust_prev_measures::create/$1', ['filter' => 'auth']);
});