<script src = "js_p/sha3.js"></script>
		<script>
			function validar(){

				if (document.forms[0].freg3.value > document.forms[0].hoy.value){
					alert("Enfermero(a): <?php echo $_SESSION["AUT"]["nombre"]?>, no no no, NO puede adelantar las fechas.");
					document.forms[0].freg3.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].freg3.value < document.forms[0].v1.value){
					alert("Enfermero(a): <?php echo $_SESSION["AUT"]["nombre"]?>, Esta fecha es MENOR a la fecha de inicio de la autorizacion.");
					document.forms[0].freg3.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].freg3.value > document.forms[0].v2.value){
					alert("Enfermero(a): <?php echo $_SESSION["AUT"]["nombre"]?>, Esta fecha es MAYOR a la fecha de inicio de la autorizacion.");
					document.forms[0].freg3.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio=Domiciliarios&buscar=Buscar&opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel-heading">
    <h3>Formato de registro enfermería Turno 12 horas</h3>
  </section>
  <section class="panel-body">
    <section class="panel-body">
      <section class="col-md-6 ">
        <article class="col-md-12">
          <label for="">Fecha de Atención:</label>
          <input type="hidden" name="hoy" value="<?php echo date('Y-m-d') ?>">
          <input type="date" name="freg3" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo2;?> >
          <input type="hidden" name="idadmhosp" value="<?php echo $_GET["idadmhosp"] ;?>" class="form-control" >
          <input type="hidden" name="idd" value="<?php echo $_GET["idd"] ;?>" class="form-control" >
          <input type="hidden" name="aut" value="<?php echo $_GET["formato"] ;?>" class="form-control" <?php echo $atributo3;?> >
					<input type="hidden" name="v1" value="<?php echo $fila["finicio"] ;?>" class="form-control" <?php echo $atributo3;?> >
					<input type="hidden" name="v2" value="<?php echo $fila["ffinal"] ;?>" class="form-control" <?php echo $atributo3;?> >
        </article>
        <article class="col-md-12">

          <label for="">Hora de Atención:</label>
					<?php
					$tipo=$_GET['tipo'];
					$turn=$_GET['turno'];
					if ($turn==24) {
						if ($tipo==D) {
							?>
							<select class="form-control" required="" name="hnota">
								<option value=""></option>
								<option value="06:00">06:00</option>
								<option value="07:00">07:00</option>
								<option value="08:00">08:00</option>
							</select>
							<input type="hidden" name="turno" value="<?php echo $_GET['turno'] ;?>" class="form-control">
		          <input type="hidden" name="tipo" value="<?php echo $_REQUEST['tipo'] ;?>" class="form-control">
							<?php
						}
						if ($tipo==N) {
							?>
							<select class="form-control" required="" name="hnota">
								<option value=""></option>
								<option value="18:00">18:00</option>
								<option value="19:00">19:00</option>
								<option value="20:00">20:00</option>
							</select>
							<input type="hidden" name="turno" value="<?php echo $_GET['turno'] ;?>" class="form-control">
		          <input type="hidden" name="tipo" value="<?php echo $_REQUEST['tipo'] ;?>" class="form-control">
							<?php
						}
					}else {
						?>
						<input type="time" name="hnota" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo3;?>>
						<input type="hidden" name="turno" value="<?php echo $_GET['turno'] ;?>" class="form-control">
	          <input type="hidden" name="tipo" value="<?php echo $_REQUEST['tipo'] ;?>" class="form-control">
						<?php
					}

					 ?>

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
        <article class="col-md-4">
          <label for="">Hora  7</label>
          <textarea class="form-control" name="nota7" rows="5" id="comment" required=""></textarea>
        </article>
        <article class="col-md-4">
          <label for="">Hora  8</label>
          <textarea class="form-control" name="nota8" rows="5" id="comment" required=""></textarea>
        </article>
        <article class="col-md-4">
          <label for="">Hora  9</label>
          <textarea class="form-control" name="nota9" rows="5" id="comment" required=""></textarea>
        </article>
        <article class="col-md-4">
          <label for="">Hora  10</label>
          <textarea class="form-control" name="nota10" rows="5" id="comment" required=""></textarea>
        </article>
        <article class="col-md-4">
          <label for="">Hora  11</label>
          <textarea class="form-control" name="nota11" rows="5" id="comment" required=""></textarea>
        </article>
        <article class="col-md-4">
          <label for="">Hora  12</label>
          <textarea class="form-control" name="nota12" rows="5" id="comment" required=""></textarea>
        </article>
      </section>

      <section class="panel-body">
        <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?> Truno 12 horas" />
        <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
        <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
      </section>
  </section>
</form>
