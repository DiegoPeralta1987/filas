<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<div class="contact1" style="width=100%;">
		<div class="contact1">
			<div class="container-contact1">
			
			<div class="contact1-pic js-tilt" data-tilt>
				<img src="../images/img-01.png" alt="IMG">
			</div>
			
			
				<form class="contact1-form validate-form" action="insert-persona.php" method="POST">
					<span class="contact1-form-title">
						DATOS
					</span>

				<div class="wrap-input1 validate-input" data-validate = "Name is required">
				<span class="shadow-input12" style="margin-left:20px;margin-bottom:10px;">Documento</span>
					<input class="input1" type="text" name="documento" placeholder="Documento">
					
				</div>

				<div class="wrap-input1 validate-input" data-validate = "Name is required">
				<span class="shadow-input12" style="margin-left:20px;margin-bottom:10px;">Nombre</span>
					<input class="input1" type="text" name="nombre" placeholder="Nombre">
					
				</div>

				<div class="wrap-input1 validate-input" data-validate = "Name is required">
				<span class="shadow-input12" style="margin-left:20px;margin-bottom:10px;">Apellido</span>
					<input class="input1" type="text" name="apellido" placeholder="Apellido">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "Name is required">
				<span class="shadow-input12" style="margin-left:20px;margin-bottom:10px;">Correo</span>
					<input class="input1" type="text" name="correo" placeholder="Correo">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "Name is required">
				<span class="shadow-input12" style="margin-left:20px;margin-bottom:10px;">Celular</span>
					<input class="input1" type="text" name="celular" placeholder="Celular">
					<span class="shadow-input1"></span>
				</div>	

				<div class="wrap-input1 validate-input" data-validate = "Name is required">
				<span class="shadow-input12" style="margin-left:20px;margin-bottom:10px;">Dirección y Ciudad</span>
					<input class="input1" type="text" name="direccion" placeholder="Dirección">
					<span class="shadow-input1"></span>
				</div>	

				<div class="wrap-input1 validate-input" data-validate = "Name is required">
				<span class="shadow-input12" style="margin-left:20px;margin-bottom:10px;">País</span>
					<input class="input1" type="text" name="pais" placeholder="País">
					<span class="shadow-input1"></span>
				</div>	

				<div class="wrap-input1 validate-input" data-validate = "Name is required">
				<span class="shadow-input12" style="margin-left:20px;margin-bottom:10px;">Fecha de Nacimiento</span>
					<input class="input1" type="date"  size="30" name="nacimiento" step="1" min="1900-01-01" max="2050-12-31" value="<?php echo date("Y-m-d");?>">
					<span class="shadow-input1"></span>
				</div>	

				<div class="container-contact1-form-btn">
					<button class="contact1-form-btn">
						<span>
							GUARDAR
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
					</button>
				</div>				

				</form>
				
				<!---->

			</div>
		</div>
		

	</div>


	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>

	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

	<script src="../vendor/select2/select2.min.js"></script>

	<script src="../vendor/tilt/tilt.jquery.min.js"></script>


	<script src="../js/main.js"></script>

</body>
</html>
