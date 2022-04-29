<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    protected $table = 'transacciones';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'calificacion' 
    ];

    public function ventas(){
        return $this->hasOne(Venta::class, 'ventas_id','id');
    }

    public function usuarios(){
        return $this->belongsTo(Usuario::class,'usuarios_id','id');
    }
}
