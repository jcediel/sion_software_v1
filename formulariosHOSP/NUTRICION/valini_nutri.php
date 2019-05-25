<form action="<?php echo PROGRAMA;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel-body">
  <?php
    include("consulta_paciente.php");
  ?>
</section>
<article>
  <h4 id="th-estilot">Datos de Valoracion Nutricional</h4>
  <?php include("consulta_rapida.php");?>

<section class="panel-body"> <!--Anamnesis-->
  <div class="botonhc">
      <a data-toggle="collapse" class="ac" data-target="#valpsicologia" >Valoración Inicial Nutrición</a>
      <span class="glyphicon glyphicon-arrow-down"></span>
      <span class="badge">OK</span>
  </div>
  <section class="collapse" id="valpsicologia">
    <article class="col-xs-3">
      <label for="">Fecha de registro:</label>
      <input type="text" name="freg_nutri" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1?> >
    </article>
    <article class="col-xs-3">
      <label for="">Hora de registro</label>
      <input type="text" name="hreg_nutri" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1?>>
    </article>
    <article class="col-xs-10">
      <label for="">Motivo de Consulta:</label>
      <textarea class="form-control" name="motivonutri" rows="5" id="comment" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
    </article>
  </section>
</section>
<section class="panel-body">
    <div class="botonhc">
      <a data-toggle="collapse" class="ac" data-target="#gradoafec" >Valoración y diagnostico Nutricional<span class="glyphicon glyphicon-arrow-down"></span> </a>
      <span class="badge">OK</span>
    </div>
    <section id="gradoafec" class="collapse">
      <article class="col-xs-10">
        <label for="">Valoración Nutricional:</label>
        <input type="hidden" name="idadmhosp" value="<?php echo $fila['id_adm_hosp'];?>">
        <textarea class="form-control" name="val_nutri" rows="5" id="comment" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
      </article>
      <article class="col-xs-10">
        <label for="">Diagnostico Nutricional:</label>
        <textarea class="form-control" name="dxnutri" rows="5" id="comment" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
      </article>
      <article class="col-xs-2">
        <label for="">Peso(Kg):</label>
        <input type="text" name="peso" value="" class="form-control">
      </article>
      <article class="col-xs-2">
        <label for="">Talla(mts): <span class="fa fa-pulse fa-comment-o" data-toggle="popover" title="El valor correspondiente a la talla del paciente debe ser diligenciado en metros Ej: 1.95" data-content=""></span></label>
        <input type="text" name="talla" value="" class="form-control">
      </article>
    </section>
</section>
<section class="panel-body">
    <div class="botonhc">
      <a data-toggle="collapse" class="ac" data-target="#HH" >ANTROPOMETRÍA<span class="glyphicon glyphicon-arrow-down"></span> </a>
      <span class="badge">OK</span>
    </div>
    <section id="HH" class="collapse">
      <article class="col-xs-2">
        <label for="">Peso(Kg):</label>
        <input type="text" name="peso" value="" class="form-control">
      </article>
      <article class="col-xs-2">
        <label for="">Talla(mts): <span class="fa fa-pulse fa-comment-o" data-toggle="popover" title="El valor correspondiente a la talla del paciente debe ser diligenciado en metros Ej: 1.95" data-content=""></span></label>
        <input type="text" name="talla" value="" class="form-control">
      </article>
    </section>
</section>
<section class="panel-body">
    <div class="botonhc">
      <a data-toggle="collapse" class="ac" data-target="#forhipo" >Plan de tratamiento<span class="glyphicon glyphicon-arrow-down"></span> </a>
      <span class="badge">OK</span>
    </div>
    <section id="forhipo" class="collapse">
      <article class="col-xs-10">
        <label for="">Plan tratamiento:</label>
        <textarea class="form-control" name="plan_nutri" rows="5" id="comment" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
      </article>
    </section>
</section>
<div class="row text-center">
    <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
  <input type="reset" class="btn btn-primary" Value="Reestablecer"/>
  <input type="submit" class="btn btn-primary" name="aceptar" Value="Descartar"/>
  <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
  <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
</div>
</section>
</form>
