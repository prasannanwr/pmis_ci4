<?php

namespace App\Modules\bridge_type\Models;

use CodeIgniter\Model;

class bridge_type_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bri01bridge_type_table';
    protected $primaryKey       = 'bri01id';
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

    public function dbGetList()
    {
        //check if loggged in or not
        //check if it has all district permission or not
        //
        $this->load->model('auth/sel_district_model');
        $arrPermittedDistListFull = $this->sel_district_model->where('user02userid', $this->session->userdata('user_id'))->dbGetList();
       
        $arrPermittedDistList = array();
        foreach( $arrPermittedDistListFull as $k=>$v ){
            $arrPermittedDistList[] = $v->user02dist01id;
        }
        $blnIsLogged = empty($this->session);
        $intUserType = ($blnIsLogged)? $this->session->userdata('type'): ENUM_GUEST; 
        if($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR){
            //comma seperated value
            /*if( count( $arrPermittedDistList )> 0){
                $this->where_in('dist01id', $arrPermittedDistList);
            }else{
                $this->where('dist01id', null);
            }*/
			
			 if( count( $arrPermittedDistList )> 0){
                $this->where_in('bri03district_name_lb', $arrPermittedDistList);
            }else{
                $this->where('bri03district_name_lb', null);
            }
			
			
        }
		//echo $this->db->last_query();		
        return parent::dbGetList();
    }
    public function generate_bridge_code($intVDCNo, $ctype='')
    {
        /**
        $this->load->model('view/view_vdc_model');
        $arrInfo = $this->view_vdc_model->where('muni01id', $intVDCNo)->dbGetRecord();
        //$arrInfCont = $this->view_vdc_model->where('total_bridge', $intVDCNo)->dbgetRec();
        $nb = ((int)$arrInfo->total_bridge) + 1;
        */
        $this->load->model('view/view_vdc_new_model');
        $this->load->model('view/view_vdc_bridge_count_new_model');
        
        $arrInfo = $this->view_vdc_new_model->where('muni01id', $intVDCNo)->dbGetRecord();
        //$arrInfC = $this->view_vdc_bridge_count_new_model->where('muni01id', $intVDCNo)->dbGetRecord();
        //$arrInfo = $arrInfoList[0];
        
        $nb = ((int)$arrInfo->muni01last_bridge_no) + 1;
        $nb = ($nb < 10) ? '0' . $nb : $nb;
        $x = $arrInfo->dist01code . ' ' . $arrInfo->muni01code . '' . BRIDGE_INF_CODE .'' . $nb;
        
        if($ctype== ENUM_MAJOR_MAINTENANCE){
            //$x .= MM_CODE;
            $x .= "M";
        }
        
        $this->load->model('vcd_municipality/vcd_municipality_model');
        $this->vcd_municipality_model->dbUpdate($intVDCNo, array('muni01id'=>$intVDCNo, 'muni01last_bridge_no'=> $arrInfo->muni01last_bridge_no + 1 ));
        //echo $this->db->last_query();
        //die();

        return $x;
    }
}