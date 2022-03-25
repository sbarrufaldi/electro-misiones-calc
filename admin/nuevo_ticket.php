<?php

	include ("conex.php");

//	--------------------------------

	session_name("ticket_admin");

	session_start();	

//	--------------------------------

    $link = conectar();

	$hoy = new DateTime();
	$diadelasemanaHoy = $hoy->format('w');

	if(isset($_REQUEST['notificacion'])){ $_SESSION['notificaciones'] = $_REQUEST['notificacion']; }

	mysqli_set_charset($link, 'utf8');

	if(time()-$_SESSION["login_time_stamp"] > 3600)   
    { 
        session_unset(); 
        session_destroy(); 
        enviar("login_cerrar.php");
    }
	else{
		$_SESSION["login_time_stamp"] = time();
	}

	if(isset($_SESSION['usuario']))

	{

?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="es">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Tickets | Nuevo ticket</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Control de Pañol">
    <meta name="msapplication-tap-highlight" content="no">
	
<link href="../main.css" rel="stylesheet">
<link href="../assets/dataTables/dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="../assets/dataTables/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="../assets/dataTables/dataTables.min.js"></script>
	
<style>

input[type=text], input[type=number], input[type=float], select {
  width: 100%;
  padding: 8px 20px;
  margin: 10px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 2rem;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #178d44;
  color: white;
  padding: 10px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 100px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #168c43;
}

.upload {
    height: 50px;
}

.form-popup {

        display: none;

        background-color: white;

        position: absolute;

        top: 15%;

        width: 50%;

        left: 25%;

        border: 3px solid #f1f1f1;

        z-index: 9;
	
		height : 0px;

        padding-bottom: 8px;

        border-radius: 30px;

    }
	
.form-popup-error {

        display: none;

        background-color: white;

        position: absolute;

        top: 15%;

        width: 30%;

        left: 35%;

        border: 3px solid #cb4b6552;

        z-index: 9;

        padding-bottom: 8px;

        border-radius: 30px;

    }



@media 

only screen and (max-width: 760px),

(min-device-width: 768px) and (max-device-width: 1024px)  {

/* The popup form - hidden by default */

    .form-popup {

        display: none;

        background-color: white;

        position: absolute;

        top: 15%;

        width: 80%;

        left: 10%;

        border: 3px solid #f1f1f1;

		z-index: 9;
		
		height : 0px;

        padding-bottom: 8px;

        border-radius: 30px;

    }
	
	.form-popup-error {

        display: none;

        background-color: white;

        position: absolute;

        top: 15%;

        width: 80%;

        left: 10%;

        border: 3px solid #cb4b6552;

        z-index: 9;

        padding-bottom: 8px;

        border-radius: 30px;

    }

}



/* Add styles to the form container */

.form-container {

  padding: 10px;

}



/* Full-width input fields */ 

.form-container input[type=text], .form-container input[type=password], .form-container input[type=number], .form-container select, .form-container input[type=float] {

  width: 100%;

  padding: 15px;

  margin: 5px 0 5px 0;

  border: none;

  background: #f1f1f1;

}



/* When the inputs get focus, do something */

.form-container input[type=text]:focus, .form-container input[type=password]:focus, .form-container input[type=number], .form-container select:focus {

  background-color: #f4f4f4;

  outline: none;

}



/* Add some hover effects to buttons */

.form-container .btn:hover, .open-button:hover {

  opacity: 1;

}



.btncerrar {

    float: right;

    position: absolute;

    padding: 8px;

    left: 94%;

    top: -25px;

    padding: 14px;

}



@media 

only screen and (max-width: 760px),

(min-device-width: 768px) and (max-device-width: 1024px)  {

    .btncerrar {

        float: right;

        position: absolute;

        padding: 8px;

        left: 92%;

        top: -48px;

        padding: 14px;

    }   

}

</style>
<link rel='shortcut icon' type='image/x-icon' href='favicon.ico'>
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header" id="blur1" style="transition: all 1s cubic-bezier(0, 1.15, 1, 1) 0s; filter: blur(0px);">
        <div class="app-header header-shadow bg-happy-green header-text-light">
            <div class="app-header__logo">
                <div style="width: 100%;"><img src='../assets/images/logo.png' alt='Tickets' width='90' height='57'><h6 style="float: right;margin-top: 13px;margin-right: 14px;color: #d9e2e7;background-color: #2a945e;border-radius: 100px;padding: 6px;padding-left: 25px;padding-right: 25px;cursor: default;">Tickets</h6></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    <div class="app-header__content">
                <div class="app-header-left">
					<!-- ESTE ES EL DIV DEL CARRITO -->
                    </div>
                <div class="app-header-right">
					<?php if($_SESSION['notificaciones'] == "1"){
					echo '<ul class="header-menu nav">
                        <li class="nav-item">
                            <form method="post" action="" class="nav-link" id="desactivar_notif">
								<input type="text" value="0" name="notificacion" style="display:none">
                                <i onClick="notif1();" type="submit" class="nav-link-icon fa fa-bell" style="color: #f7f7f7;"></i></form>
                        </li>
                    </ul>'; } 
					else {
					echo '<ul class="header-menu nav">
                        <li class="nav-item">
                            <form method="post" action="" class="nav-link" id="activar_notif">
								<input type="text" value="1" name="notificacion" style="display:none">
                                <i onClick="notif2();" type="submit" class="nav-link-icon fa fa-bell-slash" style="color: #f7f7f7;"></i></form>
								
                        </li>
                    </ul>'; } ?>
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <button onclick="window.location.href='cambiar_contrasena.php'" type="button" tabindex="0" class="dropdown-item">Cambiar contrase&ntilde;a</button>
                                            <button onclick="window.location.href='login_cerrar.php'" type="button" tabindex="0" class="dropdown-item">Cerrar sesi&oacute;n</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?php echo $_SESSION['nombre'];?> <?php echo $_SESSION['apellido'];?>
                                    </div>
									<?php
									$consulta = "SELECT * FROM `usuarios` WHERE user = '" . $_SESSION['usuario'] . "'";
									$resultado = mysqli_query($link, $consulta);
      								while($fila = mysqli_fetch_array($resultado)){
		
									$ult_conex = new DateTime($fila['ultima_conexion']);
									$diadelasemanaNum = $ult_conex->format('w');
									if($diadelasemanaNum == $diadelasemanaHoy){
										$diadelasemana = "hoy";
									}
									else if($diadelasemanaNum == ($diadelasemanaHoy - 1)){
										$diadelasemana = "ayer";
									}
									else if($diadelasemanaNum == "0"){ $diadelasemana = "domingo";}
									else if($diadelasemanaNum == "1"){ $diadelasemana = "lunes";}
									else if($diadelasemanaNum == "2"){ $diadelasemana = "martes";}
									else if($diadelasemanaNum == "3"){ $diadelasemana = "mi&eacute;rcoles";}
									else if($diadelasemanaNum == "4"){ $diadelasemana = "jueves";}
									else if($diadelasemanaNum == "5"){ $diadelasemana = "viernes";}
									else if($diadelasemanaNum == "6"){ $diadelasemana = "s&aacute;bado";}
									?>
      								
                                    <div class="widget-subheading">
                                        &uacute;ltima vez <?php echo $diadelasemana;
										echo ' a las ' . $ult_conex->format('H:i');
										?>
                                    </div>
									<?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div>        <div class="app-main">
                <div class="app-sidebar sidebar-shadow bg-heavy-rain sidebar-text-dark">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Principal</li>
                                <li>
                                    <a href="panel.php">
                                        <i class="metismenu-icon pe-7s-play"></i>
                                         Tickets del turno
                                    </a>
                                </li>
								<li>
                                    <a href="global.php">
                                        <i class="metismenu-icon pe-7s-albums"></i>
                                         Todos los tickets
                                    </a>
                                </li>
								<li class="app-sidebar__heading">Crear</li>
								<li>
                                    <a href="nuevo_ticket.php" class="mm-active">
                                        <i class="metismenu-icon pe-7s-plus"></i>
                                         Nuevo ticket
                                    </a>
                                </li>
								<li class="app-sidebar__heading">Avisos</li>
								<li>
                                    <a href="avisos_activos.php">
                                        <i class="metismenu-icon pe-7s-attention"></i>
                                         Avisos activos
                                    </a>
                                </li>
								<li>
                                    <a href="nuevo_aviso.php">
                                        <i class="metismenu-icon pe-7s-plus"></i>
                                         Nuevo aviso
                                    </a>
                                </li>
								<li class="app-sidebar__heading">Rendimiento</li>
								<li>
                                    <a href="graficos.php">
                                        <i class="metismenu-icon pe-7s-graph3"></i>
                                         General
                                    </a>
                                </li>
								<!--<li class="app-sidebar__heading">Panel de Control</li>
								<li>
                                    <a href="productos_pedidos.php">
                                        <i class="metismenu-icon pe-7s-paper-plane"></i>
                                         Productos pedidos
                                    </a>
                                </li>
								<li>
                                    <a href="stock_minimo.php">
                                        <i class="metismenu-icon pe-7s-info"></i>
                                         Stock m&iacute;nimo
                                    </a>
                                </li>
								<li class="app-sidebar__heading">&Oacute;rdenes</li>
								<li>
                                    <a href="pedidos.php">
                                        <i class="metismenu-icon pe-7s-users"></i>
                                         Proveedores
                                    </a>
                                </li>
								<li>
                                    <a href="generar_pedido.php">
                                        <i class="metismenu-icon pe-7s-cart"></i>
                                         Generar orden
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Historial</li>
                                <li>
                                    <a href="stock_ultimo.php">
                                        <i class="metismenu-icon pe-7s-timer"></i>
                                         &Uacute;ltimos movimientos
                                    </a>
                                </li>
								<li>
                                    <a href="ordenes_emitidas.php">
                                        <i class="metismenu-icon pe-7s-next-2"></i>
                                         &Oacute;rdenes emitidas
                                    </a>
                                </li>-->
                            </ul>
                        </div>
                    </div>
                </div>    <div class="app-main__outer">
                    <div class="app-main__inner">
						<ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                                <div class="row" style="display: block;">
                                    <div class="mb-3 card">
                                            <div class="card-body dropdown">
                                                <ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c1-0" data-toggle="tab" href="#tab-animated1-0" onClick="area0('Envasado')">
                                                            <span class="nav-text">Envasado</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c1-1" data-toggle="tab" href="#tab-animated1-1" onClick="area0('Molino')">
                                                            <span class="nav-text">Molino</span>
                                                        </a>
                                                    </li>
                                                </ul>
												
<!-- ##################################### COMIENZO DE TABLA 1 ##################################### -->
                                                <div class="tab-content">
                                                    <div class="tab-pane tabs-animation fade" id="tab-animated1-0" role="tabpanel">
														<hr>
													<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c2-0" data-toggle="tab" href="#tab-animated2-0" onClick="area1('Volpak')">
                                                            <span class="nav-text">Volpak</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c2-1" data-toggle="tab" href="#tab-animated2-1" onClick="area1('Fawema')">
                                                            <span class="nav-text">Fawema</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c2-2" data-toggle="tab" href="#tab-animated2-2" onClick="area1('Muestra Gratis')">
                                                            <span class="nav-text">Muestra Gratis</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c2-3" data-toggle="tab" href="#tab-animated2-3" onClick="area1('Matecocido')">
                                                            <span class="nav-text">Matecocido</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c2-4" data-toggle="tab" href="#tab-animated2-4" onClick="area1('Palletizadoras')">
                                                            <span class="nav-text">Palletizadoras</span>
                                                        </a>
                                                    </li>
                                                </ul>
														
<!-- ##################################### COMIENZO DE TABLA 2-0 ##################################### -->
												<div class="tab-content">
												<div class="tab-pane tabs-animation fade" id="tab-animated2-0" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Volpak No.1')">
                                                            <span class="nav-text">Volpak Nº1</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Volpak No.2')">
                                                            <span class="nav-text">Volpak Nº2</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Volpak No.3')">
                                                            <span class="nav-text">Volpak Nº3</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Volpak No.4')">
                                                            <span class="nav-text">Volpak Nº4</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Volpak No.5')">
                                                            <span class="nav-text">Volpak Nº5</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Volpak No.6')">
                                                            <span class="nav-text">Volpak Nº6</span>
                                                        </a>
                                                    </li>
                                                </ul>
													
<!-- ##################################### COMIENZO DE TABLA 3-0 ##################################### -->
												<div class="tab-content">
												<div class="tab-pane tabs-animation fade" id="tab-animated3-0" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c4-0" data-toggle="tab" href="#tab-animated4-0" onClick="area3('Vertical')">
                                                            <span class="nav-text">Vertical</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c4-1" data-toggle="tab" href="#tab-animated4-1" onClick="area3('Carrusel')">
                                                            <span class="nav-text">Carrusel</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c4-2" data-toggle="tab" href="#tab-animated4-2" onClick="area3('Horno')">
                                                            <span class="nav-text">Horno</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c4-3" data-toggle="tab" href="#tab-animated4-3" onClick="area3('Balanzas')">
                                                            <span class="nav-text">Balanzas</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c4-4" data-toggle="tab" href="#tab-animated4-4" onClick="area3('Fechador')">
                                                            <span class="nav-text">Fechador</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c4-5" data-toggle="tab" href="#tab-animated4-5" onClick="area3('Etiquetador')">
                                                            <span class="nav-text">Etiquetador</span>
                                                        </a>
                                                    </li>
													<li class="nav-item" onClick="openFormArea3('Otro', 1, '4')">
                                                        <a role="tab" class="nav-link" id="tab-c4-6" data-toggle="tab" href="#tab-animated4-6" onClick="area3('Otro')">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>
													
<!-- ##################################### COMIENZO DE TABLA 4-0 ##################################### -->
												<div class="tab-content">
												<div class="tab-pane tabs-animation fade" id="tab-animated4-0" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openForm('Mordaza Vertical')">
                                                        <a role="tab" class="nav-link" id="tab-c5-0" data-toggle="tab" style="height: 60px;" href="#tab-animated5-0">
                                                            <span class="nav-text">Mordaza Vertical</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Mordaza Horizontal')">
                                                        <a role="tab" class="nav-link" id="tab-c5-1" data-toggle="tab" style="height: 60px;" href="#tab-animated5-1">
                                                            <span class="nav-text">Mordaza Horizontal</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Temperatura Mordazas')">
                                                        <a role="tab" class="nav-link" id="tab-c5-2" data-toggle="tab" style="height: 60px;" href="#tab-animated5-2">
                                                            <span class="nav-text">Temperatura Mordazas</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Cuchillas')">
                                                        <a role="tab" class="nav-link" id="tab-c5-3" data-toggle="tab" style="height: 60px;" href="#tab-animated5-3">
                                                            <span class="nav-text">Cuchillas</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Arrastre')">
                                                        <a role="tab" class="nav-link" id="tab-c5-4" data-toggle="tab" style="height: 60px;" href="#tab-animated5-4">
                                                            <span class="nav-text">Arrastre</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Aspiraci&oacute;n')">
                                                        <a role="tab" class="nav-link" id="tab-c5-5" data-toggle="tab" style="height: 60px;" href="#tab-animated5-5">
                                                            <span class="nav-text">Aspiraci&oacute;n</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Otro')">
                                                        <a role="tab" class="nav-link" id="tab-c5-6" data-toggle="tab" style="height: 60px;" href="#tab-animated5-6">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>

                                                    </div>

<!-- ##################################### FINAL DE TABLA 4-0 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 4-1 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated4-1" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openForm('Vibradores')">
                                                        <a role="tab" class="nav-link" id="tab-c5-0" data-toggle="tab" style="height: 60px;" href="#tab-animated5-0">
                                                            <span class="nav-text">Vibradores</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Mordaza Horizontal')">
                                                        <a role="tab" class="nav-link" id="tab-c5-1" data-toggle="tab" style="height: 60px;" href="#tab-animated5-1">
                                                            <span class="nav-text">Mordaza Horizontal</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Temperatura Mordazas')">
                                                        <a role="tab" class="nav-link" id="tab-c5-2" data-toggle="tab" style="height: 60px;" href="#tab-animated5-2">
                                                            <span class="nav-text">Temperatura Mordazas</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Cuchillas')">
                                                        <a role="tab" class="nav-link" id="tab-c5-3" data-toggle="tab" style="height: 60px;" href="#tab-animated5-3">
                                                            <span class="nav-text">Cuchillas</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Sensores')">
                                                        <a role="tab" class="nav-link" id="tab-c5-4" data-toggle="tab" style="height: 60px;" href="#tab-animated5-4">
                                                            <span class="nav-text">Sensores</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Levas')">
                                                        <a role="tab" class="nav-link" id="tab-c5-5" data-toggle="tab" style="height: 60px;" href="#tab-animated5-5">
                                                            <span class="nav-text">Levas</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Otro')">
                                                        <a role="tab" class="nav-link" id="tab-c5-6" data-toggle="tab" style="height: 60px;" href="#tab-animated5-6">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>

                                                    </div>

<!-- ##################################### FINAL DE TABLA 4-1 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 4-2 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated4-2" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openForm('Guillotina')">
                                                        <a role="tab" class="nav-link" id="tab-c5-0" data-toggle="tab" style="height: 60px;" href="#tab-animated5-0">
                                                            <span class="nav-text">Guillotina</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Temperatura Horno')">
                                                        <a role="tab" class="nav-link" id="tab-c5-1" data-toggle="tab" style="height: 60px;" href="#tab-animated5-1">
                                                            <span class="nav-text">Temperatura Horno</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Cilindros')">
                                                        <a role="tab" class="nav-link" id="tab-c5-2" data-toggle="tab" style="height: 60px;" href="#tab-animated5-2">
                                                            <span class="nav-text">Cilindros</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Cuchilla')">
                                                        <a role="tab" class="nav-link" id="tab-c5-3" data-toggle="tab" style="height: 60px;" href="#tab-animated5-3">
                                                            <span class="nav-text">Cuchilla</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Sensores')">
                                                        <a role="tab" class="nav-link" id="tab-c5-4" data-toggle="tab" style="height: 60px;" href="#tab-animated5-4">
                                                            <span class="nav-text">Sensores</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Cinta')">
                                                        <a role="tab" class="nav-link" id="tab-c5-5" data-toggle="tab" style="height: 60px;" href="#tab-animated5-5">
                                                            <span class="nav-text">Cinta</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Otro')">
                                                        <a role="tab" class="nav-link" id="tab-c5-6" data-toggle="tab" style="height: 60px;" href="#tab-animated5-6">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>

                                                    </div>

<!-- ##################################### FINAL DE TABLA 4-2 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 4-3 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated4-3" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openForm('Balanza No.1')">
                                                        <a role="tab" class="nav-link" id="tab-c5-0" data-toggle="tab" style="height: 60px;" href="#tab-animated5-0">
                                                            <span class="nav-text">Balanza No.1</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Balanza No.2')">
                                                        <a role="tab" class="nav-link" id="tab-c5-1" data-toggle="tab" style="height: 60px;" href="#tab-animated5-1">
                                                            <span class="nav-text">Balanza No.2</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Balanza No.3')">
                                                        <a role="tab" class="nav-link" id="tab-c5-2" data-toggle="tab" style="height: 60px;" href="#tab-animated5-2">
                                                            <span class="nav-text">Balanza No.3</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Otro')">
                                                        <a role="tab" class="nav-link" id="tab-c5-6" data-toggle="tab" style="height: 60px;" href="#tab-animated5-6">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>

                                                    </div>

<!-- ##################################### FINAL DE TABLA 4-3 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 4-4 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated4-4" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openForm('Impresi&oacute;n borrosa')">
                                                        <a role="tab" class="nav-link" id="tab-c5-0" data-toggle="tab" style="height: 60px;" href="#tab-animated5-0">
                                                            <span class="nav-text">Impresi&oacute;n borrosa</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Fuera de lugar')">
                                                        <a role="tab" class="nav-link" id="tab-c5-1" data-toggle="tab" style="height: 60px;" href="#tab-animated5-1">
                                                            <span class="nav-text">Fuera de lugar</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('No imprime')">
                                                        <a role="tab" class="nav-link" id="tab-c5-2" data-toggle="tab" style="height: 60px;" href="#tab-animated5-2">
                                                            <span class="nav-text">No imprime</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Problema fechador')">
                                                        <a role="tab" class="nav-link" id="tab-c5-3" data-toggle="tab" style="height: 60px;" href="#tab-animated5-3">
                                                            <span class="nav-text">Problema fechador</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Otro')">
                                                        <a role="tab" class="nav-link" id="tab-c5-6" data-toggle="tab" style="height: 60px;" href="#tab-animated5-6">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>

                                                    </div>

<!-- ##################################### FINAL DE TABLA 4-4 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 4-5 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated4-5" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openForm('Doble etiqueta')">
                                                        <a role="tab" class="nav-link" id="tab-c5-0" data-toggle="tab" style="height: 60px;" href="#tab-animated5-0">
                                                            <span class="nav-text">Doble etiqueta</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Fuera de lugar')">
                                                        <a role="tab" class="nav-link" id="tab-c5-1" data-toggle="tab" style="height: 60px;" href="#tab-animated5-1">
                                                            <span class="nav-text">Fuera de lugar</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('No funciona')">
                                                        <a role="tab" class="nav-link" id="tab-c5-2" data-toggle="tab" style="height: 60px;" href="#tab-animated5-2">
                                                            <span class="nav-text">No funciona</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Otro')">
                                                        <a role="tab" class="nav-link" id="tab-c5-6" data-toggle="tab" style="height: 60px;" href="#tab-animated5-6">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>

                                                    </div>
													</div>

<!-- ##################################### FINAL DE TABLA 4-5 ##################################### -->

                                                    </div>
													</div>
													</div>

<!-- ##################################### FINAL DE TABLA 3-0 ##################################### -->
<!-- ##################################### FINAL DE TABLA 2-0 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 2-1 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated2-1" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c13-0" data-toggle="tab" href="#tab-animated13-0" onClick="area2('Fawema No.1')">
                                                            <span class="nav-text">Fawema No.1</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c13-0" data-toggle="tab" href="#tab-animated13-0" onClick="area2('Fawema No.2')">
                                                            <span class="nav-text">Fawema No.2</span>
                                                        </a>
                                                    </li>
                                                </ul>

<!-- ##################################### FINAL DE TABLA 2-1 ##################################### -->
												<div class="tab-content">
												<div class="tab-pane tabs-animation fade" id="tab-animated13-0" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c14-0" data-toggle="tab" href="#tab-animated14-0" onClick="area3('Cabezal No.1')">
                                                            <span class="nav-text">Cabezal No.1</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c14-0" data-toggle="tab" href="#tab-animated14-0" onClick="area3('Cabezal No.2')">
                                                            <span class="nav-text">Cabezal No.2</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c14-1" data-toggle="tab" href="#tab-animated14-1" onClick="area3('Carrusel')">
                                                            <span class="nav-text">Carrusel</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c14-2" data-toggle="tab" href="#tab-animated14-2" onClick="area3('Horno')">
                                                            <span class="nav-text">Horno</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c14-3" data-toggle="tab" href="#tab-animated14-3" onClick="area3('Balanzas')">
                                                            <span class="nav-text">Balanzas</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c14-4" data-toggle="tab" href="#tab-animated14-4" onClick="area3('Fechador')">
                                                            <span class="nav-text">Fechador</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c14-5" data-toggle="tab" href="#tab-animated14-5" onClick="area3('Etiquetador')">
                                                            <span class="nav-text">Etiquetador</span>
                                                        </a>
                                                    </li>
													<li class="nav-item" onClick="openFormArea2('Otro', 1, '14')">
                                                        <a role="tab" class="nav-link" id="tab-c14-6" data-toggle="tab" href="#tab-animated14-6" onClick="area3('Otro')">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>
													
<!-- ##################################### COMIENZO DE TABLA 14-0 ##################################### -->
												<div class="tab-content">
												<div class="tab-pane tabs-animation fade" id="tab-animated14-0" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openForm('Mordaza Vertical')">
                                                        <a role="tab" class="nav-link" id="tab-c5-0" data-toggle="tab" style="height: 60px;" href="#tab-animated5-0">
                                                            <span class="nav-text">Mordaza Vertical</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Mordaza Horizontal')">
                                                        <a role="tab" class="nav-link" id="tab-c5-1" data-toggle="tab" style="height: 60px;" href="#tab-animated5-1">
                                                            <span class="nav-text">Mordaza Horizontal</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Temperatura Mordazas')">
                                                        <a role="tab" class="nav-link" id="tab-c5-2" data-toggle="tab" style="height: 60px;" href="#tab-animated5-2">
                                                            <span class="nav-text">Temperatura Mordazas</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Cuchillas')">
                                                        <a role="tab" class="nav-link" id="tab-c5-3" data-toggle="tab" style="height: 60px;" href="#tab-animated5-3">
                                                            <span class="nav-text">Cuchillas</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Arrastre')">
                                                        <a role="tab" class="nav-link" id="tab-c5-4" data-toggle="tab" style="height: 60px;" href="#tab-animated5-4">
                                                            <span class="nav-text">Arrastre</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Aspiraci&oacute;n')">
                                                        <a role="tab" class="nav-link" id="tab-c5-5" data-toggle="tab" style="height: 60px;" href="#tab-animated5-5">
                                                            <span class="nav-text">Aspiraci&oacute;n</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Otro')">
                                                        <a role="tab" class="nav-link" id="tab-c5-6" data-toggle="tab" style="height: 60px;" href="#tab-animated5-6">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>

                                                    </div>

<!-- ##################################### FINAL DE TABLA 14-0 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 14-1 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated14-1" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openForm('Vibradores')">
                                                        <a role="tab" class="nav-link" id="tab-c5-0" data-toggle="tab" style="height: 60px;" href="#tab-animated5-0">
                                                            <span class="nav-text">Vibradores</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Mordazas')">
                                                        <a role="tab" class="nav-link" id="tab-c5-1" data-toggle="tab" style="height: 60px;" href="#tab-animated5-1">
                                                            <span class="nav-text">Mordazas</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Temperatura Mordazas')">
                                                        <a role="tab" class="nav-link" id="tab-c5-2" data-toggle="tab" style="height: 60px;" href="#tab-animated5-2">
                                                            <span class="nav-text">Temperatura Mordazas</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Cuchillas')">
                                                        <a role="tab" class="nav-link" id="tab-c5-3" data-toggle="tab" style="height: 60px;" href="#tab-animated5-3">
                                                            <span class="nav-text">Cuchillas</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Sensores')">
                                                        <a role="tab" class="nav-link" id="tab-c5-4" data-toggle="tab" style="height: 60px;" href="#tab-animated5-4">
                                                            <span class="nav-text">Sensores</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Gu&iacute;as')">
                                                        <a role="tab" class="nav-link" id="tab-c5-5" data-toggle="tab" style="height: 60px;" href="#tab-animated5-5">
                                                            <span class="nav-text">Gu&iacute;as</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Otro')">
                                                        <a role="tab" class="nav-link" id="tab-c5-6" data-toggle="tab" style="height: 60px;" href="#tab-animated5-6">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>

                                                    </div>

<!-- ##################################### FINAL DE TABLA 14-1 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 14-2 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated14-2" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openForm('Guillotina')">
                                                        <a role="tab" class="nav-link" id="tab-c5-0" data-toggle="tab" style="height: 60px;" href="#tab-animated5-0">
                                                            <span class="nav-text">Guillotina</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Temperatura Horno')">
                                                        <a role="tab" class="nav-link" id="tab-c5-1" data-toggle="tab" style="height: 60px;" href="#tab-animated5-1">
                                                            <span class="nav-text">Temperatura Horno</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Cilindros')">
                                                        <a role="tab" class="nav-link" id="tab-c5-2" data-toggle="tab" style="height: 60px;" href="#tab-animated5-2">
                                                            <span class="nav-text">Cilindros</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Cuchilla')">
                                                        <a role="tab" class="nav-link" id="tab-c5-3" data-toggle="tab" style="height: 60px;" href="#tab-animated5-3">
                                                            <span class="nav-text">Cuchilla</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Sensores')">
                                                        <a role="tab" class="nav-link" id="tab-c5-4" data-toggle="tab" style="height: 60px;" href="#tab-animated5-4">
                                                            <span class="nav-text">Sensores</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Cinta')">
                                                        <a role="tab" class="nav-link" id="tab-c5-5" data-toggle="tab" style="height: 60px;" href="#tab-animated5-5">
                                                            <span class="nav-text">Cinta</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Otro')">
                                                        <a role="tab" class="nav-link" id="tab-c5-6" data-toggle="tab" style="height: 60px;" href="#tab-animated5-6">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>

                                                    </div>

<!-- ##################################### FINAL DE TABLA 14-2 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 14-3 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated14-3" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openForm('Balanza Grueso')">
                                                        <a role="tab" class="nav-link" id="tab-c5-0" data-toggle="tab" style="height: 60px;" href="#tab-animated5-0">
                                                            <span class="nav-text">Balanza Grueso</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Balanza Fino')">
                                                        <a role="tab" class="nav-link" id="tab-c5-1" data-toggle="tab" style="height: 60px;" href="#tab-animated5-1">
                                                            <span class="nav-text">Balanza Fino</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Balanza Cinta')">
                                                        <a role="tab" class="nav-link" id="tab-c5-2" data-toggle="tab" style="height: 60px;" href="#tab-animated5-2">
                                                            <span class="nav-text">Balanza Cinta</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Otro')">
                                                        <a role="tab" class="nav-link" id="tab-c5-6" data-toggle="tab" style="height: 60px;" href="#tab-animated5-6">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>

                                                    </div>

<!-- ##################################### FINAL DE TABLA 14-3 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 14-4 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated14-4" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openForm('Impresi&oacute;n borrosa')">
                                                        <a role="tab" class="nav-link" id="tab-c5-0" data-toggle="tab" style="height: 60px;" href="#tab-animated5-0">
                                                            <span class="nav-text">Impresi&oacute;n borrosa</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Fuera de lugar')">
                                                        <a role="tab" class="nav-link" id="tab-c5-1" data-toggle="tab" style="height: 60px;" href="#tab-animated5-1">
                                                            <span class="nav-text">Fuera de lugar</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('No imprime')">
                                                        <a role="tab" class="nav-link" id="tab-c5-2" data-toggle="tab" style="height: 60px;" href="#tab-animated5-2">
                                                            <span class="nav-text">No imprime</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Problema fechador')">
                                                        <a role="tab" class="nav-link" id="tab-c5-3" data-toggle="tab" style="height: 60px;" href="#tab-animated5-3">
                                                            <span class="nav-text">Problema fechador</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Otro')">
                                                        <a role="tab" class="nav-link" id="tab-c5-6" data-toggle="tab" style="height: 60px;" href="#tab-animated5-6">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>

                                                    </div>

<!-- ##################################### FINAL DE TABLA 14-4 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 14-5 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated14-5" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openForm('Doble etiqueta')">
                                                        <a role="tab" class="nav-link" id="tab-c5-0" data-toggle="tab" style="height: 60px;" href="#tab-animated5-0">
                                                            <span class="nav-text">Doble etiqueta</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openForm('Fuera de lugar')">
                                                        <a role="tab" class="nav-link" id="tab-c5-1" data-toggle="tab" style="height: 60px;" href="#tab-animated5-1">
                                                            <span class="nav-text">Fuera de lugar</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('No funciona')">
                                                        <a role="tab" class="nav-link" id="tab-c5-2" data-toggle="tab" style="height: 60px;" href="#tab-animated5-2">
                                                            <span class="nav-text">No funciona</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openForm('Otro')">
                                                        <a role="tab" class="nav-link" id="tab-c5-6" data-toggle="tab" style="height: 60px;" href="#tab-animated5-6">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>

                                                    </div>
													</div>

<!-- ##################################### FINAL DE TABLA 14-5 ##################################### -->

                                                    </div>
													</div>
													</div>

<!-- ##################################### FINAL DE TABLA 2-1 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 2-2 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated2-2" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c24-0" data-toggle="tab" href="#tab-animated24-0" onClick="area2('Vertical')">
                                                            <span class="nav-text">Vertical</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea2('Dosificador', 1, '24')">
                                                        <a role="tab" class="nav-link" id="tab-c24-3" data-toggle="tab" href="#tab-animated24-3" onClick="area2('Dosificador')">
                                                            <span class="nav-text">Dosificador</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c24-4" data-toggle="tab" href="#tab-animated24-4" onClick="area2('Fechador')">
                                                            <span class="nav-text">Fechador</span>
                                                        </a>
                                                    </li>
													<li class="nav-item" onClick="openFormArea2('Otro', 1, '24')">
                                                        <a role="tab" class="nav-link" id="tab-c24-6" data-toggle="tab" href="#tab-animated24-6" onClick="area2('Otro')">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>
													
<!-- ##################################### COMIENZO DE TABLA 24-0 ##################################### -->
												<div class="tab-content">
												<div class="tab-pane tabs-animation fade" id="tab-animated24-0" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openFormArea3('Mordaza Vertical')">
                                                        <a role="tab" class="nav-link" id="tab-c5-0" data-toggle="tab" style="height: 60px;" href="#tab-animated5-0">
                                                            <span class="nav-text">Mordaza Vertical</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea3('Mordaza Horizontal')">
                                                        <a role="tab" class="nav-link" id="tab-c5-1" data-toggle="tab" style="height: 60px;" href="#tab-animated5-1">
                                                            <span class="nav-text">Mordaza Horizontal</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openFormArea3('Temperatura Mordazas')">
                                                        <a role="tab" class="nav-link" id="tab-c5-2" data-toggle="tab" style="height: 60px;" href="#tab-animated5-2">
                                                            <span class="nav-text">Temperatura Mordazas</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea3('Cuchillas')">
                                                        <a role="tab" class="nav-link" id="tab-c5-3" data-toggle="tab" style="height: 60px;" href="#tab-animated5-3">
                                                            <span class="nav-text">Cuchillas</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openFormArea3('Otro')">
                                                        <a role="tab" class="nav-link" id="tab-c5-6" data-toggle="tab" style="height: 60px;" href="#tab-animated5-6">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>

                                                    </div>

<!-- ##################################### FINAL DE TABLA 24-0 ##################################### -->

													
<!-- ##################################### COMIENZO DE TABLA 24-4 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated24-4" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openFormArea3('Impresi&oacute;n borrosa')">
                                                        <a role="tab" class="nav-link" id="tab-c5-0" data-toggle="tab" style="height: 60px;" href="#tab-animated5-0">
                                                            <span class="nav-text">Impresi&oacute;n borrosa</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea3('Fuera de lugar')">
                                                        <a role="tab" class="nav-link" id="tab-c5-1" data-toggle="tab" style="height: 60px;" href="#tab-animated5-1">
                                                            <span class="nav-text">Fuera de lugar</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openFormArea3('No imprime')">
                                                        <a role="tab" class="nav-link" id="tab-c5-2" data-toggle="tab" style="height: 60px;" href="#tab-animated5-2">
                                                            <span class="nav-text">No imprime</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea3('Problema fechador')">
                                                        <a role="tab" class="nav-link" id="tab-c5-3" data-toggle="tab" style="height: 60px;" href="#tab-animated5-3">
                                                            <span class="nav-text">Problema fechador</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openFormArea3('Otro')">
                                                        <a role="tab" class="nav-link" id="tab-c5-6" data-toggle="tab" style="height: 60px;" href="#tab-animated5-6">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>

                                                    </div>

<!-- ##################################### FINAL DE TABLA 24-4 ##################################### -->
													
													</div>
													</div>

<!-- ##################################### FINAL DE TABLA 2-2 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 2-3 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated2-3" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c13-1" data-toggle="tab" href="#tab-animated13-1" onClick="area2('Maisa No.1')">
                                                            <span class="nav-text">Maisa No.1</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c13-1" data-toggle="tab" href="#tab-animated13-1" onClick="area2('Maisa No.2')">
                                                            <span class="nav-text">Maisa No.2</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c13-1" data-toggle="tab" href="#tab-animated13-1" onClick="area2('Maisa No.3')">
                                                            <span class="nav-text">Maisa No.3</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c13-1" data-toggle="tab" href="#tab-animated13-1" onClick="area2('Maisa No.4')">
                                                            <span class="nav-text">Maisa No.4</span>
                                                        </a>
                                                    </li>
                                                </ul>
													
												<div class="tab-content">
												<div class="tab-pane tabs-animation fade" id="tab-animated13-1" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openFormArea3('Armador', 1, '14')">
                                                        <a role="tab" class="nav-link" id="tab-c34-0" data-toggle="tab" href="#tab-animated34-0" onClick="area3('Armador')">
                                                            <span class="nav-text">Armador</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                   <li class="nav-item" onClick="openFormArea3('Cuchilla Tijera', 1, '14')">
                                                        <a role="tab" class="nav-link" id="tab-c34-1" data-toggle="tab" href="#tab-animated34-1" onClick="area3('Cuchilla Tijera')">
                                                            <span class="nav-text">Cuchilla Tijera</span>
                                                        </a>
													   <hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openFormArea3('Horquillas', 1, '14')">
                                                        <a role="tab" class="nav-link" id="tab-c34-2" data-toggle="tab" href="#tab-animated34-2" onClick="area3('Horquillas')">
                                                            <span class="nav-text">Horquillas</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea3('Encolador', 1, '14')">
                                                        <a role="tab" class="nav-link" id="tab-c34-3" data-toggle="tab" href="#tab-animated34-3" onClick="area3('Encolador')">
                                                            <span class="nav-text">Encolador</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openFormArea3('Dosificador', 1, '14')">
                                                        <a role="tab" class="nav-link" id="tab-c34-4" data-toggle="tab" href="#tab-animated34-4" onClick="area3('Dosificador')">
                                                            <span class="nav-text">Dosificador</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea3('Envolvedora', 1, '14')">
                                                        <a role="tab" class="nav-link" id="tab-c34-5" data-toggle="tab" href="#tab-animated34-5" onClick="area3('Envolvedora')">
                                                            <span class="nav-text">Envolvedora</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openFormArea3('Cinta', 1, '14')">
                                                        <a role="tab" class="nav-link" id="tab-c34-6" data-toggle="tab" href="#tab-animated34-6" onClick="area3('Cinta')">
                                                            <span class="nav-text">Cinta</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													
													<li class="nav-item" onClick="openFormArea3('Otro', 1, '14')">
                                                        <a role="tab" class="nav-link" id="tab-c34-7" data-toggle="tab" href="#tab-animated34-7" onClick="area3('Otro')">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>
                                                    </div>
												</div>
													
												</div>

<!-- ##################################### FINAL DE TABLA 2-3 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 2-4 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated2-4" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c13-2" data-toggle="tab" href="#tab-animated13-2" onClick="area2('Palletizadora No.1')">
                                                            <span class="nav-text">Palletizadora No.1</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c13-2" data-toggle="tab" href="#tab-animated13-2" onClick="area2('Palletizadora No.2')">
                                                            <span class="nav-text">Palletizadora No.2</span>
                                                        </a>
                                                    </li>
                                                </ul>
													
												<div class="tab-content">
												<div class="tab-pane tabs-animation fade" id="tab-animated13-2" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openFormArea3('Mal funcionamiento', 0, 1)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area3('Mal funcionamiento')">
                                                            <span class="nav-text">Mal funcionamiento</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea3('No funciona', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area3('No funciona')">
                                                            <span class="nav-text">No funciona</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openFormArea3('Otro', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area3('Otro')">
                                                            <span class="nav-text">Otro</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>
													
													</div>
												</div>
												</div>

<!-- ##################################### FINAL DE TABLA 2-4 ##################################### -->

													</div>
													</div>
												
<!-- ##################################### FINAL DE TABLA 1 ##################################### -->
												
                                                   

<!-- ##################################### COMIENZO DE TABLA 2 ##################################### -->

  													<div class="tab-pane tabs-animation fade" id="tab-animated1-1" role="tabpanel">
														<hr>
													<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c12-0" data-toggle="tab" href="#tab-animated12-0" onClick="area1('Tolva')">
                                                            <span class="nav-text">Tolva</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c12-1" data-toggle="tab" href="#tab-animated12-1" onClick="area1('Diabletes')">
                                                            <span class="nav-text">Diabletes</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c12-2" data-toggle="tab" href="#tab-animated12-2" onClick="area1('Compresores')">
                                                            <span class="nav-text">Compresores</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c12-3" data-toggle="tab" href="#tab-animated12-3" onClick="area1('Aspiradora')">
                                                            <span class="nav-text">Aspiradora</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c12-4" data-toggle="tab" href="#tab-animated12-4" onClick="area1('Linea 1')">
                                                            <span class="nav-text">Linea 1</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c12-4" data-toggle="tab" href="#tab-animated12-4" onClick="area1('Linea 2')">
                                                            <span class="nav-text">Linea 2</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c12-4" data-toggle="tab" href="#tab-animated12-4" onClick="area1('Linea 3')">
                                                            <span class="nav-text">Linea 3</span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a role="tab" class="nav-link" id="tab-c12-5" data-toggle="tab" href="#tab-animated12-5" onClick="area1('Matecocido')">
                                                            <span class="nav-text">Matecocido</span>
                                                        </a>
                                                    </li>
                                                </ul>
														
<!-- ##################################### COMIENZO DE TABLA 2-0 ##################################### -->
												<div class="tab-content">
												<div class="tab-pane tabs-animation fade" id="tab-animated12-0" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openFormArea2('Emboque No.1', 0, 1)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Emboque No.1')">
                                                            <span class="nav-text">Emboque Nº1</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea2('Emboque No.2', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Emboque No.2')">
                                                            <span class="nav-text">Emboque Nº2</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openFormArea2('Emboque No.3', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Emboque No.3')">
                                                            <span class="nav-text">Emboque Nº3</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea2('Emboque No.4', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Emboque No.4')">
                                                            <span class="nav-text">Emboque Nº4</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>
													
													</div>

<!-- ##################################### FINAL DE TABLA 12-0 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 12-1 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated12-1" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openFormArea2('Emboque No.1', 0, 1)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Emboque No.1')">
                                                            <span class="nav-text">Emboque Nº1</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea2('Emboque No.2', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Emboque No.2')">
                                                            <span class="nav-text">Emboque Nº2</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openFormArea2('Emboque No.3', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Emboque No.3')">
                                                            <span class="nav-text">Emboque Nº3</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea2('Emboque No.4', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Emboque No.4')">
                                                            <span class="nav-text">Emboque Nº4</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>
													
													</div>

<!-- ##################################### FINAL DE TABLA 12-1 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 12-2 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated12-2" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openFormArea2('Atlas Copco', 0, 1)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Atlas Copco')">
                                                            <span class="nav-text">Atlas Copco</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea2('Sullair', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Sullair')">
                                                            <span class="nav-text">Sullair</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>
													
													</div>

<!-- ##################################### FINAL DE TABLA 12-2 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 12-3 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated12-3" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openFormArea2('Aspiradora No.1', 0, 1)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Aspiradora No.1')">
                                                            <span class="nav-text">Aspiradora No.1</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea2('Aspiradora No.2', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Aspiradora No.2')">
                                                            <span class="nav-text">Aspiradora No.2</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>
													
													</div>

<!-- ##################################### FINAL DE TABLA 12-3 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 12-4 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated12-4" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openFormArea2('Zaranda Hoja', 0, 1)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Zaranda Hoja')">
                                                            <span class="nav-text">Zaranda Hoja</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea2('Zaranda Palo', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Zaranda Palo')">
                                                            <span class="nav-text">Zaranda Palo</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openFormArea2('Malladora', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Malladora')">
                                                            <span class="nav-text">Malladora</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea2('Noria', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Noria')">
                                                            <span class="nav-text">Noria</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openFormArea2('Molino No.1', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Molino No.1')">
                                                            <span class="nav-text">Molino No.1</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openFormArea2('Molino No.2', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Molino No.2')">
                                                            <span class="nav-text">Molino No.2</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
													<li class="nav-item" onClick="openFormArea2('Despunte', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Despunte')">
                                                            <span class="nav-text">Despunte</span>
                                                        </a>
														<hr style="border: 1px solid;margin: 10px;color: #9a9a9a;">
                                                    </li>
                                                </ul>
													
													</div>

<!-- ##################################### FINAL DE TABLA 12-4 ##################################### -->
													
<!-- ##################################### COMIENZO DE TABLA 12-5 ##################################### -->

												<div class="tab-pane tabs-animation fade" id="tab-animated12-5" role="tabpanel">
													<hr>
												<ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                                    <li class="nav-item" onClick="openFormArea2('Descremador', 0, 1)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Descremador')">
                                                            <span class="nav-text">Descremador</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea2('Zaranda Rotativa', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Zaranda Rotativa')">
                                                            <span class="nav-text">Zaranda Rotativa</span>
                                                        </a>
                                                    </li>
													<li class="nav-item" onClick="openFormArea2('Zaranda No.1', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Zaranda No.1')">
                                                            <span class="nav-text">Zaranda No.1</span>

                                                        </a>
                                                    </li>
                                                    <li class="nav-item" onClick="openFormArea2('Zaranda No.2', 0, 0)">
                                                        <a role="tab" class="nav-link" id="tab-c3-0" data-toggle="tab" href="#tab-animated3-0" onClick="area2('Zaranda No.2')">
                                                            <span class="nav-text">Zaranda No.2</span>
                                                        </a>
                                                    </li>
                                                </ul>
													
													</div>

<!-- ##################################### FINAL DE TABLA 12-5 ##################################### -->
													
													</div>
													</div>
    </div>
    
<!-- ##################################### FINAL DE TABLA 2 ##################################### -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="app-wrapper-footer">
                        <div class="app-footer">
                            <div class="app-footer__inner">
                                <div class="app-footer-left">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <!--Escribir  acá Footer Link 1-->
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <!--Escribir  acá Footer Link 2-->
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="app-footer-right">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <!--Escribir  acá Footer Link 3-->
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <div class="badge badge-success mr-1 ml-0">
                                                    <small><?php $year = date("Y"); echo $year; ?> | Cooperativa Agr&iacute;cola de la Colonia Liebig LTDA.</small>
                                                </div>
                                                <!--Escribir  acá Footer Link 4-->
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>    </div>
        </div>
    </div>
    
<div class="card-body" style="display: none;">
                                        <div class="card-title">Toastr Configurator</div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="title">Title</label>
                                                    <input id="title" type="text" class="form-control" placeholder="Enter a title ..." value="Stock M&iacute;nimo"/>
                                                </div>
                                                <div class="form-group">
                                                <label class="form-label" for="message">Message</label>
                                                <input class="form-control" id="message" placeholder="Enter a message ..." value="Un &iacute;tem ha llegado a su stock m&iacute;nimo."/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input id="closeButton" type="checkbox" value="checked" class="form-check-input"/>
                                                        <label class="form-check-label" for="closeButton">
                                                            Close Button
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input id="addBehaviorOnToastClick" type="checkbox" value="checked" class="form-check-input"/>
                                                        <label class="form-check-label" for="addBehaviorOnToastClick">
                                                            Add behavior on toast click
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input disabled id="addBehaviorOnToastCloseClick" type="checkbox" value="checked" class="form-check-input"/>
                                                        <label class="form-check-label" for="addBehaviorOnToastCloseClick">
                                                            Add behavior on toast close button click
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input id="debugInfo" type="checkbox" value="checked" class="form-check-input"/>
                                                        <label class="form-check-label" for="debugInfo">
                                                            Debug
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input id="progressBar" type="checkbox" class="form-check-input"/>
                                                        <label class="form-check-label" for="progressBar">
                                                            Progress Bar
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input id="rtl" type="checkbox" value="checked" class="form-check-input"/>
                                                        <label class="form-check-label" for="rtl">
                                                            Right-To-Left
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input id="preventDuplicates" type="checkbox" value="checked" class="form-check-input"/>
                                                        <label class="form-check-label" for="preventDuplicates">
                                                            Prevent Duplicates
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input id="addClear" type="checkbox" value="checked" class="form-check-input"/>
                                                        <label class="form-check-label" for="addClear">
                                                            Add button to force clearing a toast
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input id="newestOnTop" type="checkbox" value="checked" class="form-check-input"/>
                                                        <label class="form-check-label" for="newestOnTop">
                                                            Newest on top
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div id="toastTypeGroup">
                                                    <h5>Toast Type</h5>
                                                    <div class="form-check">
                                                        <input type="radio" name="toasts" class="form-check-input" value="success" checked/>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Success
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" name="toasts" class="form-check-input" value="info" checked/>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Info
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" name="toasts" class="form-check-input" value="warning" checked/>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Warning
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" name="toasts" class="form-check-input" value="warning" id="tipo" checked/>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Error
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="positionGroup">
                                                    <h5>Position</h5>
                                                    <div class="form-check">
                                                        <input type="radio" name="positions" class="form-check-input" value="toast-top-right" checked/>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Top Right
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" name="positions" class="form-check-input" value="toast-bottom-right"/>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Bottom Right
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" name="positions" class="form-check-input" value="toast-bottom-left"/>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Bottom Left
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" name="positions" class="form-check-input" value="toast-top-left"/>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Top Left
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" name="positions" class="form-check-input" value="toast-top-full-width"/>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Top Full Width
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" name="positions" class="form-check-input" value="toast-bottom-full-width"/>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Bottom Full Width
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" name="positions" class="form-check-input" value="toast-top-center"/>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Top Center
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" name="positions" class="form-check-input" value="toast-bottom-center"/>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Bottom Center
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="showEasing">Show Easing</label>
                                                    <input id="showEasing" type="text" placeholder="swing, linear" class="form-control" value="swing"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="hideEasing">Hide Easing</label>
                                                    <input id="hideEasing" type="text" placeholder="swing, linear" class="form-control" value="linear"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="showMethod">Show Method</label>
                                                    <input id="showMethod" type="text" placeholder="show, fadeIn, slideDown" class="form-control" value="fadeIn"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="hideMethod">Hide Method</label>
                                                    <input id="hideMethod" type="text" placeholder="hide, fadeOut, slideUp" class="form-control" value="fadeOut"/>
                                                </div>
                                            </div>
            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="showDuration">Show Duration</label>
                                                    <input id="showDuration" type="number" placeholder="ms" class="form-control" value="300"/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="hideDuration">Hide Duration</label>
                                                    <input id="hideDuration" type="number" placeholder="ms" class="form-control" value="1000"/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="timeOut">Time out</label>
                                                    <input id="timeOut" type="number" placeholder="ms" class="form-control" value="10000"/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="extendedTimeOut">Extended time out</label>
                                                    <input id="extendedTimeOut" type="number" placeholder="ms" class="form-control" value="1000"/>
                                                    <input type="button" id="showtoast" style="display: none">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    <script type="text/javascript">
    function alerta(){
        document.getElementById("showtoast").click();
    }
    </script>
                                                
                                                <?php
	if($_SESSION['notificaciones'] == "1"){
      $consulta = "SELECT * FROM `panol` WHERE stock < stock_minimo and stock != 0 ORDER BY producto ASC";
      $resultado = mysqli_query($link, $consulta);
      $cont = 0;
      while($fila = mysqli_fetch_array($resultado)){
          $stock_minimo = $fila['producto'];
          echo('                        <script>
                                        const interval'.$cont.' = setInterval(function() {
										document.getElementById("title").value = "Stock m&iacute;nimo";
                                        document.getElementById("message").value = "'.$stock_minimo.' ha llegado a su stock m&iacute;nimo.";
                                        alerta();
                                        clearInterval(interval'.$cont.');
                                        }, 1000);
                                    </script>');
                                    $cont = $cont+1; ?>
                                    <?php } ?>
	<?php
      $consulta = "SELECT * FROM `panol` WHERE stock = 0 ORDER BY producto ASC";
      $resultado = mysqli_query($link, $consulta);
      $cont = 0;
      while($fila = mysqli_fetch_array($resultado)){
          $stock_minimo = $fila['producto'];
          echo('                        <script>
                                        const interval2'.$cont.' = setInterval(function() {
										document.getElementById("tipo").value = "error";
										document.getElementById("title").value = "Sin stock";
                                        document.getElementById("message").value = "'.$stock_minimo.' se ha quedado sin stock.";
                                        alerta();
                                        clearInterval(interval2'.$cont.');
                                        }, 1000);
                                    </script>');
                                    $cont = $cont+1; ?>
                                    <?php } } ?>
                                   
<divEfecto class="form-popup" id="myForm">
<div>

  <form method="post" action="agregar_ticket.php" class="form-container" style="margin-bottom: 0;" id="ticketForm" enctype="multipart/form-data">

    <h2 style="text-align: center;font-size: 18px;font-weight: bold;background-color: #178d44;border-radius: 500px;color: white;padding: 12px;">NUEVO TICKET</h2>
	  
	<input type="text" id="usuario" name="usuario" readonly="readonly" value="<?php echo $_SESSION['usuario'];?>" style="display:none">
	  
	<input type="text" id="area0" name="area0" readonly="readonly" value="" style="display:none">
	<input type="text" id="area1" name="area1" readonly="readonly" value="" style="display:none">
	<input type="text" id="area2" name="area2" readonly="readonly" value="" style="display:none">
	<input type="text" id="area3" name="area3" readonly="readonly" value="" style="display:none">
	<input type="text" id="area4" name="area4" readonly="readonly" value="" style="display:none">

    <br>

    <label id="ruta"></label>
    <br>

    <hr style="margin-bottom: 8px;">
    
    <label><b>Detalle del problema:</b></label>

    <input type="text" name="detalle" id="detalle">
	  
	</form>

    <hr style="margin-top: 2px;margin-bottom: 8px;">

    <button class='btn button-style mt-md-0 mt-4' style="height: 50px;color: white;font-size: 15px;font-weight: bold;width: 120px;float: right;background: #178d44;border-radius: 50px;margin-right: 8px;" id="enviarTicket">Enviar</button>

    <button class='btn button-style mt-md-0 mt-4' type="button" onclick="closeForm()" style="float: left;padding: 8px;background: #178d44;border-radius: 50px;margin-left: 8px;"><img src='../images/iconoatras.png' style='height: 33px; cursor: pointer;'></button>
	  
</div>
</divEfecto>

<div class="form-popup" id="myForm2">

  <form method="post" action="editar.php" class="form-container" style="margin-bottom: 0;">

    <h2 style="text-align: center;font-size: 25px;" id="verCodigo">Codigo</h2>
	  
	<input type="text" id="verCodigo2" name="verCodigo2" readonly="readonly" style="display: none">

    <br>

    <label><b>Producto</b></label>
    <br>
    <input type="text" id="verProducto" name="verProducto" readonly="readonly">

    <hr>
    
    <label><b>Descripci&oacute;n</b></label>

    <input type="text" name="verDescripcion" id="verDescripcion" readonly="readonly">

    <hr>

    <label><b>Stock</b></label>

    <input type="text" name="verStock" id="verStock" readonly="readonly">

    <hr>
    
    <label><b>Stock m&iacute;nimo</b></label>

    <input type="text" name="verStock_minimo" id="verStock_minimo" readonly="readonly">

    <hr>
	  
	<label><b>Ubicaci&oacute;n X</b></label>

    <input type="text" name="ubi_x" id="ubi_x" readonly="readonly">

    <hr>
	  
	<label><b>Ubicaci&oacute;n Y</b></label>

    <input type="text" name="ubi_y" id="ubi_y" readonly="readonly">

    <hr>
	  
	<label><b>Ubicaci&oacute;n Z</b></label>

    <input type="text" name="ubi_z" id="ubi_z" readonly="readonly">

    <hr>
	  
	<label><b>Lugar</b></label>

    <input type="text" name="verLugar" id="verLugar" readonly="readonly">

    <hr>

    <button class='btn button-style mt-md-0 mt-4'  style="height: 50px;color: white;font-size: 15px;font-weight: bold;width: 120px;float: right;background: #178d44;border-radius: 50px;">Editar</button>

    <button class='btn button-style mt-md-0 mt-4' type="button" onclick="closeProducto()" style="float: left;padding: 8px;background: #178d44;border-radius: 50px;"><img src='images/iconoatras.png' style='height: 33px; cursor: pointer;'></button>

    <button class="btn button-style mt-md-0 mt-4 btncerrar" type="button" onclick="closeProducto()" style="background: #178d44;border-radius: 50px;"><img src="images/iconocruz.png" style="height: 21px; cursor: pointer;"></button>

    </form>

</div>

<div class="form-popup" id="myForm3">

  <form method="post" action="retirar.php" class="form-container" style="margin-bottom: 0;">

    <h2 style="text-align: center;font-size: 25px;" id="retirarCodigo">Retirar</h2>
	  
	<input type="text" id="usuario" name="usuario" readonly="readonly" value="<?php echo $_SESSION['usuario'];?>" style="display:none">
	  
	<input type="text" id="retirarCodigo2" name="retirarCodigo2" readonly="readonly" style="display: none">

    <br>

    <label><b>Producto</b></label>
    <br>
    <input type="text" id="retirarProducto" name="retirarProducto" readonly="readonly" required>

    <hr>
	  
	<label><b>Cantidad</b></label>

    <input type="number" name="retirarCantidad" id="retirarCantidad" required>

    <hr>
    
    <label><b>Destino <label style="color: lightgray;margin-bottom: 0px;">(opcional)</label></b></label>

    <input type="text" name="retirarDestino" id="retirarDestino">

    <hr>

    <button class='btn button-style mt-md-0 mt-4'  style="height: 50px;color: white;font-size: 15px;font-weight: bold;width: 120px;float: right;background: #178d44;border-radius: 50px;">Retirar</button>

    <button class='btn button-style mt-md-0 mt-4' type="button" onclick="closeRetirar()" style="float: left;padding: 8px;background: #178d44;border-radius: 50px;"><img src='images/iconoatras.png' style='height: 33px; cursor: pointer;'></button>

    <button class="btn button-style mt-md-0 mt-4 btncerrar" type="button" onclick="closeRetirar()" style="background: #178d44;border-radius: 50px;"><img src="images/iconocruz.png" style="height: 21px; cursor: pointer;"></button>

    </form>

</div>

<div class="form-popup" id="myForm4">

  <form method="post" action="desmarcar.php" class="form-container" style="margin-bottom: 0;">

    <h2 style="text-align: center;font-size: 25px;" id="pedidoCodigo">Pedidos</h2>
	  
	<input type="text" id="pedidoCodigo2" name="pedidoCodigo2" readonly="readonly" style="display: none">

    <br>

    <label><b>Producto</b></label>
    <br>
    <input type="text" id="pedidoProducto" name="pedidoProducto" readonly="readonly" >

    <hr>
	  
	<label><b>Cantidad de pedidos</b></label>

    <input type="number" name="pedidoCantidad" id="pedidoCantidad" readonly="readonly">

    <hr>
	  
	<label><b>Precio</b></label>

    <input type="number" name="pedidoPrecio" id="pedidoPrecio" readonly="readonly">

    <hr>
    
    <label><b>Fecha de pedido</b></label>

    <input type="text" name="pedidoFecha" id="pedidoFecha" readonly="readonly">

    <hr>
	  
	<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-info" style="height: 50px;color: white;font-size: 15px;font-weight: bold;width: 220px;float: right;background: #178d44;border-radius: 50px;">Marcar como recibido</button>
	  
	<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; padding: 15px; top: 0px; left: 0px; transform: translate3d(161px, 370px, 0px);">
                                                <label><b>Cantidad de recibidos</b></label>

    <input type="number" name="recibidoCantidad" id="recibidoCantidad">
		
                                                <div tabindex="-1" class="dropdown-divider"></div>
                                                <button class='btn button-style mt-md-0 mt-4'  style="height: 50px;color: white;font-size: 15px;font-weight: bold;width: 120px;float: right;background: #178d44;border-radius: 50px;">Cargar</button>
                                            </div>

    <button class='btn button-style mt-md-0 mt-4' type="button" onclick="closePedido()" style="float: left;padding: 8px;background: #178d44;border-radius: 50px;"><img src='images/iconoatras.png' style='height: 33px; cursor: pointer;'></button>

    <button class="btn button-style mt-md-0 mt-4 btncerrar" type="button" onclick="closePedido()" style="background: #178d44;border-radius: 50px;"><img src="images/iconocruz.png" style="height: 21px; cursor: pointer;"></button>

    </form>

</div>

<div class="form-popup" id="myForm5">

  <form method="post" action="agregar_imagen.php" class="form-container" enctype="multipart/form-data" style="margin-bottom: 0;">

    <h2 style="text-align: center;font-size: 25px;" id="pedidoCodigo">Agregar imagen</h2>
	  
	<input type="text" id="imagenCodigo" name="codigo" readonly="readonly" style="display: none">

    <br>

    <label><b>Producto</b></label>
    <br>
    <input type="text" id="imagenProducto" name="producto" readonly="readonly" >

    <hr>
	  
	<label for="fileToUpload" style="margin-bottom: 0px;">Imagen</label>
	<input name="fileToUpload" id="fileToUpload" type="file" class="form-control-file" capture="camera" style="padding-top: 12px;">
	<small class="form-text text-muted">Se recomienda ingresar a esta página con el smartphone para sacar la captura del producto en tiempo real.</small>

    <hr>
	  
	<input type="submit" name="submit" value="Subir" style="height: 50px;color: white;font-size: 15px;font-weight: bold;width: 220px;float: right;background: #178d44;border-radius: 50px;">

    <button class='btn button-style mt-md-0 mt-4' type="button" onclick="closeSubirImagen()" style="float: left;padding: 8px;background: #178d44;border-radius: 50px;"><img src='images/iconoatras.png' style='height: 33px; cursor: pointer;'></button>

    <button class="btn button-style mt-md-0 mt-4 btncerrar" type="button" onclick="closeSubirImagen()" style="background: #178d44;border-radius: 50px;"><img src="images/iconocruz.png" style="height: 21px; cursor: pointer;"></button>

    

</div>

<div class="form-popup-error" id="error" style="background-color: #fff2f4;">

  <form class="form-container" style="margin-bottom: 0;text-align: center;">

    <h4 style="text-align: center;">Error</h4>

    <hr>

    <input type="text" name="user" value="" style="display: none;">

    <h6>Se ha producido un error inesperado. Si el error persiste, comun&iacute;quese con el administrador del sistema.</h6>

    <br>

    <button class="btn button-style mt-md-0 mt-4" type="button" onclick="closeError()" style="height: 50px;color: white;font-size: 15px;font-weight: bold;width: 120px;background: #cb4b65;border-radius: 50px;">Aceptar</button>

    </form>

</div>

<script type="text/javascript">
	
  document.getElementById("enviarTicket").addEventListener("click", efectoEnviar);
	
    function openForm(area4) {

  document.getElementById("myForm").style.display = "block";
  document.getElementById("myForm").style.height = "0px";
  document.getElementById("blur1").style.filter = "blur(8px) opacity(0.5)";
		
  efectoAparecer();
		
  var area0 = document.getElementById("area0").value;
  var area1 = document.getElementById("area1").value;
  var area2 = document.getElementById("area2").value;
  var area3 = document.getElementById("area3").value;
  document.getElementById("area4").value = area4;
  
  document.getElementById("ruta").innerHTML = area0 + " > " + area1 + " > " + area2 + " > " + area3 + " > <b>" + area4 + "</b>";
	  
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;

}
	
function openFormArea3(area3, ocultar, num) {

  document.getElementById("myForm").style.display = "block";
  document.getElementById("myForm").style.height = "0px";
  document.getElementById("blur1").style.filter = "blur(8px) opacity(0.5)";
		
  efectoAparecer();
		
  var area0 = document.getElementById("area0").value;
  var area1 = document.getElementById("area1").value;
  var area2 = document.getElementById("area2").value;
  document.getElementById("area3").value = area3;
  
  document.getElementById("ruta").innerHTML = area0 + " > " + area1 + " > " + area2 + " > <b>" + area3 + "</b>";
	  
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
	
  if(ocultar){
  document.getElementById("tab-animated" + num + "-0").className = "tab-pane tabs-animation fade";
  document.getElementById("tab-animated" + num + "-1").className = "tab-pane tabs-animation fade";
  document.getElementById("tab-animated" + num + "-2").className = "tab-pane tabs-animation fade";
  document.getElementById("tab-animated" + num + "-3").className = "tab-pane tabs-animation fade";
  document.getElementById("tab-animated" + num + "-4").className = "tab-pane tabs-animation fade";
  document.getElementById("tab-animated" + num + "-5").className = "tab-pane tabs-animation fade";
  }

}
	
function openFormArea2(area2, ocultar, num) {

  document.getElementById("myForm").style.display = "block";
  document.getElementById("myForm").style.height = "0px";
  document.getElementById("blur1").style.filter = "blur(8px) opacity(0.5)";
		
  efectoAparecer();
		
  var area0 = document.getElementById("area0").value;
  var area1 = document.getElementById("area1").value;
  document.getElementById("area2").value = area2;
  
  document.getElementById("ruta").innerHTML = area0 + " > " + area1 + " > <b>" + area2 + "</b>";
	  
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
	
  if(ocultar){
  document.getElementById("tab-animated" + num + "-0").className = "tab-pane tabs-animation fade";
  document.getElementById("tab-animated" + num + "-1").className = "tab-pane tabs-animation fade";
  document.getElementById("tab-animated" + num + "-2").className = "tab-pane tabs-animation fade";
  document.getElementById("tab-animated" + num + "-3").className = "tab-pane tabs-animation fade";
  document.getElementById("tab-animated" + num + "-4").className = "tab-pane tabs-animation fade";
  document.getElementById("tab-animated" + num + "-5").className = "tab-pane tabs-animation fade";
  }

}



function closeForm() {

  document.getElementById("myForm").style.display = "none";
  document.getElementById("blur1").style.filter = "blur(0px)";

}
	
function efectoAparecer(){
  var div1 = $("divEfecto");
  div1.animate({height: '314px'}, "slow")
}
	
function efectoEnviar(){
  var div1 = $("divEfecto");
  div1.animate({height: '70px', opacity: '0.8'}, "slow");
  div1.animate({height: '70px', opacity: '0.8', left: '2000px'}, "slow");
  setTimeout(formSubmit, 1200);
}
	
function formSubmit(){
  document.getElementById("ticketForm").submit();
}
	
function area0(valor){
	document.getElementById("area0").value = valor;
}
function area1(valor){
	document.getElementById("area1").value = valor;
}
function area2(valor){
	document.getElementById("area2").value = valor;
}
function area3(valor){
	document.getElementById("area3").value = valor;
}
	
function openProducto(codigo, producto) {

  document.getElementById("myForm2").style.display = "block";

  document.getElementById("blur1").style.filter = "blur(5px)";
	
  var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var myObj = JSON.parse(this.responseText);
    document.getElementById("verDescripcion").value = myObj.descripcion;
	document.getElementById("verStock").value = myObj.stock;
	document.getElementById("verStock_minimo").value = myObj.stockminimo;
	document.getElementById("ubi_x").value = myObj.ubi_x;
	document.getElementById("ubi_y").value = myObj.ubi_y;
	document.getElementById("ubi_z").value = myObj.ubi_z;
	document.getElementById("verLugar").value = myObj.lugar;
  }
};
xmlhttp.open("GET", "ver_producto.php?cod=" + codigo, true);
xmlhttp.send();
   
  document.getElementById("verCodigo").innerHTML = codigo;
  document.getElementById("verCodigo2").value = codigo;
  document.getElementById("verProducto").value = producto;
	
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;

}



function closeProducto() {

  document.getElementById("myForm2").style.display = "none";

  document.getElementById("blur1").style.filter = "blur(0px)";

}
	
function openRetirar(codigo, producto) {

  document.getElementById("myForm3").style.display = "block";

  document.getElementById("blur1").style.filter = "blur(5px)";
  
  document.getElementById("retirarCodigo2").value = codigo;
  document.getElementById("retirarProducto").value = producto;
  document.getElementById("retirarCantidad").value = "";
  document.getElementById("retirarDestino").value = "";
	
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;

}



function closeRetirar() {

  document.getElementById("myForm3").style.display = "none";

  document.getElementById("blur1").style.filter = "blur(0px)";

}
	
function openPedido(codigo, producto) {

  document.getElementById("myForm4").style.display = "block";

  document.getElementById("blur1").style.filter = "blur(5px)";
	
  var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var myObj = JSON.parse(this.responseText);
    document.getElementById("pedidoCantidad").value = myObj.cantidad;
	document.getElementById("pedidoPrecio").value = myObj.precio;
	document.getElementById("pedidoFecha").value = myObj.fecha;
  }
};
xmlhttp.open("GET", "ver_pedidos.php?cod=" + codigo, true);
xmlhttp.send();
   
  document.getElementById("pedidoCodigo2").value = codigo;
  document.getElementById("pedidoProducto").value = producto;
	
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;

}



function closePedido() {

  document.getElementById("myForm4").style.display = "none";

  document.getElementById("blur1").style.filter = "blur(0px)";

}
	
function openError() {

  document.getElementById("error").style.display = "block";

  document.getElementById("blur1").style.filter = "blur(5px)";
   
	
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;

}



function closeError() {

  document.getElementById("error").style.display = "none";

  document.getElementById("blur1").style.filter = "blur(0px)";

}
	
function notif1() {

  document.getElementById("desactivar_notif").submit();

}
	
function notif2() {

  document.getElementById("activar_notif").submit();

}
	
function openImagen(error,link,codigo,producto) {
	
if(!error){
	openSubirImagen(codigo, producto);
	return;
}
	
  window.location=link;

}
	
function openSubirImagen(codigo, producto) {

  document.getElementById("myForm5").style.display = "block";

  document.getElementById("blur1").style.filter = "blur(5px)";
   
  document.getElementById("imagenCodigo").value = codigo;
  document.getElementById("imagenProducto").value = producto;
	
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;

}
	
function closeSubirImagen() {

  document.getElementById("myForm5").style.display = "none";

  document.getElementById("blur1").style.filter = "blur(0px)";

}
	
</script>

<script type="text/javascript" src="../assets/scripts/main.js"></script>
</body>
</html>
<?php

if($_GET['error']){
	echo '<script>openError();</script>';
}
		
}else{

	enviar("login_cerrar.php");

}

?>