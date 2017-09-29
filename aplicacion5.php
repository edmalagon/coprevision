<?php
session_start();
require_once("config/config5.php");

if (isset($_GET["salir"])){
	if ($_GET["salir"] == $_SESSION["AUT"]["id_user"]){
	    session_unset();
		session_destroy();

		}
}
if (!isset($_SESSION["AUT"]["id_user"])){
	header("location:".LOGINI);
}
	$bd1=new subase();
	$error1="";
		if (!$bd1->obtener_conexion()){			//comparacion implicita
 			$error1="error en conexión a base de datos";
		}
?>
<!DOCTYPE html>
<html>
 <head>
 	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/estilomapa.css">
	<link rel="stylesheet" href="css/estilo.css">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="shortcut icon" href="images/ico/.ico">
  <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="http://csshake.surge.sh/csshake.min.css">
	<link rel="stylesheet" href="css/sweetalert.css" media="screen" title="no title" charset="utf-8">
	<script src="js/sweetalert.min.js"></script>
  <script src="http://maps.googleapis.com/maps/api/js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/js/jquery-3.1.1.min.js" charset="utf-8"></script>
	<script src="js/js/jquery-ui.min.js" charset="utf-8"></script>
	<script src="js2/jquery.js" charset="utf-8"></script>
	<script src="js2/jqueryui.js" charset="utf-8"></script>
	<script src="js2/tool.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="js/js/ajax.js"></script>
	<script type="text/javascript" src="js/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/js/jquery-1.3.2.min.js"></script>

	<script>
			function mostrarbod(){
				var bodega = $("#sede").val();
				$.ajax({
					url: "departamento.php",
					data: {idpais:bodega},
					type: "POST",
					success: function(resultado){
								$("#bodeguita").html(resultado);
						}
					});
				}
	</script>

 	<title>Previsocial WEB</title>

 	<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nombre.value == ""){
					alert("Se requiere el nombre del usuario!");
					document.forms[0].nombre.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].cuenta.value == ""){
					alert("Se requiere la cuenta del usuario!");
					document.forms[0].cuenta.focus();				// Ubicar el cursor
					return(false);
				}

				if (document.forms[0].clave1.value == document.forms[0].clave2.value ){
					if (document.forms[0].clave1.value != ""){
						document.forms[0].clave1.value = CryptoJS.SHA3(document.forms[0].clave1.value);
						document.forms[0].clave2.value = document.forms[0].clave1.value;
					}
				}else{
					alert("Error en confirmacion de la clave!");
					document.forms[0].clave1.value = "";
					document.forms[0].clave2.value = "";
					document.forms[0].clave1.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
 </head>
 <body>
	 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class=" btn btn-outline-success my-2 my-sm-0 navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo PROGRAMA ;?>"><img src="images/previsocial.jpg" class="image_logo" alt="logoP"></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav" id="barra">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Configuración <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><?php include("menus/configuracion.php");?></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav" id="barra">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Registros <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><?php include("menus/registros.php");?></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav" id="barra">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Consultas <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><?php include("menus/consultas.php");?></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav" id="barra">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><?php include("menus/reportes.php");?></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<button type="button" class="btn btn-primary fa fa-envelope"> <span class="badge">7</span></button>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php include("usuario".VERSION.".php");?></span></a>
					<ul class="dropdown-menu">
						<li><a href="#"><span class="fa fa-key"></span> Cambio de Clave</a></li>
						<li><a href="#"><span class="fa fa-gears"></span> Soporte</a></li>
						<li><a href="#"><span class="fa fa-mortar-board"></span> Capacitación</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="<?php echo PROGRAMA."?salir=".$_SESSION["AUT"]["id_user"]; ?>" class="text-center"><span class="fa fa-power-off"></span> Salir</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	 </nav>

  <section class="modal fade" id="myModal" role="dialog">
    <section class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Notificaciones: Pendientes por gestionar</h4>
        </div>
        <div class="modal-body">
          <table class="table table-responsive lettermodal">
            <tr>
              <th id="th-estilo1"></th>
              <th id="th-estilo2">FECHA DE VIAJE</th>
              <th id="th-estilo1">NOMBRE PASAJERO</th>
              <th id="th-estilo2">TRAYECTORIA</th>
              <th id="th-estilo1">TRANSPORTADORA</th>
              <th id="th-estilo2">ESTADO</th>
            </tr>
            <?php

            $sql="SELECT c.id_cliente,nom_cliente,t.id_tk,fecha_viaje,nombre_pasajero,estado_tk,r.id_ruta,origen,destino,o.id_transportadora,nombre_transpor from cliente c LEFT JOIN Tiquetes t on t.id_cliente=c.id_cliente LEFT JOIN Ruta r on  r.id_ruta=t.id_ruta LEFT JOIN Transportadora o on o.id_transportadora=r.id_transportadora";

            if ($tabla=$bd1->sub_tuplas($sql)){
              //echo $sql;
              foreach ($tabla as $fila ) {
                if ($fila["estado_tk"]=="En Tramite") {
                echo"<tr >\n";
                echo'<th class="text-center danger" ><a href="'.PROGRAMA.'?opcion=6&mante=E&idtk='.$fila["id_tk"].'&idcli='.$fila["id_cliente"].'"><button type="button" class="btn btn-primary" ><span class="glyphicon glyphicon-play-circle"></span></button></a></th>';
                echo'<td class="text-center danger">'.$fila["fecha_viaje"].'</td>';
                echo'<td class="text-center danger">'.$fila["nombre_pasajero"].'</td>';
                echo'<td class="text-center danger">'.$fila["origen"].' -- '.$fila["destino"].'</td>';
                echo'<td class="text-center danger">'.$fila["nombre_transpor"].'</td>';
                echo'<td class="text-center danger" >'.$fila["estado_tk"].'</td>';
                echo "</tr>\n";
                }
              }
            }
            ?>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </section>
  </section>
  <section class="panel panel-default">
    <article id="contenidoP" class="panel panel-body">
      <?php include("contenido".VERSION.".php");?>
    </article>
  </section>
  <footer class="panel panel-footer text-center" >
    <?php include("pie".VERSION.".php");?>
  </footer>
</body>
</html>
