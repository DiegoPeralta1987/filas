<!DOCTYPE html>
<html>
<head>
<title>Reservas de Asientos</title>
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
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->

<!-- start-smoth-scrolling -->
</head>
<?php
require_once 'conexion.php'; 

echo "asientoss ".$val= $_POST['cantiRe'];
//echo "ci_persona ".$docs= $_POST['ci_titular'];
echo "idstock ".$idstock= $_POST["idstock"];
echo "cantidad ".$cantStock= $_POST["cantidad"];
echo "docu ".$documento= $_POST["documento"];
$cantiRe= $_POST['cantiRe'];
$idservicio= $_POST['idservicio'];


for($x =0 ; $x <= $val; $x++){
 
if(isset($_POST["num" . $x]) ) {
 
 //$Pro=  $_POST["i".$x ]; 
$docc= $_POST["ci_persona".$x ];
$nombre= $_POST["nombre".$x ];
$telefono= $_POST["telefono".$x ];
$correo= $_POST["correo".$x ];
$direccion= $_POST["direccion".$x ];
$ciudad= $_POST["ciudad".$x ];

$requi="SELECT COUNT(*) as cantidad FROM reserva_detalle where ci_persona='$docc' and idservicio='$idservicio'";
$se=$mysqli->query($requi);
$ser = $se->fetch_object();
$repetidor= $ser->cantidad;

$resultado=$repetidor+$x;
}else{
echo "faltadatos";
}

}

////trae informacion de base de datos
if($val==$resultado){

  $resull = "SELECT id_asientos,cantidad,cant_reserva,lugares,lugares_ocupados from stock where idstock='$idstock'";
            $resul = $mysqli->query($resull);
            $res2 = $resul->fetch_object();
            $id_asientos = $res2->id_asientos;
            $cantidad = $res2->cantidad;
            $cant_r = $res2->cant_reserva;
            $lugares = $res2->lugares;
            $lugaresO = $res2->lugares_ocupados;

////calcular el codigo lugar

 if($lugares>0 and $cantidad>0){

        $total= $cantidad - $id_asientos;
        $total_re= $cant_r+$id_asientos;
        $totaLuga=$lugares-1;
        $totaLugaRe=$lugaresO+1;
        
        }else{
         echo "<script>
                          alert('Cupo lleno')
                            history.go(-1);
                         
                  
                    </script>";
        }
  
///consulta si existe ese codigo de lugar
      if($resull==TRUE){
       
          $sqlc="SELECT cod_lugar FROM reserva_cabecera WHERE id_stock='$idstock' and idservicio='$idservicio'";
          $rspta = $mysqli->query($sqlc);
          $res2 = $rspta->fetch_object();
          $cod_lugarr = $res2->cod_lugar;


                      for($x =0 ; $x <= $cod_lugarr; $x++){
                          if($cod_lugarr==$totaLugaRe){

                            echo "<script>
                            alert('Por favor intente de nuevo el registro')
                              history.go(-1);
                          
                    
                      </script>
                      
                      ";
                          }
          }


          $sq = "UPDATE stock set cantidad='$total', cant_reserva='$total_re',
          lugares='$totaLuga', lugares_ocupados='$totaLugaRe'
          where idstock='$idstock'";
          $res = $mysqli->query($sq);
  
  
          $consulta2 = "INSERT INTO reserva_cabecera (id_stock,ci_titular,che,idservicio,cod_lugar)VALUES($idstock,'$documento',$cantiRe,$idservicio,$totaLugaRe)";
          $resul = $mysqli->query($consulta2);


      
        }


////obtiene el id cabecera de la persona

if($resul===TRUE){

    $resul = "SELECT MAX(idreserva_cabecera) as id from reserva_cabecera where ci_titular='$documento'";
    $resul = $mysqli->query($resul);
    $res2 = $resul->fetch_object();
    $idreserva = $res2->id;
   // $doco = $res2->ci_titular;

}


////inserta en detalle

for($x =0 ; $x <= $val; $x++)
 
if(isset($_POST["num" . $x]) ) {
 
 //$Pro=  $_POST["i".$x ]; 
$docc= $_POST["ci_persona".$x ];
$doctype= $_POST["doctype".$x ];
$nombre= $_POST["nombre".$x ];
$telefono= $_POST["telefono".$x ];
$correo= $_POST["correo".$x ];
$direccion= $_POST["direccion".$x ];
$ciudad= $_POST["ciudad".$x ];
//$titular= $_POST["titular"];

//$idLocal= $_POST["asientos"];

//$cant=0;
//echo "idstock   ".$doc;




      $sqls = "INSERT INTO reserva_detalle (idreserva_cabecera,ci_persona,doctype,nombre,telefono,correo,direccion,ciudad,idservicio)
      VALUES ('$idreserva','$docc','$doctype','$nombre','$telefono','$correo','$direccion','$ciudad','$idservicio')";
      $result = $mysqli->query($sqls);


    
}else{
    echo "falta datoss";



}



/////si todo esta bien actualiza el cod_lugar
        if($result==TRUE){
                    
          
        
        
     
        /*   $sql = "UPDATE reserva_cabecera set cod_lugar='$totaLugaRe' where idreserva_cabecera='$idreserva'";
           $resp = $mysqli->query($sql);*/
        
        
           $sql2 = "UPDATE reserva_detalle set cod_lugar='$totaLugaRe' where idreserva_cabecera='$idreserva'";
           $resp2 = $mysqli->query($sql2);
           
           
          // header ("Location: http://localhost:81/asientos/gracias.php");
           
      header ("Location: https://reservas.cfa.org.py/gracias.php?grupo=$cantiRe&lugar=$totaLugaRe&ci_persona=$docc");
        /// header ("Location: https://api.cfa.org.py/ws004.php?documento=$documento&amount=$amount&cc=$cc&currency=$currency&description=$description&descripcion=$descripcion");
        
    
  
    

     

      }else{    

      
          echo "noseguardoturesrva";
      }
      
      
}else{

 echo "<script>
        alert('Informamos que el ci $docc ya se encuentra registrado para este evento')
          history.go(-1);
       

  </script>
  
  ";


}
mysqli_close($mysqli); 




?>