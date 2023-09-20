<?php
$routes->group("handrail_cable", ["namespace" => "App\Modules\handrail_cable\Controllers"], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'handrail_cable::index', ['filter' => 'auth']);
	$routes->get('index', 'handrail_cable::index', ['filter' => 'auth']);
	$routes->get('lists', 'handrail_cable::lists', ['filter' => 'auth']);
	$routes->get('create', 'handrail_cable::create', ['filter' => 'auth']);
	$routes->get('create/(:any)', 'handrail_cable::create/$1', ['filter' => 'auth']);
	
	$routes->post('create', 'handrail_cable::create', ['filter' => 'auth']);
	$routes->post('create/(:any)', 'handrail_cable::create/$1', ['filter' => 'auth']);
});