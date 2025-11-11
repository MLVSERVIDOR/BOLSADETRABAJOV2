<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Restablecer Contraseña | Municipalidad de La Victoria</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="font-family:'Poppins',sans-serif;background:#f4f6f9;">
  <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card p-4 shadow-lg" style="max-width:500px;width:100%;">
      <h4 class="text-center text-primary fw-bold mb-3">Restablecer Contraseña</h4>
      @if (session('status'))
        <div class="alert alert-danger">{{ session('status') }}</div>
      @endif
      <form method="POST" action="{{ route('olvide.password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <div class="mb-3">
          <label class="form-label fw-semibold">Nueva contraseña</label>
          <input type="password" name="password" class="form-control" required placeholder="••••••">
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Confirmar contraseña</label>
          <input type="password" name="password_confirmation" class="form-control" required placeholder="••••••">
        </div>
        <button type="submit" class="btn btn-primary w-100">Guardar nueva contraseña</button>
      </form>
    </div>
  </div>
</body>
</html>
