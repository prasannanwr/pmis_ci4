<?php

namespace App\Modules\fiscal_data\Controllers;

use App\Controllers\BaseController;
use App\Modules\district_name\Models\district_name_model;
use App\Modules\fiscal_data\Models\fiscal_data_model;
use App\Modules\fiscal_year\Models\FiscalYearModel;
use App\Modules\supporting_agencies\Models\supporting_agencies_model;
use App\Modules\view\Models\view_fiscal_data_all_dist_vdc_model;
use App\Modules\view\Models\view_fiscalyear_data_grouping_model;

class Fiscal_data extends BaseController
{
    private $custom_errors = array();
    private static $arrDefData = array();
    protected $model;
    protected $fiscal_year_model;
    protected $view_fiscal_data_all_dist_vdc_model;
    protected $view_fiscalyear_data_grouping_model;
    protected $supporting_agencies_model;
    protected $district_name_model;

    function __construct()
    {
        helper(['form', 'html', 'et_helper']);
        if (count(self::$arrDefData) <= 0) {
            $FName = basename(__FILE__, '.php');
            $fName = strtolower($FName);
            self::$arrDefData = array(
                'title'         => $FName,
                'breadcrumb'    => array(array('text' => $FName, 'link' => $fName)),
                'module'        => $fName,
                'view_file'     => 'index',
            );
        }

        if (session()->get('type') == 6 || session()->get('type') != ENUM_ADMINISTRATOR) {
            redirect('bridge', 'refresh');
        }

        $model = new fiscal_data_model();
        $fiscal_year_model = new FiscalYearModel();
        $view_fiscal_data_all_dist_vdc_model = new view_fiscal_data_all_dist_vdc_model();
        $view_fiscalyear_data_grouping_model = new view_fiscalyear_data_grouping_model();
        $supporting_agencies_model = new supporting_agencies_model();
        $district_name_model = new district_name_model();
        $this->fiscal_year_model = $fiscal_year_model;
        $this->view_fiscal_data_all_dist_vdc_model = $view_fiscal_data_all_dist_vdc_model;
        $this->view_fiscalyear_data_grouping_model = $view_fiscalyear_data_grouping_model;
        $this->supporting_agencies_model = $supporting_agencies_model;
        $this->district_name_model = $district_name_model;
        $this->model = $model;
    }

