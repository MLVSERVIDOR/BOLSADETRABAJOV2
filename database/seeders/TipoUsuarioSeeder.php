<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_usuarios')->insert([
            ['nombre' => 'persona', 'descripcion' => 'Usuario tipo persona', 'estado' => '1'],
            ['nombre' => 'empresa', 'descripcion' => 'Usuario tipo empresa', 'estado' => '1'],
        ]);
    }
}
