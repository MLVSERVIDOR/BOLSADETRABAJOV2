<?php

namespace App\Http\Controllers;

use App\Models\CategoriaOcupacional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{

    public function index(Request $request)
{
    // 🔹 Obtener el texto de búsqueda (si existe)
    $buscar = $request->input('buscar');

    // 🔹 Query SQL base
    $sql = "select * from anuncio_laborals 
                inner join categoria_ocupacionals on categoria_ocupacionals.id = anuncio_laborals.id_categoria_ocupacionals 
                where id_etapa = 2";

    // 🔹 Agregar filtro de búsqueda si existe
    if ($buscar) {
        $sql .= " AND (nombre LIKE '%$buscar%' OR sub_nombre LIKE '%$buscar%')";
    }

   
    $categorias = DB::select($sql);
    
    // 🔹 Contar las repeticiones de id_categoria_ocupacionals
    $conteoOfertas = [];
    foreach ($categorias as $categoria) {
        $id = $categoria->id_categoria_ocupacionals;
        if (isset($conteoOfertas[$id])) {
            $conteoOfertas[$id]++;
        } else {
            $conteoOfertas[$id] = 1;
        }
    }

    // dd($conteoOfertas, $categorias);

    return view('welcome', compact('categorias','conteoOfertas'));
}


}
