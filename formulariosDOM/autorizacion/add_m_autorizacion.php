
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
<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading">
     <h2><?php echo $subtitulo; ?></h2>
    </section>
    <section class="panel-body">
     <?php include('consulta_paciente.php') ?>
    </section>
    <section class="panel-body">
      <section class="col-md-12">
        <section class="row">
          <article class="col-md-3">
            <label for="">Tipo paciente:</label>
            <input type="hidden" name="idadm" value="<?php echo $_REQUEST['idadm']?>">
            <select name="tipo_paciente" class="form-control" <?php echo atributo3; ?> required="">
              <option value=""></option>
              <?php
              $sql="SELECT id_cusuario,nomclaseusuario from clase_usuario ORDER BY id_cusuario ASC";
              if($tabla=$bd1->sub_tuplas($sql)){
                foreach ($tabla as $fila2) {
                  if ($fila["id_cusuario"]==$fila2["id_cusuario"]){
                    $sw=' selected="selected"';
                  }else{
                    $sw="";
                  }
                echo '<option value="'.$fila2["id_cusuario"].'"'.$sw.'>'.$fila2["nomclaseusuario"].'</option>';
                }
              }
              ?>
            </select>
          </article>
          <?php
          $eps=$fila['ideps'];
          if ($eps==13) {
            ?>
            <article class="col-md-3">
              <label for="">Zona Paciente:</label>
              <select name="zona_paciente" class="form-control" required="">
                <option value=""></option>
                <option value="ZonaIn">Zona In</option>
                <option value="Evento">Evento</option>
              </select>
            </article>
            <article class="col-md-3">
              <label for=""># Radicacion:</label>
              <input type="text" class="form-control" name="num_radica_sanitas" value="" required="">
            </article>
            <article class="col-md-3">
              <label for="">Fecha Orden:</label>
              <input type="date" class="form-control" name="fecha_radicacion" value="" required="">
            </article>
            <article class="col-md-2">
              <label for="">Vigencia en meses:</label>
              <input type="number" class="form-control" name="vigencia_meses" value="" required="">
            </article>
            <?php
          }else {
            ?>
            <input type="hidden" name="zona_paciente" value="Ninguna">
            <input type="hidden" name="num_radica_sanitas" value="">
            <input type="hidden" name="fecha_radicacion" value="">
            <?php
          }
           ?>
          <article class="col-md-6">
            <label for="">IPS Ordena:</label>
            <input type="text" name="ips_externa" class="form-control" value="" id="buscarIPSexterna" required="">
          </article>

          <article class="col-md-4">
            <label for="">Medico Ordena:</label>
            <input type="text" class="form-control" required name="medico_ordena" value="">
          </article>
        </section>
      </section>
      <section class="panel-body">
        <article class="col-md-12">
         <?php include('dxindv.php');?>
       </article>
      </section>
      <section class="col-md-12 text-right">
        <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" /><br>
        <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
        <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
      </section>
    </section>
  </section>
</form>
