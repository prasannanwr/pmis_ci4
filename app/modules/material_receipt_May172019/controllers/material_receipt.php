<?php
class Material_receipt extends MX_Controller {
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
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model( "organization/organization_model" );
        $this->load->model( "supplier/supplier_model" );
        $this->load->model( "stock/stock_model" );
        $this->load->model("agency/agency_model");
        $this->load->model("regional_office/regional_office_model");
        $clName = get_class($this) . '_model';
        $this->load->model( $clName );
        $this->model = $this->{$clName};
        $this->isadmin = 0;
        if  ($this->session->userdata('type') == ENUM_ADMINISTRATOR) { $this->isadmin = 1;}

        $this->region = $this->session->userdata('region');

	}
	function index()
	{
        $data = self::$arrDefData;
       // $region = $this->session->userdata('region');
        $data['arrDataList']= $this->model->getOverallList($this->region);
        //var_dump($data['getOverallList']);exit;
        $this->template->my_template($data);
	}
	
    function create($emp_id = FALSE){        
        $data = self::$arrDefData;
		$data['title'] = 'Material Receipt Form';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = self::$fName."/create";
        $data['region'] = '';
        if ($this->isadmin != 1) {
            $regionInfo = $this->regional_office_model->where('id', $this->region)->dbGetRecord();
            $data['region'] = $regionInfo->region_code;
        }

        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('id',$emp_id)->dbGetRecord();
            $data['postURL'] .= '/'.$emp_id;
        }

        $data['organizations_list'] = $this->organization_model->dbGetList();
        $data['suppliers_list'] = $this->supplier_model->dbGetList();
        $data['agency_list'] = $this->supplier_model->dbGetList();
        $data['agency_list'] = $this->agency_model->dbGetList();
        //$data['diameter_list'] = $this->supplier_model->dbGetList();
        $data['last_record'] = 1;
        $last_record = $this->model->order_by("id desc")->limit(1,0)->dbGetRecord();
        if($last_record){
            $data['last_record'] = $last_record->id+1;
        }

        if ($this->isadmin == 1) {
            $this->form_validation->set_rules('region', '', 'required');
        }
		$this->form_validation->set_rules('type', '', 'required');
        $this->form_validation->set_rules('diameter', '', 'required');
        $this->form_validation->set_rules('input_id', '', 'required');
        $this->form_validation->set_rules('lot_no', '', 'required');
        $this->form_validation->set_rules('units', '', 'required');
        $this->form_validation->set_rules('receipt_date', '', 'required');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
            $this->template->my_template($data);
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
            if($this->session->userdata('rcid') != '') {                
                $rcid = $this->session->userdata('rcid');    
            } else {
                $incr_id = $last_record->id+1;
                $rcid = $regionInfo->region_code."RC"."-".date("Y").$incr_id;    
            }
            
            $inputid = @$this->input->post('input_id');
            $units = @$this->input->post('units');
            $lot = @$this->input->post('lot_no');
            $type = @$this->input->post('type');
            $diameter = @$this->input->post('diameter');
            $region = $this->region;
            if ($this->isadmin == 1) {
                $region_code = @$this->input->post('region');
                $regionInfo = $this->regional_office_model->where('region_code', $region_code)->dbGetRecord();
                $region = $regionInfo->id;
            }
			$form_data = array(
		       	'id' => $emp_id,
    	       	'type' => $type,
                'receipt_date' => @$this->input->post('receipt_date'),
                'diameter' => $diameter,
                'purchased_by' => @$this->input->post('purchased_by'),
                'supplier' => @$this->input->post('supplier'),
                'input_id' => $inputid,
                'lot' => $lot,
                'rcid' => $rcid,
                'rate' => @$this->input->post('rate'),
                'region' => $region,
                'units' => $units,
  			);
					
			// run insert model to write data to db
            //var_dump( $this->model );
			if ($this->model->dbSave($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
			    //update stock
			    $this->stock_model->updateStock($this->region,$type,$diameter,$units);
    			set_message('Successfully created.', 'success');
    			//redirect(self::$fName, 'refresh');

                if($this->input->post('btn_add_more')){                    
                    $this->session->set_userdata('rcid', $rcid);
                } else {
                    $this->session->unset_userdata('rcid');
                    redirect('material_receipt/index', 'refresh');
                }

                redirect('material_receipt/create', 'refresh');
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
		$this->supplier_model->where('supplier_id', $delete_id)->dbDelete();
        $message = 'Selected Data Deleted.';
        log_query($message);
        set_message($message, 'success');
		redirect('supplier');
	}


    function ajaxDataApplyWhere(){

        $gtc = @$this->input->get('columns');
        if(is_array( $gtc )){
            foreach( $gtc as $k=>$v){
                if( $v['search']['value'] !== ''){
                    $this->model->where( $v['data'], $v['search']['value']);
                }
            }
        }

        $search = $this->input->get('search');
        if($search['value']!=='' ){
            $this->model->or_like('typename',$search['value']);
            $this->model->or_like('lot',$search['value']);
            $this->model->or_like('diameter',$search['value']);
        }
    }
    function ajaxData(){
        //todo: check login, security
        /*
        echo 'Get: ';
        print_r( $_GET );
        echo 'Post: ';
        print_r( $_POST);
        die();
        */


        //todo: count total records and put the no here
        //Apply Where Condition for counting
        $this->ajaxDataApplyWhere();
        $total = count($this->model->where('region',$this->region)->dbGetList());

        //Apply Where condition for Data
        $this->ajaxDataApplyWhere();

        //Apply Limit for data
        $length = $this->input->get('length');
        $start  = $this->input->get('start');


        //for ordering
        //$arrColumns = array('bri03bridge_no', 'bri03bridge_name', 'bri03river_name', 'bri03design', 'dist01name', 'bri05bridge_complete', 'bri05bridge_complete_check', 'bri03construction_type');
        $arrColumns = array('id', 'receipt_date', 'typename', 'diametername', 'input_id', 'lot', 'units');
        $order = $this->input->get('order');
        // var_dump($order['0']['column']);
//        if( is_array( $order )){
//            $x = $order;
//            foreach($order as $k=>$v){
//                $this->model->order_by( $arrColumns [  $v['column']  ].' '.  $v['dir']  );
//            }
//        }else{
//            $this->model->order_by('id desc');
//            $x = false;
//        }
        $arrDataList = $this->model->limit($length, $start)->dbGetList();
        //$output['sql'] = $this->db->last_query();

        $output['draw']=$this->input->get('draw');
        $output['recordsTotal']=$total;
        $output['recordsFiltered']=$total;

        $output['data']=$arrDataList;
        //$output['debug']=$x;
        //$output['get'] = $_GET;
        //$output['post'] = $_POST;
        //var_dump($output['data']);

        echo json_encode( $output );
        die();
    }
}
?>