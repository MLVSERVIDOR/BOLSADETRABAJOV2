@extends('plantilla.layouts.form')

@section('content')

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #fff; /* Fondo blanco normal */
    color: #333;
  }

  .auth-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }

  .card-login {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15); /* Sombra para resaltar */
    overflow: hidden;
    max-width: 950px;
    width: 100%;
    border: 1px solid #e0e0e0; /* Borde sutil */
  }

  /* 🔹 Lado izquierdo con el logo */
  .login-image {
    background: #f7f9fc;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 30px;
    position: relative;
  }

  /* Línea divisoria entre logo y formulario */
  .login-image::after {
    content: '';
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    height: 70%;
    width: 1px;
    background-color: #e0e0e0;
  }

  .login-image img {
    width: 100%;
    max-width: 320px;
    height: auto;
    object-fit: contain;
    margin-top: 20px;
  }

  /* Estilo para el texto sobre el logo */
  .logo-text {
    text-align: center;
    margin-bottom: 20px;
    color: #002060;
  }

  .logo-text h1 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 5px;
  }

  .logo-text h2 {
    font-size: 1.8rem;
    font-weight: 800;
    letter-spacing: 2px;
  }

  .login-form {
    padding: 60px 40px;
  }

  .login-form h3 {
    color: rgb(0, 32, 96);
    font-weight: 700;
    text-align: center;
    margin-bottom: 10px;
  }

  .login-form p.subtitle {
    text-align: center;
    color: #666;
    margin-bottom: 30px;
    font-size: 0.95rem;
  }

  .form-label {
    font-weight: 500;
    color: #444;
  }

  .input-group-text {
    background: rgb(0, 32, 96);
    color: #fff;
    border: none;
  }

  .form-control:focus {
    box-shadow: none;
    border-color: rgb(0, 32, 96);
  }

  .btn-primary {
    background-color: rgb(0, 32, 96);
    border-color: rgb(0, 32, 96);
    font-weight: 600;
    letter-spacing: 0.5px;
  }

  .btn-primary:hover {
    background-color: #0a2466;
    border-color: #0a2466;
  }

  .text-danger i {
    margin-right: 4px;
  }

  .footer-text {
    text-align: center;
    margin-top: 15px;
    color: #555;
    font-size: 0.9rem;
  }

  .footer-text a {
    color: rgb(0, 32, 96);
    text-decoration: none;
    font-weight: 600;
  }

  @media (max-width: 768px) {
    .login-image::after {
      display: none; /* Ocultar línea divisoria en móviles */
    }
    .login-form {
      padding: 40px 25px;
    }
  }
</style>

<div class="auth-wrapper">
  <div class="card-login row g-0">

    <!-- 🔹 Imagen lateral con logo -->
    <div class="col-md-6 login-image d-none d-md-flex">
      <!-- Texto sobre el logo -->
      <div class="logo-text">
        <h2>Encuentra el trabajo</h2>
        <h1>que estás buscando.</h1>
        {{-- <h2>LA VICTORIA</h2> --}}
      </div>
      
      <img src="{{ asset('images/imagenes/logo_muni_v2.png') }}" alt="Logo Municipalidad de La Victoria">
    </div>

    <!-- 🔹 Formulario -->
    <div class="col-md-6">
      <div class="login-form">
        <h3>Portal de Empleos</h3>
        <p class="subtitle">Ingresa tus credenciales para acceder</p>

        <form action="{{ route('login') }}" method="POST" novalidate>
          @csrf

          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label fw-bold">Correo electrónico</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
              <input 
                type="email" 
                name="email" 
                id="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="usuario@gmail.com"
                value="{{ old('email') }}" 
                required 
                autofocus>
            </div>
            @error('email')
              <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
            @enderror
          </div>

          <!-- Password -->
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
              <input 
                type="password" 
                name="password" 
                id="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Ingrese su contraseña"
                required>
              <span class="input-group-text toggle-password" style="cursor: pointer;"><i class="bi bi-eye"></i></span>
            </div>
            @error('password')
              <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
            @enderror
          </div>

          <!-- Recordarme -->
          <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label for="remember" class="form-check-label">Recuérdame</label>
          </div>

          <!-- Botón -->
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary btn-lg">
              <i class="bi bi-door-open-fill"></i> INGRESAR
            </button>
          </div>
          <p class="text-center mt-2">
            <a href="{{ route('olvide.password.index') }}" class="text-decoration-none fw-semibold">
              ¿Olvidaste tu contraseña?
            </a>
          </p>

          <p class="footer-text">
            ¿No tienes cuenta? <a href="{{ route('registrar.persona') }}">Regístrate aquí</a>
          </p>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Mostrar/ocultar contraseña -->
<script>
document.querySelector('.toggle-password').addEventListener('click', function() {
  const input = document.getElementById('password');
  const icon = this.querySelector('i');
  if (input.type === 'password') {
    input.type = 'text';
    icon.classList.replace('bi-eye', 'bi-eye-slash');
  } else {
    input.type = 'password';
    icon.classList.replace('bi-eye-slash', 'bi-eye');
  }
});
</script>
@endsection