<form action="<?php echo PROGRAMA.'?opcion='.$return.'&idm='.$return4.'&idadmhosp='.$return2.'&servicio='.$return5.'&sede='.$return7.'&atencion='.$return8.'&doc='.$return3.'&tf='.$return6.'&bod='.$return9;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading"><h4><?php echo $subtitulo.' '.$fila['medicamento']; ?></h4></section>
    <section class="panel-body">
      <article class="col-xs-1">
  	  	<label for="">ID:</label>
  	  	<input type="text"  name="idd" class="form-control" value="<?php echo $_GET["idm"];?>"<?php echo $atributo1;?>/>
        <input type="hidden"  name="servicio" class="form-control" value="<?php echo $_GET["servicio"];?>"<?php echo $atributo1;?>/>
        <input type="hidden"  name="idm" class="form-control" value="<?php echo $fila["id_m_fmedhosp"];?>"<?php echo $atributo1;?>/>
  	  </article>
  	  <article class="col-xs-3">
  	  	<label for="">Medicamento:</label>
  	  	<input type="text" name="medicamento" class="form-control" value="<?php echo $fila['medicamento'];?>" <?php echo $atributo1;?>>
      </article>
      <article class="col-xs-2">
  	  	<label for="">Vía Administración:</label>
  	  	<input type="text" name="via" class="form-control" value="<?php echo $fila['via'];?>" <?php echo $atributo1;?>>
      </article>
  	  <article class="col-xs-2">
  	  	<label for="">Frecuencia:</label>
        <?php echo $frecuencia; ?>
  	  </article>
      <article class="col-xs-1">
				<label for="">6am-8am: </label>
				<input class="form-control" type='number'  name='dosis1' value='<?php echo $fila['dosis1'];?>'<?php echo $atributo2;?>/>
			</article>
      <article class="col-xs-1">
				<label for="">12m-2pm: </label>
				<input class="form-control" type='number'  name='dosis2' value='<?php echo $fila['dosis2'];?>'<?php echo $atributo2;?>/>
			</article>
      <article class="col-xs-1">
				<label for="">6pm-8pm: </label>
				<input class="form-control" type='number'  name='dosis3' value='<?php echo $fila['dosis3'];?>'<?php echo $atributo2;?>/>
			</article>
      <article class="col-xs-1">
				<label for="">10pm-12pm: </label>
				<input class="form-control" type='number'  name='dosis4' value='<?php echo $fila['dosis4'];?>'<?php echo $atributo2;?>/>
			</article>
      <article class="col-xs-7">
				<label for="">Observación: </label>
				<textarea name="obsfmedhosp" rows="5" class="form-control" <?php echo $atributo3;?>><?php echo $fila['obsfmedhosp'];?></textarea>
			</article>
    </section>
    <div class="row text-center">
		  <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>
  </section>
</form>
