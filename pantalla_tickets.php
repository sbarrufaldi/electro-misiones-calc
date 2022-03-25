<?php

	include ("conex.php");

    $link = conectar();

	$hoy = new DateTime();
	$diadelasemanaHoy = $hoy->format('w');
	$hora = $hoy->format('H');

	$ayer = new DateTime();
	$ayer->modify('-1 day');

	$respuesta = ["hola", "hola2"];

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

      $consulta = "SELECT * FROM `tickets` ORDER BY activo DESC";
      $resultado = mysqli_query($link, $consulta);
      while($fila = mysqli_fetch_array($resultado)){
		$fecha = new DateTime($fila['timestamp']);
		$ticket = $fila['ticket'];
		$problema = $fila['problema'];
		  
		//$respuesta = $respuesta . " " . $ticket . " " . $problema . "<br>";
	  }
		  
	echo $respuesta;
    ?>