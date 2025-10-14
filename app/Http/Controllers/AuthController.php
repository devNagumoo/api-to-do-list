<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\AuthService;
use App\Traits\Traits;

use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    private $serviceAuth;
    use Traits;

    public function __construct(AuthService $service)
    {
        $this->serviceAuth = $service;
    }


   public function login(Request $request)
    {
        
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return ['token' => $token];
        
    }
}
