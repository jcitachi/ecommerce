<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        //
        //$roles = Role::all(); // traer todo
        $roles = Role::paginate(5); //paginar
        return view('admin.roles.index', compact('roles'));
    }


    public function create()
    {
        //
        return view('admin.roles.create');
    }


    public function store(Request $request)
    {
        //return response()->json($request->all());
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name'
        ]);

        $rol = new Role();
        $rol->name = strtoupper($request->name);
        $rol->save();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Rol Registrado Exitosamente')
            ->with('icono', 'success');
    }


    public function show($id)
    {
        $rol = Role::find($id);
        //return response()->json($rol);
        return view('admin.roles.show', compact('rol'));
    }


    public function edit($id)
    {
        //
        $rol = Role::find($id);
        return view('admin.roles.edit', compact('rol'));
    }


    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
        ]);

        $rol = Role::find($id);
        $rol->name = strtoupper($request->name);
        $rol->save();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Rol Actualizado Exitosamente')
            ->with('icono', 'success');
    }

    public function destroy($id)
    {
        //
        $rol = Role::find($id);
        $rol->delete();
        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Rol Eliminado Exitosamente')
            ->with('icono', 'success');
    }
}
