<?php

namespace App\Modules\vdc_municipality\Models;

use CodeIgniter\Model;

class vdc_municipality_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'muni01municipality_vcd';
    protected $primaryKey       = 'muni01id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "muni01id",
        "muni01name",
        "muni01type",
        "muni01dist01id",
        "muni01remark",
        "muni01code",
        "muni01last_bridge_no"
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

     // public function getProduct($id = false)
    // {
    //     if($id === false){
    //         return $this->findAll();
    //     }else{
    //         return $this->getWhere(['product_id' => $id]);
    //     }   
    // }
    /* receive users */
    // public function getUsers($id = null){

    //     /* return all users */
    //     if($id) return $this->findAll();

    //     /* return user by id */
    //     return $this->find($id);

    // }

    // public function init_insert($data = NULL){

    //     /* insert new user in db */
    //     $this->save($data);

    // }

    // public function init_update($data = NULL) {

    //     /* update a user by your id (primary key) */
    //     $this->update($data["id"], $data);
    
    // }

    
    // public function init_delete($id){

    //     /* delete a user by your id */
    //     $this->delete($id);

    // }
}

