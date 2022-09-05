<?php
$routes->group("basic_supporting_agencies", ["namespace" => "App\Modules\basic_supporting_agencies\Controllers"], function ($routes) {

	//$routes->get("/", "basic_supporting_agencies::index");
	$routes->get('/', 'basic_supporting_agencies::index', ['filter' => 'auth']);
	$routes->get('index', 'basic_supporting_agencies::index', ['filter' => 'auth']);

	$routes->match(['get','post'],'create', 'basic_supporting_agencies::create/', ['filter' => 'auth']);
    $routes->match(['get','post'],'create/(:any)', 'basic_supporting_agencies::create/$1', ['filter' => 'auth']);

    $routes->match(['get','post'],'delete/(:any)', 'basic_supporting_agencies::delete/$1', ['filter' => 'auth']);

});