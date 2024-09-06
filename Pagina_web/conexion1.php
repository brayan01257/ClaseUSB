<?php
function conexion(){
$host = 'awsdos.cnma9jlyi8t6.us-east-1.rds.amazonaws.com';
$port = '5432';
$base_datos = 'proyecto';
$usuario = 'postgres';
$pass = 'brayan01257';
$conexion = pg_connect("host=$host port=$port dbname=$base_datos 
			user=$usuario password=$pass")
            or die("Error de Conexion".pg_last_error());
			
	if (!$conexion){
		echo   "Error de Conexion".pg_last_error();
	} else {
		echo "<h3>Conexion Exitosa PHP - PostgreSQL</h3><hr>";
	
return($conexion);
}
}
//conexion() // Descomente esta linea para probar la conexión, luego comente otra vez
?>