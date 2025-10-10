<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use Illuminate\Http\Request;

class AjusteController extends Controller
{

    public function index()
    {
        //
        return view('admin.ajustes.index');
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
