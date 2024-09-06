<html>
	<head>
		<title>PROYECTO Sesiones, Login, Formulario, Ajax, GeoJson</title>
			<link rel="stylesheet" href="OpenLayers/ol.css" type="text/css">  <!-- Librerias de Openlayers css -->
			<script src="OpenLayers/ol.js" type="text/javascript"></script> <!-- Librerias de Openlayers js -->
			<script src="JQuery/jquery.js" type="text/javascript"></script> <!-- Librerias de JQuery js -->
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="description" content="Control to add a grid reference to a map." />
			<meta name="keywords" content="ol3, control, search, BAN, french, places, autocomplete" />
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
			<link rel="stylesheet" href="http://viglino.github.io/ol-ext/dist/ol-ext.css" />
			<script type="text/javascript" src="http://viglino.github.io/ol-ext/dist/ol-ext.js"></script>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
			<link rel="stylesheet" type="text/css" href="estilos.css">
			<link href="https://fontawesome.com/v4.7.0/assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
			<link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

	<style>
  	html, body{
	height:100% ;
	width:100% vw;
	}
	
	
	#mapa{
	width:80%;
	height:100%;
	position: fixed;
	top: 70px;}
	
	#captura{
	width:20%;
	position:fixed;
	top: 70px;
	left:1215px;
	border: solid 30px;
	background-color: #313B44;}
	
	</style>
	
	</head>
	<body>
<?php
		//  1-  Inicio y acceso al sistema, Controla estar logeado en la sesión
		session_start(); // se inicia una sesión

		$rol = $_SESSION['rol'];
		
		if($rol){

?>	

<?php 
    include("includes/header1.php")
?>	

				<div id="mapa" class="mapa" style="width: 1200px" ></div> <!-- Dentro del Rol usuario se define el visor geográfico -->
				<br>
				<div  id="captura" style="width: 320px" > <!-- Dentro del Rol usuario se define las opciones -->
					
				<div class="row">
				  <div class="col-lg-6">
					<div class="input-group">
					<span class="input-group-btn">
					<input size="15px" class="form-control" style="left: 18px" id="cor_origen" type="text" placeholder="Coor. Origen" onclick="capturar_click_origen()">
					<input size="15px" class="form-control" style="left: 18px" id="cor_destino" type="text" placeholder="Coor. Destino" onclick="capturar_click_destino()">
					<br></br>
					<button class="btn btn-warning active" style="left: 18px" onclick="capturar_click_origen()">Mi ubicación</button>
					<br></br>
					<button class="btn btn-warning active" style="left: 18px" onclick="capturar_click_destino()">Destino</button>
					<br></br>
					</span>
					</div>
				  </div>
				  </div>
				  <br>
				<div class="row">
				  <div class="col-lg-6">
					<div class="input-group" align="center">
					  <span class="input-group-btn">
						<button class="btn btn-primary active" style="left: 70px" onclick="calcular_ruta_click()">Calcular Ruta</button>
					  </span>
					</div>
				  </div>
				</div> 
				  <br>
				<div class="row">	
				  <div class="col-lg-6">
					<div class="input-group" align="center">
					  <span class="input-group-btn">
						<button class="btn btn-primary active" style="left: 30px" onclick="media_click()">Estado Superficial de la Ruta</button>
					  </span>
					</div>
				  </div>
				</div>
				  <br>				  
				<div class="row">	
				  <div class="col-lg-6">
					<div class="input-group" align="center">
					  <span class="input-group-btn">
						<button class="btn btn-primary active" style="left: 55px" onclick="dist_euclediana_click()">Distancia de la Ruta</button>
					  </span>
					</div>
				  </div>
				</div> 
				  <br>
				<div class="row">
				  <div class="col-lg-6">
					<div class="input-group" align="center">
					  <span class="input-group-btn">
						<button class="btn btn-primary active" style="left: 35px" onclick="calcular_ruta_click1()">Calcular una Ruta Alterna</button>
					  </span>
					</div>
				  </div>
				</div> 
				  <br>
				<div class="row">	
				  <div class="col-lg-6">
					<div class="input-group" align="center">
					  <span class="input-group-btn">
						<button class="btn btn-primary active" style="left: 4px" onclick="media_click1()">Estado Superficial de la Ruta Alterna</button>
					  </span>
					</div>
				  </div>
				</div>
				  <br>				  
				<div class="row">	
				  <div class="col-lg-6">
					<div class="input-group" align="center">
					  <span class="input-group-btn">
						<button class="btn btn-primary active" style="left: 30px" onclick="dist_euclediana_click1()">Distancia de la Ruta Alterna</button>
					  </span>
					</div>
				  </div>
				</div> 
				  <br>	
				<div class="row">	
				  <div class="col-lg-6">
					<div class="input-group" align="center">
					  <span class="input-group-btn">
						<button class="btn btn-primary active" style="left: 65px" onclick="calcular_nodos_click()">Calcular Nodos</button>
					  </span>
					</div>
				  </div>
				</div> 
				  <br>
				<div class="row">	
				  <div class="col-lg-6">
					<div class="input-group" align="center">
					  <span class="input-group-btn">
						<button class="btn btn-primary active" style="left: 70px" onclick="nueva_ruta()">Nueva Ruta</button>
					  </span>
					</div>
				  </div>
				</div>

				</div>
			
			
<?php
		}
			
		else{ // Si no se ha creado el parámetro usuario retornará este mensaje en HTML
			echo 'Debe Iniciar Sesion Para Acceder';
			echo '<p><a href="inicio_sesion.php">Iniciar Sesion</a></p>'; // Enlace de inicio de sesión en HTML
		}
