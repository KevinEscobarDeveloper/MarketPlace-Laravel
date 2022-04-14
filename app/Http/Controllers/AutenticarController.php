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
        
        switch ($rol) {
            case 'Supervisor':
                if($request->input('contraseña')==$contraseña)
                    return  redirect('/tablero');
                else return  redirect('/login');
                break;
            case 'Cliente':
                if($request->input('contraseña')==$contraseña)
                    return  redirect('/cuenta');
                else return  redirect('/login');
                break;
            case 'Encargado':
                if($request->input('contraseña')==$contraseña)
                    return  redirect('/tablero');
                else return  redirect('/login');
                break;
            case 'Contador':
                if($request->input('contraseña')==$contraseña)
                    return  redirect('/totalizar');
                else return  redirect('/login');
                break;
            default:
                return  redirect('/login')->with('error', 'Usuario no registrado');
                break;
        }
    }
}
