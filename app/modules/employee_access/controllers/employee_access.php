<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Employee_access extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->module('template');
		$this->load->module('employee_access_general');
		$this->load->model('employee_access_model');
	}

	function index()
	{
		//check access
		_check(array('access_view'), '', '', "You don't have permission to Access Control.", 'info', 'dashboard');

		$data['title'] = 'Access Control';
		$data['breadcrumb'] = array(array('text' => 'Access Control', 'link' => ''));

		$data['module'] = 'Employee_access';
		$data['view_file'] = 'display';

		if ($this->input->get('q') != FALSE)
		{
			$search = $this->input->get('q');
			$data['q'] = $search;

			$query = "SELECT DISTINCT e.id, e.first_name, e.last_name FROM employee e";

			if ($this->session->userdata('user_id') != 1)
			{
				$query .= " JOIN employee_designation ed ON ed.employee_ref = e.id";
			}
			
			$query .= " WHERE (e.first_name LIKE '%$search%' OR e.last_name LIKE '%$search%')";

			if ($this->session->userdata('user_id') != 1)
			{
				$query .= " AND ed.department_ref IN (SELECT DISTINCT department_ref FROM employee_designation WHERE employee_ref = ". $this->session->userdata('user_id').")";
			}

			$data['users'] = $this->_custom_query($query)->result();
		}
		else
		{
			$data['q'] = 'Employee';
		}

		$this->template->my_template($data);
	}

	function view($emp_id, $dep_id = FALSE)
	{
		//check access
		_check(array('access_view'), '', '', "You don't have permission to Access Control.", 'info', 'dashboard');

		if ( ! isset($emp_id))
		{
			redirect('employee_access');
		}

		$data['title'] = 'Access Control';
		$data['breadcrumb'] = array(
				array('text' => 'Access Control', 'link' => 'employee_access'),
				array('text' => 'View', 'link' => '')
			);

		$data['module'] = 'employee_access';
		$data['view_file'] = 'form';

		$this->load->library('ion_auth');
		$data['emp_id'] = $emp_id;
		$data['emp_info'] = $this->ion_auth->user_fullname($emp_id)->row();
		
		if (empty($data['emp_info']))
		{
			set_message('Unable to find the requested employee.', 'info');
			redirect('employee_access');
		}

		if ($dep_id == FALSE)
		{
			$this->load->module('department');
			$data['department_info'] = $this->department->get_join_org()->result_array();
			$data['emp_dep_info'] = get_user_departments($emp_id);
			if ($this->session->userdata('user_id') == 1)
			{
				$data['logged_emp_dep_info'] = $data['emp_dep_info'];
			}
			else
			{
				$data['logged_emp_dep_info'] = get_user_departments();
			}
			
			$data['dep_id'] = FALSE;
		}
		else
		{
			$this->load->module('employee_access_general');
			$data['emp_access_general_info'] = $this->employee_access_general->get_where($emp_id)->row();
			$data['emp_access_info'] = $this->get_access_dept($emp_id, $dep_id)->row();

			if (empty($data['emp_access_info']))
			{
				$data['type'] = 'insert';
			}
			else
			{
				$data['type'] = 'update';
			}

			$this->load->module('department');
			$data['org_id'] = $this->department->get_where($dep_id)->row()->organization_ref;
			$data['dep_id'] = $dep_id;
		}

		$this->template->my_template($data);
	}

	function submit()
	{
		$data['access_org'] = $this->is_access_checked('access', 'access_org');
		$data['access_dep'] = $this->is_access_checked('access', 'access_dep');
		$data['access_emp'] = $this->is_access_checked('access', 'access_emp');
		$data['access_eqp'] = $this->is_access_checked('access', 'access_eqp');
		$data['access_chkst'] = $this->is_access_checked('access', 'access_chkst');
		$data['access_assign_eqp'] = $this->is_access_checked('access', 'access_assign_eqp');
		$data['access_assign_deg'] = $this->is_access_checked('access', 'access_assign_deg');
		$data['access_view'] = $this->check_view($data, array('access_org', 'access_dep', 'access_emp', 'access_eqp', 'access_chkst', 'access_assign_eqp', 'access_assign_deg'));
		
		$data['organization_ref'] = $this->input->post('org_id');
		$dep_id = $data['department_ref'] = $this->input->post('dep_id');
		$user_id = $this->input->post('user_id');
		
		if (check_access(array('access_org'), $dep_id))
		{
			$data_general['org_add'] = $this->is_access_checked('access_org', 'org_add');
			$data_general['org_edit'] = $this->is_access_checked('access_org', 'org_edit');
			$data_general['org_delete'] = $this->is_access_checked('access_org', 'org_delete');
			$data_general['org_view'] = $this->check_view($data_general, array('org_add', 'org_edit', 'org_delete'));
		}

		if (check_access(array('access_dep'), $dep_id))
		{
			$data_general['dep_add'] = $this->is_access_checked('access_dep', 'dep_add');
			$data_general['dep_edit'] = $this->is_access_checked('access_dep', 'dep_edit');
			$data_general['dep_delete'] = $this->is_access_checked('access_dep', 'dep_delete');
			$data_general['dep_view'] = $this->check_view($data_general, array('dep_add', 'dep_edit', 'dep_delete'));
		}

		if (check_access(array('access_emp'), $dep_id))
		{
			$data_general['emp_add'] = $this->is_access_checked('access_emp', 'emp_add');
			$data_general['emp_edit'] = $this->is_access_checked('access_emp', 'emp_edit');
			$data_general['emp_delete'] = $this->is_access_checked('access_emp', 'emp_delete');
			$data_general['emp_view'] = 'Y'; //$this->check_view($data_general, array('emp_add', 'emp_edit', 'emp_delete'));
		}

		if (check_access(array('access_eqp'), $dep_id))
		{
			$data['eqp_add'] = $this->is_access_checked('access_eqp', 'eqp_add');
			$data['eqp_edit'] = $this->is_access_checked('access_eqp', 'eqp_edit');
			$data['eqp_delete'] = $this->is_access_checked('access_eqp', 'eqp_delete');
			$data['eqp_view'] = 'Y'; //$this->check_view($data, array('eqp_add', 'eqp_edit', 'eqp_delete'));
		}

		if (check_access(array('access_chkst'), $dep_id))
		{
			$data['chkst_add'] = $this->is_access_checked('access_chkst', 'chkst_add');
			$data['chkst_edit'] = $this->is_access_checked('access_chkst', 'chkst_edit');
			$data['chkst_delete'] = $this->is_access_checked('access_chkst', 'chkst_delete');
			$data['chkst_view'] = $this->check_view($data, array('chkst_add', 'chkst_edit', 'chkst_delete'));
		}

		if (check_access(array('access_assign_eqp'), $dep_id))
		{
			$data['emp_eqp_assign'] = $this->is_access_checked('access_emp_eqp', 'emp_eqp_assign');
			$data['emp_eqp_delete'] = $this->is_access_checked('access_emp_eqp', 'emp_eqp_delete');
		}

		if (check_access(array('access_assign_deg'), $dep_id))
		{
			$data['emp_deg_assign'] = $this->is_access_checked('access_emp_deg', 'emp_deg_assign');
			$data['emp_deg_delete'] = $this->is_access_checked('access_emp_deg', 'emp_deg_delete');
		}

		$data_general['updated_on'] = $data['updated_on'] = date('Y-m-d H:i:s');
		$data_general['updated_by'] = $data['updated_by'] =  $this->session->userdata('user_id');
		
		if ($this->input->post('type') == 'insert')
		{
			$data_general['user_id'] = $data['user_id'] = $user_id;
			$this->employee_access_general->_insert($data_general);
			$this->_insert($data);
		}
		else if ($this->input->post('type') == 'update')
		{
			$this->employee_access_general->_update($user_id, $data_general);

			$update_arr = array('user_id' => $user_id, 'department_ref' => $dep_id);
			$this->_update1($update_arr, $data);
		}
		
		$message = 'Access updated.';
		log_query($message);
		set_message($message, 'success');

		redirect('employee_access/view/'.$user_id.'/'.$data['department_ref']);
	}

	function is_access_checked($arrkey, $acctype)
	{
		if ( ! is_array($this->input->post($arrkey)))
		{
			return 'N';
		}

		if (in_array($acctype, $this->input->post($arrkey)))
		{
			return 'Y';
		}

		return 'N';
	}

	function check_view($data, $arrkey)
	{
		$view_access = array_search('Y', elements($arrkey, $data));

		if( ! empty($view_access))
		{
			return 'Y';
		}

		return 'N';
	}

	function get_access_dept($emp_id, $dep_id)
	{
		$query = "SELECT * FROM employee_access WHERE user_id = $emp_id AND department_ref = $dep_id";
		return $this->_custom_query($query);
	}

	function get_with_limit($limit, $offset, $order_by)
	{
		$query = $this->employee_access_model->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	function get_where($id)
	{
		$query = $this->employee_access_model->get_where($id);
		return $query;
	}

	function get_where_custom($col, $value)
	{
		$query = $this->employee_access_model->get_where_custom($col, $value);
		return $query;
	}

	function _insert($data)
	{
		$this->employee_access_model->_insert($data);
	}

	function _update($id, $data)
	{
		$this->employee_access_model->_update($id, $data);
	}

	function _update1($arr, $data)
	{
		$this->employee_access_model->_update1($arr, $data);
	}

	function _delete($id)
	{
		$this->employee_access_model->_delete($id);
	}

	function count_where($column, $value)
	{
		$count = $this->employee_access_model->count_where($column, $value);
		return $count;
	}

	function get_max()
	{
		$max_id = $this->employee_access_model->get_max();
		return $max_id;
	}

	function _custom_query($mysql_query)
	{
		$query = $this->employee_access_model->_custom_query($mysql_query);
		return $query;
	}
}