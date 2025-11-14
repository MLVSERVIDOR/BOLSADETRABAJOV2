@extends('plantilla.layouts.form')

@section('content')
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, rgba(0, 32, 96, 0.9), rgba(0, 32, 96, 0.7)),
    url('{{ asset("images/imagenes/bg_trabajo.jpg") }}') no-repeat center center fixed;
    background-size: cover;
  }

  .register-wrapper {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 40px 15px;
  }

  .card-register {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    width: 100%;
    max-width: 950px;
    overflow: hidden;
    position: relative;
  }

  /* Botón Iniciar Sesión */
  .btn-login {
    position: absolute;
    top: 20px;
    right: 25px;
    background: transparent;
    border: 2px solid rgb(0, 32, 96);
    color: rgb(0, 32, 96);
    font-weight: 600;
    font-size: 0.9rem;
    border-radius: 6px;
    padding: 6px 15px;
    transition: all 0.25s ease-in-out;
  }

  .btn-login:hover {
    background: rgb(0, 32, 96);
    color: #fff;
    box-shadow: 0 0 10px rgba(0, 32, 96, 0.3);
  }

  .register-header {
    text-align: center;
    padding: 25px 20px 10px;
    border-bottom: 1px solid #eee;
  }

  .register-header img {
    max-width: 180px;
  }

  .register-header h3 {
    font-weight: 700;
    color: rgb(0, 32, 96);
    margin-top: 8px;
  }

  .register-header p {
    color: #777;
    font-size: 0.9rem;
    margin-bottom: 10px;
  }

  .register-switch {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
  }

  .switch-btn {
    flex: 1;
    max-width: 180px;
    padding: 8px 0;
    border: 2px solid rgb(0, 32, 96);
    border-radius: 6px;
    background: #fff;
    color: rgb(0, 32, 96);
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.25s ease-in-out;
    cursor: pointer;
  }

  .switch-btn:hover,
  .switch-btn.active {
    background: rgb(0, 32, 96);
    color: #fff;
    box-shadow: 0 0 10px rgba(0, 32, 96, 0.3);
  }

  .form-section {
    padding: 18px 35px 30px;
    transition: all 0.3s ease;
  }

  .form-section.hidden {
    padding: 18px 35px 30px;
    transition: all 0.3s ease;
  }

  .form-label {
    font-weight: 500;
    color: #333;
    font-size: 0.9rem;
    margin-bottom: 3px;
  }

  .form-control {
    height: 38px;
    padding: 6px 10px;
    font-size: 0.9rem;
  }

  textarea.form-control {
    height: 70px;
    resize: none;
  }

  .btn-primary {
    background-color: rgb(0, 32, 96);
    border-color: rgb(0, 32, 96);
    font-weight: 600;
    height: 42px;
    font-size: 0.95rem;
  }

  .btn-primary:hover {
    background-color: #0a2466;
  }

  .footer-text {
    text-align: center;
    font-size: 0.85rem;
    margin-top: 10px;
  }

  .footer-text a {
    color: rgb(0, 32, 96);
    text-decoration: none;
    font-weight: 600;
  }
</style>

