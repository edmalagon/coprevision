
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
			case 'E':
			$fecha=$_POST["fnacimiento"];
			$segundos= strtotime('now') - strtotime($fecha);
			$diferencia_dias=intval($segundos /60/60/24);
			$dias=floor($diferencia_dias/365);
			$nom_completo=$_POST["nom1"].' '.$_POST["nom2"].' '.$_POST["ape1"].' '.$_POST["ape2"];
			$sql="UPDATE cliente SET tdoc_cli='".$_POST['tdoc_cli']."', doc_cli='".$_POST['doc_cli']."',
			nom1='".$_POST['nom1']."', nom2='".$_POST['nom2']."', ape1='".$_POST['ape1']."',
			ape2='".$_POST['ape2']."',fnacimiento='".$_POST['fnacimiento']."', edad='".$dias."',
			email_cli='".$_POST['email_cli']."', dir_cli='".$_POST['dir_cli']."',
				fijo='".$_POST['fijo']."', celular='".$_POST['celular']."',
				nom_completo='".$nom_completo."', gremio='".$_POST['gremio']."' WHERE id_cliente='".$_POST['id_cliente']."'";
				$subtitulo="Actualizado";
			break;
			case 'X':
				$sql="SELECT logo from cliente where id=".$_POST["idcli"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="UPDATE cliente SET estado_cli=2 WHERE id_cliente=".$_POST["id_cliente"];
				$subtitulo="Eliminado";
			break;
			case 'A':
			$fecha=$_POST["fnacimiento"];
			$segundos= strtotime('now') - strtotime($fecha);
			$diferencia_dias=intval($segundos /60/60/24);
			$dias=floor($diferencia_dias/365);

			$nom_completo=$_POST["nom1"].' '.$_POST["nom2"].' '.$_POST["ape1"].' '.$_POST["ape2"];
			$sql="INSERT INTO cliente (resp_reg, tdoc_cli, doc_cli, nom1, nom2, ape1, ape2, fnacimiento, edad, email_cli, dir_cli,
				fijo, celular, estado_cli,nom_completo)
			VALUES ('".$_SESSION["AUT"]["id_user"]."','".$_POST["tdoc_cli"]."','".$_POST["doc_cli"]."', '".$_POST["nom1"]."', '".$_POST["nom2"]."', '".$_POST["ape1"]."',
							'".$_POST["ape2"]."','".$_POST["fnacimiento"]."', '".$dias."', '".$_POST["email_cli"]."', '".$_POST["dir_cli"]."', '".$_POST["fijo"]."',
							'".$_POST["celular"]."', '1','".$nom_completo."')";
			$subtitulo="El cliente ";
			$sub2="adicionado";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo fue $sub2 con exito!";
			$check='si';
		}else{
			$subtitulo="$subtitulo NO fue $sub2 !!! . Comuniquese con el soporte técnico.";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'E':
			$sql="SELECT a.id_cliente, tdoc_cli, doc_cli, nom1, nom2, ape1, ape2,
									 fnacimiento, edad, email_cli, dir_cli,
									 fijo, celular, estado_cli,nom_completo
						FROM cliente a
						WHERE a.doc_cli='".$_GET['doc']."'";
						//echo $sql;
			$color="green";
			$boton="Actualizar datos cliente";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$return=$_REQUEST['doc'];
			$form1='vistaCliente/add_cliente.php';
			$subtitulo='Edición de datos del Vehículo';
			break;
			case 'X':
			$sql="SELECT a.id_cliente, tdoc_cli, doc_cli, nom1, nom2, ape1, ape2,
									 fnacimiento, edad, email_cli, dir_cli,
									 fijo, celular, estado_cli,nom_completo
						FROM cliente a
						WHERE a.doc_cli='".$_GET['doc']."'";
			$color="red";
			$boton="Eliminar Cliente";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$form1='vistaCliente/add_cliente.php';
			$subtitulo='Confirmación para eliminar de datos del cliente';
			break;
			case 'A':
			$sql="";
			$color="yellow";
			$boton="Agregar datos del cliente";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$edad='<h4>?</h4>';
			$form1='vistaCliente/add_cliente.php';
			$subtitulo='';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_cliente"=>"", "tdoc_cli"=>"", "doc_cli"=>"", "nom1"=>"", "nom2"=>"", "ape1"=>"", "ape2"=>"",
				"fnacimiento"=>"", "edad"=>"", "email_cli"=>"", "dir_cli"=>"", "fijo"=>"", "celular"=>"", "estado_cli"=>"","nom_completo"=>"");
			}
		}else{
			$fila=array("id_cliente"=>"", "tdoc_cli"=>"", "doc_cli"=>"", "nom1"=>"", "nom2"=>"", "ape1"=>"", "ape2"=>"",
			"fnacimiento"=>"", "edad"=>"", "email_cli"=>"", "dir_cli"=>"", "fijo"=>"", "celular"=>"", "estado_cli"=>"","nom_completo"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nom_cliente.value == ""){
					alert("Se requiere el nombre del cliente!");
					document.forms[0].nom_cliente.focus();				// Ubicar el cursor
					return(false);
				}

			}
		</script>
		<?php include($form1);?>

