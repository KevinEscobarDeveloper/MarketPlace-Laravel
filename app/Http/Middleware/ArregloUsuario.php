<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ArregloUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $usuario = \Session::get('usuario');
        if(is_null($usuario)){
            $usuario=[
            ];
            \Session::put('usuario',$usuario);
        }
        return $next($request);
    }
}
