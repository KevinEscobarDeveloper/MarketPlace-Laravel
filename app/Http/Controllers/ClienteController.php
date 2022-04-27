<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\File;
use App\Models\Usuario;

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
    $fecha = date('y/m/d');
    $crear=DB::insert('insert into usuarios(nombre,apellido_paterno,apellido_materno,correo,imagen,rol,activo,password,fecha)
     values(?,?,?,?,?,?,?,?,?)',[$valores['nombre'],$valores['apaterno'],$valores['amaterno'],
     $valores['correo'],$valores['imagen'],'Cliente',1,$valores['password'],$fecha]);
     $id = DB::table('usuarios')->latest('id')->first()->id;
     
     $usuario = Usuario::select('nombre','apellido_paterno','apellido_materno','correo','id')
     ->where('id',$id)->get();
     \Session::put('usuario',$usuario);
     $categorias = DB::table('categorias')->get();
     return view("clientes.principal")->with('categorias',$categorias);
    }

    public function principalcliente(){
        $categorias = DB::table('categorias')->get();
        return view("clientes.principal")->with('categorias',$categorias);
    }
    public function listarcategorias($id){
        $cproductos = DB::table('productos')
        -> join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
        -> where ('categoria_productos.categoria_id',$id)
        ->get();
        return view("clientes.principal")->with('cproductos',$cproductos);
    }


    public function preguntar($id){
        $productos = DB::table('productos')->get();
        $id = $id;
        $usuarios = DB::table('usuarios')
        -> join('productos','usuarios.id', '=', 'productos.usuarios_id')
        ->select('usuarios.nombre as usernombre','productos.nombre',
        'usuarios.apellido_paterno','usuarios.apellido_materno',
        'productos.precio','productos.imagen','productos.consecionado')
        -> where ('usuarios.id','=',$id)
        ->get();
        return view("clientes.pregunta",compact('id','productos','usuarios'));
    }

    public function realizarpregunta(Request $request,$id){
        $id = $id;
        $valores=$request->all();
        $usuario = \Session::get('usuario');
      foreach($usuario as $user){
        $iduser=$user->id;
      }
       
            $crear=DB::insert('insert into preguntas(pregunta,productos_id,usuarios_id)
            values(?,?,?)',[$valores['pregunta'],$id,$iduser]);

            //----volvemos a redirigir a la pagina pero tenemos que mandar los datos----//
            $usuarios = DB::table('usuarios')
            -> join('productos','usuarios.id', '=', 'productos.usuarios_id')
            ->select('usuarios.nombre as usernombre','productos.nombre',
            'usuarios.apellido_paterno','usuarios.apellido_materno',
            'productos.precio','productos.imagen','productos.consecionado')
            -> where ('usuarios.id','=',$id)
            ->get();

            $productos = DB::table('productos')->get();
            //--------------//

            $mensaje='Pregunta realizada';
            return view("clientes.pregunta",compact('id','mensaje','usuarios','productos'));
    }
}

