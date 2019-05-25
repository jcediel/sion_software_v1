<script src = "js_p/sha3.js"></script>
		<script>
			function validar(){

				if (document.forms[0].freg.value > document.forms[0].fecha1.value){
					swal("OJO TERAPEUTA !!! <?php echo $_SESSION["AUT"]["nombre"] ?>","NO NO NO puede adelantar fechas.","error")
					document.forms[0].freg.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].freg.value < document.forms[0].v1.value){

					swal("OJO TERAPEUTA !!! <?php echo $_SESSION["AUT"]["nombre"] ?>","la fecha de la evolución no puede ser MENOR a la fecha de inicio de la vigencia del servicio.","error")
					document.forms[0].freg.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].freg.value > document.forms[0].v2.value){
					swal("OJO TERAPEUTA !!! <?php echo $_SESSION["AUT"]["nombre"] ?>","la fecha de la evolución no puede ser MAYOR a la fecha de finalización de la vigencia del servicio.","error")
					document.forms[0].freg.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion=105';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
	  <?php
	    include("consulta_paciente.php");
	  ?>
	</section>
	<article>
		<h4 id="th-estilot"><?php echo $subtitulo ?></h4>
<?php include("consulta_rapidaDOM.php");?>

	<section class="panel-body"> <!--evolucion to-->
			<article class="col-md-3">
				<label for="">Fecha de registro:</label>
				<input type="date" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo2;?>>
				<input type="hidden" name="fecha1" value="<?php echo $date;?>">
				<input type="hidden" name="fregreg" value="<?php echo date('Y-m-d H:m:s') ;?>" class="form-control" <?php echo $atributo2;?>>
				<input type="hidden" name="idadmhosp" value="<?php echo $fila['id_adm_hosp'];?>">
				<input type="hidden" name="idd" value="<?php echo $_GET['idd'];?>">
			</article>
			<article class="col-md-3">
				<label for="">Hora de Evolucion</label>
				<input type="time" required name="hregevo" value="" class="form-control">
				<input type="hidden" name="hreg" value="<?php echo $date1 ;?>" class="form-control">
        <input type="hidden" name="intervalo" value="<?php echo $_GET['t'];?>" class="form-control">
			</article>
			<article class="col-md-8">
				<label for="">Evolucion Nutricion:</label>
				<textarea class="form-control" name="evoto" rows="15" id="respuesta18" required ></textarea>
			</article>
			<article class="col-md-4">
				<h3 class="text-danger">INFORMACIÓN DE AUTORIZACIÓN</h3>
				<?php
				$d_procedimiento=$_GET['idd'];
				$sql_autorizado="SELECT id_d_aut_dom, id_m_aut_dom, resp_d_aut_dom, freg, cups,
											procedimiento, cantidad, finicio, ffinal, num_aut_externa,
											resp_inicial_num, estado_d_aut_dom, intervalo, temporalidad,
											dosis, frecuencia, succion, profesional, f_prof, f_cancela,
											resp_cancela, justificacion_cancela, resp_ext, justificacion_ext
							FROM d_aut_dom
							WHERE id_d_aut_dom=$d_procedimiento";
							if ($tabla_autorizado=$bd1->sub_tuplas($sql_autorizado)){
								foreach ($tabla_autorizado as $fila_autorizado) {
									?>
									<p><strong>Procedimiento: </strong><?php echo $fila_autorizado['procedimiento'] ?></p>
									<p class="text-primary"><strong>Cantidad Autorizada: </strong><span class="lead"><?php echo $fila_autorizado['cantidad'] ?></span></p>
									<p><strong>Vigencia : </strong><?php echo $fila_autorizado['finicio'].' - '.$fila_autorizado['ffinal'] ?></p>
									<input type="hidden" name="v1" value="<?php echo $fila_autorizado['finicio']; ?>">
									<input type="hidden" name="v2" value="<?php echo $fila_autorizado['ffinal']; ?>">
									<?php
								}
							}
				 ?>
				 <?php
				$d_procedimiento=$_GET['idd'];
				$sql_realizado="SELECT count(id_d_aut_dom) cuantos
							FROM evo_nutri_dom
							WHERE id_d_aut_dom=$d_procedimiento and estado_evonutri_dom='Realizada'";
							if ($tabla_realizado=$bd1->sub_tuplas($sql_realizado)){
								foreach ($tabla_realizado as $fila_realizado) {
									?>
									<p class="text-danger"><strong>Hasta el momento USTED ha realizado: </strong><span class="lead"><?php echo $fila_realizado['cuantos'] ?></span></p>
									<?php
								}
							}
				 ?>
			</article>
		</section>
	<div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
