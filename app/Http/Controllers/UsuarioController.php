<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{

    public function index(Request $request)
    {
        $buscar = $request->get('buscar');
        $query = User::whereDoesntHave('roles', function($q){
            $q->where('name', 'SUPER ADMIN');
        })->withTrashed();

        if ($buscar) {
            $query->where('name', 'like', '%' . $buscar . '%')
                ->orWhere('email', 'like', '%' . $buscar . '%');
        }
        $usuarios = $query->paginate(10);
        return view('admin.usuarios.index', compact('usuarios'));
    }


    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }


    public function store(Request $request)
    {
        //return response()->json($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'rol' => 'required',
        ]);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        $usuario->assignRole($request->rol);

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario Registrado Exitosamente')
            ->with('icono', 'success');
    }


    public function show($id)
    {
        $usuario = User::find($id);
        return view('admin.usuarios.show', compact('usuario'));
    }


    public function edit($id)
    {
        $usuario = User::find($id);
        $roles = Role::all();
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }


    public function update(Request $request, $id)
    {
        //return response()->json($request->all());
        $request->validate([
            'rol' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $usuario = User::find($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;

        if ($request->password) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->syncRoles($request->rol);
        $usuario->save();

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario actualizado exitosamente.')
             ->with('icono', 'success');
    }


    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->estado = false;
        $usuario->save();
        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario eliminado exitosamente.')
             ->with('icono', 'success');
    }

    public function restore($id)
    {
        $usuario = User::withTrashed()->find($id);
        $usuario->restore();
        $usuario->estado = true;
        $usuario->save();


        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario restaurado exitosamente.')
             ->with('icono', 'success');
    }
}
