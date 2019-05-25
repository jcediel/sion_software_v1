
<link rel="stylesheet" href="css/jquery-ui.css" media="screen" title="no title" charset="utf-8">
<script src="js/jquery-3.1.1.min.js" charset="utf-8"></script>
<script src="js/jquery-ui.min.js" charset="utf-8"></script>
<script type="text/javascript">
$('document').ready(function() {
    $('#buscarIPSexterna').autocomplete({
      source : 'busIPSexterna.php'
    });
  });
</script>
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$option;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading">
     <h2><?php echo $subtitulo; ?></h2>
    </section>
    <section class="panel-body">
      <article class="col-md-6">
        <label>Fecha registro:</label>
        <input type="text" class="form-control" name="f_realizacion" value="<?php echo date('Y-m-d') ?>"<?php echo $atributo1?>>
        <input type="hidden" class="form-control" name="freg" value="<?php echo date('Y-m-d') ?>"<?php echo $atributo1?>>
        <input type="hidden" class="form-control" name="idadmhosp" value="<?php echo $_REQUEST['idadm'] ?>"<?php echo $atributo1?>>
      </article>
      <article class="col-md-6">
        <label>Hora registro:</label>
        <input type="text" class="form-control" name="h_realizacion" value="<?php echo date('H:i') ?>"<?php echo $atributo1?>>
        <input type="hidden" class="form-control" name="hreg" value="<?php echo date('H:i') ?>"<?php echo $atributo1?>>
      </article>
    </section>
    <section class="panel-body">
      <article class="col-md-6">
        <label for="">Vivienda cuenta con servicios y medios de comunicación?</label>
        <select class="form-control" name="check_vivienda">
          <option value=""></option>
          <option value="1">SI</option>
          <option value="0">NO</option>
        </select>
      </article>
      <article class="col-md-3">
        <label for="">Accesibilidad al domicilio</label>
        <select class="form-control" name="check_vivienda">
          <option value=""></option>
          <option value="1">SI</option>
          <option value="0">NO</option>
        </select>
      </article>
      <article class="col-md-3">
        <label for="">Observación</label>
        <textarea name="obs_acceso_domicilio" class="form-control" rows="4"></textarea>
      </article>
    </section>
    <section class="panel-body">
      <?php include('dxindv.php') ?>
    </section>
    <section class="panel-body">
      <article class="col-md-6">
        <label for="">IPS donde se hace la visita:</label>
        <input type="text" name="ips_externa" class="form-control" value="" id="buscarIPSexterna" required="">
      </article>
      <article class="col-md-6">
        <label for="">Medico tratante </label>
        <input type="text" class="form-control" name="medico_remite" value="">
      </article>
    </section>
    <section class="panel-body">
      <article class="col-md-6">
        <label for="">Estado de conciencia del paciente:</label>
        <textarea name="estado_conciencia" class="form-control" rows="4"></textarea>
      </article>
      <article class="col-md-6">
        <label for="">Estado de conciencia del paciente:</label>
        <textarea name="estado_hemodinamico" class="form-control" rows="4"></textarea>
      </article>
      <article class="col-md-12">
        
      </article>
    </section>
    <section class="panel-body">
     <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
     <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
     <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
   </section>
 		</section>
  </form>
