<form action="<?php echo PROGRAMA.'?opcion='.$return.'&idadmhosp='.$return1.'&servicio='.$return2.'&atencion='.$return5.'&sede='.$return6.'&doc='.$return3.'&tf='.$return4;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading"><h3><?php echo $subtitulo; ?></h3></section>
    <section class="panel-body">
      <article class="col-xs-4">
        <label for="">ID formula</label>
        <input type="text" name="idm" class="form-control" value="<?php echo $_REQUEST['idm'];?>"<?php echo $atributo1 ?>>
      </article>
      <?php
        $id_m=$_REQUEST['idm'];
        $sql_fecha="SELECT * from m_fmedhosp WHERE id_m_fmedhosp=$id_m";
        if ($tabla_fecha=$bd1->sub_tuplas($sql_fecha)){
      		foreach ($tabla_fecha as $fila_fecha) {
            ?>
            <article class="col-xs-4">
              <label for="">Fecha a extender</label>
              <input type="date" name="fejecucion_final" class="form-control" value="<?php echo $fila_fecha['fejecucion_final'];?>">
            </article>
            <?php
          }
        }
       ?>
    </section>
    <div class="row text-center">
		  <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>
  </section>
</form>
