<?php
class agency_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        $this->table = 'funding_agency';
        $this->idFld = 'id';
    }
}