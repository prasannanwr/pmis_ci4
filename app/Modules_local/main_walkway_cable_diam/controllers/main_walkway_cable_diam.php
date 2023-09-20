<?php

namespace App\Modules\main_walkway_cable_diam\Controllers;

use App\Controllers\BaseController;
use App\Modules\main_walkway_cable_diam\Models\main_walkway_cable_diam_model;

class Main_walkway_cable_diam extends BaseController
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
		$model = new main_walkway_cable_diam_model();
		$this->model = $model;
	}
	function index()
	{
 //var_dump( $this->model );
        $data = self::$arrDefData;
        $data['arrDataList']= $this->model->asObject()->findAll();
        return view('\Modules\main_walkway_cable_diam\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}
	
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Add Main Walk Way Cable Diam';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = "main_walkway_cable_diam/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->first($emp_id);
            $data['postURL'] .= '/'.$emp_id;
        }

		if ($this->request->getMethod() == 'post') {
        	
            $rules = [
                'cad01mcdww_type_code' => 'required|max_length[5]',
                'cad01mcdww_type_number' => 'required|max_length[5]'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else // passed validation proceed to post success logic
            {
			 	// build array for the model
				$form_data = array(
			       	'cad01id' => @$this->request->getVar('cad01id'),
						       	'cad01mcdww_type_code' => @$this->request->getVar('cad01mcdww_type_code'),
						       	'cad01mcdww_type_number' => @$this->request->getVar('cad01mcdww_type_number'),
						       	'cad01description' => @$this->request->getVar('cad01description'),
				);
						
				// run insert model to write data to db
	            //var_dump( $this->model );
				if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
				{
	    			
	    			session()->setFlashdata('message', 'successfully created.');
				}
				else
				{
	    			session()->setFlashdata('message', 'An error occurred saving your information. Please try again later.');
		       		// Or whatever error handling is necessary
				}
				redirect('main_walkway_cable_diam');
			}
		}
		return view('\Modules\main_walkway_cable_diam\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
    }
 function delete()
	{
		$delete_id = $this->input->get('id');
        $this->load->model('main_walkway_cable_diam_model');
 	      $this->main_walkway_cable_diam_model->where('cad01id', $delete_id)->dbDelete();
          
			$message = 'Selected Data Deleted.';
			log_query($message);
			set_message($message, 'success');
		
        
		redirect('main_walkway_cable_diam');
	}    
}
?>