<?php
class profile_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        //$this->table = 'fis01fiscal_year';
        //$this->idFld = 'fis01id';
    }
}
?>