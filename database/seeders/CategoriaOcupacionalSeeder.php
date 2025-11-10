<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaOcupacionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categoria_ocupacionals')->insert([
            [
                'nombre' => 'Administrativo',
                'sub_nombre' => 'Gestión y Oficina',
                'vacantes' => 5,
                'descripcion' => 'Puestos relacionados con administración, atención al cliente y soporte organizacional.',
                'icono' => 'fa-solid fa-briefcase',
                'estado' => 1,
                'created_at' => now(),
            ],
            [
                'nombre' => 'Construcción',
                'sub_nombre' => 'Obras Públicas',
                'vacantes' => 3,
                'descripcion' => 'Actividades en obras civiles, mantenimiento y construcción de infraestructuras.',
                'icono' => 'fa-solid fa-hammer',
                'estado' => 1,
                'created_at' => now(),
            ],
            [
                'nombre' => 'Finanzas',
                'sub_nombre' => 'Contabilidad y Auditoría',
                'vacantes' => 4,
                'descripcion' => 'Gestión de presupuestos, contabilidad y procesos financieros.',
                'icono' => 'fa-solid fa-coins',
                'estado' => 1,
                'created_at' => now(),
            ],
            [
                'nombre' => 'Logística',
                'sub_nombre' => 'Transporte y Almacén',
                'vacantes' => 6,
                'descripcion' => 'Planificación, transporte, distribución y control de inventarios.',
                'icono' => 'fa-solid fa-truck',
                'estado' => 1,
                'created_at' => now(),
            ],
            [
                'nombre' => 'Salud',
                'sub_nombre' => 'Servicios Médicos',
                'vacantes' => 4,
                'descripcion' => 'Atención médica, enfermería, laboratorio y áreas de salud pública.',
                'icono' => 'fa-solid fa-stethoscope',
                'estado' => 1,
                'created_at' => now(),
            ],
            [
                'nombre' => 'Tecnología',
                'sub_nombre' => 'IT y Desarrollo',
                'vacantes' => 7,
                'descripcion' => 'Desarrollo de software, soporte técnico y análisis de sistemas.',
                'icono' => 'fa-solid fa-laptop-code',
                'estado' => 1,
                'created_at' => now(),
            ],
            [
                'nombre' => 'Educación',
                'sub_nombre' => 'Docencia',
                'vacantes' => 3,
                'descripcion' => 'Formación académica, capacitación y enseñanza.',
                'icono' => 'fa-solid fa-graduation-cap',
                'estado' => 1,
                'created_at' => now(),
            ],
            [
                'nombre' => 'Confección',
                'sub_nombre' => 'Taller Textil',
                'vacantes' => 2,
                'descripcion' => 'Confección y diseño de prendas textiles.',
                'icono' => 'fa-solid fa-scissors',
                'estado' => 1,
                'created_at' => now(),
            ],
            [
                'nombre' => 'Seguridad',
                'sub_nombre' => 'Serenazgo y Vigilancia',
                'vacantes' => 5,
                'descripcion' => 'Seguridad ciudadana, patrullaje y control de accesos.',
                'icono' => 'fa-solid fa-shield-halved',
                'estado' => 1,
                'created_at' => now(),
            ],
            [
                'nombre' => 'Restaurante',
                'sub_nombre' => 'Gastronomía',
                'vacantes' => 5,
                'descripcion' => 'Atención en restaurantes, cocina y servicio al cliente.',
                'icono' => 'fa-solid fa-utensils',
                'estado' => 1,
                'created_at' => now(),
            ],
        ]);
    }
}
