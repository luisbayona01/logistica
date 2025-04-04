<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PuntoGPS;

class MapaController extends Controller
{
    public function obtenerPuntos()
    {
        // Obtener los puntos GPS con los datos del vehículo
        $puntos = PuntoGPS::with('vehiculo:id,modelo,placa')->get();

        // Formatear los datos para el mapa
        $data = $puntos->map(function ($punto) {
            return [
                'latitud' => $punto->latitud,
                'longitud' => $punto->longitud,
                'fecha_hora' => $punto->fecha_hora,
                'vehiculo' => $punto->vehiculo->modelo . ' - ' . $punto->vehiculo->placa
            ];
        });

        // Retornar los datos en formato JSON
        return response()->json($data);
    }
}
