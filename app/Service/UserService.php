<?php

namespace App\Service;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function createUser($data)
    {
       $validator =  Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'string|min:3'
        ], [
            'email.required' => 'O email é obrigatorio',
            'email.unique' => 'O email já está cadastrado',
            'email.email' => 'O formato do email é invalido',
            'passoword.min' => 'A senha deve ter no minimo 3 caracteres',
            'name.required' => 'O nome é obrigatorio'
        ]);

        if($validator->fails())
        {
            return $validator->errors()->toArray();
        }

        $validated = $validator->validated();


        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'name' => $validated['name']
        ]);
        return $user;


    }
}
