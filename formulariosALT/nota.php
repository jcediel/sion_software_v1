<form action="<?php echo PROGRAMA.'?opcion=100&rpt='.$return1;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
		<?php
			include("consulta_paciente.php");
		?>
	</section>
<article>
  <h4 id="th-estilot">Registro Notas de enfermería</h4>
  <?php include("consulta_rapida.php");?>
	<section class="panel-body">
		<section class="col-xs-3 well">
			<article class="col-xs-12">
				<label for="">Fecha de registro:</label>
		    <input type="date" name="freg" value="<?php echo $_REQUEST['fecha'];?>" class="form-control" <?php echo $atributo2?> >
				<input type="hidden" name="idadmhosp" value="<?php echo $fila['id_adm_hosp'];?>">
			</article>
			<article class="col-xs-12">
				<label for="">Hora de registro</label>
				<input type="time" name="hreg" value="<?php echo $date1;?>" class="form-control">
			</article>
		</section>
	</section>
<section class="panel-body"> <!--notas de enfermeria-->
  <article class="col-xs-10">
    <label for="">Descripción Nota Enfermería:</label>
    <textarea class="form-control" name="notaenfermeria" rows="10" id="comment" required=""></textarea>
  </article>
</section>
<div class="row text-center">
  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
<input type="reset" class="btn btn-primary" Value="Reestablecer"/>
<input type="submit" class="btn btn-primary" name="aceptar" Value="Descartar"/>
<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
</div>
</section>
</form>
