<?php
    require 'conexion.php';
    
    $query = "SELECT s.idservicio,  DATE_FORMAT(s.fecha, '%d-%m-%Y') as fecha,  s.horario , e.evento,st.cantidad
FROM filas.servicios s
INNER JOIN eventos e on s.ideventos=e.ideventos
INNER JOIN stock st on s.idservicio=st.idservicio
where s.estado=1 and e.condicion=1 and   s.ideventos =76 ";
    $resultado=$mysqli->query($query);
    

    $query2 = "SELECT s.idservicio,  DATE_FORMAT(s.fecha, '%d-%m-%Y') as fecha, s.horario,  e.evento,st.cantidad
    FROM filas.servicios s
    INNER JOIN eventos e on s.ideventos=e.ideventos
    INNER JOIN stock st on s.idservicio=st.idservicio
    where s.estado=1 and e.condicion=1 and s.ideventos!= 3 and s.ideventos !=72 and s.ideventos!=22 and s.ideventos!=28 ORDER BY fecha asc";
        $resultado2=$mysqli->query($query2);

        $query3 = "SELECT s.idservicio,  DATE_FORMAT(s.fecha, '%d-%m-%Y') as fecha,  s.horario, e.evento,st.cantidad
        FROM filas.servicios s
        INNER JOIN eventos e on s.ideventos=e.ideventos
        INNER JOIN stock st on s.idservicio=st.idservicio
        where s.estado=1 and e.condicion=1   and s.ideventos=22";
            $resultado3=$mysqli->query($query3);
            
               $query4 = "SELECT s.idservicio,  DATE_FORMAT(s.fecha, '%d-%m-%Y') as fecha,  s.horario, e.evento,st.cantidad
            FROM filas.servicios s
            INNER JOIN eventos e on s.ideventos=e.ideventos
            INNER JOIN stock st on s.idservicio=st.idservicio
            where s.estado=1 and e.condicion=1";
            $resultado4=$mysqli->query($query4);
?>

<!DOCTYPE html>
<html>
<head>
<title>Reservas de Asamblea</title>
  <link rel="shortcut icon" type="image/x-icon" href="public/img/favicon.ico">
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

