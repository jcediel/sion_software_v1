<form action="<?php echo PROGRAMA.'?opcion='.$return;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-body">
      <article class="col-xs-1">
  	  	<label for="">ID:</label>
  	  	<input type="text"  name="idpaci" class="form-control" value="<?php echo $_GET["idpac"];?>"<?php echo $atributo1;?>/>
        <input type="text" name="docpac" class="form-control text-center" value="<?php echo $fila["doc_pac"];?>"/>
  	  </article>
  	  <article class="col-xs-3">
  	  	<label for="">Fecha Presentación:</label>
  	  	<input type="datetime" name="fpresentacion" class="form-control" value="<?php echo date('Y-m-d H:i:s');?>"<?php echo $atributo1;?>>
      </article>
      <article class="col-xs-2">
  	  	<label for="">Tipo paciente:</label>
  	    <select class="form-control" name="tipo_paciente" required="">
  	  	  <option value=""></option>
          <option value="Puntual">Puntual</option>
          <option value="Cronico">Cronico</option>
          <option value="PHD">PHD</option>
          <option value="PHD paleativo">PHD Paleativo</option>
          <option value="Cronico paleativo">Cronico paleativo</option>
          <option value="Paleativo">Paleativo</option>
          <option value="Ninguno">Ninguno</option>
  	  	</select>
  	  </article>
      <article class="col-xs-2">
  	  	<label for="">Zona Paciente:</label>
  	    <select class="form-control" name="zona_pac" required="">
  	  	  <option value=""></option>
          <option value="Zona IN">Zona IN</option>
          <option value="Soacha">Soacha</option>
          <option value="Sanitas evento">Sanitas evento</option>
          <option value="Ninguno">Ninguno</option>
  	  	</select>
  	  </article>
  	  <article class="col-xs-2">
  	  	<label for="">IPS que ordena:</label>
  	  	<input type="text" value="" name="ips_ordena"  class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required=""<?php echo $atributo2;?>/>
  	  </article>
  	  <article class="col-xs-2">
  	  	<label for="">Medico que ordena:</label>
  	  	<input type="text" value="" name="medico_ordena"  class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required=""<?php echo $atributo2;?>/>
  	  </article>
      <article class="col-xs-4">
  	  	<label for="">Seleccione EPS:</label>
  	  	<select name="eps" class="form-control" <?php echo atributo3; ?>>
  				<?php
  				$sql="SELECT id_eps,nom_eps from eps ORDER BY id_eps DESC";
  				if($tabla=$bd1->sub_tuplas($sql)){
  					foreach ($tabla as $fila2) {
  						if ($fila["id_eps"]==$fila2["id_eps"]){
  							$sw=' selected="selected"';
  						}else{
  							$sw="";
  						}
  					echo '<option value="'.$fila2["id_eps"].'"'.$sw.'>'.$fila2["nom_eps"].'</option>';
  					}
  				}
  				?>
  		  </select>
      </article>
      <article class="col-xs-7">
        <label for=""> </label>
        <p class="alert alert-danger animated bounceInRight"><span class="fa fa-info-circle"></span> RECUERDE: Todos los campos son obligatorios</p>
      </article>
  	  <article class="col-xs-12">
    		<?php include('dxindv.php');?>
    	</article>
    </section>
    <div class="row text-center">
		  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>
  </section>
</form>
