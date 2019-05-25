<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].hregevo.value > document.forms[0].hreg.value){
					alert("Profesional (a) <?php echo $_SESSION["AUT"]["nombre"]?>, NO puede adelantar el tiempo.");
					document.forms[0].hreg.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion='.$opcion.'';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
		<section class="panel-body">
			<?php include("consulta_paciente.php");?>
		</section>
		<section class="panel-body">
			<article class="col-xs-12">
				<?php include("consulta_rapida.php");?>
			</article>
		</section>
		<section class="panel-heading">
			<section class="panel-body">
				<article class="col-md-12">
					<?php include("alerta_fija/alert_alert.php");?>
				</article>
			</section>
		</section>
	<section class="panel-body"> <!--evolucion to-->
			<article class="col-xs-2">
				<label for="">Fecha de registro:</label>
				<input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1;?>>
				<input type="hidden" name="idadmhosp" value="<?php echo $fila['id_adm_hosp'];?>">
				<input type="hidden" name="fecha" value="<?php echo $date1;?>">
			</article>
			<article class="col-xs-2">
				<label for="">Hora de Evolucion</label>
				<input type="time" name="hregevo" value="<?php echo $date1 ;?>" class="form-control">
				<input type="hidden" name="hreg" value="<?php echo $date1 ;?>" class="form-control">
			</article>
			<article class="col-xs-4">
				<?php include("alerta_fija/alert_ubi_formula.php");?>
			</article>
			<article class="col-xs-4">
				<?php include("alerta_fija/alert_dieta.php");?>
			</article>
			<article class="col-xs-9">
				<label for="">Evolucion Nutricion:</label>
				<button type="button" class="fa fa-plus btn-danger"  onclick="verTexto18()" ></button>
				<textarea class="form-control" name="evoto" rows="6" required ></textarea>
			</article>

			<?php
			$id=$fila['id_adm_hosp'];
			$sql_datos="SELECT max(peso) peso, max(talla) talla FROM evo_nutrism WHERE id_adm_hosp=$id";
			if ($tabla_datos=$bd1->sub_tuplas($sql_datos)){
				foreach ($tabla_datos as $fila_datos) {
					?>
					<article class="col-xs-2">
						<label for="">Peso(Kg):</label>
						<input type="text" name="peso" value="<?php echo $fila_datos['peso'] ?>" class="form-control">
					</article>
					<article class="col-xs-2">
						<label for="">Talla(mts):</label>
						<input type="text" name="talla" value="<?php echo $fila_datos['talla'] ?>" class="form-control">
					</article>
					<?php
				}
			}
			 ?>
			 <article class="col-xs-12">
 				<label for="">Diagnostico Nutrición:</label>
 				<button type="button" class="fa fa-plus btn-danger"></button>
 				<textarea class="form-control" name="dx_nutrion" rows="6" required ></textarea>
 			</article>
	</section>
	<div class="row text-center">
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
