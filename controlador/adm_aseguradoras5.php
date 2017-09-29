
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
			case 'E':
      $nc=$_POST['nombre'];
			$sql="UPDATE aseguradora SET tipo_aseguradora='".$_POST["tipo_aseguradora"]."',
			cod_ministerio='".$_POST["cod_ministerio"]."',nombre='".$_POST["nombre"]."',nit='".$_POST["nit"]."',
			direccion='".$_POST["direccion"]."',telefono='".$_POST["telefono"]."'
			WHERE id_aseguradora='".$_POST['id_aseguradora']."' ";
				$subtitulo="La aseguradora ".$nc;
				$sub2='ADICIONADO';
			break;
			case 'X':
				$sql="SELECT logo from cliente where id=".$_POST["idcli"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="UPDATE convenio SET estado='2',

				WHERE id_aseguradora='".$_POST['id_aseguradora']."' ";
				$subtitulo="La aseguradora ".$nc;
				$sub2='INACTIVADA';
			break;
			case 'A':
			$nc=$_POST['nombre'];
			$sql="INSERT INTO aseguradora (resp_reg, tipo_aseguradora, cod_ministerio, nombre,
				nit, direccion, telefono, estado)
				VALUES ('".$_SESSION['AUT']['id_user']."','".$_POST["tipo_aseguradora"]."',
				'".$_POST["cod_ministerio"]."','".$_POST["nombre"]."','".$_POST["nit"]."',
				'".$_POST["direccion"]."','".$_POST["telefono"]."','1')";
				$subtitulo="La aseguradora ".$nc;
				$sub2='ADICIONADO';
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
			$sql="SELECT id_aseguradora, resp_reg, freg, tipo_aseguradora, cod_ministerio,
									 nombre, nit, direccion, ciudad, telefono, estado

					FROM  aseguradora
					WHERE id_aseguradora='".$_GET['id']."'";
						//echo $sql;
			$color="green";
			$boton="Actualizar aseguradora";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$return=$_REQUEST['ase'];
			$form1='aseguradora/add_aseguradora.php';
			$subtitulo='Edición de aseguradora';
			break;
			case 'X':
			$sql="SELECT id_aseguradora, resp_reg, freg, tipo_aseguradora, cod_ministerio, nombre, nit, direccion, ciudad, telefono, estado

						FROM  aseguradora
            WHERE id_aseguradora='".$_GET['id']."'";
			$color="red";
			$boton="Eliminar aseguradora";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$return=$_REQUEST['ase'];
			$form1='aseguradora/add_aseguradora.php';
			$subtitulo='Confirmación para eliminar aseguradora';
			break;
			case 'A':
			$ida=$_REQUEST['ida'];
			$sql="";
						//echo $sql;
			$color="yellow";
			$boton="Agregar Aseguradora";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$edad='<h4>?</h4>';
			$return=$_REQUEST['ase'];
			$form1='aseguradora/add_aseguradora.php';
			$subtitulo='Creación de aseguradora';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_aseguradora"=>"", "resp_reg"=>"", "freg"=>"", "tipo_aseguradora"=>"",
				"cod_ministerio"=>"", "nombre"=>"", "nit"=>"", "direccion"=>"", "ciudad"=>"", "telefono"=>"", "estado"=>"");
			}
		}else{
			$fila=array("id_aseguradora"=>"", "resp_reg"=>"", "freg"=>"", "tipo_aseguradora"=>"",
"cod_ministerio"=>"", "nombre"=>"", "nit"=>"", "direccion"=>"", "ciudad"=>"", "telefono"=>"", "estado"=>"");
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
			<h4>Administración de aseguradoras</h3>
	</section>
	<section class="panel-body">
		<form class="navbar-form navbar-center" role="search">
			<section class="form-group col-xs-5">
				<article class="col-xs-6">
					<input type="text" class="form-control" name="ase" placeholder="Digite nombre de aseguradora">
				</article>
			</section>
			<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
			<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		</form>
	</section>

		<table class="table table-responsive table-bordered">
			<tr>
				<td colspan="7" class="text-right">
					<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A';?>" align="center" >
						<button type="button" class="btn btn-info btn-lg fa fa-plus-circle fa-3x" > Adicionar Aseguradora </button>
					</a>
				</td>
			</tr>
		<tr>
			<th class="text-center info">ID</th>
			<th class="text-center info">ASEGURADORA</th>
      <th class="text-center info">TIPO</th>
			<th class="text-center info">DETALLES</th>
      <th class="text-center info" colspan="2"></th>
		</tr>
			<?php
			$ase=$_REQUEST['ase'];
			$sql1="SELECT id_aseguradora, resp_reg, freg, tipo_aseguradora,
										cod_ministerio, nombre, nit, direccion, ciudad, telefono, estado
 						 FROM  aseguradora  WHERE nombre LIKE '%$ase%'";
						//echo $sql1;
			 if ($tabla=$bd1->sub_tuplas($sql1)){
          foreach ($tabla as $fila ) {
						$ase=$_REQUEST['ase'];
						if (isset($ase)) {
						if ($fila['estado']=='1') {
							echo"<tr>\n";
	        		echo'<td class="text-center success"><strong>'.$fila["id_aseguradora"].'</strong></td>';
	        		echo'<td class="text-center success">
										<p><strong class="lead"><strong>'.$fila["nombre"].'</strong></p>
									 </td>';
							echo'<td class="text-center success">
		 								<p><strong class="lead"><strong>'.$fila["tipo_aseguradora"].'</strong></p>
		 								</td>';
							echo'<td class="text-left success">
									 <p><strong class="text-danger">CODIGO: </strong> '.$fila["cod_ministerio"].'</p>
									 <p><strong class="text-danger">NIT: </strong> '.$fila["nit"].'</p>
									 <p><strong class="text-danger">Dirección: </strong> '.$fila["direccion"].'</p>
									 </td>';
              echo'<td class="text-center success">
     							<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST['opcion'].'&mante=E&id='.$fila["id_aseguradora"].'&ase='.$fila["nombre"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-edit"></span> Edición<br>Aseguradora</button></a></p>
                  <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST['opcion'].'&mante=X&id='.$fila["id_aseguradora"].'&ase='.$fila["nombre"].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar<br>Aseguradora</button></a></p>
     						 </td>';
							echo "</tr>\n";
						}
            if ($fila['estado']=='2') {
							echo"<tr>\n";
	        		echo'<td class="text-center danger"><strong>'.$fila["id_aseguradora"].'</strong></td>';
	        		echo'<td class="text-center danger">
										<p><strong class="lead"><strong>'.$fila["nombre"].'</strong></p>
									 </td>';
							echo'<td class="text-center danger">
		 								<p><strong class="lead"><strong>'.$fila["tipo_aseguradora"].'</strong></p>
		 								</td>';
							echo'<td class="text-left danger">
									 <p><strong class="text-danger">CODIGO: </strong> '.$fila["cod_ministerio"].'</p>
									 <p><strong class="text-danger">NIT: </strong> '.$fila["nit"].'</p>
									 <p><strong class="text-danger">Dirección: </strong> '.$fila["direccion"].'</p>
									 </td>';
              echo'<td class="text-center danger">
     							<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST['opcion'].'&mante=E&id='.$fila["id_aseguradora"].'&ase='.$fila["nombre"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-edit"></span> Edición<br>Aseguradora</button></a></p>
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
