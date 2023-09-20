<?php

namespace App\Modules\district_name\Models;

use CodeIgniter\Model;
use App\Modules\auth\Models\sel_district_model;

class district_name_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'dist01district';
    protected $primaryKey       = 'dist01id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "dist01name",
        "dist01zon01id",
        "dist01remark",
        "dist01code",
        "dist01tbis01id",
        "dist01state"];

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

    function findAll(int $limit = 0, int $offset = 0) {
        $sel_district_model = new sel_district_model();
        $arrPermittedDistListFull = $sel_district_model->where('user02userid', session()->get('user_id'))->findAll();
         
        $arrPermittedDistList = array();
        foreach( $arrPermittedDistListFull as $k=>$v ){
            //$arrPermittedDistList[] = $v->user02dist01id;
            $arrPermittedDistList[] = $v['user02dist01id'];
        }
        $blnIsLogged = empty($this->session);
        $intUserType = (session()->get('type')) ? session()->get('type') : ENUM_GUEST;
        if($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR){
            //comma seperated value
            if( count( $arrPermittedDistList )> 0){
                $this->whereIn('dist01id', $arrPermittedDistList);
            }else{
                $this->where('dist01id', null);
            }
        }
        return parent::findAll();
    }
}