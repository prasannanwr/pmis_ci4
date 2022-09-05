<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\view\Models\view_bridge_actual_cost;
use App\Modules\view\Models\view_bridge_detail_model;
use App\Modules\view\Models\view_district_reg_office_model;

//use App\Modules\Reports\Models\ReportsModel;

class Act_Supporting_AgencyWise_DateWise extends BaseController
{

    private static $arrDefData = array();

    private $view_bridge_detail_model;
  
    private $view_district_reg_office_model;

    private $view_bridge_actual_cost;
  
    public function __construct()
    {
      helper(['form', 'html', 'et_helper']);
      $view_bridge_detail_model = new view_bridge_detail_model();
      $view_district_reg_office_model = new view_district_reg_office_model();
      $view_bridge_actual_cost = new view_bridge_actual_cost();
      $this->view_bridge_detail_model = $view_bridge_detail_model;
      $this->view_district_reg_office_model = $view_district_reg_office_model;
      $this->view_bridge_actual_cost = $view_bridge_actual_cost;
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
            $dataStart = @$this->request->getVar('start_date');
            $dateEnd = @$this->request->getVar('end_date');

        $data['blnMM'] = $stat;
        $selAgency = @$this->request->getPost('selAgency'); // supporting agency        
        
        $data['dataStart'] = $dataStart;
        $data['dateEnd'] = $dateEnd;
        $data['selAgency'] = $selAgency;
    
        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back')
        {
            redirect(site_url());
        } elseif ($dataStart <= $dateEnd)
        {
            if ($dataStart != 0 || $dateEnd != 0)
            {
                $data['arrCostCompList'] = $this->cost_components_model->asObject()->findAll();
                $arrDistList = $this->view_regional_office_model->asObject()->findAll();
                $arrSupList = $this->supporting_agencies_model->asObject()->findAll();
                $arrPrintList = array();
                      if (empty($stat))
                {
                    $this->view_brigde_detail_model->where('bri03construction_type',
                        ENUM_NEW_CONSTRUCTION);
                } else
                {
                    $this->view_brigde_detail_model->where('bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE);
                }

                $this->view_brigde_detail_model->dbFilterCompleted();

                 if($selAgency != '' && strtolower($selAgency) != "all") {                    
                        $data['arrDevList']= $this->view_brigde_detail_model->
                        where('bri05bridge_complete >=',$dataStart)->
                       where('bri05bridge_complete <=', $dateEnd)->
                        where('bri03supporting_agency =', $selAgency)->
                        asObject()->
                        findAll();
                    } else {
                         $data['arrDevList']= $this->view_brigde_detail_model->
                        where('bri05bridge_complete >=',$dataStart)->
                       where('bri05bridge_complete <=', $dateEnd)->asObject()->findAll();
                    }    

               
                
                if (is_array($arrSupList)){
                     foreach ($arrSupList as $k => $v){
                        $data['arrsupportList']['sup_'.$v->sup01id] = $v;
                     }
                }
                 if (is_array($arrDistList)){
                     foreach ($arrDistList as $k => $v){
                        $data['arrDistrictList']['dist_'.$v->dist01id] = $v;
                     }
                }
              //print_r( $data['arrDistrictList']);
              //  print_r($data['arrsupportList']);
              
                  $arrBridgeIdList=null;
                    if (is_array($data['arrDevList'])){
                        foreach ($data['arrDevList'] as $k => $v2){
                            $arrChild2=null;
                            $arrBridgeIdList[]=$v2->bri03bridge_no;
                        //$arrPrintList['sup_'.$v2->sup01id]['info']=$v2;
                        //$arrPrintList['sup_'.$v2->sup01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['sup_'.$v2->sup01id]['arrChildList']['dist_'.$v2->dist01id]['arrChildList'][] = array('info'=>$v2);
                         }
                    }
              
                        
                        
                        $arrBridgeCostList = $this->view_bridge_actual_cost->
                            whereIn('bri08bridge_no', $arrBridgeIdList)->asObject()->
                            findAll();
                        foreach ($arrBridgeCostList as $x2)
                        {
                        
                        $arrChild2['bri_'.$x2->bri08bridge_no]['id_' . $x2->bri08cmp01id] = $x2;
                        }
                        
                        $data['arrCostList'] = $arrChild2;
                        //$arrChild = array('info' => $v, 'arrChildList' => $arrChild2);
                        //$arrPrintList['sup_'.$v->sup01id]['dist_'.$v->dist01id][] = $arrChild;
                                         
                         
               
             //print_r($arrPrintList);
                $data['arrPrintList'] = $arrPrintList;
                //die();
                
            } else
            {
                redirect("reports/Act_Supporting_AgencyWise_DateWise/".$stat);
            }
        } else
        {
            'start date is Smaller than End Date';
        }
              return view('\Modules\Reports\Views\Act_Supporting_AgencyWise_DateWise_report', $data);
            //$this->template->my_template($data); 
    }
}