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


<?php 

include('conectar.php');

require_once 'conexion.php';

$idstock=$_POST['cbx_municipio'];
$idservicio=$_POST['cbx_estado'];

$que= "SELECT s.idstock, a.cantidad as cantiReserva, s.cantidad
FROM stock s
INNER JOIN asientos a on s.id_asientos=a.id_asientos
where s.idservicio='$idservicio' and s.idstock='$idstock' and s.estado=1";
$resuly = $mysqli->query($que);
$resy = $resuly->fetch_object();
$cantiReserva = $resy->cantiReserva;
$cantidadtotal= $resy->cantidad;


$database = "sngerp";

$db_conn = pg_connect("host=172.17.0.233 user=snguser password=snguser  port=5433 dbname=$database");
if (!$db_conn) {
  echo "Failed connecting to postgres database $database\n";
  exit;
}


if(isset($_POST['documento']) ){
   $json=array();


                 $documento=$_POST["documento"];
 
                 $result = pg_query($db_conn, "SELECT nro_doc_ident,aprsnm,dctadpeid,bdpenm,linea FROM v_lideresconlinea WHERE nro_doc_ident='$documento'");
                 $rows = pg_num_rows($result);

                 if($rows>0){

                


                    $qu = pg_query($db_conn, "SELECT nro_doc_ident,aprsnm,dctadpeid,bdpecd,linea,celula_lider FROM v_lideresconlinea WHERE nro_doc_ident='$documento'");
                    while ($data = pg_fetch_object($qu)) {
                    $doc= $data->nro_doc_ident;
                    $nombre= $data->aprsnm;
                    $codigo= $data->dctadpeid;
                    $lider= $data->celula_lider;
                    $linea= $data->linea;
                    }

                    pg_free_result($qu);
                    pg_close($db_conn);

                }else{

                    $rows=0;
                }


}



?>

<form action="lider_save.php" method="POST">

<input name="documento" value="<?php echo $doc ?>" type="hidden">


<input name="idstock" value="<?php echo $idstock ?>" type="hidden">
<input name="cantiReserva" value="<?php echo $cantiReserva ?>" type="hidden">
<input name="idservicio" value="<?php echo $idservicio ?>" type="hidden">
<table  class="table" >
    <thead >
    
        
        
    <tr>
        <th>No.</th>
        <th>Documento</th>
        <th>Datos Personales</th>
       
        <th>Lider</th>
        <th>Linea</th>
        <th>Correo</th>
        
        
    </tr> 
    </thead>
    <?php
if($rows>0){
 $cantidad=1;

 While($cantidad<= $cantiReserva){ 

  ?>
<tbody>
  <tr>
  <td ><?php echo "$cantidad"; ?></td>
	
  <?php
  if($cantidad==1){
?>

      <td><input  class="form-control" type="text" name="ci_persona<?php echo $cantidad;?>" value="<?php echo $doc ?>" readonly required="required"></td>
       
  <td><input  class="form-control" type="text" name="nombre<?php echo $cantidad;?>"  value="<?php echo $nombre;?>"   required="required" readonly></td>

  <td><input class="form-control" type="email" name="correo<?php echo $cantidad;?>" value="<?php echo $lider;?>"  readonly></td>
 
  <td><input class="form-control"  type="text" name="direccion<?php echo $cantidad;?>"  value="<?php echo $linea;?>"  required="required" readonly></td>
    <td><input class="form-control"  type="email" name="correo<?php echo $cantidad;?>"   required="required" placeholder="Ingrese su correo"></td>
 
  <?php
  }
  ?>

 
    
<input name="num<?php echo $cantidad;?>"  type="hidden">



<?php
$cantidad++;
}

}else{

    echo "<script>
    alert('Lo sentimos pero no se encuentra en nuestros registros')
    history.go(-1);


</script>

";


}
?>

 
  <tr>
   <td colspan="7" align="right">
   <input class="" type="submit" value="Registrar" />
  
 


</form>

 
<button>
 
 <a href="http://reservas.cfa.org.py/asamblea">Volver</a></button>  </td>
</tr>

</tbody>
</table>



<div class="footer">
		
<div class="container" >
	<div class="navigation-agileits" align="center">
		
		<div class="" style="color: white">
						<p>&copy;2021 Todos los Derechos Reservados |<a href="https://cfa.org.py/" style="color: white">CENTRO FAMILIAR DE ADORACI&Oacute;N</a></p>
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