<?php

$routes->group("fiscal_year", ["namespace" => 'App\Modules\fiscal_year\Controllers'], function ($routes) {

	// welcome page - URL: /student
	$routes->get("/", "fiscal_year::index", ['filter' => 'auth']);
	
	// $routes->match(['get','post'],'create/(:any)/(:any)/(:any)', 'Fiscal_data::create/$1/$2/$3', ['filter' => 'auth']);
	$routes->match(['get','post'],'create', 'Fiscal_year::create', ['filter' => 'auth']);
	$routes->match(['get','post'],'create/(:any)', 'Fiscal_year::create/$1', ['filter' => 'auth']);

	$routes->post('delete/(:num)', 'Fiscal_year::delete/$1', ['filter' => 'auth']);

});