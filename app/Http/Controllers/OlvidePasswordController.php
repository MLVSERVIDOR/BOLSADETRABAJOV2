<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class OlvidePasswordController extends Controller
{
     // 🔹 Muestra la vista donde se ingresa el correo
    public function index()
    {
        return view('olvide_password.olvide_password');
    }

    // 🔹 Envía el enlace de restablecimiento al correo
    public function send(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('status', 'No se encontró un usuario con ese correo.');
        }

        // Generar token
        $token = Str::random(64);
        $user->remember_token = $token;
        $user->save();

        // 🔹 Enlace con tu propia ruta
        $resetLink = route('olvide.password.form', ['token' => $token, 'email' => $user->email]);

        // Enviar correo con tu diseño
        Mail::send('emails.reset_password', [
            'user' => $user,
            'resetLink' => $resetLink
        ], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Restablecer contraseña - Municipalidad de La Victoria');
        });

        return back()->with('status', 'Se envió un enlace de recuperación a tu correo.');
    }

    // 🔹 Muestra la vista donde se ingresa la nueva contraseña
    public function showResetForm($token, Request $request)
    {
        return view('olvide_password.reset_password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    // 🔹 Actualiza la contraseña del usuario
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)
                    ->where('remember_token', $request->token)
                    ->first();

        if (!$user) {
            return back()->with('status', 'El enlace no es válido o ha expirado.');
        }

        // Cambiar contraseña y limpiar token
        $user->password = Hash::make($request->password);
        $user->remember_token = null;
        $user->save();

        return redirect('/login')->with('success', 'Tu contraseña se actualizó correctamente.');
    }
}
