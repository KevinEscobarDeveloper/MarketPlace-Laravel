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
  }

  //--------SUPERVISOR------//
    public function principalsupervisor(){
        $categorias = DB::table('categorias')->get();
        return view("supervisor.principal")->with('categorias',$categorias);
    }

    public function editarcategoria(Request $request, $id){
        $categorias = DB::table('categorias')
        ->where('categorias.id', '=', $id)
        ->get();
        $id = $id;
        //var_dump($categorias);
        return view("supervisor.editarcat",compact('id','categorias'));
    }

    public function updatecategoria(Request $request, $id){
        $activo=0;
        $valores=$request->all();
        $categorias = DB::table('categorias')
        ->where('categorias.id', '=', $id)
        ->get();
        $id = $id;
        //var_dump($valores);

        if(!empty($valores['activa'])){
            $activo=1;
        }
        if(!empty($valores['imagen'])){
            $file = $request->file('imagen'); 
            $originalname = $file->getClientOriginalName();
            $file->storeAs('public/cliente',$originalname);
            $valores['imagen'] = '/storage/cliente/'.$originalname;
        }
        if(empty($valores['imagen'])){
            $valores['imagen']=null;
        }
    
        DB::table('categorias')->where('id', $id)->update(['nombre'=>$valores['nombre'],
        'descripción'=>$valores['descripcion'],'imagen'=>$valores['imagen'],'activa'=>$activo]);
        
        $mensaje='Actualización exitosa';
        return view("supervisor.editarcat",compact('id','categorias','mensaje'));
    }

    public function borrarcategoria(Request $request, $id){
        DB::table('categorias')->where('id', $id)->delete();
        $categorias = DB::table('categorias')->get();
        
        var_dump($id);
        return view("supervisor.principal")->with('categorias',$categorias);
    }

}