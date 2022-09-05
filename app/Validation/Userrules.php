<?php

namespace App\Validation;

use App\Modules\User\Models\UserModel;

class Userrules
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $model = new UserModel();
        $user = $model->where('email', $data['email'])
                      ->first();

        if(!$user)
        return false;

        return password_verify($data['password'], $user['password']);
    }
}
