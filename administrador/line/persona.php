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
				<form class="contact1-form validate-form">
					<span class="contact1-form-title">
						DATOS
					</span>

				<div class="wrap-input1 validate-input" data-validate = "Name is required">
					<span class="">Nombre : <?php echo $_POST["nombre"]; ?> </span> <hr/>
				</div>
				
				<div class="wrap-input1 validate-input" data-validate = "Name is required">
					<span class="">Apellido : <?php echo $_POST["apellido"]; ?> </span> <hr/>
				</div>
				
				<div class="wrap-input1 validate-input" data-validate = "Name is required">
					<span class="">Documento : <?php echo $_POST["documento"]; ?> </span> <hr/>
				</div>				

				<div class="wrap-input1 validate-input" data-validate = "Name is required">
					<span class="">Celular : <?php echo $_POST["celular"]; ?> </span> <hr/>
				</div>	
				
				<div class="wrap-input1 validate-input" data-validate = "Name is required">
					<span class="">Correo : <?php echo $_POST["correo"]; ?> </span> <hr/>
				</div>					

				</form>
				
				<!---->
				
				<form class="contact1-form validate-form" action="check-mount.php" method="POST">
					<span class="contact1-form-title">
						INGRESAR
					</span>
						<input class="input1" type="hidden" name="documento" value="<?php echo $_POST["documento"]; ?>" >
					
					<div class="wrap-input1 validate-input" data-validate = "Name is required">
						<input class="input1" type="number" name="amount" placeholder="Monto">
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "Name is required">
						<select class="input2" name="cc" id="motivo">
						  <option value="4">Ofrendas</option>
						  <option value="3">Diezmos</option>
						</select>
						<span class="shadow-input1"></span>
					</div>
					<div class="container-contact1-form-btn">
						<button class="contact1-form-btn">
							<span>
								PROCESAR
								<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</form>
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
