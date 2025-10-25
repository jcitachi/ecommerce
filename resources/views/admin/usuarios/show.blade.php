@extends('layouts.admin')

@section('page-header')
    <h1>Detalles del Usuario</h1>
    <p>Bienvenido <b>{{ $usuario->name ?? '' }}</b>, aquí puedes ver toda tu información</p>
    <hr class="text-primary w-60 my-4" style="height: 10px; opacity: 1;">
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-gradient-primary text-primary rounded-top-4 text-center">
                <h4 class="mb-0 card-title">
                    <i class="fas fa-user"></i> Información del Usuario
                </h4>
                <hr>
            </div>

            <div class="card-body p-4">
                <div class="row">
                    {{-- Rol --}}
                    <div class="col-md-6 mt-2">
                        <label class="form-label fw-semibold">
                            Rol Asignado
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                            <input type="text" class="form-control rounded-pill" value="{{ $usuario->roles->pluck('name')->implode(', ') }}" disabled>
                        </div>
                    </div>

                    {{-- Nombre --}}
                    <div class="col-md-6 mt-2">
                        <label class="form-label fw-semibold">
                            Nombre Completo
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control rounded-pill" value="{{ $usuario->name }}" disabled>
                        </div>
                    </div>

                    {{-- Correo --}}
                    <div class="col-md-6 mt-2">
                        <label class="form-label fw-semibold">
                            Correo Electrónico
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control rounded-pill" value="{{ $usuario->email }}" disabled>
                        </div>
                    </div>

                    {{-- Fecha de creación --}}
                    <div class="col-md-6 mt-2">
                        <label class="form-label fw-semibold">
                            Fecha de Registro
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                            <input type="text" class="form-control rounded-pill" value="{{ $usuario->created_at->format('d/m/Y H:i') }}" disabled>
                        </div>
                    </div>

                    {{-- Última actualización --}}
                    <div class="col-md-6 mt-2">
                        <label class="form-label fw-semibold">
                            Última Actualización
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-clock-history"></i></span>
                            <input type="text" class="form-control rounded-pill" value="{{ $usuario->updated_at->format('d/m/Y H:i') }}" disabled>
                        </div>
                    </div>
                </div>

                <hr class="text-primary w-50 my-4 mx-auto" style="height: 10px; opacity: 1;">

                {{-- Botones --}}
                <div class="text-center">
                    <a href="{{ route('admin.usuarios.index') }}"
                        class="btn btn-secondary btn-sm rounded-pill shadow-sm px-4 me-2">
                        <i class="bi bi-arrow-left-circle"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('footer')
@stop

@section('css')
@stop

@section('js')
@stop
