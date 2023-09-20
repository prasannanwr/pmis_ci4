<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Designation extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->module('template');
		$this->load->model('designation_model');
	}

	function index()
	{
		if ($this->session->userdata('user_id') != 1)
		{
			$message = "You don't have permission to view designation page.";
			set_message($message, 'info');
			redirect('dashboard');
		}
		
		$data['module'] = 'designation';
		$data['view_file'] = 'display';

		$data['title'] = 'Designations';
		$data['designation'] = $this->get('name')->result();

		$data['breadcrumb'] = array(
			array('text' => 'Settings', 'link' => 'settings'),
			array('text' => 'Designation', 'link' => 'designation')
		);
		$this->template->my_template($data);
	}

	function create()
	{
		if ($this->session->userdata('user_id') != 1)
		{
			$message = "You don't have permission to add designation.";
			set_message($message, 'info');
			redirect('dashboard');
		}
		$update_id = $this->uri->segment(3, 0); //if edit

		if($update_id == 0) //new add or edit validation error
		{
			//check if from edit
			$update_id = $this->input->post('id', TRUE);

			$data = $this->get_data_from_post();

			if(!is_numeric($update_id)) //fresh new add
			{
				$data['title'] = 'Add Designation';
			}
			else //edit validation error
			{
				$data['title'] = 'Edit Designation';
				$data['update_id'] = $update_id;
			}
		}
		else //edit
		{
			$data = $this->get_data_from_db($update_id);
			$data['update_id'] = $update_id;
			$data['title'] = 'Edit Designation';
		}

		$data['module'] = 'designation';
		$data['view_file'] = 'form';

		$data['breadcrumb'] = array(
			array('text' => 'Settings', 'link' => 'settings'),
			array('text' => 'Designation', 'link' => 'designation'),
			array('text' => $data['title'], 'link' => '')
		);
		$this->template->my_template($data);
	}

	function submit()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|min_length[5]|xss_clean');

		$update_id = $this->input->post('id', TRUE);

		if($this->form_validation->run() == FALSE)
		{
			$this->create();
		}
		else
		{
			$data = $this->get_data_from_post();

			if(is_numeric($update_id))
			{
				//Todo: check duplicate
				$this->_update($update_id, $data);

				$message = 'Designation updated.';
				log_query($message);
				set_message($message, 'success');
			}
			else
			{
				//Todo: check duplicate
				$data['created_on'] = date('Y-m-d H:i:s');
				$data['created_by'] = $this->session->userdata('user_id');
				$this->_insert($data);
				
				$message = 'New Designation added.';
				log_query($message);
				set_message($message, 'success');
			}
			redirect('designation');
		}
	}

	function delete()
	{
		if ($this->session->userdata('user_id') != 1)
		{
			$message = "You don't have permission to delete designation.";
			set_message($message, 'info');
			redirect('dashboard');
		}
		
		//Todo: check if referenced values are available (department)
		$delete_id = $this->uri->segment(3);

		if(is_numeric($delete_id))
		{
			$this->_delete($delete_id);

			$message = 'Designation deleted.';
			log_query($message);
			set_message($message, 'success');
		}
		redirect('designation');
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
	
	function get($order_by)
	{
		$query = $this->designation_model->get($order_by);
		return $query;
	}

	function get_with_limit($limit, $offset, $order_by)
	{
		$query = $this->designation_model->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	function get_where($id)
	{
		$query = $this->designation_model->get_where($id);
		return $query;
	}

	function get_where_custom($col, $value)
	{
		$query = $this->designation_model->get_where_custom($col, $value);
		return $query;
	}

	function _insert($data)
	{
		$this->designation_model->_insert($data);
	}

	function _update($id, $data)
	{
		$this->designation_model->_update($id, $data);
	}

	function _delete($id)
	{
		$this->designation_model->_delete($id);
	}

	function count_where($column, $value)
	{
		$count = $this->designation_model->count_where($column, $value);
		return $count;
	}

	function get_max()
	{
		$max_id = $this->designation_model->get_max();
		return $max_id;
	}

	function _custom_query($mysql_query)
	{
		$query = $this->designation_model->_custom_query($mysql_query);
		return $query;
	}
}