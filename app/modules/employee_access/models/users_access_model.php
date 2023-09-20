<?php
class users_access_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        $this->table = 'employee';
        $this->idFld = 'id';
    }
    
}
?>

