<?php

namespace App\Modules\main_walkway_cable_number\Controllers;

use App\Controllers\BaseController;
use App\Modules\main_walkway_cable_number\Models\main_walkway_cable_number_model;

class Main_walkway_cable_number extends BaseController
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
		$model = new main_walkway_cable_number_model();
		$this->model = $model;
	}
	function index()
	{
 //var_dump( $this->model );
        $data = self::$arrDefData;
        $data['arrDataList']= $this->model->asObject()->findAll();
        return view('\Modules\main_walkway_cable_number\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}
	
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Add Main Walkway Cable Number';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = "main_walkway_cable_number/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->first($emp_id);
            $data['postURL'] .= '/'.$emp_id;
        }

       
		if ($this->request->getMethod() == 'post') {
	        	
	            $rules = [
	                'cab01mcnww_type_code' => 'required|max_length[5]',
	                'cab01mcnww_type_number' => 'required|max_length[5]'
	            ];

	            if (!$this->validate($rules)) {
	                $data['validation'] = $this->validator;
	            } else // passed validation proceed to post success logic
	            {
			 	// build array for the model
				$form_data = array(
			       	'cab01id' => @$this->request->getVar('cab01id'),
						       	'cab01mcnww_type_code' => @$this->request->getVar('cab01mcnww_type_code'),
						       	'cab01mcnww_type_number' => @$this->request->getVar('cab01mcnww_type_number'),
						       	'cab01description' => @$this->request->getVar('cab01description'),
				);
						
				// run insert model to write data to db
	            //var_dump( $this->model );
				if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
				{
	    			session()->setFlashdata('message', 'Main Walkway Cable Number  successfully created.');
				}
				else
				{
		       		session()->setFlashdata('message', 'An error occurred saving your information. Please try again later.');
				}
				redirect('main_walkway_cable_number');
				
			}

		}
		return view('\Modules\main_walkway_cable_number\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
    }
     function delete($delete_id)
	{
		if($delete_id) {
		$this->model->where('cab01id', $delete_id)->delete();
          
			session()->setFlashdata('message', 'deleted.');	
		}
        
	      
		
        
		redirect('main_walkway_cable_number');
	}
}
?>