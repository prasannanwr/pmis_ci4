<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\fiscal_data\Models\fiscal_data_model;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\regional_office\Models\regional_office_model;
use App\Modules\template\Controllers\Template;
use App\Modules\view\Models\view_brigde_detail_site_assesment_survey_model;
use App\Modules\view\Models\view_brigde_detail_site_assesment_survey_r7_model;
use App\Modules\view\Models\view_district_model;
use App\Modules\view\Models\view_district_new_reg_office_model;
use App\Modules\User\Models\UserModel;

//use App\Modules\Reports\Models\ReportsModel;

class R_Completed_report extends BaseController
{
    private static $arrDefData = array();

    private $fiscal_year_model;

    private $template;

    private $view_regional_office_model;

    private $supporting_agencies_model;

    private $view_district_model;

    private $fiscal_data_model;

    private $regional_office_model;

    private $view_brigde_detail_site_assesment_survey_r7_model;

    private $view_district_new_reg_office_model;

    private $view_brigde_detail_site_assesment_survey_model;

    public function __construct()
    {
        helper(['form', 'html', 'et_helper']);
        $fiscal_year_model = new FiscalYearModel();
        $view_district_model = new view_district_model();
        $regional_office_model = new regional_office_model();
        $fiscal_data_model = new fiscal_data_model();
        $view_brigde_detail_site_assesment_survey_r7_model = new view_brigde_detail_site_assesment_survey_r7_model();
        $view_district_new_reg_office_model = new view_district_new_reg_office_model();
        $view_brigde_detail_site_assesment_survey_model = new view_brigde_detail_site_assesment_survey_model();
        $this->fiscal_year_model = $fiscal_year_model;
        $this->view_district_model = $view_district_model;
        $this->fiscal_data_model = $fiscal_data_model;
        $this->regional_office_model = $regional_office_model;
        $this->view_brigde_detail_site_assesment_survey_r7_model = $view_brigde_detail_site_assesment_survey_r7_model;
        $this->view_district_new_reg_office_model = $view_district_new_reg_office_model;
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

        $data['blnMM'] = $stat;
        $Postback = @$this->request->getVar('submit');
		$userModel = new UserModel();
		$arrPermittedDistList = $userModel->getArrPermitedDistList();
		$intUserType = (session()->get('type')) ? session()->get('type') : ENUM_GUEST;

            
            if($this->request->getVar('rtype') && $this->request->getVar('rtype') == "regional") { //tbsu regional office wise
                $dataDist = @$this->request->getVar('regionaloffice');
				$arrRegionalInfo = $this->regional_office_model->where('tbis01id', $dataDist)->asObject()->findAll();
				
				$data['tbsu_regional_off'] = $arrRegionalInfo[0];
                if($dataDist ==''){
                  redirect(site_url());
                }else{
            
                  $arrDistList = $this->regional_office_model->asObject()->findAll();

                  if (is_array($arrDistList))
                  {
                      foreach ($arrDistList as $k => $v)
                      {
                          $data['arrDistrictList']['dist_' . $v->tbis01id] = $v;
                          //$data['arrDistrictList']['dist_' . $dataDist] = $v;
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
              
                  /*$brige_list= $this->view_brigde_detail_site_assesment_survey_model->where('tbis01id', $dataDist)->where('bri03construction_type',$x)->
                  where('bri05bridge_complete_check', '1')->findAll();*/
				  if ($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR) {
					  //comma seperated value
					  //var_dump($dataDist);exit;
					  if (count($arrPermittedDistList) > 0) {
						$brige_list= $this->view_brigde_detail_site_assesment_survey_r7_model->whereIn('dist01id', $arrPermittedDistList)->where('dist01tbis01id',$dataDist)->where('bri03construction_type',$x)->
                        where('bri05bridge_complete_check', '1')->where('bri03work_category !=','3')->asObject()->findAll();
						//$brige_list= $this->view_brigde_detail_site_assesment_survey_r7_model->whereIn('dist01id', $arrPermittedDistList)->where('bri03construction_type',$x)->
                        //where('bri05bridge_complete_check', '1')->where('bri03work_category !=','3')->asObject()->findAll();
					  }
					} else {
						$brige_list= $this->view_brigde_detail_site_assesment_survey_r7_model->where('dist01tbis01id',$dataDist)->where('bri03construction_type',$x)->
							where('bri05bridge_complete_check', '1')->where('bri03work_category !=','3')->asObject()->findAll();
					}
				 //  echo $this->view_brigde_detail_site_assesment_survey_r7_model->getLastQuery()->getQuery();
                  //   exit;
                   $arrDataList = array();
                 /*  foreach ($brige_list as $k => $v)
                  
                      {
						   
						  if($v->tbis01id) {
                              
								
                         $arrDataList['dist_' . $v->tbis01id]['dist'] = $data['arrDistrictList'][ 'dist_' . $v->tbis01id ];
						  }
                          
                          $arrDataList['dist_' . $v->tbis01id]['data'][]=$v;
                      }*/
					  
                         foreach ($brige_list as $k => $v)
                        
                            {
                              
                               $arrDataList['dist_' . $dataDist]['dist'] = $data['arrDistrictList'][ 'dist_' . $dataDist ];
                                
                                $arrDataList['dist_' . $dataDist]['data'][]=$v;
                            }
                 
             // var_dump($arrDataList);exit;
                  
                  $data['arrPrintList'] = $arrDataList;
                 }
                 $data['rtype'] = "regional";
                      //print_r($data['arrPrintList']);
             $this->template->my_template($data); 

              } else {
                $dataDist = @$this->request->getVar('district');
				$arrDistInfo = $this->view_district_model->where('dist01id',$dataDist)->findAll();
				$arrRegionalInfo = $this->regional_office_model->where('tbis01id', $arrDistInfo[0]['dist01tbis01id'])->asObject()->findAll();
				$data['arrPrintList'] = '';
        //var_dump($arrRegionalInfo);exit;
				if(isset($arrRegionalInfo[0])) {
				$data['tbsu_regional_off'] = $arrRegionalInfo[0];				
                if($dataDist ==''){
                  redirect(site_url());
                }else{
            
                  $arrDistList = $this->view_district_new_reg_office_model->findAll();

                    if (is_array($arrDistList))
                    {
                        foreach ($arrDistList as $k => $v)
                        {
                            $data['arrDistrictList']['dist_' . $v['dist01id']] = $v;
                            //$data['arrDistrictList']['dist_' . $dataDist] = $v;
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
                    
                                       
                        //$brige_list= $this->view_brigde_detail_site_assesment_survey_model->where('dist01id', $dataDist)->where('bri03construction_type',$x)->
                        //where('bri05bridge_complete_check', '1')->asObject()->findAll();
						if ($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR) {
						  //comma seperated value
						 // $brige_list= $this->view_brigde_detail_site_assesment_survey_r7_model->whereIn('dist01id', $arrPermittedDistList)->where('dist01tbis01id',$dataDist)->where('bri03construction_type',$x)->
                       // where('bri05bridge_complete_check', '1')->where('bri03work_category !=','3')->asObject()->findAll();
						  if (count($arrPermittedDistList) > 0) {
							$brige_list= $this->view_brigde_detail_site_assesment_survey_model->whereIn('dist01id', $arrPermittedDistList)->where('dist01id', $dataDist)->where('bri03construction_type',$x)->where('bri05bridge_complete_check', '1')->asObject()->findAll();
						  }
						} else {
							$brige_list= $this->view_brigde_detail_site_assesment_survey_model->where('dist01id', $dataDist)->where('bri03construction_type',$x)->where('bri05bridge_complete_check', '1')->asObject()->findAll();
						}
                
                         $arrDataList = array();
                         foreach ($brige_list as $k => $v)
                        
                            {
                              
                               $arrDataList['dist_' . $v->dist01id]['dist'] = $data['arrDistrictList'][ 'dist_' . $v->dist01id ];
                                
                                $arrDataList['dist_' . $v->dist01id]['data'][]=$v;
                            }
                       
                        
                        $data['arrPrintList'] = $arrDataList;
				} }
				 
                      //print_r($data['arrPrintList']);
                 $data['rtype'] = "district";
            // $this->template->my_template($data); 
              }
          
        return view('\Modules\Reports\Views\R_Completed_report', $data);
    }

}