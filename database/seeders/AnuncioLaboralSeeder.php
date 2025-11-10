<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AnuncioLaboralSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('es_PE');

        for ($i = 1; $i <= 20; $i++) {
            DB::table('anuncio_laborals')->insert([
                'id_users' => $faker->numberBetween(2, 5), // ID de empresas demo
                'puesto' => ucfirst($faker->jobTitle()),
                'id_categoria_ocupacionals' => $faker->numberBetween(1, 10),
                'id_modalidads' => $faker->numberBetween(1, 3),
                'vacantes' => $faker->numberBetween(1, 10),
                'sueldo' => $faker->randomFloat(2, 1200, 8500),
                'fecha_limite' => Carbon::now()->addDays(rand(10, 60)),
                'descripcion' => $faker->paragraph(4),
                'condiciones' => $faker->paragraph(3),
                'id_etapa' => $faker->numberBetween(1, 3),
                'motivo_rechazo' => null,
                'estado' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
