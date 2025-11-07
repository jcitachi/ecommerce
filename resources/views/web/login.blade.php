@extends('layouts.web')

@section('content')
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Acceder</h1>
        </div>
    </div><!-- End Page Title -->

    <!-- Login Section -->
    <section id="login" class="login section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="auth-container" data-aos="fade-in" data-aos-delay="200">

                        <!-- Login Form -->
                        <div class="auth-form login-form active">
                            <div class="form-header">
                                <h3>Bienvenido de Nuevo</h3>
                                <p>Inicia sesión en tu cuenta</p>
                            </div>

                            <form action="{{ route('web.autenticacion') }}" method="POST" class="auth-form-content">
                                @csrf
                                <div class="input-group mb-3">
                                    <span class="input-icon">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input name="email" id="email" type="email" class="form-control" placeholder="dirección de correo electrónico" required=""
                                        autocomplete="email">
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-icon">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input name="password" id="password" type="password" class="form-control" placeholder="Contraseña..." required=""
                                        autocomplete="current-password">
                                    <span class="password-toggle">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                </div>

                                <div class="form-options mb-4">
                                    <div class="remember-me">
                                        <input type="checkbox" id="rememberLogin">
                                        <label for="rememberLogin">Recuerdame</label>
                                    </div>
                                    <a href="#" class="forgot-password">¿Has olvidado la contraseña?</a>
                                </div>

                                <button type="submit" class="auth-btn primary-btn mb-3">
                                    Iniciar sesión
                                    <i class="bi bi-arrow-right"></i>
                                </button>

                                <div class="switch-form">
                                    <span>¿No tienes cuenta?</span>
                                    <a href="{{ route('web.registro')}}" type="button" class="switch-btn" data-target="register">Crear una cuenta</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Login Section -->
@stop
