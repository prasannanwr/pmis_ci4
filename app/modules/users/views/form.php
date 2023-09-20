<?php

$emp_id = isset($emp_id)?$emp_id:0;
// var_dump($emp_id);
// die;
if($emp_id == 0)
{
	echo Modules::run('auth/create_user');
}
else
{
	echo Modules::run('auth/edit_user', $emp_id);
}

?>