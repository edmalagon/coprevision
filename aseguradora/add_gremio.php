<form action="<?php echo PROGRAMA.'?ase='.$return.'&buscar=Consultar&opcion=2';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
    <section class="panel-heading">
      <h3><strong><?php echo $subtitulo ?> </strong></h3>
    </section>
    <section class="panel-body col-xs-9">
			<section class="panel-body col-xs-12">
				<article class="col-xs-4">
	        <label for="">Nombre Gremio:</label>
	        <input type="text" class="form-control" name="nombre" value="<?php echo $fila['nombre'];?>" <?php echo $atributo2;?>>
					<input type="hidden" class="form-control" name="id_gremio" value="<?php echo $fila['id_gremio'];?>" <?php echo $atributo1;?>>
	        </select>
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
