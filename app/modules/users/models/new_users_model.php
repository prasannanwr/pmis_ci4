<?php
class new_users_model extends ET_BaseModel {
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

