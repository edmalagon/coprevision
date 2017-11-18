
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["fotopac"])){
				if (is_uploaded_file($_FILES["fotopac"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["fotopac"]["name"]);
					$archivo=$_POST["docpac"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["fotopac"]["tmp_name"],LOG.PACIENTES.$archivo)){
						$fotoE=",fotopac='".PACIENTES.$archivo."'";
						$fotoA1=",fotopac";
						$fotoA2=",'".PACIENTES.$archivo."'";
						}
				}
			}
			switch ($_POST["operacion"]) {
			case 'EGRESO':
				$sql="UPDATE afiliacion SET estado_afiliacion=0,motivo_egreso='".$_POST["motivo_egreso"]."' ,obs_egreso='".$_POST["obs_egreso"]."' ,resp_egreso='".$_SESSION["AUT"]['id_user']."' WHERE id_afiliacion='".$_POST["id_afiliacion"]."'";
				$subtitulo="La afiliación del cliente";
				$sub2="Inactivada";
			break;
			case 'X':
				$sql="SELECT logo from cliente where id=".$_POST["idcli"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="DELETE FROM cliente WHERE id_cliente=".$_POST["idcli"];
				$subtitulo="Eliminado";
			break;
			case 'A':
			$f=date('Y-m-d');
				$sql="INSERT INTO afiliacion (id_empresa, id_convenio, id_cliente, resp_reg, fini_afiliacion,
					eps_afiliacion, afp_afiliacion, ccf_afiliacion, arp_afiliacion, ocupacion, clase_riesgo,salario, estado_afiliacion)
				VALUES ('".$_POST["id_empresa"]."','".$_POST["id_convenio"]."','".$_POST["id_cliente"]."','".$_SESSION['AUT']['id_user']."',
				'".$_POST["fini_afiliacion"]."','".$_POST["eps_afiliacion"]."','".$_POST["afp_afiliacion"]."','".$_POST["ccf_afiliacion"]."',
				'".$_POST["arp_afiliacion"]."','".$_POST["idocu"]."','".$_POST["nivel_arp"]."','".$_POST["salario"]."','1')";
				$subtitulo="La afiliación del cliente";
				$sub2='Agregada';
			break;
			case 'CLAVE': //pendiente crear en bd de produccion
			$sql="UPDATE clave  SET resp_clave='".$_SESSION["AUT"]['id_user']."',usuario='".$_POST["usuario"]."',
			clave='".$_POST["clave"]."' WHERE id_afiliacion='".$_POST["id_afiliacion"]."' ";
				$subtitulo="Las credenciales";
				$sub2='Agregada';
			break;
		}
		echo $sql;
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
		case 'EGRESO':
			$sql="SELECT id_afiliacion, id_empresa, id_convenio, id_cliente, resp_reg, freg, fini_afiliacion,
									 eps_afiliacion, afp_afiliacion, ccf_afiliacion, arp_afiliacion, ocupacion, clase_riesgo,
									 salario, estado_afiliacion, resp_clave, usuario, clave, resp_egreso, obs_egreso
						FROM afiliacion
						WHERE id_afiliacion='".$_REQUEST['ida']."'";
						//echo $sql;
			$color="green";
			$boton="Inactivar Afiliación";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$ida=$_REQUEST['idc'];

			$doc=$_REQUEST['doc'];
			$nc=$_REQUEST['nc'];
			$form1='vistaAfiliacion/fin_afiliacion.php';
			$subtitulo='Inactivar Afiliación';
		break;

		case 'X':
			$sql="";
			$color="red";
			$boton="Eliminar";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$subtitulo='Confirmación para eliminar de datos del Vehículo';
			break;

			case 'A':
			$sql="SELECT a.id_cliente, tdoc_cli, doc_cli, nom1, nom2, ape1, ape2, fnacimiento, edad, email_cli, dir_cli,
										 fijo, celular, estado_cli,nom_completo

						FROM cliente a

						WHERE a.doc_cli='".$_GET['doc']."' ";
						//echo $sql;
			$color="yellow";
			$boton="Agregar afiliación";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$edad='<h4>?</h4>';
			$ida=$_REQUEST['idc'];
			$doc=$_REQUEST['doc'];
			$nc=$_REQUEST['nc'];
			$form1='vistaAfiliacion/add_afiliacion.php';
			$subtitulo='';
			break;
			case 'CLAVE':
			$sql="SELECT a.id_cliente, tdoc_cli, doc_cli, nom1, nom2, ape1, ape2, fnacimiento, edad, email_cli, dir_cli,
										 fijo, celular, estado_cli,nom_completo,
									 b.id_afiliacion

						FROM cliente a INNER JOIN afiliacion b on a.id_cliente=b.id_cliente

						WHERE a.doc_cli='".$_GET['doc']."' ";
						//echo $sql;
			$color="yellow";
			$boton="Agregar datos";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$edad='<h4>?</h4>';
			$doc=$_REQUEST['doc'];
			$nc=$_REQUEST['nc'];
			$form1='vistaAfiliacion/clave.php';
			$subtitulo='Registro de credenciales en plataforma de pagos online';
			break;
			case 'SOPORTES':
			$sql="SELECT a.id_cliente, tdoc_cli, doc_cli, nom1, nom2, ape1, ape2, fnacimiento, edad, email_cli, dir_cli,
										 fijo, celular, estado_cli,nom_completo,
									 b.id_afiliacion

						FROM cliente a INNER JOIN afiliacion b on a.id_cliente=b.id_cliente

						WHERE a.doc_cli='".$_GET['doc']."' ";
						//echo $sql;
			$color="yellow";
			$boton="Cargar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$edad='<h4>?</h4>';
			$doc=$_REQUEST['doc'];
			$nc=$_REQUEST['nc'];
			$form1='vistaAfiliacion/documentos.php';
			$subtitulo='Upload de soportes para usuarios';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_cliente"=>"", "tdoc_cli"=>"", "doc_cli"=>"", "nom1"=>"", "nom2"=>"", "ape1"=>"", "ape2"=>"",
				"fnacimiento"=>"", "edad"=>"", "email_cli"=>"", "dir_cli"=>"", "fijo"=>"", "celular"=>"", "estado_cli"=>"",
				"nom_completo"=>"","id_afiliacion"=>"");
			}
		}else{
			$fila=array("id_cliente"=>"", "tdoc_cli"=>"", "doc_cli"=>"", "nom1"=>"", "nom2"=>"", "ape1"=>"", "ape2"=>"",
			"fnacimiento"=>"", "edad"=>"", "email_cli"=>"", "dir_cli"=>"", "fijo"=>"", "celular"=>"", "estado_cli"=>"",
			"nom_completo"=>"","id_afiliacion"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].salario.value == "0"){
					alert("hey!!! " <?php echo $_SESSION["AUT"]["nombre"]?> ", el salario del cliente no puede ser $0");
					document.forms[0].salario.focus();				// Ubicar el cursor
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
	<section class="panel-heading">
			<h4>Afiliaciones del cliente: </h4><h3><?php echo $_GET['nc']; ?></h3>
	</section>
	<section>
		<article class="col-xs-12">
			<a href="<?php echo PROGRAMA.'?opcion=3';?>"><button type="button" class="btn btn-success" name="button"><span class="fa fa-arrow-left"></span> Regresar a busqueda de CLIENTES</button></a>
		</article>
	</section>
	<section class="panel-body">
		<table class="table table-responsive table-bordered">

		<tr>
			<th class="text-center info"></th>
			<th class="text-center info">EMPRESA</th>
			<th class="text-center info">CONVENIO</th>
			<th class="text-center info">CLIENTE</th>
			<th class="text-center info">ASEGURADORAS</th>
			<th class="text-center info">OCUPACION</th>
			<th class="text-center info">ACCIONES</th>
		</tr>

			<?php
			if (isset($_REQUEST["doc"])){
			$doc=$_REQUEST["doc"];

			$sql1="SELECT a.id_afiliacion,fini_afiliacion, eps_afiliacion,afp_afiliacion, ccf_afiliacion, arp_afiliacion,
			 							ocupacion, clase_riesgo, estado_afiliacion,salario,
										b.id_cliente,tdoc_cli, doc_cli, nom1, nom2, ape1, ape2, fnacimiento, edad, email_cli,
										dir_cli, fijo,celular,gremio, estado_cli,nom_completo,
										c.nom_empresa,
										d.nom_convenio,eps, afp, ccf, tadm,
										e.nombre eps_ase,
										f.nombre afp_ase,
										g.nombre arp_ase,
										h.nombre ccf_ase,
										i.nom_ocupacion,nivel_arl,porcen_nivel

						FROM cliente b LEFT JOIN afiliacion a on b.id_cliente=a.id_cliente
													 INNER JOIN empresa c on c.id_empresa=a.id_empresa
													 INNER JOIN convenio d on d.id_convenio=a.id_convenio
													 LEFT JOIN aseguradora e on e.id_aseguradora=a.eps_afiliacion
													 LEFT JOIN aseguradora f on f.id_aseguradora=a.afp_afiliacion
													 LEFT JOIN aseguradora g on g.id_aseguradora=a.arp_afiliacion
													 LEFT JOIN aseguradora h on h.id_aseguradora=a.afp_afiliacion
													 LEFT JOIN ocupacion i on i.id_ocupacion=a.ocupacion
						WHERE a.estado_afiliacion=1 and b.doc_cli='$doc'";
						//echo $sql1;
			 if ($tabla=$bd1->sub_tuplas($sql1)){
          foreach ($tabla as $fila ) {
						if ($fila['estado_afiliacion']=='1') {
							echo"<tr>\n";
							echo'<td class="text-left"
										<p><a href="rpt_afiliacion.php?ida='.$fila["id_afiliacion"].'&emp='.$fila["nom_empresa"].'" target="_blank"><button type="button" class="btn btn-danger" ><span class="fa fa-file-pdf-o"></span> Certificado Afiliación</button></a></p>
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST['opcion'].'&mante=SOPORTES&doc='.$_REQUEST['doc'].'&ida='.$fila["id_afiliacion"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-file"></span> Soportes Afiliación</button></a></p>
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST['opcion'].'&mante=CLAVE&doc='.$_REQUEST['doc'].'&ida='.$fila["id_afiliacion"].'"><button type="button" class="btn btn-info" ><span class="fa fa-key"></span> Registro de Claves</button></a></p>
										<br>
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST['opcion'].'&mante=EGRESO&nc='.$_REQUEST['nc'].'&doc='.$_REQUEST['doc'].'&ida='.$fila["id_afiliacion"].'&idc='.$fila["id_cliente"].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Cancelar Afiliación</button></a></p>
									 </td>';
	        		echo'<td class="text-right"><strong>'.$fila["nom_empresa"].'</strong></td>';
	        		echo'<td class="text-center"><strong>'.$fila["nom_convenio"].'</strong></td>';
	        		echo'<td class="text-left">
										<p>'.$fila["nom_completo"].' </p>
										<p><strong>'.$fila["tdoc_cli"].':</strong> '.$fila["doc_cli"].'</p>
										<p class="text-primary"><strong>Gremio:</strong> '.$fila["gremio"].'</p>
									 </td>';
	        		echo'<td class="text-left">
										<p><strong>'.$fila["eps_ase"].'= </strong>'.$fila["eps"].' %</p>
										<p><strong>'.$fila["afp_ase"].'= </strong>'.$fila["afp"].' %</p>
										<p><strong>'.$fila["arp_ase"].'= Clase: </strong>'.$fila["nivel_arl"].' -- '.$fila["porcen_nivel"].'%</p>
										<p><strong>'.$fila["ccf_ase"].'= </strong>'.$fila["ccf"].' %</p>
										<p><strong>Tarifa Administrativa = </strong>$ '.$fila["tadm"].'</p>
									 </td>';
							echo'<td class="text-center"><strong>'.$fila["nom_ocupacion"].'</strong></td>';
							$docs=substr($fila['doc_cli'], -2);
							$f=date('d');
							$nc=$_REQUEST['nc'];
							$doc=$_REQUEST['doc'];

							if ($docs >= 00 && $docs <= 07) {
								$obligacion='Aqui se realiza pago';
								echo'<th class="text-center">
											<p><a href="'.PROGRAMA.'?opcion=5&ida='.$fila["id_afiliacion"].'&doc='.$doc.'&nc='.$nc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-money"></span> Liquidar Obligaciones</button></a></p>
											<p><span class="fa fa-check fa-4x text-success"></span></p>
											<h3>'.$obligacion.'</h3>';
											$ftope=2;
											$fmora=$f-$ftope;
											if ($fmora>0) {
												$obligacion1='Hoy <strong>'.date('Y-m-d').'</strong> el cliente <strong>'.$fila['nom_completo'].'</strong>. tiene <strong>'.$fmora.'</strong> dias de mora.';
												echo'<h5 class="alert alert-danger">'.$obligacion1.'</h5>';
											}else {
												echo'<h5 class="alert alert-info">'.$obligacion1.'</h5>';
											}
							}
							if ($docs >= '08' && $docs <= 14) {
								$obligacion='Aqui se realiza pago';
								echo'<th class="text-center">
											<p><a href="'.PROGRAMA.'?opcion=5&ida='.$fila["id_afiliacion"].'&doc='.$doc.'&nc='.$nc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-money"></span> Liquidar Obligaciones</button></a></p>
											<p><span class="fa fa-check fa-4x text-success"></span></p>
											<h3>'.$obligacion.'</h3>';
											$ftope=3;
											$fmora=$f-$ftope;
											if ($fmora>0) {
												$obligacion1='Hoy <strong>'.date('Y-m-d').'</strong> el cliente <strong>'.$fila['nom_completo'].'</strong>. tiene <strong>'.$fmora.'</strong> dias de mora.';
												echo'<h5 class="alert alert-danger">'.$obligacion1.'</h5>';
											}else {
												echo'<h5 class="alert alert-info">'.$obligacion1.'</h5>';
											}

							}

							if ($docs >= 15 && $docs <= 21) {
								$obligacion='Aqui se realiza pago';
								echo'<th class="text-center">
											<p><a href="'.PROGRAMA.'?opcion=5&ida='.$fila["id_afiliacion"].'&doc='.$doc.'&nc='.$nc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-money"></span> Liquidar Obligaciones</button></a></p>
											<p><span class="fa fa-check fa-4x text-success"></span></p>
											<h3>'.$obligacion.'</h3>';
											$ftope=4;
											$fmora=$f-$ftope;
											if ($fmora>0) {
												$obligacion1='Hoy <strong>'.date('Y-m-d').'</strong> el cliente <strong>'.$fila['nom_completo'].'</strong>. tiene <strong>'.$fmora.'</strong> dias de mora.';
												echo'<h5 class="alert alert-danger">'.$obligacion1.'</h5>';
											}else {
												echo'<h5 class="alert alert-info">'.$obligacion1.'</h5>';
											}


							}
							if ($docs >= 22 && $docs <= 28) {
								$obligacion='Aqui se realiza pago';
								echo'<th class="text-center">
											<p><a href="'.PROGRAMA.'?opcion=5&ida='.$fila["id_afiliacion"].'&doc='.$doc.'&nc='.$nc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-money"></span> Liquidar Obligaciones</button></a></p>
											<p><span class="fa fa-check fa-4x text-success"></span></p>
											<h3>'.$obligacion.'</h3>';
											$ftope=5;
											$fmora=$f-$ftope;
											if ($fmora>0) {
												$obligacion1='Hoy <strong>'.date('Y-m-d').'</strong> el cliente <strong>'.$fila['nom_completo'].'</strong>. tiene <strong>'.$fmora.'</strong> dias de mora.';
												echo'<h5 class="alert alert-danger">'.$obligacion1.'</h5>';
											}else {
												echo'<h5 class="alert alert-info">'.$obligacion1.'</h5>';
											}

							}
							if ($docs >= 29 && $docs <= 35) {
								$obligacion='Aqui se realiza pago';
								echo'<th class="text-center">
											<p><a href="'.PROGRAMA.'?opcion=5&ida='.$fila["id_afiliacion"].'&doc='.$doc.'&nc='.$nc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-money"></span> Liquidar Obligaciones</button></a></p>
											<p><span class="fa fa-check fa-4x text-success"></span></p>
											<h3>'.$obligacion.'</h3>';
											$ftope=6;
											$fmora=$f-$ftope;
											if ($fmora>0) {
												$obligacion1='Hoy <strong>'.date('Y-m-d').'</strong> el cliente <strong>'.$fila['nom_completo'].'</strong>. tiene <strong>'.$fmora.'</strong> dias de mora.';
												echo'<h5 class="alert alert-danger">'.$obligacion1.'</h5>';
											}else {
												echo'<h5 class="alert alert-info">'.$obligacion1.'</h5>';
											}

							}
							if ($docs >= 36 && $docs <= 42) {
								$obligacion='Aqui se realiza pago';
								echo'<th class="text-center">
											<p><a href="'.PROGRAMA.'?opcion=5&ida='.$fila["id_afiliacion"].'&doc='.$doc.'&nc='.$nc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-money"></span> Liquidar Obligaciones</button></a></p>
											<p><span class="fa fa-check fa-4x text-success"></span></p>
											<h3>'.$obligacion.'</h3>';
											$ftope=7;
											$fmora=$f-$ftope;
											if ($fmora>0) {
												$obligacion1='Hoy <strong>'.date('Y-m-d').'</strong> el cliente <strong>'.$fila['nom_completo'].'</strong>. tiene <strong>'.$fmora.'</strong> dias de mora.';
												echo'<h5 class="alert alert-danger">'.$obligacion1.'</h5>';
											}else {
												echo'<h5 class="alert alert-info">'.$obligacion1.'</h5>';
											}

							}
							if ($docs >= 43 && $docs <= 49) {
								$obligacion='Aqui se realiza pago';
								echo'<th class="text-center">
											<p><a href="'.PROGRAMA.'?opcion=5&ida='.$fila["id_afiliacion"].'&doc='.$doc.'&nc='.$nc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-money"></span> Liquidar Obligaciones</button></a></p>
											<p><span class="fa fa-check fa-4x text-success"></span></p>
											<h3>'.$obligacion.'</h3>';
											$ftope=8;
											$fmora=$f-$ftope;
											if ($fmora>0) {
												$obligacion1='Hoy <strong>'.date('Y-m-d').'</strong> el cliente <strong>'.$fila['nom_completo'].'</strong>. tiene <strong>'.$fmora.'</strong> dias de mora.';
												echo'<h5 class="alert alert-danger">'.$obligacion1.'</h5>';
											}else {
												echo'<h5 class="alert alert-info">'.$obligacion1.'</h5>';
											}


							}
							if ($docs >= 50 && $docs <= 56) {
								$obligacion='Aqui se realiza pago';
								echo'<th class="text-center">
											<p><a href="'.PROGRAMA.'?opcion=5&ida='.$fila["id_afiliacion"].'&doc='.$doc.'&nc='.$nc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-money"></span> Liquidar Obligaciones</button></a></p>
											<p><span class="fa fa-check fa-4x text-success"></span></p>
											<h3>'.$obligacion.'</h3>';
											$ftope=9;
											$fmora=$f-$ftope;
											if ($fmora>0) {
												$obligacion1='Hoy <strong>'.date('Y-m-d').'</strong> el cliente <strong>'.$fila['nom_completo'].'</strong>. tiene <strong>'.$fmora.'</strong> dias de mora.';
												echo'<h5 class="alert alert-danger">'.$obligacion1.'</h5>';
											}else {
												echo'<h5 class="alert alert-info">'.$obligacion1.'</h5>';
											}

							}

							if ($docs >= 57 && $docs <= 63) {
								$obligacion='Aqui se realiza pago';
								echo'<th class="text-center">
											<p><a href="'.PROGRAMA.'?opcion=5&ida='.$fila["id_afiliacion"].'&doc='.$doc.'&nc='.$nc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-money"></span> Liquidar Obligaciones</button></a></p>
											<p><span class="fa fa-check fa-4x text-success"></span></p>
											<h3>'.$obligacion.'</h3>';
											$ftope=10;
											$fmora=$f-$ftope;
											if ($fmora>0) {
												$obligacion1='Hoy <strong>'.date('Y-m-d').'</strong> el cliente <strong>'.$fila['nom_completo'].'</strong>. tiene <strong>'.$fmora.'</strong> dias de mora.';
												echo'<h5 class="alert alert-danger">'.$obligacion1.'</h5>';
											}else {
												echo'<h5 class="alert alert-info">'.$obligacion1.'</h5>';
											}


							}
							if ($docs >= 64 && $docs <= 69) {
								$obligacion='Aqui se realiza pago';
								echo'<th class="text-center">
											<p><a href="'.PROGRAMA.'?opcion=5&ida='.$fila["id_afiliacion"].'&doc='.$doc.'&nc='.$nc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-money"></span> Liquidar Obligaciones</button></a></p>
											<p><span class="fa fa-check fa-4x text-success"></span></p>
											<h3>'.$obligacion.'</h3>';
											$ftope=11;
											$fmora=$f-$ftope;
											if ($fmora>0) {
												$obligacion1='Hoy <strong>'.date('Y-m-d').'</strong> el cliente <strong>'.$fila['nom_completo'].'</strong>. tiene <strong>'.$fmora.'</strong> dias de mora.';
												echo'<h5 class="alert alert-danger">'.$obligacion1.'</h5>';
											}else {
												echo'<h5 class="alert alert-info">'.$obligacion1.'</h5>';
											}

							}
							if ($docs >= 70 && $docs <= 75) {
								$obligacion='Aqui se realiza pago';
								echo'<th class="text-center">
											<p><a href="'.PROGRAMA.'?opcion=5&ida='.$fila["id_afiliacion"].'&doc='.$doc.'&nc='.$nc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-money"></span> Liquidar Obligaciones</button></a></p>
											<p><span class="fa fa-check fa-4x text-success"></span></p>
											<h3>'.$obligacion.'</h3>';
											$ftope=12;
											$fmora=$f-$ftope;
											if ($fmora>0) {
												$obligacion1='Hoy <strong>'.date('Y-m-d').'</strong> el cliente <strong>'.$fila['nom_completo'].'</strong>. tiene <strong>'.$fmora.'</strong> dias de mora.';
												echo'<h5 class="alert alert-danger">'.$obligacion1.'</h5>';
											}else {
												echo'<h5 class="alert alert-info">'.$obligacion1.'</h5>';
											}

							}
							if ($docs >= 76 && $docs <= 81) {
								$obligacion='Aqui se realiza pago';
								echo'<th class="text-center">
											<p><a href="'.PROGRAMA.'?opcion=5&ida='.$fila["id_afiliacion"].'&doc='.$doc.'&nc='.$nc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-money"></span> Liquidar Obligaciones</button></a></p>
											<p><span class="fa fa-check fa-4x text-success"></span></p>
											<h3>'.$obligacion.'</h3>';
											$ftope=13;
											$fmora=$f-$ftope;
											if ($fmora>0) {
												$obligacion1='Hoy <strong>'.date('Y-m-d').'</strong> el cliente <strong>'.$fila['nom_completo'].'</strong>. tiene <strong>'.$fmora.'</strong> dias de mora.';
												echo'<h5 class="alert alert-danger">'.$obligacion1.'</h5>';
											}else {
												echo'<h5 class="alert alert-info">'.$obligacion1.'</h5>';
											}

							}
							if ($docs >= 82 && $docs <= 87) {
								$obligacion='Aqui se realiza pago';
								echo'<th class="text-center">
											<p><a href="'.PROGRAMA.'?opcion=5&ida='.$fila["id_afiliacion"].'&doc='.$doc.'&nc='.$nc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-money"></span> Liquidar Obligaciones</button></a></p>
											<p><span class="fa fa-check fa-4x text-success"></span></p>
											<h3>'.$obligacion.'</h3>';
											$ftope=14;
											$fmora=$f-$ftope;
											if ($fmora>0) {
												$obligacion1='Hoy <strong>'.date('Y-m-d').'</strong> el cliente <strong>'.$fila['nom_completo'].'</strong>. tiene <strong>'.$fmora.'</strong> dias de mora.';
												echo'<h5 class="alert alert-danger">'.$obligacion1.'</h5>';
											}else {
												echo'<h5 class="alert alert-info">'.$obligacion1.'</h5>';
											}

							}
							if ($docs >= 88 && $docs <= 93) {
								$obligacion='Aqui se realiza pago';
								echo'<th class="text-center">
											<p><a href="'.PROGRAMA.'?opcion=5&ida='.$fila["id_afiliacion"].'&doc='.$doc.'&nc='.$nc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-money"></span> Liquidar Obligaciones</button></a></p>
											<p><span class="fa fa-check fa-4x text-success"></span></p>
											<h3>'.$obligacion.'</h3>';
											$ftope=15;
											$fmora=$f-$ftope;
											if ($fmora>0) {
												$obligacion1='Hoy <strong>'.date('Y-m-d').'</strong> el cliente <strong>'.$fila['nom_completo'].'</strong>. tiene <strong>'.$fmora.'</strong> dias de mora.';
												echo'<h5 class="alert alert-danger">'.$obligacion1.'</h5>';
											}else {
												echo'<h5 class="alert alert-info">'.$obligacion1.'</h5>';
											}

							}
							if ($docs >= 94 && $docs <= 99) {
								$obligacion='Aqui se realiza pago';
								echo'<th class="text-center">
											<p><a href="'.PROGRAMA.'?opcion=5&ida='.$fila["id_afiliacion"].'&doc='.$doc.'&nc='.$nc.'"><button type="button" class="btn btn-primary" ><span class="fa fa-money"></span> Liquidar Obligaciones</button></a></p>
											<p><span class="fa fa-check fa-4x text-success"></span></p>
											<h3>'.$obligacion.'</h3>';
											$ftope=16;
											$fmora=$f-$ftope;
											if ($fmora>0) {
												$obligacion1='Hoy <strong>'.date('Y-m-d').'</strong> el cliente <strong>'.$fila['nom_completo'].'</strong>. tiene <strong>'.$fmora.'</strong> dias de mora.';
												echo'<h5 class="alert alert-danger">'.$obligacion1.'</h5>';
											}else {
												echo'<h5 class="alert alert-info">'.$obligacion1.'</h5>';
											}

							}
							echo'</th>';
							echo "</tr>\n";
						}
        	}
       }
			}

			?>
			<tr>
				<td colspan="7" class="text-right">
					<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&doc='.$_REQUEST['doc'].'&idc='.$_REQUEST['id'].'&nc='.$_REQUEST['nc'];?>" align="center" >
						<button type="button" class="btn btn-info btn-lg fa fa-plus-circle fa-3x" > Adicionar Nueva afiliación</button>
					</a>
				</td>
			</tr>
	</table>
</section>
	<?php
}
?>
