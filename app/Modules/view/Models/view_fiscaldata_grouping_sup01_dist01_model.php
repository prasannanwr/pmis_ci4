<?php //(defined('BASEPATH')) OR exit('No direct script access allowed');

class view_fiscaldata_grouping_sup01_dist01_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        
        $this->table = 'view_fiscaldata_grouping_sup01_dist01';
        //$this->idFld = 'bri03id';
    }
}
