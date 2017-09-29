<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Buscar&opcion='.$option;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
 <section class="panel panel-default">
	 <section class="panel-heading">
	 	<h2><?php echo $subtitulo; ?></h2>
	 </section>
	 <section class="panel-body">
     <article class="col-xs-5">
       <input type="hidden" name="idpac" value="<?php echo $_GET["idpac"];?>">
       <label for="">Documento:</label>
       <select name="nomdoc" class="form-control" <?php echo atributo3; ?>>
       <option value="Documento Identidad">Documento Identidad</option>
       <option value="Autorizacion EPS">Autorizacion EPS</option>
       <option value="Consentimiento Informado">Consentimiento Informado</option>
       <option value="Consentimiento Procedimientos">Consentimiento Procedimientos</option>
       <option value="Consentimiento Traslado">Consentimiento Traslado</option>
       <option value="Epicrisis">Epicrisis</option>
       <option value="Pagare">Pagare</option>
     </select>
   </article>
   <article class="col-xs-6">
     <label>Suba aqui el documento:</label>
     <?php echo $fila["foto"];?><br>
     <input type="file" class="form-control" name="foto" <?php echo $atributo3; ?>/>
   </article>
	 </section>
 </section>
 <div class="row text-center">
	 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />

	 <input type="submit" class="btn btn-danger" name="aceptar" Value="Descartar"/>
	 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
 </div>
		</section>
	</form>
