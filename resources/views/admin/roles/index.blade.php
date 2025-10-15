@extends('layouts.admin')

@section('page-header')
    <h1>Panel Roles</h1>
    <p> Bienvenido <b>{{ Auth::user()->name }}</b>, aca se mostrara el contenido de Roles</p>
    <hr class="text-primary w-60 my-4" style="height: 10px; opacity: 1;">
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="d-flex justify-content-between align-items-center mb-4">
                {{-- Título a la izquierda --}}
                <h5 class="mb-0">
                    <i class="bi bi-list-task"></i> Listado de Roles
                </h5>

                {{-- Botón a la derecha --}}
                <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-primary rounded-pill shadow-sm">
                    <i class="bi bi-plus-circle"></i> Registrar Rol
                </a>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-header bg-gradient-primary text-primary rounded-top-4 text-center">
                            <h4 class="mb-0 card-title">
                                <i class="fas fa-id-card"></i> Roles registrados
                            </h4>
                            <hr>
                        </div>

                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col" class="text-start">Rol</th>
                                            <th scope="col" class="text-center" style="width: 150px;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Bucle para iterar sobre los roles. Asume que la variable es $roles --}}
                                        @foreach ( $roles as $rol )
                                            <tr>
                                                {{-- Campo del Rol --}}
                                                <td class="text-start">{{ $rol->name }}</td>

                                                {{-- Botones de Acciones --}}
                                                <td class="text-center">
                                                    {{-- Botón Editar --}}
                                                    <a href="{{-- route('admin.roles.edit', $rol) --}}"
                                                        class="btn btn-sm btn-info text-white me-2" title="Editar Rol">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>

                                                    {{-- Botón Borrar (Formulario para el método DELETE) --}}
                                                    <form action="{{-- route('admin.roles.destroy', $rol) --}}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            title="Eliminar Rol"
                                                            onclick="return confirm('¿Estás seguro de que quieres eliminar este rol?');">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
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
