<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class personnel_information_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bri06personnel_information';
    protected $primaryKey       = 'bri06id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "bri06bridge_no",
        "bri06site_surveyor",
        "bri06design_approved_by",
        "bri06uc_members",
        "bri06ngo_consultants_trained",
        "bri06bridge_designer",
        "bri06site_supervision",
        "bri06bridge_craftpersons_trained",
        "bri06bmc_chairperson",
        "bri06uc_chairperson",
        "bri06ddc_technician_trained",
        "bri06bmc_members",
        "bri06uc_contractor",
        "bri06deleted",
        "bri06status"
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
