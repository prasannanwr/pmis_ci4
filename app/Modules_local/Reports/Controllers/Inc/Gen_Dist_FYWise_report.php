<?php
        $Postback = @$this->input->post('submit');
            $dataStart = @$this->input->post('start_year');
            $dateEnd = @$this->input->post('end_year');
            $data['blnMM'] = $stat;
             
            $this->load->model('fiscal_year/fiscal_year_model');
            $this->load->model('view/view_brigde_detail_model');
            $this->load->model('view/view_district_reg_office_model');
            $this->load->model('view/view_brigde_detail_model');
            $data['startyear'] =$this->fiscal_year_model->where('fis01id', $dataStart)->dbGetRecord();
            $data['endyear'] = $this->fiscal_year_model->where('fis01id', $dateEnd)->dbGetRecord();
		
               if($Postback =='Back'){
                  redirect(site_url());     
                }
             elseif( $dataStart <= $dateEnd){
                   if($dataStart!= 0 || $dateEnd != 0 ){
 
                    $selDist=$this->view_district_reg_office_model->findAll();					
                    $data['selDist'] = $selDist; 
					
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
							/*echo $dataStart;
							echo "<br>";
							echo $dateEnd;exit;*/
						
						$data['sel_district_filter'] ='';						
                        $this->view_brigde_detail_model->where('bri05bridge_completion_fiscalyear >=', $dataStart)->where('bri05bridge_completion_fiscalyear <=',$dateEnd );
                        $this->view_brigde_detail_model->where('bri05bridge_complete_check', 1)->where('bri05bridge_completion_fiscalyear_check', 1);
						  
						  //$this->view_brigde_detail_model->where('bri05bridge_complete >=', $dataStart)->where('bri05bridge_complete <=', $dateEnd);
						  //$this->view_brigde_detail_model->where('bri05bridge_complete_check', 1)->where('bri05bridge_completion_fiscalyear_check', 1);
						  
						  if($this->input->post("selFilterByDistrict") != '') {
                          $distFilter = $this->input->post("selFilterByDistrict");
                          $this->view_brigde_detail_model->where('dist01id',$distFilter);
                          $data['sel_district_filter'] = $distFilter;
                        }
						  
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
                    redirect("reports/Gen_Dist_FYWise/".$stat);   
                }
              }else{
                'start date is Smaller than End Date';
              }
            $this->template->my_template($data);  
       
        ?>