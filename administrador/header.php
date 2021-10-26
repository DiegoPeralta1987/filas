<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reserva de Lugares</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../images/icons/fvico.ico">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">

  </head>
  <body class="hold-transition skin-red-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
        
          <!-- logo for regular state and mobile devices -->
          <span ><b>CFA</b></span>
          
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Sidebar toggle button-->
          
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../public/dist/img/cfa.png" class="user-image" alt="User Image">
                  <span class="hidden-xs">RESERVA DE LUGARES</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../public/dist/img/cfa.png" class="img-circle" alt="User Image">
                    <p>
                      
                      <small>CENTRO FAMILIA DE ADORACIÓN</small>
                      <small></small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Cerrar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
 
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
                       
<li>
             <a href="dashboard.php">
                <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
              </a>
            </li>   

            <li>
             <a href="categoria.php">
                <i class="fa fa-bank"></i> <span>HOME</span>
              </a>
            </li>       
            <li>
             <a href="asientos.php">
             <i class="fa fa-calendar" aria-hidden="true"></i> <span>Conf. Asientos</span>
              </a>
              <a href="servicios.php">
              <i class="fa fa-clock-o" aria-hidden="true"></i><span>Conf. Horarios</span>
              </a>
              <a href="eventos.php">
              <i class="fa fa-clock-o" aria-hidden="true"></i><span>Registo de Eventos</span>
              </a>
            </li>       
                 <li>
             <a href="informes.php">
                <i class="fa fa-bank"></i> <span>Detalles por Eventos</span>
              </a>
            </li> 
             <li>
             <a href="detallee.php">
                <i class="fa fa-bank"></i> <span>Detalles Ujieres</span>
              </a>
            </li> 
                <li>
             <a href="total.php">
                <i class="fa fa-bank"></i> <span>Asistencia Total</span>
              </a>
            </li> 
                <li>
             <a href="control.php">
                <i class="fa fa-bank"></i> <span>Control de Asistencia</span>
              </a>
            </li> 
           <li>
             <a href="filas.php">
                <i class="fa fa-bank"></i> <span>Control de Cantidad</span>
              </a>
            </li> 
              <li>
             <a href="recargando.php">
                <i class="fa fa-bank"></i> <span>Carga de Cantidad X Evento</span>
              </a>
            </li> 
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>