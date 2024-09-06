<?php
include 'conexion_db.php'; // Se incluye el archivo de conexión a la base de datos
$dbcon = conexion(); // se crea una variable con la función definida anteriormente
header('Content-Type: application/json');

	$caso=$_GET['caso'];
	$origen=$_GET['origen'];
	$destino=$_GET['destino'];
	switch ($caso) {
   
		
    case 'ejemplo':
                $sql= " 
				SELECT row_to_json(fc) as geojson
		FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
		 FROM (SELECT 'Feature' As type
			, ST_AsGeoJSON(lg.geom)::json As geometry
			, row_to_json((SELECT l FROM (SELECT gid,tramo,inicio,llegada) As l
			  )) As properties
		  FROM ( select * from vias_wgs84

				   ) As lg   ) As f )  As fc;
				";
		$resultado = pg_query($dbcon, $sql);
		$row = pg_fetch_array($resultado);
		echo $row['geojson'];
        break;
		


}
?>