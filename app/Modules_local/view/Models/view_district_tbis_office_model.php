<?php //(defined('BASEPATH')) OR exit('No direct script access allowed');

class view_district_tbis_office_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        
        $this->table = 'view_vdc_reg_office';
        //$this->table = 'view_district_reg_office';
        //$this->idFld = 'bri03id';
    }
}
