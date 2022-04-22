<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\File;

class ClienteController extends Controller
{
    public function crear(Request $request){
        //se guarda lo que viene en el formulario
        $valores=$request->all();
        //$productos = \Session::get('productos');
        //array_push($productos, $valores);
        //\Session::put('productos',$productos);
    if(!empty($valores['imagen'])){
        $file = $request->file('imagen'); 
        $originalname = $file->getClientOriginalName();
        $file->storeAs('public/cliente',$originalname);
        $valores['imagen'] = '/storage/cliente/'.$originalname;
        }
    
    if(empty($valores['imagen'])){
        $valores['imagen']=null;
    }
    $crear=DB::insert('insert into usuarios(nombre,apellido_paterno,apellido_materno,correo,imagen,rol,activo,password)
     values(?,?,?,?,?,?,?,?)',[$valores['nombre'],$valores['apaterno'],$valores['amaterno'],
     $valores['correo'],$valores['imagen'],'Cliente',1,$valores['password']]);
     \Session::put('usuario',$valores);
     $categorias = DB::table('categorias')->get();
     return view("clientes.principal")->with('categorias',$categorias);
    }

    public function principalcliente(){
        $categorias = DB::table('categorias')->get();
        return view("clientes.principal")->with('categorias',$categorias);
    }
    public function listarherramientas(){
        $cproductos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> where ('categoria_productos.categoria_id',1)
        ->get();
        return view("clientes.principal")->with('cproductos',$cproductos);
    }
    public function listarropa(){
        $cproductos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> where ('categoria_productos.categoria_id',2)
        ->get();
        return view("clientes.principal")->with('cproductos',$cproductos);
    }
    public function listaralimentos(){
        $cproductos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> where ('categoria_productos.categoria_id',3)
        ->get();
        return view("clientes.principal")->with('cproductos',$cproductos);
    }
    public function listarmuebles(){
        $cproductos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> where ('categoria_productos.categoria_id',4)
        ->get();
        return view("clientes.principal")->with('cproductos',$cproductos);
    }
}
