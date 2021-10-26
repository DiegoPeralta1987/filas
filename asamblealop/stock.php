<!DOCTYPE html>
<html>
<head>
<title>Reservas de Asientos</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<!-- //for-mobile-apps -->

<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->

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
@media screen and (max-width: 600px) {
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
<div class="logo_products">
		<div class="container">
		<div class="w3ls_logo_products_left1">
	
			</div>
			<div class="w3ls_logo_products_left">
				<h1><a href="index.php">RESERVAS DE LUGAR</a></h1>
			</div>

			
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //header -->
<!-- navigation -->

	<div class="container">			

<?php 
require_once('conexion.php'); 

$idstock=$_POST['cbx_municipio'];
$idservicio=$_POST['cbx_estado'];
$doc=$_POST['documento'];


//echo "idstock ".$idservicio;

if( $idstock>0){ 

$resul = "SELECT id_asientos,cantidad, cant_reserva from stock where idstock='$idstock' and idservicio='$idservicio'";

  $resul = $conn->query($resul);
  $res2 = $resul->fetch_object();
  $idLocal = $res2->id_asientos;
  //$cant= $res2->cantidad;
  //$cant_reser= $res2->cant_reserva;
  //echo "jo  ".$idLocal;



}else{
	echo "Falta cantidad";
}



$cantidad = $idLocal;

 if($cantidad>0){ ?>
<br /><br />

<form action="guardar.php" method="POST" class="">


<input name="ci_titular" value="<?php echo $_POST['documento']; ?>" type="hidden">
<input name="asientos" value="<?php echo $idLocal ?>" type="hidden">
<input name="idstock" value="<?php echo $_POST['cbx_municipio']; ?>" type="hidden">


  <table  class="table table-responsive table-bordered" >
  <thead>
  <tr>
  		<th>No.</th>
	    <th>Documento</th>
	    <th>Datos Personales</th>
	    <th>Telefono</th>
	    <th>Correo</th>
	    <th>Direcccion</th>
	    <th>Ciudad</th>
	    
    
  </tr>
  </thead>
  
  <?php




 $cantidad=1;


 While($cantidad<= $idLocal){ 
/*	if($cantidad=1){
		$ci_persona =$_POST['documento'];

		echo "documenti".$ci_persona;
	}*/

  ?>
<tbody>
  <tr>
 
	<td><?php echo "$cantidad"; ?></td>
	
    <?php
    if($cantidad==1){
    ?>
	<td><input type="text" name="ci_persona<?php echo "$cantidad";?>" value="<?php echo $_POST['documento']; ?>" disabled required="required"></td>
	
    <?php
    }else{
    ?>
    <td><input type="text"  name="ci_persona<?php echo "$cantidad";?>" required="required" placeholder="Documento"></td>
    <?php
    }
    ?>
   
	<td><input  type="text" name="nombre<?php echo "$cantidad";?>" required="required" placeholder="Nombres"></td>
	<td><input  type="number" name="telefono<?php echo "$cantidad";?>" required="required" placeholder="Telefono"></td>
    <td><input  type="email" name="correo<?php echo "$cantidad";?>" required="required" placeholder="Correo"></td>
   
    <td><input  type="text" name="direccion<?php echo "$cantidad";?>" required="required" placeholder="Direccion"></td>
    <td><input  type="text" name="ciudad<?php echo "$cantidad";?>" required="required" placeholder="Ciudad"></td>
  
    
    
    
 <input name="num<?php echo "$cantidad";?>" type="hidden">

 
 <input name="cantidad" type="hidden" id="cantidad" value="<?php echo "$cantidad"; ?>" />
 <input name="idstock" type="hidden" id="idstock" value="<?php echo "$_POST[cbx_municipio]"; ?>" />
 

<?php
$cantidad++;
}
?>

  </tr>
  </tbody>
  <tr>
   <td colspan="7" align="right">
   <input class="" type="submit" value="Registrar" />
   <button onclick="location.href='index.php'"   >Volver</button>
   </td>
<?php } ?>  
  </tr>
  </tbody>
</table>

</form>

</div>	

<div class="footer">
		<div class="container">
			<div class="w3_footer_grids">
			<div class="footer">
		<div class="container">
			<div class="w3_footer_grids">
				
				<div class="clearfix"> </div>
			</div>
		</div>
		
		<div class="footer-copy">
			
			<div class="container">
				<p>©2020 All rights reserved | CFA-TI <a href="https://cfa.org.py/">CENTRO FAMILIAR DE ADORACIÓN</a></p>
			</div>
		</div>
		
	</div>	

<!-- //footer -->	
<!-- Bootstrap Core JavaScript -->

<!-- main slider-banner -->
	
</body>
</html>