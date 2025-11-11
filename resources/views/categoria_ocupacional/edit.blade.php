@extends('plantilla.layouts.panel')

@section('css')
<!-- ✅ Font Awesome completo -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


<style>
  .icon-selector {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
    gap: 10px;
    max-height: 350px;
    overflow-y: auto;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 10px;
    background: #fafafa;
  }

  .icon-item {
    text-align: center;
    font-size: 22px;
    padding: 10px;
    cursor: pointer;
    border-radius: 8px;
    transition: all 0.2s ease;
    color: #6b7280;
  }

  .icon-item:hover {
    background-color: #f3f4f6;
    color: #111827;
  }

  .icon-item.selected {
    background-color: #2563eb;
    color: #fff;
    transform: scale(1.1);
  }
</style>
@endsection

@section('panel_blanco')
<div class="app-content content ">
  <div class="content-wrapper container-xxl p-0">
    <div class="content-body">
      <section id="editar-categoria">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Editar Categoría Ocupacional</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('categoria-ocupacional.update', $categoria->id) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="row">
                <div class="col-md-6 mb-1">
                  <label>Nombre</label>
                  <input type="text" name="nombre" class="form-control" value="{{ $categoria->nombre }}" required>
                </div>
                <div class="col-md-6 mb-1">
                  <label>Sub Nombre</label>
                  <input type="text" name="sub_nombre" class="form-control" value="{{ $categoria->sub_nombre }}">
                </div>

                <div class="col-md-6 mb-1">
                  <label>Vacantes</label>
                  <input type="number" name="vacantes" class="form-control" disabled value="{{ $categoria->vacantes }}">
                </div>

                <div class="col-md-12 mb-1">
                  <label>Descripción</label>
                  <textarea name="descripcion" class="form-control">{{ $categoria->descripcion }}</textarea>
                </div>

                <div class="col-md-12 mb-1">
                  <label>Seleccionar Ícono</label>
                  <input type="hidden" name="icono" id="icono" value="{{ $categoria->icono }}" required>

                  <div class="icon-selector mt-2">
                    @php
                      $icons = [
                        // Negocios y oficina
                        'fa-solid fa-briefcase', 'fa-solid fa-user-tie', 'fa-solid fa-handshake', 'fa-solid fa-building',
                        'fa-solid fa-file-contract', 'fa-solid fa-folder-open', 'fa-solid fa-envelope',
                        'fa-solid fa-clipboard-list', 'fa-solid fa-chart-line', 'fa-solid fa-sack-dollar',

                        // Construcción y oficios
                        'fa-solid fa-hammer', 'fa-solid fa-hard-hat', 'fa-solid fa-screwdriver-wrench', 'fa-solid fa-ruler',
                        'fa-solid fa-toolbox', 'fa-solid fa-paint-roller', 'fa-solid fa-wrench', 'fa-solid fa-brush',
                        'fa-solid fa-bolt', 'fa-solid fa-gears',

                        // Tecnología
                        'fa-solid fa-laptop-code', 'fa-solid fa-desktop', 'fa-solid fa-server', 'fa-solid fa-microchip',
                        'fa-solid fa-keyboard', 'fa-solid fa-wifi', 'fa-solid fa-bug', 'fa-solid fa-code',
                        'fa-solid fa-database', 'fa-solid fa-cloud',

                        // Salud
                        'fa-solid fa-stethoscope', 'fa-solid fa-user-nurse', 'fa-solid fa-hospital', 'fa-solid fa-heart-pulse',
                        'fa-solid fa-syringe', 'fa-solid fa-pills', 'fa-solid fa-briefcase-medical', 'fa-solid fa-bandage',
                        'fa-solid fa-dna', 'fa-solid fa-tooth',

                        // Educación
                        'fa-solid fa-graduation-cap', 'fa-solid fa-chalkboard-user', 'fa-solid fa-book', 'fa-solid fa-school',
                        'fa-solid fa-lightbulb', 'fa-solid fa-pencil', 'fa-solid fa-language', 'fa-solid fa-user-graduate',
                        'fa-solid fa-globe', 'fa-solid fa-person-chalkboard',

                        // Transporte
                        'fa-solid fa-truck', 'fa-solid fa-plane', 'fa-solid fa-ship', 'fa-solid fa-bus', 'fa-solid fa-car-side',
                        'fa-solid fa-box', 'fa-solid fa-road', 'fa-solid fa-train', 'fa-solid fa-bicycle', 'fa-solid fa-warehouse',

                        // Arte y diseño
                        'fa-solid fa-palette', 'fa-solid fa-camera', 'fa-solid fa-video', 'fa-solid fa-music',
                        'fa-solid fa-pen-nib', 'fa-solid fa-film', 'fa-solid fa-microphone', 'fa-solid fa-image',
                        'fa-solid fa-paintbrush', 'fa-solid fa-photo-film',

                        // Agricultura, industria, energía
                        'fa-solid fa-seedling', 'fa-solid fa-tractor', 'fa-solid fa-apple-whole', 'fa-solid fa-wheat-awn',
                        'fa-solid fa-industry', 'fa-solid fa-flask', 'fa-solid fa-atom', 'fa-solid fa-solar-panel',
                        'fa-solid fa-recycle', 'fa-solid fa-battery-full',

                        // Seguridad, defensa y leyes
                        'fa-solid fa-shield-halved', 'fa-solid fa-gavel', 'fa-solid fa-balance-scale', 'fa-solid fa-user-shield',
                        'fa-solid fa-passport', 'fa-solid fa-id-card', 'fa-solid fa-lock', 'fa-solid fa-fire-extinguisher',
                        'fa-solid fa-life-ring', 'fa-solid fa-bullhorn'
                      ];
                    @endphp

                    @foreach ($icons as $icon)
                      <div class="icon-item {{ $categoria->icono === $icon ? 'selected' : '' }}" data-icon="{{ $icon }}">
                        <i class="{{ $icon }}"></i>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>

              <div class="mt-3">
                <a href="{{ route('categoria-ocupacional.index') }}" class="btn btn-secondary">Atrás</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const icons = document.querySelectorAll('.icon-item');
    const inputIcono = document.getElementById('icono');
    const currentIcon = inputIcono.value;

    // Mostrar seleccionado al cargar
    icons.forEach(icon => {
      if (icon.getAttribute('data-icon') === currentIcon) {
        icon.classList.add('selected');
      }

      icon.addEventListener('click', function() {
        icons.forEach(i => i.classList.remove('selected'));
        this.classList.add('selected');
        inputIcono.value = this.getAttribute('data-icon');
      });
    });
  });
</script>
@endsection
