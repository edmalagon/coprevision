	<?php
		require_once("config/config5.php");
		$error1 = "Bienvenido al portal WEB de transacciones para PREVISOCIAL.";
		if ( isset($_POST["cuenta"]) && isset($_POST["clave"]) ){
			//print_r($_POST);
			$bd1 = new subase();
			if ($bd1->obtener_conexion()){		// Comparación implícita
				$sql = "SELECT a.id_user,a.nombre nombre,a.foto foto,a.id_perfil perfil,b.nombre_perfil FROM perfil b inner join user a on a.id_perfil=b.id_perfil WHERE cuenta='".$_POST["cuenta"]."' AND clave = '".$_POST["clave"]."' AND estado ='".$_POST["estado"]."'";
				if ( $fila = $bd1->sub_fila($sql) ){
					session_start();
					$_SESSION["AUT"] = $fila;
					header("location:".PROGRAMA);
				} elseif ($bd1->obtener_error()=="") {
					$error1 = "Error: Cuenta o clave errada";
				} else {
					$error1 = $bd1->obtener_error();
				}
			}else{
				//$error1 = "Error: No hay conexión a servidor de Base de Datos";
				$error1 = $bd1->obtener_error();
			}
		}
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="images/iconos/">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="css/animate.css">
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,700' rel='stylesheet' type='text/css'>

	<title>Previsocial WEB</title>
	<script src = "js/sha3.js"></script>
	<script>
		function validar(){
			if (document.forms[0].cuenta.value == ""){
				alert("Upssss!! No digitaste Nombre de Usuario (Username)");
				document.forms[0].cuenta.focus();				// Ubicar el cursor
				return(false);
			}
			if (document.forms[0].clave.value == ""){
				alert("Upssss!! No digitaste Contraseña de Usuario (Password)");
				document.forms[0].clave.focus();				// Ubicar el cursor
				return(false);
			}
			document.forms[0].clave.value = CryptoJS.SHA3(document.forms[0].clave.value);
		}
	</script>
</head>
<body>
	<form action="<?php echo LOGINI;?>" method="POST" onsubmit = "return validar()">					<!-- Se asignan los datos que se vayan a enviar al mismo archivo-->
		<section class="text-center">
			<figure  class="text-center animated slideInDown" >
				<img src="images/previsocial.gif" class="image_login1" alt="Logo_principal">
			</figure>
			<article id="logintitle">
				<?php echo SOFTWARE;?>
			</article>
			<article class="text-center">
				<label for="" class="text-left">Usuario: </label><br>
				<input type="text" name="cuenta" class="form-login"/>
			</article>
			<article class="text-center">
				<label for="" class="text-left">Contraseña: </label><br>
				<input type="password" class="form-login" name="clave"/>
				<input type="hidden" name="estado" value="Activo"/>
			</article>
			<br>
			<article>
				<input class="btn btn-primary" type="submit" value="Aceptar"/>
				<input class="btn btn-primary" type="reset"  value="Limpiar"/>
			</article>
			<br>
			<article>
				<?php echo $error1; ?>
			</article>
		</section>
	</form>
	<footer class="panel panel-footer text-center">
		<article>
			<h4>
				<strong>
					<?php echo EMPRESA;?>
				</strong>
			</h4>
		</article>
		<article>
			<img src="images/visual.png" class="image_visual" alt="">
			<strong>
			<small><?php echo AUTOR;?></small></strong>
		</article>
	</footer>
</body>
</html>
