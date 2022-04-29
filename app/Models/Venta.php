<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'ventas';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'monto',
        'status',
        'evidencia',
        'tipo',
        'correo',   
    ];

    public function productos(){
        return $this->belongsTo(Producto::class,'productos_id','id');
    }

    public function transacciones(){
        return $this->belongsTo(Transaccion::class, 'transaccion_id','id');
    }
}
