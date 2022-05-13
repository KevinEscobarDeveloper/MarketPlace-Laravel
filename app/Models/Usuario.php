<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'correo',
        'imagen',
        'rol',
        'activo',
        'password',
        'fecha',   
    ];

    public function productos(){
        return $this->hasMany(Producto::class, 'usuarios_id','id');
    }

    public function preguntas(){
        return $this->hasMany(Pregunta::class, 'usuarios_id','id');
    }
    public function transacciones(){
        return $this->hasMany(Transaccion::class, 'transaccion_id','id');
    }

    public function pagoss(){
        return $this->hasMany(Pago::class, 'pagos_id','id');
    }
}

