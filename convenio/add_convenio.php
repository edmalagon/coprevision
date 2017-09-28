<form action="<?php echo PROGRAMA.'?opcion=6';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
    <section class="panel-heading">
      <h3><strong><?php echo $subtitulo ?> </strong></h3>
    </section>
    <section class="panel-body col-xs-9">
			<section class="panel-body col-xs-12">
				<article class="col-xs-4">
	        <label for="">Nombre Convenio:</label>
	        <input type="text" class="form-control" name="nom_convenio" value="<?php echo $fila['nom_convenio'];?>" <?php echo $atributo2;?>>
					<input type="hidden" class="form-control" name="id_convenio" value="<?php echo $fila['id_convenio'];?>" <?php echo $atributo1;?>>
	        </select>
	      </article>
				<article class="col-xs-2">
	        <label for="">EPS:</label>
	        <input type="text" class="form-control" name="eps"  required="" value="<?php echo $fila['eps'];?>" <?php echo $atributo2;?>>
	      </article>
        <article class="col-xs-2">
	        <label for="">AFP:</label>
	        <input type="text" class="form-control" name="afp"  required="" value="<?php echo $fila['afp'];?>" <?php echo $atributo2;?>>
	      </article>
        <article class="col-xs-2">
	        <label for="">CCF:</label>
	        <input type="text" class="form-control" name="ccf" value="<?php echo $fila['ccf'];?>" <?php echo $atributo2;?>>
	      </article>
        <article class="col-xs-2">
	        <label for="">T.Admin:</label>
	        <input type="text" class="form-control" name="tadm" required=""  value="<?php echo $fila['tadm'];?>" <?php echo $atributo2;?>>
	      </article>
        <article class="col-xs-4">
	        <label for="">Tipo de convenio:</label>
	        <select class="form-control" name="tipo_convenio" required="">
            <?php
              $contrato=$fila['tipo_convenio'];
              if ($contrato=1) {
                echo'<option value="1">Dependiente</option>';
              }else {
                echo'<option value="2">Independiente</option>';
              }
             ?>
            <option value=""></option>
            <option value="1">Dependiente</option>
            <option value="2">Independiente</option>
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
