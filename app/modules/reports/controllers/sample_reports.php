<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

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
        $this->load->model( 'bridge/bridge_model' );

        $this->load->model( $clName );
        $this->model = $this->{$clName};
	}

	function index()
	{
		//check access
		//_check(array('org_view'), 'general', '', "You don't have permission to view Reports.", 'info', 'dashboard');

		$data = self::$arrDefData;
        $this->template->my_template($data);
	}
   
  function main_completed_bridges(){
		$data = self::$arrDefData;
		$data['view_file'] ='main_completed_bridges/main_completed_bridges' ;
       
 		$this->template->my_template($data);        
    }
  function districtwise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
        $this->load->model('district_name/district_name_model');
        $data['arrDistList'] = $this->district_name_model->dbGetList();
 
		$this->template->my_template($data);        
    }
  function districtwise_report(){
        //var_dump($_POST);
		
             $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
             $this->load->model('vcd_municipality/vcd_municipality_model');
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
                if($selDist!=0){
                    $data['arrsDataList'] = $this->view_brigde_detail_model->where('dist01id', $selDist)->dbGetList();
 
                   
                }else{
                
                    redirect("reports/districtwise");   
                }
            $this->template->my_template($data);        
      
             
    }
  function districtwise_print(){
            //var_dump($_GET);
            $selDist = (int)@$this->input->get('id');
            var_dump($selDist);
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
               if($Postback =='Back'){
                  redirect("reports");     
                }else{
 
                if($selDist!=0){
                    $data['arrsDataList'] = $this->view_brigde_detail_model->where('bri03id', $selDist)->dbGetList();
                    //var_dump($data['arrDevtList']);
                }else{
                
                    redirect("reports/districtwise");   
                }
                }
            $this->template->my_template($data);        
}   
    
  function devregionwise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
         $this->load->model('development_region/development_region_model');
        $data['arrDistList'] = $this->development_region_model->dbGetList();
 
		$this->template->my_template($data);        
    }
  function devregionwise_report(){
            //var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
                  if($Postback =='Back'){
                  redirect("reports");     
                }else{
 
                    if($selDist!=0){
                        $data['arrDevtList'] = $this->view_brigde_detail_model->where('dev01id', $selDist)->dbGetList();
                        //var_dump($data['arrDevtList']);
                    }else{
                    
                        redirect("reports/devregionwise");   
                    }
                }
            $this->template->my_template($data);        
}
 function Bridgewise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
         $this->load->model('bridge/bridge_model');
        $data['arrDistList'] = $this->bridge_model->dbGetList();
		$this->template->my_template($data);        
    }
  function Bridgewise_report(){
            //var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_bridge_major_vdc_model');
            $data['arrDevInfo'] = $this->view_bridge_major_vdc_model->dbGetRecord();
                 if($Postback =='Back'){
                  redirect("reports");     
                }else{
 
                    if($selDist!=0){
                        $data['arrDevtList'] = $this->view_bridge_major_vdc_model->where('bri03id', $selDist)->dbGetList();
                        //var_dump($data['arrDevtList']);
                    }else{
                    
                        redirect("reports/Bridgewise");   
                    }
                }
            $this->template->my_template($data);        
}    

 function tbss_pregionwise(){
       $data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
        $this->load->model('regional_office/regional_office_model');
        $data['arrDistList'] = $this->regional_office_model->dbGetList();
		$this->template->my_template($data);        
    }
