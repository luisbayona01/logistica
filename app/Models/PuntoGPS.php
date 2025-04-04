<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoGPS  extends Model
{
    use HasFactory;
    protected $table = 'puntos_gps';
    protected $fillable = ['vehiculo_id', 'latitud', 'longitud','fecha_hora'];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}
