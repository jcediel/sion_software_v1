<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Buscar&opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="card">
    <section class="card-header">
     <h2><?php echo $subtitulo; ?></h2>
    </section>
	 <section class="row card-body">
     <article class="col-sm-5">
       <input type="hidden" name="id_referencia" value="<?php echo $_REQUEST['idref'];?>">
       <label for="">Fecha y hora:</label>
       <input type="text" class="form-control" name="freg_bitacora" value="<?php echo date('Y-m-d')?>" <?php echo $atributo1 ?>>
       <input type="text" class="form-control" name="hreg_bitacora" value="<?php echo date('H:i')?>" <?php echo $atributo1 ?>>
     </article>
     <article class="col-sm-6">
       <label>Realice AQUI descripción del registro de bitacora: </label>
       <textarea name="bitacora" class="form-control" rows="8" cols="80"></textarea>
     </article>
	 </section>
   <div class="row card-body">
  	 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
  	 <input type="submit" class="btn btn-danger" name="aceptar" Value="Descartar"/>
  	 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
  	 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
   </div>
 </section>
	</form>