function tbss_pregionwise_report(){
         //var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $Postback = (int)@$this->input->post('submit');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
                if($Postback =='Back'){
                  redirect("reports");     
                }else{
                if($selDist!=0 ){
                    $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                    //var_dump($data['arrDevtList']);
                }else{
                
                    redirect("reports/tbss_pregionwise");   
                }
                }
            $this->template->my_template($data); 
   }          
 function Est_Overall_DateWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$this->template->my_template($data);        
    }
    
 function Est_Overall_DateWise_report(){
          //var_dump($_POST);
           
            $Postback = @$this->input->post('submit');
            $dataStart = @$this->input->post('start_date');
            $dateEnd = @$this->input->post('end_date');
            //var_dump($dataStart);
            //var_dump($dateEnd);
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
            $data['startdate'] = $dataStart;
            $data['enddate'] = $dateEnd;
             if($Postback =='Back'){
                  redirect("reports");     
                }
             elseif( $dataStart <= $dateEnd){
                if($dataStart!= 0 || $dateEnd != 0 ){
                    $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=',$dateEnd )->dbGetList();
                  //print_r($data['arrDevtList']);
                }else{
                    redirect("reports/Est_Overall_DateWise");   
                }
              }else{
                'start date is Smaller than End Date';
              }
            $this->template->my_template($data); 
   }      
 function Est_Overall_FYWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
        $this->load->model('fiscal_year/fiscal_year_model');
        $data['arrDistList'] = $this->fiscal_year_model->dbGetList();
 
		$this->template->my_template($data);        
    }
  function Est_Overall_FYWise_report(){
         //var_dump($_POST);
            
            $Postback = @$this->input->post('submit');
            $dataStart = @$this->input->post('start_year');
            $dateEnd = @$this->input->post('end_year');
            var_dump($dataStart);
            var_dump($dateEnd);
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            $this->load->model('fiscal_year/fiscal_year_model');

            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
           $startdate = $this->fiscal_year_model->where('fis01id =',$dataStart )->dbGetRecord();
             $data['startdate']= $startdate->fis01year;
            $enddate = $this->fiscal_year_model->where('fis01id =',$dateEnd )->dbGetRecord();
            $data['enddate']= $enddate->fis01year;
             
             if($Postback =='Back'){
                  redirect("reports");     
                }
             elseif( $dataStart <= $dateEnd ){
                if($dataStart!= 0 || $dateEnd != 0 ){
                    $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03Project_fiscal_year >=', $dataStart)->where('bri03Project_fiscal_year <=',$dateEnd )->dbGetList();
                  //var_dump($data['arrDevtList']);
                }else{
                    redirect("reports/Est_Overall_FYWise");   
                }
              }else{
                'start date is Smaller than End Date';
              }
            $this->template->my_template($data); 
   }      
  
 function Est_Dist_DateWise(){
        $data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$this->template->my_template($data);  
    }
 function Est_Dist_DateWise_report(){
         $Postback = @$this->input->post('submit');
            $dataStart = @$this->input->post('start_date');
            $dateEnd = @$this->input->post('end_date');
             $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            $this->load->model('view/view_district_model');
            $this->load->model('view/view_brigde_detail_model');
             $data['startdate'] = $dataStart;
            $data['enddate'] = $dateEnd;
             if($Postback =='Back'){
                  redirect("reports");     
                }
             elseif( $dataStart <= $dateEnd){
                if($dataStart!= 0 || $dateEnd != 0 ){
                    $data['arrDistList'] = $this->view_district_model->dbGetList();
                 $selDist = $data['arrDistList'];
                $arrPrintList = array();
                if(is_array( $selDist)){
                        foreach( $selDist as $k=>$v){
                            $rr=$v->dist01id;
                            $dist=$this->view_brigde_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=',$dateEnd )->where('dist01id',$rr)->dbGetList();
                             if(is_array($dist) && !empty($dist)){
                                //print header
                                //echo 'header';
                                $row['dist'] = $v;
                                $row['data'] = $dist;
                               $arrPrintList[] = $row;
                            }
                        }
                    }
                    $data['arrPrintList'] = $arrPrintList;
                    //var_dump($arrPrintList);                  
                }else{
                    redirect("reports/Est_Dist_DateWise");   
                }
              }else{
                'start date is Smaller than End Date';
              }
            $this->template->my_template($data); 
   }   
   
function Est_Dist_FYWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
        $this->load->model('fiscal_year/fiscal_year_model');
        $data['arrDistList'] = $this->fiscal_year_model->dbGetList();
 
		$this->template->my_template($data);        
    }
