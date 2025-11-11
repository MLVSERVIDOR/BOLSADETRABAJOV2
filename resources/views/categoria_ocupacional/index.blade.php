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
<div class="app-content content ">
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <h2 class="content-header-title float-start mb-0">Categorías Ocupacionales</h2>
      </div>
    </div>

    <div class="content-body">
      <section id="lista-categorias">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Lista de Categorías</h4>
            @can('crear-categoria')
              <a href="{{ route('categoria-ocupacional.create') }}" class="btn btn-primary">Nuevo</a>
            @endcan
          </div>

          <div class="card-body">
            @if (session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover">
              <thead class="table-light">
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Sub Nombre</th>
                  <th>Vacantes</th>
                  <th>Descripción</th>
                  <th>Icono</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categorias as $categoria)
                <tr>
                  <td>{{ $categoria->id }}</td>
                  <td>{{ $categoria->nombre }}</td>
                  <td>{{ $categoria->sub_nombre ?? '-' }}</td>
                  <td>{{ $categoria->vacantes ?? '0' }}</td>
                  <td>{{ $categoria->descripcion ?? '-' }}</td>
                  <td><i class="{{ $categoria->icono }}"></i></td>
                  <td>
                    @if($categoria->estado == '1')
                      <span class="badge bg-success">Activo</span>
                    @else
                      <span class="badge bg-danger">Inactivo</span>
                    @endif
                  </td>
                  <td>
                    @can('editar-categoria')
                      <a href="{{ route('categoria-ocupacional.edit', $categoria->id) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i>
                      </a>
                    @endcan

                    @can('borrar-categoria')
                      <form action="{{ route('categoria-ocupacional.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                          onclick="return confirm('¿Seguro que deseas cambiar el estado de esta categoría?')">
                          <i class="fas fa-power-off"></i>
                        </button>
                      </form>
                    @endcan
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>
      </section>
    </div>
  </div>
</div>
@endsection

