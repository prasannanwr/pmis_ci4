<?php //(defined('BASEPATH')) OR exit('No direct script access allowed');

class view_sup03_muni01_bri05_count_site_assessment_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        
        $this->table = 'view_sup03_muni01_bri05_count_site_assessment';
        //$this->idFld = 'bri03id';
    }
}
