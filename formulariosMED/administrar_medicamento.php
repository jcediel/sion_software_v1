<form action="<?php echo PROGRAMA.'?opcion=155&idadmhosp='.$return.'&servicio=Hospitalario&doc='.$return1.'&sede='.$return2;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-body">
      <article class="col-xs-1">
  	  	<label for="">ID:</label>
  	  	<input type="text"  name="idd" class="form-control" value="<?php echo $_GET["iddosi"];?>"<?php echo $atributo1;?>/>
        <input type="hidden"  name="fadmin" class="form-control" value="<?php echo date('Y-m-d');?>"<?php echo $atributo1;?>/>
  	  </article>
  	  <article class="col-xs-2">
  	  	<label for="">Dosis:</label>
  	  	<input type="text" name="nom_dosi" class="form-control" value="<?php echo $fila['nom_dosi'];?>" <?php echo $atributo1;?>>
      </article>
      <article class="col-xs-2">
  	  	<label for="">Cantidad Dosificada:</label>
  	  	<input type="text" name="cant_dosi" class="form-control" value="<?php echo $fila['cant_dosi'];?>" <?php echo $atributo1;?>>
      </article>
  	  <article class="col-xs-7">
  	  	<label for="">Observación:</label>
        <textarea name="obs_dosi" rows="5" class="form-control"<?php echo $atributo1;?>><?php echo $fila['obs_dosi'];?></textarea>
  	  </article>
    </section>
    <section class="panel-body">
      <article class="col-xs-2">
  	  	<label for="">Cantidad administrada:</label>
  	  	<input type="number" name="cant_admin" class="form-control" value="<?php echo $fila['cant_dosi'];?>" <?php echo $atributo3;?>>
      </article>
      <article class="col-xs-2">
  	  	<label for="">Hora administración:</label>
  	  	<input type="time" name="hora_admin" class="form-control" value="<?php echo $date1;?>" <?php echo $atributo3;?>>
      </article>
  	  <article class="col-xs-8">
  	  	<label for="">Nota de administración:</label>
        <textarea name="obs_admin" rows="5" class="form-control" <?php echo $atributo3;?>><?php echo $fila['obs_dosi'];?></textarea>
  	  </article>
    </section>
    <div class="row text-center">
		  <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>
  </section>
</form>
