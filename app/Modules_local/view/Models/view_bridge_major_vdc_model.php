<?php //(defined('BASEPATH')) OR exit('No direct script access allowed');

class view_bridge_major_vdc_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        
        $this->table = 'view_bridge_major_dist';
        //$this->idFld = 'bri03id';
    }
}
