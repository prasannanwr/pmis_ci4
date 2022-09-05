<?php
class Bridge_Designer extends MX_Controller {
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
        $data['arrDataList']= $this->model->dbGetList();
        $this->template->my_template($data);
	}
	
    function create($emp_id = FALSE){
        
        $data = self::$arrDefData;
		$data['title'] = 'Add Bridge Designer';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = self::$fName."/create";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('bdr01id',$emp_id )->dbGetRecord();
            $data['postURL'] .= '/'.$emp_id;
            //var_dump($data['postURL']);
        }

            $this->form_validation->set_rules('bdr01designer_id', 'bdr01designer_id', 'max_length[5]');			
    		$this->form_validation->set_rules('bdr01designer_name', 'bdr01designer_name', 'max_length[30]');			
    		$this->form_validation->set_rules('bdr01birth_date', 'bdr01birth_date', 'max_length[30]');			
    		$this->form_validation->set_rules('bdr01address', 'bdr01address', 'max_length[30]');			
    		$this->form_validation->set_rules('bdr01agency_id', 'bdr01agency_id', 'max_length[5]');			
    		$this->form_validation->set_rules('bdr01description', 'bdr01description', 'max_length[100]');			
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
            $this->template->my_template($data);
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			$form_data = array(
		       	'bdr01id' => $emp_id,
					       	'bdr01designer_id' => @$this->input->post('bdr01designer_id'),
					       	'bdr01designer_name' => @$this->input->post('bdr01designer_name'),
					       	'bdr01birth_date' => @$this->input->post('bdr01birth_date'),
					       	'bdr01address' => @$this->input->post('bdr01address'),
					       	'bdr01agency_id' => @$this->input->post('bdr01agency_id'),
					       	'bdr01description' => @$this->input->post('bdr01description')
  			);
					
			// run insert model to write data to db
            //var_dump( $this->model );
			if ($this->model->dbSave($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
    			set_message('Bridge Designer  successfully created.', 'success');
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
       //var_dump($_GET);
      
		$delete_id = $this->input->get('id');
        $this->load->model('bridge_designer_model');
          $this->bridge_designer_model->where('bdr01id', $delete_id)->dbDelete();
          
			$message = 'Selected Data Deleted.';
			log_query($message);
			set_message($message, 'success');
		
        
		redirect('bridge_designer');
	}
}
?>