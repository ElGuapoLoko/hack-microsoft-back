<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {


    }


    public function store(Request $request)
    {

    }


    public function show(Request $request)
    {
        //pegar usuário autenticado e fazer a requisição
        $user = User::query()->with('userGames.game')->first();

        return $user;


    }


    public function update( Request $request)
    {


    }

    public function destroy(Request $request)
    {


    }
}
