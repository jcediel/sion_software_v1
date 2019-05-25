
<script src = "js/sha3.js"></script>
<script>
function validar(){
	if (document.forms[0].freg_food.value < document.forms[0].hoy.value){
		swal("<?php echo $_SESSION['AUT']['nombre']; ?>, USTED NO PUEDE SOLICITAR ALMUERZO  !!!","CUANDO LA FECHA ACTUAL ES MENOR A LA FECHA SELECCIONADA","error");
		document.forms[0].freg_food.focus();				// Ubicar el cursor
		return(false);
	}
	if (document.forms[0].freg_food.value > document.forms[0].hoy.value){
		swal("<?php echo $_SESSION['AUT']['nombre']; ?>, USTED NO PUEDE SOLICITAR ALMUERZO  !!!","CUANDO LA FECHA ACTUAL ES MAYOR A LA FECHA SELECCIONADA","error");
		document.forms[0].freg_food.focus();				// Ubicar el cursor
		return(false);
	}
}
</script>
<form action="<?php echo PROGRAMA.'?opcion=206';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="card col-md-5">
		<section class="card-header">
			<h2><?php echo $subtitulo; ?></h2>
		</section><br>
		<section class="panel-body">
			<section class="col-md-12">
				<section class="row">
					<article class="col-md-6">
						<label class="text-center">Seleccione la Fecha: </label><br>
						<input type="date" class="form-control" required name="freg_food" value="<?php echo date('Y-m-d') ?>" min="<?php echo date ('Y-m-d') ?> "/>
						<input type="hidden" class="form-control" required name="hoy" value="<?php echo date('Y-m-d') ?>"/>
					</article>
					<article class="col-md-6">
						<label class="text-center">Hora: </label><br>
						<input type="time" class="form-control" required name="hreg" value="<?php $h=date_default_timezone_set('America/Bogota'); echo  date('H:i');?>" readonly='readonly'/>
					</article>
				</section><br>
				<div class="panel-body text-center">
					<input type="hidden" required name="freg" value="<?php echo date('Y-m-d');?>"/>
					<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
					<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
					<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
				</div>
			</section>
		</section>
	</section>
</form>
	<section class="panel-body col-md-7">
			<?php
			$hoy=date('Y-m-d');
			$dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
			$fecha = $dias[date('N', strtotime($hoy))];
			?>
		<table class="table table-striped col-md-12"><br>
			<tr>
				<h3 class="text-primary text-center"><strong>El menú del día <?php $sd=saber_dia($hoy); ?> es:</strong></h3>
			</tr>
			<h5 class="text-center alert alert-danger"><strong>Recuerde que el menú puede cambiar,<br>estas son las posibles opciones que tienes hoy</strong></h5>
			<tr>
					<?php
					$sql_menu_food="SELECT id_menu_food, sopa_food, cereal_food, proteico_food, energetico_food, verdura_food, bebida_food, dia_food, semana_food
													FROM menu_food
													WHERE dia_food='$fecha'";
													//echo $sql_menu_food;
					if ($tablau=$bd1->sub_tuplas($sql_menu_food)){
						foreach ($tablau as $filau) {
							echo '<td class="col-md-3">';
								echo '<p><strong>Sopa: </strong>'.$filau['sopa_food'].'</p>';
								echo '<p><strong>Cereal: </strong>'.$filau['cereal_food'].'</p>';
								echo '<p><strong>Proteico: </strong>'.$filau['proteico_food'].'</p>';
								echo '<p><strong>Energetico: </strong>'.$filau['energetico_food'].'</p>';
								echo '<p><strong>Verdura: </strong>'.$filau['verdura_food'].'</p>';
								echo '<p><strong>Bebida: </strong>'.$filau['bebida_food'].'</p>';
							echo '</td>';
						}
					}
					 ?>
			</tr>
			</table>
			<table class="table table-striped">
			<tr  class="fuente_titulo_tabla"><br>
				<th class="text-center text-primary">DETALLE HISTORICO</th>
			</tr>
			<article class="col-md-12">
				<?php
				$user=$_SESSION['AUT']['id_user'];
				$sql_usuario="SELECT id_food, id_user, freg, hreg, freg_food, estado_food
				FROM food
				WHERE id_user=$user";
				$i=1;
				if ($tablau=$bd1->sub_tuplas($sql_usuario)){
					foreach ($tablau as $filau) {
						$ef=$filau['estado_food'];
						echo '<tr>';
						echo '<td>';
						echo '<p><strong>Fecha Solicitado: </strong>'.$filau['freg_food'].'</p>';
						if ($ef==1) {
							echo '<h5 class="alert alert-warning"><Strong>Estado:</Strong> Solicitado</h5>';
						}if ($ef==2) {
							echo '<h5 class="alert alert-success"><Strong>Estado:</Strong> Reclamado';
						}if ($ef==3) {
							echo '<h5 class="alert alert-danger"><Strong>Estado:</Strong> Cancelado';
						}
						echo '</td>';
					}
				}else {
					echo '<td>';
					echo '<p class="text-center alert alert-danger"><strong>Usted no ha realizado ningun pedido</strong></p>';
					echo '</td>';
				}?>
			</article>
		</table>
	</section>
