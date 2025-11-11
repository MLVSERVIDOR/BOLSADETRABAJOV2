<?php

use App\Http\Controllers\AnuncioLaboralController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaOcupacionalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SocketController;
use App\Http\Controllers\Restaurante\RestauranteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;;
use App\Http\Controllers\Restaurante\VentaController;

use App\Http\Controllers\Generador\GeneradorController;
use App\Http\Controllers\Credencial\CredencialController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\Generador\AreaController;
use App\Http\Controllers\Generador\Vista\VistaController;
use App\Http\Controllers\OlvidePasswordController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\WelcomeController;
// pdf
use Illuminate\Support\Facades\Storage;


// Route::get('/', function () {
//     return view('auth.login');
// });
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');


// Route::get('/login', [AuthController::class, 'loginFiscalizador'])->name('login.fiscalizador');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);
// Route::get('/login', [AuthController::class, 'loginFiscalizador']);
// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);


Route::get('/registrar/persona', [RegistrarController::class, 'registrar_persona'])->name('registrar.persona');
Route::get('/registrar/empresa', [RegistrarController::class, 'registrar_empresa'])->name('registrar.empresa');
Route::post('/registrar/persona', [RegistrarController::class, 'storePersona'])->name('registrar.persona');
Route::post('/registrar/empresa', [RegistrarController::class, 'storeEmpresa'])->name('registrar.empresa');

Route::get('/tipo-documentos', [RegistrarController::class, 'tipo_documentos'])->name('tipo.documentos');

//  - - - - - - - - - - - - - - - - - - - OLVIDE CONTRASEÑA - - - - - - - - - - - - - - - - - - - - - 
// Vista donde se ingresa el correo
Route::get('/olvide-password', [OlvidePasswordController::class, 'index'])->name('olvide.password.index');

// Enviar el enlace al correo
Route::post('/olvide-password/send', [OlvidePasswordController::class, 'send'])->name('olvide.password.send');

// Vista para poner nueva contraseña (al hacer clic en el enlace del correo)
Route::get('/restablecer-password/{token}', [OlvidePasswordController::class, 'showResetForm'])->name('olvide.password.form');

// Guardar nueva contraseña
Route::post('/restablecer-password', [OlvidePasswordController::class, 'updatePassword'])->name('olvide.password.update');


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

Route::group(['middleware' => ['auth']], function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/perfil', [ProfileController::class, 'perfil'])->name('perfil');
    Route::post('/perfil', [ProfileController::class, 'update'])->name('perfil.update');

    // : : : : : : : : : : : : : : : ROLES - USUARIOS - MODULO : : : : : : : : : : : : : : : : : : : : : : : : : : : : : : : : : :
    Route::resource('roles', RolController::class);

    

    Route::resource('usuarios', UsuarioController::class);
    Route::put('usuarios/{usuario}/update-permissions', [UsuarioController::class, 'updatePermissions'])->name('usuarios.updatePermissions');

    Route::get('modules', [ModuleController::class, 'index'])->name('modules.index');
    Route::get('modules/create', [ModuleController::class, 'create'])->name('modules.create');
    Route::post('modules', [ModuleController::class, 'store'])->name('modules.store');
    Route::get('modules/{id}/edit', [ModuleController::class, 'edit'])->name('modules.edit');
    Route::put('modules/{id}', [ModuleController::class, 'update'])->name('modules.update');
    Route::delete('modules/{id}', [ModuleController::class, 'destroy'])->name('modules.destroy');

    





    // : : : : : : : : : : : : : : : CATEGORIA OCUPACIONAL  : : : : : : : : : : : : :
    Route::get('categoria-ocupacional', [CategoriaOcupacionalController::class, 'index'])->name('categoria-ocupacional.index');
    Route::get('categoria-ocupacional/create', [CategoriaOcupacionalController::class, 'create'])->name('categoria-ocupacional.create');
    Route::post('categoria-ocupacional', [CategoriaOcupacionalController::class, 'store'])->name('categoria-ocupacional.store');
    Route::get('categoria-ocupacional/{id}/edit', [CategoriaOcupacionalController::class, 'edit'])->name('categoria-ocupacional.edit');
    Route::put('categoria-ocupacional/{id}', [CategoriaOcupacionalController::class, 'update'])->name('categoria-ocupacional.update');
    Route::delete('categoria-ocupacional/{id}', [CategoriaOcupacionalController::class, 'destroy'])->name('categoria-ocupacional.destroy');

    // : : : : : : : : : : : : : : : ANUNCIO LABORAL : : : : : : : : : : : : : : : : :
    Route::get('anuncio-laboral', [AnuncioLaboralController::class, 'index'])->name('anuncio-laboral.index');
    Route::post('anuncio-laboral/actualizar-etapa', [AnuncioLaboralController::class, 'actualizarEtapa'])->name('anuncio-laboral.actualizar-etapa');


    // : : : : : : : : : : : : : : : PERFIL : : : : : : : : : : : : : : : : :

    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::post('/perfil', [PerfilController::class, 'update'])->name('perfil.update');


});


    Route::group(['middleware' => ['auth', 'role:Personas']], function () {
        
        // : : : : : : : : : : : : : : : PERSONA : : : : : : : : : : : : :
        Route::get('persona', [PersonaController::class, 'index'])->name('persona.index');
        Route::get('persona/create', [PersonaController::class, 'create'])->name('persona.create');
        Route::post('persona', [PersonaController::class, 'store'])->name('persona.store');
        Route::get('/persona/{id}', [PersonaController::class, 'show'])->name('persona.show');
        Route::get('persona/{id}/edit', [PersonaController::class, 'edit'])->name('persona.edit');
        Route::put('persona/{id}', [PersonaController::class, 'update'])->name('persona.update');
        Route::delete('persona/{id}', [PersonaController::class, 'destroy'])->name('persona.destroy');

        Route::get('/persona/anuncio/{id}', [PersonaController::class, 'detalle']);
        Route::post('/persona/postular/{id}', [PersonaController::class, 'postular'])->name('persona.postular');
        Route::post('/persona/update-perfil', [PersonaController::class, 'updatePerfil'])->name('persona.updatePerfil');
        Route::post('/profile/update-photo', [PersonaController::class, 'updatePhoto'])->name('profile.update.photo');


    });

    Route::group(['middleware' => ['auth', 'role:Empresas']], function () {
        
        // : : : : : : : : : : : : : : : EMPRESA : : : : : : : : : : : : :
        Route::get('empresa', [EmpresaController::class, 'index'])->name('empresa.index');
        Route::get('empresa/create', [EmpresaController::class, 'create'])->name('empresa.create');
        Route::post('empresa', [EmpresaController::class, 'store'])->name('empresa.store');
        Route::get('empresa/{id}/edit', [EmpresaController::class, 'edit'])->name('empresa.edit');
        Route::put('empresa/{id}', [EmpresaController::class, 'update'])->name('empresa.update');
        Route::delete('empresa/{id}', [EmpresaController::class, 'destroy'])->name('empresa.destroy');
        Route::get('/empresa/postulaciones', [EmpresaController::class, 'postulaciones'])->name('empresa.postulaciones');

    });


require __DIR__ . '/auth.php';