function Est_Dist_FYWise_report(){
    
  $Postback = @$this->input->post('submit');
            $dataStart = @$this->input->post('start_year');
            $dateEnd = @$this->input->post('end_year');
             $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            $this->load->model('view/view_district_model');
            $this->load->model('view/view_brigde_detail_model');
             $data['startdate'] = $dataStart;
            $data['enddate'] = $dateEnd;
             if($Postback =='Back'){
                  redirect("reports");     
                }
             elseif( $dataStart <= $dateEnd){
                $selDist=$this->view_district_model->dbGetList();
                
                $arrPrintList = array();
                if(is_array( $selDist)){
                        foreach( $selDist as $k=>$v){
                            $rr=$v->dist01id;
                if($dataStart!= 0 || $dateEnd != 0 ){
                    $this->view_brigde_detail_model->where('bri05bridge_completion_fiscalyear >=', $dataStart)->where('bri05bridge_completion_fiscalyear <=',$dateEnd );
                     $dist= $this->view_brigde_detail_model->where('dist01id',$rr)->dbGetList();
                            
                            
                             if(is_array($dist) && !empty($dist)){
                                //print header
                                //echo 'header';
                                $row['dist'] = $v;
                                $row['data'] = $dist;
                               $arrPrintList[] = $row;
                            }
                        }
                    }
                    $data['arrPrintList'] = $arrPrintList;                  
                }else{
                    redirect("reports/Est_Dist_FYWise");   
                }
              }else{
                'start date is Smaller than End Date';
              }
            $this->template->my_template($data); 
   }   
 function Est_Dev_DateWise(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$this->template->my_template($data);        
    } 
 function Est_Dev_DateWise_report(){ 
     //var_dump($_POST);
          $Postback = @$this->input->post('submit');
            $dataStart = @$this->input->post('start_date');
            $dateEnd = @$this->input->post('end_date');
             $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
           
            $this->load->model('view/view_district_model');
            $this->load->model('view/regional_office_model');
             $this->load->model('development_region/development_region_model');
            $this->load->model('view/view_brigde_detail_model');
             $data['startdate'] = $dataStart;
            $data['enddate'] = $dateEnd;
             if($Postback =='Back'){
                  redirect("reports");     
                }
             elseif( $dataStart <= $dateEnd){
                if($dataStart!= 0 || $dateEnd != 0 ){
                    $data['arrDistList'] = $this->view_district_model->dbGetList();
                    $data['arrDevRegList'] = $this->development_region_model->dbGetList();
                   
                    
                     $arrdev = $data['arrDevRegList'];
                
                $arrPrintList = array();
                if(is_array( $arrdev)){
                        foreach( $arrdev as $k=>$v){
                         //var_dump($v);
                        $ddd = $v->dev01id;
                         $selDist = $this->view_district_model->where('dev01id', $ddd)->dbGetList();
                         
                         //var_dump($selDist);
                         $row = array();
                        $row['dev'] = $v;
                   
                        if(is_array( $selDist)){
                            foreach( $selDist as $k1=>$v1){
                                $rr=$v1->dist01id;
                                $dist=$this->view_brigde_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=',$dateEnd )->where('dist01id',$rr)->dbGetList();
                                if(is_array($dist) && !empty($dist)){
                                    $row['dist'][$rr]['info'] = $v1;
                                    $row['dist'][$rr]['data'] = $dist;
                                
                                }
                            }
                            $arrPrintList[] = $row;
                            }
                        }
                    }
                    $data['arrPrintList'] = $arrPrintList;  
                 //var_dump($data['arrPrintList']);               
                }else{
                    redirect("reports/Est_Dev_DateWise");   
                }
              }else{
                'start date is Smaller than End Date';
              }
            $this->template->my_template($data); 
   }   
   
