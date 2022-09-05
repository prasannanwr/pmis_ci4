<?php

namespace App\Modules\Reports\Controllers;

use App\Controllers\BaseController;
use App\Modules\bridge\Models\bridge_est_cost_model;
use App\Modules\bridge\Models\bridge_model;
use App\Modules\bridge\Models\contribution_agencies_model;
use App\Modules\bridge_type\Models\bridge_type_model;
use App\Modules\cost_components\Models\cost_components_model;
use App\Modules\district_name\Models\district_name_model;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\template\Controllers\Template;
use App\Modules\vdc_municipality\Models\vdc_municipality_model;
use App\Modules\view\Models\view_bridge_detail_model;
use App\Modules\view\Models\view_district_reg_office_model;
use App\Modules\view\Models\view_vdc_model;
use App\Modules\supporting_agencies\Models\supporting_agencies_model;
use App\Modules\view\Models\view_for_detail_bridge_model;
use App\Modules\view\Models\view_sup03_dist01_bri05_count_carry_previous;
use App\Modules\view\Models\view_dist01_bri05_count_first_constraction_fiscalyear;
use App\Modules\view\Models\view_count_material_handover_fiscalyear;
use App\Modules\view\Models\view_dist01_bri05_count_bridge_completion_fiscalyear_new;
use App\Modules\view\Models\view_count_steel_parts_fiscalyear;
use App\Modules\view\Models\view_count_cable_pulling_fiscalyear;
use App\Modules\view\Models\view_sup03_dist01_bri05_count_site_assessment_dist_new;
use App\Modules\view\Models\view_sup03_dist01_bri05_count_design_estimate_bridges_new;
use App\Modules\view\Models\view_sup03_dist01_bri05_count_community_agreement_dist_new;
use App\Modules\fiscal_data\Models\fiscal_data_model;
use App\Modules\view\Models\view_bridge_actual_supporting_cost;
use App\Modules\view\Models\view_regional_office_model;
use App\Modules\regional_office\Models\regional_office_model;
use App\Modules\view\Models\view_bridge_actual_cost;
//use App\Modules\Reports\Models\ReportsModel;

class Reports extends BaseController
{
    private static $arrDefData = array();

    private $fiscal_year_model;

    private $view_bridge_detail_model;

    private $view_district_reg_office_model;

    private $template;

    private $vcd_municipality_model;

    private $district_name_model;

    private $view_vdc_model;

    private $supporting_agencies_model;

    private $view_sup03_dist01_bri05_count_carry_previous;

    private $bridge_model;

    private $cost_components_model;

    private $view_for_detail_bridge_model;

    private $bridge_type_model;

    private $bridge_est_cost_model;

    private $contribution_agencies_model;

    private $view_dist01_bri05_count_first_constraction_fiscalyear;

    private $view_count_material_handover_fiscalyear;

    private $view_dist01_bri05_count_bridge_completion_fiscalyear_new;

    private $view_count_steel_parts_fiscalyear;

    private $view_count_cable_pulling_fiscalyear;

    private $view_sup03_dist01_bri05_count_site_assessment_dist_new;

    private $view_sup03_dist01_bri05_count_design_estimate_bridges_new;

    private $view_sup03_dist01_bri05_count_community_agreement_dist_new;

    private $fiscal_data_model;

    private $view_bridge_actual_supporting_cost;

    private $view_regional_office_model;

    private $regional_office_model;

    private $view_bridge_actual_cost;

    public function __construct()
    {
        helper(['form', 'html', 'et_helper']);
        $fiscal_year_model = new FiscalYearModel();
        $view_bridge_detail_model = new view_bridge_detail_model();
        $view_district_reg_office_model = new view_district_reg_office_model();
        $vcd_municipality_model = new vdc_municipality_model();
        $district_name_model = new district_name_model();
        $view_vdc_model  = new view_vdc_model();
        $supporting_agencies_model = new supporting_agencies_model();
        $view_sup03_dist01_bri05_count_carry_previous = new view_sup03_dist01_bri05_count_carry_previous();
        $bridge_model = new bridge_model();
        $cost_components_model = new cost_components_model();
        $view_for_detail_bridge_model = new view_for_detail_bridge_model();
        $bridge_est_cost_model = new bridge_est_cost_model();
        $bridge_type_model = new bridge_type_model();
        $contribution_agencies_model = new contribution_agencies_model();
        $view_dist01_bri05_count_first_constraction_fiscalyear = new view_dist01_bri05_count_first_constraction_fiscalyear();
        $view_count_material_handover_fiscalyear = new view_count_material_handover_fiscalyear();
        $view_dist01_bri05_count_bridge_completion_fiscalyear_new = new view_dist01_bri05_count_bridge_completion_fiscalyear_new();
        $view_count_steel_parts_fiscalyear = new view_count_steel_parts_fiscalyear();
        $view_count_cable_pulling_fiscalyear = new view_count_cable_pulling_fiscalyear();
        $view_sup03_dist01_bri05_count_site_assessment_dist_new = new view_sup03_dist01_bri05_count_site_assessment_dist_new();
        $view_sup03_dist01_bri05_count_design_estimate_bridges_new = new view_sup03_dist01_bri05_count_design_estimate_bridges_new();
        $view_sup03_dist01_bri05_count_community_agreement_dist_new = new view_sup03_dist01_bri05_count_community_agreement_dist_new();
        $fiscal_data_model = new fiscal_data_model();
        $view_bridge_actual_supporting_cost = new view_bridge_actual_supporting_cost();
        $view_regional_office_model = new view_regional_office_model();
        $regional_office_model = new regional_office_model();
        $view_bridge_actual_cost = new view_bridge_actual_cost();
        $this->fiscal_year_model = $fiscal_year_model;
        $this->fiscal_data_model = $fiscal_data_model;
        $this->view_bridge_detail_model = $view_bridge_detail_model;
        $this->view_district_reg_office_model = $view_district_reg_office_model;
        $this->vcd_municipality_model = $vcd_municipality_model;
        $this->district_name_model = $district_name_model;
        $this->view_vdc_model = $view_vdc_model;
        $this->supporting_agencies_model = $supporting_agencies_model;
        $this->view_sup03_dist01_bri05_count_carry_previous = $view_sup03_dist01_bri05_count_carry_previous;
        $this->bridge_model = $bridge_model;
        $this->cost_components_model = $cost_components_model;
        $this->view_for_detail_bridge_model = $view_for_detail_bridge_model;
        $this->bridge_type_model = $bridge_type_model;
        $this->bridge_est_cost_model = $bridge_est_cost_model;
        $this->contribution_agencies_model = $contribution_agencies_model;
        $this->view_dist01_bri05_count_first_constraction_fiscalyear = $view_dist01_bri05_count_first_constraction_fiscalyear;
        $this->view_count_material_handover_fiscalyear = $view_count_material_handover_fiscalyear;
        $this->view_dist01_bri05_count_bridge_completion_fiscalyear_new = $view_dist01_bri05_count_bridge_completion_fiscalyear_new;
        $this->view_count_steel_parts_fiscalyear = $view_count_steel_parts_fiscalyear;
        $this->view_count_cable_pulling_fiscalyear = $view_count_cable_pulling_fiscalyear;
        $this->view_sup03_dist01_bri05_count_site_assessment_dist_new = $view_sup03_dist01_bri05_count_site_assessment_dist_new;
        $this->view_sup03_dist01_bri05_count_design_estimate_bridges_new = $view_sup03_dist01_bri05_count_design_estimate_bridges_new;
        $this->view_sup03_dist01_bri05_count_community_agreement_dist_new = $view_sup03_dist01_bri05_count_community_agreement_dist_new;
        $this->view_bridge_actual_supporting_cost = $view_bridge_actual_supporting_cost;
        $this->view_regional_office_model = $view_regional_office_model;
        $this->regional_office_model = $regional_office_model;
        $this->view_bridge_actual_cost = $view_bridge_actual_cost;

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
    public function index()
    {
        return view('\Modules\Dashboard\Views\Index');
    }

    public function Gen_Overall_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\Gen_Overall_FYWise', $data);
    }

