<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Settings extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		if ( ! $this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$this->load->module('template');
		$this->load->model('settings_model');
	}

	function index()
	{
		
		$data['module'] = 'settings';
		$data['view_file'] = 'display';

		$data['title'] = 'Settings';

		$data['breadcrumb'] = array(array('text' => 'Settings', 'link' => ''));
		$this->template->my_template($data);
	}
	
	
			
	function set_value( $id)
	{
		
		$data['type_id']=$id;
		
		$data['module']='settings';
		
		$update_id = $this->uri->segment(4, 0); //if edit
		if($update_id==0){

			
				switch($id){
					case 1://standard value 
					$data['chk_list']=array('0'=>'');

					$data['view_file']='std_value';
					$data['title']='Set Standard value';
					$this->load->module('check_sheet');
					$chk_sht_info=$this->check_sheet->get('id')->result();
					
					$check_sheet_id=$this->input->post('chksheet', TRUE);
					
					if(is_numeric($check_sheet_id)){
						$this->get_std_post_value( $data );
					$chk_sht_info1=$this->check_sheet->get_where($check_sheet_id)->row();
					$this->load->database();
					$fields = $this->db->list_fields($chk_sht_info1->name);
					$field_list=array(''=>'');
					foreach ($fields as $field)
					{
					   $temp=array($field=>$field);
					   $field_list=$field_list+$temp;
					}
					
					}
					$data['field_list']=$field_list;
					foreach($chk_sht_info as $ck){
						array_push($data['chk_list'], $ck->description);
						}
					
					
					
					$this->settings_model->set_table('standard_value');
					
					
					break;
					
					case 2:
					$department=$this->input->post('department',TRUE);
					$department_list=array();
					$this->load->module('department');
					$department_detail=$this->department->get('id')->result_array();
					
					foreach($department_detail as $row){
						$a=array($row[id]=>$row[name]);
						$department_list=$department_list+$a;
						}
					$data['department_list']=$department_list;
					$employee_list=array('0'=>'');
					
					$equipment_item_code_list =array('0'=>'');
					
						if($department!=0){
									$employee=$this->settings_model->get_employee($department=24);
									foreach($employee as $row)
									{
										$a=array( $row[id]=>$row[name]);
										
										$employee_list= $employee_list + $a;
										}
									$equipment_item_code=$this->settings_model->get_equipment_detail($department=24);
									foreach($equipment_item_code as $row)
									{
										$a=array( $row[id]=>$row[code]);
										
										$equipment_item_code_list= $equipment_item_code_list + $a;
										
										}
										
										$data['employee_list']=$employee_list;
										$data['equipment_item_code_list']=$equipment_item_code_list;
										
										$this->get_alert_post_value($data);
										
										
									}
					
					$data['department_id']=$department;
					$data['view_file']='alert';
					$data['title']='Set alert for equipment';
					
					$this->settings_model->set_table('alert');
					break;
					
					case 3:
					$data['view_file']='license';
					$data['title']='Set license';
					$this->get_license_post_value($data);
					$this->settings_model->set_table('license');
					break;
					
					default:
					redirect('settings', 'refresh');
					break;
					
					}
					
			
		
		
		}

		else //edit
		{
			
			$data = $this->get_data_from_db($update_id);
						
			$data['update_id'] = $update_id;
			$data['title'] = 'Edit Record';
			
		}

		$data['breadcrumb'] = array(
			array('text' => 'Setting', 'link' => 'settings'),
			array('text' => 'set value', 'link' => '')
		);
		
		$this->template->my_template($data);
	}


/** this function serves to insert the data  filled in the  form of create in 
 ** ass_ssr_daily form and  update this into  table check_sheet_asr_ssr_daily*/
 
	function submit_std_value(){
			$this->load->library('form_validation');
			$this->settings_model->set_table('standard_value');
			$this->get_std_post_value($data);
			
			print_r($data);
			$this->settings_model->_insert($data);

				$message = 'Standrad value added.';
				log_query($message);
				set_message($message, 'success');
				
			redirect('settings');

			
	}
	
		function submit_license(){
			$this->load->library('form_validation');
			$this->settings_model->set_table('license');

			$data['created_by']=$this->session->userdata('user_id');
			$data['created_on']=time();
			$data['name']=$this->input->post('license_name',TRUE);
			$data['status']=$this->input->post('status', TRUE);
			
			$this->settings_model->_insert($data);

				$message = 'License value added.';
				log_query($message);
				set_message($message, 'success');
				
			redirect('settings');

			
	}
	
	function submit_alert()
	{
		

		$this->settings_model->set_table('checksheet_alert');
		$this->get_alert_post_value($data);			
			
				//Todo: check duplicate
				//$data['created_by'] = $this->session->userdata('user_id');
				//$data['created_on'] = date('Y-m-d H:i:s');
		$data['updated_by']=$this->session->userdata('user_id');
		$data['remarks']='You have to perform next check sheet at'.$data['alert_date'];								
		$this->settings_model->_insert($data);

		$message = 'Alert setting added.';
		log_query($message);
		set_message($message, 'success');
		
		
		redirect('settings');
	}

	

	
	function get_std_post_value(&$data){
		$data['check_sheet_id'] = $this->input->post('chksheet', TRUE);
		$data['field_name'] = $this->input->post('field_name', TRUE);
		$data['max_value'] = $this->input->post('max_value', TRUE);
		$data['min_value'] = $this->input->post('min_value', TRUE);	
		
		}
		
function get_alert_post_value(&$data){
	$data['employee_ref']=$this->input->post('employee_id', TRUE);
	$data['equipment_item_code_ref']=$this->input->post('equipment_item_code', TRUE);
	$data['alert_date']=$this->input->post('alert_date', TRUE);
	}
	
	
function get_license_post_value(&$data){
	
	}
	
	function set_table($table){
		$this->settings_model->set_table($table);
		}
	
	function get($order_by)
	{
		$query = $this->settings_model->get($order_by);
		return $query;
	}
	
	function get_where_custom($col, $value){
		
				$query = $this->settings_model->get_where_custom($col,$value);
						return $query;
}

	
	function _insert($data)
	{
		$this->settings_model->_insert($data);
	}

	function _update($id, $data)
	{
		$this->settings_model->_update($id, $data);
	}

	function _delete($id)
	{
		$this->settings_model->_delete($id);
	}

	function count_where($column, $value)
	{
		$count = $this->settings_model->count_where($column, $value);
		return $count;
	}

	function get_max()
	{
		$max_id = $this->settings_model->get_max();
		return $max_id;
	}

	function _custom_query($mysql_query)
	{
		$query = $this->settings_model->_custom_query($mysql_query);
		return $query;
	}

}