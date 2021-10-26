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
  require_once "../modelos/dashboard.php";
  $consulta = new Consulta();
  //total usuario
  $rusu= $consulta->cantUsuario();
  $regu=$rusu->fetch_object();
  $totalusu=$regu->tot_us;

   //total evento
  $rse= $consulta->cantServ();
  $regs=$rse->fetch_object();
  $totalser=$regs->tot_ser;

  //total persona
  $rsp= $consulta->cantPer();
  $regp=$rsp->fetch_object();
  $totalper=$regp->tot_per;

  //grafico eventos
  $eventos=$consulta->totEvento();
  $even='';
  $eventot='';
  while ($regeven=$eventos->fetch_object()) {
    $even=$even.'"'.$regeven->evento.'",';
    $eventot=$eventot.$regeven->tot_ins.',';
  }
  //sacamos la ultima coma
  $even=substr($even,0,-1);
  $eventot=substr($eventot,0,-1);

   //grafico asistencia
  $asistencia=$consulta->totAsistencia();
  $asis='';
  $asistot='';
  while ($regasis=$asistencia->fetch_object()) {
    $asis=$asis.'"'.$regasis->asistencia.'",';
    $asistot=$asistot.$regasis->total_asis.',';
  }
  //sacamos la ultima coma
  $asis=substr($asis,0,-1);
  $asistot=substr($asistot,0,-1);

   //grafico inscriptos por mes
  $mes=$consulta->totMes();
  $meses='';
  $mestot='';
  while ($regmes=$mes->fetch_object()) {
    $meses=$meses.'"'.$regmes->mes.'",';
    $mestot=$mestot.$regmes->total.',';
  }
  //sacamos la ultima coma
  $meses=substr($meses,0,-1);
  $mestot=substr($mestot,0,-1);

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
                         
                          <h1 class="box-title">Dashboard</a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    
                      <div class="small-box bg-aqua">
                        <div class="inner text-center">
                          <h4 style="font-size: 17px">
                            <strong><?php echo $totalusu;?></strong>
                          </h4>
                          <p>Total Usuarios</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-settings"></i>
                        </div>
                        <a href="#" class="small-box-footer">Usuarios<i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                       
                    </div>

                    <!-- box2-->

                    <div class="panel-body col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    
                      <div class="small-box bg-green">
                        <div class="inner text-center">
                          <h4 style="font-size: 17px">
                            <strong><?php echo $totalser;?></strong>  
                          </h4>
                          <p>Total Eventos</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                         <a href="#" class="small-box-footer">Eventos<i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                       
                    </div>
                    <!-- box3-->
                    <div class="panel-body col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    
                      <div class="small-box bg-orange">
                        <div class="inner text-center">
                          <h4 style="font-size: 17px">
                            <strong><?php echo $totalper;?></strong>
                          </h4>
                          <p>Personas Registradas</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-person-add"></i>
                        </div>
                         <a href="#" class="small-box-footer">Personas<i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                       
                    </div>


                    <div class="panel-body">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="box box-primary">
                            <div class="box-header with-border">
                              Total Inscriptos por Eventos
                            </div>
                            <div class="box-body">
                              <canvas id=eventosbar width="600" height="400"></canvas>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="box box-primary">
                            <div class="box-header with-border">
                              Total Asistencia
                            </div>
                            <div class="box-body">
                              <canvas id=asisbar width="600" height="400"></canvas>
                            </div>
                          </div>
                        </div>
                    </div>


                    <div class="panel-body" >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                            <div class="box box-primary">
                              <div class="box-header with-border" >
                               Total Registros Mensuales
                              </div>
                              <div class="box-body" >
                                <canvas id="mesgraf" ></canvas>
                              </div>
                            </div>
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
else if ($_SESSION['ujieres']==1 and $_SESSION['nombre'] ){ 

	header("Location: detallee.php");
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script src="js/Chart.bundle.min.js"></script>
<script src="js/Chart.min.js"></script>
<!-- primer chart-->
<script type="text/javascript">
  var ctx = document.getElementById('eventosbar').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: [<?php echo $even  ?>],
        datasets: [{
            label: 'Total Inscriptos por Eventos',
            backgroundColor: 'rgb(0,225,225)',
            borderColor: 'rgb(0, 0, 255)',
            data: [<?php echo  $eventot ; ?>]
        }]
    },

    // Configuration options go here
    options: {}
});

</script>

<script type="text/javascript">
  var asis = document.getElementById('asisbar');
var asistencia = new Chart(asis, {
    type: 'bar',
    data: {
        labels: [<?php echo $asis; ?>],
        datasets: [{
            label: 'Total Asistencia',
            data: [<?php echo $asistot ?>],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)',
               
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
<!--line chart por mes-->
<script type="text/javascript">
  var mes = document.getElementById('mesgraf');
var meschart = new Chart(mes, {
    type: 'bar',
    data: {
        labels: [<?php echo $meses; ?>],
        datasets: [{
            label: 'Total por Mes',
            data: [<?php echo $mestot;?>],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 160, 230, 0.2)',
                'rgba(255, 119, 132, 0.2)',
               
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 160, 230, 0.2)',
                'rgba(255, 119, 132, 0.2)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

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
