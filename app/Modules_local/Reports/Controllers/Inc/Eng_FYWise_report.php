<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_bridge_detail_model;
use App\Modules\view\Models\view_vdc_model;

//use App\Modules\Reports\Models\ReportsModel;

class Eng_FYWise_report extends BaseController
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
    
    $data['blnMM'] = $stat;

$data['startdate'] = $this->fiscal_year_model->where('fis01id', $dataStart)->first();
$data['enddate'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();

     if($Postback =='Back'){
          redirect(site_url());     
        }
     elseif( $dataStart <= $dateEnd){
        if($dataStart!= 0 || $dateEnd != 0 ){
            
        $arrDistList = $this->view_district_new_reg_office_model->findAll();

            
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
            
             //ADoR (Allocatecd District of reponsibity )
            //$this->load->model('sel_district_model');
            $arrDistList = $this->district_name_model->findAll();
            $arrDists = array();
            foreach($arrDistList as $dist) {
              array_push($arrDists, $dist['dist01id']);                      
            }
                                 
                $brige_list= $this->view_brigde_detail_site_assesment_survey_model->where('bri03construction_type',$x)->
                where('bri03project_fiscal_year >=', $dataStart)->
                where('bri03project_fiscal_year <=', $dateEnd)->
                whereIn('dist01id', $arrDists)->findAll();
        
                 $arrDataList = array();
                 foreach ($brige_list as $k => $v)
                
                    {
                        $arrDataList['dist_' . $v['dist01id']]['dist'] = $data['arrDistrictList'][ 'dist_' . $v['dist01id'] ];
                        $arrDataList['dist_' . $v['dist01id']]['data'][]=$v;
                    }
               
                
                
                $data['arrPrintList'] = $arrDataList;

              // print_r($data['arrPrintList']);
           // die();
         
            //var_dump($arrPrintList);                  
        }else{
            redirect("reports/Eng_FYWise/".$stat);   
        }
      }else{
        'start date is Smaller than End Date';
      }
    return view('\Modules\Reports\Views\Eng_FYWise_report', $data);
  }
}