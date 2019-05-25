
<form action="<?php echo PROGRAMA.'?&opcion=160&user='.$user.'';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()">
  <section class="panel panel-default">
    <section class="panel-heading">
      <h3>Modificación de Password y/o avatar</h3>
    </section>
    <section class="panel-body">
      <article class="col-xs-3">
  			<label>Clave:</label><br>
        <input type="hidden" name="id" value="<?php echo $fila['id_user'];?>">
  			<input type="password" class="form-control" name="clave1" value=""<?php echo $atributo2;?>/>
  		</article>
  		<article class="col-xs-3">
  			<label>Confirmar Clave:</label><br>
  			<input type="password" class="form-control" name="clave2" value=""<?php echo $atributo2;?>/>
  		</article >
      <article class="col-xs-5">
  			<label>Foto:</label>
  			Archivo: <?php echo $fila["foto"];?><br>
  			<img src="<?php echo $fila["foto"];?>" alt="" class="image_inicio_login"/>
  			<input type="file" class="form-control" name="foto" <?php echo $atributo3; ?>/>
  		</article>
    </section>
    <div class="text-center panel panel-body">
			<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>

  </section>
</form>
