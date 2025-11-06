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
                                <p class="fs-6">{{ $producto->descripcion_corta ?: 'Sin descripción' }} </p>
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
                        <div style="float: right;">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="bi bi-upload"></i> Cargar imagen
                            </button>
                        </div>
                    </h5>
                </div>
                {{-- Cuerpo --}}
                <div class="card-body bg-light p-5">

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cargar imagen del producto</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.productos.upload_imagen', $producto->id) }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="imagen">Imagen del Producto</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-camera"></i></span>
                                                        <input type="file" name="imagen" id="imagen"
                                                            onchange="mostrarimagen(event)"
                                                            class="form-control @error('imagen') is-invalid @enderror"
                                                            accept="image/*" required>
                                                        @error('imagen')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <center>
                                                    <img src="" alt="" id="preview2" class="img-fluid"
                                                        style="max-width: 200px; margin-top:10px">
                                                </center>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                                                    Guardar Imagen</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @forelse ($producto->imagenes as $imagen)
                            <div class="col-md-3" style="margin-bottom: 20px">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $imagen->imagen) }}" alt=""
                                        class="img-fluid">
                                    <div class="text-center">
                                        <form action="{{ route('admin.productos.destroy_imagen', $imagen) }}" method="POST"
                                        class="d-inline" id="form{{ $imagen->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mt-2 text-center" title="Eliminar"
                                            onclick="confirmarEliminacion{{ $imagen->id }}(event)">
                                            <i class="bi bi-trash"></i> Borrar imagen
                                        </button>
                                    </form>

                                    <script>
                                        function confirmarEliminacion{{ $imagen->id }}(e) {
                                            e.preventDefault();
                                            Swal.fire({
                                                title: '¿Desea Eliminar esta Imagen?',
                                                text: 'no podra recuperar el registro borrado',
                                                icon: 'question',
                                                showDenyButton: true,
                                                confirmButtonText: 'Eliminar',
                                                confirmButtonColor: '#a5161d',
                                                denyButtonText: 'Cancelar',
                                                denyButtonColor: '#270a0a',
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('form{{ $imagen->id }}').submit();
                                                }
                                            });
                                        }
                                    </script>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <p class="text-muted">Sin imagenes</p>
                            </div>
                        @endforelse
                    </div>
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
    <script>
        const mostrarimagen = (event) => {
            document.getElementById('preview2').src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@stop