?>

		<script> <!-- Se define JavaScript -->
		//  Definición del Mapa con OpenLayers	  
			var map = new ol.Map({
										layers: [
										  new ol.layer.Tile({
											source: new ol.source.OSM(),
											opacity: 0.6
										  })
										],
										target: 'mapa',
										view: new ol.View({
										  projection: 'EPSG:4326',
										  center: [-76.516573, 3.427974],
										  zoom: 12.5
										})
									});
									
	// Current selection
	var sLayer = new ol.layer.Vector({
		source: new ol.source.Vector(),
		style: new ol.style.Style({
			image: new ol.style.Circle({
				radius: 5,
				stroke: new ol.style.Stroke ({
					color: 'rgb(255,165,0)',
					width: 3
				}),
				fill: new ol.style.Fill({
					color: 'rgba(255,165,0,.3)'
				})
			}),
			stroke: new ol.style.Stroke ({
				color: 'rgb(255,165,0)',
				width: 3
			}),
			fill: new ol.style.Fill({
				color: 'rgba(255,165,0,.3)'
			})
		})
	});
	map.addLayer(sLayer);

	// Set the search control 
	var search = new ol.control.SearchNominatim (
		{	//target: $(".options").get(0),
			polygon: $("#polygon").prop("checked"),
			reverse: true,
			position: true	// Search, with priority to geo position
		});
	map.addControl (search);

	// Select feature when click on the reference index
	search.on('select', function(e)
		{	// console.log(e);
			sLayer.getSource().clear();
			// Check if we get a geojson to describe the search
			if (e.search.geojson) {
				var format = new ol.format.GeoJSON();
				var f = format.readFeature(e.search.geojson, { dataProjection: "EPSG:4326", featureProjection: map.getView().getProjection() });
				sLayer.getSource().addFeature(f);
				var view = map.getView();
				var resolution = view.getResolutionForExtent(f.getGeometry().getExtent(), map.getSize());
				var zoom = view.getZoomForResolution(resolution);
				var center = ol.extent.getCenter(f.getGeometry().getExtent());
				// redraw before zoom
				setTimeout(function(){
						view.animate({
						center: center,
						zoom: Math.min (zoom, 16)
					});
				}, 100);
			}
			else {
				map.getView().animate({
					center:e.coordinate,
					zoom: Math.max (map.getView().getZoom(),16)
				});
			}
		});
									
		//  Creación de estilos de los elementos espaciales para su desplieque							
			var styles = {
            'Point': [new ol.style.Style({
                    image: new ol.style.Circle({
                        radius: 3,
                        fill: new ol.style.Fill({
                            color: 'black'
                        })
                    })
                })],
            'LineString': [new ol.style.Style({
                    stroke: new ol.style.Stroke({
                        color: '#5A66E5',
                        width: 2
                    })
                })],
            'MultiLineString': [new ol.style.Style({
                    stroke: new ol.style.Stroke({
                        color: 'green',
                        width: 3
                    })
                })],
            'MultiPolygon': [new ol.style.Style({
                    stroke: new ol.style.Stroke({
                        color: 'yellow',
                        width: 1
                    }),
                    fill: new ol.style.Fill({
                        color: 'rgba(255, 255, 0, 0.1)'
                    })
                })],
            'Polygon': [new ol.style.Style({
                    stroke: new ol.style.Stroke({
                        color: 'blue',
                        lineDash: [4],
                        width: 3
                    }),
                    fill: new ol.style.Fill({
                        color: 'rgba(0, 0, 255, 0.1)'
                    })
                })],
            'GeometryCollection': [new ol.style.Style({
                    stroke: new ol.style.Stroke({
                        color: 'magenta',
                        width: 2
                    }),
                    fill: new ol.style.Fill({
                        color: 'magenta'
                    }),
                    image: new ol.style.Circle({
                        radius: 10,
                        fill: null,
                        stroke: new ol.style.Stroke({
                            color: 'magenta'
                        })
                    })
                })],
            'Circle': [new ol.style.Style({
                    stroke: new ol.style.Stroke({
                        color: 'red',
                        width: 5
                    }),
                    fill: new ol.style.Fill({
                        color: 'rgba(255,0,0,0.2)'
                    })
                })]
        };

        var styleFunction = function (feature, resolution) {
                return styles[feature.getGeometry().getType()];
        };	
		

		var styles1 = {'LineString': [new ol.style.Style({
                    stroke: new ol.style.Stroke({
                        color: 'red',
                        width: 2
                    })
                })]};

        var styleFunction1 = function (feature, resolution) {
                return styles1[feature.getGeometry().getType()];
        };	
			
		  
			function capturar_click_origen(){
				alert('Click sobre el mapa para capturar coordenadas de partida');
				map.once('click', function(evt) {
					var lng = evt.coordinate[0].toFixed(6);
					var lat = evt.coordinate[1].toFixed(6);
					document.getElementById("cor_origen").value=lng+' '+lat;
					var marcStyle = new ol.style.Style({
							image: new ol.style.Icon(({
								anchor: [0.2, 0.5],
								src: "https://norfipc.com/img/icon/marker-icon.png"
							}))
						});
					var marcador1 = new ol.layer.Vector({
					  source: new ol.source.Vector({
						features: [new ol.Feature({
						  geometry: new ol.geom.Point([lng, lat])              
							  })]
						  }), style: [marcStyle]
					  });  
					 map.addLayer(marcador1);
					});
					
			}
			
			function capturar_click_destino(){
				alert('Click sobre el mapa para capturar coordenadas de destino');
				map.once('click', function(evt) {
					var lng = evt.coordinate[0].toFixed(6);
					var lat = evt.coordinate[1].toFixed(6);
					document.getElementById("cor_destino").value=lng+' '+lat;
					var marcStyle = new ol.style.Style({
							image: new ol.style.Icon(({
								anchor: [0.2, 0.5],
								src: "https://norfipc.com/img/icon/marker-icon.png"
							}))
						});
					 var marcador2 = new ol.layer.Vector({
					  source: new ol.source.Vector({
						features: [new ol.Feature({
						  geometry: new ol.geom.Point([lng, lat])
											})]
						  }), style: [marcStyle]
					  });  
					 map.addLayer(marcador2);
					
					});
			}
			
 
			function calcular_ruta_click () {
				var cor_origen= document.getElementById("cor_origen").value;
				var cor_destino= document.getElementById("cor_destino").value;
				
				var vectorruta = new ol.source.Vector({
									 url: 'consultas.php?caso=ruta_por_click&origen='+cor_origen+'&destino='+cor_destino,
									 format: new ol.format.GeoJSON()
								  });

				var layer_ruta = new ol.layer.Vector({
						  source: vectorruta,
						  style: styleFunction
					  });
					  
				map.addLayer(layer_ruta);
				//  Esta función cambia el Zoom del despliegue del mapa al tamaño de la ruta creada
				
				setTimeout(function(){
					var extent = vectorruta.getExtent();
					  map.getView().fit(extent, map.getSize());
				}, 500);
				
			}
			
			function calcular_ruta_click1 () {
				var cor_origen= document.getElementById("cor_origen").value;
				var cor_destino= document.getElementById("cor_destino").value;
				
				var vectorruta = new ol.source.Vector({
									 url: 'consultas.php?caso=ruta_por_click1&origen='+cor_origen+'&destino='+cor_destino,
									 format: new ol.format.GeoJSON()
								  });

				var layer_ruta = new ol.layer.Vector({
						  source: vectorruta,
						  style: styleFunction1
					  });
					  
				map.addLayer(layer_ruta);
				//  Esta función cambia el Zoom del despliegue del mapa al tamaño de la ruta creada
				
				setTimeout(function(){
					var extent = vectorruta.getExtent();
					  map.getView().fit(extent, map.getSize());
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
						  source: vector_nodo,
						  style: styleFunction
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
							alert('Distancia de la ruta: '+data+' Km');
							
							},
							error : function(XMLHttpRequest, textStatus, errorThrown) {
							// Display error
							}
					});
			}
			
			function dist_euclediana_click1(){
				var cor_origen= document.getElementById("cor_origen").value;
				var cor_destino= document.getElementById("cor_destino").value;
				
				$.ajax({
						type : 'GET',
						url : 'consultas.php?caso=dist_eucl_click1&origen='+cor_origen+'&destino='+cor_destino,
						dataType : 'json',
						success : function(data){
							alert('Distancia de la ruta: '+data+' Km');
							
							},
							error : function(XMLHttpRequest, textStatus, errorThrown) {
							// Display error
							}
					});
			}
			
			function media_click(){
				var cor_origen= document.getElementById("cor_origen").value;
				var cor_destino= document.getElementById("cor_destino").value;
				
				$.ajax({
						type : 'GET',
						url : 'consultas.php?caso=media_click&origen='+cor_origen+'&destino='+cor_destino,
						dataType : 'text',
						success : function(data){
							alert('Estado superficial de la vía: '+data);
							
							},
							error : function(XMLHttpRequest, textStatus, errorThrown) {
							// Display error
							}
					});
			}
			
			function media_click1(){
				var cor_origen= document.getElementById("cor_origen").value;
				var cor_destino= document.getElementById("cor_destino").value;
				
				$.ajax({
						type : 'GET',
						url : 'consultas.php?caso=media_click1&origen='+cor_origen+'&destino='+cor_destino,
						dataType : 'text',
						success : function(data){
							alert('Estado superficial de la vía: '+data);
							
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