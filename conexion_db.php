<?php
function conexion(){
$host = 'awsdos.cnma9jlyi8t6.us-east-1.rds.amazonaws.com';
$port = '5432';
$base_datos = 'proyecto';
$usuario = 'postgres';
$pass = 'brayan01257';
$conexion = pg_connect("host=$host port=$port dbname=$base_datos user=$usuario password=$pass");
return($conexion);
}
conexion('Conexion exitosa');
?>