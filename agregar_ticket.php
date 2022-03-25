<?php
session_name("ticket");
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
	$problema = $area0."  >  ".$area1."  >  ".$area2."  >  ".$area3."  >  ".$area4;
}
else if($area3){
	$problema = $area0."  >  ".$area1."  >  ".$area2."  >  ".$area3;
}
else if($area2){
	$problema = $area0."  >  ".$area1."  >  ".$area2;
}
$detalle = $_REQUEST['detalle'];
$usuario = $_SESSION['usuario'];
//$correo = $_SESSION['correo'];

include("conex.php");
$link = conectar();

$consulta = "SELECT * FROM `tickets` WHERE ticket LIKE '$prefijo%'";
$resultado = mysqli_query($link, $consulta);
if(mysqli_num_rows($resultado) <> 0){ 
      $num_ticket = (mysqli_num_rows($resultado)) + 1;
}
else{
	$num_ticket = 1;
}

$num = sprintf("%05d", $num_ticket);

$ticket = $prefijo . $num;

error_reporting(0);
$domain='http://192.168.2.9/osticket/';

$token = '55941bf02fb567124c66e4561d247051a6e59775'; // __CSRFToken__
$a ='open'; // hidden a
$topicId = '1'; // hidden topicId
$email = $_SESSION['email']; // Email = 161a74037808c8cc
$name = $_SESSION['nombre']." ".$_SESSION['apellido']; // Name = 2d247057c5ca795d
$program = $problema; // Program = 413ba874292bbf99[]
$status = "1"; // Status = bcd8d9dc418d2aec[]   Numeric
$topicq = $detalle; // Topic question = 1dea7a8c0d685fdc
$message = 'Problema: '.$program.'\r\nDetalle: '.$topicq; // Message = message


include('ost-api.php');

// BASE DE DATOS
$consulta = "INSERT INTO `tickets`(`ticket`, `fecha`, `timestamp`, `problema`, `detalle`, `usuario`, `activo`, `prioridad`) VALUES ('$ticket',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'$problema','$detalle','$usuario','1','1')";

if (mysqli_query($link, $consulta)) {
    echo "<script>window.location='panel.php?enviado=1';</script>";
}
else{
    echo "<script>window.location='panel.php?error=1';</script>";
}
?>