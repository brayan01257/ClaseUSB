<html>
	<head>
		<title>PROYECTO SIG2</title>
			<link rel="stylesheet" href="OpenLayers/ol.css" type="text/css">  <!-- Librerias de Openlayers css -->
			<script src="OpenLayers/ol.js" type="text/javascript"></script> <!-- Librerias de Openlayers js -->
			<script src="JQuery/jquery.js" type="text/javascript"></script> <!-- Librerias de JQuery js -->
	</head>
	<body>
		<?php
		
		session_start(); // se inicia una sesión

		$rol = $_SESSION['rol'];
		
		if($rol){
			
		

			?>		
			<p> Bienvenido, <?php echo $rol; ?> <a href='salir.php'>Cerrar Sesion</a></p> 

			
				<div id="mapa" class="mapa" style="height: 500px;width: 720px;" ></div> <!-- Dentro del Rol usuario se define el visor geográfico -->
				<br>
				<div> <!-- Dentro del Rol usuario se define las opciones -->
					<input size="15px" id="nodo_origen" type="text" placeholder="Nodo Origen">
					<input size="15px" id="nodo_destino" type="text" placeholder="Nodo Destino">
					<button onclick="calcular_ruta_nodo()">Calcular Ruta</button>
					<button onclick="calcular_nodos()">Calcular Nodos</button>
					<button onclick="dist_euclediana_nodo()">Distancia Euclediana</button>
					<button onclick="nueva_ruta()">Nueva Ruta</button>
					
				</div>
			
			
			<?php
		}
			
		else{ // Si no se ha creado el parámetro usuario retornará este mensaje en HTML
			echo 'Debe Iniciar Sesion Para Acceder';
			echo '<p><a href="inicio_sesion.php">Iniciar Sesion</a></p>'; // Enlace de inicio de sesión en HTML
		}
		?>
		
		<script> <!-- Se define JavaScript -->

			var map = new ol.Map({
										layers: [
										  new ol.layer.Tile({
											source: new ol.source.OSM()
										  })],
										target: 'mapa',
										view: new ol.View({
										  projection: 'EPSG:4326',
										  center: [-76.5, 3.438],
										  zoom: 12
										})
									});

		
			/*var myLayer1303 = new ol.layer.Tile({
							  extent: [2033814, 6414547, 2037302, 6420952],
							  preload: Infinity,
							  visible: true,
							  source: new ol.source.TileWMS(({
								url: 'http://localhost:8080/geoserver/Taller2/wms?',
								params: {'LAYERS': 'Taller2:vias_wgs84', 'TILED': true, 'VERSION': '1.3.0',
								  'FORMAT': 'image/png8', 'WIDTH': 256, 'HEIGHT': 256, 'CRS': 'EPSG:4326'},
								serverType: 'geoserver'
								}))
							  });
							  
			map.addLayer(myLayer1303);*/

								
		
			function capturar_click_origen(){
				alert('Click sobre el mapa para capturar coordenadas');
				map.once('click', function(evt) {
					var lng = evt.coordinate[0].toFixed(6);
					var lat = evt.coordinate[1].toFixed(6);
					document.getElementById("cor_origen").value=lng+' '+lat;
					});
			}
			
			function capturar_click_destino(){
				alert('Click sobre el mapa para capturar coordenadas');
				map.once('click', function(evt) {
					var lng = evt.coordinate[0].toFixed(6);
					var lat = evt.coordinate[1].toFixed(6);
					document.getElementById("cor_destino").value=lng+' '+lat;
					});
			}
			
			function calcular_ruta_click () {
				var cor_origen= document.getElementById("cor_origen").value;
				var cor_destino= document.getElementById("cor_destino").value;
				console.log('consultas.php?caso=ruta_por_click&origen='+cor_origen+'&destino='+cor_destino);
				var vectorruta = new ol.source.Vector({
									 url: 'consultas.php?caso=ruta_por_click&origen='+cor_origen+'&destino='+cor_destino,
									 format: new ol.format.GeoJSON()
								  });

				var layer_ruta = new ol.layer.Vector({
						  source: vectorruta
					  });
					  
				map.addLayer(layer_ruta);
				
				setTimeout(function(){
					var extent = vectorruta.getExtent();
					  map.getView().fit( extent, map.getSize());
				}, 500);
				
			}
			
			function calcular_nodos_click(){
				var cor_origen= document.getElementById("cor_origen").value;
				var cor_destino= document.getElementById("cor_destino").value;
				
				var vector_nodo = new ol.source.Vector({
									 url: 'consultas.php?caso=nodos_por_click&origen='+cor_origen+'&destino='+cor_destino,
									 format: new ol.format.GeoJSON()
								  });

				var layer_nodo = new ol.layer.Vector({
						  source: vector_nodo
					  });
					  
				map.addLayer(layer_nodo);
				
			}
			
			function dist_euclediana_click(){
				var cor_origen= document.getElementById("cor_origen").value;
				var cor_destino= document.getElementById("cor_destino").value;
				
				$.ajax({
						type : 'GET',
						url : 'consultas.php?caso=dist_eucl_click&origen='+cor_origen+'&destino='+cor_destino,
						dataType : 'json',
						success : function(data){
							alert('Distancia Euclediana: '+data);
							
							},
							error : function(XMLHttpRequest, textStatus, errorThrown) {
							// Display error
							}
					});
			}
			
			function nueva_ruta(){
				location.reload();
			}

			
    </script>

	</body>
</html>