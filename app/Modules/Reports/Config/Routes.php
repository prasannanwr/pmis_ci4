<?php
$routes->group("reports", ["namespace" => "App\Modules\Reports\Controllers"], function ($routes) {

	// welcome page - URL: /student
	$routes->get("/", "Reports::index");

	//$routes->get("/user/login", "User::login");

	$routes->get('index', 'Reports::index', ['filter' => 'auth']);

	$routes->get('Gen_Overall_FYWise', 'Reports::Gen_Overall_FYWise', ['filter' => 'auth']);
	$routes->get('Gen_Overall_FYWise/(:any)', 'Reports::Gen_Overall_FYWise/$1', ['filter' => 'auth']);

	//$routes->post('Gen_Overall_FYWise_report', 'Reports::Gen_Overall_FYWise_report', ['filter' => 'auth']);

	$routes->get('Gen_Overall_DateWise/(:any)', 'Reports::Gen_Overall_DateWise/$1', ['filter' => 'auth']);
	$routes->get('Gen_Overall_DateWise', 'Reports::Gen_Overall_DateWise', ['filter' => 'auth']);

	$routes->get('Gen_Dev_FYWise', 'Reports::Gen_Dev_FYWise', ['filter' => 'auth']);
	$routes->get('Gen_Dev_FYWise/(:any)', 'Reports::Gen_Dev_FYWise/$1', ['filter' => 'auth']);

	$routes->get('Gen_Dev_DateWise', 'Reports::Gen_Dev_DateWise', ['filter' => 'auth']);
	$routes->get('Gen_Dev_DateWise/(:any)', 'Reports::Gen_Dev_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Gen_Munc_FYWise', 'Reports::Gen_Munc_FYWise', ['filter' => 'auth']);
	$routes->get('Gen_Munc_FYWise/(:any)', 'Reports::Gen_Munc_FYWise/$1', ['filter' => 'auth']);

	$routes->get('Gen_Munc_DateWise', 'Reports::Gen_Munc_DateWise', ['filter' => 'auth']);
	$routes->get('Gen_Munc_DateWise/(:any)', 'Reports::Gen_Munc_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Act_Overall_FYWise', 'Reports::Act_Overall_FYWise', ['filter' => 'auth']);
	$routes->get('Act_Overall_FYWise/(:any)', 'Reports::Act_Overall_FYWise/$1', ['filter' => 'auth']);

	$routes->get('Act_Overall_DateWise', 'Reports::Act_Overall_DateWise', ['filter' => 'auth']);
	$routes->get('Act_Overall_DateWise/(:any)', 'Reports::Act_Overall_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Act_Dist_FYWise', 'Reports::Act_Dist_FYWise', ['filter' => 'auth']);
	$routes->get('Act_Dist_FYWise/(:any)', 'Reports::Act_Dist_FYWise/$1', ['filter' => 'auth']);

	$routes->get('Act_Dist_DateWise', 'Reports::Act_Dist_DateWise', ['filter' => 'auth']);
	$routes->get('Act_Dist_DateWise/(:any)', 'Reports::Act_Dist_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Act_Dev_FYWise', 'Reports::Act_Dev_FYWise', ['filter' => 'auth']);
	$routes->get('Act_Dev_FYWise/(:any)', 'Reports::Act_Dev_FYWise/$1', ['filter' => 'auth']);

	$routes->get('Act_Dev_DateWise', 'Reports::Act_Dev_DateWise', ['filter' => 'auth']);
	$routes->get('Act_Dev_DateWise/(:any)', 'Reports::Act_Dev_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Act_TBSS_FYWise', 'Reports::Act_TBSS_FYWise', ['filter' => 'auth']);
	$routes->get('Act_TBSS_FYWise/(:any)', 'Reports::Act_TBSS_FYWise/$1', ['filter' => 'auth']);

	$routes->get('Act_TBSS_DateWise', 'Reports::Act_TBSS_DateWise', ['filter' => 'auth']);
	$routes->get('Act_TBSS_DateWise/(:any)', 'Reports::Act_TBSS_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Act_Dev_DateWise', 'Reports::Act_Dev_DateWise', ['filter' => 'auth']);
	$routes->get('Act_Dev_DateWise/(:any)', 'Reports::Act_Dev_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Act_Supporting_AgencyWise_FYWise', 'Reports::Act_Supporting_AgencyWise_FYWise', ['filter' => 'auth']);
	$routes->get('Act_Supporting_AgencyWise_FYWise/(:any)', 'Reports::Act_Supporting_AgencyWise_FYWise/$1', ['filter' => 'auth']);

	$routes->get('Act_Supporting_AgencyWise_DateWise', 'Reports::Act_Supporting_AgencyWise_DateWise', ['filter' => 'auth']);
	$routes->get('Act_Supporting_AgencyWise_DateWise/(:any)', 'Reports::Act_Supporting_AgencyWise_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Act_Munc_FYWise', 'Reports::Act_Munc_FYWise', ['filter' => 'auth']);
	$routes->get('Act_Munc_FYWise/(:any)', 'Reports::Act_Munc_FYWise/$1', ['filter' => 'auth']);

	$routes->get('Act_Munc_DateWise', 'Reports::Act_Munc_DateWise', ['filter' => 'auth']);
	$routes->get('Act_Munc_DateWise/(:any)', 'Reports::Act_Munc_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Act_Con_Overall_Fywise', 'Reports::Act_Con_Overall_Fywise', ['filter' => 'auth']);
	$routes->get('Act_Con_Overall_Fywise/(:any)', 'Reports::Act_Con_Overall_Fywise/$1', ['filter' => 'auth']);

	$routes->get('Act_Con_Districtwise_FYwise', 'Reports::Act_Con_Districtwise_FYwise', ['filter' => 'auth']);
	$routes->get('Act_Con_Districtwise_FYwise/(:any)', 'Reports::Act_Con_Districtwise_FYwise/$1', ['filter' => 'auth']);

	$routes->get('Act_Con_Districtwise_datewise', 'Reports::Act_Con_Districtwise_datewise', ['filter' => 'auth']);
	$routes->get('Act_Con_Districtwise_datewise/(:any)', 'Reports::Act_Con_Districtwise_datewise/$1', ['filter' => 'auth']);

	$routes->get('Act_Con_Dev_RegionWise_fywise', 'Reports::Act_Con_Dev_RegionWise_fywise', ['filter' => 'auth']);
	$routes->get('Act_Con_Dev_RegionWise_fywise/(:any)', 'Reports::Act_Con_Dev_RegionWise_fywise/$1', ['filter' => 'auth']);

	$routes->get('Act_Con_Dev_RegionWise_datewise', 'Reports::Act_Con_Dev_RegionWise_datewise', ['filter' => 'auth']);
	$routes->get('Act_Con_Dev_RegionWise_datewise/(:any)', 'Reports::Act_Con_Dev_RegionWise_datewise/$1', ['filter' => 'auth']);

	$routes->get('Act_Con_Overall_datewise', 'Reports::Act_Con_Overall_datewise', ['filter' => 'auth']);
	$routes->get('Act_Con_Overall_datewise/(:any)', 'Reports::Act_Con_Overall_datewise/$1', ['filter' => 'auth']);

	$routes->get('Act_Con_TBSSPRegionWise_FYwise', 'Reports::Act_Con_TBSSPRegionWise_FYwise', ['filter' => 'auth']);
	$routes->get('Act_Con_TBSSPRegionWise_FYwise/(:any)', 'Reports::Act_Con_TBSSPRegionWise_FYwise/$1', ['filter' => 'auth']);

	$routes->get('Act_Con_TBSSPRegionWise_datewise', 'Reports::Act_Con_TBSSPRegionWise_datewise', ['filter' => 'auth']);
	$routes->get('Act_Con_TBSSPRegionWise_datewise/(:any)', 'Reports::Act_Con_TBSSPRegionWise_datewise/$1', ['filter' => 'auth']);

	$routes->get('Act_Con_Supporting_AgencyWise_FYwise', 'Reports::Act_Con_Supporting_AgencyWise_FYwise', ['filter' => 'auth']);
	$routes->get('Act_Con_Supporting_AgencyWise_FYwise/(:any)', 'Reports::Act_Con_Supporting_AgencyWise_FYwise/$1', ['filter' => 'auth']);

	$routes->get('Act_Con_Supporting_AgencyWise_datewise', 'Reports::Act_Con_Supporting_AgencyWise_datewise', ['filter' => 'auth']);
	$routes->get('Act_Con_Supporting_AgencyWise_datewise/(:any)', 'Reports::Act_Con_Supporting_AgencyWise_datewise/$1', ['filter' => 'auth']);

	$routes->get('Act_Con_Munc_FYWise', 'Reports::Act_Con_Munc_FYWise', ['filter' => 'auth']);
	$routes->get('Act_Con_Munc_FYWise/(:any)', 'Reports::Act_Con_Munc_FYWise/$1', ['filter' => 'auth']);

	$routes->get('Act_Con_Munc_datewise', 'Reports::Act_Con_Munc_datewise', ['filter' => 'auth']);
	$routes->get('Act_Con_Munc_datewise/(:any)', 'Reports::Act_Con_Munc_datewise/$1', ['filter' => 'auth']);

	

	$routes->get('Pro_Physical_Progress', 'Reports::Pro_Physical_Progress', ['filter' => 'auth']);
	$routes->get('Pro_Physical_Progress/(:any)', 'Reports::Pro_Physical_Progress/$1', ['filter' => 'auth']);

	$routes->get('Pro_Cumulative_Overall', 'Reports::Pro_Cumulative_Overall', ['filter' => 'auth']);
	$routes->get('Pro_Cumulative_Overall/(:any)', 'Reports::Pro_Cumulative_Overall/$1', ['filter' => 'auth']);

	$routes->get('Pro_Cumulative_Overall_agencywise', 'Reports::Pro_Cumulative_Overall_agencywise', ['filter' => 'auth']);
	$routes->get('Pro_Cumulative_Overall_agencywise/(:any)', 'Reports::Pro_Cumulative_Overall_agencywise/$1', ['filter' => 'auth']);

	$routes->get('R_Under_Construction', 'Reports::R_Under_Construction', ['filter' => 'auth']);
	$routes->get('R_Under_Construction/(:any)', 'Reports::R_Under_Construction/$1', ['filter' => 'auth']);

	$routes->get('R_Under_Construction_Regional', 'Reports::R_Under_Construction_Regional', ['filter' => 'auth']);
	$routes->get('R_Under_Construction_Regional/(:any)', 'Reports::R_Under_Construction_Regional/$1', ['filter' => 'auth']);

	$routes->get('R_Under_Construction_Palika', 'Reports::R_Under_Construction_Palika', ['filter' => 'auth']);
	$routes->get('R_Under_Construction_Palika/(:any)', 'Reports::R_Under_Construction_Palika/$1', ['filter' => 'auth']);

	$routes->get('R_Completed', 'Reports::R_Completed', ['filter' => 'auth']);
	$routes->get('R_Completed/(:any)', 'Reports::R_Completed/$1', ['filter' => 'auth']);

	$routes->get('R_Completed_Regional', 'Reports::R_Completed_Regional', ['filter' => 'auth']);
	$routes->get('R_Completed_Regional/(:any)', 'Reports::R_Completed_Regional/$1', ['filter' => 'auth']);

	$routes->get('R_Completed_Palika', 'Reports::R_Completed_Palika', ['filter' => 'auth']);
	$routes->get('R_Completed_Palika/(:any)', 'Reports::R_Completed_Palika/$1', ['filter' => 'auth']);

	$routes->get('Bridgewise', 'Reports::Bridgewise', ['filter' => 'auth']);
	$routes->get('Bridgewise/(:any)', 'Reports::Bridgewise/$1', ['filter' => 'auth']);

	$routes->get('Bridgewise_report', 'Reports::Bridgewise_report', ['filter' => 'auth']);
	$routes->get('Bridgewise_report/(:any)', 'Reports::Bridgewise_report/$1', ['filter' => 'auth']);

	$routes->post('Pro_Cumulative_Overall_agencywise_report', 'Reports::Pro_Cumulative_Overall_agencywise_report', ['filter' => 'auth']);
	$routes->post('Pro_Cumulative_Overall_agencywise_report/(:any)', 'Reports::Pro_Cumulative_Overall_agencywise_report\$1', ['filter' => 'auth']);

	$routes->post('Act_Con_Dev_RegionWise_fywise_report', 'Reports::Act_Con_Dev_RegionWise_fywise_report', ['filter' => 'auth']);
	$routes->post('Act_Con_Dev_RegionWise_fywise_report/(:any)', 'Reports::Act_Con_Dev_RegionWise_fywise_report/$1', ['filter' => 'auth']);

	$routes->post('Act_Con_Dev_RegionWise_datewise_report', 'Reports::Act_Con_Dev_RegionWise_datewise_report', ['filter' => 'auth']);
	$routes->post('Act_Con_Dev_RegionWise_datewise_report/(:any)', 'Reports::Act_Con_Dev_RegionWise_datewise_report/$1', ['filter' => 'auth']);

	$routes->post('Act_Con_TBSSPRegionWise_FYwise_report', 'Reports::Act_Con_TBSSPRegionWise_FYwise_report', ['filter' => 'auth']);
	$routes->post('Act_Con_TBSSPRegionWise_FYwise_report/(:any)', 'Reports::Act_Con_TBSSPRegionWise_FYwise_report/$1', ['filter' => 'auth']);

	$routes->post('Act_Con_TBSSPRegionWise_datewise_report', 'Reports::Act_Con_TBSSPRegionWise_datewise_report', ['filter' => 'auth']);
	$routes->post('Act_Con_TBSSPRegionWise_datewise_report/(:any)', 'Reports::Act_Con_TBSSPRegionWise_datewise_report/$1', ['filter' => 'auth']);

	$routes->post('Act_Con_Supporting_AgencyWise_FYwise_report', 'Reports::Act_Con_Supporting_AgencyWise_FYwise_report', ['filter' => 'auth']);
	$routes->post('Act_Con_Supporting_AgencyWise_FYwise_report/(:any)', 'Reports::Act_Con_Supporting_AgencyWise_FYwise_report/$1', ['filter' => 'auth']);

	$routes->post('Act_Con_Supporting_AgencyWise_datewise_report', 'Reports::Act_Con_Supporting_AgencyWise_datewise_report', ['filter' => 'auth']);
	$routes->post('Act_Con_Supporting_AgencyWise_datewise_report/(:any)', 'Reports::Act_Con_Supporting_AgencyWise_datewise_report/$1', ['filter' => 'auth']);

	$routes->post('Act_Con_Munc_FYWise_report', 'Reports::Act_Con_Munc_FYWise_report', ['filter' => 'auth']);
	$routes->post('Act_Con_Munc_FYWise_report/(:any)', 'Reports::Act_Con_Munc_FYWise_report/$1', ['filter' => 'auth']);

	$routes->post('Act_Con_Munc_Datewise_report', 'Reports::Act_Con_Munc_Datewise_report', ['filter' => 'auth']);
	$routes->post('Act_Con_Munc_Datewise_report/(:any)', 'Reports::Act_Con_Munc_Datewise_report/$1', ['filter' => 'auth']);

	$routes->post('Bridgewise_report', 'Reports::Bridgewise_report', ['filter' => 'auth']);
	$routes->post('Bridgewise_report/(:any)', 'Reports::Bridgewise_report/$1', ['filter' => 'auth']);
	
	
});
$routes->post('reports/Gen_Overall_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Gen_Overall_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Gen_Overall_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Gen_Overall_FYWise_report::index/$1', ['filter' => 'auth']);
$routes->post('reports/Gen_Overall_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Gen_Overall_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Gen_Overall_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Gen_Overall_DateWise_report::index/$1', ['filter' => 'auth']);
$routes->post('reports/Gen_Dev_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Gen_Dev_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Gen_Dev_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Gen_Dev_FYWise_report::index/$1', ['filter' => 'auth']);
$routes->post('reports/Gen_Dev_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Gen_Dev_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Gen_Dev_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Gen_Dev_DateWise_report::index/$1', ['filter' => 'auth']);
$routes->post('reports/Gen_Munc_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Gen_Munc_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Gen_Munc_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Gen_Munc_FYWise_report::index/$1', ['filter' => 'auth']);
$routes->post('reports/Gen_Munc_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Gen_Munc_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Gen_Munc_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Gen_Munc_DateWise_report::index/$1', ['filter' => 'auth']);
$routes->post('reports/Act_Overall_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Act_Overall_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_Overall_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_Overall_FYWise_report::index/$1', ['filter' => 'auth']);
$routes->post('reports/Act_Overall_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Act_Overall_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_Overall_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_Overall_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Act_Dist_FYWise', '\App\Modules\Reports\Controllers\Inc\Act_Dist_FYWise::index', ['filter' => 'auth']);
$routes->post('reports/Act_Dist_FYWise/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_Dist_FYWise::index/$1', ['filter' => 'auth']);

