<?php //(defined('BASEPATH')) OR exit('No direct script access allowed');

class view_vdc_bridge_count_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        
        $this->table = 'view_vdc_bridge_count';
        //$this->idFld = 'bri03id';
    }
}
