<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Employee_designation extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->module('template');
		$this->load->model('employee_designation_model');
	}

	function index($emp_id, $type = '')
	{
		$query = 'SELECT ed.*, o.name AS org_name, d.name AS dep_name, dg.name AS deg_name 
					FROM employee_designation ed
					JOIN department d ON ed.department_ref = d.id
					JOIN designation dg ON ed.designation_ref = dg.id
					JOIN organization o ON d.organization_ref = o.id
					WHERE ed.employee_ref = '.$emp_id.' ORDER BY o.name, d.name, dg.name';
		$data['designation_info'] = $this->_custom_query($query)->result();
		$data['type'] =  $type;
		$this->load->view('display', $data);
	}

	function assign()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('dep_id', 'Department Name', 'required|xss_clean');
		$this->form_validation->set_rules('deg_id', 'Designation Name', 'required|xss_clean');
		$this->form_validation->set_rules('emp_id', 'Employee Name', 'required|xss_clean');
		$this->form_validation->set_rules('mgr_id', 'Employee Name', 'required|xss_clean');
		$this->form_validation->set_rules('join_date', 'Join Date', 'required|xss_clean');

		//$update_id = $this->input->post('id', TRUE);
		$emp_id = $this->input->post('emp_id');

		if($this->form_validation->run() == FALSE)
		{
			//$this->session->set_flashdata('message', 'Error on assigning designation.'); TODO
			redirect('employee/designation/'.$emp_id, 'refresh');
		}
		else
		{
			$data['employee_ref'] = $this->input->post('emp_id');
			$data['department_ref'] = $this->input->post('dep_id');
			
			$this->load->module('department');
			$data['organization_ref'] = $this->department->get_where($data['department_ref'])->row()->organization_ref;
			
			$data['designation_ref'] = $this->input->post('deg_id');
			$data['manager_ref'] = $this->input->post('mgr_id');
			$data['join_date'] = $this->input->post('join_date');
			$data['created_on'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');
			
			$this->_insert($data);
			$message = 'New Designation assigned.';
			log_query($message);
			
			//Add userinfo in access table
			$new_user_access_general['user_id'] = $new_user_access['user_id'] = $data['employee_ref'];
			$new_user_access['department_ref'] = $data['department_ref'];
			$new_user_access['organization_ref'] = $data['organization_ref'];
			$new_user_access_general['updated_on'] = $new_user_access['updated_on'] = date('Y-m-d H:i:s');
			$new_user_access_general['updated_by'] = $new_user_access['updated_by'] = $this->session->userdata('user_id');
			
			$this->load->module('employee_access_general');
			$this->employee_access_general->_insert($new_user_access_general);
			log_query('Access assigned.');

			$this->load->module('employee_access');
			$this->employee_access->_insert($new_user_access);
			log_query('Access assigned.');

			set_message($message, 'success');
	
			redirect('employee/view/'.$emp_id, 'refresh');
		}
	}

	function leave()
	{
		//Todo: check if referenced values are available (department)
		$data['emp_id'] = $this->uri->segment(3);
		$data['delete_id'] = $this->uri->segment(4);

		if(is_numeric($data['delete_id']))
		{
			$data['title'] = 'Delete Designation';
			$data['module'] = 'employee_designation';
			$data['view_file'] = 'delete';

			$data['user_info'] = $this->ion_auth->user_fullname($data['emp_id'])->row();

			$data['breadcrumb'] = array(
				array('text' => 'Employee', 'link' => 'employee/view/'.$data['emp_id']),
				array('text' => 'Delete Designation', 'link' => ''),
			);
			$this->template->my_template($data);
		}
		
	}
	
		function delete()
	{
		//check access
		_check(array('org_delete'), 'general', '', "You don't have permission to delete Organization.", 'info', 'dashboard');

		//Todo: check if referenced values are available (department)
		$emp_id=$this->uri->segment(3);
		$delete_id = $this->uri->segment(4);

		if(is_numeric($delete_id))
		{
			$this->_delete($delete_id);

			$message = 'EMployee desigination deleted.';
			log_query($message);
			set_message($message, 'success');
		}
		redirect('employee/view/'.$emp_id);
	}


	function del_up_deg()
	{
		$delete_id = $this->input->post('delete_id');
		$emp_id = $this->input->post('emp_id');
		
		$data['leave_date'] = $this->input->post('leave_date');
		$data['leave_remarks'] = $this->input->post('remarks');
		$data['status'] = '0';

		$this->_update($delete_id, $data);

		$message = 'Designation deleted.';
		log_query($message);
		set_message($message, 'success');

		redirect('employee/view/'.$emp_id, 'refresh');
	}

	function log($emp_id)
	{
		$data['title'] = 'Employee Log';
		$query = 'SELECT o.name AS org_name, d.name AS dep_name, dg.name AS deg_name, ed.join_date, ed.leave_date, ed.leave_remarks AS remarks 
					FROM employee_designation ed
					JOIN department d ON d.id=ed.department_ref
					JOIN organization o ON o.id = d.organization_ref
					JOIN designation dg ON dg.id = ed.designation_ref
					WHERE ed.employee_ref = '.$emp_id.'
					ORDER BY o.name ASC, d.name ASC';
		$data['log_info'] = $this->_custom_query($query)->result();

		$data['module'] = 'employee_designation';
		$data['view_file'] = 'log';

		$data['breadcrumb'] = array(
				array('text' => 'Employee', 'link' => 'employee'),
				array('text' => 'Log', 'link' => '')
			);
		$this->template->my_template($data);
	}

	function get_employee_hierarchy($emp_id)
	{
		$mysql_query = "SELECT e.first_name, e.last_name, ed.*, o.name AS org_name, d.name as department_name FROM (
                            SELECT manager_ref AS emp_id, 'manager' AS who, 0 AS 'level',department_ref, organization_ref FROM employee_designation WHERE employee_ref = $emp_id
                            UNION ALL
                            SELECT $emp_id AS emp_id, 'self' AS who, 1 AS 'level',department_ref, organization_ref FROM employee_designation WHERE employee_ref = $emp_id
                            UNION ALL
                            SELECT employee_ref AS emp_id, 'employee' AS who, 2 AS 'level', department_ref,organization_ref FROM employee_designation WHERE manager_ref = $emp_id
                        ) ed
                        JOIN employee e ON e.id = ed.emp_id
                        JOIN organization o ON o.id = ed.organization_ref
						JOIN department d ON d.id=ed.department_ref
                        ORDER BY o.name, ed.level ASC, e.first_name ASC, e.last_name ASC";
		$query = $this->db->query($mysql_query);
		return $query;
	}

	function get_data_from_post()
	{
		$data['name'] = $this->input->post('name', TRUE);
		return $data;
	}

	function get_data_from_db($update_id)
	{
		$query = $this->get_where($update_id);
		foreach ($query->result() as $row)
		{
			$data['name'] = $row->name;
		}
		return $data;
	}

	function designation_assigned($emp_id)
	{
		$count = $this->count_where('employee_ref', $emp_id);
		return ($count>0)?TRUE:FALSE;
	}
	
	function get($order_by)
	{
		$query = $this->employee_designation_model->get($order_by);
		return $query;
	}

	function get_with_limit($limit, $offset, $order_by)
	{
		$query = $this->employee_designation_model->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	function get_where($id)
	{
		$query = $this->employee_designation_model->get_where($id);
		return $query;
	}

	function get_where_custom($col, $value)
	{
		$query = $this->employee_designation_model->get_where_custom($col, $value);
		return $query;
	}

	function _insert($data)
	{
		$this->employee_designation_model->_insert($data);
	}

	function _update($id, $data)
	{
		$this->employee_designation_model->_update($id, $data);
	}

	function _delete($id)
	{
		$this->employee_designation_model->_delete($id);
	}

	function count_where($column, $value)
	{
		$count = $this->employee_designation_model->count_where($column, $value);
		return $count;
	}

	function get_max()
	{
		$max_id = $this->employee_designation_model->get_max();
		return $max_id;
	}

	function _custom_query($mysql_query)
	{
		$query = $this->employee_designation_model->_custom_query($mysql_query);
		return $query;
	}

	function get_departments($emp_id)
	{
		$query = 'SELECT d.id, d.name, o.id AS org_id, o.name AS org_name 
					FROM department d RIGHT JOIN organization o ON d.organization_ref = o.id 
					WHERE d.id IN (SELECT DISTINCT department_ref FROM employee_designation WHERE employee_ref = '.$emp_id.')
					ORDER BY o.name, d.name';
		return $this->_custom_query($query);
	}
}