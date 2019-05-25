<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$opcion;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
 <section class="panel panel-default">
	 <section class="panel-heading">
	 	<h2><?php echo $subtitulo; ?></h2>
	 </section>
	 <section class="panel-body">
     <article class="col-md-6">
       <input type="hidden" name="id_m_aut_dom" value="<?php echo $_REQUEST["idm"];?>">
       <label for="">Seleccione motivo de cancelacion:</label>
       <select name="motivo" class="form-control" required="">
         <option value=""></option>
         <option value="1">Cambio de tipo paciente</option>
         <option value="2">Cambio de IPS prestadora</option>
       </select>
     </article>
     <article class="col-md-6">
       <label for="">Fecha de cierre:</label>
       <input type="date" name="fcierre" value="" class="form-control" required="">
     </article>
  </section>
  <section class="panel-body">
     <article class="col-md-12">
       <label for="">Justificacion:</label>
       <textarea name="justificacion" class="form-control" rows="5"  required="" ></textarea>
     </article>
	 </section>
   </section>
   <div class="row text-center">
  	 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
  	 <input type="submit" class="btn btn-danger" name="aceptar" Value="Descartar"/>
  	 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
  	 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
   </div>
  </section>
</form>
