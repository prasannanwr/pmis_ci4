<?php
$Postback = @$this->input->post('submit');
            $dataStart = @$this->input->post('start_date');
            $dateEnd = @$this->input->post('end_date');
            $data['blnMM'] = $stat;
             
            $this->load->model('view/view_brigde_detail_model');
            $this->load->model('view/view_district_reg_office_model');
            $this->load->model('view/view_brigde_detail_model');
             $data['startdate'] = $dataStart;
            $data['enddate'] = $dateEnd;
             if($Postback =='Back'){
                  redirect(site_url());     
                }
             elseif( $dataStart <= $dateEnd){
                 if($dataStart!= 0 || $dateEnd != 0 ){

                $selDist=$this->view_district_reg_office_model->findAll();
                
                $arrPrintList = array();
                if(is_array( $selDist)){
                        foreach( $selDist as $k=>$v){
                            $rr=$v->dist01id;
                   if (empty($stat))
                        {
                            $this->view_brigde_detail_model->where('bri03construction_type',
                                ENUM_NEW_CONSTRUCTION);
                        } else
                        {
                            $this->view_brigde_detail_model->where('bri03construction_type',
                                ENUM_MAJOR_MAINTENANCE);
                        }
                    // $this->view_brigde_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=',$dateEnd );
                    //  $dist= $this->view_brigde_detail_model->where('dist01id',$rr)->findAll();

                        //uddated query
                      $this->view_brigde_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=',$dateEnd );
                      $this->view_brigde_detail_model->where('bri05bridge_complete_check', 1)->where('bri05bridge_completion_fiscalyear_check', 1);
                      $dist= $this->view_brigde_detail_model->where('dist01id',$rr)->findAll();
                                    
                            
                            
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
                }else{
                    redirect("reports/Gen_Overall_DateWise/".$stat);   
                }
              }else{
                'start date is Smaller than End Date';
              }
            $this->template->print_template($data); 
 
?>