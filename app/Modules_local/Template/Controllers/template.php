<?php
namespace App\Modules\template\Controllers;

use App\Controllers\BaseController;
use App\Modules\logo_upload\Models\logo_upload_model;

class Template extends BaseController
{
	function my_template($data)
	{
	        $logo_upload_model = new logo_upload_model();
            $data['logoimg']= $logo_upload_model->first();
	        //$this->load->view('my_template', $data);
			return view('\Modules\template\Views\my_template', $data);  
	    
		
	}
	function print_template($data)
	{
		$this->load->view('print_template', $data);
	}
	
	function graph_template($data){
        $this->load->view('graph_template',$data);
	}
    
    
}