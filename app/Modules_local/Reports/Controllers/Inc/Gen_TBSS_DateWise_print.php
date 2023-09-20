<?php
        $Postback = @$this->input->post('submit');
        $dataStart = @$this->input->post('start_date');
        $dateEnd = @$this->input->post('end_date');
      
        $data['blnMM'] = $stat;
        $this->load->model('view/view_brigde_detail_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('district_name/district_name_model');
        $this->load->model('regional_office/regional_office_model');
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
                $data['arrDevList']= $this->regional_office_model->findAll();
                if (is_array($data['arrDevList'])){
                    
                    foreach ($data['arrDevList'] as $k => $v){
                        $arrChild=null;
                         
                        $arrDistList=$this->view_regional_office_model->where('tbis01id', $v->tbis01id)->findAll();
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
                            $this->view_brigde_detail_model->dbFilterCompleted();
                                $arrBridgeList = $this->view_brigde_detail_model->
                                    where('bri05bridge_complete >=', $dataStart)->
                                    where('bri05bridge_complete <=', $dateEnd)->
                                    where('dist01id', $v1->dist01id)->
                                    findAll();
                                
                                foreach ($arrBridgeList as $k2 => $v2)
                                {
                                    $arrChild2=null;
                                    
                                   
                                    $arrBridgeCostList = $this->view_all_actual_view_model->
                                        where('bri08bridge_no', $v2->bri03bridge_no)->
                                        view_bridge_actual_cost();
                                   // foreach ($arrBridgeCostList as $x2)
                                    //{
                                        
                                       // $arrChild2['id_' . $x2->bri08cmp01id] = $x2;
                                    //}
                                    
                                   
                                    $arrChild1[] = array('info' => $v2); //, 'arrChildList' => $arrChild2);
                                    //$row['cost'] = $newData;
                                } //bridge list for
                                if($arrChild1){
                                    $arrChild[]=array('info'=>$v1, 'arrChildList'=>$arrChild1);
                                }
                            }
                        }
                        if($arrChild){
                        $arrPrintList[]=array('info'=>$v, 'arrChildList'=>$arrChild);
                        }
                    }
                }
                //print_r($arrPrintList);
                $data['arrPrintList'] = $arrPrintList;
                
            } else
            {
                redirect("reports/Gen_TBSS_DateWise/".$stat);
            }
        } else
        {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
	   
        ?>