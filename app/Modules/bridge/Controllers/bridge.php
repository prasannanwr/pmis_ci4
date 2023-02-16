<?php

namespace App\Modules\bridge\Controllers;

use App\Controllers\BaseController;
use App\Modules\bridge\Models\bridge_basic_data_model;
use App\Modules\bridge\Models\bridge_est_cost_model;
use App\Modules\bridge\Models\bridge_implementation_process_model;
use App\Modules\bridge\Models\bridge_model;
use App\Modules\bridge\Models\bridge_technical_data_model;
use App\Modules\bridge\Models\contribution_agencies_model;
use App\Modules\bridge\Models\personnel_information_model;
use App\Modules\construction\Models\construction_model;
use App\Modules\cost_components\Models\CostComponentsModel;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\supporting_agencies\Models\supporting_agencies_model;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_all_join_bridge_table_model;
use App\Modules\view\Models\view_vdc_model;
use App\Modules\bridge_anchorage_foundation\Models\bridge_anchorage_foundation_model;
use App\Modules\auth\Models\sel_district_model;

//use App\Modules\Reports\Models\ReportsModel;

class bridge extends BaseController
{
	private static $arrDefData = array();

	private $fiscal_year_model;

	private $cost_components_model;

	private $construction_model;

	private $view_vdc_model;

	private $view_all_join_bridge_table_model;

	private $supporting_agencies_model;

	private $bridge_technical_data_model;

	private $bridge_model;

	private $bridge_basic_data_model;

	private $bridge_implementation_process_model;

	private $personnel_information_model;

	private $bridge_est_cost_model;
			
	private $contribution_agencies_model;

	protected $table = 'view_all_join_bridge_table';

	private $db;

	public function __construct()
	{
		helper(['form', 'html', 'et_helper']);
		$this->db = \Config\Database::connect();
		$fiscal_year_model = new FiscalYearModel();
		$cost_components_model = new CostComponentsModel();
		$construction_model = new construction_model();
		$view_vdc_model = new view_vdc_model();
		$view_all_join_bridge_table_model = new view_all_join_bridge_table_model();
		$supporting_agencies_model = new supporting_agencies_model();
		$bridge_technical_data_model = new bridge_technical_data_model();
		$bridge_model = new bridge_model();
		$bridge_basic_data_model = new bridge_basic_data_model();
		$bridge_implementation_process_model = new bridge_implementation_process_model();
		$personnel_information_model = new personnel_information_model();
		$bridge_est_cost_model = new bridge_est_cost_model();
		$contribution_agencies_model = new contribution_agencies_model();
		$this->fiscal_year_model = $fiscal_year_model;
		$this->cost_components_model = $cost_components_model;
		$this->construction_model = $construction_model;
		$this->view_vdc_model = $view_vdc_model;
		$this->view_all_join_bridge_table_model = $view_all_join_bridge_table_model;
		$this->supporting_agencies_model = $supporting_agencies_model;
		$this->bridge_technical_data_model = $bridge_technical_data_model;
		$this->bridge_model = $bridge_model;
		$this->bridge_basic_data_model = $bridge_basic_data_model;
		$this->personnel_information_model = $personnel_information_model;
		$this->bridge_est_cost_model = $bridge_est_cost_model;
		$this->contribution_agencies_model = $contribution_agencies_model;
		$this->bridge_implementation_process_model = $bridge_implementation_process_model;
		$this->template = new Template();
		if (count(self::$arrDefData) <= 0) {
			$FName = basename(__FILE__, '.php');
			$fName = strtolower($FName);
			self::$arrDefData = array(
				'title'         => $FName,
				'breadcrumb'    => array(array('text' => $FName, 'link' => $fName)),
				'module'        => $fName,
				'view_file'     => 'index',
			);
		}
	}

	function index()
	{
		//check access
		//_check(array('org_view'), 'general', '', "You don't have permission to view New_bridge.", 'info', 'dashboard');
		$data['view_file'] = __FUNCTION__;
		$data = self::$arrDefData;
		$PostRadio = @$this->request->getVar('sort');
		$data['dataRadio'] = $PostRadio;
		$data['arrConstructionTypeList'] = $this->construction_model->findAll();
		return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}

