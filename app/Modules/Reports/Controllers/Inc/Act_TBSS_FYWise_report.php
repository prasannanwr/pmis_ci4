<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\cost_components\Models\cost_components_model;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\regional_office\Models\regional_office_model;
use App\Modules\view\Models\view_bridge_actual_cost;
use App\Modules\view\Models\view_brigde_detail_model;
use App\Modules\view\Models\view_regional_office_model;

//use App\Modules\Reports\Models\ReportsModel;

class Act_TBSS_FYWise_report extends BaseController
{
    private static $arrDefData = array();

    private $fiscal_year_model;

    private $cost_components_model;
  
    private $view_brigde_detail_model;
  
    private $view_bridge_actual_cost;

    private $regional_office_model;

    private $view_regional_office_model;

    public function __construct()
    {
        helper(['form', 'html', 'et_helper']);
        $fiscal_year_model = new FiscalYearModel();
    $cost_components_model = new cost_components_model();
    $view_brigde_detail_model = new view_brigde_detail_model();
    $view_bridge_actual_cost = new view_bridge_actual_cost();
    $regional_office_model = new regional_office_model();
    $view_regional_office_model = new view_regional_office_model();
    $this->fiscal_year_model = $fiscal_year_model;
    $this->cost_components_model = $cost_components_model;
    $this->view_brigde_detail_model = $view_brigde_detail_model;
    $this->view_bridge_actual_cost = $view_bridge_actual_cost;
    $this->regional_office_model = $regional_office_model;
    $this->view_regional_office_model = $view_regional_office_model;
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
        $data['blnMM'] = $stat;
        $data['title'] = "Overall";

        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->asObject()->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->asObject()->first();

        if ($Postback == 'Back') {
            redirect(site_url());
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->cost_components_model->asObject()->findAll();
                $arrPrintList = array();
                $data['arrDevList'] = $this->regional_office_model->asObject()->findAll();

                if (is_array($data['arrDevList'])) {

                    foreach ($data['arrDevList'] as $k => $v) {
                        $arrChild = null;
                        //dev region
                        //$arrDistList=$this->view_regional_office_model->findAll(); //->where('tbis01id', $v->tbis01id)
                        $arrDistList = $this->view_regional_office_model->where('dist01tbis01id', $v->tbis01id)->asObject()->findAll();

                        if (is_array($arrDistList)) {

                            foreach ($arrDistList as $k1 => $v1) {
                                $arrChild1 = null;
                                if (empty($stat)) {
                                    $this->view_brigde_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_NEW_CONSTRUCTION
                                    );
                                } else {
                                    $this->view_brigde_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_MAJOR_MAINTENANCE
                                    );
                                }
                                $this->view_brigde_detail_model->dbFilterCompleted();
                                $arrBridgeList = $this->view_brigde_detail_model->where('bri03project_fiscal_year >=', $dataStart)->where('bri03project_fiscal_year <=', $dateEnd)->where('dist01id', $v1->dist01id)->asObject()->findAll();

                                foreach ($arrBridgeList as $k2 => $v2) {
                                    $arrChild2 = null;


                                    $arrBridgeCostList = $this->view_bridge_actual_cost->where('bri08bridge_no', $v2->bri03bridge_no)->asObject()->findAll();
                                    // foreach ($arrBridgeCostList as $x2)
                                    //{

                                    // $arrChild2['id_' . $x2->bri08cmp01id] = $x2;
                                    //}


                                    $arrChild1[] = array('info' => $v2); //, 'arrChildList' => $arrChild2);
                                    //$row['cost'] = $newData;
                                } //bridge list for
                                if ($arrChild1) {
                                    $arrChild[] = array('info' => $v1, 'arrChildList' => $arrChild1);
                                }
                            }
                        }
                        if ($arrChild) {
                            $arrPrintList[] = array('info' => $v, 'arrChildList' => $arrChild);
                        }
                    }
                }
                //print_r($arrPrintList);
                $data['arrPrintList'] = $arrPrintList;
            } else {
                redirect("reports/Act_TBSS_FYWise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        return view('\Modules\Reports\Views\Act_TBSS_FYWise_report', $data);
    }
}