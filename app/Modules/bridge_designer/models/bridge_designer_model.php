<?php
class bridge_designer_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        $this->table = 'bdr01bridge_designer_table';
     $this->idFld = 'bdr01id';
    }
}
?>

