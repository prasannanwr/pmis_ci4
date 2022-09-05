<?php

$routes->group("regional_office", ["namespace" => 'App\Modules\regional_office\Controllers'], function ($routes) {

	// welcome page - URL: /student
	$routes->get("/", "regional_office::index", ['filter' => 'auth']);
    $routes->get("index", "regional_office::index", ['filter' => 'auth']);
	
	$routes->match(['get','post'],'create', 'regional_office::create', ['filter' => 'auth']);
	$routes->match(['get','post'],'create/(:any)', 'regional_office::create/$1', ['filter' => 'auth']);
	$routes->get('delete/(:num)', 'regional_office::delete/$1', ['filter' => 'auth']);

});