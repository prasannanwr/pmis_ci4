<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Reports extends MX_Controller
{
    private static $arrDefData = array();
	function __construct()
	{
        if(count(self::$arrDefData)<=0){
            $FName = basename(__FILE__, '.php');
            $fName = strtolower($FName);
            self::$arrDefData = array(
                'title'         => $FName, 
                'breadcrumb'    => array(array('text' => $FName, 'link' => $fName)),
            	'module'        => $fName,
            	'view_file'     => 'index',
            );
        }
		parent::__construct();
        if ( ! $this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
        
        
        $this->load->database();
 		$this->load->module('template');
        $clName = get_class($this) . '_model';        

        $this->load->model( $clName );
        $this->model = $this->{$clName};
	}

	function index()
	{
		//check access
		//_check(array('org_view'), 'general', '', "You don't have permission to view Reports.", 'info', 'dashboard');

		$data = self::$arrDefData;
        $this->template->my_template($data);
	}   

    

}