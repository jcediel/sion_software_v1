<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading">
     <h2><?php echo $subtitulo; ?></h2>
    </section>
    <section class="panel-body">
      <article class="col-md-4">
        <label for=""><?php echo  $fila['cups']?></label>
      </article>
      <article class="col-md-8">
        <label for=""><?php echo  $fila['procedimiento']?></label>
      </article>

    </section>
    <section class="panel-body">
      <article class="col-md-6">
        <label>Fecha registro:</label>
        <input type="text" class="form-control" name="freg" value="<?php echo date('Y-m-d') ?>"<?php echo $atributo1?>>
        <input type="hidden" class="form-control" name="idd" value="<?php echo $_REQUEST['idd'] ?>"<?php echo $atributo1?>>
      </article>
      <article class="col-md-6 text-center">
        <label>Tipo Bitacora:</label>
        <input type="text" class="form-control" name="tipo_bitacora" value="<?php echo $_GET['t'] ?>"<?php echo $atributo1?>>
      </article>
      <article class="col-md-12">
        <label for="">Describa aqui la situación:</label>
        <textarea name="descripcion_bitacora" class="form-control"  rows="8" cols="80"></textarea>
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
