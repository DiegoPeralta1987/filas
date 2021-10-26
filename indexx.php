<?php
	require ('config/conexion.php');
	
	$query = "SELECT * FROM servicios";
	$resultado=$mysqli->query($query);
?>


<html>
	<head>
		<title>asientos</title>
		
		<script language="javascript" src="js/jquery-3.1.1.min.js"></script>
		
		<script language="javascript">
			$(document).ready(function(){ 
				$("#cbx_estado").change(function () {

					$('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
					
					$("#cbx_estado option:selected").each(function () {
						idservicio = $(this).val();
						$.post("includes/getStock.php", { idservicio: idservicio }, function(data){
							$("#cbx_municipio").html(data);
						});            
					});
				})
			});
			
			$(document).ready(function(){
				$("#cbx_municipio").change(function () {
					$("#cbx_municipio option:selected").each(function () {
						idstock = $(this).val();
						
						$.post("insert.php", { idstock: idstock }, function(data){
					
						});            
					});
				})
			});
		</script>
		
	</head>
	
	<body>
		<form id="combo" name="combo" action="insert.php" method="POST">
			<div>
				
			<label>Selecciona Dia-Hora : </label>
				
			<select name="cbx_estado" id="cbx_estado" required>
                
				<option value="0">Fecha de Culto</option>
				<?php while($row = $resultado->fetch_assoc()) { ?>
					<option value="<?php echo $row['idservicio']; ?>"><?php echo $row['fecha']; ?>--<?php echo $row['horario']; ?></option>
				
					
				<?php } ?>
				
		
				</select>
				
		</div>
			
			<br />
			
			<div>Lugares Disponible :
				
			<select name="cbx_municipio" id="cbx_municipio" required>
		
			
			</select>
		</div>
		<br>
		<div> Documento Responsable:
		<input type="text" name="documento" required>

		</div>
			<br />
			
	
			<input type="submit" id="enviar" name="enviar" value="REGISTRAR" />
		</form>
	</body>
</html>