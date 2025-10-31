@extends('layouts.admin')

@section('page-header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="fw-bold text-primary mb-0">
            <i class="bi bi-eye me-2"></i> Detalle del Producto
            {{-- Botón regresar --}}
        </h1>
        <div>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm px-5 py-2">
                <i class="bi bi-arrow-left-circle"></i> Regresar
            </a>
        </div>
    </div>
    <hr class="text-primary w-50 my-3" style="height: 4px; opacity: 0.9;">
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                {{-- Encabezado --}}
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 text-white">
                        <i class="bi bi-box me-2"></i> Información del Producto: {{ $producto->nombre }}
                    </h5>
                </div>
                {{-- Cuerpo --}}
                <div class="card-body bg-light p-5">
                    <div class="row g-4 mb-4">
                        {{-- Columna izquierda --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <h6 class="text-muted mb-1">Nombre del producto</h6>
                                <p class="fs-5 fw-semibold text-dark">{{ $producto->nombre }}</p>
                            </div>

                            <div class="mb-3">
                                <h6 class="text-muted mb-1">Categoría</h6>
                                <p class="fs-5">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>
                            </div>

                            <div class="mb-3">
                                <h6 class="text-muted mb-1">Código</h6>
                                <p class="fs-5">{{ $producto->codigo }}</p>
                            </div>

                            <div class="mb-3">
                                <h6 class="text-muted mb-1">Stock disponible</h6>
                                <span class="badge bg-success fs-6 px-3 py-2">{{ $producto->stock }}</span>
                            </div>
                        </div>

                        {{-- Centr8 --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <h6 class="text-muted mb-1">Precio compra</h6>
                                <p class="fs-5 text-primary fw-semibold">S/ {{ number_format($producto->precio_compra, 2) }}
                                </p>
                            </div>

                            <div class="mb-3">
                                <h6 class="text-muted mb-1">Precio venta</h6>
                                <p class="fs-5 text-success fw-semibold">S/ {{ number_format($producto->precio_venta, 2) }}
                                </p>
                            </div>

                            <div class="mb-3">
                                <h6 class="text-muted mb-1">Registrado el</h6>
                                <p class="fs-6">{{ $producto->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>

                        {{-- columna derecha --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <h6 class="text-muted mb-2">Descripción corta</h6>
                                <p class="fs-6">{{ $producto->descripcion_corta ?: 'Sin descripción' }}  </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    {{-- Descripciones --}}
                    <div class="row g-4 mt-4">
                        <div class="col-md-12">
                            <h6 class="text-muted mb-2">Descripción larga</h6>
                            <div class="p-3 rounded-3 border bg-body-secondary ck-content" style="min-height: 150px;">
                                {!! $producto->descripcion_larga ?: '<em>Sin descripción detallada</em>' !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                {{-- Encabezado --}}
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 text-white">
                        <i class="bi bi-box me-2"></i> Imagenes del Producto
                    </h5>
                </div>
                {{-- Cuerpo --}}
                <div class="card-body bg-light p-5">


                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <style>
        .ck-content {
            line-height: 1.6;
            font-size: 15px;
        }

        .ck-content h1,
        .ck-content h2,
        .ck-content h3 {
            color: #0d6efd;
            margin-bottom: 0.5rem;
        }

        .ck-content ul,
        .ck-content ol {
            padding-left: 1.5rem;
        }
    </style>
@stop
@section('js')

@stop
