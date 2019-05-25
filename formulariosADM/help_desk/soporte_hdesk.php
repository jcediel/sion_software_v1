<form action="<?php echo PROGRAMA.'?opcion=199';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
 <section class="panel panel-default">
	 <section class="panel-heading">
	 	<h2><?php echo $subtitulo; ?></h2>
	 </section>
	 <section class="panel-body">
     <article class="col-md-4">
      <label for="">Nombre Soporte</label>
      <input type="text" name="nombre_soporte" class="form-control" value="<?php $i=$_REQUEST['id']; echo $i.'cod'.date('Y-m-d') ?>" <?php echo $atributo1 ?>>
      <input type="hidden" name="id_hdesk" class="form-control" value="<?php $i=$_REQUEST['id']; echo $i ?>" >
     </article>
     <article class="col-md-4">
      <label for="">Fecha registro</label>
      <input type="text" name="freg_hdesk" class="form-control" value="<?php echo date('Y-m-d') ?>" <?php echo $atributo1 ?>>
     </article>
     <article class="col-md-4">
      <label for="">Hora Registro</label>
      <input type="text" name="hreg_hdesk" class="form-control" value="<?php echo date('H:i') ?>" <?php echo $atributo1 ?>>
     </article>
     <article class="col-md-12">
       <label>Suba aqui el documento:</label>
       <?php echo $fila["soporte_hdesk"];?><br>
       <input type="file" class="form-control" name="soporte_hdesk" <?php echo $atributo3; ?>/>
     </article>
	 </section>
 </section>
 <div class="row text-center">
	 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />

	 <input type="submit" class="btn btn-danger" name="aceptar" Value="Descartar"/>
	 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
	 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
 </div>
		</section>
	</form>
