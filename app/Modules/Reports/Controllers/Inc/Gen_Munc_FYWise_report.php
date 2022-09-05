<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_bridge_detail_model;
use App\Modules\view\Models\view_vdc_model;

//use App\Modules\Reports\Models\ReportsModel;

class Gen_Munc_FYWise_report extends BaseController
{
  private static $arrDefData = array();

  private $fiscal_year_model;

  private $view_bridge_detail_model;

  private $template;

  private $view_vdc_model;

  public function __construct()
  {
    helper(['form', 'html', 'et_helper']);
    $fiscal_year_model = new FiscalYearModel();
    $view_bridge_detail_model = new view_bridge_detail_model();
    $view_vdc_model  = new view_vdc_model();
    $this->fiscal_year_model = $fiscal_year_model;
    $this->view_bridge_detail_model = $view_bridge_detail_model;
    $this->view_vdc_model = $view_vdc_model;
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
    $dataStart = @$this->request->getVar('start_year');
    $dateEnd = @$this->request->getVar('end_year');
    $bri03municipality = @$this->request->getVar('bri03municipality');
    $data['blnMM'] = $stat;
    $data['title'] = "Overall";

    $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
    $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();
    if ($Postback == 'Back') {
      redirect(site_url());
    } elseif ($dataStart <= $dateEnd) {
      if ($dataStart != 0 || $dateEnd != 0) {

        // $selDist=$this->view_district_reg_office_model->findAll();
        $municipality = $this->view_vdc_model->where('muni01id', $bri03municipality)->findAll();
        //print_r($selVdc);exit;
        $arrPrintList = array();
        // if(is_array( $selDist)){
        // foreach( $selDist as $k=>$v){
        // $rr=$v->dist01id;
        if (empty($stat)) {
          $this->view_bridge_detail_model->where(
            'bri03construction_type',
            ENUM_NEW_CONSTRUCTION
          );
        } else {
          $this->view_bridge_detail_model->where(
            'bri03construction_type',
            ENUM_MAJOR_MAINTENANCE
          );
        }

        $data['sel_district_filter'] = '';
        $this->view_bridge_detail_model->where('bri05bridge_completion_fiscalyear >=', $dataStart)->where('bri05bridge_completion_fiscalyear <=', $dateEnd);
        $this->view_bridge_detail_model->where('bri05bridge_complete_check', 1)->where('bri05bridge_completion_fiscalyear_check', 1);
        //$dist= $this->view_bridge_detail_model->where('dist01id',$rr)->findAll();
        $dist = $this->view_bridge_detail_model->where('left_muni01id', $bri03municipality)->findAll();


        if (is_array($dist) && !empty($dist)) {
          //print header
          //echo 'header';
          $row['municipality'] = $municipality;
          $row['data'] = $dist;
          $arrPrintList[] = $row;
        }
        // }
        // }
        $data['arrPrintList'] = $arrPrintList;
      } else {
        redirect("reports/Gen_Munc_FYWise/" . $stat);
      }
    } else {
      'start date is Smaller than End Date';
    }
    //$this->template->my_template($data);
    return view('\Modules\Reports\Views\Gen_Munc_FYWise_report', $data);
  }
}
