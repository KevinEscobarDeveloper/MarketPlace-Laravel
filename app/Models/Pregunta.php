<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;
    protected $table = 'preguntas';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'pregunta',  
        'respuesta',  
    ];

    public function productos(){
        return $this->belongsTo(Producto::class,'productos_id','id');
    }

    public function usuarios(){
        return $this->belongsTo(Usuario::class,'usuarios_id','id');
    }
}