    function index()
    {
        //var_dump( $this->model );
        $data = self::$arrDefData;

        //$data['fiscalyear']= $this->view_fiscal_data_all_dist_vdc_model->first();
        $data['arrFYList'] = $this->fiscal_year_model->findAll();
        if ($_POST) {
            $fiscalyear = $this->fiscal_year_model->asObject()->where("fis01id", @$this->request->getVar('selFY'))->first();
        } else {
            $fiscalyear = $this->fiscal_year_model->asObject()->orderBy("fis01id", "desc")->limit(1, 0)->first();
        }
        $fis02constype = 0;

        $data['fiscalyear'] = $fiscalyear;
        $data['arrDataList'] = $this->view_fiscal_data_all_dist_vdc_model->findAll();

        $data['selConstruction'] = 0;
        if ($_GET) {
            $data['selConstruction'] = $_GET['selConstruction'];
        }

        // $this->view_fiscal_data_all_dist_vdc_model->where('fis02year',$fiscalyear->fis01year)->findAll()
        // $data['arrViewList']= $this->view_fiscalyear_data_grouping_model->findAll();
        //$data['arrViewList']= $this->view_fiscalyear_data_grouping_model->where('fis02year',$fiscalyear->fis01year)->where('fis02constype', $data['selConstruction'])->findAll();        
        $data['arrViewList'] = $this->view_fiscalyear_data_grouping_model->getfyData($fiscalyear->fis01year, $data['selConstruction']);

        return view('\Modules\fiscal_data\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function form2()
    {
        //var_dump( $this->model );
        $data = self::$arrDefData;

        $data['view_file'] = __FUNCTION__;
        //$data['arrDataList']= $this->model->findAll();
        $this->template->my_template($data);
    }

    function create($emp_id = FALSE, $fye = '', $fc = '')
    {
        // var_dump($_POST);
        //die();     

        $data = self::$arrDefData;
        $data['title'] = 'Fiscal Data.';
        $data['view_file'] = __FUNCTION__;

        $data['arrDataList'] = $this->supporting_agencies_model->asObject()->findAll();

        $data['objOldRec'] = '';
        $data['postURL'] = "fiscal_data/create";

        if ($emp_id !== false) {
            if ($fye == '') {
                $fy = @$this->request->getVar('fis02year');
                // $fy = (!$fy)? '20152016': $fye;
            } else {
                $fy = $fye;
            }

            if ($fc == '') {
                $fc = @$this->request->getVar('fconst');
                // $fy = (!$fy)? '20152016': $fye;
            } else {
                $fc = $fc;
                $data['fc'] = $fc;
            }
            //echo $fy;exit;
            // if($fy == '') {
            //     redirect('fiscal_data');
            // }
            //var_dump( $fy );
            $i = (int) $emp_id;

            //get fiscal data
            //$fiscaldata = $this->model->where('fis02id',$emp_id);           
            if (strlen($emp_id) == 1) {
                $emp_ide = '0' . $emp_id;
            } else {
                $emp_ide = $emp_id;
            }
            $data['arrDistrictList'] = $this->district_name_model->where('dist01code', $emp_ide)->asObject()->first();

            $data['objOldRec'] = $this->model->where('fis02dist01codeid', $emp_id)->where('fis02year', $fy)->where('fis02constype', $fc)->asObject()->findAll();
            //$data['objOldRec'] = $this->model->where('fis02id',$fid)->findAll();

            //$data['objFY']=$this->model->first();
            // $data['objFY']=$this->model->where('fis02year',$fy)->first();            
            $data['fy'] = $fy;
            //var_dump($data['objFY']);
            $data['postURL'] .= '/' . $emp_id;

            //print_r($data['objOldRec']);exit;
            foreach ($data['objOldRec'] as $supData) {
                //var_dump($supData);
                $arrSupdata['sup_' . $supData->fis02sup01id] = $supData;
            }
            $data['arrSupData'] = $arrSupdata;
            //var_dump( $arrSupdata );
        }

        if ($this->request->getMethod() == 'post') {
            if ($this->request->getVar('submit') == 'Cancel') {
                //die("cancel");
                return redirect()->to('fiscal_data/index');
            }
            //check if the form is submitted or not bri03project_fiscal_year
            $rules = [
                'fis02year' => 'required|max_length[15]',
                'fis02dist01codeid' => 'required|max_length[15]'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else // passed validation proceed to post success logic
            {
                // $this->model->where('fis02dist01codeid', $emp_id)->where('fis02year', @$this->request->getVar('fis02year'))->dbDelete();
                $this->model->where('fis02dist01codeid', $emp_id)->where('fis02year', @$this->request->getVar('fis02year'))->where('fis02constype', @$this->request->getVar('fconst'))->delete();

                // build array for the model
                foreach ($data['arrDataList'] as $SupData) {
                    //var_dump($SupData);
                    $supD1 = $_POST['fis02name1_sup' . $SupData->sup01id];
                    $supD2 = $_POST['fis02name2_sup' . $SupData->sup01id];
                    $supD3 = $_POST['fis02name3_sup' . $SupData->sup01id];
                    $supD4 = $_POST['fis02name4_sup' . $SupData->sup01id];
                    $carryover = $_POST['fis02carryover_sup' . $SupData->sup01id];

                    $form_data = array(
                        'fis02dist01codeid' => $emp_id,
                        //'fis02dist01codeid' => @$this->request->getVar('fis02dist01codeid'),
                        'fis02year' => @$this->request->getVar('fis02year'),
                        'fis02name1' => $supD1,
                        'fis02name2' => $supD2,
                        'fis02name3' => $supD3,
                        'fis02name4' => $supD4,
                        'fis02sup01id' => $SupData->sup01id,
                        'fis02carryover' => $carryover,
                        'fis02constype' => $fc
                    );

                    $this->model->save($form_data);
                }

                $session = session();
                $session->setFlashdata('message', 'successfully updated');
                //$session->setFlashdata('message_type','success');
                return redirect()->to(base_url('fiscal_data/index'));
            }
        }
        return view('\Modules\fiscal_data\Views' . DIRECTORY_SEPARATOR . __FUNCTION__, $data);
    }

    function delete()
    {
        //var_dump($_GET);

        $delete_id = $this->input->get('id');
        $this->load->model('fiscal_data_model');
        $this->fiscal_data_model->where('fis02id', $delete_id)->dbDelete();

        $message = 'Selected Data Deleted.';
        session()->setFlashdata('message', $message);


        return redirect()->to(base_url('fiscal_data'));
    }
}
