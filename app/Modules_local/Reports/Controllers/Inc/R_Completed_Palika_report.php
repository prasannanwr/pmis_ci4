<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\fiscal_data\Models\fiscal_data_model;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_brigde_detail_site_assesment_survey_model;
use App\Modules\view\Models\view_district_model;
use App\Modules\view\Models\view_district_new_reg_office_model;
use App\Modules\view\Models\view_vdc_model;

//use App\Modules\Reports\Models\ReportsModel;

class R_Completed_Palika_report extends BaseController
{
    private static $arrDefData = array();

    private $fiscal_year_model;

    private $template;

    private $view_regional_office_model;

    private $supporting_agencies_model;

    private $view_district_model;

    private $fiscal_data_model;

    //private $view_brigde_detail_site_assesment_survey_r7_model;

    private $view_brigde_detail_site_assesment_survey_model;

    private $view_district_new_reg_office_model;

    private $view_vdc_model;

    public function __construct()
    {
        helper(['form', 'html', 'et_helper']);
        $fiscal_year_model = new FiscalYearModel();
        $view_district_model = new view_district_model();
        $fiscal_data_model = new fiscal_data_model();
        //$view_brigde_detail_site_assesment_survey_r7_model = new view_brigde_detail_site_assesment_survey_r7_model();
        $view_brigde_detail_site_assesment_survey_model = new view_brigde_detail_site_assesment_survey_model();
        $view_district_new_reg_office_model = new view_district_new_reg_office_model();
        $view_vdc_model = new view_vdc_model();
        $this->fiscal_year_model = $fiscal_year_model;
        $this->view_district_model = $view_district_model;
        $this->fiscal_data_model = $fiscal_data_model;
        $this->view_district_new_reg_office_model = $view_district_new_reg_office_model;
        $this->view_vdc_model = $view_vdc_model;
        $this->view_brigde_detail_site_assesment_survey_model = $view_brigde_detail_site_assesment_survey_model;

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
            // $this->load->model('view/view_brigde_detail_site_assesment_survey_model');
            // $this->load->model('regional_office/regional_office_model');
            // $this->load->model('view/view_district_tbis_office_model');
            // $this->load->model('view/view_brigde_detail_model');
            // $this->load->model('view/view_district_model');
            // $this->load->model('view/view_district_reg_office_model');
            // $this->load->model('view/view_brigde_detail_model');
            // $this->load->model('view/view_district_new_reg_office_model');
            // $this->load->model('district_name/district_name_model');
            // $this->load->model('view/view_brigde_detail_site_assesment_survey_r7_model');
            // $this->load->model('view/view_vdc_model');
            
            
         $data['blnMM'] = $stat;
         $Postback = @$this->request->getVar('submit');
         $bri03municipality = @$this->request->getVar('bri03municipality');
         $data['rtype'] = "district";

         $municipality = $this->view_vdc_model->where('muni01id',$bri03municipality)->findAll();
            $data['arrPrintList'] = '';
            $data['municipality'] = $municipality;
         
             $dataDist = @$this->request->getVar('district');
             //$arrDistInfo = $this->view_district_model->where('dist01id',$dataDist)->findAll();
             

             if($bri03municipality ==''){
                redirect(site_url());
             }else{

                 $arrDistList = $this->view_district_new_reg_office_model->findAll();
                 //$arrDistList = array();
                  if (is_array($arrDistList))
                 {
                     foreach ($arrDistList as $k => $v)
                     {
                         $data['arrDistrictList']['dist_' . $v['dist01id']] = $v;
                        
                      }
                 }
                 
                 
                 //$data['arrDistList'] = $this->view_district_tbis_office_model->findAll();
                 
                     if (empty($stat))
                         {                       
                          $x = ENUM_NEW_CONSTRUCTION;
                         } else
                         {
                          $x = ENUM_MAJOR_MAINTENANCE;
                 
                     }
                 
                     // $brige_list= $this->view_brigde_detail_site_assesment_survey_model->where('dist01id',$dataDist)->where('bri03construction_type',$x)->
                     // where('bri05bridge_complete_check', '0')->where('bri03work_category !=','3')->asObject()->findAll();

                $brige_list= $this->view_brigde_detail_site_assesment_survey_model->where('bri03construction_type',$x)->where('bri05bridge_complete_check', '1')->where('left_muni01id',$bri03municipality)->asObject()->findAll();
          
                      $arrDataList = array();
                      foreach ($brige_list as $k => $v)
                     
                         {
                            $arrDataList['dist_' . $v->dist01id]['dist'] = $data['arrDistrictList'][ 'dist_' . $v->dist01id ];
                              $arrDataList['dist_' . $v->dist01id]['data'][]=$v;
                         }
                    
                 
                     $data['arrPrintList'] = $arrDataList;
              }
              $data['rtype'] = "district";
  
          
        return view('\Modules\Reports\Views\R_Completed_Palika_report', $data);
    }

}