<?php
class requisition_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        $this->table = 'requisition';
        $this->idFld = 'id';
    }

    public function requisitionInfo($req_num) {
        $sql = "SELECT a.`req_id`,a.`issued_for`,a.`bridge_name`,b.`name` FROM `requisition` a LEFT JOIN `organization` b ON a.issued_for = b.organization_id WHERE a.`id`='$req_num'";
        $query = $this->db->query($sql);
        return $query->row();
    }
}