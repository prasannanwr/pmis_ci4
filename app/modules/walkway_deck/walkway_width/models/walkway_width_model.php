<?php
class walkway_width_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        $this->table = 'wal01walkway_width_table';
        $this->idFld = 'wal01id';
    }
}
