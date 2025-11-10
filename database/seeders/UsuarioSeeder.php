<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        // - - - - - - - ADMINISTRADOR - - - - - - - - - - - 
        $usuario = User::create([
            'nombres'           => 'admin',
            'apellido_paterno'  => 'Paterno Admin',
            'apellido_materno'  => 'Materno Admin',
            'nro_documento'     => '99999999',
            'email'             => 'admin@gmail.com',
            'password'          => '123123123', // se encripta automáticamente por el mutador en el modelo
        ]);

        $rolAdmin = Role::create(['name' => 'Administrador']);
        $permisosAdmin = Permission::pluck('id', 'id')->all(); // Obtén todos los permisos
        $rolAdmin->syncPermissions($permisosAdmin);
        $usuario->assignRole([$rolAdmin->id]);


        // - - - - - - - PERSONA - - - - - - - - - - - 

        $usuarioPersona = User::create([
            'apellido_paterno'  => 'Demo',
            'apellido_materno'  => 'Ejemplo',
            'nombres'           => 'Persona',
            'nro_documento'     => '77777777',
            'fecha_nacimiento'  => '1995-05-05', // puedes cambiarlo
            'celular'           => '999999999',
            'email'             => 'persona@gmail.com',
            'password'          => Hash::make('123123123'),
            'curriculum_vitae'  => 'curriculums/CV_77777777.pdf', // ruta simulada
            'id_roles'          => 2, // si usas tu campo de relación con roles
        ]);

        // 🔹 Crear el rol "Personas" si no existe
        $rolPersona = Role::firstOrCreate(['name' => 'Personas']);

        // 🔹 Crear los permisos del módulo Persona si no existen
        $permisoVerPersona = Permission::firstOrCreate(['name' => 'ver-persona']);
        $permisoCrearPersona = Permission::firstOrCreate(['name' => 'crear-persona']);
        $permisoEditarPersona = Permission::firstOrCreate(['name' => 'editar-persona']);
        $permisoEliminarPersona = Permission::firstOrCreate(['name' => 'borrar-persona']);

        // 🔹 Asignar los permisos al rol
        $rolPersona->syncPermissions([
            $permisoVerPersona->name,
            $permisoCrearPersona->name,
            $permisoEditarPersona->name,
            $permisoEliminarPersona->name
        ]);

        // 🔹 Asignar el rol "Personas" al usuario
        $usuarioPersona->assignRole($rolPersona);


        // - - - - - - - EMPRESA - - - - - - - - - - - 

        $usuarioEmpresa = User::create([
            'id_roles'         => 3,
            'nro_ruc'          => '12345678901',
            'razon_social'     => 'Empresa Demo S.A.C.',
            'direccion_empresa'=> 'Av. Los Emprendedores 123 - Lima',
            'descripcion'      => 'Empresa dedicada a servicios tecnológicos y consultoría.',
            'apellido_paterno' => 'Demo',
            'apellido_materno' => 'Ejemplo',
            'nombres'          => 'Empresa',
            'nro_documento'    => '66666666',
            'celular'          => '987654321',
            'email'            => 'empresa@gmail.com',
            'password'         => Hash::make('123123123'),
            'url_logo'         => 'logos/LOGO_12345678901.png', // archivo simulado
        ]);

        // 🔹 Crear el rol "Empresas" si no existe
        $rolEmpresa = Role::firstOrCreate(['name' => 'Empresas']);

        // 🔹 Crear permisos si no existen
        $permisoVerEmpresa   = Permission::firstOrCreate(['name' => 'ver-empresa']);
        $permisoCrearEmpresa = Permission::firstOrCreate(['name' => 'crear-empresa']);
        $permisoEditarEmpresa= Permission::firstOrCreate(['name' => 'editar-empresa']);
        $permisoBorrarEmpresa= Permission::firstOrCreate(['name' => 'borrar-empresa']);

        // 🔹 Asignar permisos al rol (reemplaza los existentes si ya hay)
        $rolEmpresa->syncPermissions([
            $permisoVerEmpresa->name,
            $permisoCrearEmpresa->name,
            $permisoEditarEmpresa->name,
            $permisoBorrarEmpresa->name
        ]);

        // 🔹 Asignar el rol al usuario
        $usuarioEmpresa->assignRole($rolEmpresa);

        // - - - - - - - FISCALIZADOR - - - - - - - - - - - - 
        // $generador_qr = User::create([
        //     'name' => '',
        //     'apellido_paterno' => '',
        //     'apellido_materno' => '',
        //     'dni' => '',
        //     'persona_id' => '',
        //     'user_id' => '',
        //     'email' => 'fiscalizador@gmail.com',
        //     'user_name' => '',
        //     'password' => bcrypt(''),
        // ]);

        // $rolGeneradorQR = Role::create(['name' => 'Credenciales']);
        // $rolGeneradorQR->syncPermissions(['ver-qr']); // Asigna solo el permiso específico
        // $generador_qr->assignRole([$rolGeneradorQR->id]);

        // - - - - - - - ADMINISTRADO - - - - - - - - - - - - 
        // $administrado = User::create([
        //     'name' => 'Administrado PRUEBA',
        //     'apellido_paterno' => 'Paterno Fiscalizador',
        //     'apellido_materno' => 'Materno Fiscalizador',
        //     'dni' => '88888888',
        //     'persona_id' => '',
        //     'user_id' => '',
        //     // 'email' => 'fiscalizador@gmail.com',
        //     'user_name' => 'Administrado',
        //     'password' => bcrypt('123123123'),
        // ]);

        // $rolAdministrado = Role::create(['name' => 'Administrado']);
        // $rolAdministrado->syncPermissions(['ver-administrado']); // Asigna solo el permiso específico
        // $administrado->assignRole([$rolAdministrado->id]);
    }
}

