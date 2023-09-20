<?php
$routes->group("province", ["namespace" => "App\Modules\province\Controllers"], function ($routes) {

	//$routes->get("/", "province::index");
	$routes->get('/', 'province::index', ['filter' => 'auth']);
	$routes->get('index', 'province::index', ['filter' => 'auth']);

	$routes->match(['get','post'],'create', 'province::create/', ['filter' => 'auth']);
    $routes->match(['get','post'],'create/(:any)', 'province::create/$1', ['filter' => 'auth']);

    $routes->match(['get','post'],'delete/(:any)', 'province::delete/$1', ['filter' => 'auth']);

});