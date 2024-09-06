<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>

<?php
include 'conexion_db.php'; // Se incluye el archivo de conexión a la base de datos
$dbcon = conexion(); // se crea una variable con la función definida anteriormente
echo '	<form method="post" action="registro.php">
			<table>
				<tr>
					<th>Usuario</th>
					<th><input type="text" name="R_usuario" /></th>
				</tr>
				<tr>
					<th>Nombre</th>
					<th><input type="text" name="R_nombre" /></th>
				</tr>
				<tr>
					<th>Apellidos</th>
					<th><input type="text" name="R_apellidos" /></th>
				</tr>
				<tr>
					<th>Contraseña</th>
					<th><input type="password" name="R_pass" /></th>
				</tr>
				<tr>
					<th></th>
					<th><input name="registro" type="submit" value="Registrar"  /></th>
				</tr>
			</table>
		</form>'; //Se define un formulario de registro en HTML 
		

if(isset($_POST['registro'])){ //De acuerdo con el formulario definido aquí se ejecuta cuando presionamos el botón registro 
    $R_usuario=$_POST['R_usuario']; // Se guarda en una variable cada entrada definida en el formulario
	$R_nombre=$_POST['R_nombre']; // Se guarda en una variable cada entrada definida en el formulario
	$R_apellidos=$_POST['R_apellidos']; // Se guarda en una variable cada entrada definida en el formulario
	$R_pass=md5($_POST['R_pass']); // Se guarda en una variable cada entrada definida en el formulario (codificamos la contraseña en MD5)
	
	if (!empty($R_usuario) && !empty($R_nombre) && !empty($R_apellidos) && !empty($R_pass)){ // Se consulta que no exista ningún campo vacío
		$sql ="INSERT INTO usuarios(usuario, nombre, apellidos,contrasena,rol) VALUES('$R_usuario', '$R_nombre', '$R_apellidos','$R_pass','usuario');"; // Ingreso de registro en SQL (parametros de usuario)
		$resultado = pg_query($dbcon, $sql); // Se ejecuta la consulta en PostgreSQL con la conexión definida anteriormente

		if(pg_affected_rows($resultado)==1){ //Si el registro es exitoso, retorna el valor de 1
			echo '<p>Registro exitoso</p>'; // Mensaje de salida en HTML
			echo '<p><a href="inicio_sesion.php">Inicio Sesion</a></p>'; // Mensaje de salida en HTML
		}else{
			echo 'Registro Fallido, Usuario no disponible'; // Si el registro no es exitoso, retorna el mensaje en HTML
		}	
	}else{
		echo 'Registro Fallido, Campos vacíos'; // Si existe algún campo vacío, retorna el mensaje en HTML
	}
}
?>


 
 </body>
</html>
