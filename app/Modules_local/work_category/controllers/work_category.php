<?php

namespace App\Modules\work_category\Controllers;

use App\Controllers\BaseController;
use App\Modules\work_category\Models\work_category_model;

class Work_Category extends BaseController
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

        $model = new work_category_model();
        $this->model = $model;
    }
	function index()
	{
 //var_dump( $this->model );
        $data = self::$arrDefData;
        $data['arrDataList']= $this->model->asObject()->findAll();
        return view('\Modules\work_category\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}
	
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Add Work Category';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = self::$fName."/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('wkc01id',$emp_id)->first();
            $data['postURL'] .= '/'.$emp_id;
        }

		$rules = [
                'wkc01work_category_code' => 'required|max_length[5]',
                'wkc01work_category_name' => 'required|max_length[40]'
            ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
        } else // passed validation proceed to post success logic
        {
		 	// build array for the model
			$form_data = array(
		       	'wkc01id' => $emp_id,
    	       	'wkc01work_category_code' => @$this->request->getVar('wkc01work_category_code'),
    	       	'wkc01work_category_name' => @$this->request->getVar('wkc01work_category_name'),
    	       	'wkc01description' => @$this->request->getVar('wkc01description'),
  			);
					
			// run insert model to write data to db
            //var_dump( $this->model );
			if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
    			//set_message('Work Category  successfully created.', 'success');
    			session()->setFlashdata('message', 'Successfully created.');
			}
			else
			{
	       		session()->setFlashdata('message', 'An error occurred saving your information. Please try again later');
			}
			redirect('work_category');
		}
		return view('\Modules\work_category\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
    }
    
     function delete($delete_id)
	{
 		//$delete_id = $this->input->get('id');
 		if($delete_id) {
 			//$this->load->model('work_category_model');
	      $this->model->where('wkc01id', $delete_id)->delete();
          
			$message = 'Selected Data Deleted.';
			log_query($message);
			set_message($message, 'success');
		
 		}
        
        
		redirect('work_category');
	}
}
?>