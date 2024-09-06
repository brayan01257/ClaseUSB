<?php

$conn = new PDO('pgsql:host=awsdos.cnma9jlyi8t6.us-east-1.rds.amazonaws.com;dbname=proyecto','postgres','brayan01257');

//conexion() // Descomente esta linea para probar la conexión, luego comente otra vez
$caso=$_GET['caso'];
			
		$sql1 = "Select
		 min(r.seq) as seq,
		 e.gid as id,
		 e.name,
		 e.highway,
		 sum(e.reverse_cost) as distance,
		 ST_Collect(e.the_geom) as geom, ST_AsGeoJSON(the_geom,10)
		from
		 pgr_dijkstra('SELECT gid AS id,
								 source::integer,
								 target::integer,
								 reverse_cost::double precision AS cost
								FROM vias',(select t1.id from (
										SELECT nodos.id, 
										ST_Distance(ST_GeomFromText('POINT($origen)',4326),nodos.geom) as dist 
										from (select distinct(source) as id, st_startpoint(ST_GeometryN(the_geom,1)) as geom from vias 
										union
										select distinct(target) as id, st_endpoint(ST_GeometryN(the_geom,1)) as geom  from vias ) as nodos 
										order by  dist asc limit 1) as t1
									),
								(select t1.id from (
										SELECT nodos.id, 
										ST_Distance(ST_GeomFromText('POINT($destino)',4326),nodos.geom) as dist 
										from (select distinct(source) as id, st_startpoint(ST_GeometryN(the_geom,1)) as geom from vias 
										union
										select distinct(target) as id, st_endpoint(ST_GeometryN(the_geom,1)) as geom  from vias ) as nodos 
										order by  dist asc limit 1) as t1
									), false) as r,
		 vias as e
		 where r.edge=e.gid
		 group by e.gid, e.name, e.highway";
		 

		$rs = $conn->query($sql1);


		$geojson = array(
		   'type'      => 'FeatureCollection',
		   'features'  => array()
		);

		while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
			$properties = $row;
			# Remove geojson and geometry fields from properties
			unset($properties['geojson']);
			unset($properties['the_geom']);
			$feature = array(
				 'type' => 'Feature',
				 'geometry' => json_decode($row['st_asgeojson'], true),
				 'properties' => $properties
			);
			# Add feature arrays to feature collection array
			array_push($geojson['features'], $feature);
		}

		header('Content-type: application/json');
		echo json_encode($geojson, JSON_NUMERIC_CHECK);
		$conn = NULL;

?>