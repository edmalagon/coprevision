
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
			case 'E':

				$subtitulo="Actualizado";
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
			$nc=$_POST['nc'];
			$mes=$_POST['mes_pago'];

			$empresa=$_POST['empresa'];
			$dmora=$_POST['dias_mora'];
			$pmora=$_POST['porcen_mora'];
			$tmora=$dmora*$pmora;


			if ($empresa=='PREVISOCIAL') {
				$salario=$tmora+$_POST['t_servicio'];
				$sql="INSERT INTO obligacion (id_afiliacion, freg, resp_reg, mes_pago, t_eps, t_afp, t_arp, t_ccf,
																			t_servicio, estado_obligacion,dias_mora,porcen_mora)
				VALUES ('".$_POST["ida"]."','".$f."','".$_SESSION['AUT']['id_user']."','".$_POST["mes_pago"]."',
								'".$_POST["t_eps"]."','".$_POST["t_afp"]."','".$_POST["t_arp"]."','".$_POST["t_ccf"]."',
								'".$salario."','1','".$_POST["mora"]."','".$_POST["porcenmora"]."')";
			$subtitulo="La obligación del cliente ".$nc." para el mes de ".$mes;
			$sub2='ADICIONADA';
			}
			if ($empresa=='PREVISION') {
				$dsalario=$_POST['dias_laborados'];
				$dsalariodia=$_POST['salario']/30;
				$s=$dsalario*$dsalariodia;
				$eps=floor($s*$_POST['t_eps'])/100;
				$afp=floor($s*$_POST['t_afp'])/100;
				$ccf=floor($s*$_POST['t_ccf'])/100;
				$arl=floor($s*$_POST['t_arp'])/100;
				$tadm=$_POST['tadm'];
				$total=floor($eps+$afp+$ccf+$arl+$tadm+$tmora);

				$sql="INSERT INTO obligacion (id_afiliacion, freg, resp_reg, mes_pago, t_eps, t_afp, t_arp, t_ccf,
																			t_servicio, estado_obligacion)
				VALUES ('".$_POST["ida"]."','".$f."','".$_SESSION['AUT']['id_user']."','".$_POST["mes_pago"]."',
								'".$eps."','".$afp."','".$arl."','".$ccf."',
								'".$total."','1')";
			$subtitulo="La obligación del cliente ".$nc." para el mes de ".$mes;
			$sub2='ADICIONADA';
			}

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
			$sql="SELECT a.id_cliente, tdoc_cli, doc_cli, nom1, nom2, ape1, ape2, fnacimiento, edad, email_cli, dir_cli,
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
			$sql="";
			$color="red";
			$boton="Eliminar";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$subtitulo='Confirmación para eliminar de datos del Vehículo';
			break;
			case 'A':
			$ida=$_REQUEST['ida'];
			$sql="SELECT a.id_afiliacion,fini_afiliacion, eps_afiliacion,
										afp_afiliacion, ccf_afiliacion, arp_afiliacion, ocupacion, clase_riesgo, estado_afiliacion,salario,
										b.tdoc_cli, doc_cli, nom1, nom2, ape1, ape2, fnacimiento, edad, email_cli, dir_cli, fijo,
										celular, estado_cli,nom_completo,
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
						WHERE a.estado_afiliacion=1 and a.id_afiliacion=".$ida;
						//echo $sql;
			$color="yellow";
			$boton="Agregar Obligación";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$edad='<h4>?</h4>';
			$return=$_REQUEST['doc'];
			$return1=$_REQUEST['nc'];
			$form1='vistaAfiliacion/add_obligacion.php';
			$subtitulo='';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_cliente"=>"","id_afiliacion"=>"","fini_afiliacion"=>"", "eps_afiliacion"=>"",
											"afp_afiliacion"=>"", "ccf_afiliacion"=>"", "arp_afiliacion"=>"", "ocupacion"=>"",
											"clase_riesgo"=>"", "estado_afiliacion"=>"","salario"=>"","tdoc_cli"=>"", "doc_cli"=>"",
											"nom1"=>"", "nom2"=>"", "ape1"=>"", "ape2"=>"", "fnacimiento"=>"", "edad"=>"", "email_cli"=>"",
											 "dir_cli"=>"", "fijo"=>"","celular"=>"", "estado_cli"=>"","nom_completo"=>"","nom_empresa"=>"",
											"nom_convenio"=>"","eps"=>"", "afp"=>"", "ccf"=>"", "tadm"=>"","nombre eps_ase"=>"","nombre afp_ase"=>"",
											"nombre arp_ase"=>"","nombre ccf_ase"=>"","nom_ocupacion"=>"","nivel_arl"=>"","porcen_nivel"=>"");
			}
		}else{
			$fila=array("id_cliente"=>"","id_afiliacion"=>"","fini_afiliacion"=>"", "eps_afiliacion"=>"",
										"afp_afiliacion"=>"", "ccf_afiliacion"=>"", "arp_afiliacion"=>"", "ocupacion"=>"",
										"clase_riesgo"=>"", "estado_afiliacion"=>"","salario"=>"","tdoc_cli"=>"", "doc_cli"=>"",
										"nom1"=>"", "nom2"=>"", "ape1"=>"", "ape2"=>"", "fnacimiento"=>"", "edad"=>"", "email_cli"=>"",
										 "dir_cli"=>"", "fijo"=>"","celular"=>"", "estado_cli"=>"","nom_completo"=>"","nom_empresa"=>"",
										"nom_convenio"=>"","eps"=>"", "afp"=>"", "ccf"=>"", "tadm"=>"","nombre eps_ase"=>"","nombre afp_ase"=>"",
										"nombre arp_ase"=>"","nombre ccf_ase"=>"","nom_ocupacion"=>"","nivel_arl"=>"","porcen_nivel"=>"");
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
			<h4>Obligaciones de pago del cliente: </h4><h3><?php echo $_GET['nc']; ?></h3>
	</section>
	<section>
		<article class="col-xs-12">
			<a href="<?php echo PROGRAMA.'?opcion=3';?>"><button type="button" class="btn btn-success" name="button"><span class="fa fa-arrow-left"></span> Regresar a busqueda de CLIENTES</button></a>
		</article>
	</section>
	<section class="panel-body">
		<table class="table table-responsive table-bordered">
			<tr>
				<td colspan="7" class="text-right">
					<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&doc='.$_REQUEST['doc'].'&ida='.$_REQUEST['ida'].'&nc='.$_REQUEST['nc'];?>" align="center" >
						<button type="button" class="btn btn-info btn-lg fa fa-plus-circle fa-3x" > Adicionar Obligación del mes </button>
					</a>
				</td>
			</tr>
		<tr>
			<th class="text-center info"></th>
			<th class="text-center info">MES DE PAGO</th>
			<th colspan="2" class="text-center info">TARIFAS</th>
		</tr>
			<?php
			if (isset($_REQUEST["ida"])){
			$doc=$_REQUEST["ida"];

			$sql1="SELECT a.id_afiliacion,id_empresa,fini_afiliacion, eps_afiliacion,
										afp_afiliacion, ccf_afiliacion, arp_afiliacion, ocupacion, clase_riesgo, estado_afiliacion,salario,
										b.id_obligacion,mes_pago,t_eps,t_afp,t_arp,t_ccf,t_servicio,estado_obligacion

						FROM  afiliacion a LEFT JOIN obligacion b on b.id_afiliacion=a.id_afiliacion

						WHERE  a.id_afiliacion=$doc";
						//echo $sql1;
			 if ($tabla=$bd1->sub_tuplas($sql1)){
          foreach ($tabla as $fila ) {
						if ($fila['estado_afiliacion']=='1') {
							echo"<tr>\n";
							echo'<td class="text-left"
										<p><a href="rpt_recibo.php?ido='.$fila["id_obligacion"].'&empresa='.$fila["id_empresa"].'" target="_blank"><button type="button" class="btn btn-danger" ><span class="fa fa-print"></span> Recibo Pago</button></a></p>
									 </td>';
	        		echo'<td class="text-right"> <strong>'.$fila["mes_pago"].'</strong></td>';
	        		echo'<td class="text-left">
										<p><strong class="text-danger">Pago EPS: </strong><strong>$ '.$fila["t_eps"].'</strong></p>
										<p><strong class="text-danger">Pago AFP: </strong><strong>$ '.$fila["t_afp"].'</strong></p>
									 </td>';
							echo'<td class="text-left">
									 <p><strong class="text-danger">Pago ARP: </strong><strong>$ '.$fila["t_arp"].'</strong></p>
									 <p><strong class="text-danger">Pago CCF: </strong><strong>$ '.$fila["t_ccf"].'</strong></p>
									 <p><strong class="text-danger">Total: </strong><strong>$ '.$fila["t_servicio"].'</strong></p>
									 </td>';
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
