@extends('layouts.admin')

@section('page-header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="fw-bold text-primary mb-0">
            <i class="bi bi-box-seam me-2"></i> Registrar Producto
        </h1>
    </div>
    <hr class="text-primary w-50 my-3" style="height: 4px; opacity: 0.9;">
@stop

@section('content')
    <div class="row">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0 text-white"><i class="bi bi-pencil-square me-2"></i> Llene el Formulario de Registro</h5>
            </div>

            <div class="card-body bg-light">
                <form action="{{ route('admin.productos.store') }}" method="POST" class="p-3">
                    @csrf
                    @method('POST')

                    <div class="row g-4">

                        {{-- Nombre del producto --}}
                        <div class="col-md-3">
                            <label for="nombre" class="form-label fw-semibold">Nombre del producto</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-light"><i class="bi bi-box"></i></span>
                                <input type="text" class="form-control border-0" name="nombre" id="nombre"
                                    placeholder="Ej: Laptop Dell Inspiron 15" value="{{ old('nombre') }}" required>
                            </div>
                            @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Categoría --}}
                        <div class="col-md-3">
                            <label for="categoria_id" class="form-label fw-semibold">Categoría</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-light"><i class="bi bi-tags"></i></span>
                                <select name="categoria_id" id="categoria_id" class="form-select border-0" required>
                                    <option value="" selected disabled>Seleccione una categoría</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}"
                                            {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('categoria_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Código --}}
                        <div class="col-md-3">
                            <label for="codigo" class="form-label fw-semibold">Código</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-light"><i class="bi bi-upc-scan"></i></span>
                                <input type="text" name="codigo" id="codigo" class="form-control border-0"
                                    value="{{ old('codigo') }}" placeholder="Ej: RDM-5254" required>
                            </div>
                            @error('codigo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Stock --}}
                        <div class="col-md-3">
                            <label for="stock" class="form-label fw-semibold">Stock</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-light"><i class="bi bi-archive"></i></span>
                                <input type="number" name="stock" id="stock" class="form-control border-0"
                                    value="{{ old('stock') }}" placeholder="Ejemplo: 10" required>
                            </div>
                            @error('stock')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Descripción Corta --}}
                        <div class="col-md-6">
                            <label for="descripcion_corta" class="form-label fw-semibold">Descripción corta</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-light"><i class="bi bi-card-text"></i></span>
                                <textarea name="descripcion_corta" id="descripcion_corta" class="form-control border-0" rows="3"
                                    placeholder="Breve descripción...">{{ old('descripcion_corta') }}</textarea>
                            </div>
                            @error('descripcion_corta')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Descripción Larga con CKEditor --}}
                        <div class="col-md-6">
                            <label for="descripcion_larga" class="form-label fw-semibold">Descripción larga</label>
                            <textarea name="descripcion_larga" id="descripcion_larga" class="form-control shadow-sm border-0"
                                rows="4" placeholder="Detalles completos, especificaciones y características...">{{ old('descripcion_larga') }}</textarea>
                            @error('descripcion_larga')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Precio de Compra --}}
                        <div class="col-md-4">
                            <label for="precio_compra" class="form-label fw-semibold">Precio compra</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-primary text-white">S/</span>
                                <input type="number" step="0.01" name="precio_compra" id="precio_compra"
                                    class="form-control border-0" value="{{ old('precio_compra') }}" required>
                            </div>
                            @error('precio_compra')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Precio de Venta --}}
                        <div class="col-md-4">
                            <label for="precio_venta" class="form-label fw-semibold">Precio venta</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-success text-white">S/</span>
                                <input type="number" step="0.01" name="precio_venta" id="precio_venta"
                                    class="form-control border-0" value="{{ old('precio_venta') }}" required>
                            </div>
                            @error('precio_venta')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="text-center mt-4">
                        <a href="{{ route('admin.productos.index') }}"
                            class="btn btn-outline-secondary rounded-pill shadow-sm px-4 me-2">
                            <i class="bi bi-arrow-left-circle"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill shadow-sm px-4">
                            <i class="bi bi-save2"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    {{-- CKEditor 5 con configuración avanzada --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Editor para el contenido (más completo)
            ClassicEditor
                .create(document.querySelector('#descripcion_larga'), {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', '|',
                            'link', 'bulletedList', 'numberedList', '|',
                            'outdent', 'indent', '|',
                            'alignment', '|',
                            'blockQuote', 'insertTable', 'mediaEmbed', '|',
                            'undo', 'redo', '|',
                            'fontBackgroundColor', 'fontColor', 'fontSize', 'fontFamily', '|',
                            'code', 'codeBlock', 'htmlEmbed', '|',
                            'sourceEditing'
                        ]
                    },
                    shouldNotGroupWhenFull: true,
                    language: 'es'
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@stop