	function form($emp_id = FALSE)
	{
		//return redirect()->to('bridge/form2/06 3 0536 18 06 13');
		if (session()->get('type') == 6) {
			redirect('bridge/index', 'refresh');
		}
		$data = self::$arrDefData;

		$data['title'] = 'Add Bridge';
		$data['view_file'] = __FUNCTION__;


		if (session()->get('user_rights') == 3 || session()->get('user_rights') == 5) {
			$data['is_admin'] = 1;
		} else {
			$data['is_admin'] = 0;
		}

		$data['objOldRec'] = '';
		$data['objbasicRec'] = '';
		$data['objPersonalRec'] = '';
		$data['objImplementationRec'] = '';
		$data['arrEstCost'] = '';
		$data['arrCstCost'] = '';
		$data['postURL'] = "bridge/form";
		//new updated
		$data['savecostURL'] = base_url() . "/bridge/saveCostRef/";
		$data['anchorageUrl'] = base_url() . "/bridge/getAnchorageFoundations/"; 

		//added by prasannanwr@gmail.com
		//under revision
		$data['constypeArr'] = $this->construction_model->findAll();

		$data['countLocal'] = $this->supporting_agencies_model->where('sup01sup_agency_type', ENUM_SUPPORT_LOCAL)->where('sup01_status',1)->orderBy('sup01index asc')->findAll();
		$data['countGovt'] = $this->supporting_agencies_model->where('sup01sup_agency_type', ENUM_SUPPORT_GOVERMENT)->where('sup01_status',1)->orderBy('sup01index asc')->findAll();
		$data['countOther'] = $this->supporting_agencies_model->where('sup01sup_agency_type', ENUM_SUPPORT_OTHER)->where('sup01_status',1)->orderBy('sup01index asc')->findAll();

		$data['brianchorage_foundation'] = $this->anchorageFoundations();

		if ($emp_id !== false) {
			$emp_id = urldecode($emp_id);
			$data['objOldRec'] = $this->bridge_basic_data_model->where('bri03bridge_no', $emp_id)->first();
			
			if (empty($data['objOldRec'])) {
				redirect('/bridge');
			}

			$data['objbasicRec'] = $this->bridge_technical_data_model->where('bri04bridge_no', $emp_id)->first();
			$data['objImplementationRec'] = $this->bridge_implementation_process_model->where('bri05bridge_no', $emp_id)->first();
			$data['objPersonalRec'] = $this->personnel_information_model->where('bri06bridge_no', $emp_id)->first();
			//$data['arrEstCost'] = $this->bridge_est_cost_model->where('bri07bridge_no', $data['objOldRec']['bri03bridge_no'])->where('bri07amount !=', 0)->findAll();
			$data['arrEstCost'] = $this->bridge_est_cost_model->getBridgeEstCosts($data['objOldRec']['bri03bridge_no']);
			//$data['arrCstCost'] = $this->contribution_agencies_model->where('bri08bridge_no', $data['objOldRec']['bri03bridge_no'])->where('bri08amount !=', 0)->findAll();
			$data['arrCstCost'] = $this->contribution_agencies_model->getBridgeContribution($data['objOldRec']['bri03bridge_no']);
			//echo $this->db->getLastQuery();exit;

			$data['brianchorage_foundation'] = $this->anchorageFoundations($data['objOldRec']['bri03bridge_type']);

			$oldmajor_vdc = $data['objOldRec']['bri03major_vdc'];
			if ($oldmajor_vdc == 1) { //right
				$oldmajor_municipality = $data['objOldRec']['bri03municipality_rb'];
			} else {
				$oldmajor_municipality = $data['objOldRec']['bri03municipality_lb'];
			}
			//echo $oldmajor_municipality;exit;
			$data['postURL'] .= '/' . $emp_id;
			//var_dump( $data['arrEstCost'] );
			$data['arrVDCList'] = $this->db->query("select `a`.`dist01id` AS `dist01id`,`a`.`dist01name` AS `dist01name`,`a`.`dist01zon01id` AS `dist01zon01id`,`a`.`dist01remark` AS `dist01remark`,`a`.`dist01code` AS `dist01code`,`a`.`dist01tbis01id` AS `dist01tbis01id`,`a`.`dist01state` AS `dist01state`, `b`.`muni01id`, `b`.`muni01name` from `dist01district` `a` LEFT JOIN `muni01municipality_vcd` `b` ON (`a`.`dist01id` = `b`.`muni01dist01id`) order by muni01name ASC")->getResult();
		} else {
			$data['arrVDCList'] = $this->db->query("select `a`.`dist01id` AS `dist01id`,`a`.`dist01name` AS `dist01name`,`a`.`dist01zon01id` AS `dist01zon01id`,`a`.`dist01remark` AS `dist01remark`,`a`.`dist01code` AS `dist01code`,`a`.`dist01tbis01id` AS `dist01tbis01id`,`a`.`dist01state` AS `dist01state`, `b`.`muni01id`, `b`.`muni01name` from `dist01district` `a` LEFT JOIN `muni01municipality_vcd` `b` ON (`a`.`dist01id` = `b`.`muni01dist01id`) WHERE `muni01name` LIKE '%Ga Pa%' ESCAPE '!' OR `muni01name` LIKE '%Na Pa%' ESCAPE '!' order by muni01name ASC")->getResult();
		}
		//Load Helping data For form
		$data['arrSupList'] = $this->supporting_agencies_model->where('sup01_status',1)->orderBy('sup01sup_agency_type asc')->orderBy('sup01index asc')->findAll();
		
		$data['arrCostCompList'] = $this->cost_components_model->where('cmp01component_status', 1)->findAll();
		//$data['arrVDCList'] = $this->view_vdc_model->orderBy('muni01remark DESC')->orderBy('muni01name ASC')->findAll();

		//if post
		if ($this->request->getMethod() == 'post') {
			//check if the form is submitted or not bri03project_fiscal_year
			$rules = [
				'bri03bridge_name' => 'required',
				'bri03construction_type' => 'required',
				'bri03district_name_lb' => 'required',
				'bri03district_name_rb' => 'required',
				'bri03river_name' => 'required',
				'bri03supporting_agency' => 'required',
				'bri03work_category' => 'required',
				'bri03project_fiscal_year' => 'required'
			];

		if (!$this->validate($rules)) {
			$data['validation'] = $this->validator;
			return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
		} else {

			//$act = $this->request->getVar('cmdSubmit');
			//log_message('error', $this->request->getVar('cmdSubmit'));
			if ($this->request->getVar('cmdSubmit') == 'Close') {
				redirect('bridge');
			} else {

				if ($this->request->getVar('cmdSubmit') == 'Save' || $this->request->getVar('cmdSubmit') == 'Save and Close') {
				//	log_message('error', 'inside the save condition');
					//save
					$bridge_no = @$this->request->getVar('bri03bridge_no');
					$bridge_id = @$this->request->getVar('bri03id');
					$bridge_name = @$this->request->getVar('bri03bridge_name');
					$blnIsNew = false;
					// log_message('error', 'bno:'.$bridge_no);
					// log_message('error', 'bid:'.$bridge_id);
					if (($bridge_no == '' && $bridge_id == '') || ($bridge_no == 0 && $bridge_id == 0)) {
						$blnIsNew = true;
						$bridge_no = '';
						//new case
						//$bridge_no = $this->bridge_model->generate_bridge_code(); //'123456789'; //will be autogenerated as per function
					} else {
						//update case
					}

					$enumMajorVDC = @$this->request->getVar('bri03major_vdc');


					if ($blnIsNew) {
						//die("new");
						$mVDC = @$this->request->getVar('bri03municipality_rb');
						if ($enumMajorVDC == MAJOR_LEFT) {
							$mVDC = @$this->request->getVar('bri03municipality_lb');
						}
						$bridge_no = $this->bridge_model->generate_bridge_code($mVDC);
						//echo "bno:".$bridge_no;exit;
					} else {
						//die("old");
						$mVDC = @$this->request->getVar('bri03municipality_rb');
						if ($enumMajorVDC == MAJOR_LEFT) {
							$mVDC = @$this->request->getVar('bri03municipality_lb');
						}
						if ($oldmajor_municipality != $mVDC) {
							$bridge_no = $this->bridge_model->generate_bridge_code($mVDC);
						}
						//echo "old:".$bridge_no;exit;
					}

					/*
                    * check if the bridge is from past fiscal year and not complete 
                    * update work category to carry over 
                    */
					//$this->load->model('fiscal_year/fiscal_year_model');
					$current_fiscal_year = $this->fiscal_year_model->orderBy("fis01id", "DESC")->limit(1, 0)->first();
					/*if(($this->request->getVar('bri03project_fiscal_year') < $current_fiscal_year->fis01id) && $this->request->getVar('bri05bridge_complete_check') != 1) {
                        $bri03work_category = "2"; //carrry over                    
                    } else {
                        $bri03work_category = @$this->request->getVar('bri03work_category');
                    }
					*/
					if (!empty(trim($this->request->getVar('bri03work_category')))) {
						$bri03work_category = @$this->request->getVar('bri03work_category');
					} else {
						$bri03work_category = 1; //new
					}

					/* 
						convert the completed date to completed fiscal year
						assign completion fiscal year according to date
						*/
					$bri05bridge_complete_date = @$this->request->getVar('bri05bridge_complete');
					$completed_year = (int) (date("Y", strtotime($bri05bridge_complete_date)));
					$completed_month = (int) (date("n", strtotime($bri05bridge_complete_date)));
					$completed_day = (int) (date("d", strtotime($bri05bridge_complete_date)));

					$current_year = (int) (date("Y"));
					$current_year = (int) (date("Y"));
					
					if ($completed_year == $current_year) {
						if ($completed_month < 7) {
							$completed_fy = $this->getCorrespondingFY($completed_year - 1);
						} elseif ($completed_month == 7 && $completed_day <= 15) {
							$completed_fy = $this->getCorrespondingFY($completed_year - 1);
						} elseif ($completed_month == 7 && $completed_day > 15) {
							$completed_fy = $this->getCorrespondingFY($completed_year);
						} elseif ($completed_month > 7) {
							$completed_fy = $this->getCorrespondingFY($completed_year);
						}
					} elseif ($completed_year < $current_year) {
						if ($completed_month <= 7) {
							if ($completed_month == 7) {
								if ($completed_month == 7 && $completed_day < 16) {
									$completed_fy = $this->getCorrespondingFY($completed_year - 1);
								} elseif ($completed_month == 7 && $completed_day >= 16) {
									$completed_fy = $this->getCorrespondingFY($completed_year);
								}
							} elseif ($completed_month < 7) {

								$completed_fy = $this->getCorrespondingFY($completed_year - 1);
							}
						} elseif ($completed_month > 7) {

							$completed_fy = $this->getCorrespondingFY($completed_year);
						}
					}

					$completed_fy = $this->fiscal_year_model->where("fis01code", $completed_fy)->first();
					if($completed_fy != NULL)
					$completed_fis01id = $completed_fy['fis01id'];
					else 
					$completed_fis01id = $completed_fy;
					
					if (!empty(trim($this->request->getVar('bri03tbsu_regional_office')))) {
						$bri03tbsu_regional_office = $this->request->getVar('bri03tbsu_regional_office');
					} else {
						$bri03tbsu_regional_office = 0;
					}

					$form_data1 = array(
						'bri03id' => $bridge_id,
						'bri03bridge_name' => @$this->request->getVar('bri03bridge_name'),
						'bri03construction_type' => @$this->request->getVar('bri03construction_type'),
						'bri03bridge_no' => $bridge_no,
						'bri03river_name' => @$this->request->getVar('bri03river_name'),
						//'bri03major_vdc' => $mVDCID,
						'bri03ward_lb' => @$this->request->getVar('bri03ward_lb'),
						'bri03ward_rb' => @$this->request->getVar('bri03ward_rb'),
						'bri03road_head' => @$this->request->getVar('bri03road_head'),
						'bri03portering_distance' => @$this->request->getVar('bri03portering_distance'),
						'bri03bridge_type' => @$this->request->getVar('bri03bridge_type'),
						'bri03design' => @$this->request->getVar('bri03design'),
						'bri03ww_width' => @$this->request->getVar('bri03ww_width'),
						'bri03ww_deck_type' => @$this->request->getVar('bri03ww_deck_type'),
						'bri03development_region' => @$this->request->getVar('bri03development_region'),
						'bri03tbsu_regional_office' => $bri03tbsu_regional_office,
						'bri03supporting_agency' => @$this->request->getVar('bri03supporting_agency'),
						'bri03work_category' => $bri03work_category,
						'bri03project_fiscal_year' => @$this->request->getVar('bri03project_fiscal_year'),
						'bri03topo_map_no' => @$this->request->getVar('bri03topo_map_no'),
						'bri03coordinate_north' => @$this->request->getVar('bri03coordinate_north'),
						'bri03coordinate_east' => @$this->request->getVar('bri03coordinate_east'),
						'bri03e_span' => @$this->request->getVar('bri03e_span'),

					);
					//var_dump($form_data1);exit;
					//if( (int) $bridge_id <= 0 ){
					$dist_left =  @$this->request->getVar('bri03district_name_lb');
					//var_dump( $dist_left );
					if ($dist_left) {
						$form_data1['bri03district_name_lb'] = $dist_left;
					}
					$dist_left =  @$this->request->getVar('bri03district_name_rb');
					if ($dist_left) {
						$form_data1['bri03district_name_rb'] = $dist_left;
					}
					$dist_left =  @$this->request->getVar('bri03municipality_lb');
					if ($dist_left) {
						$form_data1['bri03municipality_lb'] = $dist_left;
					}
					$dist_left =  @$this->request->getVar('bri03municipality_rb');
					if ($dist_left) {
						$form_data1['bri03municipality_rb'] = $dist_left;
					}
					$dist_left =  @$this->request->getVar('bri03bridge_series');
					if ($dist_left) {
						$form_data1['bri03bridge_series'] = $dist_left;
					}
					$form_data1['bri03major_vdc'] = @$this->request->getVar('bri03major_vdc');
					//} 
					//var_dump($_POST);
					// echo "<pre>";
					// var_dump($form_data1);
					// die();
					$xx = $this->bridge_basic_data_model->save($form_data1);

					//die($bridge_no);
					if (!empty(trim($this->request->getVar('bri04anchorage_foundation_leftbank')))) {
						$bri04anchorage_foundation_leftbank = $this->request->getVar('bri04anchorage_foundation_leftbank');
					} else {
						$bri04anchorage_foundation_leftbank = 0;
					}
					if (!empty(trim($this->request->getVar('bri04anchorage_foundation_rb')))) {
						$bri04anchorage_foundation_rb = $this->request->getVar('bri04anchorage_foundation_rb');
					} else {
						$bri04anchorage_foundation_rb = 0;
					}
					if (!empty(trim($this->request->getVar('bri04handrail_cable_two')))) {
						$bri04handrail_cable_two = $this->request->getVar('bri04handrail_cable_two');
					} else {
						$bri04handrail_cable_two = 0;
					}
					if (!empty(trim($this->request->getVar('bri04main_ww_cable_nos')))) {
						$bri04main_ww_cable_nos = $this->request->getVar('bri04main_ww_cable_nos');
					} else {
						$bri04main_ww_cable_nos = 0;
					}
					if (!empty(trim($this->request->getVar('bri04main_ww_cable_dia')))) {
						$bri04main_ww_cable_dia = $this->request->getVar('bri04main_ww_cable_dia');
					} else {
						$bri04main_ww_cable_dia = 0;
					}
					if (!empty(trim($this->request->getVar('bri04rust_prevention_measures')))) {
						$bri04rust_prevention_measures = $this->request->getVar('bri04rust_prevention_measures');
					} else {
						$bri04rust_prevention_measures = 0;
					}


					$form_data2 = array(
						'bri04id' => @$this->request->getVar('bri04id'),
						'bri04bridge_no' => $bridge_no,
						'bri04anchorage_foundation_leftbank' => $bri04anchorage_foundation_leftbank,
						'bri04anchorage_foundation_rb' => $bri04anchorage_foundation_rb,
						'bri04slope_protection_lb' => @$this->request->getVar('bri04slope_protection_lb'),
						'bri04slope_protection_rb' => @$this->request->getVar('bri04slope_protection_rb'),
						'bri04handrail_cable_two' => $bri04handrail_cable_two,
						'bri04main_ww_cable_nos' => $bri04main_ww_cable_nos,
						'bri04main_ww_cable_dia' => $bri04main_ww_cable_dia,
						'bri04rust_prevention_measures' => $bri04rust_prevention_measures,
						'bri04bridge_design_standard' => @$this->request->getVar('bri04bridge_design_standard'),
						'bri04windguy_arrangement' => @$this->request->getVar('bri04windguy_arrangement')
					);
					//var_dump($form_data2);
					// 	die();


					$this->bridge_technical_data_model->save($form_data2);

					//assign completion fiscal year according to date
					$bri05bridge_complete_date = @$this->request->getVar('bri05bridge_complete');
					$completed_year = date("Y", strtotime($bri05bridge_complete_date));
					$completed_month = date("m", strtotime($bri05bridge_complete_date));
					$completed_day = date("d", strtotime($bri05bridge_complete_date));

					if (!empty($this->request->getVar('bri05bridge_complete'))) {
						$bri05bridge_complete = $this->request->getVar('bri05bridge_complete');
					} else {
						$bri05bridge_complete = NULL;
					}

					if (!empty($this->request->getVar('bri05site_assessment'))) {
						$bri05site_assessment = $this->request->getVar('bri05site_assessment');
					} else {
						$bri05site_assessment = NULL;
					}

					if (!empty($this->request->getVar('bri05final_inspection'))) {
						$bri05final_inspection = $this->request->getVar('bri05final_inspection');
					} else {
						$bri05final_inspection = NULL;
					}

					if (!empty($this->request->getVar('bri05dmbt'))) {
						$bri05dmbt = $this->request->getVar('bri05dmbt');
					} else {
						$bri05dmbt = NULL;
					}
					//echo $this->request->getVar('bri05third_phase_construction');exit;
					if (!empty($this->request->getVar('bri05third_phase_construction'))) {
						$bri05third_phase_construction = $this->request->getVar('bri05third_phase_construction');
					} else {
						$bri05third_phase_construction = NULL;
					}

					if (!empty($this->request->getVar('bri05work_completion_certificate'))) {
						$bri05work_completion_certificate = $this->request->getVar('bri05work_completion_certificate');
					} else {
						$bri05work_completion_certificate = NULL;
					}

					if (!empty($this->request->getVar('bri05bridge_complete_check'))) {
						$bri05bridge_complete_check = $this->request->getVar('bri05bridge_complete_check');
					} else {
						$bri05bridge_complete_check = 0;
					}


					$form_data3 = array(
						'bri05id' => @$this->request->getVar('bri05id'),
						'bri05site_assessment' => $bri05site_assessment,
						'bri05bridge_design_estimate' => @$this->request->getVar('bri05bridge_design_estimate'),
						'bri05material_supply_target' => ($this->request->getVar('bri05material_supply_target') != '' ? $this->request->getVar('bri05material_supply_target') : NULL),
						'bri05first_phase_constrution' => ($this->request->getVar('bri05first_phase_constrution') != '' ? $this->request->getVar('bri05first_phase_constrution') : NULL),
						'bri05anchorage_concreting' => @$this->request->getVar('bri05anchorage_concreting'),
						'bri05bridge_complete' => $bri05bridge_complete,
						'bri05bmc_formation' => @$this->request->getVar('bri05bmc_formation'),
						'bri05sos_orentation' => @$this->request->getVar('bri05sos_orentation'),
						'bri05design_approval' => @$this->request->getVar('bri05design_approval'),
						'bri05bridge_completion_target' => @$this->request->getVar('bri05bridge_completion_target'),
						'bri05material_supply_uc' => @$this->request->getVar('bri05material_supply_uc'),
						'bri05cable_pulling' => @$this->request->getVar('bri05cable_pulling'),
						'bri05final_inspection' => $bri05final_inspection,
						'bri05bridge_completion_fiscalyear' => $completed_fis01id,
						'bri05bridge_no' => $bridge_no,
						'bri05community_agreement' => @$this->request->getVar('bri05community_agreement'),
						'bri05dmbt' => $bri05dmbt,
						'bri05second_phase_construction' => @$this->request->getVar('bri05second_phase_construction'),
						'bri05third_phase_construction' => $bri05third_phase_construction,
						'bri05work_completion_certificate' => @$this->request->getVar('bri05work_completion_certificate'),
						'bri05site_assessment_check' => @$this->request->getVar('bri05site_assessment_check'),
						'bri05bridge_design_estimate_check' => @$this->request->getVar('bri05bridge_design_estimate_check'),
						'bri05material_supply_target_check' => @$this->request->getVar('bri05material_supply_target_check'),
						'bri05first_phase_constrution_check' => @$this->request->getVar('bri05first_phase_constrution_check'),
						'bri05anchorage_concreting_check' => @$this->request->getVar('bri05anchorage_concreting_check'),
						'bri05bridge_complete_check' => $bri05bridge_complete_check,
						'bri05bmc_formation_check' => @$this->request->getVar('bri05bmc_formation_check'),
						'bri05sos_orentation_check' => @$this->request->getVar('bri05sos_orentation_check'),
						'bri05design_approval_check' => @$this->request->getVar('bri05design_approval_check'),
						'bri05bridge_completion_target_check' => @$this->request->getVar('bri05bridge_completion_target_check'),
						'bri05material_supply_uc_check' => @$this->request->getVar('bri05material_supply_uc_check'),
						'bri05cable_pulling_check' => @$this->request->getVar('bri05cable_pulling_check'),
						'bri05final_inspection_check' => @$this->request->getVar('bri05final_inspection_check'),
						'bri05bridge_completion_fiscalyear_check' => @$this->request->getVar('bri05bridge_complete_check'),
						'bri05community_agreement_check' => @$this->request->getVar('bri05community_agreement_check'),
						'bri05dmbt_check' => @$this->request->getVar('bri05dmbt_check'),
						'bri05second_phase_construction_check' => @$this->request->getVar('bri05second_phase_construction_check'),
						'bri05third_phase_construction_check' => @$this->request->getVar('bri05third_phase_construction_check'),
						'bri05work_completion_certificate_check' => @$this->request->getVar('bri05work_completion_certificate_check'),
						'bri05bridge_fabrication_contract_check' => @$this->request->getVar('bri05bridge_fabrication_contract_check'),
						'bri05bridge_fabrication_contract' => @$this->request->getVar('bri05bridge_fabrication_contract')
					);
					$this->bridge_implementation_process_model->save($form_data3);
					//var_dump($form_data3);
					//die();
					$form_data4 = array(
						'bri06id' => @$this->request->getVar('bri06id'),
						'bri06bridge_no' => $bridge_no,
						'bri06site_surveyor' => trim(@$this->request->getVar('bri06site_surveyor')),
						'bri06design_approved_by' => trim(@$this->request->getVar('bri06design_approved_by')),
						'bri06uc_members' => trim(@$this->request->getVar('bri06uc_members')),
						'bri06ngo_consultants_trained' => trim(@$this->request->getVar('bri06ngo_consultants_trained')),
						'bri06bridge_designer' => trim(@$this->request->getVar('bri06bridge_designer')),
						'bri06site_supervision' => trim(@$this->request->getVar('bri06site_supervision')),
						'bri06bridge_craftpersons_trained' => trim(@$this->request->getVar('bri06bridge_craftpersons_trained')),
						'bri06bmc_chairperson' => trim(@$this->request->getVar('bri06bmc_chairperson')),
						'bri06uc_chairperson' => trim(@$this->request->getVar('bri06uc_chairperson')),
						'bri06ddc_technician_trained' => trim(@$this->request->getVar('bri06ddc_technician_trained')),
						'bri06bmc_members' => trim(@$this->request->getVar('bri06bmc_members')),
					);
					$this->personnel_information_model->save($form_data4);


					//for est cost
					//delete all prev records of the est cost
					$this->bridge_est_cost_model->where('bri07bridge_no', $bridge_no)->delete();
					$arrEstCost = @$this->request->getVar('est_cost');
					if (is_array($arrEstCost)) {
						foreach ($arrEstCost as $k => $v) {
							$cid = substr($k, 2);
							//echo $cid;
							foreach ($v as $k1 => $v1) {
								$sid = substr($k1, 2);

								$form_data5 = array(
									//'bri07id' => (int) $v['rec_id'],
									'bri07cmp01id' => (float) $cid,
									'bri07sup01id' => (float) $sid,
									'bri07amount' => (float) $v1,
									'bri07bridge_no' => $bridge_no
								);
								$this->bridge_est_cost_model->save($form_data5);
							}
						}
					}
					//for contribute agencies
					//delete all prev records of the contribute agencies
					$this->contribution_agencies_model->where('bri08bridge_no', $bridge_no)->delete();
					$arrCstCost = @$this->request->getVar('cst_cost');
					if (is_array($arrCstCost)) {
						foreach ($arrCstCost as $k => $v) {
							$cid = substr($k, 2);

							foreach ($v as $k1 => $v1) {
								$sid = substr($k1, 2);

								$form_data6 = array(
									//'bri08id' => (int) $v['rec_id'],
									'bri08cmp01id' => (float) $cid,
									'bri08sup01id' => (float) $sid,
									'bri08amount' => (float) $v1,
									'bri08bridge_no' => $bridge_no
								);
								$this->contribution_agencies_model->save($form_data6);
							}
						}
					}

					session()->setFlashdata('message', 'Updated successfully.');
					if ($this->request->getVar('cmdSubmit') == 'Save and Close') {
						redirect('bridge');
					} else {
						//open it in edit mode
						//log_message('error', 'edit mode');
						//redirect('bridge/form/' . $bridge_no);

						return redirect()->to('bridge/form/' . $bridge_no);
					}
				} else {
					//log_message('error', 'no submit');
				}
			}
		}
		}

		return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}

