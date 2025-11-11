@can('ver-persona')
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi Perfil | Portal de Empleos</title>

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

    /* Perfil */
    .profile-card {
      text-align: center;
      padding: 25px;
    }

    .profile-avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background: #eef2f8;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 3rem;
      color: var(--azul);
      margin: 0 auto 15px;
    }

    .profile-info p {
      margin: 4px 0;
      font-size: 0.95rem;
    }

    .btn-edit {
      background: var(--azul);
      color: white;
      font-weight: 500;
      border-radius: 8px;
      padding: 8px 18px;
      transition: 0.3s;
    }

    .btn-edit:hover {
      background: #012b8b;
    }

    table thead {
      background-color: var(--azul);
      color: white;
    }

    .profile-avatar-container {
      display: flex;
      justify-content: center;
      margin-top: 0px;
      margin-bottom: 10px;
    }

    .profile-avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      border: 3px solid #007bff;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .profile-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }

    .default-avatar {
      font-size: 3rem;
      color: #6c757d;
    }

    .camera-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 123, 255, 0.8);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .camera-overlay i {
      font-size: 2rem;
    }

    .profile-avatar:hover .camera-overlay {
      opacity: 1;
    }

    /* Estilos para el panel de información (derecha) */
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
      margin-bottom: 20px;
    }

    .info-panel p {
      font-size: 0.95rem;
      color: #555;
      line-height: 1.5;
    }

    .info-panel label {
      font-weight: 600;
      color: #001f60;
      margin-top: 15px;
      display: block;
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
    /* Estilos para el header del modal */
    .modal-header-azul {
        background: var(--azul);
        color: white;
        border-bottom: 1px solid var(--azul);
    }

    .modal-header-azul .modal-title {
        font-weight: 600;
        font-size: 1.1rem;
    }

    .modal-header-azul .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
    /* Estilos para el botón que abre el modal */
    .btn-modal {
        background: var(--azul);
        color: white;
        border: 2px solid var(--azul);
        padding: 6px 15px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-modal:hover {
        background: #fff;
        color: var(--azul);
        border: 2px solid var(--azul);
    }
    /* Estilos para los botones (Cerrar Sesión, Editar Perfil, Ver Anuncio) */
    .btn-edit, .btn-modal {
        background: var(--azul);
        color: white;
        border: 2px solid var(--azul);
        padding: 6px 15px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-edit:hover, .btn-modal:hover {
        background: #fff;
        color: var(--azul);
        border: 2px solid var(--azul);
    }

    /* Para el botón específico de la tabla (tamaño pequeño) */
    .btn-modal {
        font-size: 0.875rem;
        padding: 4px 12px;
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header>
    <div class="d-flex align-items-center gap-3">
      <a href="{{ route('welcome') }}"
        class="btn btn-light d-flex align-items-center gap-2 px-3 py-2 fw-semibold border-0 shadow-sm"
        style="border-radius: 50px;">
        <i class="bi bi-arrow-left-circle text-primary fs-5"></i>
        <span class="text-primary">Atrás</span>
      </a>

      <div class="title">
        <img src="{{ asset('images/imagenes/logo_muni_v2.png') }}" alt="Logo">
        Municipalidad de La Victoria
      </div>
    </div>

    <a href="{{ route('logout') }}" class="logout">
      <i class="bi bi-door-open"></i> Cerrar Sesión
    </a>
  </header>

  <div class="container py-4">
    <div class="row g-4">
      <!-- 🔹 Card Perfil -->
      <div class="col-lg-4">
        <div class="card profile-card shadow-sm">
          <!-- Foto de Perfil Circular - Ahora clickeable -->
          <div class="profile-avatar-container position-relative">
            <div class="profile-avatar position-relative" id="profileAvatar" style="cursor: pointer;">
              @if(Auth::user()->url_logo)
              <img src="{{ asset('storage/' . Auth::user()->url_logo) }}" alt="Foto de perfil" class="profile-image"
                style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
              @else
              <i class="bi bi-person-fill default-avatar"></i>
              @endif
            </div>

            <!-- Input file oculto -->
            <input type="file" id="fotoPerfilInput" name="url_logo" accept="image/jpeg,image/png,image/jpg,image/gif"
              class="d-none">
          </div>

          <h5 class="fw-bold text-primary mt-3">{{ Auth::user()->nombres }} {{ Auth::user()->apellido_paterno }} {{ Auth::user()->apellido_materno }}</h5>
          <p class="text-muted mb-2">{{ Auth::user()->email }}</p>

          <div class="profile-info text-start mt-3">
            <p><strong>DNI:</strong> {{ Auth::user()->nro_documento }}</p>
            <p><strong>Celular:</strong> {{ Auth::user()->celular }}</p>
            @if(Auth::user()->curriculum_vitae)
            <p><strong>CV:</strong>
              <a href="{{ asset('storage/' . Auth::user()->curriculum_vitae) }}" target="_blank"
                class="text-primary fw-semibold">
                Ver Currículum
              </a>
            </p>
            @else
            <p><strong>CV:</strong> No cargado</p>
            @endif
          </div>

          <div class="mt-3">
            <button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#modalEditarPerfil">
              <i class="bi bi-pencil-square"></i> Editar Perfil
            </button>
          </div>
        </div>
      </div>

      <!-- 🔹 Card Postulaciones -->
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header" style="background: var(--azul); color: white; font-weight: 600;">
            <i class="bi bi-clipboard-check"></i> Mis Postulaciones
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table align-middle"
                style="border: 1px solid var(--borde); border-radius: 10px; overflow: hidden;">
                <thead style="background: var(--azul); color: #fff;">
                  <tr>
                    <th style="width: 60px;">#</th>
                    <th>Puesto</th>
                    <th>Fecha Límite</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($postulaciones as $index => $post)
                  <tr>
                    <td class="fw-semibold text-secondary">{{ $index + 1 }}</td>
                    <td>{{ $post->puesto }}</td>
                    <td>{{ \Carbon\Carbon::parse($post->fecha_limite)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</td>
                    <td>
                      @if($post->estado == 1)
                      <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">En revisión</span>
                      @elseif($post->estado == 2)
                      <span class="badge bg-success px-3 py-2 rounded-pill">Aceptado</span>
                      @else
                      <span class="badge bg-danger px-3 py-2 rounded-pill">Rechazado</span>
                      @endif
                    </td>
                    <td>
    <button class="btn btn-sm btn-modal" 
            data-bs-toggle="modal" 
            data-bs-target="#detalleModal"
            data-puesto="{{ $post->puesto }}"
            data-categoria="{{ $post->id_categoria_ocupacionals ?? 'No especificada' }}"
            data-modalidad="{{ $post->id_modalidads ?? 'No especificada' }}"
            data-vacantes="{{ $post->vacantes }}"
            data-sueldo="{{ $post->sueldo }}"
            data-descripcion="{{ $post->descripcion ?? 'No disponible' }}"
            data-condiciones="{{ $post->condiciones ?? 'No especificadas' }}"
            data-fecha="{{ $post->fecha_limite }}">
        <i class="bi bi-eye"></i> Ver Anuncio
    </button>
</td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                      <i class="bi bi-briefcase"></i> No has postulado a ningún empleo aún.
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
              
              <!-- Modal para mostrar detalles -->
<div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="detalleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- HEADER MODIFICADO CON COLOR AZUL -->
            <div class="modal-header modal-header-azul">
                <h5 class="modal-title" id="detalleModalLabel">Detalles de la Oferta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="info-panel" id="info-panel">
                            <h5>Selecciona una oferta para ver más información</h5>
                            <p>Haz clic en cualquiera de las ofertas de la izquierda para visualizar los detalles completos aquí.</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div> --}}
        </div>
    </div>
</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 🔹 Modal Editar Perfil -->
  <div class="modal fade" id="modalEditarPerfil" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><i class="bi bi-person-lines-fill"></i> Editar Perfil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formEditarPerfil">
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Apellido Paterno</label>
              <input type="text" name="apellido_paterno" class="form-control" value="{{ Auth::user()->apellido_paterno }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Apellido Materno</label>
              <input type="text" name="apellido_materno" class="form-control" value="{{ Auth::user()->apellido_materno }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Nombres</label>
              <input type="text" name="nombres" class="form-control" value="{{ Auth::user()->nombres }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Correo Electrónico</label>
              <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Celular</label>
              <input type="text" name="celular" class="form-control" value="{{ Auth::user()->celular }}" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <script>
    $('#formEditarPerfil').on('submit', function (e) {
      e.preventDefault();
      const formData = $(this).serialize();

      fetch('{{ route("persona.updatePerfil") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
      })
        .then(res => res.json())
        .then(data => {
          if (data.ok) {
            Swal.fire('✅ Éxito', data.mensaje, 'success').then(() => location.reload());
          } else {
            Swal.fire('⚠️ Aviso', data.mensaje, 'warning');
          }
        })
        .catch(() => Swal.fire('❌ Error', 'No se pudo actualizar el perfil.', 'error'));
    });
  </script>

  <script>
    // Función para cargar datos en el modal con el diseño solicitado
    document.addEventListener('DOMContentLoaded', function() {
      const detalleModal = document.getElementById('detalleModal');
      
      detalleModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const panel = document.getElementById('info-panel');
        
        const data = {
          puesto: button.getAttribute('data-puesto'),
          categoria: button.getAttribute('data-categoria'),
          modalidad: button.getAttribute('data-modalidad'),
          vacantes: button.getAttribute('data-vacantes'),
          sueldo: button.getAttribute('data-sueldo'),
          descripcion: button.getAttribute('data-descripcion'),
          condiciones: button.getAttribute('data-condiciones'),
          fecha_limite: button.getAttribute('data-fecha')
        };
        
        panel.innerHTML = `
          <h5 class="mb-4"><i class="bi bi-briefcase"></i> ${data.puesto}</h5>
          
          <div class="mb-3">
            <label class="fw-semibold text-primary">Categoría:</label>
            <p class="mb-2">${data.categoria}</p>
          </div>
          
          <div class="mb-3">
            <label class="fw-semibold text-primary">Modalidad:</label>
            <p class="mb-2">${data.modalidad}</p>
          </div>
          
          <div class="mb-3">
            <label class="fw-semibold text-primary">Vacantes:</label>
            <p class="mb-2">${data.vacantes} plazas disponibles</p>
          </div>
          
          <div class="mb-3">
            <label class="fw-semibold text-primary">Sueldo:</label>
            <p class="mb-2"><b>S/ ${parseFloat(data.sueldo).toFixed(2)}</b></p>
          </div>
          
          <div class="mb-3">
            <label class="fw-semibold text-primary">Descripción:</label>
            <p class="mb-2">${data.descripcion}</p>
          </div>
          
          <div class="mb-3">
            <label class="fw-semibold text-primary">Condiciones:</label>
            <p class="mb-2">${data.condiciones}</p>
          </div>
          
          <div class="mb-4">
            <label class="fw-semibold text-primary">Fecha límite de postulación:</label>
            <p class="mb-2"><i class="bi bi-calendar-event"></i> ${new Date(data.fecha_limite).toLocaleDateString('es-PE')}</p>
          </div>
        `;
      });
    });
  </script>
    
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const profileAvatar = document.getElementById('profileAvatar');
      const fotoPerfilInput = document.getElementById('fotoPerfilInput');

      // Click en el avatar para abrir selector de archivos
      profileAvatar.addEventListener('click', function () {
        fotoPerfilInput.click();
      });

      // Cuando se selecciona un archivo, enviar automáticamente
      fotoPerfilInput.addEventListener('change', function (event) {
        const file = event.target.files[0];

        if (file) {
          // Validar tipo de archivo
          const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
          if (!validTypes.includes(file.type)) {
            alert('Por favor, selecciona una imagen válida (JPEG, PNG, JPG, GIF).');
            this.value = '';
            return;
          }

          // Validar tamaño (2MB)
          if (file.size > 2 * 1024 * 1024) {
            alert('La imagen debe ser menor a 2MB.');
            this.value = '';
            return;
          }

          // Enviar formulario automáticamente
          autoSubmitProfilePhoto();
        }
      });
    });

    // Función para auto-submit
    function autoSubmitProfilePhoto() {
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = '{{ route("profile.update.photo") }}';
      form.enctype = 'multipart/form-data';

      const csrfToken = document.createElement('input');
      csrfToken.type = 'hidden';
      csrfToken.name = '_token';
      csrfToken.value = '{{ csrf_token() }}';
      form.appendChild(csrfToken);

      const fileInput = document.getElementById('fotoPerfilInput').cloneNode(true);
      form.appendChild(fileInput);

      document.body.appendChild(form);
      form.submit();
    }
  </script>

  <script>
    function previewPDF(url) {
      // Abrir en nueva pestaña
      window.open(url, '_blank');
      return false; // Prevenir comportamiento por defecto
    }
  </script>

</body>
</html>
@endcan