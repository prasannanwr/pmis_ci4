<?php

namespace App\Modules\weighted\Models;

use CodeIgniter\Model;

class weighted_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'wei01weighted';
    protected $primaryKey       = 'wei01id';
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

 
}