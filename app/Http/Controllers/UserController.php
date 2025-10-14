<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Service\UserService;
use App\Traits\Traits;
use Exception;

class UserController extends Controller
{

    use Traits;

    private $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $user = $this->service->createUser($request->only(['email', 'password', 'name']));

            if(is_array($user))
            {
                return $this->errorsMessage($user, 'Requisição invalida', 400);
            }

            return $this->messageResponse('Usuario criado com sucessso.', 200,  new UserResource($user));

        }catch(Exception $e)
        {
            return $this->errorsMessage($e, 'Ocorreu um error ao processar a requisição', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
       return User::find($user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
