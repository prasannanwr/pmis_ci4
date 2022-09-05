<?php

namespace App\Modules\view\Models;

use CodeIgniter\Model;

class actual_stored_procedure extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = '';
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

    public function proc_bridge_cmp($briNo){
        //echo 'asdfgjk';
        $this->load->helper('mysqli');
       // $result = $this->db->query('call proc_bridge_component_supplier_amt_cross("'.$briNo.'");');
        $result = $this->db->query('call proc_bridge_supplier_actual_cost("'.$briNo.'");');
        // clean_mysqli_connection($this->db->conn_id);
        // return $result->result_array();
    }

}