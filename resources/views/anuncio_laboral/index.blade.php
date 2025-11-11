@extends('plantilla.layouts.panel')

@section('panel_blanco')
<div class="app-content content">
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row mb-2">
      <div class="col-12">
        <h2 class="content-header-title">Aprobación de Anuncios Laborales</h2>
      </div>
    </div>

    <div class="content-body">
      <section>
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Lista de Anuncios</h4>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table id="tablaAnuncios" class="table table-bordered align-middle text-center">
                <thead class="table-primary">
                  <tr>
                    <th>#</th>
                    <th>Puesto</th>
                    <th>Vacantes</th>
                    <th>Sueldo</th>
                    <th>Fecha Límite</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($anuncios as $index => $item)
                    <tr id="fila-{{ $item->id }}">
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $item->puesto }}</td>
                      <td>{{ $item->vacantes }}</td>
                      <td>S/ {{ number_format($item->sueldo, 2) }}</td>
                      <td>{{ \Carbon\Carbon::parse($item->fecha_limite)->format('d/m/Y') }}</td>
                      <td data-estado="{{ $item->estado_nombre }}">
                        @if ($item->estado_nombre == 'Pendiente')
                          <span class="badge bg-warning text-white fw-semibold">{{ $item->estado_nombre }}</span>
                        @elseif ($item->estado_nombre == 'Aprobado')
                          <span class="badge bg-success">{{ $item->estado_nombre }}</span>
                        @else
                          <span class="badge bg-danger">{{ $item->estado_nombre }}</span>
                        @endif
                      </td>
                      <td>
                        <!-- 👁 Botón Ver Detalle -->
                        <button class="btn btn-info btn-sm ver-detalle"
                                data-id="{{ $item->id }}"
                                data-puesto="{{ $item->puesto }}"
                                data-vacantes="{{ $item->vacantes }}"
                                data-sueldo="{{ number_format($item->sueldo, 2) }}"
                                data-fecha="{{ \Carbon\Carbon::parse($item->fecha_limite)->format('d/m/Y') }}"
                                data-descripcion="{{ $item->descripcion }}"
                                data-condiciones="{{ $item->condiciones }}"
                                data-estado="{{ $item->estado_nombre }}"
                                data-motivo="{{ $item->motivo_rechazo ?? '—' }}">
                          <i class="bi bi-eye"></i> Ver
                        </button>

                        @if ($item->estado_nombre == 'Pendiente')
                          <button class="btn btn-success btn-sm aprobar" data-id="{{ $item->id }}">
                            <i class="bi bi-check-circle"></i> Aprobar
                          </button>
                          <button class="btn btn-danger btn-sm rechazar" data-id="{{ $item->id }}">
                            <i class="bi bi-x-circle"></i> Rechazar
                          </button>
                        @else
                          <span class="text-muted">—</span>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<!-- 🔹 Modal Detalle Completo -->
<div class="modal fade" id="modalDetalle" tabindex="-1" aria-labelledby="detalleLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
<h5 class="modal-title text-white" id="detalleLabel"><i class="bi bi-briefcase"></i> Detalle del Anuncio Laboral</h5>        
{{-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button> --}}
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <tbody>
            <tr><th>Puesto</th><td id="detallePuesto"></td></tr>
            <tr><th>Vacantes</th><td id="detalleVacantes"></td></tr>
            <tr><th>Sueldo</th><td id="detalleSueldo"></td></tr>
            <tr><th>Fecha Límite</th><td id="detalleFecha"></td></tr>
            <tr><th>Descripción</th><td id="detalleDescripcion"></td></tr>
            <tr><th>Condiciones</th><td id="detalleCondiciones"></td></tr>
            <tr><th>Estado</th><td id="detalleEstado"></td></tr>
            <tr><th>Motivo de Rechazo</th><td id="detalleMotivo"></td></tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endsection


