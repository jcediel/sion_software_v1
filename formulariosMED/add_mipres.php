<form action="<?php echo PROGRAMA.'?opcion='.$return.'&idm='.$return1.'&idadmhosp='.$return2.'&servicio='.$return3.'&atencion='.$return8.'&sede='.$return7.'&doc='.$return5.'&tf='.$return6;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading"><h3><?php echo $subtitulo; ?></h3></section>
    <section class="panel-body">
      <article class="col-xs-3">
        <label for="">Radicado MIPRES</label>
        <input type="text" name="rad_mipres" class="form-control" value="">
        <input type="hidden" name="id_d_fmedhosp" class="form-control" value="<?php echo $fila['id_d_fmedhosp'];?>">
      </article>
      <article class="col-xs-3">
        <label for="">Tipo de MIPRES</label>
        <select class="form-control" required="" name="tipo_mipres">
          <option value=""></option>
          <option value="1" class="text-danger">Junta medica</option>
          <option value="2" class="text-success">Prescripción</option>
        </select>
      </article>
      
      <article class="col-xs-4">
        <label>Cargar soporte MIPRES:</label>
        <?php echo $fila["foto"];?><br>
        <input type="file" class="form-control" name="soporte" <?php echo $atributo3; ?>/>
      </article>
    </section>
    <div class="row text-center">
		  <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>
  </section>
</form>
