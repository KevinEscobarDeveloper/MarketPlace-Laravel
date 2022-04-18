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
    $file = $request->file('imagen'); 
    $originalname = $file->getClientOriginalName();
    $file->storeAs('public/cliente',$originalname);
   
    $valores['imagen'] = '/storage/cliente/'.$originalname;
    $crear=DB::insert('insert into usuarios(nombre,apellido_paterno,apellido_materno,correo,imagen,rol,activo,password)
     values(?,?,?,?,?,?,?,?)',[$valores['nombre'],$valores['apaterno'],$valores['amaterno'],
     $valores['correo'],$valores['imagen'],'Cliente',1,$valores['password']]);
     return  redirect('/principal-categoria');
    }
}
