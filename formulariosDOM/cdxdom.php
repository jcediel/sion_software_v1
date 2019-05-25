<form action="<?php echo PROGRAMA.'?fecha1='.$f1.'&fecha2='.$f2.'&doc='.$ident.'&buscar=Consultar&opcion=78';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading">
      <h2>Actualización de Diagnostico</h2>
    </section>
    <section class="panel-body">
      <input type="hidden" name="id_paciente" value="<?php echo $fila['id_paciente']; ?>">
      <?php include('dxindv.php');?>
    </section>
    <div class="row text-center">
  	  	<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
  		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
  		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
  	</div>
  </section>
</form>
