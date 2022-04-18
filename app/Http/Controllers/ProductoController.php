<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductoController extends Controller
{
    public function listarproductos(){
        $productos = DB::table('productos')
        ->get();
        return view("categorias.productos")->with('productos',$productos);
    }
}
