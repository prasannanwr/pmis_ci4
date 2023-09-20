<?php
class Material_issue extends MX_Controller {
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
        $this->load->model( "requisition/requisition_model" );
        $this->load->model( "material_receipt/material_receipt_model" );
        $this->load->model("regional_office/regional_office_model");
        $this->load->model( "stock/stock_model" );
        $clName = get_class($this) . '_model';
        $this->load->model( $clName );
        $this->model = $this->{$clName};
        $this->region = $this->session->userdata('region');
	}
	function index()
	{
        $data = self::$arrDefData;        
        $data['arrDataList']= $this->model->getOverallList($this->region);
        //var_dump($data['arrDataList']);exit;
        $this->template->my_template($data);
	}
	
    function create($emp_id = FALSE){
        $data = self::$arrDefData;
		$data['title'] = 'Material Issue Form';
        $data['view_file'] = __FUNCTION__;

        $data['objOldRec'] ='';
        $data['postURL'] = self::$fName."/create";
        $data['ajaxURL'] = base_url()."material_issue/getRequisitionInfo";
        $data['ajaxStockURL'] = base_url()."material_issue/getStockInfo";
        if( $emp_id !== false){
            $data['objOldRec'] = $this->model->where('id',$emp_id)->dbGetRecord();
            $data['postURL'] .= '/'.$emp_id;
        }        
        $regionInfo = $this->regional_office_model->where('id',$this->region)->dbGetRecord();
        $region_code = $regionInfo->region_code;
        $data['region'] = $this->region;

//        $data['organizations_list'] = $this->organization_model->dbGetList();
//        $data['suppliers_list'] = $this->supplier_model->dbGetList();

        $data['requisition_id'] = $region_code."Ri-".date("Y")."2D";

		$this->form_validation->set_rules('requisition_num', '', 'required');
        $this->form_validation->set_rules('lot', '', 'required');        
        $this->form_validation->set_rules('issued_date', '', 'required');
        $this->form_validation->set_rules('units', '', 'required');
        //$this->form_validation->set_rules('bridge_no', '', 'required');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
            $this->template->my_template($data);
		}
		else // passed validation proceed to post success logic
		{
		    $lot = @$this->input->post('lot');
		    $units = @$this->input->post('units');            
		    /* check stock */
            $available_units = $this->getStock($lot);            
            if($units <= $available_units) {
                // build array for the model
                $form_data = array(
                    'id' => $emp_id,
                    'requisition_num' => @$this->input->post('requisition_num'),
                    'lot' => $lot,
                    'issued_date' => @$this->input->post('issued_date'),
                    'units' => $units
                );

                // run insert model to write data to db
                //var_dump( $this->model );
                if ($this->model->dbSave($form_data) == TRUE) // the information has therefore been successfully saved in the db
                {
                    //update stock
                    $material_info = $this->material_receipt_model->where("id",$lot)->dbGetRecord();                                        
                    $this->stock_model->updateStock($this->region,$material_info->type,$material_info->diameter,$units,"sub");
                    set_message('Successfully created.', 'success');
                    //redirect(self::$fName, 'refresh');
                    redirect('material_issue/create', 'refresh');
                }
                else
                {
                    set_message('An error occurred saving your information. Please try again later', 'warning');
                    //redirect(self::$fName, 'refresh');
                    redirect('material_issue/create', 'refresh');
                }
            } else {
                set_message('The given units exceeds the available units in the inventory.', 'warning');
                //redirect(self::$fName, 'refresh');
                redirect('material_issue/create', 'refresh');

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

	function getRequisitionInfo() {
	    $requistion_num = $_GET['reqid'];
        $reqinfo = $this->requisition_model->requisitionInfo($requistion_num);
        $materialIssueinfo = $this->model->issueInfo($requistion_num);        
        $i = 1;
        $str = "";
        //var_dump($materialIssueinfo);exit;
        foreach ($materialIssueinfo as $material) {            
            $str .="<tr><td>$i</td>";
            $str .="<td>".$material->diametername."</td>";
            $str .="<td>".$material->units."</td>";
            if($material->type == "1"){
                $str .="<td>Bulldog grip</td>";
            } else {
                $str .="<td>Cable</td>";
            }
            $str .="</tr>";
            $i++;
        }
        //print_r($str);exit;
        echo json_encode(array("issued" => $reqinfo->name, "bridge" => $reqinfo->bridge_name, "issued_data" => $str));
    }

    function getStock($lot_num) {
        $receiptinfo = $this->material_receipt_model->where('id',$lot_num)->dbGetRecord();
        $issueinfo = $this->model->where('lot',$lot_num)->dbGetList();
        $purchased_stock = $receiptinfo->units;
        foreach ($issueinfo as $item) {
            $purchased_stock = $purchased_stock - $item->units;
        }
        return $purchased_stock;
    }

    function getStockInfo() {
        $lot_num = $_GET['lot'];
        $purchased_stock = $this->getStock($lot_num);
        echo "Available stock:".$purchased_stock;
    }
}
?>