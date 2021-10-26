
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
					
			
		

				  <label>Su codigo de Acceso es:</label>
		<p class="qrnombre"> <?php echo $_GET['grupo'];?>  </p>


										<?php
									//Agregamos la libreria para genera códigos QR
									require "phpqrcode/qrlib.php";    
                  require_once 'conexion.php'; 
									
									//Declaramos una carpeta temporal para guardar la imagenes generadas
									$dir = 'imagenesqr/';
								//	 $dir2 = 'temp/'.$grupo;

									if(isset($_GET["grupo"]) && isset($_GET["lugar"])  && isset($_GET["ci_persona"]) &&isset($_GET["idreserva"]) ){
										$json=array();

											$grupo=$_GET['grupo'];
											$lugar=$_GET['lugar'];
											$ci_persona=$_GET['ci_persona'];
											$idreserva=$_GET['idreserva'];
                      $correo=$_GET['correo'];
                      $nombre=$_GET['nombre'];

									

												$sq2 = "UPDATE reserva_cabecera set cod_lugar='$grupo' where idreserva_cabecera='$idreserva'";
												$res2 = $mysqli->query($sq2);

												$sq = "UPDATE reserva_detalle set cod_lugar='$grupo' where idreserva_cabecera='$idreserva'";
												$res = $mysqli->query($sq);
                                                     
                        	if($res===TRUE){
													
													
													$grupo=$_GET['grupo'];
													$lugar=$_GET['lugar'];
													$ci_persona=$_GET['ci_persona'];
													$correo=$_GET['correo'];
													$nombre=$_GET['nombre'];
													$nombre_final=str_replace(" ", "%20", $nombre);
							
													$url = "http://172.17.0.77:83/reservas.php?ci_persona=$ci_persona&correo=$correo&grupo=$grupo&nombre=$nombre_final";

												

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
										                              
                                                                                   
												

												
												//Si no existe la carpeta la creamos
										/*	if (!file_exists($dir2))
													mkdir($dir2);*/
												
													//Declaramos la ruta y nombre del archivo a generar
												$filename = $dir.$grupo.'.png';
											
													//Parametros de Condiguración
												
												$tamaño =7; //Tamaño de Pixel
												$level = 'L'; //Precisión Baja
												$framSize = 3; //Tamaño en blanco
												$contenido = "$grupo"; //Texto
												
													//Enviamos los parametros a la Función para generar código QR 
												QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
												
													//Mostramos la imagen generada
												echo '<img src="'.$dir.basename($filename).'" />';  

												echo '	<button class="contact1-form-btn">
												<a href="'.$filename.'" download>Descargar</a>
													<i class="fa fa-long-arrow-down" aria-hidden="true"></i>
									
											</button><hr/>';

									}else

										printf("No se genero codigo QR\n");
									
								
						
								?>

						
	</div>

					<h3>Tenga en cuenta:</h3>
				
        <ol>
          <li> Respetar todos los protocolos sanitarios.<a href="https://cfa.org.py/#8"> Click AquÃ­</a> </li> 
          <li> Indique su nÃºmero de cedula y de sus acompaÃ±antes al ujier para que le asigne el lugar que le (s) corresponde.
          O puede descargar el codigo QR de arriba y tenerlo en su celular para ser escaneado por el ujier.</li>
          <li> Acatar las instrucciones extras de los ujieres.</li>
          <li> Al salir del edificio hÃ¡galo con cautela manteniendo el orden.</li></br>

          	</ol>
        
				<h3>MÃ¡s InformaciÃ³n</h3>
        <p>Puede comunicarse con nosotros a:</p>
        <p>Linea Baja 021-6205000</p>
        <p>Whatsapp 0972275500</p>
        <p>Correo: eventos@cfa.org.py</p></br>
        
        <h2>Dios le bendiga!</h2>


					<form style="width:60%;margin-top:20px;" method="GET" action="index.php">
					
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
