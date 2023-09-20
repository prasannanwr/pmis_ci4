<?php  (defined('BASEPATH')) OR exit('No direct script access allowed');

class Reports extends MX_Controller
{
    private static $arrDefData = array();
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
		parent::__construct();
        if ( ! $this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}        
        
        $this->load->database();
 		$this->load->module('template');
        $clName = get_class($this) . '_model';
        //$this->load->model( 'bridge/bridge_model' );
        $this->isadmin = 0;
        if  ($this->session->userdata('type') == ENUM_ADMINISTRATOR) { $this->isadmin = 1;}

        $this->load->model( $clName );
        $this->model = $this->{$clName};
        $this->region = $this->session->userdata('region');
	}

	function index()
	{
		//check access
		//_check(array('org_view'), 'general', '', "You don't have permission to view Reports.", 'info', 'dashboard');
		$data = self::$arrDefData;
        $this->template->my_template($data);
	}   

    function receipt($ext = ''){
        $data = self::$arrDefData;
    	$data['view_file'] = __FUNCTION__;
        $this->load->model('material_receipt/material_receipt_model');
        if($this->isadmin == 1){
            $data['arrReceiptList'] = $this->material_receipt_model->getReceipts();
        } else {
            //$data['arrReceiptList'] = $this->material_receipt_model->where('region',$this->region)->dbGetList();
            $data['arrReceiptList'] = $this->material_receipt_model->getReceipts($this->region);
        }
        $data['major'] = $ext;
 		$this->template->my_template($data);        
    }

    function getReceiptByDate() {
        $receipt_date = @$this->input->get('receipt_date');
        $receipt_date = str_replace("/", "-", $receipt_date);
        //echo "date:".$receipt_date;exit;
        $this->load->model('material_receipt/material_receipt_model');
        if($this->isadmin == 1){
            $arrReceiptList = $this->material_receipt_model->getReceiptsByDate('',$receipt_date);
        } else {
            //$data['arrReceiptList'] = $this->material_receipt_model->where('region',$this->region)->dbGetList();
            $arrReceiptList = $this->material_receipt_model->getReceiptsByDate($this->region,$receipt_date);
        }
        //var_dump($arrReceiptList);exit;
        $options = '';
        foreach ($arrReceiptList as $receipt) {
            $options .= "<option value='".$receipt->rcid."'>".$receipt->rcid."</option>";
        }
        echo $options;
    }

    function receipt_report(){        
          
        $selReceipt = @$this->input->post('receipt_num');
        $data = self::$arrDefData;

        $data['view_file'] = __FUNCTION__;      
        $data['receipt_num'] = $selReceipt;  
        $data['material'] ='';
        $this->load->model('material_receipt/material_receipt_model');        
                       
        if($selReceipt!=''){                    
            //$data['arrReceiptInfo'] = $this->material_receipt_model->where('id', $selReceipt)->dbGetRecord();
            if($this->input->post('material')) {
                $material = $this->input->post('material');
                $data['material'] = $material;
            }
            if($this->input->post('material')) {
                $data['arrReceiptInfo'] = $this->material_receipt_model->getReceiptInfo($selReceipt,$material);
            } else {
                $data['arrReceiptInfo'] = $this->material_receipt_model->getReceiptInfo($selReceipt);
            }
            
            //var_dump( $data['arrReceiptInfo']);exit;
       }else{
            redirect("reports/receipt");   
        }
        $this->template->my_template($data);        
    }  

    function receipt_report_print(){        
          
        $selReceipt = @$this->input->post('receipt_num');
        $data = self::$arrDefData;

        $data['view_file'] = __FUNCTION__;   
        $data['receipt_num'] = $selReceipt;      
        $data['material'] ='';
        $this->load->model('material_receipt/material_receipt_model');        
                       
        if($selReceipt!=''){                    
            //$data['arrReceiptInfo'] = $this->material_receipt_model->where('id', $selReceipt)->dbGetRecord();
            if($this->input->post('material')) {
                $material = $this->input->post('material');
                $data['material'] = $material;
            }
            if($this->input->post('material')) {
                $data['arrReceiptInfo'] = $this->material_receipt_model->getReceiptInfo($selReceipt,$material);
            } else {
                $data['arrReceiptInfo'] = $this->material_receipt_model->getReceiptInfo($selReceipt);
            }
            
            //var_dump( $data['arrReceiptInfo']);exit;
       }else{
            redirect("reports/receipt");   
        }
        $this->template->print_template($data);
    }  

    function dakhila($ext = ''){
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_receipt/material_receipt_model');
        if($this->isadmin == 1) {
            $data['arrReceiptList'] = $this->material_receipt_model->getReceipts();
        } else {
            //$data['arrReceiptList'] = $this->material_receipt_model->where('region',$this->region)->dbGetList();
            $data['arrReceiptList'] = $this->material_receipt_model->getReceipts($this->region);
        }            
        $data['major'] = $ext;
        $this->template->my_template($data);        
    }

    function dakhila_report(){        
          
        $selReceipt = @$this->input->post('receipt_num');
        $data = self::$arrDefData;

        $data['view_file'] = __FUNCTION__;  
        $data['receipt_num'] = $selReceipt;      
        $this->load->model('material_receipt/material_receipt_model');        
                       
        if($selReceipt!=''){                    
            //$data['arrReceiptInfo'] = $this->material_receipt_model->where('id', $selReceipt)->dbGetRecord();
            $data['arrReceiptInfo'] = $this->material_receipt_model->getReceiptInfo($selReceipt);
            //var_dump( $data['arrReceiptInfo']);exit;
       }else{
            redirect("reports/dakhila");   
        }
        $this->template->print_template($data);
    }  


    function delivery_note($ext = ''){
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_issue/material_issue_model');
        if($this->isadmin == 1)
            $data['arrReceiptList'] = $this->material_issue_model->getIssuedList();
        else
            $data['arrReceiptList'] = $this->material_issue_model->getIssuedList($this->region);
        $data['major'] = $ext;
        $this->template->my_template($data);        
    }

    public function bridge_search(){
        $this->load->model('requisition/requisition_model'); 
        //echo $this->input->get('bridge_name');exit;
        if($this->input->get('bridge_name')){
            $result = $this->requisition_model->like('bridge_name',$this->input->get('bridge_name'))->dbGetList();
            if(count($result)>0){
                //var_dump($result);exit;
                foreach($result as $object)
                    $arr_result[] = $object->bridge_name;

                echo json_encode($arr_result);
            }
        }
    }

    function delivery_note_report(){        
          
        $selReceipt = (int)@$this->input->post('receipt_num');
        $selBridge = (int)@$this->input->post('bridge_name');
        $data = self::$arrDefData;

        $data['view_file'] = __FUNCTION__;   
        $data['material'] ='';            
        $this->load->model('material_issue/material_issue_model'); 

        if($this->input->post('material')) {
            $selReceipt = $this->input->post('receipt_number');
            $material = $this->input->post('material');
            $data['material'] = $material;
        }
        $data['receipt_num'] = $selReceipt;        
                       
        if($selReceipt!=0){                    
            //$data['arrReceiptInfo'] = $this->material_receipt_model->where('id', $selReceipt)->dbGetRecord();
            if($this->input->post('material')) {
                $data['arrReceiptItems'] = $this->material_issue_model->issueInfo($selReceipt,$material);
            } else {
                $data['arrReceiptItems'] = $this->material_issue_model->issueInfo($selReceipt);
            }
            $data['receiptInfo'] = $this->material_issue_model->issueDetail($selReceipt);            
            
       }else{
            redirect("reports/delivery_note");   
        }
        $this->template->my_template($data);
    }   

    function delivery_note_report_print(){        
          
        $selReceipt = (int)@$this->input->post('receipt_num');
        $data = self::$arrDefData;

        $data['view_file'] = __FUNCTION__;        
        $this->load->model('material_issue/material_issue_model');             
                       
        if($selReceipt!=0){                    
            //$data['arrReceiptInfo'] = $this->material_receipt_model->where('id', $selReceipt)->dbGetRecord();
            $data['receiptInfo'] = $this->material_issue_model->issueDetail($selReceipt);            
            if($this->input->post('material') != '') {            
                $data['arrReceiptItems'] = $this->material_issue_model->issueInfo($selReceipt,$this->input->post('material'));
            } else {
                $data['arrReceiptItems'] = $this->material_issue_model->issueInfo($selReceipt);
            }            
            
       }else{
            redirect("reports/delivery_note");   
        }
        $this->template->print_template($data);
    }  

    function handover($ext = ''){
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_issue/material_issue_model');
        if($this->isadmin == 1)
            $data['arrReceiptList'] = $this->material_issue_model->getIssuedList();
        else
            $data['arrReceiptList'] = $this->material_issue_model->getIssuedList($this->region);
        $data['major'] = $ext;
        $this->template->my_template($data);        
    }

    function handover_report(){        
          
        $selReceipt = (int)@$this->input->post('receipt_num');
        $data = self::$arrDefData;

        $data['view_file'] = __FUNCTION__;        
        $this->load->model('material_issue/material_issue_model');        
                       
        if($selReceipt!=0){                    
            //$data['arrReceiptInfo'] = $this->material_receipt_model->where('id', $selReceipt)->dbGetRecord();
            $data['receiptInfo'] = $this->material_issue_model->issueDetail($selReceipt);
            $data['arrReceiptItems'] = $this->material_issue_model->issueInfo($selReceipt);
            
       }else{
            redirect("reports/delivery_note");   
        }
        $this->template->print_template($data);
    }

    function sbd_cable_ledger(){
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_receipt/material_receipt_model');
        $this->load->model('material_issue/material_issue_model');

        if($this->isadmin == 1)
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_CABLE,GON);
        else
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_CABLE,GON,$this->region);
        $arrDiameter = array();
        foreach ($diameter_received as $value) {
            $diameter = $value->diameter;
            //$arrDiameter[] = $diameter;
            if($this->isadmin == 1)
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_CABLE,$diameter,GON);
            else
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_CABLE,$diameter,GON,$this->region);
            $arrIssueList = array();
            foreach ($arrReceiptList as $receiptInfo) {
               $issueList = $this->material_issue_model->getIssueList($receiptInfo->id);
               $arrIssueList[] = array('data' => $receiptInfo,'listing' => $issueList);

            }
            //var_dump($arrIssueList);exit;
            $arrDiameter[$diameter] = $arrIssueList;
        } 

       // var_dump($arrDiameter);exit;
        
        $data['arrCableList'] = $arrDiameter;
        $this->template->my_template($data);
    }

    function sbd_cable_ledger_print(){
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_receipt/material_receipt_model');
        $this->load->model('material_issue/material_issue_model');
        if($this->isadmin == 1)
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_CABLE,GON);
        else
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_CABLE,GON,$this->region);
        $arrDiameter = array();     
        foreach ($diameter_received as $value) {
            $diameter = $value->diameter;
            //$arrDiameter[] = $diameter;
            if($this->isadmin == 1)
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_CABLE,$diameter,GON);
            else
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_CABLE,$diameter,GON,$this->region);
            $arrIssueList = array();
            foreach ($arrReceiptList as $receiptInfo) {
               $issueList = $this->material_issue_model->getIssueList($receiptInfo->id);
               $arrIssueList[] = array('data' => $receiptInfo,'listing' => $issueList);

            }
            //var_dump($arrIssueList);exit;
            $arrDiameter[$diameter] = $arrIssueList;
        } 

       // var_dump($arrDiameter);exit;
        
        $data['arrCableList'] = $arrDiameter;
        $this->template->print_template($data);
    }

    function sdc_cable_ledger(){
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_receipt/material_receipt_model');
        $this->load->model('material_issue/material_issue_model');

        if($this->isadmin == 1)
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_CABLE,SDC);
        else
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_CABLE,SDC,$this->region);
        $arrDiameter = array();     
        foreach ($diameter_received as $value) {
            $diameter = $value->diameter;
            //$arrDiameter[] = $diameter;
            if($this->isadmin == 1)
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_CABLE,$diameter,SDC);
            else
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_CABLE,$diameter,SDC,$this->region);
            $arrIssueList = array();
            foreach ($arrReceiptList as $receiptInfo) {
               $issueList = $this->material_issue_model->getIssueList($receiptInfo->id);
               $arrIssueList[] = array('data' => $receiptInfo,'listing' => $issueList);

            }
            //var_dump($arrIssueList);exit;
            $arrDiameter[$diameter] = $arrIssueList;
        } 

       // var_dump($arrDiameter);exit;
        
        $data['arrCableList'] = $arrDiameter;
        $this->template->my_template($data);
    }

    function sdc_cable_ledger_print(){
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_receipt/material_receipt_model');
        $this->load->model('material_issue/material_issue_model');

        if($this->isadmin == 1)
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_CABLE,SDC);
        else
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_CABLE,SDC,$this->region);
        $arrDiameter = array();
        foreach ($diameter_received as $value) {
            $diameter = $value->diameter;
            //$arrDiameter[] = $diameter;
            if($this->isadmin == 1)
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_CABLE,$diameter,SDC);
            else
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_CABLE,$diameter,SDC,$this->region);
            $arrIssueList = array();
            foreach ($arrReceiptList as $receiptInfo) {
                $issueList = $this->material_issue_model->getIssueList($receiptInfo->id);
                $arrIssueList[] = array('data' => $receiptInfo,'listing' => $issueList);

            }
            //var_dump($arrIssueList);exit;
            $arrDiameter[$diameter] = $arrIssueList;
        }

        // var_dump($arrDiameter);exit;
        
        $data['arrCableList'] = $arrDiameter;
        $this->template->print_template($data);
    }

    function sbd_bulldog_ledger(){
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_receipt/material_receipt_model');
        $this->load->model('material_issue/material_issue_model');

        if($this->isadmin == 1)
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_BULLDOG,GON);
        else
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_BULLDOG,GON,$this->region);
        $arrDiameter = array();     
        foreach ($diameter_received as $value) {
            $diameter = $value->diameter;
            //$arrDiameter[] = $diameter;            
            if($this->isadmin == 1)
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_BULLDOG,$diameter,GON);
            else
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_BULLDOG,$diameter,GON,$this->region);
            $arrIssueList = array();
            foreach ($arrReceiptList as $receiptInfo) {
               $issueList = $this->material_issue_model->getIssueList($receiptInfo->id);
               $arrIssueList[] = array('data' => $receiptInfo,'listing' => $issueList);

            }
            //var_dump($arrIssueList);exit;
            $arrDiameter[$diameter] = $arrIssueList;
        } 

       // var_dump($arrDiameter);exit;
        
        $data['arrCableList'] = $arrDiameter;
        $this->template->my_template($data);
    }

    function sbd_bulldog_ledger_print(){
       $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_receipt/material_receipt_model');
        $this->load->model('material_issue/material_issue_model');

        if($this->isadmin == 1)
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_BULLDOG,GON);
        else 
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_BULLDOG,GON,$this->region);
        $arrDiameter = array();     
        foreach ($diameter_received as $value) {
            $diameter = $value->diameter;
            //$arrDiameter[] = $diameter;     
            if($this->isadmin == 1)       
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_BULLDOG,$diameter,GON);
            else
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_BULLDOG,$diameter,GON,$this->region);
            $arrIssueList = array();
            foreach ($arrReceiptList as $receiptInfo) {
               $issueList = $this->material_issue_model->getIssueList($receiptInfo->id);
               $arrIssueList[] = array('data' => $receiptInfo,'listing' => $issueList);

            }
            //var_dump($arrIssueList);exit;
            $arrDiameter[$diameter] = $arrIssueList;
        } 

       // var_dump($arrDiameter);exit;
        
        $data['arrCableList'] = $arrDiameter;
        $this->template->print_template($data);
    }

    function sdc_bulldog_ledger(){
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_receipt/material_receipt_model');
        $this->load->model('material_issue/material_issue_model');

        if($this->isadmin == 1)
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_BULLDOG,SDC);
        else 
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_BULLDOG,SDC,$this->region);
        $arrDiameter = array();
        foreach ($diameter_received as $value) {
            $diameter = $value->diameter;
            //$arrDiameter[] = $diameter;
            if($this->isadmin == 1)
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_BULLDOG,$diameter,SDC);
            else
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_BULLDOG,$diameter,SDC,$this->region);
            $arrIssueList = array();
            foreach ($arrReceiptList as $receiptInfo) {
                $issueList = $this->material_issue_model->getIssueList($receiptInfo->id);
                $arrIssueList[] = array('data' => $receiptInfo,'listing' => $issueList);

            }
            //var_dump($arrIssueList);exit;
            $arrDiameter[$diameter] = $arrIssueList;
        }

        // var_dump($arrDiameter);exit;

        $data['arrCableList'] = $arrDiameter;
        $this->template->my_template($data);
    }

    function sdc_bulldog_ledger_print(){
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_receipt/material_receipt_model');
        $this->load->model('material_issue/material_issue_model');

        if($this->isadmin == 1)
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_BULLDOG,SDC);
        else 
            $diameter_received = $this->material_receipt_model->getByDiameterReceipt(TYPE_BULLDOG,SDC,$this->region);
        $arrDiameter = array();
        foreach ($diameter_received as $value) {
            $diameter = $value->diameter;
            //$arrDiameter[] = $diameter;
            if($this->isadmin == 1)
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_BULLDOG,$diameter,SDC);
            else
                $arrReceiptList = $this->material_receipt_model->getList(TYPE_BULLDOG,$diameter,SDC,$this->region);
            $arrIssueList = array();
            foreach ($arrReceiptList as $receiptInfo) {
                $issueList = $this->material_issue_model->getIssueList($receiptInfo->id);
                $arrIssueList[] = array('data' => $receiptInfo,'listing' => $issueList);

            }
            //var_dump($arrIssueList);exit;
            $arrDiameter[$diameter] = $arrIssueList;
        }

        // var_dump($arrDiameter);exit;

        $data['arrCableList'] = $arrDiameter;
        $this->template->print_template($data);
    }

    function org_wise_cable_issue() {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('organization/organization_model');
        $data['arrOrganizationList'] = $this->organization_model->dbGetList();
        $this->template->my_template($data);
    }


    function org_wise_cable_issue_report(){

        $selOrganization = (int)@$this->input->post('organization');
        $data = self::$arrDefData;

        $data['view_file'] = __FUNCTION__;
        $data['organization'] = $selOrganization;
        $this->load->model('material_issue/material_issue_model');
        $this->load->model('organization/organization_model');
        $organizationInfo = $this->organization_model->where('organization_id',$selOrganization)->dbGetRecord();
        $data['organization_name'] = $organizationInfo->name;
        if($selOrganization!=0){
            //$data['arrReceiptInfo'] = $this->material_receipt_model->where('id', $selReceipt)->dbGetRecord();
            if($this->isadmin == 1) {
                $data['orgInfo'] = $this->material_issue_model->getIssueByOrganization($selOrganization,TYPE_CABLE);
                $data['diameterTotal'] = $this->material_issue_model->totalUnitsByOrganization($selOrganization,TYPE_CABLE);
            }
            else {
                $data['orgInfo'] = $this->material_issue_model->getIssueByOrganization($selOrganization,TYPE_CABLE,$this->region);
                $data['diameterTotal'] = $this->material_issue_model->totalUnitsByOrganization($selOrganization,TYPE_CABLE,$this->region);
            }

        }else{
            redirect("reports/org_wise_cable_issue");
        }
        $this->template->my_template($data);
    }

    function org_wise_cable_issue_report_print(){

        $selOrganization = (int)@$this->input->post('organization');
        $data = self::$arrDefData;

        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_issue/material_issue_model');
        $this->load->model('organization/organization_model');
        $organizationInfo = $this->organization_model->where('organization_id',$selOrganization)->dbGetRecord();
        $data['organization_name'] = $organizationInfo->name;

        if($selOrganization!=0){
            //$data['arrReceiptInfo'] = $this->material_receipt_model->where('id', $selReceipt)->dbGetRecord();
            // if($this->isadmin == 1)
            //     $data['orgInfo'] = $this->material_issue_model->getIssueByOrganization($selOrganization,TYPE_CABLE);
            // else 
            //     $data['orgInfo'] = $this->material_issue_model->getIssueByOrganization($selOrganization,TYPE_CABLE,$this->region);

            if($this->isadmin == 1) {
                $data['orgInfo'] = $this->material_issue_model->getIssueByOrganization($selOrganization,TYPE_CABLE);
                $data['diameterTotal'] = $this->material_issue_model->totalUnitsByOrganization($selOrganization,TYPE_CABLE);
            }
            else {
                $data['orgInfo'] = $this->material_issue_model->getIssueByOrganization($selOrganization,TYPE_CABLE,$this->region);
                $data['diameterTotal'] = $this->material_issue_model->totalUnitsByOrganization($selOrganization,TYPE_CABLE,$this->region);
            }
            
            //var_dump( $data['arrReceiptInfo']);exit;
        }else{
            redirect("reports/org_wise_cable_issue");
        }
        $this->template->print_template($data);
    }

    function org_wise_bulldog_issue() {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('organization/organization_model');
        $data['arrOrganizationList'] = $this->organization_model->dbGetList();
        $this->template->my_template($data);
    }


    function org_wise_bulldog_issue_report(){

        $selOrganization = (int)@$this->input->post('organization');
        $data = self::$arrDefData;

        $data['view_file'] = __FUNCTION__;
        $data['organization'] = $selOrganization;
        $this->load->model('material_issue/material_issue_model');
        $this->load->model('organization/organization_model');
        $organizationInfo = $this->organization_model->where('organization_id',$selOrganization)->dbGetRecord();
        $data['organization_name'] = $organizationInfo->name;

        if($selOrganization!=0){
            //$data['arrReceiptInfo'] = $this->material_receipt_model->where('id', $selReceipt)->dbGetRecord();
           /* if($this->isadmin == 1)
                $data['orgInfo'] = $this->material_issue_model->getIssueByOrganization($selOrganization,TYPE_BULLDOG);
            else
                $data['orgInfo'] = $this->material_issue_model->getIssueByOrganization($selOrganization,TYPE_BULLDOG,$this->region);*/

            if($this->isadmin == 1) {
                $data['orgInfo'] = $this->material_issue_model->getIssueByOrganization($selOrganization,TYPE_BULLDOG);
                $data['diameterTotal'] = $this->material_issue_model->totalUnitsByOrganization($selOrganization,TYPE_BULLDOG);
            }
            else {
                $data['orgInfo'] = $this->material_issue_model->getIssueByOrganization($selOrganization,TYPE_BULLDOG,$this->region);
                $data['diameterTotal'] = $this->material_issue_model->totalUnitsByOrganization($selOrganization,TYPE_BULLDOG,$this->region);
            }

            //var_dump( $data['arrReceiptInfo']);exit;
        }else{
            redirect("reports/org_wise_bulldog_issue");
        }
        $this->template->my_template($data);
    }

    function org_wise_bulldog_issue_report_print(){

        $selOrganization = (int)@$this->input->post('organization');
        $data = self::$arrDefData;

        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_issue/material_issue_model');
        $this->load->model('organization/organization_model');
        $organizationInfo = $this->organization_model->where('organization_id',$selOrganization)->dbGetRecord();
        $data['organization_name'] = $organizationInfo->name;

        if($selOrganization!=0){
            //$data['arrReceiptInfo'] = $this->material_receipt_model->where('id', $selReceipt)->dbGetRecord();
            // if($this->isadmin == 1)
            //     $data['orgInfo'] = $this->material_issue_model->getIssueByOrganization($selOrganization,TYPE_BULLDOG);
            // else 
            //     $data['orgInfo'] = $this->material_issue_model->getIssueByOrganization($selOrganization,TYPE_BULLDOG,$this->region);

            if($this->isadmin == 1) {
                $data['orgInfo'] = $this->material_issue_model->getIssueByOrganization($selOrganization,TYPE_BULLDOG);
                $data['diameterTotal'] = $this->material_issue_model->totalUnitsByOrganization($selOrganization,TYPE_BULLDOG);
            }
            else {
                $data['orgInfo'] = $this->material_issue_model->getIssueByOrganization($selOrganization,TYPE_BULLDOG,$this->region);
                $data['diameterTotal'] = $this->material_issue_model->totalUnitsByOrganization($selOrganization,TYPE_BULLDOG,$this->region);
            }
            //var_dump( $data['arrReceiptInfo']);exit;
        }else{
            redirect("reports/org_wise_bulldog_issue");
        }
        $this->template->print_template($data);
    }

    function overall_cable_issue() {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_issue/material_issue_model');

        //$orgInfo = $this->material_issue_model->getIssuedOrganizationList(TYPE_CABLE);
//        $arrOverallList = array();
//        foreach($orgInfo as $item) {
//            $organization = $item->organization_id;
//            $issueInfo = $this->material_issue_model->totalUnitsByOrganization($organization, TYPE_CABLE);
//            $arrOverallList[] = array('name' => $item->organization_name , "detail" => $issueInfo);
//        }
        if($this->isadmin == 1)
            $orgInfo = $this->material_issue_model->totalUnitsOrganization(TYPE_CABLE);
        else
            $orgInfo = $this->material_issue_model->totalUnitsOrganization(TYPE_CABLE,$this->region);

        $data['arrOverallList'] = $orgInfo;

        $this->template->my_template($data);

    }

    function overall_cable_issue_print() {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_issue/material_issue_model');
        if($this->isadmin == 1)
            $orgInfo = $this->material_issue_model->totalUnitsOrganization(TYPE_CABLE);
        else
            $orgInfo = $this->material_issue_model->totalUnitsOrganization(TYPE_CABLE,$this->region);

        $data['arrOverallList'] = $orgInfo;
        $this->template->print_template($data);

    }

    function overall_bulldog_issue() {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_issue/material_issue_model');
        $this->load->model('material_receipt/material_receipt_model');
        
        /* old from stock table
        if($this->isadmin == 1)
            $orgInfo = $this->material_issue_model->totalUnitsOrganization(TYPE_BULLDOG);
        else
            $orgInfo = $this->material_issue_model->totalUnitsOrganization(TYPE_BULLDOG,$this->region);
        $data['arrOverallList'] = $orgInfo;
        */

        // new updated
        // $arrStockList = array();
        // if($this->isadmin == 1)
        //     $arrMTotal = $this->material_receipt_model->getTotalMaterial(TYPE_BULLDOG);
        // else
        //     $arrMTotal = $this->material_receipt_model->getTotalMaterial(TYPE_BULLDOG,$this->region);
        
        // foreach ($arrMTotal as $total) {
        //     $diameter = $total->diameter;
        //     $totalreceipt = $total->totalunits;
        //     $issueList = $this->material_issue_model->totalUnitsPerDiameter(TYPE_BULLDOG, $diameter, $this->region);
        //     $totalissue = $issueList[0]->total_issue;
        //     $diametername = $issueList[0]->diametername;
        //     $stock = $totalreceipt - $totalissue;
        //     $stockarr = array("diameter" => $diametername, "stock" => $stock);
        //     array_push($arrStockList, $stockarr);
        // }
        //$data['arrOverallList'] = $orgInfo;

        if($this->isadmin == 1)
            $orgInfo = $this->material_issue_model->totalUnitsOrganization(TYPE_BULLDOG);
        else
            $orgInfo = $this->material_issue_model->totalUnitsOrganization(TYPE_BULLDOG,$this->region);

        $data['arrOverallList'] = $orgInfo;

        $this->template->my_template($data);

    }

    function overall_bulldog_issue_print() {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_issue/material_issue_model');

        /*
        if($this->isadmin == 1)
            $orgInfo = $this->material_issue_model->totalUnitsOrganization(TYPE_BULLDOG);
        else
            $orgInfo = $this->material_issue_model->totalUnitsOrganization(TYPE_BULLDOG,$this->region);
        
        $data['arrOverallList'] = $orgInfo;
        */

       if($this->isadmin == 1)
            $orgInfo = $this->material_issue_model->totalUnitsOrganization(TYPE_BULLDOG);
        else
            $orgInfo = $this->material_issue_model->totalUnitsOrganization(TYPE_BULLDOG,$this->region);

        $data['arrOverallList'] = $orgInfo;
        
        $this->template->print_template($data);

    }

    function overall_cable_stock() {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_issue/material_issue_model');
        $this->load->model('material_receipt/material_receipt_model');     

        /* old one from stock table 
        if($this->isadmin == 1)
            $orgInfo = $this->material_issue_model->totalUnitsDiameter(TYPE_CABLE);
        else
            $orgInfo = $this->material_issue_model->totalUnitsDiameter(TYPE_CABLE,'',$this->region);
            */

        // new updated
        $arrStockList = array();
        if($this->isadmin == 1)
            $arrMTotal = $this->material_receipt_model->getTotalMaterial(TYPE_CABLE);
        else
            $arrMTotal = $this->material_receipt_model->getTotalMaterial(TYPE_CABLE,$this->region);
        
        foreach ($arrMTotal as $total) {
            $diameter = $total->diameter;
            $totalreceipt = $total->totalunits;
            $issueList = $this->material_issue_model->totalUnitsPerDiameter(TYPE_CABLE, $diameter, $this->region);
            $totalissue = $issueList[0]->total_issue;
            $diametername = $issueList[0]->diametername;
            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "stock" => $stock);
            array_push($arrStockList, $stockarr);
        }
        //$data['arrOverallList'] = $orgInfo;
        $data['arrOverallList'] = $arrStockList;

        $this->template->my_template($data);

    }

    function overall_cable_stock_print() {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_issue/material_issue_model');  
        $this->load->model('material_receipt/material_receipt_model');     
        /* old one from stock table      
        if($this->isadmin == 1)
            $orgInfo = $this->material_issue_model->totalUnitsDiameter(TYPE_CABLE);
        else
            $orgInfo = $this->material_issue_model->totalUnitsDiameter(TYPE_CABLE,'',$this->region);
        $data['arrOverallList'] = $orgInfo;

        $this->template->print_template($data);
        */

        // new updated
        $arrStockList = array();
        if($this->isadmin == 1)
            $arrMTotal = $this->material_receipt_model->getTotalMaterial(TYPE_CABLE);
        else
            $arrMTotal = $this->material_receipt_model->getTotalMaterial(TYPE_CABLE,$this->region);
        
        foreach ($arrMTotal as $total) {
            $diameter = $total->diameter;
            $totalreceipt = $total->totalunits;
            $issueList = $this->material_issue_model->totalUnitsPerDiameter(TYPE_CABLE, $diameter, $this->region);
            $totalissue = $issueList[0]->total_issue;
            $diametername = $issueList[0]->diametername;
            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "stock" => $stock);
            array_push($arrStockList, $stockarr);
        }
        //$data['arrOverallList'] = $orgInfo;
        $data['arrOverallList'] = $arrStockList;

    }

    function overall_bulldog_stock() {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_issue/material_issue_model'); 
        $this->load->model('material_receipt/material_receipt_model');            
        /*if($this->isadmin == 1)
            $orgInfo = $this->material_issue_model->totalUnitsDiameter(TYPE_BULLDOG);
        else
            $orgInfo = $this->material_issue_model->totalUnitsDiameter(TYPE_BULLDOG,'',$this->region);
        $data['arrOverallList'] = $orgInfo;
        */

         // new updated
        $arrStockList = array();
        if($this->isadmin == 1)
            $arrMTotal = $this->material_receipt_model->getTotalMaterial(TYPE_BULLDOG);
        else
            $arrMTotal = $this->material_receipt_model->getTotalMaterial(TYPE_BULLDOG,$this->region);
        
        foreach ($arrMTotal as $total) {
            $diameter = $total->diameter;
            $totalreceipt = $total->totalunits;
            $issueList = $this->material_issue_model->totalUnitsPerDiameter(TYPE_BULLDOG, $diameter, $this->region);
            $totalissue = $issueList[0]->total_issue;
            $diametername = $issueList[0]->diametername;
            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "stock" => $stock);
            array_push($arrStockList, $stockarr);
        }
        $data['arrOverallList'] = $arrStockList;

        $this->template->my_template($data);

    }

    function overall_bulldog_stock_print() {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('material_issue/material_issue_model'); 
        $this->load->model('material_receipt/material_receipt_model');       
        /*if($this->isadmin == 1)
            $orgInfo = $this->material_issue_model->totalUnitsDiameter(TYPE_BULLDOG);
        else
            $orgInfo = $this->material_issue_model->totalUnitsDiameter(TYPE_BULLDOG,'',$this->region);
        $data['arrOverallList'] = $orgInfo;*/

         // new updated
        $arrStockList = array();
        if($this->isadmin == 1)
            $arrMTotal = $this->material_receipt_model->getTotalMaterial(TYPE_BULLDOG);
        else
            $arrMTotal = $this->material_receipt_model->getTotalMaterial(TYPE_BULLDOG,$this->region);
        
        foreach ($arrMTotal as $total) {
            $diameter = $total->diameter;
            $totalreceipt = $total->totalunits;
            $issueList = $this->material_issue_model->totalUnitsPerDiameter(TYPE_BULLDOG, $diameter, $this->region);
            $totalissue = $issueList[0]->total_issue;
            $diametername = $issueList[0]->diametername;
            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "stock" => $stock);
            array_push($arrStockList, $stockarr);
        }


        $this->template->print_template($data);

    }

    function overall_stock_dmwise($agency=1) { //GON

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['agency'] = $agency;
        $this->load->model('material_issue/material_issue_model');
        $this->load->model('material_receipt/material_receipt_model');
        /*if($this->isadmin == 1)
            $orgInfo = $this->material_issue_model->totalUnitsDiameter(TYPE_CABLE,$agency);
        else
            $orgInfo = $this->material_issue_model->totalUnitsDiameter(TYPE_CABLE,$agency, $this->region);*/

         // new updated
        $arrStockList = array();
        if($this->isadmin == 1)
            $arrMTotal = $this->material_receipt_model->getTotalMaterial(TYPE_CABLE,'',$agency);
        else
            $arrMTotal = $this->material_receipt_model->getTotalMaterial(TYPE_CABLE,$this->region,$agency);

        foreach ($arrMTotal as $total) {
            $diameter = $total->diameter;
            $totalreceipt = $total->totalunits;
            $totalissue = 0;
            $issueList = $this->material_issue_model->totalUnitsPerDiameter(TYPE_CABLE, $diameter, $this->region, $agency);
            if($issueList) {
                $totalissue = $issueList[0]->total_issue;
            }
            $diametername = $total->diameter_name;
            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "stock" => $stock);
            array_push($arrStockList, $stockarr);
        }

        $data['arrOverallList'] = $arrStockList;

        $this->template->my_template($data);

    }

    function overall_stock_dmwise_print($agency=1) {       
        
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['agency'] = $agency;
        $this->load->model('material_issue/material_issue_model');
        $this->load->model('material_receipt/material_receipt_model');

         // new updated
        $arrStockList = array();
        if($this->isadmin == 1)
            $arrMTotal = $this->material_receipt_model->getTotalMaterial(TYPE_CABLE,'',$agency);
        else
            $arrMTotal = $this->material_receipt_model->getTotalMaterial(TYPE_CABLE,$this->region,$agency);

        foreach ($arrMTotal as $total) {
            $diameter = $total->diameter;
            $totalreceipt = $total->totalunits;
            $totalissue = 0;
            $issueList = $this->material_issue_model->totalUnitsPerDiameter(TYPE_CABLE, $diameter, $this->region, $agency);
            if($issueList) {
                $totalissue = $issueList[0]->total_issue;
            }
            $diametername = $total->diameter_name;
            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "stock" => $stock);
            array_push($arrStockList, $stockarr);
        }

        $data['arrOverallList'] = $arrStockList;

        $this->template->my_template($data);

    }

    function overall_stock_reelno_wise($agency=GON) {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['agency'] = $agency;
        // $this->load->model('material_issue/material_issue_model');        
        // if($this->isadmin == 1)
        //     $orgInfo = $this->material_issue_model->totalUnitsReelno(TYPE_CABLE,$agency);
        // else            
        //     $orgInfo = $this->material_issue_model->totalUnitsReelno(TYPE_CABLE,$agency, $this->region);
        // $data['arrOverallList'] = $orgInfo;
        $data['region'] = '';
        if ($agency == 1) {
            $data['agency_name'] = "GoN";
        } else {
            $data['agency_name'] = "SDC";
        }
        $arrStockList = array();

        $this->load->model('material_issue/material_issue_model');
        $this->load->model('regional_office/regional_office_model');
        if ($this->isadmin == 1) {
            $region = 'DEFAULT_REGION';
            $data['region']= $this->input->post('region');
            if($this->input->post('region')) { $region = $this->input->post('region');}
            if($this->isadmin == 1) {
                $orgInfo = $this->material_issue_model->totalUnitsReelno(TYPE_CABLE, $agency);
            } else {
                $orgInfo = $this->material_issue_model->totalUnitsReelno(TYPE_CABLE, $agency, $region);
            }
            
            $regionalOffice = $this->regional_office_model->where('id', $region)->dbGetRecord();
        } else {
            $orgInfo = $this->material_issue_model->totalUnitsReelno(TYPE_CABLE, $agency, $this->region);
            $regionalOffice = $this->regional_office_model->where('id', $this->region)->dbGetRecord();
        }

        
        if(isset($regionalOffice->region_name))
            $data['region_name'] = $regionalOffice->region_name;
        else
            $data['region_name'] = '';

        $totalreceipt = 0;
        $totalissue = 0;
        foreach ($orgInfo as $total) {
            $totalreceipt = 0;
            $totalissue = 0;
            $diametername = $total->diametername;
            $totalreceipt = $totalreceipt + $total->total_receipt;

            $issueList = $this->material_issue_model->totalIssueLot($total->id);
            $totalissue = $totalissue + $issueList[0]->total_issue;


            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "lot" => $total->lot ,"stock" => $stock, "regionalOffice" => $regionalOffice);
            array_push($arrStockList, $stockarr);
            //var_dump($stockarr);exit;
        }

        //$data['arrOverallList'] = $orgInfo;
        $data['arrOverallList'] = $arrStockList;


        $this->template->my_template($data);

    }

    function overall_stock_reelno_wise_print($agency=GON) {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['agency'] = $agency;
        $data['region'] = '';
        if ($agency == 1) {
            $data['agency_name'] = "GoN";
        } else {
            $data['agency_name'] = "SDC";
        }
        $arrStockList = array();

        $this->load->model('material_issue/material_issue_model');
        $this->load->model('regional_office/regional_office_model');
        if ($this->isadmin == 1) {
            $region = 'DEFAULT_REGION';
            $data['region']= $this->input->post('region');
            if($this->input->post('region')) { $region = $this->input->post('region');}
            if($this->isadmin == 1) {
                $orgInfo = $this->material_issue_model->totalUnitsReelno(TYPE_CABLE, $agency);
            } else {
                $orgInfo = $this->material_issue_model->totalUnitsReelno(TYPE_CABLE, $agency, $region);
            }
            $regionalOffice = $this->regional_office_model->where('id', $region)->dbGetRecord();
        } else {
            $orgInfo = $this->material_issue_model->totalUnitsReelno(TYPE_CABLE, $agency, $this->region);
            $regionalOffice = $this->regional_office_model->where('id', $this->region)->dbGetRecord();
        }

        
        if(isset($regionalOffice->region_name))
            $data['region_name'] = $regionalOffice->region_name;
        else
            $data['region_name'] = '';

        $totalreceipt = 0;
        $totalissue = 0;
        foreach ($orgInfo as $total) {
            $totalreceipt = 0;
            $totalissue = 0;
            $diametername = $total->diametername;
            $totalreceipt = $totalreceipt + $total->total_receipt;

            $issueList = $this->material_issue_model->totalIssueLot($total->id);
            $totalissue = $totalissue + $issueList[0]->total_issue;


            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "lot" => $total->lot ,"stock" => $stock, "regionalOffice" => $regionalOffice);
            array_push($arrStockList, $stockarr);
            //var_dump($stockarr);exit;
        }

        //$data['arrOverallList'] = $orgInfo;
        $data['arrOverallList'] = $arrStockList;

        $this->template->print_template($data);

    }

    /*
    * Cable region wise summary
    */
    function region_wise_summary($agency=GON)
    {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['agency'] = $agency;
        $data['region'] = '';
        if ($agency == 1) {
            $data['agency_name'] = "GoN";
        } else {
            $data['agency_name'] = "SDC";
        }
        $arrStockList = array();

        $this->load->model('material_issue/material_issue_model');
        $this->load->model('regional_office/regional_office_model');
        if ($this->isadmin == 1) {
            $region = 'DEFAULT_REGION';
            $data['region']= $this->input->post('region');
            if($this->input->post('region')) { $region = $this->input->post('region');}
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_CABLE, $agency, $region);
            $regionalOffice = $this->regional_office_model->where('id', $region)->dbGetRecord();
        } else {
            $region = $this->region;
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_CABLE, $agency, $this->region);
            $regionalOffice = $this->regional_office_model->where('id', $this->region)->dbGetRecord();
        }

		
		if(isset($regionalOffice->region_name))
			$data['region_name'] = $regionalOffice->region_name;
		else
			$data['region_name'] = '';

        $totalreceipt = 0;
        $totalissue = 0;
        foreach ($orgInfo as $total) {
            $totalreceipt = 0;
            $diametername = $total->diametername;
            $totalreceipt = $totalreceipt + $total->total_receipt;

            //get issues
            $material_receipt =$this->material_issue_model->receiptUnitsRegion(TYPE_CABLE, $agency, $region, $total->diameter);
            $totalissue = 0;
            foreach ($material_receipt as $item) {
                $issueList = $this->material_issue_model->totalIssueLot($item->id);
                $totalissue = $totalissue + $issueList[0]->total_issue;
            }
            
// echo "Receipt: ".$totalreceipt."   Issue:".$totalissue;
// echo "<br>";
            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "stock" => $stock, "regionalOffice" => $regionalOffice);
            array_push($arrStockList, $stockarr);
            //var_dump($stockarr);exit;
        }

        //$data['arrOverallList'] = $orgInfo;
        $data['arrOverallList'] = $arrStockList;

        $this->template->my_template($data);

    }

    function region_wise_summary_print($agency=GON) {

         $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['agency'] = $agency;

        if ($agency == 1) {
            $data['agency_name'] = "GoN";
        } else {
            $data['agency_name'] = "SDC";
        }
        $arrStockList = array();

        $this->load->model('material_issue/material_issue_model');
        $this->load->model('regional_office/regional_office_model');
        if ($this->isadmin == 1) {
            $region = 'DEFAULT_REGION';
            $data['region']= $this->input->post('region');
            if($this->input->post('region')) { $region = $this->input->post('region');}
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_CABLE, $agency, $region);
            $regionalOffice = $this->regional_office_model->where('id', $region)->dbGetRecord();
        } else {
            $region = $this->region;
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_CABLE, $agency, $this->region);
            $regionalOffice = $this->regional_office_model->where('id', $this->region)->dbGetRecord();
        }

        
        if(isset($regionalOffice->region_name))
            $data['region_name'] = $regionalOffice->region_name;
        else
            $data['region_name'] = '';

        $totalreceipt = 0;
        $totalissue = 0;
        foreach ($orgInfo as $total) {
            $totalreceipt = 0;
            $diametername = $total->diametername;
            $totalreceipt = $totalreceipt + $total->total_receipt;

            //get issues
            $material_receipt =$this->material_issue_model->receiptUnitsRegion(TYPE_CABLE, $agency, $region, $total->diameter);
            $totalissue = 0;
            foreach ($material_receipt as $item) {
                $issueList = $this->material_issue_model->totalIssueLot($item->id);
                $totalissue = $totalissue + $issueList[0]->total_issue;
            }

            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "stock" => $stock, "regionalOffice" => $regionalOffice);
            array_push($arrStockList, $stockarr);
            //var_dump($stockarr);exit;
        }

        //$data['arrOverallList'] = $orgInfo;
        $data['arrOverallList'] = $arrStockList;
        $this->template->print_template($data);

    }

    function summary_report($agency=GON) {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['agency'] = $agency;
        // $this->load->model('material_issue/material_issue_model');
        // $this->load->model('regional_office/regional_office_model');
        // $orgInfo = $this->material_issue_model->totalOverallUnits(TYPE_CABLE,$agency,$this->region);        
        // $data['arrOverallList'] = $orgInfo;
        $data['region'] = '';
        if ($agency == 1) {
            $data['agency_name'] = "GoN";
        } else {
            $data['agency_name'] = "SDC";
        }
        $arrStockList = array();

        $this->load->model('material_issue/material_issue_model');
        $this->load->model('regional_office/regional_office_model');
        if ($this->isadmin == 1) {
            $region = '';
            $data['region']= $this->input->post('region');
            if($this->input->post('region')) { $region = $this->input->post('region');}
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_CABLE, $agency, $region);
            $regionalOffice = $this->regional_office_model->where('id', $region)->dbGetRecord();
        } else {
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_CABLE, $agency, $this->region);
            $regionalOffice = $this->regional_office_model->where('id', $this->region)->dbGetRecord();
        }

        
        if(isset($regionalOffice->region_name))
            $data['region_name'] = $regionalOffice->region_name;
        else
            $data['region_name'] = '';

        $totalreceipt = 0;
        $totalissue = 0;
        foreach ($orgInfo as $total) {
            $totalreceipt = 0;
            $diametername = $total->diametername;
            $totalreceipt = $totalreceipt + $total->total_receipt;

            //get issues
            if ($this->isadmin == 1) {
                $material_receipt =$this->material_issue_model->receiptUnitsRegion(TYPE_CABLE, $agency, '', $total->diameter);
            } else {
                $material_receipt =$this->material_issue_model->receiptUnitsRegion(TYPE_CABLE, $agency, $this->region, $total->diameter);
            }
            $totalissue = 0;
            foreach ($material_receipt as $item) {
                $issueList = $this->material_issue_model->totalIssueLot($item->id);
                $totalissue = $totalissue + $issueList[0]->total_issue;
            }

            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "total_receipt" => $totalreceipt, "total_issue" => $totalissue, "regionalOffice" => $regionalOffice);
            array_push($arrStockList, $stockarr);
            //var_dump($stockarr);exit;
        }

        //$data['arrOverallList'] = $orgInfo;
        $data['arrOverallList'] = $arrStockList;
        $this->template->my_template($data);

    }

    function summary_report_print($agency=GON) {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['agency'] = $agency;
        $data['region'] = '';
        if ($agency == 1) {
            $data['agency_name'] = "GoN";
        } else {
            $data['agency_name'] = "SDC";
        }
        $arrStockList = array();

        $this->load->model('material_issue/material_issue_model');
        $this->load->model('regional_office/regional_office_model');
        if ($this->isadmin == 1) {
            $region = 'DEFAULT_REGION';
            $data['region']= $this->input->post('region');
            if($this->input->post('region')) { $region = $this->input->post('region');}
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_CABLE, $agency, $region);
            $regionalOffice = $this->regional_office_model->where('id', $region)->dbGetRecord();
        } else {
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_CABLE, $agency, $this->region);
            $regionalOffice = $this->regional_office_model->where('id', $this->region)->dbGetRecord();
        }

        
        if(isset($regionalOffice->region_name))
            $data['region_name'] = $regionalOffice->region_name;
        else
            $data['region_name'] = '';

        $totalreceipt = 0;
        $totalissue = 0;
        foreach ($orgInfo as $total) {
            $totalreceipt = 0;
            $diametername = $total->diametername;
            $totalreceipt = $totalreceipt + $total->total_receipt;

            //get issues
            $material_receipt =$this->material_issue_model->receiptUnitsRegion(TYPE_CABLE, $agency, $this->region, $total->diameter);
            $totalissue = 0;
            foreach ($material_receipt as $item) {
                $issueList = $this->material_issue_model->totalIssueLot($item->id);
                $totalissue = $totalissue + $issueList[0]->total_issue;
            }

            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "total_receipt" => $totalreceipt, "total_issue" => $totalissue, "regionalOffice" => $regionalOffice);
            array_push($arrStockList, $stockarr);
            //var_dump($stockarr);exit;
        }

        //$data['arrOverallList'] = $orgInfo;
        $data['arrOverallList'] = $arrStockList;    

        $this->template->print_template($data);

    }


    function region_wise_summary_bulldog($agency=GON) {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['agency'] = $agency;
        $data['region'] = '';

        if ($agency == 1) {
            $data['agency_name'] = "GoN";
        } else {
            $data['agency_name'] = "SDC";
        }
        $arrStockList = array();

        $this->load->model('material_issue/material_issue_model');
        $this->load->model('regional_office/regional_office_model');
        if ($this->isadmin == 1) {
            $region = 'DEFAULT_REGION';
            $data['region']= $this->input->post('region');
            if($this->input->post('region')) { $region = $this->input->post('region');}
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_BULLDOG, $agency, $region);
            $regionalOffice = $this->regional_office_model->where('id', $region)->dbGetRecord();
        } else {
            $region = $this->region;
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_BULLDOG, $agency, $this->region);
            $regionalOffice = $this->regional_office_model->where('id', $this->region)->dbGetRecord();
        }

        
        if(isset($regionalOffice->region_name))
            $data['region_name'] = $regionalOffice->region_name;
        else
            $data['region_name'] = '';

        $totalreceipt = 0;
        $totalissue = 0;
        foreach ($orgInfo as $total) {
            $totalreceipt = 0;
            $diametername = $total->diametername;
            $totalreceipt = $totalreceipt + $total->total_receipt;

            //get issues
            $material_receipt =$this->material_issue_model->receiptUnitsRegion(TYPE_BULLDOG, $agency, $region, $total->diameter);
            $totalissue = 0;
            foreach ($material_receipt as $item) {
                $issueList = $this->material_issue_model->totalIssueLot($item->id);
                $totalissue = $totalissue + $issueList[0]->total_issue;
            }

            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "stock" => $stock, "regionalOffice" => $regionalOffice);
            array_push($arrStockList, $stockarr);
            //var_dump($stockarr);exit;
        }

        //$data['arrOverallList'] = $orgInfo;
        $data['arrOverallList'] = $arrStockList;

        $this->template->my_template($data);

    }

    function region_wise_summary_bulldog_print($agency=GON) {

         $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['agency'] = $agency;
        if ($agency == 1) {
            $data['agency_name'] = "GoN";
        } else {
            $data['agency_name'] = "SDC";
        }
        $arrStockList = array();

        $this->load->model('material_issue/material_issue_model');
        $this->load->model('regional_office/regional_office_model');
        if ($this->isadmin == 1) {
            $region = 'DEFAULT_REGION';
            $data['region']= $this->input->post('region');
            if($this->input->post('region')) { $region = $this->input->post('region');}
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_BULLDOG, $agency, $region);
            $regionalOffice = $this->regional_office_model->where('id', $region)->dbGetRecord();
        } else {
            $region = $this->region;
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_BULLDOG, $agency, $this->region);
            $regionalOffice = $this->regional_office_model->where('id', $this->region)->dbGetRecord();
        }

        
        if(isset($regionalOffice->region_name))
            $data['region_name'] = $regionalOffice->region_name;
        else
            $data['region_name'] = '';

        $totalreceipt = 0;
        $totalissue = 0;
        foreach ($orgInfo as $total) {
            $totalreceipt = 0;
            $diametername = $total->diametername;
            $totalreceipt = $totalreceipt + $total->total_receipt;

            //get issues
            $material_receipt =$this->material_issue_model->receiptUnitsRegion(TYPE_BULLDOG, $agency, $region, $total->diameter);
            $totalissue = 0;
            foreach ($material_receipt as $item) {
                $issueList = $this->material_issue_model->totalIssueLot($item->id);
                $totalissue = $totalissue + $issueList[0]->total_issue;
            }

            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "stock" => $stock, "regionalOffice" => $regionalOffice);
            array_push($arrStockList, $stockarr);
            //var_dump($stockarr);exit;
        }

        //$data['arrOverallList'] = $orgInfo;
        $data['arrOverallList'] = $arrStockList;

        $this->template->print_template($data);

    }


    function summary_report_bulldog($agency=GON) {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['agency'] = $agency;
        // $this->load->model('material_issue/material_issue_model');
        // $this->load->model('regional_office/regional_office_model');
        // $orgInfo = $this->material_issue_model->totalOverallUnits(TYPE_BULLDOG,$agency,$this->region);        
        // $data['arrOverallList'] = $orgInfo;

        $data['region'] = '';
        if ($agency == 1) {
            $data['agency_name'] = "GoN";
        } else {
            $data['agency_name'] = "SDC";
        }
        $arrStockList = array();

        $this->load->model('material_issue/material_issue_model');
        $this->load->model('regional_office/regional_office_model');
        if ($this->isadmin == 1) {
            $region = '';
            $data['region']= $this->input->post('region');
            if($this->input->post('region')) { $region = $this->input->post('region');}
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_BULLDOG, $agency, $region);
            $regionalOffice = $this->regional_office_model->where('id', $region)->dbGetRecord();
        } else {
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_BULLDOG, $agency, $this->region);
            $regionalOffice = $this->regional_office_model->where('id', $this->region)->dbGetRecord();
        }

        
        if(isset($regionalOffice->region_name))
            $data['region_name'] = $regionalOffice->region_name;
        else
            $data['region_name'] = '';

        $totalreceipt = 0;
        $totalissue = 0;
        foreach ($orgInfo as $total) {
            $totalreceipt = 0;
            $diametername = $total->diametername;
            $totalreceipt = $totalreceipt + $total->total_receipt;

            //get issues
            if ($this->isadmin == 1) {
                $material_receipt =$this->material_issue_model->receiptUnitsRegion(TYPE_BULLDOG, $agency, '', $total->diameter);
            } else {
                $material_receipt =$this->material_issue_model->receiptUnitsRegion(TYPE_BULLDOG, $agency, $this->region, $total->diameter);
            }
            $totalissue = 0;
            foreach ($material_receipt as $item) {
                $issueList = $this->material_issue_model->totalIssueLot($item->id);
                $totalissue = $totalissue + $issueList[0]->total_issue;
            }

            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "total_receipt" => $totalreceipt, "total_issue" => $totalissue, "regionalOffice" => $regionalOffice);
            array_push($arrStockList, $stockarr);
            //var_dump($stockarr);exit;
        }

        //$data['arrOverallList'] = $orgInfo;
        $data['arrOverallList'] = $arrStockList;
        $this->template->my_template($data);

    }

    function summary_report_bulldog_print($agency=GON) {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['agency'] = $agency;
        $data['region'] = '';
        if ($agency == 1) {
            $data['agency_name'] = "GoN";
        } else {
            $data['agency_name'] = "SDC";
        }
        $arrStockList = array();

        $this->load->model('material_issue/material_issue_model');
        $this->load->model('regional_office/regional_office_model');
        if ($this->isadmin == 1) {
            $region = 'DEFAULT_REGION';
            $data['region']= $this->input->post('region');
            if($this->input->post('region')) { $region = $this->input->post('region');}
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_BULLDOG, $agency);
            $regionalOffice = $this->regional_office_model->where('id', $region)->dbGetRecord();
        } else {
            $orgInfo = $this->material_issue_model->totalUnitsRegion(TYPE_BULLDOG, $agency, $this->region);
            $regionalOffice = $this->regional_office_model->where('id', $this->region)->dbGetRecord();
        }

        
        if(isset($regionalOffice->region_name))
            $data['region_name'] = $regionalOffice->region_name;
        else
            $data['region_name'] = '';

        $totalreceipt = 0;
        $totalissue = 0;
        foreach ($orgInfo as $total) {
            $totalreceipt = 0;
            $diametername = $total->diametername;
            $totalreceipt = $totalreceipt + $total->total_receipt;

            //get issues
            if ($this->isadmin == 1) {
                $material_receipt =$this->material_issue_model->receiptUnitsRegion(TYPE_BULLDOG, $agency, '', $total->diameter);
            } else {
                $material_receipt =$this->material_issue_model->receiptUnitsRegion(TYPE_BULLDOG, $agency, $this->region, $total->diameter);
            }
            $totalissue = 0;
            foreach ($material_receipt as $item) {
                $issueList = $this->material_issue_model->totalIssueLot($item->id);
                $totalissue = $totalissue + $issueList[0]->total_issue;
            }

            $stock = $totalreceipt - $totalissue;
            $stockarr = array("diameter" => $diametername, "total_receipt" => $totalreceipt, "total_issue" => $totalissue, "regionalOffice" => $regionalOffice);
            array_push($arrStockList, $stockarr);
            //var_dump($stockarr);exit;
        }

        //$data['arrOverallList'] = $orgInfo;
        $data['arrOverallList'] = $arrStockList;      

        $this->template->print_template($data);

    }





}