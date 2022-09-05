<?php
$routes->group("cost_components", ["namespace" => "App\Modules\cost_components\Controllers"], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'cost_components::index', ['filter' => 'auth']);
	$routes->get('index', 'cost_components::index', ['filter' => 'auth']);
	$routes->get('lists', 'cost_components::lists', ['filter' => 'auth']);
	$routes->get('form', 'cost_components::form', ['filter' => 'auth']);
	$routes->get('form/(:any)', 'cost_components::form/$1', ['filter' => 'auth']);
	
	$routes->post('form', 'cost_components::form', ['filter' => 'auth']);
	$routes->post('form/(:any)', 'cost_components::form/$1', ['filter' => 'auth']);
});