$routes->post('reports/Act_Dist_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Act_Dist_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_Dist_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_Dist_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Act_Dist_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Act_Dist_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_Dist_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_Dist_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Act_Dev_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Act_Dev_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_Dev_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_Dev_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Act_Dev_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Act_Dev_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_Dev_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_Dev_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/Act_TBSS_FYWise', '\App\Modules\Reports\Controllers\Inc\Act_TBSS_FYWise::index', ['filter' => 'auth']);
$routes->get('reports/Act_TBSS_FYWise/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_TBSS_FYWise::index/$1', ['filter' => 'auth']);

$routes->post('reports/Act_TBSS_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Act_TBSS_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_TBSS_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_TBSS_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Act_TBSS_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Act_TBSS_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_TBSS_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_TBSS_DateWise_report::index/$1', ['filter' => 'auth']);


$routes->post('reports/Act_Supporting_AgencyWise_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Act_Supporting_AgencyWise_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_Supporting_AgencyWise_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_Supporting_AgencyWise_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Act_Supporting_AgencyWise_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Act_Supporting_AgencyWise_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_Supporting_AgencyWise_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_Supporting_AgencyWise_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Act_Munc_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Act_Munc_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_Munc_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_Munc_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Act_Munc_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Act_Munc_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_Munc_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_Munc_DateWise_report::index/$1', ['filter' => 'auth']);

