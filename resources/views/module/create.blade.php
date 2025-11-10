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
                            <h2 class="content-header-title float-start mb-0">CREAR MODULO</h2>
                            
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
                                    <h4 class="card-title">Crear MODULO</h4>
                                    <a href="{{ url('/modules') }}" class="btn btn-success">Atras</a>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('modules') }}" method="POST">
                                        @csrf
                                        
                                        <div class="mb-3">
                                            <label for="">Nombre del Permiso</label>
                                            <input type="text" name="name" id="" class="form-control"/>
                                        </div>

                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Save</button>

                                        </div>

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