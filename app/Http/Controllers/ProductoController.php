<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Imagen;


class ProductoController extends Controller
{
    public function listarproductos(){
        $productos = DB::table('productos')
        ->where([['productos.consignar','=',1]])
        ->get();

        $imagenes = Imagen::select('*')->get();
        return view("categorias.productos",compact('productos','imagenes'));
  
    }
    
    public function productoscliente(){
        $productos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> join('categorias','categoria_productos.categoria_id', '=', 'categorias.id')
        ->select('categorias.nombre as catnombre','productos.id','productos.nombre','productos.descripción',
        'productos.precio','productos.consignar','productos.motivo',
        'productos.existencia','productos.pendientes')
        ->get();

        $imagenes = Imagen::select('*')->get();
        return view("clientes.principal",compact('productos','imagenes'));
    }

    public function productosencargado(){
        $productos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> join('categorias','categoria_productos.categoria_id', '=', 'categorias.id')
        ->select('categorias.nombre as catnombre','productos.id','productos.nombre','productos.descripción',
        'productos.precio','productos.consecionado','productos.consignar',
        'productos.motivo','productos.existencia','productos.pendientes')
        ->get();

        $imagenes = Imagen::select('*')->get();
        return view("encargado.principal",compact('productos','imagenes'));
    }

    public function productosdesconsignar(){
        $productos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> join('categorias','categoria_productos.categoria_id', '=', 'categorias.id')
        ->select('categorias.nombre as catnombre','productos.id','productos.nombre','productos.descripción',
        'productos.precio','productos.consecionado','productos.consignar',
        'productos.motivo','productos.existencia','productos.pendientes')
        ->get();

        $imagenes = Imagen::select('*')->get();
        return view("encargado.productos",compact('productos','imagenes'));
    }
    public function productossupervisor(){
        $productos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> join('categorias','categoria_productos.categoria_id', '=', 'categorias.id')
        ->select('categorias.nombre as catnombre','productos.id','productos.nombre','productos.descripción',
        'productos.precio','productos.consecionado','productos.consignar',
        'productos.motivo','productos.existencia','productos.pendientes')
        ->get();
        $imagenes = Imagen::select('*')->get();
        return view("supervisor.productos",compact('productos','imagenes'));
    }
}
