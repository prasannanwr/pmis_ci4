<?php

namespace App\Modules\view\Models;

use CodeIgniter\Model;

class view_fiscalyear_data_grouping_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'view_fiscaldata_zone_district_grouping';
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

    public function getfyData($fy,$fc) {
    	$sql = "select `fis02fiscal_data`.`fis02id`,`fis02fiscal_data`.`fis02dist01codeid` AS `fis02dist01codeid`,`fis02fiscal_data`.`fis02sup01id` AS `fis02sup01id`,`fis02fiscal_data`.`fis02year` AS `fis02year`,sum(`fis02fiscal_data`.`fis02name1`) AS `sumdata1`,sum(`fis02fiscal_data`.`fis02name2`) AS `sumdata2`,sum(`fis02fiscal_data`.`fis02name3`) AS `sumdata3`,sum(`fis02fiscal_data`.`fis02name4`) AS `sumdata4`,`fis02fiscal_data`.`fis02constype` AS `fis02constype`, `b`.`dist01id` AS `dist01id`,`b`.`dist01name` AS `dist01name`,`b`.`dist01zon01id` AS `dist01zon01id`,`b`.`dist01remark` AS `dist01remark`,`b`.`dist01code` AS `dist01code`,`b`.`dist01tbis01id` AS `dist01tbis01id`,`b`.`zon01id` AS `zon01id`,`b`.`zon01name` AS `zon01name`,`b`.`zon01dev01id` AS `zon01dev01id`,`b`.`zon01remark` AS `zon01remark`,`b`.`zon01code` AS `zon01code`,`b`.`dev01id` AS `dev01id`,`b`.`dev01name` AS `dev01name`,`b`.`dev01remark` AS `dev01remark`,`b`.`dev01code` AS `dev01code`
from `fis02fiscal_data` left join
`view_district` `b` on (`b`.`dist01code` = `fis02fiscal_data`.`fis02dist01codeid`)
WHERE `fis02year` = '".$fy."' AND `fis02constype` = ".$fc."
group by `fis02fiscal_data`.`fis02dist01codeid`,`fis02fiscal_data`.`fis02year`";
		$query = $this->db->query($sql);
		return $query->getResultObject();
    }

}