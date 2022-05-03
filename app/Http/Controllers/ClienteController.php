<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\File;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Pregunta;
use App\Models\Transaccion;

class ClienteController extends Controller
{
    public function crear(Request $request){
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
        //$productos = DB::table('productos')->get();
        $id = $id;
        $productos = DB::table('usuarios')
        -> join('productos','usuarios.id', '=', 'productos.usuarios_id')
        ->select('usuarios.nombre as usernombre','productos.nombre',
        'usuarios.apellido_paterno','usuarios.apellido_materno',
        'productos.precio','productos.imagen','productos.consecionado')
        -> where ('productos.id','=',$id)
        ->get();
        //dd($productos);
        return view("clientes.pregunta",compact('id','productos'));
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
            $productos = DB::table('usuarios')
            -> join('productos','usuarios.id', '=', 'productos.usuarios_id')
            ->select('usuarios.nombre as usernombre','productos.nombre',
            'usuarios.apellido_paterno','usuarios.apellido_materno',
            'productos.precio','productos.imagen','productos.consecionado')
            -> where ('productos.id','=',$id)
            ->get();

            //$productos = DB::table('productos')->get();
            //--------------//
           
            $mensaje='Pregunta realizada';
            return view("clientes.pregunta",compact('id','mensaje','productos'));
    }

    public function comprar($id){
        $id = $id;
       
            $usuarios = Usuario::select('usuarios.nombre as usernombre','productos.nombre',
            'usuarios.apellido_paterno','usuarios.apellido_materno',
            'productos.precio','productos.imagen','productos.consecionado')
            -> join('productos','usuarios.id', '=', 'productos.usuarios_id')
            -> where ('productos.id','=',$id)
            ->get();

            //var_dump($usuarios);
            $productos = Producto::where('id',$id)->get();

            
            return view("clientes.compra",compact('id','usuarios','productos'));
    }

    public function tipocompra(Request $request,$id){
        $id = $id;
        $valores=$request->all();

        $usuarios = Usuario::select('usuarios.nombre as usernombre','productos.nombre',
            'usuarios.apellido_paterno','usuarios.apellido_materno',
            'productos.precio','productos.imagen','productos.consecionado')
            -> join('productos','usuarios.id', '=', 'productos.usuarios_id')
            -> where ('productos.id','=',$id)
            ->get();

            //var_dump($usuarios);
            $productos = Producto::where('id',$id)->get();

        if ($valores['tipocompra']=='Compra en linea'){
            $usuario = \Session::get('usuario');
            foreach($usuario as $user){
            $iduser = $user->id;
            }
            $correo = Usuario::where('id',$iduser)->value('correo');
            $venta = new Venta;
            $venta->correo = $correo;
            $venta->monto = $valores['precio'];
            $venta->tipo = 'Transacción';
            $venta->productos_id = $id;
            $venta->save();
            //----------------------------------------//
            $transaccion = new Transaccion;
            $transaccion->ventas_id= $venta->id;
            $transaccion->usuarios_id= $iduser;
            $transaccion->save();

            //-----------//
            $producto = Producto::find($id);
            $producto->decrement('existencia',1);

            return view("clientes.tipocompra",compact('id','usuarios','productos','valores'));
            
        }
        if ($valores['tipocompra']=='Por banco'){
            if(!empty($valores['comprobante'])){
                $file = $request->file('comprobante'); 
                $originalname = $file->getClientOriginalName();
                $file->storeAs('public/cliente',$originalname);
                $valores['comprobante'] = '/storage/evidencias/'.$originalname;
                $mensaje='Compra exitosa';
                
                $usuario = \Session::get('usuario');
                foreach($usuario as $user){
                $iduser = $user->id;
                }

                $correo = Usuario::where('id',$iduser)->value('correo');
                $venta = new Venta;
                $venta->correo = $correo;
                $venta->monto = $valores['precio'];
                $venta->tipo = 'Deposito';
                $venta->productos_id = $id;
                $venta->evidencia = $valores['comprobante'];
                $venta->save();
                //-------------------------------------//
                $transaccion = new Transaccion;
                $transaccion->ventas_id= $venta->id;
                $transaccion->usuarios_id= $iduser;
                $transaccion->save();
                 //-----------//
                $producto = Producto::find($id);
                $producto->decrement('existencia',1);
                return view("clientes.tipocompra",compact('id','usuarios','productos','valores','mensaje'));
                }
            
            
            if(empty($valores['comprobante'])){
                $mensaje='Agregue el comprobante';
                return view("clientes.tipocompra",compact('id','usuarios','productos','mensaje','valores'));
            }  
        }        
    }
    public function mispreguntas(){
            $usuario = \Session::get('usuario');
            foreach($usuario as $user){
            $iduser = $user->id;
            }
            $preguntas = Pregunta::select('preguntas.id as idp','productos.nombre as pnombre','preguntas.respuesta',
            'usuarios.nombre','usuarios.apellido_paterno','usuarios.apellido_materno',
            'productos.precio','productos.imagen')
            -> join('productos','preguntas.productos_id', '=', 'productos.id')
            -> join('usuarios','preguntas.usuarios_id', '=', 'usuarios.id')
            -> where ('productos.usuarios_id','=',$iduser)
            ->get();
  
            return view("clientes.verpreguntas",compact('preguntas'));
    }

