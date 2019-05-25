<link rel="stylesheet" href="css/jquery-ui.css" media="screen" title="no title" charset="utf-8">
<script src="js/jquery-3.1.1.min.js" charset="utf-8"></script>
<script src="js/jquery-ui.min.js" charset="utf-8"></script>

<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Consultaropcion=19';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel panel-default">
	<section class="panel-heading">
		<h3><?php echo $subtitulo; ?></h3>
	</section>
	<section class="panel-body">
		<article class="col-xs-6">
      <label for="">Procedimiento de referencia:</label>
      <input type="text" name="cups" class="form-control" value="" id="buscarcups" required="">
      <input type="hidden" name="id_adm_hosp" class="form-control" value="<?php echo $fila['id_adm_hosp']?>">
		</article>
    <article class="col-xs-6">
      <p class="alert alert-success animated bounceInLeft"><strong>Doctor(a):</strong> Le recomendamos realizar el diligenciamiento de este campo de acuerdo a las opciones que le brinda el sistema. Absténgase de realizar escritura de un procedimiento que no se encuentre en base de datos, si tiene problemas comuníquese con soporte técnico.<br> <span class="fa fa-whatsapp text-success fa-2x"></span> 301 3034897</p>
		</article>
    <article class="col-xs-12">
      <label for="">Justificación del proceso de referencia:</label>
      <textarea name="justificacion" rows="5" class="form-control" required=""></textarea>
    </article>
	</section>
	<section class="col-xs-12">
		<input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
	  <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	  <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</section>
</section>
	</form>
