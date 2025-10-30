@extends('layouts.admin')

@section('page-header')
    <h1 class="fw-bold text-primary">Modificar Categoría: {{ $categoria->nombre }}</h1>
    <hr class="text-primary w-50 my-4" style="height: 4px; opacity: 1;">
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-gradient-primary text-white text-center rounded-top-4">
                <h4 class="mb-0">
                    <i class="bi bi-folder-check"></i> Llene los datos del Formulario
                </h4>
            </div>

            <div class="card-body p-4">
                {{-- Formulario de edición --}}
                <form action="{{ route('admin.categorias.update', $categoria->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        {{-- Nombre --}}
                        <div class="col-md-12">
                            <label for="nombre" class="form-label fw-semibold">
                                Nombre <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-tag"></i></span>
                                <input type="text" name="nombre" id="nombre" class="form-control rounded-end-pill"
                                    value="{{ old('nombre', $categoria->nombre) }}"
                                    placeholder="Ej. Laptops, Impresoras, Proyectores..." required>
                            </div>
                            @error('nombre')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="col-md-12">
                            <label for="slug" class="form-label fw-semibold">
                                Slug <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-link-45deg"></i></span>
                                <input type="text" name="slug" id="slug" class="form-control rounded-end-pill"
                                    value="{{ old('slug', $categoria->slug) }}"
                                    placeholder="Ej. laptops, impresoras, proyectores..." readonly required>
                            </div>
                            @error('slug')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div class="col-md-12">
                            <label for="descripcion" class="form-label fw-semibold">Descripción</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-text-paragraph"></i></span>
                                <textarea name="descripcion" id="descripcion" rows="3"
                                    class="form-control rounded-end"
                                    placeholder="Describe brevemente la categoría...">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                            </div>
                            @error('descripcion')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="text-center mt-4">
                        <a href="{{ route('admin.categorias.index') }}"
                            class="btn btn-outline-secondary rounded-pill shadow-sm px-4 me-2">
                            <i class="bi bi-arrow-left-circle"></i> Volver
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill shadow-sm px-4">
                            <i class="bi bi-save"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, 0.25);
        }
        .card {
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
    </style>
@stop

@section('js')
    <script>
        // Generar automáticamente el slug desde el nombre
        document.getElementById('nombre').addEventListener('keyup', function() {
            let nombre = this.value;
            let slug = nombre.toLowerCase()
                            .trim()
                            .replace(/[\s\W-]+/g, '-');
            document.getElementById('slug').value = slug;
        });
    </script>
@stop
