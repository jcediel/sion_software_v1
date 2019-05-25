<script src = "js_p/sha3.js"></script>
		<script>
			function validar(){

				if (document.forms[0].medico1.value == document.forms[0].medico2.value){
					alert(" <?php echo $_SESSION["AUT"]["nombre"]?>, HEYYY, no pude configurar el mismo medico en ambos campos.");
					document.forms[0].medico1.focus();			// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?&opcion=70';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading">
      <h1><?php echo $subtitulo ?></h1>
    </section>
    <section class="panel-body">
      <section class="col-md-6 text-center">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#hcdom">Ver Historia <br> Clínica</button>
          <!-- Modal -->
          <div id="hcdom" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Historia Clinica</h4>
                </div>
                <div class="modal-body">
                    <?php
                    $id=$fila['id_d_aut_dom'];
                    $sql_consulta="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
                    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
                    j.nom_eps,
                    k.id_hchosp,id_hchosp,id_d_aut_dom, freg_hchosp, hreg_hchosp, tipo_hc, motivo_consulta, enfer_actual,
										tas, tad, fc, fr, so2, peso, talla, glasgow, gucometria, imc, rxs,
										cabcuello, torax, ext, abdomen, neurologico, genitourinario,
										barthel, weefim, cruzroja, raisberg, karnell, grossmotor, norton, honenyahr, fac,
										analisis, finalidad, causa_externa,
										dxp, tdxp, dx1, tdx1, dx2, tdx2, dx3, tdx3, plan_manejo, estado_hchosp,
										cant_valmed, periodo_valmed, cant_enfer, temp_valenf, periodo_valenf, cant_fisio, cant_fono, cant_to, cant_resp,
										m.ant_alergicos, ant_patologico, ant_patologico, ant_toxicologico, ant_farmaco,
											ant_gineco, ant_psiquiatrico, ant_hospitalario,
											ant_traumatologico, ant_familiar, otros_ant,
                    l.nombre,rm_profesional,l.especialidad espec_user,firma
                    from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
                          inner join eps j on (j.id_eps=b.id_eps)
                          inner join hcini_dom k on (k.id_adm_hosp=b.id_adm_hosp)
													left join hc_principal m on (m.id_paciente=a.id_paciente)
                          inner join user l on (l.id_user=k.id_user)
                    where k.id_d_aut_dom=$id";
												//echo $sql;
                    if ($tabla_consulta=$bd1->sub_tuplas($sql_consulta)){
                      foreach ($tabla_consulta as $fila_consulta) {
                        echo'
                        <section class="panel-body">
                          <article class="col-md-6">
                            <label for="">Registro:</label>
                            <p>'.$fila_consulta["fecha_evo"].'  '.$fila_consulta["hora_evo"].'</p>
                          </article>
                          <article class="col-md-6">
                            <label for="">Medico Responsable</label>
                            <p><strong>'.$fila_consulta["nombre"].' </strong></p>
                          </article>
                        </section>
												<section class="panel-body">
													<article class="col-md-12">
														<p>'.$fila_consulta["tipo_hc"].'</p>
													</article>
													<article class="col-md-12">
														<h3 class="text-center">ANAMNESIS</h3>
													</article>
													<article class="col-md-6">
														<label>Motivo Consulta</label>
														<p>'.$fila_consulta["motivo_consulta"].'</p>
													</article>
													<article class="col-md-6">
														<label>Enfermedad Actual</label>
														<p>'.$fila_consulta["enfer_actual"].'</p>
													</article>
												</section>
												<section class="panel-body">
													<article class="col-md-12">
														<h3 class="text-center">ANTECEDENTES PERSONALES</h3>
													</article>
													<article class="col-md-6">
														<label>Alergicos</label>
														<p>'.$fila_consulta["ant_alergicos"].'</p>
													</article>
													<article class="col-md-6">
														<label>Patologico</label>
														<p>'.$fila_consulta["ant_patologico"].'</p>
													</article>
													<article class="col-md-6">
														<label>Quirurgicos</label>
														<p>'.$fila_consulta["ant_patologico"].'</p>
													</article>
													<article class="col-md-6">
														<label>Toxicologico</label>
														<p>'.$fila_consulta["ant_toxicologico"].'</p>
													</article>
													<article class="col-md-6">
														<label>Farmacologico</label>
														<p>'.$fila_consulta["ant_farmaco"].'</p>
													</article>
													<article class="col-md-6">
														<label>Ginecologico</label>
														<p>'.$fila_consulta["ant_gineco"].'</p>
													</article>
													<article class="col-md-6">
														<label>Psiquiatrico</label>
														<p>'.$fila_consulta["ant_psiquiatrico"].'</p>
													</article>
													<article class="col-md-6">
														<label>Hospitalario</label>
														<p>'.$fila_consulta["ant_hospitalario"].'</p>
													</article>
													<article class="col-md-6">
														<label>Traumatologico</label>
														<p>'.$fila_consulta["ant_traumatologico"].'</p>
													</article>
													<article class="col-md-6">
														<label>Familiares</label>
														<p>'.$fila_consulta["ant_familiar"].'</p>
													</article>
													<article class="col-md-6">
														<label>Otros</label>
														<p>'.$fila_consulta["otros_ant"].'</p>
													</article>
												</section>
												<section class="panel-body">
													<article class="col-md-12">
														<h3 class="text-center">EXAMEN FISICO</h3>
													</article>
													<article class="col-md-2">
														<label>TA</label>
														<p>'.$fila_consulta["tad"].' / '.$fila_consulta["tas"].' mmhg</p>
													</article>
													<article class="col-md-2">
														<label>FC</label>
														<p>'.$fila_consulta["fc"].' </p>
													</article>
													<article class="col-md-2">
														<label>FR</label>
														<p>'.$fila_consulta["fr"].'</p>
													</article>
													<article class="col-md-2">
														<label>Saturacion</label>
														<p>'.$fila_consulta["so2"].'</p>
													</article>
													<article class="col-md-2">
														<label>Peso</label>
														<p>'.$fila_consulta["peso"].'</p>
													</article>
													<article class="col-md-2">
														<label>Talla</label>
														<p>'.$fila_consulta["talla"].'</p>
													</article>
													<article class="col-md-2">
														<label>Glasgow</label>
														<p>'.$fila_consulta["glasgow"].'</p>
													</article>
													<article class="col-md-2">
														<label>Glucometria</label>
														<p>'.$fila_consulta["glucometria"].'</p>
													</article>
													<article class="col-md-2">
														<label>IMC</label>
														<p>'.$fila_consulta["imc"].'</p>
													</article>
													<article class="col-md-12">
														<label>Revisión por sistemas</label>
														<p>'.$fila_consulta["rxs"].'</p>
													</article>
												</section>
												<section class="panel-body">
													<article class="col-md-12">
														<h3 class="text-center">EXPLORACION GENERAL Y REGIONAL</h3>
													</article>
													<article class="col-md-4">
														<label>Cabeza Cuello</label>
														<p>'.$fila_consulta["cabcuello"].'</p>
													</article>
													<article class="col-md-4">
														<label>Torax</label>
														<p>'.$fila_consulta["torax"].' </p>
													</article>
													<article class="col-md-4">
														<label>Extremidades</label>
														<p>'.$fila_consulta["ext"].'</p>
													</article>
													<article class="col-md-4">
														<label>Abdomen</label>
														<p>'.$fila_consulta["abdomen"].'</p>
													</article>
													<article class="col-md-4">
														<label>Neurologico</label>
														<p>'.$fila_consulta["neurologico"].'</p>
													</article>
													<article class="col-md-4">
														<label>Genitourinario</label>
														<p>'.$fila_consulta["genitourinario"].'</p>
													</article>
												</section>
												<section class="panel-body">
												<article class="col-md-12">
													<h3 class="text-center">ESCALAS</h3>
												</article>
													<article class="col-md-2">
														<label>Barthel</label>
														<p>'.$fila_consulta["barthel"].'</p>
													</article>
													<article class="col-md-2">
														<label>Wee fim</label>
														<p>'.$fila_consulta["weefim"].'</p>
													</article>
													<article class="col-md-2">
														<label>Cruz roja</label>
														<p>'.$fila_consulta["cruzroja"].'</p>
													</article>
													<article class="col-md-2">
														<label>raisberg</label>
														<p>'.$fila_consulta["raisberg"].'</p>
													</article>
													<article class="col-md-2">
														<label>karnell</label>
														<p>'.$fila_consulta["karnell"].'</p>
													</article>
													<article class="col-md-2">
														<label>grossmotor</label>
														<p>'.$fila_consulta["grossmotor"].'</p>
													</article>
													<article class="col-md-2">
														<label>norton</label>
														<p>'.$fila_consulta["norton"].'</p>
													</article>
													<article class="col-md-2">
														<label>honenyahr</label>
														<p>'.$fila_consulta["honenyahr"].'</p>
													</article>
													<article class="col-md-2">
														<label>FAC</label>
														<p>'.$fila_consulta["fac"].'</p>
													</article>
												</section>
												<section class="panel-body">
												<article class="col-md-12">
													<h3 class="text-center">ANALISIS</h3>
												</article>
													<article class="col-md-12">
														<label>Analisis</label>
														<p>'.$fila_consulta["analisis"].'</p>
													</article>
													<article class="col-md-6">
														<label>Finalidad</label>
														<p>'.$fila_consulta["finalidad"].'</p>
													</article>
													<article class="col-md-6">
														<label>Causa externa</label>
														<p>'.$fila_consulta["causa_externa"].'</p>
													</article>
													<article class="col-md-12">
														<label>Dx Principal</label>
														<p>'.$fila_consulta["dxp"].' '.$fila_consulta["tdxp"].'</p>
													</article>
													<article class="col-md-12">
														<label>Dx relacionado 1</label>
														<p>'.$fila_consulta["dxp1"].' '.$fila_consulta["tdxp1"].'</p>
													</article>
													<article class="col-md-12">
														<label>Dx relacionado 2</label>
														<p>'.$fila_consulta["dxp2"].' '.$fila_consulta["tdxp2"].'</p>
													</article>
													<article class="col-md-12">
														<label>Dx relacionado 3</label>
														<p>'.$fila_consulta["dxp3"].' '.$fila_consulta["tdxp3"].'</p>
													</article>
													<article class="col-md-12">
														<label>Plan Manejo</label>
														<p>'.$fila_consulta["plan_manejo"].' </p>
													</article>
												</section>
                        ';
                      }
                    }

                    ?>
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>
      </section>
      <section class="col-md-6 col-sm-12">
        <label for="">Seleccione Medico 1:</label>
        <select class="form-control" required="" name="medico1">
          <option value=""></option>
          <?php
   				$sql="SELECT id_user,nombre from user WHERE id_perfil=48 ORDER BY id_user ASC";
   				if($tabla=$bd1->sub_tuplas($sql)){
   					foreach ($tabla as $fila2) {
   						if ($fila["id_user"]==$fila2["id_user"]){
   							$sw=' selected="selected"';
   						}else{
   							$sw="";
   						}
   					echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.$fila2["nombre"].'</option>';
   					}
   				}
   				?>
        </select>
      </section>
      <section class="col-md-6 col-sm-12">
        <label for="">Seleccione Medico 12</label>
        <select class="form-control" required="" name="medico2">
          <option value=""></option>
          <?php
          $sql="SELECT id_user,nombre from user WHERE id_perfil=48 ORDER BY id_user ASC";
          if($tabla=$bd1->sub_tuplas($sql)){
            foreach ($tabla as $fila2) {
              if ($fila["id_user"]==$fila2["id_user"]){
                $sw=' selected="selected"';
              }else{
                $sw="";
              }
            echo '<option value="'.$fila2["id_user"].'"'.$sw.'>'.$fila2["nombre"].'</option>';
            }
          }
          ?>
        </select>
      </section>
    </section>
    <section class="panel-body">
			<article class="col-md-6">
				<label for="">Fecha registro:</label>
				<input type="text" name="freg" value="<?php echo date('Y-m-d') ?>">
			</article>
			<article class="col-md-6">
				<label for="">Hora registro:</label>
				<input type="text" name="hreg" value="<?php echo date('H:i') ?>">
			</article>
      <article class="col-md-12">
        <label for="">Objetivo Junta Medica</label>
				<input type="hidden" name="id_hchosp" value="<?php echo $fila['id_hchosp'] ?>">
        <textarea name="objetivo_junta" class="form-control" rows="6"></textarea>
      </article>
      <article class="col-md-12">
        <label for="">Concepto Junta Medica</label>
        <textarea name="concepto_junta" class="form-control" rows="6"></textarea>
      </article>
    </section>
		<section class="panel-body text-center">
			<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</section>
  </section>

</form>
