<?php //(defined('BASEPATH')) OR exit('No direct script access allowed');

class view_sup03_muni01_bri05_count_design_approval_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        
        $this->table = 'view_sup03_muni01_bri05_count_design_approval';
        //$this->idFld = 'bri03id';
    }
}
