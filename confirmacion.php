<?php 

require_once 'conexion.php';




		
if(isset($_POST["ci_persona"]) && isset($_POST["idservicio"])  && isset($_POST["codigo"]) ){
    $json=array();
    
    $documento	= $_POST['ci_persona'];
    $idservicio = $_POST['idservicio']; 
    $codigo = $_POST['codigo']; ///curso
    

   $sql="UPDATE reserva_detalle SET asistencia=2 ,fechaCancelacion=CURRENT_TIMESTAMP() 
     WHERE  ci_persona='$documento'  and idservicio='$idservicio' and cod_lugar='$codigo'";
      $res = $mysqli->query($sql);

            $sql2="SELECT asistencia FROM reserva_detalle where ci_persona='$documento' and idservicio='$idservicio' ";
            $res = $mysqli->query($sql2);
            $resy = $res->fetch_object();
            $asistencia = $resy->asistencia;
          


       if($asistencia==2){
           header ("Location: https://reservas.cfa.org.py/graciass.php?servicio=$idservicio");

       }else{
        printf("No se realizo la cancelacion verifique que su codigo sea el correcto");

       }

    //header ("Location: https://api.cfa.org.py/ws004.php?documento=$documento&amount=$amount&cc=$cc&currency=$currency&description=$description&descripcion=$descripcion");
//


        
}else
    printf("Falta algun datossss\n");


?>
</html>