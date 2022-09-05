<?php

namespace App\Modules\province\Controllers;

use App\Controllers\BaseController;
use App\Modules\province\Models\ProvinceModel;

class Province extends BaseController
{

	private static $arrDefData = array();
	private static $fName = '';

	function __construct()
	{
		helper(['form']);
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

		$model = new ProvinceModel();
		$this->model = $model;
	}

	function index()
	{
		$data = self::$arrDefData;
		$data['arrDataList'] = $this->model->asObject()->findAll();
		return view('\Modules\province\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
	}

	function create($emp_id = FALSE)
	{
		$data = self::$arrDefData;
		$data['title'] = 'Add State';
		$data['view_file'] = __FUNCTION__;

		$data['objOldRec'] = '';
		$data['postURL'] = self::$fName . "/create";
		if ($emp_id !== false) {
			$data['objOldRec'] = $this->model->where('province_id', $emp_id)->asObject()->first();
			$data['postURL'] .= '/' . $emp_id;
		}


		if ($this->request->getMethod() == 'post') {
			//check if the form is submitted or not bri03project_fiscal_year
			$rules = [
				'province_name' => 'required|max_length[255]',
				'province_code' => 'required'
			];


			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
				return view('\Modules\province\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
			} else {
				// build array for the model
				$form_data = array(
					'province_id' => $emp_id,
					'province_name' => @$this->request->getVar('province_name'),
					'province_code' => @$this->request->getVar('province_code'),
					'province_status' => 1,
				);

				// run insert model to write data to db
				//var_dump( $this->model );
				if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
				{
					session()->setFlashdata('message', 'State successfully created.');
				} else {
					echo 'An error occurred saving your information. Please try again later';
					// Or whatever error handling is necessary
				}
				return redirect()->to('province');
			}
		}
		return view('\Modules\province\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
	}

	function delete($delete_id)
	{
		if ($delete_id) {
			$this->model->where('province_id', $delete_id)->delete();

			$message = 'Selected Data Deleted.';
			session()->setFlashdata('message', $message);
			return redirect()->to('province');
		}
	}
}
