<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\district_name\Models\district_name_model;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\supporting_agencies\Models\supporting_agencies_model;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_bridge_detail_model;
use App\Modules\weighted\Models\weighted_model;
use App\Modules\view\Models\view_all_join_bridge_table_model;
//use App\Modules\Reports\Models\ReportsModel;

class Pro_Physical_Progress_report extends BaseController
{
  private static $arrDefData = array();

  private $fiscal_year_model;

  private $supporting_agencies_model;

  private $district_name_model;

  private $view_brigde_detail_model;

  private $view_all_join_bridge_table_model;

  private $template;

  public function __construct()
  {
    helper(['form', 'html', 'et_helper']);
    $fiscal_year_model = new FiscalYearModel();
    $supporting_agencies_model = new supporting_agencies_model();
    $district_name_model = new district_name_model();
    $weighted_model = new weighted_model();
    $view_brigde_detail_model = new view_bridge_detail_model();
    $view_all_join_bridge_table_model = new view_all_join_bridge_table_model();
    $this->fiscal_year_model = $fiscal_year_model;
    $this->supporting_agencies_model = $supporting_agencies_model;
    $this->district_name_model = $district_name_model;
    $this->weighted_model = $weighted_model;
    $this->view_brigde_detail_model = $view_brigde_detail_model;
    $this->view_all_join_bridge_table_model = $view_all_join_bridge_table_model;
    $this->template = new Template();
    if (count(self::$arrDefData) <= 0) {
      $FName = basename(__FILE__, '.php');
      $fName = strtolower($FName);
      self::$arrDefData = array(
        'title'         => $FName,
        'breadcrumb'    => array(array('text' => $FName, 'link' => $fName)),
        'module'        => $fName,
        'view_file'     => 'index',
      );
    }
  }

