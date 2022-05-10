<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

    protected $table = 'imagenes';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre'
    ];

    public function productos(){
        return $this->belongsTo(Producto::class,'productos_id','id');
    }
}
