@extends('layouts.admin')

@section('page-header')
    <h1>Panel de Configuración</h1>
    <p> Bienvenido <b>{{ Auth::user()->name }}</b> estas en el panel de Ajustes del Sistema</p>
    <hr class="">
@endsection

@section('content')
    <h5><i class="bi bi-gear-fill"></i> Ajustes del Sistema
    </h5>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-primary text-primary rounded-top-4 text-center">
                    <h4 class="mb-0 card-title">
                        <i class="fas fa-id-card"></i> CONFIGURACIÓN DEL SISTEMA
                    </h4>
                    <hr>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.ajustes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{-- Imagenes --}}
                            <div class="col-md-4 text-center">
                                <div class="row">
                                    <div class="col-md-6 text-center mb-4">
                                        {{-- Logo de la empresa --}}
                                        <div class="form-group">

                                            <label for="logo" class="form-label fw-semibold d-block">
                                                <i class="fas fa-camera text-primary"></i> Logo <span class="text-danger">
                                                    @if (!isset($ajuste) || empty($ajuste->logo))
                                                        *
                                                    @endif
                                                </span>
                                            </label>

                                            <div class="input-group d-flex flex-column align-items-center">
                                                <label class="btn btn-outline-primary rounded-pill px-4 mb-2"
                                                    for="logo">
                                                    <i class="bi bi-upload"></i> Seleccionar archivo
                                                </label>

                                                <input type="file" class="d-none" id="logo" name="logo"
                                                    accept="image/*"
                                                    onchange="mostrarImagen(event, 'preview', 'nombre-archivo')"
                                                    @if (!isset($ajuste) || empty($ajuste->logo)) required @endif>

                                                <span id="nombre-archivo" class="mt-1 text-muted small">
                                                    Ningún archivo seleccionado
                                                </span>
                                                @if (isset($ajuste) && $ajuste->logo)
                                                    <img id="preview" src="{{ asset('storage/' . $ajuste->logo) }}"
                                                        width="150" class="mt-3 rounded shadow-sm"
                                                        style=" object-fit: cover;">
                                                @else
                                                    <img id="preview" src="" width="150"
                                                        class="mt-3 rounded shadow-sm"
                                                        style="display:none; object-fit: cover;">
                                                @endif

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6 text-center mb-4">
                                        {{-- Imagen del login --}}
                                        <div class="form-group">

                                            <label for="imagen_login" class="form-label fw-semibold d-block">
                                                <i class="fas fa-camera text-primary"></i> Imagen Login
                                                <span class="text-danger">
                                                    @if (!isset($ajuste) || empty($ajuste->logo))
                                                        *
                                                    @endif
                                                </span>
                                            </label>

                                            <div class="input-group d-flex flex-column align-items-center">
                                                <label class="btn btn-outline-primary rounded-pill px-4 mb-2"
                                                    for="imagen_login">
                                                    <i class="bi bi-upload"></i> Seleccionar archivo
                                                </label>

                                                <input type="file" class="d-none" id="imagen_login" name="imagen_login"
                                                    accept="image/*"
                                                    onchange="mostrarImagen(event, 'preview-1', 'nombre-archivo-1')"
                                                    @if (!isset($ajuste) || empty($ajuste->logo)) required @endif>

                                                <span id="nombre-archivo-1" class="mt-1 text-muted small">
                                                    Ningún archivo seleccionado
                                                </span>
                                                @if (isset($ajuste) && $ajuste->imagen_login)
                                                    <img id="preview-1"
                                                        src="{{ asset('storage/' . $ajuste->imagen_login) }}" width="150"
                                                        class="mt-3 rounded shadow-sm" style="object-fit: cover;">
                                                @else
                                                    <img id="preview-1" src="" width="150"
                                                        class="mt-3 rounded shadow-sm"
                                                        style="display:none; object-fit: cover;">
                                                @endif

                                            </div>

                                        </div>
                                    </div>


                                </div>

                            </div>
                            <!--##########################-->
                            {{-- contenido --}}
                            <div class="col-md-8">
                                <div class="row">
                                    {{-- Nombre Completo --}}
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="nombre" class="form-label fw-semibold ">
                                                Nombre
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-building"></i></span>
                                                <input type="text" name="nombre" id="nombre"
                                                    class="form-control rounded-pill @error('nombre') is-invalid @enderror"
                                                    value="{{ old('nombre', $ajuste->nombre ?? '') }}"
                                                    placeholder="nombre de la empresa" required>
                                                @error('nombre')
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Descripción --}}
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="descripcion" class="form-label fw-semibold ">
                                                Descripción
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                                <input type="text" name="descripcion" id="descripcion"
                                                    class="form-control rounded-pill @error('descripcion') is-invalid @enderror"
                                                    value="{{ old('descripcion', $ajuste->descripcion ?? '') }}"
                                                    placeholder="descripcion de la actividad o sector" required>
                                                @error('descripcion')
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Sucursal --}}
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="sucursal" class="form-label fw-semibold ">
                                                Sucursal
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-shop"></i>
                                                </span>
                                                <input type="text" name="sucursal" id="sucursal"
                                                    class="form-control rounded-pill @error('sucursal') is-invalid @enderror"
                                                    value="{{ old('sucursal', $ajuste->sucursal ?? '') }}"
                                                    placeholder="sucursal matriz de la empresa" required>
                                                @error('sucursal')
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    {{-- Dirección --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="direccion" class="form-label fw-semibold ">
                                                Direccion
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-geo-alt"></i></span>
                                                <textarea name="direccion" id="direccion" rows="1"
                                                    class="form-control rounded-pill @error('direccion') is-invalid @enderror" placeholder="direccion de la empresa"
                                                    required> {{ old('direccion', $ajuste->direccion ?? '') }}
                                                </textarea>
                                                @error('direccion')
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- email --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="email" class="form-label fw-semibold ">
                                                email
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                <input type="email" name="email" id="email"
                                                    class="form-control rounded-pill @error('email') is-invalid @enderror"
                                                    value="{{ old('email', $ajuste->email ?? '') }}"
                                                    placeholder="email de la empresa" required>
                                                @error('email')
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- Teléfonos --}}
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="telefono" class="form-label fw-semibold ">
                                                Telefono
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                                <input type="text" name="telefono" id="telefono"
                                                    class="form-control rounded-pill @error('telefono') is-invalid @enderror"
                                                    value="{{ old('telefono', $ajuste->telefono ?? '') }}"
                                                    placeholder="telefono de la empresa" required>
                                                @error('telefono')
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Página Web --}}
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="pagina_web" class="form-label fw-semibold ">
                                                Pagina Web

                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-globe"></i></span>
                                                <input type="text" name="pagina_web" id="pagina_web"
                                                    class="form-control rounded-pill @error('pagina_web') is-invalid @enderror"
                                                    value="{{ old('pagina_web', $ajuste->pagina_web ?? '') }}"
                                                    placeholder="ej: example@example.com">
                                                @error('pagina_web')
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Divisas --}}
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="divisa" class="form-label fw-semibold ">
                                                Divisa
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i
                                                        class="bi bi-currency-dollar"></i></span>
                                                <select name="divisa" id="divisa"
                                                    class="form-control rounded-pill @error('divisa') is-invalid @enderror">
                                                    <option value="">Selecione una divisa</option>
                                                    @foreach ($divisas as $divisa)
                                                        <option value="{{ $divisa['symbol'] }}"
                                                            {{ old('divisa', $ajuste->divisa ?? '') == $divisa['symbol'] ? 'selected' : '' }}>
                                                            {{ $divisa['name'] }} ({{ $divisa['symbol'] }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('divisa')
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr class="text-primary">

                                {{-- botones --}}
                                <div class="row justify-content-center mt-4">
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-sm rounded-pill shadow-sm">
                                            <i class="bi bi-save"></i> Guardar Configuración
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
    {{-- Aquí puedes agregar estilos personalizados si deseas --}}
@stop

@section('js')
    <script>
        function mostrarImagen(event, previewId, nombreArchivoId) {
            const archivo = event.target.files[0];
            const preview = document.getElementById(previewId);
            const nombreArchivo = document.getElementById(nombreArchivoId);

            if (archivo) {
                nombreArchivo.textContent = archivo.name;

                const lector = new FileReader();
                lector.onload = e => {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };
                lector.readAsDataURL(archivo);
            } else {
                nombreArchivo.textContent = "Ningún archivo seleccionado";
                preview.style.display = "none";
                preview.src = "";
            }
        }
    </script>

@stop