	function view()
	{

		if (session()->get('type') == 6) {
			redirect('bridge/index', 'refresh');
		}
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;
		$GetBridgeNo = @$this->request->getVar('id');
		//var_dump($GetBridgeNo);
		//

		$data['objOldRec'] = $this->view_all_join_bridge_table_model->where('bri03bridge_no', $GetBridgeNo)->first();
		$data['Completion_Fiscal_Year'] = $this->fiscal_year_model->where('fis01id', $data['objOldRec']->bri05bridge_completion_fiscalyear)->first();
		$data['arrEstCost'] = $this->bridge_est_cost_model->where('bri07bridge_no', $data['objOldRec']->bri03bridge_no)->findAll();
		$data['arrCstCost'] = $this->contribution_agencies_model->where('bri08bridge_no', $data['objOldRec']->bri03bridge_no)->findAll();

		$data['arrSupList'] = $this->supporting_agencies_model->where('sup01_status',1)->findAll();
		$data['arrCostCompList'] = $this->cost_components_model->where('cmp01component_status',1)->findAll();
		$data['arrVDCList'] = $this->view_vdc_model->findAll();

		return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}


	function delete($delete_id = FALSE)
	{
		//return redirect()->to(base_url('bridge/lists'));exit;
		if (session()->get('type') == 6) {
			redirect('bridge/index', 'refresh');
		}
		if (session()->get('type') == ENUM_ADMINISTRATOR || session()->get('type') == ENUM_REGIONAL_MANAGER) {

			$arrdeltable = $this->bridge_model->where('bri03bridge_no', $delete_id)->asObject()->first();
			if($arrdeltable) {
				$this->bridge_model->where('bri03bridge_no', $arrdeltable->bri03bridge_no)->delete();
			$this->bridge_technical_data_model->where('bri04bridge_no', $arrdeltable->bri03bridge_no)->delete();
			$this->bridge_implementation_process_model->where('bri05bridge_no', $arrdeltable->bri03bridge_no)->delete();
			$this->personnel_information_model->where('bri06bridge_no', $arrdeltable->bri03bridge_no)->delete();
			$this->bridge_est_cost_model->where('bri07bridge_no', $arrdeltable->bri03bridge_no)->delete();
			$this->contribution_agencies_model->where('bri08bridge_no', $arrdeltable->bri03bridge_no)->delete();

			$message = 'Selected Data Deleted.';
			session()->setFlashdata('message', $message);
    				session()->setFlashdata('alert-class', 'alert-danger');
			// log_query($message);
			// set_message($message, 'success');
			}

			return redirect('bridge/lists');
		} else {
			return redirect('bridge');
		}
	}

