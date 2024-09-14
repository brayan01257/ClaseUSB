//inicio el mapa en la coordenada 6.210732, -75.573817 
var map = L.map('map').setView([6.210732, -75.573817], 11);

//inicio mapa base de un proveedor (Cartocdn)

L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://carto.com/attributions">CartoDB</a> | &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
});

var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
});

var osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'});

//informacion cartograficainserta un punto
// var marker = L.marker([6.210732, -75.573817]).addTo(map);

//inserta una etiqueta cliqueable de informacion del punto

// marker.bindPopup("<b>Hola medellín</b><br>Estoy aquí").openPopup();

// //añadir un circulo 
// var circle = L.circle([6.210732, -75.573817], {
//     color: 'blue',
//     fillColor: '#3cd18d',
//     fillOpacity: 0.5,
//     radius: 500
// }).addTo(map);

// //añadir un poligono

// var polygon = L.polygon([
//     [6.212606, -75.575394],
//     [6.211993, -75.574273],
//     [6.210804, -75.574584],
//     [6.211220, -75.575480]
// ]);

var baseMaps = {
    "OpenStreetMap": osm,
    "OpenStreetMap.HOT": osmHOT,
    "Satelital": Esri_WorldImagery
};

// var overlayMaps = {
//     "marker": marker,
//     "circle": circle
// };

function style_limite_barrio_vereda_cata_4326_0_0(feature) {
    switch (String(feature.properties['comuna'])) {
        case '01':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(220,68,34,1.0)', // Rojo
                fillOpacity: 0.2
            };
        case '02':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(239,98,112,1.0)', // Rosa
                fillOpacity: 0.2
            };
        case '03':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(220,250,34,1.0)', // Amarillo
                fillOpacity: 0.2
            };
        case '04':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(150,98,112,1.0)', // Morado
                fillOpacity: 0.2
            };
        case '05':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(20,150,34,1.0)', // Verde
                fillOpacity: 0.2
            };
        case '06':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(39,18,112,1.0)', // Azul Marino
                fillOpacity: 0.2
            };
        case '07':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(255,50,34,1.0)', // Naranja
                fillOpacity: 0.2
            };
        case '08':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(1,8,112,1.0)', // Azul Oscuro
                fillOpacity: 0.2
            };
        case '09':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(128,0,128,1.0)', // Púrpura
                fillOpacity: 0.2
            };
        case '10':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(255,215,0,1.0)', // Dorado
                fillOpacity: 0.2
            };
        case '11':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(255,105,180,1.0)', // Rosa Claro
                fillOpacity: 0.2
            };
        case '12':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(0,255,255,1.0)', // Cian
                fillOpacity: 0.2
            };
        case '13':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(255,69,0,1.0)', // Rojo Anaranjado
                fillOpacity: 0.2
            };
        case '14':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(34,139,34,1.0)', // Verde Bosque
                fillOpacity: 0.2
            };
        case '15':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(0,191,255,1.0)', // Azul Profundo
                fillOpacity: 0.2
            };
        case '16':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(255,0,255,1.0)', // Magenta
                fillOpacity: 0.2
            };
        case '50':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(255,228,225,1.0)', // Rosa Pálido
                fillOpacity: 0.2
            };
        case '60':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(109,102,192,1.0)', // Gris
                fillOpacity: 0.2
            };
        case '70':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(255,140,0,1.0)', // Naranja Oscuro
                fillOpacity: 0.2
            };
        case '80':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(0,250,154,1.0)', // Verde Claro
                fillOpacity: 0.2
            };
        case '90':
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(0,0,255,1.0)', // Azul
                fillOpacity: 0.2
            };
        default:
            return {
                color: 'rgba(35,35,35,1.0)',
                weight: 1.0,
                fillColor: 'rgba(128,202,63,1.0)', // Verde Pastel por defecto
                fillOpacity: 0.2
            };
    }
}

function style_vias(feature) {
    let color, weight, dashArray;

    // Determina el color, el peso y el patrón de la línea según la jerarquía
    switch (String(feature.properties.jerarquiza)) {
        case 'Vía arteria':
            color = 'rgba(255,0,0,1.0)'; // Rojo para vías primarias
            weight = 4;  // Peso mayor para vías primarias
            dashArray = '5, 5'; // Línea punteada
            break;
        case 'Autopista urbana o vía de travesía':
            color = 'rgba(0,255,0,1.0)'; // Verde para vías secundarias
            weight = 3;  // Peso medio para vías secundarias
            dashArray = '0'; // Línea sólida
            break;
        case 'Vía secundaria rural':
            color = 'rgba(0,0,255,1.0)'; // Azul para vías terciarias
            weight = 2;  // Peso menor para vías terciarias
            dashArray = '2, 6'; // Línea con rayas
            break;
        default:
            color = 'rgba(128,128,128,1.0)'; // Gris para jerarquías no especificadas
            weight = 1;
            dashArray = '0'; // Línea sólida
            break;
    }

    // Estilo final para la vía
    return {
        color: color,
        weight: weight,
        dashArray: dashArray,
        opacity: 1.0
    };
}

// Cargar el archivo GeoJSON
fetch('GeoJSON/jerarquia_vial.json')
    .then(response => response.json())
    .then(data => {
        console.log(data); // Para depuración

        // Añadir el GeoJSON al mapa con estilos y eventos
        L.geoJSON(data, {
            style: style_vias, // Aplicar la función de estilo
            onEachFeature: function (feature, layer) {
                // Configurar el contenido del popup para mostrar los atributos
                var popupContent = '<p><strong>Nombre vía:</strong> ' + (feature.properties.nombre || 'Sin nombre') + '<br>' +
                                   '<strong>Jerarquía:</strong> ' + (feature.properties.jerarquiza || 'Sin jerarquía') + '<br>' +
                                   '<strong>Estado:</strong> ' + (feature.properties.estado || 'Sin estado') + '</p>';
                layer.bindPopup(popupContent);
            }
        }).addTo(map);
    })
    .catch(err => console.error('Error cargando el archivo GeoJSON: ', err));


// Cargar el archivo GeoJSON
fetch('GeoJSON/limite_barrio_vereda_cata_43261.geojson')
    .then(response => response.json())
    .then(data => {
        console.log(data); // Para depuración

        // Añadir el GeoJSON al mapa con estilos y eventos
        L.geoJSON(data, {
            style: style_limite_barrio_vereda_cata_4326_0_0, // Aplicar la función de estilo
            onEachFeature: function (feature, layer) {
                // Configurar el contenido del popup para mostrar los atributos nombre_bar y nombre_com
                var popupContent = '<p><strong>Barrio:</strong> ' + (feature.properties.nombre_bar || 'Sin nombre') + '<br>' +
                                   '<strong>Comuna:</strong> ' + (feature.properties.nombre_com || 'Sin comuna') + '<br>' + 
                                   '<strong>Comuna_numero:</strong> ' + (feature.properties.comuna || 'Sin numero comuna') + '</p>';
                layer.bindPopup(popupContent);
            }
        }).addTo(map);
    })
    .catch(err => console.error('Error cargando el archivo GeoJSON: ', err));


