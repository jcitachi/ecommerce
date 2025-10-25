@extends('layouts.admin')

@section('page-header')
    <h1>Panel para Editar Usuario</h1>
    <p>Bienvenido <b>{{ Auth::user()->name }}</b>, aquí podrás actualizar los datos de un usuario registrado.</p>
    <hr class="text-primary w-60 my-4" style="height: 10px; opacity: 1;">
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-gradient-primary text-primary rounded-top-4 text-center">
                <h4 class="mb-0 card-title">
                    <i class="fas fa-user-edit"></i> Editar Usuario
                </h4>
                <hr>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Rol --}}
                        <div class="col-md-6">
                            <label for="rol" class="form-label fw-semibold">
                                Rol Asignado <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                                <select name="rol" id="rol" class="form-control rounded-pill" required>
                                    <option value="">Seleccione un rol...</option>
                                    @foreach ($roles as $rol)
                                        @if (!($rol->name == 'SUPER ADMIN'))
                                            <option value="{{ $rol->name }}"
                                                {{ (old('rol', $usuario->roles->pluck('name')->implode(', ')) == $rol->name) ? 'selected' : '' }}>
                                                {{ $rol->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('rol')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- Nombre --}}
                        <div class="col-md-6 mt-2">
                            <label for="name" class="form-label fw-semibold">
                                Nombre Completo <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" name="name" id="name" class="form-control rounded-pill"
                                    value="{{ old('name', $usuario->name) }}" placeholder="Ingrese el nombre completo" required>
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6 mt-2">
                            <label for="email" class="form-label fw-semibold">
                                Correo Electrónico <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" id="email" class="form-control rounded-pill"
                                    value="{{ old('email', $usuario->email) }}" placeholder="ejemplo@correo.com" required>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="col-md-6 mt-2">
                            <label for="password" class="form-label fw-semibold">
                                Nueva Contraseña <small class="text-muted">(opcional)</small>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" id="password" class="form-control rounded-pill"
                                    placeholder="Ingrese una nueva contraseña si desea cambiarla">
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirmar Password --}}
                        <div class="col-md-6 mt-2">
                            <label for="password_confirmation" class="form-label fw-semibold">
                                Confirmar Nueva Contraseña <small class="text-muted">(solo si cambia)</small>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control rounded-pill" placeholder="Repita la nueva contraseña">
                            </div>
                        </div>
                    </div>

                    <hr class="text-primary w-50 my-4 mx-auto" style="height: 10px; opacity: 1;">

                    {{-- Botones --}}
                    <div class="text-center">
                        <a href="{{ route('admin.usuarios.index') }}"
                            class="btn btn-secondary btn-sm rounded-pill shadow-sm px-4 me-2">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-success btn-sm rounded-pill shadow-sm px-4">
                            <i class="bi bi-save"></i> Actualizar
                        </button>
                    </div>
                </form>
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
