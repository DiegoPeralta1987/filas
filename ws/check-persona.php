<html>
<?php
error_reporting(0);
	if(isset($_POST["documento"]) ){
		$json=array();
		 
		$doc		=	$_POST['documento'];
		
						$url = "localahost:81/asientos/ws/ws001.php?documento=$doc&tipodocumento=1";
						$ch = curl_init($url);
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$result = curl_exec($ch);
						
						$data = json_decode($result, true);
						$status = $data['persona']["status"];

						$documento 		     = $data['persona']["Documento"];
						$pais				 = $data['persona']["Pais"];
						$nombre 			 = $data['persona']["Nombre"];
						$apellido 			 = $data['persona']["Apellido"];
						$fechaNacimiento 	 = $data['persona']["FechaNacimiento"];
						$correo 			 = $data['persona']["Correo"];
						$celular 			 = $data['persona']["Celular"];
						$direccion 			 = $data['persona']["Direccion"];
						
						
						
						if($status=='ok'){
						?>
							<script>
							window.onload=function(){ 
								document.forms["gotoPersona"].submit();
							}
							</script>
						<form name="gotoPersona" action="insert.php" method="POST">
								<input class="input1" type="hidden" name="documento" 	 	 value="<?php echo $documento; ?>">
								<input class="input1" type="hidden" name="pais" 			 value="<?php echo $pais; ?>">
								<input class="input1" type="hidden" name="nombre" 		 	 value="<?php echo $nombre; ?>">
								<input class="input1" type="hidden" name="apellido" 		 value="<?php echo $apellido; ?>">
								<input class="input1" type="hidden" name="fechaNacimiento" 	 value="<?php echo $fechaNacimiento; ?>">
								<input class="input1" type="hidden" name="correo" 		 	 value="<?php echo $correo; ?>">
								<input class="input1" type="hidden" name="celular" 		 	 value="<?php echo $telefono; ?>">
								<input class="input1" type="hidden" name="direccion" 		 value="<?php echo $direccion; ?>">
								<input type="submit" value="Submit">

						</form>

					
						<?php
						}	
	}else
		
	
	
?>
</html>