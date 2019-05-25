<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].hreg.value > document.forms[0].hoy.value){
					alert("Psicologo(a) <?php echo $_SESSION["AUT"]["nombre"]?>, NO puede adelantar el tiempo.");
					document.forms[0].hreg.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion='.$opcion.'';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-body">
      <?php
        include("consulta_paciente.php");
      ?>
    </section>
    <section class="panel-heading">
      <h4>Valoración inicial Psicología en <?php echo $_REQUEST['servicio'] ?></h4>
    </section>
    <section class="panel-body">
      <article class="col-xs-3">
        <label for="">Fecha de registro:</label>
        <input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1;?> >
        <input type="hidden" name="idadmhosp" value="<?php echo $_GET["idadmhosp"] ;?>" class="form-control" <?php echo $atributo1;?> >
      </article>
      <article class="col-xs-3">
        <label for="">Hora de registro</label>
        <input type="time" name="hreg" value="<?php echo $date1 ;?>" class="form-control" >
        <input type="hidden" name="hoy" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1;?>>
      </article>
    </section>
    <section class="panel-body">
      <article class="col-xs-6">
        <label for="">Motivo de consulta: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
        <textarea class="form-control" name="motivo_consulta" rows="5" id="comment" ></textarea>
      </article>
      <article class="col-xs-6">
        <label for="" >Historia Familiar y Personal: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
        <textarea class="form-control" name="hfamiliar_personal" rows="5" id="comment" ></textarea>
      </article>

      <article class="col-xs-6">
        <label for="">Evaluación psicologica: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
        <textarea class="form-control" name="evaluacion_psico" rows="6" id="comment" ></textarea>
      </article>
      <article class="col-xs-6">
        <label for="">Analisis del caso: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
        <textarea class="form-control" name="analisis_caso" rows="6" id="comment" ></textarea>
      </article>
      <article class="col-xs-6">
        <label for="">Recomendaciones: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
        <textarea class="form-control" name="recomendaciones" rows="6" id="comment" ></textarea>
      </article>
    </section>
    <div class="row text-center">
      <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
      <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
      <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
    </div>
  </section>
</form>
