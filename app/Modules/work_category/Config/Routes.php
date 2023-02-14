<?php
$routes->group("work_category", ["namespace" => "App\Modules\work_category\Controllers"], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'work_category::index', ['filter' => 'auth']);
	$routes->get('index', 'work_category::index', ['filter' => 'auth']);
	$routes->get('lists', 'work_category::lists', ['filter' => 'auth']);
	$routes->get('create', 'work_category::create', ['filter' => 'auth']);
	$routes->get('create/(:any)', 'work_category::create/$1', ['filter' => 'auth']);
	
	$routes->post('create', 'work_category::create', ['filter' => 'auth']);
	$routes->post('create/(:any)', 'work_category::create/$1', ['filter' => 'auth']);
});