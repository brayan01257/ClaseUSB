<?php

	include ("conexion1.php");
	$dbcon = conexion();
?>

<?php
    include("includes/meta.php")
        
?>

<?php 
    include("includes/header1.php")
?>


<?php if (!empty($message)) {echo "<p class=\"error\">" . "Mensaje: ". $message . "</p>";} ?>

<div class="container mregister">
    <div id="login" class="panel panel-primary">
        <div class="panel-heading text-center">
             <h2>Registrarse</h2>
        </div>
        
        <form name="registerform" id="registerform" action="register.php" method="post">
        <div class="panel-body">
            <h4 align="left">Nombre Completo</h4>
            <input type="text" name="full_name" id="full_name" class="form-control" size="32" value="" placeholder="Nombre completo"><br>
        
            <h4 align="left">Email</h4>
            <input type="email" name="email" id="email" class="form-control" size="32" value="" placeholder="Correo electronico"><br>

            <h4 align="left">Nombre de Usuario</h4>
            <input type="text" name="username" id="username" class="form-control" size="32" value="" placeholder="Usuario"><br>

            <h4 align="left">Contraseña</h4>
            <input type="password" name="password" id="password" class="form-control" size="32" value="" placeholder="Contraseña"><br>
        </div>
        <div class="panel-footer">
            <input type="submit" name="register" id="regiter" class="btn btn-warning" value="Registrarse"><br><br>
        
            <p class="regtext">Ya tienes una cuenta? <a href="inicio_sesion.php" >Entra Aquí!</a>!</p>
            </form>
        </div>

    </div>
</div>

<?php

if(isset($_POST['register'])){ //De acuerdo con el formulario definido aquí se ejecuta cuando presionamos el botón registro 
    $R_usuario=$_POST['full_name']; // Se guarda en una variable cada entrada definida en el formulario
	$R_nombre=$_POST['email']; // Se guarda en una variable cada entrada definida en el formulario
	$R_apellidos=$_POST['username']; // Se guarda en una variable cada entrada definida en el formulario
	$R_pass=md5($_POST['password']); // Se guarda en una variable cada entrada definida en el formulario (codificamos la contraseña en MD5)
	
	if (!empty($R_usuario) && !empty($R_nombre) && !empty($R_apellidos) && !empty($R_pass)){ // Se consulta que no exista ningún campo vacío
		$sql ="INSERT INTO usertbl(full_name, email, username, password,rol) VALUES('$R_usuario', '$R_nombre', '$R_apellidos', '$R_pass','$R_usuario');"; // Ingreso de registro en SQL (parametros de usuario)
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
