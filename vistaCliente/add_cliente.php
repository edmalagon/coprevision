<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Buscar&opcion=3';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
    <section class="panel-heading">
      <h3><strong>Registro de datos personales de cliente</strong></h3>
    </section>
    <section class="panel-body col-xs-8">
			<section class="panel-body col-xs-12">
				<article class="col-xs-4">
	        <label for="">Tipo documento:</label>
	        <select name="tdoc_cli" class="form-control" <?php echo $atributo1; ?>>
						<option value="<?php echo $fila['tdoc_cli']; ?>"><?php echo $fila['tdoc_cli']; ?></option>
	          <?php
	          $sql="SELECT tipo,descri_tipo from tdocumentos ORDER BY tipo DESC";

	          if($tabla=$bd1->sub_tuplas($sql)){
	            foreach ($tabla as $fila2) {
	              if ($fila["tipo"]==$fila2["tipo"]){
	                $sw=' selected="selected"';
	              }else{
	                $sw="";
	              }
	            echo '<option value="'.$fila2["tipo"].'"'.$sw.'>'.$fila2["descri_tipo"].'</option>';
	            }
	          }
	          ?>
	        </select>
	      </article>
				<article class="col-xs-3">
					<label for="">Documento</label>
					<input type="text" class="form-control" name="doc_cli" value="<?php echo $fila['doc_cli']; ?>"  <?php echo $atributo2; ?>>
					<input type="hidden" class="form-control" name="id_cliente" value="<?php echo $fila['id_cliente']; ?>">
				</article>
			</section>
      <section class="panel-body  col-xs-12">
				<article class="col-xs-3">
					<label for="">Primer Nombre</label>
					<input type="text" name="nom1" class="form-control" value="<?php echo $fila['nom1']; ?>"  <?php echo $atributo2; ?>style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" >
				</article>
				<article class="col-xs-3">
					<label for="">Segundo Nombre</label>
					<input type="text" name="nom2" class="form-control" value="<?php echo $fila['nom2']; ?>"  <?php echo $atributo2; ?>style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" >
				</article>
				<article class="col-xs-3">
					<label for="">Primer Apellido</label>
					<input type="text" name="ape1" class="form-control" value="<?php echo $fila['ape1']; ?>"  <?php echo $atributo2; ?>style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" >
				</article>
				<article class="col-xs-3">
					<label for="">Segundo Apellido</label>
					<input type="text" name="ape2" class="form-control" value="<?php echo $fila['ape2']; ?>"  <?php echo $atributo2; ?>style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" >
				</article>
      </section>
			<section class="panel-body  col-xs-12">
				<article class="col-xs-3">
					<label for="">F. nacimiento</label>
					<input type="date" class="form-control" name="fnacimiento" value="<?php echo $fila['fnacimiento']; ?>" <?php echo $atributo2; ?>>
				</article>
				<article class="col-xs-1">
					<label for="">Edad</label>
					<label for=""><?php echo $fila['edad']; ?><?php echo $edad; ?></label>
				</article>
				<article class="col-xs-4">
					<label for="">Email</label>
					<input type="email" class="form-control" name="email_cli" value="<?php echo $fila['email_cli']; ?>" <?php echo $atributo2; ?>>
				</article>
				<article class="col-xs-4">
					<label for="">Dirección</label>
					<input type="text" class="form-control" name="dir_cli" value="<?php echo $fila['dir_cli']; ?>" <?php echo $atributo2; ?>>
				</article>
			</section>
			<section class="panel-body">
				<article class="col-xs-6">
					<label for="">Teléfono Fijo:</label>
					<input type="text" name="fijo" class="form-control" value="<?php echo $fila['fijo']; ?>" <?php echo $atributo2; ?>>
				</article>
				<article class="col-xs-6">
					<label for="">Teléfono Celular:</label>
					<input type="text" name="celular" class="form-control" value="<?php echo $fila['celular']; ?>" <?php echo $atributo2; ?>>
				</article>
				<article class="col-xs-4">
	        <label for="">Seleccione Gremio:</label>
	        <select name="gremio" required="" class="form-control" <?php echo $atributo1; ?>>
						<option value="<?php echo $fila['gremio']; ?>"><?php echo $fila['gremio']; ?></option>
	          <?php
	          $sql="SELECT * from gremio";

	          if($tabla=$bd1->sub_tuplas($sql)){
	            foreach ($tabla as $fila2) {
	              if ($fila["nom_gremio"]==$fila2["nom_gremio"]){
	                $sw=' selected="selected"';
	              }else{
	                $sw="";
	              }
	            echo '<option value="'.$fila2["nom_gremio"].'"'.$sw.'>'.$fila2["nom_gremio"].'</option>';
	            }
	          }
	          ?>
	        </select>
	      </article>
			</section>
    </section>
  	<section class="panel-body text-right col-xs-4">
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
