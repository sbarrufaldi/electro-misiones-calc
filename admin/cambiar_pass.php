<?php
$usuario = $_REQUEST['user'];
$pass_ant = $_REQUEST['pass_ant'];
$pass = $_REQUEST['pass'];
$pass2 = $_REQUEST['pass2'];

include("conex.php");
$link = conectar();

$consulta = "SELECT * FROM `usuarios` WHERE user = '$usuario'";
$resultado = mysqli_query($link, $consulta);
while($fila = mysqli_fetch_array($resultado)){
    $pass_bd = $fila['pass'];
}

if ($pass_bd !== $pass_ant) {
    echo("<script>alert('Contraseña incorrecta')</script>");
    echo "<script>window.location='cambiar_contrasena.php';</script>";
}

else if ($pass !== $pass2) {
    echo("<script>alert('La contraseña confirmada no coincide con la ingresada anteriormente, vuelva a intentarlo')</script>");
    echo "<script>window.location='cambiar_contrasena.php';</script>";
}
        
else {
    $consulta = "UPDATE `usuarios` SET `pass`='$pass' WHERE user = '$usuario'";

if (mysqli_query($link, $consulta)) {
    echo "<script>window.location='panel.php?pass=1';</script>";
}
else{
    echo "<script>window.location='panel.php?error=1';</script>";
}
}
?>