<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AjusteController extends Controller
{

    public function index()
    {
        //
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

        return view('admin.ajustes.index', compact('divisas'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Ajuste $ajuste)
    {
        //
    }


    public function edit(Ajuste $ajuste)
    {
        //
    }

    public function update(Request $request, Ajuste $ajuste)
    {
        //
    }


    public function destroy(Ajuste $ajuste)
    {
        //
    }
}
