<?php

	function conectar(){

		$servidor	= "localhost";

		$usuario	= "id18408264_sbe";

		$clave		= "IWillBeRich1<";

		$bd			= "id18408264_sbetechs";

		

		if(!($link = mysqli_connect($servidor,$usuario,$clave))){

			echo "ERROR DE CONEXION CON EL SERVIDOR";

			exit();

		}

		

		if(!mysqli_select_db($link,$bd)){

			echo "ERROR DE CONEXION CON LA BASE DE DATOS";

			exit();		

		}

		

		return $link;

	}

	

	function enviar($url){

		echo "<script>window.location='".$url."';</script>";

	}

?>