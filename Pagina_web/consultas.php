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
					$sql= "SELECT row_to_json(fc) as geojson
					FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
					FROM (SELECT 'Feature' As type
						, ST_AsGeoJSON(lg.the_geom)::json As geometry
						, row_to_json((SELECT l FROM (SELECT id, highway, name, est, est_name, reverse_cost) As l
						)) As properties
					FROM (
					
						select vias_noded.id, vias_noded.highway, vias_noded.name, vias_noded.est, vias_noded.est_name, vias_noded.reverse_cost, agg_cost, vias_noded.the_geom from 
						pgr_dijkstra 
							('select id, 
							source, target, 
							reverse_cost as cost
							from vias_noded',
							(select t1.id from (
								SELECT nodos.id, 
								ST_Distance(ST_GeomFromText('POINT($origen)',4326),nodos.geom) as dist 
								from (select distinct(source) as id, st_startpoint(ST_GeometryN(the_geom,1)) as geom from vias_noded 
								union
								select distinct(target) as id, st_endpoint(ST_GeometryN(the_geom,1)) as geom  from vias_noded ) as nodos 
								order by  dist asc limit 1) as t1
							),(select t1.id from (
								SELECT nodos.id, 
								ST_Distance(ST_GeomFromText('POINT($destino)',4326),nodos.geom) as dist 
								from (select distinct(source) as id, st_startpoint(ST_GeometryN(the_geom,1)) as geom from vias_noded 
								union
								select distinct(target) as id, st_endpoint(ST_GeometryN(the_geom,1)) as geom  from vias_noded ) as nodos 
								order by  dist asc limit 1) as t1
							), directed := true)
						,vias_noded where vias_noded.id = edge
						
					) As lg   ) As f )  As fc;
					";
			$resultado = pg_query($dbcon, $sql);
			$row = pg_fetch_array($resultado);
			echo $row['geojson'];
			break;
			
		case 'ruta_por_click1':
					$sql= "SELECT row_to_json(fc) as geojson
					FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
					FROM (SELECT 'Feature' As type
						, ST_AsGeoJSON(lg.the_geom)::json As geometry
						, row_to_json((SELECT l FROM (SELECT id, highway, name, est, est_name, reverse_cost) As l
						)) As properties
					FROM (
					
						select vias_noded.id, vias_noded.highway, vias_noded.name, vias_noded.est, vias_noded.est_name, vias_noded.reverse_cost, agg_cost, vias_noded.the_geom from 
						pgr_dijkstra
							('select id, 
							source, target, 
							reverse_cost as cost
							from vias_noded',
							(select t1.id from (
								SELECT nodos.id, 
								ST_Distance(ST_GeomFromText('POINT($origen)',4326),nodos.geom) as dist 
								from (select distinct(source) as id, st_startpoint(ST_GeometryN(the_geom,1)) as geom from vias_noded 
								union
								select distinct(target) as id, st_endpoint(ST_GeometryN(the_geom,1)) as geom  from vias_noded ) as nodos 
								order by  dist asc limit 1) as t1
							),(select t1.id from (
								SELECT nodos.id, 
								ST_Distance(ST_GeomFromText('POINT($destino)',4326),nodos.geom) as dist 
								from (select distinct(source) as id, st_startpoint(ST_GeometryN(the_geom,1)) as geom from vias_noded 
								union
								select distinct(target) as id, st_endpoint(ST_GeometryN(the_geom,1)) as geom  from vias_noded ) as nodos 
								order by  dist asc limit 1) as t1
							), directed := false)
						,vias_noded where vias_noded.id = edge
						
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
								, ST_AsGeoJSON(lg.the_geom)::json As geometry
								, row_to_json((SELECT l FROM (SELECT id) As l
								)) As properties
							FROM (
							
								select t1.id,t1.the_geom from (
								SELECT nodos.id, 
									ST_Distance(ST_geomFromText('POINT($origen)',4326),nodos.the_geom) as dist, nodos.the_geom
									from (select distinct(source) as id, st_startpoint(ST_geometryN(the_geom,1)) as the_geom from vias_noded 
									union
									select distinct(target) as id, st_endpoint(ST_geometryN(the_geom,1)) as the_geom  from vias_noded ) as nodos 
									order by  dist asc limit 1) as t1
							union 
							select t1.id,t1.the_geom from (
								SELECT nodos.id, 
									ST_Distance(ST_geomFromText('POINT($destino)',4326),nodos.the_geom) as dist, nodos.the_geom
									from (select distinct(source) as id, st_startpoint(ST_geometryN(the_geom,1)) as the_geom from vias_noded 
									union
									select distinct(target) as id, st_endpoint(ST_geometryN(the_geom,1)) as the_geom  from vias_noded ) as nodos 
									order by  dist asc limit 1) as t1

					) As lg   ) As f )  As fc;
					";
			$resultado = pg_query($dbcon, $sql);
			$row = pg_fetch_array($resultado);
			echo $row['geojson'];
			break;		
		
		case 'dist_eucl_click':
                $sql= " select  sum(st_length(ST_Transform(vias_noded.the_geom, 3115)))/1000 as dist, AVG(est) as media from 
						pgr_dijkstra 
							('select id, 
							source, target, 
							st_length(the_geom) as cost
							from vias_noded',
							(select t1.id from (
								SELECT nodos.id, 
								ST_Distance(ST_GeomFromText('POINT($origen)',4326),nodos.geom) as dist 
								from (select distinct(source) as id, st_startpoint(ST_GeometryN(the_geom,1)) as geom from vias_noded 
								union
								select distinct(target) as id, st_endpoint(ST_GeometryN(the_geom,1)) as geom  from vias_noded ) as nodos 
								order by  dist asc limit 1) as t1
							),(select t1.id from (
								SELECT nodos.id, 
								ST_Distance(ST_GeomFromText('POINT($destino)',4326),nodos.geom) as dist 
								from (select distinct(source) as id, st_startpoint(ST_GeometryN(the_geom,1)) as geom from vias_noded 
								union
								select distinct(target) as id, st_endpoint(ST_GeometryN(the_geom,1)) as geom  from vias_noded ) as nodos 
								order by  dist asc limit 1) as t1
							), directed := true)
						,vias_noded where vias_noded.id = edge;
				";
		$resultado = pg_query($dbcon, $sql);
		$row = pg_fetch_array($resultado);
		echo $row['dist'];
        break;
		
		case 'dist_eucl_click1':
                $sql= " select  sum(st_length(ST_Transform(vias_noded.the_geom, 3115)))/1000 as dist, AVG(est) as media from 
						pgr_dijkstra 
							('select id, 
							source, target, 
							st_length(the_geom) as cost
							from vias_noded',
							(select t1.id from (
								SELECT nodos.id, 
								ST_Distance(ST_GeomFromText('POINT($origen)',4326),nodos.geom) as dist 
								from (select distinct(source) as id, st_startpoint(ST_GeometryN(the_geom,1)) as geom from vias_noded 
								union
								select distinct(target) as id, st_endpoint(ST_GeometryN(the_geom,1)) as geom  from vias_noded ) as nodos 
								order by  dist asc limit 1) as t1
							),(select t1.id from (
								SELECT nodos.id, 
								ST_Distance(ST_GeomFromText('POINT($destino)',4326),nodos.geom) as dist 
								from (select distinct(source) as id, st_startpoint(ST_GeometryN(the_geom,1)) as geom from vias_noded 
								union
								select distinct(target) as id, st_endpoint(ST_GeometryN(the_geom,1)) as geom  from vias_noded ) as nodos 
								order by  dist asc limit 1) as t1
							), directed := false)
						,vias_noded where vias_noded.id = edge;
				";
		$resultado = pg_query($dbcon, $sql);
		$row = pg_fetch_array($resultado);
		echo $row['dist'];
        break;
		
		case 'media_click':
                $sql= "select ROUND(avg(est), 3) as media, CASE WHEN avg(est)>='1' and avg(est)<='1.667' THEN 'La ruta se encuentra en Buen estado' 
	           when avg(est)>'1.667' and avg(est)<='2.334' then 'Ten precaución, la ruta se encuentra en estado Regular'
			   when avg(est)>'2.334' and avg(est)<='3' then 'Ten precaución o toma una ruta alterna, la ruta se encuentra en Mal estado'
			   else ''	
	     	   end as estado from 
						pgr_dijkstra 
							('select id, 
							source, target, 
							st_length(the_geom) as cost
							from vias_noded',
							(select t1.id from (
								SELECT nodos.id, 
								ST_Distance(ST_GeomFromText('POINT($origen)',4326),nodos.geom) as dist 
								from (select distinct(source) as id, st_startpoint(ST_GeometryN(the_geom,1)) as geom from vias_noded 
								union
								select distinct(target) as id, st_endpoint(ST_GeometryN(the_geom,1)) as geom  from vias_noded ) as nodos 
								order by  dist asc limit 1) as t1
							),(select t1.id from (
								SELECT nodos.id, 
								ST_Distance(ST_GeomFromText('POINT($destino)',4326),nodos.geom) as dist 
								from (select distinct(source) as id, st_startpoint(ST_GeometryN(the_geom,1)) as geom from vias_noded 
								union
								select distinct(target) as id, st_endpoint(ST_GeometryN(the_geom,1)) as geom  from vias_noded ) as nodos 
								order by  dist asc limit 1) as t1
							), directed := true)
						,vias_noded where vias_noded.id = edge;
				";
		$resultado = pg_query($dbcon, $sql);
		$row = pg_fetch_array($resultado);
		echo $row['estado'];
        break;
		
		case 'media_click1':
                $sql= "select ROUND(avg(est), 3) as media, CASE WHEN avg(est)>='1' and avg(est)<='1.667' THEN 'La ruta se encuentra en Buen estado' 
	           when avg(est)>'1.667' and avg(est)<='2.334' then 'Ten precaución, la ruta se encuentra en estado Regular'
			   when avg(est)>'2.334' and avg(est)<='3' then 'Ten precaución o toma una ruta alterna, la ruta se encuentra en Mal estado'
			   else ''	
	     	   end as estado from 
						pgr_dijkstra 
							('select id, 
							source, target, 
							st_length(the_geom) as cost
							from vias_noded',
							(select t1.id from (
								SELECT nodos.id, 
								ST_Distance(ST_GeomFromText('POINT($origen)',4326),nodos.geom) as dist 
								from (select distinct(source) as id, st_startpoint(ST_GeometryN(the_geom,1)) as geom from vias_noded 
								union
								select distinct(target) as id, st_endpoint(ST_GeometryN(the_geom,1)) as geom  from vias_noded ) as nodos 
								order by  dist asc limit 1) as t1
							),(select t1.id from (
								SELECT nodos.id, 
								ST_Distance(ST_GeomFromText('POINT($destino)',4326),nodos.geom) as dist 
								from (select distinct(source) as id, st_startpoint(ST_GeometryN(the_geom,1)) as geom from vias_noded 
								union
								select distinct(target) as id, st_endpoint(ST_GeometryN(the_geom,1)) as geom  from vias_noded ) as nodos 
								order by  dist asc limit 1) as t1
							), directed := true)
						,vias_noded where vias_noded.id = edge;
				";
		$resultado = pg_query($dbcon, $sql);
		$row = pg_fetch_array($resultado);
		echo $row['estado'];
        break;

	}
?>

		