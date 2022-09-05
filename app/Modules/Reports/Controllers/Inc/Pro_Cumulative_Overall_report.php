<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\cost_components\Models\CostComponentsModel;
use App\Modules\district_name\Models\district_name_model;
use App\Modules\fiscal_data\Models\fiscal_data_model;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\supporting_agencies\Models\supporting_agencies_model;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_all_views_model;
use App\Modules\view\Models\view_bridge_actual_cost;
use App\Modules\view\Models\view_bridge_detail_model;
use App\Modules\view\Models\view_count_cable_pulling_fiscalyear;
use App\Modules\view\Models\view_count_material_handover_fiscalyear;
use App\Modules\view\Models\view_count_steel_parts_fiscalyear;
use App\Modules\view\Models\view_dist01_bri05_count_first_constraction_fiscalyear;
use App\Modules\view\Models\view_regional_office_model;
use App\Modules\view\Models\view_sup03_dist01_bri05_count_carry_previous;
use App\Modules\view\Models\view_vdc_model;

//use App\Modules\Reports\Models\ReportsModel;

class Pro_Cumulative_Overall_report extends BaseController
{
    private static $arrDefData = array();

    private $fiscal_year_model;

    private $view_brigde_detail_model;

    private $template;

    private $view_vdc_model;

    private $cost_components_model;

    private $view_regional_office_model;

    private $supporting_agencies_model;

    private $view_bridge_actual_cost;

    private $district_name_model;

    private $view_all_views_model;

    private $view_sup03_dist01_bri05_count_carry_previous;

    private $view_dist01_bri05_count_first_constraction_fiscalyear;

    private $view_count_material_handover_fiscalyear;

    private $view_count_steel_parts_fiscalyear;

    private $view_count_cable_pulling_fiscalyear;

    private $fiscal_data_model;

