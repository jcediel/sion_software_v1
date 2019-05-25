<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading">
     <h2><?php echo $subtitulo; ?></h2>
    </section>

    <section class="panel-body">
      <article class="col-md-6">
        <label>Seleccione fecha :</label>
        <input type="date" class="form-control" name="freg" value="" >
        <input type="hidden" class="form-control" name="idd" value="<?php echo $_REQUEST['idd'] ?>"<?php echo $atributo1?>>
      </article>
    </section>
    <section class="panel-body">
     <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />

     <input type="submit" class="btn btn-danger" name="aceptar" Value="Descartar"/>
     <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
     <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
   </section>
 		</section>
  </form>
