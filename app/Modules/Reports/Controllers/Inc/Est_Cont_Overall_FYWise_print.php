<?php
        $Postback = @$this->input->post('submit');
        $dataStart = @$this->input->post('start_year');
        $dateEnd = @$this->input->post('end_year');
        $data['blnMM'] = $stat;
 
          $this->load->model('fiscal_year/fiscal_year_model');
          $this->load->model('view/view_brigde_detail_model');
        $this->load->model('district_name/district_name_model');
        $this->load->model('development_region/development_region_model');
        $this->load->model('view/view_district_model');
        $this->load->model('view/view_regional_office_model');
        $this->load->model('view/view_brigde_detail_model');
        $this->load->model('view/stored_procedure');
        $this->load->model('view/view_all_views_model');
        $this->load->model('view/view_all_actual_view_model');
        $this->load->model('cost_components/cost_components_model');
        $this->load->model('supporting_agencies/supporting_agencies_model');
    
        $data['startyear'] = $this->fiscal_year_model->where('fis01id', $dataStart)->dbGetRecord();
        $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->dbGetRecord();

        $data['arrDistList'] = $this->fiscal_year_model->findAll();
       if ($Postback == 'Back')
        {
            redirect(site_url());
        } elseif ($dataStart <= $dateEnd)
        {
            if ($dataStart != 0 || $dateEnd != 0)
            {
                 $data['arrCostSuppList'] = $this->supporting_agencies_model->findAll();
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

                $arrBridgeList = $this->view_brigde_detail_model->
                    where('bri03project_fiscal_year >=', $dataStart)->
                    where('bri03project_fiscal_year <=', $dateEnd)->
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
                    whereIn('bri07bridge_no', $arrBridgeIdList)->view_bridge_estimated_supporting_cost();
                    
                foreach ($arrBridgeCostList as $x2)
                {
                    $arrCostList['bri_'.$x2->bri07bridge_no]['id_' . $x2->bri07sup01id] = $x2;
                }
                       
                
                $data['arrPrintList'] = $arrPrintList;
                $data['arrCostList'] = $arrCostList;
                 //print_r($arrPrintList);
            } else
            {
                redirect("reports/Est_Cont_Overall_FYWise/".$stat);
            }
        } else
        {
            'start date is Smaller than End Date';
        }
        $this->template->print_template($data);
?>