	function deleteAll()
	{
		exit;
		if (session()->get('type') == ENUM_ADMINISTRATOR || session()->get('type') == ENUM_REGIONAL_MANAGER) {

			//$delete_ids = $this->request->getVar('bids');
			$delete_ids = $this->bridge_model->limit(200, 0)->findAll();
			//print_r($delete_ids);exit;
			foreach ($delete_ids as $delete_id) {
				//print_r($delete_id->bri03bridge_no);exit;
				//$arrdeltable = $this->bridge_model->where('bri03id', $delete_id)->first();
				//print_r($arrdeltable->bri03bridge_no);exit;
				$this->bridge_model->where('bri03bridge_no', $delete_id->bri03bridge_no)->delete();
				$this->bridge_technical_data_model->where('bri04bridge_no', $delete_id->bri03bridge_no)->delete();
				$this->bridge_implementation_process_model->where('bri05bridge_no', $delete_id->bri03bridge_no)->delete();
				$this->personnel_information_model->where('bri06bridge_no', $delete_id->bri03bridge_no)->delete();
				$this->bridge_est_cost_model->where('bri07bridge_no', $delete_id->bri03bridge_no)->delete();
				$this->contribution_agencies_model->where('bri08bridge_no', $delete_id->bri03bridge_no)->delete();
			}
			//exit;


			$message = 'Selected Data Deleted.';
			// log_query($message);
			// set_message($message, 'success');


			redirect('bridge');
		} else {
			redirect('bridge');
		}
	}

