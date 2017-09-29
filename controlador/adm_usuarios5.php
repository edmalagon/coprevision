<h1 class="fuente_titulo text-center">Administración de Usuarios</h1> <?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["foto"])){
				if (is_uploaded_file($_FILES["foto"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["foto"]["name"]);
					$archivo=$_POST["cuenta"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["foto"]["tmp_name"],WEB.FOTOS.$archivo)){
						$fotoE=",foto='".FOTOS.$archivo."'";
						$fotoA1=",foto";
						$fotoA2=",'".FOTOS.$archivo."'";
						}
				}
			}
			$firmaE="";$firmaA1="";$firmaA2="";
			if (isset($_FILES["firma"])){
				if (is_uploaded_file($_FILES["firma"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["firma"]["name"]);
					$archivo=$_POST["cuenta"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["firma"]["tmp_name"],FIR.FIRMAS.$archivo)){
						$firmaE=",firma='".FIRMAS.$archivo."'";
						$firmaA1=",firma";
						$firmaA2=",'".FIRMAS.$archivo."'";
						}
				}
			}
			$claveE="";$claveA1="";$claveA2="";
			if ($_POST["clave1"]==$_POST["clave2"]){
				if ($_POST["clave1"]!=""){
					$claveE=",clave='".$_POST["clave1"]."'";
					$claveA1=",clave";
					$claveA2=",clave='".$_POST["clave1"]."'";
				}
			}
			switch ($_POST["operacion"]) {
			case 'E':
				$sql="UPDATE user SET nombre='".$_POST["nombre"]."',cuenta='".$_POST["cuenta"]."',
				id_perfil='".$_POST["id_perfil"]."',estado='".$_POST["estado"]."'$fotoE$claveE$firmaE
				WHERE id_user=".$_POST["idu"];
				$subtitulo="Actualizado";
			break;
			case 'X':
				$sql="SELECT foto from user where id_user=".$_POST["idu"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("foto"=> "");
				}
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("firma"=> "");
				}
				$sql="DELETE FROM user WHERE id_user=".$_POST["idu"];
				$subtitulo="Eliminado";
			break;
			case 'A':
				$sql="INSERT INTO user (nombre,cuenta,email,tdoc,doc,dir_user,tel_user,estado,id_perfil$fotoA1$claveA1) VALUES
				('".$_POST["nombre"]."','".$_POST["cuenta"]."','".$_POST["email"]."','".$_POST["tdoc"]."',
				'".$_POST["doc"]."','".$_POST["dir_user"]."','".$_POST["tel_user"]."','".$_POST["estado"]."'
				,'".$_POST["id_perfil"]."'$fotoA2$claveA2)";

				$subtitulo="Adicionado";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro fue $subtitulo con exito!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["foto"])){
				unlink($fila["foto"]);
			}
			}
		}else{
			$subtitulo="El registro NO fue $subtitulo !!! .";
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'E':
			$sql="SELECT id_user,nombre,cuenta,tdoc,doc,dir_user,tel_user,email,foto,estado,
			id_perfil FROM  user where id_user=".$_GET["idu"];
			//echo $sql;
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de datos del Usuario';
			break;
			case 'X':
			$sql="SELECT id_user,nombre,cuenta,tdoc,doc,dir_user,tel_user,email,foto,estado,
			id_perfil FROM  user where id_user=".$_GET["idu"];
			$color="red";
			$boton="Eliminar";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$subtitulo='Confirmación para eliminar de datos del Usuario';
			break;
			case 'A':
			$sql="";
			$color="yellow";
			$boton="Crear";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Creación de Usuario';
			break;
		}
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_user"=>"","nombre"=>"","cuenta"=>"","foto"=>"","email"=>"",
				"tdoc"=>"","doc"=>"","estado"=>"","id_perfil"=>"");
			}
		}else{
				$fila=array("id_user"=>"","nombre"=>"","cuenta"=>"","foto"=>"","email"=>"",
				"tdoc"=>"","doc"=>"","estado"=>"","id_perfil"=>"");
			}

		?>
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
<form action="<?php echo PROGRAMA.'?&opcion=1';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()">
  <section class="panel panel-default">
  		<marquee class="fuente1">
			<?php echo $subtitulo;?>
		</marquee>
	<section class="panel panel-body text-center">
		<article class="col-xs-1">
			<label class="text-center">ID:</label><br>
			<input type="text" class="form-control text-center" name="idu" value="<?php echo $fila["id_user"];?>" <?php echo $atributo1;?>/>
		</article>
		<article class="col-xs-5">
			<label class="text-center">Nombre:</label><br>
			<input type="text" class="form-control text-center" name="nombre" value="<?php echo $fila["nombre"];?>"<?php echo $atributo2;?>/>
		</article>
		<article class="col-xs-3">
			<label class="text-center">Cuenta:</label><br>
			<input type="text" class="form-control text-center" name="cuenta" value="<?php echo $fila["cuenta"];?>"<?php echo $atributo2;?>/>
		</article>
		<article class="col-xs-3">
			<label class="text-center">Tipo Documento:</label><br>
			<select name="tdoc" class="form-control" <?php echo atributo3; ?>>
				<option value="<?php echo $fila["tdoc"];?>"><?php echo $fila["tdoc"];?></option>
				<?php
				$sql="SELECT tipo,descri_tipo from tdocumentos ORDER BY descri_tipo ASC";
				if($tabla=$bd1->sub_tuplas($sql)){
					foreach ($tabla as $fila2) {
						if ($fila["tipo"]==$fila2["tipo"]){
							$sw=' selected="selected"';
						}else{
							$sw="";
						}
					echo '<option value="'.$fila2["tipo"].'"'.$sw.'>'.$fila2["descri_tipo"].'</option>';
					}
				}
				?>
			</select>
		</article>
		<article class="col-xs-2">
			<label class="text-center">Documento:</label><br>
			<input type="text" class="form-control text-center" name="doc" value="<?php echo $fila["doc"];?>"<?php echo $atributo2;?>/>
		</article>
		<article class="col-xs-4">
			<label class="text-center">Dirección:</label><br>
			<input type="text" class="form-control text-center" name="dir_user" value="<?php echo $fila["dir_user"];?>"<?php echo $atributo2;?>/>
		</article>
		<article class="col-xs-3">
			<label class="text-center">Teléfono:</label><br>
			<input type="text" class="form-control text-center" name="tel_user" value="<?php echo $fila["tel_user"];?>"<?php echo $atributo2;?>/>
		</article>
		<article class="col-xs-5">
			<label>Foto:</label>
			Archivo: <?php echo $fila["foto"];?><br>
			<img src="<?php echo $fila["foto"];?>" alt="" class="image_inicio_login"/>
			<input type="file" class="form-control" name="foto" <?php echo $atributo3; ?>/>
		</article>
		<article class="col-xs-5">
			<label for="">Email:</label>
			<input type="email" name="email" class="form-control" value="<?php echo $fila["email"];?>"<?php echo $atributo2;?>/>
		</article>
		<article class="col-xs-3">
			<label>Clave:</label><br>
			<input type="password" class="form-control" name="clave1" value=""<?php echo $atributo2;?>/>
		</article>
		<article class="col-xs-3">
			<label>Confirmar Clave:</label><br>
			<input type="password" class="form-control" name="clave2" value=""<?php echo $atributo2;?>/>
		</article >
		<article class="col-xs-3">
			<label>Perfil:</label><br>
			<select name="id_perfil" class="form-control" <?php echo atributo3; ?>>
				<?php
				$sql="SELECT id_perfil,nombre_perfil from perfil ORDER BY nombre_perfil ASC";
				if($tabla=$bd1->sub_tuplas($sql)){
					foreach ($tabla as $fila2) {
						if ($fila["id_perfil"]==$fila2["id_perfil"]){
							$sw=' selected="selected"';
						}else{
							$sw="";
						}
					echo '<option value="'.$fila2["id_perfil"].'"'.$sw.'>'.$fila2["nombre_perfil"].'</option>';
					}
				}

				?>
			</select>
		</article>
		<article class="col-xs-3">
			<label>Estado:</label><br>
			<select name="estado" class="form-control" <?php echo atributo3; ?>>
				<option value="Activo" selected="selected" class="form-control">Activo</option>
				<option value="Inactivo" >Inactivo</option>
			</select>
		</article>
	</section>
		<div class="text-center panel panel-body">
			<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="reset" class="btn btn-primary" Value="Reestablecer"/>
			<input type="submit" class="btn btn-primary" name="aceptar" Value="Descartar"/>
			<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>

	</section>
