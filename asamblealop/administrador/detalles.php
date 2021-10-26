<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'headerU.php';



if ($_SESSION['ujieres']==1 and $_SESSION['nombre'])
{
?>

<div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                         
                          <h1 class="box-title">Buscador de Personas con Reservas</a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>

                    <?php
                    require_once '../conexion.php'; 
                    $idreserva= $_GET['idreserva_cabecera'];

                    $sq="SELECT che from reserva_cabecera WHERE idreserva_cabecera=$idreserva";
                    $res= $mysqli->query($sq);
                    $resp= $res->fetch_object();
                    $can= $resp->che;
                 //   echo "dsa ".$can;

                    if($res==true){

                   
                    
                    $sql="SELECT id_reserva_cabecera,ci_persona, nombre,telefono,correo,
                    direccion, ciudad,asistencia
                    FROM filas.reserva_detalle
                    WHERE id_reserva_cabecera='$idreserva' ";
                    $r= $mysqli->query($sql);
                    $re = $r->fetch_object();
                    $id_reserva_cabecera= $re->id_reserva_cabecera;
                    $ci= $re->ci_persona;
                    $nombre= $re->nombre;
                    $telefono= $re->telefono;
                    $correo= $re->correo;
                    $direccion= $re->direccion;
                    $ciudad= $re->ciudad;
                    $asistencia= $re->asistencia;
                  }
                    ?>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="">
                    
                    
                        <table class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Id</th>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Asistencia</th>
                        
                            <th>Registrar</th>
                            
                            
                          </thead>
                          <tbody>                            
                          </tbody>

                          <?php
                    $cantidad=1;

                  while ($cantidad <= $can)
                  {
                          ?>
                      <form  action="actualizar" method="POST">
                                <tr>
                               
                                <td><input type="text" name="id_reserva_cabecera<?php echo "$cantidad";?>" value="<?php echo $id_reserva_cabecera ?>" readonly > </td>
                                <td><input type="text" name="ci_persona<?php echo "$cantidad";?>" value="<?php echo $ci ?>" readonly > </td>
                                <td><input type="text" name="nombre<?php echo "$cantidad";?>" value="<?php echo $nombre ?>" readonly > </td>
                                <td><input type="text" name="asistencia<?php echo "$cantidad";?>" value="<?php echo $asistencia ?>" readonly > </td>
                                                              
                                <td > <input type="checkbox" id="asistencia" name="asistencia" value="1" ></td>
                                </tr>
                             
                             
                             
                            <?php
                            $cantidad++;
                            }
                            ?>
                                                                                    
                         <tr>
                          <td colspan="8" align="right">
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" onclick="guardaryeditar()" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="location.href='http://localhost:81/asientos/administrador/ujieres.php'" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        
                          </td>
                          </tr>
                          </tfoot>
                                
                        </table>
                        
                        </form>
                       
                         
                    </div>
                    
                    </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->
    

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/detalles.js"></script>
<?php 
}
ob_end_flush();
?>


