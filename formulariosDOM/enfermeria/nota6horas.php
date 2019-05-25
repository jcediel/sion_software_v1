<script src = "js_p/sha3.js"></script>
		<script>
			function validar(){

				if (document.forms[0].freg3.value > document.forms[0].hoy.value){
					alert("Enfermero(a): <?php echo $_SESSION["AUT"]["nombre"]?>, no no no, NO puede adelantar las fechas.");
					document.forms[0].freg3.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio=Domiciliarios&buscar=Buscar&opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel-heading">
    <h3><?php echo $titulo ?></h3>
  </section>
  <section class="panel-body">
    <section class="panel-body">
      <section class="col-md-6">
        <article class="col-md-12">
          <label for="">Fecha de Atención:</label>
          <input type="hidden" name="hoy" value="<?php echo date('Y-m-d') ?>">
          <input type="date" name="freg3" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo2;?> >
          <input type="hidden" name="idadmhosp" value="<?php echo $_GET["idadmhosp"] ;?>" class="form-control">
          <input type="hidden" name="idd" value="<?php echo $_GET["idd"] ;?>" class="form-control">
          <input type="hidden" name="aut" value="<?php echo $_GET["formato"] ;?>" class="form-control" <?php echo $atributo3;?> >
					<input type="hidden" name="v1" value="<?php echo $fila["finicio"] ;?>" class="form-control" <?php echo $atributo3;?> >
					<input type="hidden" name="v2" value="<?php echo $fila["ffinal"] ;?>" class="form-control" <?php echo $atributo3;?> >
        </article>
        <article class="col-md-12">
          <label for="">Hora de Atención:</label>
          <input type="time" name="hnota" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo3;?>>
          <input type="hidden" name="turno" value="<?php echo $_REQUEST['turno'] ;?>" class="form-control" <?php echo $atributo3;?>>

        </article>
      </section>
      <section class="col-md-6">
        <p class="alert alert-info animated bounceIn"><span class="fa fa-info fa-2x"></span> Recuerde: cuando escoge la hora hace referencia a la primera hora de su nota, adicional recuerde que el sistema calcula el resto de las horas a partir de la que escogió.  </p>
      </section>
      <section class="col-md-12 well">
        <h4 class="col-md-12 text-info">Registro enfermería</h4>
        <article class="col-md-4">
          <label for="">Hora 1 </label>
          <textarea class="form-control" name="nota1" rows="5" id="comment" required=""></textarea>
        </article>
        <article class="col-md-4">
          <label for="">Hora  2</label>
          <textarea class="form-control" name="nota2" rows="5" id="comment" required=""></textarea>
        </article>
        <article class="col-md-4">
          <label for="">Hora  3</label>
          <textarea class="form-control" name="nota3" rows="5" id="comment" required=""></textarea>
        </article>
        <article class="col-md-4">
          <label for="">Hora 4 </label>
          <textarea class="form-control" name="nota4" rows="5" id="comment" required=""></textarea>
        </article>
        <article class="col-md-4">
          <label for="">Hora  5</label>
          <textarea class="form-control" name="nota5" rows="5" id="comment" required=""></textarea>
        </article>
        <article class="col-md-4">
          <label for="">Hora  6</label>
          <textarea class="form-control" name="nota6" rows="5" id="comment" required=""></textarea>
        </article>
      </section>


      <section>
        <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?> Truno 6 horas" />
        <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
        <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
      </section>
  </section>
</form>
