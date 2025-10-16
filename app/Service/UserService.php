<?php

namespace App\Service;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function createUser($data)
    {

        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'name' => $data['name']
        ]);
        
        return $user;


    }
}
