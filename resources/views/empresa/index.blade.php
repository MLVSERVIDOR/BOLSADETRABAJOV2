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
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 1.5rem;
      border: 1px solid #eaeaea;
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

    @keyframes blink {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.4; transform: scale(1.3); }
    }
  </style>
</head>

<body>

  <!-- 🔹 HEADER -->
  <header>
    <div class="d-flex align-items-center gap-3">
      <a href="{{ route('welcome') }}" class="btn-atras">
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

        <div class="button-group">
          <button class="btn btn-outline-primary" onclick="window.location='{{ route('empresa.postulaciones') }}'">
            <i class="bi bi-eye-fill"></i> Ver Postulaciones
          </button>
          <button class="btn btn-primary" onclick="window.location='{{ route('empresa.create') }}'">
            <i class="bi bi-plus-circle"></i> Nueva Oferta
          </button>
        </div>
      </div>

      <hr>

      <div class="mb-3">
        <label class="form-label">Empresa</label>
        <input type="text" class="form-control" value="{{ Auth::user()->razon_social ?? 'Sin razón social registrada' }}" readonly>
      </div>



<!-- Tabla -->
<div class="table-responsive">
    <table id="tablaOfertas" class="table table-bordered tabla-ofertas align-middle display nowrap" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Puesto</th>
              <th>Categoría</th>
              <th>Modalidad</th>
              <th>Vacantes</th>
              <th>Sueldo</th>
              <th>Fecha Límite</th>
              <th>Etapa</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($anuncios as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $item->puesto }}</td>
              <td>{{ $item->categoria }}</td>
              <td>{{ $item->modalidad }}</td>
              <td>{{ $item->vacantes }}</td>
              <td>S/ {{ number_format($item->sueldo, 2) }}</td>
              <td>{{ \Carbon\Carbon::parse($item->fecha_limite)->format('d/m/Y') }}</td>

              @php
                $badgeClass = match($item->nombre) {
                    'Pendiente' => 'bg-pendiente',
                    'Aprobado'  => 'bg-aprobado',
                    'Rechazado' => 'bg-rechazado',
                    default     => 'bg-secondary'
                };
              @endphp

              <td class="position-relative">
                @if ($item->nombre === 'Rechazado' && !empty($item->motivo_rechazo))
                  <div style="position: relative; display: inline-block;">
                    <span 
                      class="badge {{ $badgeClass }} ver-motivo"
                      style="cursor:pointer; padding-right:18px;"
                      data-motivo="{{ $item->motivo_rechazo }}">
                      {{ $item->nombre }}
                    </span>
                    <span class="dot-blink"></span>
                  </div>
                @else
                  <span class="badge {{ $badgeClass }}">{{ $item->nombre }}</span>
                @endif
              </td>

              <td>
                <div class="d-flex justify-content-center gap-2">
                  <a href="{{ route('empresa.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Actualizar">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="{{ route('empresa.destroy', $item->id) }}" method="POST" class="form-eliminar d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm btn-eliminar" title="Eliminar">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
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
$(document).ready(function() {
    var table = $('#tablaOfertas').DataTable({
        responsive: true,
        pageLength: 5,
        lengthMenu: [5, 10, 20, 50],
        language: {
            processing:     "Procesando...",
            search:         "Buscar:",
            lengthMenu:     "Mostrar _MENU_ registros",
            info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty:      "Mostrando 0 a 0 de 0 registros",
            infoFiltered:   "(filtrado de _MAX_ registros totales)",
            loadingRecords: "Cargando...",
            zeroRecords:    "No se encontraron resultados",
            emptyTable:     "No hay datos disponibles en la tabla",
            paginate: {
                first:      "Primero",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Último"
            },
            aria: {
                sortAscending:  ": activar para ordenar ascendente",
                sortDescending: ": activar para ordenar descendente"
            }
        },
        columnDefs: [
            { orderable: false, targets: [8] }
        ],
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rtip',
        initComplete: function() {
            // Agregar el botón de filtro junto al buscador
            $('.dataTables_filter').append(
                '<button type="button" class="btn btn-primary btn-sm ms-2" id="btnFiltroPuestos" title="Filtrar por puesto">' +
                '<i class="bi bi-funnel"></i> Filtrar Puestos' +
                '</button>'
            );
            
            // Inicializar el modal de filtros
            inicializarModalFiltros();
        }
    });

    function inicializarModalFiltros() {
        // Crear el modal dinámicamente
        var modalHTML = `
        <div class="modal fade" id="modalFiltroPuestos" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Filtrar Puestos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="selectAllPuestos" checked>
                            <label class="form-check-label" for="selectAllPuestos">
                                <strong>Seleccionar Todos</strong>
                            </label>
                        </div>
                        <hr>
                        <div id="listaCheckboxesPuestos">
                            <!-- Los checkboxes se generarán aquí -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="aplicarFiltroPuestos">Aplicar</button>
                    </div>
                </div>
            </div>
        </div>`;
        
        // Agregar el modal al body si no existe
        if ($('#modalFiltroPuestos').length === 0) {
            $('body').append(modalHTML);
        }
    }

    function generarCheckboxesPuestos() {
        var puestosUnicos = table.column(1).data().unique().sort().toArray();
        var listaCheckboxes = $('#listaCheckboxesPuestos');
        listaCheckboxes.empty();
        
        puestosUnicos.forEach(function(puesto, index) {
            var checkboxHTML = `
            <div class="form-check mb-1">
                <input class="form-check-input puesto-checkbox" type="checkbox" value="${puesto}" id="puesto${index}" checked>
                <label class="form-check-label" for="puesto${index}">${puesto}</label>
            </div>`;
            listaCheckboxes.append(checkboxHTML);
        });
        
        // Actualizar contador
        var totalPuestos = puestosUnicos.length;
        $('#modalFiltroPuestos .modal-title').text(`Filtrar Puestos (${totalPuestos} total)`);
    }

    // Evento para abrir el modal de filtros
    $(document).on('click', '#btnFiltroPuestos', function() {
        generarCheckboxesPuestos();
        var modal = new bootstrap.Modal(document.getElementById('modalFiltroPuestos'));
        modal.show();
    });

    // Evento para seleccionar/deseleccionar todos
    $(document).on('change', '#selectAllPuestos', function() {
        var isChecked = $(this).prop('checked');
        $('.puesto-checkbox').prop('checked', isChecked);
    });

    // Evento para aplicar el filtro
    $(document).on('click', '#aplicarFiltroPuestos', function() {
        var puestosSeleccionados = [];
        $('.puesto-checkbox:checked').each(function() {
            puestosSeleccionados.push($(this).val());
        });
        
        if (puestosSeleccionados.length === 0) {
            // Si no hay puestos seleccionados, no mostrar nada
            table.column(1).search('^$').draw();
        } else if (puestosSeleccionados.length === $('.puesto-checkbox').length) {
            // Si están todos seleccionados, mostrar todos
            table.column(1).search('').draw();
        } else {
            // Crear regex para los puestos seleccionados
            var regex = puestosSeleccionados.map(function(puesto) {
                return '^' + puesto.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + '$';
            }).join('|');
            
            table.column(1).search(regex, true, false).draw();
        }
        
        // Cerrar el modal
        $('#modalFiltroPuestos').modal('hide');
        
        // Mostrar cuántos puestos están activos en el botón
        var totalPuestos = $('.puesto-checkbox').length;
        var seleccionados = puestosSeleccionados.length;
        if (seleccionados < totalPuestos) {
            $('#btnFiltroPuestos').html('<i class="bi bi-funnel"></i> Puestos (' + seleccionados + '/' + totalPuestos + ')');
        } else {
            $('#btnFiltroPuestos').html('<i class="bi bi-funnel"></i> Filtrar Puestos');
        }
    });

    // Filtro para la columna de Puesto (si aún lo quieres mantener)
    $('#filtroPuesto').on('keyup', function() {
        table.column(1).search(this.value).draw();
    });

    // SweetAlert Eliminar
    $(document).on('click', '.btn-eliminar', function(e) {
        e.preventDefault();
        const form = $(this).closest('form');
        Swal.fire({
            title: '¿Eliminar anuncio?',
            text: "¿Estás seguro de eliminar este anuncio?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
    });

    // Ver motivo de rechazo
    $(document).on('click', '.ver-motivo', function() {
        const motivo = $(this).data('motivo');
        Swal.fire({
            title: 'Motivo del rechazo',
            html: `<div style="text-align:left; font-size:15px;">${motivo}</div>`,
            icon: 'info',
            confirmButtonColor: '#0d6efd'
        });
    });
});
</script>

</body>
</html>
@endcan
