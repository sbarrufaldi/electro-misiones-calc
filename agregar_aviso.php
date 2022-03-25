<?php
session_name("ticket");
session_start();

$hoy = new DateTime();
$hoy->setTimezone(new DateTimeZone('America/Argentina/Buenos_Aires'));
$hora = $hoy->format('H');

$prefijo = "101-";

$aviso = $_REQUEST['aviso'];
$pagina = $_REQUEST['pagina'];
$usuario = $_SESSION['usuario'];
$sugerencia = $_REQUEST['sugerencia'];
//$correo = $_SESSION['correo'];

include("conex.php");
$link = conectar();

// TIMEZONE
$consulta = "SET time_zone = '-03:00'";
mysqli_query($link, $consulta);

// CONSULTA
$consulta = "SELECT * FROM `tickets` WHERE 1";
$resultado = mysqli_query($link, $consulta);
if(mysqli_num_rows($resultado) <> 0){ 
      $num_ticket = (mysqli_num_rows($resultado)) + 1;
}
else{
	$num_ticket = 1;
}

$num = sprintf("%04d", $num_ticket);

$ticket = $prefijo . $num;

// BASE DE DATOS
$consulta = "INSERT INTO `tickets`(`ticket`, `fecha`, `timestamp`, `problema`, `detalle`, `usuario`, `activo`, `prioridad`, `sugerencia`) VALUES ('$ticket',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'$aviso','$pagina','$usuario','1','1','$sugerencia')";

if (mysqli_query($link, $consulta)) {
    echo "<script>window.location='panel.php?enviado=1';</script>";
}
else{
    echo "<script>window.location='panel.php?error=1';</script>";
}
?>