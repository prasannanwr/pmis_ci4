<?php
$routes->group("palika", ["namespace" => "App\Modules\palika\Controllers"], function ($routes) {

	$routes->get('/', "palika::index", ['filter' => 'auth']);
	$routes->get('index', "palika::index", ['filter' => 'auth']);
	//$routes->post('form/(:any)', 'Bridge::form/$1', ['filter' => 'auth']);
	$routes->get('create', 'palika::create', ['filter' => 'auth']);
	$routes->get('create/(:any)', 'palika::create/$1', ['filter' => 'auth']);
	$routes->post('create', 'palika::create', ['filter' => 'auth']);
	$routes->post('create/(:any)', 'palika::create/$1', ['filter' => 'auth']);
	$routes->get('ajaxData', "palika::ajaxData", ['filter' => 'auth']);

	$routes->match(['get','post'],'delete/(:any)', 'palika::delete/$1', ['filter' => 'auth']);
});