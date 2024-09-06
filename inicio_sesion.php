<html lang="en">
<head>
    <meta charset="UTF-8">
	
	<title>Login</title>
	
	<meta charset="utf-8">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="estilos.css"
	
</head>
<body>

<?php 
    include("includes/header1.php")
?>

<?php
include 'conexion1.php'; // Se incluye el archivo de conexión a la base de datos
$dbcon = conexion(); // se crea una variable con la función definida anteriormente
session_start(); // se inicia una sesión
echo '	
	<form method="post" action="inicio_sesion.php">
	<div class="panel panel-primary">
		<div class="panel-heading text-center">
			<h2>Inisiar Sesión</h2>
		</div>
        <form name="loginform" id="loginform" action="" method="POST">
		<div class="panel-body">
			<h4 align="left">Usuario: </h4>
			<input type="text" name="username" id="username" value="" size="20" class="form-control" placeholder="usuario
			"><br>
			<h4 align="left">Contraseña: </h4>
			<input type="password" id="password" value="" size="20" class="form-control" name="password" placeholder="contraseña">
		</div>
		<div class="panel-footer">
            
            <input type="submit" name="login" class="btn btn-primary" value="Ingresar">
			
            <button class="btn btn-warning"><a href="register.php" style="color:white">Registrarse</a></button>
		</div>
	</div>
	</form>'; //Se define un formulario de inicio de sesión en HTML 

if(isset($_POST['login'])){ //De acuerdo con el formulario definido aquí, se ejecuta cuando presionamos el botón login 
    $L_usuario=$_POST['username']; // Guarda la variable usuario definida en el formulario
	$L_pass=md5($_POST['password']); //Guarda la variable pwd definida en el formulario (codificamos la contraseña en MD5)
//  Validación de la existencia de los usuarios 	
	if (!empty($L_usuario) && !empty($L_pass)){ // Se consulta que no exista ningún campo vacío
		$sql =" SELECT username, password, rol FROM usertbl WHERE username='$L_usuario';"; // Consulta de usuario en SQL
		$resultado = pg_query($dbcon, $sql); // Se ejecuta la consulta en PostgreSQL con la conexión definida anteriormente
		if($row = pg_fetch_array($resultado)){ // se estructura el resultado en matriz
			if($row["password"] == $L_pass){ // Valida la contraseña de la base de datos y la digitada por el usuario  
			   $_SESSION['username'] = $row['usuario']; //se define el parametro usuario en la sesion creada
			   $_SESSION['rol'] = $row['rol']; //se define el parametro rol en la sesion creada
				   echo '<script language="javascript">'; 
				   echo 'location.href = "index.php";'; //se define el redireccionamiento de la pagina de inicio en javascript
				   echo '</script>';			   
			}else{
			   echo 'Contraseña Incorrecta'; // Si la contraseña de la base de datos no es igual a la digitada por el usuario, retorna un mensaje en HTML
			}
		}else{
		  echo 'Usuario no existente en la base de datos'; // Cuando la consulta en base de datos no retorna ningún valor, se debe a que no existe el usuario retornando un mensaje en HTML
		}
		
	}else{
		echo 'Inicio Sesión Fallido, Campos vacíos'; // Si existe algún campo vacío, retorna el mensaje en HTML
	}
}
?>

 
 </body>
</html>
