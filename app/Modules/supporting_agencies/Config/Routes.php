<?php
$routes->group("supporting_agencies", ["namespace" => "App\Modules\supporting_agencies\Controllers"], function ($routes) {

	//$routes->get("/", "supporting_agencies::index");
	$routes->get('/', 'supporting_agencies::index', ['filter' => 'auth']);
	$routes->get('index', 'supporting_agencies::index', ['filter' => 'auth']);

	$routes->match(['get','post'],'create', 'supporting_agencies::create/', ['filter' => 'auth']);
    $routes->match(['get','post'],'create/(:any)', 'supporting_agencies::create/$1', ['filter' => 'auth']);

    $routes->match(['get','post'],'delete/(:any)', 'supporting_agencies::delete/$1', ['filter' => 'auth']);

});