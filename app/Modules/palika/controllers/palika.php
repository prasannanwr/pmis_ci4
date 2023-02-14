<?php

namespace App\Modules\palika\Controllers;

use App\Controllers\BaseController;
use App\Modules\palika\Models\palika_model;
use App\Modules\view\Models\view_vdc_model;
use App\Modules\view\Models\view_vdc_new_model;

class Palika extends BaseController {
	private $custom_errors = array();
    private static $arrDefData = array();
    private static $fName = '';
    private $view_vdc_model;
    private $view_vdc_new_model;
    
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
        $model = new palika_model();
        $view_vdc_new_model = new view_vdc_new_model();
        $this->model = $model;
        $this->view_vdc_new_model = $view_vdc_new_model;
	}
	function index()
	{
 //var_dump( $this->model );
        $data = self::$arrDefData;
        $this->view_vdc_model = new view_vdc_model();
        $data['arrDataList']= $this->view_vdc_model->findAll();
        return view('\Modules\palika\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
	}
	
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Add VDC and Municipality';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = self::$fName."/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('muni01id', $emp_id)->first();
            $data['postURL'] .= '/'.$emp_id;
        }

		// $this->form_validation->set_rules('muni01name', '', 'max_length[255]');			
		// $this->form_validation->set_rules('muni01type', '', 'max_length[10]');			
		// $this->form_validation->set_rules('muni01remark', '', '');			
		// $this->form_validation->set_rules('muni01code', '', '');			
		// $this->form_validation->set_rules('muni01dist01id', '', 'max_length[10]');	
		//$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
    	$rules = [
                'muni01name' => 'required|max_length[255]',
                'muni01code' => 'required|max_length[10]'
        ];    

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
        }
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			$form_data = array(
		       	'muni01id' => $emp_id,
    	       	'muni01name' => @$this->request->getVar('muni01name'),
    	       	'muni01type' => @$this->request->getVar('muni01type'),
    	       	'muni01dist01id' => @$this->request->getVar('muni01dist01id'),
    	       	'muni01remark' => @$this->request->getVar('muni01remark'),
    	       	'muni01code' => @$this->request->getVar('muni01code'),
  			);
					
			// run insert model to write data to db
            //var_dump( $this->model );
			if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
    			//set_message('Municipality VDC successfully created.', 'success');
                session()->setFlashdata('message', 'Municipality VDC successfully created.');
    			//redirect(self::$fName, 'refresh');
			}
			else
			{
                //set_message('An error occurred saving your information. Please try again later.', 'success');
                session()->setFlashdata('message', 'An error occurred saving your information. Please try again later.');
	       		// Or whatever error handling is necessary
			}
            redirect(self::$fName, 'refresh');
		}
        return view('\Modules\palika\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    
    function ajaxData($id = ''){
        $length = @$this->request->getVar('length'); 
        $start = @$this->request->getVar('start');
        $search= @$this->request->getVar('search');

        //todo: count total records and put the no here
        $total = count($this->view_vdc_new_model->findAll());
        
        $this->view_vdc_new_model->limit($length, $start);
        if($search['value']!==''){
             $this->view_vdc_new_model->like('muni01name',$search['value']);
        }
        $arrDataList = $this->view_vdc_new_model->findAll();
        $output['draw']=$this->request->getVar('draw');
        $output['recordsTotal']=$total;
        $output['recordsFiltered']=$total;
        $output['data']=$arrDataList;
        echo json_encode( $output );
        die();
    }
    
     function delete($delete_id)
	{
       //var_dump($_GET);
      if ($delete_id) {
        //die($delete_id);
	      $this->model->where('muni01id', $delete_id)->delete();
          
			$message = 'Selected Data Deleted.';
			
		session()->setFlashdata('message', $message);
        
		return redirect()->to('palika');
        }
	}
}
?>