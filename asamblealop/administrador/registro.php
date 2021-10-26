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
                         
                          <h1 class="box-title">Registro de Personas sin Reservas </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                 
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
       
                        </div>

              

                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                        
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Documento:</label>
                      
                            <input type="number" class="form-control" name="ci_persona" id="ci_persona" required>
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Tipo Doc</label>
                          <select id="doctype" name="doctype" class="form-control selectpicker" data-live-search="true" required>
                          <option value="CEDULA">CEDULA</option>
                            <option value="PASAPORTE">PASAPORTE</option>
                            <option value="DNI">DNI</option>
                             </select>
                        </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre y Apellido:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre"  required>
                          </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          
                          <label>Seleccione el Evento:</label>
                          <input type="hidden" name="idreserva_cabecera" id="idreserva_cabecera">
                            <select id="idservicio" name="idservicio" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>
                        
                         
                       
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Telefono:</label>
                            <input type="number" class="form-control" name="telefono" id="telefono"  required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Correo:</label>
                            <input type="email" class="form-control" name="correo" id="correo" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Direccion:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion"  required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Ciudad:</label>
                            <input type="text" class="form-control" name="ciudad" id="ciudad"  required>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Registrar Persona</button>

                           
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
<script type="text/javascript" src="scripts/registro.js"></script>


      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <script type="text/javascript"  src="../public/js/jquery-1.10.2.js"></script>
  <script type="text/javascript" src= "../public/jquery-ui-1.12.1/jquery-ui.js"></script>
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


