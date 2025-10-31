<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function index(Request $request)
    {
        $buscar = $request->get('buscar');
        $query = Producto::with('categoria'); // 👈 Carga la relación

        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', '%' . $buscar . '%')
                    ->orWhere('codigo', 'like', '%' . $buscar . '%')
                    ->orWhere('descripcion_corta', 'like', '%' . $buscar . '%')
                    ->orWhere('descripcion_larga', 'like', '%' . $buscar . '%');
            });
        }

        $productos = $query->paginate(10);

        return view('admin.productos.index', compact('productos'));
    }


    public function create()
    {
        //
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return response()->json($request->all());
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:productos,codigo',
            'descripcion_corta' => 'required|string|max:255',
            'descripcion_larga' => 'required|string|',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'stock' => 'required|numeric|min:0',
        ]);

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->codigo = $request->codigo;
        $producto->descripcion_corta = $request->descripcion_corta;
        $producto->descripcion_larga = $request->descripcion_larga;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->categoria_id = $request->categoria_id;
        $producto->stock = $request->stock;
        $producto->save();

        return redirect()->route('admin.productos.index')
            ->with('mensaje', 'Producto Registrado exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Carga el producto y su categoría asociada
        $producto = Producto::with('categoria')->findOrFail($id);

        // Envía los datos a la vista
        return view('admin.productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
