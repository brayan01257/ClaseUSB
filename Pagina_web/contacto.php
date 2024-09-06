<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de contacto</title>
  <link rel="stylesheet" href="css/estilosco.css">

  <!-- Enlace al documento css. no aplicable en codepen.
  <link rel="stylesheet" type="text/css" href="contact-form.css">
-->
  
  <style>
  		
		#franja{
		width: 100%;
		position: fixed;
		top: 0;
		left: 0;
		height: 60px;
		background-color: #313B44;
		border-bottom: 6px black solid;
		}
		
		header{
		position: fixed;
		top: 6px;
		width: 100%;
		margin: 0 auto;
		font-family: titulares_light;
		font-size: 35px;
		color: white;
		}
		
		header a{
		text-decoration: none;
		}
  </style>
  
  </head>


<body>

<?php

	include ("conexion1.php");
	$dbcon = conexion();
?>

  <div id="franja"></div>
		<header>
			<img src="caras1.png" width="50px" height="60px" align="center"><a href="index_pgweb.html" title="Inicio" style="color:white">   EsvGIS</a>
		</header>
  
  <!-- formulario de contacto en html y css -->  

<?php if (!empty($message)) {echo "<p class=\"error\">" . "Mensaje: ". $message . "</p>";} ?>

  <div class="contact_form">

    <div class="formulario">      
      <h1>Formulario de contacto</h1>
        <h3>Escríbenos y en breve los pondremos en contacto contigo</h3>


          <form action="contacto.php" method="post">       

            
                <p>
                  <label for="nombre" class="colocar_nombre">Nombre
                    <span class="obligatorio">*</span>
                  </label>
                    <input type="text" name="introducir_nombre" id="nombre" required="obligatorio" placeholder="Escribe tu nombre">
                </p>
              
                <p>
                  <label for="email" class="colocar_email">Email
                    <span class="obligatorio">*</span>
                  </label>
                    <input type="email" name="introducir_email" id="email" required="obligatorio" placeholder="Escribe tu Email">
                </p>
            
                <p>
                  <label for="telefone" class="colocar_telefono">Teléfono
                  </label>
                    <input type="tel" name="introducir_telefono" id="telefono" placeholder="Escribe tu teléfono">
                </p>         
              
                <p>
                  <label for="mensaje" class="colocar_mensaje">Mensaje
                    <span class="obligatorio">*</span>
                  </label>                     
                                    <textarea name="introducir_mensaje" class="texto_mensaje" id="mensaje" required="obligatorio" placeholder="Deja aquí tu comentario..."></textarea> 
                                </p>                    
              
                <button type="submit" name="enviar_formulario" id="enviar"><p>Enviar</p></button>

                <p class="aviso">
                  <span class="obligatorio"> * </span>los campos son obligatorios.
                </p>          
            
          </form>
    </div>  
  </div>


<?php

if(isset($_POST['enviar_formulario'])){ //De acuerdo con el formulario definido aquí se ejecuta cuando presionamos el botón registro 
    $R_usuario=$_POST['introducir_nombre']; // Se guarda en una variable cada entrada definida en el formulario
	$R_nombre=$_POST['introducir_email']; // Se guarda en una variable cada entrada definida en el formulario
	$R_apellidos=$_POST['introducir_telefono']; // Se guarda en una variable cada entrada definida en el formulario
	$R_pass=$_POST['introducir_mensaje']; // Se guarda en una variable cada entrada definida en el formulario (codificamos la contraseña en MD5)
	
	if (!empty($R_usuario) && !empty($R_nombre) && !empty($R_apellidos) && !empty($R_pass)){ // Se consulta que no exista ningún campo vacío
		$sql ="INSERT INTO contacto(introducir_nombre, introducir_email, introducir_telefono, introducir_mensaje) VALUES('$R_usuario', '$R_nombre', '$R_apellidos', '$R_pass');"; // Ingreso de registro en SQL (parametros de usuario)
		$resultado = pg_query($dbcon, $sql); // Se ejecuta la consulta en PostgreSQL con la conexión definida anteriormente

		if(pg_affected_rows($resultado)==1){ //Si el registro es exitoso, retorna el valor de 1
			echo '<p>Registro exitoso</p>'; // Mensaje de salida en HTML
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
