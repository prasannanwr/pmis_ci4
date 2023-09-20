<?php
            $data['blnMM'] = $stat;
            $Postback = @$this->input->post('submit');
            $province = @$this->input->post('province');

            $this->load->model('view/view_brigde_detail_site_assesment_survey_model');
            $this->load->model('regional_office/regional_office_model');
            $this->load->model('view/view_district_tbis_office_model');
            $this->load->model('view/view_brigde_detail_model');
            $this->load->model('view/view_district_model');
            $this->load->model('view/view_district_reg_office_model');
            $this->load->model('view/view_brigde_detail_model');
            $this->load->model('view/view_district_new_reg_office_model');
            $this->load->model('district_name/district_name_model');
			$this->load->model('view/view_brigde_detail_site_assesment_survey_r7_model');
            $this->load->model('view/view_vdc_model');
            $this->load->model('province/province_model');
       
						
             if($province ==''){
                redirect(site_url());
            }else{
                
                $data['arrStateList'] = $this->province_model->where('province_id',$province)->findAll();
                $data['province'] = $province;

                // $arrDistList = $this->view_district_new_reg_office_model->findAll();
                //  if (is_array($arrDistList))
                // {
                //     foreach ($arrDistList as $k => $v)
                //     {
                //         $data['arrDistrictList']['dist_' . $v->dist01id] = $v;
                       
                //      }
                // }
                
                
                //$data['arrDistList'] = $this->view_district_tbis_office_model->findAll();
                
                    if (empty($stat))
                        {                       
                         $x = ENUM_NEW_CONSTRUCTION;
                        } else
                        {
                         $x = ENUM_MAJOR_MAINTENANCE;
                
                    }
                                                         
                    /*$brige_list= $this->view_brigde_detail_site_assesment_survey_model->where('dist01id',$dataDist)->where('bri03construction_type',$x)->
                    where('bri05bridge_complete_check', '0')->findAll();*/


                         $brige_list= $this->view_brigde_detail_site_assesment_survey_r7_model->where('province_id',$province_id)->where('bri03construction_type',$x)->
                        where('bri05bridge_complete_check', '0')->where('bri03work_category !=','3')->findAll();
					
                     $arrDataList = array();
                     foreach ($brige_list as $k => $v)
                    
                        {
                            //var_dump($v);exit;
                             $arrDataList['dist_' . $v->dist01id]['dist'] = $data['arrDistrictList'][ 'dist_' . $v->dist01id ];
                             $arrDataList['dist_' . $v->dist01id]['data'][]=$v;
                        }
                   
                
                    $data['arrPrintList'] = $arrDataList;
             }
             $data['rtype'] = "district";
                  //print_r($data['arrPrintList']);
            $this->template->my_template($data); 
          
          
?>