<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Service\UserService;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Validator;
use Exception;

class UserController extends Controller
{

    use ApiResponse;

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
    public function index() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'name' => 'required|string'
        ], [
            'email.required' => 'o Email é obrigatorio',
            'email.unique' => 'O email já está cadastrado',
            'password.required' => 'A senha é obrigatoria?',
            'name.required' => 'O nome é obrigatorio'
        ]);

        if ($validador->fails()) {
            return $this->errors('Ocorream errors na validação do formulário', 400, $validador->errors()->toArray());
        }

        $validated = $validador->validate();
        try {
            $user = $this->service->createUser($validated);

            return $this->message(
                'Usuario criado com sucesso',
                201,
                new UserResource($user)
            );
        } catch (Exception $e) {
            return $this->errors(
                'Ocorreu um erro na criação do usuario',
                500,
                $e->getMessage()
            );
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
