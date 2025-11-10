@can('ver-empresa')
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Postulaciones Recibidas | Municipalidad de La Victoria</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

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

    /* 🔹 HEADER */
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

    .main-container {
      padding: 25px;
    }

    /* 🔹 CARD */
    .card-oferta {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      width: 110%;
      max-width: 1100px;
      margin: 0 auto;
      padding: 20px 35px;
      border: 1px solid #eaeaea;
      animation: fadeIn 0.5s ease-in-out;
    }

    h3.titulo-principal {
      text-align: center;
      font-weight: 700;
      font-size: 1.6rem;
      color: var(--azul);
    }

    .subtitulo {
      text-align: center;
      color: #777;
      font-size: 0.95rem;
      margin-bottom: 20px;
    }

    .tabla-postulaciones thead th {
      background-color: #194c97 !important;
      color: #fff !important;
      text-align: center;
      border: none;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .tabla-postulaciones tbody td {
      vertical-align: middle;
      text-align: center;
      background: #f8f9fa;
    }

    .tabla-postulaciones tbody tr:hover td {
      background: rgba(13, 110, 253, 0.08);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .btn-outline-primary {
      border-radius: 10px;
      font-weight: 600;
      padding: 8px 20px;
    }

    .btn-sm {
      border-radius: 8px;
      padding: 5px 10px;
      font-size: 0.85rem;
    }
  </style>
</head>

<body>

  <!-- 🔹 HEADER -->
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

  <!-- 🔹 CONTENIDO -->
  <div class="main-container">
    <div class="card-oferta">
      <h3 class="titulo-principal">Postulaciones Recibidas</h3>
      <p class="subtitulo">Visualiza todas las postulaciones a tus ofertas laborales</p>

      <hr>

      <div class="table-responsive">
        <table class="table table-bordered tabla-postulaciones align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>Puesto</th>
              <th>Postulante</th>
              <th>Documento</th>
              <th>Correo</th>
              <th>Currículum</th>
              <th>Estado</th>
              <th>Fecha</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($postulaciones as $index => $p)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->puesto }}</td>
                <td>{{ $p->nombres }} {{ $p->apellido_paterno }} {{ $p->apellido_materno }}</td>
                <td>{{ $p->nro_documento }}</td>
                <td>{{ $p->email }}</td>
                <td>
                  @if($p->curriculum_vitae)
                    <a href="{{ asset('storage/' . $p->curriculum_vitae) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                      <i class="bi bi-file-earmark-text"></i> Ver CV
                    </a>
                  @else
                    <span class="text-muted">No adjunto</span>
                  @endif
                </td>
                <td>
                  @if($p->estado == 1)
                    <span class="badge bg-warning text-dark">En revisión</span>
                  @elseif($p->estado == 2)
                    <span class="badge bg-success">Aceptado</span>
                  @else
                    <span class="badge bg-danger">Rechazado</span>
                  @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y') }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center text-muted py-4">
                  <i class="bi bi-inbox"></i> No hay postulaciones recibidas aún.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>
</html>
@endcan
