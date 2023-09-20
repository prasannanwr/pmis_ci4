<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\logo_upload\Models\logo_upload_model;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_bridge_detail_model;
use App\Modules\view\Models\view_district_reg_office_model;

//use App\Modules\Reports\Models\ReportsModel;

class Est_Cont_Dist_DateWise_report extends BaseController
{

    private static $arrDefData = array();

    private $fiscal_year_model;
  
    private $view_bridge_detail_model;
  
    private $view_district_reg_office_model;
  
    private $template;
  
    public function __construct()
    {
      helper(['form', 'html', 'et_helper']);
      $fiscal_year_model = new FiscalYearModel();
      $view_bridge_detail_model = new view_bridge_detail_model();
      $view_district_reg_office_model = new view_district_reg_office_model();
      $this->fiscal_year_model = $fiscal_year_model;
      $this->view_bridge_detail_model = $view_bridge_detail_model;
      $this->view_district_reg_office_model = $view_district_reg_office_model;
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
            $dataStart = @$this->request->getVar('start_date');
            $dateEnd = @$this->request->getVar('end_date');
            $data['blnMM'] = $stat;
        
            $data['startdate'] = $dataStart;
            $data['enddate'] = $dateEnd;
            if ($Postback == 'Back')
            {
                redirect(site_url());
            } elseif ($dataStart <= $dateEnd)
            {
    
                if ($dataStart != 0 || $dateEnd != 0)
                {
                     $data['arrCostSuppList'] = $this->supporting_agencies_model->findAll();
                    $arrPrintList = array();
                    $data['arrDevList']= $this->district_name_model->findAll();
                             
                    $arrChild1=null;
                    if (empty($stat))
                    {
                        $this->view_brigde_detail_model->where('bri03construction_type',
                        ENUM_NEW_CONSTRUCTION);
                    } else
                    {
                        $this->view_brigde_detail_model->where('bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE);
                    }
    
                    $arrBridgeList = $this->view_brigde_detail_model->
                        where('bri05bridge_complete >=', $dataStart)->
                        where('bri05bridge_complete <=', $dateEnd)->
                        findAll();
                    
                    $arrBridgeIdList = null;
                    if(is_array( $arrBridgeList )){
                        foreach ($arrBridgeList as $k2 => $v2)
                        {
                            $arrChild2=null;
                            $arrBridgeIdList[] = $v2['bri03bridge_no'];
                            $arrPrintList['dist_'.$v2['dist01id']]['info']=$v2;
                            $arrPrintList['dist_'.$v2['dist01id']]['arrChildList'][] = array('info'=>$v2);
                        }
                    }
                    
                    $arrBridgeCostList = $this->view_all_actual_view_model->
                        whereIn('bri07bridge_no', $arrBridgeIdList)->view_bridge_estimated_supporting_cost();
                        
                    foreach ($arrBridgeCostList as $x2)
                    {
                        $arrCostList['bri_'.$x2['bri07bridge_no']]['id_' . $x2['bri07sup01id']] = $x2;
                    }
                           
                    
                    $data['arrPrintList'] = $arrPrintList;
                    $data['arrCostList'] = $arrCostList;
                     //print_r($arrPrintList);
                
            } else
                {
                    redirect("reports/Est_Cont_Dist_DateWise/".$stat);
                }
            } else
            {
                'start date is Smaller than End Date';
            }
              return view('\Modules\Reports\Views\Est_Cont_Dist_DateWise_report', $data);
            //$this->template->my_template($data); 
    }
}