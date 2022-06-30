<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class AutenticarController extends Controller
{
    public function validar(Request $request)
    {
        $correo = $request->input('usuario');
        $correo = DB::table('usuarios')->select('correo')->where('correo', '=', $correo)->value('correo');
        $rol = DB::table('usuarios')->select('rol')->where('correo', '=', $correo)->value('rol');
        $contraseña = DB::table('usuarios')->select('password')->where('correo', '=', $correo)->value('password');
        $mensajeerror='Error en la contraseña';
        //-----Obtenemos los datos del usuario que ingreso para la sesión----//
        $usuario = DB::table('usuarios')
        ->select('usuarios.nombre','usuarios.apellido_paterno','usuarios.apellido_materno',
        'usuarios.rol','usuarios.id','usuarios.activo')
        ->where([['usuarios.correo','=',$correo],['usuarios.password','=',$contraseña]])
        ->get();

        switch ($rol) {
            case 'Supervisor':
                if($request->input('contraseña')==$contraseña){
                    \Session::put('usuario',$usuario);
                    return  redirect('/principal-supervisor');
                }
                else return view("login.login",compact('mensajeerror'));
                break;
            case 'Cliente':
                if($request->input('contraseña')==$contraseña){
                    \Session::put('usuario',$usuario);
                    return  redirect('/principal-cliente');
                }
                else return view("login.login",compact('mensajeerror'));
                break;
            case 'Encargado':
                if($request->input('contraseña')==$contraseña){
                    \Session::put('usuario',$usuario);
                    return  redirect('/principal-encargado');
                }
                else return view("login.login",compact('mensajeerror'));
                break;
            case 'Contador':
                if($request->input('contraseña')==$contraseña){
                    \Session::put('usuario',$usuario);
                    return  redirect('/principal-contador');
                }
                else return  redirect('/login');
                break;
            default:
                $mensaje='Usuario no registrado';
                return  redirect('/login')->with('mensaje');
                break;
        }
    }
}