	function ajaxDataApplyWhere()
	{

		$gtc = @$this->request->getVar('columns');
		if (is_array($gtc)) {
			foreach ($gtc as $k => $v) {
				if ($v['search']['value'] !== '' && $v['search']['value'] != 'All District') {
					$this->view_all_join_bridge_table_model->where($v['data'], $v['search']['value']);
				}
			}
		}

		$search = $this->request->getVar('search');
		if ($search['value'] !== '') {
			$this->view_all_join_bridge_table_model->like('bri03bridge_name', $search['value']);
			$this->view_all_join_bridge_table_model->orLike('bri03bridge_no', $search['value']);
			//$this->view_all_join_bridge_table_model->orLike('dist01name', $search['value']);
		}
	}

	function ajaxDataApplyWhereOptimized()
	{

		$gtc = @$this->request->getVar('columns');
		$sql = '';
		if (is_array($gtc)) {
			foreach ($gtc as $k => $v) {
				if ($v['search']['value'] !== '' && $v['search']['value'] != 'All District') {
					$sql .=" AND `{$v['data']}` = '{$v['search']['value']}'";
				}
			}
		}

		$search = $this->request->getVar('search');
		if ($search['value'] !== '') {
			$sql .= " AND `bri03bridge_name` LIKE '%{$search['value']}%'";
			$sql .= " OR `bri03bridge_no` LIKE '%{$search['value']}%'";
		}
		return $sql;
	}

