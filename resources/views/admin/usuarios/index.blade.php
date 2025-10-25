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
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('admin.usuarios.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control rounded-pill shadow-sm" name="buscar" id="buscar"
                                placeholder="buscar usuario..." value="{{ $_REQUEST['buscar'] ?? '' }}">
                            <button type="submit" class="btn btn-primary rounded-pill shadow-sm mr-3"><i
                                    class="bi bi-search"></i> Buscar
                            </button>
                            @if (isset($_REQUEST['buscar']))
                                <a href="{{ route('admin.usuarios.index') }}"
                                    class="btn btn-secondary rounded-pill shadow-sm mr-3"><i class="bi bi-trash"></i>
                                    Limpiar</a>
                            @endif
                        </div>
                    </form>
                </div>
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

                            <div class="table-responsive mt-2">
                                <table class="table table-striped table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="text-center">Nro</th>
                                            <th scope="col" class="text-start">Nombre del Usuario</th>
                                            <th scope="col" class="text-start">Rol del Usuario</th>
                                            <th scope="col" class="text-start">Email</th>
                                            <th scope="col" class="text-start">Estado</th>
                                            <th scope="col" class="text-center" style="width: 150px;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $nro = ($usuarios->currentPage() - 1) * $usuarios->perPage() + 1;
                                        @endphp
                                        {{-- Bucle para iterar sobre los roles. Asume que la variable es $roles --}}
                                        @foreach ($usuarios as $usuario)
                                            <tr>
                                                <td class="text-center"><b>{{ $nro++ }}</b></td>
                                                {{-- Campo del usuario --}}
                                                <td class="text-start">{{ $usuario->name }}</td>
                                                <td class="text-start">{{ $usuario->roles->pluck('name')->implode(', ') }}
                                                </td>
                                                <td class="text-start">{{ $usuario->email }}</td>
                                                <td>
                                                    @if ($usuario->estado == 0)
                                                        <span class="badge bg-danger">Inactivo</span>
                                                    @else
                                                        <span class="badge bg-success">Activo</span>
                                                    @endif
                                                </td>

                                                {{-- Botones de Acciones --}}
                                                <td class="text-center">
                                                    @if ($usuario->estado == 1)
                                                        {{-- Botón ver --}}
                                                        <a href="{{ route('admin.usuarios.show', $usuario) }}"
                                                            class="btn btn-sm btn-info text-white me-2" title="Ver usuario">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        {{-- Botón Editar --}}
                                                        <a href="{{ route('admin.usuarios.edit', $usuario) }}"
                                                            class="btn btn-sm btn-warning text-white me-2"
                                                            title="Editar usuario">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>


                                                        {{-- Botón Borrar (Formulario para el método DELETE) --}}
                                                        <form action="{{ route('admin.usuarios.destroy', $usuario) }}"
                                                            method="POST" id="miformulario{{ $usuario->id }}"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                title="Eliminar Usuario"
                                                                onclick="preguntar{{ $usuario->id }}(event)">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                        <script>
                                                            function preguntar{{ $usuario->id }}(event) {
                                                                event.preventDefault();
                                                                Swal.fire({
                                                                        title: '¿Desea Eliminar este registro?',
                                                                        text: 'no podra recuperar el registro borrado',
                                                                        icon: 'question',
                                                                        showDenyButton: true,
                                                                        confirmButtonText: 'Eliminar',
                                                                        confirmButtonColor: '#a5161d',
                                                                        denyButtonText: 'Cancelar',
                                                                        denyButtonColor: '#270a0a',
                                                                    })
                                                                    .then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            //JavaScript puro para enviar el formulario
                                                                            document.getElementById('miformulario{{ $usuario->id }}').submit();
                                                                        }
                                                                    });
                                                            }
                                                        </script>
                                                    @else
                                                        {{-- Botón restaurar (Formulario para el método RESTORE) --}}
                                                        <form action="{{ route('admin.usuarios.restore', $usuario) }}"
                                                            method="POST" id="miformulario{{ $usuario->id }}"
                                                            class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-warning"
                                                                title="Restaurar Usuario"
                                                                onclick="preguntar{{ $usuario->id }}(event)">
                                                                <i class="bi bi-arrow-counterclockwise"></i> Restaurar
                                                            </button>
                                                        </form>
                                                        <script>
                                                            function preguntar{{ $usuario->id }}(event) {
                                                                event.preventDefault();
                                                                Swal.fire({
                                                                        title: '¿Desea Restaurar este usuario?',
                                                                        text: '',
                                                                        icon: 'question',
                                                                        showDenyButton: true,
                                                                        confirmButtonText: 'Restaurar',
                                                                        confirmButtonColor: '#a5161d',
                                                                        denyButtonText: 'Cancelar',
                                                                        denyButtonColor: '#270a0a',
                                                                    })
                                                                    .then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            //JavaScript puro para enviar el formulario
                                                                            document.getElementById('miformulario{{ $usuario->id }}').submit();
                                                                        }
                                                                    });
                                                            }
                                                        </script>
                                                    @endif
                                                </td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ($usuarios->hasPages())
                                    <div class="d-flex justify-content-between align-items-center mt4 px-3">
                                        <div class="text-muted">
                                            Mostrando {{ $usuarios->firstItem() }} a {{ $usuarios->lastItem() }} de
                                            {{ $usuarios->total() }} registros
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
