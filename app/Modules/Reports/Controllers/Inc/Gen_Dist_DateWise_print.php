<?php
            
      $Postback = @$this->input->post('submit');
            $dataStart = @$this->input->post('start_date');
            $dateEnd = @$this->input->post('end_date');
            $data['blnMM'] = $stat;
           
            $this->load->model('district_name/district_name_model');
           $this->load->model('view/view_district_reg_office_model');
            $this->load->model('regional_office/regional_office_model');
             $this->load->model('development_region/development_region_model');
            $this->load->model('view/view_brigde_detail_model');
             $data['startdate'] = $dataStart;
            $data['enddate'] = $dateEnd;
             if($Postback =='Back'){
                  redirect(site_url());     
                }
             elseif( $dataStart <= $dateEnd){
                if($dataStart!= 0 || $dateEnd != 0 ){
                    $data['arrDistList'] = $this->view_district_reg_office_model->findAll();
                
                    $arrPrintList = array();
                    if (is_array($data['arrDistList']))
                    {
                        foreach ($data['arrDistList'] as $k => $v)
                        {
                            //var_dump($v);
                            $ddd = $v->dist01id;
                            $row['info'] = $v;

                            $this->view_brigde_detail_model->where('bri05bridge_complete_check', 1)->where('bri05bridge_completion_fiscalyear_check', 1);
                            if (empty($stat))
                                {
                                $row['data'] = $this->view_brigde_detail_model->where('bri03construction_type',
                                ENUM_NEW_CONSTRUCTION)->
                                where('bri05bridge_complete >=', $dataStart)->
                                where('bri05bridge_complete <=', $dateEnd)->
                                where('dist01id', $ddd)->findAll();
                                }else
                                {
                               $row['data'] = $this->view_brigde_detail_model->where('bri03construction_type',
                                ENUM_MAJOR_MAINTENANCE)->
                                where('bri05bridge_complete >=', $dataStart)->
                                where('bri05bridge_complete <=', $dateEnd)->
                                where('dist01id', $ddd)->findAll();
                                }
                            if (is_array($row['data']) && !empty($row['data']))
                            {
                                $arrPrintList[] = $row;
                            }
                        }
                    }
                    $data['arrPrintList'] = $arrPrintList;
                //print_r($data['arrPrintList']);               
                }else{
                    redirect("reports/Gen_Dist_DateWise/".$stat);   
                }
              }else{
                'start date is Smaller than End Date';
              }
            $this->template->print_template($data); 
       
        ?>