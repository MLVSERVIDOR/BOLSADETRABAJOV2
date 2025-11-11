<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Verificación de sesión
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }

        // Si es Persona → redirige a su vista
        if ($user->hasRole('Personas')) {
            return redirect()->route('persona.index')->with('info', 'Bienvenido a tu panel de Persona.');
        }

        // Si es Empresa → redirige a su vista
        if ($user->hasRole('Empresas')) {
            return redirect()->route('empresa.index')->with('info', 'Bienvenido a tu panel de Empresa.');
        }

        // Solo administradores y otros roles ven el dashboard con estadísticas
        // Total de Postulantes (usuarios con rol de persona)
        $totalPostulantes = DB::table('users')
            ->where('id_roles', '2') // Asumiendo que 2 es el rol de persona
            ->count();

        // Total de Empresas (usuarios con rol de empresa)
        $totalEmpresas = DB::table('users')
            ->where('id_roles', '3') // Asumiendo que 3 es el rol de empresa
            ->count();

        // Puestos Pendientes de Aprobación (anuncios en etapa 1)
        $puestosPendientes = DB::table('anuncio_laborals')
            ->where('id_etapa', '1')
            ->where('estado', '1')
            ->count();

        // Total de Anuncios Publicados
        $totalAnuncios = DB::table('anuncio_laborals')
            ->where('estado', '1')
            ->count();

        // Postulaciones por Estado
        $postulacionesEnRevision = DB::table('postulacions')
            ->where('estado', '1')
            ->count();

        $postulacionesAprobadas = DB::table('postulacions')
            ->where('estado', '2')
            ->count();

        $postulacionesRechazadas = DB::table('postulacions')
            ->where('estado', '3')
            ->count();

        // Porcentaje de Postulantes Aprobados
        $totalPostulaciones = $postulacionesEnRevision + $postulacionesAprobadas + $postulacionesRechazadas;
        $porcentajeAprobados = $totalPostulaciones > 0 ?
            round(($postulacionesAprobadas / $totalPostulaciones) * 100, 2) : 0;

        // Anuncios por Categoría
        $categorias = DB::table('anuncio_laborals')
            ->join('categoria_ocupacionals', 'anuncio_laborals.id_categoria_ocupacionals', '=', 'categoria_ocupacionals.id')
            ->select('categoria_ocupacionals.nombre', DB::raw('COUNT(*) as total'))
            ->where('anuncio_laborals.estado', '1')
            ->groupBy('categoria_ocupacionals.nombre')
            ->get();

        $categoriasNombres = $categorias->pluck('nombre')->toArray();
        $categoriasCount = $categorias->pluck('total')->toArray();

        // Postulaciones Mensuales (último año)
        // Postulaciones Mensuales (último año)
        $postulacionesMensuales = DB::table('postulacions')
            ->select(DB::raw('MONTH(created_at) as mes'), DB::raw('COUNT(*) as total'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Inicializar array con ceros
        $mensualData = array_fill(0, 12, 0);

        // Solo procesar si hay resultados
        if (!$postulacionesMensuales->isEmpty()) {
            foreach ($postulacionesMensuales as $item) {
                // Conversión segura a entero
                $mesIndex = (int)$item->mes - 1;
                if ($mesIndex >= 0 && $mesIndex < 12) {
                    $mensualData[$mesIndex] = (int)$item->total;
                }
            }
        }

        // Distribución por Modalidad
        $modalidades = DB::table('anuncio_laborals')
            ->join('modalidads', 'anuncio_laborals.id_modalidads', '=', 'modalidads.id')
            ->select('modalidads.nombre', DB::raw('COUNT(*) as total'))
            ->where('anuncio_laborals.estado', '1')
            ->groupBy('modalidads.nombre')
            ->get();

        $modalidadesNombres = $modalidades->pluck('nombre')->toArray();
        $modalidadesCount = $modalidades->pluck('total')->toArray();

        return view('dashboard', compact(
            'user',
            'totalPostulantes',
            'totalEmpresas',
            'puestosPendientes',
            'totalAnuncios',
            'porcentajeAprobados',
            'postulacionesEnRevision',
            'postulacionesAprobadas',
            'postulacionesRechazadas',
            'categoriasNombres',
            'categoriasCount',
            'mensualData',
            'modalidadesNombres',
            'modalidadesCount'
        ));
    }
}