// $routes->post('Act_Con_Overall_Fywise_report', 'Reports::Act_Con_Overall_Fywise_report', ['filter' => 'auth']);
// $routes->post('Act_Con_Overall_Fywise_report/(:any)', 'Reports::Act_Con_Overall_Fywise_report/$1', ['filter' => 'auth']);

$routes->post('reports/Act_Con_Overall_Fywise_report', '\App\Modules\Reports\Controllers\Inc\Act_Con_Overall_Fywise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_Con_Overall_Fywise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_Con_Overall_Fywise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Act_Con_Overall_datewise_report', '\App\Modules\Reports\Controllers\Inc\Act_Con_Overall_datewise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_Con_Overall_datewise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_Con_Overall_datewise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Act_Con_Districtwise_FYwise_report', '\App\Modules\Reports\Controllers\Inc\Act_Con_Districtwise_FYwise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_Con_Districtwise_FYwise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_Con_Districtwise_FYwise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Act_Con_Districtwise_datewise_report', '\App\Modules\Reports\Controllers\Inc\Act_Con_Districtwise_datewise_report::index', ['filter' => 'auth']);
$routes->post('reports/Act_Con_Districtwise_datewise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Act_Con_Districtwise_datewise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Pro_Physical_Progress_report', '\App\Modules\Reports\Controllers\Inc\Pro_Physical_Progress_report::index', ['filter' => 'auth']);
$routes->post('reports/Pro_Physical_Progress_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Pro_Physical_Progress_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Pro_Cumulative_Overall_report', '\App\Modules\Reports\Controllers\Inc\Pro_Cumulative_Overall_report::index', ['filter' => 'auth']);
$routes->post('reports/Pro_Cumulative_Overall_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Pro_Cumulative_Overall_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/R_Completed_report', '\App\Modules\Reports\Controllers\Inc\R_Completed_report::index', ['filter' => 'auth']);
$routes->post('reports/R_Completed_report/(:any)', '\App\Modules\Reports\Controllers\Inc\R_Completed_report::index/$1', ['filter' => 'auth']);
$routes->post('reports/R_Under_Construction_report', '\App\Modules\Reports\Controllers\Inc\R_Under_Construction_report::index', ['filter' => 'auth']);
$routes->post('reports/R_Under_Construction_report/(:any)', '\App\Modules\Reports\Controllers\Inc\R_Under_Construction_report::index/$1', ['filter' => 'auth']);


// $routes->group("reportsinc", ["namespace" => "\App\Modules\Reports\Controllers\Inc"], function ($routes) {

// 	//$routes->post('Gen_Overall_DateWise_report', 'Reportsinc::Gen_Overall_DateWise_report', ['filter' => 'auth']);
// 	$routes->get('reports/Gen_Overall_DateWise_report', 'Reportsinc\Gen_Overall_DateWise_report::index', ['filter' => 'auth']);
// });
