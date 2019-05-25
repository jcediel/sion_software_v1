<form action="<?php echo PROGRAMA.'?&opcion='.$return.'&idpresentacion='.$return2.'&idpac='.$return3;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-body">
      <section class="panel-heading"><h4 class="alert alert-info">Datos del paciente</h4></section>
      <article class="col-xs-1">
        <label for="">ID:</label>
        <input type="text" class="form-control" name="proc" value="<?php echo $_REQUEST['idpprod']?>" <?php echo $atributo1; ?>>
      </article>
      <article class="col-xs-3">
        <label for="">Documento:</label>
        <input type="text" class="form-control" name="name" value="<?php echo $fila['doc_pac']?>" <?php echo $atributo1; ?>>
      </article>
      <article class="col-xs-4">
        <label for="">Nombre completo:</label>
        <input type="text" class="form-control" name="name" value="<?php echo $fila['nom1']?> <?php echo $fila['nom2']?> <?php echo $fila['ape1']?> <?php echo $fila['ape1']?>" <?php echo $atributo1; ?>>
      </article>
      <article class="col-xs-4">
        <label for="">Ubicación:</label>
        <input type="text" class="form-control" name="name" value="<?php echo $fila['dir_pac']?> <?php echo $fila['nom_barrio']?>" <?php echo $atributo1; ?>>
      </article>
    </section>
    <section class="panel-body">
      <section class="panel-heading"><h4 class="alert alert-info">Datos de asignación del profesional</h4></section>
      <article class="col-xs-5">
  	  	<label for="">Fecha inicial de atención:</label>
  	  	<input type="date" value="<?php echo $fila['doc_pac'];?>" name="finicial" class="form-control"<?php echo $atributo2;?>/>
        <input type="hidden" value="<?php echo $_REQUEST['idpprod'];?>" name="iprod" class="form-control"<?php echo $atributo2;?>/>
        <input type="text" value="<?php echo $fila['zonificacion'];?>" name="iprod" class="form-control"<?php echo $atributo2;?>/>
  	  </article>
      <article class="col-xs-5">
  	  	<label for="">Fecha final de atención:</label>
  	  	<input type="date" value="<?php echo $fila["nom1"];?>" name="ffinal" class="form-control" <?php echo $atributo2;?>/>
  	  </article>
      <article class="col-xs-6">
        <label for="">Selecciona Profesional:</label>
        <select name="id_user" class="form-control" required=""  <?php echo atributo3; ?>>
  				<option value=""></option>
  				<?php
          $zona=$fila['zonificacion'];
  				$sql="SELECT a.id_user,nombre,especialidad,b.id_barrio from user a inner join zonificacion b on a.id_user=b.id_user WHERE b.id_barrio=".$zona;
  				if($tabla=$bd1->sub_tuplas($sql)){
  					foreach ($tabla as $fila2) {
  						if ($fila2["id_user"]==$fila2["id_user"]){
  							$sw=' selected="selected"';
  						}else{
  							$sw="";
  						}
  					echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.$fila2["nombre"].' | '.$fila2["especialidad"].'</option>';
  					}
  				}
  				?>
  			</select>
      </article>
  	  <article class="col-xs-12">
  	  	<label for="">Notificación para que observe el profesional:</label>
  	  	<textarea name="notificacion" rows="4" class="form-control"></textarea>
  	  </article>
  </section>
  <div class="row text-center">
    <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
    <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
    <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
  </div>
</form>
