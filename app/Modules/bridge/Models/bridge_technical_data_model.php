<?php

namespace App\Modules\bridge\Models;

use App\Modules\auth\Models\sel_district_model;
use CodeIgniter\Model;

class bridge_technical_data_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bri04basic_technical_datatable';
    protected $primaryKey       = 'bri04id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "bri04bridge_no",
        "bri04anchorage_foundation_leftbank",
        "bri04anchorage_foundation_rb",
        "bri04slope_protection_lb",
        "bri04slope_protection_rb",
        "bri04handrail_cable_two",
        "bri04main_ww_cable_nos",
        "bri04main_ww_cable_dia",
        "bri04rust_prevention_measures",
        "bri04bridge_design_standard",
        "bri04windguy_arrangement",
        "bri04deleted",
        "bri04status"
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

    public function dbGetList()
    {
        //check if loggged in or not
        //check if it has all district permission or not
        //
        $sel_district_model = new sel_district_model();
        $arrPermittedDistListFull = $sel_district_model->where('user02userid', session()->get('user_id'))->findAll();
        $arrPermittedDistList = array();
        foreach ($arrPermittedDistListFull as $k => $v) {
            $arrPermittedDistList[] = $v['user02dist01id'];
        }
        $blnIsLogged = empty(session());
        $intUserType = ($blnIsLogged) ? session()->get('type') : ENUM_GUEST;
        if ($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR) {
            //comma seperated value
            if (count($arrPermittedDistList) > 0) {
                $this->where_in('dist01id', $arrPermittedDistList);
            } else {
                $this->where('dist01id', null);
            }
        }
        return parent::dbGetList();
    }
}
