<?php
include 'conexion_db.php'; // Se incluye el archivo de conexión a la base de datos
$dbcon = conexion(); // se crea una variable con la función definida anteriormente
//header('Content-Type: application/json');

// Lectura de las variables enviadas desde el index.php dentro de la URL de la función
	$caso=$_GET['caso'];
	$origen=$_GET['origen'];
	$destino=$_GET['destino'];


	switch ($caso) {
			
		case 'ruta_por_click':
					$sql= " SELECT row_to_json(fc) as geojson
					FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
					FROM (SELECT 'Feature' As type
						, ST_AsGeoJSON(lg.geom)::json As geometry
						, row_to_json((SELECT l FROM (SELECT gid, inicio, llegada) As l
						)) As properties
					FROM (
					
						select vias_wgs84.gid, vias_wgs84.inicio, vias_wgs84.llegada,
						vias_wgs84.geom from 
						pgr_dijkstra 
							('select gid as id, 
							source, target, 
							st_length(geom) as cost
							from vias_wgs84',
							(select t1.id from (
								SELECT nodos.id, 
								ST_Distance(ST_GeomFromText('POINT($origen)',4326),nodos.geom) as dist 
								from (select distinct(source) as id, st_startpoint(ST_GeometryN(geom,1)) as geom from vias_wgs84 
								union
								select distinct(target) as id, st_endpoint(ST_GeometryN(geom,1)) as geom  from vias_wgs84 ) as nodos 
								order by  dist asc limit 1) as t1
							),(select t1.id from (
								SELECT nodos.id, 
								ST_Distance(ST_GeomFromText('POINT($destino)',4326),nodos.geom) as dist 
								from (select distinct(source) as id, st_startpoint(ST_GeometryN(geom,1)) as geom from vias_wgs84 
								union
								select distinct(target) as id, st_endpoint(ST_GeometryN(geom,1)) as geom  from vias_wgs84 ) as nodos 
								order by  dist asc limit 1) as t1
							), false)
						,vias_wgs84 where vias_wgs84.gid = edge
						
					) As lg   ) As f )  As fc;
					";
			$resultado = pg_query($dbcon, $sql);
			$row = pg_fetch_array($resultado);
			echo $row['geojson'];
			break;
			
		case 'nodos_por_click':
					$sql= " SELECT row_to_json(fc) as geojson
							FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
							FROM (SELECT 'Feature' As type
								, ST_AsGeoJSON(lg.geom)::json As geometry
								, row_to_json((SELECT l FROM (SELECT id) As l
								)) As properties
							FROM (
							
								select t1.id,t1.geom from (
								SELECT nodos.id, 
									ST_Distance(ST_GeomFromText('POINT($origen)',4326),nodos.geom) as dist, nodos.geom
									from (select distinct(source) as id, st_startpoint(ST_GeometryN(geom,1)) as geom from vias_wgs84 
									union
									select distinct(target) as id, st_endpoint(ST_GeometryN(geom,1)) as geom  from vias_wgs84 ) as nodos 
									order by  dist asc limit 1) as t1
							union 
							select t1.id,t1.geom from (
								SELECT nodos.id, 
									ST_Distance(ST_GeomFromText('POINT($destino)',4326),nodos.geom) as dist, nodos.geom
									from (select distinct(source) as id, st_startpoint(ST_GeometryN(geom,1)) as geom from vias_wgs84 
									union
									select distinct(target) as id, st_endpoint(ST_GeometryN(geom,1)) as geom  from vias_wgs84 ) as nodos 
									order by  dist asc limit 1) as t1

					) As lg   ) As f )  As fc;
					";
			$resultado = pg_query($dbcon, $sql);
			$row = pg_fetch_array($resultado);
			echo $row['geojson'];
			break;		
		
		case 'dist_eucl_click':
                $sql= " 
				// SELECT ST_Distance(
				   // ST_GeomFromText(
				       // ST_Transform('POINT($origen)',4326),3115),
				   // ST_GeomFromText(
				       // ST_Transform('POINT($destino)',4326),3115)
					   // ) as dist
					   
				SELECT ST_Distance(
					ST_Transform('SRID=4326;POINT($origen)'::geometry, 3115),
					ST_Transform('SRID=4326;POINT($destino)'::geometry, 3115)
				);
				";
		$resultado = pg_query($dbcon, $sql);
		$row = pg_fetch_array($resultado);
		echo $row['dist'];
        break;

	}
?>

		