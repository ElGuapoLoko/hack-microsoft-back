<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
    }

    public function login(Request $request)
    {
        $verify = User::query()
            ->where('email', '=', $request['email'])
            ->first();

        if (isset($verify) && Hash::check($request['password'], $verify['password'])) {
            unset($verify['password']);
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
        try {
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
            $user->phone = $request['phone'];
            $user->email = $request['email'];
            $user->password = Hash::make($request['password']);
            $user->save();

            return [
                'message' => 'Usuário cadastrado com sucesso',
                'status' => 'success'
            ];
        } catch (\Exception $e) {
            return $e;
        }


    }

}
