@extends('layouts.admin')

@section('page-header')
    <h1>Panel Usuarios</h1>
    <p> Bienvenido <b>{{ Auth::user()->name }}</b>, aca se mostrara el contenido de Usuarios</p>
    <hr class="text-primary w-60 my-4" style="height: 10px; opacity: 1;">
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                {{-- Título a la izquierda --}}
                <h5 class="mb-0">
                    <i class="bi bi-list-task"></i> Listado de Usuarios
                </h5>

                {{-- Botón a la derecha --}}
                <a href="{{ route('admin.usuarios.create') }}" class="btn btn-sm btn-primary rounded-pill shadow-sm">
                    <i class="bi bi-plus-circle"></i> Registrar Usuario
                </a>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-header bg-gradient-primary text-primary rounded-top-4 text-center">
                            <h4 class="mb-0 card-title">
                                <i class="fas fa-id-card"></i> Usuarios registrados
                            </h4>
                            <hr>
                        </div>

                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="text-center">Nro</th>
                                            <th scope="col" class="text-start">Nombre del Usuario</th>
                                            <th scope="col" class="text-start">Rol del Usuario</th>
                                            <th scope="col" class="text-start">Email</th>
                                            <th scope="col" class="text-center" style="width: 150px;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $nro = ($usuarios->currentPage() - 1) * $usuarios->perPage() + 1;
                                        @endphp
                                        {{-- Bucle para iterar sobre los roles. Asume que la variable es $roles --}}
                                        @foreach ( $usuarios as $usuario )
                                            <tr>
                                                <td class="text-center"><b>{{ $nro++ }}</b></td>
                                                {{-- Campo del usuario --}}
                                                <td class="text-start">{{ $usuario->name }}</td>
                                                <td class="text-start">{{ $usuario->name }}</td>
                                                <td class="text-start">{{ $usuario->email }}</td>

                                                {{-- Botones de Acciones --}}
                                                <td class="text-center">
                                                    {{-- Botón ber --}}
                                                    <a href="{{ route('admin.usuarios.show', $usuario) }}"
                                                        class="btn btn-sm btn-info text-white me-2" title="Ver usuario">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    {{-- Botón Editar --}}
                                                    <a href="{{ route('admin.usuarios.edit', $usuario) }}"
                                                        class="btn btn-sm btn-warning text-white me-2" title="Editar usuario">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>


                                                    {{-- Botón Borrar (Formulario para el método DELETE) --}}
                                                    <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            title="Eliminar Usuario"
                                                            onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                                @if ($usuarios->hasPages())
                                    <div class="d-flex justify-content-between align-items-center mt4 px-3">
                                        <div class="text-muted">
                                            Mostrando {{ $usuarios->firstItem() }} a {{ $usuarios->lastItem() }} de {{ $usuarios->total() }} registros
                                        </div>
                                        {{ $usuarios->links('pagination::bootstrap-4') }}
                                    </div>
                                @endif
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
