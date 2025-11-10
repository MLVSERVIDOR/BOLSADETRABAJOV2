<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Permission;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }







    public function store(LoginRequest $request): RedirectResponse
    {


        // 1️⃣ Obtener credenciales del formulario
        $email = $request->input('email');
        $password = $request->input('password');

        // 2️⃣ Buscar usuario activo por correo
        $user = User::where('email', $email)
            ->where('id_estado', 1) // tu columna es 'id_estado'
            ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'El usuario no existe o está inactivo.',
            ]);
        }

        // 3️⃣ Validar credenciales
        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return back()->withErrors([
                'email' => 'Credenciales inválidas.',
            ]);
        }

        // 4️⃣ Regenerar sesión
        $request->session()->regenerate();

        // 5️⃣ Redirigir al home
        return redirect()->intended(RouteServiceProvider::HOME);
    }




    
















    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
