<?php
$routes->group("fiscal_data", ["namespace" => 'App\Modules\fiscal_data\Controllers'], function ($routes) {

	
	$routes->get('index', 'Fiscal_data::index', ['filter' => 'auth']);
	$routes->match(['get','post'],'create/(:any)/(:any)/(:any)', 'Fiscal_data::create/$1/$2/$3', ['filter' => 'auth']);
	$routes->match(['get','post'],'create/(:any)', 'Fiscal_data::create/$1', ['filter' => 'auth']);
});
