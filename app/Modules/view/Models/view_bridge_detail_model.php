<?php

namespace App\Modules\view\Models;

use CodeIgniter\Model;
use App\Modules\User\Models\UserModel;

class view_bridge_detail_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'view_bridge_major_dist';
    protected $primaryKey       = 'dist01id';
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
    
    public function dbFilterCompleted(){
        return $this->where('bri05bridge_complete_check', 1)->where('bri05bridge_completion_fiscalyear_check', 1)->findAll();
    }
    /*
	* $fy | fiscal year
	* $x | construction type
	* $selAgency | agency 
	*/
	public function getcbridges($fy,$x,$selAgency = '',$selProvince = '') { 
		
        //
        $sql = "select `a`.`dist01id` AS `dist01id`,`a`.`dist01name` AS `dist01name`,`a`.`dist01code` AS `dist01code`,`a`.`dist01tbis01id` AS `dist01tbis01id`,`a`.`dist01state` as `dist01state`,`b`.`bri03id` AS `bri03id`,`b`.`bri03bridge_name` AS `bri03bridge_name`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03bridge_no` AS `bri03bridge_no`,`b`.`bri03district_name_lb` AS `bri03district_name_lb`,`b`.`bri03district_name_rb` AS `bri03district_name_rb`,`b`.`bri03river_name` AS `bri03river_name`,`b`.`bri03municipality_lb` AS `bri03municipality_lb`,`b`.`bri03municipality_rb` AS `bri03municipality_rb`,`b`.`bri03major_vdc` AS `bri03major_vdc`,`b`.`bri03bridge_series` AS `bri03bridge_series`,`b`.`bri03ward_lb` AS `bri03ward_lb`,`b`.`bri03ward_rb` AS `bri03ward_rb`,`b`.`bri03road_head` AS `bri03road_head`,`b`.`bri03portering_distance` AS `bri03portering_distance`,`b`.`bri03bridge_type` AS `bri03bridge_type`,`b`.`bri03design` AS `bri03design`,`b`.`bri03ww_width` AS `bri03ww_width`,`b`.`bri03ww_deck_type` AS `bri03ww_deck_type`,`b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03work_category` AS `bri03work_category`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`b`.`bri03e_span` AS `bri03e_span`,`b`.`bri03is_new` AS `bri03is_new`,`b`.`bri03ci_nol` AS `bri03ci_nol`,`b`.`bri03ci_nor` AS `bri03ci_nor`,`b`.`bri03ci_nomain` AS `bri03ci_nomain`,`b`.`bri03deleted` AS `bri03deleted`,`b`.`bri03status` AS `bri03status`,`b`.`bri01id` AS `bri01id`,`b`.`bri01bridge_type_code` AS `bri01bridge_type_code`,`b`.`bri01bridge_type_name` AS `bri01bridge_type_name`,`b`.`bri01description` AS `bri01description`,`b`.`wal01id` AS `wal01id`,`b`.`wal01walkwaywidth_code` AS `wal01walkwaywidth_code`,`b`.`wal01walkway_width` AS `wal01walkway_width`,`b`.`wal01description` AS `wal01description`,`b`.`wad01id` AS `wad01id`,`b`.`wad01walkway_deck_type_code` AS `wad01walkway_deck_type_code`,`b`.`wad01walkway_deck_type_name` AS `wad01walkway_deck_type_name`,`b`.`wad01description` AS `wad01description`,`b`.`sup01id` AS `sup01id`,`b`.`sup01sup_agency_code` AS `sup01sup_agency_code`,`b`.`sup01sup_agency_name` AS `sup01sup_agency_name`,`b`.`sup01sup_agency_type` AS `sup01sup_agency_type`,`b`.`sup01description` AS `sup01description`,`b`.`wkc01id` AS `wkc01id`,`b`.`wkc01work_category_code` AS `wkc01work_category_code`,`b`.`wkc01work_category_name` AS `wkc01work_category_name`,`b`.`wkc01description` AS `wkc01description`,`b`.`left_muni01id` AS `left_muni01id`,`b`.`left_muni01name` AS `left_muni01name`,`b`.`right_muni01id` AS `right_muni01id`,`b`.`right_muni01name` AS `right_muni01name`,`b`.`left_dist01id` AS `left_dist01id`,`b`.`left_dist01name` AS `left_dist01name`,`b`.`left_dist01code` AS `left_dist01code`,`b`.`left_dist01zon01id` AS `left_dist01zon01id`,`b`.`right_dist01id` AS `right_dist01id`,`b`.`right_dist01name` AS `right_dist01name`,`b`.`right_dist01code` AS `right_dist01code`,`b`.`right_dist01zon01id` AS `right_dist01zon01id`,`b`.`bri05id` AS `bri05id`,`b`.`bri05site_assessment` AS `bri05site_assessment`,`b`.`bri05bridge_design_estimate` AS `bri05bridge_design_estimate`,`b`.`bri05material_supply_target` AS `bri05material_supply_target`,`b`.`bri05first_phase_constrution` AS `bri05first_phase_constrution`,`b`.`bri05anchorage_concreting` AS `bri05anchorage_concreting`,`b`.`bri05bridge_complete` AS `bri05bridge_complete`,`b`.`bri05bmc_formation` AS `bri05bmc_formation`,`b`.`bri05sos_orentation` AS `bri05sos_orentation`,`b`.`bri05design_approval` AS `bri05design_approval`,`b`.`bri05bridge_completion_target` AS `bri05bridge_completion_target`,`b`.`bri05material_supply_uc` AS `bri05material_supply_uc`,`b`.`bri05cable_pulling` AS `bri05cable_pulling`,`b`.`bri05final_inspection` AS `bri05final_inspection`,`b`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,`b`.`bri05bridge_no` AS `bri05bridge_no`,`b`.`bri05community_agreement` AS `bri05community_agreement`,`b`.`bri05dmbt` AS `bri05dmbt`,`b`.`bri05second_phase_construction` AS `bri05second_phase_construction`,`b`.`bri05third_phase_construction` AS `bri05third_phase_construction`,`b`.`bri05work_completion_certificate` AS `bri05work_completion_certificate`,`b`.`bri05site_assessment_check` AS `bri05site_assessment_check`,`b`.`bri05bridge_design_estimate_check` AS `bri05bridge_design_estimate_check`,`b`.`bri05material_supply_target_check` AS `bri05material_supply_target_check`,`b`.`bri05first_phase_constrution_check` AS `bri05first_phase_constrution_check`,`b`.`bri05anchorage_concreting_check` AS `bri05anchorage_concreting_check`,`b`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`,`b`.`bri05bmc_formation_check` AS `bri05bmc_formation_check`,`b`.`bri05sos_orentation_check` AS `bri05sos_orentation_check`,`b`.`bri05design_approval_check` AS `bri05design_approval_check`,`b`.`bri05bridge_completion_target_check` AS `bri05bridge_completion_target_check`,`b`.`bri05material_supply_uc_check` AS `bri05material_supply_uc_check`,`b`.`bri05cable_pulling_check` AS `bri05cable_pulling_check`,`b`.`bri05final_inspection_check` AS `bri05final_inspection_check`,`b`.`bri05bridge_completion_fiscalyear_check` AS `bri05bridge_completion_fiscalyear_check`,`b`.`bri05community_agreement_check` AS `bri05community_agreement_check`,`b`.`bri05dmbt_check` AS `bri05dmbt_check`,`b`.`bri05second_phase_construction_check` AS `bri05second_phase_construction_check`,`b`.`bri05third_phase_construction_check` AS `bri05third_phase_construction_check`,`b`.`bri05work_completion_certificate_check` AS `bri05work_completion_certificate_check`,`b`.`bri03major_dist_id` AS `bri03major_dist_id` from (`view_bridge_child_pro` `b` left join `view_district` `a` on((`b`.`bri03major_dist_id` = `a`.`dist01id`))) 
        WHERE (`bri05bridge_complete_check` <> '1' OR `bri05bridge_completion_fiscalyear` = '$fy') AND bri03work_category != 3 AND bri03construction_type = '$x'";
        if($selAgency != '') {
            $sql .=" AND bri03supporting_agency = '$selAgency'";
        }
        if(trim($selProvince) != '') {
            $sql .=" AND dist01state = '$selProvince'";
        }//
		$sql .= " ORDER BY bri03work_category DESC";
		
		$query = $this->db->query($sql);
		return $query->getResult();
	}
	
	/*
	* $fy | fiscal year
	* $x | construction type
	* $selAgency | agency 
	*/
	public function getoldcbridges($syear,$eyear,$x,$selAgency = '',$selProvince = '') { 

		$sql = "select `a`.`dist01id` AS `dist01id`,`a`.`dist01name` AS `dist01name`,`a`.`dist01zon01id` AS `dist01zon01id`,`a`.`dist01remark` AS `dist01remark`,`a`.`dist01code` AS `dist01code`,`a`.`dist01tbis01id` AS `dist01tbis01id`,`a`.`dist01state` as `dist01state`, `a`.`zon01id` AS `zon01id`,`a`.`zon01name` AS `zon01name`,`a`.`zon01dev01id` AS `zon01dev01id`,`a`.`zon01remark` AS `zon01remark`,`a`.`zon01code` AS `zon01code`,`a`.`dev01id` AS `dev01id`,`a`.`dev01name` AS `dev01name`,`a`.`dev01remark` AS `dev01remark`,`a`.`dev01code` AS `dev01code`,`b`.`bri03id` AS `bri03id`,`b`.`bri03bridge_name` AS `bri03bridge_name`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03bridge_no` AS `bri03bridge_no`,`b`.`bri03district_name_lb` AS `bri03district_name_lb`,`b`.`bri03district_name_rb` AS `bri03district_name_rb`,`b`.`bri03river_name` AS `bri03river_name`,`b`.`bri03municipality_lb` AS `bri03municipality_lb`,`b`.`bri03municipality_rb` AS `bri03municipality_rb`,`b`.`bri03major_vdc` AS `bri03major_vdc`,`b`.`bri03bridge_series` AS `bri03bridge_series`,`b`.`bri03ward_lb` AS `bri03ward_lb`,`b`.`bri03ward_rb` AS `bri03ward_rb`,`b`.`bri03road_head` AS `bri03road_head`,`b`.`bri03portering_distance` AS `bri03portering_distance`,`b`.`bri03bridge_type` AS `bri03bridge_type`,`b`.`bri03design` AS `bri03design`,`b`.`bri03ww_width` AS `bri03ww_width`,`b`.`bri03ww_deck_type` AS `bri03ww_deck_type`,`b`.`bri03development_region` AS `bri03development_region`,`b`.`bri03tbsu_regional_office` AS `bri03tbsu_regional_office`,`b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03work_category` AS `bri03work_category`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`b`.`bri03topo_map_no` AS `bri03topo_map_no`,`b`.`bri03coordinate_north` AS `bri03coordinate_north`,`b`.`bri03coordinate_east` AS `bri03coordinate_east`,`b`.`bri03e_span` AS `bri03e_span`,`b`.`bri03is_new` AS `bri03is_new`,`b`.`bri03ci_nol` AS `bri03ci_nol`,`b`.`bri03ci_nor` AS `bri03ci_nor`,`b`.`bri03ci_nomain` AS `bri03ci_nomain`,`b`.`bri03deleted` AS `bri03deleted`,`b`.`bri03status` AS `bri03status`,`b`.`bri01id` AS `bri01id`,`b`.`bri01bridge_type_code` AS `bri01bridge_type_code`,`b`.`bri01bridge_type_name` AS `bri01bridge_type_name`,`b`.`bri01description` AS `bri01description`,`b`.`wal01id` AS `wal01id`,`b`.`wal01walkwaywidth_code` AS `wal01walkwaywidth_code`,`b`.`wal01walkway_width` AS `wal01walkway_width`,`b`.`wal01description` AS `wal01description`,`b`.`wad01id` AS `wad01id`,`b`.`wad01walkway_deck_type_code` AS `wad01walkway_deck_type_code`,`b`.`wad01walkway_deck_type_name` AS `wad01walkway_deck_type_name`,`b`.`wad01description` AS `wad01description`,`b`.`sup01id` AS `sup01id`,`b`.`sup01sup_agency_code` AS `sup01sup_agency_code`,`b`.`sup01sup_agency_name` AS `sup01sup_agency_name`,`b`.`sup01sup_agency_type` AS `sup01sup_agency_type`,`b`.`sup01description` AS `sup01description`,`b`.`wkc01id` AS `wkc01id`,`b`.`wkc01work_category_code` AS `wkc01work_category_code`,`b`.`wkc01work_category_name` AS `wkc01work_category_name`,`b`.`wkc01description` AS `wkc01description`,`b`.`left_muni01id` AS `left_muni01id`,`b`.`left_muni01name` AS `left_muni01name`,`b`.`right_muni01id` AS `right_muni01id`,`b`.`right_muni01name` AS `right_muni01name`,`b`.`left_dist01id` AS `left_dist01id`,`b`.`left_dist01name` AS `left_dist01name`,`b`.`left_dist01code` AS `left_dist01code`,`b`.`left_dist01zon01id` AS `left_dist01zon01id`,`b`.`right_dist01id` AS `right_dist01id`,`b`.`right_dist01name` AS `right_dist01name`,`b`.`right_dist01code` AS `right_dist01code`,`b`.`right_dist01zon01id` AS `right_dist01zon01id`,`b`.`bri05id` AS `bri05id`,`b`.`bri05site_assessment` AS `bri05site_assessment`,`b`.`bri05bridge_design_estimate` AS `bri05bridge_design_estimate`,`b`.`bri05material_supply_target` AS `bri05material_supply_target`,`b`.`bri05first_phase_constrution` AS `bri05first_phase_constrution`,`b`.`bri05anchorage_concreting` AS `bri05anchorage_concreting`,`b`.`bri05bridge_complete` AS `bri05bridge_complete`,`b`.`bri05bmc_formation` AS `bri05bmc_formation`,`b`.`bri05sos_orentation` AS `bri05sos_orentation`,`b`.`bri05design_approval` AS `bri05design_approval`,`b`.`bri05bridge_completion_target` AS `bri05bridge_completion_target`,`b`.`bri05material_supply_uc` AS `bri05material_supply_uc`,`b`.`bri05cable_pulling` AS `bri05cable_pulling`,`b`.`bri05final_inspection` AS `bri05final_inspection`,`b`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,`b`.`bri05bridge_no` AS `bri05bridge_no`,`b`.`bri05community_agreement` AS `bri05community_agreement`,`b`.`bri05dmbt` AS `bri05dmbt`,`b`.`bri05second_phase_construction` AS `bri05second_phase_construction`,`b`.`bri05third_phase_construction` AS `bri05third_phase_construction`,`b`.`bri05work_completion_certificate` AS `bri05work_completion_certificate`,`b`.`bri05site_assessment_check` AS `bri05site_assessment_check`,`b`.`bri05bridge_design_estimate_check` AS `bri05bridge_design_estimate_check`,`b`.`bri05material_supply_target_check` AS `bri05material_supply_target_check`,`b`.`bri05first_phase_constrution_check` AS `bri05first_phase_constrution_check`,`b`.`bri05anchorage_concreting_check` AS `bri05anchorage_concreting_check`,`b`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`,`b`.`bri05bmc_formation_check` AS `bri05bmc_formation_check`,`b`.`bri05sos_orentation_check` AS `bri05sos_orentation_check`,`b`.`bri05design_approval_check` AS `bri05design_approval_check`,`b`.`bri05bridge_completion_target_check` AS `bri05bridge_completion_target_check`,`b`.`bri05material_supply_uc_check` AS `bri05material_supply_uc_check`,`b`.`bri05cable_pulling_check` AS `bri05cable_pulling_check`,`b`.`bri05final_inspection_check` AS `bri05final_inspection_check`,`b`.`bri05bridge_completion_fiscalyear_check` AS `bri05bridge_completion_fiscalyear_check`,`b`.`bri05community_agreement_check` AS `bri05community_agreement_check`,`b`.`bri05dmbt_check` AS `bri05dmbt_check`,`b`.`bri05second_phase_construction_check` AS `bri05second_phase_construction_check`,`b`.`bri05third_phase_construction_check` AS `bri05third_phase_construction_check`,`b`.`bri05work_completion_certificate_check` AS `bri05work_completion_certificate_check`,`b`.`bri03major_dist_id` AS `bri03major_dist_id` from (`view_bridge_child_pro` `b` left join `view_district` `a` on((`b`.`bri03major_dist_id` = `a`.`dist01id`))) 
		WHERE ((`bri05community_agreement` <= '$eyear' AND `bri05bridge_complete_check` != 1) OR (`bri05community_agreement` <= '$eyear' AND (`bri05bridge_complete` >= '$syear' AND `bri05bridge_complete` <= '$eyear'))) AND bri03work_category != 3 AND bri03construction_type = '$x'";
		if($selAgency != '') {
			$sql .=" AND bri03supporting_agency = '$selAgency'";
		}
        if(trim($selProvince) != '') {
            $sql .=" AND dist01state = '$selProvince'";
        }
        
		$sql .= " ORDER BY bri03work_category DESC";
        //echo $sql;exit;
		$query = $this->db->query($sql);
		return $query->getResult();
	}

    public function getbridges($dataStart, $dateEnd, $dd = '', $ctype = ENUM_NEW_CONSTRUCTION, $resultType = 'array', $municipality = '') {

        $sql = "select * from `view_bridge_major_dist_completed` where `bri05bridge_completion_fiscalyear` >= '$dataStart' AND `bri05bridge_completion_fiscalyear` <= '$dateEnd' AND `bri05bridge_complete_check` = 1 AND `bri05bridge_completion_fiscalyear_check` = 1 AND `bri03construction_type` = '$ctype'";

        if($dd != '') {
            if(is_array($dd)) {
                $dd = implode(',',$dd);
                $sql .=" AND `dist01id` IN ($dd)";
            } else {
                $sql .=" AND `dist01id` = '$dd'";
            }
        }
        if($municipality != '') {
            $sql .=" AND `left_muni01id` = '$municipality'";   
        }
        //restrict users 
        $userModel = new UserModel();
        $arrPermittedDistList = $userModel->getArrPermitedDistList();
        $intUserType = (session()->get('type')) ? session()->get('type') : ENUM_GUEST;
        if ($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR) {
          //comma seperated value
          if (count($arrPermittedDistList) > 0) {
            $arrPermittedDistList = implode(',', $arrPermittedDistList);
            $sql .=" AND `dist01id` IN ($arrPermittedDistList)";
          }
        }
        
        //echo $sql;exit;
        // echo $sql;
        // echo "<br>";
        $query = $this->db->query($sql);
        if($resultType == "array") {
            return $query->getResultArray();
        } else {
            return $query->getResult();
        }
    }

    public function getbridgesbydate($dataStart, $dateEnd, $dd = '', $ctype = ENUM_NEW_CONSTRUCTION, $resultType = 'array', $selAgency= '') {
        // /die($resultType);
        $sql = "select * from `view_bridge_major_dist_completed` where `bri05bridge_complete` >= '$dataStart' AND `bri05bridge_complete` <= '$dateEnd' AND `bri05bridge_complete_check` = 1 AND `bri05bridge_completion_fiscalyear_check` = 1 AND `bri03construction_type` = '$ctype'";
        if($dd != '') {
            if(is_array($dd)) {
                $dd = implode(',',$dd);
                $sql .=" AND `dist01id` IN ($dd)";
            } else {
                $sql .=" AND `dist01id` = '$dd'";
            }
        }

        //restrict users 
        $userModel = new UserModel();
        $arrPermittedDistList = $userModel->getArrPermitedDistList();
        $intUserType = (session()->get('type')) ? session()->get('type') : ENUM_GUEST;
        if ($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR) {
          //comma seperated value
          if (count($arrPermittedDistList) > 0) {
            $arrPermittedDistList = implode(',', $arrPermittedDistList);
            $sql .=" AND `dist01id` IN ($arrPermittedDistList)";
          }
        }
        
        $sql .=" ORDER BY `dist01state` ASC";
        //echo $sql;exit;
        $query = $this->db->query($sql);
        if($resultType == "array") {
            return $query->getResultArray();
        } else {
            return $query->getResult();
        }
    }

    public function getbridgesbysup($dataStart, $dateEnd, $dd = '', $ctype = ENUM_NEW_CONSTRUCTION, $resultType = 'array', $selAgency = '') {
        $sql = "select * from `view_bridge_major_dist_sup` where `bri05bridge_completion_fiscalyear` >= '$dataStart' AND `bri05bridge_completion_fiscalyear` <= '$dateEnd' AND `bri05bridge_complete_check` = 1 AND `bri05bridge_completion_fiscalyear_check` = 1 AND `bri03construction_type` = '$ctype'";
        if($dd != '') {
            if(is_array($dd)) {
                $dd = implode(',',$dd);
                $sql .=" AND `dist01id` IN ($dd)";
            } else {
                $sql .=" AND `dist01id` = '$dd'";
            }
        }
        if($selAgency != '') {
            $sql .=" AND `bri03supporting_agency` = '$selAgency'";   
        }
        //echo $sql;exit;
        $query = $this->db->query($sql);
        //echo $resultType;exit;
        if($resultType == "array") {
            return $query->getResultArray();
        } else {
            return $query->getResult();
        }
    }

    public function getbridgesbysupdate($dataStart, $dateEnd, $dd = '', $ctype = ENUM_NEW_CONSTRUCTION, $resultType = 'array', $selAgency= '') {
        // /die($resultType);
        $sql = "select * from `view_bridge_major_dist_sup` where `bri05bridge_complete` >= '$dataStart' AND `bri05bridge_complete` <= '$dateEnd' AND `bri05bridge_complete_check` = 1 AND `bri05bridge_completion_fiscalyear_check` = 1 AND `bri03construction_type` = '$ctype'";
        if($dd != '') {
            if(is_array($dd)) {
                $dd = implode(',',$dd);
                $sql .=" AND `dist01id` IN ($dd)";
            } else {
                $sql .=" AND `dist01id` = '$dd'";
            }
        }
        if($selAgency != '') {
            $sql .=" AND `bri03supporting_agency` IN ('$selAgency')";
        }
        $sql .=" ORDER BY `dist01state` ASC";
        //echo $sql;exit;
        $query = $this->db->query($sql);
        if($resultType == "array") {
            return $query->getResultArray();
        } else {
            return $query->getResult();
        }
    }

    public function getbridgesMunc($dataStart, $dateEnd, $dd = '', $ctype = ENUM_NEW_CONSTRUCTION, $resultType = 'array', $municipality = '') {
        $sql = "select * from `view_bridge_major_dist_munc_completed` where `bri05bridge_completion_fiscalyear` >= '$dataStart' AND `bri05bridge_completion_fiscalyear` <= '$dateEnd' AND `bri05bridge_complete_check` = 1 AND `bri05bridge_completion_fiscalyear_check` = 1 AND `bri03construction_type` = '$ctype'";
        if($dd != '') {
            if(is_array($dd)) {
                $dd = implode(',',$dd);
                $sql .=" AND `dist01id` IN ($dd)";
            } else {
                $sql .=" AND `dist01id` = '$dd'";
            }
        }
        if($municipality != '') {
            $sql .=" AND `left_muni01id` = '$municipality'";   
        }
        //echo $sql;exit;
        $query = $this->db->query($sql);
        //echo $resultType;exit;
        if($resultType == "array") {
            return $query->getResultArray();
        } else {
            return $query->getResult();
        }
    }

    public function getbridgesMuncbydate($dataStart, $dateEnd, $dd = '', $ctype = ENUM_NEW_CONSTRUCTION, $resultType = 'array', $municipality = '') {
        $sql = "select * from `view_bridge_major_dist_munc_completed` where `bri05bridge_complete` >= '$dataStart' AND `bri05bridge_complete` <= '$dateEnd' AND `bri05bridge_complete_check` = 1 AND `bri05bridge_completion_fiscalyear_check` = 1 AND `bri03construction_type` = '$ctype'";
        if($dd != '') {
            if(is_array($dd)) {
                $dd = implode(',',$dd);
                $sql .=" AND `dist01id` IN ($dd)";
            } else {
                $sql .=" AND `dist01id` = '$dd'";
            }
        }
        if($municipality != '') {
            $sql .=" AND `left_muni01id` = '$municipality'";   
        }
        $sql .=" ORDER BY `dist01state` ASC";
        //echo $sql;exit;
        $query = $this->db->query($sql);
        if($resultType == "array") {
            return $query->getResultArray();
        } else {
            return $query->getResult();
        }
    }
}
