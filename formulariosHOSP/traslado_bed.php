<form action="<?php echo PROGRAMA.'?opcion=161&idadmhosp='.$return.'&sede='.$return1.'&doc='.$return2;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
		<?php
			include("consulta_paciente.php");
		?>
	</section>
  <section class="panel-body"> <!--notas de enfermeria-->
		<article class="col-xs-1">
			<label for="">ID</label>
			<input type="text" class="form-control" name="id_ubipaciente" value="<?php echo $_GET['idubi'];?>" <?php echo $atributo1; ?>>
			<input type="hidden" class="form-control" name="id_cama" value="<?php echo $_GET['idc'];?>">
			<input type="hidden" class="form-control" name="hab" value="<?php echo $fila['nom_hab'].'--'.$fila['nom_cama'];?>">
		</article>
    <article class="col-xs-3">
      <label for="">Fecha Final:</label>
      <input type="date" name="ffinal" required="" value="<?php echo date('Y-m-d');?>" class="form-control" <?php echo $atributo1 ;?>>
			<input type="date" name="finicial" required="" value="<?php echo $fila['finicial'];?>" class="form-control" <?php echo $atributo1 ;?>>
    </article>
		<article class="col-xs-8">
			<p class="alert alert-warning fa fa-warning lead">
				Se encuentra realizando traslado de cama del paciente <strong><?php echo $fila['nom1'].' '.$fila['nom2'].' '.$fila['ape1'].' '.$fila['ape2'];?></strong>, Ubicado en
				<strong><?php echo $fila['nom_piso'].' PABELLON: '.$fila['nom_pabellon'].' HABITACIÓN: '.$fila['nom_hab'].'--'.$fila['nom_cama'] ;?></strong>.
				Jefe: <?php echo $_SESSION['AUT']['nombre'] ?>, recuerde que la fecha final del traslado es vital para el registro de estancia del paciente.
			</p>
		</article>
  </section>

  <div class="row text-center">
    <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
	  <input type="submit" class="btn btn-primary" name="aceptar" Value="Descartar"/>
	  <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	  <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
  </div>
</section>
</form>
