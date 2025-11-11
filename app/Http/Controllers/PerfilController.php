<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Detectar rol del usuario
        if ($user->hasRole('Personas')) {
            return view('auth.perfil', [
                'user' => $user,
                'tipo' => 'persona'
            ]);
        }

        if ($user->hasRole('Empresas')) {
            return view('auth.perfil', [
                'user' => $user,
                'tipo' => 'empresa'
            ]);
        }

        // Si no tiene ninguno
        return redirect('/')->with('error', 'No tiene un rol asignado.');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        if ($user->hasRole('Personas')) {
            $request->validate([
                'nombres' => 'required|string|max:150',
                'apellido_paterno' => 'required|string|max:150',
                'apellido_materno' => 'required|string|max:150',
                'celular' => 'required|string|max:15',
            ]);

            $user->update($request->only('nombres', 'apellido_paterno', 'apellido_materno', 'celular'));
        }

        if ($user->hasRole('Empresas')) {
            $request->validate([
                'razon_social' => 'required|string|max:255',
                'direccion_empresa' => 'required|string|max:255',
                'descripcion' => 'required|string|max:500',
                'url_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $data = $request->only('razon_social', 'direccion_empresa', 'descripcion');

            if ($request->hasFile('url_logo')) {
                $file = $request->file('url_logo');
                $extension = $file->getClientOriginalExtension();
                $filename = 'LOGO_' . $user->nro_ruc . '.' . $extension;
                
                // Eliminar logos anteriores del mismo RUC
                $files = glob(storage_path('app/public/logos/LOGO_' . $user->nro_ruc . '.*'));
                foreach ($files as $fileToDelete) {
                    if (is_file($fileToDelete)) {
                        unlink($fileToDelete);
                    }
                }
                
                // Guardar nuevo logo
                $file->move(storage_path('app/public/logos'), $filename);
                $data['url_logo'] = 'logos/' . $filename;
            } else {
                // Mantener el logo existente
                $data['url_logo'] = $user->url_logo;
            }

            $user->update($data);
        }

        return back()->with('success', 'Perfil actualizado correctamente.');
    }




}
