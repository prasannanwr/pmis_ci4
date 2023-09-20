<?php
class stock_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        $this->table = 'stock';
        $this->idFld = 'id';
    }

    public function updateStock($region,$mtype,$diameter,$units,$type = "add") {
	    $sql = "SELECT id FROM stock WHERE region = '$region' AND material_type = '$mtype' AND diameter = '$diameter'";
        $query = $this->db->query($sql);
        if($query->num_rows()> 0) {
            if($type == "add") {
                $sql = "UPDATE stock SET units = units + '$units' WHERE region = '$region' AND material_type = '$mtype' AND diameter = '$diameter'";
            } else {
                $sql = "UPDATE stock SET units = units - '$units' WHERE region = '$region' AND material_type = '$mtype' AND diameter = '$diameter'";
            }            
            $this->db->simple_query($sql);
        } else {
            $sql = "INSERT INTO stock(region,material_type,diameter,units) VALUES('$region','$mtype','$diameter','$units')";
            $this->db->query($sql);
        }

    }

    public function removeStock($id) {
        $sql = "SELECT id,type,diameter,units,region from material_receipt WHERE id = ".$id;
        $query = $this->db->query($sql);
        if($query->num_rows()> 0) {
            $row = $query->row();
            $units = $row->units;
            $region = $row->region;
            $mtype = $row->type;
            $diameter = $row->diameter;
            $sql = "SELECT id FROM stock WHERE region = '$region' AND material_type = '$mtype' AND diameter = '$diameter'";
            $query = $this->db->query($sql);
            if($query->num_rows()> 0) {
                $sql = "UPDATE stock SET units = units - '$units' WHERE region = '$region' AND material_type = '$mtype' AND diameter = '$diameter'";
                $this->db->simple_query($sql);
            }   
        }
    }

    public function addStock($id) {
        $sql = "SELECT i.`id`,r.`type`,r.`diameter`,r.`units`,r.`region` from material_issue i left join material_receipt r ON i.`lot` = r.`id` WHERE i.`id` = ".$id;
        $query = $this->db->query($sql);
        if($query->num_rows()> 0) {
            $row = $query->row();
            $units = $row->units;
            $region = $row->region;
            $mtype = $row->type;
            $diameter = $row->diameter;
            $sql = "SELECT id FROM stock WHERE region = '$region' AND material_type = '$mtype' AND diameter = '$diameter'";
            $query = $this->db->query($sql);
            if($query->num_rows()> 0) {
                $sql = "UPDATE stock SET units = units + $units WHERE region = '$region' AND material_type = '$mtype' AND diameter = '$diameter'";
                $this->db->simple_query($sql);
            }   
        }
    }
}