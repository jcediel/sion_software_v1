<script src = "js_p/sha3.js"></script>
		<script>
			function validar(){

				if (document.forms[0].freg_sv.value > document.forms[0].hoy.value){
					alert("Enfermero(a): <?php echo $_SESSION["AUT"]["nombre"]?>, no no no, NO puede adelantar las fechas.");
					document.forms[0].freg_sv.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio=Domiciliarios&buscar=Buscar&opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel-heading">
    <h3>Registro de signos vitales</h3>
  </section>
  <section class="col-md-12 well">
    <h4 class="col-md-12 text-info">Signos vitales</h4>
    <article class="col-md-6">
      <label for="">Fecha Registro:</label>
      <input type="hidden" name="hoy" value="<?php echo date('Y-m-d') ?>">
      <input type="date" name="freg_sv" value="" class="form-control" <?php echo $atributo2;?> >
    </article>
    <article class="col-md-6">
      <label for="">Hora Registro:</label>
      <input type="time" name="hreg_sv" class="form-control" value=""  required="">
      <input type="hidden" name="idd" value="<?php echo $_GET["idd"] ;?>" class="form-control"  >
      <input type="hidden" name="idadmhosp" value="<?php echo $_GET["idadmhosp"] ;?>" class="form-control"  >
    </article>
    <article class="col-md-1">
      <label for="">TAS:</label>
      <input type="text" name="tas_s" class="form-control" value=""  required="">
    </article>
    <article class="col-md-1">
      <label for="">TAD:</label>
      <input type="text" name="tad_s" class="form-control" value=""  required="">
    </article>
    <article class="col-md-1">
      <label for="">FC:</label>
      <input type="text" name="fc_s" class="form-control" value=""  required="">
    </article>
    <article class="col-md-1">
      <label for="">FR:</label>
      <input type="text" name="fr_s" class="form-control" value=""  required="">
    </article>
    <article class="col-md-1">
      <label for="">Temp:</label>
      <input type="text" name="temp_s" class="form-control" value=""  required="">
    </article>
    <article class="col-md-1">
      <label for="">SpO2:</label>
      <input type="text" name="spo_s" class="form-control" value=""  >
    </article>
    <article class="col-md-2">
      <label for="">Glucometria:</label>
      <input type="text" class="form-control" name="glucometria" value="" >
    </article>
  </section>
  <section class="panel-body">
    <article class="col-md-12">
      <label for="">Observación:</label>
      <textarea name="obs_signos"class="form-control" rows="5" ></textarea>
    </article>
  </section>
  <section>
    <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
    <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
    <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
  </section>
</section>
</form>
