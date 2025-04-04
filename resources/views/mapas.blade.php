@extends('layouts.app')

@section('content')

    <!-- Contenido principal -->
    <div class="container mt-4">
        <h2 class="text-center">Ubicación de Vehículos</h2>
        <div id="map" style="height: 500px; border-radius: 10px;"></div>
    </div>

    <script>
        var map = L.map('map'); 

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

fetch("{{ url('/api/puntos_gps') }}")
    .then(response => response.json())
    .then(data => {
        if (data.length > 0) {
            let bounds = [];

            data.forEach(punto => {
                let latlng = [punto.latitud, punto.longitud];
                bounds.push(latlng);

                L.marker(latlng)
                    .addTo(map)
                    .bindPopup(`<b>Vehículo:</b> ${punto.vehiculo}<br><b>Fecha/Hora:</b> ${punto.fecha_hora}`);
            });

            // Centrar el mapa automáticamente para mostrar todos los puntos
            map.fitBounds(bounds);
        } else {
            console.warn("No hay puntos GPS disponibles.");
          
        }
    })
    .catch(error => {
        console.error("Error cargando datos:", error);
        

       //map.setView([0.23408, 7.24473], 6); // Fallback si hay error
    });
    </script>

  
@endsection
