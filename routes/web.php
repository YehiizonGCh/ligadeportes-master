<?php

use App\Http\Controllers\EntrenadorController;
use App\Http\Controllers\LigaController;
use App\Http\Controllers\PartidoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TorneoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EstadisticaPartidoController;
use App\Http\Controllers\JugadorEncuentroController;
use App\Http\Controllers\JugadorCambioController;
use App\Http\Controllers\EstadioController;
use App\Http\Controllers\NotificacionController;
use App\Notifications\jugadorinscrito;
use Illuminate\Support\Facades\Notification;
use App\Models\User;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('dash.index');
// })->name('dash');

Route::get('/', function () {
    // $user = User::find(1);
    // $user->notify(new jugadorinscrito());
    // Notification::route('mail', 'taylor@example.com')->notify(new jugadorinscrito());
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dash', function () {
        return view('dash.index');
    })->name('dash');
});

//rutas de inscripciones
Route::group(['middleware' => ['auth']], function() {
    Route::resource('jugadores', JugadorController::class);
    Route::resource('clubs', ClubController::class);
    Route::resource('categorias', CategoryController::class);
    Route::resource('equipos', EquipoController::class);

    
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('arbitros', App\Http\Controllers\ArbitroController::class);
    Route::resource('estadios', App\Http\Controllers\EstadioController::class);

});
//rutas de gestion partidos
Route::group(['middleware'=>['auth']],function(){
    Route::resource('partidos', PartidoController::class);
    Route::resource('resultados', EstadisticaPartidoController::class);
    Route::resource('encuentros', JugadorEncuentroController::class);
    Route::resource('cambios', JugadorCambioController::class);


});
//rutas de eventos
Route::group(['middleware'=>['auth']],function(){
    Route::resource('torneos', TorneoController::class);
    Route::resource('entrenadores', EntrenadorController::class);
    Route::resource('ligas', LigaController::class);
    // imprimir hola
    
});

// rutas para modulo de membresia (roles y permisos)
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', App\Http\Controllers\RolController::class);
    Route::resource('usuarios', App\Http\Controllers\UsuarioController::class);
});
// ruta para cargar todas las categorias asociadas al club seleccionado
Route::get('/obtener-categorias-por-club/{club}', [EquipoController::class, 'obtenerCategorias'])->name('obtener.categorias');
Route::get('/obtener-torneo-por-categoria/{categoria}', [EquipoController::class, 'obtenerTorneo'])->name('obtener.torneo');
Route::get('/obtener-equipos-por-categoria/{categoryId}', [PartidoController::class, 'obtenerEquipos'])->name('obtener.equipos');



// routes/web.php o routes/api.php

Route::get('/api/partidos-por-jugador/{jugadorId}', [JugadorEncuentroController::class, 'partidosPorJugador'])->name('partidos.por.jugador');
Route::get('/check-player-registration', [JugadorEncuentroController::class, 'verificarRegistro'])->name('verificar.registro');


Route::get('/api/jugadores-por-partido/{partidoId}/{equipo}', [JugadorEncuentroController::class, 'obtenerJugadoresPorPartidoYEquipo'])->name('jugadores.por.partido');
Route::get('/api/jugadores-por-partido/{partidoId}/{equipo}', [JugadorCambioController::class, 'obtenerJugadoresPorPartido'])->name('jugadores.por.partido');


// reportes pdf
Route::get('/generar-pdf-jugadorcambios', [JugadorCambioController::class, 'generarInformePDF'])->name('generar.pdf.jugadorcambios');
Route::get('/generar-pdf-jugadorencuentros', [JugadorEncuentroController::class, 'generarInformeencuentroPDF'])->name('generar.pdf.jugadorencuentros');
Route::get('/generar-pdf-partidosresultados', [EstadisticaPartidoController::class, 'generarInformePDF'])->name('generar.pdf.partidosresultados');
Route::get('/generar-pdf-partidos', [PartidoController::class, 'generarInformePDF'])->name('generar.pdf.partidos');
Route::get('/generar-pdf-jugadores', [JugadorController::class, 'generarInformePDF'])->name('generar.pdf.jugadores');
Route::get('/generar-pdf-clubes', [ClubController::class, 'generarInformePDF'])->name('generar.pdf.clubes');
Route::get('/generar-pdf-categorias', [CategoryController::class, 'generarInformePDF'])->name('generar.pdf.categorias');
Route::get('/generar-pdf-equipos', [EquipoController::class, 'generarInformePDF'])->name('generar.pdf.equipos');
Route::get('/generar-pdf-entrenadores', [EntrenadorController::class, 'generarInformePDF'])->name('generar.pdf.entrenadores');
Route::get('/generar-pdf-ligas', [LigaController::class, 'generarInformePDF'])->name('generar.pdf.ligas');
Route::get('/generar-pdf-torneos', [TorneoController::class, 'generarInformePDF'])->name('generar.pdf.torneos');
Route::get('/generar-pdf-estadios', [EstadioController::class, 'generarInformePDF'])->name('generar.pdf.estadios');



//rutas para modulo de configuracion de usuario
Route::get('/NewPassword',  [App\Http\Controllers\UserSettingsControllerController::class, 'NewPassword'])->name('NewPassword')->middleware('auth');
Route::post('/change/password',  [App\Http\Controllers\UserSettingsControllerController::class, 'changePassword'])->name('changePassword');


//rutas para cambiar estado de usuarios
Route::post('camestadousu/{id}',[App\Http\Controllers\UsuarioController::class, 'cambiarEstado']);
