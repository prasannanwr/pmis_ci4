<?php
class Vcd_Municipality extends MX_Controller {
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
	function index()
	{
 //var_dump( $this->model );
        $data = self::$arrDefData;
        $this->load->model('view/view_vdc_model');
        $data['arrDataList']= $this->view_vdc_model->dbGetList();
        $this->template->my_template($data);
	}
	
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Add VCD and Municipality';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = self::$fName."/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('muni01id', $emp_id)->dbGetRecord();
            $data['postURL'] .= '/'.$emp_id;
        }

		$this->form_validation->set_rules('muni01name', '', 'max_length[255]');			
		$this->form_validation->set_rules('muni01type', '', 'max_length[10]');			
		$this->form_validation->set_rules('muni01remark', '', '');			
		$this->form_validation->set_rules('muni01code', '', '');			
		$this->form_validation->set_rules('muni01dist01id', '', 'max_length[10]');			
			
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
            $this->template->my_template($data);
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			$form_data = array(
		       	'muni01id' => $emp_id,
    	       	'muni01name' => @$this->input->post('muni01name'),
    	       	'muni01type' => @$this->input->post('muni01type'),
    	       	'muni01dist01id' => @$this->input->post('muni01dist01id'),
    	       	'muni01remark' => @$this->input->post('muni01remark'),
    	       	'muni01code' => @$this->input->post('muni01code'),
  			);
					
			// run insert model to write data to db
            //var_dump( $this->model );
			if ($this->model->dbSave($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
    			set_message('Municipality VDC successfully created.', 'success');
    			redirect(self::$fName, 'refresh');
			}
			else
			{
    			echo 'An error occurred saving your information. Please try again later';
	       		// Or whatever error handling is necessary
			}
		}
    }
    
    function ajaxData($id = ''){
        //todo: check login, security
        //var_dump( $_GET);
        //var_dump( $_POST);
        $length = $this->input->get('length'); 
        $start = $this->input->get('start');
        $search=$this->input->get('search');
        //var_dump($search);
        //die();
        $this->load->model('view/view_vdc_new_model');
        //todo: count total records and put the no here
        $total = count($this->view_vdc_new_model->dbGetList());
        
        $this->view_vdc_new_model->limit($length, $start);
        if($search['value']!==''){
             $this->view_vdc_new_model->like('muni01name',$search['value']);
        }
        $arrDataList = $this->view_vdc_new_model->dbGetList();
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
      
		$delete_id = $this->input->get('id');
        $this->load->model('vcd_municipality_model');
	      $this->vcd_municipality_model->where('muni01id', $delete_id)->dbDelete();
          
			$message = 'Selected Data Deleted.';
			log_query($message);
			set_message($message, 'success');
		
        
		redirect('vcd_municipality');
	}
}
?>