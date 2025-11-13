<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalidadSeeder extends Seeder
{
    
    // public function run(): void
    // {
    //     DB::table('modalidads')->insert([
    //         [
    //             'nombre' => 'Tiempo completo',
    //             'descripcion' => 'Jornada laboral completa',
    //             'estado' => 1,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ],
    //         [
    //             'nombre' => 'Medio tiempo',
    //             'descripcion' => 'Jornada parcial o medio turno',
    //             'estado' => 1,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ],
    //         [
    //             'nombre' => 'Temporal',
    //             'descripcion' => 'Empleo de duración limitada o por proyecto',
    //             'estado' => 1,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ],
    //         [
    //             'nombre' => 'Eventual',
    //             'descripcion' => 'Trabajo ocasional o de corta duración',
    //             'estado' => 1,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ],
    //         [
    //             'nombre' => 'Trabajo remoto',
    //             'descripcion' => 'Trabajo realizado de forma remota o desde casa',
    //             'estado' => 1,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ],
    //     ]);
    // }

    public function run(): void
    {
        DB::table('modalidads')->insert([
            [
                'nombre' => 'Presencial',
                'descripcion' => 'Trabajo realizado de manera presencial en las instalaciones.',
                'estado' => 1,
                
            ],
            [
                'nombre' => 'Remoto',
                'descripcion' => 'Trabajo realizado completamente desde casa o fuera de la oficina.',
                'estado' => 1,
                
            ],
            [
                'nombre' => 'Híbrido',
                'descripcion' => 'Combinación de trabajo remoto y presencial.',
                'estado' => 1,
                
            ],
        ]);
    }
}
