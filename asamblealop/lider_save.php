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
$correo= $_POST['correo'];

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
              
          
          
          
               
               $requi= "SELECT count(ci_persona) as cantidad
               FROM 
                   filas.lideres_asis 
               where 
                       ci_persona='$docc'  and asistencia !=2 ";

               
               
              $se=$mysqli->query($requi);
              $ser = $se->fetch_object();
              $repetidor= $ser->cantidad;
          
              $resultado=$repetidor+$x;
          
              
              }
          }


      
      ////trae informacion de base de datos
      if($val==$resultado){

       
                      
                    for($x =1 ; $x <= $val; $x++)
                     
                    if(isset($_POST["num" .$x]) ) {
                     
                     
                            $doccc= $_POST["ci_persona".$x ];
                           $nombre= $_POST["nombre".$x ];
                            $correo= $_POST["correo".$x ];
                          
                            
                            
                
                       $consulta2 = "INSERT INTO lideres_asis (ci_persona,nombre,idservicio,correo)
                        VALUES($doccc,'$nombre','$idservicio','$correo')";
                        $resultade = $mysqli->query($consulta2);
        
              }
          
         
               
        
            
        
        
        ////obtiene el id cabecera de la persona
        
        
        
        /////si todo esta bien actualiza el cod_lugar
                if($resultade==TRUE){
                            
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
                   
              header ("Location:  https://reservas.cfa.org.py/asamblea/gracias.php?grupo=$varibale&ci_persona=$docc&idreserva=$idservicio");
                /// header ("Location: https://api.cfa.org.py/ws004.php?documento=$documento&amount=$amount&cc=$cc&currency=$currency&description=$description&descripcion=$descripcion");
                
               
          
            
        
             
        
              }else{    
        
        
        
                    
            
            }
              
                  
    }else{
    
     echo "<script>
            alert('Informamos que el ci $docc ya se encuentra registrado para este dia')
              history.go(-1);
           
    
      </script>
      
      ";
    
    
    }
}
mysqli_close($mysqli); 




?>