@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .image-container {
            position: relative;
            overflow: hidden;
        }
        #panzoom-container {
            width: 100%;
            height: 100%;
            position: relative;
        }
        #document-image {
            max-width: 100%;
            max-height: 100%;
            display: block;
        }
        .controls {
            margin-top: 10px;
        }
    </style>
@endsection

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
                        <h2 class="content-header-title float-start mb-0">Roles</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                                <li class="breadcrumb-item active">Rol</li>
                            </ol>
                        </div>
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
                            <div class="card-header" style="display: flex; align-items: center;">
                                <h4 class="card-title" style="flex: 1; text-align: center; margin: 0;">Lista de Usuarios Registrados</h4>
                                @can('crear-rol')
                                <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('roles.create') }}">Nuevo</a>
                                @endcan
                            </div>
                            <div class="card-body">
                                <form id="searchForm" action="javascript:void(0)">
                                    <div class="row mb-3">
                                        <div class="col-md-1">
                                            <select name="perPage" id="perPage-select" class="form-control">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                            </select>
                                        </div>
                                        <div class="col-7"></div>
                                        <div class="col-md-4">
                                            <input type="text" id="search-input" name="search" class="form-control" placeholder="Buscar por nombre o rol">
                                        </div>
                                    </div>

                                </form>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="color:black;" class="sort-link" data-sort="id" data-direction="{{ $direction === 'asc' ? 'desc' : 'asc' }}">
                                                ID <i class="fa fa-sort"></i>
                                            </th>
                                            <th style="color:black;" class="sort-link" data-sort="name" data-direction="{{ $direction === 'asc' ? 'desc' : 'asc' }}">
                                                Rol <i class="fa fa-sort"></i>
                                            </th>
                                            <th style="color:black;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-container">
                                        @include('roles.index_table', 
                                        ['roles' => $paginatedItems])
                                    </tbody>
                                </table>

                                <!-- Agrega paginación -->
                                <div id="pagination-links" class="mt-2">
                                    {{ $paginatedItems->links() }}
                                </div>
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

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function fetchRoles(search, page, perPage, sort, direction) {
        $.ajax({
            url: '{{ route('roles.index') }}',
            method: 'GET',
            data: {
                search: search,
                page: page,
                perPage: perPage,
                sort: sort,
                direction: direction
            },
            success: function(data) {
                $('#table-container').html(data.html);
                $('#pagination-links').html(data.pagination);
                updateSortIcons(sort, direction);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }

    function updateSortIcons(sort, direction) {
        $('.sort-link').each(function() {
            let link = $(this);
            let linkSort = link.data('sort');
            let icon = link.find('i');

            if (linkSort === sort) {
                icon.removeClass('fa-sort').addClass(direction === 'asc' ? 'fa-sort-up' : 'fa-sort-down');
            } else {
                icon.removeClass('fa-sort-up fa-sort-down').addClass('fa-sort');
            }
        });
    }

    $(document).ready(function() {
        function debounce(func, wait) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        $('#search-input').on('keyup', debounce(function() {
            let search = $('#search-input').val();
            let perPage = $('#perPage-select').val();
            let sort = '{{ $sort }}';
            let direction = '{{ $direction }}';
            fetchRoles(search, null, perPage, sort, direction);
        }, 300));

        $('#perPage-select').on('change', function() {
            let search = $('#search-input').val();
            let perPage = $('#perPage-select').val();
            let sort = '{{ $sort }}';
            let direction = '{{ $direction }}';
            fetchRoles(search, null, perPage, sort, direction);
        });

        $(document).on('click', '.sort-link', function(e) {
            e.preventDefault();
            let sort = $(this).data('sort');
            let direction = $(this).data('direction');
            let search = $('#search-input').val();
            let perPage = $('#perPage-select').val();
            fetchRoles(search, null, perPage, sort, direction);

            $(this).data('direction', direction === 'asc' ? 'desc' : 'asc');
        });

        $(document).on('click', '#pagination-links a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            let search = $('#search-input').val();
            let perPage = $('#perPage-select').val();
            let sort = '{{ $sort }}';
            let direction = '{{ $direction }}';
            fetchRoles(search, page, perPage, sort, direction);
        });
    });
</script>
@endsection
