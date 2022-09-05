<?php

namespace App\Modules\view\Models;

use CodeIgniter\Model;

class view_all_views_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'view_vdc';
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

	public function view_bridge_cost_component_amt(){
        $this->table = __FUNCTION__;
        return $this->findAll();
    }
    public function view_zone(){
        $this->table = __FUNCTION__;
        return $this->findAll();
    }
    
    public function view_bridge_supporting_cost(){
    $this->table = __FUNCTION__;
    return $this->findAll();
    }
     
    public function view_sup01_muni01_wkc01_count_bri03_dist(){
    $this->table = __FUNCTION__;
    return $this->findAll();
    }
   

    public function view_sup03_dist01_bri05_count_community_agreement_dist(){
    $this->table = __FUNCTION__;
    return $this->findAll();
    }
    public function view_sup03_dist01_bri05_count_community_agreement(){
    $this->table = __FUNCTION__;
    return $this->findAll();
    }
    public function view_sup03_dist01_bri05_count_design_approval(){
    $this->table = __FUNCTION__;
    return $this->findAll();
    }
    public function view_sup03_dist01_bri05_count_site_assessment(){
    $this->table = __FUNCTION__;
    return $this->findAll();
    }

    public function view_sup03_dist01_bri05_count_design_approval_dist(){
    $this->table = __FUNCTION__;
    return $this->findAll();
    }

    public function view_sup03_dist01_bri05_count_first_constraction_dist(){
    $this->table = __FUNCTION__;
    return $this->findAll();
    }
   
    public function view_sup03_dist01_bri05_count_site_assessment_dist(){
        $this->table = __FUNCTION__;
        return $this->findAll();
    }
    public function view_sup03_dist01_bri05_count_material_handover(){
        $this->table = __FUNCTION__;
        return $this->findAll();
    }
    public function view_sup03_dist01_bri05_count_material_handover_dist(){
        $this->table = __FUNCTION__;
        return $this->findAll();
         
    } 
   
     public function view_sup03_dist01_bri05_count_underconst_bridges(){
        $this->table = __FUNCTION__;
        return $this->findAll();
       
    }
     public function view_sup03_dist01_bri05_count_community_agreement_model(){
        $this->table = __FUNCTION__;
        return $this->findAll();
       
    } 
    public function view_sup03_dist01_bri05_count_third_phase_construction(){
        $this->table = __FUNCTION__;
        return $this->findAll();
       
    } 
   public function view_dist01_bri05_count_bridge_completion_fiscalyear(){
        $this->table = __FUNCTION__;
        return $this->findAll();
       
    } 
//   public function view_dist01_bri05_count_first_constraction_fiscalyear(){
//         $this->table = __FUNCTION__;
//         return $this->findAll();
       
//     }
  public function view_dist01_bri05_count_material_handover_fiscalyear(){
        $this->table = __FUNCTION__;
        return $this->findAll();
       
    } 
  public function view_sup03_dist01_bri05_count_design_estimate_bridges(){
    $this->table = __FUNCTION__;
    return $this->findAll();
       
    }
//    public function view_sup03_dist01_bri05_count_carry_previous(){
//     $this->table = __FUNCTION__;
//     return $this->findAll();
       