@section('scripts')
<!-- ✅ DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<!-- ✅ SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(function () {

    // Ordenar por estado
    $.fn.dataTable.ext.order['estado-prioridad'] = function(settings, colIndex) {
      return this.api().column(colIndex, { order: 'index' }).nodes().map(function(td) {
        const estado = $(td).data('estado');
        switch (estado) {
          case 'Pendiente': return 1;
          case 'Aprobado': return 2;
          case 'Rechazado': return 3;
          default: return 4;
        }
      });
    };

    const tabla = $('#tablaAnuncios').DataTable({
      columnDefs: [{ targets: 5, orderDataType: 'estado-prioridad' }],
      order: [[5, 'asc']],
      pageLength: 10,
      language: {
        lengthMenu: 'Mostrar _MENU_ registros por página',
        zeroRecords: 'No se encontraron resultados',
        info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
        infoEmpty: 'No hay registros disponibles',
        infoFiltered: '(filtrado de _MAX_ registros totales)',
        search: 'Buscar:',
        paginate: { first: 'Primero', last: 'Último', next: 'Siguiente', previous: 'Anterior' },
      }
    });

    // 👁 Mostrar modal con todos los detalles
    $(document).on('click', '.ver-detalle', function () {
      $('#detallePuesto').text($(this).data('puesto'));
      $('#detalleVacantes').text($(this).data('vacantes'));
      $('#detalleSueldo').text('S/ ' + $(this).data('sueldo'));
      $('#detalleFecha').text($(this).data('fecha'));
      $('#detalleDescripcion').text($(this).data('descripcion') || '—');
      $('#detalleCondiciones').text($(this).data('condiciones') || '—');
      $('#detalleEstado').text($(this).data('estado'));
      $('#detalleMotivo').text($(this).data('motivo') || '—');
      $('#modalDetalle').modal('show');
    });

    // ✅ Aprobar anuncio
    $(document).on('click', '.aprobar', function () {
      const id = $(this).data('id');
      Swal.fire({
        title: '¿Aprobar anuncio?',
        text: "Esta acción marcará el anuncio como Aprobado.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, aprobar'
      }).then((result) => {
        if (result.isConfirmed) actualizarEtapa(id, 2, null);
      });
    });

    // ❌ Rechazar anuncio
    $(document).on('click', '.rechazar', function () {
      const id = $(this).data('id');
      Swal.fire({
        title: 'Rechazar anuncio',
        html: `
          <div style="text-align:center;">
            <label for="motivo_rechazo" style="display:block; font-weight:600; margin-bottom:8px;">
              Escribe el motivo del rechazo:
            </label>
            <textarea id="motivo_rechazo" class="swal2-textarea" 
              placeholder="Ejemplo: No cumple con los requisitos técnicos o de experiencia"
              style="width:90%; height:120px; resize:none; border-radius:10px; padding:10px; font-size:15px; font-family:'Poppins',sans-serif;"></textarea>
          </div>
        `,
        width: '500px',
        showCancelButton: true,
        confirmButtonText: 'Rechazar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        focusConfirm: false,
        preConfirm: () => {
          const motivo = Swal.getPopup().querySelector('#motivo_rechazo').value.trim();
          if (!motivo) Swal.showValidationMessage('⚠️ Debes escribir un motivo de rechazo.');
          return motivo;
        }
      }).then((result) => {
        if (result.isConfirmed) actualizarEtapa(id, 3, result.value);
      });
    });

    // 🔁 AJAX actualizar etapa
    function actualizarEtapa(id, etapa, motivo) {
      fetch('{{ route('anuncio-laboral.actualizar-etapa') }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id, etapa, motivo_rechazo: motivo })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          Swal.fire({
            icon: 'success',
            title: 'Actualizado',
            text: data.message,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#0d6efd'
          }).then(() => location.reload());
        } else {
          Swal.fire('Error', 'No se pudo actualizar el anuncio.', 'error');
        }
      })
      .catch(() => Swal.fire('Error', 'Error en la solicitud al servidor.', 'error'));
    }
  });
</script>
@endsection
