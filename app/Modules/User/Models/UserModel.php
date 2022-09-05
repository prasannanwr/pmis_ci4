<?php

namespace App\Modules\User\Models;

use App\Modules\auth\Models\sel_district_model;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "name",
        "email",
        "password",
        'username',
        'status',
        'user_rights',
        'dist_id',
        'palika_id'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ["beforeInsert"];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function beforeInsert(array $data)
	{
		$data = $this->passwordHash($data);
		return $data;
	}

	protected function passwordHash(array $data)
	{
		if (isset($data['data']['password'])) {
			$data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
		}

		return $data;
	}

    public function getArrPermitedDistList(){
        $sel_district_model = new sel_district_model();

        $arrPermittedDistListFull = $sel_district_model->where('user02userid', session()->get('user_id'))->findAll();
        $arrPermittedDistList = array();
        foreach( $arrPermittedDistListFull as $k=>$v ){
            $arrPermittedDistList[] = $v['user02dist01id'];
        }
        return $arrPermittedDistList;
    }
    public function is_logged_in()
    {
        $user = session()->get('user_id');
        return isset($user);
    }   
    public function getLoggedType()
    {
        $user = session()->get('type');
        //var_dump( $user );
        return $user;
    }   
}
