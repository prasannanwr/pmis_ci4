 
 <?php
$Postback = @$this->input->post('submit');
        $dataStart = @$this->input->post('start_date');
        $dateEnd = @$this->input->post('end_date');
        
        $this->load->model('view/view_brigde_detail_model');
        $this->load->model('district_name/district_name_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('view/view_district_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_brigde_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');
         $this->load->model('supporting_agencies/supporting_agencies_model');
 
    
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
                        $arrPrintList['dist_'.$v2->dist01id]['info']=$v2;
                        $arrPrintList['dist_'.$v2->dist01id]['arrChildList'][] = array('info'=>$v2);
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
                redirect("reports/Act_Dist_DateWise/".$stat);
            }
        } else
        {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
        
        ?>