<?php
	
	require '../conexion.php';
	
	$id_estado = $_POST['idservicio'];
	
	$queryM = "SELECT s.idstock,s.cantidad,s.cant_reserva,s.lugares,
	s.idservicio,s.estado, a.cantidad as cantidisponible,
  round(s.cantidad/s.total*100) as porcentaje
	FROM stock s
	INNER JOIN asientos a on s.id_asientos=a.id_asientos
	where s.idservicio='$id_estado' and s.estado=1";
	$resultadoM = $mysqli->query($queryM);
	
    $html= "";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
     if($rowM['cantidad']>=1){
		$html.= "<option value='".$rowM['idstock']."'>".$rowM['cantidisponible']. '-Persona--'.$rowM['porcentaje']."% Disponible</option>";
		}else if($rowM['cantidad']==0){
 	  $html.= "<option value='999' >Acreditaci&oacute;n Cerrada</option>";

   }
		
	}
	
	echo $html;



?>		 
      
