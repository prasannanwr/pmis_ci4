 
 <?php
 $Postback = @$this->input->post('submit');
        $dataStart = @$this->input->post('start_year');
        $dateEnd = @$this->input->post('end_year');
         $data['blnMM'] = $stat;
       $this->load->model('fiscal_year/fiscal_year_model');
        $this->load->model('view/view_brigde_detail_model');
        $this->load->model('bridge/bridge_model');
        $this->load->model('supporting_agencies/supporting_agencies_model');
        $this->load->model('regional_office/regional_office_model');
        $this->load->model('view/view_regional_office_model');
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
                $arrDistList = $this->view_regional_office_model->findAll();
                $arrSupList = $this->supporting_agencies_model->findAll();
                $arrPrintList = array();
                 if (empty($stat))
                        {
                            $this->view_brigde_detail_model->where('bri03construction_type',
                                ENUM_NEW_CONSTRUCTION);
                        } else
                        {
                            $this->view_brigde_detail_model->where('bri03construction_type',
                                ENUM_MAJOR_MAINTENANCE);
                        }
                $data['arrDevList']= $this->view_brigde_detail_model->
                        where('bri03project_fiscal_year >=',$dataStart)->
                       where('bri03project_fiscal_year <=', $dateEnd)->findAll();
                
                
                if (is_array($arrDistList)){
                     foreach ($arrDistList as $k => $v){
                        $data['arrDistrictList']['dist_'.$v->dist01id] = $v;
                     }
                }
                  if (is_array($data['arrDevList'])){
                    foreach ($data['arrDevList'] as $k => $v){
                        $arrChild2=null;
                        
                        
                        $arrBridgeCostList = $this->view_all_actual_view_model->
                            where('bri08bridge_no', $v->bri03bridge_no)->
                            view_bridge_actual_cost();
                        foreach ($arrBridgeCostList as $x2)
                        {
                        
                        $arrChild2['id_' . $x2->bri08cmp01id] = $x2;
                        }
                        
                        
                        $arrChild = array('info' => $v, 'arrChildList' => $arrChild2);
                        $arrPrintList['dist_'.$v->dist01id][] = $arrChild;
                                       
                         
                        }
                    }
               
             // print_r($arrPrintList);
                $data['arrPrintList'] = $arrPrintList;
                
            } else
            {
                redirect("reports/Act_Overall_FYWise/".$stat);
            }
        } else
        {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
        
        ?>