<script src = "js_p/sha3.js"></script>
		<script>
			function validar(){

				if (document.forms[0].sesion_asignada.value > document.forms[0].cantidad_autorizada.value){
					alert(" <?php echo $_SESSION["AUT"]["nombre"]?>, NO puede asignar más sesiones de las autorizadas.");
					document.forms[0].sesion_asignada.focus();			// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel panel-default">
  <section class="panel-heading">
    <h3><?php echo $subtitulo ?></h3>
  </section>
	<section class="panel-body">
		<input type="hidden" name="id_d_aut_dom" value="<?php echo $fila['id_d_aut_dom'] ?>">
		<?php
		$tipo_paciente=$fila['tipo_paciente'];
		if ($tipo_paciente!=1) {
			$obligatorio='required=""';
			?>
			<article class="col-md-12 alert alert-danger">
				<p> <span class="fa fa-info-circle"></span> Recuerde que cuando el paciente NO es CRONICO,debe diligenciar de manera obligatoria el numero de autorizacion</p>
			</article>
			<article class="col-md-12">
				<label for="">Registre aqui el número de autorizacion correspondiente al procedmiento</label>
				<input type="text" class="form-control" name="num_aut_externa"<?php echo $obligatorio ?> value="">
			</article>
			<?php
		}else {
			?>
			<article class="col-md-12 alert alert-danger">
				<p> <span class="fa fa-info-circle"></span> Recuerde que este paciente en un paciente CRONICO, debe considerar q el campo siguiente puede esperar a ser diligenciado</p>
			</article>
			<article class="col-md-12">
				<label for="">Registre aqui el número de autorizacion correspondiente al procedmiento</label>
				<input type="text" class="form-control" name="num_aut_externa" value="">
			</article>
			<?php
		}
		 ?>

	</section>
	<div class="row text-center">
		<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
</section>
</form>
