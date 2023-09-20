<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\logo_upload\Models\logo_upload_model;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_bridge_detail_model;
use App\Modules\view\Models\view_district_reg_office_model;

//use App\Modules\Reports\Models\ReportsModel;

class Eng_Desing_Approval_report extends BaseController
{

  private static $arrDefData = array();

  private $fiscal_year_model;

  private $view_bridge_detail_model;

  private $view_district_reg_office_model;

  private $template;

  public function __construct()
  {
    helper(['form', 'html', 'et_helper']);
    $fiscal_year_model = new FiscalYearModel();
    $view_bridge_detail_model = new view_bridge_detail_model();
    $view_district_reg_office_model = new view_district_reg_office_model();
    $this->fiscal_year_model = $fiscal_year_model;
    $this->view_bridge_detail_model = $view_bridge_detail_model;
    $this->view_district_reg_office_model = $view_district_reg_office_model;
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

  public function index($stat = '')
  {
    $Postback = @$this->request->getVar('submit');
    $dataStart = @$this->request->getVar('start_date');
    $dateEnd = @$this->request->getVar('end_date');
    $data['blnMM'] = $stat;

    $data['startdate'] = $dataStart;
    $data['enddate'] = $dateEnd;

    if ($Postback == 'Back') {
      redirect(site_url());
    } elseif ($dataStart <= $dateEnd) {
      if ($dataStart != 0 || $dateEnd != 0) {

        $arrDistList = $this->view_district_new_reg_office_model->findAll();


        if (is_array($arrDistList)) {
          foreach ($arrDistList as $k => $v) {
            $data['arrDistrictList']['dist_' . $v['dist01id']] = $v;
          }
        }


        //$data['arrDistList'] = $this->view_district_tbis_office_model->findAll();

        if (empty($stat)) {
          $x = ENUM_NEW_CONSTRUCTION;
        } else {
          $x = ENUM_MAJOR_MAINTENANCE;
        }


        //ADoR (Allocatecd District of reponsibity )
        //$this->load->model('sel_district_model');
        $arrDistList = $this->district_name_model->findAll();
        $arrDists = array();
        foreach ($arrDistList as $dist) {
          array_push($arrDists, $dist['dist01id']);
        }


        $brige_list = $this->view_brigde_detail_site_assesment_survey_model->where('bri03construction_type', $x)->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd)->where('bri05design_approval_check', '1')->whereIn('dist01id', $arrDists)->findAll();

        $arrDataList = array();
        foreach ($brige_list as $k => $v) {
          $arrDataList['dist_' . $v['dist01id']]['dist'] = $data['arrDistrictList']['dist_' . $v['dist01id']];

          $arrDataList['dist_' . $v['dist01id']]['data'][] = $v;
        }



        $data['arrPrintList'] = $arrDataList;

        // print_r($data['arrPrintList']);
        // die();

        //var_dump($arrPrintList);                  
      } else {
        redirect("reports/Eng_Desing_Approval/" . $stat);
      }
    } else {
      'start date is Smaller than End Date';
    }

    return view('\Modules\Reports\Views\Eng_Desing_Approval_report', $data);
    //$this->template->my_template($data); 
  }
}
