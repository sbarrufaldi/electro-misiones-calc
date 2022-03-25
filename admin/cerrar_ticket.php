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

$var = 0;
$personal = "";

$num_ticket = $_REQUEST['ticket'];
$solucion = $_REQUEST['solucion'];
$usuario = $_REQUEST['usuario'];

include("conex.php");

$link = conectar();

$consulta = "UPDATE `tickets` SET `activo`= '0', `usuario_cerrado`= '$usuario' WHERE ticket = '$num_ticket'";
mysqli_query($link, $consulta);

$consulta = "INSERT INTO `soluciones`(`ticket`, `fecha`, `timestamp`, `solucion`, `usuario`, `personal`) VALUES ('$num_ticket',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'$solucion','$usuario', '$personal')";

if (mysqli_query($link, $consulta)) {
    echo "<script>window.location='panel.php';</script>";
}
else{
    echo "<script>window.location='panel.php?error=1';</script>";
}
?>