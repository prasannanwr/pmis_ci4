<?php

namespace App\Modules\Reports\Controllers\Inc;

use App\Controllers\BaseController;
use App\Modules\cost_components\Models\cost_components_model;
use App\Modules\district_name\Models\district_name_model;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\view\Models\view_bridge_actual_cost;
use App\Modules\view\Models\view_bridge_detail_model;

//use App\Modules\Reports\Models\ReportsModel;

class Act_Dev_FYWise_report extends BaseController
{
  private static $arrDefData = array();

  private $fiscal_year_model;

  private $cost_components_model;

  private $district_name_model;

  private $view_bridge_detail_model;

  private $view_bridge_actual_cost;

  public function __construct()
  {
    helper(['form', 'html', 'et_helper']);
    $fiscal_year_model = new FiscalYearModel();
    $cost_components_model = new cost_components_model();
    $district_name_model = new district_name_model();
    $view_bridge_detail_model = new view_bridge_detail_model();
    $view_bridge_actual_cost = new view_bridge_actual_cost();
    $this->fiscal_year_model = $fiscal_year_model;
    $this->cost_components_model = $cost_components_model;
    $this->district_name_model = $district_name_model;
    $this->view_bridge_detail_model = $view_bridge_detail_model;
    $this->view_bridge_actual_cost = $view_bridge_actual_cost;
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
    $selProvince = @$this->request->getVar('province'); // province 
    $page = @$this->request->getVar('page');
    $data['blnMM'] = $stat;
    $data['title'] = "Overall";
    $data['dataStart'] = $dataStart;
    $data['dateEnd'] = $dateEnd;
    $data['selProvince'] = $selProvince;

    $data['arrPrintList'] = array();
    $data['arrCostList'] = array();

    $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->asObject()->first();
    $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->asObject()->first();


    if ($Postback == 'Back')
    {
        redirect(site_url());
    } elseif ($dataStart <= $dateEnd)
    {
        if ($dataStart != 0 || $dateEnd != 0)
        {
            $data['arrCostCompList'] = $this->cost_components_model->asObject()->findAll();
            $arrPrintList = array();
            $arrCostList = array();

            if(trim($selProvince) != '') {
                $data['arrDevList'] = $this->district_name_model->where('dist01state',$selProvince)->findAll();
            } else {
                $data['arrDevList']= $this->district_name_model->asObject()->findAll();
            }
                        
            $arrChild1=null;
            if (empty($stat))
            {
                // $this->view_brigde_detail_model->where('bri03construction_type',
                // ENUM_NEW_CONSTRUCTION);
                $ctype = ENUM_NEW_CONSTRUCTION;
            } else
            {
                // $this->view_brigde_detail_model->where('bri03construction_type',
                // ENUM_MAJOR_MAINTENANCE);
                $ctype = ENUM_MAJOR_MAINTENANCE;
            }

            //$this->view_brigde_detail_model->dbFilterCompleted();
            /*$arrBridgeList = $this->view_brigde_detail_model->
                where('bri03project_fiscal_year >=', $dataStart)->
                where('bri03project_fiscal_year <=', $dateEnd)->
                findAll();*/
            if(trim($selProvince) != '') {
                // $this->view_brigde_detail_model->
                //     where('dist01state =', $selProvince);
                $arrBridgeList = $this->view_bridge_detail_model->getbridgesbyProv($dataStart, $dateEnd, '', $ctype, 'asObject', $selProvince, 'dist01state');
            } else {
                $arrBridgeList = $this->view_bridge_detail_model->getbridgesbyProv($dataStart, $dateEnd, '', $ctype, 'asObject', '', 'dist01state', $page);
            }
            // $arrBridgeList = $this->view_brigde_detail_model->
            // where('bri05bridge_completion_fiscalyear =', $dateEnd)->
            // orderBy('dist01state')->
            // asObject()->
            // findAll();

            
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

                    $arrBridgeCostList = $this->view_bridge_actual_cost->
                    whereIn('bri08bridge_no', $arrBridgeIdList)->
                    asObject()->
                    findAll();

                    //echo "<pre>"; var_dump($arrBridgeCostList);exit;
                    
                    foreach ($arrBridgeCostList as $x2)
                    {
                        $arrCostList['bri_'.$x2->bri08bridge_no]['id_' . $x2->bri08cmp01id] = $x2;
                    }

                }

                $data['arrPrintList'] = $arrPrintList;
                $data['arrCostList'] = $arrCostList;

            }
            
                //print_r($arrPrintList);
        } else
        {
            redirect("reports/Act_Dev_FYWise/".$stat);
        }
    } else
    {
        'start date is Smaller than End Date';
    }
    return view('\Modules\Reports\Views\Act_Dev_FYWise_report', $data);
  }

  public function loadMore($page = '')
  {
    $dataStart = @$this->request->getVar('start_year');
    $dateEnd = @$this->request->getVar('end_year');
    $bri03municipality = @$this->request->getVar('bri03municipality');
    $selProvince = @$this->request->getVar('province'); // province 
    $page = @$this->request->getVar('page');
    $data['blnMM'] = $stat;
    $data['title'] = "Overall";
    $data['dataStart'] = $dataStart;
    $data['dateEnd'] = $dateEnd;
    $data['selProvince'] = $selProvince;

    $data['arrPrintList'] = array();
    $data['arrCostList'] = array();

    $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->asObject()->first();
    $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->asObject()->first();


    if ($dataStart <= $dateEnd)
    {
        if ($dataStart != 0 || $dateEnd != 0)
        {
            $data['arrCostCompList'] = $this->cost_components_model->asObject()->findAll();
            $arrPrintList = array();
            $arrCostList = array();

            if(trim($selProvince) != '') {
                $data['arrDevList'] = $this->district_name_model->where('dist01state',$selProvince)->findAll();
            } else {
                $data['arrDevList']= $this->district_name_model->asObject()->findAll();
            }
                        
            $arrChild1=null;
            if (empty($stat))
            {
                
                $ctype = ENUM_NEW_CONSTRUCTION;
            } else
            {
                
                $ctype = ENUM_MAJOR_MAINTENANCE;
            }

          
            if(trim($selProvince) != '') {
                
                $arrBridgeList = $this->view_bridge_detail_model->getbridgesbyProv($dataStart, $dateEnd, '', $ctype, 'asObject', $selProvince, 'dist01state');
            } else {
                $arrBridgeList = $this->view_bridge_detail_model->getbridgesbyProv($dataStart, $dateEnd, '', $ctype, 'asObject', '', 'dist01state', $page);
            }
            
            
            $arrBridgeIdList = null;
            if(is_array( $arrBridgeList )){
                foreach ($arrBridgeList as $k2 => $v2)
                {
                    //print_r($v2);exit;
                    $arrChild2=null;
                    $arrBridgeIdList[] = $v2->bri03bridge_no;
                   

                    $arrPrintList['dev_'.$v2->dist01state]['info']=$v2;
                    $arrPrintList['dev_'.$v2->dist01state]['arrChildList']['dist_'.$v2->dist01id]['info']=$v2;
                    $arrPrintList['dev_'.$v2->dist01state]['arrChildList']['dist_'.$v2->dist01id]['arrChildList'][] = array('info'=>$v2);

                    $arrBridgeCostList = $this->view_bridge_actual_cost->
                    whereIn('bri08bridge_no', $arrBridgeIdList)->
                    asObject()->
                    findAll();
                    
                    foreach ($arrBridgeCostList as $x2)
                    {
                        $arrCostList['bri_'.$x2->bri08bridge_no]['id_' . $x2->bri08cmp01id] = $x2;
                    }

                }


               
        $i = 1;
        if(is_array($arrPrintList)){
            foreach($arrPrintList as $dataRow){
                if( isset($dataRow['info']) ){
        
            $str = '<tr>
                <td colspan="22">
                    <div class="row">
                        <div class="col-lg-6">
                            <b><span>State:'.$dataRow["info"]->province_name.'</span></b>
                        </div>
                    </div>
                </td>
            </tr>';
                if (is_array($dataRow['arrChildList']))
                {
                    foreach ($dataRow['arrChildList'] as $dataRow2)
                    {
                $str .='<tbody class="distRegion_'.$dataRow2["info"]->dist01id.'">
                    <tr>
                        <td colspan="22">
                            <div class="row">
                            <div class="col-lg-6">
                                    <b><span>District:'.$dataRow2["info"]->dist01name.'</span></b>
                                </div>
                                <div class="col-lg-6">
                                </div>
                            </div>    
                        </td>
                    </tr>';
                        $i = 1;
                        foreach ($dataRow2['arrChildList'] as $dataRow1)
                        {
                        $str .='<tr class="row'.$i.'">
                                <td class="center" style="width:40px;">'.$i.'</td>
                                <td class="center">'.$dataRow1["info"]->bri03bridge_no.'</td>
                                <td class="center">'.$dataRow1["info"]->bri03bridge_name.'</td>
                                <td class="center">'.$dataRow1["info"]->bri01bridge_type_code.'</td>
                                <td class="center spw_bri_'.$dataRow1["info"]->bri03id.'. spw">'.$dataRow1["info"]->bri03e_span.'</td>
                                <td class="center">'.$dataRow1["info"]->bri03river_name.'</td>
                                <td class="center">'.$dataRow1["info"]->wad01walkway_deck_type_name.'</td>
                                <td class="center">'.$dataRow1["info"]->wal01walkway_width.'</td>';
                                foreach ($arrCostCompList as $dataRow5)
                                {
                                $str .='<td class="center costAmt bri_'.$dataRow1["info"]->bri03id.' col'.$dataRow5->cmp01id.'">';
                                if(isset($arrCostList['bri_'.$dataRow1["info"]->bri03bridge_no][ 'id_' . $dataRow5->cmp01id ])) {
                                    $str .=$arrCostList['bri_'.$dataRow1["info"]->bri03bridge_no][ 'id_' . $dataRow5->cmp01id ]->totalAmt;
                                } else {
                                    $str .= '0';
                                }
                                
                                $str .='</td>';
                            
                                }
                            
                            $str .'<td class="center est">
                                <label class="sumCalc colSumCostAmt" data-sum=".row'.$i.'.bri_'.$dataRow1["info"]->bri03id.'.costAmt">0.00</label>
                             </td>
                            <td class="center est_per divCalc" data-numerator=".row'.$i.' .colSumCostAmt" data-denominator=".row'.$i.' .spw_bri_'.$dataRow1["info"]->bri03id.'"><label>0.00</label></td>
                            </tr>';
                        
                        $i++;
                        }
                        
                         $str .='<tr>
                                <td colspan="4" class="center">Total span and cost per </td>
                                <td class="center sumCalc summeryspan" data-sum=".distRegion_'.$dataRow2["info"]->dist01id.' .spw">0</td>
                                <td colspan="3" class="center"></td>';

        foreach ($arrCostCompList as $dataRow5)
        {


                $str .= '<td class="center sumCalc total_'.$dataRow5->cmp01id.' totalspan" data-sum=".distRegion_'.$dataRow2["info"]->dist01id.' .col'.$dataRow5->cmp01id.'">0</td>';
                                

        }


            $str .='<td class="center sumCalc summerytotal" data-sum=".distRegion_'.$dataRow2["info"]->dist01id.' .colSumCostAmt"></td> 
                                <td>&nbsp;</td> 
                                <input type="hidden" class="cntCalc totalcnt" data-cnt=".distRegion_'.$dataRow2["info"]->dist01id.' .spw"/>
                                                                                          
                            </tr>
                            <tr>
                                <td colspan="4" class="center">Average span and cost per span</td>
                                <td class="center divCalc grsspan" data-numerator=".distRegion_'.$dataRow2["info"]->dist01id.' .summeryspan" data-denominator=".distRegion_'.$dataRow2["info"]->dist01id.' .totalcnt" >0</td>
                                <td colspan="3" class="center"></td>';
                                                            

        foreach ($arrCostCompList as $dataRow5)
        {


                                $str .='<td class="center divCalc grstotal" data-numerator=".distRegion_'.$dataRow2["info"]->dist01id.' .totalspan.total_'.$dataRow5->cmp01id.'" data-denominator=".distRegion_'.$dataRow2["info"]->dist01id.' .summeryspan">0</td>';

        }


                                 $str .='<td>&nbsp;</td> 
                                <td class="center sumCalc " data-sum=".distRegion_'.$dataRow2["info"]->dist01id.' .grstotal"></td></tr></tbody>';

    } //dist for each close

} //dist if close


                        }//if isset close
                        
                        }//printlist for each close
                        }//printlist if close
                        $j = $i-1;
                         $str .='<tr><td colspan="22"><input type="hidden" name="totbridges" id="totbridges" value="'.$j.'" /><input type="hidden" name="actype" id="actype" value="ac" /></td></tr>';

            }

        } 
    }
    //echo $str;exit;
    return $str;
  }
}