<?php

namespace App\Modules\bridge_type\Controllers;

use App\Controllers\BaseController;
use App\Modules\bridge_type\Models\bridge_type_model;
use App\Modules\district_name\Models\district_name_model;
use App\Modules\view\Models\view_district_model;

class District_name extends BaseController
{
    private static $arrDefData = array();
    protected $model;
    private static $fName = '';
	private $view_district_model;

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
        $model = new district_name_model();
		$view_district_model = new view_district_model();
        $this->model = $model;
		$this->view_district_model = $view_district_model;
	}
	function index()
	{
        $data = self::$arrDefData;
        $data['arrDataList']= $this->view_district_model->asObject()->findAll();
        $data['arrDistList']= $this->model->asObject()->findAll();
		return view('\Modules\district_name\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
        
	}
	
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Add District';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = self::$fName."/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('dist01id', $emp_id)->dbGetRecord();
            $data['postURL'] .= '/'.$emp_id;
        }

		if ($this->request->getMethod() == 'post') {
            if ($this->request->getVar('submit') == 'Cancel') {
                //die("cancel");
                return redirect()->to('district_name/index');
            }
            //check if the form is submitted or not bri03project_fiscal_year
            $rules = [
                'dist01name' => 'required|max_length[50]',
                'dist01zon01id' => 'required|max_length[4]',
				'dist01remark' => 'max_length[100]',
				'dist01tbis01id' => 'required',
				'province_id' => 'required'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else
		{
		 	// build array for the model
					
			if($emp_id != '') {
				$form_data = array(
					'dist01id' => $emp_id,
					'dist01name' => @$this->request->getVar('dist01name'),
					'dist01zon01id' => @$this->request->getVar('dist01zon01id'),
					'dist01remark' => @$this->request->getVar('dist01remark'),
					'dist01code' => @$this->request->getVar('dist01code'),
					'dist01tbis01id' => @$this->request->getVar('dist01tbis01id'),
					'dist01state' => @$this->request->getVar('province_id')
				);
				//print_r($form_data);exit;
			} else {
				 $form_data = array(
					'dist01name' => @$this->request->getVar('dist01name'),
					'dist01zon01id' => @$this->request->getVar('dist01zon01id'),
					'dist01remark' => @$this->request->getVar('dist01remark'),
					'dist01code' => @$this->request->getVar('dist01code'),
					'dist01tbis01id' => @$this->request->getVar('dist01tbis01id'),
					'dist01state' => @$this->request->getVar('province_id')
				);			
			}
			// run insert model to write data to db
            //var_dump( $this->model );
			if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
    			session()->setFlashdata('message', 'Successfully updated');
    			redirect(self::$fName, 'refresh');
			}
			else
			{
    			session()->setFlashdata('alert-class', 'alert-danger');
				session()->setFlashdata('message', 'Error processing your request.');
			}
		}
		return view('\Modules\district_name\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
        
    }

    function ajaxData($id = ''){
        //todo: check login, security
        //var_dump( $_GET);
        //var_dump( $_POST);
		$length = $this->input->get('length'); 
        $start = $this->input->get('start');
        $search=$this->input->get('search');
        
        $this->load->model('view/view_district_model');
        //todo: count total records and put the no here
        $total = count($this->view_district_model->findAll());
        
        $this->view_district_model->limit($length, $start);
		if($search['value']!==''){
             $this->view_district_model->like('dist01name',$search['value']);
        }
        $arrDataList = $this->view_district_model->findAll();
        $output['draw']=$this->input->get('draw');
        $output['recordsTotal']=$total;
        $output['recordsFiltered']=$total;
        $output['data']=$arrDataList;
        echo json_encode( $output );
        die();
    }
    
	function delete()
	{
       //var_dump($_GET);
      
		$delete_id = $this->request->getVar('id');
	      $this->district_name_model->where('dist01id', $delete_id)->delete();
          
			$message = 'Selected Data Deleted.';
			session()->setFlashdata('message', $message);
		
        
		redirect('district_name');
	}
}