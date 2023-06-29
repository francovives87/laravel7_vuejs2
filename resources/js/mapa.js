// import
import { OpenStreetMapProvider } from 'leaflet-geosearch';

// setup
const provider = new OpenStreetMapProvider();


document.addEventListener('DOMContentLoaded', () => {



    if (document.querySelector('#mapa')) {

        const lat = -32.976046;
        const lng = -60.636097;

        var mymap = L.map('mapa').setView([lat, lng], 16);

        //Eliminar pines previos
        let markers = new L.FeatureGroup().addTo(mymap);



        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZXppb25zdHVkaW8iLCJhIjoiY2tvcTR5bWhsMG5vdzJucnl3MXNmNG4zbCJ9.dVIGb_KiSS7PHilup4T9xA'
        }).addTo(mymap);

        let marker;


        //Agregando el pin
        marker = L.marker([lat, lng], {
            draggable: true,
            autoPan: true,
        }).addTo(mymap);

        //Agrego pin a las capas para poder limpiarlo al de arranque
        markers.addLayer(marker);

        //Geocode Service
        const geocodeService = L.esri.Geocoding.geocodeService({
            apikey: 'AAPKaa4b71720483470ca0259f945a24977bEEkPuM4Naqf52rbl0FmecWr2C9ERP-U-zmX608ZyhfgGs9UWFrSBUSvT4TCf-zk5',
        });

        //Buscador de direcciones
        const btnBuscar = document.querySelector('#btnBuscar')
        btnBuscar.addEventListener("click", buscarDireccion);

        const btnLimpiar = document.querySelector('#btnLimpiar')
        btnLimpiar.addEventListener("click", limpiarInputBuscar);

        const btnLatLgnBrowser = document.querySelector('#LatLgnBrowser')
        LatLgnBrowser.addEventListener("click", obtenerLanLgnDelNavegador);

        reubicarPin(marker);

        function reubicarPin(marker) {

            //Detectar movimiento del marker
            marker.on('moveend', function (e) {
                marker = e.target;

                const posicion = marker.getLatLng()

                //Centrar mapa
                mymap.panTo(new L.LatLng(posicion.lat, posicion.lng));

                //Reverse Geocoding, cuando el user reubica el pin
                geocodeService.reverse().latlng(posicion, 13).run(function (error, resultado) {
                    console.log(error);



                    marker.bindPopup(resultado.address.LongLabel);
                    marker.openPopup();

                    // Llenar los campos
                    llenarCampos(resultado);

                });

            });
        }

        function llenarCampos(resultado) {
            console.log(resultado);
            document.querySelector('#pais').value = resultado.address.CountryCode;
            document.querySelector('#region').value = resultado.address.Region;
            document.querySelector('#subregion').value = resultado.address.Subregion;
            document.querySelector('#ciudad').value = resultado.address.City;
            document.querySelector('#direccion').value = resultado.address.Address;
            document.querySelector('#codigo_postal').value = resultado.address.Postal;
            document.querySelector('#barrio').value = resultado.address.Neighborhood;
            document.querySelector('#lat').value = resultado.latlng.lat;
            document.querySelector('#lng').value = resultado.latlng.lng;
        }

        function obtenerLanLgnDelNavegador() {
            console.log('obtenerLanLgnDelNavegador');
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            console.log(position.coords.latitude);
            console.log(position.coords.longitude);

            //Limpiamos pines previos
            markers.clearLayers();

            //Centrar mapa
            mymap.panTo(new L.LatLng(position.coords.latitude, position.coords.longitude));

            //Agregando el pin
            marker = L.marker([position.coords.latitude, position.coords.longitude], {
                draggable: true,
                autoPan: true,
            }).addTo(mymap);

            //Agrego pin a las capas para poder limpiarlo al de arranque
            markers.addLayer(marker);

            //mover el pin
            reubicarPin(marker);


        }


        function limpiarInputBuscar() {
            document.querySelector('#inputBuscar').value = "";
        }

        function buscarDireccion() {
            const inputBuscar = document.querySelector('#inputBuscar').value;

            console.log(inputBuscar);

            provider.search({ query: inputBuscar })
                .then(resultado => {
                    if (resultado[0]) {

                        //Limpiamos pines previos
                        markers.clearLayers();

                        //Reverse Geocoding, cuando el user reubica el pin
                        geocodeService.reverse().latlng(resultado[0].bounds[0], 13).run(function (error, resultado) {


                            console.log(resultado);

                            // Llenar los campos
                            llenarCampos(resultado);

                            //Centrar el mapa
                            mymap.setView(resultado.latlng);

                            //Agregar el pin
                            marker = L.marker(resultado.latlng, {
                                draggable: true,
                                autoPan: true,
                            }).addTo(mymap);

                            //Asiganar el contendor de markers el nuevo pin
                            markers.addLayer(marker);

                            //mover el pin
                            reubicarPin(marker);
                        });
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        }



    }





});