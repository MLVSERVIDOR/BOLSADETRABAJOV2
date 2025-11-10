<?php

namespace App\Http\Controllers;

use App\Models\AnuncioLaboral;
use App\Models\CategoriaOcupacional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PersonaController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:ver-persona|crear-persona|editar-persona|borrar-persona', ['only' => ['index']]);
        $this->middleware('permission:crear-persona', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-persona', ['only' => ['edit', 'update']]);

        $this->middleware('permission:borrar-persona', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = auth()->user();
        $postulaciones = DB::select('SELECT
                a.*,
                p.* 
            FROM 
                postulacions p 
            INNER JOIN 
                anuncio_laborals a ON a.id = p.id_anuncio_laborals 
            WHERE 
                p.id_users = ? and p.estado = 1  
            ORDER BY 
                p.created_at DESC;', [$user->id]);

        return view('persona.index', compact('postulaciones'));
    }

    public function updatePerfil(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nombres' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'celular' => 'required|string|max:15',
        ]);

        $user->update([
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'nombres' => $request->nombres,
            'email' => $request->email,
            'celular' => $request->celular,
        ]);

        return response()->json([
            'ok' => true,
            'mensaje' => 'Perfil actualizado correctamente.',
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'url_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Eliminar foto anterior si existe
        if ($user->url_logo && Storage::disk('public')->exists($user->url_logo)) {
            Storage::disk('public')->delete($user->url_logo);
        }

        // Guardar nueva foto
        $filename = 'PROFILE_' . $user->id . '_' . time() . '.' . $request->file('url_logo')->getClientOriginalExtension();
        $path = $request->file('url_logo')->storeAs('profile-photos', $filename, 'public');

        $user->update(['url_logo' => $path]);

        return back()->with('success', 'Foto de perfil actualizada correctamente.');
    }

    public function show(string $id)
    {
        // Obtener la categoría
        $categoria = CategoriaOcupacional::findOrFail($id);

        // Obtener los anuncios laborales de esa categoría junto con el icono
        $empleos = AnuncioLaboral::select(
            'anuncio_laborals.*',
            'categoria_ocupacionals.icono as categoria_icono'
        )
            ->leftJoin('categoria_ocupacionals', 'categoria_ocupacionals.id', '=', 'anuncio_laborals.id_categoria_ocupacionals')
            ->where('anuncio_laborals.id_categoria_ocupacionals', $id)
            ->where('anuncio_laborals.id_etapa', 2)
            ->get();
        // dd($empleos);
        // Mostrar la vista
        return view('persona.show', compact('categoria', 'empleos'));
    }

    public function detalle($id)
    {
        $empleo = AnuncioLaboral::select(
            'anuncio_laborals.id',
            'anuncio_laborals.puesto',
            'anuncio_laborals.descripcion',
            'anuncio_laborals.condiciones',
            'anuncio_laborals.vacantes',
            'anuncio_laborals.sueldo',
            'anuncio_laborals.fecha_limite',
            'anuncio_laborals.created_at',
            'm.nombre as modalidad',
            'c.nombre as categoria'
        )
            ->leftJoin('modalidads as m', 'm.id', '=', 'anuncio_laborals.id_modalidads')
            ->leftJoin('categoria_ocupacionals as c', 'c.id', '=', 'anuncio_laborals.id_categoria_ocupacionals')
            ->where('anuncio_laborals.id', $id)
            ->first();

        if (! $empleo) {
            return response()->json(['error' => 'No se encontró el empleo.'], 404);
        }

        return response()->json($empleo);
    }

    public function postular($id)
    {
        try {
            $user = auth()->user();

            if (! $user) {
                return response()->json([
                    'ok' => false,
                    'mensaje' => 'Debes iniciar sesión para postular.',
                ]);
            }

            // Verificar si ya postuló
            $yaPostulo = DB::table('postulacions')
                ->where('id_users', $user->id)
                ->where('id_anuncio_laborals', $id)
                ->exists();

            if ($yaPostulo) {
                return response()->json([
                    'ok' => false,
                    'mensaje' => 'Ya has postulado a este empleo anteriormente.',
                ]);
            }

            // Insertar postulación
            DB::table('postulacions')->insert([
                'id_users' => $user->id,
                'id_anuncio_laborals' => $id,
                'curriculum_vitae' => $user->curriculum_vitae,
                'estado' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'ok' => true,
                'mensaje' => 'Tu postulación fue registrada correctamente.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'Error al postular: ' . $th->getMessage(),
            ]);
        }
    }
}
