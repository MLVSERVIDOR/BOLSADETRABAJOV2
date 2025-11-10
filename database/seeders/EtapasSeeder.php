<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtapasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('etapas')->insert([
            [
            'nombre' => 'Pendiente',
            'descripcion' => 'La solicitud está pendiente de revisión.',
            'estado' => '1',
            'created_at' => now()
            ],
            [
            'nombre' => 'Aprobado',
            'descripcion' => 'La solicitud ha sido aprobada.',
            'estado' => '1',
            'created_at' => now()
            ],
            [
            'nombre' => 'Rechazado',
            'descripcion' => 'La solicitud ha sido rechazada.',
            'estado' => '1',
            'created_at' => now()
            ],
        ]);
        
    }
}
