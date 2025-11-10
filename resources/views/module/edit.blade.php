@extends('plantilla.layouts.panel')

@section('panel_blanco')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">EDITAR MODULO</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Input Mask start -->
            <section id="input-mask-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Editar Módulo</h4>
                                <a href="{{ route('modules.index') }}" class="btn btn-success">Atrás</a>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('modules.update', $module->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" class="form-control" value="{{ $module->name }}" required>
                                    </div>
                                    <!-- Agrega otros campos según tu tabla de módulos si es necesario -->
                                    <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Input Mask End -->
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
