<form action="<?php echo PROGRAMA.'?ase='.$return.'&buscar=Consultar&opcion=8';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
    <section class="panel-heading">
      <h3><strong><?php echo $subtitulo ?> </strong></h3>
    </section>
    <section class="panel-body col-xs-9">
			<section class="panel-body col-xs-12">
				<article class="col-xs-4">
	        <label for="">Nombre ocupacion:</label>
	        <input type="text" class="form-control" name="nom_ocupacion" value="<?php echo $fila['nombre'];?>" <?php echo $atributo2;?>>
					<input type="hidden" class="form-control" name="id_ocupacion" value="<?php echo $fila['id_ocupacion'];?>" <?php echo $atributo1;?>>
	        </select>
	      </article>
				<article class="col-xs-4">
	        <label for="">Nivel de ARL:</label>
	        <select class="form-control" name="nivel_arl" required="">
	        	<option value=""></option>
						<option value="I">I</option>
						<option value="II">II</option>
						<option value="III">III</option>
						<option value="IV">IV</option>
						<option value="V">V</option>
	        </select>
	      </article>
				<article class="col-xs-4">
	        <label for="">Porcentaje ARL:</label>
	        <input type="text" class="form-control" name="porcen_nivel" value="<?php echo $fila['nombre'];?>" <?php echo $atributo2;?>>
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
