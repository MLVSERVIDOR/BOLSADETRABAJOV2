@extends('plantilla.layouts.panel')

@section('panel_blanco')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Creación de un Nuevo Rol</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                                <li class="breadcrumb-item active">Nuevo Rol</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="input-mask-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="display: flex; align-items: center;">
                                <h4 class="card-title" style="flex: 1; text-align: center; margin: 0;">Creación de un Nuevo Rol</h4>
                                <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('roles.index') }}">Regresar</a>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <script>
                                        Swal.fire({
                                            title: 'Errores en el formulario',
                                            html: '<ul>' +
                                                @foreach ($errors->all() as $error)
                                                    '<li>{{ $error }}</li>' +
                                                @endforeach
                                                '</ul>',
                                            icon: 'error'
                                        });
                                    </script>
                                @endif
                                <form id="alertFormulario" method="POST" action="{{ route('roles.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="name">Nombre del Rol:</label>
                                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                                            </div>
                                            <br>
                                        </div>
                                        
                                        @php $count = 0; @endphp
                                        @foreach($groupedModules as $moduleId => $moduleData)
                                            @if($count % 3 == 0)
                                                </div><div class="row"> <!-- Cada 3 tarjetas, inicia una nueva fila -->
                                            @endif
                                            <div class="col-md-4 mb-2">
                                                <div class="card border mb-2">
                                                    <div class="switch-label card-header d-flex justify-content-between align-items-center" style="font-weight: bold; font-size: 23px;">
                                                        {{ $moduleData['name_module'] }}
                                                        <!-- Checkbox para seleccionar todos los permisos del módulo -->
                                                        <label class="switch switch-square switch-lg d-flex align-items-center mb-0">
                                                            <input type="checkbox" class="switch-input select-all-permissions" data-module="{{ $moduleId }}">
                                                            <span class="switch-toggle-slider">
                                                                <span class="switch-on">
                                                                    <i class="ti ti-check"></i>
                                                                </span>
                                                                <span class="switch-off">
                                                                    <i class="ti ti-x"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="card-body">
                                                        <!-- Permisos individuales del módulo -->
                                                        @foreach($moduleData['permissions'] as $permission)
                                                        <div class="col">
                                                            <label class="switch switch-square switch-lg d-flex align-items-center">
                                                                <input type="checkbox" class="switch-input permission-checkbox" data-module="{{ $moduleId }}" name="permissions[]" value="{{ $permission->id }}">
                                                                <span class="switch-toggle-slider">
                                                                    <span class="switch-on">
                                                                        <i class="ti ti-check"></i>
                                                                    </span>
                                                                    <span class="switch-off">
                                                                        <i class="ti ti-x"></i>
                                                                    </span>
                                                                </span>
                                                                <span class="switch-label ms-1">{{ $permission->name_permissions }}</span>
                                                            </label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @php $count++; @endphp
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section('scripts')
<!-- SWEET ALERTS - FORMULARIO -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('alertFormulario');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el envío por defecto

        const name = document.getElementById('name').value;

        if (name.trim() === '') {
            mostrarAlerta('Error', 'Por favor, ingrese el NOMBRE del rol.', 'error');
            return;
        }

        // Mostrar mensaje de confirmación
        Swal.fire({
            title: '¿Estás seguro de que deseas enviar el formulario?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-secondary',
            },
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Enviar el formulario
            }
        });
    });

    // Función genérica para mostrar alertas
    function mostrarAlerta(titulo, mensaje, icono) {
        Swal.fire({
            title: titulo,
            text: mensaje,
            icon: icono,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: icono === 'error' ? '#dc3545' : '#28a745',
            customClass: {
                confirmButton: icono === 'error' ? 'btn btn-danger' : 'btn btn-success',
            },
        });
    }

    // Mostrar errores de validación (si existen)
    @if ($errors->any())
        mostrarAlerta('Errores en el formulario', `{!! implode('<br>', $errors->all()) !!}`, 'error');
    @endif

    // Selector para los checkboxes de "Seleccionar todos"
    $('.select-all-permissions').change(function() {
        let module = $(this).data('module');
        $(`.permission-checkbox[data-module="${module}"]`).prop('checked', $(this).prop('checked'));
    });

    // Controlar la lógica de selección de checkboxes individuales
    $('.permission-checkbox').change(function() {
        let module = $(this).data('module');
        let allChecked = $(`.permission-checkbox[data-module="${module}"]:checked`).length === $(`.permission-checkbox[data-module="${module}"]`).length;
        $(`.select-all-permissions[data-module="${module}"]`).prop('checked', allChecked);
    });
});

</script>
@endsection
