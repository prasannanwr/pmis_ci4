<?php

namespace App\Modules\walkway_width\Controllers;

use App\Controllers\BaseController;
use App\Modules\walkway_width\Models\walkway_width_model;

class Walkway_Width extends BaseController
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
		$model = new walkway_width_model();
		$this->model = $model;
	}
	function index()
	{
 //var_dump( $this->model );
        $data = self::$arrDefData;
        $data['arrDataList']= $this->model->asObject()->findAll();
        return view('\Modules\walkway_width\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Add Walk Way Width';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = "walkway_width/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->first($emp_id);
            $data['postURL'] .= '/'.$emp_id;
        }

		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
		$rules = [
                'wal01walkwaywidth_code' => 'required|max_length[5]',
                'wal01walkway_width' => 'required|max_length[5]'
            ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
        } else // passed validation proceed to post success logic
        {
		 	// build array for the model
			$form_data = array(
		       	'wal01id' => @$this->request->getVar('wal01id'),
    	       	'wal01walkwaywidth_code' => @$this->request->getVar('wal01walkwaywidth_code'),
    	       	'wal01walkway_width' => @$this->request->getVar('wal01walkway_width'),
    	       	'wal01description' => @$this->request->getVar('wal01description'),
  			);
					
			// run insert model to write data to db
            //var_dump( $this->model );
			if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
    			session()->setFlashdata('message', 'Walkway Width successfully created.');
			}
			else
			{
    			session()->setFlashdata('message', 'An error occurred saving your information. Please try again later.');
	       		// Or whatever error handling is necessary
			}
			redirect('walkway_width');
		}
		return view('\Modules\walkway_width\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
    }
    
 function delete($delete_id)
	{
  		//$delete_id = $this->input->get('id');
        //$this->load->model('walkway_width_model');
        if($delete_id) {
        	$this->model->where('wal01id', $delete_id)->dbDelete();
			$message = 'Selected Data Deleted.';
			session()->setFlashdata('message', $message);	
        }
        
		redirect('walkway_width');
	}
}
?>