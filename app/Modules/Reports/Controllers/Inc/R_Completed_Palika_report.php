<?php
            $data['blnMM'] = $stat;
            $Postback = @$this->input->post('submit');
            $bri03municipality = @$this->input->post('bri03municipality');

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
            $municipality = $this->view_vdc_model->where('muni01id',$bri03municipality)->findAll();
            $data['arrPrintList'] = '';
            $data['municipality'] = $municipality;

            if($bri03municipality ==''){
              redirect(site_url());
            }else{

                $arrDistList = $this->view_district_new_reg_office_model->findAll();

                if (is_array($arrDistList))
                {
                    foreach ($arrDistList as $k => $v)
                    {
                        $data['arrDistrictList']['dist_' . $v->dist01id] = $v;
                        //$data['arrDistrictList']['dist_' . $dataDist] = $v;
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

                $this->view_brigde_detail_site_assesment_survey_model->where('bri03construction_type',$x)->where('bri05bridge_complete_check', '1');
                $brige_list= $this->view_brigde_detail_site_assesment_survey_model->where('left_muni01id',$bri03municipality)->findAll();

                $arrDataList = array();
                foreach ($brige_list as $k => $v)
                {
                   $arrDataList['dist_' . $v->dist01id]['dist'] = $data['arrDistrictList'][ 'dist_' . $v->dist01id ];
                   $arrDataList['dist_' . $v->dist01id]['data'][]=$v;
                }
                $data['arrPrintList'] = $arrDataList;
            }
				 
            //print_r($data['arrPrintList']);
            $this->template->my_template($data);
?>