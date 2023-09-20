<?php

namespace App\Modules\fiscal_year\Controllers;

use App\Controllers\BaseController;
use App\Modules\district_name\Models\district_name_model;
use App\Modules\fiscal_data\Models\fiscal_data_model;
use App\Modules\fiscal_year\Models\FiscalYearModel as ModelsFiscalYearModel;
use App\Modules\view\Models\view_all_views_model;

class fiscal_year extends BaseController {
	
    private static $arrDefData = array();
	protected $district_name_model;
	protected $fiscal_data_model;
	protected $view_all_views_model;
    
	function __construct()
	{
        if(count(self::$arrDefData)<=0){
            $FName = basename(__FILE__, '.php');
            $fName = strtolower($FName);
            self::$arrDefData = array(
                'title'         => $FName, 
                'breadcrumb'    => array(array('text' => $FName, 'link' => $fName)),
            	'module'        => $fName,
            	'view_file'     => 'index',
            );
        }

        if(session()->get('type') == 6){
            redirect('bridge', 'refresh');
        }
		helper('form');
        $this->model = new ModelsFiscalYearModel();
		$district_name_model = new district_name_model();
		$fiscal_data_model = new fiscal_data_model();
		$view_all_views_model = new view_all_views_model();
		$this->district_name_model = $district_name_model;
		$this->fiscal_data_model = $fiscal_data_model;
		$this->view_all_views_model = $view_all_views_model;

	}

    function index()
	{
       $data = self::$arrDefData;
         //$data['view_file'] = __FUNCTION__;
         $data['arrDataList']= $this->model->asObject()->findAll();
		return view('\Modules\fiscal_year\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
	}
    
	function form2()
	{
	    //var_dump( $this->model );
        $data = self::$arrDefData;

        $data['view_file'] = __FUNCTION__;
        //$data['arrDataList']= $this->model->findAll();
        return view('\Modules\fiscal_year\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
	}
	
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Fiscal Year';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = "fiscal_year/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->asObject()->where('fis01id',$emp_id)->first();
            $data['postURL'] .= '/'.$emp_id;
        }

		if ($this->request->getMethod() == 'post') {
            if ($this->request->getVar('submit') == 'Cancel') {
                //die("cancel");
                return redirect()->to('fiscal_year/index');
            }
            //check if the form is submitted or not bri03project_fiscal_year
            $rules = [
                'fis01year' => 'required|max_length[12]',
                'fis01code' => 'required|max_length[10]'
            ];
			

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            }
			else // passed validation proceed to post success logic
			{
				// build array for the model
				$form_data = array(
					'fis01id' => $emp_id,
								'fis01year' => @$this->request->getVar('fis01year'),
								'fis01code' => @$this->request->getVar('fis01code'),
								
				);
				
				$fis01year = $this->request->getVar('fis01year');			
				
				// run insert model to write data to db
				if ($this->model->save($form_data) == TRUE) // the information has therefore been successfully saved in the db
				
				{
					/* save fiscal data */
					
					$arrDistList= $this->district_name_model->findAll();
					// build array for the model
					foreach($arrDistList as $distData){
						//var_dump($SupData);	        	            
						$form_data = array(
							'fis02dist01codeid' =>$distData->dist01id,
										//'fis02dist01codeid' => @$this->request->getVar('fis02dist01codeid'),
										'fis02year' => @$this->request->getVar('fis01year'),
										'fis02name1' => 0,
										'fis02name2' => 0,
										'fis02name3' => 0,
										'fis02name4' => 0,
										'fis02sup01id' => 1,
										'fis02constype' => 0
						);	                
						$this->fiscal_data_model->save($form_data);

						$form_data1 = array(
							'fis02dist01codeid' =>$distData->dist01id,
										//'fis02dist01codeid' => @$this->request->getVar('fis02dist01codeid'),
										'fis02year' => @$this->request->getVar('fis01year'),
										'fis02name1' => 0,
										'fis02name2' => 0,
										'fis02name3' => 0,
										'fis02name4' => 0,
										'fis02sup01id' => 1,
										'fis02constype' => 1
						);
						
						$this->fiscal_data_model->save($form_data1);
					} 
					
					//save carry over bridges from previous fy
					
					//new construction
					$Previous_carry= $this->view_all_views_model->view_sup03_dist01_bri05_count_carry_previous_data(0,$fis01year);
					//var_dump($Previous_carry);
					//exit;
					
					foreach($Previous_carry as $previous) {
										
						$this->fiscal_data_model->dbInsertAData($previous->dist01id, @$this->request->getVar('fis01year'), 0, $previous->bri03supporting_agency, $previous->bri03total_previous_carry_count);
						
					}
					
					//major maintenance
					$Previous_carry= $this->view_all_views_model->view_sup03_dist01_bri05_count_carry_previous_data(1,$fis01year);
					foreach($Previous_carry as $previous) {	                	                
						$this->fiscal_data_model->dbInsertAData($previous->dist01id, @$this->request->getVar('fis01year'), 1, $previous->bri03supporting_agency, $previous->bri03total_previous_carry_count);
					}
					//exit;				

					//set_message('Fiscal Year successfully created.', 'success');
					session()->setFlashdata('message', 'Fiscal Year successfully created.');
					return redirect()->to(base_url('fiscal_year/index'));
				}
				else
				{
					session()->setFlashdata('alert-class', 'alert-danger');
					session()->setFlashdata('message', 'Error processing your request.');
					return redirect()->to(base_url('fiscal_year/index'));
				}
			}
		}
		return view('\Modules\fiscal_year\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

     function delete($delete_id = 0)
	{
       //var_dump($_GET);
		  //$delete_id = $this->request->getVar('id');
		$objOldRec = $this->model->where('fis01id',$delete_id)->asObject()->first();
		$fy = $objOldRec->fis01year;
		 
 	    $this->fiscal_year_model->where('fis01id', $delete_id)->delete();
		$this->fiscal_data_model->dbDeleteData($fy);
          
			$message = 'Selected Data Deleted.';
			// log_query($message);
			// set_message($message, 'success');
		
        
			return redirect()->to(base_url('fiscal_year/index'));
	}
    
}