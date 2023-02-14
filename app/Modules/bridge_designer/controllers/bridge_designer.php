<?php
namespace App\Modules\bridge_designer\Controllers;

use App\Controllers\BaseController;
use App\Modules\bridge_designer\Models\bridge_designer_model;

class Bridge_Designer extends BaseController
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
        $model = new bridge_designer_model();
        $this->model = $model;
	}
	function index()
	{
 //var_dump( $this->model );
        $data = self::$arrDefData;
        $data['arrDataList']= $this->model->asObject()->findAll();
        return view('\Modules\bridge_designer\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}
	
    function create($emp_id = FALSE){
        
        $data = self::$arrDefData;
		$data['title'] = 'Add Bridge Designer';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = "bridge_designer/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('bdr01id',$emp_id )->dbGetRecord();
            $data['postURL'] .= '/'.$emp_id;
            //var_dump($data['postURL']);
        }
			
        $rules = [
                'bdr01designer_name' => 'required|max_length[30]',
                'bdr01address' => 'required|max_length[40]'
            ];

		if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
		} else // passed validation proceed to post success logic
		{
		 	// build array for the model
			$form_data = array(
		       	'bdr01id' => $emp_id,
					       	'bdr01designer_id' => @$this->request->getVar('bdr01designer_id'),
					       	'bdr01designer_name' => @$this->request->getVar('bdr01designer_name'),
					       	'bdr01birth_date' => @$this->request->getVar('bdr01birth_date'),
					       	'bdr01address' => @$this->request->getVar('bdr01address'),
					       	'bdr01agency_id' => @$this->request->getVar('bdr01agency_id'),
					       	'bdr01description' => @$this->request->getVar('bdr01description')
  			);
					
			// run insert model to write data to db
            //var_dump( $this->model );
			if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
                session()->setFlashdata('message', 'Successfully created.');
                //$session->setFlashdata('message_type','success');
                return redirect()->to(base_url('bridge_designer/index'));
			}
			else
			{
	       		// Or whatever error handling is necessary
                session()->setFlashdata('message', 'An error occurred saving your information. Please try again later');
                //$session->setFlashdata('message_type','success');
                return redirect()->to(base_url('bridge_designer/index'));
			}
		}
        return view('\Modules\bridge_designer\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
    }
    function delete($delete_id)
	{
       //var_dump($_GET);
      
		if($delete_id) {
          $this->model->where('bdr01id', $delete_id)->delete();
          
            session()->setFlashdata('message', 'Selected data deleted.');
                //$session->setFlashdata('message_type','success');
        }
        
		
        return redirect()->to(base_url('bridge_designer/index'));
	
	}
}