<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AjusteController extends Controller
{

    public function index()
    {
        //
        $ajuste = Ajuste::first();

        try {
            // Llamada a la API con timeout de 5 segundos
            $response = Http::timeout(5)->get('https://api.hilariweb.com/divisas');

            if ($response->successful()) {
                // Obtener el JSON como array asociativo
                $divisas = $response->json();
            } else {
                // API respondió pero con error
                $divisas = [];
                session()->flash('error', 'No se pudo obtener la información de divisas.');
            }
        } catch (\Exception $e) {
            // Error de conexión, timeout u otro problema
            $divisas = [];
            session()->flash('error', 'Error al conectarse con la API de divisas: ' . $e->getMessage());
        }

        return view('admin.ajustes.index', compact('divisas', 'ajuste'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //return response()->json($request->all());
        $ajuste = Ajuste::first();

        $rules=[
            'nombre'        => 'required|string|max:100',
            'descripcion'   => 'required|string|max:255',
            'sucursal'      => 'required|string|max:100',
            'direccion'     => 'required|string|max:255',
            'email'         => 'required|email|max:100',
            'telefono'      => 'required|string|max:20',
            'pagina_web'    => 'nullable|url|max:255',
            'divisa'        => 'required|string|max:10',
        ];

        if ($ajuste)
            {
                $rules['logo']          = 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048';
                $rules['imagen_login']  = 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048';
        }else
            {
                $rules['logo']          = 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048';
                $rules['imagen_login']  = 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048';
            }

        $request->validate($rules);

        if(!$ajuste)
        {
            $ajuste = new Ajuste();
        }

        $ajuste->nombre = $request->nombre;
        $ajuste->descripcion = $request->descripcion;
        $ajuste->sucursal = $request->sucursal;
        $ajuste->direccion = $request->direccion;
        $ajuste->email = $request->email;
        $ajuste->telefono = $request->telefono;
        $ajuste->pagina_web = $request->pagina_web;
        $ajuste->divisa = $request->divisa;

        if($request->hasFile('logo')){
            if($ajuste->logo && Storage::disk('public')->exists($ajuste->logo)){
                Storage::disk('public')->delete($ajuste->logo);
            }
            $ajuste->logo = $request->file('logo')->store('logos', 'public');
        }
        if($request->hasFile('imagen_login')){
            if($ajuste->imagen_login && Storage::disk('public')->exists($ajuste->imagen_login)){
                Storage::disk('public')->delete($ajuste->imagen_login);
            }
            $ajuste->imagen_login = $request->file('imagen_login')->store('imagenes_login', 'public');
        }

        $ajuste->save();

        return redirect()->route('admin.ajustes.index')
            ->with('mensaje', 'Configuración creada correctamente')
            ->with('icono', 'success');
    }
}
