<form action="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Buscar&opcion='.$option;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="card">
    <section class="card-header">
     <h2><?php echo $subtitulo; ?></h2>
    </section>
	 <section class="row card-body">
     <article class="col-sm-5">
       <input type="hidden" name="id_referencia" value="<?php echo $referencia;?>">
       <label for="">Seleccione tipo de documento:</label>
       <select name="nomdoc" class="form-control" <?php echo atributo3; ?>>
       <option value="Epicrisis">Epicrisis</option>
       <option value="Lectura_dx">Lectura ayudas DX</option>
       <option value="Laboratorio">Laboratorio Clinico</option>
     </select>
   </article>
   <article class="col-sm-6">
     <label>Suba aqui el documento: <br><span class="text-danger animated bounceIn"> <small>Solo documentos PDF o JPG, que no superen los 2 Mb.</small></span></label>
     <?php echo $fila["foto"];?><br>
     <input type="file" class="form-control" required name="foto" <?php echo $atributo3; ?>/>
   </article>
	 </section>
   <div class="row card-body">
  	 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
  	 <input type="submit" class="btn btn-danger" name="aceptar" Value="Descartar"/>
  	 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
  	 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
   </div>
 </section>
	</form>
