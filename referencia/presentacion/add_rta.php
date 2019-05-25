
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
      <label>Soportes de presentación <span class="fa fa-book fa-2x"></span> </label>
      <table class="table table-bordered">
        <?php
        $r=$_REQUEST['idr'];
        $sqlr="SELECT id_soporte_ref, fcargue, nom_soporte, soporte_referencia
              FROM soporte_referencia
              WHERE  id_referencia=$r";
              //echo $sqlr;
              if ($tablar=$bd1->sub_tuplas($sqlr)){
                foreach ($tablar as $filar) {
                  echo'<tr>';
                  echo'<td><p><a href="'.$filar['soporte_referencia'].'"><button type="button" class="btn btn-info" ><span class="fa fa-file-pdf-o"></span>'.$filar['nom_soporte'].' - '.$filar1['fcargue'].'</button></a></p></td>';
                  echo'</tr>';
                }
              }else {
                echo'<p class="alert alert-danger animated bounceIn">No hay soportes cargados en sistema</p>';
              }
         ?>
      </table>
		</section>
		<section class="panel-body">
			<table class="table table-bordered">
				<tr class="alert alert-info animated ZoomIn ">
					<th class="text-center">Ocupación Clínica Bogotá:</th>
					<th class="text-center">
						<?php
						$sql="SELECT COUNT(b.id_adm_hosp) cuantos

								from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
											left join eps j on (j.id_eps=b.id_eps)
								where b.estado_adm_hosp='Activo' and b.id_sedes_ips='8'
															and b.tipo_servicio='Hospitalario'";
							//echo $sql;
						if ($tabla=$bd1->sub_tuplas($sql)){

							//echo $sql;
							foreach ($tabla as $fila ) {
								echo $fila["cuantos"];
							}
						}
						?>
					</th>
				</tr>
				<tr class="alert alert-success animated ZoomIn ">
					<th class="text-center ">Ocupación Clínica Facatativá:</th>
					<th class="text-center ">
						<?php
						$sql="SELECT COUNT(b.id_adm_hosp) cuantos

								from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
											left join eps j on (j.id_eps=b.id_eps)
								where b.estado_adm_hosp='Activo' and b.id_sedes_ips='2'
															and b.tipo_servicio='Hospitalario'";
							//echo $sql;
						if ($tabla=$bd1->sub_tuplas($sql)){

							//echo $sql;
							foreach ($tabla as $fila ) {
								echo $fila["cuantos"];
							}
						}
						?>
					</th>
				</tr>
      </table>
			<section class="col-md-12">
				<article class="col-md-2">
					<button type="button" data-toggle="collapse" class="btn btn-success text-center" data-target="#faca" onclick="verTexto18()"><span class="fa fa-check-circle fa-2x"></span> Aceptado Faca</button>
				</article>
				<article class="col-md-2">
					<button type="button" data-toggle="collapse" class="btn btn-success text-center" data-target="#bta" onclick="verTexto19()"><span class="fa fa-check-circle fa-2x"></span> Aceptado BTA</button>

				</article>
				<article class="col-md-2">
					<button type="button" data-toggle="collapse" class="btn btn-warning text-center" data-target="#w1" onclick="verTexto20()"><span class="fa fa-spinner fa-spin fa-2x"></span> Pendiente 1</button>

				</article>
				<article class="col-md-2">
					<button type="button" data-toggle="collapse" class="btn btn-warning text-center" data-target="#w2" onclick="verTexto21()"><span class="fa fa-spinner fa-spin fa-2x"></span> Pendiente 2</button>

				</article>
				<article class="col-md-2">
					<button type="button" data-toggle="collapse" class="btn btn-warning text-center" data-target="#w3" onclick="verTexto22()"><span class="fa fa-spinner fa-spin fa-2x"></span> Pendiente 3</button>

				</article>
				<article class="col-md-2">
					<button type="button" data-toggle="collapse" class="btn btn-danger text-center" data-target="#n1" onclick="verTexto23()"><span class="fa fa-times-circle fa-2x"></span> No Aceptado 1</button>

				</article>
				<article class="col-md-2">
					<button type="button" data-toggle="collapse" class="btn btn-danger text-center" data-target="#n2" onclick="verTexto24()"><span class="fa fa-times-circle fa-2x"></span> No Aceptado 2</button>

				</article>
				<article class="col-md-2">
					<button type="button" data-toggle="collapse" class="btn btn-danger text-center" data-target="#n3" onclick="verTexto25()"><span class="fa fa-times-circle fa-2x"></span> No Aceptado 3</button>

				</article>
			</section>
			<section class="col-md-12">
				<section id="faca" class="collapse col-md-12">
					<article class="col-md-10">
						<textarea name="respuesta1" class="form-control alert alert-success" id='respuesta18' rows="5"></textarea>
					</article>
					<article class="col-md-2">
						<input type="radio" class="radio form-control" name="rta_validacion1"
							<?php if (isset($tmuscular1) && $tmuscular1=="1") echo "checked";?>
							value="1">
					</article>
					<input type="hidden" name="rta-1" value="2">
				</section>
				<section id="bta" class="collapse col-md-12">
					<article class="col-md-10">
						<textarea name="respuesta2" class="form-control alert alert-success" id='respuesta19' rows="5"></textarea>
					</article>
					<article class="col-md-2">
						<input type="radio" class="radio form-control" name="rta_validacion2"
							<?php if (isset($tmuscular1) && $tmuscular1=="1") echo "checked";?>
							value="1">
					</article>
					<input type="hidden" name="rta-2" value="2">
				</section>
				<section id="w1" class="collapse col-md-12">
					<article class="col-md-10">
						<textarea name="respuesta3" class="form-control  alert alert-warning" id='respuesta20' rows="5"></textarea>
					</article>
					<article class="col-md-2">
						<input type="radio" class="radio form-control" name="rta_validacion3"
							<?php if (isset($tmuscular1) && $tmuscular1=="1") echo "checked";?>
							value="1">
					</article>
					<input type="hidden" name="rta-3" value="4">
				</section>
				<section id="w2" class="collapse col-md-12">
					<article class="col-md-10">
						<textarea name="respuesta4" class="form-control  alert alert-warning" id='respuesta21' rows="5"></textarea>
					</article>
					<article class="col-md-2">
						<input type="radio" class="radio form-control" name="rta_validacion4"
							<?php if (isset($tmuscular1) && $tmuscular1=="1") echo "checked";?>
							value="1">
					</article>
					<input type="hidden" name="rta-4" value="4">
				</section>
				<section id="w3" class="collapse col-md-12">
					<article class="col-md-10">
						<textarea name="respuesta5" class="form-control  alert alert-warning" id='respuesta22' rows="5"></textarea>
					</article>
					<article class="col-md-2">
						<input type="radio" class="radio form-control" name="rta_validacion5"
							<?php if (isset($tmuscular1) && $tmuscular1=="1") echo "checked";?>
							value="1">
					</article>
					<input type="hidden" name="rta-5" value="4">
				</section>
				<section id="n1" class="collapse col-md-12">
					<article class="col-md-10">
						<textarea name="respuesta6" class="form-control  alert alert-danger" id='respuesta23' rows="5"></textarea>
					</article>
					<article class="col-md-2">
						<input type="radio" class="radio form-control" name="rta_validacion6"
							<?php if (isset($tmuscular1) && $tmuscular1=="1") echo "checked";?>
							value="1">
					</article>
					<input type="hidden" name="rta-6" value="3">
				</section>
				<section id="n2" class="collapse col-md-12">
					<article class="col-md-10">
						<textarea name="respuesta7" class="form-control  alert alert-danger" id='respuesta24' rows="5"></textarea>
					</article>
					<article class="col-md-2">
						<input type="radio" class="radio form-control" name="rta_validacion7"
							<?php if (isset($tmuscular1) && $tmuscular1=="1") echo "checked";?>
							value="1">
					</article>
					<input type="hidden" name="rta-7" value="3">
				</section>
				<section id="n3" class="collapse col-md-12">
					<article class="col-md-10">
						<textarea name="respuesta8" class="form-control  alert alert-danger" id='respuesta25' rows="5"></textarea>
					</article>
					<article class="col-md-2">
						<input type="radio" class="radio form-control" name="rta_validacion8"
							<?php if (isset($tmuscular1) && $tmuscular1=="1") echo "checked";?>
							value="1">
					</article>
					<input type="hidden" name="rta-8" value="3">
				</section>
			</section>

    </section>

   <div class="row text-center">
  	 <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
  	 <input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
  	 <input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
   </div>
  </section>
</form>
