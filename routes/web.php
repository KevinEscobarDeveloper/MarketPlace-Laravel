<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticarController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;


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

Route::get('principal-categoria', function() {
    return view('categorias.categoria');
});


Route::get('tablero', function() {
    return view('supervisor.tablero');
    //buscara el archivo 'tablero' dentro de resoureces/views
});

Route::get('principal-cliente', function() {
    return view('clientes.principal');
    //buscara el archivo 'tablero' dentro de resoureces/views
});
//ventana de cliente
Route::get('registrar-cliente', function() {
    return view('clientes.registrar');
    //buscara el archivo 'tablero' dentro de resoureces/views
});

Route::get('principal-encargado', function() {
    return view('clientes.registrar');
    //buscara el archivo 'tablero' dentro de resoureces/views
});

//supervisor
Route::get('crear-categoria', function() {
    return view('supervisor.crearcat');
    //buscara el archivo 'tablero' dentro de resoureces/views
});

Route::get('crear-usuario', function() {
    return view('supervisor.crearuser');
    //buscara el archivo 'tablero' dentro de resoureces/views
});



//valida que rol es el usuario 
Route::post('/validar',[AutenticarController::class, 'validar']);

//Listar categorias
Route::get('principal-categoria',[CategoriaController::class, 'listarcategorias']);
//Listar productos por categorias 
Route::get('Herramientas',[CategoriaController::class, 'listarherramientas']);
Route::get('Ropa',[CategoriaController::class, 'listarropa']);
Route::get('Alimentos',[CategoriaController::class, 'listaralimentos']);
Route::get('Muebles',[CategoriaController::class, 'listarmuebles']);
Route::get('productos',[CategoriaController::class, 'listarmuebles']);

//Listar todos los productos segun el rol
Route::get('all-productos',[ProductoController::class, 'listarproductos']);
Route::get('productos-cliente',[ProductoController::class, 'productoscliente']);
Route::get('principal-encargado',[ProductoController::class, 'productosencargado']);
Route::get('productos-supervisor',[ProductoController::class, 'productossupervisor']);

//crear usuario de tipo cliente (registro de anonimo)
Route::post('crearcliente',[ClienteController::class,'crear'])->middleware('arreglo');

//Cliente l
Route::get('principal-cliente',[ClienteController::class, 'principalcliente']);
//Listar productos por categorias para los clientes
Route::get('clienteHerramientas',[ClienteController::class, 'listarherramientas']);
Route::get('clienteRopa',[ClienteController::class, 'listarropa']);
Route::get('clienteAlimentos',[ClienteController::class, 'listaralimentos']);
Route::get('clienteMuebles',[ClienteController::class, 'listarmuebles']);
Route::get('pregunta/{id}',[ClienteController::class, 'preguntar']);
Route::post('realizarpregunta/{id}',[ClienteController::class, 'realizarpregunta']);



//Encargado
Route::get('usuarios',[UsuarioController::class, 'listarusuarios']);
Route::get('editar/{id}',[UsuarioController::class, 'editarpasword']);
Route::put('editarpassword/{id}',[UsuarioController::class, 'actualizarcontraseña']);
Route::get('consignar/{id}',[UsuarioController::class, 'editarconsignar']);
Route::post('rconsignar/{id}',[UsuarioController::class, 'rconsignar']);
Route::put('updateconsignar/{id}',[UsuarioController::class, 'actualizarconsignar']);

//Supervisor
Route::get('principal-supervisor',[UsuarioController::class, 'principalsupervisor']);
Route::get('editarcategoria/{id}',[UsuarioController::class, 'editarcategoria']);
Route::put('updatecategoria/{id}',[UsuarioController::class, 'updatecategoria']);
Route::delete('borrarcategoria/{id}',[UsuarioController::class, 'borrarcategoria']);
Route::post('añadircategoria',[UsuarioController::class, 'añadircategoria']);
Route::post('crearclientesupervisor',[UsuarioController::class, 'crearcliente']);
Route::get('verusuario',[UsuarioController::class, 'verusuarios']);
Route::get('editar-usuario/{id}',[UsuarioController::class, 'editarusuario']);
Route::put('updateusuario/{id}',[UsuarioController::class, 'updateusuario']);
Route::get('editar-password/{id}',[UsuarioController::class, 'editarpasswordsup']);
Route::put('editarpasswordsup/{id}',[UsuarioController::class, 'actualizarcontraseñasup']);

