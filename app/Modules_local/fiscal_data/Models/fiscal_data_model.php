<?php

namespace App\Modules\fiscal_data\Models;

use CodeIgniter\Model;

class fiscal_data_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'fis02fiscal_data';
    protected $primaryKey       = 'fis02id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
      'fis02year',
      'fis02dist01codeid',
      'fis02name1',
      'fis02name2',
      'fis02name3',
      'fis02name4',
      'fis02sup01id',
      'fis02carryover',
      'fis02constype'
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

	public function dbUpdateData($dId, $fy, $ctype, $sa, $cc){
		
		$sql = "UPDATE `fis02fiscal_data` SET `fis02carryover` = '$cc' WHERE `fis02dist01codeid` = '$dId' AND `fis02year` = '$fy' AND `fis02constype` = '$ctype' AND `fis02sup01id` = '$sa'";
		$query = $this->db->query($sql);
		
    }
	
	public function dbInsertAData($dId, $fy, $ctype, $sa, $cc){
		
		// if(checkExistingData($dId,$fy)) {
		// 	$sql = "UPDATE `fis02fiscal_data` SET `fis02carryover` = '$cc' WHERE `fis02dist01codeid` = '$dId' AND `fis02year` = '$fy' AND `fis02constype` = '$ctype' AND `fis02sup01id` = '$sa' WHERE `fis02year` LIKE '%".$fy."%' AND `fis02dist01codeid` = '$dId'";
		// 	$query = $this->db->query($sql);
		// } else {
			//$sql = "INSERT INTO `fis02fiscal_data`(`fis02year`,`fis02dist01codeid`,`fis02name1`,`fis02name2`,`fis02name3`,`fis02name4`,`fis02sup01id`,`fis02carryover`,`fis02constype`) VALUES('$fy','$dId',0,0,0,0,'$sa','$cc','$ctype')";
			//$query = $this->db->query($sql);

		//}

		//check if the data exists 
		$sql = "SELECT `fis02id` FROM `fis02fiscal_data` WHERE `fis02dist01codeid` = '$dId' AND `fis02year` = '$fy' AND `fis02constype` = '$ctype' AND `fis02sup01id` = '$sa'";
		$query = $this->db->query($sql);
		$row = $query->getRow();

		if($row->Count() > 0) {
			$fis02id = $row->fis02id;
			//echo $fis02id;exit;
			$sql = "UPDATE `fis02fiscal_data` SET `fis02carryover` = `fis02carryover` + '$cc' WHERE `fis02id` = '$fis02id'";
		} else {
			$sql = "INSERT INTO `fis02fiscal_data`(`fis02year`,`fis02dist01codeid`,`fis02name1`,`fis02name2`,`fis02name3`,`fis02name4`,`fis02sup01id`,`fis02carryover`,`fis02constype`) VALUES('$fy','$dId',0,0,0,0,'$sa','$cc','$ctype')";
		}
		$query = $this->db->query($sql);
		
		
    }
	
	public function dbDeleteData($fy){
		
		$sql = "DELETE FROM `fis02fiscal_data` WHERE `fis02year` LIKE '%".$fy."%'";
		$query = $this->db->query($sql);
		
    }

    public function checkExistingData($dId, $fy) {
    	$sql = "SELECT * FROM `fis02fiscal_data` WHERE `fis02year` LIKE '%".$fy."%' AND `fis02dist01codeid` = '$dId'";
		$query = $this->db->query($sql);
		$row = $query->getRow();
		if($row->Count() > 0) {
			return true;
		} else {
			return false;
		}
    }
}