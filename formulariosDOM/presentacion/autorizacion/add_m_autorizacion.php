<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$option;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="card">
    <section class="card-header">
     <h2><?php echo $subtitulo; ?></h2>
    </section>
    <section class="row">
      <section class="col-md-9">
        <section class="row">
          <article class="col-sm-3">
           <label for="">Fecha inicial:</label>
           <input type="date"  name="inicial" class="form-control" value=""<?php echo $atributo2;?>/>
           <input type="hidden"  name="idadm" class="form-control" value="<?php echo $fila['id_admision']?>"<?php echo $atributo2;?>/>
          </article>
          <article class="col-sm-3">
            <label for="">Fecha Final:</label>
            <input type="date"  name="final" class="form-control" value=""<?php echo $atributo2;?>/>
          </article>
          <article class="col-sm-4">
            <label for="">Tipo paciente:</label>
            <select class="form-control" required name="tipo_paciente">
              <option value=""></option>
              <option value="1">Crónico</option>
              <option value="2">Puntual</option>
            </select>
          </article>
        </section>
        <section class="row">
          
          <article class="col-sm-4">
            <label for=""># Autorización:</label>
            <input type="text" class="form-control" name="num_aut" value="">
          </article>
        </section>
      </section>
      <section class="col-md-3">
        <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" /><br>
        <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
        <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
      </section>
    </section>
  </section>
</form>