	function ajaxData()
	{
		//todo: count total records and put the no here
		//Apply Where Condition for counting
		//$this->ajaxDataApplyWhere();

		//Apply Limit for data
		$length = ($this->request->getVar('length') != ''?$this->request->getVar('length'):10);
		$start  = ($this->request->getVar('start') != ''?$this->request->getVar('start'):0);
		$search = $this->request->getVar('search');
		$arrDataList = '';
		$extra_sql = '';

		//for ordering
		//$arrColumns = array('bri03bridge_no', 'bri03bridge_name', 'bri03river_name', 'bri03design', 'dist01name', 'bri05bridge_complete', 'bri05bridge_complete_check', 'bri03construction_type');
		$arrColumns = array('bri03bridge_no', 'bri03bridge_name', 'bri03river_name', 'bri03design', 'dist01name', 'bri05bridge_complete', 'bri05bridge_complete_check', 'bri03construction_type', 'bri03work_category');
		$order = $this->request->getVar('order');
		
		// $arrDataList = $this->view_all_join_bridge_table_model->findAll($length, $start);
		//$arrDataList = $this->view_all_join_bridge_table_model->getBridgesFiltered($length, $start);
		//$sql = "SELECT * FROM {$this->table} WHERE 1=1";
		// $sql = "select `a`.`bri03id` AS `bri03id`,`a`.`bri03bridge_name` AS `bri03bridge_name`,`a`.`bri03bridge_no` AS `bri03bridge_no`,`a`.`bri03river_name` AS `bri03river_name`,`a`.`bri03e_span` AS `bri03e_span`, `a`.`bri03major_vdc`, `a`.`bri03construction_type`,`a`.`bri03work_category`, `a`.`bri03district_name_lb` as `left_dist01id`, `a`.`bri03district_name_rb` as `right_dist01id`, `b`.`bri05bridge_complete` AS `bri05bridge_complete`,`b`.`bri05bridge_completion_fiscalyear` AS `bri05bridge_completion_fiscalyear`, `c`.`dist01id`, `c`.`dist01name` AS `left_district`, `d`.`dist01name` AS `right_district` from `bri03basic_bridge_datatable` `a` left join `bri05bridge_implementation_processtable` `b` on(`a`.`bri03bridge_no` = `b`.`bri05bridge_no`) left join `dist01district` `c` on(`a`.`bri03district_name_lb` = `c`.`dist01id`) left join `dist01district` `d` on(`a`.`bri03district_name_rb` = `d`.`dist01id`) WHERE 1=1";

		$sql = "select `a`.*, case `a`.`bri03major_vdc` when 0 then `a`.`left_dist01id` else `a`.`right_dist01id` end AS `bri03major_dist_id`, case `a`.`bri03major_vdc` when 0 then `a`.`left_district` else `a`.`right_district` end AS `bri03major_district` FROM `view_all_bridges_list` a WHERE 1=1";

		// $sel_district_model = new sel_district_model();
  //       $arrPermittedDistListFull = $sel_district_model->where('user02userid', session()->get('user_id'))->findAll();
        
  //       $arrPermittedDistList = array();
  //       foreach( $arrPermittedDistListFull as $k=>$v ){
  //           $arrPermittedDistList[] = $v['user02dist01id'];
  //       }

		$extra_sql = $this->ajaxDataApplyWhereOptimized();
		$sql .=$extra_sql;
		//echo $sql;exit;

		$arrPermittedDistList = $this->view_all_join_bridge_table_model->permittedDistrict();
        $blnIsLogged = empty($this->session);
        //var_dump($arrPermittedDistList);exit;
        //var_dump(session()->get('type'));
        $intUserType = ($blnIsLogged)? session()->get('type'): ENUM_GUEST; 
        if($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR){
            //comma seperated value
            $data = '';
            if( count( $arrPermittedDistList )> 0) {
            	$permittedDistList = implode(',', $arrPermittedDistList);
            	//var_dump($arrPermittedDistList);exit;
                $sql .= " AND `a`.`dist01id` in ($permittedDistList)";
            }
        }
		$sql .=" LIMIT {$start}, {$length}";
		//echo $sql;exit;
		$arrDataList = $this->db->query($sql)->getResult();

		$total = $this->view_all_join_bridge_table_model->totalBridges($search, $arrPermittedDistList, $extra_sql);
		//$total = 100;
		//echo($this->view_all_join_bridge_table_model->getLastQuery());exit;
		$output['draw'] = $this->request->getVar('draw');
		$output['recordsTotal'] = $total;
		$output['recordsFiltered'] = $total;

		$output['data'] = $arrDataList;
		echo json_encode($output);
		die();
	}