<div class="register-wrapper">
    <div class="card-register">
        <a href="{{ route('login') }}" class="btn-login">
            <i class="bi bi-door-open"></i> Iniciar sesión
        </a>

        <div class="register-header">
            <img src="{{ asset('images/imagenes/logo_la_victoria.png') }}" alt="Logo Municipalidad de La Victoria">
            {{-- Títulos fijos para Empresa --}}
            <h3 id="form-title">Registra tu Empresa</h3>
            <p id="form-subtitle">Es rápido y fácil</p>

            <div class="register-switch">
              <a href="{{ route('registrar.persona') }}" id="btn-persona" class="switch-btn">Soy Persona</a>
              <a href="{{ route('registrar.empresa') }}" id="btn-empresa" class="switch-btn active"> {{-- Añade clases de botón si usas Bootstrap u otro framework --}}
                  Soy Empresa
              </a>      
            </div>
        </div>

        {{-- 🔹 SweetAlert2 para mostrar errores (sin cambios) --}}
        @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: '¡ERROR!',
                html: `
                    <ul style="text-align:left; padding-left: 1.5rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#d33'
            });
        </script>
        @endif

        {{-- Eliminado el DIV de form-persona --}}

        {{-- ================= FORMULARIO EMPRESA (Siempre visible) ================= --}}
        {{-- Quitada la clase 'hidden' --}}
        <div id="form-empresa" class="form-section"> 
            <form method="POST" action="{{ route('registrar.empresa') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id_tipo_usuario" value="2">

    <h5><strong>Datos de la Empresa :</strong></h5>
    <br>
    <div class="row g-2">
        <div class="col-md-6">
            <label class="form-label">Número de RUC</label>
            <input type="text" name="nro_ruc" class="form-control @error('nro_ruc') is-invalid @enderror" maxlength="11" pattern="[0-9]*" inputmode="numeric" value="{{ old('nro_ruc') }}" required>
            @error('nro_ruc') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Razón Social</label>
            <input type="text" name="razon_social" class="form-control @error('razon_social') is-invalid @enderror" value="{{ old('razon_social') }}" required>
            @error('razon_social') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="row g-2 mt-2">
        <div class="col-md-12">
            <label class="form-label">Dirección de la empresa</label>
            <input type="text" name="direccion_empresa" class="form-control @error('direccion_empresa') is-invalid @enderror" value="{{ old('direccion_empresa') }}" required>
            @error('direccion_empresa') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="row g-2 mt-2">
        <div class="col-md-12">
            <label class="form-label">Descripción del rubro</label>
            <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" required>{{ old('descripcion') }}</textarea>
            @error('descripcion') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="row g-2 mt-2">
        <div class="col-md-12">
            <label class="form-label">Cargar Logo</label>
            <small class="text-muted d-block mb-1">(Opcional. Formatos: JPG, PNG, JPEG, SVG. Tamaño máximo 25 MB)</small>
            <input type="file" name="url_logo" class="form-control @error('url_logo') is-invalid @enderror" accept=".jpg,.png,.jpeg,.svg">
            @error('url_logo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <hr class="my-3">
    <h5 class="mt-3"><strong>Datos del Administrador :</strong></h5>
    <div class="row g-2 mt-2">
        <div class="col-md-4">
            <label class="form-label">Apellido Paterno</label>
            <input type="text" name="apellido_paterno" class="form-control @error('apellido_paterno') is-invalid @enderror" value="{{ old('apellido_paterno') }}" required>
            @error('apellido_paterno') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Apellido Materno</label>
            <input type="text" name="apellido_materno" class="form-control @error('apellido_materno') is-invalid @enderror" value="{{ old('apellido_materno') }}" required>
            @error('apellido_materno') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Nombres</label>
            <input type="text" name="nombres" class="form-control @error('nombres') is-invalid @enderror" value="{{ old('nombres') }}" required>
            @error('nombres') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="row g-2 mt-2">
        <div class="col-md-8">
            <label class="form-label">Tipo y Número de Documento</label>
            <div class="input-group">
                <select name="id_tipo_documentos" class="form-select @error('id_tipo_documentos') is-invalid @enderror" required style="max-width: 120px;">
                    <option value="" selected disabled>Tipo</option>
                    @foreach ($tipo_documento as $tipo)
                        <option value="{{ $tipo->id }}" {{ old('id_tipo_documentos') == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->nombre }}
                        </option>
                    @endforeach
                </select>
                <input type="text" name="nro_documento" class="form-control @error('nro_documento') is-invalid @enderror" placeholder="Número" maxlength="15" pattern="[0-9]*" inputmode="numeric" value="{{ old('nro_documento') }}" required>
            </div>
            @error('id_tipo_documentos') <small class="text-danger d-block">{{ $message }}</small> @enderror
            @error('nro_documento') <small class="text-danger d-block">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Celular</label>
            <input type="text" name="celular" class="form-control @error('celular') is-invalid @enderror" pattern="[0-9]*" inputmode="numeric" maxlength="15" value="{{ old('celular') }}" required>
            @error('celular') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="row g-2 mt-2">
        <div class="col-md-6">
            <label class="form-label">Correo electrónico</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="d-grid mt-3">
        <button type="submit" class="btn btn-primary">Registrar Empresa</button>
    </div>
</form>
        </div>

    </div>
</div>

{{-- Eliminado el SCRIPT para cambiar formularios --}}
@endsection