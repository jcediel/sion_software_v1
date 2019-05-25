<form action="<?php echo PROGRAMA.'?f1='.$return.'&f2='.$return1.'&buscar=Consultar&opcion=176';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">

  <section class="panel-body">

    <article class="col-xs-5">
      <input type="hidden" name="id_master_prod" value="<?php echo $fila["id_master_prod"];?>">
      <label for="">Fecha registro:</label>
      <input type="text" name="fecha" value="<?php echo date('Y-m-d');?>">
      <input type="text" name="idd" value="<?php echo $_REQUEST['idd'];?>">
  </article>
  <article class="col-xs-6">
    <label>Suba aqui el documento:</label>
    <?php echo $fila["foto"];?><br>
    <input type="file" class="form-control" name="archivo" <?php echo $atributo3; ?>/>
  </article>
  </section>
  <div class="row text-center">
    <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
    <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
    <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
  </div>
</section>
</form>
