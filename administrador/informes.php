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
require 'header.php';

if ($_SESSION['home']==1 and $_SESSION['nombre'])


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
                          <h1 class="box-title">Listado  Personas </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                                   
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-8">
                          
                        <label>Seleccionar Fecha Evento:</label>
                          <select id="idservicio" name="idservicio" class="form-control selectpicker" data-live-search="true" required></select>
                        
                        </div>

                        <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <label></label><br>
                        <button class="btn btn-success" onclick="listar()">Mostrar</button>
                        </div>

                      <!--   <div class="form-group col-lg-2 col-md-24 col-sm-2 ">
                            <label>Presentes:</label>
                            
                            <input type="text" class="form-control" name="presentes" id="presentes" value="<?php echo $vista; ?> " readonly>
                          </div>
                         <div class="form-group col-lg-2 col-md-2 col-sm-2">
                            <label>Ausentes:</label>
                           
                            <input type="text" class="form-control" name="ausentes" id="ausentes" readonly>
                          </div> -->


                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                          <th>Opciones</th>
                            <th>Documento</th>
                            <th>Tipo Doc.</th>
                            <th>Datos Personales</th>
                            <th>Telefono</th>
                            <th>Codigo</th>
                            <th>Hora</th>
                            <th>Asistencia</th>
                    
                           
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                         <th>Opciones</th>
                            <th>Documento</th>
                            <th>Tipo Doc.</th>
                            <th>Datos Personales</th>
                            <th>Telefono</th>
                          
                            <th>Codigo</th>
                            <th>Hora</th>
                            <th>Asistencia</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre:</label>
                            <input type="hidden" name="idcategoria" id="idcategoria">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Descripci??n:</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="256" placeholder="Descripci??n">
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
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
<script type="text/javascript" src="scripts/informes.js"></script>
<?php 
}
ob_end_flush();
?>