<?php
}else{
	if ($check=='si') {
		echo'<section>';
		echo '<script>swal("EXCELENTE !!! '.$subtitulo.'","","success")</script>';
		echo'</section>';
	}if ($check=='no') {
		echo'<section>';
		echo '<script>swal("DEBES REVISAR EL PROCESO !!! '.$subtitulo.'","","error")</script>';
		echo'</section>';
	}
// nivel 1?>
<section class="panel panel-default">
	<section class="panel-heading"><h4>REGISTRO: Operación general de afiliciones PREVISOCIAL Filtrado por gremios</h4></section>
	<section class="col-xs-6">
		<form>
			<section class="panel-body">
				<article class="col-xs-12 input-group">
					<span class="input-group-addon fa fa-user" id="basic-addon1"></span>
					<input type="text" class="form-control" placeholder="Digite nombre del gremio" name="doc" aria-describedby="basic-addon1">
				</article>
				<br>
				<div>
					<input type="submit" name="buscar" class="btn btn-warning" value="Buscar">
					<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
				</div>
			</section>
		</form>
	</section>
	<section class="panel-body">
		<table class="table table-responsive table-bordered">
			<tr>
				<td colspan="7" class="text-right">
					<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A'?>" align="center" >
						<button type="button" class="btn btn-info fa fa-plus-circle fa-3x" > Adicionar Nuevo Cliente</button>
					</a>
				</td>
			</tr>
		<tr>
			<th colspan="2" class="text-center info"></th>
			<th class="text-center info">IDENTIFICACIÓN</th>
			<th class="text-center info">NOMBRE CLIENTE</th>
			<th class="text-center info">DIRECCION</th>
			<th class="text-center info">TELEFONOS</th>
			<th colspan="2" class="text-center info">ACCIONES</th>
		</tr>

			<?php
			if (isset($_REQUEST["doc"])){
			$doc=$_REQUEST["doc"];
			$f1=$_REQUEST["f1"];
			$f2=$_REQUEST["f2"];
			$sql="SELECT id_cliente, tdoc_cli, doc_cli, nom1, nom2, ape1, ape2, fnacimiento,
									 edad, email_cli, dir_cli, fijo, celular, estado_cli,nom_completo

						FROM cliente

						WHERE gremio = '".$doc."' ";
						//echo $sql;
			$sql1="SELECT id_afiliacion, id_empresa, id_convenio, id_cliente, resp_reg, freg, fini_afiliacion, eps_afiliacion,
										afp_afiliacion, ccf_afiliacion, arp_afiliacion, ocupacion, clase_riesgo, estado_afiliacion

						FROM afiliacion

						WHERE estado_afiliacion=1";
			 if ($tabla=$bd1->sub_tuplas($sql)){
          foreach ($tabla as $fila ) {
						if ($fila['estado_cli']==1) {
							echo"<tr>\n";
	        		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=X&doc='.$fila["doc_cli"].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar Cliente</button></a></th>';
	        		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&doc='.$fila["doc_cli"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-edit"></span>Editar Cliente</button></a></th>';
	        		echo'<td class="text-right"><strong>'.$fila["tdoc_cli"].':</strong> '.$fila["doc_cli"].'</td>';
	        		echo'<td class="text-center">
										<p>'.$fila["nom_completo"].'</p>
										<p>'.$fila["gremio"].'</p>
							</td>';
	        		echo'<td class="text-left">'.$fila["dir_cli"].'</td>';
	        		echo'<td class="text-left"><strong>Fijo: </strong>'.$fila["fijo"].' <strong>Celular: </strong>'.$fila["celular"].'</td>';
							echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion=4&id='.$fila["id_cliente"].'&doc='.$fila["doc_cli"].'&nc='.$fila["nom_completo"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-rocket"></span> Ver Afiliaciones</button></a></th>';
	        		echo "</tr>\n";
						}

        	}
       }
			}
			?>

	</table>
</section>
	<?php
}
?>
