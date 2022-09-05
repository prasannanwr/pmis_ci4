<?php

namespace App\Modules\cost_components\Controllers;

use App\Controllers\BaseController;
use App\Modules\cost_components\Models\CostComponentsModel;

class Cost_Components extends BaseController
{
	private static $arrDefData = array();
	private static $fName = '';
	private $model;

	function __construct()
	{
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}
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

		$model = new CostComponentsModel();
		$this->model = $model;
	}

	function index()
	{
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$data['arrDataList'] = $this->model->findAll();
		return view('\Modules\cost_components\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}



	function create($emp_id = FALSE)
	{

		$data = self::$arrDefData;
		$data['title'] = 'Add Cost Components';
		$data['view_file'] = __FUNCTION__;
		$data['objOldRec'] = '';
		$data['postURL'] = self::$fName . "/create";
		if ($emp_id !== false) {
			$data['objOldRec'] = $this->model->where('cmp01id', $emp_id)->dbGetRecord();
			$data['postURL'] .= '/' . $emp_id;
		}

		if ($this->request->getMethod() == 'post') {
            if ($this->request->getVar('submit') == 'Cancel') {
                //die("cancel");
                return redirect()->to('bridge_design_standard/index');
            }
            //check if the form is submitted or not bri03project_fiscal_year
            $rules = [
                'cmp01component_id' => 'required|max_length[5]',
                'cmp01component_name' => 'required|max_length[40]',
				'cmp01description' => 'max_length[100]'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else // passed validation proceed to post success logic
            {

			// build array for the model

			$form_data = array(

				'cmp01id' => $emp_id,

				'cmp01component_id' => @$this->input->post('cmp01component_id'),

				'cmp01component_name' => @$this->input->post('cmp01component_name'),

				'cmp01description' => @$this->input->post('cmp01description'),

			);

			// run insert model to write data to db
			if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				session()->setFlashdata('message', 'Successfully created.');
                //$session->setFlashdata('message_type','success');
                return redirect()->to(base_url('cost_components/index'));
			} else {
				// Or whatever error handling is necessary
				session()->setFlashdata('message', 'An error occurred saving your information. Please try again later');
                //$session->setFlashdata('message_type','success');
                return redirect()->to(base_url('cost_components/index'));

			}
		}
		return view('\Modules\cost_components\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}



	function delete($delete_id)
	{
		//$delete_id = $this->input->get('id');
		$this->cost_components_model->where('cmp01id', $delete_id)->delete();
		$message = 'Selected Data Deleted.';
		session()->setFlashdata('message', $message);
        //$session->setFlashdata('message_type','success');
        return redirect()->to(base_url('cost_components/index'));
	}
}