function Est_Dev_FYWise(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
        $this->load->model('fiscal_year/fiscal_year_model');
        $data['arrDistList'] = $this->fiscal_year_model->dbGetList();
         
		$this->template->my_template($data);        
    } 
 function Est_Dev_FYWise_report(){ 
     //var_dump($_POST);
          $Postback = @$this->input->post('submit');
            $dataStart = @$this->input->post('start_year');
            $dateEnd = @$this->input->post('end_year');
             $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
           
            $this->load->model('view/view_district_model');
            $this->load->model('view/regional_office_model');
             $this->load->model('development_region/development_region_model');
            $this->load->model('view/view_brigde_detail_model');
             $data['startdate'] = $dataStart;
            $data['enddate'] = $dateEnd;
             if($Postback =='Back'){
                  redirect("reports");     
                }
             elseif( $dataStart <= $dateEnd){
                if($dataStart!= 0 || $dateEnd != 0 ){
                    $data['arrDistList'] = $this->view_district_model->dbGetList();
                    $data['arrDevRegList'] = $this->development_region_model->dbGetList();
                   
                    
                     $arrdev = $data['arrDevRegList'];
                
                $arrPrintList = array();
                if(is_array( $arrdev)){
                        foreach( $arrdev as $k=>$v){
                         //var_dump($v);
                        $ddd = $v->dev01id;
                         $selDist = $this->view_district_model->where('dev01id', $ddd)->dbGetList();
                         
                         //var_dump($selDist);
                         $row = array();
                        $row['dev'] = $v;
                   
                        if(is_array( $selDist)){
                            foreach( $selDist as $k1=>$v1){
                                $rr=$v1->dist01id;
                                $dist=$this->view_brigde_detail_model->where('bri05bridge_completion_fiscalyear >=', $dataStart)->where('bri05bridge_completion_fiscalyear <=',$dateEnd )->where('dist01id',$rr)->dbGetList();
                                if(is_array($dist) && !empty($dist)){
                                    $row['dist'][$rr]['info'] = $v1;
                                    $row['dist'][$rr]['data'] = $dist;
                                
                                }
                            }
                            $arrPrintList[] = $row;
                            }
                        }
                    }
                    $data['arrPrintList'] = $arrPrintList;  
                 //var_dump($data['arrPrintList']);               
                }else{
                    redirect("reports/Est_Dev_DateWise");   
                }
              }else{
                'start date is Smaller than End Date';
              }
            $this->template->my_template($data); 
   }   
      
function Est_TBSS_DateWise(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$this->template->my_template($data);        
    }
 function Est_TBSS_DateWise_report(){ 
       //var_dump($_POST);
          $Postback = @$this->input->post('submit');
            $dataStart = @$this->input->post('start_date');
            $dateEnd = @$this->input->post('end_date');
             $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
           
            $this->load->model('view/view_district_model');
            $this->load->model('view/regional_office_model');
             $this->load->model('development_region/development_region_model');
            $this->load->model('view/view_brigde_detail_model');
             $data['startdate'] = $dataStart;
            $data['enddate'] = $dateEnd;
             if($Postback =='Back'){
                  redirect("reports");     
                }
             elseif( $dataStart <= $dateEnd){
                if($dataStart!= 0 || $dateEnd != 0 ){
                    $data['arrDistList'] = $this->view_district_model->dbGetList();
                    $data['arrDevRegList'] = $this->development_region_model->dbGetList();
                   
                    
                     $arrdev = $data['arrDevRegList'];
                
                $arrPrintList = array();
                if(is_array( $arrdev)){
                        foreach( $arrdev as $k=>$v){
                         //var_dump($v);
                        $ddd = $v->dev01id;
                         $selDist = $this->view_district_model->where('dev01id', $ddd)->dbGetList();
                         
                         //var_dump($selDist);
                         $row = array();
                        $row['dev'] = $v;
                   
                        if(is_array( $selDist)){
                            foreach( $selDist as $k1=>$v1){
                                $rr=$v1->dist01id;
                                $dist=$this->view_brigde_detail_model->where('bri05bridge_completion_fiscalyear >=', $dataStart)->where('bri05bridge_completion_fiscalyear <=',$dateEnd )->where('dist01id',$rr)->dbGetList();
                                if(is_array($dist) && !empty($dist)){
                                    $row['dist'][$rr]['info'] = $v1;
                                    $row['dist'][$rr]['data'] = $dist;
                                
                                }
                            }
                            $arrPrintList[] = $row;
                            }
                        }
                    }
                    $data['arrPrintList'] = $arrPrintList;  
                 //var_dump($data['arrPrintList']);               
                }else{
                    redirect("reports/Est_TBSS_DateWise");   
                }
              }else{
                'start date is Smaller than End Date';
              }
            $this->template->my_template($data); 
   }     
    
function Est_TBSS_FYWise(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
     $this->load->model('fiscal_year/fiscal_year_model');
        $data['arrDistList'] = $this->fiscal_year_model->dbGetList();
  
		$this->template->my_template($data);        
    }
function Est_TBSS_FYWise_report(){ 
   //var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
               if($Postback =='Back'){
                  redirect("reports");     
                }else{
                    if($selDist!=0){
                        $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                        //var_dump($data['arrDevtList']);
                    }else{
                    
                        redirect("reports/Est_TBSS_FYWise");   
                    }
               } 
            $this->template->my_template($data); 
   }  
