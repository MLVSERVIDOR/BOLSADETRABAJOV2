@extends('plantilla.layouts.panel')

@section('panel_blanco')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Usuario</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuario</a></li>
                                <li class="breadcrumb-item active">Editar Usuario</li>
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
                                <h4 class="card-title" style="flex: 1; text-align: center; margin: 0;">Edición de Usuario</h4>
                                <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('usuarios.index') }}">Regresar</a>
                            </div>
                            <div class="card-body">
                                <form id="alertFormulario" action="{{ route('usuarios.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        @if ($errors->any())
                                            <div class="alert alert-dismissible alert-danger fade show text-center" role="alert">
                                                <ul class="error-list">
                                                    @foreach ($errors->all() as $error)
                                                        <li class="">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                <button type="button" class="btn-close mb-2" data-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <div class="container mt-0">
                                            <section id="multiple-column-form">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-12">
                                                                        <div class="mb-1">
                                                                            <label class="form-label" for="name">Nombre Completo</label>
                                                                            <input type="text" id="name" class="form-control" name="name" value="{{ $user->name }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 col-12">
                                                                        <div class="mb-1">
                                                                            <label class="form-label" for="name">Apellido Paterno</label>
                                                                            <input type="text" id="apellido_paterno" class="form-control" name="apellido_paterno" value="{{ $user->apellido_paterno }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 col-12">
                                                                        <div class="mb-1">
                                                                            <label class="form-label" for="name">Apellido Materno</label>
                                                                            <input type="text" id="apellido_materno" class="form-control" name="apellido_materno" value="{{ $user->apellido_materno }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 col-12">
                                                                        <div class="mb-1">
                                                                            <label class="form-label" for="name">DNI</label>
                                                                            <input type="text" id="dni" class="form-control" name="dni" value="{{ $user->dni }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 col-12">
                                                                        <div class="mb-1">
                                                                            <label class="form-label" for="user_name">Nombre de Usuario</label>
                                                                            <input type="text" id="user_name" class="form-control" name="user_name" value="{{ $user->user_name }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 col-12">
                                                                        <div class="mb-1">
                                                                            <label class="form-label" for="password">Contraseña</label>
                                                                            <input type="password" id="password" class="form-control" name="password">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 col-12">
                                                                        <div class="mb-1">
                                                                            <label class="form-label" for="confirm-password">Confirmar Contraseña</label>
                                                                            <input type="password" id="confirm-password" class="form-control" name="confirm-password">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 col-12">
                                                                        <div class="form-group">
                                                                            <label for="roles">Roles</label>
                                                                            <select id="roles" name="roles[]" class="form-select" required>
                                                                                @foreach ($roles as $roleName)
                                                                                    <option value="{{ $roleName }}" {{ in_array($roleName, $userRole) ? 'selected' : '' }}>{{ $roleName }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                                        <button type="reset" class="btn btn-outline-secondary waves-effect">Resetear</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
