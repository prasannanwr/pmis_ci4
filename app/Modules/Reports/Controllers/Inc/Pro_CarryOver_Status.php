<?php



$this->load->model('fiscal_year/fiscal_year_model');

$this->load->model('supporting_agencies/supporting_agencies_model');

$this->load->model('district_name/district_name_model');

$this->load->model('view/view_all_views_model');
$this->load->model('view/view_brigde_detail_model');
 $data['blnMM'] = $stat;
 
 $FiscalDate = 16 ; 




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

        
    $first_constraction= $this->view_all_views_model->where('bri03construction_type',
        $x)->where('bri03project_fiscal_year =', $FiscalDate)->where('bri03work_category =', WORK_CATEGORY_CARRY)->
    where('bri05first_phase_constrution_check =', '1')->view_dist01_bri05_count_first_constraction_fiscalyear();
        
        
    $material_handover= $this->view_all_views_model->where('bri03construction_type',$x)->
    where('bri03project_fiscal_year =', $FiscalDate)->where('bri03work_category =', WORK_CATEGORY_CARRY)->
    where('bri05material_supply_target_check =', '1')->view_dist01_bri05_count_material_handover_fiscalyear();
        
    
    $bridges_complet_total = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri03project_fiscal_year =', $FiscalDate)->
    where('bri05work_completion_certificate_check = ', '1')->where('bri03work_category =', WORK_CATEGORY_CARRY)->view_dist01_bri05_count_bridge_completion_fiscalyear();
        
    $bridges_carry_from_previous = $this->view_all_views_model->where('bri03construction_type',$x)->where('bri03work_category =', WORK_CATEGORY_CARRY)->where('bri03project_fiscal_year =', $FiscalDate)->
    where('bri05work_completion_certificate_check = ', '0')->
        view_dist01_bri05_count_bridge_completion_fiscalyear();
    
    
    $site_assessmen = $this->view_all_views_model->
    
        view_sup03_dist01_bri05_count_site_assessment_dist();
        
    
    
    
    
    $arrDataList = array();
    
    
    
    foreach ($first_constraction as $k => $v)
     //var_dump($v);
     //die();
    
    {
    
        $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['first_Phase'] = $v->bri05total_first_phase_count;
    
    }
    foreach ($bridges_carry_from_previous as $k => $v)
      //var_dump($v);
    
    {
    
        $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['carry_from'] = $v->bri05total_completion_bridge_count;
    
    }
    
    foreach ($material_handover as $k => $v)
      //var_dump($v);
    
    {
    
        $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['material'] = $v->bri05total_material_handover_count;
    
    }
    
    
    
    foreach ($bridges_complet_total as $k => $v)
          // var_dump($Fical_bridges_total);
    {
    
        $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['complet'] = $v->bri05total_completion_bridge_count;
    
    }
    
    
    $data['arrPrintList'] = $arrDataList;
    
    //print_r($data['arrPrintList'] );
    //die();
    
    $this->template->my_template($data);

