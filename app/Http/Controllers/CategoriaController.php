<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoriaController extends Controller
{
    
    public function listarcategorias(){
        $categorias = DB::table('categorias')->get();
        return view("categorias.categoria")->with('categorias',$categorias);
    }
    public function listarherramientas(){
        $productos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> where ('categoria_productos.categoria_id',1)
        ->get();
        return view("categorias.productos")->with('productos',$productos);
    }
    public function listarropa(){
        $productos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> where ('categoria_productos.categoria_id',2)
        ->get();
        return view("categorias.productos")->with('productos',$productos);
    }
    public function listaralimentos(){
        $productos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> where ('categoria_productos.categoria_id',3)
        ->get();
        return view("categorias.productos")->with('productos',$productos);
    }
    public function listarmuebles(){
        $productos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> where ('categoria_productos.categoria_id',4)
        ->get();
        return view("categorias.productos")->with('productos',$productos);
    }
}
