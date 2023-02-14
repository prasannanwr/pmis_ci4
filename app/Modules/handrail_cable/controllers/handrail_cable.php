<?php

namespace App\Modules\handrail_cable\Controllers;

use App\Controllers\BaseController;
use App\Modules\handrail_cable\Models\handrail_cable_model;

class Handrail_Cable extends BaseController
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

        $model = new handrail_cable_model();
        $this->model = $model;
    }
	function index()
	{
 //var_dump( $this->model );
        $data = self::$arrDefData;
        $data['arrDataList']= $this->model->asObject()->findAll();
        return view('\Modules\handrail_cable\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}
	
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Add Handrail Cable';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = "handrail_cable/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('hdc01id',$emp_id)->first();
            $data['postURL'] .= '/'.$emp_id;
        }

        if ($this->request->getMethod() == 'post') {
        	
            $rules = [
                'hdc01hhcn_type_code' => 'required|max_length[5]',
                'hdc01hhcn_type_number' => 'required|max_length[10]',
				'hdc01description' => 'max_length[100]'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else // passed validation proceed to post success logic
            {
			 	// build array for the model
				$form_data = array(
			       	'hdc01id' =>$emp_id,
	    	       	'hdc01hhcn_type_code' => @$this->request->getVar('hdc01hhcn_type_code'),
	    	       	'hdc01hhcn_type_number' => @$this->request->getVar('hdc01hhcn_type_number'),
	    	       	'hdc01description' => @$this->request->getVar('hdc01description'),
	  			);	
				// run insert model to write data to db
	            //var_dump( $this->model );
				if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
				{
	    			//set_message('Handrail Cable  successfully created.', 'success');
	    			
	    			session()->setFlashdata('message', 'Successfully created.');
                    
				}
				else
				{
	    			session()->setFlashdata('message', 'An error occurred saving your information. Please try again later.');
		       		// Or whatever error handling is necessary
				}
				redirect('handrail_cable');
			}
        }
		
		return view('\Modules\handrail_cable\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
    }
 function delete($delete_id)
	{
       //var_dump($_GET);
      if($delete_id) {
      	//$delete_id = $this->input->get('id');
	      $this->model->where('hdc01id', $delete_id)->delete();
          
			$message = 'Selected Data Deleted.';
			log_query($message);
			set_message($message, 'success');
		
        
		redirect('handrail_cable');
      }
		
	}
}
?>