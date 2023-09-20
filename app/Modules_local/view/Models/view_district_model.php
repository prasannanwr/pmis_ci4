<?php

namespace App\Modules\view\Models;

use CodeIgniter\Model;

class view_district_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'view_district';
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

    // public function dbGetList()
    // {
    //     //check if loggged in or not
    //     //check if it has all district permission or not
    //     //
    //     //$this->load->model('auth/sel_district_model');
    //     $arrPermittedDistListFull = $this->sel_district_model->where('user02userid', $this->session->userdata('user_id'))->dbGetList();
       
    //     $arrPermittedDistList = array();
    //     foreach( $arrPermittedDistListFull as $k=>$v ){
    //         $arrPermittedDistList[] = $v->user02dist01id;
    //     }
    //     $blnIsLogged = empty($this->session);
    //     $intUserType = ($blnIsLogged)? $this->session->userdata('type'): ENUM_GUEST; 
    //     if($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR){
    //         //comma seperated value
    //         if( count( $arrPermittedDistList )> 0){
    //             $this->where_in('dist01id', $arrPermittedDistList);
    //         }else{
    //             $this->where('dist01id', null);
    //         }
    //     }
    //     return parent::dbGetList();
    // }

}