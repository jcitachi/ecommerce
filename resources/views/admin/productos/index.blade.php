@extends('layouts.admin')

@section('page-header')
    <h1>Panel de Productos</h1>
    <p>Bienvenido <b>{{ Auth::user()->name }}</b>, acá se mostrará el contenido de Productos</p>
    <hr class="text-primary w-60 my-4" style="height: 10px; opacity: 1;">
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">
                    <i class="bi bi-box-seam"></i> Listado de Productos
                </h5>
                <a href="{{ route('admin.productos.create') }}" class="btn btn-sm btn-primary rounded-pill shadow-sm">
                    <i class="bi bi-plus-circle"></i> Registrar Nuevo Producto
                </a>
            </div>

            {{-- Buscador --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('admin.productos.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="buscar" class="form-control rounded-pill shadow-sm"
                                placeholder="Buscar producto..." value="{{ request('buscar') }}">
                            <button type="submit" class="btn btn-primary rounded-pill shadow-sm">
                                <i class="bi bi-search"></i> Buscar
                            </button>
                            @if (request('buscar'))
                                <a href="{{ route('admin.productos.index') }}"
                                    class="btn btn-secondary rounded-pill shadow-sm">
                                    <i class="bi bi-trash"></i> Limpiar
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tabla --}}
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-primary text-primary text-center rounded-top-4">
                    <h4 class="mb-0 card-title">
                        <i class="bi bi-box-seam"></i> Productos Registrados
                    </h4>
                    <hr>
                </div>

                <div class="card-body p-4">
                    <div class="table-responsive mt-2">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center">Nro</th>
                                    <th>Categoría</th>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Descripción corta</th>
                                    <th>Precio compra</th>
                                    <th>Precio venta</th>
                                    <th>Stock</th>
                                    <th class="text-center" style="width: 150px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nro = ($productos->currentPage() - 1) * $productos->perPage() + 1;
                                @endphp

                                @foreach ($productos as $producto)
                                    <tr>
                                        <td class="text-center"><b>{{ $nro++ }}</b></td>
                                        <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td> {{-- ->nombre ?? 'Sin categoría' --}}
                                        <td>{{ $producto->nombre }}</td>
                                        <td>{{ $producto->codigo }}</td>
                                        <td>{{ Str::limit($producto->descripcion_corta, 50) }}</td>
                                        <td>{{ $ajuste->divisa. " ".number_format($producto->precio_compra, 2) }}</td>
                                        <td>{{ $ajuste->divisa. " ".number_format($producto->precio_venta, 2) }}</td>
                                        <td>{{ $producto->stock }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.productos.show', $producto->id) }}"
                                                    class="btn btn-sm btn-info text-white">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.productos.imagenes', $producto->id) }}"
                                                    class="btn btn-sm btn-warning text-white">
                                                    <i class="bi bi-card-image"></i>
                                                </a>
                                                <a href="{{ route('admin.productos.edit', $producto) }}"
                                                    class="btn btn-sm btn-success text-white ">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </div>

                                            <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST"
                                                class="d-inline" id="form{{ $producto->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar"
                                                    onclick="confirmarEliminacion{{ $producto->id }}(event)">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>

                                            <script>
                                                function confirmarEliminacion{{ $producto->id }}(e) {
                                                    e.preventDefault();
                                                    Swal.fire({
                                                        title: '¿Desea Eliminar este registro?',
                                                        text: 'no podra recuperar el registro borrado',
                                                        icon: 'question',
                                                        showDenyButton: true,
                                                        confirmButtonText: 'Eliminar',
                                                        confirmButtonColor: '#a5161d',
                                                        denyButtonText: 'Cancelar',
                                                        denyButtonColor: '#270a0a',
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            document.getElementById('form{{ $producto->id }}').submit();
                                                        }
                                                    });
                                                }
                                            </script>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if ($productos->hasPages())
                            <div class="d-flex justify-content-between align-items-center mt-4 px-3">
                                <div class="text-muted">
                                    Mostrando {{ $productos->firstItem() }} a {{ $productos->lastItem() }} de
                                    {{ $productos->total() }} registros
                                </div>
                                {{ $productos->links('pagination::bootstrap-4') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
