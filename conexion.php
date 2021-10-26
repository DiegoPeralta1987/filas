
			<?php
	
        $mysqli = new mysqli("172.17.0.78","wordpressuser","#S3rv2019$","filas"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos

			
			if(mysqli_connect_errno()){
				echo 'Conexion Fallida : ', mysqli_connect_error();
				exit();
			}
			

		?> 

