<?php

namespace App\Modules\rust_prev_measures\Controllers;

use App\Controllers\BaseController;
use App\Modules\rust_prev_measures\Models\rust_prev_measures_model;

class Rust_Prev_Measures extends BaseController
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
		$model = new rust_prev_measures_model();
		$this->model = $model;
	}
	function index()
	{
 //var_dump( $this->model );
        $data = self::$arrDefData;
        $data['arrDataList']= $this->model->asObject()->findAll();
        return view('\Modules\rust_prev_measures\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}
	
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Add Rust Prev Measures';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = self::$fName."/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('rus01id', $emp_id)->dbGetRecord();
            $data['postURL'] .= '/'.$emp_id;
        }

		
		if ($this->request->getMethod() == 'post') {
	        	
	            $rules = [
	                'rus01rpm_type_code' => 'required|max_length[5]',
	                'rus01rpm_type_name' => 'required|max_length[30]'
	            ];

	            if (!$this->validate($rules)) {
	                $data['validation'] = $this->validator;
	            } else // passed validation proceed to post success logic
	            {
			 	// build array for the model
				$form_data = array(
			       	'rus01id' =>$emp_id,
	    	       	'rus01rpm_type_code' => @$this->request->getVar('rus01rpm_type_code'),
	    	       	'rus01rpm_type_name' => @$this->request->getVar('rus01rpm_type_name'),
	    	       	'rus01description' => @$this->request->getVar('rus01description'),
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
				redirect('rust_prev_measures');
			}
		}
		return view('\Modules\rust_prev_measures\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
    }
    
      function delete($delete_id)
	{
       //var_dump($_GET);
      
		if($delete_id) {

 	      $this->model->where('rus01id', $delete_id)->dbDelete();
          
			$message = 'Selected Data Deleted.';
			session()->setFlashdata('message', $message);
		
		}
       
        
		redirect('rust_prev_measures');
	}
}
?>