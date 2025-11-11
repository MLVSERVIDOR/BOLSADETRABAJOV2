@foreach ($paginatedItems as $role)
    <tr>
        <td>{{ $role->id }}</td>
        <td>{{ $role->nombre }}</td>
        <td>
            @can('editar-rol')
            <a class="btn btn-warning waves-effect waves-float waves-light" href="{{ route('roles.edit', $role->id) }}">Editar</a>
            @endcan
            @can('borrar-rol')
            <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <input type="submit" value="Borrar" class="btn btn-danger">
            </form>
            @endcan
        </td>
    </tr>
@endforeach
