<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_bridge_detail_model;
use App\Modules\view\Models\view_vdc_model;

//use App\Modules\Reports\Models\ReportsModel;

class Act_Dev_DateWise_report extends BaseController
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
    $data['title'] = "Overall";

    // $this->load->model('view/view_brigde_detail_model');
    // $this->load->model('development_region/development_region_model');
    // $this->load->model('district_name/district_name_model');
    // $this->load->model('development_region/development_region_model');
    // $this->load->model('view/view_district_model');
    // $this->load->model('view/view_regional_office_model');
    // $this->load->model('view/view_brigde_detail_model');
    // $this->load->model('view/stored_procedure');
    // $this->load->model('view/view_all_actual_view_model');
    // $this->load->model('cost_components/cost_components_model');

    $data['startdate'] = $dataStart;
    $data['enddate'] = $dateEnd;
    if ($Postback == 'Back')
    {
        redirect(site_url());
    } elseif ($dataStart <= $dateEnd)
    {
        if ($dataStart != 0 || $dateEnd != 0)
        {
            $data['arrCostCompList'] = $this->cost_components_model->findAll();
            $arrPrintList = array();
            $data['arrDevList']= $this->district_name_model->findAll();
                        
            $arrChild1=null;
            if (empty($stat))
            {
                $this->view_brigde_detail_model->where('bri03construction_type',
                ENUM_NEW_CONSTRUCTION);
            } else
            {
                $this->view_brigde_detail_model->where('bri03construction_type',
                ENUM_MAJOR_MAINTENANCE);
            }

            $this->view_brigde_detail_model->dbFilterCompleted();
            $arrBridgeList = $this->view_brigde_detail_model->
                where('bri05bridge_complete >=', $dataStart)->
                where('bri05bridge_complete <=', $dateEnd)->
                findAll();
            
            $arrBridgeIdList = null;
            if(is_array( $arrBridgeList )){
                foreach ($arrBridgeList as $k2 => $v2)
                {
                    $arrChild2=null;
                    $arrBridgeIdList[] = $v2->bri03bridge_no;
                    // $arrPrintList['dev_'.$v2->dev01id]['info']=$v2;
                    // $arrPrintList['dev_'.$v2->dev01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                    // $arrPrintList['dev_'.$v2->dev01id]['arrChildList']['dist_'.$v2->dist01id]['arrChildList'][] = array('info'=>$v2);
                    
                    $arrPrintList['dev_'.$v2->dist01state]['info']=$v2;
                    $arrPrintList['dev_'.$v2->dist01state]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                    $arrPrintList['dev_'.$v2->dist01state]['arrChildList']['dist_'.$v2->dist01id]['arrChildList'][] = array('info'=>$v2);

                }
            }
            
            $arrBridgeCostList = $this->view_all_actual_view_model->
                whereIn('bri08bridge_no', $arrBridgeIdList)->
                view_bridge_actual_cost();
                
            foreach ($arrBridgeCostList as $x2)
            {
                $arrCostList['bri_'.$x2->bri08bridge_no]['id_' . $x2->bri08cmp01id] = $x2;
            }
                    
            
            $data['arrPrintList'] = $arrPrintList;
            $data['arrCostList'] = $arrCostList;
                //print_r($arrPrintList);
        } else
        {
            redirect("reports/Act_Dev_DateWise/".$stat);
        }
    } else
    {
        'start date is Smaller than End Date/'.$stat;
    }
        
    return view('\Modules\Reports\Views\Act_Dev_DateWise_report', $data);
  }
} <?php
  $Postback = @$this->input->post('submit');
        $dataStart = @$this->input->post('start_date');
        $dateEnd = @$this->input->post('end_date');
        
         	$data['blnMM'] = $stat;
        $this->load->model('view/view_brigde_detail_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('district_name/district_name_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('view/view_district_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_brigde_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');
    
        $data['startdate'] = $dataStart;
        $data['enddate'] = $dateEnd;
        if ($Postback == 'Back')
        {
            redirect(site_url());
        } elseif ($dataStart <= $dateEnd)
        {
            if ($dataStart != 0 || $dateEnd != 0)
            {
                $data['arrCostCompList'] = $this->cost_components_model->findAll();
                $arrPrintList = array();
                $data['arrDevList']= $this->district_name_model->findAll();
                         
                $arrChild1=null;
                if (empty($stat))
                {
                    $this->view_brigde_detail_model->where('bri03construction_type',
                    ENUM_NEW_CONSTRUCTION);
                } else
                {
                    $this->view_brigde_detail_model->where('bri03construction_type',
                    ENUM_MAJOR_MAINTENANCE);
                }

                $this->view_brigde_detail_model->dbFilterCompleted();
                $arrBridgeList = $this->view_brigde_detail_model->
                    where('bri05bridge_complete >=', $dataStart)->
                    where('bri05bridge_complete <=', $dateEnd)->
                    findAll();
                
                $arrBridgeIdList = null;
                if(is_array( $arrBridgeList )){
                    foreach ($arrBridgeList as $k2 => $v2)
                    {
                        $arrChild2=null;
                        $arrBridgeIdList[] = $v2->bri03bridge_no;
                        $arrPrintList['dev_'.$v2->dev01id]['info']=$v2;
                        $arrPrintList['dev_'.$v2->dev01id]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['dev_'.$v2->dev01id]['arrChildList']['dist_'.$v2->dist01id]['arrChildList'][] = array('info'=>$v2);
                         

                    }
                }
                
                $arrBridgeCostList = $this->view_all_actual_view_model->
                    whereIn('bri08bridge_no', $arrBridgeIdList)->
                    view_bridge_actual_cost();
                    
                foreach ($arrBridgeCostList as $x2)
                {
                    $arrCostList['bri_'.$x2->bri08bridge_no]['id_' . $x2->bri08cmp01id] = $x2;
                }
                       
                
                $data['arrPrintList'] = $arrPrintList;
                $data['arrCostList'] = $arrCostList;
                 //print_r($arrPrintList);
            } else
            {
                redirect("reports/Act_Dev_DateWise/".$stat);
            }
        } else
        {
            'start date is Smaller than End Date/'.$stat;
        }
        $this->template->print_template($data);
        
        ?>