<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Producto;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    
    public function listarcategorias(){
        $categorias = DB::table('categorias')->get();
        return view("categorias.categoria")->with('categorias',$categorias);
    }
    public function listarproductoscat($id){
        $id=$id;

        $productos=Producto::select('*')
                   ->join('categoria_productos','productos.id', '=', 'categoria_productos.producto_id')
                   -> where ([['categoria_productos.categoria_id',$id],['productos.consignar','=',1]])
                   ->get();

        return view("categorias.productos")->with('productos',$productos);
    }
}
