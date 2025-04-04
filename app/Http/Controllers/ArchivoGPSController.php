<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\PuntoGPS;

class ArchivoGPSController extends Controller
{
    public function cargar(Request $request)
    {   /*  /*N4.724473 → Latitud positiva: 4.724473 ,W74.023408 → Longitud negativa: -74.023408,
        N → Latitud (North = Norte),
        S → Latitud (South = Sur),
        E → Longitud (East = Este),
        W → Longitud (West = Oeste*/
        try {
            $archivo = $request->file('archivo_gps');
            $contenido = file($archivo->getPathname());
    
            foreach ($contenido as $linea) {
                $partes = explode(',', $linea);
                $modelo = $partes[0];
                $imei =  $partes[2];
                $extreaeplaca = explode(':', $partes[4]);
                $placa = strtok($extreaeplaca[1], ';');
                $parteslat = explode(';', $partes[5]);
                $latRaw = $parteslat[2];
                $lngRaw = $parteslat[3];
    
                $latitud = (str_starts_with($latRaw, 'S') ? -1 : 1) * floatval(substr($latRaw, 1));
                $longitud = (str_starts_with($lngRaw, 'W') ? -1 : 1) * floatval(substr($lngRaw, 1));
                $fecha_limp = trim($partes[count($partes) - 1], "[]\n");
                $extrafechaparts = explode("#", $fecha_limp);
                $fecha_hora = str_replace(["[", "]"], "", $extrafechaparts[1]);
    
                $vehiculo = Vehiculo::firstOrCreate(
                    ['placa' => $placa],
                    ['imei' => $imei, 'modelo' => $modelo]
                );
    
                // Evitar duplicados exactos
                $existe = PuntoGPS::where('vehiculo_id', $vehiculo->id)
                    ->where('latitud', round($latitud, 6))
                    ->where('longitud', round($longitud, 6))
                    ->first();
    
                if (!$existe) {
                    PuntoGPS::create([
                        'vehiculo_id' => $vehiculo->id,
                        'latitud' => $latitud,
                        'longitud' => $longitud,
                        'fecha_hora' => $fecha_hora
                    ]);
                }
            }
    
            return response()->json(['success' => true]);
    
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
