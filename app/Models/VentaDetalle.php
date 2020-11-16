<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Venta;
use App\Models\Producto;
class VentaDetalle extends Model
{
    use HasFactory;

    protected $fillable = ['venta_id', 'producto_id'];
    protected $table = 'ventas_detalle';
    public $timestamps = false;

public function venta(){
        return $this->belongsTo(Venta::class);
    }

public function producto(){
        return $this->belongsTo(Producto::class);
    }


}
