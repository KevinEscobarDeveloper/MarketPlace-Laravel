<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticarController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;


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

Route::get('registrar-cliente', function() {
    return view('clientes.registrar');
    //buscara el archivo 'tablero' dentro de resoureces/views
});



Route::post('/validar',[AutenticarController::class, 'validar']);

//Listar categorias
Route::get('principal-categoria',[CategoriaController::class, 'listarcategorias']);
//Listar productos por categorias 
Route::get('Herramientas',[CategoriaController::class, 'listarherramientas']);
Route::get('Ropa',[CategoriaController::class, 'listarropa']);
Route::get('Alimentos',[CategoriaController::class, 'listaralimentos']);
Route::get('Muebles',[CategoriaController::class, 'listarmuebles']);
Route::get('productos',[CategoriaController::class, 'listarmuebles']);

//Listar todos los productos
Route::get('all-productos',[ProductoController::class, 'listarproductos']);
