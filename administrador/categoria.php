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
                         
                          <h1 class="box-title">Configuración de Reservas <button class="btn btn-success" id="btnagregar" onclick="mostrarform2(true)">
                          <i class="fa fa-plus-circle"></i> Agregar</button></a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                    

                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Horario</th>
                             <th>Evento</th>
                            <th>Turno</th>
                            <th>Estado</th>
                          
                         
                           
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Horario</th>
                            <th>Evento</th>
                            <th>Turno</th>
                            <th>Estado</th>
                       
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
       
                          <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        
                          <thead style="background-color:#A9D0F5">
                                  <th>Opciones</th>
                                  <th>Artículo</th>
                                  <th>Cantidad</th>
                                  <th>Precio Venta</th>
                                  <th>Descuento</th>
                                  <th>Subtotal</th>
                              </thead>
                              <tfoot>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th> 
                              </tfoot>
                              <tbody>
                                
                              </tbody>
                          </table>
                        </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>

                    <div class="panel-body" style="height: 400px;" id="formularioregistros2">
                        <form name="formulario2" id="formulario2" method="POST">
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Lugares:</label>
                            <input type="number" class="form-control" name="lugares" id="lugares" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Grupo de Personas:</label>
                          <select id="id_asientos" name="id_asientos" class="form-control selectpicker" data-live-search="true" required></select>
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Cantidad:</label>
                            <input type="number" class="form-control" name="cantidad" id="cantidad" readonly required>
                          </div>
                          
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          
                        <label>Fecha Evento:</label>
                          <select id="idservicio" name="idservicio" class="form-control selectpicker" data-live-search="true" required></select>
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
else if ($_SESSION['ujieres']==1 and $_SESSION['nombre'] ){ 

	header("Location: detallee.php");
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/categoria.js"></script>
<script>
$(document).ready(function($){
 var mont;
 $('#lugares').keyup(function(e){
   mont = $(this).val();
 })
 
 $('select#id_asientos').on('change',function(){
 var valor =$(this).val();
 var total= parseFloat(valor)* parseFloat(mont);
   $("#cantidad").val(total);
 })
 
 });
 
</script>
<?php 
}
ob_end_flush();
?>


