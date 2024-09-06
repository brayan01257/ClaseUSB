<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.6.0/leaflet.css" />
		
		<script src="jquery-3.4.1.js"></script>  <!-- plugin jquery -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.6.0/leaflet.js"></script>
		
		<style>
		html, body{
		height:100% ;
		width:100% vw;
		}
		
		#map{
		width:300px;
		float:right;
		height:300px;
		border-radius:0 7px 7px 0;
		margin-top:100px;
		position:absolute;
		bottom:0;
		right:0;
		}
		
		#formulario{
		width:59px;
		height:699.400px;
		float:left;
		margin-top:15px;
		position:absolute;
		left:130px;
		}
		
		#franja{
		width: 100%;
		position: fixed;
		top: 0;
		left: 0;
		height: 60px;
		background-color: #313B44;
		border-bottom: 6px black solid;
		}
		
		header{
		position: relative;
		width: 100%;
		margin: 0 auto;
		font-family: titulares_light;
		font-size: 35px;
		color: white;
		}
			
		nav li {
		list-style: none;
		display: inline-block;
		padding: 4px 120px;
		text-align: center;
		}
		
		#cerrar{
		position: fixed;
		top: 0;
		left: 1200;
		height: 60px;
		border-bottom: 6px black solid;
		color: white;
		font-size: 20px;
		}
		

		</style>
		
		<title>Estado de las vias - EsvGIS</title>
	</head>
	
	<body>
		<div id="franja">
		<header>
			<img src="img/caras1.png" width="50px" height="60px" align="center"><a href="index_pgweb.html" title="Inicio" style="color:white">   EsvGIS</a>
		</header>
        </div>
		<div id="cerrar" align="center">
		<p> Bienvenido, <?php echo $rol; ?> <a href='salir.php' style="color:white">Cerrar Sesion</a></p> 
		</div>