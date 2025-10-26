@extends('layouts.admin')

@section('page-header')
    <h1>Panel de Categorías</h1>
    <p> Bienvenido <b>{{ Auth::user()->name }}</b>, aca se mostrara el contenido de Categorías</p>
    <hr class="text-primary w-60 my-4" style="height: 10px; opacity: 1;">
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                {{-- Título a la izquierda --}}
                <h5 class="mb-0">
                    <i class="bi bi-list-task"></i> Listado de Categorías
                </h5>

                {{-- Botón a la derecha --}}
                <a href="{{ route('admin.usuarios.create') }}" class="btn btn-sm btn-primary rounded-pill shadow-sm">
                    <i class="bi bi-plus-circle"></i> Registrar Nueva Categoría
                </a>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('admin.categorias.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control rounded-pill shadow-sm" name="buscar" id="buscar"
                                placeholder="buscar usuario..." value="{{ $_REQUEST['buscar'] ?? '' }}">
                            <button type="submit" class="btn btn-primary rounded-pill shadow-sm mr-3"><i
                                    class="bi bi-search"></i> Buscar
                            </button>
                            @if (isset($_REQUEST['buscar']))
                                <a href="{{ route('admin.categorias.index') }}"
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
                                <i class="fas fa-id-card"></i> Categorias registradas
                            </h4>
                            <hr>
                        </div>

                        <div class="card-body p-4">

                            <div class="table-responsive mt-2">
                                <table class="table table-striped table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="text-center">Nro</th>
                                            <th scope="col" class="text-center">Nombre de la Categoría</th>
                                            <th scope="col" class="text-start">Slug</th>
                                            <th scope="col" class="text-start">Descripción</th>
                                            <th scope="col" class="text-center" style="width: 150px;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $nro = ($categorias->currentPage() - 1) * $categorias->perPage() + 1;
                                        @endphp
                                        {{-- Bucle para iterar sobre los roles. Asume que la variable es $roles --}}
                                        @foreach ($categorias as $categoria)
                                            <tr>
                                                <td class="text-center"><b>{{ $nro++ }}</b></td>
                                                {{-- Campo del categoria --}}
                                                <td class="text-start">{{ $categoria->nombre }}</td>
                                                <td class="text-start">{{ $categoria->slug }}</td>
                                                <td class="text-start">{{ $categoria->descripcion }}</td>
                                                {{-- Botones de Acciones --}}
                                                <td class="text-center">

                                                        {{-- Botón ver --}}
                                                        <a href="{{ route('admin.categorias.show', $categoria) }}"
                                                            class="btn btn-sm btn-info text-white me-2" title="Ver categoria">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        {{-- Botón Editar --}}
                                                        <a href="{{ route('admin.categorias.edit', $categoria) }}"
                                                            class="btn btn-sm btn-warning text-white me-2"
                                                            title="Editar categoria">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>


                                                        {{-- Botón Borrar (Formulario para el método DELETE) --}}
                                                        <form action="{{ route('admin.categorias.destroy', $categoria) }}"
                                                            method="POST" id="miformulario{{ $categoria->id }}"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                title="Eliminar Categoría"
                                                                onclick="preguntar{{ $categoria->id }}(event)">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                        <script>
                                                            function preguntar{{ $categoria->id }}(event) {
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
                                                                            document.getElementById('miformulario{{ $categoria->id }}').submit();
                                                                        }
                                                                    });
                                                            }
                                                        </script>
                                                </td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ($categorias->hasPages())
                                    <div class="d-flex justify-content-between align-items-center mt4 px-3">
                                        <div class="text-muted">
                                            Mostrando {{ $categorias->firstItem() }} a {{ $categorias->lastItem() }} de
                                            {{ $categorias->total() }} registros
                                        </div>
                                        {{ $categorias->links('pagination::bootstrap-4') }}
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

