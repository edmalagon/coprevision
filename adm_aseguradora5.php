
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
			case 'E':
      $nc=$_POST['nom_convenio'];
			$sql="UPDATE convenio SET tipo_convenio='".$_POST['tipo_convenio']."',
      nom_convenio='".$_POST['nom_convenio']."', eps='".$_POST['eps']."', afp='".$_POST['afp']."', ccf='".$_POST['ccf']."',
      tadm='".$_POST['tadm']."'  WHERE id_convenio=".$_POST["idc"];
				$subtitulo="El convenio ".$nc;
				$sub2='ADICIONADO';
			break;
			case 'X':
				$sql="SELECT logo from cliente where id=".$_POST["idcli"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="UPDATE convenio SET estado_convenio=2 WHERE id_convenio=".$_POST["idc"];
				$subtitulo="Eliminado";
			break;
			case 'A':
			$nc=$_POST['nom_convenio'];
			$sql="INSERT INTO convenio (resp_reg,tipo_convenio, nom_convenio, eps, afp, ccf, tadm, estado_convenio)
				VALUES ('".$_SESSION['AUT']['id_user']."','".$_POST["tipo_convenio"]."','".$_POST["nom_convenio"]."',
				'".$_POST["eps"]."','".$_POST["afp"]."','".$_POST["ccf"]."','".$_POST["tadm"]."','1')";
				$subtitulo="El convenio ".$nc;
				$sub2='ADICIONADO';
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
		case 'E':
			$sql="SELECT id_convenio, resp_reg, freg, tipo_convenio, nom_convenio, eps, afp, ccf, tadm, estado_convenio

						FROM  convenio

						WHERE id_convenio='".$_GET['idc']."'";
						//echo $sql;
			$color="green";
			$boton="Actualizar Convenio";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$return=$_REQUEST['doc'];
			$form1='convenio/add_convenio.php';
			$subtitulo='Edición del Convenio';
			break;
			case 'X':
			$sql="SELECT id_convenio, resp_reg, freg, tipo_convenio, nom_convenio, eps, afp, ccf, tadm, estado_convenio

						FROM  convenio
            WHERE id_convenio='".$_GET['idc']."'";
			$color="red";
			$boton="Eliminar Convenio";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$form1='convenio/add_convenio.php';
			$subtitulo='Confirmación para eliminar convenio';
			break;
			case 'A':
			$ida=$_REQUEST['ida'];
			$sql="";
						//echo $sql;
			$color="yellow";
			$boton="Agregar Convenio";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$edad='<h4>?</h4>';
			$return=$_REQUEST['doc'];
			$return1=$_REQUEST['nc'];
			$form1='convenio/add_convenio.php';
			$subtitulo='Creación de convenio';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_convenio"=>"", "resp_reg"=>"", "freg"=>"", "tipo_convenio"=>"", "nom_convenio"=>"",
        "eps"=>"", "afp"=>"", "ccf"=>"","tadm"=>"", "estado_convenio"=>"");
			}
		}else{
      $fila=array("id_convenio"=>"", "resp_reg"=>"", "freg"=>"", "tipo_convenio"=>"", "nom_convenio"=>"",
      "eps"=>"", "afp"=>"", "ccf"=>"","tadm"=>"", "estado_convenio"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nom_convenio.value == ""){
					alert("hey!!! " <?php echo $_SESSION["AUT"]["nombre"]?> ", el nombre del convenio es obligatorio");
					document.forms[0].nom_convenio.focus();				// Ubicar el cursor
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
			<h4>Administración de convenios</h3>
	</section>

	<section class="panel-body">
		<table class="table table-responsive table-bordered">
			<tr>
				<td colspan="7" class="text-right">
					<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A';?>" align="center" >
						<button type="button" class="btn btn-info btn-lg fa fa-plus-circle fa-3x" > Adicionar Convenio </button>
					</a>
				</td>
			</tr>
		<tr>
			<th class="text-center info">ID</th>
			<th class="text-center info">ASEGURADORA</th>
      <th class="text-center info">TIPO</th>
      <th class="text-center info" colspan="2"></th>
		</tr>
			<?php
			$sql1="SELECT id_aseguradora, resp_reg, freg, tipo_aseguradora,
										cod_ministerio, nombre, nit, direccion, ciudad, telefono, estado
 						 FROM  aseguradora ";
						//echo $sql1;
			 if ($tabla=$bd1->sub_tuplas($sql1)){
          foreach ($tabla as $fila ) {
						if ($fila['estado']=='1') {
							echo"<tr>\n";
	        		echo'<td class="text-center"><strong>'.$fila["id_aseguradora"].'</strong></td>';
	        		echo'<td class="text-center">
										<p><strong class="lead"><strong>'.$fila["nombre"].'</strong></p>
									 </td>';

							echo'<td class="text-left">
									 <p><strong class="text-danger">EPS: </strong><strong>'.$fila["eps"].' %</strong></p>
									 <p><strong class="text-danger">AFP: </strong><strong>'.$fila["afp"].' %</strong></p>
									 <p><strong class="text-danger">CCF: </strong><strong>'.$fila["ccf"].' %</strong></p>
                   <p><strong class="text-danger">Tarifa Administrativa: </strong><strong>$ '.$fila["tadm"].'</strong></p>
									 </td>';
              echo'<td class="text-center">
     							<p><a href="'.PROGRAMA.'?opcion=E&idc='.$fila["id_convenio"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-edit"></span> Edición convenio</button></a></p>
                  <p><a href="'.PROGRAMA.'?opcion=X&idc='.$fila["id_convenio"].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar convenio</button></a></p>
     						 </td>';
							echo "</tr>\n";
						}
            if ($fila['estado']=='2') {
							echo"<tr>\n";
	        		echo'<td class="text-center"><strong>'.$fila["id_aseguradora"].'</strong></td>';
	        		echo'<td class="text-center">
										<p><strong class="lead"><strong>'.$fila["nombre"].'</strong></p>
									 </td>';
              $tipo=$fila['tipo_convenio'];
              if ($tipo==1) {
                echo'<td class="text-center">
       							<p><strong class="lead text-success"><strong>Dependiente</strong></p>
       						 </td>';
              }else {
                echo'<td class="text-center">
       							<p><strong class="lead text-primary"><strong>Independiente</strong></p>
       						 </td>';
              }

							echo'<td class="text-left">
									 <p><strong class="text-danger">EPS: </strong><strong>'.$fila["eps"].' %</strong></p>
									 <p><strong class="text-danger">AFP: </strong><strong>'.$fila["afp"].' %</strong></p>
									 <p><strong class="text-danger">CCF: </strong><strong>'.$fila["ccf"].' %</strong></p>
                   <p><strong class="text-danger">Tarifa Administrativa: </strong><strong>$ '.$fila["tadm"].'</strong></p>
									 </td>';
              echo'<td class="text-center">
     							<p><a href="'.PROGRAMA.'?opcion=E&idc='.$fila["id_convenio"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-edit"></span> Edición convenio</button></a></p>
     						 </td>';
							echo "</tr>\n";
						}
        	}
       }


			?>

	</table>
</section>
	<?php
}
?>
