<?php
$routes->group("cost_components", ["namespace" => "App\Modules\cost_components\Controllers"], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'cost_components::index', ['filter' => 'auth']);
	$routes->get('index', 'cost_components::index', ['filter' => 'auth']);
	$routes->get('lists', 'cost_components::lists', ['filter' => 'auth']);
	$routes->get('create', 'cost_components::create', ['filter' => 'auth']);
	$routes->get('create/(:any)', 'cost_components::create/$1', ['filter' => 'auth']);
	
	$routes->post('create', 'cost_components::create', ['filter' => 'auth']);
	$routes->post('create/(:any)', 'cost_components::create/$1', ['filter' => 'auth']);
});