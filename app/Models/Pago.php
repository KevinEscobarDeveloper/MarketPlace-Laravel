<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table = 'pagos';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'monto',
        'estado',  
    ];

    public function ventas(){
        return $this->hasMany(Venta::class, 'ventas_id','id');
    }

    public function usuarios(){
        return $this->belongsTo(Usuario::class,'usuarios_id','id');
    }
}
