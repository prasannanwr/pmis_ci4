<?php

namespace App\Modules\weighted\Controllers;

use App\Controllers\BaseController;
use App\Modules\weighted\Models\weighted_model;

class Weighted extends BaseController
{
    private static $arrDefData = array();
    private static $fName = '';
    private $model;

    function __construct()
    {
        if (count(self::$arrDefData) <= 0) {

            $FName = basename(__FILE__, '.php');
            self::$fName = strtolower($FName);
            self::$arrDefData = array(
                'title'         => $FName,
                'breadcrumb'    => array(array('text' => $FName, 'link' => self::$fName)),
                'module'        => self::$fName,
                'view_file'     => 'index',
            );
        }
        helper(['form', 'html', 'et_helper']);
        $model = new weighted_model();
        $this->model = $model;
    }

	
    function index(){
    //var_dump($_POST);
      // die();
        $data = self::$arrDefData;
		$data['title'] = 'weighted ';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = "weighted/create";
        $data['arrDataList']= $this->model->asObject()->findAll();
        
        $rules = [
                'wei01value' => 'required',
            ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
        } else {
            //
                	// build array for the model
            foreach($data['arrDataList'] as $SupData){
                //var_dump($SupData);
                $supD1 = $_POST['id_'. $SupData->wei01id];
                $supD2 =  $SupData->wei01int_name;
                $supD3 = $SupData->wei01label;;
                $supD4 = $_POST['wei01value_'. $SupData->wei01id];
            
    			$form_data = array(
    		       	'wei01id' =>$supD1,
                                   
    					       	//'fis02dist01codeid' => @$$this->request->getVar('fis02dist01codeid'),
    					       	'wei01int_name' => $supD2,
    					       	'wei01label' => $supD3,
    						   	'wei01value' => $supD4
    					       	
        		);
                
                $this->model->save($form_data);
            } 
                
           
                  if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
                {
                    session()->setFlashdata('message', 'Data saved.');
                    // Or whatever error handling is necessary
                }
                else
                {
                    session()->setFlashdata('message', 'An error occurred saving your information. Please try again later.');
                    // Or whatever error handling is necessary
                }	
                redirect('main_walkway_cable_diam');
            
		}
        return view('\Modules\weighted\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}
    
    
}
?>