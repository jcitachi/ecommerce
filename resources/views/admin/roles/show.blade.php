@extends('layouts.admin')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="fw-bold text-primary mb-0">
                <i class="bi bi-shield-lock-fill"></i> Detalles del Rol: {{ $rol->name }}
            </h1>
            <p class="text-muted mb-0">
                Bienvenido, <b>{{ Auth::user()->name }}</b> — consulta la información del rol registrado.
            </p>
        </div>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary rounded-pill shadow-sm">
            <i class="bi bi-arrow-left-circle"></i> Volver
        </a>
    </div>
    <hr class="text-primary mt-3" style="height: 4px; opacity: 0.8; width: 70%;">
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary bg-gradient text-white rounded-top-4 text-center py-3">
                    <h4 class="mb-0 fw-semibold">
                        <i class="fas fa-id-card me-2"></i> Información del Rol
                    </h4>
                </div>

                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label text-muted fw-semibold">
                            <i class="bi bi-person-badge me-2 text-primary"></i>Nombre del Rol
                        </label>
                        <div class="input-group border rounded-3 shadow-sm">
                            <span class="input-group-text bg-light border-0 text-primary">
                                <i class="bi bi-award-fill"></i>
                            </span>
                            <labe type="text" class="form-control border-0 bg-light fw-bold text-primary"
                                    readonly>{{ $rol->name }}</labe>
                        </div>
                    </div>

                    <hr class="text-primary opacity-75">

                    {{-- Puedes mostrar más detalles si tu modelo los tiene --}}
                    {{-- Ejemplo:--}}
                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold">
                            <i class="bi bi-clock me-2 text-primary"></i>fecha y hora de registro
                        </label>
                         <div class="input-group border rounded-3 shadow-sm">
                            <span class="input-group-text bg-light border-0 text-primary">
                                <i class="bi bi-calendar3"></i>
                            </span>
                            <labe type="text" class="form-control border-0 bg-light fw-bold text-primary"
                                    readonly>{{ $rol->created_at }}</labe>
                        </div>
                    </div>

                    {{--
                    <div class="text-center mt-4">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary rounded-pill px-4 shadow-sm">
                            <i class="bi bi-x-circle"></i> Cerrar
                        </a>
                    </div>
                    --}}
                </div>
            </div>
        </div>
    </div>
@stop
