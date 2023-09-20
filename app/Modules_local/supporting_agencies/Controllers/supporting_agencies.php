<?php

namespace App\Modules\supporting_agencies\Controllers;

use App\Controllers\BaseController;
use App\Modules\supporting_agencies\Models\supporting_agencies_model;

class Supporting_Agencies extends BaseController {
	private $custom_errors = array();
    private static $arrDefData = array();
    private static $fName = '';
    protected $model;
    
	function __construct()
	{
        if(count(self::$arrDefData)<=0){
            $FName = basename(__FILE__, '.php');
            self::$fName = strtolower($FName);
            self::$arrDefData = array(
                'title'         => $FName, 
                'breadcrumb'    => array(array('text' => $FName, 'link' => self::$fName)),
            	'module'        => self::$fName,
            	'view_file'     => 'index',
            );
        }
        $model = new supporting_agencies_model();
        $this->model = $model;
	}
	function index()
	{
	    //var_dump( $this->model );
        $data = self::$arrDefData;
        //$data['arrDataList']= $this->model->view_sup01_sup02();
        $data['arrDataList']= $this->model->asObject()->findAll();
        return view('\Modules\supporting_agencies\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}
	
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Add Location';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = self::$fName."/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('sup01id',$emp_id)->asObject()->first();
            $data['postURL'] .= '/'.$emp_id;
        }

        if ($this->request->getMethod() == 'post') {
        	$rules = [
                'sup01sup_agency_code' => 'required|max_length[10]',
                'sup01sup_agency_name' => 'required|max_length[40]'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            }
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			$form_data = array(
		       	'sup01id' => $emp_id, //@$this->input->post('sup01id'),
    	       	'sup01sup_agency_code' => @$this->request->getVar('sup01sup_agency_code'),
    	       	'sup01sup_agency_name' => @$this->request->getVar('sup01sup_agency_name'),
    	       	'sup01sup_agency_type' => @$this->request->getVar('sup01sup_agency_type'),
    	       	'sup01description' => @$this->request->getVar('sup01description'),
    	       	'sup01index' => @$this->request->getVar('sup01index')
			);

					
			// run insert model to write data to db
            //var_dump( $this->model );
			if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
    			set_message('Location successfully created.', 'success');
    			redirect(self::$fName, 'refresh');
			}
			else
			{
    			echo 'An error occurred saving your information. Please try again later';
	       		// Or whatever error handling is necessary
			}
		}
        }

		
		return view('\Modules\supporting_agencies\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
    }
     function delete()
	{
       //var_dump($_GET);
      
		$delete_id = $this->input->get('id');
        $this->load->model('supporting_agencies_model');
	      $this->supporting_agencies_model->where('sup01id', $delete_id)->dbDelete();
          
			$message = 'Selected Data Deleted.';
			log_query($message);
			set_message($message, 'success');
		
        
		redirect('supporting_agencies');
	}

}
?>