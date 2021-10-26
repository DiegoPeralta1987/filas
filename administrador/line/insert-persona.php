<html>
<?php
//error_reporting(0);
	if(isset($_POST["documento"])  && isset($_POST["nombre"]) 
		&& isset($_POST["apellido"]) && isset($_POST["correo"]) && isset($_POST["celular"]) 
		&& isset($_POST["direccion"])&& isset($_POST["pais"]) && isset($_POST["nacimiento"])){
		
		$documento			=	$_POST['documento'];
		$nombre				=	$_POST['nombre'];
		$apellido			=	$_POST['apellido'];
		$correo				=	$_POST['correo'];
		$celular			=	$_POST['celular'];
		$direccion			=	$_POST['direccion'];
		$pais				=	$_POST['pais'];
		$nacimiento			=	$_POST['nacimiento'];
		
		

		
		$json=array();

		
	$urlwr = "http://172.17.0.78:89/ws002.php?documento=$documento&nombre=$nombre&apellido=$apellido&correo=$correo&celular=$celular&direccion=$direccion&pais=$pais&nacimiento=$nacimiento";
					
					$url = str_replace(" ","--",$urlwr);
					
					$ch = curl_init($url);
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$result = curl_exec($ch);
						
						$data = json_decode($result, true);
						$status = $data['persona']["status"];


						if($status=='ok'){
						?>
							<script>
							window.onload=function(){
								document.forms["gotoPersona"].submit();
							}
							</script>
						<form name="gotoPersona" action="check-persona.php" method="POST">
								<input class="input1" type="hidden" name="documento" 	 	 value="<?php echo $documento; ?>">
								<input type="submit" value="Submit">

						</form>

						<?php
						}else if($status=='error'){
						?>
						<script>
							window.onload=function(){
								document.forms["gotonewPersona"].submit();
							}
							</script>
						<form name="gotonewPersona" action="nueva-persona.php" method="POST">
								<input class="input1" type="hidden" name="documento" 	 	 value="<?php echo $doc; ?>">
								<input type="submit" value="Submit">

						</form>
						<?php
						}	
	}else{
		echo ' ';
	}	
	
	
?>
</html>