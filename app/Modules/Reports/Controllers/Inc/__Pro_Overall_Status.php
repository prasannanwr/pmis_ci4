<?php

$this->load->model('fiscal_year/fiscal_year_model');
$this->load->model('supporting_agencies/supporting_agencies_model');
$this->load->model('district_name/district_name_model');
$this->load->model('view/view_all_views_model');

$this->load->model('view/view_sup03_muni01_bri05_count_community_agreement_model');
$this->load->model('view/view_sup03_muni01_bri05_count_design_approval_model');
$this->load->model('view/view_sup03_muni01_bri05_count_first_constraction_model');
$this->load->model('view/view_sup03_muni01_bri05_count_site_assessment_model');

$this->load->model('view/view_sup01_muni01_wkc01_count_bri03_model');
$this->load->model('view/view_sup03_muni01_bri05_count_community_agreement_model');
$this->load->model('view/view_sup03_muni01_bri05_count_design_approval_model');
$this->load->model('view/view_sup03_muni01_bri05_count_first_constraction_model');
$this->load->model('view/view_sup03_muni01_bri05_count_site_assessment_model');

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


$bri_model = $this->view_all_views_model->where('bri03work_category', WORK_CATEGORY_CARRY)->
    view_sup01_muni01_wkc01_count_bri03_dist();
$community_agreement = $this->view_all_views_model->where('bri05community_agreement_check', COMPLETED)->
    view_sup03_dist01_bri05_count_community_agreement();
$design_approval = $this->view_all_views_model->where('bri05design_approval_check', COMPLETED)->
    view_sup03_dist01_bri05_count_design_approval();
$first_constraction = $this->view_all_views_model->//where('0', COMPLETED)->
    view_sup03_muni01_bri05_count_first_constraction_dist();
$site_assessmen = $this->view_all_views_model->where('bri05site_assessment_check', COMPLETED)->
    view_sup03_dist01_bri05_count_site_assessment();

//material handover
$material_handover_new = $this->view_all_views_model->where('bri05material_supply_target_check', COMPLETED)->
    view_sup03_dist01_bri05_count_site_assessment();

$arrDataList = array();
foreach ($bri_model as $k => $v)
{

    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['wc_' .
        $v->bri03work_category] = $v->bri03total_carry_over;
}
foreach ($community_agreement as $k => $v)
{
    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['ca_' .
        $v->bri05community_agreement_check] = $v->bri05total_community_agreement;
}
foreach ($design_approval as $k => $v)
{
    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['da_' . COMPLETED] = 
        $v->bri05total_design_approval;
}

foreach ($site_assessmen as $k => $v)
{
    $arrDataList['sup_' . $v->bri03supporting_agency]['dist_' . $v->dist01id]['sa_' .COMPLETED] = 
        $v->bri05total_dist_site_assessment;
}


$data['arrPrintList'] = $arrDataList;

$this->template->my_template($data);
