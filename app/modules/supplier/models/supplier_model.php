<?php
class supplier_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        $this->table = 'supplier';
        $this->idFld = 'supplier_id';
    }
}