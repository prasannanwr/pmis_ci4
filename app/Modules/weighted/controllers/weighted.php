<?php
class Weighted extends MX_Controller {
	private $custom_errors = array();
    private static $arrDefData = array();
    private static $fName = '';
    
	function __construct()
	{
		if ( ! $this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
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
        parent::__construct();
        $this->load->module('template');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $clName = get_class($this) . '_model';
        $this->load->model( $clName );
        $this->model = $this->{$clName};
	}
//function index()
	//{
 //var_dump( $this->model );
       //$data = self::$arrDefData;
        //$data['arrDataList']= $this->model->dbGetList();
        //$this->template->my_template($data);
//	}
	
    function index(){
    //var_dump($_POST);
      // die();
        $data = self::$arrDefData;
		$data['title'] = 'weighted ';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = self::$fName."/create";
        $data['arrDataList']= $this->model->dbGetList();
        
        $this->form_validation->set_rules('wei01value', '', '');	

        if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
            $this->template->my_template($data);
		}else{
            //
                	// build array for the model
            foreach($data['arrDataList'] as $SupData){
                //var_dump($SupData);
                $supD1 = $_POST['id_'. $SupData->wei01id];
                $supD2 =  $SupData->wei01int_name;
                $supD3 = $SupData->wei01label;;
                $supD4 = $_POST['wei01value_'. $SupData->wei01id];
            
    			$form_data = array(
    		       	'wei01id' =>$supD1,
                                   
    					       	//'fis02dist01codeid' => @$this->input->post('fis02dist01codeid'),
    					       	'wei01int_name' => $supD2,
    					       	'wei01label' => $supD3,
    						   	'wei01value' => $supD4
    					       	
        		);
                
                $this->model->dbSave($form_data);
            } 
                
           
                  if ($this->model->dbSave($form_data) == TRUE) // the information has therefore been successfully saved in the db
                {
                    set_message('Data successfully upload.', 'success');
                    redirect(self::$fName, 'refresh');
                }
                else
                {
                    echo 'An error occurred saving your information. Please try again later';
                    // Or whatever error handling is necessary
                }	
            
		}
	}
    
    
}
?>