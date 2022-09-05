<?php

namespace App\Modules\construction\Controllers;

use App\Controllers\BaseController;
use App\Modules\construction\Models\construction_model;

class Construction extends BaseController
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

        $model = new construction_model();
        $this->model = $model;
    }

	function index()
	{
	    //var_dump( $this->model );
        $data = self::$arrDefData;
        $data['arrDataList']= $this->model->asObject()->findAll();
		return view('\Modules\construction\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}
	
	function form2()
	{
	    //var_dump( $this->model );
        $data = self::$arrDefData;

        $data['view_file'] = __FUNCTION__;
        //$data['arrDataList']= $this->model->findAll();
        $this->template->my_template($data);
	}
	
    function create($emp_id = FALSE){
     //echo $emp_id;
        $data = self::$arrDefData;
		$data['title'] = 'Add Construction';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = "construction/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('con02id',$emp_id)->first();
            $data['postURL'] .= '/'.$emp_id;
        }

		if ($this->request->getMethod() == 'post') {
            if ($this->request->getVar('submit') == 'Cancel') {
                //die("cancel");
                return redirect()->to('construction/index');
            }
            //check if the form is submitted or not bri03project_fiscal_year
            $rules = [
                'con02construction_type_code' => 'required|max_length[5]',
                'con02construction_type_name' => 'required|max_length[40]',
				'con02description' => 'max_length[100]'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else // passed validation proceed to post success logic
            {
		 	// build array for the model
			 $form_data = array(
				'con02id' => $emp_id,//@$this->input->post('con02id'),
				'con02construction_type_code' => @$this->input->post('con02construction_type_code'),
				'con02construction_type_name' => @$this->input->post('con02construction_type_name'),
				'con02description' => @$this->input->post('con02description'),
		   );
					
			// run insert model to write data to db
			if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				session()->setFlashdata('message', 'Successfully created.');
                //$session->setFlashdata('message_type','success');
                return redirect()->to(base_url('construction/index'));
			}
			else
			{
    			//echo 'An error occurred saving your information. Please try again later';
	       		// Or whatever error handling is necessary
				   session()->setFlashdata('message', 'An error occurred saving your information. Please try again later');
				   session()->setFlashdata('alert-class', 'alert-danger');
				   return redirect()->to(base_url('construction/index'));
			}
		}
    }


	function delete($delete_id)
	{
       //var_dump($_GET);
      
		//$delete_id = $this->input->get('id');
         //$arrdeltable = $this->bridge_model->where('bri02id', $delete_id)->dbGetRecord();
	      $this->construction_model->where('con02id', $delete_id)->delete();
          
		  $message = 'Selected Data Deleted.';
		  // log_query($message);
		  // set_message($message, 'success');
		  session()->setFlashdata('message', $message);
		return redirect()->to(base_url('construction/index'));
	}  
    
}