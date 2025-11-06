<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\ProductoImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{

    public function index(Request $request)
    {
        $ajuste = Ajuste::first();
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

        return view('admin.productos.index', compact('productos', 'ajuste'));
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

    public function imagenes($id)
    {
        $producto = Producto::findOrFail($id);
        return view('admin.productos.imagenes', compact('producto'));
    }

    public function upload_imagen(Request  $request, $id)
    {
       $request->validate([
           'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
       ]);

       $producto = Producto::findOrFail($id);

       $imagenProducto = new ProductoImagen();
       $imagenProducto->producto_id = $producto->id;
       $imagenProducto->imagen = $request->file('imagen')->store('productos', 'public');
       $imagenProducto->save();

       return redirect()->route('admin.productos.imagenes', $producto->id)
           ->with('mensaje', 'Imagen cargada exitosamente.')
           ->with('icono', 'success');
    }

    public function destroy_imagen(Request $request,  $id)
    {
        $imagenProducto = ProductoImagen::findOrFail($id);
        $productoId = $imagenProducto->producto_id;
        if ($imagenProducto->imagen && Storage::disk('public')->exists($imagenProducto->imagen)) {
            Storage::disk('public')->delete($imagenProducto->imagen);
        }

        $imagenProducto->delete();


        return redirect()->route('admin.productos.imagenes', $productoId)
            ->with('mensaje', 'Imagen eliminada exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //return response()->json($request->all());
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:productos,codigo,' . $id,
            'descripcion_corta' => 'required|string|max:255',
            'descripcion_larga' => 'required|string|',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'stock' => 'required|numeric|min:0',
        ]);

        $producto = Producto::findOrFail($id);
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
            ->with('mensaje', 'Producto Actualizado exitosamente.')
            ->with('icono', 'success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $producto = Producto::findOrFail($id);

        // Elimina las imagenes asociadas al producto
        foreach ($producto->imagenes as $imagen) {
            if ($imagen->imagen && Storage::disk('public')->exists($imagen->imagen)) {
                Storage::disk('public')->delete($imagen->imagen);
            }
            $imagen->delete();
        }

        $producto->delete();

        return redirect()->route('admin.productos.index')
            ->with('mensaje', 'Producto Eliminado exitosamente.')
            ->with('icono', 'success');
    }

    public function detalle_producto($id)
    {
        $ajuste = Ajuste::first();
        $producto = Producto::findOrFail($id);
        return view('web.detalle_producto', compact('producto', 'ajuste'));
    }

}
