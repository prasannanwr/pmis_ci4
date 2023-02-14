<?php

namespace App\Modules\User\Controllers;

use App\Controllers\BaseController;
use App\Modules\auth\Models\sel_district_model;
use App\Modules\User\Models\UserModel;

class User extends BaseController
{
    private $model;
    private $sel_district_model;

    public function __construct()
    {
        helper(['form']);
        $model = new UserModel();
        $sel_district_model = new sel_district_model();
        $this->model = $model;
        $this->sel_district_model = $sel_district_model;
    }
    public function index()
    {
        //helper(['form']);
    }

    public function login()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Email or Password don't match",
                ],
            ];

            if (!$this->validate($rules, $errors)) {

                return view('\Modules\User\Views\login', [
                    "validation" => $this->validator,
                ]);

            } else {
                //$model = new UserModel();

                $user = $this->model->where('email', $this->request->getVar('email'))
                    ->first();
                // Store session values
                $this->setUserSession($user);
                // Redirecting to dashboard after login
                return redirect()->to(base_url('dashboard'));

            }
        }
        return view('\Modules\User\Views\login');
    }

    private function setUserSession($user)
    {
        $data = [
            // 'id' => $user['id'],
            'user_id' => $user['id'],
            'name' => $user['username'],
            'email' => $user['email'],
            'user_rights' => $user['user_rights'],
            'isLoggedIn' => true,
            'type' => $user['user_rights'],
            'dist_id' => $user['dist_id'],
            'palika_id' => $user['palika_id']
        ];

        session()->set($data);
        return true;
    }

    public function register($id = '')
    {
        $data = [];

        //$data['arrDist'] = $this->objDist->findAll();
        //$data['arrRights'] = array(1=>'Guest', 2=>'Editor', 3=>'Admin', 4=>'Manager', 5=>'Super Admin');
        $data['arrRights'] = array(6=>'Guest', 4=>'Central Operator', 5=>'Regional Operator', 1=>'Admin', 2=>'Central Manager', 3=>'Regional Manager', 1=>'Super Admin');
        $data['arrData'] = '';
        $data['arrPalika'] = '';

        if( $id != '')
        {
            $arrData = $this->model->where('id',$id)->first();
            // $arrData['palikaList'] = explode(',', $arrData['palika_id']);
            // $data['arrPalika'] = $this->getPalikaList($arrData['dist_id']);
            // $arrData['distList'] = explode(',', $arrData['dist_id']);
            $data['arrData'] = $arrData;
        }

        if ($this->request->getMethod() == 'post') {
            if ($this->request->getPost('submit') == 'Cancel') {
                //echo site_url('user/user_management');
                return redirect()->to(site_url('user/list'));
            }
            //let's do the validation here
            $rules = [
                'name' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[tbl_users.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                return view('\Modules\User\Views\register', $data);
            } else {
                //$model = new UserModel();
                //
                // $arrDist = $this->request->getVar('district');
                // $arrDist = is_array( $arrDist )? implode(',', $arrDist): $arrDist;

                // $arrPalika = $this->request->getVar('palika');
                // $arrPalika = is_array( $arrPalika )? implode(',', $arrPalika): $arrPalika;

                if( $id != '')
                {
                    $newData = [
                        'name' => $this->request->getVar('name'),
                        'username' => $this->request->getVar('email'),
                        'email' => $this->request->getVar('email'),
                        'user_rights' => $this->request->getVar('type'),
                        //'dist_id' => $this->request->getVar('district_auth')
                        // 'palika_id' => $arrPalika,
                    ];
                } else {
                    $newData = [
                        'name' => $this->request->getVar('name'),
                        'username' => $this->request->getVar('email'),
                        'email' => $this->request->getVar('email'),
                        'password' => $this->request->getVar('password'),
                        'status' => 1,
                        'user_rights' => $this->request->getVar('type'),
                        //'dist_id' => $this->request->getVar('district_auth')
                        // 'palika_id' => $arrPalika,
                    ];
                }
                //var_dump($newData);exit;
                $this->model->save($newData);
                $newid = $this->model->getInsertID();
  
                $arrDist = $this->request->getVar('district_auth' );
                if(isset($arrDist)){
                    foreach($arrDist as $k => $v ){
                        $this->sel_district_model->insert(array('user02dist01id'=>$v, 'user02userid'=> $newid));
                    }
                    //die;
                }
                $session = session();
                $session->setFlashdata('message', 'New User added successfully');
                //$session->setFlashdata('message_type','success');
                return redirect()->to(base_url('user/list'));
            }
        }
        return view('\Modules\User\Views\register', $data);
    }

    public function edit($id = '')
    {
        $data = [];
        $db = \Config\Database::connect();
        //$data['arrDist'] = $this->objDist->findAll();
        //$data['arrRights'] = array(1=>'Guest', 2=>'Editor', 3=>'Admin', 4=>'Manager', 5=>'Super Admin');
        $data['arrRights'] = array(6=>'Guest', 4=>'Central Operator', 5=>'Regional Operator', 1=>'Admin', 2=>'Central Manager', 3=>'Regional Manager', 1=>'Super Admin');
        $data['arrData'] = '';
        $data['arrPalika'] = '';

        if( $id != '')
        {
            $arrData = $this->model->where('id',$id)->first();
            $data['arrData'] = $arrData;
            // $arrData['palikaList'] = explode(',', $arrData['palika_id']);
            // $data['arrPalika'] = $this->getPalikaList($arrData['dist_id']);
            // $arrData['distList'] = explode(',', $arrData['dist_id']);
            //$arrData['distList'] = $this->sel_district_model->where('user02userid', $id)->findAll();
            $sql = "select a.*,b.`dist01id`,b.`dist01name` from `user02sel_dist` a LEFT JOIN `dist01district` b ON (a.`user02dist01id`= b.`dist01id`) WHERE a.`user02userid` = '$id'";
            
            $query = $db->query($sql);
            $data['distList'] = $query->getResult();

            if ($this->request->getMethod() == 'post') {
                if ($this->request->getPost('submit') == 'Cancel') {
                    //echo site_url('user/user_management');
                    return redirect()->to(site_url('user/list'));
                }
                //let's do the validation here
                $rules = [
                    'name' => 'required|min_length[3]|max_length[20]',
                    'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[tbl_users.email]',
                ];

                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                    return view('\Modules\User\Views\edit', $data);
                } else {
                    //$model = new UserModel();
                    //
                    // $arrDist = $this->request->getVar('district');
                    // $arrDist = is_array( $arrDist )? implode(',', $arrDist): $arrDist;

                    // $arrPalika = $this->request->getVar('palika');
                    // $arrPalika = is_array( $arrPalika )? implode(',', $arrPalika): $arrPalika;

                    if( $id != '')
                    {
                        $data = [
                            'id' => $id,
                            'name' => $this->request->getVar('name'),
                            'username' => $this->request->getVar('email'),
                            'email' => $this->request->getVar('email'),
                            'user_rights' => $this->request->getVar('type'),
                            //'dist_id' => $this->request->getVar('district_auth')
                            // 'palika_id' => $arrPalika,
                        ];
                    } 
                    //var_dump($newData);exit;
                    $this->model->save($data);
                    //$newid = $this->model->getInsertID();
      
                    $arrDist = $this->request->getVar('district_auth' );
                    if(isset($arrDist)){
                        foreach($arrDist as $k => $v ){
                            $this->sel_district_model->insert(array('user02dist01id'=>$v, 'user02userid'=> $id));
                        }
                        //die;
                    }
                    $session = session();
                    $session->setFlashdata('message', 'New User added successfully');
                    //$session->setFlashdata('message_type','success');
                    return redirect()->to(base_url('user/list'));
                }
            }
            return view('\Modules\User\Views\edit', $data);
        }else {
            return redirect()->to(base_url('user/list'));
        } 
    }

    public function profile()
    {

        $data = [];
        //$model = new UserModel();

        $data['users'] = $this->model->where('id', session()->get('user_id'))->first();
        return view('\Modules\User\Views\profile', $data);
    }

    public function change_password()
    {
        $session = session();
        $data = [];
        $data['user'] = $this->model->where('id', session()->get('user_id'))->first();

        $data['min_password_length'] = 6;
			$data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$data['new_password'] = array(
				'name' => 'new',
				'id'   => 'new',
				'type' => 'password',
				'pattern' => '^.{'.$data['min_password_length'].'}.*$',
			);
			$data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id'   => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{'.$data['min_password_length'].'}.*$',
			);
			$data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $data['user']['id'],
			);
        
            //if post
		if ($this->request->getMethod() == 'post') {

            if ($this->request->getVar('submit') == 'Cancel') {
                //die("cancel");
                return redirect()->to('dashboard');
            }
			//check if the form is submitted or not bri03project_fiscal_year
			$rules = [
				'old' => 'required',
				'new' => 'required',
				'new_confirm' => 'required'
			];

		if (!$this->validate($rules)) {
			$data['validation'] = $this->validator;
			return view('\Modules\user\list'. DIRECTORY_SEPARATOR .__FUNCTION__, $data);
		} else {
            if($this->request->getVar('new') != $this->request->getVar('new_confirm')) {
                
                $session->setFlashdata('message', 'Password mismatch');
                //return redirect()->to('user/change_password');
            }
                    $newData = [
                        'id' => $data['user']['id'],
                        'password' => $this->request->getVar('new')
                    ];
                
                //var_dump($newData);exit;
                $this->model->save($newData);
                $session->setFlashdata('message', 'Password updated successfully');
                return redirect()->to('user/change_password');
        }
    }
        return view('\Modules\User\Views\change_password', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('user/login');
    }

    public function list()
    {
        $data = array();
        $data['arrRights'] = array(6=>'Guest', 4=>'Central Operator', 5=>'Regional Operator', 1=>'Admin', 2=>'Central Manager', 3=>'Regional Manager', 1=>'Super Admin');
        if(session()->get('user_rights') < ENUM_SUPER_ADMIN)
        {
            return redirect()->to('login');
        }

        if(isset($_POST['Delete']))
        {
            $arrSelID = $this->request->getPost('selId');
            $this->model->whereIn('id', $arrSelID)->delete();
            $session = session();
            $session->setFlashdata('message', 'Selected users deleted');
            return redirect()->to('user/list');
            
        }
        $data['arrUser'] = $this->model->findAll();
        return view('\Modules\User\Views\user_management', $data);

    }

    public function getPalika()
    {
        if($this->request->getVar('distcode')) {
			$distcode = $this->request->getVar('distcode');
            $palika_list = $this->getPalikaList($distcode);
            $str = '';
            foreach( $palika_list as $row): 
                $str .= '<option value="'.$row['hlcit_code'].'">'.$row['vdc_name'].'</option>';
            endforeach;
            if($str == '') {
                $str .= '<option value="">-Select-</option>';
            }
            echo $str;
		} 
    }

    public function getPalikaList($distcode)
    {
        if($distcode != '') {
            $arrData = $this->objVdc;
            if( is_array( $distcode)){
                if(count($distcode) > 1) {
                    $arrData->whereIn('dist_code', implode(',', $distcode));
                } else {
                    $arrData->where('dist_code', $distcode[0]);
                }
            } 
            //$arrData->like('vdc_name', 'Na Pa')->like('vdc_name', 'Ga Pa');
            $arrPalika = $arrData->findAll();
            //echo $arrData->getLastQuery();exit;
            return $arrPalika;
        }
    }

}
    