@extends('layouts.admin')

@section('page-header')
    <h1>Panel para Registrar Roles</h1>
    <p> Bienvenido <b>{{ Auth::user()->name }}</b>, aca podras registrar los roles</p>
    <hr class="text-primary w-60 my-4" style="height: 10px; opacity: 1;">
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-primary text-primary rounded-top-4 text-center">
                    <h4 class="mb-0 card-title">
                        <i class="fas fa-id-card"></i> LLene los Campos del Formulario
                    </h4>
                    <hr>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.roles.store') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-label fw-semibold ">
                                        Nombre del Rol
                                        <span class="text-danger"> *</span>
                                    </label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-shield-lock"></i>
                                    </span>
                                    <input type="text" name="name" id="name" class="form-control rounded-pill"
                                        value="" placeholder="ingresa el rol" required>
                                </div>
                                @error('name')
                                        <div>
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </div>
                                    @enderror
                            </div>
                        </div>

                        <hr class="text-primary w-50 my-4" style="height: 10px; opacity: 1;">
                        {{-- botones --}}
                        <div class="row justify-content-center mt-4">
                            <div>
                                <a href="{{ route('admin.roles.index') }}"
                                    class="btn btn-secondary btn-sm rounded-pill shadow-sm"><i class="bi bi-x-circle"></i>
                                    Cancelar</a>
                                <button type="submit" class="btn btn-primary btn-sm rounded-pill shadow-sm">
                                    <i class="bi bi-save"></i> Guardar
                                </button>
                            </div>
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
