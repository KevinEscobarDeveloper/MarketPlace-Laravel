<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login.login');
});

Route::get('login', function() {
    return view('login.login');
    //buscara el archivo 'login' donde también se relizará la autenticación dentro de resoureces/views
});

Route::get('categoria', function() {
    return view('categorias.categoria');
    //buscara el archivo 'login' donde también se relizará la autenticación dentro de resoureces/views
});


Route::get('tablero', function() {
    return view('supervisor.tablero');
    //buscara el archivo 'tablero' dentro de resoureces/views
});

Route::post('/validar',[AutenticarController::class, 'validar']);

