<form action="<?php echo PROGRAMA.'?doc='.$doc.'&servicio='.$servicio.'&buscar=Buscar&opcion='.$opcion.'&reporte='.$reporte;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
 <section class="panel panel-default">
	 <section class="panel-heading">
	 	<h2><?php echo $subtitulo; ?></h2>
	 </section>
	 <section class="panel-body">
     <article class="col-xs-5">
       <?php
       $pac=$_REQUEST['idpac'];
       $adm=$_REQUEST['idadm'];
       if ($pac!='' && $adm!='') {
        echo'<label for="">Documento:</label>
            <select name="nomdoc" class="form-control" <?php echo atributo3; ?>>
              <option value="'.$_REQUEST['idpac'].'_Documento Identidad">Documento Identidad</option>
              <option value="'.$_REQUEST['idadm'].'_listaChequeo">Lista Chequeo</option>
              <option value="'.$_REQUEST['idadm'].'_Consentimiento Informado">Consentimiento Informado</option>
              <option value="'.$_REQUEST['idadm'].'_Funciones enfermeria">Funciones enfermería</option>
              <option value="'.$_REQUEST['idadm'].'_soporteFirmas">Soporte de Firmas</option>
            </select>';
       }
       if ($pac!='' && $adm=='') {
         echo'<label for="">Documento:</label>
             <select name="nomdoc" class="form-control" <?php echo atributo3; ?>>
               <option value="'.$_REQUEST['idpac'].'_Documento Identidad">Documento Identidad</option>
             </select>';
       }
       ?>
       <input type="hidden" name="idpac" value="<?php echo $_GET["idpac"];?>">

   </article>
   <article class="col-xs-6">
     <label>Suba aqui el documento:</label>
     <?php echo $fila["foto"];?><br>
     <input type="file" class="form-control" name="foto" <?php echo $atributo3; ?>/>
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
