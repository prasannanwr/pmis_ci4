<?php

namespace App\Modules\view\Models;

use CodeIgniter\Model;

class view_bridge_actual_cost extends Model
{
    // public function afterInit(){
        
    //     $this->table = 'view_vdc';
    //     //$this->idFld = 'bri03id';
    // }
    // public function view_bridge_actual_cost(){
    //     $this->table = __FUNCTION__;
    //     return $this->dbGetList();
    // }
    // public function view_bridge_actual_supporting_cost(){ 
    //     $this->table = __FUNCTION__;
    //     return $this->dbGetList();
    // }
    // public function view_bridge_estimated_supporting_cost(){ 
    //     $this->table = __FUNCTION__;
    //     return $this->dbGetList();
    // }
    // public function view_bridge_new_estimated_cost(){ 
    //     $this->table = __FUNCTION__;
    //     return $this->dbGetList();
    // }

    protected $DBGroup          = 'default';
    protected $table            = 'view_bridge_actual_cost';
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
}