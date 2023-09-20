<?php

namespace App\Modules\view\Models;

use CodeIgniter\Model;

class view_brigde_detail_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'view_bridge_major_dist';
    protected $primaryKey       = 'bri03id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

	public function dbGetList(){
        //check if loggged in or not
        //check if it has all district permission or not
        //
        $this->load->model('auth/sel_district_model');
        $arrPermittedDistListFull = $this->sel_district_model->where('user02userid', $this->session->userdata('user_id'))->dbGetList();
        $arrPermittedDistList = array();
        foreach( $arrPermittedDistListFull as $k=>$v ){
            $arrPermittedDistList[] = $v->user02dist01id;
        }
        $blnIsLogged = empty($this->session);
        $intUserType = ($blnIsLogged)? $this->session->userdata('type'): ENUM_GUEST; 
        if($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR){
            //comma seperated value
            if( count( $arrPermittedDistList )> 0){
                $this->where_in('dist01id', $arrPermittedDistList);
            }else{
                $this->where('dist01id', null);
            }
        }
        return parent::dbGetList();
    }
    public function dbFilterCompleted(){
        $this->where('bri05bridge_complete_check', 1)->where('bri05bridge_completion_fiscalyear_check', 1);
        return $this;
    }
	
	/*
	* $fy | fiscal year
	* $x | construction type
	* $selAgency | agency 
	*/
	public function getcbridges($fy,$x,$selAgency = '') { 
		$sql = "select `a`.`dist01id` AS `dist01id`,`a`.`dist01name` AS `dist01name`,`a`.`dist01zon01id` AS `dist01zon01id`,`a`.`dist01remark` AS `dist01remark`,`a`.`dist01code` AS `dist01code`,`a`.`dist01tbis01id` AS `dist01tbis01id`,`a`.`zon01id` AS `zon01id`,`a`.`zon01name` AS `zon01name`,`a`.`zon01dev01id` AS `zon01dev01id`,`a`.`zon01remark` AS `zon01remark`,`a`.`zon01code` AS `zon01code`,`a`.`dev01id` AS `dev01id`,`a`.`dev01name` AS `dev01name`,`a`.`dev01remark` AS `dev01remark`,`a`.`dev01code` AS `dev01code`,`b`.`bri03id` AS `bri03id`,`b`.`bri03bridge_name` AS `bri03bridge_name`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03bridge_no` AS `bri03bridge_no`,`b`.`bri03district_name_lb` AS `bri03district_name_lb`,`b`.`bri03district_name_rb` AS `bri03district_name_rb`,`b`.`bri03river_name` AS `bri03river_name`,`b`.`bri03municipality_lb` AS `bri03municipality_lb`,`b`.`bri03municipality_rb` AS `bri03municipality_rb`,`b`.`bri03major_vdc` AS `bri03major_vdc`,`b`.`bri03bridge_series` AS `bri03bridge_series`,`b`.`bri03ward_lb` AS `bri03ward_lb`,`b`.`bri03ward_rb` AS `bri03ward_rb`,`b`.`bri03road_head` AS `bri03road_head`,`b`.`bri03portering_distance` AS `bri03portering_distance`,`b`.`bri03bridge_type` AS `bri03bridge_type`,`b`.`bri03design` AS `bri03design`,`b`.`bri03ww_width` AS `bri03ww_width`,`b`.`bri03ww_deck_type` AS `bri03ww_deck_type`,`b`.`bri03development_region` AS `bri03development_region`,`b`.`bri03tbsu_regional_office` AS `bri03tbsu_regional_office`,`b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03work_category` AS `bri03work_category`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`b`.`bri03topo_map_no` AS `bri03topo_map_no`,`b`.`bri03coordinate_north` AS `bri03coordinate_north`,`b`.`bri03coordinate_east` AS `bri03coordinate_east`,`b`.`bri03e_span` AS `bri03e_span`,`b`.`bri03is_new` AS `bri03is_new`,`b`.`bri03ci_nol` AS `bri03ci_nol`,`b`.`bri03ci_nor` AS `bri03ci_nor`,`b`.`bri03ci_nomain` AS `bri03ci_nomain`,`b`.`bri03deleted` AS `bri03deleted`,`b`.`bri03status` AS `bri03status`,`b`.`bri01id` AS `bri01id`,`b`.`bri01bridge_type_code` AS `bri01bridge_type_code`,`b`.`bri01bridge_type_name` AS `bri01bridge_type_name`,`b`.`bri01description` AS `bri01description`,`b`.`bdr01id` AS `bdr01id`,`b`.`bdr01designer_id` AS `bdr01designer_id`,`b`.`bdr01designer_name` AS `bdr01designer_name`,`b`.`bdr01birth_date` AS `bdr01birth_date`,`b`.`bdr01address` AS `bdr01address`,`b`.`bdr01agency_id` AS `bdr01agency_id`,`b`.`bdr01description` AS `bdr01description`,`b`.`wal01id` AS `wal01id`,`b`.`wal01walkwaywidth_code` AS `wal01walkwaywidth_code`,`b`.`wal01walkway_width` AS `wal01walkway_width`,`b`.`wal01description` AS `wal01description`,`b`.`wad01id` AS `wad01id`,`b`.`wad01walkway_deck_type_code` AS `wad01walkway_deck_type_code`,`b`.`wad01walkway_deck_type_name` AS `wad01walkway_deck_type_name`,`b`.`wad01description` AS `wad01description`,`b`.`tbis01id` AS `tbis01id`,`b`.`tbis01name` AS `tbis01name`,`b`.`tbis01address` AS `tbis01address`,`b`.`tbis01remarks` AS `tbis01remarks`,`b`.`tbis01dev01id` AS `tbis01dev01id`,`b`.`sup01id` AS `sup01id`,`b`.`sup01sup_agency_code` AS `sup01sup_agency_code`,`b`.`sup01sup_agency_name` AS `sup01sup_agency_name`,`b`.`sup01sup_agency_type` AS `sup01sup_agency_type`,`b`.`sup01description` AS `sup01description`,`b`.`wkc01id` AS `wkc01id`,`b`.`wkc01work_category_code` AS `wkc01work_category_code`,`b`.`wkc01work_category_name` AS `wkc01work_category_name`,`b`.`wkc01description` AS `wkc01description`,`b`.`left_muni01id` AS `left_muni01id`,`b`.`left_muni01name` AS `left_muni01name`,`b`.`right_muni01id` AS `right_muni01id`,`b`.`right_muni01name` AS `right_muni01name`,`b`.`left_dist01id` AS `left_dist01id`,`b`.`left_dist01name` AS `left_dist01name`,`b`.`left_dist01code` AS `left_dist01code`,`b`.`left_dist01zon01id` AS `left_dist01zon01id`,`b`.`right_dist01id` AS `right_dist01id`,`b`.`right_dist01name` AS `right_dist01name`,`b`.`right_dist01code` AS `right_dist01code`,`b`.`right_dist01zon01id` AS `right_dist01zon01id`,`b`.`bri04id` AS `bri04id`,`b`.`bri04bridge_no` AS `bri04bridge_no`,`b`.`bri04anchorage_foundation_leftbank` AS `bri04anchorage_foundation_leftbank`,`b`.`bri04anchorage_foundation_rb` AS `bri04anchorage_foundation_rb`,`b`.`bri04slope_protection_lb` AS `bri04slope_protection_lb`,`b`.`bri04slope_protection_rb` AS `bri04slope_protection_rb`,`b`.`bri04handrail_cable_two` AS `bri04handrail_cable_two`,`b`.`bri04main_ww_cable_nos` AS `bri04main_ww_cable_nos`,`b`.`bri04main_ww_cable_dia` AS `bri04main_ww_cable_dia`,`b`.`bri04rust_prevention_measures` AS `bri04rust_prevention_measures`,`b`.`bri04bridge_design_standard` AS `bri04bridge_design_standard`,`b`.`bri04windguy_arrangement` AS `bri04windguy_arrangement`,`b`.`bri04deleted` AS `bri04deleted`,`b`.`bri04status` AS `bri04status`,`b`.`bri05id` AS `bri05id`,`b`.`bri05site_assessment` AS `bri05site_assessment`,`b`.`bri05bridge_design_estimate` AS `bri05bridge_design_estimate`,`b`.`bri05material_supply_target` AS `bri05material_supply_target`,`b`.`bri05first_phase_constrution` AS `bri05first_phase_constrution`,`b`.`bri05anchorage_concreting` AS `bri05anchorage_concreting`,`b`.`bri05bridge_complete` AS `bri05bridge_complete`,`b`.`bri05bmc_formation` AS `bri05bmc_formation`,`b`.`bri05sos_orentation` AS `bri05sos_orentation`,`b`.`bri05design_approval` AS `bri05design_approval`,`b`.`bri05bridge_completion_target` AS `bri05bridge_completion_target`,`b`.`bri05material_supply_uc` AS `bri05material_supply_uc`,`b`.`bri05cable_pulling` AS `bri05cable_pulling`,`b`.`bri05final_inspection` AS `bri05final_inspection`,`b`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,`b`.`bri05bridge_no` AS `bri05bridge_no`,`b`.`bri05community_agreement` AS `bri05community_agreement`,`b`.`bri05dmbt` AS `bri05dmbt`,`b`.`bri05second_phase_construction` AS `bri05second_phase_construction`,`b`.`bri05third_phase_construction` AS `bri05third_phase_construction`,`b`.`bri05work_completion_certificate` AS `bri05work_completion_certificate`,`b`.`bri05site_assessment_check` AS `bri05site_assessment_check`,`b`.`bri05bridge_design_estimate_check` AS `bri05bridge_design_estimate_check`,`b`.`bri05material_supply_target_check` AS `bri05material_supply_target_check`,`b`.`bri05first_phase_constrution_check` AS `bri05first_phase_constrution_check`,`b`.`bri05anchorage_concreting_check` AS `bri05anchorage_concreting_check`,`b`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`,`b`.`bri05bmc_formation_check` AS `bri05bmc_formation_check`,`b`.`bri05sos_orentation_check` AS `bri05sos_orentation_check`,`b`.`bri05design_approval_check` AS `bri05design_approval_check`,`b`.`bri05bridge_completion_target_check` AS `bri05bridge_completion_target_check`,`b`.`bri05material_supply_uc_check` AS `bri05material_supply_uc_check`,`b`.`bri05cable_pulling_check` AS `bri05cable_pulling_check`,`b`.`bri05final_inspection_check` AS `bri05final_inspection_check`,`b`.`bri05bridge_completion_fiscalyear_check` AS `bri05bridge_completion_fiscalyear_check`,`b`.`bri05community_agreement_check` AS `bri05community_agreement_check`,`b`.`bri05dmbt_check` AS `bri05dmbt_check`,`b`.`bri05second_phase_construction_check` AS `bri05second_phase_construction_check`,`b`.`bri05third_phase_construction_check` AS `bri05third_phase_construction_check`,`b`.`bri05work_completion_certificate_check` AS `bri05work_completion_certificate_check`,`b`.`bri06id` AS `bri06id`,`b`.`bri06bridge_no` AS `bri06bridge_no`,`b`.`bri06site_surveyor` AS `bri06site_surveyor`,`b`.`bri06design_approved_by` AS `bri06design_approved_by`,`b`.`bri06uc_members` AS `bri06uc_members`,`b`.`bri06ngo_consultants_trained` AS `bri06ngo_consultants_trained`,`b`.`bri06bridge_designer` AS `bri06bridge_designer`,`b`.`bri06site_supervision` AS `bri06site_supervision`,`b`.`bri06bridge_craftpersons_trained` AS `bri06bridge_craftpersons_trained`,`b`.`bri06bmc_chairperson` AS `bri06bmc_chairperson`,`b`.`bri06uc_chairperson` AS `bri06uc_chairperson`,`b`.`bri06ddc_technician_trained` AS `bri06ddc_technician_trained`,`b`.`bri06bmc_members` AS `bri06bmc_members`,`b`.`bri06deleted` AS `bri06deleted`,`b`.`bri06status` AS `bri06status`,`b`.`bri03major_dist_id` AS `bri03major_dist_id` from (`view_bridge_child` `b` left join `view_district` `a` on((`b`.`bri03major_dist_id` = `a`.`dist01id`))) 
		WHERE (`bri05bridge_complete_check` <> '1' OR `bri05bridge_completion_fiscalyear` = '$fy') AND bri03work_category != 3 AND bri03construction_type = '$x'";
		if($selAgency != '') {
			$sql .=" AND bri03supporting_agency = '$selAgency'";
		}
		$sql .= " ORDER BY bri03work_category DESC";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	/*
	* $fy | fiscal year
	* $x | construction type
	* $selAgency | agency 
	*/
	public function getoldcbridges($syear,$eyear,$x,$selAgency = '') { 

		$sql = "select `a`.`dist01id` AS `dist01id`,`a`.`dist01name` AS `dist01name`,`a`.`dist01zon01id` AS `dist01zon01id`,`a`.`dist01remark` AS `dist01remark`,`a`.`dist01code` AS `dist01code`,`a`.`dist01tbis01id` AS `dist01tbis01id`,`a`.`zon01id` AS `zon01id`,`a`.`zon01name` AS `zon01name`,`a`.`zon01dev01id` AS `zon01dev01id`,`a`.`zon01remark` AS `zon01remark`,`a`.`zon01code` AS `zon01code`,`a`.`dev01id` AS `dev01id`,`a`.`dev01name` AS `dev01name`,`a`.`dev01remark` AS `dev01remark`,`a`.`dev01code` AS `dev01code`,`b`.`bri03id` AS `bri03id`,`b`.`bri03bridge_name` AS `bri03bridge_name`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03bridge_no` AS `bri03bridge_no`,`b`.`bri03district_name_lb` AS `bri03district_name_lb`,`b`.`bri03district_name_rb` AS `bri03district_name_rb`,`b`.`bri03river_name` AS `bri03river_name`,`b`.`bri03municipality_lb` AS `bri03municipality_lb`,`b`.`bri03municipality_rb` AS `bri03municipality_rb`,`b`.`bri03major_vdc` AS `bri03major_vdc`,`b`.`bri03bridge_series` AS `bri03bridge_series`,`b`.`bri03ward_lb` AS `bri03ward_lb`,`b`.`bri03ward_rb` AS `bri03ward_rb`,`b`.`bri03road_head` AS `bri03road_head`,`b`.`bri03portering_distance` AS `bri03portering_distance`,`b`.`bri03bridge_type` AS `bri03bridge_type`,`b`.`bri03design` AS `bri03design`,`b`.`bri03ww_width` AS `bri03ww_width`,`b`.`bri03ww_deck_type` AS `bri03ww_deck_type`,`b`.`bri03development_region` AS `bri03development_region`,`b`.`bri03tbsu_regional_office` AS `bri03tbsu_regional_office`,`b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03work_category` AS `bri03work_category`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`b`.`bri03topo_map_no` AS `bri03topo_map_no`,`b`.`bri03coordinate_north` AS `bri03coordinate_north`,`b`.`bri03coordinate_east` AS `bri03coordinate_east`,`b`.`bri03e_span` AS `bri03e_span`,`b`.`bri03is_new` AS `bri03is_new`,`b`.`bri03ci_nol` AS `bri03ci_nol`,`b`.`bri03ci_nor` AS `bri03ci_nor`,`b`.`bri03ci_nomain` AS `bri03ci_nomain`,`b`.`bri03deleted` AS `bri03deleted`,`b`.`bri03status` AS `bri03status`,`b`.`bri01id` AS `bri01id`,`b`.`bri01bridge_type_code` AS `bri01bridge_type_code`,`b`.`bri01bridge_type_name` AS `bri01bridge_type_name`,`b`.`bri01description` AS `bri01description`,`b`.`bdr01id` AS `bdr01id`,`b`.`bdr01designer_id` AS `bdr01designer_id`,`b`.`bdr01designer_name` AS `bdr01designer_name`,`b`.`bdr01birth_date` AS `bdr01birth_date`,`b`.`bdr01address` AS `bdr01address`,`b`.`bdr01agency_id` AS `bdr01agency_id`,`b`.`bdr01description` AS `bdr01description`,`b`.`wal01id` AS `wal01id`,`b`.`wal01walkwaywidth_code` AS `wal01walkwaywidth_code`,`b`.`wal01walkway_width` AS `wal01walkway_width`,`b`.`wal01description` AS `wal01description`,`b`.`wad01id` AS `wad01id`,`b`.`wad01walkway_deck_type_code` AS `wad01walkway_deck_type_code`,`b`.`wad01walkway_deck_type_name` AS `wad01walkway_deck_type_name`,`b`.`wad01description` AS `wad01description`,`b`.`tbis01id` AS `tbis01id`,`b`.`tbis01name` AS `tbis01name`,`b`.`tbis01address` AS `tbis01address`,`b`.`tbis01remarks` AS `tbis01remarks`,`b`.`tbis01dev01id` AS `tbis01dev01id`,`b`.`sup01id` AS `sup01id`,`b`.`sup01sup_agency_code` AS `sup01sup_agency_code`,`b`.`sup01sup_agency_name` AS `sup01sup_agency_name`,`b`.`sup01sup_agency_type` AS `sup01sup_agency_type`,`b`.`sup01description` AS `sup01description`,`b`.`wkc01id` AS `wkc01id`,`b`.`wkc01work_category_code` AS `wkc01work_category_code`,`b`.`wkc01work_category_name` AS `wkc01work_category_name`,`b`.`wkc01description` AS `wkc01description`,`b`.`left_muni01id` AS `left_muni01id`,`b`.`left_muni01name` AS `left_muni01name`,`b`.`right_muni01id` AS `right_muni01id`,`b`.`right_muni01name` AS `right_muni01name`,`b`.`left_dist01id` AS `left_dist01id`,`b`.`left_dist01name` AS `left_dist01name`,`b`.`left_dist01code` AS `left_dist01code`,`b`.`left_dist01zon01id` AS `left_dist01zon01id`,`b`.`right_dist01id` AS `right_dist01id`,`b`.`right_dist01name` AS `right_dist01name`,`b`.`right_dist01code` AS `right_dist01code`,`b`.`right_dist01zon01id` AS `right_dist01zon01id`,`b`.`bri04id` AS `bri04id`,`b`.`bri04bridge_no` AS `bri04bridge_no`,`b`.`bri04anchorage_foundation_leftbank` AS `bri04anchorage_foundation_leftbank`,`b`.`bri04anchorage_foundation_rb` AS `bri04anchorage_foundation_rb`,`b`.`bri04slope_protection_lb` AS `bri04slope_protection_lb`,`b`.`bri04slope_protection_rb` AS `bri04slope_protection_rb`,`b`.`bri04handrail_cable_two` AS `bri04handrail_cable_two`,`b`.`bri04main_ww_cable_nos` AS `bri04main_ww_cable_nos`,`b`.`bri04main_ww_cable_dia` AS `bri04main_ww_cable_dia`,`b`.`bri04rust_prevention_measures` AS `bri04rust_prevention_measures`,`b`.`bri04bridge_design_standard` AS `bri04bridge_design_standard`,`b`.`bri04windguy_arrangement` AS `bri04windguy_arrangement`,`b`.`bri04deleted` AS `bri04deleted`,`b`.`bri04status` AS `bri04status`,`b`.`bri05id` AS `bri05id`,`b`.`bri05site_assessment` AS `bri05site_assessment`,`b`.`bri05bridge_design_estimate` AS `bri05bridge_design_estimate`,`b`.`bri05material_supply_target` AS `bri05material_supply_target`,`b`.`bri05first_phase_constrution` AS `bri05first_phase_constrution`,`b`.`bri05anchorage_concreting` AS `bri05anchorage_concreting`,`b`.`bri05bridge_complete` AS `bri05bridge_complete`,`b`.`bri05bmc_formation` AS `bri05bmc_formation`,`b`.`bri05sos_orentation` AS `bri05sos_orentation`,`b`.`bri05design_approval` AS `bri05design_approval`,`b`.`bri05bridge_completion_target` AS `bri05bridge_completion_target`,`b`.`bri05material_supply_uc` AS `bri05material_supply_uc`,`b`.`bri05cable_pulling` AS `bri05cable_pulling`,`b`.`bri05final_inspection` AS `bri05final_inspection`,`b`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,`b`.`bri05bridge_no` AS `bri05bridge_no`,`b`.`bri05community_agreement` AS `bri05community_agreement`,`b`.`bri05dmbt` AS `bri05dmbt`,`b`.`bri05second_phase_construction` AS `bri05second_phase_construction`,`b`.`bri05third_phase_construction` AS `bri05third_phase_construction`,`b`.`bri05work_completion_certificate` AS `bri05work_completion_certificate`,`b`.`bri05site_assessment_check` AS `bri05site_assessment_check`,`b`.`bri05bridge_design_estimate_check` AS `bri05bridge_design_estimate_check`,`b`.`bri05material_supply_target_check` AS `bri05material_supply_target_check`,`b`.`bri05first_phase_constrution_check` AS `bri05first_phase_constrution_check`,`b`.`bri05anchorage_concreting_check` AS `bri05anchorage_concreting_check`,`b`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`,`b`.`bri05bmc_formation_check` AS `bri05bmc_formation_check`,`b`.`bri05sos_orentation_check` AS `bri05sos_orentation_check`,`b`.`bri05design_approval_check` AS `bri05design_approval_check`,`b`.`bri05bridge_completion_target_check` AS `bri05bridge_completion_target_check`,`b`.`bri05material_supply_uc_check` AS `bri05material_supply_uc_check`,`b`.`bri05cable_pulling_check` AS `bri05cable_pulling_check`,`b`.`bri05final_inspection_check` AS `bri05final_inspection_check`,`b`.`bri05bridge_completion_fiscalyear_check` AS `bri05bridge_completion_fiscalyear_check`,`b`.`bri05community_agreement_check` AS `bri05community_agreement_check`,`b`.`bri05dmbt_check` AS `bri05dmbt_check`,`b`.`bri05second_phase_construction_check` AS `bri05second_phase_construction_check`,`b`.`bri05third_phase_construction_check` AS `bri05third_phase_construction_check`,`b`.`bri05work_completion_certificate_check` AS `bri05work_completion_certificate_check`,`b`.`bri06id` AS `bri06id`,`b`.`bri06bridge_no` AS `bri06bridge_no`,`b`.`bri06site_surveyor` AS `bri06site_surveyor`,`b`.`bri06design_approved_by` AS `bri06design_approved_by`,`b`.`bri06uc_members` AS `bri06uc_members`,`b`.`bri06ngo_consultants_trained` AS `bri06ngo_consultants_trained`,`b`.`bri06bridge_designer` AS `bri06bridge_designer`,`b`.`bri06site_supervision` AS `bri06site_supervision`,`b`.`bri06bridge_craftpersons_trained` AS `bri06bridge_craftpersons_trained`,`b`.`bri06bmc_chairperson` AS `bri06bmc_chairperson`,`b`.`bri06uc_chairperson` AS `bri06uc_chairperson`,`b`.`bri06ddc_technician_trained` AS `bri06ddc_technician_trained`,`b`.`bri06bmc_members` AS `bri06bmc_members`,`b`.`bri06deleted` AS `bri06deleted`,`b`.`bri06status` AS `bri06status`,`b`.`bri03major_dist_id` AS `bri03major_dist_id` from (`view_bridge_child` `b` left join `view_district` `a` on((`b`.`bri03major_dist_id` = `a`.`dist01id`))) 
		WHERE ((`bri05community_agreement` <= '$eyear' AND `bri05bridge_complete_check` != 1) OR (`bri05community_agreement` <= '$eyear' AND (`bri05bridge_complete` >= '$syear' AND `bri05bridge_complete` <= '$eyear'))) AND bri03work_category != 3 AND bri03construction_type = '$x'";
		if($selAgency != '') {
			$sql .=" AND bri03supporting_agency = '$selAgency'";
		}
		$sql .= " ORDER BY bri03work_category DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
}