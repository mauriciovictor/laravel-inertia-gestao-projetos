<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use \Inertia\Response as InertiaResponse;

class UserController
{
    public function index(Request $request): InertiaResponse
    {
        $users = User::all();
        return Inertia::render('Users/List', compact('users'));
    }

    public function create(Request $request)
    {
        return Inertia::render('Users/Form');
    }

    public function edit(Request $request, int $id)
    {
        $user = User::find($id);
        return Inertia::render('Users/Form', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        #validação
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ];

        #verifica se a senha foi alterada
        if (!empty($request->input('password'))) {
            $rules['password'] = 'required|string|min:8|confirmed';
            $rules['password_confirmation'] = 'required|string|min:8';
        }

        #validação
        $request->validate($rules);

        #busca o usuário
        $user = User::find($id);

        #pega os dadoos da request
        $data = $request->except(['password', 'password_confirmation']);

        #verifica se a senha foi alterada e atualiza a senha criptografada
        if (!empty($request->input('password'))) {
            $data['password'] = bcrypt($request->input('password'));
        }

        #atualiza
        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Usuário alterado com sucesso');
    }


    public function store(Request $request)
    {
        #validação
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);

        #salvar
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso');
    }
}
