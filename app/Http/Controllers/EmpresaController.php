<?php

namespace App\Http\Controllers;

use App\Models\AnuncioLaboral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    
    function __construct()
    {
        $this->middleware('permission:ver-empresa|crear-empresa|editar-empresa|borrar-empresa', ['only' => ['index']]);
        $this->middleware('permission:crear-empresa', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-empresa', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-empresa', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $userId = auth()->id();
        $us = auth()->user();
        // dd($us);
        // Consulta SQL directa con joins
        $anuncios = DB::select("
            SELECT 
                a.id,
                a.puesto,
                a.descripcion,
                a.vacantes,
                a.sueldo,
                a.fecha_limite,
                a.created_at,
                a.estado,
                a.motivo_rechazo,
                e.nombre,
                c.nombre AS categoria,
                m.nombre AS modalidad
            FROM anuncio_laborals a
            inner join etapas e on e.id = a.id_etapa
            INNER JOIN categoria_ocupacionals c ON c.id = a.id_categoria_ocupacionals
            INNER JOIN modalidads m ON m.id = a.id_modalidads
            WHERE a.estado = 1
            AND a.id_users = ?
            ORDER BY a.created_at DESC
        ", [$userId]);

        return view('empresa.index', compact('anuncios'));
    }

    
    public function create()
    {
        
        $modalidad = DB::select('select * from modalidads where estado = ?', [1]);
        $categoria_ocupacional = DB::select('select * from categoria_ocupacionals where estado = ?', [1]);
        // dd($modalidad, $categoria_ocupacional);
        return view('empresa.create', compact('modalidad', 'categoria_ocupacional'));
    }

    
    public function store(Request $request)
    {
        $users = Auth()->id();
        
        $request->validate([
            'puesto' => 'required|string|max:255',
            'id_categoria_ocupacionals' => 'required|integer',
            'id_modalidads' => 'required|integer',
            'vacantes' => 'required|integer|min:1',
            'sueldo' => 'required|numeric|min:0',
            'fecha_limite' => 'required|date|after_or_equal:today',
            'descripcion' => 'nullable|string',
            'condiciones' => 'nullable|string',
        ]);

        AnuncioLaboral::create([
            'id_users' => $users,
            'puesto' => $request->puesto,
            'id_categoria_ocupacionals' => $request->id_categoria_ocupacionals,
            'id_modalidads' => $request->id_modalidads,
            'vacantes' => $request->vacantes,
            'sueldo' => $request->sueldo,
            'fecha_limite' => $request->fecha_limite,
            'descripcion' => $request->descripcion,
            'condiciones' => $request->condiciones,
        ]);

        return redirect()->route('empresa.index')->with('success', 'Anuncio registrado correctamente.');
    
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit($id)
    {
        $modalidad = DB::select('SELECT * FROM modalidads WHERE estado = ?', [1]);
        $categoria_ocupacional = DB::select('SELECT * FROM categoria_ocupacionals WHERE estado = ?', [1]);
        $anuncio = AnuncioLaboral::findOrFail($id);

        return view('empresa.editar', compact('anuncio', 'modalidad', 'categoria_ocupacional'));
    }


    
    public function update(Request $request, $id)
    {
        $request->validate([
            'puesto' => 'required|string|max:255',
            'id_categoria_ocupacionals' => 'required|integer',
            'id_modalidads' => 'required|integer',
            'vacantes' => 'required|integer|min:1',
            'sueldo' => 'required|numeric|min:0',
            'fecha_limite' => 'required|date|after_or_equal:today',
            'descripcion' => 'nullable|string',
            'condiciones' => 'nullable|string',
        ]);

        $anuncio = AnuncioLaboral::findOrFail($id);
        $anuncio->update([
            'puesto' => $request->puesto,
            'id_categoria_ocupacionals' => $request->id_categoria_ocupacionals,
            'id_modalidads' => $request->id_modalidads,
            'vacantes' => $request->vacantes,
            'sueldo' => $request->sueldo,
            'fecha_limite' => $request->fecha_limite,
            'descripcion' => $request->descripcion,
            'condiciones' => $request->condiciones,
            'id_etapa' => 1,
        ]);

        return redirect()->route('empresa.index')->with('success', 'Anuncio actualizado correctamente.');
    }

   
    public function destroy($id)
    {
        $anuncio = AnuncioLaboral::findOrFail($id);

        // Cambiamos su estado a 0 (inactivo)
        $anuncio->estado = 0;
        $anuncio->save();

        return redirect()->route('empresa.index')->with('success', 'Anuncio eliminado correctamente.');
    }


    public function postulaciones()
    {
        $empresaId = Auth::id();

        $postulaciones = DB::table('postulacions as p')
            ->join('anuncio_laborals as a', 'a.id', '=', 'p.id_anuncio_laborals')
            ->join('users as u', 'u.id', '=', 'p.id_users')
            ->select(
                'p.id',
                'a.puesto',
                'u.nombres',
                'u.apellido_paterno',
                'u.apellido_materno',
                'u.email',
                'u.nro_documento',
                'p.curriculum_vitae',
                'p.estado',
                'p.created_at'
            )
            ->where('a.id_users', $empresaId)
            ->orderByDesc('p.created_at')
            ->get();

        return view('empresa.postulaciones', compact('postulaciones'));
    }


}