</form>

<?php
}else{
	echo '<div class="alert alert-success animated bounceInRight">';
	echo $subtitulo;
	echo '</div>';
// nivel 1?>
<div class="panel panel-default">
<div class="panel-body">
	<section class="panel panel-default" class="col-xs-7">
		<form class="navbar-form navbar-center" role="search">
					<section class="form-group col-xs-3">
							<input type="text" class="form-control" name="placa" placeholder="Digite Identificación">
					</section>
					<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
					<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
				</form>
				<form class="navbar-form navbar-center" role="search">
							<section class="form-group col-xs-3">
									<input type="text" class="form-control" name="nom" placeholder="Digite Nombre paciente">
							</section>
							<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
							<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
				</form>
	</section>
<table class="table table-responsive">
	<tr>
		<th colspan="2" id="th-estilo1"></th>
		<th id="th-estilo2">ID</th>
		<th id="th-estilo2">NOMBRE</th>
		<th id="th-estilo2">CUENTA</th>
		<th id="th-estilo2">PERFIL</th>
		<th id="th-estilo2">ESTADO</th>
		<th id="th-estilo2">FOTO</th>
	</tr>

	<?php
	if (isset($_REQUEST["placa"])){
	$doc=$_REQUEST["placa"];
	$sql="SELECT id_user,nombre,cuenta,foto,estado,nombre_perfil FROM user u LEFT JOIN perfil p ON u.id_perfil=p.id_perfil where doc='".$doc."'";
if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {
		echo"<tr>\n";
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idu='.$fila["id_user"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-pencil"></span></button></a></th>';
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=X&idu='.$fila["id_user"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-trash"></span></button></a></th>';
		echo'<td class="text-center">'.$fila["id_user"].'</td>';
		echo'<td class="text-center">'.$fila["nombre"].'</td>';
		echo'<td class="text-center">'.$fila["cuenta"].'</td>';
		echo'<td class="text-center">'.$fila["nombre_perfil"].'</td>';
		echo'<td class="text-center">'.$fila["estado"].'</td>';
		echo'<td class="text-center"><img src="'.$fila["foto"].'"alt ="foto" class="image_login" > </td>';
		echo "</tr>\n";

		}
	}
}
if (isset($_REQUEST["nom"])){
$nom=$_REQUEST["nom"];
$sql="SELECT id_user,nombre,cuenta,foto,estado,nombre_perfil
			FROM user u LEFT JOIN perfil p ON u.id_perfil=p.id_perfil
			WHERE nombre like '%".$nom."%'";

if ($tabla=$bd1->sub_tuplas($sql)){
foreach ($tabla as $fila ) {
	echo"<tr>\n";
	echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idu='.$fila["id_user"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-pencil"></span></button></a></th>';
	echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=X&idu='.$fila["id_user"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-trash"></span></button></a></th>';
	echo'<td class="text-center">'.$fila["id_user"].'</td>';
	echo'<td class="text-center">'.$fila["nombre"].'</td>';
	echo'<td class="text-center">'.$fila["cuenta"].'</td>';
	echo'<td class="text-center">'.$fila["nombre_perfil"].'</td>';
	echo'<td class="text-center">'.$fila["estado"].'</td>';
	echo'<td class="text-center"><img src="'.$fila["foto"].'"alt ="foto" class="image_login" > </td>';
	echo "</tr>\n";

	}
}
}
	?>
	<tr>
		<th colspan="8" class="text-center"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A'?>" align="center" ><button type="button" class="btn btn-primary" >Adicionar</button>

		</a></th>
	</tr>
</table>
</div>
</div>
	<?php
}
?>
