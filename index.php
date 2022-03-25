<html>

<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">

<title>Tickets | Login</title>

<head>

<link rel='shortcut icon' type='image/x-icon' href='favicon.png'>

<meta name="keywords" content="control de pañol stock" />

	<script>

		addEventListener("load", function () {

			setTimeout(hideURLbar, 0);

		}, false);



		function hideURLbar() {

			window.scrollTo(0, 1);

		}

	</script>

	<!-- //Meta tag Keywords -->



	<!-- Custom-Files -->

	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Bootstrap-Core-CSS -->

	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />

	<!-- Style-CSS -->

	<link href="css/font-awesome.min.css" rel="stylesheet">

	<!-- Font-Awesome-Icons-CSS -->

	<!-- //Custom-Files -->



	<!-- Web-Fonts -->

	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext"

	 rel="stylesheet">

	<!-- //Web-Fonts -->



<style>div,fieldset,input,select,a{color:#0b9cbd;border-radius:4rem;min-width:250px;text-align:center;padding:5px;font-size:1em;font-family: Tahoma, Helvetica, sans-serif;}input{box-sizing:border-box;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;}select{width:100%;}textarea{resize:none;width:100%;height:318px;padding:5px;overflow:auto;}body{text-align:center;font-family:verdana;background: #f4f4fa;}td{padding:0px;}label{border:0;border-radius:4rem;background-color:#0b9cbd;color:#fff;text-align:center;line-height:2.4rem;font-size:1.2rem;-webkit-transition-duration:0.4s;transition-duration:0.4s;cursor:pointer;}label:hover{background-color:#438291;}button{border:0;border-radius:5rem;background-color:#0b9cbd;color:#fff;display:block;line-height:2.4rem;font-size:1.2rem;-webkit-transition-duration:0.4s;transition-duration:0.4s;cursor:pointer;}button:hover{background-color:#0e70a4;}.bred{ display: block;    position: relative;    padding: 2px;    cursor: pointer;    font-size: 18px;    -webkit-user-select: none;    -moz-user-select: none;    -ms-user-select: none;    user-select: none;    background-color:#0b9cbd;    }.bred:hover{background-color:#438291;}.bgrn{background-color:#47c266;}.bgrn:hover{background-color:#5aaf6f;}a{text-decoration:none;}.p{float:left;text-align:left;}.q{float:right;text-align:right;}.container {    display: block;    position: relative;    cursor: pointer;    font-size: 18px;    -webkit-user-select: none;    -moz-user-select: none;    -ms-user-select: none;    user-select: none;}.container input {    position: fixed;    opacity: 0;    cursor: pointer;}.checkmark {    top: 0;    left: 0;    height: 2.4rem;    width: 2.4rem;    background-color: #ddd;}.container:hover input ~ .checkmark {    background-color: #ddd;}.container input:checked ~ .checkmark {    background-color: #008ec5;}.checkmark:after {    content: "";    position: absolute;    display: none;}.container input:checked ~ .checkmark:after {    display: block;}.container .checkmark:after {    left: 0.9rem;    top: 0.8rem;    width: 5px;    height: 10px;    border: solid white;    border-width: 0 3px 3px 0;    -webkit-transform: rotate(45deg);    -ms-transform: rotate(45deg);    transform: rotate(45deg);}.slidecontainer {}.slider {    -webkit-appearance: none;    width: 100%;    height: 15px;    border-radius: 5px;    background: #d3d3d3;    outline: none;    opacity: 0.7;    -webkit-transition: .2s;    transition: opacity .2s;}.slider:hover {    opacity: 1;}.slider::-webkit-slider-thumb {    -webkit-appearance: none;    appearance: none;    width: 25px;    height: 25px;    border-radius: 50%;    background: #008ec5;    cursor: pointer;}.slider::-moz-range-thumb {    width: 25px;    height: 25px;    border-radius: 50%;    background: #4CAF50;    cursor: pointer;}input[type=number], input[type=datetime-local] {  width: 100%;  padding: 12px 20px;  margin: 8px 0;  box-sizing: border-box;  border: 3px solid #aaa;  -webkit-transition: 0.5s;  transition: 0.5s;  outline: none;  border-radius: 5rem;  font-family: Tahoma, Helvetica, sans-serif;}



.form-popup {

        display: none;

        background-color: white;

        position: absolute;

        top: 15%;

        width: 30%;

        left: 35%;

        border: 3px solid #f1f1f1;

        z-index: 9;

        padding-bottom: 8px;

        border-radius: 30px;

    }



@media 

only screen and (max-width: 760px),

(min-device-width: 768px) and (max-device-width: 1024px)  {

/* The popup form - hidden by default */

    .form-popup {

        display: none;

        background-color: white;

        position: absolute;

        top: 15%;

        width: 80%;

        left: 10%;

        border: 3px solid #f1f1f1;

        z-index: 9;

        padding-bottom: 8px;

        border-radius: 36px;

    }

}



/* Add styles to the form container */

.form-container {

  padding: 10px;

}



/* Full-width input fields */

.form-container input[type=text], .form-container input[type=password], .form-container input[type=number], .form-container select {

  width: 100%;

  padding: 15px;

  margin: 5px 0 22px 0;

  border: none;

  background: #f1f1f1;

}



/* When the inputs get focus, do something */

.form-container input[type=text]:focus, .form-container input[type=password]:focus, .form-container input[type=number], .form-container select:focus {

  background-color: #f4f4f4;

  outline: none;

}



/* Add some hover effects to buttons */

.form-container .btn:hover, .open-button:hover {

  opacity: 1;

}



.btncerrar {

    float: right;

    position: absolute;

    padding: 8px;

    left: 94%;

    top: -25px;

    padding: 14px;

}



@media 

only screen and (max-width: 760px),

(min-device-width: 768px) and (max-device-width: 1024px)  {

    .btncerrar {

        float: right;

        position: absolute;

        padding: 8px;

        left: 92%;

        top: -48px;

        padding: 14px;

    }   

}

</style>

</head>

<body>

    

    <div style="height: 100%;width: 100%;display: table;">

    <div style="display: table-cell;height: 100%;vertical-align: middle;">

    <div style='text-align:center;display:inline-block;min-width:340px;'><div style='text-align:center;'>
		
		

    <img src="images/logo_cyan.png" alt="Tickets" width="160" height="160"><br><br><style> form { border: 4px solid #169ebf; background-color: #99bcdb; border-radius: 34px; text-align: center; color: #fff;}
	.form-error { border: 4px solid #dc3545; background-color: #dc3545; border-radius: 23px; text-align: center; color: #fff;} </style>

    

<div class="form-popup" id="error">

  <form class="form-container form-error" style="margin-bottom: -4;text-align: center;">

    <h3 style="text-align: center;">Error de login</h3>

    <br>

    <input type="text" name="user" value="<?php echo $_SESSION['usuario'];?>" style="display: none;">

    <h5>Datos de ingreso incorrectos.<hr>Ingrese correctamente los datos e intente nuevamente, de lo contrario, presione "Olvid&eacute; mi contrase&ntilde;a" o cont&aacute;ctese con el administrador.</h5>

    <br>

    <button class='btn button-style mt-md-0 mt-4' type="button" onclick="closeError()" style="width: 120px;background-color: #caa;"><h5>Aceptar</h5></button>

    </form>

</div>

<form name="coop" method="POST" action="login_validar.php<?php if(isset($_REQUEST['pag'])){echo "?pag=" . $_REQUEST['pag'];}?>" id="blur1">

	<h4 style="text-align: center;color: white;background-color: #0b9cbd;border-radius: 100px;padding: 13px;">TICKETS</h4>
    <br>

	<input type='text'value=''style='text-align: center;border: none;' placeholder='Usuario' name='user' id='user' required>

	<br>

	<input type='password' value=''style='text-align: center; margin-top: 12px;border: none;' placeholder='Contraseña' name='pass' id='pass' required>

	<br>

	<div style='text-align: -webkit-center;display: inline-block; '>

    <label class="button bred" style='margin-top: 12px;'>Iniciar sesión<input type='submit' style='position: fixed; visibility: hidden;'>

	</label>

	<div style="padding: 10;"><a href="https://wa.me/5493764283322?text=Hola! Necesito ayuda, olvidé mi contraseña." target="_blank">Olvidé mi contraseña</a></div>

	</div>

</form>

    

    <script>

    function Submit() {

        document.getElementById('buscar').style.display = 'none';

    }

    

    function openError() {

  document.getElementById("error").style.display = "block";

  document.getElementById("blur1").style.filter = "blur(5px)";

}



function closeError() {

  document.getElementById("error").style.display = "none";

  document.getElementById("blur1").style.filter = "blur(0px)";

}

    </script>
		
<div style="padding: 10;"><a href="admin/">Ingresar como Administrador</a></div>
	</div>

</div>

</div>

</div>

<div style="background-color:#f4f4fa;height: 30px;width: 100%;position:fixed;bottom:0;z-index:10000000;text-align:center;">

</div>

<?php

if(isset($_REQUEST['error']))

	{

	    echo "<script>openError();</script>";

	}

?>

</body>

</html>