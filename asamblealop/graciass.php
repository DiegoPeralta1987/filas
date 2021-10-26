

<?php
require_once 'conexion.php';

$idservicio= $_GET['servicio'];
$sql2="SELECT s.fecha,s.horario,e.evento
FROM servicios s
INNER JOIN eventos e on s.ideventos=e.ideventos
where  s.idservicio='$idservicio' ";
$res = $mysqli->query($sql2);
$resy = $res->fetch_object();
$fecha = $resy->fecha;
$horario = $resy->horario;
$evento = $resy->evento;
?>
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
		<div class="container-contact1" >
			<div class="container-contact1-form-btn" >
      			<center>
				<img src="public/dist/logoes1.png" alt="cfa" width="310px"/> <br><br>

						<h4>&iexcl;CONFIRMAMOS SU CANCELACION!</h4>
				  <p>Se gener&oacute; correctamente la cancelacion de su reserva </p></br>
				  <p>Evento: <?php echo $evento; echo " Fecha: "; echo $fecha; echo " Horario: "; echo $horario;   ?></p>


                    <span>&nbsp;&nbsp;&nbsp;</span>
             
                                        <h3>Más Información</h3>
                                <p>Puede comunicarse con nosotros a:</p>
                                <p>Linea Baja 021-6205000</p>
                                <p>Whatsapp 0972275500</p>
                                <p>Correo: eventos@cfa.org.py</p></br>
                                
                                <h2>Dios le Bendiga!</h2>


					<form style="width:40%;margin-top:20px;" method="GET" action="index.php">
					
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
