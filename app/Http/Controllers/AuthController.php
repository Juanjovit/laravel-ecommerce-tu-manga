<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function formLogin()
    {
        return view('auth.form-login');
    }

    public function formRegister()
    {
        return view('auth.form-register');
    }

    public function processLogin(Request $request)
    {
      
        $credentials = $request->only(['email', 'password']);


        if(!auth()->attempt($credentials)) {
            return redirect()
                ->route('auth.formLogin')
                ->with('status.message', 'Parece que los datos que ingresaste son incorrectos.')
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()
            ->route('home')
            ->with('status.message', 'Sesion iniciada con exito.');
    }

    public function processLogout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('auth.formLogin')
            ->with('status.message', 'Sesion cerrada con éxito.');
    }



    public function processRegister(Request $request)
    {
    
        $data = $request->except(['_token']);

        $data["password"] = Hash::make($data["password"]);

        $request->validate(User::validationRules(), User::validationMessages());

        User::create($data);


        return redirect()
            ->route('auth.formLogin')
            ->with('status.message', 'Te registraste con exito! Ahora ya podes iniciar sesion!');
    }






    public function editarPassword(int $id)
    {
        $usuario = User::findOrFail($id);

        return view('editarPassword', [
            'usuario' => $usuario
        ]);
    }


    public function processEditarPassword(int $id, Request $request)
    {
    
        $user = User::findOrFail($id);

        $data = $request->except(['_token']);

        $data["password"] = Hash::make($data["password"]);

        $request->validate(User::validationRulesPassword(), User::validationMessagesPassword());

        $user->update($data);


        return redirect()
            ->route('perfil', ['id' => $id])
            ->with('status.message', 'Password editado con exito!');
    }


}