	function ajaxData_old()
	{
		//todo: count total records and put the no here
		//Apply Where Condition for counting
		$this->ajaxDataApplyWhere();

		//Apply Limit for data
		$length = ($this->request->getVar('length') != ''?$this->request->getVar('length'):10);
		$start  = ($this->request->getVar('start') != ''?$this->request->getVar('start'):0);
		$search = $this->request->getVar('search');

		//for ordering
		//$arrColumns = array('bri03bridge_no', 'bri03bridge_name', 'bri03river_name', 'bri03design', 'dist01name', 'bri05bridge_complete', 'bri05bridge_complete_check', 'bri03construction_type');
		$arrColumns = array('bri03bridge_no', 'bri03bridge_name', 'bri03river_name', 'bri03design', 'dist01name', 'bri05bridge_complete', 'bri05bridge_complete_check', 'bri03construction_type', 'bri03work_category');
		$order = $this->request->getVar('order');
		
		// $arrDataList = $this->view_all_join_bridge_table_model->findAll($length, $start);
		$arrDataList = $this->view_all_join_bridge_table_model->getBridgesFiltered($length, $start);
		
		// $sel_district_model = new sel_district_model();
  //       $arrPermittedDistListFull = $sel_district_model->where('user02userid', session()->get('user_id'))->findAll();
        
  //       $arrPermittedDistList = array();
  //       foreach( $arrPermittedDistListFull as $k=>$v ){
  //           $arrPermittedDistList[] = $v['user02dist01id'];
  //       }

		$arrPermittedDistList = $this->view_all_join_bridge_table_model->permittedDistrict();
        $blnIsLogged = empty($this->session);
        //var_dump(session()->get('type'));
        $intUserType = ($blnIsLogged)? session()->get('type'): ENUM_GUEST; 
        if($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR){
            //comma seperated value
            $data = '';
            if( count( $arrPermittedDistList )> 0) {
                $sql .= " AND `c`.`dist01id` in ($arrPermittedDistList)";
            }
        }
		$sql .=" LIMIT {$start}, {$length}";
		$arrDataList = $this->db->query($sql)->getResult();

		$total = $this->view_all_join_bridge_table_model->totalBridges($search, $arrPermittedDistList);
		//$total = 100;
		//echo($this->view_all_join_bridge_table_model->getLastQuery());exit;
		$output['draw'] = $this->request->getVar('draw');
		$output['recordsTotal'] = $total;
		$output['recordsFiltered'] = $total;

		$output['data'] = $arrDataList;
		echo json_encode($output);
		die();
	}

