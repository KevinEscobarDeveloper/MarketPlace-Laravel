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
use App\Models\Imagen;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;



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
        $imagenes = Imagen::select('*')->get();
        return view("clientes.principal",compact('cproductos','imagenes'));
    }


    public function preguntar($id){
        //$productos = DB::table('productos')->get();
        $id = $id;
        $productos = DB::table('usuarios')
        -> join('productos','usuarios.id', '=', 'productos.usuarios_id')
        ->select('usuarios.nombre as usernombre','productos.nombre',
        'usuarios.apellido_paterno','usuarios.apellido_materno',
        'productos.precio','productos.consecionado')
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
            'productos.precio','productos.consecionado')
            -> where ('productos.id','=',$id)
            ->get();

            //$productos = DB::table('productos')->get();
            //--------------//
           
            $mensaje='Pregunta realizada';
            return redirect()->route('pregunta.principal',$id);
    }

    public function comprar($id){
        $id = $id;
       
            $usuarios = Usuario::select('usuarios.nombre as usernombre','productos.nombre',
            'usuarios.apellido_paterno','usuarios.apellido_materno',
            'productos.precio','productos.consecionado')
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
            'productos.precio','productos.consecionado')
            -> join('productos','usuarios.id', '=', 'productos.usuarios_id')
            -> where ('productos.id','=',$id)
            ->get();

            //var_dump($usuarios);
            $productos = Producto::where('id',$id)->get();

        if ($valores['tipocompra']=='Compra en linea'){
            $usuario = \Session::get('usuario');
            foreach($usuario as $user){
            $iduser = $user->id;
            $nameuser = $user->nombre;
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

            
            $details=[
                'title' => 'Venta en el mercado',
                'body' => 'El cliente '.$nameuser.' se a postulado para su producto '.$producto->nombre
            ];
    
            Mail::to("sop.man.kaem@gmail.com")->send(new TestMail($details));

            return view("clientes.tipocompra",compact('id','usuarios','productos','valores'));
            
        }
        if ($valores['tipocompra']=='Por banco'){
            if(!empty($valores['comprobante'])){
                $file = $request->file('comprobante'); 
                $originalname = $file->getClientOriginalName();
                $file->storeAs('public/evidencias',$originalname);
                $valores['comprobante'] = '/storage/evidencias/'.$originalname;
                $mensaje='Compra exitosa';
                
                $usuario = \Session::get('usuario');
                foreach($usuario as $user){
                $iduser = $user->id;
                $nameuser = $user->nombre;
                
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

                $details=[
                    'title' => 'Venta en el mercado',
                    'body' => 'El cliente'.$nameuser.' se a postulado para su producto'.$producto->nombre
                ];
        
                Mail::to("sop.man.kaem@gmail.com")->send(new TestMail($details));

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
            'productos.precio')
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
        'productos.precio')
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
        'productos.precio')
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

    public function mostrarpropuesta(){

        $categorias = Categoria::select('categorias.nombre')
        ->get();

        $mensaje='respuesta enviada';

        return view("clientes.venderp",compact('categorias'));
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


        if($request->hasFile('imagen')){
            $imagenes = $request->file('imagen');
            foreach($imagenes as $imagen){
                $nombre = time().'_'.$imagen->getClientOriginalName();
                $imagen->storeAs('public/productos',$nombre);
                //$ruta = public_path().'/productos';
                //$imagen->move($ruta,$nombre);
                
                $urlimagenes[]['url'] = '/storage/productos/'.$nombre;
            }

        $producto = new Producto;
        $producto->nombre=$valores['nombre'];
        $producto->descripción=$valores['descripcion'];
        $producto->precio=$valores['precio'];
        $producto->existencia=$valores['existencia'];
        $producto->usuarios_id=$iduser;
        $producto->consignar='0';
        $producto->fecha=$fecha;
        $producto->save();

        $categoria = Categoria::where('nombre','=',$valores['categoria'])->firstOrFail();
        $producto->categorias()->attach($categoria->id);
        

        foreach($urlimagenes as $rutaimagen){
            $imagenDB = new Imagen;
            $imagenDB->nombre = $rutaimagen['url'];
            $imagenDB->productos_id = $producto->id;
            $imagenDB->save();
     
        }
     }

     $categorias = Categoria::select('categorias.nombre')
     ->get();
       
        return view("clientes.venderp",compact('categorias'));
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
        $productos = Producto::join('ventas','productos.id', '=', 'ventas.productos_id')
        -> join('transacciones','ventas.id', '=', 'transacciones.ventas_id')
        ->select('productos.nombre','productos.precio','productos.descripción','transacciones.calificacion',
        'transacciones.id as tid')
        -> where ([['transacciones.usuarios_id','=',$iduser],['ventas.status','=','Aceptado']])
        ->get();

       
        //dd($productos);
        return view("clientes.miscompras",compact('productos'));
    }

    public function calificacion(Request $request,$id){
        $valores=$request->all();
       
        Transaccion::where('id',$id)->update(['calificacion'=>((int)$valores['rating']['rating'])]);
        return redirect()->route('miscompras.ver');
    }

    public function misventas(){
        $usuario = \Session::get('usuario');
        foreach($usuario as $user){
        $iduser = $user->id;
        }
        //-----------------//
        $ventas = Producto::selectRaw('productos.id, count(productos.id) as vendidos, productos.nombre, productos.precio,
        productos.existencia')
        -> join('usuarios','productos.usuarios_id', '=', 'usuarios.id')
        -> join('ventas','productos.id', '=', 'ventas.productos_id')
        -> join('transacciones','ventas.id', '=', 'transacciones.ventas_id')
        -> where ('productos.usuarios_id','=',$iduser)
       ->groupBy('productos.id')
       ->get();

        /* $cantidad = Producto::select('productos.nombre','productos.precio','productos.existencia')
        -> join('usuarios','productos.usuarios_id', '=', 'usuarios.id')
        -> join('ventas','productos.id', '=', 'ventas.productos_id')
        -> join('transacciones','ventas.id', '=', 'transacciones.ventas_id')
        -> where (['productos.usuarios_id','=',$iduser,])
        ->groupBy('pnombre','productos.precio','productos.existencia')
        ->having('pnombre','productos.precio','productos.existencia') < 1; */

        

        //dd($ventas);
        //dd($productos);
        return view("clientes.misventas",compact('ventas'));
    }

    public function editarfotos($id){
        $id=$id;
        //-----------------//
        $productos = Producto::where('id', $id)->get(['nombre','id']);
        $imagenes = Imagen::where('productos_id', $id)->get(['nombre','id']);
        return view("clientes.editimagenes",compact('productos','imagenes'));
    }

    public function formularioimagen($id){

        //-----------------//
        $productos = Producto::where('id', $id)->get(['nombre','id']);
        return view("clientes.addimagen",compact('productos','id'));
    }

    public function añadirimagen(Request $request,$id){
        $valores=$request->all();
        $id=$id;
        $urlimagenes = [];

        //dd($valores);
        if($request->hasFile('imagen')){
            $imagenes = $request->file('imagen');
            foreach($imagenes as $imagen){
                $nombre = time().'_'.$imagen->getClientOriginalName();
                $imagen->storeAs('public/productos',$nombre);
                
                $urlimagenes[]['url'] = '/storage/productos/'.$nombre;
            }
        
        foreach($urlimagenes as $rutaimagen){
            $imagenDB = new Imagen;
            $imagenDB->nombre = $rutaimagen['url'];
            $imagenDB->productos_id = $id;
            $imagenDB->save();
     
        }
     }
     $productos = Producto::where('id', $id)->get(['nombre','id']);
     $mensaje='Imagen añadida correctamente';

        return view("clientes.addimagen",compact('productos','mensaje','id'));
    }

    public function cambiarimagen(Request $request,$id){
        $imagenes = Imagen::where('id', $id)->get(['nombre','id']);
        return view("clientes.changeimagen",compact('imagenes','id'));
    }


    public function updateimagen(Request $request,$id){
        $valores=$request->all();
        $imagenes = Imagen::select('nombre')->find($id);
        
       
        //unlink(Storage::disk('public')->delete($imagenes['nombre']));
        unlink(public_path($imagenes['nombre']));
            $file = $request->file('imagen'); 
            $originalname = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/productos',$originalname);
            
            $valores['imagen'] = '/storage/productos/'.$originalname;
            
            Imagen::where('id',$id)->update(['nombre'=>$valores['imagen']]);    

        $mensaje='Imagen cambiada';
         $imagenes = Imagen::where('id', $id)->get(['nombre','id']);
         return view("clientes.changeimagen",compact('imagenes','id','mensaje'));
    }

    public function deleteimagen(Request $request,$id){
        $valores=$request->all();
        $imagenes = Imagen::select('nombre')->find($id);

        unlink(public_path($imagenes['nombre']));
        
        Imagen::where('id',$id)->delete();

        $productos = Producto::where('nombre', $valores['nombre'])->get(['nombre','id']);

        foreach($productos as $producto){
            $idproducto=$producto->id;
          }
        
        $imagenes = Imagen::where('productos_id', $idproducto)->get(['nombre','id']);
        
         //$imagenes = Imagen::where('id', $id)->get(['nombre','id']);
         return redirect()->route('editar-fotos.editarfotos',$idproducto);
    }

    public function deleteproducto($id){
        $id=$id;
        $imagenes = Imagen::where('productos_id', $id)->get();

        foreach($imagenes as $imagen){
            unlink(public_path($imagen['nombre']));
            Imagen::where('id',$imagen['id'])->delete();

        }
        
        Producto::where('id',$id)->delete();
        $productos=Producto::select('*')->get();
        
        
        return redirect()->route('misproductos.misproductos');
    }


}

