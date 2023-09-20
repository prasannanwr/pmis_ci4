<?php

namespace App\Modules\walkway_deck\Controllers;

use App\Controllers\BaseController;
use App\Modules\walkway_deck\Models\walkway_deck_model;

class Walkway_Deck extends BaseController
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
		$model = new walkway_deck_model();
		$this->model = $model;
	}
	function index()
	{
 //var_dump( $this->model );
        $data = self::$arrDefData;
        $data['arrDataList']= $this->model->asObject()->findAll();
        return view('\Modules\walkway_deck\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}	
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Add Walkway Deck';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = "walkway_deck/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('wad01id', $emp_id)->first();
            $data['postURL'] .= '/'.$emp_id;
        }

		$rules = [
                'wad01walkway_deck_type_code' => 'required|max_length[5]',
                'wad01walkway_deck_type_name' => 'required|max_length[40]'
            ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
        } else // passed validation proceed to post success logic
        {
		 	// build array for the model
			$form_data = array(
		       	'wad01id' => $emp_id,
                        'wad01walkway_deck_type_code' => @$this->request->getVar('wad01walkway_deck_type_code'),
                        'wad01walkway_deck_type_name' => @$this->request->getVar('wad01walkway_deck_type_name'),
                        'wad01description' => @$this->request->getVar('wad01description')
				);
					
			// run insert model to write data to db
            //var_dump( $this->model );
			if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
    			session()->setFlashdata('message', 'Walkway Deck Type successfully created.');
			}
			else
			{
	       		session()->setFlashdata('message', 'An error occurred saving your information. Please try again later.');
			}
			redirect('walkway_deck');
		}
		return view('\Modules\walkway_deck\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
    }
    
     function delete($delete_id)
	{
  //      //var_dump($_GET);
      
		// $delete_id = $this->input->get('id');
        
	      $this->model->where('wad01id', $delete_id)->delete();
          
			$message = 'Selected Data Deleted.';
			log_query($message);
			set_message($message, 'success');
		
        
		redirect('walkway_deck');
	}
}
?>