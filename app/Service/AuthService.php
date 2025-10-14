<?php

namespace App\Service;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class AuthService
{

    public function validateLogin($data)
    {
        try {
            Validator::make($data, [
                'email' => 'required|email',
                'password' => 'required|min:3'
            ], [
                'email.required' => 'O email é obrigatorio',
                'password.required' => 'A senha é obrigatoria'
            ]);

            return true;

        } catch (ValidationException $e) {
            return ['erros' => $e->errors()];
        }
    }
}
