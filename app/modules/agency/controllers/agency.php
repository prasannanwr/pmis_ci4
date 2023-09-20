<?php
class Agency extends MX_Controller {
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
        $data = self::$arrDefData;
        $data['arrDataList']= $this->model->dbGetList();
        $this->template->my_template($data);
	}
	
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Add Supplier';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = self::$fName."/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('supplier_id',$emp_id)->dbGetRecord();
            $data['postURL'] .= '/'.$emp_id;
        }

		$this->form_validation->set_rules('name', '', 'max_length[255]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
            $this->template->my_template($data);
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			$form_data = array(
		       	'supplier_id' => $emp_id,
    	       	'name' => @$this->input->post('name')
  			);
					
			// run insert model to write data to db
            //var_dump( $this->model );
			if ($this->model->dbSave($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
    			set_message('Supplier successfully created.', 'success');
    			redirect(self::$fName, 'refresh');
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
		$this->model->where('supplier_id', $delete_id)->dbDelete();
        $message = 'Selected Data Deleted.';
        log_query($message);
        set_message($message, 'success');
		redirect('supplier');
	}
}
?>