    public function __construct()
    {
        helper(['form', 'html', 'et_helper']);
        $fiscal_year_model = new FiscalYearModel();
        $view_bridge_detail_model = new view_bridge_detail_model();
        $view_vdc_model  = new view_vdc_model();
        $cost_components_model = new CostComponentsModel();
        $view_regional_office_model = new view_regional_office_model();
        $supporting_agencies_model = new supporting_agencies_model();
        $view_bridge_actual_cost = new view_bridge_actual_cost();
        $district_name_model = new district_name_model();
        $view_all_views_model = new view_all_views_model();
        $view_sup03_dist01_bri05_count_carry_previous = new view_sup03_dist01_bri05_count_carry_previous();
        $view_dist01_bri05_count_first_constraction_fiscalyear = new view_dist01_bri05_count_first_constraction_fiscalyear();
        $view_count_material_handover_fiscalyear = new view_count_material_handover_fiscalyear();
        $view_count_steel_parts_fiscalyear =  new view_count_steel_parts_fiscalyear();
        $view_count_cable_pulling_fiscalyear  = new view_count_cable_pulling_fiscalyear();
        $fiscal_data_model = new fiscal_data_model();
        $this->fiscal_year_model = $fiscal_year_model;
        $this->view_brigde_detail_model = $view_bridge_detail_model;
        $this->view_vdc_model = $view_vdc_model;
        $this->cost_components_model = $cost_components_model;
        $this->view_regional_office_model = $view_regional_office_model;
        $this->supporting_agencies_model = $supporting_agencies_model;
        $this->view_bridge_actual_cost = $view_bridge_actual_cost;
        $this->district_name_model = $district_name_model;
        $this->view_all_views_model = $view_all_views_model;
        $this->view_sup03_dist01_bri05_count_carry_previous = $view_sup03_dist01_bri05_count_carry_previous;
        $this->view_count_material_handover_fiscalyear = $view_count_material_handover_fiscalyear;
        $this->view_count_steel_parts_fiscalyear = $view_count_steel_parts_fiscalyear;
        $this->view_dist01_bri05_count_first_constraction_fiscalyear = $view_dist01_bri05_count_first_constraction_fiscalyear;
        $this->view_count_cable_pulling_fiscalyear = $view_count_cable_pulling_fiscalyear;
        $this->fiscal_data_model = $fiscal_data_model;

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
        $dateStart = @$this->request->getVar('start_year');
        $dateEnd = @$this->request->getVar('end_year');
        $data['dateStart'] = $dateStart;
        // $data['dateEnd'] = $dateEnd;
        if ($dateStart == "" && $dateEnd == "") {
            redirect("reports/Pro_Cumulative_Overall");
        }

        $data['blnMM'] = $stat;

        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dateStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();

        //$FiscalDate =  9 ; 
        /* get the latest fiscal year from the db */
        $fiscalyear = $this->fiscal_year_model->first();
        $FiscalDate = $fiscalyear['fis01id']; // current fiscal year id

        $arrSupList = $this->supporting_agencies_model->findAll();
        $arrDistList = $this->district_name_model->findAll();

        if (is_array($arrSupList)) {

            foreach ($arrSupList as $k => $v) {

                $data['arrsupportList']['sup_' . $v['sup01id']] = $v;
            }
        }

        if (is_array($arrDistList)) {

            foreach ($arrDistList as $k => $v) {

                $data['arrDistrictList']['dist_' . $v['dist01id']] = $v;
            }
        }

        if (empty($stat)) {
            $x = ENUM_NEW_CONSTRUCTION;
        } else {
            $x = ENUM_MAJOR_MAINTENANCE;
        }

        $data['ctype'] = $x;
        //get current fiscal year    
        $fyarr = $this->fiscal_year_model->orderBy('fis01id DESC')->limit(1, 0)->findAll();

        $currentfy = $fyarr[0]['fis01id'];
        $fycode = $fyarr[0]['fis01year'];

        $data['currentfy'] = $currentfy;

        $startfy = substr($data['startyear']['fis01year'], 0, 4);
        $endfy = substr($data['endyear']['fis01year'], 4, 4);
        $fstartfy = $startfy . "-07-16";
        $fendfy = $endfy . "-07-15";

        if ($dateStart == $currentfy) { //current fy
            //$Previous_carry= $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_complete_check !=', 1)
            //->where('bri03work_category =', WORK_CATEGORY_CARRY)->view_sup03_dist01_bri05_count_carry_previous();   
            $Previous_carry = $this->view_all_views_model->view_sup03_dist01_bri05_count_carry_previous_($x, $currentfy);

            //exit;
            //->where('bri05bridge_completion_fiscalyear =', $FiscalDate)
            //$pipe_line= $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_complete_check !=', 1)->
            //where('bri05first_phase_constrution_check ', '1')->view_dist01_bri05_count_first_constraction_fiscalyear();


            // $site_assessmen = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_completion_fiscalyear =', $FiscalDate)->
            // where('bri05site_assessment_check ', '1')->view_sup03_dist01_bri05_count_site_assessment_dist();

            //$site_assessmen = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri03project_fiscal_year >=', $dateStart)->where('bri03project_fiscal_year <=', $dateEnd)->
            //where('bri05site_assessment_check ', '1')->view_sup03_dist01_bri05_count_site_assessment_dist_new();

            $site_assessmen = $this->view_all_views_model->view_sup03_dist01_bri05_count_site_assessment_dist_final($x, '', '', $fycode);


            //$design_esstimate = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri03project_fiscal_year >=', $dateStart)->where('bri03project_fiscal_year <=', $dateEnd)->
            //where('bri05bridge_design_estimate_check ', '1')->view_sup03_dist01_bri05_count_design_estimate_bridges_new();

            $design_esstimate = $this->view_all_views_model->view_sup03_dist01_bri05_count_design_estimate_bridges_final($x, '', '', $fycode);

            // $community_agreement = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri03project_fiscal_year =', $FiscalDate)->
            // where('bri05community_agreement_check ', '1')->view_sup03_dist01_bri05_count_community_agreement_dist();

            // $community_agreement = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri03project_fiscal_year >=', $dateStart)->where('bri03project_fiscal_year <=', $dateEnd)->
            // where('bri05community_agreement_check ', '1')->view_sup03_dist01_bri05_count_community_agreement_dist_new();

            $community_agreement = $this->view_all_views_model->view_sup03_dist01_bri05_count_community_agreement_dist_final($x, '', '', $fycode);

            //$first_constraction_new= $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_complete_check !=', 1)->
            //where('bri05first_phase_constrution_check ', '1')->view_dist01_bri05_count_first_constraction_fiscalyear();

            //$first_constraction_carry= $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_complete_check !=', 1)->where('bri03work_category ', WORK_CATEGORY_CARRY)->
            //where('bri05first_phase_constrution_check ', '1')->view_dist01_bri05_count_first_constraction_fiscalyear();

            $first_constraction_new = $this->view_all_views_model->view_dist01_bri05_count_first_constraction_fiscalyear_($x, WORK_CATEGORY_NEW, $currentfy);

            $first_constraction_carry = $this->view_all_views_model->view_dist01_bri05_count_first_constraction_fiscalyear_($x, WORK_CATEGORY_CARRY, $currentfy);

            //  $material_handover_new= $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_complete_check !=', 1)->where('bri03work_category ', WORK_CATEGORY_NEW)->
            //  where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
            //  where('bri05material_supply_uc_check', '1')->view_count_material_handover_fiscalyear();

            $material_handover_new = $this->view_all_views_model->view_count_material_handover_fiscalyear_($x, WORK_CATEGORY_NEW, $currentfy);

            // $material_handover_carry= $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_complete_check !=', 1)->where('bri03work_category ', WORK_CATEGORY_CARRY)->
            // where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
            //  where('bri05material_supply_uc_check', '1')->view_count_material_handover_fiscalyear();

            $material_handover_carry = $this->view_all_views_model->view_count_material_handover_fiscalyear_($x, WORK_CATEGORY_CARRY, $currentfy);

            //steel and fabrication
            //   $steel_parts_new= $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_complete_check !=', 1)->where('bri03work_category ', WORK_CATEGORY_NEW)->
            //  where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
            //  where('bri05material_supply_target_check', '1')->view_count_steel_parts_fiscalyear();

            //$steel_parts_carry= $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_complete_check !=', 1)->where('bri03work_category ', WORK_CATEGORY_CARRY)->
            // where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
            // where('bri05material_supply_target_check', '1')->view_count_steel_parts_fiscalyear();

            $steel_parts_new = $this->view_all_views_model->view_count_steel_parts_fiscalyear_($x, WORK_CATEGORY_NEW, $currentfy);

            $steel_parts_carry = $this->view_all_views_model->view_count_steel_parts_fiscalyear_($x, WORK_CATEGORY_CARRY, $currentfy);

            //cable pulling
            //  $cable_pulling_new= $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_complete_check !=', 1)->where('bri03work_category ', WORK_CATEGORY_NEW)->
            //  where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
            //   where('bri05cable_pulling_check', '1')->view_count_cable_pulling_fiscalyear();

            //  $cable_pulling_carry= $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_complete_check !=', 1)->where('bri03work_category ', WORK_CATEGORY_CARRY)->
            // where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
            //  where('bri05cable_pulling_check', '1')->view_count_cable_pulling_fiscalyear();

            $cable_pulling_new = $this->view_all_views_model->view_count_cable_pulling_fiscalyear_($x, WORK_CATEGORY_NEW, $currentfy);
            $cable_pulling_carry = $this->view_all_views_model->view_count_cable_pulling_fiscalyear_($x, WORK_CATEGORY_CARRY, $currentfy);



            //$total_under_Constr = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri03project_fiscal_year =', $FiscalDate)->
            //where('bri05work_completion_certificate_check  ', '0')->where('bri03work_category != ', WORK_CATEGORY_CANCELLED)->view_dist01_bri05_count_bridge_completion_fiscalyear();

            //$total_under_Constr = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri03project_fiscal_year >=', $dateStart)->where('bri03project_fiscal_year <=', $dateEnd)
            //->where('bri03work_category != ', WORK_CATEGORY_CANCELLED)->view_dist01_bri05_count_bridge_completion_fiscalyear();

            // $bridges_complet_total_new = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->
            // where('bri05bridge_complete_check', '1')->where('bri03work_category ', WORK_CATEGORY_NEW)->view_dist01_bri05_count_bridge_completion_fiscalyear_new();

            //$bridges_complet_total_new = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_completion_fiscalyear >=', $dateStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd)->
            //where('bri05bridge_complete_check', '1')->where('bri03work_category ', WORK_CATEGORY_NEW)->view_dist01_bri05_count_bridge_completion_fiscalyear1();

            $bridges_complet_total_new = $this->view_all_views_model->view_dist01_bri05_count_bridge_completion_fiscalyear1($x, $dateStart, $dateEnd, WORK_CATEGORY_NEW, $fstartfy, $fendfy);

            $bridges_complet_total_carry = $this->view_all_views_model->view_dist01_bri05_count_bridge_completion_fiscalyear1($x, $dateStart, $dateEnd, WORK_CATEGORY_CARRY, $fstartfy, $fendfy);

            $total_underconstruction = $this->view_all_views_model->getTotalUnderConstructionBridges('', '', $x);
        } else {

            $Previous_carry = $this->view_sup03_dist01_bri05_count_carry_previous->where('bri03construction_type', $x)->where('bri05bridge_complete_check !=', 1)
                ->where('bri03work_category =', WORK_CATEGORY_CARRY)->findAll();

            $site_assessmen = $this->view_all_views_model->view_sup03_dist01_bri05_count_site_assessment_dist_final($x, $dateStart, $dateEnd);

            $design_esstimate = $this->view_all_views_model->view_sup03_dist01_bri05_count_design_estimate_bridges_final($x, $dateStart, $dateEnd);

            $community_agreement = $this->view_all_views_model->view_sup03_dist01_bri05_count_community_agreement_dist_final($x, $dateStart, $dateEnd);

            $first_constraction_new = $this->view_dist01_bri05_count_first_constraction_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_complete_check !=', 1)->where('bri03work_category ', WORK_CATEGORY_NEW)->where('bri05first_phase_constrution_check ', '1')->findAll();

            $first_constraction_carry = $this->view_dist01_bri05_count_first_constraction_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_complete_check !=', 1)->where('bri03work_category ', WORK_CATEGORY_CARRY)->where('bri05first_phase_constrution_check ', '1')->findAll();

            $material_handover_new = $this->view_count_material_handover_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_complete_check !=', 1)->where('bri03work_category ', WORK_CATEGORY_NEW)->
                //  where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                where('bri05material_supply_uc_check', '1')->findAll();

            $material_handover_carry = $this->view_count_material_handover_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_complete_check !=', 1)->where('bri03work_category ', WORK_CATEGORY_CARRY)->
                // where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                where('bri05material_supply_uc_check', '1')->findAll();

            //steel and fabrication
            $steel_parts_new = $this->view_count_steel_parts_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_complete_check !=', 1)->where('bri03work_category ', WORK_CATEGORY_NEW)->
                //  where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                where('bri05material_supply_target_check', '1')->findAll();

            $steel_parts_carry = $this->view_count_steel_parts_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_complete_check !=', 1)->where('bri03work_category ', WORK_CATEGORY_CARRY)->
                // where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                where('bri05material_supply_target_check', '1')->findAll();

            //cable pulling
            $cable_pulling_new = $this->view_count_cable_pulling_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_complete_check !=', 1)->where('bri03work_category ', WORK_CATEGORY_NEW)->
                //  where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                where('bri05cable_pulling_check', '1')->findAll();

            $cable_pulling_carry = $this->view_count_cable_pulling_fiscalyear->where('bri03construction_type', $x)->where('bri05bridge_complete_check !=', 1)->where('bri03work_category ', WORK_CATEGORY_CARRY)->
                // where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
                where('bri05cable_pulling_check', '1')->findAll();

            $bridges_complet_total_new = $this->view_all_views_model->view_dist01_bri05_count_bridge_completion_fiscalyear1($x, $dateStart, $dateEnd, WORK_CATEGORY_NEW, $fstartfy, $fendfy);

            $bridges_complet_total_carry = $this->view_all_views_model->view_dist01_bri05_count_bridge_completion_fiscalyear1($x, $dateStart, $dateEnd, WORK_CATEGORY_CARRY, $fstartfy, $fendfy);

            $total_underconstruction = $this->view_all_views_model->getTotalUnderConstructionBridges($fstartfy, $fendfy, $x);
        }

        $arrDataList = array();
        foreach ($Previous_carry as $k => $v) {
            //$Previous_carry = $this->fiscal_data_model->where()		
            $arrDataList['sup_' . $v['bri03supporting_agency']]['dist_' . $v['dist01id']]['Previous_carry'] = $v['bri03total_previous_carry_count'];
        }

        /*foreach ($pipe_line as $k => $v)
    {
        $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['pipeline'] = $v->bri05total_first_phase_count;
    }*/
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
            $arrDataList['sup_' . $v['bri03supporting_agency']]['dist_' . $v['dist01id']]['first_constraction_new'] = $v['bri05total_first_phase_count'];
        }
        foreach ($first_constraction_carry as $k => $v) {
            $arrDataList['sup_' . $v['bri03supporting_agency']]['dist_' . $v['dist01id']]['first_constraction_carry'] = $v['bri05total_first_phase_count'];
        }
        foreach ($material_handover_new as $k => $v) {
            $arrDataList['sup_' . $v['bri03supporting_agency']]['dist_' . $v['dist01id']]['material_new'] = $v['bri05total_material_handover_count'];
        }

