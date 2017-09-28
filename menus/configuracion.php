<?php
defined("CLAVE5") or die ("Acceso No Autorizado");

$bd1=new subase();
$sql="SELECT m.id_menu,titulo,grupo from aux_perfiles_menus a LEFT JOIN menu m ON a.id_menu=m.id_menu where a.id_perfil=".$_SESSION["AUT"]["perfil"]." and m.grupo='Configuracion'";
//echo $sql;
if ($tabla=$bd1->sub_tuplas($sql))
{
	foreach ($tabla as $fila)
	{
		echo '<a  href="'.PROGRAMA.'?opcion='.$fila["id_menu"].'"><span class="fa fa-gear"></span> '.$fila["titulo"].'</a></br>';
	}
}else
{
	echo'<p class="alert alert-danger">Lo siento <strong>'.$_SESSION["AUT"]["nombre"].'</strong> ,pero no tiene permisos en este menú </p>';
}

?>
