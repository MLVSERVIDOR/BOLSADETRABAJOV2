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

  <!-- 🔹 HEADER -->
  <header>
    <div class="d-flex align-items-center gap-3">
      <a href="{{ route('empresa.index') }}" class="btn-atras">
        <i class="bi bi-arrow-left-circle-fill"></i> Atrás
      </a>
      <div class="title">
        <img src="https://web.munilavictoria.gob.pe/mlv/assets/imgs/logo.png" alt="Logo">
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
      <div class="header-section">
        <div class="title-section">
          <h3>Registro de Ofertas Laborales</h3>
          <p>Gestiona y controla tus anuncios fácilmente</p>
        </div>


      </div>

      <hr>

          <!-- 🔹 Formulario -->
<form id="formAnuncio" action="{{ route('empresa.store') }}" method="POST">
  @csrf

  <div class="row mb-4">
    <div class="col-md-6">
      <label class="form-label fw-semibold">Puesto</label>
      <input type="text" name="puesto" class="form-control" placeholder="Ej. Desarrollador Backend" required>
    </div>
    <div class="col-md-6">
      <label class="form-label fw-semibold">Categoría Ocupacional</label>
      <select name="id_categoria_ocupacionals" class="form-select" required>
        <option value="">--- Seleccione ---</option>
        @foreach ($categoria_ocupacional as $cat)
        <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-3">
      <label class="form-label fw-semibold">Modalidad</label>
      <select name="id_modalidads" class="form-select" required>
        <option value="">--- Seleccione ---</option>
        @foreach ($modalidad as $mod)
        <option value="{{ $mod->id }}">{{ $mod->nombre }}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-3">
      <label class="form-label fw-semibold">Vacantes</label>
      <div class="input-group">
        <button class="btn btn-outline-secondary" type="button" id="vacantes-minus">−</button>
        <input type="number" name="vacantes" id="vacantes" class="form-control text-center" min="1" max="10" value="1" required>
        <button class="btn btn-outline-secondary" type="button" id="vacantes-plus">+</button>
      </div>
    </div>

    <div class="col-md-3">
      <label class="form-label fw-semibold">Sueldo</label>
      <div class="input-group">
        <span class="input-group-text bg-light fw-bold">S/.</span>
        <input type="number" name="sueldo" class="form-control" step="0.01" min="0" max="10000" placeholder="0.00" required>
      </div>
    </div>

    <div class="col-md-3">
      <label class="form-label fw-semibold">Fecha Límite</label>
      <input type="date" name="fecha_limite" class="form-control"
        min="{{ now()->format('Y-m-d') }}"
        max="{{ now()->addDays(30)->format('Y-m-d') }}"
        value="{{ now()->format('Y-m-d') }}" required>
    </div>
  </div>

  <div class="mb-4">
    <label class="form-label fw-semibold">Descripción</label>
    <textarea name="descripcion" class="form-control" rows="5"
      placeholder="Describe las responsabilidades y requisitos del puesto" required></textarea>
  </div>

  <div class="mb-4">
    <label class="form-label fw-semibold">Condiciones</label>
    <textarea name="condiciones" class="form-control" rows="4"
      placeholder="Condiciones adicionales, beneficios o detalles relevantes (opcional)"></textarea>
  </div>

  <div class="text-center mt-3">
    <button type="submit" class="btn btn-primary px-5 py-2">
      <i class="bi bi-save"></i> Grabar Anuncio
    </button>
  </div>
</form>


    </div>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formAnuncio');
    const minus = document.getElementById('vacantes-minus');
    const plus = document.getElementById('vacantes-plus');
    const inputVacantes = document.getElementById('vacantes');

    // Controles de vacantes
    minus.addEventListener('click', () => {
      let val = parseInt(inputVacantes.value) || 1;
      if (val > 1) inputVacantes.value = val - 1;
    });

    plus.addEventListener('click', () => {
      let val = parseInt(inputVacantes.value) || 1;
      inputVacantes.value = val + 1;
    });

    // 🔹 SweetAlert al enviar formulario
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      // Validar campos requeridos excepto "condiciones"
      const requiredFields = form.querySelectorAll('[required]');
      let valid = true;

      requiredFields.forEach(field => {
        if (!field.value.trim()) valid = false;
      });

      if (!valid) {
        Swal.fire({
          icon: 'warning',
          title: 'Campos incompletos',
          text: 'Por favor, complete todos los campos obligatorios antes de grabar.',
          confirmButtonColor: '#0d6efd'
        });
        return;
      }

      // Confirmación antes de enviar
      Swal.fire({
        title: '¿Grabar anuncio laboral?',
        text: 'Confirme que los datos son correctos antes de registrar el anuncio.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, grabar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#0B47DF',
        cancelButtonColor: '#6c757d'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });
</script>
</body>
</html>
@endcan
