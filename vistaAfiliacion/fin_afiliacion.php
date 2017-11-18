<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
          $("#codigo").autocomplete({
              source: "vistaAfiliacion/bus_ocupacion.php",
              minLength: 4,
              select: function(event, ui) {
        event.preventDefault();
        $('#codigo').val(ui.item.codigo);
        $('#descripcion').val(ui.item.descripcion);
        $('#porcentaje').val(ui.item.porcentaje);
        $('#id_producto').val(ui.item.id_producto);
         }
          });
  });
</script>
<form action="<?php echo PROGRAMA.'?opcion=4&id='.$ida.'&doc='.$doc.'$nc='.$nc;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
    <section class="panel-heading">
      <h3><strong>Inactivar afiliación del cliente  <?php echo $nc ;?></strong></h3>
    </section>
    <section class="panel-body col-xs-9">
      <article class="col-xs-2">
        <label for="">ID:</label>
        <input type="text" class="form-control" name="id_afiliacion" value="<?php echo $fila['id_afiliacion']?>" <?php echo $atributo1 ?>>
      </article>
      <article class="col-xs-3">
        <label for="">Motivo de cancelación:</label>
        <select class="form-control" name="motivo_egreso">
          <option value="Error en convenio">Error en convenio</option>
          <option value="Cambio Empleador">Cambio Empleador</option>
          <option value="Finalizacion Contrato">Finalizacion Contrato</option>
          <option value="No pago de obligaciones">No pago de obligaciones</option>
        </select>
      </article>
      <article class="col-xs-7">
        <label for="">Observación cancelación:</label>
        <textarea name="obs_egreso" class="form-control" rows="5" cols="80"></textarea>
      </article>
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
