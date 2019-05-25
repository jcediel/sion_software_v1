<form action="<?php echo PROGRAMA.'?opcion=37&servicio='.$servicio.'&idadmhosp='.$admision;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
		<section class="panel-heading">
			<h3>Registro de Epicrisis en servicio <?php echo $servicio ?></h3>
		</section>
		<section class="panel-body">
			<article class="col-md-3">
				<label for="">Fecha resgistro:</label>
				<input type="text" class="form-control" name="freg" value="<?php echo date('Y-m-d') ?>" <?php echo $atributo1 ?>>
			</article>
			<article class="col-md-3">
				<label for="">Hora resgistro:</label>
				<input type="text" class="form-control" name="hreg" value="<?php echo date('H:i') ?>" <?php echo $atributo1 ?>>
				<input type="hidden" class="form-control" name="adm" value="<?php echo $admision ?>">
			</article>
			<article class="col-md-3">
				<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#historico_analisis"><span class="fa fa-history"></span> Historico Analisis</button>
				<div id="historico_analisis" class="modal fade" role="dialog">
				  <div class="modal-dialog modal-lg">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Historico de analisis medicos </h4>
				      </div>
				      <div class="modal-body">
				        <table class="table table-bordered">
				          <tr class="info">
				            <th>FECHA</th>
				            <th>ANALISIS</th>
				          </tr>
				        <?php
				        $adm=$_REQUEST['idadmhosp'];
				        $sqld="SELECT freg_evomed,analisis_evomed
											 FROM evolucion_medica
				               WHERE id_adm_hosp=$adm and analisis_evomed<>'.' ORDER BY freg_evomed DESC";

				            if ($tablad=$bd1->sub_tuplas($sqld)){
				              foreach ($tablad as $filad ) {
				              ?>
				              <tr>
				                <td><?php echo $filad['freg_evomed'] ?></td>
				                <td><?php echo $filad['analisis_evomed'] ?></td>
				              </tr>


				              <?php
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
			</article>
			<article class="col-md-3">
				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#hc_ingreso"><span class="fa fa-history"></span> Historia Ingreso</button>
				<div id="hc_ingreso" class="modal fade" role="dialog">
					<div class="modal-dialog modal-lg">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Historico de analisis medicos </h4>
							</div>
							<div class="modal-body">
								<table class="table table-bordered">
									<tr class="info">
										<th>FECHA</th>
										<th>ANALISIS</th>
									</tr>
									<?php
	                if (isset($_REQUEST["idadmhosp"])){
	                $id=$_REQUEST["idadmhosp"];
	                $sql="SELECT a.id_adm_hosp,estado_adm_hosp,
	                             n.freg_hchosp,hreg_hchosp,motivo_consulta,enfer_actual,his_personal,his_familiar,perso_premorbida,
															 ant_alergicos,ant_patologico,ant_quirurgico,ant_toxicologico,ant_farmaco,ant_gineco,ant_psiquiatrico,
															 ant_hospitalario,ant_traumatologico,ant_familiar,otros_ant,estado_general,tad,tas,tam,fr,fc,so,peso,
															 talla,temperatura,imc,cabcuello,torax,ext,abdomen,neurologico,genitourinario,examen_mental,analisis,
															 finalidad,causa_externa,plantratamiento,ddxp,tdxp,ddx1,tdx1,ddx2,tdx2,
	                             m.nombre

	                             FROM adm_hospitalario a LEFT JOIN hc_hospitalario n on a.id_adm_hosp=n.id_adm_hosp
	                                                     LEFT JOIN user m on m.id_user=n.id_user

	                             where a.id_adm_hosp='".$id."'";

	                if ($tabla=$bd1->sub_tuplas($sql)){
	                  //echo $sql;
	                  foreach ($tabla as $fila ) {
	                    echo"<tr >\n";
	                    echo'<td class="text-center success"><span class="fa fa-calendar"></span><strong> '.$fila["freg_hchosp"].'  '.$fila["hreg_hchosp"].' </strong></td>';
	                    echo'<td class="text-center success" colspan="9"><strong>Medico que realiza:</strong> '.$fila["nombre"].'  <span class="fa fa-user-md"> </span><strong>'.$fila["resp_hchosp"].' </strong></td>';
	                    echo '</tr>';
	                    echo"<tr >\n";
	                    echo'<td colspan="10" class="text-center danger">ANAMNESIS</td>';
	                    echo '</tr>';
	                    echo '<tr>';
	                    echo'<td colspan="5" class="text-center info">Motivo de Consulta</td>';
	                    echo'<td colspan="5" class="text-center info" >Enfermedad Actual</td>';
	                    echo"</tr>";
	                    echo "<tr>";
	                    echo'<td colspan="5" class="text-center">'.$fila["motivo_consulta"].'</td>';
	                    echo'<td colspan="5" class="text-left">'.$fila["enfer_actual"].'</td>';
	                    echo "</tr>\n";
	                    echo '<tr>';
	                    echo'<td colspan="5" class="text-center info">Historia Personal</td>';
	                    echo'<td colspan="5" class="text-center info" >Historia Familiar</td>';
	                    echo"</tr>";
	                    echo "<tr>";
	                    echo'<td colspan="5" class="text-center">'.$fila["his_personal"].'</td>';
	                    echo'<td colspan="5" class="text-left">'.$fila["his_familiar"].'</td>';
	                    echo "</tr>\n";
	                    echo '<tr>';
	                    echo'<td colspan="10" class="text-center info">Personalidad Premorbida</td>';
	                    echo"</tr>";
	                    echo "<tr>";
	                    echo'<td colspan="10" class="text-center">'.$fila["perso_premorbida"].'</td>';
	                    echo "</tr>\n";
	                    echo"<tr >\n";
	                    echo'<td colspan="10" class="text-center danger">ANTECEDENTES PERSONALES</td>';
	                    echo '</tr>';
	                    echo '<tr>';
	                    echo'<td class="text-center info">Alergicos</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["ant_alergicos"].'</td>';
	                    echo"</tr>";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Psiquiatricos</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["ant_psiquiatrico"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Patológicos</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["ant_patologico"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Quirurgicos</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["ant_quirurgico"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Toxicológicos</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["ant_toxicologico"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Farmacológicos</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["ant_farmaco"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Hospitalarios</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["ant_hospitalario"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Gineco-Obstetricos</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["ant_gineco"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Traumatológicos</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["ant_traumatologico"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Familiares</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["ant_familiar"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Otros Antecedentes</td>';
	                      echo'<td colspan="9" class="text-center">'.$fila["otros_ant"].'</td>';
	                    echo "</tr>\n";
	                    echo"<tr >\n";
	                    echo'<td colspan="10" class="text-center danger">EXAMEN FÍSICO</td>';
	                    echo '</tr>';
	                    echo '<tr>';
	                    echo'<td class="text-center info">TAS</td>';
	                    echo'<td class="text-center info" >TAD</td>';
	                    echo'<td class="text-center info" >TAM</td>';
	                    echo'<td class="text-center info" >FC</td>';
	                    echo'<td class="text-center info" >FR</td>';
	                    echo'<td class="text-center info" >SAO2</td>';
	                    echo'<td class="text-center info" >PESO</td>';
	                    echo'<td class="text-center info" >TALLA</td>';
	                    echo'<td class="text-center info" >TEMP</td>';
	                    echo'<td class="text-center info" >IMC</td>';
	                    echo"</tr>";
	                    echo "<tr>";
	                    echo'<td class="text-center info">'.$fila["tas"].'</td>';
	                    echo'<td class="text-center info" >'.$fila["tad"].'</td>';
	                    echo'<td class="text-center info" >'.$fila["tam"].'</td>';
	                    echo'<td class="text-center info" >'.$fila["fc"].'</td>';
	                    echo'<td class="text-center info" >'.$fila["fr"].'</td>';
	                    echo'<td class="text-center info" >'.$fila["so"].'</td>';
	                    echo'<td class="text-center info" >'.$fila["peso"].'</td>';
	                    echo'<td class="text-center info" >'.$fila["talla"].'</td>';
	                    echo'<td class="text-center info" >'.$fila["temperatura"].'</td>';
	                    echo'<td class="text-center info" >'.$fila["imc"].'</td>';
	                    echo "</tr>\n";
	                    echo"<tr >\n";
	                    echo'<td colspan="10" class="text-center danger">EXPLORACIÓN GENERAL Y REGIONAL</td>';
	                    echo '</tr>';
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Estado General</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["estado_general"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Cabeza y Cuello</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["cabcuello"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Torax</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["torax"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Abdomen</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["abdomen"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Genitourinario</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["genitourinario"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Extremidades</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["ext"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Neurologico</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["neurologico"].'</td>';
	                    echo "</tr>\n";
	                    echo"<tr >\n";
	                    echo'<td colspan="10" class="text-center danger">Examen Mental y Analisis</td>';
	                    echo '</tr>';
	                    echo '<tr>';
	                    echo'<td colspan="5" class="text-center info">Examen Mental</td>';
	                    echo'<td colspan="5" class="text-center info" >Analisis</td>';
	                    echo"</tr>";
	                    echo "<tr>";
	                    echo'<td colspan="5" class="text-center">'.$fila["examen_mental"].'</td>';
	                    echo'<td colspan="5" class="text-left">'.$fila["analisis"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Diagnostico Principal:</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["ddxp"].' -- '.$fila["tdxp"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Diagnostico Relacionado 1:</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["ddx1"].' -- '.$fila["tdx1"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Diagnostico Relacionado 2:</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["ddx2"].' -- '.$fila["tdx2"].'</td>';
	                    echo "</tr>\n";
	                    echo "<tr>";
	                    echo'<td class="text-center info" >Diagnostico Relacionado 3:</td>';
	                    echo'<td colspan="9" class="text-center">'.$fila["ddx3"].' -- '.$fila["tdx3"].'</td>';
	                    echo "</tr>\n";
	                    echo '<tr>';
	                    echo'<td colspan="10" class="text-center info">Plan tratamiento</td>';
	                    echo"</tr>";
	                    echo "<tr>";
	                    echo'<td colspan="10" class="text-left">'.$fila["plantratamiento"].'</td>';
	                    echo "</tr>\n";
	                  }
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
			</article>
			<article class="col-md-12">
				<label for="">Descripción de epicrisis:</label>
				<textarea name="analisis" class="form-control" rows="15" cols="80">EPICRISIS: </textarea>
			</article>
			<section class="col-xs-12">
				<?php include("dxbusqueda.php");?>
			</section>
		</section>
	</section>
		<div class="text-center">
			<input type="submit" class="btn btn-primary sombra_movil" name="aceptar" Value="<?php echo $boton; ?>" />
			<input type="hidden" class="btn btn-primary sombra_movil" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
			<input type="hidden" class="btn btn-primary sombra_movil" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
		</div>

</form>
