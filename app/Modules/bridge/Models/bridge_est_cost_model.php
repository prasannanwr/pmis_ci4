<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class bridge_est_cost_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bri07estimated_cost';
    protected $primaryKey       = 'bri07id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "bri07cmp01id",
        "bri07sup01id",
        "bri07amount",
        "bri07deleted",
        "bri07status",
        "bri07bridge_no"
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

    public function getBridgeEstCosts($bridge_no) {

        $result = $this->db->query("select `bri07id`,`bri07cmp01id`,`bri07sup01id`,`bri07amount` from `{$this->table}` WHERE `bri07bridge_no` = '{$bridge_no}' AND `bri07amount` != 0")->getResultArray();
        return $result;

    }

}