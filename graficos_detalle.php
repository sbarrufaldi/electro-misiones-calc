<?php

	include ("conex.php");

//	--------------------------------

	session_name("ticket");

	session_start();	

//	--------------------------------

    $link = conectar();

	$hoy = new DateTime();
	$diadelasemanaHoy = $hoy->format('w');
	$hora = $hoy->format('H');

	$ayer = new DateTime();
	$ayer->modify('-1 day');

	$problema = $_GET['problema'];

	if($hora < 6){
		$prefijo = "N";
	}
	else if($hora < 14){
		$prefijo = "M";
	}
	else if($hora < 22){
		$prefijo = "T";
	}
	else{
		$prefijo = "N";
	}

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
    <title>Tickets | Rendimiento (Detalle)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Control de Pañol">
    <meta name="msapplication-tap-highlight" content="no">
	
<link href="./main.css" rel="stylesheet">
<link href="./assets/dataTables/dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="./assets/dataTables/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="./assets/dataTables/dataTables.min.js"></script>
	
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

        width: 30%;

        left: 35%;

        border: 3px solid #f1f1f1;

        z-index: 9;

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
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header" id="blur1" style="filter: blur(0px); transition: all 1s ease 0s;">
        <div class="app-header header-shadow bg-grow-early header-text-light">
            <div class="app-header__logo">
                <div style="width: 100%;"><img src='assets/images/logo.png' alt='Pa&ntilde;ol' width='90' height='57'><h6 style="float: right;margin-top: 13px;margin-right: 14px;color: #d9e2e7;background-color: #25ac67;border-radius: 100px;padding: 6px;padding-left: 25px;padding-right: 25px;cursor: default;">Tickets</h6></div>
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
								<li class="app-sidebar__heading">Abrir Ticket</li>
								<li>
                                    <a href="nuevo_ticket.php">
                                        <i class="metismenu-icon pe-7s-plus"></i>
                                         Nuevo ticket
                                    </a>
                                </li>
								<li class="app-sidebar__heading">Rendimiento</li>
								<li>
                                    <a href="graficos.php" class="mm-active">
                                        <i class="metismenu-icon pe-7s-graph3"></i>
                                         General (Detalle)
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
                                            <div class="card-body">
                                                <div class="tab-content">
													<h6 style="border-radius: 50px;text-align: center;background-color: #30b464;color: white;padding: 8px;"><?php echo $problema ?></h6>
                                                    <div class="tab-pane active" id="tab-animated1-0" role="tabpanel">

<!-- ##################################### COMIENZO DE TABLA ##################################### -->
														
														
<div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tabla1">
                                            <thead>
                                            <tr>
												<th style="width: 100px;">Ticket N°</th>
                                                <th>Problema</th>
                                                <th>Descripci&oacute;n</th>
												<th>Estado</th>
                                            </tr>
                                            </thead>
                                            <tbody>
												<?php
      $consulta = "SELECT * FROM `tickets` WHERE problema = '$problema' ORDER BY timestamp DESC";
      $resultado = mysqli_query($link, $consulta);
	  $count = 0;
      while($fila = mysqli_fetch_array($resultado)){
		$count = $count + 1;
		$fecha = new DateTime($fila['timestamp']);
		if($fecha->format('d/m/Y') == $hoy->format('d/m/Y')){
			$mostrarFecha = "<b>Hoy</b> a las <b>".$fecha->format('H:i')."</b>";
		}
		else if($fecha->format('d/m/Y') == $ayer->format('d/m/Y')){
			$mostrarFecha = "<b>Ayer</b> a las <b>".$fecha->format('H:i')."</b>";
		}
		else{
			$mostrarFecha = "El <b>".$fecha->format('d/m/Y')."</b> a las <b>".$fecha->format('H:i')."</b>";
		}
		if($fila['activo'] == 1){
			$estado = "<div class='mb-2 mr-2 badge badge-pill badge-info'>Abierto</div>";
		}
		else{
			$estado = "<div class='mb-2 mr-2 badge badge-pill badge-success'>Solucionado</div>";
		}
    ?>
                                            <tr>
                                                <td><?php echo $fila['ticket'] ?></td>
      											<td><?php echo $fila['problema'] ?>
												<div class="widget-subheading opacity-7"><?php echo $mostrarFecha; ?></div></td>
      											<td><?php echo $fila['detalle'] ?></td>
												<td class="text-center"><?php echo $estado ?></td>
                                            </tr>
												<?php } ?>
                                            </tbody>
                                        </table>
                                    </div>


<!-- ##################################### FINAL DE TABLA ##################################### -->

                                                    </div>
												</div>

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
                                    
