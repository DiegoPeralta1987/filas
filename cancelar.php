<?php 

require_once 'conexion.php';


if(isset($_POST["documento"]) &&  isset($_POST["cbx_estado"]) ){ 
  $json=array();


$idservicio=$_POST['cbx_estado'];
$doc1=$_POST['documento'];

$que= "SELECT * FROM reserva_detalle  where idservicio='$idservicio' and ci_persona='$doc1'";
$resuly = $mysqli->query($que);
$resy = $resuly->fetch_object();
//$nombre = $resy->nombre;
}


if($resy!=null){
  $que= "SELECT * FROM reserva_detalle  where idservicio='$idservicio' and ci_persona='$doc1'";
  $resuly = $mysqli->query($que);
  $resy = $resuly->fetch_object();
  $nombre = $resy->nombre;

?>



<!DOCTYPE html>
<html>
<head>
<title>Reservas de Asientos</title>
  <link rel="shortcut icon" type="image/x-icon" href="public/img/favicon.ico">
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
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

<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<div class="container" >
    <div class="navigation-agileits" align="center">
        <nav class="navbar navbar-default">
            <h5>&nbsp;</h5>
            <h1><a href="index.php" style="color: white;">RESERVAS DE LUGAR</a></h1>
        <h5>&nbsp;</h5>
            
            <!-- <div class="navbar-header nav_2">
                                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
              
              <div >
                <img src="public/img/protocolo.png" class="container-2">
            </div>
              -->
                
        </div>

        <form action="confirmacion.php" method="POST">

<input type="hidden" name="idservicio" value="<?php echo $_POST["cbx_estado"];?>">
<input type="hidden" name="ci_persona" value="<?php echo $_POST["documento"];?>">
<div align="center"><br>
 <h2>Cancelacion de reserva realizada por Sr./Sra. <br><?php echo $nombre  ?></h2><br>
   <h2> Por favor ingrese el codigo que se le envio en su correo</h2><br>
   <input type="text" name="codigo" id="codigo" required  min="6" placeholder="Ingrese aqui su codigo">
   <button type="submit">Enviar</button>
</div>     



</form>
        </div>



<?php
  
}else{

  echo "Esta persona no se encuentra registrada en ningun evento";
}


?>
