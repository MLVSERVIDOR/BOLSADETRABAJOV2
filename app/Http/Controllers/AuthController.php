<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // CERRAR SESION....
    public function logout()
    {
        Auth::logout();  
        return redirect('/');
    }

    

}