<div class="form-popup" id="myForm">

  <form method="post" action="agregar_pedidos.php" class="form-container" style="margin-bottom: 0;">

    <h2 style="text-align: center;font-size: 25px;">Agregar Pedido</h2>
	  
	<input type="text" id="usuario" name="usuario" readonly="readonly" value="<?php echo $_SESSION['usuario'];?>" style="display:none">

    <br>

    <label><b>Producto</b></label>
    <br>
    <input type="text" id="producto_pedido" name="producto_pedido" readonly="readonly" required>

    <hr>
    
    <label><b>Precio</b></label>

    <input type="float" name="precio" id="precio">

    <hr>

    <label><b>Cantidad</b></label>

    <input type="number" name="cantidad" id="cantidad" required>

    <hr>
    
    <label><b>Detalle <label style="color: lightgray;margin-bottom: 0px;">(opcional)</label></b></label>

    <input type="text" name="detalle" id="detalle">

    <hr>

    <button class='btn button-style mt-md-0 mt-4' type="submit" style="height: 50px;color: white;font-size: 15px;font-weight: bold;width: 120px;float: right;background: #178d44;border-radius: 50px;">Agregar</button>

    <button class='btn button-style mt-md-0 mt-4' type="button" onclick="closeForm()" style="float: left;padding: 8px;background: #178d44;border-radius: 50px;"><img src='images/iconoatras.png' style='height: 33px; cursor: pointer;'></button>

    <button class="btn button-style mt-md-0 mt-4 btncerrar" type="button" onclick="closeForm()" style="background: #178d44;border-radius: 50px;"><img src="images/iconocruz.png" style="height: 21px; cursor: pointer;"></button>

    </form>

</div>

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

    </form>

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

<div class="form-popup" id="enviado" style="background-color: rgb(182 228 203 / 70%);border: 3px solid rgb(163 210 183 / 50%);">

  <form class="form-container" style="margin-bottom: 0;text-align: center;">

    <h5 style="text-align: center;">¡Ticket enviado!</h5>

    <hr>

    <input type="text" name="user" value="" style="display: none;">

    <h6>El ticket se envió con éxito.</h6>

    <br>

    <button class="btn button-style mt-md-0 mt-4" type="button" onclick="closeEnviado()" style="height: 50px;color: white;font-size: 15px;font-weight: bold;width: 120px;background: #24af5f;border-radius: 50px;">Aceptar</button>

    </form>

</div>

<div class="form-popup" id="passCambiada" style="background-color: rgb(182 228 203 / 70%);border: 3px solid rgb(163 210 183 / 50%);">

  <form class="form-container" style="margin-bottom: 0;text-align: center;">

    <h5 style="text-align: center;">¡Contrase&ntilde;a cambiada!</h5>

    <hr>

    <input type="text" name="user" value="" style="display: none;">

    <h6>Su contrase&ntilde;a se cambi&oacute; con éxito.</h6>

    <br>

    <button class="btn button-style mt-md-0 mt-4" type="button" onclick="closePass()" style="height: 50px;color: white;font-size: 15px;font-weight: bold;width: 120px;background: #24af5f;border-radius: 50px;">Aceptar</button>

    </form>

</div>

<script type="text/javascript">
    function openForm(codigo, producto) {

  document.getElementById("myForm").style.display = "block";

  document.getElementById("blur1").style.filter = "blur(5px)";
  
  document.getElementById("producto_pedido").value = producto;
  
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;

}



function closeForm() {

  document.getElementById("myForm").style.display = "none";

  document.getElementById("blur1").style.filter = "blur(0px)";

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
	
function openEnviado() {

  document.getElementById("enviado").style.display = "block";

  document.getElementById("blur1").style.filter = "blur(5px)";
   
	
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;

}



function closeEnviado() {

  document.getElementById("enviado").style.display = "none";

  document.getElementById("blur1").style.filter = "blur(0px)";

}
	
function openPass() {

  document.getElementById("passCambiada").style.display = "block";

  document.getElementById("blur1").style.filter = "blur(5px)";
   
	
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;

}



function closePass() {

  document.getElementById("passCambiada").style.display = "none";

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
<script type="text/javascript" src="./assets/scripts/main.js"></script>
</body>
</html>
<?php

if($_GET['error']){
	echo '<script>openError();</script>';
}
	 
if($_GET['enviado']){
	echo '<script>openEnviado();</script>';
}
	 
if($_GET['pass']){
	echo '<script>openPass();</script>';
}
		
}else{

	enviar("login_cerrar.php");

}

?>