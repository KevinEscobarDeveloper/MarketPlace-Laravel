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
    
});

Route::get('principal-categoria', function() {
    return view('categorias.categoria');
});


Route::get('tablero', function() {
    return view('supervisor.tablero');
    
});

Route::get('principal-cliente', function() {
    return view('clientes.principal');
    
});
//ventana de cliente
Route::get('registrar-cliente', function() {
    return view('clientes.registrar');
    
});

Route::get('principal-encargado', function() {
    return view('clientes.registrar');
 
});

//supervisor
Route::get('crear-categoria', function() {
    return view('supervisor.crearcat');
 
});

Route::get('crear-usuario', function() {
    return view('supervisor.crearuser');
    
});

Route::get('principal-sup', function() {
    return view('supervisor.principal');
   
});





//valida que rol es el usuario 
Route::post('/validar',[AutenticarController::class, 'validar']);

//Listar categorias
Route::get('principal-categoria',[CategoriaController::class, 'listarcategorias']);
//Listar productos por categorias 
Route::get('Pcategoria/{id}',[CategoriaController::class, 'listarproductoscat']);


//Listar todos los productos segun el rol
Route::get('all-productos',[ProductoController::class, 'listarproductos']);
Route::get('productos-cliente',[ProductoController::class, 'productoscliente']);
Route::get('principal-encargado',[ProductoController::class, 'productosencargado']);
Route::get('productos-supervisor',[ProductoController::class, 'productossupervisor']);
Route::get('productosdes',[ProductoController::class, 'productosdesconsignar']);

//crear usuario de tipo cliente (registro de anonimo)
Route::post('crearcliente',[ClienteController::class,'crear'])->middleware('arreglo');

//Cliente 
Route::get('principal-cliente',[ClienteController::class, 'principalcliente']);
//Listar productos por categorias para los clientes
Route::get('categoria/{id}',[ClienteController::class, 'listarcategorias']);
Route::get('pregunta/{id}',[ClienteController::class, 'preguntar']);
Route::post('realizarpregunta/{id}',[ClienteController::class, 'realizarpregunta']);
Route::get('comprar/{id}',[ClienteController::class, 'comprar']);
Route::post('tipocompra/{id}',[ClienteController::class, 'tipocompra']);
Route::put('calificar-transaccion/{id}',[ClienteController::class, 'calificacion']);
//VENDEDOR
Route::get('mispreguntas',[ClienteController::class, 'mispreguntas']);
Route::get('verpregunta/{id}',[ClienteController::class, 'verpregunta']);
Route::put('respuesta/{id}',[ClienteController::class, 'respuesta']);
Route::get('misproductos',[ClienteController::class, 'misproductos'])->name('misproductos.misproductos');
Route::get('actualizarp/{id}',[ClienteController::class, 'actualizarp']);
Route::put('updateproducto/{id}',[ClienteController::class, 'updateproducto']);
Route::get('miscompras',[ClienteController::class, 'miscompras'])->name('miscompras.ver');
Route::get('misventas',[ClienteController::class, 'misventas']);
Route::get('proponer-producto',[ClienteController::class, 'mostrarpropuesta']);
Route::post('propuesta',[ClienteController::class, 'propuesta']);
Route::get('editar-fotos/{id}',[ClienteController::class, 'editarfotos'])->name('editar-fotos.editarfotos');
Route::get('formimagen/{id}',[ClienteController::class, 'formularioimagen']);
Route::post('addimagen/{id}',[ClienteController::class, 'añadirimagen']);
Route::get('cambiarimagen/{id}',[ClienteController::class, 'cambiarimagen']);
Route::delete('editar-fotos/deleteimagen/{id}',[ClienteController::class, 'deleteimagen']);
Route::delete('borrar-producto/{id}',[ClienteController::class, 'deleteproducto']);


//Encargado
Route::get('usuarios',[UsuarioController::class, 'listarusuarios']);
Route::get('editar/{id}',[UsuarioController::class, 'editarpasword']);
Route::put('editarpassword/{id}',[UsuarioController::class, 'actualizarcontraseña']);
Route::get('consignar/{id}',[UsuarioController::class, 'editarconsignar']);
Route::post('rconsignar/{id}',[UsuarioController::class, 'rconsignar']);
Route::put('updateconsignar/{id}',[UsuarioController::class, 'actualizarconsignar']);
Route::get('desconsignar/{id}',[UsuarioController::class, 'desconsignarproducto']);
Route::put('updatedesconsignar/{id}',[UsuarioController::class, 'actualizardesconsignar']);


//Supervisor
Route::get('principal-supervisor',[UsuarioController::class, 'principalsupervisor'])->name('principal-supervisor.principal');
Route::get('editarcategoria/{id}',[UsuarioController::class, 'editarcategoria']);
Route::put('updatecategoria/{id}',[UsuarioController::class, 'updatecategoria']);
Route::delete('borrarcategoria/{id}',[UsuarioController::class, 'borrarcategoria']);
Route::post('añadircategoria',[UsuarioController::class, 'añadircategoria']);
Route::post('crearclientesupervisor',[UsuarioController::class, 'crearusuariosup']);
Route::get('verusuario',[UsuarioController::class, 'verusuarios']);
Route::get('editar-usuario/{id}',[UsuarioController::class, 'editarusuario']);
Route::put('updateusuario/{id}',[UsuarioController::class, 'updateusuario']);
Route::get('editar-password/{id}',[UsuarioController::class, 'editarpasswordsup']);
Route::put('editarpasswordsup/{id}',[UsuarioController::class, 'actualizarcontraseñasup']);
Route::get('Tablero',[UsuarioController::class, 'tablerodatos']);
Route::get('kardex/{id}',[UsuarioController::class, 'verkardex']);
Route::get('Vendedores',[UsuarioController::class, 'vendedor']);


//Contador 
Route::get('principal-contador',[UsuarioController::class, 'principalcontador'])->name('principal-contador.principal');
Route::put('validar-compra/{id}',[UsuarioController::class, 'validarcompra']);
Route::get('vista-pago',[UsuarioController::class, 'vistapago']);
Route::get('crear-pago/{id}',[UsuarioController::class, 'crearpago'])->name('crear-pago.generar');
Route::post('generar-pago/{id}',[UsuarioController::class, 'generarpago']);
Route::get('listar-pago',[UsuarioController::class, 'listarpagos'])->name('listar-pago.listar');
Route::get('editar-pago/{id}',[UsuarioController::class, 'editarpagos']);
Route::put('update-pago/{id}',[UsuarioController::class, 'updatepago']);
Route::put('entregar-pago/{id}',[UsuarioController::class, 'entregarpago']);
