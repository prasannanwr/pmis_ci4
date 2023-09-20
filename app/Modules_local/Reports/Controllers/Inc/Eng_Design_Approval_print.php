<?php
            $Postback = @$this->input->post('submit');
            $dataStart = @$this->input->post('start_date');
            $dateEnd = @$this->input->post('end_date');
             $data['blnMM'] = $stat;
                $this->load->model('view/view_brigde_detail_site_assesment_survey_model');
                $this->load->model('regional_office/regional_office_model');
                $this->load->model('view/view_district_tbis_office_model');
                $this->load->model('view/view_brigde_detail_model');
                $this->load->model('view/view_district_model');
                $this->load->model('view/view_district_reg_office_model');
                $this->load->model('view/view_brigde_detail_model');
                $this->load->model('view/view_district_new_reg_office_model');
                $this->load->model('district_name/district_name_model');
       
            
          

             $data['startdate'] = $dataStart;
            $data['enddate'] = $dateEnd;
             if($Postback =='Back'){
                  redirect(site_url());     
                }
             elseif( $dataStart <= $dateEnd){
                if($dataStart!= 0 || $dateEnd != 0 ){
                    
                $arrDistList = $this->view_district_new_reg_office_model->findAll();

                    
                     if (is_array($arrDistList))
                    {
                        foreach ($arrDistList as $k => $v)
                        {
                            $data['arrDistrictList']['dist_' . $v->dist01id] = $v;
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
                    
                     //ADoR (Allocatecd District of reponsibity )
                    $this->load->model('district_name/district_name_model');
                    //$this->load->model('sel_district_model');
                    $arrDistList = $this->district_name_model->findAll();
                    $arrDists = array();
                    foreach($arrDistList as $dist) {
                      array_push($arrDists, $dist->dist01id);                      
                    }

                                         
                        $brige_list= $this->view_brigde_detail_site_assesment_survey_model->where('bri03construction_type',$x)->
                        where('bri05bridge_complete >=', $dataStart)->
                        where('bri05bridge_complete <=', $dateEnd)->where('bri05design_approval_check', '1')->
                        whereIn('dist01id', $arrDists)->findAll();
                
                         $arrDataList = array();
                         foreach ($brige_list as $k => $v)
                        
                            {
                                $arrDataList['dist_' . $v->dist01id]['dist'] = $data['arrDistrictList'][ 'dist_' . $v->dist01id ];
                                
                                $arrDataList['dist_' . $v->dist01id]['data'][]=$v;
                            }
                       
                        
                        
                        $data['arrPrintList'] = $arrDataList;
   
                      // print_r($data['arrPrintList']);
                   // die();
                 
                    //var_dump($arrPrintList);                  
                }else{
                    redirect("reports/Eng_Desing_Approval/".$stat);   
                }
              }else{
                'start date is Smaller than End Date';
              }
            $this->template->print_template($data); 
      
       
        ?>