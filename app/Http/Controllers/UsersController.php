<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
    }

    public function login(Request $request)
    {
        $verify = User::query()
            ->where('email', '=', $request['email'])
            ->where('password', '=', $request['password'])
            ->first();

        if (isset($verify)) {
            return [
                'message' => 'Usuário logado com sucesso',
                'status' => 'success',
                'data' => json_encode($verify)
            ];
        } else {
            return [
                'message' => 'Email ou senha incorretos, favor tentar novamente',
                'status' => 'error'
            ];
        }

    }

    public function register(Request $request)
    {
        $verify = User::query()->where('email', '=', $request['email'])->first();

        if (isset($verify)) {
            return [
                'message' => 'Esse email já encontra cadastrado na plataforma',
                'status' => 'error'
            ];
        }

        $user = new User();
        $user->name = $request['name'];
        $user->cpf = $request['cpf'];
        $user->telefone = $request['telefone'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->type = $request['selectedType'];
        $user->save();

        return [
            'message' => 'Usuário cadastrado com sucesso',
            'status' => 'success'
        ];

    }

}
