<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ajuste;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return view('web.dashboard');
        }else{
            return redirect()->route('web.login');
        }
    }


    public function carrito()
    {
        return view('web.carrito');
    }


    public function login()
    {
        $ajuste = Ajuste::first();
        return view('web.login', compact('ajuste'));
    }


    public function autenticacion(Request $request)
    {
        //return response()->json($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        $credenciales = $request->only('email', 'password');

        if(Auth::attempt($credenciales)){
            return redirect()->intended(route('web.dashboard'));
        }else{
            return redirect()->route('web.login')->with('mensaje', 'Credenciales incorrectas')->with('icono', 'error');
        }
    }

     public function registro()
    {
        $ajuste = Ajuste::first();
        return view('web.registro', compact('ajuste'));
    }
     public function crear_cuenta(Request $request)
    {
        //return response()->json($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->assignRole('CLIENTE');

        //iniciar sesion automaticamente despues de crear la cuenta
        Auth::login($user);

        return redirect()->route('web.dashboard');

    }
}
