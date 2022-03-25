<?php
$ticket = $_GET['ticket'];

include("conex.php");
$link = conectar();

$consulta = "SELECT * FROM `soluciones` WHERE ticket = '$ticket'";

$resultado = mysqli_query($link, $consulta);
      while($fila = mysqli_fetch_array($resultado)){
          $myObj = new stdClass;
		  $myObj->solucion = $fila['solucion'];
		  $myObj->personal = $fila['personal'];
		  $myJSON = json_encode($myObj);

		  echo $myJSON;
	  }
?>