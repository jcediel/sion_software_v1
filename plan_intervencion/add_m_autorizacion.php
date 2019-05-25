<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].finicial.value > document.forms[0].ffinal.value){
					alert("No es posible que la fecha final sea menor a la fecha inicial.");
					document.forms[0].ffinal.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?opcion=31&idadm='.$idadm.'&servicio='.$servicio.'&doc='.$doc;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel panel-default">
	<section class="panel-heading">
		<h3><?php echo $subtitulo; ?></h3>
	</section>
	<section class="panel-body">
		<article class="col-xs-3">
		  <label for="">Fecha Inicial:</label>
      <input type="date" class="form-control" name="finicial" value="">
      <input type="hidden" class="form-control" name="id_adm_hosp" value="<?php echo $_REQUEST['idadm'];?>">
		</article>
    <article class="col-xs-3">
		  <label for="">Fecha Final:</label>
      <input type="date" class="form-control" name="ffinal" value="">
		</article>
    <article class="col-xs-2">
      <label for=""># autorización:</label>
      <input type="text" class="form-control" name="num_autori" value="">
		</article>
		<article class="col-xs-3">
			<label for="">Tipo numero autorización:</label>
			<select class="form-control" required="" name="tipo_num_autori">
				<option class="text-primary" value="<?php echo $fila['tipo_num_autori']; ?>"><?php echo $fila['tipo_num_autori']; ?></option>
				<option value="PROPIO">PROPIO</option>
				<option value="EPS">EPS</option>
			</select>
		</article>
    <article class="col-xs-6">
      <label for="">Servicio:</label>
      <input type="text" name="tipo_servicio" class="form-control text-center text-primary" value="<?php echo $_REQUEST['servicio'];?>" <?php echo $atributo1 ?>>
    </article>
	</section>
  <?php include('dxindv.php') ?>
	<section class="col-xs-12">
		<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
	  <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	  <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</section>
</section>
	</form>
