<?php

namespace App\Modules\bridge_anchorage_foundation\Controllers;

use App\Controllers\BaseController;
use App\Modules\bridge_anchorage_foundation\Models\bridge_anchorage_foundation_model;

class Bridge_anchorage_foundation extends BaseController
{
    private static $arrDefData = array();
    protected $model;

    function __construct()
    {
        helper(['form', 'html', 'et_helper']);
        if (count(self::$arrDefData) <= 0) {
            $FName = basename(__FILE__, '.php');
            $fName = strtolower($FName);
            self::$arrDefData = array(
                'title'         => $FName,
                'breadcrumb'    => array(array('text' => $FName, 'link' => $fName)),
                'module'        => $fName,
                'view_file'     => 'index',
            );
        }

        if (session()->get('type') == 6 || session()->get('type') != ENUM_ADMINISTRATOR) {
            redirect('bridge', 'refresh');
        }

        $model = new bridge_anchorage_foundation_model();
        $this->model = $model;
    }

	function index()
	{
	    //var_dump( $this->model );
        $data = self::$arrDefData;
        $data['arrDataList']= $this->model->asObject()->findAll();
		return view('\Modules\bridge_anchorage_foundation\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}
    
}