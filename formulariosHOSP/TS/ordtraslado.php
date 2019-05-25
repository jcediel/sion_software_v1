<form action="<?php echo PROGRAMA.'?opcion='.$opcion.'&buscar=Consultar&doc='.$doc.'';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
	  <?php
	    include("consulta_paciente.php");
	  ?>
	</section>
		<?php include("consulta_rapida.php");?>
		<section class="panel-body"> <!--Anamnesis-->
				<article class="col-xs-3">
					<input type="hidden" name="freg" value="<?php echo date('Y-m-d') ;?>" class="form-control" <?php echo $atributo1?> >
					<input type="hidden" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1?>>
					<?php
					$sqlq="SELECT a.id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil,
											 genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena,
											 c.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
											 b.id_ubipaciente idubi,b.id_cama idc,finicial,ffinal,
											 d.nom_cama,
											 e.nom_hab,
											 f.nom_pabellon,
											 g.nom_piso
								FROM pacientes a INNER JOIN adm_hospitalario c on a.id_paciente=c.id_paciente
																 LEFT JOIN ubipaciente b on b.id_adm_hosp=c.id_adm_hosp
																 LEFT JOIN cama d on d.id_cama=b.id_cama
																 LEFT JOIN habitacion e on e.id_habitacion=d.id_habitacion
																 LEFT JOIN pabellon f on f.id_pabellon=e.id_pabellon
																 LEFT JOIN piso g on g.id_piso=f.id_piso
								WHERE c.id_adm_hosp=$idadm and c.estado_adm_hosp='Activo' and b.ffinal is null" ;
								//echo $sqlq;
								if ($tablaq=$bd1->sub_tuplas($sqlq)){
									foreach ($tablaq as $filaq ) {
										echo'<input type="hidden" name="idu" value="'.$filaq['idubi'].'" class="form-control">';
										echo'<input type="hidden" name="f" value="'.$filaq['finicial'].'" class="form-control">';
									}
								}
					 ?>
				</article>
		</section>
		<section class="panel-body"> <!--Anamnesis-->
				<article class="col-xs-3">
					<label for="">Fecha:</label>
					<input type="date" name="fprog" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo2?> >
					<input type="text" name="idadmhosp" value="<?php echo $fila['id_adm_hosp'] ;?>" class="form-control" <?php echo $atributo2?> >
				</article>
				<article class="col-xs-2">
					<label for="">Hora:</label>
					<input type="time" name="hprog" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo2?>>
				</article>
				<article class="col-xs-4">
					<label for="">Seleccione Sede de Origen:</label>
					<select name="sedes" class="form-control" <?php echo atributo3; ?>>
						<?php
						$sql="SELECT id_sedes_ips,nom_sedes from sedes_ips where id_sedes_ips in (2,8) ORDER BY id_sedes_ips ASC";
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
				</article>
		</section>
		<section class="panel-body">

		</section>
		<section class="panel-body">
			<article class="col-xs-6">
				<label for="">Observacion de transporte:</label>
				<textarea class="form-control" name="mediots" rows="5" id="comment" ></textarea>
			</article>
			<article class="col-xs-6">
				<label for="">Observaciones del traslado:</label>
				<textarea class="form-control" name="obs_envio" rows="5" id="comment" ></textarea>
			</article>

		</section>

	<div class="row text-center">
	  	<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
