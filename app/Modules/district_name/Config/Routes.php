<?php
$routes->group("district_name", ["namespace" => "App\Modules\district_name\Controllers"], function ($routes) {

	$routes->get('/', 'district_name::index', ['filter' => 'auth']);
	$routes->get('index', 'district_name::index', ['filter' => 'auth']);
	//$routes->post('form/(:any)', 'Bridge::form/$1', ['filter' => 'auth']);
	$routes->get('create', 'district_name::create', ['filter' => 'auth']);
	$routes->get('create/(:any)', 'district_name::create/$1', ['filter' => 'auth']);
	$routes->post('create', 'district_name::create', ['filter' => 'auth']);
	$routes->post('create/(:any)', 'district_name::create/$1', ['filter' => 'auth']);
	
	$routes->get('ajaxData', 'district_name::ajaxData', ['filter' => 'auth']);
});