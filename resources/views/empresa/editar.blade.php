@can('ver-empresa')
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Ofertas Laborales | Municipalidad de La Victoria</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- DataTables CSS -->
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    :root {
      --azul: #001f60;
      --gris-fondo: #f4f6f9;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--gris-fondo);
      color: #333;
    }

    header {
      background: var(--azul);
      color: white;
      padding: 15px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header .title {
      display: flex;
      align-items: center;
      font-weight: 600;
      font-size: 1.1rem;
    }

    header img {
      height: 42px;
      margin-right: 10px;
    }

    .logout {
      border: 2px solid #fff;
      padding: 6px 15px;
      border-radius: 10px;
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      transition: 0.3s;
    }

    .logout:hover {
      background: #fff;
      color: var(--azul);
    }

    .btn-atras {
      background: #fff;
      color: var(--azul);
      font-weight: 600;
      border: none;
      border-radius: 50px;
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 6px 14px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
      transition: 0.3s;
    }

    .btn-atras:hover {
      background: #e8eefc;
    }

    .main-container {
      padding: 25px;
    }

    .card-oferta {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      width: 110%;
      max-width: 1100px; /* 🔸 tamaño más pequeño y centrado */
      margin: 0 auto;   /* 🔸 centrado horizontal */
      padding: 20px 35px;
      border: 1px solid #eaeaea;
      animation: fadeIn 0.5s ease-in-out;
    }

    .header-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 15px;
      margin-bottom: 1.5rem;
    }

    .title-section h3 {
      font-weight: 700;
      font-size: 1.5rem;
      color: #001f60;
      margin-bottom: 5px;
    }

    .button-group {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .btn-outline-primary {
      border: 1px solid #0B47DF;
      color: #0B47DF;
      font-weight: 600;
      border-radius: 8px;
    }

    .btn-outline-primary:hover {
      background: #0B47DF;
      color: white;
    }

    .btn-primary {
      background-color: #0B47DF;
      border-color: #0B47DF;
      font-weight: 600;
      border-radius: 8px;
    }

    .btn-primary:hover {
      background-color: #0a3dc9;
    }

    .form-label {
      font-weight: 600;
    }

    .form-control {
      border-radius: 8px;
      border: 1px solid #d1d5db;
    }

    .tabla-ofertas thead th {
      background-color: #194c97 !important;
      color: #fff !important;
      text-align: center;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.8rem;
    }

    .tabla-ofertas tbody td {
      text-align: center;
      font-size: 0.9rem;
      vertical-align: middle;
    }

    .badge {
      font-size: 0.75rem;
      padding: 6px 10px;
      border-radius: 20px;
      font-weight: 600;
    }

    .bg-pendiente { background-color: #ffc107 !important; color: #212529 !important; }
    .bg-aprobado { background-color: #198754 !important; color: white !important; }
    .bg-rechazado { background-color: #dc3545 !important; color: white !important; }

    .dot-blink {
      position: absolute;
      top: -4px;
      right: -4px;
      width: 10px;
      height: 10px;
      background-color: #64e77e;
      border-radius: 50%;
      animation: blink 1s infinite;
      box-shadow: 0 0 6px rgba(68, 219, 91, 0.672);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <header>
    <div class="d-flex align-items-center gap-3">
      <a href="{{ route('empresa.index') }}" class="btn-atras">
        <i class="bi bi-arrow-left-circle-fill"></i> Atrás
      </a>
      <div class="title">
        <img src="{{ asset('images/imagenes/logo_muni_v2.png') }}" alt="Logo">
        Municipalidad de La Victoria
      </div>
    </div>

    <div class="d-flex align-items-center gap-3">
      <a href="{{ route('perfil.index') }}" class="btn btn-light fw-semibold">
        <i class="bi bi-person-circle"></i> Mi Perfil
      </a>
      <a href="{{ route('logout') }}" class="logout">
        <i class="bi bi-door-open"></i> Cerrar Sesión
      </a>
    </div>
  </header>

<br>
<br>
<div class="auth-wrapper">
  <div class="card-oferta">

    <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
        <h3 class="titulo-principal mb-0">Editar Anuncio</h3>
        <p class="text-muted mb-0">Modifica la información del puesto</p>
      </div>
      <button class="btn btn-primary px-5 py-2" onclick="window.location='{{ route('empresa.index') }}'">
        <i class="bi bi-arrow-left-circle"></i> Volver
      </button>
    </div>

    <hr>

    <form action="{{ route('empresa.update', $anuncio->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="row mb-4">
        <div class="col-md-6">
          <label class="form-label">Puesto</label>
          <input type="text" name="puesto" class="form-control" value="{{ old('puesto', $anuncio->puesto) }}" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Categoría Ocupacional</label>
          <select name="id_categoria_ocupacionals" class="form-select" required>
            <option value="">--- Seleccione ---</option>
            @foreach ($categoria_ocupacional as $cat)
              <option value="{{ $cat->id }}" {{ $cat->id == $anuncio->id_categoria_ocupacionals ? 'selected' : '' }}>
                {{ $cat->nombre }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-3">
          <label class="form-label">Modalidad</label>
          <select name="id_modalidads" class="form-select" required>
            <option value="">--- Seleccione ---</option>
            @foreach ($modalidad as $mod)
              <option value="{{ $mod->id }}" {{ $mod->id == $anuncio->id_modalidads ? 'selected' : '' }}>
                {{ $mod->nombre }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-3">
          <label class="form-label">Vacantes</label>
          <input type="number" name="vacantes" class="form-control" min="1" max="10" value="{{ old('vacantes', $anuncio->vacantes) }}" required>
        </div>

        <div class="col-md-3">
          <label class="form-label">Sueldo</label>
          <div class="input-group">
            <span class="input-group-text bg-light fw-bold">S/.</span>
            <input type="number" name="sueldo" class="form-control" step="0.01" min="0" max="10000"
              value="{{ old('sueldo', $anuncio->sueldo) }}" placeholder="0.00">
          </div>
        </div>

        <div class="col-md-3">
          <label class="form-label">Fecha Límite</label>
          <input type="date" name="fecha_limite" class="form-control"
            min="{{ now()->format('Y-m-d') }}"
            max="{{ now()->addDays(30)->format('Y-m-d') }}"
            value="{{ old('fecha_limite', $anuncio->fecha_limite) }}">
        </div>
      </div>

      <div class="mb-4">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control" rows="4">{{ old('descripcion', $anuncio->descripcion) }}</textarea>
      </div>

      <div class="mb-4">
        <label class="form-label">Condiciones</label>
        <textarea name="condiciones" class="form-control" rows="4">{{ old('condiciones', $anuncio->condiciones) }}</textarea>
      </div>

      <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary px-5 py-2">
          <i class="bi bi-save"></i> Actualizar Anuncio
        </button>
      </div>

    </form>
  </div>
</div>
</body>
</html>
@endcan

