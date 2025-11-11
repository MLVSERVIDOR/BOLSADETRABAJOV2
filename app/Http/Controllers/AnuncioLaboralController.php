<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnuncioLaboralController extends Controller
{
    public function index()
    {
        $anuncios = DB::select("
            SELECT 
                al.id,
                al.id_categoria_ocupacionals,
                co.nombre,
                al.puesto,
                al.vacantes,
                al.sueldo,
                al.id_etapa,
                al.motivo_rechazo,
                al.fecha_limite,
                al.descripcion,
                al.condiciones,
                al.created_at,
                e.nombre AS estado_nombre
            FROM anuncio_laborals al
            LEFT JOIN etapas e ON e.id = al.id_etapa
            inner join categoria_ocupacionals co on co.id = al.id_categoria_ocupacionals
            where al.id_etapa = 2
            ORDER BY 
                CASE 
                    WHEN al.id_etapa = 1 THEN 0   -- Pendiente primero
                    WHEN al.id_etapa = 2 THEN 1   -- Aprobado
                    WHEN al.id_etapa = 3 THEN 2   -- Rechazado
                    ELSE 3
                END,
                al.created_at DESC
        ");

        return view('anuncio_laboral.index', compact('anuncios'));
    }

    public function actualizarEtapa(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'etapa' => 'required|integer',
            'motivo_rechazo' => 'nullable|string|max:500',
        ]);

        DB::table('anuncio_laborals')
            ->where('id', $request->id)
            ->update([
                'id_etapa' => $request->etapa,
                'motivo_rechazo' => $request->etapa == 3 ? $request->motivo_rechazo : null,
                'updated_at' => now(),
            ]);

        return response()->json([
            'success' => true,
            'message' => $request->etapa == 3
                ? 'Anuncio rechazado con motivo registrado.'
                : 'Anuncio aprobado correctamente.'
        ]);
    }
    
}
