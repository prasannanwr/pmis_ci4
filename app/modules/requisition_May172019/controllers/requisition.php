<?php
class Requisition extends MX_Controller {
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
        $this->load->model( "organization/organization_model" );
        $this->load->model( "supplier/supplier_model" );
        $this->load->model("regional_office/regional_office_model");
        $this->load->model("district_name/district_name_model");
        $clName = get_class($this) . '_model';
        $this->load->model( $clName );
        $this->model = $this->{$clName};
	}
	function index()
	{
        $data = self::$arrDefData;
        $data['arrDataList']= $this->model->dbGetList();
        $this->template->my_template($data);
	}
	
    function create($emp_id = FALSE){

        $data = self::$arrDefData;
		$data['title'] = 'Requisition Form';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $this->load->model('vcd_municipality/vcd_municipality_model');
        $data['postURL'] = self::$fName."/create";
        $data['ajaxURL'] = base_url()."requisition/getState";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('id',$emp_id)->dbGetRecord();
            $data['postURL'] .= '/'.$emp_id;
        }
        $region = $this->session->userdata('region');

//        $data['organizations_list'] = $this->organization_model->dbGetList();
//        $data['suppliers_list'] = $this->supplier_model->dbGetList();
        $region = $this->session->userdata('region');
        $regionInfo = $this->regional_office_model->where('id',$region)->dbGetRecord();
        $regionCode = $regionInfo->region_code;
        $last_record = 1;
        $lastRecord = $this->model->order_by("id desc")->limit(1,0)->dbGetRecord();
        if($lastRecord){
            $last_record = $lastRecord->id+1;
        }

        $data['requisition_id'] = $regionCode."Ri-".date("Y").$last_record."D";

        $data['arrVDCList'] = $this->vcd_municipality_model->dbGetList();

		$this->form_validation->set_rules('requisition_id', '', 'required');
        $this->form_validation->set_rules('issued_for', '', 'required');
        $this->form_validation->set_rules('bridge_name', '', 'required');
        $this->form_validation->set_rules('district', '', 'required');
        $this->form_validation->set_rules('palika', '', 'required');
        //$this->form_validation->set_rules('bridge_no', '', 'required');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
            $this->template->my_template($data);
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			$form_data = array(
		       	'id' => $emp_id,
    	       	'req_id' => @$this->input->post('requisition_id'),
                'issued_for' => @$this->input->post('issued_for'),
                'bridge_name' => @$this->input->post('bridge_name'),
                'district' => @$this->input->post('district'),
                'palika' => @$this->input->post('palika'),
                'bridge_num' => @$this->input->post('bridge_num'),
                'region' => $region
  			);
					
			// run insert model to write data to db
            //var_dump( $this->model );
			if ($this->model->dbSave($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
    			set_message('Successfully created.', 'success');
    			//redirect(self::$fName, 'refresh');
                redirect('requisition/create', 'refresh');
			}
			else
			{
    			echo 'An error occurred saving your information. Please try again later';
	       		// Or whatever error handling is necessary
			}
		}
    }
    function delete()
	{
		$delete_id = $this->input->get('id');
		$this->supplier_model->where('id', $delete_id)->dbDelete();
        $message = 'Selected Data Deleted.';
        log_query($message);
        set_message($message, 'success');
		redirect('requisition');
	}

	function getState() {
        $dist_id = $this->input->get('dist_id');
        $dist_info =$this->district_name_model->where('dist_id', $dist_id)->dbGetRecord();
        echo $dist_info->dist_state;

    }
}
?>