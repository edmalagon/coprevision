<form action="<?php echo PROGRAMA.'?opcion=4&doc='.$return.'$nc='.$return1;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
    <section class="panel-heading">
      <h3><strong> <?php echo $subtitulo.': '.$fila['nom1'].' '.$fila['nom2'].' '.$fila['ape1'].' '.$fila['ape2'] ;?></strong></h3>
    </section>
    <section class="panel-body text-center col-xs-9">
    	<article class="col-xs-2">
    		<label for="">Afiliacion</label>
				<input type="text" class="form-control" name="id_afiliacion" value="<?php echo $fila['id_afiliacion'] ?>" <?php echo $atributo1 ?>>
    	</article>
			<article class="col-xs-4">
    		<label for="">Usuario:</label>
				<input type="text" class="form-control" name="usuario" value="">
    	</article>
			<article class="col-xs-4">
    		<label for="">Contraseña:</label>
				<input type="text" class="form-control" name="clave" value="">
    	</article>
    </section>
    </section>
  	<section class="panel-body text-right col-xs-3">
			<div class="">
				<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
			</div>
			<br>
  	  <div class="">
  	  	<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="Descartar"/>
  	  </div>
  		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
  		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
  	</section>
  </section>
</form>