  public function index($stat = '')
  {
    $Postback = @$this->request->getVar('submit');
    $dataStart = @$this->request->getVar('start_year');
    $dateEnd = @$this->request->getVar('end_year');
    $selAgency = @$this->request->getVar('selAgency'); // supporting agency
    $regionaloffice = @$this->request->getVar('regionaloffice'); // province 
    $data['blnMM'] = $stat;
    $data['title'] = "Overall";
    
    $data['dataStart'] = $dataStart;
    $data['dateEnd'] = $dateEnd;
    $data['selAgency'] = $selAgency;
        
    // $this->load->model('fiscal_year/fiscal_year_model');
    // $this->load->model('supporting_agencies/supporting_agencies_model');
    // $this->load->model('district_name/district_name_model');
    // $this->load->model('view/view_all_views_model');
    // $this->load->model('view/view_all_join_bridge_table_model');
    // $this->load->model('view/view_brigde_detail_model');
    // $this->load->model('weighted/weighted_model');
    
    $data['startyear'] =$this->fiscal_year_model->where('fis01id', $dataStart)->first();
    $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();

    $arrPermittedDistList = $this->view_all_join_bridge_table_model->permittedDistrict();

    //filter districts
    $blnIsLogged = empty($this->session);
    $intUserType = ($blnIsLogged)? session()->get('type'): ENUM_GUEST;
    if($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR){
        //comma seperated value
        if( count( $arrPermittedDistList )> 0) {
            //$permittedDistList = implode(',', $arrPermittedDistList);
            $this->district_name_model->whereIn('dist01id',$arrPermittedDistList);
        }
    }
    
    $arrSupList = $this->supporting_agencies_model->findAll();
    if(trim($regionaloffice) != '') {
        $arrDistList = $this->district_name_model->where('dist01state',$regionaloffice)->findAll();
    } else { 
        if($intUserType == ENUM_ADMINISTRATOR) { // default load from province 1
            $regionaloffice = 1; //province 1
            $arrDistList = $this->district_name_model->where('dist01state',$regionaloffice)->findAll();
        } else {
            $arrDistList = $this->district_name_model->findAll();
        }
    }

    $data['regionaloffice'] = $regionaloffice;

    // echo $regionaloffice."<pre>";
    // var_dump($arrDistList);exit;
    $x = $this->weighted_model->asArray()->findAll();
    //var_dump( $x );
    //change into associatie array
    $arrWeightList = array();
    foreach( $x as $v){
        $arrWeightList[ $v['wei01int_name'] ] = $v;
    }
    // if(is_array($arrWeightList)) {
    //     echo "<pre>";
    //     var_dump($arrWeightList);exit;
    // }
    $data['arrWeightList'] = $arrWeightList;
   
    $fldnames = array('bri05site_assessment', 'bri05bridge_design_estimate','bri05material_supply_target',
    'bri05first_phase_constrution','bri05anchorage_concreting','bri05bridge_complete','bri05bmc_formation','bri05sos_orentation',
    'bri05bridge_completion_target','bri05material_supply_uc','bri05final_inspection','bri05community_agreement','bri05dmbt'
    ,'bri05second_phase_construction','bri05third_phase_construction','bri05work_completion_certificate',
    'bri05cable_pulling','bri05design_approval');
    
    $arrExLabel = array('bri05bridge_completion_target', 'bri05design_approval','bri05work_completion_certificate','bri05sos_orentation');
    
    //echo $arrWeightList['bri05bmc_formation']['wei01value'];

    if ($Postback == 'Back')
    {
        redirect(site_url());
    } elseif ($dataStart <= $dateEnd)
    {
        if ($dataStart != 0 || $dateEnd != 0)
        {


                    if (is_array($arrSupList))
                
                {
                
                    foreach ($arrSupList as $k => $v)
                
                    {
                
                        $data['arrsupportList']['sup_' . $v['sup01id']] = $v;
                
                    }
                
                }
                
                if (is_array($arrDistList))
                
                {
                
                    foreach ($arrDistList as $k => $v)
                
                    {
                
                        $data['arrDistrictList']['dist_' . $v['dist01id']] = $v;
                
                    }
                
                }
                    
                    if (empty($stat))
                    {                       
                        $x = ENUM_NEW_CONSTRUCTION;
                    } else
                    {
                        $x = ENUM_MAJOR_MAINTENANCE;
                
                    }
                    
                    //get current fiscal year
                    $fyarr =$this->fiscal_year_model->orderBy('fis01id DESC')->limit(1,0)->findAll();
                    
                    $data['currentfy'] = $fyarr[0]['fis01id'];
                    if($dataStart == $data['currentfy']) {
                        
                        // if($selAgency != '' && strtolower($selAgency) != "all") {                    
                           
                                                            
                        //     $brige_list = $this->view_brigde_detail_model->getcbridges($data['currentfy'],$x,$selAgency);
                                                            
                        // } else {
                            
                            /*$brige_list= $this->view_brigde_detail_model->where('bri03construction_type',$x)->
                                where('bri05bridge_complete_check !=', 1)->
                                where('bri03work_category !=', 3)->
                                orderBy('bri03work_category desc')->
                                findAll();*/

                        if($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR){
                            //comma seperated value
                            if( count( $arrPermittedDistList )> 0) {
                                //$permittedDistList = implode(',', $arrPermittedDistList);
                                $brige_list = $this->view_brigde_detail_model->getcbridges($data['currentfy'], $x, $selAgency, $regionaloffice, $arrPermittedDistList);
                            }
                        } else {
                            $brige_list = $this->view_brigde_detail_model->getcbridges($data['currentfy'], $x, $selAgency, $regionaloffice);
                        }
                                
                       // }    
                    
                    } else {
                        $startfy = substr($data['startyear']['fis01year'], 0 , 4);
                        $endfy = substr($data['endyear']['fis01year'], 4 , 4);
                        $fstartfy = $startfy."-07-16";
                        $fendfy = $endfy."-07-15";
                        
                        // if($selAgency != '' && strtolower($selAgency) != "all") {                    
                           
                        //     $brige_list = $this->view_brigde_detail_model->getoldcbridges($fstartfy,$fendfy,$x,$selAgency);
                            
                        // } else {
                            /*$brige_list= $this->view_brigde_detail_model->where('bri03construction_type',$x)->
                                where('bri03project_fiscal_year >=', $dataStart)->
                                where('bri03project_fiscal_year <=', $dateEnd)->
                                where('bri03work_category !=', 3)->
                                orderBy('bri03work_category desc')->
                                findAll();*/
                                
                            //$brige_list = $this->view_brigde_detail_model->getoldcbridges($fstartfy,$fendfy,$x);
                                
                        //}
                        if($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR){
                            //comma seperated value
                            if( count( $arrPermittedDistList )> 0) {
                                //$permittedDistList = implode(',', $arrPermittedDistList);
                                $brige_list = $this->view_brigde_detail_model->getoldcbridges($fstartfy,$fendfy,$x,$selAgency,$regionaloffice, $arrPermittedDistList);
                            }
                        } else {
                            $brige_list = $this->view_brigde_detail_model->getoldcbridges($fstartfy,$fendfy,$x,$selAgency,$regionaloffice);
                        }

                    }

                    //echo $this->db->last_query();
                    //echo count($brige_list);            
                        
                    $arrDataList = array();
                    $allTotal = 0;
                    
                    //$arrExLabel = array('');
                        foreach ($brige_list as $k => $v)
                    
                        {
                        
                            $maxDate = '';
                            $maxFld = '';
                            $sumPro = 0;
                            foreach( $fldnames as $dr){
                                if( $v->{$dr} >= $maxDate ){
                                    if( !in_array( $dr, $arrExLabel)){
                                        $maxDate = $v->{$dr};
                                        $maxFld = $dr;
                                    }
                                }
                                if($x == 1){ //major maintenace
                                    if( $v->{'bri05bridge_complete_check'} == 1 || $v->{'bri05work_completion_certificate_check'} == 1 ){
                                        $sumPro = '100';                                        
                                    } else {
                                        
                                        // if($v->{'bri05final_inspection_check'} == 1){
                                        //      $sumPro = '90';
                                        // }
                                        if( $v->{$dr.'_check'} == 1 ){
                                            $sumPro += $arrWeightList[ $dr ]->wei01value;
                                        }                                            
                                        
                                    }
                                } else {
                                    if( $v->{$dr.'_check'} == 1 ){
                                        $sumPro += $arrWeightList[ $dr ]['wei01value'];
                                    }
                                }
                            }
                            $v->maxDate = $maxDate;
                            $v->maxFld = $maxFld;								
                            $v->proValue = $sumPro;
                            
                            if($maxDate == "0000-00-00" || $maxDate =='') {
                                $v->maxProLabel = "";
                            } else {									
                                $v->maxProLabel = $arrWeightList[ $maxFld ]['wei01label'] .' completed on '. $maxDate;
                            }
                            
                            $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['bridge_List'][] =$v;
                            $allTotal += $v->proValue;
                        }
                                                    
                        if($allTotal != 0)
                        $data['avgWeightage'] = number_format( $allTotal/count($brige_list), 2);
                        else
                        $data['avgWeightage'] = number_format( 0, 2);
                    
                    $data['arrPrintList'] = $arrDataList;
                    //print_r($data['arrPrintList'] );
                } else
        {
            redirect("reports/Pro_Physical_Progress/".$stat);
        }
    } else
    {
        'start date is Smaller than End Date';
    }  //die();
    return view('\Modules\Reports\Views\Pro_Physical_Progress_report', $data);

  }

  public function loadmore() {
    
  }
}