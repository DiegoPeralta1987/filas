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
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
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
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros"> 

                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                          <th>Opciones</th>
                            <th>Documento</th>
                            <th>Nombre-Apellido</th>
                            <th>Cant. Reserva</th>
                            <th>Evento</th>
                            <th>Fecha</th>
                            
                           
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                            <th>Documento</th>
                            <th>Nombre-Apellido</th>
                            <th>Cant. Reserva</th>
                            <th>Evento</th>
                            <th>Fecha</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                  

                        <form >

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Cedula</label>
                            
                            
                            <input type="text" class="form-control" name="ci_persona" id="ci_persona" readonly required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" readonly required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Telefono:</label>
                          
                            <input type="text" class="form-control" name="telefono" id="telefono" readonly required>
                          </div>
                         
                          </form>
                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                          
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                          
                            <thead style="background-color:#A9D0F5">
                                  
                                <tbody>
                                  
                                </tbody>
                            </table>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        
                    </div>
                    <!--Fin centro -->
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


