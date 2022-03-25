<?php
	include("conex.php");
	$link = conectar();
	
	// TIMEZONE
    $consulta = "SET time_zone = '-03:00'";
    mysqli_query($link, $consulta);
//------------------------------------------------------------------------------------------
	if(isset($_SESSION['usuario']))
	{
		session_destroy();
	}
	
	session_name("ticket");
	session_start();
//------------------------------------------------------------------------------------------	
	if(isset($_REQUEST['user']))
	{
		$usuario = $_REQUEST['user'];
		$clave	 = $_REQUEST['pass'];
		$consulta = "SELECT * FROM `usuarios` WHERE usuarios.user = '$usuario' and usuarios.pass = '$clave' and usuarios.activo = 1";
		
		$resultado = mysqli_query($link, $consulta);
		
		if(mysqli_num_rows($resultado) <> 0){
			$datos = mysqli_fetch_array($resultado);
			$nombre  = $datos['nombre'];
			$apellido  = $datos['apellido'];
			$admin  = $datos['admin'];
			$siglas  = $datos['siglas_orden'];
			$_SESSION['usuario'] = $usuario;
			$_SESSION['nombre'] = $nombre;
			$_SESSION['apellido'] = $apellido;
			$_SESSION['admin'] = $admin;
			$_SESSION['siglas_orden'] = $siglas;
			$_SESSION['notificaciones'] = "1";
			$_SESSION["login_time_stamp"] = time();  
			if(isset($_REQUEST['pag'])){enviar($_REQUEST['pag']);}
			else{enviar("panel.php");}
			
			$consulta = "UPDATE `usuarios` SET `ultima_conexion`= '".$datos['ultima_conexion2']."' WHERE user = '$usuario'";
			mysqli_query($link, $consulta);
			
			$consulta = "UPDATE `usuarios` SET `ultima_conexion2`= CURRENT_TIMESTAMP WHERE user = '$usuario'";
			mysqli_query($link, $consulta);
			
		}else{
		    $consulta = "SELECT * FROM `usuarios` WHERE usuarios.user = '$usuario' and usuarios.pass = '$clave'";
		    $resultado = mysqli_query($link, $consulta);
		    if(mysqli_num_rows($resultado) <> 0){
		        echo "<script>alert('CUENTA NO ACTIVADA: Active su cuenta desde el enlace que le enviamos a su dirección de e-mail.')</script>";
		        enviar("index.php");
		    }
		    else{
			    enviar("index.php?error=1");
		    }
		}
	
}else{
	enviar("login_cerrar.php");
}
?>
