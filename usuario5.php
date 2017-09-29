<?php
defined("CLAVE5") or die ("Acceso No Autorizado");
?>
<link rel="stylesheet" href="css/bootstrap.css">
	<section>
		<article class="col-xs-2">
			<figure>
				<img src="<?php echo $_SESSION["AUT"]["foto"]; ?>"  class="image_login" alt="foto" >
			</figure>
		</article>
		<article class="col-xs-10">
			<p class="text-center"><strong><?php echo $_SESSION["AUT"]["nombre"]; ?></strong></p>
			<p class="text-center"><strong><?php echo $_SESSION["AUT"]["nombre_perfil"]; ?></strong></p>
			<p class="text-center" hidden=""><strong><?php echo $_SESSION["AUT"]["perfil"]; ?></strong></p>
		</article>

	</section>
