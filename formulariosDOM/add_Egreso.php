<form action="<?php echo PROGRAMA.'?opcion='.$return;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-body">
      <article class="col-xs-1">
  	  	<label for="">ID:</label>
  	  	<input type="text"  name="idpresentacion" class="form-control" value="<?php echo $_GET["idpresentacion"];?>"<?php echo $atributo1;?>/>

  	  </article>
  	  <article class="col-xs-3">
  	  	<label for="">Fecha ejecución Egreso:</label>
  	  	<input type="datetime" name="freg_egreso" class="form-control" value="<?php echo date('Y-m-d H:i:s');?>">
      </article>
  	  <article class="col-xs-4">
  	  	<label for="">Dirección del egreso:</label>
  	  	<input type="text" value="" name="dir_egreso"  class="form-control"  required=""/>
  	  </article>
      <article class="col-xs-4">
  	  	<label for="">Seleccione Profesional:</label>
  	  	<select name="id_user" class="form-control" required="" <?php echo atributo3; ?>>
          <option value=""></value>
  				<?php
  				$sql="SELECT id_user,id_perfil,nombre,especialidad from user where id_perfil=48";
  				if($tabla=$bd1->sub_tuplas($sql)){
  					foreach ($tabla as $fila2) {
  						if ($fila["id_user"]==$fila2["id_user"]){
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
    		<?php include('dxindv.php');?>
    	</article>
      <article class="col-xs-12">
        <label for="">Observación egreso:</label>
        <textarea name="obs_egreso" class="form-control" rows="5" ></textarea>
      </article>
    </section>
    <div class="row text-center">
		  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>
  </section>
</form>
