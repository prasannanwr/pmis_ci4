<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller
{
     private static $arrDefData = array();
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'),$this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
		$this->load->helper('language');
		$this->load->module('employee_access');
	}

	//redirect if needed, otherwise display the user list
	function index($search = FALSE)
	{
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		/*elseif (!$this->ion_auth->is_admin())
		{
			//redirect them to the home page because they must be an administrator to view this
			redirect('/', 'refresh');
		}*/
		else
		{
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			
			if($search != FALSE)
			{
				$data['users'] = $this->ion_auth->search_user($search)->result();
				$data['q'] = $search;
			}
			else
			{
				$data['users'] = $this->ion_auth->active_users()->result();
				$data['q'] = 'Employee';

				/*foreach ($data['users'] as $k => $user)
				{
					$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
				}*/
			}

			//list the users
			
			// $this->load->library('pagination');
			// $config['base_url'] = base_url().'employee/index/';
			// $config['total_rows'] = 100; //counting the total no of rows in your table
			// $config['per_page'] = '10';
			// $config['num_links'] = '5';
			// $config['full_tag_open'] = '<p>';
			// $config['full_tag_close'] = '</p>';
			// $this->pagination->initialize($config);
			// $data['offset_no']=$this->uri->segment(3);

			// $data['pagination'] = $this->pagination->create_links();
			$this->_render_page('auth/index', $data);
		}
	}
	function set_license($emp_id){
		$data['emp_id']=$emp_id;
		$this->load->module('settings');
		$this->settings->set_table('license');
		$result=$this->settings->get('id')->result_array();

		$license_list=array();
		foreach($result as $row)
			{
				$a=array($row['id']=>$row['name']);
				$license_list=$license_list+$a;
				}
				
		$data['license_list']=$license_list;
		
		$this->_render_page('auth/set_license',$data);
		
		}

	function view($emp_id, $type)
	{
		$data['users'] = $this->ion_auth->user($emp_id)->row();
		
		if (empty($data['users']))
		{
			set_message('Unable to find the requested user.', 'info');
			redirect('users');
		}
		
		$data['type'] = $type;

		//ADoR (Allocatecd District of reponsibity )
		$this->load->model('district_name/district_name_model');
 	    $this->load->model('sel_district_model');
        $data['arrDistList'] = $this->district_name_model->dbGetList();


		//$this->load->module('employee_designation');
		//$data['emp_deg_assigned'] = $this->employee_designation->designation_assigned($emp_id);
/**
		$this->load->module('employee_equipment');
		$data['emp_eqp_assigned'] = $this->employee_equipment->equipment_assigned($emp_id);
		
		$this->load->module('settings');
		$this->settings->set_table('employee_license');
		$data['employee_license'] = $this->settings->get_where_custom('employee_ref',$emp_id)->row();
		//print_r($data['employee_license']);
		
		$this->settings->set_table('employee license');
		$data['emp_license']=$this->settings->get('id');
	*/	
		//$this->load->module('employee_designation');
		//$data['emp_hierarchy_info'] = $this->employee_designation->get_employee_hierarchy($emp_id)->result_array();

		$this->_render_page('auth/view', $data);
	}

	//log the user in
	function login()
	{
		$data['title'] = "Login";
		$data['module'] = 'auth';
		$data['view_file'] = 'login';

		//validate form input
		$this->form_validation->set_rules('identity', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{
			
			//check to see if the user is logging in
			//check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				set_message($this->ion_auth->messages(), 'success');
				redirect('bridge', 'refresh');
			}
			else
			{
				//if the login was un-successful
				//redirect them back to the login page
				set_message($this->ion_auth->errors(), 'error');
				redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data['identity'] = array(
				'name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
				'class' => 'input-block-level input-large',
    			'autofocus' => 'focus'
			);

			$data['password'] = array(
				'name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'class' => 'input-block-level input-large'
			);

			//$this->_render_page('auth/login', $data);

			$this->load->module('template');
			$this->template->my_template($data);
		}
	}

	//log the user out
	function logout()
	{
		$data['title'] = "Logout";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them to the login page
		redirect('auth/login', 'refresh');
	}

	//change password
	function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();
  		if ($this->form_validation->run() == false)
		{
			//display the form
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$data['new_password'] = array(
				'name' => 'new',
				'id'   => 'new',
				'type' => 'password',
				'pattern' => '^.{'.$data['min_password_length'].'}.*$',
			);
			$data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id'   => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{'.$data['min_password_length'].'}.*$',
			);
			$data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			//render
			$this->_render_page('auth/change_password', $data);
		}
		else
		{
			$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/change_password', 'refresh');
			}
		}
	}

	function designation($emp_id)
	{
		$data['emp_id'] = $emp_id;
		$data['user_info'] = $this->ion_auth->get_user_info($emp_id)->row();
		
		$this->load->module('department');
		$data['department_info'] = $this->department->get_join_org()->result_array();
		$data['emp_dep_info'] = get_user_departments($emp_id);
		
		if ($this->session->userdata('user_id') == 1)
		{
			$data['logged_emp_dep_info'] = $data['department_info'];
		}
		else
		{
			$data['logged_emp_dep_info'] = get_user_departments();
		}
		
		$this->load->module('designation');
		$data['designation_info'] = $this->designation->get('name')->result_array();

		$data['managers'] = $this->ion_auth->get_managers()->result_array();
		
		$this->_render_page('auth/assign_designation', $data);
	}

	function equipment($emp_id, $dep_id = FALSE)
	{
		$data['emp_id'] = $emp_id;
		$data['dep_id'] = $dep_id;

		$data['user_info'] = $this->ion_auth->user($emp_id)->row();
		
		$this->load->module('employee_designation');
		$data['department_info'] = $this->employee_designation->get_departments($emp_id)->result_array();

		if ($dep_id)
		{
			$this->load->module('employee_equipment');
			$data['equipment_info'] = $this->employee_equipment->get_equipments($dep_id)->result_array();
		}
		else
		{
			$data['equipment_info'] = array();
		}

		$this->_render_page('auth/assign_equipment', $data);
	}

	function get_employee_hierarchy($emp_id)
	{
		return $this->ion_auth->get_employee_hierarchy();
	}

	//forgot password
	function forgot_password()
	{
		$this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required');
		if ($this->form_validation->run() == false)
		{
			//setup the input
			$data['email'] = array('name' => 'email',
				'id' => 'email',
			);

			if ( $this->config->item('identity', 'ion_auth') == 'username' ){
				$data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
			}
			else
			{
				$data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			//set any errors and display the form
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('auth/forgot_password', $data);
		}
		else
		{
			// get identity for that email
			$config_tables = $this->config->item('tables', 'ion_auth');
			$identity = $this->db->where('email', $this->input->post('email'))->limit('1')->get($config_tables['users'])->row();

			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				//if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			//if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				//display the form

				//set the flash data error message if there is one
				$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
				'type' => 'password',
					'pattern' => '^.{'.$data['min_password_length'].'}.*$',
				);
				$data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id'   => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{'.$data['min_password_length'].'}.*$',
				);
				$data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$data['csrf'] = $this->_get_csrf_nonce();
				$data['code'] = $code;

				//render
				$this->_render_page('auth/reset_password', $data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					//something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						//if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->logout();
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			//if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}


	//activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}


	function deactivate_employee($id)
	{
		$this->ion_auth->deactivate($id);
	}

	//deactivate the user
	function deactivate($id = NULL)
	{
		$id = $this->config->item('use_mongodb', 'ion_auth') ? (string) $id : (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$data['csrf'] = $this->_get_csrf_nonce();
			$data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('auth/deactivate_user', $data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			//redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	//create a new user
	function create_user()
	{
	    //var_dump($_POST);die;
	    $this->load->model('district_name/district_name_model');
 	    $this->load->model('sel_district_model');
        $data['arrDistList'] = $this->district_name_model->dbGetList();
        //var_dump($_POST);
		$data['title'] = "Create User";
          
          

		//if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		if ( ! $this->ion_auth->logged_in())
		{
			redirect('auth', 'refresh');
		}

		//check access
		_check(array('emp_add'), 'general', '', "You don't have permission to view Checksheet.", 'info', 'dashboard');

		//validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
		$this->form_validation->set_rules('type', '', '');
		$this->form_validation->set_rules('district_auth','', '');

		$this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$username = $this->input->post('username');//strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
            

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'email'      => $this->input->post('email'),
				'type'      => $this->input->post('type'),
				//'district_auth'  => $this->input->post('district_auth'),
				'created_by' => $this->session->userdata('user_id')
			);
		}
        $blnSaved = false;
		if ($this->form_validation->run() == TRUE)
		{ 
		  
            $id=$this->ion_auth->register($username, $password, $email, $additional_data);
            if($id){
                $newid=$id;
                $arrDist = $this->input->post('district_auth' );
                if(isset($arrDist)){
                    foreach($arrDist as $k => $v ){
                        $this->sel_district_model->dbInsert(array('user02dist01id'=>$v, 'user02userid'=> $newid));
                    }
                    //die;
                }
    			//check to see if we are creating the user
    			//redirect them back to the admin page
    			set_message('Users successfully created.', 'success');
    			redirect("users", 'refresh');
                $blnSaved = true;
            }
		}
		if(!$blnSaved){
			//display the create user form
			//set the flash data error message if there is one
			$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$data['first_name'] = array(
				'name'  => 'first_name',
				'id'    => 'first_name',
				'type'  => 'text',
				'autofocus' => 'focus',
				'value' => $this->form_validation->set_value('first_name'),
                'class' => 'form-control',
			);
			$data['last_name'] = array(
				'name'  => 'last_name',
				'id'    => 'last_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('last_name'),
                'class' => 'form-control',
			);
			
			$data['email'] = array(
				'name'  => 'email',
				'id'    => 'email',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('email'),
                'class' => 'form-control',
			);
		
			
			$data['username'] = array(
				'name'  => 'username',
				'id'    => 'username',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('username'),
                'class' => 'form-control',
			);
			$data['password'] = array(
				'name'  => 'password',
				'id'    => 'password',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password'),
                'class' => 'form-control',
			);
			$data['password_confirm'] = array(
				'name'  => 'password_confirm',
				'id'    => 'password_confirm',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
                'class' => 'form-control',
			);

			$this->_render_page('auth/create_user', $data);
		}
	}

	//edit a user
	function edit_user($id)
	{
	    //var_dump($id);
        //die("wertyui");
	   $this->load->model('district_name/district_name_model');
 	    $this->load->model('sel_district_model');
         $data['arrDistList'] = $this->district_name_model->dbGetList();
		$data['title'] = "Edit User";

		//if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		if ( ! $this->ion_auth->logged_in())
		{
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		
		if (empty($user))
		{
			set_message('Unable to find the requested user.', 'info');
			redirect('users');
		}

		//validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required|xss_clean');

		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('type', '', '');
		$this->form_validation->set_rules('district_auth','', '');

		if (isset($_POST) && !empty($_POST))
		{

			// do we have a valid request?
			//if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			if ($id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
                 'type'      => $this->input->post('type'),
				//'email'		 => $this->input->post('email'),
			);
                      
			//update the password if it was posted
			if ($this->input->post('password'))
			{
				$data['password'] = $this->input->post('password');
			}
            
			if (TRUE)
			{
				$ids = $this->ion_auth->update($user->id, $data);
                // var_dump($ids);
                  $newid=$id;
                $arrDist = $this->input->post('district_auth' );
                 
                $ssssss = $this->sel_district_model->where('user02userid', $newid)->dbDelete();
                  // echo "$newid";
                  //var_dump($ssssss);
                  //die();
                if(isset($arrDist)){
                    foreach($arrDist as $k => $v ){
                        $this->sel_district_model->dbInsert(array('user02dist01id'=>$v, 'user02userid'=> $newid));
                      // echo  $v;
                      //die();
                    }
                    
                    
                }  
				//check to see if we are creating the user
				//redirect them back to the admin page
				$this->session->set_flashdata('message_type', "success");
				$this->session->set_flashdata('message', "User Edited.");
				redirect("users", 'refresh');
			}
		}

		//display the edit user form
		$data['csrf'] = $this->_get_csrf_nonce();

		//set the flash data error message if there is one
		$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$data['user'] = $user;
		//$data['groups'] = $groups;
		//$data['currentGroups'] = $currentGroups;
         $data['userType'] = $this->form_validation->set_value('type', $user->type);
          $data['userids']=$this->form_validation->set_value('id', $user->id);
         $data['arrSelDistrict'] = $this->sel_district_model->where('user02userid', $data['userids'])->dbGetList();
          $arrDistList = array();
          foreach($data['arrSelDistrict'] as $dataDist){
                $row = $dataDist->user02dist01id;
                 $arrDistList[] = $row;
          }
            $data['arrDistList'] = $arrDistList;  
         
		$data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
            'class' => 'form-control',
		);
		$data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
            'class' => 'form-control',
		);


		$data['username'] = array(
			'name'  => 'username',
			'id'    => 'username',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('username', $user->username),
			'disabled' => 'disabled',
            'class' => 'form-control',
		);

		$data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('email', $user->email),
			'disabled' => 'disabled',
            'class' => 'form-control',
		);

		$data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password',
            'class' => 'form-control',
		);
		$data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password',
            'class' => 'form-control',
		);

		$this->_render_page('auth/edit_user', $data);
	}

	// create a new group
	function create_group()
	{
		$data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		//validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash|xss_clean');
		$this->form_validation->set_rules('description', $this->lang->line('create_group_validation_desc_label'), 'xss_clean');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth", 'refresh');
			}
		}
		else
		{
			//display the create group form
			//set the flash data error message if there is one
			$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->_render_page('auth/create_group', $data);
		}
	}

	//edit a group
	function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('auth', 'refresh');
		}

		$data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		//validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash|xss_clean');
		$this->form_validation->set_rules('group_description', $this->lang->line('edit_group_validation_desc_label'), 'xss_clean');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("auth", 'refresh');
			}
		}

		//set the flash data error message if there is one
		$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$data['group'] = $group;

		$data['group_name'] = array(
			'name'  => 'group_name',
			'id'    => 'group_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_name', $group->name),
		);
		$data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);

		$this->_render_page('auth/edit_group', $data);
	}


	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function _render_page($view, $data=null, $render=false)
	{
		$this->viewdata = (empty($data)) ? $data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $render);

		if (!$render) return $view_html;
	}
    
  function delete()
	{
      //var_dump($_GET);
      
		$delete_id = $this->input->get('id');
       $this->load->model('users/new_users_model');
         //$arrdeltable = $this->bridge_model->where('bri02id', $delete_id)->dbGetRecord();
	      $this->new_users_model->where('id', $delete_id)->dbDelete();
          
			$message = 'Selected User Deleted.';
			log_query($message);
			set_message($message, 'success');
		
        
		redirect('users');
	}  

}
