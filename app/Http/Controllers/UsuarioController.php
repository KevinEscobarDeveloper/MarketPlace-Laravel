<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UsuarioController extends Controller
{
    public function listarusuarios(){
        $usuarios = DB::table('usuarios')
        -> where ('usuarios.rol','!=','Supervisor')
        ->get();
        return view("encargado.principal")->with('usuarios',$usuarios);
    }
    public function usuariodatos(){
        $usuarios = DB::table('usuarios')
        -> where ('usuarios.rol','!=','Supervisor')
        ->get();
        return view("encargado.principal")->with('usuarios',$usuarios);
    }



    public function actualizarcontraseña(Request $request,$id){
    $valores=$request->all();
    DB::table('usuarios')->where('id', $id)->update(['password' =>$valores['contraseña1']]);  
    return redirect("/usuarios")->with('status','Student Updated Successfully');
    }

    public function editarpasword(Request $request, $id){
        $id = $id;
         return view("encargado.editar",compact('id'));
    }

    public function editarconsignar(Request $request, $id){
        $id = $id;
        $productos = DB::table('productos')
        ->where('productos.id', '=', $id)
        ->get();

        return view("encargado.consignar",compact('id','productos'));
    }
    public function rconsignar(Request $request, $id){
        $valores=$request->all();
        $productos = DB::table('productos')
        ->where('productos.id', '=', $id)
        ->get();
       
        return view("encargado.consignar",compact('id','productos','valores'));
    }

    public function actualizarconsignar(Request $request,$id){
        $valores=$request->all();
        
        $productos = DB::table('productos')
        ->where('productos.id', '=', $id)
        ->get();
       
        if($valores['opciones']=='No'){
            if(empty($valores['motivo'])){
                $mensaje='Debe agregar el motivo';
                return view("encargado.consignar",compact('id','valores','productos','mensaje'));
            }
  
            if(!empty($valores['motivo'])){
                DB::table('productos')->where('id', $id)->update(['motivo' =>$valores['motivo']]);
                $mensaje='Conseción exitosa';
                return view("encargado.consignar",compact('id','valores','productos','mensaje'));
            }
        }
        if($valores['opciones']=='Si'){
                DB::table('productos')->where('id', $id)->update(['consecionado'=>$valores['consecionado'],'consignar'=>1]);
                $mensaje='Conseción exitosa';
                return view("encargado.consignar",compact('id','valores','productos','mensaje'));
    }
         //return redirect("/usuarios")->with('status','Student Updated Successfully');
  }
}