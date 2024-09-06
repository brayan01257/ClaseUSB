<?php
session_start(); // se inicia una sesión
session_destroy(); // se destruye la sesión 
echo 'Ha Terminado La Session,'; //Mensaje en HTML
echo ' <p><a href="inicio_sesion.php">Iniciar Sesion</a></p>'; // Enlace de inicio de sesión en HTML
?>
