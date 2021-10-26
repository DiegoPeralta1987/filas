<?php
if (isset($_GET['term'])){
	# conectare la base de datos
	$codigo=$_GET['term'];

	$con=@mysqli_connect("172.17.0.78", "wordpressuser", "#S3rv2019$", "filas");
	$return_arr = array();
if ($con)
{
			$fetch = mysqli_query($con,"SELECT ci_persona,nombre,telefono,correo,direccion,ciudad FROM personas
		 where ci_persona='$codigo'");
    	 
		
	while ($row = mysqli_fetch_array($fetch)) {
		$ci_persona=$row['ci_persona'];
		
		$nombre=$row['nombre'];
		$telefono=$row['telefono'];
		$direccion=$row['direccion'];
		$ciudad=$row['ciudad'];
		$correo=$row['correo'];
		$row_array['value'] = $row['nombre']. " | ".$row['telefono']." | ".$row['direccion'];
	  	$row_array['ci_persona']=$ci_persona;
	  	$row_array['nombre']=$nombre;
		$row_array['telefono']=$telefono;
		$row_array['correo']=$correo;
		$row_array['direccion']=$direccion;
		$row_array['ciudad']=$ciudad;
		array_push($return_arr,$row_array); 



    }
}

/* Cierra la conexión. */
mysqli_close($con);

/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);	

}
?>