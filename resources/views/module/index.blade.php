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
                        <h2 class="content-header-title float-start mb-0">MODULE</h2> 
                    </div>
                </div>
            </div>
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
        </div>
        <div class="content-body">
            <!-- Input Mask start -->
            <section id="input-mask-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">MODULE</h4>
                                @can('crear-modulo')
                                    <a href="{{ route('modules.create') }}" class="btn btn-success">Crear Modulo</a>
                                @endcan
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th>ACCION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($modules as $module)
                                            <tr>
                                                <td>{{ $module->id }}</td>
                                                <td>{{ $module->name }}</td>
                                                <td>
                                                    @can('editar-modulo')
                                                        <a href="{{ route('modules.edit', $module->id) }}" class="btn btn-primary">Editar</a>
                                                    @endcan
                                                    @can('borrar-modulo')
                                                        <form action="{{ route('modules.destroy', $module->id) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este módulo?');">Eliminar</button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
