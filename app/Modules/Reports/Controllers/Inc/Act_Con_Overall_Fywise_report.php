<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\district_name\Models\district_name_model;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\supporting_agencies\Models\supporting_agencies_model;
use App\Modules\view\Models\view_bridge_actual_supporting_cost;
use App\Modules\view\Models\view_bridge_detail_model;

//use App\Modules\Reports\Models\ReportsModel;

class Act_Con_Overall_Fywise_report extends BaseController
{
  //private static $arrDefData = array();

  private $fiscal_year_model;

  private $view_bridge_actual_supporting_cost;

  private $view_bridge_detail_model;

  private $supporting_agencies_model;

  private $district_name_model;

  public function __construct()
  {
    helper(['form', 'html', 'et_helper']);
    $fiscal_year_model = new FiscalYearModel();
    $view_bridge_detail_model = new view_bridge_detail_model();
    $view_bridge_actual_supporting_cost = new view_bridge_actual_supporting_cost();
    $supporting_agencies_model = new supporting_agencies_model();
    $district_name_model = new district_name_model();
    $this->fiscal_year_model = $fiscal_year_model;
    $this->view_bridge_detail_model = $view_bridge_detail_model;
    $this->view_bridge_actual_supporting_cost = $view_bridge_actual_supporting_cost;
    $this->supporting_agencies_model = $supporting_agencies_model;
    $this->district_name_model = $district_name_model;
    // if (count(self::$arrDefData) <= 0) {
    //   $FName = basename(__FILE__, '.php');
    //   $fName = strtolower($FName);
    //   self::$arrDefData = array(
    //     'title'         => $FName,
    //     'breadcrumb'    => array(array('text' => $FName, 'link' => $fName)),
    //     'module'        => $fName,
    //     'view_file'     => 'index',
    //   );
    // }
  }

  public function index($stat = '')
  {
    $Postback = @$this->request->getVar('submit');
    $dataStart = @$this->request->getVar('start_year');
    $dateEnd = @$this->request->getVar('end_year');
   // $data = self::$arrDefData;
    $data['view_file'] = __function__;
    $data['blnMM'] = $stat;

    $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->asObject()->first();
    $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->asObject()->first();


    if ($Postback == 'Back') {
        redirect("reports/main_completed_bridges");
    } elseif ($dataStart <= $dateEnd) {
        if ($dataStart != 0 || $dateEnd != 0) {
            $data['arrCostCompList'] = $this->supporting_agencies_model->asObject()->findAll();
             $arrPrintList = array();
             $data['arrDevList'] = $this->district_name_model->asObject()->findAll();

            $arrChild1 = null;
            if (empty($stat)) {
                $b_type = ENUM_NEW_CONSTRUCTION;
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_NEW_CONSTRUCTION
                );
            } else {
                $b_type = ENUM_MAJOR_MAINTENANCE;
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_MAJOR_MAINTENANCE
                );
            }
            //$this->view_bridge_detail_model->dbFilterCompleted();
            /*$arrBridgeList = $this->view_bridge_detail_model->
                where('bri03project_fiscal_year >=', $dataStart)->
                where('bri03project_fiscal_year <=', $dateEnd)->
                findAll();*/
            $arrBridgeList = $this->view_bridge_detail_model->where('bri05bridge_completion_fiscalyear >=', $dataStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri05bridge_complete_check', 1)->where('bri03construction_type', $b_type)->asObject()->findAll();
            
            $arrBridgeIdList = null;
            if (is_array($arrBridgeList)) {
                foreach ($arrBridgeList as $k2 => $v2) {
                    $arrChild2 = null;

                    $bri03bridge_no = trim($v2->bri03bridge_no);
                    //$bridgeToalCostAmount = $this->contribution_agencies_model->getSum($bri03bridge_no);

                    //if($bridgeToalCostAmount->totalAmt > 0) {

                    $arrBridgeIdList[] = $v2->bri03bridge_no;
                    $arrPrintList['dist_' . $v2->dist01id]['info'] = $v2;
                    $arrPrintList['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    //}


                }
            }
            
            $arrBridgeCostList = $this->view_bridge_actual_supporting_cost->whereIn('bri08bridge_no', $arrBridgeIdList)->asObject()->findAll();

            foreach ($arrBridgeCostList as $x2) {
                $arrCostList['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08sup01id] = $x2;
            }


            $data['arrPrintList'] = $arrPrintList;
            $data['arrCostList'] = $arrCostList;
        } else {
            redirect("reports/Act_Con_Overall_Fywise/" . $stat);
        }
    } else {
        'start date is Smaller than End Date';
    }
    return view('\Modules\Reports\Views\Act_Con_Overall_Fywise_report', $data);
  }
}