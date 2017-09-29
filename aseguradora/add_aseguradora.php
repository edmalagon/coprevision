<form action="<?php echo PROGRAMA.'?ase='.$return.'&buscar=Consultar&opcion=2';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
    <section class="panel-heading">
      <h3><strong><?php echo $subtitulo ?> </strong></h3>
    </section>
    <section class="panel-body col-xs-9">
			<section class="panel-body col-xs-12">
				<article class="col-xs-4">
	        <label for="">Nombre Aseguradora:</label>
	        <input type="text" class="form-control" name="nombre" value="<?php echo $fila['nombre'];?>" <?php echo $atributo2;?>>
					<input type="hidden" class="form-control" name="id_aseguradora" value="<?php echo $fila['id_aseguradora'];?>" <?php echo $atributo1;?>>
	        </select>
	      </article>
				<article class="col-xs-3">
	        <label for="">Tipo Aseguradora:</label>
	        <select class="form-control" name="tipo_aseguradora">
	        	<option value="<?php echo $fila['tipo_aseguradora']; ?>"><?php echo $fila['tipo_aseguradora']; ?></option>
						<option value="EPS">EPS</option>
						<option value="AFP">AFP</option>
						<option value="ARP">ARP</option>
						<option value="CCF">CCF</option>
	        </select>
	      </article>
				<article class="col-xs-2">
	        <label for="">Cod Ministerio:</label>
	        <input type="text" class="form-control" name="cod_ministerio"  required="" value="<?php echo $fila['cod_ministerio'];?>" <?php echo $atributo2;?>>
	      </article>
        <article class="col-xs-3">
	        <label for="">NIT:</label>
	        <input type="text" class="form-control" name="nit"  required="" value="<?php echo $fila['nit'];?>" <?php echo $atributo2;?>>
	      </article>
        <article class="col-xs-5">
	        <label for="">Dirección:</label>
	        <input type="text" class="form-control" name="direccion" value="<?php echo $fila['direccion'];?>" <?php echo $atributo2;?>>
	      </article>
        <article class="col-xs-5">
	        <label for="">Teléfono:</label>
	        <input type="text" class="form-control" name="telefono" required=""  value="<?php echo $fila['telefono'];?>" <?php echo $atributo2;?>>
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
