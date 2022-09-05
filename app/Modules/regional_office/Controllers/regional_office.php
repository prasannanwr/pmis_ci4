<?php

namespace App\Modules\regional_office\Controllers;

use App\Controllers\BaseController;
use App\Modules\regional_office\Models\regional_office_model;

class Regional_office extends BaseController
{

	private static $arrDefData = array();
	protected $district_name_model;
	protected $fiscal_data_model;
	protected $view_all_views_model;
	private static $fName = '';

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
		helper(['form', 'url']);
		$this->model = new regional_office_model();
	}

	function index()
	{
		$data = self::$arrDefData;
		$data['arrDataList'] = $this->model->asObject()->findAll();
		return view('\Modules\regional_office\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
	}

	function create($emp_id = FALSE)
	{
		$data = self::$arrDefData;
		$data['title'] = 'Add TBIS Regional Office';
		$data['view_file'] = __FUNCTION__;

		$data['objOldRec'] = '';
		$data['postURL'] = self::$fName . "/create";
		if ($emp_id !== false) {
			$data['objOldRec'] = $this->model->where('tbis01id', $emp_id)->asObject()->first();
			$data['postURL'] .= '/' . $emp_id;
		}


		if ($this->request->getMethod() == 'post') {
			if ($this->request->getVar('submit') == 'Cancel') {
				//die("cancel");
				return redirect()->to('regional_office/index');
			}
			//check if the form is submitted or not bri03project_regional_office
			$rules = [
				'tbis01name' => 'required|max_length[255]',
				'tbis01address' => 'max_length[255]'
			];


			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
				//return view('\Modules\regional_office\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
				return redirect()->route('regional_office/create')->withInput()->with('validation',$this->validator); 
			} else // passed validation proceed to post success logic
			{
				// build array for the model
				$form_data = array(
					'tbis01id' => $emp_id,
					'tbis01name' => @$this->request->getVar('tbis01name'),
					'tbis01address' => @$this->request->getVar('tbis01address'),
					'tbis01remarks' => @$this->request->getVar('tbis01remarks'),
				);

				// run insert model to write data to db
				//var_dump( $this->model );
				if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
				{
					session()->setFlashdata('message', 'Regional Office successfully created.');
					return redirect()->to(base_url('regional_office'));
				} else {
					session()->setFlashdata('message', 'An error occurred saving your information. Please try again later');
					session()->setFlashdata('alert-class', 'alert-danger');
					return redirect()->to(base_url('regional_office/create'));
				}
			}
		}
		return view('\Modules\regional_office\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
	}
	function delete($delete_id = 0)
	{
		//var_dump($_GET);
		if($delete_id > 0) {
			//$delete_id = $this->request->getVar('id');
			$this->model->where('tbis01id', $delete_id)->delete();

			$message = 'Selected Data Deleted.';
			session()->setFlashdata('message', $message);
		} else {
			session()->setFlashdata('alert-class', 'alert-danger');
			session()->setFlashdata('message', 'Error processing your request.');
		}
		return redirect()->to(base_url('regional_office/index'));
	}
}
