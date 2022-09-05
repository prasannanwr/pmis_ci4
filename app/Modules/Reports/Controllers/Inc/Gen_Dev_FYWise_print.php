<?php
       $Postback = @$this->input->post('submit');
        $dataStart = @$this->input->post('start_year');
        $dateEnd = @$this->input->post('end_year');
        $data['blnMM'] = $stat;
        $this->load->model('fiscal_year/fiscal_year_model');
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
    
        $data['startyear'] =$this->fiscal_year_model->where('fis01id', $dataStart)->dbGetRecord();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->dbGetRecord();
        if ($Postback == 'Back')
        {
            redirect(site_url());
        } elseif ($dataStart <= $dateEnd)
        {
            if ($dataStart != 0 || $dateEnd != 0)
            {
                $data['arrCostCompList'] = $this->cost_components_model->findAll();
                $arrPrintList = array();
                $data['arrDevList']= $this->development_region_model->findAll();
                if (is_array($data['arrDevList'])){
                    
                    foreach ($data['arrDevList'] as $k => $v){
                        $arrChild=null;
                        
                        $arrDistList=$this->view_regional_office_model->where('dev01id', $v->dev01id)->findAll();
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
                            // $this->view_brigde_detail_model->where('bri05bridge_complete_check', 1)->where('bri05bridge_completion_fiscalyear_check', 1);
                            //     $arrBridgeList = $this->view_brigde_detail_model->
                            //         where('bri03project_fiscal_year >=', $dataStart)->
                            //         where('bri03project_fiscal_year <=', $dateEnd)->
                            //         where('dist01id', $v1->dist01id)->
                            //         findAll();
                                    //updated
                                     $this->view_brigde_detail_model->where('bri05bridge_complete_check', 1)->where('bri05bridge_completion_fiscalyear_check', 1);
                                $arrBridgeList = $this->view_brigde_detail_model->
                                    where('bri05bridge_completion_fiscalyear >=', $dataStart)->
                                    where('bri05bridge_completion_fiscalyear <=', $dateEnd)->
                                    where('dist01id', $v1->dist01id)->
                                    findAll();
                                
                                foreach ($arrBridgeList as $k2 => $v2)
                                {
                                    $arrChild2=null;
                                    $arrChild1[] = array('info' => $v2); 
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
                redirect("reports/Gen_Dev_FYWise/".$stat);
            }
            
        } else
        {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
	   
        ?>