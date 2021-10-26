<!DOCTYPE html>
<html>
<head>
<title>Reservas de Asientos</title>
  <link rel="shortcut icon" type="image/x-icon" href="public/img/favicon.ico">
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Super Market Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
	/* scroll de lado
@media screen and (max-width: 400px) {
     table {
       display: block;
       overflow-x: auto;
     }
}*/

@media screen and (max-width: 690px) {
       table {
           width:100%;
       }
       thead {
		display: none;
          
       }
       tr:nth-of-type(2n) {
           background-color: inherit;
       }
       tr td:first-child {
           background: #f0f0f0;
           font-weight:bold;
           font-size:1.3em;
       }
       tbody td {
           display: block;
           text-align:center;
       }
       tbody td:before {
           content: attr(data-th);
           display: block;
           text-align:center;
       }
}

</style>
<!-- start-smoth-scrolling -->
</head>

	
<body>
 <div class="container" align="center">

				<img src="public/img/logoes1.png" width="302" height="80" alt="">
			
        <h1><a href="index.php">RESERVAS DE LUGAR</a></h1>
        
		
      
		
	</div>
<!-- //header -->
<!-- navigation -->

<?php
 


error_reporting(0);
	if(isset($_POST["documento"]) ){
		$json=array();
		 
		$doc		=	$_POST['documento'];
		
					//	$url = "localhost:81/asientos/ws/ws001.php?documento=$doc&tipodocumento=1";
						$url = "http://172.17.0.78:81/ws/ws001.php?documento=$doc&tipodocumento=1";
						$ch = curl_init($url);
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$result = curl_exec($ch);
						
						$data = json_decode($result, true);
						$status = $data['persona']["status"];

						$documento 		     = $data['persona']["Documento"];
						$pais				 = $data['persona']["Pais"];
						$name 			 = $data['persona']["nombrecompleto"];
						$apellido 			 = $data['persona']["Apellido"];
						$fechaNacimiento 	 = $data['persona']["FechaNacimiento"];
						$emaill 			 = $data['persona']["Correo"];
						$phone 			 = $data['persona']["Celular"];
						$address 			 = $data['persona']["Direccion"];
						$city 			 = $data['persona']["Ciudad"];
						
						
						
					
	}else{
 
 
 
  }
		
	
		
?>
					

<?php 

require_once 'conexion.php';

$idstock=$_POST['cbx_municipio'];
$idservicio=$_POST['cbx_estado'];
$doc=$_POST['documento'];

//echo "docuemento:  ".$doc;
//echo "cantidisponible  ".$cantidisponible=$_POST['cantidisponible'];
/*

$requi="SELECT * FROM personas where ci_persona='$doc'";
$se=$mysqli->query($requi);
$ser = $se->fetch_object();
$name= $ser->nombre;
$phone= $ser->telefono;
$emaill= $ser->correo;
$address= $ser->direccion;
$city= $ser->ciudad;*/


//echo "repe: ".$repetidor;




$sql="SELECT fecha,horario FROM filas.servicios where idservicio='$idservicio'";
$r= $mysqli->query($sql);
$re = $r->fetch_object();
$fe= $re->fecha;
$ho= $re->horario;


  $que= "SELECT s.idstock, a.cantidad 
  FROM stock s
  INNER JOIN asientos a on s.id_asientos=a.id_asientos
  where s.idservicio='$idservicio' and s.idstock='$idstock' and s.estado=1";
  $resuly = $mysqli->query($que);
  $resy = $resuly->fetch_object();
  $cantidisponible = $resy->cantidad;

//echo "que ".$cantidisponible;
/*
if( $idstock>0){ 

$resul = "SELECT id_asientos,cantidad, cant_reserva from stock where idstock='$idstock' and idservicio='$idservicio'";

  $resul = $mysqli->query($resul);
  $res2 = $resul->fetch_object();
  $idLocal = $res2->id_asientos;
  //$cant= $res2->cantidad;
 // $cant_reser= $res2->cant_reserva;
  //echo "jo  ".$idLocal;



}else{
	echo "Falta cantidad";
}*/



