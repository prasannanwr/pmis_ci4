<?php

namespace App\Modules\basic_supporting_agencies\Controllers;

use App\Controllers\BaseController;
use App\Modules\basic_supporting_agencies\Models\basic_supporting_agencies_model;

class Basic_supporting_agencies extends BaseController
{
    private static $arrDefData = array();
    protected $model;
    private static $fName = '';
    private $basic_supporting_agencies_model;

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
        helper('form');

        $basic_supporting_agencies_model = new basic_supporting_agencies_model();
        $this->model = $basic_supporting_agencies_model;
	}
	function index()
	{
	    //var_dump( $this->model );
        $data = self::$arrDefData;
        //$data['arrDataList']= $this->model->view_sup03_sup02();
        $data['arrDataList']= $this->model->asObject()->findAll();
        return view('\Modules\basic_supporting_agencies\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}
	
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Add Location';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = self::$fName."/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('sup03id',$emp_id)->dbGetRecord();
            $data['postURL'] .= '/'.$emp_id;
        }
			
		$rules = [
                'sup03sup_agency_code' => 'required|max_length[10]',
                'sup03sup_agency_name' => 'required|max_length[40]'
            ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
        }
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			$form_data = array(
		       	'sup03id' => $emp_id, //@$this->input->post('sup03id'),
    	       	'sup03sup_agency_code' => @$this->input->post('sup03sup_agency_code'),
    	       	'sup03sup_agency_name' => @$this->input->post('sup03sup_agency_name'),
    	       	'sup03sup_agency_type' => @$this->input->post('sup03sup_agency_type'),
    	       	'sup03description' => @$this->input->post('sup03description'),
    	       	'sup03index' => @$this->input->post('sup03index')
			);
					
			// run insert model to write data to db
            //var_dump( $this->model );
			if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
    			set_message('Location successfully created.', 'success');
    			redirect('basic_supporting_agencies', 'refresh');
			}
			else
			{
    			echo 'An error occurred saving your information. Please try again later';
	       		// Or whatever error handling is necessary
			}
		}
        return view('\Modules\basic_supporting_agencies\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
    }
     function delete()
	{
       //var_dump($_GET);
      
		$delete_id = $this->input->get('id');
        $this->load->model('basic_supporting_agencies_model');
	      $this->basic_supporting_agencies_model->where('sup03id', $delete_id)->dbDelete();
          
			$message = 'Selected Data Deleted.';
			log_query($message);
			set_message($message, 'success');
		
        
		redirect('basic_supporting_agencies');
	}
}