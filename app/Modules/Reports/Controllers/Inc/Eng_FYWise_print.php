<?php
            $Postback = @$this->input->post('submit');
            $dataStart = @$this->input->post('start_year');
            $dateEnd = @$this->input->post('end_year');
            
            $data['blnMM'] = $stat;
            $this->load->model('view/view_brigde_detail_model');
            $this->load->model('view/view_district_model');
           $this->load->model('view/view_district_reg_office_model');
            $this->load->model('view/view_brigde_detail_model');
              $this->load->model('view/view_brigde_detail_site_assesment_survey_model');
          $this->load->model('view/view_district_tbis_office_model');
           $data['startdate'] = $dataStart;
            $data['enddate'] = $dateEnd;
             if($Postback =='Back'){
                  redirect(site_url());     
                }
             elseif( $dataStart <= $dateEnd){
                if($dataStart!= 0 || $dateEnd != 0 ){
                    $data['arrDistList'] = $this->view_district_tbis_office_model->findAll();
                 $selDist = $data['arrDistList'];
                $arrPrintList = array();

                 //ADoR (Allocatecd District of reponsibity )
                    $this->load->model('district_name/district_name_model');
                    //$this->load->model('sel_district_model');
                    $arrDistList = $this->district_name_model->findAll();
                    $arrDists = array();
                    foreach($arrDistList as $dist) {
                      array_push($arrDists, $dist->dist01id);                      
                    }

                if(is_array( $selDist)){
                        foreach( $selDist as $k=>$v){
                            $rr=$v->dist01id;
                             if (empty($stat))
                                {
                                    $this->view_brigde_detail_site_assesment_survey_model->where('bri03construction_type',
                                        ENUM_NEW_CONSTRUCTION);
                                } else
                                {
                                    $this->view_brigde_detail_site_assesment_survey_model->where('bri03construction_type',
                                        ENUM_MAJOR_MAINTENANCE);
                                }
                            $dist=$this->view_brigde_detail_site_assesment_survey_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=',$dateEnd )->where('dist01id',$rr)->whereIn('dist01id', $arrDists)->findAll();
                             if(is_array($dist) && !empty($dist)){
                                //print header
                                //echo 'header';
                                $row['dist'] = $v;
                                $row['data'] = $dist;
                               $arrPrintList[] = $row;
                            }
                        }
                    }
                    $data['arrPrintList'] = $arrPrintList;
                    //var_dump($arrPrintList);                  
                }else{
                    redirect("reports/Eng_FYWise/".$stat);   
                }
              }else{
                'start date is Smaller than End Date';
              }
            $this->template->print_template($data);
      
       
        ?>