<form action="<?php echo PROGRAMA.'?opcion='.$return.'&idadmhosp='.$return1.'&servicio='.$return2.'&atencion='.$return4.'&doc='.$return3;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading"><h4><?php echo $subtitulo; ?></h4></section>
    <section class="panel-body">
      <article class="col-xs-1">
  	  	<label for="">ID:</label>
  	  	<input type="text"  name="idadmhosp" class="form-control" value="<?php echo $_GET["idadmhosp"];?>"<?php echo $atributo1;?>/>
        <input type="hidden"  name="servicio" class="form-control" value="<?php echo $_GET["servicio"];?>"<?php echo $atributo1;?>/>
        <input type="hidden"  name="idm" class="form-control" value="<?php echo $fila["id_master_prod"];?>"<?php echo $atributo1;?>/>
  	  </article>
  	  <article class="col-xs-3">
  	  	<label for="">Fecha Registro:</label>
  	  	<input type="date" name="fecha_orden" class="form-control" value="<?php echo date('Y-m-d');?>" <?php echo $atributo1;?>>
      </article>
      <?php
        $servicio=$_REQUEST['servicio'];
        if ($servicio=='Hospitalario') {
          echo'
          <article class="col-xs-4">
      	  	<label for="">Tipo de Atención:</label>
      	  	<select class="form-control"  name="tipo_atencion" required="" '.$atributo2.'>
      	  	  <option values="'.$fila["tipo_atencion"].'">'.$fila["tipo_atencion"].'</option>
              <option values="Hospitalario">Hospitalario</option>
              <option values="Ambulatoria">Ambulatoria</option>
      	  	</select>
      	  </article>
          ';
        }else {
          echo'
          <article class="col-xs-4">
            <label for="">Tipo de Atención:</label>
            <select class="form-control"  name="tipo_atencion" required="" '.$atributo2.'>
              <option values="'.$fila["tipo_atencion"].'">'.$fila["tipo_atencion"].'</option>
              <option values="Ambulatoria">Ambulatoria</option>
            </select>
          </article>
          ';
        }
      ?>
      <article class="col-xs-5">
				<label for="">Servicio: </label>
				<input type="text" class="form-control" name="servicio" value="<?php echo $_REQUEST["servicio"];?>" <?php echo $atributo1;?>>
			</article>
      <article class="col-xs-12">
    		<?php include('dxindv.php');?>
    	</article>
    </section>
    <div class="row text-center">
		  <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>
  </section>
</form>
