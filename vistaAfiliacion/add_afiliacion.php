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
<form action="<?php echo PROGRAMA.'?opcion=4&doc='.$return.'$nc='.$return1;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
    <section class="panel-heading">
      <h3><strong>Datos de afiliación para el cliente <?php echo $fila['nom1'].' '.$fila['nom2'].' '.$fila['ape1'].' '.$fila['ape2'] ;?></strong></h3>
    </section>
    <section class="panel-body col-xs-9">
			<section class="panel-body col-xs-12">
				<article class="col-xs-4">
          <input type="hidden" name="nom_completo" value="<?php echo $fila['nom_completo'];?>">
	        <label for="">Seleccione Empresa:</label>
	        <select name="id_empresa" required="" class="form-control" <?php echo $atributo1; ?>>
						<option value="<?php echo $fila['id_empresa']; ?>"><?php echo $fila['nom_empresa']; ?></option>
	          <?php
	          $sql="SELECT * from empresa ";

	          if($tabla=$bd1->sub_tuplas($sql)){
	            foreach ($tabla as $fila2) {
	              if ($fila["id_empresa"]==$fila2["id_empresa"]){
	                $sw=' selected="selected"';
	              }else{
	                $sw="";
	              }
	            echo '<option value="'.$fila2["id_empresa"].'"'.$sw.'>'.$fila2["nom_empresa"].'</option>';
	            }
	          }
	          ?>
	        </select>
	      </article>
				<article class="col-xs-4">
	        <label for="">Seleccione Convenio:</label>
	        <select name="id_convenio" required="" class="form-control" <?php echo $atributo1; ?>>
						<option value="<?php echo $fila['id_convenio']; ?>"><?php echo $fila['nom_convenio']; ?></option>
	          <?php
	          $sql="SELECT * from convenio ";

	          if($tabla=$bd1->sub_tuplas($sql)){
	            foreach ($tabla as $fila2) {
	              if ($fila["id_convenio"]==$fila2["id_convenio"]){
	                $sw=' selected="selected"';
	              }else{
	                $sw="";
	              }
	            echo '<option value="'.$fila2["id_convenio"].'"'.$sw.'>'.$fila2["nom_convenio"].'</option>';
	            }
	          }
	          ?>
	        </select>
	      </article>
				<article class="col-xs-4">
					<label for="">Fecha de afiliación:</label>
					<input type="date" required="" name="fini_afiliacion" class="form-control" value="">
          <input type="hidden" required="" name="id_cliente" class="form-control" value="<?php echo $fila['id_cliente'];?>">
				</article>
			</section>
      <section class="panel-body  col-xs-12">
				<article class="col-xs-4">
	        <label for="">Seleccione EPS:</label>
	        <select name="eps_afiliacion" class="form-control" <?php echo $atributo1; ?>>
						<option value="<?php echo $fila['eps_afiliacion']; ?>"><?php echo $fila['eps_afiliacion']; ?></option>
	          <?php
	          $sql="SELECT * from aseguradora where tipo_aseguradora in ('EPS','SALUD ESPECIAL','EAS')";

	          if($tabla=$bd1->sub_tuplas($sql)){
	            foreach ($tabla as $fila2) {
	              if ($fila["id_aseguradora"]==$fila2["id_aseguradora"]){
	                $sw=' selected="selected"';
	              }else{
	                $sw="";
	              }
	            echo '<option value="'.$fila2["id_aseguradora"].'"'.$sw.'>'.$fila2["nombre"].'</option>';
	            }
	          }
	          ?>
	        </select>
	      </article>
				<article class="col-xs-4">
	        <label for="">Seleccione AFP:</label>
	        <select name="afp_afiliacion" required="" class="form-control" <?php echo $atributo1; ?>>
						<option value="<?php echo $fila['afp_afiliacion']; ?>"><?php echo $fila['afp_afiliacion']; ?></option>
	          <?php
	          $sql="SELECT * from aseguradora where tipo_aseguradora in ('AFP')";

	          if($tabla=$bd1->sub_tuplas($sql)){
	            foreach ($tabla as $fila2) {
	              if ($fila["id_aseguradora"]==$fila2["id_aseguradora"]){
	                $sw=' selected="selected"';
	              }else{
	                $sw="";
	              }
	            echo '<option value="'.$fila2["id_aseguradora"].'"'.$sw.'>'.$fila2["nombre"].'</option>';
	            }
	          }
	          ?>
	        </select>
	      </article>
				<article class="col-xs-4">
	        <label for="">Seleccione ARP:</label>
	        <select name="arp_afiliacion" required="" class="form-control" <?php echo $atributo1; ?>>
						<option value="<?php echo $fila['arp_afiliacion']; ?>"><?php echo $fila['arp_afiliacion']; ?></option>
	          <?php
	          $sql="SELECT * from aseguradora where tipo_aseguradora in ('ARP')";

	          if($tabla=$bd1->sub_tuplas($sql)){
	            foreach ($tabla as $fila2) {
	              if ($fila["id_aseguradora"]==$fila2["id_aseguradora"]){
	                $sw=' selected="selected"';
	              }else{
	                $sw="";
	              }
	            echo '<option value="'.$fila2["id_aseguradora"].'"'.$sw.'>'.$fila2["nombre"].'</option>';
	            }
	          }
	          ?>
	        </select>
	      </article>
				<article class="col-xs-4">
	        <label for="">Seleccione CCF:</label>
	        <select name="ccf_afiliacion" required="" class="form-control" <?php echo $atributo1; ?>>
						<option value="<?php echo $fila['ccf_afiliacion']; ?>"><?php echo $fila['ccf_afiliacion']; ?></option>
	          <?php
	          $sql="SELECT * from aseguradora where tipo_aseguradora in ('CCF')";

	          if($tabla=$bd1->sub_tuplas($sql)){
	            foreach ($tabla as $fila2) {
	              if ($fila["id_aseguradora"]==$fila2["id_aseguradora"]){
	                $sw=' selected="selected"';
	              }else{
	                $sw="";
	              }
	            echo '<option value="'.$fila2["id_aseguradora"].'"'.$sw.'>'.$fila2["nombre"].'</option>';
	            }
	          }
	          ?>
	        </select>
	      </article>
        
      </section>
      <section class="panel-body">
        <article class="col-xs-3">
	        <label for="">Seleccione ocupacion:</label>
	        <input type="text" required="" class="form-control" name="idocu" id="codigo" value="">
	      </article>
	      <article class="col-xs-3">
	        <label for="">Ocupación seleccionada:</label>
	        <input type="text" required="" class="form-control" name="ocupacion" id="descripcion" value="" <?php echo $atributo1;?>>
	      </article>
        <article class="col-xs-3">
	        <label for="">Nivel ARP:</label>
	        <input type="text" required="" class="form-control" name="nivel_arp" id="id_producto" value="" <?php echo $atributo1;?>>
	      </article>
        <article class="col-xs-3">
	        <label for="">Porcentaje nivel:</label>
	        <input type="text" required="" class="form-control" name="porcentaje" id="porcentaje" value="" <?php echo $atributo1;?>>
	      </article>
      </section>
      <section class="panel-body">
        <article class="col-xs-4">
          <label for="">Registre SALARIO:</label>
          <input type="text" required="" class="form-control" name="salario" value="0" <?php echo $atributo3;?>>
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
