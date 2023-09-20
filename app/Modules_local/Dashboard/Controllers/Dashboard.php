<?php

namespace App\Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use App\Modules\User\Models\UserModel;

class Dashboard extends BaseController
{
    private $model;

    public function __construct()
    {
        $model = new UserModel();
        $this->model = $model;
    }
    
    public function index()
    {
        // echo "<pre>";
        // var_dump(session()->get('user_id'));exit;
        $data['title'] = 'Dashboard';
        return view('\Modules\Dashboard\Views\Index', $data);
    }

}
    