function Overall_DateWise(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$this->template->my_template($data);        
    }
function Overall_DateWise_report(){ 
   //var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
              if($Postback =='Back'){
                  redirect("reports");     
                }else{

                    if($selDist!=0){
                        $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                        //var_dump($data['arrDevtList']);
                    }else{
                    
                        redirect("reports/Overall_DateWise");   
                    }
                }
            $this->template->my_template($data); 
   }  
function Overall_FYWise(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
            $this->load->model('fiscal_year/fiscal_year_model');
        $data['arrDistList'] = $this->fiscal_year_model->dbGetList();
         
		$this->template->my_template($data);        
    }
function Overall_FYWise_report(){ 
   //var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
            if($Postback =='Back'){
                  redirect("reports");     
                }else{
                  if($selDist!=0){
                        $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                        //var_dump($data['arrDevtList']);
                    }else{
                    
                        redirect("reports/Overall_FYWise");   
                    }
                  }  
            $this->template->my_template($data); 
   }  
function Est_Cont_Overall_DateWise(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
   
		$this->template->my_template($data);        
    }
function Est_Cont_Overall_DateWise_report(){ 
  //var_dump($_POST);
             $Postback = @$this->input->post('submit');
            $dataStart = @$this->input->post('start_date');
            $dateEnd = @$this->input->post('end_date');
            var_dump($dataStart);
            var_dump($dateEnd);
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            $this->load->model('fiscal_year/fiscal_year_model');

            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
           $startdate = $this->fiscal_year_model->where('fis01id =',$dataStart )->dbGetRecord();
             $data['startdate']= $startdate->fis01year;
            $enddate = $this->fiscal_year_model->where('fis01id =',$dateEnd )->dbGetRecord();
            $data['enddate']= $enddate->fis01year;
             
             if($Postback =='Back'){
                  redirect("reports");     
                }
             elseif( $dataStart <= $dateEnd ){
                if($dataStart!= 0 || $dateEnd != 0 ){
                    $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03Project_fiscal_year >=', $dataStart)->where('bri03Project_fiscal_year <=',$dateEnd )->dbGetList();
                  //var_dump($data['arrDevtList']);
                }else{
                    redirect("reports/Est_Overall_FYWise");   
                }
              }else{
                'start date is Smaller than End Date';
              }
            $this->template->my_template($data); 
   }      
    
function Est_Cont_Overall_FYWise(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
         $this->load->model('fiscal_year/fiscal_year_model');
        $data['arrDistList'] = $this->fiscal_year_model->dbGetList();
 		$this->template->my_template($data);        
    }
function Est_Cont_Overall_FYWise_report(){ 
  //var_dump($_POST);
             $Postback = @$this->input->post('submit');
            $dataStart = @$this->input->post('start_year');
            $dateEnd = @$this->input->post('end_year');
            var_dump($dataStart);
            var_dump($dateEnd);
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            $this->load->model('fiscal_year/fiscal_year_model');

            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
           $startdate = $this->fiscal_year_model->where('fis01id =',$dataStart )->dbGetRecord();
             $data['startdate']= $startdate->fis01year;
            $enddate = $this->fiscal_year_model->where('fis01id =',$dateEnd )->dbGetRecord();
            $data['enddate']= $enddate->fis01year;
             
             if($Postback =='Back'){
                  redirect("reports");     
                }
             elseif( $dataStart <= $dateEnd ){
                if($dataStart!= 0 || $dateEnd != 0 ){
                    $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03Project_fiscal_year >=', $dataStart)->where('bri03Project_fiscal_year <=',$dateEnd )->dbGetList();
                  //var_dump($data['arrDevtList']);
                }else{
                    redirect("reports/Est_Overall_FYWise");   
                }
              }else{
                'start date is Smaller than End Date';
              }
            $this->template->my_template($data); 
   }      
    
function Est_Cont_Dist_DateWise(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$this->template->my_template($data);        
    }
