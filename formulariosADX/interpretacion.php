<form action="<?php echo PROGRAMA.'?opcion='.$return.'&idm='.$return1.'&idadmhosp='.$return2.'&atencion='.$return4.'&doc='.$return3;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
		<section class="panel-heading"><h4>Interpretación del procedimiento: </h4><p class="alert alert-info animated bounceInRight"><?php echo $fila["procedimiento"];?></p></section>
		<section class="panel-body">
      <article class="col-xs-6">
        <label for="">Observación en orden de servicio:</label>
        <textarea name="obs" class="form-control" rows="4" <?php echo $atributo1;?>><?php echo $fila['observacion'];?></textarea>
      </article>
      <article class="col-xs-6">
        <label for="">Observación en Laboratorio clínico:</label>
        <textarea name="obs" class="form-control" rows="4" <?php echo $atributo1;?>><?php echo $fila['observacion_lab'];?></textarea>
      </article>
			<article class="col-xs-1">
		  	<label  for="">ID:</label>
		  	<input type="text"  name="idd" class="form-control" value="<?php echo $_GET["idd"];?>"<?php echo $atributo1;?>/>
				<input type="hidden"  name="idord" class="form-control" value="<?php echo $_GET["idorden"];?>"<?php echo $atributo1;?>/>
		  </article>
			<article class="col-xs-3">
				<label for="">Fecha Registro:</label>
				<input type="text" name="freg" class="form-control" value="<?php echo date('Y-m-d');?>" <?php echo $atributo1; ?>>
				<input type="hidden" name="idadmhosp" class="form-control" value="<?php echo $_GET["idadmhosp"];?>" <?php echo $atributo1;?>/>
			</article>
			<article class="col-xs-8">
				<label for="">Interpretacion:</label>
				<textarea class="form-control" name="interpretacion" rows="15" ></textarea>
			</article>
		</section>
	</section>
		<div class="row text-center">
		  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>

  </section>
</form>
