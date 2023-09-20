<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Users extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		if ( ! $this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		// if($this->session->userdata('type') == 6){
  //           redirect('dashboard', 'refresh');
  //       }

		$this->load->module('template');
		$this->load->model('users_model');
	}

	function index()
	{
		//check access
       // echo "111";
		_check(array('emp_view'), 'general', '', "You don't have permission to view Users.", 'info', 'dashboard');

		$data['title'] = 'Users';
		$data['breadcrumb'] = array(array('text' => 'Users', 'link' => 'Users'));

		$data['module'] = 'users';
		$data['view_file'] = 'display';

		if($this->input->get('q') != FALSE)
		{
			$data['breadcrumb'] = array(
					array('text' => 'Users', 'link' => 'Users'),
					array('text' => 'Search', 'link' => ''),
				);
			$data['search'] = $this->input->get('q');
		}

		$this->template->my_template($data);
	}

	function view($emp_id = FALSE)
	{
		$data['title'] = 'Users View';
		$data['breadcrumb'] = array(
				array('text' => 'Users', 'link' => 'Users'),
				array('text' => 'View', 'link' => '')
			);

		$data['module'] = 'users';
		$data['view_file'] = 'display';

		if ($emp_id == FALSE)
		{
			$data['emp_id'] = $this->session->userdata('user_id');
		}
		else
		{
			$data['emp_id'] = $emp_id;
		}
		
		$this->template->my_template($data);
	}

	function create($emp_id = FALSE)
	{
		// Edit
		if (is_numeric($emp_id))
		{
			_check(array('emp_edit'), 'general', '', "You don't have permission to edit Users.", 'info', 'dashboard');

			$data['title'] = 'Edit Users';
			$data['emp_id'] = $emp_id;
			$data['breadcrumb'] = array(
				array('text' => 'Users', 'link' => 'Users'),
				array('text' => 'Edit', 'link' => '')
			);
		}
		else //Add
		{
			//check access
			_check(array('emp_add'), 'general', '', "You don't have permission to add Users.", 'info', 'dashboard');

			$data['title'] = 'Create Users';
			$data['breadcrumb'] = array(
				array('text' => 'Users', 'link' => 'users'),
				array('text' => 'Create', 'link' => '')
			);
		}

		$data['module'] = 'users';
		$data['view_file'] = 'form';

		$this->template->my_template($data);
	}

	function designation($emp_id)
	{
		$data['title'] = 'Assign Designation';

		$data['module'] = 'users';
		$data['view_file'] = 'display';

		$data['emp_id'] = $emp_id;
	   $data['action'] = 'designation';

		$data['breadcrumb'] = array(
				array('text' => 'Users', 'link' => 'users'),
				array('text' => 'View', 'link' => 'users/view/'.$emp_id),
				array('text' => $data['title'], 'link' => '')
			);
		$this->template->my_template($data);
	}


	function delete()
	{
		//check access
		_check(array('emp_delete'), 'general', '', "You don't have permission to delete Employee.", 'info', 'dashboard');
		//Todo: check if referenced values are available (department)
		$delete_id = $this->uri->segment(3);

		if (is_numeric($delete_id))
		{
			$this->load->module('auth/ionauth');
			$this->ionauth->deactivate_employee($delete_id);

			$message = 'Employee deleted.';
			log_query($message);
			set_message($message, 'success');
		}
		redirect('employee');
	}

	function profile()
	{
		$data['title'] = 'Profile View';
		$data['breadcrumb'] = array(
				array('text' => 'Profile', 'link' => 'profile')
			);

		$data['module'] = 'users';
		$data['view_file'] = 'display';

		$data['emp_id'] = $this->session->userdata('user_id');

		$this->template->my_template($data);
	}

function change_password(){
    
        $data['module'] = 'users';
		$data['view_file'] = 'display';
		$data['emp_id'] = $this->session->userdata('user_id');

		$this->template->my_template($data);
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

	function get_with_limit($limit, $offset, $order_by)
	{
		$query = $this->users_model->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	function get_where($id)
	{
		$query = $this->users_model->get_where($id);
		return $query;
	}

	function get_where_custom($col, $value)
	{
		$query = $this->users_model->get_where_custom($col, $value);
		return $query;
	}

	function _insert($data)
	{
		$this->users_model->_insert($data);
	}

	function _update($id, $data)
	{
		$this->users_model->_update($id, $data);
	}

	function _delete($id)
	{
		$this->users_model->_delete($id);
	}

	function count_where($column, $value)
	{
		$count = $this->users_model->count_where($column, $value);
		return $count;
	}

	function get_max()
	{
		$max_id = $this->users_model->get_max();
		return $max_id;
	}

	function _custom_query($mysql_query)
	{
		$query = $this->users_model->_custom_query($mysql_query);
		return $query;
	}
}