<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Recuperar Contraseña | Municipalidad de La Victoria</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="font-family:'Poppins',sans-serif;background:#f4f6f9;">
  <header style="background:#001f60;color:white;padding:15px 40px;display:flex;align-items:center;">
    {{-- <a href="{{ route('login.index') }}" class="btn btn-light me-3">
      <i class="bi bi-arrow-left-circle-fill"></i> Atrás
    </a> --}}
    <img src="https://web.munilavictoria.gob.pe/mlv/assets/imgs/logo.png" alt="Logo" style="height:42px;margin-right:10px;">
    Municipalidad de La Victoria
  </header>

  <div class="container py-5">
    <div class="card shadow p-4 mx-auto" style="max-width:450px;border-radius:12px;">
      <h4 class="fw-bold text-center text-primary mb-3">¿Olvidaste tu contraseña?</h4>
      <p class="text-muted text-center mb-4">Ingresa tu correo y te enviaremos un enlace para restablecerla.</p>

      @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif

      <form method="POST" action="{{ route('olvide.password.send') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label fw-semibold">Correo electrónico</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" class="form-control" required placeholder="usuario@gmail.com">
          </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">
          <i class="bi bi-send"></i> Enviar enlace
        </button>
      </form>
    </div>
  </div>
</body>
</html>
