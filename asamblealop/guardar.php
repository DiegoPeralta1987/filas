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


$val= $_POST['cantiReserva'];
$idstock= $_POST["idstock"];
$documento= $_POST["documento"];
$idservicio= $_POST['idservicio'];

  $que= "SELECT s.idstock, a.cantidad as cantiReserva, s.cantidad
  FROM stock s
  INNER JOIN asientos a on s.id_asientos=a.id_asientos
  where s.idservicio='$idservicio' and s.idstock='$idstock' and s.estado=1";
  $resuly = $mysqli->query($que);
  $resy = $resuly->fetch_object();
  $cantiReserva = $resy->cantiReserva;
  $cantidadtotal= $resy->cantidad;
  
  
   if($cantidadtotal>=$cantiReserva ){
          
          for($x =0; $x <= $val; $x++){
           
              if(isset($_POST["ci_persona" . $x]) ) {
              
          
                $docc= $_POST["ci_persona".$x ];
                $doctype= $_POST["doctype".$x ];
                $nombre= $_POST["nombre".$x ];
                $telefono= $_POST["telefono".$x ];
                $correo= $_POST["correo".$x ];
                $direccion= $_POST["direccion".$x ];
                $ciudad= $_POST["ciudad".$x ];
          
          
          
          /*
              $requi="SELECT COUNT(*) as cantidad FROM reserva_detalle where
               ci_persona='$docc' and idservicio='$idservicio'";*/
               
               $requi= "SELECT count(ci_persona) as cantidad
                FROM 
                	filas.v_contador 
                where 
                		ideventos=(SELECT ideventos FROM filas.servicios where idservicio='$idservicio' ) 
                		and estado=1 
                		and ci_persona='$docc'  and asistencia !=2 ";

               
               
              $se=$mysqli->query($requi);
              $ser = $se->fetch_object();
              $repetidor= $ser->cantidad;
          
              $resultado=$repetidor+$x;
          
              
              }
          }



////trae informacion de base de datos
if($val==$resultado){

  $resull = "SELECT cantidad,cant_reserva from stock where idstock='$idstock'";
  $resul = $mysqli->query($resull);
  $res2 = $resul->fetch_object();
   $cantidad = $res2->cantidad;
  $cant_reserva = $res2->cant_reserva;
 

////calcular el codigo lugar

 if($cantidad>0){

        $total= $cantidad - $val;
        $total_re= $cant_reserva+$val;
                
        $sq = "UPDATE stock set cantidad='$total', cant_reserva='$total_re',lugares=0,lugares_ocupados=0
        where idstock='$idstock'";
        $res = $mysqli->query($sq);
      

        
        
        }else{
         echo "<script>
                          alert('Cupo lleno')
                            history.go(-1);
                         
                  
                    </script>";
        }
  
///consulta si existe ese codigo de lugar
      $consulta1 = "SELECT count(ci_persona) as cantidad
                FROM 
                	filas.v_contador 
                where 
                		ideventos=(SELECT ideventos FROM filas.servicios where idservicio='$idservicio' ) 
                		and estado=1 
                		and ci_persona='$docc'  and asistencia !=2";
      $resul = $mysqli->query($consulta1);
      $res2 = $resul->fetch_object();
      $ci_titu = $res2->cantidad;
     

      if($ci_titu>0 ){
        echo "<script>
        alert('Ya tiene una reserva esta persona con cedula nro $documento')
          history.go(-1);
       

  </script>";

      }else{

  

       $consulta2 = "INSERT INTO reserva_cabecera (id_stock,ci_titular,che,idservicio)
        VALUES($idstock,'$documento',$val,$idservicio)";
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

for($x =1 ; $x <= $val; $x++)
 
if(isset($_POST["num" .$x]) ) {
 
 
$docc= $_POST["ci_persona".$x ];
$doctype= $_POST["doctype".$x ];
$nombre= $_POST["nombre".$x ];
$telefono= $_POST["telefono".$x ];
$correo= $_POST["correo".$x ];
$direccion= $_POST["direccion".$x ];
$ciudad= $_POST["ciudad".$x ];


      $sqls = "INSERT INTO reserva_detalle (idreserva_cabecera,ci_persona,doctype,nombre,telefono,correo,direccion,ciudad,idservicio)
      VALUES ('$idreserva','$docc','$doctype','$nombre','$telefono','$correo','$direccion','$ciudad','$idservicio')";
      $result = $mysqli->query($sqls);
   

    
}else{
    echo "---falta datoss///";



}



/////si todo esta bien actualiza el cod_lugar
        if($result==TRUE){
                    
          $resul = "SELECT i.ideventos,c.contador
          from servicios i
          inner join contador c on i.ideventos=c.idventos
          where i.idservicio='$idservicio'";
          $resul = $mysqli->query($resul);
          $res2 = $resul->fetch_object();
          $contador = $res2->contador;
          $ideventos = $res2->ideventos;

          $premio=$contador+1;
    
     
         $sql = "UPDATE contador set contador='$premio' where idventos='$ideventos'";
           $resp = $mysqli->query($sql);
                
          // header ("Location: http://localhost:81/asientos/gracias.php");

          $varibale=$premio.$documento;
           
      header ("Location:  https://reservas.cfa.org.py/asamblea/gracias.php?grupo=$varibale&lugar=$ideventos&ci_persona=$documento&idreserva=$idreserva&correo=$correo&nombre=$nombre");
        /// header ("Location: https://api.cfa.org.py/ws004.php?documento=$documento&amount=$amount&cc=$cc&currency=$currency&description=$description&descripcion=$descripcion");
        
       
  
    

     

      }else{    


        
        if($res==TRUE){

          $total= $cantidad + $val;
        $total_re= $cant_reserva - $val;

        $sq = "UPDATE stock set cantidad='$total', cant_reserva='$total_re',lugares=0,lugares_ocupados=0
        where idstock='$idstock'";
        $res = $mysqli->query($sq);

        echo "<script>
        alert('Intente nuevo la registracion')
          history.go(-1);
       

        </script>
        
        ";
      


      }
    }
      
      
}else{

 echo "<script>
        alert('Informamos que el ci $docc ya se encuentra registrado para este dia')
          history.go(-1);
       

  </script>
  
  ";


}

} else{

echo "<script>
alert('Lo sentimos llegamos al limite de la reserva')
  history.go(-1);


</script>

";

} 
mysqli_close($mysqli); 




?>