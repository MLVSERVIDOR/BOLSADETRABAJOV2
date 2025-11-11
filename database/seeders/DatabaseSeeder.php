<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CategoriaOcupacional;
use App\Models\DocumentType;
use App\Models\Modalidad;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    { 
        $this->call([
            SeederTablaPermisos::class,
            UsuarioSeeder::class,
            TipoUsuarioSeeder::class,
            CategoriaOcupacionalSeeder::class,
            ModalidadSeeder::class,
            EtapasSeeder::class,
            // AnuncioLaboralSeeder::class,
            TipoDocumentoSeeder::class,
                    

        ]);
    }
}
