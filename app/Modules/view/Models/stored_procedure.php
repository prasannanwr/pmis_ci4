<?php //(defined('BASEPATH')) OR exit('No direct script access allowed');

class stored_procedure extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        
        $this->table = '';
        //$this->idFld = 'bri03id';
    }
    public function proc_bridge_cmp($briNo){
        //echo 'asdfgjk';
        $this->load->helper('mysqli');
       // $result = $this->db->query('call proc_bridge_component_supplier_amt_cross("'.$briNo.'");');
        $result = $this->db->query('call proc_bridge_supplier_component_amt_cross("'.$briNo.'");');
        clean_mysqli_connection($this->db->conn_id);
        return $result->result_array();
    }
}
