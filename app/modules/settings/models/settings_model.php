<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Settings_model extends CI_Model
{
	private $table;
	function __construct()
	{
		parent::__construct();
	}
	
	function set_table($tb){
		$this->table=$tb;  }

	function get_table()
	{
		
		return $this->table;
	}

	function get($order_by)
	{
		$table = $this->get_table();
		$this->db->order_by($order_by);
		$query=$this->db->get($table);
		return $query;
	}

	function get_with_limit($limit, $offset, $order_by)
	{
		$table = $this->get_table();
		$this->db->limit($limit, $offset);
		$this->db->order_by($order_by);
		$query=$this->db->get($table);
		return $query;
	}

	function get_where($id)
	{
		$table = $this->get_table();
		$this->db->where('id', $id);
		$query=$this->db->get($table);
		return $query;
	}

	function get_where_custom($col, $value)
	{
		$table = $this->get_table();
		$this->db->where($col, $value);
		$query=$this->db->get($table);
		return $query;
	}

	function _insert($data)
	{
		
		$table = $this->get_table();
		$this->db->insert($table, $data);
	}

	function _update($id, $data)
	{
		$table = $this->get_table();
		$this->db->where('id', $id);
		$this->db->update($table, $data);
	}

	function _delete($id)
	{
		$table = $this->get_table();
		$this->db->where('id', $id);
		$this->db->delete($table);
	}

	function count_where($column, $value)
	{
		$table = $this->get_table();
		$this->db->where($column, $value);
		$query=$this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}

	function count_all()
	{
		$table = $this->get_table();
		$query=$this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}

	function get_max()
	{
		$table = $this->get_table();
		$this->db->select_max('id');
		$query = $this->db->get($table);
		$row=$query->row();
		$id=$row->id;
		return $id;
	}

	function _custom_query($mysql_query)
	{
		$query = $this->db->query($mysql_query);
		return $query;
	}
	function get_all_inventory(){
		$query="SELECT o.name, d.name AS department_name, eic.code AS equipment_item_code_name, eq. * 
FROM department AS d
JOIN equipment_item_code AS eic ON eic.department_ref = d.id
JOIN (

SELECT ein.equipment_item_code_ref, ep.parts_name, ein.total_no_of_parts AS used_no_of_parts
FROM equipment_item_inventory AS ein
JOIN equipment_parts AS ep ON ep.id = ein.equipment_parts_ref
ORDER BY ein.equipment_item_code_ref
) AS eq ON eq.equipment_item_code_ref = eic.id
JOIN organization AS o ON d.organization_ref = o.id		
				";
				
		$result_query=$this->_custom_query($query);
		return $result_query->result();
		}
		
		

		function get_all_parts($org_id){
			$query="SELECT ei.organization_ref, o.name AS organization_name, eqi.name AS equipment_item_name, ep.parts_name, ei.total_no_of_items, ei.remaining_items
FROM equipment_inventory AS ei
JOIN organization AS o ON ei.organization_ref = o.id
JOIN equipment_parts AS ep ON ei.equipment_parts_ref = ep.id
JOIN equipment_item AS eqi ON ep.equipment_item_ref = eqi.id
WHERE organization_ref = $org_id";
			$result=$this->_custom_query($query);
			return $result->result();

			}
			
			function get_all_items($org_id){
			$query="SELECT d.name as department_name, eic.code as equipment_item_code_name,eq.*
							FROM department as d JOIN equipment_item_code as eic on eic.department_ref= d.id 
							JOIN 
								(SELECT ein.equipment_item_code_ref, ep.parts_name, ein.total_no_of_parts as used_no_of_parts
									 FROM  equipment_item_inventory as ein
										JOIN equipment_parts as ep  ON ep.id = ein.equipment_parts_ref ORDER BY ein.equipment_item_code_ref) as eq 
														ON  eq.equipment_item_code_ref= eic.id
											where organization_ref=$org_id";
			$result=$this->_custom_query($query);
			return $result->result();
			}
			
			function get_department($user_id){
				$q="SELECT  department_ref  FROM employee_designation WHERE employee_ref= $user_id AND status=1";
				$result=$this->_custom_query($q)->row()->department_ref;
				return $result;
			
				}
				
			function get_employee($department_ref){
				$q="SELECT ee.id, CONCAT( ee.first_name,  ' ',  ' ', ee.last_name ) AS name
					FROM employee_designation AS ed
					LEFT JOIN employee AS ee ON ed.employee_ref = ee.id
					WHERE ed.department_ref =$department_ref";
				
				$result=$this->_custom_query($q)->result_array();
				
				return $result;
				}
				function get_equipment_detail($department_ref){
					
					$q="SELECT id, code FROM equipment_item_code WHERE  department_ref=$department_ref";
					$result=$this->_custom_query($q)->result_array();
					return $result;
					}
				


}



