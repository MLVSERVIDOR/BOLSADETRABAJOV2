<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $categoria->nombre }} | Portal de Empleos</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    :root {
      --azul: #001f60;
      --gris-fondo: #f4f6f9;
      --gris-card: #fff;
      --borde: #e3e7ef;
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

    header img {
      height: 42px;
      margin-right: 10px;
    }

    header .title {
      display: flex;
      align-items: center;
      font-weight: 600;
      font-size: 1.1rem;
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

    /* Layout principal */
    .container-fluid {
      padding: 35px 45px;
    }

    h4.titulo {
      font-weight: 700;
      color: var(--azul);
      margin-bottom: 30px;
    }

    /* Card de empleo */
    .job-card {
      background: var(--gris-card);
      border-radius: 15px;
      padding: 25px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
      border: 1px solid var(--borde);
      transition: 0.3s;
      cursor: pointer;
    }

    .job-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    }

    .job-left {
      display: flex;
      align-items: flex-start;
      gap: 20px;
      flex: 1;
    }

    .job-icon {
      font-size: 2.3rem;
      color: var(--azul);
      background: #eef2f8;
      padding: 18px;
      border-radius: 12px;
      flex-shrink: 0;
    }

    .job-info h5 {
      font-weight: 700;
      color: var(--azul);
      margin-bottom: 5px;
      font-size: 1.1rem;
    }

    .job-info small {
      color: #777;
      display: block;
      margin-bottom: 5px;
    }

    .job-info p {
      color: #555;
      font-size: 0.95rem;
      margin: 0;
    }

    .job-right {
      text-align: right;
      min-width: 220px;
    }

    .job-right .precio {
      background: var(--azul);
      color: white;
      padding: 6px 12px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.9rem;
      margin-bottom: 10px;
      display: inline-block;
    }

    .job-right .ubicacion {
      font-size: 0.9rem;
      color: #666;
      margin-bottom: 5px;
    }

    .btn-detalle {
      background: transparent;
      border: 1.5px solid var(--azul);
      color: var(--azul);
      border-radius: 8px;
      font-weight: 600;
      padding: 8px 18px;
      font-size: 0.9rem;
      transition: 0.3s;
    }

    .btn-detalle:hover {
      background: var(--azul);
      color: white;
    }

    /* Panel de información (derecha) */
    .info-panel {
      background: #fff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      min-height: 100%;
      border: 1px solid var(--borde);
    }

    .info-panel h5 {
      font-weight: 700;
      color: var(--azul);
    }

    .info-panel p {
      font-size: 0.95rem;
      color: #555;
    }

    .info-panel label {
      font-weight: 600;
      color: #001f60;
      margin-top: 10px;
    }

    @media (max-width: 992px) {
      .container-fluid {
        padding: 20px;
      }

      .job-card {
        flex-direction: column;
        text-align: center;
        align-items: center;
        gap: 10px;
      }

      .job-right {
        text-align: center;
        margin-top: 10px;
      }
    }
  </style>

</head>

<body>
  <header style="background: var(--azul); color: white; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center;">
    <div class="d-flex align-items-center gap-3">
      <!-- 🔹 Botón Atrás (redirige al inicio) -->
      <a href="{{ route('welcome') }}" 
        class="btn btn-light d-flex align-items-center gap-2 px-3 py-2 fw-semibold border-0 shadow-sm"
        style="border-radius: 50px; transition: 0.3s;">
        <i class="bi bi-arrow-left-circle text-primary fs-5"></i>
        <span class="text-primary">Atrás</span>
      </a>

      <!-- 🔹 Logo y título -->
      <div class="title d-flex align-items-center ms-3" style="font-weight: 600; font-size: 1.1rem;">
        <img src="{{ asset('images/imagenes/logo_muni_v2.png') }}" alt="Logo" style="height: 42px; margin-right: 10px;">
        Municipalidad de La Victoria
      </div>
    </div>

    <!-- 🔹 Botón Cerrar Sesión -->
    <a href="{{ route('logout') }}" class="logout">
      <i class="bi bi-door-open"></i> Cerrar Sesión
    </a>
  </header>






  <div class="container-fluid">
    <div class="row g-4">
      <!-- 🔹 Listado de empleos -->
      <div class="col-lg-7">
        <h4 class="titulo">Ofertas de {{ $categoria->nombre }}</h4>

        @forelse($empleos as $empleo)
          <div class="job-card" onclick="mostrarDetalle({{ $empleo->id }})">
            <div class="job-left">
              <i class="{{ $empleo->categoria_icono ?? $categoria->icono ?? 'bi bi-briefcase' }} job-icon"></i>
              <div class="job-info">
                <h5>{{ $empleo->puesto }}</h5>
                <small>Publicado el {{ \Carbon\Carbon::parse($empleo->created_at)->format('d/m/Y') }}</small>
                <p>{{ Str::limit($empleo->descripcion, 100, '...') }}</p>
              </div>
            </div>
            <div class="job-right">
              <div class="precio">S/ {{ number_format($empleo->sueldo, 2) }}</div>
              <div class="ubicacion"><i class="bi bi-geo-alt"></i> Lima, Perú</div>
              <div class="ubicacion"><i class="bi bi-building"></i> Presencial</div>
              <button class="btn btn-detalle mt-2">
                <i class="bi bi-eye"></i> Ver Detalles
              </button>
            </div>
          </div>
        @empty
          <div class="text-center text-muted mt-5">
            <p><i class="bi bi-briefcase"></i> No hay empleos publicados para esta categoría.</p>
          </div>
        @endforelse
      </div>

      <!-- 🔹 Panel con la información -->
      <div class="col-lg-5">
        <div class="info-panel" id="info-panel">
          <h5>Selecciona una oferta para ver más información</h5>
          <p>Haz clic en cualquiera de las ofertas de la izquierda para visualizar los detalles completos aquí.</p>
        </div>
      </div>
    </div>
  </div>



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  function mostrarDetalle(id) {
  const panel = $('#info-panel');
  panel.html(`
    <div class="text-center py-5">
      <div class="spinner-border text-primary" role="status"></div>
      <p class="mt-3 fw-semibold text-secondary">Cargando información...</p>
    </div>
  `);

  $.ajax({
    url: `/persona/anuncio/${id}`,
    method: 'GET',
    dataType: 'json',
    success: function(data) {
      panel.html(`
        <h5 class="mb-3"><i class="bi bi-briefcase"></i> ${data.puesto}</h5>
        <label>Categoría:</label><p>${data.categoria ?? 'No especificada'}</p>
        <label>Modalidad:</label><p>${data.modalidad ?? 'No especificada'}</p>
        <label>Vacantes:</label><p>${data.vacantes} plazas disponibles</p>
        <label>Sueldo:</label><p><b>S/ ${parseFloat(data.sueldo).toFixed(2)}</b></p>
        <label>Descripción:</label><p>${data.descripcion || 'No disponible'}</p>
        <label>Condiciones:</label><p>${data.condiciones || 'No especificadas'}</p>
        <label>Fecha límite de postulación:</label>
        <p><i class="bi bi-calendar-event"></i> ${new Date(data.fecha_limite).toLocaleDateString('es-PE')}</p>
        <div class="mt-4 text-end">
          <button class="btn btn-detalle btnPostular" data-id="${data.id}">
            <i class="bi bi-send"></i> Postular Ahora
          </button>
        </div>
      `);
    },
    error: function() {
      panel.html(`
        <div class="text-center text-danger py-5">
          <i class="bi bi-exclamation-triangle fs-1"></i>
          <p class="mt-3">Error al obtener el empleo.</p>
        </div>
      `);
    }
  });
}
</script>


<script>
  $(document).on('click', '.btnPostular', function() {
    const anuncioId = $(this).data('id');

    Swal.fire({
      title: '¿Deseas postular a este empleo?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí, postular',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#2563eb',
      cancelButtonColor: '#6b7280'
    }).then((result) => {
      if (result.isConfirmed) {
        fetch(`/persona/postular/${anuncioId}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.ok) {
            Swal.fire('✅ Éxito', data.mensaje, 'success');
          } else {
            Swal.fire('⚠️ Aviso', data.mensaje, 'warning');
          }
        })
        .catch(() => {
          Swal.fire('❌ Error', 'Ocurrió un error al enviar la postulación.', 'error');
        });
      }
    });
  });
</script>





</body>
</html>
