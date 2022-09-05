<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\cost_components\Models\cost_components_model;
use App\Modules\district_name\Models\district_name_model;
use App\Modules\view\Models\view_bridge_actual_cost;
use App\Modules\view\Models\view_brigde_detail_model;
use App\Modules\view\Models\view_district_reg_office_model;

class Act_Dist_DateWise_report extends BaseController
{
  private static $arrDefData = array();

  private $cost_components_model;

  private $district_name_model;

  private $view_district_reg_office_model;

  private $view_brigde_detail_model;

  private $view_bridge_actual_cost;

  public function __construct()
  {
    helper(['form', 'html', 'et_helper']);

    $cost_components_model = new cost_components_model();
    $district_name_model = new district_name_model();
    $view_district_reg_office_model = new view_district_reg_office_model();
    $view_brigde_detail_model = new view_brigde_detail_model();
    $view_bridge_actual_cost = new view_bridge_actual_cost();
    $this->cost_components_model = $cost_components_model;
    $this->district_name_model = $district_name_model;
    $this->view_district_reg_office_model = $view_district_reg_office_model;
    $this->view_brigde_detail_model = $view_brigde_detail_model;
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
                $arrPrintList = array();
                $data['arrDevList']= $this->district_name_model->asObject()->findAll();
				$data['sel_district_filter'] ='';
				$data['arrDistList'] = $this->view_district_reg_office_model->asObject()->findAll();
                         
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
				
				if($this->request->getVar("selFilterByDistrict") != '') {
                          $distFilter = $this->request->getVar("selFilterByDistrict");
                          $this->view_brigde_detail_model->where('dist01id',$distFilter);
                          $data['sel_district_filter'] = $distFilter;
                        }

                            $this->view_brigde_detail_model->dbFilterCompleted();
                $arrBridgeList = $this->view_brigde_detail_model->
                    where('bri05bridge_complete >=', $dataStart)->
                    where('bri05bridge_complete <=', $dateEnd)->
                    asObject()->
                    findAll();
					
					
                
                $arrBridgeIdList = null;
                if(is_array( $arrBridgeList )){
                    foreach ($arrBridgeList as $k2 => $v2)
                    {
                        $arrChild2=null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        $arrPrintList['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['dist_'.$v2->dist01id]['arrChildList'][] = array('info'=>$v2);
                    }
                }
                
                $arrBridgeCostList = $this->view_bridge_actual_cost->
                    whereIn('bri08bridge_no', $arrBridgeIdList)->
                    asObject()->
                    findAll();
                    
                foreach ($arrBridgeCostList as $x2)
                {
                    $arrCostList['bri_'.$x2->bri08bridge_no]['id_' . $x2->bri08cmp01id] = $x2;
                }
                       
                
                $data['arrPrintList'] = $arrPrintList;
                $data['arrCostList'] = $arrCostList;
                 //print_r($arrPrintList);
            } else
            {
                redirect("reports/Act_Dist_DateWise/".$stat);
            }
        } else
        {
            'start date is Smaller than End Date';
        }
        //$this->template->my_template($data);
        
    return view('\Modules\Reports\Views\Act_Dist_DateWise_report', $data);
  }
}