	function x()
	{
		$manualSearch = @$this->request->getVar('hidden_sort');
		if ($manualSearch) {
			$PostRadio = @$this->request->getVar('sort');
			//$PostDel = @$this->request->getVar('cmdDelSubmit');
			$PostShow = @$this->request->getVar('ShowSubmit');
			$PostDistShow = @$this->request->getVar('ShowAll');
			$PostInt = @$this->request->getVar('bridge_no');
			$PostDist = @$this->request->getVar('district');
			$blnSearchByDist = @$this->request->getVar('distSubmit');
			$data['dataRadio'] = $PostRadio;

			$total = 0;
			$output['draw'] = '-1';
		} else {
		}
	}

	function saveCostRef()
	{
		$bridgeid = $_POST['bid'];
		$costref = $_POST['cost'];

		$form_data = array(
			'bri03id' => $bridgeid,
			'cost_estimated_reference' => $costref
		);
		//$bid = $this->bridge_basic_data_model->dbUpdate($bridgeid, array('cost_estimated_reference' => $costref));
		// $bid = $this->bridge_basic_data_model->save($form_data);
		echo $bid;
	}

	function lists($type = "")
	{
		if (session()->get('type') == 6) {
			redirect('bridge/index', 'refresh');
		}
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;

		if ($type == "new")
			$data['btype'] = 0;
		elseif ($type == "mm")
			$data['btype'] = 1;
		else
			$data['btype'] = 0;

		$PostRadio = @$this->request->getVar('sort');
		$data['dataRadio'] = $PostRadio;
		$data['arrConstructionTypeList'] = $this->construction_model->findAll();
		return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}

	/*
	* get fiscal year accoding to date
	*/
	function getCorrespondingFY($year)
	{

		$FY = $year . ($year + 1);
		return $FY;
	}

	function list_cancelled($type = "")
	{
		if (session()->get('type') == 6) {
			redirect('bridge/index', 'refresh');
		}
		$data = self::$arrDefData;
		$data['view_file'] = __FUNCTION__;

		$PostRadio = @$this->request->getVar('sort');
		$data['dataRadio'] = $PostRadio;
		$data['arrConstructionTypeList'] = $this->construction_model->findAll();
		return view('\Modules\bridge\Views'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
	}

	function anchorageFoundations($btype = '') {
			
		$bridge_anchorage_foundation_model = new bridge_anchorage_foundation_model();
		// $anchorage_foundation_list = $bridge_anchorage_foundation_model->whereIn('anc01maf_btype', $btype)->asObject()->findAll();
		if($btype != '') {
			$bridge_anchorage_foundation_model->where('anc01maf_btype', $btype);
		}
		$anchorage_foundation_list = $bridge_anchorage_foundation_model->where('anc01maf_status', 1)->asObject()->findAll();
		return $anchorage_foundation_list;
	}

	function getAnchorageFoundations() {
		//$btype[] = $_POST['btype'];
		//$btype[] = $this->request->getVar('btype');
		$btype = $this->request->getVar('btype');
		// $anchorage_foundation_list = $bridge_anchorage_foundation_model->whereIn('anc01maf_btype', $btype)->asObject()->findAll();
		if($btype) {
			$anchorage_foundation_list = $this->anchorageFoundations($btype);
			$str = "<option value='''>-- Please select --</option>";

			if($anchorage_foundation_list && is_array($anchorage_foundation_list)) {
				// if($btype == 16) {
				// 	$str .='<optgroup label = "Main Anchorage Block">';
				// }
				// if($btype == 20) {
				// 	$str .='<optgroup label = "Main Anchorage Foundation">';
				// }
				foreach ($anchorage_foundation_list as $value) {
					if($value->anc01maf_type_parent != '') {
						$str .= '<optgroup label = "'.$value->anc01maf_type_name.'">';
					} else {
						$str .= '<option value="'.$value->anc01id.'">'.$value->anc01maf_type_name .'</option>';
					}
				}
				return $str;
			} else {
				return '<option>&nbsp;</option>';
			}

		} else {
				return '';
		}
		
	}
}