function Est_Cont_Dist_DateWise_report(){ 
 //var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
               if($Postback =='Back'){
                  redirect("reports");     
                }else{
                    if($selDist!=0){
                        $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                        //var_dump($data['arrDevtList']);
                    }else{
                    
                        redirect("reports/Est_Cont_Dist_DateWise");   
                    
                    }
                 }
            $this->template->my_template($data); 
   }  
 function Est_Cont_Dist_FYWise(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$this->template->my_template($data);        
    }
 function Est_Cont_Dist_FYWise_report(){ 
 //var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
                if($Postback =='Back'){
                  redirect("reports");     
                }else{
                        if($selDist!=0){
                            $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                            //var_dump($data['arrDevtList']);
                        }else{
                        
                            redirect("reports/Est_Cont_Dist_FYWise");   
                        }
                    }
            $this->template->my_template($data); 
   }  
   function Est_Cont_Dev_DateWise(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$this->template->my_template($data);        
    } 
   function Est_Cont_Dev_DateWise_report(){ 
 //var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
                if($Postback =='Back'){
                  redirect("reports");     
                }else{
                       if($selDist!=0){
                            $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                            //var_dump($data['arrDevtList']);
                        }else{
                        
                            redirect("reports/Est_Cont_Dev_DateWise");   
                        }
                     }
            $this->template->my_template($data); 
   }  
   function Est_Cont_Dev_FYWise(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$this->template->my_template($data);        
    }
   function Est_Cont_Dev_FYWise_report(){ 
 //var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
                if($Postback =='Back'){
                  redirect("reports");     
                }else{
                    if($selDist!=0){
                        $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                        //var_dump($data['arrDevtList']);
                    }else{
                    
                        redirect("reports/Est_Cont_Dev_FYWise");   
                    }
                }
            $this->template->my_template($data); 
   }  
   function Est_Cont_TBSS_DateWise(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$this->template->my_template($data);        
    }
    function Est_Cont_TBSS_DateWise_report(){ 
 //var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
                if($Postback =='Back'){
                  redirect("reports");     
                }else{
                        if($selDist!=0){
                            $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                            //var_dump($data['arrDevtList']);
                        }else{
                        
                            redirect("reports/Est_Cont_TBSS_DateWise");   
                        }
                }
            $this->template->my_template($data); 
   }  
   function Est_Cont_TBSS_FYWise(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$this->template->my_template($data);        
    }
   function Est_Cont_TBSS_FYWise_report(){ 
 //var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
               if($Postback =='Back'){
                  redirect("reports");     
                }else{
                    if($selDist!=0){
                        $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                        //var_dump($data['arrDevtList']);
                    }else{
                    
                        redirect("reports/Est_Cont_TBSS_FYWise");   
                    }
                }
            $this->template->my_template($data); 
   }  
   function Eng_Design_Approval(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$this->template->my_template($data);        
    } 
   function Eng_Design_Approval_report(){ 
 //var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
                 if($Postback =='Back'){
                  redirect("reports");     
                }else{
                    if($selDist!=0){
                        $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                        //var_dump($data['arrDevtList']);
                    }else{
                    
                        redirect("reports/Eng_Design_Approval");   
                    }
                }
            $this->template->my_template($data); 
   }  
   function Eng_Desing_Cost_Estimate(){ 
		 $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            $this->load->model('view/view_district_reg_office_model');
            $this->load->model('view/view_brigde_detail_model');
          
                 $data['arrDistList'] = $this->view_district_reg_office_model->dbGetList();
                 $selDist = $data['arrDistList'];
                $arrPrintList = array();
                if(is_array( $selDist)){
                        foreach( $selDist as $k=>$v){
                            $rr=$v->dist01id;
                            $dist=$this->view_brigde_detail_model->where('dist01id',$rr)->dbGetList();
                             if(is_array($dist) && !empty($dist)){
                                //print header
                                //echo 'header';
                                $row['dist'] = $v;
                                $row['data'] = $dist;
                               $arrPrintList[] = $row;
                            }
                        }
                    }
                    $data['arrPrintList'] = $arrPrintList;                  
               
                var_dump($arrPrintList);
            $this->template->my_template($data); 
   }        
    
  
   function Eng_FYWise(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$this->template->my_template($data);        
    } 
  function Eng_FYWise_report(){ 
//var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
                if($selDist!=0){
                    $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                    //var_dump($data['arrDevtList']);
                }else{
                
                    redirect("reports/tbss_pregionwise");   
                }
            $this->template->my_template($data); 
   }  
   function Eng_SiteAssesment_Survey(){ 
           $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            $this->load->model('view/view_district_reg_office_model');
            $this->load->model('view/view_brigde_detail_model');
          
                    $data['arrDistList'] = $this->view_district_reg_office_model->dbGetList();
                 $selDist = $data['arrDistList'];
                $arrPrintList = array();
                if(is_array( $selDist)){
                        foreach( $selDist as $k=>$v){
                            $rr=$v->dist01id;
                            $dist=$this->view_brigde_detail_model->where('dist01id',$rr)->dbGetList();
                             if(is_array($dist) && !empty($dist)){
                                //print header
                                //echo 'header';
                                $row['dist'] = $v;
                                $row['data'] = $dist;
                               $arrPrintList[] = $row;
                            }
                        }
                    }
                    $data['arrPrintList'] = $arrPrintList;                  
               
                var_dump($arrPrintList);
            $this->template->my_template($data); 
   }  
   function Work_Cancelled_Bridges(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
 function Work_Cancelled_Bridges_report(){
//var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
                if($selDist!=0){
                    $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                    //var_dump($data['arrDevtList']);
                }else{
                
                    redirect("reports/tbss_pregionwise");   
                }
            $this->template->my_template($data); 
   }  
    
    function Work_Carryover_Bridges(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    } 
   function Work_Carryover_Bridges_report(){
//var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
                if($selDist!=0){
                    $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                    //var_dump($data['arrDevtList']);
                }else{
                
                    redirect("reports/tbss_pregionwise");   
                }
            $this->template->my_template($data); 
   }  
     function Work_Completed_Bridges(){ 
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
     function Work_Completed_Bridges_report(){ 
//var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
                if($selDist!=0){
                    $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                    //var_dump($data['arrDevtList']);
                }else{
                
                    redirect("reports/tbss_pregionwise");   
                }
            $this->template->my_template($data); 
   }      
     function Work_Datewise_Completed(){  
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
  function Work_Datewise_Completed_report(){  
//var_dump($_POST);
            $selDist = (int)@$this->input->post('selDist');
            $data = self::$arrDefData;
            $data['view_file'] = __FUNCTION__;
            $this->load->model('view/view_brigde_detail_model');
            
            $data['arrDevInfo'] = $this->view_brigde_detail_model->dbGetRecord();
                if($selDist!=0){
                    $data['arrDevtList'] = $this->view_brigde_detail_model->where('bri03tbsu_regional_office', $selDist)->dbGetList();
                    //var_dump($data['arrDevtList']);
                }else{
                
                    redirect("reports/tbss_pregionwise");   
                }
            $this->template->my_template($data); 
   }     
  ////start completed Bridge///  
     function Act_Dev_DateWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
  
     function Act_Dev_FYWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
  
     function Act_Dist_DateWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
  
     function Act_Dist_FYWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
  
     function Act_Overall_DateWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
  
     function Act_Overall_FYWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
     function Act_Supporting_AgencyWise_DateWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
     function Act_Supporting_AgencyWise_FYWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
     function Act_TBSS_DateWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
     function Act_TBSS_FYWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
  
    function Act_Con_Dev_RegionWise_datewise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
    function Act_Con_Dev_RegionWise_fywise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
    function Act_Con_Districtwise_datewise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
    function Act_Con_Districtwise_FYwise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
    function Act_Con_Overall_datewise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
    function Act_Con_Overall_Fywise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
    function Act_Con_Supporting_AgencyWise_datewise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
    function Act_Con_Supporting_AgencyWise_FYwise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
    function Act_Con_TBSSPRegionWise_datewise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
    function Act_Con_TBSSPRegionWise_FYwise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
  
   function Gen_Cont_Dev_DateWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
   function Gen_Cont_Dev_FYWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
   function Gen_Cont_Dist_DateWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
   function Gen_Cont_Dist_FYWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
   function Gen_Cont_Overall_DateWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
   function Gen_Cont_Overall_FYWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
   function Gen_Cont_TBSS_DateWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
   function Gen_Cont_TBSS_FYWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
   function Gen_Dev_DateWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
   function Gen_Dev_FYWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
   function Gen_Dist_DateWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
   function Gen_Dist_FYWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
   function Gen_Overall_DateWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
   function Gen_Overall_FYWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
   function Gen_TBSS_DateWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }
   function Gen_TBSS_FYWise(){
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__ ;
		$this->template->my_template($data);        
    }


}