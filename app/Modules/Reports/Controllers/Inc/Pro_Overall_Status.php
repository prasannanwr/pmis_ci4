<?php



$this->load->model('fiscal_year/fiscal_year_model');

$this->load->model('supporting_agencies/supporting_agencies_model');

$this->load->model('district_name/district_name_model');

$this->load->model('view/view_all_views_model');
$this->load->model('view/view_fiscalyear_data_grouping_model');
$this->load->model('view/view_fiscaldata_grouping_sup01_dist01_model');
$this->load->model('view/view_brigde_detail_model');
 $data['blnMM'] = $stat;
$FiscalDate = 9 ;

//$this->load->model('view/view_sup03_dist01_bri05_count_community_agreement_model');

//$this->load->model('view/view_sup03_dist01_bri05_count_design_approval_model');

//$this->load->model('view/view_sup03_dist01_bri05_count_first_constraction_model');

//$this->load->model('view/view_sup03_dist01_bri05_count_site_assessment_model');



//$this->load->model('view/view_sup01_dist01_wkc01_count_bri03_model');






$arrSupList = $this->supporting_agencies_model->findAll();

$arrDistList = $this->district_name_model->findAll();





if (is_array($arrSupList))

{

    foreach ($arrSupList as $k => $v)

    {

        $data['arrsupportList']['sup_' . $v->sup01id] = $v;

    }

}

if (is_array($arrDistList))

{

    foreach ($arrDistList as $k => $v)

    {

        $data['arrDistrictList']['dist_' . $v->dist01id] = $v;

    }

}

 if (empty($stat))
    {
     $x = ENUM_NEW_CONSTRUCTION;
    } else
    {
     $x = ENUM_MAJOR_MAINTENANCE;

    }

           
            $Previous_carry= $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_complete_check', '0')
            ->where('bri03work_category =', WORK_CATEGORY_CARRY)->view_sup03_dist01_bri05_count_carry_previous();
            
            $pipe_line= $this->view_all_views_model->where('bri03construction_type',$x)->where('bri05bridge_complete_check ', '0')->
            where('bri03work_category ', WORK_CATEGORY_NEW)->view_dist01_bri05_count_first_constraction_fiscalyear();
            
            $site_assessmen = $this->view_all_views_model->where('bri03construction_type',
            $x)->
            where('bri05site_assessment_check ', '1')->view_sup03_dist01_bri05_count_site_assessment_dist();
            
            $design_esstimate = $this->view_all_views_model->where('bri03construction_type',
            $x)->where('bri05bridge_design_estimate_check ', '1')->view_sup03_dist01_bri05_count_design_estimate_bridges();
            
            $community_agreement = $this->view_all_views_model->where('bri03construction_type',
            $x)->
            where('bri05community_agreement_check ', '1')->view_sup03_dist01_bri05_count_community_agreement_dist();
            
            
            $first_constraction_carryover= $this->view_all_views_model->where('bri03construction_type',
            $x)->where('bri03work_category ', WORK_CATEGORY_CARRY)->
            where('bri05first_phase_constrution_check =', '1')->view_dist01_bri05_count_first_constraction_fiscalyear();
            
            $first_constraction_new= $this->view_all_views_model->where('bri03construction_type',
            $x)->where('bri03work_category =', WORK_CATEGORY_NEW)->
            where('bri05first_phase_constrution_check =', '1')->view_dist01_bri05_count_first_constraction_fiscalyear();
            
            $material_handover_new= $this->view_all_views_model->where('bri03construction_type',$x)->
            where('bri03work_category ', WORK_CATEGORY_NEW)->
            where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
            
            $material_handover_carry= $this->view_all_views_model->where('bri03construction_type',$x)->
            where('bri03work_category ', WORK_CATEGORY_CARRY)->
            where('bri05material_supply_target_check ', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
            
            $total_under_Constr = $this->view_all_views_model->where('bri03construction_type',$x)->
            where('bri05bridge_complete_check  ', '0')->where('bri03work_category != ', WORK_CATEGORY_CANCELLED)->view_dist01_bri05_count_bridge_completion_fiscalyear();
            
            $bridges_complet_total_new = $this->view_all_views_model->where('bri03construction_type',$x)->
            where('bri05bridge_complete_check ', '1')->where('bri03work_category ', WORK_CATEGORY_NEW)->view_dist01_bri05_count_bridge_completion_fiscalyear();
            
            $bridges_complet_total_carry = $this->view_all_views_model->where('bri03construction_type',$x)->
            where('bri05bridge_complete_check ', '0')->where('bri03work_category ', WORK_CATEGORY_CARRY)->view_dist01_bri05_count_bridge_completion_fiscalyear();
            
            $Anticipated_Completion = $this->view_fiscaldata_grouping_sup01_dist01_model->where('bri03construction_type',$x)->where('fis02year =', $FiscalDate)->
            findAll();
            //var_dump($Previous_carry);
  
            
            





            $arrDataList = array();
            
            foreach ($Previous_carry as $k => $v)
            
                {
                $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['Previous_carry'] = $v->bri03total_previous_carry_count;
                }
            
            foreach ($Anticipated_Completion as $k => $v)
            
                {
                $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['pipe_line'] = $v->sumdata4;
                 }
            
            foreach ($site_assessmen as $k => $v)
                {
                $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['site_assessmen'] = $v->bri05total_dist_site_assessment;
                 }
            
            
            foreach ($design_esstimate as $k => $v)
                {
                $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['design_esstimate'] = $v->bri05total_design_estimate;
                }
            
            foreach ($community_agreement as $k => $v)
                {
                $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['community_agreement'] = $v->bri05total_community_agreement;
                }
            
            foreach ($first_constraction_new as $k => $v)
                {
                $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['first_constraction_new'] = $v->bri05total_first_phase_count;
                }
            foreach ($first_constraction_carryover as $k => $v)
                {
                $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['first_constraction_carry'] = $v->bri05total_first_phase_count;
                }
            
            foreach ($material_handover_new as $k => $v)
                {
                $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['material_new'] = $v->bri05total_material_handover_count;
                }
            
            foreach ($material_handover_carry as $k => $v)
                {
                $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['material_carry'] = $v->bri05total_material_handover_count;
                }
            
            foreach ($total_under_Constr as $k => $v)
                {
                $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['total_under_Constr'] = $v->bri05total_completion_bridge_count;
                }
            foreach ($bridges_complet_total_new as $k => $v)
                {
                $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['bridges_complet_total_new'] = $v->bri05total_completion_bridge_count;
                }
            foreach ($bridges_complet_total_carry as $k => $v)
                {
                $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['bridges_complet_total_carry'] = $v->bri05total_completion_bridge_count;
                }
            foreach ($Anticipated_Completion as $k => $v)
                {
                $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['Anticipated_Completion'] = $v->sumdata2;
                }
        foreach ($Anticipated_Completion as $k => $v)
                    {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['YOP_carry'] = $v->sumdata3;
                    }
        foreach ($Anticipated_Completion as $k => $v)
                    {
                    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['YOP_new'] = $v->sumdata4;
                    }




$data['arrPrintList'] = $arrDataList;



$this->template->my_template($data);