    public function verpregunta($id){
        $id=$id;

        $usuario = \Session::get('usuario');
        foreach($usuario as $user){
        $iduser = $user->id;
        }
        $preguntas = Pregunta::select('preguntas.id as idp','preguntas.pregunta','preguntas.respuesta','productos.nombre as pnombre',
        'usuarios.nombre','usuarios.apellido_paterno','usuarios.apellido_materno',
        'productos.precio','productos.imagen')
        -> join('productos','preguntas.productos_id', '=', 'productos.id')
        -> join('usuarios','preguntas.usuarios_id', '=', 'usuarios.id')
        -> where ('preguntas.id','=',$id)
        ->get();

        ($preguntas);
        return view("clientes.responder",compact('preguntas','id'));
    }

    public function respuesta(Request $request,$id){
        $id=$id;
        $valores=$request->all();
        $pregunta = Pregunta::find($id);
        $pregunta->respuesta = $valores['respuesta'];

        $pregunta->save();

        $preguntas = Pregunta::select('preguntas.id as idp','preguntas.pregunta','preguntas.respuesta','productos.nombre as pnombre',
        'usuarios.nombre','usuarios.apellido_paterno','usuarios.apellido_materno',
        'productos.precio','productos.imagen')
        -> join('productos','preguntas.productos_id', '=', 'productos.id')
        -> join('usuarios','preguntas.usuarios_id', '=', 'usuarios.id')
        -> where ('preguntas.id','=',$id)
        ->get();

        $mensaje='respuesta enviada';

        return view("clientes.responder",compact('preguntas','id','mensaje'));
    }

    public function misproductos(){

        $usuario = \Session::get('usuario');
        foreach($usuario as $user){
        $iduser = $user->id;
        }

        $productos = Producto::select('productos.nombre','productos.id as proid','productos.consignar','productos.existencia'
        ,'productos.pendientes','productos.precio','productos.motivo')
        -> join('usuarios','productos.usuarios_id', '=', 'usuarios.id')
        -> where ('productos.usuarios_id','=',$iduser)
        ->get();

        $mensaje='respuesta enviada';

        return view("clientes.misproductos",compact('productos'));
    }

    public function propuesta(Request $request){
        $valores=$request->all();
        $fecha = date('y/m/d');
        $urlimagenes = [];

        //dd($valores);
        $usuario = \Session::get('usuario');
        foreach($usuario as $user){
        $iduser = $user->id;
        }
        if($request->hasFile('imagen')==false){
            $mensaje='Tiene que añadir imagenes';
            return view("clientes.venderp",compact('mensaje'));
        }

        if($request->hasFile('imagen')){
            $imagenes = $request->file('imagen');
            foreach($imagenes as $imagen){
                $nombre = time().'_'.$imagen->getClientOriginalName();
                $ruta = $file->storeAs('public/productos');
                $imagen->move($ruta,$nombre);
                $urlimagenes[]['url'] = $nombre;

                // $originalname = $file->getClientOriginalName();
                // $file->storeAs('public/cliente',$originalname);
                // $valores['comprobante'] = '/storage/evidencias/'.$originalname;
            }
            
            return $urlimagenes;
        // $producto = new Producto;
        // $producto->nombre=$valores->nombre;
        // $producto->descripción=$valores->descripcion;
        // $producto->precio=$valores->precio;
        // $producto->existencia=$valores->existencia;
        // $producto->usuarios_id=$iduser;
        // $producto->fecha=$fecha;
        // $producto->save();
        }

        $mensaje='respuesta enviada';
        //return view("clientes.misproductos",compact('productos'));
    }

    public function actualizarp($id){
        $id = $id;
        $usuario = \Session::get('usuario');
        foreach($usuario as $user){
        $iduser = $user->id;
        }

        $productos = Producto::where('id', $id)->get(['nombre','precio','descripción']);
        return view("clientes.actualizarp",compact('productos','id'));
    }

    public function updateproducto(Request $request,$id){
        $id = $id;
        $valores=$request->all();
        Producto::where('id',$id)->update(['descripción'=>$valores['descripcion'],
        'precio'=>$valores['precio']]);

        $productos = Producto::where('id', $id)->get(['nombre','precio','descripción']);
        $mensaje='Actualización exitosa';
        return view("clientes.actualizarp",compact('productos','id','mensaje'));
    }

    public function miscompras(){
        $usuario = \Session::get('usuario');
        foreach($usuario as $user){
        $iduser = $user->id;
        }
        //-----------------//
        $productos = Producto::select('productos.nombre','productos.precio','productos.descripción')
        -> join('ventas','productos.id', '=', 'ventas.productos_id')
        -> join('transacciones','ventas.id', '=', 'transacciones.ventas_id')
        -> where ('transacciones.usuarios_id','=',$iduser)
        ->get();

        //dd($productos);
        return view("clientes.miscompras",compact('productos'));
    }

    public function misventas(){
        $usuario = \Session::get('usuario');
        foreach($usuario as $user){
        $iduser = $user->id;
        }
        //-----------------//
        $productos = Producto::select('productos.nombre','productos.precio','productos.descripción')
        -> join('ventas','productos.id', '=', 'ventas.productos_id')
        -> join('transacciones','ventas.id', '=', 'transacciones.ventas_id')
        -> where ('productos.usuarios_id','=',$iduser)
        ->get();

        //dd($productos);
        return view("clientes.miscompras",compact('productos'));
    }
}

