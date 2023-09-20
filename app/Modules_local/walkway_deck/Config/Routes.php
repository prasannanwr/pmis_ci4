<?php
$routes->group("walkway_deck", ["namespace" => "App\Modules\walkway_deck\Controllers"], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'walkway_deck::index', ['filter' => 'auth']);
	$routes->get('index', 'walkway_deck::index', ['filter' => 'auth']);
	$routes->get('lists', 'walkway_deck::lists', ['filter' => 'auth']);
	$routes->get('create', 'walkway_deck::create', ['filter' => 'auth']);
	$routes->get('create/(:any)', 'walkway_deck::create/$1', ['filter' => 'auth']);
	
	$routes->post('create', 'walkway_deck::create', ['filter' => 'auth']);
	$routes->post('create/(:any)', 'walkway_deck::create/$1', ['filter' => 'auth']);
});