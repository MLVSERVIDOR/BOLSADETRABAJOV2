@foreach ($paginatedItems as $usuario)
    <tr>
        <td>{{ $usuario->id }}</td>
        <td>{{ $usuario->nombre }}</td>
        <td>{{ $usuario->apellido_paterno }}</td>
        <td>{{ $usuario->apellido_materno }}</td>
        <td>{{ $usuario->dni }}</td>
        <td>{{ $usuario->users_usuario }}</td>
        <td>
            @if (!empty($usuario->role_nombre))
                <span class="badge badge-light-success">{{ $usuario->role_nombre }}</span>
            @endif
        </td>
        <td>
            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>
            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</button>
            </form>
        </td>
    </tr>
@endforeach