//     } 
   public function view_vdc_bridge_count_new(){
    $this->table = __FUNCTION__;
    return $this->findAll();
       
    } 
    // public function view_count_material_handover_fiscalyear(){
    //     $this->table = __FUNCTION__;
    //     return $this->findAll();
       
    // } 
    public function view_sup03_dist01_bri05_count_site_assessment_dist_new(){
        $this->table = __FUNCTION__;
		//echo $this->db->last_query();exit;
        return $this->findAll();
    }
    
    public function view_sup03_dist01_bri05_count_design_estimate_bridges_new(){
        $this->table = __FUNCTION__;
        return $this->findAll();
    }

    public function view_sup03_dist01_bri05_count_community_agreement_dist_new(){
        $this->table = __FUNCTION__;
        return $this->findAll();
    }

    public function view_dist01_bri05_count_bridge_completion_fiscalyear_new(){
        $this->table = __FUNCTION__;
        return $this->findAll();
    }
    // public function view_count_steel_parts_fiscalyear(){
    //     $this->table = __FUNCTION__;
    //     return $this->findAll();
       
    // }
    // public function view_count_cable_pulling_fiscalyear(){
    //     $this->table = __FUNCTION__;
    //     return $this->findAll();
    // }
	
	public function view_dist01_bri05_count_bridge_completion_fiscalyear1($ctype,$syear,$eyear,$wcat,$fstartfy,$fendfy){
       // $this->table = __FUNCTION__;
       // return $this->findAll();
//        echo $community_date = $eyear."-07-15";
//        $prev_year = $eyear -1;
//        echo $prev_community_date = $prev_year."-07-15";
//        exit;
		if($wcat == 2) {
            $sql = "select `b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03work_category` AS `bri03work_category`,`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`a`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`,`a`.`bri05work_completion_certificate_check` AS `bri05work_completion_certificate_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`,`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,count(`b`.`bri03id`) AS `bri05total_completion_bridge_count` from ((`bri05bridge_implementation_processtable` `a` left join `view_bri03_major_completion` `b` on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`))) 
		WHERE `bri03construction_type` = ".$ctype." AND `bri05bridge_completion_fiscalyear` >= '".$syear."' AND `bri05bridge_completion_fiscalyear` <= '".$eyear."' AND `bri05bridge_complete_check` = '1' AND (`bri05community_agreement` != '0000-00-00' && `bri05community_agreement` <= '$fendfy')
		group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05bridge_completion_fiscalyear`";
        } else {
//            $sql = "select `b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03work_category` AS `bri03work_category`,`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`a`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`,`a`.`bri05work_completion_certificate_check` AS `bri05work_completion_certificate_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`,`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,count(`b`.`bri03id`) AS `bri05total_completion_bridge_count` from ((`bri05bridge_implementation_processtable` `a` left join `view_bri03_major_completion` `b` on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`)))
//		WHERE `bri03construction_type` = ".$ctype." AND `bri05bridge_completion_fiscalyear` >= '".$syear."' AND `bri05bridge_completion_fiscalyear` <= '".$eyear."' AND `bri05bridge_complete_check` = '1' AND `bri03work_category` = ".$wcat."
//		group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05bridge_completion_fiscalyear`";
            $sql = "select `b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03work_category` AS `bri03work_category`,`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`a`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`,`a`.`bri05work_completion_certificate_check` AS `bri05work_completion_certificate_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`,`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,count(`b`.`bri03id`) AS `bri05total_completion_bridge_count` from ((`bri05bridge_implementation_processtable` `a` left join `view_bri03_major_completion` `b` on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`))) 
		WHERE `bri03construction_type` = ".$ctype." AND `bri05bridge_completion_fiscalyear` >= '".$syear."' AND `bri05bridge_completion_fiscalyear` <= '".$eyear."' AND `bri05bridge_complete_check` = '1' AND `bri05community_agreement` >= '$fstartfy' AND `bri05community_agreement` < '$fendfy'
		group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05bridge_completion_fiscalyear`";
        }

		$query = $this->db->query($sql);
		return $query->getResult();

    }

	public function view_sup03_dist01_bri05_count_site_assessment_dist_final($ctype, $syear = '',$eyear = '', $fy = '') {
				
		if($syear != '' && $eyear != '') {
			$sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03work_category` AS `bri03work_category`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,
`b`.`bri03construction_type` AS `bri03construction_type`,`a`.`bri05site_assessment_check` AS `bri05site_assessment_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`,
`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,
`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,`c`.`dist01zon01id` AS `dist01zon01id`,`c`.`dist01remark` AS `dist01remark`,`c`.`dist01code` AS `dist01code`,
`c`.`dist01tbis01id` AS `dist01tbis01id`,`c`.`zon01id` AS `zon01id`,`c`.`zon01name` AS `zon01name`,`c`.`zon01dev01id` AS `zon01dev01id`,`c`.`zon01remark` AS `zon01remark`,
`c`.`zon01code` AS `zon01code`,`c`.`dev01id` AS `dev01id`,`c`.`dev01name` AS `dev01name`,`c`.`dev01remark` AS `dev01remark`,`c`.`dev01code` AS `dev01code`, 
count(`b`.`bri03id`) AS `bri05total_dist_site_assessment` 
from `bri05bridge_implementation_processtable` `a` 
left join `view_bri03_major_new` `b` 
on(`a`.`bri05bridge_no` = `b`.`bri03bridge_no`)
left join `view_district` `c` 
on(`b`.`bri03major_dist_id` = `c`.`dist01id`)
WHERE `bri03construction_type` = ".$ctype." AND `bri03project_fiscal_year` >= '".$syear."' AND `bri03project_fiscal_year` <= '".$eyear."' AND `bri05site_assessment_check` = '1' group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05site_assessment_check`,`b`.`bri03construction_type`";
			
		} else {
			 $fyear = substr(trim($fy),0,4);		 
			$fulldate = $fyear."-07-15";
			/*$sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03work_category` AS `bri03work_category`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,
`b`.`bri03construction_type` AS `bri03construction_type`,`a`.`bri05site_assessment_check` AS `bri05site_assessment_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`,
`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,
`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,`c`.`dist01zon01id` AS `dist01zon01id`,`c`.`dist01remark` AS `dist01remark`,`c`.`dist01code` AS `dist01code`,
`c`.`dist01tbis01id` AS `dist01tbis01id`,`c`.`zon01id` AS `zon01id`,`c`.`zon01name` AS `zon01name`,`c`.`zon01dev01id` AS `zon01dev01id`,`c`.`zon01remark` AS `zon01remark`,
`c`.`zon01code` AS `zon01code`,`c`.`dev01id` AS `dev01id`,`c`.`dev01name` AS `dev01name`,`c`.`dev01remark` AS `dev01remark`,`c`.`dev01code` AS `dev01code`, 
count(`b`.`bri03id`) AS `bri05total_dist_site_assessment`, 
count(`b`.`bri03id`) AS `bri05total_dist_site_assessment` 
from `bri05bridge_implementation_processtable` `a` 
left join `view_bri03_major_all_` `b` 
on(`a`.`bri05bridge_no` = `b`.`bri03bridge_no`)
left join `view_district` `c` 
on(`b`.`bri03major_dist_id` = `c`.`dist01id`)
WHERE `bri03construction_type` = ".$ctype." AND `bri05site_assessment_check` = '1' AND `bri05site_assessment` != '0000-00-00' AND `bri05bridge_complete_check` != '1'  AND (`bri05community_agreement_check` != '1' OR (`bri05community_agreement_check` = '1' AND `bri05community_agreement` >= '$fulldate')) group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05site_assessment_check`,`b`.`bri03construction_type`";*/

			$sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03work_category` AS `bri03work_category`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`, `b`.`bri03construction_type` AS `bri03construction_type`,`a`.`bri05site_assessment_check` AS `bri05site_assessment_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`, `a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`, `c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,`c`.`dist01zon01id` AS `dist01zon01id`,`c`.`dist01remark` AS `dist01remark`,`c`.`dist01code` AS `dist01code`, `c`.`dist01tbis01id` AS `dist01tbis01id`,`c`.`zon01id` AS `zon01id`,`c`.`zon01name` AS `zon01name`,`c`.`zon01dev01id` AS `zon01dev01id`,`c`.`zon01remark` AS `zon01remark`, `c`.`zon01code` AS `zon01code`,`c`.`dev01id` AS `dev01id`,`c`.`dev01name` AS `dev01name`,`c`.`dev01remark` AS `dev01remark`,`c`.`dev01code` AS `dev01code`, count(`b`.`bri03id`) AS `bri05total_dist_site_assessment`, count(`b`.`bri03id`) AS `bri05total_dist_site_assessment` from `bri05bridge_implementation_processtable` `a` left join `view_bri03_major_all_` `b` on(`a`.`bri05bridge_no` = `b`.`bri03bridge_no`) left join `view_district` `c` on(`b`.`bri03major_dist_id` = `c`.`dist01id`) WHERE `bri03construction_type` = ".$ctype." AND `bri05site_assessment_check` = '1' AND `bri05site_assessment` != '0000-00-00' AND (`bri05bridge_complete_check` != '1' AND (`bri05community_agreement_check` != '1' OR (`bri05community_agreement_check` = '1' AND `bri05community_agreement` >= '$fulldate')) OR (`bri05community_agreement` >= '$fulldate' AND `bri05bridge_complete_check` = '1')) group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05site_assessment_check`,`b`.`bri03construction_type`";

		}		

		$query = $this->db->query($sql);
		return $query->getResult();

	}
	
	public function view_sup03_dist01_bri05_count_design_estimate_bridges_final($ctype, $syear = '',$eyear = '',$fy = '') {
		
		if($syear != '' && $eyear != '') {
			$sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03work_category` AS `bri03work_category`,`b`.`bri03construction_type` AS `bri03construction_type`,
	`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`c`.`dist01name` AS `dist01name`,`c`.`dist01id` AS `dist01id`,`a`.`bri05bridge_design_estimate_check` AS `bri05bridge_design_estimate_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`,
	`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,count(`b`.`bri03id`) AS `bri05total_design_estimate` 
	from ((`bri05bridge_implementation_processtable` `a` 
	left join `view_bri03_major_new` `b` 
	on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`))) 
	WHERE `bri03construction_type` = ".$ctype." AND `bri03project_fiscal_year` >= '".$syear."' AND `bri03project_fiscal_year` <= '".$eyear."' AND `bri05bridge_design_estimate_check` = '1'
	group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05bridge_design_estimate_check`";
		} else {
			$fyear = substr(trim($fy),0,4);		 
		    $fulldate = $fyear."-07-15";
			 /*$sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03work_category` AS `bri03work_category`,`b`.`bri03construction_type` AS `bri03construction_type`,
	`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`c`.`dist01name` AS `dist01name`,`c`.`dist01id` AS `dist01id`,`a`.`bri05bridge_design_estimate_check` AS `bri05bridge_design_estimate_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`,
	`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,count(`b`.`bri03id`) AS `bri05total_design_estimate` 
	from ((`bri05bridge_implementation_processtable` `a` 
	left join `view_bri03_major_all_` `b` 
	on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`))) 
	WHERE `bri03construction_type` = ".$ctype." AND `bri05bridge_design_estimate_check` = '1' AND `bri05bridge_design_estimate` != '0000-00-00' AND `bri05bridge_complete_check` != '1' AND (`bri05community_agreement_check` != '1' OR (`bri05community_agreement_check` = '1' AND `bri05community_agreement` >= '$fulldate')) 
	group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05bridge_design_estimate_check`";*/
		$sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03work_category` AS `bri03work_category`,`b`.`bri03construction_type` AS `bri03construction_type`,
	`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`c`.`dist01name` AS `dist01name`,`c`.`dist01id` AS `dist01id`,`a`.`bri05bridge_design_estimate_check` AS `bri05bridge_design_estimate_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`,
	`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,count(`b`.`bri03id`) AS `bri05total_design_estimate` 
	from ((`bri05bridge_implementation_processtable` `a` 
	left join `view_bri03_major_all_` `b` 
	on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`))) 
	WHERE `bri03construction_type` = ".$ctype." AND `bri05bridge_design_estimate_check` = '1' AND `bri05bridge_design_estimate` != '0000-00-00' AND (`bri05bridge_complete_check` != '1' AND (`bri05community_agreement_check` != '1' OR (`bri05community_agreement_check` = '1' AND `bri05community_agreement` >= '$fulldate')) OR (`bri05community_agreement` >= '$fulldate' AND `bri05bridge_complete_check` = '1')) 
	group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05bridge_design_estimate_check`";
		}
	$query = $this->db->query($sql);
			return $query->getResult();

}

	public function view_sup03_dist01_bri05_count_community_agreement_dist_final($ctype, $syear = '',$eyear = '', $fy = '') {
		if($syear != '' && $eyear != '') {
			$sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03work_category` AS `bri03work_category`,
`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`a`.`bri05community_agreement_check` AS `bri05community_agreement_check`,count(`b`.`bri03id`) AS `bri05total_community_agreement`,
`a`.`bri05bridge_complete` AS `bri05bridge_complete`,`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,
`c`.`dist01zon01id` AS `dist01zon01id`,`c`.`dist01remark` AS `dist01remark`,`c`.`dist01code` AS `dist01code`,`c`.`dist01tbis01id` AS `dist01tbis01id`,`c`.`zon01id` AS `zon01id`,`c`.`zon01name` AS `zon01name`,
`c`.`zon01dev01id` AS `zon01dev01id`,`c`.`zon01remark` AS `zon01remark`,`c`.`zon01code` AS `zon01code`,`c`.`dev01id` AS `dev01id`,`c`.`dev01name` AS `dev01name`,`c`.`dev01remark` AS `dev01remark`,
`c`.`dev01code` AS `dev01code` 
from `bri05bridge_implementation_processtable` `a` left join `view_bri03_major_new` `b` on (`a`.`bri05bridge_no` = `b`.`bri03bridge_no`)
left join `view_district` `c` on (`c`.`dist01id` = `b`.`bri03major_dist_id`)
WHERE `bri03construction_type` = ".$ctype." AND `bri03project_fiscal_year` >= '".$syear."' AND `bri03project_fiscal_year` <= '".$eyear."' AND `bri05community_agreement_check` = '1'
group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05community_agreement_check`";
		} else {
			$fyear = substr(trim($fy),0,4);
			$fulldate = $fyear."-07-16";
			
			/*
  $sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03work_category` AS `bri03work_category`,`b`.`bri03construction_type` AS `bri03construction_type`,
	`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`c`.`dist01name` AS `dist01name`,`c`.`dist01id` AS `dist01id`,`a`.`bri05community_agreement_check` AS `bri05community_agreement_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`,
	`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,count(`b`.`bri03id`) AS `bri05total_community_agreement` 
	from ((`bri05bridge_implementation_processtable` `a` 
	left join `view_bri03_major_all_` `b` 
	on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`))) 
	WHERE `bri03construction_type` = ".$ctype." AND `bri05community_agreement_check` = '1' AND `bri05bridge_complete_check` != '1' AND `bri05community_agreement` >= '".$fulldate."'
	group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05community_agreement_check`";
	*/
	$sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03work_category` AS `bri03work_category`,`b`.`bri03construction_type` AS `bri03construction_type`,
	`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`c`.`dist01name` AS `dist01name`,`c`.`dist01id` AS `dist01id`,`a`.`bri05community_agreement_check` AS `bri05community_agreement_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`,
	`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,count(`b`.`bri03id`) AS `bri05total_community_agreement` 
	from ((`bri05bridge_implementation_processtable` `a` 
	left join `view_bri03_major_all_` `b` 
	on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`))) 
	WHERE `bri03construction_type` = ".$ctype." AND `bri05community_agreement_check` = '1' AND ((`bri05bridge_complete_check` != '1' AND `bri05community_agreement` >= '".$fulldate."')  OR (`bri05community_agreement` >= '$fulldate' AND `bri05bridge_complete_check` = '1'))
	group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05community_agreement_check`";
	
		}
		

$query = $this->db->query($sql);
			return $query->getResult();

	}
	
	public function view_dist01_bri05_count_first_constraction_fiscalyear_($ctype, $cat, $fy) {
		
		/*	$sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03work_category` AS `bri03work_category`,
`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`a`.`bri05first_phase_constrution_check` AS `bri05first_phase_constrution_check`,count(`b`.`bri03id`) AS `bri05total_community_agreement`,
`a`.`bri05bridge_complete` AS `bri05bridge_complete`,`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,
`c`.`dist01zon01id` AS `dist01zon01id`,`c`.`dist01remark` AS `dist01remark`,`c`.`dist01code` AS `dist01code`,`c`.`dist01tbis01id` AS `dist01tbis01id`,`c`.`zon01id` AS `zon01id`,`c`.`zon01name` AS `zon01name`,
`c`.`zon01dev01id` AS `zon01dev01id`,`c`.`zon01remark` AS `zon01remark`,`c`.`zon01code` AS `zon01code`,`c`.`dev01id` AS `dev01id`,`c`.`dev01name` AS `dev01name`,`c`.`dev01remark` AS `dev01remark`,
`c`.`dev01code` AS `dev01code` 
from `bri05bridge_implementation_processtable` `a` left join `view_bri03_major_new` `b` on (`a`.`bri05bridge_no` = `b`.`bri03bridge_no`)
left join `view_district` `c` on (`c`.`dist01id` = `b`.`bri03major_dist_id`)
WHERE `bri03construction_type` = ".$ctype." AND `bri05first_phase_constrution_check` = '1' AND `bri03construction_type` = ".$cat." AND `bri05bridge_complete_check` != '1'
group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05first_phase_constrution_check`";		*/		
			
			if($cat == 1) { // new
				$sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03work_category` AS `bri03work_category`,
			`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`a`.`bri05first_phase_constrution_check` AS `bri05first_phase_constrution_check`, count(`b`.`bri03id`) AS `bri05total_first_phase_count`,
			`a`.`bri05bridge_complete` AS `bri05bridge_complete`,`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,
			`c`.`dist01zon01id` AS `dist01zon01id`,`c`.`dist01remark` AS `dist01remark`,`c`.`dist01code` AS `dist01code`,`c`.`dist01tbis01id` AS `dist01tbis01id`,`c`.`zon01id` AS `zon01id`,`c`.`zon01name` AS `zon01name`,
			`c`.`zon01dev01id` AS `zon01dev01id`,`c`.`zon01remark` AS `zon01remark`,`c`.`zon01code` AS `zon01code`,`c`.`dev01id` AS `dev01id`,`c`.`dev01name` AS `dev01name`,`c`.`dev01remark` AS `dev01remark`,
			`c`.`dev01code` AS `dev01code` 
			from `bri05bridge_implementation_processtable` `a` left join `view_bri03_major_all_` `b` on (`a`.`bri05bridge_no` = `b`.`bri03bridge_no`) left join `view_district` `c` on (`c`.`dist01id` = `b`.`bri03major_dist_id`) 
			WHERE `bri03construction_type` = ".$ctype." AND `bri05first_phase_constrution_check` = '1' AND `b`.`bri03project_fiscal_year` = ".$fy." AND `bri05bridge_complete_check` != '1' 
			group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05first_phase_constrution_check`";
			} else {
				$sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03work_category` AS `bri03work_category`,
			`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`a`.`bri05first_phase_constrution_check` AS `bri05first_phase_constrution_check`, count(`b`.`bri03id`) AS `bri05total_first_phase_count`,
			`a`.`bri05bridge_complete` AS `bri05bridge_complete`,`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,
			`c`.`dist01zon01id` AS `dist01zon01id`,`c`.`dist01remark` AS `dist01remark`,`c`.`dist01code` AS `dist01code`,`c`.`dist01tbis01id` AS `dist01tbis01id`,`c`.`zon01id` AS `zon01id`,`c`.`zon01name` AS `zon01name`,
			`c`.`zon01dev01id` AS `zon01dev01id`,`c`.`zon01remark` AS `zon01remark`,`c`.`zon01code` AS `zon01code`,`c`.`dev01id` AS `dev01id`,`c`.`dev01name` AS `dev01name`,`c`.`dev01remark` AS `dev01remark`,
			`c`.`dev01code` AS `dev01code` 
			from `bri05bridge_implementation_processtable` `a` left join `view_bri03_major_all_` `b` on (`a`.`bri05bridge_no` = `b`.`bri03bridge_no`) left join `view_district` `c` on (`c`.`dist01id` = `b`.`bri03major_dist_id`) 
			WHERE `bri03construction_type` = ".$ctype." AND `bri05first_phase_constrution_check` = '1' AND `b`.`bri03project_fiscal_year` != ".$fy." AND `bri05bridge_complete_check` != '1' 
			group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05first_phase_constrution_check`";
				
			}
			

$query = $this->db->query($sql);
			return $query->getResult();

	}
	
	public function getTotalUnderConstructionBridges1($syear = '', $eyear = '', $ctype = '') {
			
		$sql = "select count(`a`.`bri03id`) AS `total_underconstruction`,`a`.`bri03bridge_name` AS `bri03bridge_name`,`a`.`bri03construction_type` AS `bri03construction_type`,
		`a`.`bri03bridge_no` AS `bri03bridge_no`,`a`.`bri03district_name_lb` AS `bri03district_name_lb`,`a`.`bri03district_name_rb` AS `bri03district_name_rb`,
		`a`.`bri03river_name` AS `bri03river_name`,`a`.`bri03municipality_lb` AS `bri03municipality_lb`,
		`a`.`bri03municipality_rb` AS `bri03municipality_rb`,`a`.`bri03major_vdc` AS `bri03major_vdc`,
		`a`.`bri03bridge_series` AS `bri03bridge_series`,`a`.`bri03ward_lb` AS `bri03ward_lb`,
		`a`.`bri03ward_rb` AS `bri03ward_rb`,`a`.`bri03road_head` AS `bri03road_head`,
		`a`.`bri03portering_distance` AS `bri03portering_distance`,`a`.`bri03bridge_type` AS `bri03bridge_type`,`a`.`bri03design` AS `bri03design`,
		`a`.`bri03ww_width` AS `bri03ww_width`,`a`.`bri03ww_deck_type` AS `bri03ww_deck_type`,`a`.`bri03development_region` AS `bri03development_region`,
		`a`.`bri03tbsu_regional_office` AS `bri03tbsu_regional_office`,`a`.`bri03supporting_agency` AS `bri03supporting_agency`,`a`.`bri03work_category` AS `bri03work_category`,
		`a`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`a`.`bri03topo_map_no` AS `bri03topo_map_no`,`a`.`bri03coordinate_north` AS `bri03coordinate_north`,
		`a`.`bri03coordinate_east` AS `bri03coordinate_east`,`a`.`bri03e_span` AS `bri03e_span`,`a`.`bri03is_new` AS `bri03is_new`,
		`a`.`bri03ci_nol` AS `bri03ci_nol`,`a`.`bri03ci_nor` AS `bri03ci_nor`,`a`.`bri03ci_nomain` AS `bri03ci_nomain`,
		`a`.`bri03deleted` AS `bri03deleted`,`a`.`bri03status` AS `bri03status`,`a`.`dist_code` AS `dist_code`,
		`a`.`bri03work_category` AS `briworkcat`,`a`.`bri03project_fiscal_year` AS `brifiscalyear`,
		(case `a`.`bri03major_vdc` when 0 then `a`.`bri03district_name_lb` else `a`.`bri03district_name_rb` end) AS `bri03major_dist_id`,
`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,
`c`.`dist01zon01id` AS `dist01zon01id`,`c`.`dist01remark` AS `dist01remark`,`c`.`dist01code` AS `dist01code`,`c`.`dist01tbis01id` AS `dist01tbis01id`,`c`.`zon01id` AS `zon01id`,`c`.`zon01name` AS `zon01name`,
`c`.`zon01dev01id` AS `zon01dev01id`,`c`.`zon01remark` AS `zon01remark`,`c`.`zon01code` AS `zon01code`,`c`.`dev01id` AS `dev01id`,`c`.`dev01name` AS `dev01name`,`c`.`dev01remark` AS `dev01remark`,
`c`.`dev01code` AS `dev01code`		
		from `bri03basic_bridge_datatable` `a`
		left join `view_district` `c` 
		on(`a`.`bri03id` = `c`.`dist01id`) 
		WHERE `a`.`bri03project_fiscal_year` >= '".$syear."' AND `a`.`bri03project_fiscal_year` <= '".$eyear."' AND `a`.`bri03construction_type` = '".$ctype."' AND `a`.`bri03work_category` != '3'
		group by `a`.`bri03supporting_agency`,`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri03construction_type`";
		$query = $this->db->query($sql);
		return $query->getResult();
		
	}
	
	public function getTotalUnderConstructionBridges($syear, $eyear, $ctype) {
		
		/*$sql = "select `b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03work_category` AS `bri03work_category`,
		`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`a`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`,
		count(`b`.`bri03id`) AS `bri05total_completion_bridge_count` 
		from ((`bri05bridge_implementation_processtable` `a` left join `view_bri03_major_all` `b` on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) 
		left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`))) 
		WHERE `b`.`bri03project_fiscal_year` >= '".$syear."' AND `b`.`bri03project_fiscal_year` <= '".$eyear."' AND `b`.`bri03construction_type` = '".$ctype."' AND `b`.`bri03work_category` != '3'
		group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`b`.`bri03project_fiscal_year`";
		
		$query = $this->db->query($sql);
		return $query->getResult();
		*/

		
		if($syear != '' && $eyear != '') {

			$sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03work_category` AS `bri03work_category`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,
`b`.`bri03construction_type` AS `bri03construction_type`,`a`.`bri05site_assessment_check` AS `bri05site_assessment_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`,
`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,
`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,`c`.`dist01zon01id` AS `dist01zon01id`,`c`.`dist01remark` AS `dist01remark`,`c`.`dist01code` AS `dist01code`,
`c`.`dist01tbis01id` AS `dist01tbis01id`,`c`.`zon01id` AS `zon01id`,`c`.`zon01name` AS `zon01name`,`c`.`zon01dev01id` AS `zon01dev01id`,`c`.`zon01remark` AS `zon01remark`,
`c`.`zon01code` AS `zon01code`,`c`.`dev01id` AS `dev01id`,`c`.`dev01name` AS `dev01name`,`c`.`dev01remark` AS `dev01remark`,`c`.`dev01code` AS `dev01code`, 
count(`b`.`bri03id`) AS `bri05total_active_bridge_count`
from `bri05bridge_implementation_processtable` `a` 
left join `view_bri03_major_new` `b` 
on(`a`.`bri05bridge_no` = `b`.`bri03bridge_no`)
left join `view_district` `c` 
on(`b`.`bri03major_dist_id` = `c`.`dist01id`)
WHERE `bri03construction_type` = ".$ctype." AND `bri05community_agreement` <= '".$eyear."' AND `b`.`bri03work_category` != '3' AND `bri05bridge_complete_check` != '1' group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`a`.`bri05site_assessment_check`,`b`.`bri03construction_type`";			
		} else {
			
			$sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03work_category` AS `bri03work_category`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,
			`b`.`bri03construction_type` AS `bri03construction_type`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`, `a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`, `c`.`dist01id` AS `dist01id`,
			`c`.`dist01name` AS `dist01name`,`c`.`dist01zon01id` AS `dist01zon01id`,`c`.`dist01remark` AS `dist01remark`,`c`.`dist01code` AS `dist01code`, `c`.`dist01tbis01id` AS `dist01tbis01id`,`c`.`zon01id` AS `zon01id`,
			`c`.`zon01name` AS `zon01name`,`c`.`zon01dev01id` AS `zon01dev01id`,`c`.`zon01remark` AS `zon01remark`, `c`.`zon01code` AS `zon01code`,`c`.`dev01id` AS `dev01id`,`c`.`dev01name` AS `dev01name`,`c`.`dev01remark` AS `dev01remark`,
			`c`.`dev01code` AS `dev01code`, count(`b`.`bri03id`) AS `bri05total_active_bridge_count` 
			from `bri05bridge_implementation_processtable` `a` left join `view_bri03_major_all_` `b` on(`a`.`bri05bridge_no` = `b`.`bri03bridge_no`) left join `view_district` `c` on(`b`.`bri03major_dist_id` = `c`.`dist01id`) 
			WHERE `b`.`bri03construction_type` = ".$ctype." AND `bri05bridge_complete_check` != '1' group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`b`.`bri03construction_type`";
		}		

		$query = $this->db->query($sql);
		return $query->getResult();				
		
	}
	
	 public function view_sup03_dist01_bri05_count_carry_previous_($ctype, $fy){
		 
		 /*$sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,
		 `c`.`dist01name` AS `dist01name`,`c`.`dist01id` AS `dist01id`,`a`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`, `a`.`bri05bridge_complete` AS `bri05bridge_complete`,
		 `a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,count(`b`.`bri03id`) AS `bri03total_previous_carry_count` 
		 from ((`bri05bridge_implementation_processtable` `a` left join `view_bri03_major` `b` on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`))) 
		 WHERE `b`.`bri03construction_type` = ".$ctype." AND `a`.`bri05bridge_complete_check` != '1' AND `a`.`bri05community_agreement` < '1' AND `b`.`bri03project_fiscal_year` != ".$fy." 
		 group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`b`.`bri03project_fiscal_year`,`a`.`bri05bridge_complete_check`,`b`.`bri03construction_type`";*/
		 
		 $sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,
		 `c`.`dist01name` AS `dist01name`,`c`.`dist01id` AS `dist01id`,`a`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`, `a`.`bri05bridge_complete` AS `bri05bridge_complete`,
		 `a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,count(`b`.`bri03id`) AS `bri03total_previous_carry_count` 
		 from ((`bri05bridge_implementation_processtable` `a` left join `view_bri03_major` `b` on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`))) 
		 WHERE `b`.`bri03construction_type` = ".$ctype." AND ((`a`.`bri05bridge_complete_check` != '1' AND `b`.`bri03project_fiscal_year` != ".$fy.") OR (`a`.`bri05bridge_complete_check` = '1' AND `a`.`bri05bridge_completion_fiscalyear` >= ".$fy." ))
		 group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`b`.`bri03project_fiscal_year`,`a`.`bri05bridge_complete_check`,`b`.`bri03construction_type`";
		 
		//echo $sql;
		$query = $this->db->query($sql);
		return $query->getResult();
       
    } 
	
	public function view_count_material_handover_fiscalyear_($ctype,$cat,$fy) {
		
		if($cat == 1) { // new
		
			$sql = "select `b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03work_category` AS `bri03work_category`,
		`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`a`.`bri05material_supply_uc_check` AS `bri05material_supply_uc_check`,
		`a`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`,`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,
		count(`b`.`bri03id`) AS `bri05total_material_handover_count` 
		from ((`bri05bridge_implementation_processtable` `a` left join `view_bri03_major` `b` on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`))) 
		WHERE `bri05material_supply_uc_check` = '1' AND `b`.`bri03construction_type` = ".$ctype." AND `a`.`bri05bridge_complete_check` != '1' AND `b`.`bri03project_fiscal_year` = ".$fy." 
		group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`b`.`bri03project_fiscal_year`,`a`.`bri05material_supply_uc_check`";
		
		} else {
			$sql = "select `b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03work_category` AS `bri03work_category`,
		`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`a`.`bri05material_supply_uc_check` AS `bri05material_supply_uc_check`,
		`a`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`,`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,
		count(`b`.`bri03id`) AS `bri05total_material_handover_count` 
		from ((`bri05bridge_implementation_processtable` `a` left join `view_bri03_major` `b` on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`))) 
		WHERE `bri05material_supply_uc_check` = '1' AND `b`.`bri03construction_type` = ".$ctype." AND `a`.`bri05bridge_complete_check` != '1' AND `b`.`bri03project_fiscal_year` != ".$fy." 
		group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`b`.`bri03project_fiscal_year`,`a`.`bri05material_supply_uc_check`";
				
		}
			
		
		$query = $this->db->query($sql);
		return $query->getResult();
	}
	
	public function view_count_steel_parts_fiscalyear_($ctype,$cat,$fy) {
		
		if($cat == 1) { // new
			
			$sql = "select `b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03work_category` AS `bri03work_category`,
			`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`a`.`bri05material_supply_target_check` AS `bri05material_supply_target_check`,
			`a`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`,`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,
			count(`b`.`bri03id`) AS `bri05total_steel_parts_count` 
			from ((`bri05bridge_implementation_processtable` `a` left join `view_bri03_major` `b` on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`)))
			WHERE `bri05material_supply_target_check` = '1' AND `b`.`bri03construction_type` = ".$ctype." AND `a`.`bri05bridge_complete_check` != '1' AND `b`.`bri03project_fiscal_year` = ".$fy."
			group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`b`.`bri03project_fiscal_year`,`a`.`bri05material_supply_target_check`";
			
		
		} else {
			$sql = "select `b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03work_category` AS `bri03work_category`,
			`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`a`.`bri05material_supply_target_check` AS `bri05material_supply_target_check`,
			`a`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`,`a`.`bri05bridge_complete` AS `bri05bridge_complete`,`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,
			count(`b`.`bri03id`) AS `bri05total_steel_parts_count` 
			from ((`bri05bridge_implementation_processtable` `a` left join `view_bri03_major` `b` on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`)))
			WHERE `bri05material_supply_target_check` = '1' AND `b`.`bri03construction_type` = ".$ctype." AND `a`.`bri05bridge_complete_check` != '1' AND `b`.`bri03project_fiscal_year` != ".$fy."
			group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`b`.`bri03project_fiscal_year`,`a`.`bri05material_supply_target_check`";
				
		}
			
		
		$query = $this->db->query($sql);
		return $query->getResult();
		
	}
	
	public function view_count_cable_pulling_fiscalyear_($ctype,$cat,$fy) {
		
		if($cat == 1) { // new
			
			$sql = "select `b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03work_category` AS `bri03work_category`,
			`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`a`.`bri05cable_pulling_check` AS `bri05cable_pulling_check`,`a`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`,
			`a`.`bri05bridge_complete` AS `bri05bridge_complete`,`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,count(`b`.`bri03id`) AS `bri05total_cable_pulling_count` 
			from ((`bri05bridge_implementation_processtable` `a` left join `view_bri03_major` `b` on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`)))
			WHERE `bri05cable_pulling_check` = '1' AND `b`.`bri03construction_type` = ".$ctype." AND `a`.`bri05bridge_complete_check` != '1' AND `b`.`bri03project_fiscal_year` = ".$fy."
			group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`b`.`bri03project_fiscal_year`,`a`.`bri05cable_pulling_check`";
			
		
		} else {
			$sql = "select `b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03work_category` AS `bri03work_category`,
			`c`.`dist01id` AS `dist01id`,`c`.`dist01name` AS `dist01name`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,`a`.`bri05cable_pulling_check` AS `bri05cable_pulling_check`,`a`.`bri05bridge_complete_check` AS `bri05bridge_complete_check`,
			`a`.`bri05bridge_complete` AS `bri05bridge_complete`,`a`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`,count(`b`.`bri03id`) AS `bri05total_cable_pulling_count` 
			from ((`bri05bridge_implementation_processtable` `a` left join `view_bri03_major` `b` on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`)))
			WHERE `bri05cable_pulling_check` = '1' AND `b`.`bri03construction_type` = ".$ctype." AND `a`.`bri05bridge_complete_check` != '1' AND `b`.`bri03project_fiscal_year` != ".$fy."
			group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`b`.`bri03project_fiscal_year`,`a`.`bri05cable_pulling_check`";
				
		}
			
		
		$query = $this->db->query($sql);
		return $query->getResult();
		
	}
	
	public function view_sup03_dist01_bri05_count_carry_previous_data($ctype,$fy){
		 
		 $syear = substr(trim($fy),0,4);
		 $fyear = $syear + 1;
		 $fulldate = $fyear."-07-15";
         $sdate = $syear."-07-15";
		 
		 
		/* $sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,
		 `c`.`dist01name` AS `dist01name`,`c`.`dist01id` AS `dist01id`,count(`b`.`bri03id`) AS `bri03total_previous_carry_count` 
		 from ((`bri05bridge_implementation_processtable` `a` left join `view_bri03_major` `b` on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`))) 
		 WHERE `b`.`bri03construction_type` = ".$ctype." AND (`a`.`bri05bridge_complete_check` != '1' OR `a`.`bri05bridge_complete` <= ".$fulldate.") AND `a`.`bri05community_agreement_check` = '1' group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`b`.`bri03project_fiscal_year`,`a`.`bri05bridge_complete_check`,`b`.`bri03construction_type`"; */
		 
         if($ctype == 0) {
            $sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,
         `c`.`dist01name` AS `dist01name`,`c`.`dist01id` AS `dist01id`,count(`b`.`bri03id`) AS `bri03total_previous_carry_count` 
         from ((`bri05bridge_implementation_processtable` `a` left join `view_bri03_major` `b` on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`))) 
         WHERE `a`.`bri05bridge_complete_check` != '1' AND `a`.`bri05community_agreement_check` = '1' AND `a`.`bri05community_agreement` <= '$sdate' group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`b`.`bri03project_fiscal_year`,`a`.`bri05bridge_complete_check`,`b`.`bri03construction_type`";
         } else {
            $sql = "select `b`.`bri03supporting_agency` AS `bri03supporting_agency`,`b`.`bri03major_dist_id` AS `bri03major_dist_id`,`b`.`bri03construction_type` AS `bri03construction_type`,`b`.`bri03project_fiscal_year` AS `bri03project_fiscal_year`,
         `c`.`dist01name` AS `dist01name`,`c`.`dist01id` AS `dist01id`,count(`b`.`bri03id`) AS `bri03total_previous_carry_count` 
         from ((`bri05bridge_implementation_processtable` `a` left join `view_bri03_major` `b` on((`a`.`bri05bridge_no` = `b`.`bri03bridge_no`))) left join `view_district` `c` on((`b`.`bri03major_dist_id` = `c`.`dist01id`))) 
         WHERE `b`.`bri03construction_type` = ".$ctype." AND `a`.`bri05bridge_complete_check` != '1' AND `a`.`bri05community_agreement_check` = '1' AND `a`.`bri05community_agreement` <= '$sdate' group by `b`.`bri03supporting_agency`,`b`.`bri03major_dist_id`,`c`.`dist01name`,`b`.`bri03project_fiscal_year`,`a`.`bri05bridge_complete_check`,`b`.`bri03construction_type`";
         }
		 
		//echo $sql;exit;
		$query = $this->db->query($sql);
		return $query->getResult();
       
    } 
}