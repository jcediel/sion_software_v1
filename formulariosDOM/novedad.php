<form action="<?php echo PROGRAMA.'?fecha1='.$f1.'&fecha2='.$f2.'&doc='.$ident.'&buscar=Consultar&opcion=78';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading">
      <h2>Actualización de datos</h2>
    </section>
    <section class="panel-body">
      <article class="col-xs-3">
				<label for="">Fecha de registro:</label>
				<input type="text" name="freg" value="<?php echo $fila["fecha_evo"] ;?>" class="form-control" >
				<input type="hidden" name="idevolucion" value="<?php echo $fila["id"] ;?>" class="form-control" >

			</article>
			<article class="col-xs-3">
				<label for="">Hora de registro</label>
				<input type="text" name="hreg" value="<?php echo $fila["hora_evo"]  ;?>" class="form-control" >
			</article>
			<article class="col-xs-5">
				<label >Evolucion: <span class="fa fa-info-circle" data-toggle="popover" title="Consolidado de la realidad del paciente" data-content=""></span></label>
				<textarea class="form-control" name="evolucion" rows="6" id="comment" ><?php echo $fila["evolucion"];?></textarea>
			</article>
			<article class="col-xs-5">
				<label >Estado: </label>
				<select class="form-control" name="estado">
					<option value="<?php echo $fila['estado'] ?>"><?php echo $fila['estado'] ?></option>
					<option value="Realizada">Realizada</option>
					<option value="Cancelada">Cancelada</option>
				</select>
			</article>
    </section>
    <div class="row text-center">
  	  	<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
  		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
  		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
  	</div>
  </section>
</form>
