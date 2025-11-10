<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    // public function create(): View
    // {
    //     $tipo_documento = DB::select('SELECT * FROM tipo_documentos');
    //     return view('auth.register', compact('tipo_documento'));
    // }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required'|'string'|'email'|'max:255'|'unique:'.User::class,
            'password' => 'required'|'confirmed'| Rules\Password::defaults(),
        ], [
            'name.required' => 'Por favor, Ingrese el Nombre',
            'email.required' => 'Por favor, Ingrese el Correo',
            'password.required' => 'Por favor, Ingrese su contraseña',
            'password.confirmed' => 'Por favor, Ingrese la misma Contraseña',
        ]
    
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
