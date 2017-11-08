<form action="<?php echo PROGRAMA.'?opcion=4&doc='.$return.'&nc='.$return1;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
    <section class="panel-heading">
      <h3><strong>Datos de afiliación para el cliente <?php echo $fila['nom1'].' '.$fila['nom2'].' '.$fila['ape1'].' '.$fila['ape2'] ;?></strong></h3>
    </section>
    <section class="panel-body col-xs-9">
			<section class="panel-body col-xs-12">
				<article class="col-xs-4">
          <input type="hidden" name="nom_completo" value="<?php echo $fila['nom_completo'];?>" <?php echo $atributo1;?>>
	        <label for="">Empresa:</label>
	        <input type="text" class="form-control" name="empresa" value="<?php echo $fila['nom_empresa'];?>" <?php echo $atributo1;?>>
					<input type="hidden" class="form-control" name="ida" value="<?php echo $fila['id_afiliacion'];?>" <?php echo $atributo1;?>>
					<input type="hidden" class="form-control" name="nc" value="<?php echo $fila['nom_completo'];?>" <?php echo $atributo1;?>>
	        </select>
	      </article>
				<article class="col-xs-4">
	        <label for="">Seleccione Convenio:</label>
	        <input type="text" class="form-control" name="convenio" value="<?php echo $fila['nom_convenio'];?>" <?php echo $atributo1;?>>
	      </article>
				<article class="col-xs-4">
					<label for="">Fecha de afiliación:</label>
					<input type="text" class="form-control" name="fafiliacion" value="<?php echo $fila['fini_afiliacion'];?>" <?php echo $atributo1;?>>
				</article>
			</section>
      <section class="panel-body  col-xs-12">
				<article class="col-xs-6">
	        <label for="">EPS:</label> <label for="" class="text-success"><?php echo $fila['eps'];?> %</label>
	        <textarea name="eps" rows="2" class="form-control" <?php echo $atributo1;?>><?php echo $fila['eps_ase'];?></textarea>
	      </article>
				<article class="col-xs-6">
	        <label for="">AFP:</label> <label for="" class="text-success"><?php echo $fila['afp'];?> %</label>
	        <textarea name="afp" rows="2" class="form-control" <?php echo $atributo1;?>><?php echo $fila['afp_ase'];?></textarea>
	      </article>
				<article class="col-xs-6">
	        <label for="">ARP:</label> <label for="" class="text-success"><?php echo $fila['porcen_nivel'];?> %</label>
	        <textarea name="arp" rows="2" class="form-control" <?php echo $atributo1;?>><?php echo $fila['arp_ase'];?></textarea>
	      </article>
				<article class="col-xs-6">
	        <label for="">CCF:</label> <label for="" class="text-success"><?php echo $fila['ccf'];?> %</label>
	        <textarea name="ccf" rows="2" class="form-control" <?php echo $atributo1;?>><?php echo $fila['ccf_ase'];?></textarea>
	      </article>
      </section>
      <section class="panel-body">
        <article class="col-xs-3">
	        <label for="">Ocupacion:</label>
	        <input type="text" class="form-control" name="ocupacion" value="<?php echo $fila['nom_ocupacion'];?>" <?php echo $atributo1;?>>
	      </article>
        <article class="col-xs-3">
	        <label for="">Nivel ARP:</label>
	        <input type="text" required="" class="form-control" name="nivel_arp" value="<?php echo $fila['nivel_arl'];?>" <?php echo $atributo1;?>>
	      </article>
				<article class="col-xs-3">
					<label for="">SALARIO:</label>
					<input type="text" required="" class="form-control" name="salario" value="<?php echo $fila['salario'];?>" <?php echo $atributo1;?>>
				</article>
      </section>
			<?php $m=date('Y'); ?>
			<section class="panel-body">
				<?php
				if ($fila['nom_empresa']=='PREVISOCIAL') {
				echo'<article class="col-xs-3">
					<label for="">Tarifa EPS</label>';
						$s=$fila['salario'];
						$aseg=$fila['eps'];
						$teps=ceil(($s*$aseg)/100);
						echo'<input type="text" required="" class="form-control" name="t_eps" value="'.$teps.'" '.$atributo1.'>';

				echo'</article>';
				echo'<article class="col-xs-3">
					<label for="">Tarifa AFP</label>';
							$s=$fila['salario'];
							$aseg=$fila['afp'];
							$tafp=ceil(($s*$aseg)/100);
							echo'<input type="text" required="" class="form-control" name="t_afp" value="'.$tafp.'" '.$atributo1.'>';
				echo'</article>';
				echo'<article class="col-xs-3">
					<label for="">Tarifa ARP</label>';
							$s=$fila['salario'];
							$aseg=$fila['porcen_nivel'];
							$tarl=ceil(($s*$aseg)/100);
							echo'<input type="text" required="" class="form-control" name="t_arp" value="'.$tarl.'" '.$atributo1.'>';
				echo'</article>';
				echo'<article class="col-xs-3">
					<label for="">Tarifa CCF</label>';
							$s=$fila['salario'];
							$aseg=$fila['ccf'];
							$tccf=ceil(($s*$aseg)/100);
							echo'<input type="text" required="" class="form-control" name="t_ccf" value="'.$tccf.'" '.$atributo1.'>';
				echo'</article>';
			}
			if ($fila['nom_empresa']=='PREVISION') {

				echo'<article class="col-xs-12">
					<label for="" class="alert alert-danger">Las tarifas de parafiscales en clientes PREVISION se calcularan segun los dias laborados.</label>';
					echo'<input type="hidden" class="form-control" name="t_eps" value="'.$fila['eps'].'" >';
					echo'<input type="hidden" class="form-control" name="t_afp" value="'.$fila['afp'].'" >';
					echo'<input type="hidden" class="form-control" name="t_arp" value="'.$fila['porcen_nivel'].'" >';
					echo'<input type="hidden" class="form-control" name="t_ccf" value="'.$fila['ccf'].'" >';
				echo'</article>';
			}

				 ?>
			</section>
			<section class="panel-body">
				<article class="col-xs-3">
					<label for="">Mes de Pago a realizar</label>
					<select class="form-control" name="mes_pago" required="">
						<option value=""></option>
						<option value="Enero <?php echo $m;?>">Enero <?php echo $m;?></option>
						<option value="Febrero <?php echo $m;?>">Febrero <?php echo $m;?></option>
						<option value="Marzo <?php echo $m;?>">Marzo <?php echo $m;?></option>
						<option value="Abril <?php echo $m;?>">Abril <?php echo $m;?></option>
						<option value="Mayo <?php echo $m;?>">Mayo <?php echo $m;?></option>
						<option value="Junio <?php echo $m;?>">Junio <?php echo $m;?></option>
						<option value="Julio <?php echo $m;?>">Julio <?php echo $m;?></option>
						<option value="Agosto <?php echo $m;?>">Agosto <?php echo $m;?></option>
						<option value="Septiembre <?php echo $m;?>">Septiembre <?php echo $m;?></option>
						<option value="Octubre <?php echo $m;?>">Octubre <?php echo $m;?></option>
						<option value="Noviembre <?php echo $m;?>">Noviembre <?php echo $m;?></option>
						<option value="Diciembre <?php echo $m;?>">Diciembre <?php echo $m;?></option>
					</select>
				</article>
				<?php
				$idaa=$fila['id_afiliacion'];
				$sql1="SELECT max(mes_pago) pago FROM obligacion WHERE id_afiliacion=$idaa";

				if ($tabla1=$bd1->sub_tuplas($sql1)){
					 foreach ($tabla1 as $fila1 ) {
						 echo'<article class="col-xs-3 alert alert-danger animated pulse">
							<p class="lead text-danger">Ultimo Mes Canceledado '.$fila1['pago'].'</p>
						</article>';
					 }
				}
				 ?>
				<article class="col-xs-3">
					<label for="">Ingrese dias mora:</label>
					<input type="text" name="mora" class="form-control" value="0">
				</article>
				<article class="col-xs-3">
					<label for="">porcentaje dias mora:</label>
					<input type="text" name="porcenmora" class="form-control" value="0">
				</article>
			</section>
			<section class="panel-body">
				<?php
					$empresa=$fila['nom_empresa'];
					if ($empresa=='PREVISOCIAL') {
						$tadmin=$fila['tadm'];
						$ttotal=$teps+$tafp+$tarl+$tccf+$tadmin+1000;
						$t=round($ttotal,-3);
						echo'
						<article class="col-xs-2">
							<label for="" class="text-danger lead">Total a cancelar: $</label>
						</article>
						<article class="col-xs-5">
							<input type="text" required="" class="form-control text-danger lead" name="t_servicio" value="'.$t.'" '.$atributo1.'>
						</article>';
					}
					if ($empresa=='PREVISION') {

				echo'
					  <article class="col-xs-2">
							<label for="">Dias laborados:</label>
						 	<input type="text" name="dias_laborados" class="form-control" value="0">
						</article>';
					}

				 ?>
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
