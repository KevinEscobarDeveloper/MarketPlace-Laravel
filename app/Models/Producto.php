<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    use HasFactory;
    

    protected $table = 'productos';
    // public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'conseccionado',
        'consignar',
        'motivo',
        'existencia',
        'pendientes',   
        'fecha',
    ];
    
    public function categorias(){
        return $this->belongsToMany(Categoria::class, 'categoria_producto');
    }

    public function usuarios(){
        return $this->belongsTo(Usuario::class,'usuarios_id','id');
    }

    public function preguntas(){
        return $this->hasMany(Pregunta::class, 'productos_id','id');
    }

    public function ventas(){
        return $this->hasMany(Venta::class, 'ventas_id','id');
    }

}
