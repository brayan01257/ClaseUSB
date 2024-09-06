<?php

//********  RUTINA DE ACCESO AL SISTEMA
		session_start(); // se inicia una sesión

		$rol = $_SESSION['rol'];

		if (isset($_SESSION['usuario'])) { // Se verifica que exista el parametro usuario en la seccion creada cuando se inicia sesión

			if ($rol=='admin'){
				echo 'Bienvenido, adminstrador: '; // Mensaje en HTML
				echo '<b>'.$_SESSION['usuario'].'</b>.'; // Mensaje del nombre de usuario en HTML
				echo '<p><a href="salir.php">Salir</a></p>'; // Enlace de salida en HTML
			}
			else{
				echo '<p>Bienvenido, usuario: '; // Mensaje en HTML
				echo '<b>'.$_SESSION['usuario'].'</b>. -- ('; // Mensaje del nombre de usuario en HTML
				echo '<a href="salir.php">Salir</a>)</p>'; // Enlace de salida en HTML
		}}
?>
	