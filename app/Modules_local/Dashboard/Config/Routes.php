<?php

$routes->group("dashboard", ["namespace" => "App\Modules\Dashboard\Controllers"], function ($routes) {

	// welcome page - URL: /student
	$routes->get('/', 'Dashboard::index', ['filter' => 'auth']);
});