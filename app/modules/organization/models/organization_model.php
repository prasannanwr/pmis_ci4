<?php
class organization_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        $this->table = 'organization';
        $this->idFld = 'organization_id';
    }
}