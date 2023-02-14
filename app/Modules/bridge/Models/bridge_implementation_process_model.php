<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_implementation_process_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bri05bridge_implementation_processtable';
    protected $primaryKey       = 'bri05id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "bri05site_assessment",
        "bri05bridge_design_estimate",
        "bri05material_supply_target",
        "bri05first_phase_constrution",
        "bri05anchorage_concreting",
        "bri05bridge_complete",
        "bri05bmc_formation",
        "bri05sos_orentation",
        "bri05design_approval",
        "bri05bridge_completion_target",
        "bri05material_supply_uc",
        "bri05cable_pulling",
        "bri05final_inspection",
        "bri05bridge_completion_fiscalyear",
        "bri05bridge_no",
        "bri05community_agreement",
        "bri05dmbt",
        "bri05second_phase_construction",
        "bri05third_phase_construction",
        "bri05work_completion_certificate",
        "bri05site_assessment_check",
        "bri05bridge_design_estimate_check",
        "bri05material_supply_target_check",
        "bri05first_phase_constrution_check",
        "bri05anchorage_concreting_check",
        "bri05bridge_complete_check",
        "bri05bmc_formation_check",
        "bri05sos_orentation_check",
        "bri05design_approval_check",
        "bri05bridge_completion_target_check",
        "bri05material_supply_uc_check",
        "bri05cable_pulling_check",
        "bri05final_inspection_check",
        "bri05bridge_completion_fiscalyear_check",
        "bri05community_agreement_check",
        "bri05dmbt_check",
        "bri05second_phase_construction_check",
        "bri05third_phase_construction_check",
        "bri05work_completion_certificate_check",
        "bri05bridge_fabrication_contract_check",
        "bri05bridge_fabrication_contract"
    ];

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
}
