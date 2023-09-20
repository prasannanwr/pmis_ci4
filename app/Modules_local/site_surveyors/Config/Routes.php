<?php
$routes->group("site_surveyors", ["namespace" => 'App\Modules\site_surveyors\Controllers'], function ($routes) {

	//$routes->get("/", "bridge::index");
	$routes->get('/', 'site_surveyors::index', ['filter' => 'auth']);
	$routes->get('index', 'site_surveyors::index', ['filter' => 'auth']);
	$routes->get('lists', 'site_surveyors::lists', ['filter' => 'auth']);
	$routes->get('create', 'site_surveyors::create', ['filter' => 'auth']);
	$routes->get('create/(:any)', 'site_surveyors::create/$1', ['filter' => 'auth']);
	
	$routes->post('create', 'site_surveyors::create', ['filter' => 'auth']);
	$routes->post('create/(:any)', 'site_surveyors::create/$1', ['filter' => 'auth']);
});