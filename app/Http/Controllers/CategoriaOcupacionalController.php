<?php

namespace App\Http\Controllers;

use App\Models\CategoriaOcupacional;
use Illuminate\Http\Request;

class CategoriaOcupacionalController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-categoria|crear-categoria|editar-categoria|borrar-categoria', ['only' => ['index']]);
        $this->middleware('permission:crear-categoria', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-categoria', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-categoria', ['only' => ['destroy']]);
    }

    /** 🔹 Mostrar lista de categorías */
    public function index()
    {
        $categorias = CategoriaOcupacional::orderBy('id', 'desc')->get();
        return view('categoria_ocupacional.index', compact('categorias'));
    }

    /** 🔹 Formulario de creación */
    public function create()
    {
        return view('categoria_ocupacional.create');
    }

    /** 🔹 Guardar nueva categoría */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'sub_nombre' => 'nullable|string|max:255',
            'vacantes' => 'nullable|numeric|min:0',
            'descripcion' => 'nullable|string|max:500',
            'icono' => 'nullable|string|max:255',
        ]);

        CategoriaOcupacional::create([
            'nombre' => $request->nombre,
            'sub_nombre' => $request->sub_nombre,
            'vacantes' => $request->vacantes,
            'descripcion' => $request->descripcion,
            'icono' => $request->icono,
            'estado' => '1',
        ]);

        return redirect()->route('categoria-ocupacional.index')
                         ->with('success', 'Categoría creada correctamente.');
    }

    /** 🔹 Formulario de edición */
    public function edit($id)
    {
        $categoria = CategoriaOcupacional::findOrFail($id);
        return view('categoria_ocupacional.edit', compact('categoria'));
    }

    /** 🔹 Actualizar categoría */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'sub_nombre' => 'nullable|string|max:255',
            'vacantes' => 'nullable|numeric|min:0',
            'descripcion' => 'nullable|string|max:500',
            'icono' => 'nullable|string|max:255',
        ]);

        $categoria = CategoriaOcupacional::findOrFail($id);
        $categoria->update($request->all());

        return redirect()->route('categoria-ocupacional.index')
                         ->with('success', 'Categoría actualizada correctamente.');
    }

    /** 🔹 Cambiar estado (activar/inactivar) */
    public function destroy($id)
    {
        $categoria = CategoriaOcupacional::findOrFail($id);
        $categoria->estado = $categoria->estado === '1' ? '0' : '1';
        $categoria->save();

        return redirect()->route('categoria-ocupacional.index')
                         ->with('success', 'Estado de la categoría actualizado correctamente.');
    }
}
