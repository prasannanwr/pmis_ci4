<?php

namespace App\Modules\bridge_type\Controllers;

use App\Controllers\BaseController;
use App\Modules\bridge_type\Models\bridge_type_model;

class Bridge_type extends BaseController
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

        $model = new bridge_type_model();
        $this->model = $model;
    }

	function index()
	{
	    //var_dump( $this->model );
        $data = self::$arrDefData;
        $data['arrDataList']= $this->model->asObject()->findAll();
		return view('\Modules\bridge_type\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
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
		$data['title'] = 'Bridge Type';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = "bridge_type/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('bri01id',$emp_id)->first();
            $data['postURL'] .= '/'.$emp_id;
        }

		if ($this->request->getMethod() == 'post') {
            if ($this->request->getVar('submit') == 'Cancel') {
                //die("cancel");
                return redirect()->to('bridge_type/index');
            }
            //check if the form is submitted or not bri03project_fiscal_year
            $rules = [
                'bri01bridge_type_code' => 'required|max_length[4]',
                'bri01bridge_type_name' => 'required|max_length[40]',
				'bri01description' => 'max_length[100]'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else // passed validation proceed to post success logic
            {
		 	// build array for the model
			$form_data = array(
		       	'bri01id' =>$emp_id,
					       	'bri01bridge_type_code' => @$this->request->getVar('bri01bridge_type_code'),
					       	'bri01bridge_type_name' => @$this->request->getVar('bri01bridge_type_name'),
					       	'bri01description' => @$this->request->getVar('bri01description')
			);
					
			// run insert model to write data to db
			if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				session()->setFlashdata('message', 'Bridge successfully created.');
                //$session->setFlashdata('message_type','success');
                return redirect()->to(base_url('bridge_type/index'));
			}
			else
			{
	       		// Or whatever error handling is necessary
				session()->setFlashdata('message', 'An error occurred saving your information. Please try again later');
				session()->setFlashdata('alert-class', 'alert-danger');
			}
		}
		return view('\Modules\bridge_type\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function delete($delete_id)
	{
        $this->bridge_type_model->where('bri01id', $delete_id)->delete();
        $message = 'Selected Data Deleted.';
        session()->setFlashdata('message', $message);
        //$session->setFlashdata('message_type','success');
        return redirect()->to(base_url('bridge_type/index'));
	}
}