<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class RegistrarController extends Controller
{

    public function registrar_persona()
    {
        $tipo_documento = DB::select('SELECT * FROM tipo_documentos where estado = 1');
        return view('auth.register_persona', compact('tipo_documento'));
    }

    public function registrar_empresa()
    {
        $tipo_documento = DB::select('SELECT * FROM tipo_documentos where estado = 1');
        return view('auth.register_empresa', compact('tipo_documento'));
    }

    public function storePersona(Request $request)
    {
        $request->validate([
            'apellido_paterno' => 'required|string|max:150',
            'apellido_materno' => 'required|string|max:150',
            'nombres' => 'required|string|max:150',
            'id_tipo_documentos' => 'required',
            'nro_documento' => 'required|string|max:20|unique:users,nro_documento',
            'fecha_nacimiento' => 'required|date',
            'celular' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email|confirmed',
            'password' => 'required|min:6|confirmed',
            'curriculum_vitae' => 'required|file|mimes:pdf,doc,docx|max:512000',
        ]);
        // 🔹 Crear nuevo usuario
        $user = new User();
        $user->id_roles = 2; // si manejas tu propia relación interna con roles
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->nombres = $request->nombres;
        $user->id_tipo_documentos = $request->id_tipo_documentos;
        $user->nro_documento = $request->nro_documento;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->celular = $request->celular;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        // 🔹 Guardar CV en storage
        if ($request->hasFile('curriculum_vitae')) {
            $file = $request->file('curriculum_vitae');
            $extension = $file->getClientOriginalExtension();
            $filename = 'CV_' . $request->nro_documento . '.' . $extension;
            $path = $file->storeAs('curriculums', $filename, 'public');
            $user->curriculum_vitae = $path;
        }

        $user->save();

        // - - - - - - - ROLES Y PERMISOS - - - - - - - - -

        // 🔹 Obtener o crear el rol "Personas"
        $rolPersona = Role::firstOrCreate(['name' => 'Personas']);

        // 🔹 Crear permisos si no existen
        $permisoVerPersona = Permission::firstOrCreate(['name' => 'ver-persona']);
        $permisoCrearPersona = Permission::firstOrCreate(['name' => 'crear-persona']);
        $permisoEditarPersona = Permission::firstOrCreate(['name' => 'editar-persona']);
        $permisoEliminarPersona = Permission::firstOrCreate(['name' => 'borrar-persona']);

        // 🔹 Asignar permisos al rol (sin duplicar los existentes)
        $rolPersona->syncPermissions([
            $permisoVerPersona->name,
            $permisoCrearPersona->name,
            $permisoEditarPersona->name,
            $permisoEliminarPersona->name
        ]);

        // 🔹 Asignar el rol "Personas" al nuevo usuario
        $user->assignRole($rolPersona);

        // 🔹 Iniciar sesión automáticamente
        auth()->login($user);

        return redirect('/')->with('success', 'Registro de persona completado correctamente.');
    }

    public function storeEmpresa(Request $request)
    {
        $request->validate([
            'nro_ruc' => 'required|string|max:11|unique:users,nro_ruc',
            'razon_social' => 'required|string|max:255',
            'direccion_empresa' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
            'id_tipo_documentos' => 'required',
            'nro_documento' => 'required|string|max:20|unique:users,nro_documento',
            'celular' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'url_logo' => 'nullable|file|mimes:jpg,jpeg,png,svg|max:25600',
        ]);

        // 🔹 Crear nuevo usuario Empresa
        $user = new User();
        $user->id_roles = 3;
        $user->nro_ruc = $request->nro_ruc;
        $user->razon_social = $request->razon_social;
        $user->direccion_empresa = $request->direccion_empresa;
        $user->descripcion = $request->descripcion;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->nombres = $request->nombres;
        $user->id_tipo_documentos = $request->id_tipo_documentos;
        $user->nro_documento = $request->nro_documento;
        $user->celular = $request->celular;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        // 🔹 Guardar logo en /storage/app/public/logos
        if ($request->hasFile('url_logo')) {
            $file = $request->file('url_logo');
            $extension = $file->getClientOriginalExtension();
            $filename = 'LOGO_' . $request->nro_ruc . '.' . $extension;
            $path = $file->storeAs('logos', $filename, 'public');
            $user->url_logo = $path;
        }

        $user->save();

        // - - - - - - - ROLES Y PERMISOS - - - - - - - - -

        // 🔹 Crear o buscar el rol “Empresas”
        $rolEmpresa = Role::firstOrCreate(['name' => 'Empresas']);

        // 🔹 Crear los permisos del módulo Empresa si no existen
        $permisoVerEmpresa = Permission::firstOrCreate(['name' => 'ver-empresa']);
        $permisoCrearEmpresa = Permission::firstOrCreate(['name' => 'crear-empresa']);
        $permisoEditarEmpresa = Permission::firstOrCreate(['name' => 'editar-empresa']);
        $permisoBorrarEmpresa = Permission::firstOrCreate(['name' => 'borrar-empresa']);

        // 🔹 Asignar los permisos al rol (reemplaza los existentes si ya hay)
        $rolEmpresa->syncPermissions([
            $permisoVerEmpresa->name,
            $permisoCrearEmpresa->name,
            $permisoEditarEmpresa->name,
            $permisoBorrarEmpresa->name
        ]);

        // 🔹 Asignar el rol al usuario Empresa
        $user->assignRole($rolEmpresa);

        // 🔹 Iniciar sesión automáticamente
        auth()->login($user);

        return redirect('/')->with('success', 'Registro de empresa completado correctamente.');
    }


}
