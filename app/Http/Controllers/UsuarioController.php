<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Venta;


class UsuarioController extends Controller
{

    //--------ENCARGADO-----//
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
    return redirect("/usuarios")->with($id);
    }

    public function editarpasword($id){
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

    public function desconsignarproducto($id){
        $productos = DB::table('productos')
        ->where('productos.id', '=', $id)
        ->get();
       
        return view("encargado.desconsignar",compact('id','productos'));
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

  public function actualizardesconsignar(Request $request,$id){
    $valores=$request->all();
    
    $productos = DB::table('productos')
    ->where('productos.id', '=', $id)
    ->get();

    DB::table('productos')->where('id', $id)->update(['consecionado'=>0,'consignar'=>0]);
    $mensaje='Producto desconsignado';
    return view("encargado.desconsignar",compact('id','valores','productos','mensaje'));
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
        
        return view("supervisor.principal")->with('categorias',$categorias);
    }

    public function añadircategoria(Request $request){
        $valores=$request->all();
        $activo=0;

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

        $crear=DB::insert('insert into categorias(nombre,descripción,imagen,activa)
        values(?,?,?,?)',[$valores['nombre'],$valores['descripcion'],$valores['imagen'],
        $activo]);
    
        
        $mensaje='Se añadio correctamente';
        return view("supervisor.crearcat",compact('mensaje'));
    }

    public function crearusuariosup(Request $request){  
        //se guarda lo que viene en el formulario
        $valores=$request->all();
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
     $valores['correo'],$valores['imagen'],$valores['rol'],1,$valores['password'],$fecha]);
     \Session::put('usuario',$valores);
     $categorias = DB::table('categorias')->get();
     $mensaje='Se añadio correctamente';
     return view("supervisor.crearuser",compact('mensaje'));
    }

    public function verusuarios(Request $request){

        $usuarios = DB::table('usuarios')->get();

        return view("supervisor.usuarios")->with('usuarios',$usuarios);
    }

    public function editarusuario(Request $request, $id){
        $usuarios = DB::table('usuarios')
        ->where('usuarios.id', '=', $id)
        ->get();
        $id = $id;
        //var_dump($categorias);
        return view("supervisor.edituser",compact('id','usuarios'));
    }

    public function updateusuario(Request $request, $id){
        $activo=0;
        $valores=$request->all();
        $usuarios = DB::table('usuarios')
        ->where('usuarios.id', '=', $id)
        ->get();
        //$id = $id;
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
    
        DB::table('usuarios')->where('id', $id)->update(['nombre'=>$valores['nombre'],
        'apellido_paterno'=>$valores['apellido_paterno'],'apellido_materno'=>$valores['apellido_materno'],
        'correo'=>$valores['correo'],'imagen'=>$valores['imagen'],'rol'=>$valores['rol'],'activo'=>$activo]);
        
        $mensaje='Actualización exitosa';
        return view("supervisor.edituser",compact('id','usuarios','mensaje'));
    }

    public function editarpasswordsup(Request $request, $id){
        $id = $id;
         return view("supervisor.editcontraseña",compact('id'));
    }

    public function actualizarcontraseñasup(Request $request,$id){
        $id = $id;
        $valores=$request->all();
        DB::table('usuarios')->where('id', $id)->update(['password' =>$valores['contraseña1']]);  
        $mensaje='Actualización exitosa';
        return view("supervisor.editcontraseña",compact('id','mensaje'));;
        }

    public function tablerodatos(){
        $count=DB::table('usuarios')->count();
        $countcat=DB::table('categorias')->count();
       
        return view("supervisor.tablero",compact('count','countcat'));;
        }

    public function verkardex($id){
        $consecionado=0;
        $preguntas = DB::table('preguntas')
        -> join('productos','preguntas.productos_id', '=', 'productos.id')
        ->where('productos.id','=',$id)
        ->count();

     
        $productos = DB::table('productos')->where('productos.id','=',$id)
        ->get();

        foreach($productos as $producto){
        $precio =$producto->precio;
      
                $consecionado =$producto->consecionado;       
        }
        if(empty($consecionado)){
            $consecionado=0;
        }
        if(!empty($consecionado)){
            $consecionado=$consecionado/100;
        }
        $ganancia =$precio-($precio*$consecionado);
        return view("supervisor.kardex",compact('preguntas','productos','ganancia'));
        }

        public function vendedor(){
            
        $usuarios = DB::table('usuarios')
        -> join('productos','usuarios.id', '=', 'productos.usuarios_id')
        ->select('usuarios.nombre','usuarios.apellido_paterno','usuarios.apellido_materno',
        'usuarios.fecha','usuarios.id','usuarios.imagen')
        ->groupBy('usuarios.id')
        ->get();

        return view("supervisor.vendedores",compact('usuarios'));
        }

    public function historialvendedor($id){
        
        $usuarios = DB::table('usuarios')
        -> join('productos','usuarios.id', '=', 'productos.id')
        ->select('usuarios.nombre','usuarios.apellido_paterno','usuarios.apellido_materno',
        'usuarios.fecha','usuarios.id','usuarios.imagen')
        ->where('usuarios.id','=',$id)
        ->get();

        $productos = DB::table('productos')
        -> join('usuarios','productos.usuarios_id', '=', 'usuarios.id')
        ->where('productos.usuarios_id','=',$id)
        ->count();

        $consignados = DB::table('productos')
        -> join('usuarios','productos.usuarios_id', '=', 'usuarios.id')
        ->where([['productos.usuarios_id','=',$id],['productos.consignar','=',1],
        ['usuarios.id','=',$id]])
        ->count();

    return view("supervisor.historial",compact('usuarios','productos','consignados'));
    }
    //----------CONTADOR------------//
    public function principalcontador(){           
        $ventas = Venta::select(['ventas.id','ventas.correo','ventas.monto',
            'ventas.status', 'ventas.evidencia','ventas.tipo'])
        ->get();

        return view("contador.principal",compact('ventas'));
    }

    public function validarcompra(Request $request,$id){
        $valores=$request->all();
        Venta::where('id',$id)->update(['status'=>$valores['validacion']]);
        
        $ventas = Venta::select(['ventas.id','ventas.correo','ventas.monto',
            'ventas.status', 'ventas.evidencia','ventas.tipo'])
        ->get();
        
       
        return view("contador.principal",compact('ventas'));
    }


}