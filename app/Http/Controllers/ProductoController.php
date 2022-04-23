<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductoController extends Controller
{
    public function listarproductos(){
        $productos = DB::table('productos')
        ->get();
        return view("categorias.productos")->with('productos',$productos);
    }
    
    public function productoscliente(){
        $productos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> join('categorias','categoria_productos.categoria_id', '=', 'categorias.id')
        ->select('categorias.nombre as catnombre','productos.id','productos.nombre','productos.descripción',
        'productos.precio','productos.imagen','productos.consecionado','productos.motivo',
        'productos.existencia','productos.pendientes')
        ->get();
        return view("clientes.principal")->with('productos',$productos);
    }

    public function productosencargado(){
        $productos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> join('categorias','categoria_productos.categoria_id', '=', 'categorias.id')
        ->select('categorias.nombre as catnombre','productos.id','productos.nombre','productos.descripción',
        'productos.precio','productos.imagen','productos.consecionado','productos.consignar',
        'productos.motivo','productos.existencia','productos.pendientes')
        ->get();
        return view("encargado.principal")->with('productos',$productos);
    }

    public function productossupervisor(){
        $productos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> join('categorias','categoria_productos.categoria_id', '=', 'categorias.id')
        ->select('categorias.nombre as catnombre','productos.id','productos.nombre','productos.descripción',
        'productos.precio','productos.imagen','productos.consecionado','productos.consignar',
        'productos.motivo','productos.existencia','productos.pendientes')
        ->get();
        return view("supervisor.productos")->with('productos',$productos);
    }
}
