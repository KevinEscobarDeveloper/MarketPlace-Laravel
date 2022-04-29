<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categoria';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'activa',   
    ];
    public function productos(){
        return $this->belongsToMany(Producto::class, 'categoria_producto');
    }
}
