<form action="<?php echo PROGRAMA.'?&opcion=19';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel panel-default">
	<section class="panel-heading">
		<h3><?php echo $subtitulo; ?></h3>
	</section>
	<section class="panel-body">
		<article class="col-xs-2">
			<label for="">ADM:</label>
			<input type="text" class="form-control" name="id_adm_hosp" value="<?php echo $fila['id_adm_hosp'];?>">
		</article>
		<article class="col-xs-4">
			<label for="">Seleccione Medico tratante:</label>
      <select name="tratante_hosp" value="<?php echo $fila["tratante_hosp"];?>" class="form-control" <?php echo atributo3; ?> required="">
        <option value="<?php echo $fila['tratante_hosp'];?>"><?php echo $fila['tratante_hosp'];?></option>
        <?php
        $sql="SELECT id_user,nombre from user WHERE id_perfil=3 and estado='Activo' ORDER BY id_user DESC";
        if($tabla=$bd1->sub_tuplas($sql)){
          foreach ($tabla as $fila2) {
            if ($fila["nombre"]==$fila2["nombre"]){
              $sw=' selected="selected"';
            }else{
              $sw="";
            }
          echo '<option value="'.$fila2["nombre"].'"'.$sw.'>'.$fila2["nombre"].'</option>';
          }
        }
        ?>
      </select>
		</article>
	</section>
	<section class="col-xs-12">
		<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
	  <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	  <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</section>
</section>
	</form>
