<?php
//echo "qwdrf";
//echo $this->router->fetch_method();
	  // die;

switch ($this->router->fetch_method())
{
	case 'view':
		echo Modules::run('auth/view', $emp_id, 'view');
		break;
	case 'profile':
		echo Modules::run('auth/view', $emp_id, 'profile');
		break;
	case 'designation':
		echo Modules::run('auth/designation', $emp_id);
		break;
	case 'equipment':
		echo Modules::run('auth/equipment', $emp_id, $dep_id);
		break;
	case 'set_license':
		echo Modules::run('auth/set_license', $emp_id);
		break;
	case 'change_password':
		echo Modules::run('auth/change_password', $emp_id);
		break;
	
	default:
		$search = isset($search)?$search:FALSE;
		echo Modules::run('auth', $search);
		break;
}