    public function Gen_Overall_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // 
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views\Gen_Overall_DateWise', $data);
    }

    function main_completed_bridges()
    {
        $data = self::$arrDefData;
        $data['view_file'] = 'main_completed_bridges/main_completed_bridges';
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function districtwise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('district_name/district_name_model');
        $data['arrDistList'] = $this->district_name_model->findAll();
        $data['major'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function districtwise_report($stat = '')
    {
        //var_dump($_POST);

        $selDist = (int)@$this->request->getVar('selDist');
        $data = self::$arrDefData;

        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;
        //$data['arrDevInfo1'] = $selDist;

        //$this->load->model('view/view_bridge_detail_model');
        //$this->load->model('vcd_municipality/vcd_municipality_model');
        $this->load->model('view/view_district_reg_office_model');
        $data['arrDevInfo'] = $this->view_district_reg_office_model->where('dist01id', $selDist)->first();
        $data['major'] = $stat;

        //var_dump($data['arrDevInfo']);

        //print_r($this->view_bridge_detail_model);
        if ($selDist != 0) {
            if (empty($stat)) {
                $this->view_bridge_detail_model->where('bri03construction_type', ENUM_NEW_CONSTRUCTION);
            } else {
                $this->view_bridge_detail_model->where('bri03construction_type', ENUM_MAJOR_MAINTENANCE);
            }
            $data['arrsDataList'] = $this->view_bridge_detail_model->where('dist01id', $selDist)->findAll();
            // var_dump( $data['arrsDataList']);
        } else {
            redirect("reports/districtwise");
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function districtwise_print($stat = '')
    {
        $selDist = (int)@$this->input->get('id');
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('view/view_bridge_detail_model');
        //$this->load->model('vcd_municipality/vcd_municipality_model');
        $this->load->model('view/view_district_reg_office_model');
        $data['arrDevInfo'] = $this->view_district_reg_office_model->where('dist01id', $selDist)->first();

        if (empty($stat)) {
            $this->view_bridge_detail_model->where('bri03construction_type', ENUM_NEW_CONSTRUCTION);
        } else {
            $this->view_bridge_detail_model->where('bri03construction_type', ENUM_MAJOR_MAINTENANCE);
        }
        $data['arrsDataList'] = $this->view_bridge_detail_model->where('dist01id', $selDist)->findAll();
        $this->template->print_template($data);
    }
    function devregionwise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('development_region/development_region_model');
        $data['arrDistList'] = $this->development_region_model->findAll();
        $data['major'] = $ext;

        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function devregionwise_reportQQ($stat = '')
    {
        //var_dump($_POST);
        $selDist = (int)@$this->request->getVar('selDist');
        $Postback = @$this->request->getVar('submit');

        $data = self::$arrDefData;

        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;
        $data['arrDevInfo'] = $selDist;

        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('view/view_district_reg_office_model');
        $data['arrDevInfo'] = $this->view_district_reg_office_model->where('dev01id', $selDist)->first();
        $data['major'] = $stat;

        if ($selDist != 0) {
            if (empty($stat)) {
                $this->view_bridge_detail_model->where('bri03construction_type', ENUM_NEW_CONSTRUCTION);
            } else {
                $this->view_bridge_detail_model->where('bri03construction_type', ENUM_MAJOR_MAINTENANCE);
            }
            $data['arrDevtList'] = $this->view_bridge_detail_model->where('dev01id', $selDist)->findAll();
        } else {
            redirect("reports/devregionwise");
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function devregionwise_report_old($stat = '')
    {
        //var_dump($_POST);
        //die();
        $selDist = (int)@$this->request->getVar('selDist');
        $Postback = @$this->request->getVar('submit');
        $data = self::$arrDefData;

        $data['view_file'] = __function__;

        $data['blnMM'] = $stat;
        //$data['arrDevInfo'] = $selDist;
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('view/view_district_model');
        $this->load->model('view/view_vdc_model');

        if ($selDist != 0) {


            $data['arrDevList'] = $this->development_region_model->where('dev01id', $selDist)->findAll();
            //var_dump($data['arrDevList']);
            // die();
            $arrPrintList = array();
            if (is_array($data['arrDevList'])) {

                foreach ($data['arrDevList'] as $k => $v) {
                    $arrChild = null;

                    $arrDistList = $this->view_vdc_model->where('dev01id', $v->dev01id)->findAll();

                    if (is_array($arrDistList)) {

                        foreach ($arrDistList as $k1 => $v1) {
                            $arrChild1 = null;

                            if (empty($stat)) {
                                $this->view_bridge_detail_model->where(
                                    'bri03construction_type',
                                    ENUM_NEW_CONSTRUCTION
                                );
                            } else {
                                $this->view_bridge_detail_model->where(
                                    'bri03construction_type',
                                    ENUM_MAJOR_MAINTENANCE
                                );
                            }
                            $arrBridgeList = $this->view_bridge_detail_model->where('bri03major_vdc_id', $v1->muni01id)->findAll();

                            $arrChild1 = $arrBridgeList;
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

            $data['arrPrintList'] = $arrPrintList;
            // print_r($arrPrintList);

        } else {
            redirect("reports/devregionwise");
        }

        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function devregionwise_report($stat = '')
    {
        //var_dump($_POST);
        //die();
        $selDist = (int)@$this->request->getVar('selDist');
        $Postback = @$this->request->getVar('submit');
        $data = self::$arrDefData;

        $data['view_file'] = __function__;

        $data['blnMM'] = $stat;
        $data['arrDevInfo'] = $selDist;
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('development_region/development_region_model');
        // $this->load->model('view/view_district_model');
        // $this->load->model('view/view_vdc_model');

        if ($selDist != 0) {

            if (empty($stat)) {
                $this->view_bridge_detail_model->where('bri03construction_type', ENUM_NEW_CONSTRUCTION);
            } else {
                $this->view_bridge_detail_model->where('bri03construction_type', ENUM_MAJOR_MAINTENANCE);
            }
            $arrDataList = $this->view_bridge_detail_model->where('dev01id', $selDist)->findAll();
            $row = array();
            if (is_array($arrDataList)) {
                foreach ($arrDataList as &$dr) {
                    $row['dev_' . $dr->dev01id]['dist_' . $dr->dist01id][] = $dr;
                }
                unset($dr);
            }
            unset($arrDataList);
            //print_r( $row );
            $data['arrPrintList'] = $row;
        } else {
            redirect("reports/devregionwise/" . $stat);
        }


        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }




    function devregionwise_print($stat = '')
    {
        //var_dump($_POST);
        //die();
        $selDist = (int)@$this->request->getVar('selDist');
        $Postback = @$this->request->getVar('submit');
        $data = self::$arrDefData;

        $data['view_file'] = __function__;

        $data['blnMM'] = $stat;
        $data['arrDevInfo'] = $selDist;
        $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('development_region/development_region_model');
        //$this->load->model('view/view_district_model');
        //$this->load->model('view/view_vdc_model');

        if ($selDist != 0) {

            if (empty($stat)) {
                $this->view_bridge_detail_model->where('bri03construction_type', ENUM_NEW_CONSTRUCTION);
            } else {
                $this->view_bridge_detail_model->where('bri03construction_type', ENUM_MAJOR_MAINTENANCE);
            }
            $arrDataList = $this->view_bridge_detail_model->where('dev01id', $selDist)->findAll();

            if (is_array($arrDataList)) {
                foreach ($arrDataList as &$dr) {
                    $row['dev_' . $dr->dev01id]['dist_' . $dr->dist01id][] = $dr;
                }
                unset($dr);
            }
            unset($arrDataList);
            //print_r( $row );
            $data['arrPrintList'] = $row;
        } else {
            redirect("reports/devregionwise/" . $stat);
        }


        $this->template->print_template($data);
    }

    function Bridgewise($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;
        //  $this->load->model('bridge/bridge_model');
        // $this->load->model('view/view_bridge_detail_model');

        if (empty($stat)) {
            $this->bridge_model->where('bri03construction_type', ENUM_NEW_CONSTRUCTION);
        } else {
            $this->bridge_model->where('bri03construction_type', ENUM_MAJOR_MAINTENANCE);
        }

        $data['arrDistList'] = $this->bridge_model->orderBy('bri03bridge_name')->findAll();
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Bridgewise_report($stat = '')
    {
        //var_dump($_POST);
        $selDist = (int)@$this->request->getVar('selDist');
        $Postback = @$this->request->getVar('submit');
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;
        // $this->load->model('view/view_for_detail_bridge_model');
        // $this->load->model('supporting_agencies/supporting_agencies_model');
        // $this->load->model('cost_components/cost_components_model');
        // $this->load->model( 'bridge/contribution_agencies_model' );
        // $this->load->model( 'bridge/bridge_est_cost_model' );
        // $this->load->model('bridge_type/bridge_type_model');


        //bri01bridge_type_table

        //$data['arrDevInfo'] = $this->view_for_detail_bridge_model->first();
        $data['arrSupList'] = $this->supporting_agencies_model->findAll();
        $data['arrCostCompList'] = $this->cost_components_model->findAll();


        if ($Postback == 'Back') {
            redirect("reports");
        } else {

            if ($selDist != 0) {
                $data['arrDevtinfo'] = $this->view_for_detail_bridge_model->where('bri03id', $selDist)->first();
                $data['arrDevInfo'] = $this->view_for_detail_bridge_model->where('bri03bridge_no', $data['arrDevtinfo']['bri03bridge_no'])->first();

                $data["bridgeType"] = $this->bridge_type_model->where("bri01id", $data['arrDevInfo']['bri03bridge_type'])->first();
                //var_dump($data['arrDevInfo']);
                $data['arrEstCost'] = $this->bridge_est_cost_model->where('bri07bridge_no', $data['arrDevtinfo']['bri03bridge_no'])->asObject()->findAll();
                $data['arrCstCost'] = $this->contribution_agencies_model->where('bri08bridge_no', $data['arrDevtinfo']['bri03bridge_no'])->findAll();
            } else {

                redirect("reports/Bridgewise/" . $stat);
            }
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Bridgewise_print()
    {
        //var_dump($_POST);
        $selDist = (int)@$this->input->get('id');
        $Postback = @$this->request->getVar('submit');
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $this->load->model('view/view_bridge_major_vdc_model');

        $this->load->model('view/view_for_detail_bridge_model');
        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('cost_components/cost_components_model');
        $this->load->model('bridge/contribution_agencies_model');
        $this->load->model('bridge/bridge_est_cost_model');

        //$data['arrDevInfo'] = $this->view_for_detail_bridge_model->first();
        $data['arrSupList'] = $this->supporting_agencies_model->findAll();
        $data['arrCostCompList'] = $this->cost_components_model->findAll();

        $data['arrDevInfo'] = $this->view_bridge_major_vdc_model->first();
        if ($Postback == 'Back') {
            redirect("reports");
        } else {

            if ($selDist != 0) {
                // $data['arrDevtList'] = $this->view_bridge_major_vdc_model->where('bri03id', $selDist)->findAll();
                //var_dump($data['arrDevtList']);

                $data['arrDevtinfo'] = $this->view_for_detail_bridge_model->where('bri03id', $selDist)->first();
                $data['arrDevInfo'] = $this->view_for_detail_bridge_model->where('bri03bridge_no', $data['arrDevtinfo']->bri03bridge_no)->first();
                //var_dump($data['arrDevInfo']);
                $data['arrEstCost'] = $this->bridge_est_cost_model->where('bri07bridge_no', $data['arrDevtinfo']->bri03bridge_no)->findAll();
                $data['arrCstCost'] = $this->contribution_agencies_model->where('bri08bridge_no', $data['arrDevtinfo']->bri03bridge_no)->findAll();
            } else {

                redirect("reports/Bridgewise");
            }
        }
        $this->template->print_template($data);
    }

    function tbss_regionwise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $this->load->model('regional_office/regional_office_model');
        $data['arrDistList'] = $this->regional_office_model->findAll();
        $data['major'] = $ext;

        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function tbss_regionwise_report($stat = '')
    {
        //var_dump($_POST);
        $selDist = (int)@$this->request->getVar('selDist');
        $Postback = @$this->request->getVar('submit');
        $data = self::$arrDefData;

        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;
        $data['arrDevInfo'] = $selDist;
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('regional_office/regional_office_model');
        $this->load->model('view/view_district_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_all_views_model');
        $this->load->model('view/view_vdc_model');


        if ($selDist != 0) {


            $data['arrDevList'] = $this->regional_office_model->where('tbis01id', $selDist)->findAll();
            $arrPrintList = array();
            if (is_array($data['arrDevList'])) {

                foreach ($data['arrDevList'] as $k => $v) {
                    $arrChild = null;

                    $arrDistList = $this->view_vdc_model->where('dev01id', $v->tbis01dev01id)->findAll();
                    if (is_array($arrDistList)) {

                        foreach ($arrDistList as $k1 => $v1) {
                            $arrChild1 = null;

                            if (empty($stat)) {
                                $this->view_bridge_detail_model->where(
                                    'bri03construction_type',
                                    ENUM_NEW_CONSTRUCTION
                                );
                            } else {
                                $this->view_bridge_detail_model->where(
                                    'bri03construction_type',
                                    ENUM_MAJOR_MAINTENANCE
                                );
                            }
                            $arrBridgeList = $this->view_bridge_detail_model->where('bri03major_vdc_id', $v1->muni01id)->findAll();
                            $arrChild1 = $arrBridgeList;
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

            $data['arrPrintList'] = $arrPrintList;
            //print_r($arrPrintList);

        } else {
            redirect("reports/tbss_regionwise/" . $stat);
        }

        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function tbss_regionwise_report____($stat = '')
    {
        //var_dump($_POST);
        $selDist = (int)@$this->request->getVar('selDist');
        $Postback = @$this->request->getVar('submit');
        $data = self::$arrDefData;

        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;
        $data['arrDevInfo'] = $selDist;
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('regional_office/regional_office_model');
        $this->load->model('view/view_district_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_all_views_model');
        $this->load->model('view/view_vdc_model');

        if ($selDist != 0) {
            if (empty($stat)) {
                $this->view_bridge_detail_model->where('bri03construction_type', ENUM_NEW_CONSTRUCTION);
            } else {
                $this->view_bridge_detail_model->where('bri03construction_type', ENUM_MAJOR_MAINTENANCE);
            }
            $arrDataList = $this->view_bridge_detail_model->where('tbis01id', $selDist)->findAll();

            if (is_array($arrDataList)) {
                foreach ($arrDataList as &$dr) {
                    $row['reg_' . $dr->tbis01id]['dist_' . $dr->dist01id][] = $dr;
                }
                unset($dr);
            }
            unset($arrDataList);
            //print_r( $row );
            $data['arrPrintList'] = $row;
        } else {
            redirect("reports/tbss_regionwise/" . $stat);
        }

        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function tbss_regionwise_print($stat = '')
    {
        $selDist = (int)@$this->input->get('id');
        $Postback = @$this->request->getVar('submit');

        $data = self::$arrDefData;

        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;
        $data['arrDevInfo'] = $selDist;
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('district_name/district_name_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('regional_office/regional_office_model');
        $this->load->model('view/view_district_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_views_model');


        if ($selDist != 0) {


            $data['arrDevList'] = $this->regional_office_model->where('tbis01id', $selDist)->findAll();
            $arrPrintList = array();
            if (is_array($data['arrDevList'])) {

                foreach ($data['arrDevList'] as $k => $v) {
                    $arrChild = null;

                    $arrDistList = $this->view_vdc_model->where('dev01id', $v->tbis01dev01id)->findAll();
                    if (is_array($arrDistList)) {

                        foreach ($arrDistList as $k1 => $v1) {
                            $arrChild1 = null;

                            if (empty($stat)) {
                                $this->view_bridge_detail_model->where(
                                    'bri03construction_type',
                                    ENUM_NEW_CONSTRUCTION
                                );
                            } else {
                                $this->view_bridge_detail_model->where(
                                    'bri03construction_type',
                                    ENUM_MAJOR_MAINTENANCE
                                );
                            }
                            $arrBridgeList = $this->view_bridge_detail_model->where('bri03major_vdc_id', $v1->muni01id)->findAll();
                            $arrChild1 = $arrBridgeList;
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

            $data['arrPrintList'] = $arrPrintList;
            //print_r($arrPrintList);

        } else {
            redirect("reports/tbss_regionwise/" . $stat);
        }

        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_Overall_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Est_Overall_DateWise_report($stat = '')
    {

        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['blnMM'] = $stat;
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');

        $data['view_file'] = __function__;
        require($x);
    }

    function Est_Overall_DateWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data = self::$arrDefData;

        $data['view_file'] = __function__;
        require($x);
    }


    function Est_Overall_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_Overall_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');

        $data = self::$arrDefData;
        $data['blnMM'] = $stat;
        $data['view_file'] = __function__;
        require($x);
    }



    function Est_Overall_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Est_Dist_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_Dist_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;
        require($x);
    }

    function Est_Dist_DateWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;
        require($x);
    }


    function Est_Dist_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();

        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_Dist_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;
        require($x);
    }

    function Est_Dist_FYWise_print($stat = '')
    {

        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;
        require($x);
    }



    function Est_Dev_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_Dev_DateWise_report($stat = '')
    {

        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Est_Dev_DateWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Est_Dev_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_Dev_FYWise_report($stat = '')
    {
        //var_dump($_POST);
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }
    function Est_Dev_FYWise_print($stat = '')
    {
        //var_dump($_POST);
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Est_TBSS_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_TBSS_DateWise_report($stat = '')
    {
        //var_dump($_POST);
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Est_TBSS_DateWise_print($stat = '')
    {
        //var_dump($_POST);
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Est_TBSS_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_TBSS_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Est_TBSS_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Overall_DateWise($ext = '')
    {

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Overall_DateWise_report($stat = '')
    {
        //var_dump($_POST);
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;
        $this->load->model('district_name/district_name_model');
        $this->load->model('view/view_for_detail_bridge_model');
        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('cost_components/cost_components_model');
        $this->load->model('bridge/contribution_agencies_model');
        $this->load->model('bridge/bridge_est_cost_model');


        //$data['arrDevInfo'] = $this->view_for_detail_bridge_model->first();
        $data['arrSupList'] = $this->supporting_agencies_model->findAll();
        $data['arrCostCompList'] = $this->cost_components_model->findAll();
        $data['arrdistrictList'] = $this->district_name_model->findAll();

        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;

        if ($Postback == 'Back') {
            redirect(site_url());
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $arrSupList = $this->supporting_agencies_model->findAll();

                if (empty($stat)) {
                    $this->view_for_detail_bridge_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_for_detail_bridge_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }
                $arrFilteredBridgeList = $this->view_for_detail_bridge_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->findAll();

                $arrBIDs = array();
                if (is_array($arrFilteredBridgeList)) {
                    foreach ($arrFilteredBridgeList as $k => $v) {

                        $data['arrAllBridgeList']['dist_' . $v->dist01id][] = $v;
                        $arrBIDs[] = $v->bri03bridge_no;
                    }
                }
                if (!empty($arrBIDs)) {
                    $data['arrEstCost'] = array();
                    $data['arrCstCost'] = array();
                    $arrAllBridgeEst = $this->bridge_est_cost_model->whereIn('bri07bridge_no', $arrBIDs)->findAll();
                    if (is_array($arrAllBridgeEst)) {
                        foreach ($arrAllBridgeEst as $k => $v) {
                            $data['arrEstCost'][$v->bri07bridge_no]['cmp_' . $v->bri07cmp01id]['sup_' . $v->bri07sup01id] = $v->bri07amount;
                        }
                    }
                    $arrAllBridgeCst = $this->contribution_agencies_model->whereIn('bri08bridge_no', $arrBIDs)->findAll();
                    if (is_array($arrAllBridgeCst)) {
                        foreach ($arrAllBridgeCst as $k => $v) {
                            $data['arrCstCost'][$v->bri08bridge_no]['cmp_' . $v->bri08cmp01id]['sup_' . $v->bri08sup01id] = $v->bri08amount;
                        }
                    }
                    //$data['arrCstCost'] = $this->contribution_agencies_model->whereIn('bri08bridge_no', $arrBIDs)->findAll();
                }
                //print_r( $data );
                //die();
                //$data['arrEstCost'] = $this->bridge_est_cost_model->where('bri07bridge_no', $data['arrDevInfo']->bri03bridge_no)->findAll();
                //$data['arrCstCost'] = $this->contribution_agencies_model->where('bri08bridge_no', $data['arrDevInfo']->bri03bridge_no)->findAll();
            }
        } else {
            redirect("reports/Act_Overall_DateWise/" . $stat);
        }



        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Overall_DateWise_print($stat = '')
    {
        //var_dump($_POST);
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;
        $this->load->model('district_name/district_name_model');
        $this->load->model('view/view_for_detail_bridge_model');
        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('cost_components/cost_components_model');
        $this->load->model('bridge/contribution_agencies_model');
        $this->load->model('bridge/bridge_est_cost_model');


        //$data['arrDevInfo'] = $this->view_for_detail_bridge_model->first();
        $data['arrSupList'] = $this->supporting_agencies_model->findAll();
        $data['arrCostCompList'] = $this->cost_components_model->findAll();
        $data['arrdistrictList'] = $this->district_name_model->findAll();

        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;

        if ($Postback == 'Back') {
            redirect(site_url());
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $arrSupList = $this->supporting_agencies_model->findAll();

                if (empty($stat)) {
                    $this->view_for_detail_bridge_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_for_detail_bridge_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }
                $arrFilteredBridgeList = $this->view_for_detail_bridge_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->findAll();

                $arrBIDs = array();
                if (is_array($arrFilteredBridgeList)) {
                    foreach ($arrFilteredBridgeList as $k => $v) {

                        $data['arrAllBridgeList']['dist_' . $v->dist01id][] = $v;
                        $arrBIDs[] = $v->bri03bridge_no;
                    }
                }
                if (!empty($arrBIDs)) {
                    $data['arrEstCost'] = array();
                    $data['arrCstCost'] = array();
                    $arrAllBridgeEst = $this->bridge_est_cost_model->whereIn('bri07bridge_no', $arrBIDs)->findAll();
                    if (is_array($arrAllBridgeEst)) {
                        foreach ($arrAllBridgeEst as $k => $v) {
                            $data['arrEstCost'][$v->bri07bridge_no]['cmp_' . $v->bri07cmp01id]['sup_' . $v->bri07sup01id] = $v->bri07amount;
                        }
                    }
                    $arrAllBridgeCst = $this->contribution_agencies_model->whereIn('bri08bridge_no', $arrBIDs)->findAll();
                    if (is_array($arrAllBridgeCst)) {
                        foreach ($arrAllBridgeCst as $k => $v) {
                            $data['arrCstCost'][$v->bri08bridge_no]['cmp_' . $v->bri08cmp01id]['sup_' . $v->bri08sup01id] = $v->bri08amount;
                        }
                    }
                    //$data['arrCstCost'] = $this->contribution_agencies_model->whereIn('bri08bridge_no', $arrBIDs)->findAll();
                }
                //print_r( $data );
                //die();
                //$data['arrEstCost'] = $this->bridge_est_cost_model->where('bri07bridge_no', $data['arrDevInfo']->bri03bridge_no)->findAll();
                //$data['arrCstCost'] = $this->contribution_agencies_model->where('bri08bridge_no', $data['arrDevInfo']->bri03bridge_no)->findAll();
            }
        } else {
            redirect("reports/Act_Overall_DateWise/" . $stat);
        }



        $this->template->print_template($data);
    }

    function Overall_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Overall_FYWise_report($stat = '')
    {
        //var_dump($_POST);
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;
        $this->load->model('district_name/district_name_model');
        $this->load->model('view/view_for_detail_bridge_model');
        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('cost_components/cost_components_model');
        $this->load->model('bridge/contribution_agencies_model');
        $this->load->model('bridge/bridge_est_cost_model');




        //$data['arrDevInfo'] = $this->view_for_detail_bridge_model->first();
        $data['arrSupList'] = $this->supporting_agencies_model->findAll();
        $data['arrCostCompList'] = $this->cost_components_model->findAll();
        $data['arrdistrictList'] = $this->district_name_model->findAll();


        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();


        if ($Postback == 'Back') {
            redirect(site_url());
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $arrSupList = $this->supporting_agencies_model->findAll();

                if (empty($stat)) {
                    $this->view_for_detail_bridge_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_for_detail_bridge_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }
                $arrFilteredBridgeList = $this->view_for_detail_bridge_model->where('bri03project_fiscal_year >=', $dataStart)->where('bri03project_fiscal_year <=', $dateEnd)->findAll();

                $arrBIDs = array();
                if (is_array($arrFilteredBridgeList)) {
                    foreach ($arrFilteredBridgeList as $k => $v) {

                        $data['arrAllBridgeList']['dist_' . $v->dist01id][] = $v;
                        $arrBIDs[] = $v->bri03bridge_no;
                    }
                }
                if (!empty($arrBIDs)) {
                    $data['arrEstCost'] = array();
                    $data['arrCstCost'] = array();
                    $arrAllBridgeEst = $this->bridge_est_cost_model->whereIn('bri07bridge_no', $arrBIDs)->findAll();
                    if (is_array($arrAllBridgeEst)) {
                        foreach ($arrAllBridgeEst as $k => $v) {
                            $data['arrEstCost'][$v->bri07bridge_no]['cmp_' . $v->bri07cmp01id]['sup_' . $v->bri07sup01id] = $v->bri07amount;
                        }
                    }
                    $arrAllBridgeCst = $this->contribution_agencies_model->whereIn('bri08bridge_no', $arrBIDs)->findAll();
                    if (is_array($arrAllBridgeCst)) {
                        foreach ($arrAllBridgeCst as $k => $v) {
                            $data['arrCstCost'][$v->bri08bridge_no]['cmp_' . $v->bri08cmp01id]['sup_' . $v->bri08sup01id] = $v->bri08amount;
                        }
                    }
                    //$data['arrCstCost'] = $this->contribution_agencies_model->whereIn('bri08bridge_no', $arrBIDs)->findAll();
                }
                //print_r( $data );
                //die();
                //$data['arrEstCost'] = $this->bridge_est_cost_model->where('bri07bridge_no', $data['arrDevInfo']->bri03bridge_no)->findAll();
                //$data['arrCstCost'] = $this->contribution_agencies_model->where('bri08bridge_no', $data['arrDevInfo']->bri03bridge_no)->findAll();
            } else {
                redirect("reports/Overall_FYWise/" . $stat);
            }
        } else {
            redirect("reports/Overall_FYWise/" . $stat);
        }



        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Overall_FYWise_print($stat = '')
    {
        //var_dump($_POST);
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;
        $this->load->model('district_name/district_name_model');
        $this->load->model('view/view_for_detail_bridge_model');
        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('cost_components/cost_components_model');
        $this->load->model('bridge/contribution_agencies_model');
        $this->load->model('bridge/bridge_est_cost_model');




        //$data['arrDevInfo'] = $this->view_for_detail_bridge_model->first();
        $data['arrSupList'] = $this->supporting_agencies_model->findAll();
        $data['arrCostCompList'] = $this->cost_components_model->findAll();
        $data['arrdistrictList'] = $this->district_name_model->findAll();


        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();


        if ($Postback == 'Back') {
            redirect(site_url());
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $arrSupList = $this->supporting_agencies_model->findAll();

                if (empty($stat)) {
                    $this->view_for_detail_bridge_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_for_detail_bridge_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }
                $arrFilteredBridgeList = $this->view_for_detail_bridge_model->where('bri03project_fiscal_year >=', $dataStart)->where('bri03project_fiscal_year <=', $dateEnd)->findAll();

                $arrBIDs = array();
                if (is_array($arrFilteredBridgeList)) {
                    foreach ($arrFilteredBridgeList as $k => $v) {

                        $data['arrAllBridgeList']['dist_' . $v->dist01id][] = $v;
                        $arrBIDs[] = $v->bri03bridge_no;
                    }
                }
                if (!empty($arrBIDs)) {
                    $data['arrEstCost'] = array();
                    $data['arrCstCost'] = array();
                    $arrAllBridgeEst = $this->bridge_est_cost_model->whereIn('bri07bridge_no', $arrBIDs)->findAll();
                    if (is_array($arrAllBridgeEst)) {
                        foreach ($arrAllBridgeEst as $k => $v) {
                            $data['arrEstCost'][$v->bri07bridge_no]['cmp_' . $v->bri07cmp01id]['sup_' . $v->bri07sup01id] = $v->bri07amount;
                        }
                    }
                    $arrAllBridgeCst = $this->contribution_agencies_model->whereIn('bri08bridge_no', $arrBIDs)->findAll();
                    if (is_array($arrAllBridgeCst)) {
                        foreach ($arrAllBridgeCst as $k => $v) {
                            $data['arrCstCost'][$v->bri08bridge_no]['cmp_' . $v->bri08cmp01id]['sup_' . $v->bri08sup01id] = $v->bri08amount;
                        }
                    }
                    //$data['arrCstCost'] = $this->contribution_agencies_model->whereIn('bri08bridge_no', $arrBIDs)->findAll();
                }
                //print_r( $data );
                //die();
                //$data['arrEstCost'] = $this->bridge_est_cost_model->where('bri07bridge_no', $data['arrDevInfo']->bri03bridge_no)->findAll();
                //$data['arrCstCost'] = $this->contribution_agencies_model->where('bri08bridge_no', $data['arrDevInfo']->bri03bridge_no)->findAll();
            } else {
                redirect("reports/Overall_FYWise/" . $stat);
            }
        } else {
            redirect("reports/Overall_FYWise/" . $stat);
        }



        $this->template->print_template($data);
    }

    function Est_Cont_Overall_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_Cont_Overall_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Est_Cont_Overall_DateWise_print($stat = '')
    {

        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }



    function Est_Cont_Overall_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_Cont_Overall_FYWise_report($stat = '')
    {
        //var_dump($_POST);
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Est_Cont_Overall_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }



    function Est_Cont_Dist_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_Cont_Dist_DateWise_report($stat = '')
    {

        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Est_Cont_Dist_DateWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }



    function Est_Cont_Dist_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_Cont_Dist_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Est_Cont_Dist_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Est_Cont_Dev_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_Cont_Dev_DateWise_report($stat = '')
    {
        //var_dump($_POST);
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Est_Cont_Dev_DateWise_print($stat = '')
    {
        //var_dump($_POST);
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Est_Cont_Dev_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_Cont_Dev_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Est_Cont_Dev_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Est_Cont_TBSS_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_Cont_TBSS_DateWise_report($stat = '')
    {
        //var_dump($_POST);
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Est_Cont_TBSS_DateWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Est_Cont_TBSS_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Est_Cont_TBSS_FYWise_report($stat = '')
    {

        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Est_Cont_TBSS_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Eng_Design_Approval($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Eng_Design_Approval_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Eng_Design_Approval_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Eng_Desing_Cost_Estimate($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Eng_Desing_Cost_Estimate_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Eng_Desing_Cost_Estimate_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }



    function Eng_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Eng_FYWise_report($stat = '')
    {

        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Eng_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Eng_SiteAssesment_Survey($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Eng_SiteAssesment_Survey_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Eng_SiteAssesment_Survey_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Work_Cancelled_Bridges($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Work_Cancelled_Bridges_report($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data['blnMM'] = $stat;

        $this->load->model('view/view_bridge_detail_model');


        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();

        if ($Postback == 'Back') {
            redirect(site_url());
        } elseif ($dataStart != 0 || $dateEnd != 0) {
            if (empty($stat)) {
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_NEW_CONSTRUCTION
                );
            } else {
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_MAJOR_MAINTENANCE
                );
            }
            $arrDataList = $this->view_bridge_detail_model->where('bri03project_fiscal_year >=', $dataStart)->where('wkc01work_category_code =', BRIDGE_CATEGORY_CANCELLED)->where('bri05third_phase_construction_check =', 0)->where('bri03project_fiscal_year <=', $dateEnd)->findAll();
            $row = array();
            if (is_array($arrDataList)) {
                foreach ($arrDataList as &$dr) {
                    $row['dev_' . $dr->dev01id]['dist_' . $dr->dist01id][] = $dr;
                }
                //unset($dr);
            }
            unset($arrDataList);
            $data['arrPrintList'] = $row;
            //print_r( $data['arrPrintList'] );

        } else {
            redirect("reports/Work_Cancelled_Bridges/" . $stat);
        }

        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Work_Cancelled_Bridges_print($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data['blnMM'] = $stat;

        $this->load->model('view/view_bridge_detail_model');


        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();

        if ($Postback == 'Back') {
            redirect(site_url());
        } elseif ($dataStart != 0 || $dateEnd != 0) {
            if (empty($stat)) {
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_NEW_CONSTRUCTION
                );
            } else {
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_MAJOR_MAINTENANCE
                );
            }
            $arrDataList = $this->view_bridge_detail_model->where('bri03project_fiscal_year >=', $dataStart)->where('wkc01work_category_code =', BRIDGE_CATEGORY_CANCELLED)->where('bri05third_phase_construction_check =', 0)->where('bri03project_fiscal_year <=', $dateEnd)->findAll();
            $row = array();
            if (is_array($arrDataList)) {
                foreach ($arrDataList as &$dr) {
                    $row['dev_' . $dr->dev01id]['dist_' . $dr->dist01id][] = $dr;
                }
                //unset($dr);
            }
            unset($arrDataList);
            $data['arrPrintList'] = $row;
            //print_r( $data['arrPrintList'] );

        } else {
            redirect("reports/Work_Cancelled_Bridges/" . $stat);
        }

        $this->template->print_template($data);
    }


    function Work_Carryover_Bridges($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Work_Carryover_Bridges_report($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data['blnMM'] = $stat;

        $this->load->model('view/view_bridge_detail_model');


        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();

        if ($Postback == 'Back') {
            redirect(site_url());
        } elseif ($dataStart != 0 || $dateEnd != 0) {
            if (empty($stat)) {
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_NEW_CONSTRUCTION
                );
            } else {
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_MAJOR_MAINTENANCE
                );
            }
            $arrDataList = $this->view_bridge_detail_model->where('bri03project_fiscal_year >=', $dataStart)->where('wkc01work_category_code =', BRIDGE_CATEGORY_CARRY)->where('bri05third_phase_construction_check =', 0)->where('bri03project_fiscal_year <=', $dateEnd)->findAll();
            $row = array();
            if (is_array($arrDataList)) {
                foreach ($arrDataList as &$dr) {
                    $row['dev_' . $dr->dev01id]['dist_' . $dr->dist01id][] = $dr;
                }
                //unset($dr);
            }
            unset($arrDataList);
            $data['arrPrintList'] = $row;
            //print_r( $data['arrPrintList'] );

        } else {
            redirect("reports/Work_Carryover_Bridges/" . $stat);
        }

        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Work_Carryover_Bridges_print($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data['blnMM'] = $stat;

        $this->load->model('view/view_bridge_detail_model');


        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();

        if ($Postback == 'Back') {
            redirect(site_url());
        } elseif ($dataStart != 0 || $dateEnd != 0) {
            if (empty($stat)) {
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_NEW_CONSTRUCTION
                );
            } else {
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_MAJOR_MAINTENANCE
                );
            }
            $arrDataList = $this->view_bridge_detail_model->where('bri03project_fiscal_year >=', $dataStart)->where('wkc01work_category_code =', BRIDGE_CATEGORY_CARRY)->where('bri05third_phase_construction_check =', 0)->where('bri03project_fiscal_year <=', $dateEnd)->findAll();
            $row = array();
            if (is_array($arrDataList)) {
                foreach ($arrDataList as &$dr) {
                    $row['dev_' . $dr->dev01id]['dist_' . $dr->dist01id][] = $dr;
                }
                //unset($dr);
            }
            unset($arrDataList);
            $data['arrPrintList'] = $row;
            //print_r( $data['arrPrintList'] );

        } else {
            redirect("reports/Work_Carryover_Bridges/" . $stat);
        }

        $this->template->print_template($data);
    }

    function Work_Completed_Bridges($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Work_Completed_Bridges_report($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data['blnMM'] = $stat;

        $this->load->model('view/view_bridge_detail_model');


        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();

        if ($Postback == 'Back') {
            redirect(site_url());
        } elseif ($dataStart != 0 || $dateEnd != 0) {
            if (empty($stat)) {
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_NEW_CONSTRUCTION
                );
            } else {
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_MAJOR_MAINTENANCE
                );
            }
            $arrDataList = $this->view_bridge_detail_model->where('bri03project_fiscal_year >=', $dataStart)->where('bri05third_phase_construction_check =', 1)->where('bri03project_fiscal_year <=', $dateEnd)->findAll();
            $row = array();
            if (is_array($arrDataList)) {
                foreach ($arrDataList as &$dr) {
                    $row['dev_' . $dr->dev01id]['dist_' . $dr->dist01id][] = $dr;
                }
                //unset($dr);
            }
            unset($arrDataList);
            $data['arrPrintList'] = $row;
            //print_r( $data['arrPrintList'] );

        } else {
            redirect("reports/Work_Completed_Bridges/" . $stat);
        }

        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Work_Completed_Bridges_print($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data['blnMM'] = $stat;

        $this->load->model('view/view_bridge_detail_model');


        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();

        if ($Postback == 'Back') {
            redirect(site_url());
        } elseif ($dataStart != 0 || $dateEnd != 0) {
            if (empty($stat)) {
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_NEW_CONSTRUCTION
                );
            } else {
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_MAJOR_MAINTENANCE
                );
            }
            $arrDataList = $this->view_bridge_detail_model->where('bri03project_fiscal_year >=', $dataStart)->where('bri05bridge_complete_check =', 1)->where('bri03project_fiscal_year <=', $dateEnd)->findAll();
            $row = array();
            if (is_array($arrDataList)) {
                foreach ($arrDataList as &$dr) {
                    $row['dev_' . $dr->dev01id]['dist_' . $dr->dist01id][] = $dr;
                }
                //unset($dr);
            }
            unset($arrDataList);
            $data['arrPrintList'] = $row;
            //print_r( $data['arrPrintList'] );

        } else {
            redirect("reports/Work_Completed_Bridges/" . $stat);
        }

        $this->template->print_template($data);
    }


    function Work_Datewise_Completed($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Work_Datewise_Completed_report($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data['blnMM'] = $stat;

        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('district_name/district_name_model');


        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect(site_url());
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }
                $arrDataList = $this->view_bridge_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete_check =', 1)->where('bri05bridge_complete <=', $dateEnd)->findAll();
                $row = array();
                if (is_array($arrDataList)) {
                    foreach ($arrDataList as &$dr) {
                        $row['dev_' . $dr->dev01id]['dist_' . $dr->dist01id][] = $dr;
                    }
                    //unset($dr);
                }
                unset($arrDataList);
                $data['arrPrintList'] = $row;
                // print_r( $data['arrPrintList'] );

            } else {
                redirect("reports/Work_Datewise_Completed/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Work_Datewise_Completed_print($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data['blnMM'] = $stat;

        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('district_name/district_name_model');


        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect(site_url());
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }
                $arrDataList = $this->view_bridge_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete_check =', 1)->where('bri05bridge_complete <=', $dateEnd)->findAll();
                $row = array();
                if (is_array($arrDataList)) {
                    foreach ($arrDataList as &$dr) {
                        $row['dev_' . $dr->dev01id]['dist_' . $dr->dist01id][] = $dr;
                    }
                    //unset($dr);
                }
                unset($arrDataList);
                $data['arrPrintList'] = $row;
                // print_r( $data['arrPrintList'] );

            } else {
                redirect("reports/Work_Datewise_Completed/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
    }

    ////start completed Bridge /// 


    function Act_Dev_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Dev_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Act_Dev_DateWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Act_Dev_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Dev_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Act_Dev_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Act_Dist_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Dist_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Act_Dist_DateWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Act_Dist_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Dist_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Act_Dist_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Act_Overall_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Overall_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Act_Overall_DateWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Act_Overall_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Act_Overall_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Act_Overall_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    //palika
    function Act_Munc_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;

        $data['arrMunicipalityList'] = $this->vcd_municipality_model->findAll();
        $data['arrDistList'] = $this->district_name_model->findAll();
        $data['arrVDCList'] = $this->view_vdc_model->findAll();
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Munc_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Act_Munc_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        //        
        //        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();


        $data['arrMunicipalityList'] = $this->vcd_municipality_model->asObject()->findAll();
        $data['arrDistList'] = $this->district_name_model->asObject()->findAll();
        //$data['arrVDCList'] = $this->view_vdc_model->asObject()->findAll();
        $data['arrFYList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Act_Munc_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    //////
    function Act_Con_Munc_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;

        $data['arrMunicipalityList'] = $this->vcd_municipality_model->asObject()->findAll();
        $data['arrDistList'] = $this->district_name_model->asObject()->findAll();
        $data['arrVDCList'] = $this->view_vdc_model->asObject()->findAll();
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Act_Con_Munc_FYwise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;


        $data['arrMunicipalityList'] = $this->vcd_municipality_model->asObject()->findAll();
        $data['arrDistList'] = $this->district_name_model->asObject()->findAll();
        $data['arrVDCList'] = $this->view_vdc_model->asObject()->findAll();
        $data['arrFYList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Act_Con_Munc_DateWise_report($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $bri03municipality = @$this->request->getVar('bri03municipality');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;

        // $this->load->model('district_name/district_name_model');
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('bridge/bridge_model');
        // $this->load->model('supporting_agencies/supporting_agencies_model');
        // $this->load->model('regional_office/regional_office_model');
        // $this->load->model('view/view_regional_office_model');
        // $this->load->model('view/view_regional_office_model');
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('view/stored_procedure');
        // $this->load->model('view/view_all_actual_view_model');
        // $this->load->model('cost_components/cost_components_model');
        // $this->load->model('view/view_vdc_model');

        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrDevList'] = $this->district_name_model->asObject()->findAll();

                $municipality = $this->view_vdc_model->where('muni01id', $bri03municipality)->asObject()->findAll();
                $data['municipality'] = $municipality;
                $data['arrCostCompList'] = $this->supporting_agencies_model->asObject()->findAll();
                $arrDistList = $this->view_regional_office_model->asObject()->findAll();
                $arrSupList = $this->supporting_agencies_model->asObject()->findAll();
                $arrPrintList = array();

                $arrChild1 = null;
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }

                $this->view_bridge_detail_model->dbFilterCompleted();
                $arrBridgeList = $this->view_bridge_detail_model->where('left_muni01id', $bri03municipality)->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri05bridge_complete_check', 1)->asObject()->findAll();

                $arrBridgeIdList = null;
                if (is_array($arrBridgeList)) {
                    foreach ($arrBridgeList as $k2 => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        $arrPrintList['dist_' . $v2->dist01id]['info'] = $v2;
                        //$arrPrintList['dev_'.$v2->dev01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }
                if($arrBridgeIdList != NULL)
                $arrBridgeCostList = $this->view_bridge_actual_supporting_cost->whereIn('bri08bridge_no', $arrBridgeIdList)->asObject()->findAll();
                else
                $arrBridgeCostList = $this->view_bridge_actual_supporting_cost->asObject()->findAll();

                foreach ($arrBridgeCostList as $x2) {
                    $arrCostList['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08sup01id] = $x2;
                }


                $data['arrPrintList'] = $arrPrintList;
                $data['arrCostList'] = $arrCostList;
            } else {
                redirect("reports/Act_Con_Munc_DateWise_report/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Act_Con_Munc_FYWise_report($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $bri03municipality = @$this->request->getVar('bri03municipality');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;

        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->asObject()->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->asObject()->first();

        if (empty($stat)) {
            $this->view_bridge_detail_model->where(
                'bri03construction_type',
                ENUM_NEW_CONSTRUCTION
            );
        } else {
            $this->view_bridge_detail_model->where(
                'bri03construction_type',
                ENUM_MAJOR_MAINTENANCE
            );
        }

        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $municipality = $this->view_vdc_model->where('muni01id', $bri03municipality)->asObject()->findAll();
                $data['arrCostCompList'] = $this->supporting_agencies_model->asObject()->findAll();
                $arrDistList = $this->view_regional_office_model->asObject()->findAll();
                $arrSupList = $this->supporting_agencies_model->asObject()->findAll();
                $arrPrintList = array();
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }
                //$this->view_bridge_detail_model->dbFilterCompleted();

                $data['arrDevList'] = $this->view_bridge_detail_model->where('left_muni01id', $bri03municipality)->where('bri05bridge_completion_fiscalyear >=', $dataStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri05bridge_complete_check', 1)->asObject()->findAll();

                /*$data['arrDevList']= $this->view_bridge_detail_model->
                        where('left_muni01id',$bri03municipality)->
                        where('bri05bridge_complete >=',$dataStart)->
                       where('bri05bridge_complete <=', $dateEnd)->findAll();*/



                // if (is_array($arrSupList)){
                //      foreach ($arrSupList as $k => $v){
                //         $data['arrsupportList']['sup_'.$v->sup01id] = $v;
                //      }
                // }
                //  if (is_array($arrDistList)){
                //      foreach ($arrDistList as $k => $v){
                //         $data['arrDistrictList']['dist_'.$v->dist01id] = $v;
                //      }
                // }
                //print_r( $data['arrDistrictList']);
                //  print_r($data['arrsupportList']);


                $arrBridgeIdList = null;
                if (is_array($data['arrDevList'])) {
                    foreach ($data['arrDevList'] as $k => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        //$arrPrintList['sup_'.$v2->sup01id]['info']=$v2;
                        //$arrPrintList['sup_'.$v2->sup01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['sup_' . $v2->sup01id]['arrChildList']['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }

                //var_dump($arrPrintList);exit;
                if($arrBridgeIdList != NULL) {
                    $arrBridgeCostList = $this->view_bridge_actual_cost->
                    // where('left_muni01id',$bri03municipality)->
                    whereIn('bri08bridge_no', $arrBridgeIdList)->asObject()->findAll();
                } else {
                    $arrBridgeCostList = $this->view_bridge_actual_cost->asObject()->findAll();
                }

                foreach ($arrBridgeCostList as $x2) {

                    $arrChild2['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08cmp01id] = $x2;
                }

                $data['arrCostList'] = $arrChild2;

                // print_r($arrPrintList);
                $data['arrPrintList'] = $arrPrintList;
            } else {
                redirect("reports/Act_Con_Munc_FYWise_report/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }



    function Act_Supporting_AgencyWise_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Supporting_AgencyWise_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Act_Supporting_AgencyWise_DateWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }



    function Act_Supporting_AgencyWise_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Supporting_AgencyWise_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Act_Supporting_AgencyWise_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }



    function Act_TBSS_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_TBSS_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Act_TBSS_DateWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }



    function Act_TBSS_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_TBSS_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Act_TBSS_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }




    function Act_Con_Dev_RegionWise_datewise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Con_Dev_RegionWise_datewise_report($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data = self::$arrDefData;
        //$data['view_file'] = __function__;
        $data['blnMM'] = $stat;
        // $this->load->model('supporting_agencies/supporting_agencies_model');
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('development_region/development_region_model');
        // $this->load->model('district_name/district_name_model');
        // $this->load->model('development_region/development_region_model');
        // $this->load->model('view/view_district_model');
        // $this->load->model('view/view_regional_office_model');
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('view/stored_procedure');
        // $this->load->model('view/view_all_actual_view_model');
        // $this->load->model('cost_components/cost_components_model');

        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect("reports");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->asObject()->findAll();
                $arrPrintList = array();
                $data['arrDevList'] = $this->district_name_model->asObject()->findAll();

                $arrChild1 = null;
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }

                //$this->view_bridge_detail_model->dbFilterCompleted();
                $arrBridgeList = $this->view_bridge_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri05bridge_complete_check', 1)->asObject()->findAll();

                $arrBridgeIdList = null;
                if (is_array($arrBridgeList)) {
                    foreach ($arrBridgeList as $k2 => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        $arrPrintList['dev' . $v2->dev01id]['info'] = $v2;
                        $arrPrintList['dev' . $v2->dev01id]['arrChildList']['dist_' . $v2->dist01id]['info'] = $v2;
                        $arrPrintList['dev' . $v2->dev01id]['arrChildList']['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }

                $arrBridgeCostList = $this->view_bridge_actual_supporting_cost->whereIn('bri08bridge_no', $arrBridgeIdList)->asObject()->findAll();

                foreach ($arrBridgeCostList as $x2) {
                    $arrCostList['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08sup01id] = $x2;
                }


                $data['arrPrintList'] = $arrPrintList;
                $data['arrCostList'] = $arrCostList;
                //print_r($arrPrintList);
            } else {
                redirect("reports/Act_Con_Dev_RegionWise_datewise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Act_Con_Dev_RegionWise_datewise_print($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;



        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('district_name/district_name_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('view/view_district_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');

        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect("reports");
        } elseif ($dataStart <= $dateEnd) {

            $data['arrCostCompList'] = $this->supporting_agencies_model->findAll();
            $arrPrintList = array();
            $data['arrDevList'] = $this->district_name_model->findAll();

            $arrChild1 = null;
            if (empty($stat)) {
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_NEW_CONSTRUCTION
                );
            } else {
                $this->view_bridge_detail_model->where(
                    'bri03construction_type',
                    ENUM_MAJOR_MAINTENANCE
                );
            }

            $this->view_bridge_detail_model->dbFilterCompleted();
            $arrBridgeList = $this->view_bridge_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->findAll();

            $arrBridgeIdList = null;
            if (is_array($arrBridgeList)) {
                foreach ($arrBridgeList as $k2 => $v2) {
                    $arrChild2 = null;
                    $arrBridgeIdList[] = $v2->bri03bridge_no;
                    $arrPrintList['dev' . $v2->dev01id]['info'] = $v2;
                    $arrPrintList['dev' . $v2->dev01id]['arrChildList']['dist_' . $v2->dist01id]['info'] = $v2;
                    $arrPrintList['dev' . $v2->dev01id]['arrChildList']['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                }
            }

            $arrBridgeCostList = $this->view_all_actual_view_model->whereIn('bri08bridge_no', $arrBridgeIdList)->view_bridge_actual_supporting_cost();

            foreach ($arrBridgeCostList as $x2) {
                $arrCostList['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08sup01id] = $x2;
            }


            $data['arrPrintList'] = $arrPrintList;
            $data['arrCostList'] = $arrCostList;
            //print_r($arrPrintList);

        } else {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
    }


    function Act_Con_Dev_RegionWise_fywise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Con_Dev_RegionWise_fywise_report($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
       // $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;


        // $this->load->model('supporting_agencies/supporting_agencies_model');
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('development_region/development_region_model');
        // $this->load->model('district_name/district_name_model');
        // $this->load->model('development_region/development_region_model');
        // $this->load->model('view/view_district_model');
        // $this->load->model('view/view_regional_office_model');
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('view/stored_procedure');
        // $this->load->model('view/view_all_actual_view_model');
        // $this->load->model('cost_components/cost_components_model');

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
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }

                $arrBridgeList = $this->view_bridge_detail_model->where('bri05bridge_completion_fiscalyear >=', $dataStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri05bridge_complete_check', 1)->orderBy('dist01state')->asObject()->findAll();

                $arrBridgeIdList = null;
                if (is_array($arrBridgeList)) {
                    foreach ($arrBridgeList as $k2 => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        $arrPrintList['dev' . $v2->dist01state]['info'] = $v2;
                        $arrPrintList['dev' . $v2->dist01state]['arrChildList']['dist_' . $v2->dist01id]['info'] = $v2;
                        $arrPrintList['dev' . $v2->dist01state]['arrChildList']['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }

                $arrBridgeCostList = $this->view_bridge_actual_supporting_cost->whereIn('bri08bridge_no', $arrBridgeIdList)->asObject()->findAll();

                foreach ($arrBridgeCostList as $x2) {
                    $arrCostList['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08sup01id] = $x2;
                }


                $data['arrPrintList'] = $arrPrintList;
                $data['arrCostList'] = $arrCostList;
                //print_r($arrPrintList);
            } else {
                redirect("reports/Act_Con_Dev_RegionWise_fywise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Act_Con_Dev_RegionWise_fywise_print($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;


        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('district_name/district_name_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('view/view_district_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');

        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->findAll();
                $arrPrintList = array();
                $data['arrDevList'] = $this->district_name_model->findAll();

                $arrChild1 = null;
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }

                $arrBridgeList = $this->view_bridge_detail_model->where('bri03project_fiscal_year >=', $dataStart)->where('bri03project_fiscal_year <=', $dateEnd)->orderBy('dist01state')->findAll();

                $arrBridgeIdList = null;
                if (is_array($arrBridgeList)) {
                    foreach ($arrBridgeList as $k2 => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        $arrPrintList['dev' . $v2->dev01id]['info'] = $v2;
                        $arrPrintList['dev' . $v2->dev01id]['arrChildList']['dist_' . $v2->dist01id]['info'] = $v2;
                        $arrPrintList['dev' . $v2->dev01id]['arrChildList']['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }

                $arrBridgeCostList = $this->view_all_actual_view_model->whereIn('bri08bridge_no', $arrBridgeIdList)->view_bridge_actual_supporting_cost();

                foreach ($arrBridgeCostList as $x2) {
                    $arrCostList['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08sup01id] = $x2;
                }


                $data['arrPrintList'] = $arrPrintList;
                $data['arrCostList'] = $arrCostList;
                //print_r($arrPrintList);
            } else {
                redirect("reports/Act_Con_Dev_RegionWise_fywise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
    }

    function Act_Con_Districtwise_datewise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Con_Districtwise_datewise_report($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $stat = @$this->request->getVar('btype');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;

        // $this->load->model('supporting_agencies/supporting_agencies_model');
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('district_name/district_name_model');
        // $this->load->model('development_region/development_region_model');
        // $this->load->model('view/view_district_model');
        // $this->load->model('view/view_regional_office_model');
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('view/stored_procedure');
        // $this->load->model('view/view_all_actual_view_model');
        // $this->load->model('cost_components/cost_components_model');

        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->asObject()->findAll();
                $arrPrintList = array();
                $data['arrDevList'] = $this->district_name_model->asObject()->findAll();
                $data['sel_district_filter'] = '';

                $arrChild1 = null;
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }

                $this->view_bridge_detail_model->dbFilterCompleted();
                if ($this->request->getVar("selFilterByDistrict") != '') {
                    $distFilter = $this->request->getVar("selFilterByDistrict");
                    $this->view_bridge_detail_model->where('dist01id', $distFilter);
                    $data['sel_district_filter'] = $distFilter;
                }
                $arrBridgeList = $this->view_bridge_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri05bridge_complete_check', 1)->asObject()->findAll();
                $arrBridgeIdList = null;
                if (is_array($arrBridgeList)) {
                    foreach ($arrBridgeList as $k2 => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        $arrPrintList['dist_' . $v2->dist01id]['info'] = $v2;
                        //$arrPrintList['dev_'.$v2->dev01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }

                $arrBridgeCostList = $this->view_bridge_actual_supporting_cost->whereIn('bri08bridge_no', $arrBridgeIdList)->asObject()->findAll();

                foreach ($arrBridgeCostList as $x2) {
                    $arrCostList['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08sup01id] = $x2;
                }


                $data['arrPrintList'] = $arrPrintList;
                $data['arrCostList'] = $arrCostList;
            } else {
                redirect("reports/Act_Con_Districtwise_datewise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Act_Con_Districtwise_datewise_print($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;

        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('district_name/district_name_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('view/view_district_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');

        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->findAll();
                $arrPrintList = array();
                $data['arrDevList'] = $this->district_name_model->findAll();

                $arrChild1 = null;
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }

                $this->view_bridge_detail_model->dbFilterCompleted();
                $arrBridgeList = $this->view_bridge_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->findAll();
                $arrBridgeIdList = null;
                if (is_array($arrBridgeList)) {
                    foreach ($arrBridgeList as $k2 => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        $arrPrintList['dist_' . $v2->dist01id]['info'] = $v2;
                        //$arrPrintList['dev_'.$v2->dev01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }

                $arrBridgeCostList = $this->view_all_actual_view_model->whereIn('bri08bridge_no', $arrBridgeIdList)->view_bridge_actual_supporting_cost();

                foreach ($arrBridgeCostList as $x2) {
                    $arrCostList['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08sup01id] = $x2;
                }


                $data['arrPrintList'] = $arrPrintList;
                $data['arrCostList'] = $arrCostList;
            } else {
                redirect("reports/Act_Con_Districtwise_datewise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
    }


    function Act_Con_Districtwise_FYwise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Con_Districtwise_FYwise_report($stat = '')
    {

        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $stat = @$this->request->getVar('btype');
        $data = self::$arrDefData;
        $data['blnMM'] = $stat;


        $data['view_file'] = __function__;

        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('district_name/district_name_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('view/view_district_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');

        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->findAll();
                $arrPrintList = array();
                $data['arrDevList'] = $this->district_name_model->findAll();
                $data['sel_district_filter'] = '';

                $arrChild1 = null;

                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }

                if ($this->request->getVar("selFilterByDistrict") != '') {
                    $distFilter = $this->request->getVar("selFilterByDistrict");
                    $this->view_bridge_detail_model->where('dist01id', $distFilter);
                    $data['sel_district_filter'] = $distFilter;
                }

                $arrBridgeList = $this->view_bridge_detail_model->where('bri05bridge_completion_fiscalyear >=', $dataStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri05bridge_complete_check', 1)->findAll();
                $arrBridgeIdList = null;

                if (is_array($arrBridgeList)) {
                    foreach ($arrBridgeList as $k2 => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        $arrPrintList['dist_' . $v2->dist01id]['info'] = $v2;
                        //$arrPrintList['dev_'.$v2->dev01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }

                $arrBridgeCostList = $this->view_all_actual_view_model->whereIn('bri08bridge_no', $arrBridgeIdList)->view_bridge_actual_supporting_cost();

                foreach ($arrBridgeCostList as $x2) {
                    $arrCostList['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08sup01id] = $x2;
                }


                $data['arrPrintList'] = $arrPrintList;
                $data['arrCostList'] = $arrCostList;
            } else {
                redirect("reports/Act_Con_Districtwise_FYwise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Act_Con_Districtwise_FYwise_print($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data = self::$arrDefData;
        $data['blnMM'] = $stat;


        $data['view_file'] = __function__;

        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('district_name/district_name_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('view/view_district_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');

        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->findAll();
                $arrPrintList = array();
                $data['arrDevList'] = $this->district_name_model->findAll();

                $arrChild1 = null;
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }

                $arrBridgeList = $this->view_bridge_detail_model->where('bri03project_fiscal_year >=', $dataStart)->where('bri03project_fiscal_year <=', $dateEnd)->findAll();
                $arrBridgeIdList = null;
                if (is_array($arrBridgeList)) {
                    foreach ($arrBridgeList as $k2 => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        $arrPrintList['dist_' . $v2->dist01id]['info'] = $v2;
                        //$arrPrintList['dev_'.$v2->dev01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }

                $arrBridgeCostList = $this->view_all_actual_view_model->whereIn('bri08bridge_no', $arrBridgeIdList)->view_bridge_actual_supporting_cost();

                foreach ($arrBridgeCostList as $x2) {
                    $arrCostList['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08sup01id] = $x2;
                }


                $data['arrPrintList'] = $arrPrintList;
                $data['arrCostList'] = $arrCostList;
            } else {
                redirect("reports/Act_Con_Districtwise_FYwise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
    }


    function Act_Con_Overall_datewise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Con_Overall_datewise_report($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data = self::$arrDefData;
        $data['blnMM'] = $stat;
        $data['view_file'] = __function__;


        $this->load->model('district_name/district_name_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('bridge/bridge_model');
        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('regional_office/regional_office_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');

        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->findAll();
                $arrPrintList = array();
                $data['arrDevList'] = $this->district_name_model->findAll();

                $arrChild1 = null;
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }

                $this->view_bridge_detail_model->dbFilterCompleted();
                $arrBridgeList = $this->view_bridge_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri05bridge_complete_check', 1)->findAll();

                $arrBridgeIdList = null;
                if (is_array($arrBridgeList)) {
                    foreach ($arrBridgeList as $k2 => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        $arrPrintList['dist_' . $v2->dist01id]['info'] = $v2;
                        //$arrPrintList['dev_'.$v2->dev01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }

                $arrBridgeCostList = $this->view_all_actual_view_model->whereIn('bri08bridge_no', $arrBridgeIdList)->view_bridge_actual_supporting_cost();

                foreach ($arrBridgeCostList as $x2) {
                    $arrCostList['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08sup01id] = $x2;
                }


                $data['arrPrintList'] = $arrPrintList;
                $data['arrCostList'] = $arrCostList;
            } else {
                redirect("reports/Act_Con_Overall_datewise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Act_Con_Overall_datewise_print($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data = self::$arrDefData;
        $data['blnMM'] = $stat;
        $data['view_file'] = __function__;

        $this->load->model('district_name/district_name_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('bridge/bridge_model');
        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('regional_office/regional_office_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');

        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->findAll();
                $arrPrintList = array();
                $data['arrDevList'] = $this->district_name_model->findAll();

                $arrChild1 = null;
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }

                $this->view_bridge_detail_model->dbFilterCompleted();
                $arrBridgeList = $this->view_bridge_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->findAll();
                $arrBridgeIdList = null;
                if (is_array($arrBridgeList)) {
                    foreach ($arrBridgeList as $k2 => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        $arrPrintList['dist_' . $v2->dist01id]['info'] = $v2;
                        $arrPrintList['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }

                $arrBridgeCostList = $this->view_all_actual_view_model->whereIn('bri08bridge_no', $arrBridgeIdList)->view_bridge_actual_supporting_cost();

                foreach ($arrBridgeCostList as $x2) {
                    $arrCostList['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08sup01id] = $x2;
                }


                $data['arrPrintList'] = $arrPrintList;
                $data['arrCostList'] = $arrCostList;
            } else {
                redirect("reports/Act_Con_Overall_datewise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
    }


    function Act_Con_Overall_Fywise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Con_Overall_Fywise_report($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
       // $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;
        // $this->load->model('district_name/district_name_model');
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('bridge/bridge_model');
        // $this->load->model('supporting_agencies/supporting_agencies_model');
        // $this->load->model('regional_office/regional_office_model');
        // $this->load->model('view/view_regional_office_model');
        // $this->load->model('view/view_regional_office_model');
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('view/stored_procedure');
        // $this->load->model('view/view_all_actual_view_model');
        // $this->load->model('cost_components/cost_components_model');
        // $this->load->model('bridge/contribution_agencies_model');

        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();

        // $b_type = ENUM_NEW_CONSTRUCTION;
        // $arrBridgeList = $this->view_bridge_detail_model->where('bri05bridge_completion_fiscalyear >=', $dataStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri05bridge_complete_check', 1)->where('bri03construction_type', $b_type)->asObject()->findAll();
        // $arrBridgeIdList = null;
        //         if (is_array($arrBridgeList)) {
        //             foreach ($arrBridgeList as $k2 => $v2) {
        //                 $arrChild2 = null;

        //                 $bri03bridge_no = trim($v2->bri03bridge_no);
        //                 //$bridgeToalCostAmount = $this->contribution_agencies_model->getSum($bri03bridge_no);

        //                 //if($bridgeToalCostAmount->totalAmt > 0) {

        //                 $arrBridgeIdList[] = $v2->bri03bridge_no;
        //             }
        //         }
        //         echo "<pre>";
        //         var_dump($arrBridgeIdList);exit;
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                // $data['arrCostCompList'] = $this->supporting_agencies_model->findAll();
                // $arrPrintList = array();
                // $data['arrDevList'] = $this->district_name_model->findAll();

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
                
                $arrBridgeCostList = $this->view_bridge_actual_supporting_cost->whereIn('bri08bridge_no', array(1,2))->asOjbect()->findAll();

                foreach ($arrBridgeCostList as $x2) {
                    echo "<pre>";
                var_dump($x2->bri08bridge_no);exit;
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
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Act_Con_Overall_Fywise_print($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;
        $this->load->model('district_name/district_name_model');

        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('bridge/bridge_model');
        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('regional_office/regional_office_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');

        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->findAll();
                $arrPrintList = array();
                $data['arrDevList'] = $this->district_name_model->findAll();

                $arrChild1 = null;
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }

                $this->view_bridge_detail_model->dbFilterCompleted();
                $arrBridgeList = $this->view_bridge_detail_model->where('bri03project_fiscal_year >=', $dataStart)->where('bri03project_fiscal_year <=', $dateEnd)->findAll();
                $arrBridgeIdList = null;
                if (is_array($arrBridgeList)) {
                    foreach ($arrBridgeList as $k2 => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        $arrPrintList['dist_' . $v2->dist01id]['info'] = $v2;
                        $arrPrintList['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }

                $arrBridgeCostList = $this->view_all_actual_view_model->whereIn('bri08bridge_no', $arrBridgeIdList)->view_bridge_actual_supporting_cost();

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
        $this->template->print_template($data);
    }


    function Act_Con_Supporting_AgencyWise_datewise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Con_Supporting_AgencyWise_datewise_report($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;

        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('bridge/bridge_model');
        // $this->load->model('supporting_agencies/supporting_agencies_model');
        // $this->load->model('regional_office/regional_office_model');
        // $this->load->model('view/view_regional_office_model');
        // $this->load->model('view/view_regional_office_model');
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('view/stored_procedure');
        // $this->load->model('view/view_all_actual_view_model');
        // $this->load->model('cost_components/cost_components_model');

        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->asObject()->findAll();
                $arrDistList = $this->view_regional_office_model->asObject()->findAll();
                $arrSupList = $this->supporting_agencies_model->asObject()->findAll();
                $arrPrintList = array();
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }
                $this->view_bridge_detail_model->dbFilterCompleted();
                $data['arrDevList'] = $this->view_bridge_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri05bridge_complete_check', 1)->asObject()->findAll();


                if (is_array($arrSupList)) {
                    foreach ($arrSupList as $k => $v) {
                        $data['arrsupportList']['sup_' . $v->sup01id] = $v;
                    }
                }
                if (is_array($arrDistList)) {
                    foreach ($arrDistList as $k => $v) {
                        $data['arrDistrictList']['dist_' . $v->dist01id] = $v;
                    }
                }
                //print_r( $data['arrDistrictList']);
                //  print_r($data['arrsupportList']);


                $arrBridgeIdList = null;
                if (is_array($data['arrDevList'])) {
                    foreach ($data['arrDevList'] as $k => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        //$arrPrintList['sup_'.$v2->sup01id]['info']=$v2;
                        //$arrPrintList['sup_'.$v2->sup01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['sup_' . $v2->sup01id]['arrChildList']['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }



                $arrBridgeCostList = $this->view_bridge_actual_cost->whereIn('bri08bridge_no', $arrBridgeIdList)->asObject()->findAll();
                foreach ($arrBridgeCostList as $x2) {

                    $arrChild2['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08cmp01id] = $x2;
                }

                $data['arrCostList'] = $arrChild2;

                // print_r($arrPrintList);
                $data['arrPrintList'] = $arrPrintList;
            } else {
                redirect("reports/Act_Con_Supporting_AgencyWise_datewise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Act_Con_Supporting_AgencyWise_datewise_print($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;

        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('bridge/bridge_model');
        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('regional_office/regional_office_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');

        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->findAll();
                $arrDistList = $this->view_regional_office_model->findAll();
                $arrSupList = $this->supporting_agencies_model->findAll();
                $arrPrintList = array();
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }
                $this->view_bridge_detail_model->dbFilterCompleted();
                $data['arrDevList'] = $this->view_bridge_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->findAll();


                if (is_array($arrSupList)) {
                    foreach ($arrSupList as $k => $v) {
                        $data['arrsupportList']['sup_' . $v->sup01id] = $v;
                    }
                }
                if (is_array($arrDistList)) {
                    foreach ($arrDistList as $k => $v) {
                        $data['arrDistrictList']['dist_' . $v->dist01id] = $v;
                    }
                }
                //print_r( $data['arrDistrictList']);
                //  print_r($data['arrsupportList']);


                $arrBridgeIdList = null;
                if (is_array($data['arrDevList'])) {
                    foreach ($data['arrDevList'] as $k => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        //$arrPrintList['sup_'.$v2->sup01id]['info']=$v2;
                        //$arrPrintList['sup_'.$v2->sup01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['sup_' . $v2->sup01id]['arrChildList']['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }



                $arrBridgeCostList = $this->view_all_actual_view_model->whereIn('bri08bridge_no', $arrBridgeIdList)->view_bridge_actual_cost();
                foreach ($arrBridgeCostList as $x2) {

                    $arrChild2['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08cmp01id] = $x2;
                }

                $data['arrCostList'] = $arrChild2;

                // print_r($arrPrintList);
                $data['arrPrintList'] = $arrPrintList;
            } else {
                redirect("reports/Act_Con_Supporting_AgencyWise_datewise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
    }

    function Act_Con_Supporting_AgencyWise_FYwise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Act_Con_Supporting_AgencyWise_FYwise_report($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');

        $selAgency = @$this->request->getVar('selAgency'); // supporting agency

        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;

        $data['dataStart'] = $dataStart;
        $data['dateEnd'] = $dateEnd;
        $data['selAgency'] = $selAgency;

        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('bridge/bridge_model');
        // $this->load->model('supporting_agencies/supporting_agencies_model');
        // $this->load->model('regional_office/regional_office_model');
        // $this->load->model('view/view_regional_office_model');
        // $this->load->model('view/view_regional_office_model');
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('view/stored_procedure');
        // $this->load->model('view/view_all_actual_view_model');
        // $this->load->model('cost_components/cost_components_model');

        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->asObject()->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->asObject()->first();
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->asObject()->findAll();
                $arrDistList = $this->view_regional_office_model->asObject()->findAll();
                $arrSupList = $this->supporting_agencies_model->asObject()->findAll();
                $arrPrintList = array();
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }

                $arrDevList = $this->view_bridge_detail_model->where('bri05bridge_completion_fiscalyear >=', $dataStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri05bridge_complete_check', 1);

                if ($selAgency != '' && $selAgency != "all") {
                    $arrDevList->where('bri03supporting_agency =', $selAgency);
                }
                $arrDevList = $arrDevList->asObject()->findAll();
                $data['arrDevList'] = $arrDevList;


                if (is_array($arrSupList)) {
                    foreach ($arrSupList as $k => $v) {
                        $data['arrsupportList']['sup_' . $v->sup01id] = $v;
                    }
                }
                if (is_array($arrDistList)) {
                    foreach ($arrDistList as $k => $v) {
                        $data['arrDistrictList']['dist_' . $v->dist01id] = $v;
                    }
                }
                //print_r( $data['arrDistrictList']);
                //  print_r($data['arrsupportList']);


                $arrBridgeIdList = null;
                if (is_array($data['arrDevList'])) {
                    foreach ($data['arrDevList'] as $k => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        //$arrPrintList['sup_'.$v2->sup01id]['info']=$v2;
                        //$arrPrintList['sup_'.$v2->sup01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['sup_' . $v2->sup01id]['arrChildList']['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }



                $arrBridgeCostList = $this->view_bridge_actual_supporting_cost->whereIn('bri08bridge_no', $arrBridgeIdList)->asObject()->findAll();
                foreach ($arrBridgeCostList as $x2) {

                    $arrChild2['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08sup01id] = $x2;
                }

                $data['arrCostList'] = $arrChild2;
                $data['arrPrintList'] = $arrPrintList;
            } else {
                redirect("reports/Act_Con_Supporting_AgencyWise_FYwise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }

        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Act_Con_Supporting_AgencyWise_FYwise_print($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');

        $selAgency = @$this->request->getVar('selAgency'); // supporting agency

        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;

        $data['dataStart'] = $dataStart;
        $data['dateEnd'] = $dateEnd;
        $data['selAgency'] = $selAgency;



        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('bridge/bridge_model');
        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('regional_office/regional_office_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');

        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->findAll();
                $arrDistList = $this->view_regional_office_model->findAll();
                $arrSupList = $this->supporting_agencies_model->findAll();
                $arrPrintList = array();
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }

                $arrDevList = $this->view_bridge_detail_model->where('bri03project_fiscal_year >=', $dataStart)->where('bri03project_fiscal_year <=', $dateEnd);

                if ($selAgency != '' && $selAgency != "all") {
                    $arrDevList->where('bri03supporting_agency =', $selAgency);
                }
                $arrDevList = $arrDevList->findAll();
                $data['arrDevList'] = $arrDevList;


                if (is_array($arrSupList)) {
                    foreach ($arrSupList as $k => $v) {
                        $data['arrsupportList']['sup_' . $v->sup01id] = $v;
                    }
                }
                if (is_array($arrDistList)) {
                    foreach ($arrDistList as $k => $v) {
                        $data['arrDistrictList']['dist_' . $v->dist01id] = $v;
                    }
                }
                //print_r( $data['arrDistrictList']);
                //  print_r($data['arrsupportList']);


                $arrBridgeIdList = null;
                if (is_array($data['arrDevList'])) {
                    foreach ($data['arrDevList'] as $k => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        //$arrPrintList['sup_'.$v2->sup01id]['info']=$v2;
                        //$arrPrintList['sup_'.$v2->sup01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['sup_' . $v2->sup01id]['arrChildList']['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }



                $arrBridgeCostList = $this->view_all_actual_view_model->whereIn('bri08bridge_no', $arrBridgeIdList)->view_bridge_actual_supporting_cost();
                foreach ($arrBridgeCostList as $x2) {

                    $arrChild2['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08sup01id] = $x2;
                }

                $data['arrCostList'] = $arrChild2;
                $data['arrPrintList'] = $arrPrintList;
            } else {
                redirect("reports/Act_Con_Supporting_AgencyWise_FYwise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }

        //  return view('\Modules\Reports\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
        $this->template->print_template($data);
    }


    function Act_Con_TBSSPRegionWise_datewise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Act_Con_TBSSPRegionWise_datewise_report($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $stat = @$this->request->getVar('btype');
        //$data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;

        // $this->load->model('supporting_agencies/supporting_agencies_model');
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('development_region/development_region_model');
        // $this->load->model('district_name/district_name_model');
        // $this->load->model('regional_office/regional_office_model');
        // $this->load->model('view/view_district_model');
        // $this->load->model('view/view_regional_office_model');
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('view/stored_procedure');
        // $this->load->model('view/view_all_actual_view_model');
        // $this->load->model('cost_components/cost_components_model');

        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->asObject()->findAll();
                $arrPrintList = array();
                $data['arrDevList'] = $this->regional_office_model->asObject()->findAll();
                if (is_array($data['arrDevList'])) {

                    foreach ($data['arrDevList'] as $k => $v) {
                        $arrChild = null;

                        $arrDistList = $this->view_regional_office_model->where('tbis01id', $v->tbis01id)->asObject()->findAll();
                        if (is_array($arrDistList)) {

                            foreach ($arrDistList as $k1 => $v1) {
                                $arrChild1 = null;
                                if (empty($stat)) {
                                    $this->view_bridge_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_NEW_CONSTRUCTION
                                    );
                                } else {
                                    $this->view_bridge_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_MAJOR_MAINTENANCE
                                    );
                                }
                                //$this->view_bridge_detail_model->dbFilterCompleted();
                                $arrBridgeList = $this->view_bridge_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri05bridge_complete_check', 1)->where('dist01id', $v1->dist01id)->asObject()->findAll();

                                foreach ($arrBridgeList as $k2 => $v2) {
                                    $arrChild2 = null;


                                    $arrBridgeCostList = $this->view_bridge_actual_supporting_cost->where('bri08bridge_no', $v2->bri03bridge_no)->asObject()->findAll();
                                    foreach ($arrBridgeCostList as $x2) {

                                        $arrChild2['id_' . $x2->bri08sup01id] = $x2;
                                    }


                                    $arrChild1[] = array('info' => $v2, 'arrChildList' => $arrChild2);
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
                redirect("reports/Act_Con_TBSSPRegionWise_datewise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }


    function Act_Con_TBSSPRegionWise_datewise_print($stat = '')
    {

        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;

        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('district_name/district_name_model');
        $this->load->model('regional_office/regional_office_model');
        $this->load->model('view/view_district_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');

        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->findAll();
                $arrPrintList = array();
                $data['arrDevList'] = $this->regional_office_model->findAll();
                if (is_array($data['arrDevList'])) {

                    foreach ($data['arrDevList'] as $k => $v) {
                        $arrChild = null;

                        $arrDistList = $this->view_regional_office_model->where('tbis01id', $v->tbis01id)->findAll();
                        if (is_array($arrDistList)) {

                            foreach ($arrDistList as $k1 => $v1) {
                                $arrChild1 = null;
                                if (empty($stat)) {
                                    $this->view_bridge_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_NEW_CONSTRUCTION
                                    );
                                } else {
                                    $this->view_bridge_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_MAJOR_MAINTENANCE
                                    );
                                }
                                $this->view_bridge_detail_model->dbFilterCompleted();
                                $arrBridgeList = $this->view_bridge_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('dist01id', $v1->dist01id)->findAll();

                                foreach ($arrBridgeList as $k2 => $v2) {
                                    $arrChild2 = null;


                                    $arrBridgeCostList = $this->view_all_actual_view_model->where('bri08bridge_no', $v2->bri03bridge_no)->view_bridge_actual_supporting_cost();
                                    foreach ($arrBridgeCostList as $x2) {

                                        $arrChild2['id_' . $x2->bri08sup01id] = $x2;
                                    }


                                    $arrChild1[] = array('info' => $v2, 'arrChildList' => $arrChild2);
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
                redirect("reports/Act_Con_TBSSPRegionWise_datewise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
    }


    function Act_Con_TBSSPRegionWise_FYwise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    

    function Act_Con_TBSSPRegionWise_FYwise_report($stat = '')
    {

        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');

        // $selAgency = @$this->request->getVar('selAgency'); // supporting agency
        $stat = @$this->request->getVar('btype');
        //$data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;

        $data['dataStart'] = $dataStart;
        $data['dateEnd'] = $dateEnd;

        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('bridge/bridge_model');
        // $this->load->model('supporting_agencies/supporting_agencies_model');
        // $this->load->model('regional_office/regional_office_model');
        // $this->load->model('view/view_regional_office_model');
        // $this->load->model('view/view_regional_office_model');
        // $this->load->model('view/view_bridge_detail_model');
        // $this->load->model('view/stored_procedure');
        // $this->load->model('view/view_all_actual_view_model');
        // $this->load->model('cost_components/cost_components_model');


        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->asObject()->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->asObject()->first();
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->asObject()->findAll();
                $arrDistList = $this->view_regional_office_model->asObject()->findAll();
                //$data['arrDevList']= $this->regional_office_model->findAll();

                $arrSupList = $this->regional_office_model->asObject()->findAll();
                $arrPrintList = array();
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }

                $arrDevList = $this->view_bridge_detail_model->where('bri03project_fiscal_year >=', $dataStart)->where('bri03project_fiscal_year <=', $dateEnd);


                $arrDevList = $arrDevList->asObject()->findAll();
                $data['arrDevList'] = $arrDevList;


                if (is_array($arrSupList)) {
                    foreach ($arrSupList as $k => $v) {
                        $data['arrsupportList']['sup_' . $v->tbis01id] = $v;
                    }
                }
                if (is_array($arrDistList)) {
                    foreach ($arrDistList as $k => $v) {
                        $data['arrDistrictList']['dist_' . $v->dist01id] = $v;
                    }
                }
                //print_r( $data['arrDistrictList']);
                //  print_r($data['arrsupportList']);


                $arrBridgeIdList = null;
                if (is_array($data['arrDevList'])) {
                    foreach ($data['arrDevList'] as $k => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        //$arrPrintList['sup_'.$v2->tbis01id]['info']=$v2;
                        //$arrPrintList['sup_'.$v2->tbis01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['sup_' . $v2->tbis01id]['arrChildList']['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }



                $arrBridgeCostList = $this->view_bridge_actual_supporting_cost->whereIn('bri08bridge_no', $arrBridgeIdList)->asObject()->findAll();
                foreach ($arrBridgeCostList as $x2) {

                    $arrChild2['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08sup01id] = $x2;
                }

                $data['arrCostList'] = $arrChild2;
                $data['arrPrintList'] = $arrPrintList;
            } else {
                redirect("reports/Act_Con_TBSSPRegionWise_FYwise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }

        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Act_Con_TBSSPRegionWise_FYwise_print($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;

        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('district_name/district_name_model');
        $this->load->model('regional_office/regional_office_model');
        $this->load->model('view/view_district_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');

        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->findAll();
                $arrPrintList = array();
                $data['arrDevList'] = $this->regional_office_model->findAll();
                if (is_array($data['arrDevList'])) {

                    foreach ($data['arrDevList'] as $k => $v) {
                        $arrChild = null;

                        $arrDistList = $this->view_regional_office_model->where('tbis01id', $v->tbis01id)->findAll();
                        if (is_array($arrDistList)) {

                            foreach ($arrDistList as $k1 => $v1) {
                                $arrChild1 = null;
                                if (empty($stat)) {
                                    $this->view_bridge_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_NEW_CONSTRUCTION
                                    );
                                } else {
                                    $this->view_bridge_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_MAJOR_MAINTENANCE
                                    );
                                }
                                $arrBridgeList = $this->view_bridge_detail_model->where('bri03project_fiscal_year >=', $dataStart)->where('bri03project_fiscal_year <=', $dateEnd)->where('dist01id', $v1->dist01id)->findAll();

                                foreach ($arrBridgeList as $k2 => $v2) {
                                    $arrChild2 = null;


                                    $arrBridgeCostList = $this->view_all_actual_view_model->where('bri08bridge_no', $v2->bri03bridge_no)->view_bridge_actual_supporting_cost();
                                    foreach ($arrBridgeCostList as $x2) {

                                        $arrChild2['id_' . $x2->bri08sup01id] = $x2;
                                    }


                                    $arrChild1[] = array('info' => $v2, 'arrChildList' => $arrChild2);
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
                redirect("reports/Act_Con_TBSSPRegionWise_FYwise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
    }

    function Gen_Cont_Dev_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Gen_Cont_Dev_DateWise_report($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;

        $this->load->model('view/view_district_model');
        // $this->load->model('view/regional_office_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('view/view_bridge_detail_model');
        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrDistList'] = $this->view_district_model->findAll();
                $data['arrDevRegList'] = $this->development_region_model->findAll();


                $arrdev = $data['arrDevRegList'];

                $arrPrintList = array();
                if (is_array($arrdev)) {
                    foreach ($arrdev as $k => $v) {
                        //var_dump($v);
                        $ddd = $v->dev01id;
                        $selDist = $this->view_district_model->where('dev01id', $ddd)->findAll();

                        //var_dump($selDist);
                        $row = array();
                        $row['dev'] = $v;

                        if (is_array($selDist)) {
                            foreach ($selDist as $k1 => $v1) {
                                $rr = $v1->dist01id;
                                if (empty($stat)) {
                                    $this->view_bridge_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_NEW_CONSTRUCTION
                                    );
                                } else {
                                    $this->view_bridge_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_MAJOR_MAINTENANCE
                                    );
                                }
                                $dist = $this->view_bridge_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('dist01id', $rr)->where('bri05bridge_complete_check =', '1')->findAll();
                                if (is_array($dist) && !empty($dist)) {
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
            } else {
                redirect("reports/Gen_Cont_Dev_DateWise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Gen_Cont_Dev_DateWise_print($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;

        $this->load->model('view/view_district_model');
        // $this->load->model('view/regional_office_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('view/view_bridge_detail_model');
        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrDistList'] = $this->view_district_model->findAll();
                $data['arrDevRegList'] = $this->development_region_model->findAll();


                $arrdev = $data['arrDevRegList'];

                $arrPrintList = array();
                if (is_array($arrdev)) {
                    foreach ($arrdev as $k => $v) {
                        //var_dump($v);
                        $ddd = $v->dev01id;
                        $selDist = $this->view_district_model->where('dev01id', $ddd)->findAll();

                        //var_dump($selDist);
                        $row = array();
                        $row['dev'] = $v;

                        if (is_array($selDist)) {
                            foreach ($selDist as $k1 => $v1) {
                                $rr = $v1->dist01id;
                                if (empty($stat)) {
                                    $this->view_bridge_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_NEW_CONSTRUCTION
                                    );
                                } else {
                                    $this->view_bridge_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_MAJOR_MAINTENANCE
                                    );
                                }
                                $dist = $this->view_bridge_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('dist01id', $rr)->where('bri05bridge_complete_check =', '1')->findAll();
                                if (is_array($dist) && !empty($dist)) {
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
            } else {
                redirect("reports/Gen_Cont_Dev_DateWise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
    }


    function Gen_Cont_Dev_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Gen_Cont_Dev_FYWise_report($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;

        $this->load->model('view/view_district_model');

        $this->load->model('development_region/development_region_model');
        $this->load->model('view/view_bridge_detail_model');
        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrDistList'] = $this->view_district_model->findAll();
                $data['arrDevRegList'] = $this->development_region_model->findAll();


                $arrdev = $data['arrDevRegList'];

                $arrPrintList = array();
                if (is_array($arrdev)) {
                    foreach ($arrdev as $k => $v) {
                        //var_dump($v);
                        $ddd = $v->dev01id;
                        $selDist = $this->view_district_model->where('dev01id', $ddd)->findAll();

                        //var_dump($selDist);
                        $row = array();
                        $row['dev'] = $v;

                        if (is_array($selDist)) {
                            foreach ($selDist as $k1 => $v1) {
                                $rr = $v1->dist01id;
                                if (empty($stat)) {
                                    $this->view_bridge_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_NEW_CONSTRUCTION
                                    );
                                } else {
                                    $this->view_bridge_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_MAJOR_MAINTENANCE
                                    );
                                }
                                $dist = $this->view_bridge_detail_model->where('bri05bridge_completion_fiscalyear >=', $dataStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('dist01id', $rr)->where('bri05bridge_complete_check =', '1')->findAll();
                                if (is_array($dist) && !empty($dist)) {
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
            } else {
                redirect("reports/Gen_Cont_Dev_FYWise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Gen_Cont_Dev_FYWise_print($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;

        $this->load->model('view/view_district_model');

        $this->load->model('development_region/development_region_model');
        $this->load->model('view/view_bridge_detail_model');
        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrDistList'] = $this->view_district_model->findAll();
                $data['arrDevRegList'] = $this->development_region_model->findAll();


                $arrdev = $data['arrDevRegList'];

                $arrPrintList = array();
                if (is_array($arrdev)) {
                    foreach ($arrdev as $k => $v) {
                        //var_dump($v);
                        $ddd = $v->dev01id;
                        $selDist = $this->view_district_model->where('dev01id', $ddd)->findAll();

                        //var_dump($selDist);
                        $row = array();
                        $row['dev'] = $v;

                        if (is_array($selDist)) {
                            foreach ($selDist as $k1 => $v1) {
                                $rr = $v1->dist01id;
                                if (empty($stat)) {
                                    $this->view_bridge_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_NEW_CONSTRUCTION
                                    );
                                } else {
                                    $this->view_bridge_detail_model->where(
                                        'bri03construction_type',
                                        ENUM_MAJOR_MAINTENANCE
                                    );
                                }
                                $dist = $this->view_bridge_detail_model->where('bri05bridge_completion_fiscalyear >=', $dataStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('dist01id', $rr)->where('bri05bridge_complete_check =', '1')->findAll();
                                if (is_array($dist) && !empty($dist)) {
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
            } else {
                redirect("reports/Gen_Cont_Dev_FYWise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
    }


    function Gen_Cont_Dist_DateWise()
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Gen_Cont_Dist_FYWise()
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Gen_Cont_Overall_DateWise()
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Gen_Cont_Overall_FYWise()
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Gen_Cont_TBSS_DateWise()
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Gen_Cont_TBSS_FYWise()
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Gen_Dev_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Gen_Dev_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Gen_Munc_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;

        $data['arrMunicipalityList'] = $this->vcd_municipality_model->findAll();
        $data['arrDistList'] = $this->district_name_model->findAll();
        $data['arrVDCList'] = $this->view_vdc_model->findAll();
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Gen_Munc_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Gen_Munc_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;


        $data['arrMunicipalityList'] = $this->vcd_municipality_model->findAll();
        $data['arrDistList'] = $this->district_name_model->findAll();
        $data['arrVDCList'] = $this->view_vdc_model->findAll();
        $data['arrFYList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Gen_Munc_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Gen_Dev_DateWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Gen_Dev_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['title'] = "Fiscal Year Wise Report";
        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        ///return view('\Modules\Reports\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);  
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Gen_Dev_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Gen_Dev_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Gen_Dist_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Gen_Dist_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Gen_Dist_DateWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function Gen_Dist_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Gen_Dist_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Gen_Dist_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Gen_Overall_DateWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Gen_Overall_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Gen_TBSS_DateWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Gen_TBSS_DateWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Gen_TBSS_DateWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Gen_TBSS_FYWise($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Gen_TBSS_FYWise_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Gen_TBSS_FYWise_print($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Progress_Status($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = 'Progress_Status/Progress_Status';
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Pro_Overall_Status($stat = '')
    {
        //$data = self::$arrDefData;
        //$data['view_file'] =__function__ ;
        //return view('\Modules\Reports\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data); 
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }
    function Pro_CarryOver_Status($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function Pro_New_Status($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }
    function Pro_Physical_Progress($ext = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Pro_Physical_Progress_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }
    function Pro_Cumulative_Overall($stat = '')
    {
        // $x = dirname(__FILE__).'/inc/'.__FUNCTION__.'.php';
        //   	$data = self::$arrDefData;
        //       $data['view_file'] =__function__;
        //       require( $x );          
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        //$data['blnMM'] = $ext;
        $data['blnMM'] = $stat;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function Pro_Cumulative_Overall_report($stat = '')
    {
        //die("test"); 
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
        //die("test");          
    }
    function R_Under_Construction($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    /* added later for tbsu regional office */
    function R_Under_Construction_Regional($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function R_Under_Construction_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function R_Under_Construction_Palika_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }


    function R_Under_Construction_Palika($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;

        $data['arrMunicipalityList'] = $this->vcd_municipality_model->findAll();
        $data['arrDistList'] = $this->district_name_model->findAll();
        $data['arrVDCList'] = $this->view_vdc_model->findAll();
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function R_Under_Construction_State($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;
        $this->load->model('province/province_model');
        $data['arrStateList'] = $this->province_model->findAll();
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function R_Under_Construction_State_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;
        require($x);
    }

    function R_Completed($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    /* added later for tbsu regional office */
    function R_Completed_Regional($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
    function R_Completed_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    function R_Completed_Palika($stat = '')
    {
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $stat;

        $data['arrMunicipalityList'] = $this->vcd_municipality_model->findAll();
        $data['arrDistList'] = $this->district_name_model->findAll();
        $data['arrVDCList'] = $this->view_vdc_model->findAll();
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function R_Completed_Palika_report($stat = '')
    {
        $x = dirname(__FILE__) . '/inc/' . __FUNCTION__ . '.php';
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        require($x);
    }

    /* new added 
    get fiscal data
*/
    function getFiscalData($supplierId, $distId, $fy = '', $ctype)
    {
        //$this->load->model('fiscal_data/fiscal_data_model');
        $data = $this->fiscal_data_model->where('fis02sup01id', $supplierId)->where('fis02dist01codeid', $distId);
        if ($fy != '') {
            $data->where('fis02year', $fy);
        }
        $data->where('fis02constype', $ctype);
        $fiscaldata = $data->asObject()->first();
        return $fiscaldata;
    }


    /*
    * Datewise Physical progress report
    *  Added by prasanna
    */
    function Pro_Cumulative_Overall_datewise($ext = '')
    {
        // $data = self::$arrDefData;
        // $data['view_file'] = __FUNCTION__ ;
        //  
        // $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        //  $data['blnMM'] = $ext;
        // return view('\Modules\Reports\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data); 

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }


    function Pro_Cumulative_Overall_datewise_report($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        // $data['view_file'] = __function__;

        //$selAgency = @$this->request->getVar('selAgency'); // supporting agency        
        $data['dataStart'] = $dataStart;
        $data['dateEnd'] = $dateEnd;
        // $data['selAgency'] = $selAgency;


        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('district_name/district_name_model');
        $this->load->model('view/view_all_views_model');
        $this->load->model('view/view_bridge_detail_model');
        $data['blnMM'] = $stat;


        // $data['startyear'] =$this->fiscal_year_model->where('fis01id', $dateStart)->first();
        // $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();        


        if ($Postback == 'Back') {
            //redirect("reports/main_completed_bridges");
            redirect(site_url());
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {

                $fiscalyear = $this->fiscal_year_model->first();
                $FiscalDate = $fiscalyear->fis01id; // current fiscal year id

                $arrSupList = $this->supporting_agencies_model->findAll();
                $arrDistList = $this->district_name_model->findAll();

                if (is_array($arrSupList)) {

                    foreach ($arrSupList as $k => $v) {

                        $data['arrsupportList']['sup_' . $v->sup01id] = $v;
                    }
                }

                if (is_array($arrDistList)) {

                    foreach ($arrDistList as $k => $v) {

                        $data['arrDistrictList']['dist_' . $v->dist01id] = $v;
                    }
                }

                if (empty($stat)) {
                    $x = ENUM_NEW_CONSTRUCTION;
                } else {
                    $x = ENUM_MAJOR_MAINTENANCE;
                }

                //where('bri03project_fiscal_year =', $FiscalDate)
                $Previous_carry = $this->view_all_views_model->where('bri03construction_type', $x)->where('bri03work_category =', WORK_CATEGORY_CARRY)
                    ->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->view_sup03_dist01_bri05_count_carry_previous();

                //->where('bri03project_fiscal_year =', $FiscalDate)
                $pipe_line = $this->view_all_views_model->where('bri03construction_type', $x)->where('bri05first_phase_constrution_check ', '1')
                    ->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->view_dist01_bri05_count_first_constraction_fiscalyear();

                // $site_assessmen = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri03project_fiscal_year =', $FiscalDate)->
                // where('bri05site_assessment_check ', '1')->view_sup03_dist01_bri05_count_site_assessment_dist();

                $site_assessmen = $this->view_all_views_model->where('bri03construction_type', $x)->where('bri05site_assessment_check ', '1')
                    ->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->view_sup03_dist01_bri05_count_site_assessment_dist_new();

                $design_esstimate = $this->view_all_views_model->where('bri03construction_type', $x)->where('bri05bridge_design_estimate_check ', '1')
                    ->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->view_sup03_dist01_bri05_count_design_estimate_bridges_new();

                // $community_agreement = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri03project_fiscal_year =', $FiscalDate)->
                // where('bri05community_agreement_check ', '1')->view_sup03_dist01_bri05_count_community_agreement_dist();

                $community_agreement = $this->view_all_views_model->where('bri03construction_type', $x)->where('bri05community_agreement_check ', '1')
                    ->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->view_sup03_dist01_bri05_count_community_agreement_dist_new();

                $first_constraction_new = $this->view_all_views_model->where('bri03construction_type', $x)->where('bri03work_category ', WORK_CATEGORY_NEW)
                    ->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri05first_phase_constrution_check ', '1')->view_dist01_bri05_count_first_constraction_fiscalyear();

                $first_constraction_carry = $this->view_all_views_model->where('bri03construction_type', $x)->where('bri03work_category ', WORK_CATEGORY_CARRY)
                    ->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri05first_phase_constrution_check ', '1')->view_dist01_bri05_count_first_constraction_fiscalyear();


                $material_handover_new = $this->view_all_views_model->where('bri03construction_type', $x)->where('bri03work_category ', WORK_CATEGORY_NEW)
                    //  where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                    ->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri05material_supply_uc_check', '1')->view_count_material_handover_fiscalyear();


                $material_handover_carry = $this->view_all_views_model->where('bri03construction_type', $x)->where('bri03work_category ', WORK_CATEGORY_CARRY)
                    // where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                    ->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri05material_supply_uc_check', '1')->view_count_material_handover_fiscalyear();


                // $total_under_Constr = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri03project_fiscal_year =', $FiscalDate)->
                // where('bri05work_completion_certificate_check  ', '0')->where('bri03work_category != ', WORK_CATEGORY_CANCELLED)->view_dist01_bri05_count_bridge_completion_fiscalyear();

                $bridges_complet_total_new = $this->view_all_views_model->where('bri03construction_type', $x)->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri05work_completion_certificate_check ', '1')->where('bri03work_category ', WORK_CATEGORY_NEW)->view_dist01_bri05_count_bridge_completion_fiscalyear_new();

                $bridges_complet_total_carry = $this->view_all_views_model->where('bri03construction_type', $x)->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri05work_completion_certificate_check ', '1')->where('bri03work_category ', WORK_CATEGORY_CARRY)->view_dist01_bri05_count_bridge_completion_fiscalyear_new();
                //  $this->output->enable_profiler(TRUE);

                /* 
                    /* author prasannanwr@gmail.com
                    */
                //steel and fabrication
                $steel_parts_new = $this->view_all_views_model->where('bri03construction_type', $x)->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri03work_category ', WORK_CATEGORY_NEW)->
                    //  where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                    where('bri05material_supply_target_check', '1')->view_count_steel_parts_fiscalyear();

                $steel_parts_carry = $this->view_all_views_model->where('bri03construction_type', $x)->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri03work_category ', WORK_CATEGORY_CARRY)->
                    // where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                    where('bri05material_supply_target_check', '1')->view_count_steel_parts_fiscalyear();

                //cable pulling
                $cable_pulling_new = $this->view_all_views_model->where('bri03construction_type', $x)->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri03work_category ', WORK_CATEGORY_NEW)->
                    //  where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                    where('bri05cable_pulling_check', '1')->view_count_cable_pulling_fiscalyear();

                $cable_pulling_carry = $this->view_all_views_model->where('bri03construction_type', $x)->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri03work_category ', WORK_CATEGORY_CARRY)->
                    // where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                    where('bri05cable_pulling_check', '1')->view_count_cable_pulling_fiscalyear();


                $arrDataList = array();
                foreach ($Previous_carry as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['Previous_carry'] = $v->bri03total_previous_carry_count;
                }
                foreach ($pipe_line as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['pipeline'] = $v->bri05total_first_phase_count;
                }
                foreach ($site_assessmen as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['site_assessmen'] = $v->bri05total_dist_site_assessment;
                }
                foreach ($design_esstimate as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['design_esstimate'] = $v->bri05total_design_estimate;
                }
                foreach ($community_agreement as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['community_agreement'] = $v->bri05total_community_agreement;
                }
                foreach ($first_constraction_new as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['first_constraction_new'] = $v->bri05total_first_phase_count;
                }
                foreach ($first_constraction_carry as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['first_constraction_carry'] = $v->bri05total_first_phase_count;
                }
                foreach ($material_handover_new as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['material_new'] = $v->bri05total_material_handover_count;
                }

                foreach ($material_handover_carry as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['material_carry'] = $v->bri05total_material_handover_count;
                }

                // foreach ($total_under_Constr as $k => $v)
                // {
                //      $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['total_under_Constr'] = $v->bri05total_completion_bridge_count;
                // }
                foreach ($bridges_complet_total_new as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['bridges_complet_total_new'] = $v->bri05total_completion_bridge_count;
                }
                foreach ($bridges_complet_total_carry as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['bridges_complet_total_carry'] = $v->bri05total_completion_bridge_count;
                }

                ////
                foreach ($steel_parts_new as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['steel_new'] = $v->bri05total_steel_parts_count;
                }
                foreach ($steel_parts_carry as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['steel_carry'] = $v->bri05total_steel_parts_count;
                }

                foreach ($cable_pulling_new as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['cable_pulling_new'] = $v->bri05total_cable_pulling_count;
                }
                foreach ($cable_pulling_carry as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['cable_pulling_carry'] = $v->bri05total_cable_pulling_count;
                }

                $data['arrPrintList'] = $arrDataList;

                $data['procumOverall'] = $this;
            } else {
                redirect("reports/Pro_Cumulative_Overall_datewise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function Pro_Physical_Progress_datewise_print($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dataStart = @$this->request->getVar('start_date');
        $dateEnd = @$this->request->getVar('end_date');
        $data = self::$arrDefData;
        $data['view_file'] = __function__;
        $data['blnMM'] = $stat;

        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('bridge/bridge_model');
        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('regional_office/regional_office_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_bridge_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');

        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back') {
            redirect("reports/main_completed_bridges");
        } elseif ($dataStart <= $dateEnd) {
            if ($dataStart != 0 || $dateEnd != 0) {
                $data['arrCostCompList'] = $this->supporting_agencies_model->findAll();
                $arrDistList = $this->view_regional_office_model->findAll();
                $arrSupList = $this->supporting_agencies_model->findAll();
                $arrPrintList = array();
                if (empty($stat)) {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_NEW_CONSTRUCTION
                    );
                } else {
                    $this->view_bridge_detail_model->where(
                        'bri03construction_type',
                        ENUM_MAJOR_MAINTENANCE
                    );
                }
                $this->view_bridge_detail_model->dbFilterCompleted();
                $data['arrDevList'] = $this->view_bridge_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->findAll();


                if (is_array($arrSupList)) {
                    foreach ($arrSupList as $k => $v) {
                        $data['arrsupportList']['sup_' . $v->sup01id] = $v;
                    }
                }
                if (is_array($arrDistList)) {
                    foreach ($arrDistList as $k => $v) {
                        $data['arrDistrictList']['dist_' . $v->dist01id] = $v;
                    }
                }
                //print_r( $data['arrDistrictList']);
                //  print_r($data['arrsupportList']);


                $arrBridgeIdList = null;
                if (is_array($data['arrDevList'])) {
                    foreach ($data['arrDevList'] as $k => $v2) {
                        $arrChild2 = null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        //$arrPrintList['sup_'.$v2->sup01id]['info']=$v2;
                        //$arrPrintList['sup_'.$v2->sup01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['sup_' . $v2->sup01id]['arrChildList']['dist_' . $v2->dist01id]['arrChildList'][] = array('info' => $v2);
                    }
                }



                $arrBridgeCostList = $this->view_all_actual_view_model->whereIn('bri08bridge_no', $arrBridgeIdList)->view_bridge_actual_cost();
                foreach ($arrBridgeCostList as $x2) {

                    $arrChild2['bri_' . $x2->bri08bridge_no]['id_' . $x2->bri08cmp01id] = $x2;
                }

                $data['arrCostList'] = $arrChild2;

                // print_r($arrPrintList);
                $data['arrPrintList'] = $arrPrintList;
            } else {
                redirect("reports/Act_Con_Supporting_AgencyWise_datewise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
    }

    /*
    * Fiscal agency wise progress report
    *  Added by prasanna
    */
    function Pro_Cumulative_Overall_agencywise($ext = '')
    {
        // $data = self::$arrDefData;
        // $data['view_file'] = __FUNCTION__ ;
        //  
        // $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        //  $data['blnMM'] = $ext;
        // return view('\Modules\Reports\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data); 

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['blnMM'] = $ext;
        $data['arrAgencyList'] = $this->supporting_agencies_model->findAll();

        $data['arrDistList'] = $this->fiscal_year_model->orderBy('fis01id DESC')->asObject()->findAll();
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }


    function Pro_Cumulative_Overall_agencywise_report($stat = '')
    {
        $Postback = @$this->request->getVar('submit');
        $dateStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $selAgency = @$this->request->getVar('selAgency'); // supporting agency

        $data = self::$arrDefData;
        $data['view_file'] = __FUNCTION__;
        $data['selAgency'] = $selAgency;


        // $this->load->model('supporting_agencies/supporting_agencies_model');
        // $this->load->model('district_name/district_name_model');
        // $this->load->model('view/view_all_views_model');
        // $this->load->model('view/view_bridge_detail_model');
        $data['blnMM'] = $stat;
        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dateStart)->asObject()->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->asObject()->first();

        // $data['startyear'] =$this->fiscal_year_model->where('fis01id', $dateStart)->first();
        // $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();  
        $data['supportingAgency'] = $this->supporting_agencies_model->where('sup01id', $selAgency)->asObject()->first();

        if ($Postback == 'Back') {
            //redirect("reports/main_completed_bridges");
            redirect(site_url());
        } elseif ($dateStart <= $dateEnd) {
            if ($dateStart != 0 || $dateEnd != 0) {


                $fiscalyear = $this->fiscal_year_model->asObject()->first();
                $FiscalDate = $fiscalyear->fis01id; // current fiscal year id

                $arrSupList = $this->supporting_agencies_model->asObject()->findAll();
                $arrDistList = $this->district_name_model->asObject()->findAll();

                if (is_array($arrSupList)) {

                    foreach ($arrSupList as $k => $v) {

                        $data['arrsupportList']['sup_' . $v->sup01id] = $v;
                    }
                }

                if (is_array($arrDistList)) {

                    foreach ($arrDistList as $k => $v) {

                        $data['arrDistrictList']['dist_' . $v->dist01id] = $v;
                    }
                }

                if (empty($stat)) {
                    $x = ENUM_NEW_CONSTRUCTION;
                } else {
                    $x = ENUM_MAJOR_MAINTENANCE;
                }

                //where('bri03project_fiscal_year =', $FiscalDate)
                $Previous_carry = $this->view_sup03_dist01_bri05_count_carry_previous->where('bri03construction_type', $x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)
                    ->where('bri03work_category =', WORK_CATEGORY_CARRY)->where('bri03supporting_agency =', $selAgency)->asObject()->findAll();


                //->where('bri03project_fiscal_year =', $FiscalDate)
                $pipe_line = $this->view_dist01_bri05_count_first_constraction_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri05first_phase_constrution_check ', '1')->where('bri03supporting_agency =', $selAgency)->asObject()->findAll();

                // $site_assessmen = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_completion_fiscalyear =', $FiscalDate)->
                // where('bri05site_assessment_check ', '1')->view_sup03_dist01_bri05_count_site_assessment_dist();

                $site_assessmen = $this->view_sup03_dist01_bri05_count_site_assessment_dist_new->where('bri03construction_type', $x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri05site_assessment_check ', '1')->where('bri03supporting_agency =', $selAgency)->asObject()->findAll();

                $design_esstimate = $this->view_sup03_dist01_bri05_count_design_estimate_bridges_new->where('bri03construction_type', $x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri05bridge_design_estimate_check ', '1')->where('bri03supporting_agency =', $selAgency)->asObject()->findAll();

                // $community_agreement = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_completion_fiscalyear =', $FiscalDate)->
                // where('bri05community_agreement_check ', '1')->view_sup03_dist01_bri05_count_community_agreement_dist();

                $community_agreement = $this->view_sup03_dist01_bri05_count_community_agreement_dist_new->where('bri03construction_type', $x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri05community_agreement_check ', '1')->where('bri03supporting_agency =', $selAgency)->asObject()->findAll();

                $first_constraction_new = $this->view_dist01_bri05_count_first_constraction_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri03work_category ', WORK_CATEGORY_NEW)->where('bri05first_phase_constrution_check ', '1')->where('bri03supporting_agency =', $selAgency)->asObject()->findAll();

                $first_constraction_carry = $this->view_dist01_bri05_count_first_constraction_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri03work_category ', WORK_CATEGORY_CARRY)->where('bri05first_phase_constrution_check ', '1')->where('bri03supporting_agency =', $selAgency)->asObject()->findAll();


                $material_handover_new = $this->view_count_material_handover_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri03work_category ', WORK_CATEGORY_NEW)->
                    //  where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                    where('bri05material_supply_uc_check', '1')->where('bri03supporting_agency =', $selAgency)->asObject()->findAll();


                $material_handover_carry = $this->view_count_material_handover_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri03work_category ', WORK_CATEGORY_CARRY)->
                    // where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                    where('bri05material_supply_uc_check', '1')->where('bri03supporting_agency =', $selAgency)->asObject()->findAll();


                // $total_under_Constr = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_completion_fiscalyear =', $FiscalDate)->
                // where('bri05work_completion_certificate_check  ', '0')->where('bri03work_category != ', WORK_CATEGORY_CANCELLED)->view_dist01_bri05_count_bridge_completion_fiscalyear();

                $bridges_complet_total_new = $this->view_dist01_bri05_count_bridge_completion_fiscalyear_new->where('bri03construction_type', $x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri05work_completion_certificate_check ', '1')->where('bri03supporting_agency =', $selAgency)->where('bri03work_category ', WORK_CATEGORY_NEW)->asObject()->findAll();

                $bridges_complet_total_carry = $this->view_dist01_bri05_count_bridge_completion_fiscalyear_new->where('bri03construction_type', $x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri05work_completion_certificate_check ', '1')->where('bri03supporting_agency =', $selAgency)->where('bri03work_category ', WORK_CATEGORY_CARRY)->asObject()->findAll();


                //added by prasanna
                //steel and fabrication
                $steel_parts_new = $this->view_count_steel_parts_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri03work_category ', WORK_CATEGORY_NEW)->
                    //  where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                    where('bri05material_supply_target_check', '1')->where('bri03supporting_agency =', $selAgency)->asObject()->findAll();

                $steel_parts_carry = $this->view_count_steel_parts_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri03work_category ', WORK_CATEGORY_CARRY)->
                    // where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                    where('bri05material_supply_target_check', '1')->where('bri03supporting_agency =', $selAgency)->asObject()->findAll();

                //cable pulling
                $cable_pulling_new = $this->view_count_cable_pulling_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri03work_category ', WORK_CATEGORY_NEW)->
                    //  where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                    where('bri05cable_pulling_check', '1')->where('bri03supporting_agency =', $selAgency)->asObject()->findAll();

                $cable_pulling_carry = $this->view_count_cable_pulling_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->where('bri03work_category ', WORK_CATEGORY_CARRY)->
                    // where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                    where('bri05cable_pulling_check', '1')->where('bri03supporting_agency =', $selAgency)->asObject()->findAll();


                $arrDataList = array();
                foreach ($Previous_carry as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['Previous_carry'] = $v->bri03total_previous_carry_count;
                }
                foreach ($pipe_line as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['pipeline'] = $v->bri05total_first_phase_count;
                }
                foreach ($site_assessmen as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['site_assessmen'] = $v->bri05total_dist_site_assessment;
                }
                foreach ($design_esstimate as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['design_esstimate'] = $v->bri05total_design_estimate;
                }
                foreach ($community_agreement as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['community_agreement'] = $v->bri05total_community_agreement;
                }
                foreach ($first_constraction_new as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['first_constraction_new'] = $v->bri05total_first_phase_count;
                }
                foreach ($first_constraction_carry as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['first_constraction_carry'] = $v->bri05total_first_phase_count;
                }
                foreach ($material_handover_new as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['material_new'] = $v->bri05total_material_handover_count;
                }

                foreach ($material_handover_carry as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['material_carry'] = $v->bri05total_material_handover_count;
                }

                // foreach ($total_under_Constr as $k => $v)
                // {
                //      $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['total_under_Constr'] = $v->bri05total_completion_bridge_count;
                // }
                foreach ($bridges_complet_total_new as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['bridges_complet_total_new'] = $v->bri05total_completion_bridge_count;
                }
                foreach ($bridges_complet_total_carry as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['bridges_complet_total_carry'] = $v->bri05total_completion_bridge_count;
                }

                foreach ($steel_parts_new as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['steel_new'] = $v->bri05total_steel_parts_count;
                }
                foreach ($steel_parts_carry as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['steel_carry'] = $v->bri05total_steel_parts_count;
                }

                foreach ($cable_pulling_new as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['cable_pulling_new'] = $v->bri05total_cable_pulling_count;
                }
                foreach ($cable_pulling_carry as $k => $v) {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['cable_pulling_carry'] = $v->bri05total_cable_pulling_count;
                }


                $data['arrPrintList'] = $arrDataList;

                $data['procumOverall'] = $this;
            } else {
                redirect("reports/Pro_Cumulative_Overall_agencywise/" . $stat);
            }
        } else {
            'start date is Smaller than End Date';
        }
        return view('\Modules\Reports\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }
}