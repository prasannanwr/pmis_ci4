<?php



$this->load->model('fiscal_year/fiscal_year_model');

$this->load->model('supporting_agencies/supporting_agencies_model');

$this->load->model('district_name/district_name_model');

$this->load->model('view/view_all_views_model');
$this->load->model('view/view_brigde_detail_model');
 $data['blnMM'] = $stat;
 
 
 $FiscalDate =  9 ; 




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

        
    $pipe_line= $this->view_all_views_model->where('bri03construction_type',$x)->where('bri03project_fiscal_year =', $FiscalDate)->where('bri03work_category =', WORK_CATEGORY_NEW)->
    where('bri05first_phase_constrution_check =', '1')->view_dist01_bri05_count_first_constraction_fiscalyear();
    
    $site_assessmen = $this->view_all_views_model->where('bri03construction_type',
        $x)->where('bri03project_fiscal_year =', $FiscalDate)->where('bri03work_category =', WORK_CATEGORY_NEW)->
    where('bri05site_assessment_check =', '1')->view_sup03_dist01_bri05_count_site_assessment_dist();
  
    $design_esstimate = $this->view_all_views_model->where('bri03construction_type',
        $x)->where('bri03project_fiscal_year =', $FiscalDate)->where('bri03work_category =', WORK_CATEGORY_NEW)->
    where('bri05bridge_design_estimate_check =', '1')->view_sup03_dist01_bri05_count_design_estimate_bridges();
  
     $community_agreement = $this->view_all_views_model->where('bri03construction_type',
        $x)->where('bri03project_fiscal_year =', $FiscalDate)->where('bri03work_category =', WORK_CATEGORY_NEW)->
    where('bri05community_agreement_check =', '1')->view_sup03_dist01_bri05_count_community_agreement_dist();

    $first_constraction= $this->view_all_views_model->where('bri03construction_type',
        $x)->where('bri03project_fiscal_year =', $FiscalDate)->where('bri03work_category =', WORK_CATEGORY_NEW)->
    where('bri05first_phase_constrution_check =', '1')->view_dist01_bri05_count_first_constraction_fiscalyear();

         
    $material_handover= $this->view_all_views_model->where('bri03construction_type',$x)->
    where('bri03project_fiscal_year =', $FiscalDate)->where('bri03work_category =', WORK_CATEGORY_NEW)->
    where('bri05material_supply_target_check =', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
        
    
    $bridges_complet_total = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri03project_fiscal_year =', $FiscalDate)->
    where('bri05work_completion_certificate_check = ', '1')->where('bri03work_category =', WORK_CATEGORY_NEW)->view_dist01_bri05_count_bridge_completion_fiscalyear();
        
     
    $arrDataList = array();
     foreach ($pipe_line as $k => $v)
    
        {
            $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['pipeline'] = $v->bri05total_first_phase_count;
        }
    foreach ($site_assessmen as $k => $v)
        {
            $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['site_assessmen'] = $v->bri05total_completion_bridge_count;
        }
    
   foreach ($design_esstimate as $k => $v)
        {
            $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['design_esstimate'] = $v->bri05total_design_estimate;
        }
    
  foreach ($community_agreement as $k => $v)
        {
            $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['community_agreement'] = $v->bri05total_community_agreement;
        }
    
  foreach ($first_constraction as $k => $v)
        {
            $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['first_constraction'] = $v->bri05total_first_phase_count;
        }
    
    foreach ($material_handover as $k => $v)
         {
            $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['material'] = $v->bri05total_material_handover_count;
         }
    
    foreach ($bridges_complet_total as $k => $v)
        {
             $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['complet'] = $v->bri05total_completion_bridge_count;
        }
    
    
    $data['arrPrintList'] = $arrDataList;
    
  
 
    
    $this->template->my_template($data);

