<?php
session_name("ticket_admin");
session_start();

$hoy = new DateTime();
$hora = $hoy->format('H');

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

$area0 = $_REQUEST['area0'];
$area1 = $_REQUEST['area1'];
$area2 = $_REQUEST['area2'];
$area3 = $_REQUEST['area3'];
$area4 = $_REQUEST['area4'];
if($area4){
	$problema = $area0." > ".$area1." > ".$area2." > ".$area3." > ".$area4;
}
else if($area3){
	$problema = $area0." > ".$area1." > ".$area2." > ".$area3;
}
else if($area2){
	$problema = $area0." > ".$area1." > ".$area2;
}
$detalle = $_REQUEST['detalle'];
$usuario = $_SESSION['usuario'];
//$correo = $_SESSION['correo'];

include("conex.php");
$link = conectar();

// BASE DE DATOS
$consulta = "INSERT INTO `tickets`(`ticket`, `fecha`, `timestamp`, `problema`, `detalle`, `usuario`, `activo`, `prioridad`) VALUES ('$ticket',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'$problema','$detalle','$usuario','1','1')";

if (mysqli_query($link, $consulta)) {
    echo "<script>window.location='panel.php?enviado=1';</script>";
}
else{
    echo "<script>window.location='panel.php?error=1';</script>";
}
?>