        foreach ($material_handover_carry as $k => $v) {
            $arrDataList['sup_' . $v['bri03supporting_agency']]['dist_' . $v['dist01id']]['material_carry'] = $v['bri05total_material_handover_count'];
        }

        //foreach ($total_under_Constr as $k => $v)
        //{
        //      $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['total_under_Constr'] = $v->bri05total_completion_bridge_count;
        //}
        foreach ($bridges_complet_total_new as $k => $v) {
            $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['bridges_complet_total_new'] = $v->bri05total_completion_bridge_count;
        }
        foreach ($bridges_complet_total_carry as $k => $v) {
            $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['bridges_complet_total_carry'] = $v->bri05total_completion_bridge_count;
        }

        foreach ($steel_parts_new as $k => $v) {
            $arrDataList['sup_' . $v['bri03supporting_agency']]['dist_' . $v['dist01id']]['steel_new'] = $v['bri05total_steel_parts_count'];
        }
        foreach ($steel_parts_carry as $k => $v) {
            $arrDataList['sup_' . $v['bri03supporting_agency']]['dist_' . $v['dist01id']]['steel_carry'] = $v['bri05total_steel_parts_count'];
        }

        foreach ($cable_pulling_new as $k => $v) {
            $arrDataList['sup_' . $v['bri03supporting_agency']]['dist_' . $v['dist01id']]['cable_pulling_new'] = $v['bri05total_cable_pulling_count'];
        }
        foreach ($cable_pulling_carry as $k => $v) {
            $arrDataList['sup_' . $v['bri03supporting_agency']]['dist_' . $v['dist01id']]['cable_pulling_carry'] = $v['bri05total_cable_pulling_count'];
        }

        foreach ($total_underconstruction as $k => $v) {
            $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['total_under_Constr'] = $v->bri05total_active_bridge_count;
        }

        // print_r($arrDataList);exit();
        $data['arrPrintList'] = $arrDataList;


        $data['procumOverall'] = $this;
        return view('\Modules\Reports\Views\Pro_Cumulative_Overall_report', $data);
    }

    public function getFiscalData($supplierId, $distId, $fy = '', $ctype)
    {
        $data = $this->fiscal_data_model->where('fis02sup01id', $supplierId)->where('fis02dist01codeid', $distId);
        if ($fy != '') {
            $data->where('fis02year', $fy);
        }
        $data->where('fis02constype', $ctype);
        $fiscaldata = $data->first();
        return $fiscaldata;
    }
}
