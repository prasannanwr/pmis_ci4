<?php
class bridge_design_standard_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        $this->table = 'bri02bridge_design_standard_table';
        $this->idFld = 'bri02id';
    }
}
