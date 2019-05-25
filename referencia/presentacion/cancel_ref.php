
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].f_correo.value > document.forms[0].hoyF.value){
					alert("No no no, usted no puede adelantar fechas");
					document.forms[0].f_correo.focus();				// Ubicar el cursor
					return(false);
				}
        if (document.forms[0].h_correo.value > document.forms[0].hoyH.value){
					alert("No no no, usted no puede adelantar el tiempo");
					document.forms[0].h_correo.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
 	 <section class="panel-heading">
 	 	<h2><?php echo $subtitulo; ?></h2>
 	 </section>
   <section class="panel-body">
     <section class="col-md-12">
			 <button type="button" data-toggle="collapse" class="btn btn-primary text-center" data-target="#pac">Datos básicos paciente y correos de referencia<span class="glyphicon glyphicon-arrow-down"></span> </button>
			 <section id="pac" class="collapse">
       <table class="table table-bordered">
       	<tr>
       		<td>PACIENTE</td>
					<td>EPS</td>
					<td>EMAIL REFERENCIA EPS</td>
       	</tr>
				<tr>
					<td>
						<input type="text" class="form-control" name="nom" value="<?php echo $fila['nom_completo'].' '.$fila['tdoc_pac'].': '.$fila['doc_pac']?>" <?php echo $atributo1 ?>>
					</td>
					<td>
						<label for="">EPS:</label>
						<input type="text" class="form-control" name="eps" value="<?php echo $fila['nom_eps']?>" <?php echo $atributo1 ?>>
						<label for="">Responsable referencia:</label>
						<input type="text" class="form-control" name="resp1" value="<?php echo $fila['resp1']?>" <?php echo $atributo1 ?>>
					</td>
					<td>
						<?php
						$ideps=$fila['ideps'];
						//echo $ideps;
						$sql_email="SELECT mail_eps FROM correo_referencia WHERE id_eps=$ideps and estado_mail=1";
						$i=1;
						if ($tablarm=$bd1->sub_tuplas($sql_email)){
							foreach ($tablarm as $filarm) {
								echo'<p><input type="text" class="form-control" name="mail'.$i++.'" value="'.$filarm['mail_eps'].'" '.$atributo1.'><p>';
							}
						}
						?>
					</td>
				</tr>
       </table>
		 </section>
     </section>
   </section>
   <section class="panel-body">
     <article class="col-xs-6">
       <label for="">Presentación paciente:</label>
       <textarea name="presentacion" class="form-control" rows="5" <?php echo $atributo1;?>><?php echo $fila['cuerpo_referencia']; ?></textarea>
     </article>
     <article class="col-xs-3">
       <label for="">Fecha:</label>
			 <input type="hidden" required="" class="form-control" name="f_rta" value="<?php echo date('Y-m-d')?>" <?php echo $atributo1;?>>
       <input type="text" class="form-control" name="" value="<?php echo $fila['f_correo']?>" <?php echo $atributo1;?>>
       <input type="hidden" class="form-control" name="id_referencia" value="<?php echo $fila['id_referencia']?>">
     </article>
     <article class="col-xs-3">
       <label for="">Hora:</label>
       <input type="text" class="form-control" name="" value="<?php echo $fila['h_correo'] ?>" <?php echo $atributo1;?>>
			 <input type="hidden" required="" class="form-control" name="h_rta"  value="<?php echo date('H:i')?>" <?php echo $atributo1;?>>
     </article>
    </section>
    <section class="panel-body">
      <label for="">Observación:</label>
      <textarea required name="obs_cancelacion" class="form-control" rows="4" cols="30"></textarea>
    </section>

   <div class="row text-center">
  	 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
  	 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
  	 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
   </div>
  </section>
</form>
