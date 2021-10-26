
<!DOCTYPE html>
<html lang="en">
<head>
	<title>CFA</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/util.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/main.css">
</head>
<body>

	<div class="contact1">
		<div class="container-contact1">
			<div class="container-contact1-form-btn">
      			<center>
				<img src="public/dist/logoes1.png" alt="cfa" width="310px"/> <br><br>

						<h4>&iexcl;DATOS REGISTRADOS!</h4>
				  <p>Se gener&oacute; correctamente la reserva de lugar al servicio seleccionado</p></br>
				<div class="container">
					
			
		



										<?php
									//Agregamos la libreria para genera c�digos QR
									require_once 'phpqrcode/qrlib.php';    
                  require_once 'conexion.php'; 
									
									//Declaramos una carpeta temporal para guardar la imagenes generadas
									$dir = 'imagenqr/';
								//	 $dir2 = 'temp/'.$grupo;

									if(isset($_GET["grupo"])  && isset($_GET["ci_persona"]) &&isset($_GET["idreserva"]) ){
										$json=array();

											$grupo=$_GET['grupo'];
										
											$ci_persona=$_GET['ci_persona'];
											$idreserva=$_GET['idreserva'];
                   


												$sq = "SELECT nombre,correo from personas where ci_persona='$ci_persona'";
												$res = $mysqli->query($sq);
                        $res2 = $res->fetch_object();
                        $nombre = $res2->nombre;
                        $correo = $res2->correo;
                                                     
                        	if($correo !==null){
													
													
													$grupo=$_GET['grupo'];
													$ci_persona=$_GET['ci_persona'];
												  $nombre_final=str_replace(" ", "%20", $nombre);
							
													$url = "http://172.17.0.77:83/asamblea.php?ci_persona=$ci_persona&correo=$correo&grupo=$grupo&nombre=$nombre_final";

												

													$data_string = array();
							
													$data= json_encode($data_string);
													$ch = curl_init($url);
													curl_setopt($ch, CURLOPT_POST, 1);
													curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
													curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
													curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
													$result = curl_exec($ch);
													
													$data = json_decode($result, true);
													

													$status = $data["correo"]["status"];
							
													if($status=="ok"){
													
													}else if($status=="error"){
														
													
													}
												}
										                              
                                                                                   
												

												
							


									}else

										printf("No se genero codigo QR\n");
									
								
						
								?>

						
	</div>

					<h3>Dios le Bendiga querido Lider:</h3>
				
        <ol>
          <li>Hemos recibido su resrva para participar de la asamblea 2021 modo virtual</li> 
          <li> La primera convocatoria es a las 19:00 hs..</li>
          <li> La segunda convocatoria es a las 19:30 hs.</li>
          <li> Ese dia recibira el link para acceder.</li>
              <li>Muchas Gracias</li></br>
          	</ol>
        
				<h3>Más Información</h3>
        <p>Puede comunicarse con nosotros a:</p>
        <p>Linea Baja 021-6205000</p>
        <p>Whatsapp 0972275500</p>
        <p>Correo: eventos@cfa.org.py</p></br>
        
        <h2>Dios le bendiga!</h2>


					<form style="width:60%;margin-top:20px;" method="POST" action="https://reservas.cfa.org.py/asamblea/index.php">
					
					<button class="contact1-form-btn">
						<span>
							VOLVER
							<i class="fa fa-long-arrow-left" aria-hidden="true"></i>
						</span>
					</button>
					</form>
			</center>

			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>

	<script src="js/main.js"></script>

</body>
</html>
