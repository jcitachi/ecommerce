@extends('layouts.admin')

@section('page-header')
    <h3 class="fw-bold text-primary">Categoría: {{ $categoria->nombre }}</h3>
    <hr class="text-primary w-50 my-4" style="height: 4px; opacity: 1;">
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-gradient-primary text-white text-center rounded-top-4">
                <h4 class="mb-0">
                    <i class="bi bi-eye"></i> Ver Detalles de la Categoría
                </h4>
                <h5>{{ $categoria->nombre }}</h5>
            </div>

            <div class="card-body p-4">
                <div class="row g-3">
                    {{-- Nombre --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold text-secondary">Nombre</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-tag"></i></span>
                            <input type="text" class="form-control rounded-end-pill"
                                   value="{{ $categoria->nombre }}" disabled>
                        </div>
                    </div>

                    {{-- Slug --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold text-secondary">Slug</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-link-45deg"></i></span>
                            <input type="text" class="form-control rounded-end-pill"
                                   value="{{ $categoria->slug }}" disabled>
                        </div>
                    </div>

                    {{-- Descripción --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold text-secondary">Descripción</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-text-paragraph"></i></span>
                            <textarea class="form-control rounded-end" rows="3" disabled>{{ $categoria->descripcion }} </textarea>
                        </div>
                    </div>

                    {{-- Fecha de creación --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold text-secondary">Fecha de Creación</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-calendar-event"></i></span>
                            <input type="text" class="form-control rounded-end-pill"
                                   value="{{ $categoria->created_at->format('d/m/Y - H:i') }}" disabled>
                        </div>
                    </div>
                </div>

                {{-- Botón volver --}}
                <div class="text-center mt-4">
                    <a href="{{ route('admin.categorias.index') }}"
                       class="btn btn-outline-primary rounded-pill shadow-sm px-4">
                        <i class="bi bi-arrow-left-circle"></i> Volver al listado
                    </a>
                </div>
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
        .card {
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        input[readonly], textarea[readonly] {
            background-color: #f9f9f9 !important;
            cursor: not-allowed;
        }
    </style>
@stop
