<?php
class Logo_Upload extends MX_Controller {
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
      // var_dump($_POST);
      // die();
        $data = self::$arrDefData;
		$data['title'] = 'logo ';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = self::$fName."/create";
        $data['arrDataList']= $this->model->dbGetRecord();
        
        $this->form_validation->set_rules('log01name', '', '');	

        if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
            $this->template->my_template($data);
		}else{
            //
         
            	$form_data = array(
                   	'log01id' => $data['arrDataList']->log01id,
                	'log01name' => @$this->input->post('log01name'),
                );
                $fld =uploadFile('log01file');
              
                $form_data['log01file'] = $fld[1];	
                
                //$this->model->where('log01id', 1)->dbDelete();	
                if ($this->model->dbSave($form_data) == TRUE) // the information has therefore been successfully saved in the db
                {
                    set_message('photo successfully upload.', 'success');
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