$cantidad = $cantidisponible;

 if($cantidad>0){ ?>
<br /><br />
<div style"color: blue" align="center">
<h2>Fecha: <?php echo "$fe"; ?></h2>
<h3>Horario:<?php echo "$ho"; ?></h3>
</div>		<br>
<form action="guardar.php" method="POST">

<input name="documento" value="<?php echo $doc ?>" type="hidden">

<input name="cantidad" value="<?php echo $cant ?>" type="hidden">
<input name="cant_reserva" value="<?php echo $cant_reser ?>" type="hidden">
<input name="idstock" value="<?php echo $_POST['cbx_municipio']; ?>" type="hidden">
<input name="cantiRe" value="<?php echo $cantidisponible ?>" type="hidden">
<input name="idservicio" value="<?php echo $idservicio ?>" type="hidden">


  <table  class="table" >
  <thead >
 
    
    
  <tr>
    <th>No.</th>
    <th>Documento</th>
     <th>Tipo Documento</th>
    <th>Datos Personales</th>
    <th>Telefono</th>
    <th>Correo</th>
    <th>Direcccion</th>
    <th>Ciudad</th>
    
  </tr> 
  </thead>
  <?php

 $cantidad=1;

 While($cantidad<= $cantidisponible){ 

  ?>
<tbody>
  <tr>
	<td ><?php echo "$cantidad"; ?></td>
	
    <?php
    if($cantidad==1){
	?>
	
        <td><input type="text" name="ci_persona<?php echo "$cantidad";?>" value="<?php echo $_POST['documento'];?>" readonly required="required"></td>
         <td><select  name="doctype<?php echo "$cantidad";?>" value="<?php echo $_POST['doctype'];?>">
      <option value="CEDULA">CEDULA</option>
      <option value="PASAPORTE">PASAPORTE</option>
      <option value="DNI">DNI</option>
  </select></td>
    <td><input type="text" name="nombre<?php echo "$cantidad";?>"  value="<?php echo $name;?>"   required="required" placeholder="Nombres-Apellidos" maxlength="120"></td>
	  <td><input type="number" name="telefono<?php echo "$cantidad";?>" value="<?php echo $phone;?>" required="required" placeholder="Telefono" maxlength="45"></td>
    <td><input type="email" name="correo<?php echo "$cantidad";?>" value="<?php echo $emaill;?>"  placeholder="Correo" maxlength="45"></td>
   
    <td><input type="text" name="direccion<?php echo "$cantidad";?>"  value="<?php echo $address;?>"  required="required" placeholder="Direccion" maxlength="120"></td>
    <td><input type="text" name="ciudad<?php echo "$cantidad";?>"  value="<?php echo $city;?>"  required="required" placeholder="Ciudad" maxlength="120"></td>
    <?php
    }else{
    ?>
    <td><input type="text" name="ci_persona<?php echo "$cantidad";?>" id="ci_persona"  required="required" placeholder="Documento" maxlength="15"></td>
     <td><select  name="doctype<?php echo "$cantidad";?>" value="<?php echo $_POST['doctype'];?>">
      <option value="CEDULA">CEDULA</option>
      <option value="PASAPORTE">PASAPORTE</option>
      <option value="DNI">DNI</option>
  </select></td>

    <td><input type="text" name="nombre<?php echo "$cantidad";?>"  id="nombre" required="required" placeholder="Nombres-Apellidos" maxlength="120"></td>
	<td><input type="number" name="telefono<?php echo "$cantidad";?>" id="telefono" required="required" placeholder="Telefono" maxlength="45"></td>
    <td><input type="email" name="correo<?php echo "$cantidad";?>" id="correo"  placeholder="Correo" maxlength="145"></td>
   
    <td><input type="text" name="direccion<?php echo "$cantidad";?>" id="direccion"  required="required" placeholder="Direccion" maxlength="120"></td>
    <td><input type="text" name="ciudad<?php echo "$cantidad";?>" id="ciudad"   required="required" placeholder="Ciudad" maxlength="120"></td>
    <?php
    }
    ?>
   

  
    
    
    
 <input name="num<?php echo "$cantidad";?>" type="hidden">

 
 <input name="cantidad" type="hidden" id="cantidad" value="<?php echo "$cantidad"; ?>" />
 <input name="idstock" type="hidden" id="idstock" value="<?php echo "$_POST[cbx_municipio]"; ?>" />
 

<?php
$cantidad++;
}
?>

 
  <tr>
   <td colspan="7" align="right">
   <input class="" type="submit" value="Registrar" />
  
 
<?php } ?>  


</form>

 
 <button>
 
   <a href="http://reservas.cfa.org.py/">Volver</a></button>  </td>
</tr>

  </tbody>
</table>


<div class="footer">
		
<div class="container" >
	<div class="navigation-agileits" align="center">
		
		<div class="" style="color: white">
						<p>&copy;2020 Todos los Derechos Reservados |<a href="https://cfa.org.py/" style="color: white">CENTRO FAMILIAR DE ADORACI&Oacute;N</a></p>
			</div>
			
	
		</div>
		</div>
	</div>	

<!-- //footer -->	
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- top-header and slider -->
<!-- here stars scrolling icon -->

<!-- //here ends scrolling icon -->
<script src="js/minicart.min.js"></script>
<script>
	// Mini Cart
	paypal.minicart.render({
		action: '#'
	});

	if (~window.location.search.indexOf('reset=true')) {
		paypal.minicart.reset();
	}
</script>
<!-- main slider-banner -->
<script src="js/skdslider.min.js"></script>
<link href="css/skdslider.css" rel="stylesheet">
<script type="text/javascript"  src="public/js/jquery-1.10.2.js"></script>
  <script type="text/javascript" src= "public/jquery-ui-1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script type="text/javascript" >

function obtener(){
    
        go();
    
}
 

$(function()  {
 
 
  
            $("#ci_persona").autocomplete({
                source: "busqueConsulta.php",
                minLength: 2,
                select: function(event, ui) {
          event.preventDefault();
     
         $('#ci_persona').val(ui.item.ci_persona);
					$('#nombre').val(ui.item.nombre);
					$('#telefono').val(ui.item.telefono);
					$('#direccion').val(ui.item.direccion);
					$('#ciudad').val(ui.item.ciudad);
					$('#correo').val(ui.item.correo);
         			
			     }
			     
  
            });
      
    });

</script>
</script>	
</body>
</html>