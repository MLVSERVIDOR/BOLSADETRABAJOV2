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
    <!-- 🔹 Botón de Iniciar Sesión -->
    <a href="{{ route('login') }}" class="btn-login">
      <i class="bi bi-door-open"></i> Iniciar sesión
    </a>

    <div class="register-header">
      <img src="{{ asset('images/imagenes/logo_la_victoria.png') }}" alt="Logo Municipalidad de La Victoria">
      <h3 id="form-title">Crea tu cuenta</h3>
      <p id="form-subtitle">Es rápido y fácil</p>

      <div class="register-switch">
        <button id="btn-persona" class="switch-btn active">Soy Persona</button>
        <a href="{{ route('registrar.empresa') }}" id="btn-empresa" class="switch-btn "> {{-- Añade clases de botón si usas Bootstrap u otro framework --}}
            Soy Empresa
        </a>      
      </div>
    </div>

    {{-- 🔹 SweetAlert2 para mostrar errores --}}
    @if ($errors->any())
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      Swal.fire({
        icon: 'error',
        title: '¡ERROR!',
        html: `
            <ul style="text-align:left;">
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

<div id="form-persona" class="form-section">
    <form method="POST" action="{{ route('registrar.persona') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_tipo_usuario" value="1">

        {{-- Fila 1 --}}
        <div class="row g-2"> 
            <div class="col-md-4">
                <label class="form-label">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" class="form-control @error('apellido_paterno', 'persona') is-invalid @enderror" value="{{ old('apellido_paterno') }}" required>
                @error('apellido_paterno', 'persona') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Apellido Materno</label>
                <input type="text" name="apellido_materno" class="form-control @error('apellido_materno', 'persona') is-invalid @enderror" value="{{ old('apellido_materno') }}" required>
                @error('apellido_materno', 'persona') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Nombres</label>
                <input type="text" name="nombres" class="form-control @error('nombres', 'persona') is-invalid @enderror" value="{{ old('nombres') }}" required>
                @error('nombres', 'persona') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        {{-- Fila 2 - Añadido mt-2 --}}
        <div class="row g-1 mt-1"> 
             <div class="col-md-5">
                <label class="form-label">Tipo y Número de Documento</label>
                <div class="input-group">
                    <select name="id_tipo_documentos" class="form-select @error('id_tipo_documentos', 'persona') is-invalid @enderror" required style="max-width: 200px;">
                        <option value="" selected disabled>Tipo</option>
                        @foreach ($tipo_documento as $tipo)
                            <option value="{{ $tipo->id }}" {{ old('id_tipo_documentos') == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" name="nro_documento" class="form-control @error('nro_documento', 'persona') is-invalid @enderror" placeholder="Número" maxlength="15" pattern="[0-9]*" inputmode="numeric" value="{{ old('nro_documento') }}" required>
                </div>
                @error('id_tipo_documentos', 'persona') <small class="text-danger d-block">{{ $message }}</small> @enderror
                @error('nro_documento', 'persona') <small class="text-danger d-block">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento', 'persona') is-invalid @enderror" value="{{ old('fecha_nacimiento') }}" required>
                @error('fecha_nacimiento', 'persona') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
             <div class="col-md-4">
                <label class="form-label">Celular</label>
                <input type="text" name="celular" class="form-control @error('celular', 'persona') is-invalid @enderror" maxlength="15" pattern="[0-9]*" inputmode="numeric" value="{{ old('celular') }}" required>
                 @error('celular', 'persona') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        {{-- Fila 3 - Añadido mt-2 --}}
        <div class="row g-2 mt-2"> 
            <div class="col-md-12">
                <label class="form-label">Carga de CV</label>
                <small class="text-muted d-block mb-1">(Opcional. Formatos: PDF, DOC, DOCX. Tamaño máximo 500 MB)</small>
                <input type="file" name="curriculum_vitae" class="form-control @error('curriculum_vitae', 'persona') is-invalid @enderror" accept=".pdf,.doc,.docx">
                @error('curriculum_vitae', 'persona') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        {{-- Fila 4 - Añadido mt-2 --}}
        <div class="row g-2 mt-2"> 
            <div class="col-md-6">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="email" class="form-control @error('email', 'persona') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email', 'persona') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Repite correo electrónico</label>
                <input type="email" name="email_confirmation" class="form-control" required>
            </div>
        </div>

        {{-- Fila 5 - Añadido mt-2 --}}
        <div class="row g-2 mt-2"> 
            <div class="col-md-6">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control @error('password', 'persona') is-invalid @enderror" required>
                 @error('password', 'persona') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Repite contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
        </div>

        <div class="d-grid mt-3"> 
            <button type="submit" class="btn btn-primary">Registrarte</button>
        </div>
    </form>
</div>



{{-- ================== SCRIPT ================== --}}
<script>
  const btnPersona = document.getElementById('btn-persona');
  const btnEmpresa = document.getElementById('btn-empresa');
  const formPersona = document.getElementById('form-persona');
  const formEmpresa = document.getElementById('form-empresa');
  const title = document.getElementById('form-title');
  const subtitle = document.getElementById('form-subtitle');

  btnPersona.addEventListener('click', () => {
    btnPersona.classList.add('active');
    btnEmpresa.classList.remove('active');
    formPersona.classList.remove('hidden');
    formEmpresa.classList.add('hidden');
    title.textContent = 'Crea tu cuenta';
    subtitle.textContent = 'Es rápido y fácil';
  });

  btnEmpresa.addEventListener('click', () => {
    btnEmpresa.classList.add('active');
    btnPersona.classList.remove('active');
    formEmpresa.classList.remove('hidden');
    formPersona.classList.add('hidden');
    title.textContent = 'Registra tu Empresa';
    subtitle.textContent = 'Es rápido y fácil';
  });
</script>
@endsection