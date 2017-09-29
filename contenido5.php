<?php
defined("CLAVE5") or die ("Acceso No Autorizado");
echo $error1;

if (isset($_REQUEST["opcion"])){
	//$sql="SELECT modulo from menus where id=".$_GET["opcion"];

	$sql="SELECT modulo from aux_perfiles_menus a LEFT JOIN menu m ON a.id_menu=m.id_menu where a.id_perfil=".$_SESSION["AUT"]["perfil"]." AND a.id_menu=".$_REQUEST["opcion"];


	if ($fila=$bd1->sub_fila($sql)){
		include ($fila["modulo"].VERSION.".php");
	}else{
		?>
		<img src="images/perrobravo.jpg" width="100%" alt="pitbull" />
		<?php
	}
}else{
	?>

	<?php
}
?>
