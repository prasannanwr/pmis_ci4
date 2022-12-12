<?php

namespace App\Modules\bridge\Models;

use CodeIgniter\Model;

class contribution_agencies_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bri08contribution_agencies';
    protected $primaryKey       = 'bri08id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      "bri08cmp01id",
      "bri08sup01id",
      "bri08amount",
      "bri08status",
      "bri08deleted",
      "bri08bridge_no"
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

    public function getSum($bnum) {
		$builder = $this->db->table($this->table);
		$query = $builder->select("SUM(bri08amount) AS totalAmt")
			                  ->where('bri08bridge_no', $bnum)
			                  ->limit(1)
			                  ->get();
		$result = $query->getResult();
		return $result;
	}

    public function getBridgeContribution($bridge_no) {
        $result = $this->db->query("select `bri08id`,`bri08cmp01id`,`bri08sup01id`,`bri08amount` from `{$this->table}` WHERE `bri08bridge_no` = '{$bridge_no}' AND `bri08amount` != 0")->getResultArray();
        return $result;
    }
}