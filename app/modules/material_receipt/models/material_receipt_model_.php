<?php
class material_receipt_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        $this->table = 'material_receipt';
        $this->idFld = 'material_receipt_id';
    }

    public function getReceipts($region = '') {
        $sql = "SELECT DISTINCT(`rcid`) FROM material_receipt";
        if($region != '') {
            $sql .=" WHERE region = '$region'";
        }        
        $query = $this->db->query($sql);
        return $query->result();
    }


    /* get receipts by date */
    public function getReceiptsByDate($region = '',$date) {
        $sql = "SELECT DISTINCT(`rcid`) FROM material_receipt WHERE 1=1";
        if($region != '') {
            $sql .=" AND region = '$region'";
        }        
        if($date != '') {
            $sql .=" AND receipt_date = '$date'";
        }   
        $query = $this->db->query($sql);
        return $query->result();
    }


    public function getOverallList($region = '') {
        $sql = "SELECT a.*,b.name as s_name,c.name as typename,d.name as diametername FROM material_receipt as a LEFT JOIN supplier as b ON a.supplier = b.supplier_id LEFT JOIN material_type c ON a.type=c.id LEFT JOIN diameter d ON a.diameter = d.id";
        if($region != '') {
            $sql .=" WHERE a.region = '$region'";
        }
        $sql .=" GROUP BY a.`lot`";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getReceiptInfo($receiptid) {
    	$sql = "SELECT a.*,b.name as s_name,c.name as typename,d.name as diametername FROM material_receipt as a LEFT JOIN supplier as b ON a.supplier = b.supplier_id LEFT JOIN material_type c ON a.type=c.id LEFT JOIN diameter d ON a.diameter = d.id WHERE a.rcid = '$receiptid'";
    	$query = $this->db->query($sql);
		return $query->result();
    }

    public function getList($type,$diameter,$purchased_by, $region = '') {
        $sql = "SELECT a.*,b.name as s_name,c.name as typename,d.name as diametername FROM material_receipt as a LEFT JOIN supplier as b ON a.supplier = b.supplier_id LEFT JOIN material_type c ON a.type=c.id LEFT JOIN diameter d ON a.diameter = d.id WHERE a.type = '$type' AND a.diameter='$diameter' AND a.purchased_by = '$purchased_by'";
        if($region != '') {
            $sql .=" AND a.region = '$region'";
        }
        $sql .=" GROUP BY a.`lot`";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /* get the distinct number of material received according to diameter */
    public function getByDiameterReceipt($type, $purchased_by, $region = '') {
        $sql = "SELECT DISTINCT(`diameter`) FROM material_receipt WHERE type = $type AND purchased_by = '$purchased_by'";
        if($region != '') {
            $sql .=" AND region = '$region'";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    /* get receipt info by receipt date*/
     public function getReceiptInfoByDate($receipt_date) {
        $sql = "SELECT a.*,b.name as s_name,c.name as typename,d.name as diametername FROM material_receipt as a LEFT JOIN supplier as b ON a.supplier = b.supplier_id LEFT JOIN material_type c ON a.type=c.id LEFT JOIN diameter d ON a.diameter = d.id WHERE a.rcid = '$receiptid'";
        $query = $this->db->query($sql);
        return $query->result();
    }
}