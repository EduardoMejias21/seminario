<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Geolocalizacion</title>
        <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet">
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>
        <style>
            body{ 
                margin: 0; 
                padding: 0; 
            }
            #map{
            height: 400px;
            width: 50%;
            }
            .coordinates{
                background: rgba(0, 0, 0, 0.5);
                color: #fff;
                width: 25%;
                left: 10px;
                padding: 5px 20px;
                margin: 0;
                font-size: 11px;
                line-height: 18px;
                border-radius: 3px;
                display: none;
            }
        </style>
    </head>
    <body>
        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
        <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
        <div id="map"></div>
        <pre id="coordinates" class="coordinates"></pre>
        <script>
            mapboxgl.accessToken = 'pk.eyJ1IjoiZW1lamlhcyIsImEiOiJjbGx5YnAwMnUwcWIxM2pvNTZvenZwYnNlIn0.UtVNa21HqR6Oh5b7YKlpDg';
            const coordinates = document.getElementById('coordinates');
            const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [-65.779167,-28.468889],
            zoom: 12
            });
            
            map.addControl(
            new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl
            })
            );
            map.addControl(new mapboxgl.FullscreenControl());
            map.addControl(new mapboxgl.GeolocateControl({
                positionOptions: {
                    enableHighAccuracy: true
                },
                trackUserLocation: true
            }));
            map.addControl(new mapboxgl.NavigationControl());
            const popup = new mapboxgl.Popup({
            }).setText("RIXER")
            const marcador = new mapboxgl.Marker({
                color:"red",
            }).setLngLat([-65.71988072797458,-28.43790901663466]).setPopup(popup).addTo(map)
            // function clickSobreMapa(e){
            //     console.log(e.lngLat)
            //     alert("LATITUD: "+ e.lngLat.lat + " LONGITUD: " + e.lngLat.lng)
            // }
            // map.on("click", clickSobreMapa)
            // map.on('click', function (e) {
            //     document.getElementById('coordenadas').innerHTML =
            //         JSON.stringify(e.lngLat);
            //         console.log(e)
            // });
            const canvas = map.getCanvasContainer();
            const geojson = {
                'type': 'FeatureCollection',
                'features': [
                    {
                    'type': 'Feature',
                    'geometry': {
                        'type': 'Point',
                        'coordinates': [-65.779167,-28.468889]
                        }
                    }
                ]
            };
            function onMove(e) {
                const coords = e.lngLat;
                canvas.style.cursor = 'grabbing';
                geojson.features[0].geometry.coordinates = [coords.lng, coords.lat];
                map.getSource('point').setData(geojson);
            }
                
            function onUp(e) {
                const coords = e.lngLat;
                coordinates.style.display = 'block';
                coordinates.innerHTML = `Longitud: ${coords.lng}<br />Latitud: ${coords.lat}`;
                canvas.style.cursor = '';
                map.off('mousemove', onMove);
                map.off('touchmove', onMove);
            }
            map.on('load', () => {
                map.addSource('point', {
                'type': 'geojson',
                'data': geojson
                });
                
                map.addLayer({
                'id': 'point',
                'type': 'circle',
                'source': 'point',
                'paint': {
                'circle-radius': 10,
                'circle-color': '#F84C4C'
                }
                });
                
                map.on('mouseenter', 'point', () => {
                map.setPaintProperty('point', 'circle-color', '#3bb2d0');
                canvas.style.cursor = 'move';
                });
                
                map.on('mouseleave', 'point', () => {
                map.setPaintProperty('point', 'circle-color', '#3887be');
                canvas.style.cursor = '';
                });
                
                map.on('mousedown', 'point', (e) => {
                e.preventDefault();
                
                canvas.style.cursor = 'grab';
                
                map.on('mousemove', onMove);
                map.once('mouseup', onUp);
                });
                
                map.on('touchstart', 'point', (e) => {
                if (e.points.length !== 1) return;
                e.preventDefault();
                
                map.on('touchmove', onMove);
                map.once('touchend', onUp);
                });
                });
        </script>
    </body>
</html>