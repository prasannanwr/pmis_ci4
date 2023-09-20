<?php

namespace App\Modules\site_surveyors\Controllers;

use App\Controllers\BaseController;
use App\Modules\site_surveyors\Models\site_surveyors_model;

class Site_Surveyors extends BaseController
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
		$model = new site_surveyors_model();
		$this->model = $model;
	}
	function index()
	{
 //var_dump( $this->model );
        $data = self::$arrDefData;
        $data['arrDataList']= $this->model->asObject()->findAll();
        return view('\Modules\site_surveyors\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}
	
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Add Site Surveyors';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = "site_surveyors/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('ssr01id',$emp_id)->first();
            $data['postURL'] .= '/'.$emp_id;
        }
			
		
		if ($this->request->getMethod() == 'post') {
	        	
	            $rules = [
	                'ssr01surveyor_name' => 'required|max_length[80]',
	                'ssr01agency_id' => 'max_length[5]'
	            ];

	            if (!$this->validate($rules)) {
	                $data['validation'] = $this->validator;
	            } else // passed validation proceed to post success logic
	            {
			 	// build array for the model
				$form_data = array(
			       	'ssr01id' => $emp_id,
	 				       	   'ssr01surveyor_id' => @$this->request->getVar('ssr01surveyor_id'),
						       	'ssr01surveyor_name' => @$this->request->getVar('ssr01surveyor_name'),
						       	'ssr01birth_date' => @$this->request->getVar('ssr01birth_date'),
						       	'ssr01address' => @$this->request->getVar('ssr01address'),
						       	'ssr01agency_id' => @$this->request->getVar('ssr01agency_id'),
						       	'ssr01description' => @$this->request->getVar('ssr01description')
		  			);
						
				// run insert model to write data to db
	            //var_dump( $this->model );
				if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
				{
	    			set_message('Site Surveyors  successfully created.', 'success');
	    			redirect(self::$fName, 'refresh');
				}
				else
				{
	    			echo 'An error occurred saving your information. Please try again later';
		       		// Or whatever error handling is necessary
				}
			}
		}
		return view('\Modules\site_surveyors\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
    }
    
    function delete($delete_id)
	{
       //var_dump($_GET);
      
		//$delete_id = $this->input->get('id');
		if($delete_id) {

         //$arrdeltable = $this->bridge_model->where('bri02id', $delete_id)->dbGetRecord();
	      $this->model->where('ssr01id', $delete_id)->dbDelete();
          
			$message = 'Selected Data Deleted.';
			log_query($message);
			set_message($message, 'success');
		}
       
		
        
		redirect('site_surveyors');
	}
}
?>