
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
			case 'E':
      $nc=$_POST['nombre'];
			$sql="UPDATE ocupacion SET nom_ocupacion='".$_POST["nom_ocupacion"]."',nivel_arl='".$_POST["nivel_arl"]."',
			porcen_nivel='".$_POST["porcen_nivel"]."'
			where id_ocupacion='".$_POST["id_ocupacion"]."'";
				$subtitulo="La ocupacion ".$nc;
				$sub2='ADICIONADO';
			break;
			case 'X':
				$sql="SELECT logo from cliente where id=".$_POST["idcli"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="UPDATE ocupacion SET estado='2',

				WHERE id_ocupacion='".$_POST['id_ocupacion']."' ";
				$subtitulo="La ocupacion ".$nc;
				$sub2='INACTIVADA';
			break;
			case 'A':
			$nc=$_POST['nombre'];
			$sql="INSERT INTO ocupacion (nom_ocupacion,nivel_arl,porcen_nivel)
				VALUES ('".$_POST["nom_ocupacion"]."','".$_POST["nivel_arl"]."','".$_POST["porcen_nivel"]."')";
				$subtitulo="La ocupacion ".$nc;
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
		$sql="SELECT id_ocupacion,nom_ocupacion,nivel_arl,porcen_nivel
					FROM  ocupacion
					WHERE id_ocupacion='".$_GET['id']."'";
						//echo $sql;
			$color="green";
			$boton="Actualizar ocupacion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$return=$_REQUEST['ase'];
			$form1='aseguradora/add_ocupacion.php';
			$subtitulo='Edición de ocupacion';
			break;
			case 'X':
			$sql="SELECT id_ocupacion,nom_ocupacion,nivel_arl,porcen_nivel
						FROM  ocupacion
            WHERE id_ocupacion='".$_GET['id']."'";
			$color="red";
			$boton="Eliminar ocupacion";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$return=$_REQUEST['ase'];
			$form1='aseguradora/add_ocupacion.php';
			$subtitulo='Confirmación para eliminar ocupacion';
			break;
			case 'A':
			$ida=$_REQUEST['ida'];
			$sql="";
						//echo $sql;
			$color="yellow";
			$boton="Agregar Ocupacion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$edad='<h4>?</h4>';
			$return=$_REQUEST['ase'];
			$form1='aseguradora/add_ocupacion.php';
			$subtitulo='Creación de Ocupacion';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_ocupacion"=>"", "nom_ocupacion"=>"", "nivel_arl"=>"", "porcen_nivel"=>"");
			}
		}else{
			$fila=array("id_ocupacion"=>"", "nom_ocupacion"=>"", "nivel_arl"=>"", "porcen_nivel"=>"");
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
			<h4>Administración de ocupaciones</h3>
	</section>
	<section class="panel-body">
		<form class="navbar-form navbar-center" role="search">
			<section class="form-group col-xs-5">
				<article class="col-xs-6">
					<input type="text" class="form-control" name="ase" placeholder="Digite nombre de gremio">
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
						<button type="button" class="btn btn-info btn-lg fa fa-plus-circle fa-3x" > Adicionar Ocupacion </button>
					</a>
				</td>
			</tr>
		<tr>
			<th class="text-center info">ID</th>
			<th class="text-center info">OCUPACION</th>
			<th class="text-center info">DATOS ARL</th>
			<th class="text-center info" colspan="2"></th>
		</tr>
			<?php
			$ase=$_REQUEST['ase'];
			$sql1="SELECT id_ocupacion,nom_ocupacion,nivel_arl,porcen_nivel
 						 FROM  ocupacion  WHERE nom_ocupacion LIKE '%$ase%'";
						//echo $sql1;
			 if ($tabla=$bd1->sub_tuplas($sql1)){
          foreach ($tabla as $fila ) {
							echo"<tr>\n";
	        		echo'<td class="text-center success"><strong>'.$fila["id_ocupacion"].'</strong></td>';
	        		echo'<td class="text-center success">
										<p><strong class="lead"><strong>'.$fila["nom_ocupacion"].'</strong></p>
									 </td>';
							echo'<td class="text-center success"><strong>
										<p>'.$fila["nivel_arl"].'</strong></p>
		 								<p><strong><strong>'.$fila["porcen_nivel"].'</strong></p>
		 							 </td>';
							echo'<td class="text-center success">
     							<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST['opcion'].'&mante=E&id='.$fila["id_aseguradora"].'&ase='.$fila["nombre"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-edit"></span> Edición<br>Aseguradora</button></a></p>
                  <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST['opcion'].'&mante=X&id='.$fila["id_aseguradora"].'&ase='.$fila["nombre"].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar<br>Aseguradora</button></a></p>
     						 </td>';
							echo "</tr>\n";
       }
		 }
			?>
	</table>
</section>
	<?php
}
?>
