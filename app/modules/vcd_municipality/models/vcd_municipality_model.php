<?php
class vcd_municipality_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        $this->table = 'muni01municipality_vcd';
        $this->idFld = 'muni01id';
    }
}