<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script language="javascript" src="js/jquery-3.1.1.min.js"></script>
        
        <script language="javascript">
            $(document).ready(function(){ 
                $("#cbx_estado").change(function () {

                    $('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
                    
                    $("#cbx_estado option:selected").each(function () {
                        idservicio = $(this).val();
                        $.post("includes/getStock.php", { idservicio: idservicio }, function(data){
						

                           $("#cbx_municipio").html(data);
                        });            
                    });
                })
            });
            
            $(document).ready(function(){
                $("#cbx_municipio").change(function () {
                    $("#cbx_municipio option:selected").each(function () {
                        idstock = $(this).val();
                        
                        $.post("insert.php", { idstock: idstock }, function(data){
                    
                        });            
                    });
                })
            });
        </script>


         <script language="javascript">
            $(document).ready(function(){ 
                $("#cbx_estado2").change(function () {

                    $('#cbx_localidad2').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
                    
                    $("#cbx_estado2 option:selected").each(function () {
                        idservicio = $(this).val();
                        $.post("includes/getStock.php", { idservicio: idservicio }, function(data){
                            $("#cbx_municipio2").html(data);
                        });            
                    });
                })
            });
            
            $(document).ready(function(){
                $("#cbx_municipio").change(function () {
                    $("#cbx_municipio option:selected").each(function () {
                        idstock = $(this).val();
                        
                        $.post("insert.php", { idstock: idstock }, function(data){
                    
                        });            
                    });
                })
            });
        </script>
		 <script language="javascript">
            $(document).ready(function(){ 
                $("#cbx_estado3").change(function () {

                    $('#cbx_localidad3').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
                    
                    $("#cbx_estado3 option:selected").each(function () {
                        idservicio = $(this).val();
                        $.post("includes/getStock.php", { idservicio: idservicio }, function(data){
                            $("#cbx_municipio3").html(data);
                        });            
                    });
                })
            });
            
            $(document).ready(function(){
                $("#cbx_municipio").change(function () {
                    $("#cbx_municipio option:selected").each(function () {
                        idstock = $(this).val();
                        
                        $.post("insert.php", { idstock: idstock }, function(data){
                    
                        });            
                    });
                })
            });
        </script>
<!-- start-smoth-scrolling -->
</head>
    
<body>
<!-- header
    <div class="agileits_header">
        <div class="container">
            <div class="w3l_offers">
                <p>SALE UP TO 70% OFF. USE CODE "SALE70%" . <a href="products.html">SHOP NOW</a></p>
            </div>
            <div class="agile-login">
                <ul>
                    <li><a href="registered.html"> Create Account </a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="contact.html">Help</a></li>
                    
                </ul>
            </div>
            <div class="product_list_header">  
                    <form action="#" method="post" class="last"> 
                        <input type="hidden" name="cmd" value="_cart">
                        <input type="hidden" name="display" value="1">
                        <button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
                    </form>  
            </div>
            <div class="clearfix"> </div>
        </div>
    </div> -->

    <div class="logo_products">
        <div class="container">
        <div class="w3ls_logo_products_left1">
            <!--    <ul class="phone_email">
                    <li><i class="fa fa-phone" aria-hidden="true"></i>Order online or call us : (+0123) 234 567</li>
                    
                </ul>-->
            </div>
            <div class="w3ls_logo_products_left">
                <img src="public/img/logoes1.png" width="280" height="80" alt="">
            </div>

            
            <div class="clearfix"> </div>
        </div>
    </div>
<!-- //header -->
<!-- navigation -->
<div class="container" >
    <div class="navigation-agileits" align="center">
        <nav class="navbar navbar-default">
            <h5>&nbsp;</h5>
            <h1><a href="index.php" style="color: white;">RESERVAS PARA ASAMBLEA 2021</a></h1>
        <h5>&nbsp;</h5>
            
            <!-- <div class="navbar-header nav_2">
                                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
              
              <div >
                <img src="public/img/protocolo.png" class="container-2">
            </div>
              -->
                
        </div>

                

      
        <div class="cabezon"> 
                <H1 class="letrasColor">Reuni&oacute;n Virtual</H1>
              
                </div>
        <div class="container">
                
            <br>
    
</div>  

    <div class="top-brands">
        <div class="container">
        <h2>REGISTR&Aacute; TU ASISTENCIA</h2>
            <div class="grid_3 grid_5">
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <!--    <li role="presentation" class="active"><a href="#expeditions"
                             id="expeditions-tab" role="tab" data-toggle="tab" aria-controls="expeditions" aria-expanded="true">Planta Baja</a></li>
                        <li role="presentation"><a href="#tours" role="tab" id="tours-tab" data-toggle="tab" aria-controls="tours">Planta alta</a></li> -->
                    </ul>

                    <div class="tab">
  <button class="tablinks active" onclick="openCity(event, 'Cultos')">ASAMBLEA</button>

</div>

<div id="Cultos" class="tabcontent"  style="display: block;">
<br>



<form id="combo" name="combo" action="insertando.php" method="POST">

<div>
                        
		<label><img src="public/img/calendar.png" width="25" height="25"/></i>&nbsp;Selecciona D&iacute;a y Hora: </label>
			
		<select name="cbx_estado" id="cbx_estado" required class="cajaTexto" >
			
			<option value="0">&nbsp;Fecha del Eventos</option>
			<?php while($row = $resultado->fetch_assoc()) { ?>
				<option  value="<?php echo $row['idservicio']; ?>"><?php echo $row['fecha']; ?>-<?php echo $row['horario']; ?>-<?php if($row['horario']<'12:00:00'){ echo 'AM';}else{echo'PM';} ?>-<?php echo $row['evento']; ?></option>
			
				
			<?php } ?>
			
	
			</select>
			
	</div>
		
		<br />
		
		<div>   <label><img src="public/img/face2.png" width="25" height="25"/>&nbsp;Lugares Disponibles : </label>
	
		<select name="cbx_municipio" id="cbx_municipio" readonly required></select>
		</div>


		
	<br>
	<div>   <label><img src="public/img/anotador.png" width="25" height="25"/>&nbsp;C.I. del Participante: </label>
	<input type="text" name="documento" maxlength="15" required placeholder="1234567" pattern="[A-Za-z0-9]+" required placeholder="1234567" 
                title="Solo Letras y Numeros" >

	</div>
		<br />
		

						<input type="submit" id="enviar1" name="enviar1" value="REGISTRAR"  />

</form>
        

</div>














<div id="Otros Eventos" class="tabcontent">
<br>
<form id="combo2" name="combo2" action="insert.php" method="POST">
                                        
            <div>
                        
                    <label><img src="public/img/calendar.png" width="25" height="25"/></i>&nbsp;Selecciona D&iacute;a y Hora: </label>
                        
                    <select name="cbx_estado" id="cbx_estado2" required class="cajaTexto">
                        
                        <option value="0">&nbsp;Fecha del Evento</option>
                        <?php while($row = $resultado2->fetch_assoc()) { ?>
                            <option value="<?php echo $row['idservicio']; ?>"><?php echo $row['fecha']; ?>||<?php echo $row['horario']; ?>-<?php echo $row['evento']; ?></option>
                        
                            
                        <?php } ?>
                        
                
                        </select>
                        
                </div>
                    
                    <br />
                    
                    <div>   <label><img src="public/img/face2.png" width="25" height="25"/>&nbsp;Lugares Disponibles : </label>
                        
                    <select name="cbx_municipio" id="cbx_municipio2" readonly required></select>
                    </div>
                <br>
                <div>   <label><img src="public/img/anotador.png" width="25" height="25"/>&nbsp;C.I. del Participante: </label>
                <input type="text" name="documento" maxlength="15" pattern="[A-Za-z0-9]+" required placeholder="1234567" 
                title="Solo Letras y Numeros">

                </div>
                    <br />
                    
            
                    <input type="submit" id="enviar" name="enviar" value="REGISTRAR" />
        </form>
        

</div>

<div id="Cultos de 3ra Edad" class="tabcontent">

<br>
<form id="combo3" name="combo3" action="insert.php" method="POST">
                                        
    <div>
                
            <label><img src="public/img/calendar.png" width="25" height="25"/></i>&nbsp;Selecciona D&iacute;a y Hora: </label>
                
            <select name="cbx_estado" id="cbx_estado3" required class="cajaTexto">
                
                <option value="0">&nbsp;Fecha del Evento</option>
                <?php while($row = $resultado3->fetch_assoc()) { ?>
                    <option value="<?php echo $row['idservicio']; ?>"><?php echo $row['fecha']; ?>||<?php echo $row['horario']; ?>-<?php echo $row['evento']; ?></option>
                
                    
                <?php } ?>
                
        
                </select>
                
        </div>
            
            <br />
            
            <div>   <label><img src="public/img/face2.png" width="25" height="25"/>&nbsp;Lugares Disponibles : </label>
                
            <select name="cbx_municipio" id="cbx_municipio3" required></select>
            </div>
        <br>
        <div>   <label><img src="public/img/anotador.png" width="25" height="25"/>&nbsp;C.I. del Participante: </label>
        <input type="text" name="documento" maxlength="15" pattern="[A-Za-z0-9]+" required placeholder="1234567">

        </div>
            <br />
            
    
            <input type="submit" id="enviar" name="enviar" value="REGISTRAR" />
</form>
        

  
</div>
                
<div id="reservas" class="tabcontent" >
<br>



<form id="combo4" name="combo4" action="cancelar.php" method="POST">

<div>
                        
		<label><img src="public/img/calendar.png" width="25" height="25"/></i>&nbsp;Selecciona D&iacute;a y Hora: </label>
			
		<select name="cbx_estado" id="cbx_estado" required class="cajaTexto" >
			
			<option value="0">&nbsp;Fecha del Evento</option>
			<?php while($row = $resultado4->fetch_assoc()) { ?>
				<option  value="<?php echo $row['idservicio']; ?>"><?php echo $row['fecha']; ?>-<?php echo $row['horario']; ?>-<?php if($row['horario']<'12:00:00'){ echo 'AM';}else{echo'PM';} ?>-<?php echo $row['evento']; ?></option>
			
				
			<?php } ?>
			
	
			</select>
			
	</div>
		
	<br>
	<div>   <label><img src="public/img/anotador.png" width="25" height="25"/>&nbsp;C.I. del Participante: </label>
	<input type="text" name="documento" maxlength="15" required placeholder="1234567" pattern="[A-Za-z0-9]+" required placeholder="1234567" 
                title="Solo Letras y Numeros" >

	</div>
		<br />
		

						<input type="submit" id="enviar1" name="enviar1" value="Enviar"  />

</form>
        

</div>

<br>
     
<!--
<div id="myTabContent" class="tab-content">
            
                            <form id="combo" name="combo" action="insert.php" method="POST">
                                        
                                <div>
                                            
                                        <label><img src="public/img/calendar.png" width="25" height="25"/></i>&nbsp;Selecciona Dia y Hora: </label>
                                            
                                        <select name="cbx_estado" id="cbx_estado" required class="cajaTexto">
                                            
                                            <option value="0">&nbsp;Fecha del Evento</option>
                                            <?php while($row = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['idservicio']; ?>"><?php echo $row['fecha']; ?>||<?php echo $row['horario']; ?>-<?php echo $row['evento']; ?></option>
                                            
                                                
                                            <?php } ?>
                                            
                                    
                                            </select>
                                            
                                    </div>
                                        
                                        <br />
                                        
                                        <div>   <label><img src="public/img/face2.png" width="25" height="25"/>&nbsp;Lugares Disponibles : </label>
                                            
                                        <select name="cbx_municipio" id="cbx_municipio" required></select>
                                        </div>
                                    <br>
                                    <div>   <label><img src="public/img/anotador.png" width="25" height="25"/>&nbsp;C.I. del Participante: </label>
                                    <input type="text" name="documento" maxlength="15" pattern="[A-Za-z0-9]+" required placeholder="1234567">

                                    </div>
                                        <br />
                                        
                                
                                        <input type="submit" id="enviar" name="enviar" value="REGISTRAR" />
                            </form>
                                            -->
                    
                            
                                
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
<!--
    <div class="container" align="center">
        <div class="toopo">
            <h5>&nbsp;</h5>
            <h1>Protocolo de acceso y circulaci&oacute;n</h1>
            <p>por tu seguridad y la mia. Juntos nos cuidamos.</p><br>
            <button class="boton_personalizado"><a  href="https://cfa.org.py/#8"> Conocer mas</a></button>
        <h4>&nbsp;</h4>
            
        </div>
    </div>
-->
<style>

</style>
<br>
<br>

<!-- //new -->
<!-- //footer -->
<div class="container" >
    <div class="navigation-agileits" align="center">
        
        <div class="" style="color: white">
        <h5>&nbsp;</h5>
                <p>&copy;2021 Todos los Derechos Reservados |<a href="https://cfa.org.py/" style="color: white">CENTRO FAMILIAR DE ADORACI&Oacute;N</a></p>
            <h5>&nbsp;</h5>
            </div>
            
    
        </div>
        </div>
 
<!-- 
<div >
        
        
        <div class="">
            
            <div class="container footer">
                <p>?2020 All rights reserved | CFA-TI <a href="https://cfa.org.py/">CENTRO FAMILIAR DE ADORACI&Oacute;N</a></p>
            </div>
        </div>
        
    </div>  

//footer -->    
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- top-header and slider -->
<!-- here stars scrolling icon -->

<!-- //here ends scrolling icon -->
<script src="js/minicart.min.js"></script>
<script>
    // Mini Cart
    paypal.minicart.render({
        action: '#'
    });

    if (~window.location.search.indexOf('reset=true')) {
        paypal.minicart.reset();
    }
</script>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;

  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
 
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #337ab7;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
   
<!-- main slider-banner -->
<script src="js/skdslider.min.js"></script>
<link href="css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
                        
            jQuery('#responsive').change(function(){
              $('#responsive_wrapper').width(jQuery(this).val());
            });
            
        });
</script>   

<script>


    var cbx_estado = document.getElementById("cbx_estado");

        
    cbx_estado.onchange = function(e) {

        var cbx_municipio = document.getElementById("cbx_municipio").value;
        var myTextw = document.getElementById("myTextw");
       
        if(cbx_municipio!="999"){
            myTextw.hidden=true;
        } else if(cbx_municipio=="999"){
            myTextw.hidden=false;
            
        }
        

        }; 

</script>
<!-- //main slider-banner --> 
</body>
</html>
