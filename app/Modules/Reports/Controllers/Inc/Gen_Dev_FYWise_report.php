<?php
namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\cost_components\Models\CostComponentsModel;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\logo_upload\Models\logo_upload_model;
use App\Modules\province\Models\ProvinceModel;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_bridge_detail_model;
use App\Modules\view\Models\view_district_reg_office_model;
use App\Modules\view\Models\view_regional_office_model;

//use App\Modules\Reports\Models\ReportsModel;

class Gen_Dev_FYWise_report extends BaseController
{
    private static $arrDefData = array();

    private $fiscal_year_model;
  
    private $view_bridge_detail_model;
  
    private $view_district_reg_office_model;
  
    private $template;

    private $cost_components_model;

    private $province_model;

    private $view_regional_office_model;
  
    public function __construct()
    {
      helper(['form', 'html', 'et_helper']);
      $fiscal_year_model = new FiscalYearModel();
      $view_bridge_detail_model = new view_bridge_detail_model();
      $view_district_reg_office_model = new view_district_reg_office_model();
      $cost_components_model = new CostComponentsModel();
      $province_model = new ProvinceModel();
      $view_regional_office_model = new view_regional_office_model();
      $this->fiscal_year_model = $fiscal_year_model;
      $this->view_bridge_detail_model = $view_bridge_detail_model;
      $this->view_district_reg_office_model = $view_district_reg_office_model;
      $this->cost_components_model = $cost_components_model;
      $this->province_model = $province_model;
      $this->view_regional_office_model = $view_regional_office_model;
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
    
        $data['startyear'] =$this->fiscal_year_model->where('fis01id', $dataStart)->first();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->first();
        if ($Postback == 'Back')
        {
            redirect(site_url());
        } elseif ($dataStart <= $dateEnd)
        {
            if ($dataStart != 0 || $dateEnd != 0)
            {
                $data['arrCostCompList'] = $this->cost_components_model->findAll();
                $arrPrintList = array();
                //$data['arrDevList']= $this->development_region_model->findAll();
				$data['arrDevList']= $this->province_model->findAll();
                
                if (is_array($data['arrDevList'])){
                    
                    foreach ($data['arrDevList'] as $k => $v){
                        $arrChild=null;
                        
                        //$arrDistList=$this->view_regional_office_model->where('dev01id', $v->dev01id)->findAll();
						$arrDistList=$this->view_regional_office_model->where('province_name', $v['province_name'])->findAll();
                        
                        if(is_array($arrDistList)){
                            
                            foreach( $arrDistList as $k1=>$v1){
                               // var_dump($v1);exit;
                                $arrChild1=null;
                                 if (empty($stat))
                                    {
                                        $this->view_bridge_detail_model->where('bri03construction_type',
                                            ENUM_NEW_CONSTRUCTION);
                                    } else
                                    {
                                        $this->view_bridge_detail_model->where('bri03construction_type',
                                            ENUM_MAJOR_MAINTENANCE);
                                    }
                            // $this->view_bridge_detail_model->where('bri05bridge_complete_check', 1)->where('bri05bridge_completion_fiscalyear_check', 1);
                            //     $arrBridgeList = $this->view_bridge_detail_model->
                            //         where('bri03project_fiscal_year >=', $dataStart)->
                            //         where('bri03project_fiscal_year <=', $dateEnd)->
                            //         where('dist01id', $v1->dist01id)->
                            //         findAll();


                                    //update

                                     $this->view_bridge_detail_model->where('bri05bridge_complete_check', 1)->where('bri05bridge_completion_fiscalyear_check', 1);
                                $arrBridgeList = $this->view_bridge_detail_model->
                                    where('bri05bridge_completion_fiscalyear >=', $dataStart)->
                                    where('bri05bridge_completion_fiscalyear <=', $dateEnd)->
                                    where('dist01id', $v1['dist01id'])->
                                    findAll();
                                    //echo $this->view_bridge_detail_model->getLastQuery();exit;
                                    //echo $this->view_bridge_detail_model->getCompiledSelect();exit;
                                    
                                foreach ($arrBridgeList as $k2 => $v2)
                                {
                                    $arrChild2=null;
                                     $arrChild1[] = array('info' => $v2);
                                } //bridge list for
                                  
                                if($arrChild1){
                                    $arrChild[]=array('info'=>$v1, 'arrChildList'=>$arrChild1);
                                }
                            }
                            // echo "<pre>";
                            //         var_dump($arrChild);exit;
                        }
                        //print_r($v);exit;
                        if($arrChild){
                            // echo "<pre>";
                            //         var_dump($arrChild);exit;  
                        $arrPrintList[]=array('info'=>$v, 'arrChildList'=>$arrChild);
                        }
                    }
                }
                //print_r($arrPrintList);exit;
                $data['arrPrintList'] = $arrPrintList;
                
            } else
            {
                redirect("reports/Gen_Dev_FYWise/".$stat);
                //return redirect()->to(base_url('reports/Gen_Dev_FYWise_report/'));  
            }
            
        } else
        {
            'start date is Smaller than End Date';
        }
        // echo "<pre>";
        // var_dump($data['arrPrintList']);exit;
        return view('\Modules\Reports\Views\Gen_Dev_FYWise_report', $data);

    }
}
       
	   
        ?>