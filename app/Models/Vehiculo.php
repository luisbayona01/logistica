<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = ['modelo', 'imei', 'placa'];

    public function PuntoGPS()
    {
        return $this->hasMany(PuntoGPS::class);
    }
}
