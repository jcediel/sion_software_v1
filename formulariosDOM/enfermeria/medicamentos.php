<script src = "js_p/sha3.js"></script>
		<script>
			function validar(){

				if (document.forms[0].freg.value > document.forms[0].hoy.value){
					alert("Enfermero(a): <?php echo $_SESSION["AUT"]["nombre"]?>, no no no, NO puede adelantar las fechas.");
					document.forms[0].freg.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio=Domiciliarios&buscar=Buscar&opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel-heading">
    <h3>Registro de medicamentos administrados</h3>
  </section>
  <section class="col-md-12 well">
    <section class="panel-body">
      <article class="col-md-6">
        <label for="">Fecha Registro:</label>
        <input type="hidden" name="hoy" value="<?php echo date('Y-m-d') ?>">
        <input type="date" name="freg" value="" class="form-control" <?php echo $atributo2;?> >
      </article>
      <article class="col-md-6">
        <label for="">Hora Registro:</label>
        <input type="time" name="hreg" class="form-control" value=""  required="">
        <input type="hidden" name="idd" value="<?php echo $_GET["idd"] ;?>" class="form-control"  >
        <input type="hidden" name="idadmhosp" value="<?php echo $_GET["idadmhosp"] ;?>" class="form-control" >
      </article>
    </section>
    <section class="panel-body">
      <article class="col-md-12">
        <?php include('medflash.php') ?>
      </article>
      <article class="col-md-2">
        <label for="">Vía Administración:</label>
        <select class="form-control" required name="via" >
          <option value=""></option>
          <option value="intravenosa">intravenosa</option>
          <option value="oral">oral</option>
          <option value="intramuscular">Intramuscular</option>
          <option value="sublingual">sublingual</option>
          <option value="topica">Topica</option>
          <option value="transdermica">Transdermica</option>
          <option value="oftalmica">Oftalmica</option>
          <option value="otica">Otica</option>
          <option value="intranasal">Intranasal</option>
          <option value="inhalatoria">Inhalatoria</option>
          <option value="rectal">Rectal</option>
          <option value="vaginal">Vaginal</option>
          <option value="subcutanea">Subcutanea</option>
          <option value="Gastro">Gastro</option>
        </select>
      </article>
      <article class="col-md-2">
        <label for="">Frecuencia:</label>
        <select class="form-control" name="frecuencia" required >
          <option value=""></option>
          <option value="24">24 Horas</option>
          <option value="12">12 Horas</option>
          <option value="8">8 Horas</option>
          <option value="6">6 Horas</option>
          <option value="4">4 Horas</option>
          <option value="3">3 Horas</option>
          <option value="2">2 Horas</option>
          <option value="1">1 Horas</option>
          <option value="A">A demanda</option>
          <option value="U">Unica dosis</option>
        </select>
      </article>
      <article class="col-md-2">
        <label for="">Dosis:</label>
        <input type="text" name="dosis" class="form-control" value="0"  required="">
      </article>

    </section>
    <section class="panel-body">
      <article class="col-md-12">
        <label for="">Observación:</label>
        <textarea name="obs_medicamento" rows="5" class="form-control"></textarea>
      </article>
    </section>

  </section>
  <section>
    <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
    <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
    <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
  </section>
</section>
</form>
