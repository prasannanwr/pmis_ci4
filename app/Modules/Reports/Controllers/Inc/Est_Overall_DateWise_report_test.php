<?php 


        
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
            redirect( site_url());
        } elseif ($dataStart <= $dateEnd)
        {
            if ($dataStart != 0 || $dateEnd != 0)
            {
                $data['arrCostCompList'] = $this->cost_components_model->findAll();
                $arrPrintList = array();
                $data['arrDevList']= $this->district_name_model->findAll();
                         
                        $arrDistList=$this->view_regional_office_model->findAll();
                        if(is_array($arrDistList)){
                            
                            foreach( $arrDistList as $k1=>$v1){
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
 
                                $arrBridgeList = $this->view_brigde_detail_model->
                                    where('bri05bridge_complete >=', $dataStart)->
                                    where('bri05bridge_complete <=', $dateEnd)->
                                    where('dist01id', $v1->dist01id)->
                                    findAll();
                                
                                foreach ($arrBridgeList as $k2 => $v2)
                                {
                                    $arrChild2=null;
                                    
                                   
                                    $arrBridgeCostList = $this->view_all_actual_view_model->
                                        where('bri07bridge_no', $v2->bri03bridge_no)->
                                        view_bridge_new_estimated_cost();
                                    foreach ($arrBridgeCostList as $x2)
                                    {
                                        
                                        $arrChild2['id_' . $x2->bri07cmp01id] = $x2;
                                    }
                                    
                                   
                                    $arrChild1[] = array('info' => $v2, 'arrChildList' => $arrChild2);
                                    //$row['cost'] = $newData;
                                } //bridge list for
                                if($arrChild1){
                                    $arrPrintList[]=array('info'=>$v1, 'arrChildList'=>$arrChild1);
                                }
                            }
                        }
                       
                
                $data['arrPrintList'] = $arrPrintList;
                 //print_r($arrPrintList);
            } else
            {
                redirect("reports/Est_Overall_DateWise".$stat);
            }
        } else
        {
            'start date is Smaller than End Date';
        }
        $this->template->my_template($data);
        

?>