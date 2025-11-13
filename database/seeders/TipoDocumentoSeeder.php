<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define los tipos de documento
        $tiposDocumento = [
            [
                'nombre' => 'DNI', 
                'descripcion' => 'DNI', // Opcional: ajusta si tienes esta columna
                'estado' => '1',
                
            ],
            [
                'nombre' => 'Carnet CONADIS', 
                'descripcion' => 'Carnet CONADIS', // Opcional
                'estado' => '1',
                
            ],
            [
                'nombre' => 'Carnet de Extranjería', 
                'descripcion' => 'Carnet de Extranjería', // Opcional
                'estado' => '1',
                
            ],
            [
                'nombre' => 'Pasaporte', 
                'descripcion' => 'Pasaporte', // Opcional
                'estado' => '1',
                
            ],
        ];

        // Inserta los datos en la tabla
        DB::table('tipo_documentos')->insert($tiposDocumento); 
        // Asegúrate que 'tipo_documentos' es el nombre correcto de tu tabla
    }
}
