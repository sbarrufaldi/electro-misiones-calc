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

$aviso = $_REQUEST['aviso'];
$usuario = $_SESSION['usuario'];
//$correo = $_SESSION['correo'];

include("conex.php");
include("../php-mqtt.php");
$link = conectar();

// MQTT
$server = '192.168.2.9';     // change if necessary
$port = 1883;                     // change if necessary
$username = '';                   // set your username
$password = '';                   // set your password
$client_id = 'tickets'; // make sure this is unique for connecting to sever - you could use uniqid()

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

$mqtt->connect(true, NULL, $username, $password);

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

// BASE DE DATOS
$consulta = "INSERT INTO `tickets`(`ticket`, `fecha`, `timestamp`, `problema`, `detalle`, `usuario`, `activo`, `prioridad`) VALUES ('$ticket',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'$aviso','','$usuario','2','1')";

// MQTT
$mqtt->publish('tickets-aviso', $ticket, 1, false);

$mqtt->close();

if (mysqli_query($link, $consulta)) {
    echo "<script>window.location='panel.php?enviado=1';</script>";
}
else{
    echo "<script>window.location='panel.php?error=1';</script>";
}
?>