@extends('layouts.admin')

@section('content')
    <h5><i class="bi bi-gear-fill"></i> Ajustes</h5>
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-primary text-white rounded-top-4">
                    <h4 class="mb-0 card-title"><i class="fas fa-id-card"></i> Formulario de Registro</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.personal.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="tipo" id="tipo" value="{{ $tipo }}" hidden>
                        <div class="row">
                            {{-- Fotografía --}}
                            <div class="col-md-3 text-center">
                                <label for="foto" class="form-label fw-semibold">
                                    <i class="fas fa-camera text-primary"></i> Fotografía <span class="text-danger">*</span>
                                </label>
                                <div class="input-group d-flex flex-column align-items-center">
                                    <label class="btn btn-outline-primary rounded-pill px-4" for="foto">
                                        <i class="fas fa-upload"></i> Seleccionar archivo
                                    </label>
                                    <input type="file" class="d-none" id="foto" name="foto" accept="image/*"
                                        onchange="mostrarImagen(event)" required>
                                    <span id="nombre-archivo" class="mt-2 text-muted">Ningún archivo seleccionado</span>

                                    <!-- Imagen centrada -->
                                    <img id="preview" src="" width="150"
                                        style="display:none; margin-top:10px;">
                                </div>
                            </div>


                            {{-- content --}}
                            <div class="col-md-9">
                                <div class="row">
                                    {{-- Tipo de Rol --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">
                                                <span><i class="fas fa-users-cog text-primary"></i></span> Nombre del Rol
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="rol" id="rol" class="form-control rounded-pill"
                                                required>
                                                <option value="">Seleccione un rol...</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}"
                                                        {{ $role->name == $tipo ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>)
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('rol')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Nombre Completo --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre" class="form-label fw-semibold">
                                                <span><i class="fas fa-user text-primary"></i></span> Nombre <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="nombre" id="nombre"
                                                class="form-control rounded-pill" value="{{ old('nombre') }}"
                                                placeholder="Ingrese el nombre" required>
                                        </div>
                                        @error('nombre')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- Apellido Completo --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="apellido" class="form-label fw-semibold">
                                                <span><i class="fas fa-user-edit text-primary"></i></span> Apellido <b>
                                                    *</b>
                                            </label>
                                            <input type="text" name="apellido" id="apellido"
                                                class="form-control rounded-pill" value="{{ old('apellido') }}"
                                                placeholder="Ingrese el apellido" required>
                                        </div>
                                        @error('apellido')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- Documento de Identidad --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ci" class="form-label fw-semibold">
                                                <span><i class="fas fa-id-badge text-primary"></i></span> Cédula de
                                                Identidad <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="ci" id="ci"
                                                class="form-control rounded-pill" value="{{ old('ci') }}"
                                                placeholder="Ingrese la cédula de identidad" required>
                                        </div>
                                        @error('ci')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        {{-- Fecha de Nacimiento --}}
                                        <label for="fecha_nacimiento" class="form-label fw-semibold">
                                            <span><i class="fas fa-birthday-cake text-primary"></i></span> Fecha de
                                            Nacimiento <span class="text-danger">
                                                *</span>
                                        </label>
                                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                            class="form-control rounded-pill" value="{{ old('fecha_nacimiento') }}"
                                            placeholder="Ingrese la fecha de nacimiento" required>
                                    </div>
                                    @error('fecha_nacimiento')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <div class="col-md-3">
                                        <label for="telefono" class="form-label fw-semibold">
                                            <span><i class="fas fa-phone-alt text-primary"></i></span> Teléfono <span
                                                class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="telefono" id="telefono"
                                            value="{{ old('telefono') }}" placeholder="Ingrese un número de teléfono"
                                            class="form-control rounded-pill" required>
                                    </div>
                                    @error('telefono')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    <div class="col-md-3">
                                        <label for="profesion" class="form-label fw-semibold">
                                            <span><i class="fas fa-briefcase text-primary"></i></span> Profesión <span
                                                class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="profesion" id="profesion"
                                            value="{{ old('profesion') }}" placeholder="Ingrese la profesión"
                                            class="form-control rounded-pill" required>
                                    </div>
                                    @error('profesion')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    {{-- Correo Electrónico --}}
                                    <div class="col-md-3">
                                        <label for="email" class="form-label fw-semibold">
                                            <span><i class="fas fa-envelope text-primary"></i></span> Correo electrónico
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                                            class="form-control rounded-pill" placeholder="ejemplo@correo.com" required>
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        {{-- dirección --}}
                                        <label for="direccion" class="form-label fw-semibold">
                                            <i class="fas fa-map-marker-alt text-primary"></i> Dirección<span
                                                class="text-danger"> *</span>
                                        </label>
                                        <input type="text" name="direccion" id="direccion"
                                            value="{{ old('direccion') }}" placeholder="ingrese una dirección válida"
                                            class="form-control rounded-pill" required>
                                    </div>
                                    @error('direccion')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <hr>
                                <div class="row justify-content-center">
                                    <div class="mt-5 ">
                                        <a href="{{ route('admin.personal.index', $tipo) }}"
                                            class="btn btn-outline-secondary btn-sm rounded-pill mr-2">
                                            <i class="fas fa-arrow-left"></i> Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-success btn-sm rounded-pill shadow-sm">
                                            <i class="fas fa-save"></i> Guardar Registro
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
@section('css')
@stop
@section('js')
@stop
