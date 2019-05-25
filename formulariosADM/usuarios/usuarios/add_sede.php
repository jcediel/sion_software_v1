
<form action="<?php echo PROGRAMA.'?ident='.$doc.'&buscar=Consultar&opcion=1';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="card col-md-6">
		<section class="card-header">
			<h2><?php echo $subtitulo; ?></h2>
		</section><br>
		<section class="panel-body">
			<section class="col-md-12">
				<section class="row">
          <article class="col-md-12">
                <label class="text-center">Sede: <strong class="text-danger">*</strong></label><br>
                <select name="tsede" class="form-control" <?php echo atributo3; ?>>
                  <option value="<?php echo $fila["tsede"];?>"><?php echo $fila["tsede"];?></option>
                  <?php
                  $sql="SELECT id_sedes_ips,nom_sedes from sedes_ips ORDER BY id_sedes_ips ASC";
                  if($tabla=$bd1->sub_tuplas($sql)){
                    foreach ($tabla as $fila2) {
                      if ($fila["id_sedes_ips"]==$fila2["id_sedes_ips"]){
                        $sw=' selected="selected"';
                      }else{
                        $sw="";
                      }
                      echo '<option value="'.$fila2["id_sedes_ips"].'"'.$sw.'>'.$fila2["nom_sedes"].'</option>';
                    }
                  }
                  ?>
                </select>
                <input type="hidden" name="idu" value="<?php echo $fila['id_user']?>">
              </article>
				</section><br>
				<div class="panel-body text-center">
          <input type="hidden" name="idu" value="<?php echo $fila['id_user']?>">
					<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
					<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
					<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
				</div>
			</section>
		</section>
	</section>
	<section class="panel-body col-md-6">
			<section class="panel panel-primary">
				<section class="panel-heading text-center">
					<h4><strong>SEDES REGISTRADAS</strong></h4>
				</section>
				<section class="panel-body">
					<?php
					$user=$fila['id_user'];
					$sql_user_sede="SELECT id_aux_us, ax.id_user, ax.id_sede, us.nombre, us.cuenta, sd.nom_sedes, us.doc, us.estado
													FROM aux_user_sedes ax
													 INNER JOIN user us on ax.id_user=us.id_user
													 INNER JOIN sedes_ips sd on ax.id_sede=sd.id_sedes_ips
													WHERE ax.id_user=$user order by id_sedes_ips asc";
												$i=1;
													//echo $sql_user_sede;
			 if ($tabla_sede=$bd1->sub_tuplas($sql_user_sede)){
							foreach ($tabla_sede as $fila_sede) {
						 echo' <p class="text-left"><strong>'.$i++.'.</strong> '.$fila_sede['nom_sedes'].'</p>';
						 }
					 }else {
						 echo 'Este usuario no tienes sedes asignadas';
					 }
				 ?>
				</section>
		 </section>
	</section>
</form>
