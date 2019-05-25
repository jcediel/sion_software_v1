<form action="<?php echo PROGRAMA.'?&opcion=47';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
	  <?php
	    include("consulta_paciente.php");
	  ?>
	</section>
		<article>
			<h4 id="th-estilot">Datos de Valoración inicial Terapia Ocupacional</h4>

				<section class="panel-body"> <!---->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#anamnesis" >Patrones</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="anamnesis">
						<article class="col-xs-3">
							<label for="">Fecha de registro:</label>
							<input type="text" name="freg" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo1?> >
						</article>
						<article class="col-xs-3">
							<label for="">Hora de registro</label>
							<input type="text" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1?>>
						</article>
						<div class="col-xs-10">

						</div>
						<br>
						<article class="col-xs-5" id="sectpac">
							<table class="table table-bordered">
								<tr>
									<td colspan="2"></td>
									<td class=""><span class="fa fa-hand-o-left"></span> <b class="fondoizq">Izquierda</b></td>
									<td><b class="fondoder">  Derecha</b>   <span class="fa fa-hand-o-right"></span></td>
								</tr>
								<tr>
										<td rowspan="9" ><h2 class="texto-vertical">Integrales</h2></td>
									<td >
										<i>Agarre a mano llena</i>
									</td>
									<td>
										<select class="form-control" name="pintegral1i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>
										<select class="form-control" name="pintegral1d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Agarre cilindrico</i>
									</td>
									<td>
										<select class="form-control" name="pintegral2i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pintegral2d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Pinza fina</i>
									</td>
									<td>
										<select class="form-control" name="pintegral3i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pintegral3d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Pinza tripode</i>
									</td>
									<td>
										<select class="form-control" name="pintegral4i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pintegral4d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Pinza digito digital</i>
									</td>
									<td>
										<select class="form-control" name="pintegral5i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pintegral5d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Agarre de enganche</i>
									</td>
									<td>
										<select class="form-control" name="pintegral6i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pintegral6d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Soltar rudimentario</i>
									</td>
									<td>
										<select class="form-control" name="pintegral7i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pintegral7d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Soltar con precisión</i>
									</td>
									<td>
										<select class="form-control" name="pintegral8i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pintegral8d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Lanzar rudimentario</i>
									</td>
									<td>
										<select class="form-control" name="pintegral9i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>
										<select class="form-control" name="pintegral9d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="2"></td>
									<td class=""><span class="fa fa-hand-o-left"></span> <b class="fondoizq">Izquierda</b></td>
									<td><b class="fondoder">  Derecha</b>   <span class="fa fa-hand-o-right"></span></td>
								</tr>
								<tr>
										<td rowspan="7" ><h2 class="texto-vertical">Funcionales</h2></td>
									<td >
										<i>Mano-Cabeza</i>
									</td>
									<td>
										<select class="form-control" name="pfuncional1i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>
										<select class="form-control" name="pfuncional1d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Mano-Boca</i>
									</td>
									<td>
										<select class="form-control" name="pfuncional2i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pfuncional23">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Mano-Espalda</i>
									</td>
									<td>
										<select class="form-control" name="pfuncional3i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pfuncional3d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Mano-Hombro</i>
									</td>
									<td>
										<select class="form-control" name="pfuncional4i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pfuncional4d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Mano-Cadera</i>
									</td>
									<td>
										<select class="form-control" name="pfuncional5i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pfuncional5d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Mano-Perineo</i>
									</td>
									<td>
										<select class="form-control" name="pfuncional6i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pfuncional6d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Mano-Rodilla</i>
									</td>
									<td>
										<select class="form-control" name="pfuncional7i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>
										<select class="form-control" name="pfuncional7d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
								  <td colspan="2"></td>
								  <td class=""><span class="fa fa-hand-o-left"></span> <b class="fondoizq">Izquierda</b></td>
								  <td><b class="fondoder">  Derecha</b>   <span class="fa fa-hand-o-right"></span></td>
								</tr>
								<tr>
								    <td rowspan="6" ><h2 class="texto-vertical">Alcance</h2></td>
								  <td >
								    <i>Alcance Alto</i>
								  </td>
								  <td>
								    <select class="form-control" name="palcance1i">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								  <td>
								    <select class="form-control" name="palcance1d">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								</tr>
								<tr>
								  <td>
								    <i>Alcance Medio</i>
								  </td>
								  <td>
								    <select class="form-control" name="palcance2i">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								  <td>

								    <select class="form-control" name="palcance2d">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								</tr>
								<tr>
								  <td>
								    <i>Alcance Bajo</i>
								  </td>
								  <td>
								    <select class="form-control" name="palcanc3i">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								  <td>

								    <select class="form-control" name="palcance3d">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								</tr>
								<tr>
								  <td>
								    <i>Alcance Diagonal</i>
								  </td>
								  <td>
								    <select class="form-control" name="palcance4i">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								  <td>

								    <select class="form-control" name="palcance4d">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								</tr>
								<tr>
								  <td>
								    <i>Alcance Posterior</i>
								  </td>
								  <td>
								    <select class="form-control" name="palcance5i">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								  <td>

								    <select class="form-control" name="palcance5d">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								</tr>
							</table>
						</article>

						<article class="col-xs-5" id="secteps">
							<table class="table table-bordered">
								<tr>
									<td colspan="2"></td>
									<td class=""><span class="fa fa-hand-o-left"></span> <b class="fondoizq">Izquierda</b></td>
									<td><b class="fondoder">  Derecha</b>   <span class="fa fa-hand-o-right"></span></td>
								</tr>
								<tr>
										<td rowspan="8" ><h2 class="texto-vertical">Globales</h2></td>
									<td >
										<i>Hallar</i>
									</td>
									<td>
										<select class="form-control" name="pglobales1i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>
										<select class="form-control" name="pglobales1d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Empujar</i>
									</td>
									<td>
										<select class="form-control" name="pglobales2i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pglobales2d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Sosten cefalico</i>
									</td>
									<td>
										<select class="form-control" name="pglobales3i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pglobales3d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Rolados</i>
									</td>
									<td>
										<select class="form-control" name="pglobales4i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pglobales4d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Sedente</i>
									</td>
									<td>
										<select class="form-control" name="pglobales5i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pglobales5d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Gateo</i>
									</td>
									<td>
										<select class="form-control" name="pglobales6i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pglobales6d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Bipeda</i>
									</td>
									<td>
										<select class="form-control" name="pglobales7i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pglobales7d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Marcha</i>
									</td>
									<td>
										<select class="form-control" name="pglobales8i">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
									<td>

										<select class="form-control" name="pglobales8d">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
							</table>
							<table class="table table-bordered">
								<tr>
								  <td colspan="2"></td>
								  <td class=""><span class="fa fa-hand-o-left"></span> <b class="fondoizq">Izquierda</b></td>
								  <td><b class="fondoder">  Derecha</b>   <span class="fa fa-hand-o-right"></span></td>
								</tr>
								<tr>
								    <td rowspan="5" ><h3 class="texto-vertical-2">Fundamentales</h3></td>
								  <td >
								    <i>Correr</i>
								  </td>
								  <td>
								    <select class="form-control" name="pfund1i">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								  <td>
								    <select class="form-control" name="pfund1d">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								</tr>
								<tr>
								  <td>
								    <i>Saltar</i>
								  </td>
								  <td>
								    <select class="form-control" name="pfund2i">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								  <td>

								    <select class="form-control" name="pfund2d">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								</tr>
								<tr>
								  <td>
								    <i>Atajar</i>
								  </td>
								  <td>
								    <select class="form-control" name="pfund3i">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								  <td>

								    <select class="form-control" name="pfund3d">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								</tr>
								<tr>
								  <td>
								    <i>Lanzar</i>
								  </td>
								  <td>
								    <select class="form-control" name="pfund4i">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								  <td>

								    <select class="form-control" name="pfund4d">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								</tr>
								<tr>
								  <td>
								    <i>Patear</i>
								  </td>
								  <td>
								    <select class="form-control" name="pfund5i">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								  <td>

								    <select class="form-control" name="pfund5d">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								</tr>
							</table>
							<table class="table table-bordered">
								<tr>
								  <td colspan="2"></td>
								  <td class=""><span class="fa fa-hand-o-left"></span> <b class="fondoizq">Izquierda</b></td>
								  <td><b class="fondoder">  Derecha</b>   <span class="fa fa-hand-o-right"></span></td>
								</tr>
								<tr>
								    <td rowspan="5" ><h3 class="texto-vertical-2">Coordinación</h3></td>
								  <td >
								    <i>Integración bilateral</i>
								  </td>
								  <td>
								    <select class="form-control" name="pcoord1i">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								  <td>
								    <select class="form-control" name="pcoord1d">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								</tr>
								<tr>
								  <td>
								    <i>Integración visomotora</i>
								  </td>
								  <td>
								    <select class="form-control" name="pcoord2i">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								  <td>

								    <select class="form-control" name="pcoord2d">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								</tr>
								<tr>
								  <td>
								    <i>Coordinación destreza motora gruesa</i>
								  </td>
								  <td>
								    <select class="form-control" name="pcoord3i">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								  <td>

								    <select class="form-control" name="pcoord3d">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								</tr>
								<tr>
								  <td>
								    <i>Disociación segmentaria</i>
								  </td>
								  <td>
								    <select class="form-control" name="pcoord4i">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								  <td>

								    <select class="form-control" name="pcoord4d">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								</tr>
								<tr>
								  <td>
								    <i>Coordinación destreza motora fina</i>
								  </td>
								  <td>
								    <select class="form-control" name="pcoord5i">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								  <td>

								    <select class="form-control" name="pcoord5d">
								      <option value="No funcional">No funcional</option>
								      <option value="Semi-funcional">Semi-funcional</option>
								      <option value="Funcional">Funcional</option>
								    </select>
								  </td>
								</tr>

							</table>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!---->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#praxis" >Componente cognitivo-perceptual</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="praxis">
						<article class="col-xs-4">
							<table class="table table-bordered">
								<tr>
									<td rowspan="2" ><h3 class="texto-vertical-3">Orientación</h3></td>
									<td>
										<i>Tiempo/Espacio</i>
									</td>
									<td>
										<select class="form-control" name="ccp_orien1">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Persona</i>
									</td>
									<td>
										<select class="form-control" name="ccp_orien2">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td rowspan="8" ><h3 class="texto-vertical-3">Atencionales</h3></td>
									<td>
										<i>Contacto visual</i>
									</td>
									<td>
										<select class="form-control" name="ccp_atenc1">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Seguimiento visual</i>
									</td>
									<td>
										<select class="form-control" name="ccp_atenc2">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Alerta a estimulos</i>
									</td>
									<td>
										<select class="form-control" name="ccp_atenc3">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Reflejo orientación</i>
									</td>
									<td>
										<select class="form-control" name="ccp_atenc4">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Selectiva</i>
									</td>
									<td>
										<select class="form-control" name="ccp_atenc5">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Sostenida</i>
									</td>
									<td>
										<select class="form-control" name="ccp_atenc6">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Dividida</i>
									</td>
									<td>
										<select class="form-control" name="ccp_atenc7">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Tiempo Atención</i>
									</td>
									<td>
										<select class="form-control" name="ccp_atenc8">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
							</table>
						</article>
						<article class="col-xs-4">
							<table class="table table-bordered">
								<tr>
									<td rowspan="5" ><h3 class="texto-vertical-3">Técnicas Gráficas</h3></td>
									<td>
										<i>Recortado</i>
									</td>
									<td>
										<select class="form-control" name="ccp_graf1">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Repisado</i>
									</td>
									<td>
										<select class="form-control" name="ccp_graf2">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Picado</i>
									</td>
									<td>
										<select class="form-control" name="ccp_graf3">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr><tr>
									<td>
										<i>Coloreado</i>
									</td>
									<td>
										<select class="form-control" name="ccp_graf4">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr><tr>
									<td>
										<i>Rasgado</i>
									</td>
									<td>
										<select class="form-control" name="ccp_graf5">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td rowspan="7" ><h3 class="texto-vertical-3">Percepción</h3></td>
									<td>
										<i>Coordinación visiomotora</i>
									</td>
									<td>
										<select class="form-control" name="ccp_percep1">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Constancia de forma</i>
									</td>
									<td>
										<select class="form-control" name="ccp_percep2">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Color</i>
									</td>
									<td>
										<select class="form-control" name="ccp_percep3">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr><tr>
									<td>
										<i>Tamaño</i>
									</td>
									<td>
										<select class="form-control" name="ccp_percep4">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Figura-Fondo</i>
									</td>
									<td>
										<select class="form-control" name="ccp_percep5">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Reconoce espacial</i>
									</td>
									<td>
										<select class="form-control" name="ccp_percep6">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Cierre Visual</i>
									</td>
									<td>
										<select class="form-control" name="ccp_percep7">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>

							</table>
						</article>
						<article class="col-xs-4">
							<table class="table table-bordered">
							<tr>
								<td rowspan="5" ><h3 class="texto-vertical-3">Memoria</h3></td>
								<td>
									<i>Verbal</i>
								</td>
								<td>
									<select class="form-control" name="ccp_memo1">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<i>Visual</i>
								</td>
								<td>
									<select class="form-control" name="ccp_memo2">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<i>Auditiva</i>
								</td>
								<td>
									<select class="form-control" name="ccp_memo3">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select>
								</td>
							</tr><tr>
								<td>
									<i>Corto plazo</i>
								</td>
								<td>
									<select class="form-control" name="ccp_memo4">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select>
								</td>
							</tr><tr>
								<td>
									<i>Largo plazo</i>
								</td>
								<td>
									<select class="form-control" name="ccp_memo5">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select>
								</td>
							</tr>
							<tr>
								<td rowspan="6" ><h3 class="texto-vertical-3">Instrumentales</h3></td>
								<td>
									<i>Praxias</i>
								</td>
								<td>
									<select class="form-control" name="ccp_instru1">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<i>Gnosias</i>
								</td>
								<td>
									<select class="form-control" name="ccp_instru2">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<i>Esquema corporal</i>
								</td>
								<td>
									<select class="form-control" name="ccp_instru3">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select>
								</td>
							</tr><tr>
								<td>
									<i>Lateralidad</i>
								</td>
								<td>
									<select class="form-control" name="ccp_instru4">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<i>Nociones Espaciales</i>
								</td>
								<td>
									<select class="form-control" name="ccp_instru5">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<i>Nociones temporales</i>
								</td>
								<td>
									<select class="form-control" name="ccp_instru6">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select>
								</td>
							</tr>
							</table>
						</article>
						<article class="col-xs-12">
							<table class="table table-bordered">
								<tr>
									<td rowspan="6" ><h3 class="texto-vertical-3">Superiores</h3></td>
									<td>
										<i>Abstracción</i>
									</td>
									<td>
										<select class="form-control" name="ccp_supe1">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Planificación</i>
									</td>
									<td>
										<select class="form-control" name="ccp_supe2">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Categorización</i>
									</td>
									<td>
										<select class="form-control" name="ccp_supe3">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr><tr>
									<td>
										<i>Resolucion problemas</i>
									</td>
									<td>
										<select class="form-control" name="ccp_supe4">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Lecto-escritura</i>
									</td>
									<td>
										<select class="form-control" name="ccp_supe5">
											<option value="No funcional">No funcional</option>
											<option value="Semi-funcional">Semi-funcional</option>
											<option value="Funcional">Funcional</option>
										</select>
									</td>
								</tr>
							</table>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#nivel" >Componente Psicosocial</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="nivel">
						<article class="col-xs-6">
							<label for="">Segumiento de normas:</label>
							<textarea class="form-control" name="cp1" rows="5" id="comment" ></textarea>
						</article>
						<article class="col-xs-6">
							<label for="">Conducta Social:</label>
							<textarea class="form-control" name="cp2" rows="5" id="comment" ></textarea>
						</article>
						<article class="col-xs-6">
							<label for="">Autoexpresión:</label>
							<textarea class="form-control" name="cp3" rows="5" id="comment" ></textarea>
						</article>
						<article class="col-xs-6">
							<label for="">Tolerancia a la Frustración:</label>
							<textarea class="form-control" name="cp4" rows="5" id="comment" ></textarea>
						</article>
						<article class="col-xs-6">
							<label for="">Relaciones con los pares:</label>
							<textarea class="form-control" name="cp5" rows="5" id="comment" ></textarea>
						</article>
						<article class="col-xs-6">
							<label for="">Relaciones con figura de autoridad:</label>
							<textarea class="form-control" name="cp6" rows="5" id="comment" ></textarea>
						</article>
						<article class="col-xs-6">
							<label for="">Desempeño escolar:</label>
							<textarea class="form-control" name="cp7" rows="5" id="comment" ></textarea>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#sintactico" >JUEGO</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="sintactico">
						<article class="col-xs-6">
							<label for="">Manipula objetos:</label>
							<textarea class="form-control" name="juego1" rows="5" id="comment" ></textarea>
						</article>
						<article class="col-xs-6">
							<label for="">Repite esquemas con los objetos:</label>
							<textarea class="form-control" name="juego2" rows="5" id="comment" ></textarea>
						</article>
						<article class="col-xs-6">
							<label for="">Sonrié:</label>
							<textarea class="form-control" name="juego3" rows="5" id="comment" ></textarea>
						</article>
						<article class="col-xs-6">
							<label for="">Juego Exploratorio:</label>
							<textarea class="form-control" name="juego4" rows="5" id="comment" ></textarea>
						</article>
						<article class="col-xs-6">
							<label for="">Juego Simbólico:</label>
							<textarea class="form-control" name="juego5" rows="5" id="comment" ></textarea>
						</article>
						<article class="col-xs-6">
							<label for="">Juego solo:</label>
							<textarea class="form-control" name="juego6" rows="5" id="comment" ></textarea>
						</article>
						<article class="col-xs-6">
							<label for="">Juego con pares:</label>
							<textarea class="form-control" name="juego7" rows="5" id="comment" ></textarea>
						</article>
						<article class="col-xs-6">
							<label for="">Juego con adultos:</label>
							<textarea class="form-control" name="juego8" rows="5" id="comment" ></textarea>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#pragmatico" >ACTIVIDADES DE LA VIDA DIARIA:</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="pragmatico">
						<article class="col-xs-6">
							<table class="table table-bordered">
								<tr>
									<td rowspan="4" ><h3 class="texto-vertical-3">ALIMENTACIÓN</h3></td>
									<td>
										<i>Manipulación cuchara,toma el alimento y lo lleva a la boca</i>
									</td>
									<td>
										<select class="form-control" name="avd_alimen1">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Manipulación tenedor,toma el alimento y lo lleva a la boca</i>
									</td>
									<td>
										<select class="form-control" name="avd_alimen2">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Manipula un vaso y lo lleva a la boca</i>
									</td>
									<td>
										<select class="form-control" name="avd_alimen3">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr><tr>
									<td>
										<i>Tetero</i>
									</td>
									<td>
										<select class="form-control" name="avd_alimen4">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>


								<tr>
									<td rowspan="5" ><h3 class="texto-vertical-3">MENOR Y MAYOR HIGIENE</h3></td>
									<td>
										<i>Utiliza jabón y shampoo</i>
									</td>
									<td>
										<select class="form-control" name="avd_higiene1">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Abre la llave para lavarse las manos</i>
									</td>
									<td>
										<select class="form-control" name="avd_higiene2">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Toma cepillo y lava sus dientes</i>
									</td>
									<td>
										<select class="form-control" name="avd_higiene3">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr><tr>
									<td>
										<i>Utiliza la peinilla para peinarse</i>
									</td>
									<td>
										<select class="form-control" name="avd_higiene4">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Utiliza papel higiénico despues de ir al baño</i>
									</td>
									<td>
										<select class="form-control" name="avd_higiene5">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>

								<tr>
									<td rowspan="4" ><h3 class="texto-vertical-3">Traslados</h3></td>
									<td>
										<i>Se sube a la cama</i>
									</td>
									<td>
										<select class="form-control" name="avd_traslado1">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Se baja de la cama</i>
									</td>
									<td>
										<select class="form-control" name="avd_traslado2">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Se traslada de silla a cama</i>
									</td>
									<td>
										<select class="form-control" name="avd_traslado3">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr><tr>
									<td>
										<i>Se traslada de la cama a la silla</i>
									</td>
									<td>
										<select class="form-control" name="avd_traslado4">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
							</table>
						</article>
						<article class="col-xs-4">
							<table class="table table-bordered">
								<tr>
									<td rowspan="11" ><h3 class="texto-vertical-3">VESTIDO</h3></td>
									<td>
										<i>Se quita la camiseta</i>
									</td>
									<td>
										<select class="form-control" name="avd_vestido1">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Se pone la camiseta</i>
									</td>
									<td>
										<select class="form-control" name="avd_vestido2">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Se quita los pantalones</i>
									</td>
									<td>
										<select class="form-control" name="avd_vestido3">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr><tr>
									<td>
										<i>Se pone los pantalones</i>
									</td>
									<td>
										<select class="form-control" name="avd_vestido4">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>

									<td>
										<i>Se quita la medias</i>
									</td>
									<td>
										<select class="form-control" name="avd_vestido5">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Se pone la medias</i>
									</td>
									<td>
										<select class="form-control" name="avd_vestido6">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Se quita los zapatos</i>
									</td>
									<td>
										<select class="form-control" name="avd_vestido7">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr><tr>
									<td>
										<i>Se pone los zapatos</i>
									</td>
									<td>
										<select class="form-control" name="avd_vestido8">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr><tr>

									<td>
										<i>Se amarra la zapatos</i>
									</td>
									<td>
										<select class="form-control" name="avd_vestido9">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Se abotona</i>
									</td>
									<td>
										<select class="form-control" name="avd_vestido10">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Se sube cierre</i>
									</td>
									<td>
										<select class="form-control" name="avd_vestido11">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
							</table>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#senso" >ACTIVIDADES BASICAS COTIDIANAS</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="senso">
						<article class="col-xs-12">
							<table class="table table-bordered">
								<tr>
									<td rowspan="10" ><h3 class="texto-vertical-3">HOGAR</h3></td>
									<td rowspan="5">
										<i>Limpieza / arreglo de la casa</i>
									</td>
									<td>
										<i>lava platos</i>
									</td>
									<td>
										<select class="form-control" name="abc_1">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Barre espacios</i>
									</td>
									<td>
										<select class="form-control" name="abc_2">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Trapea espacios</i>
									</td>
									<td>
										<select class="form-control" name="abc_3">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr><tr>
									<td>
										<i>Limpia el polvo</i>
									</td>
									<td>
										<select class="form-control" name="abc_4">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>

									<td>
										<i>Tender la cama</i>
									</td>
									<td>
										<select class="form-control" name="abc_5">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td rowspan="2">
										<i>Lavado / arreglo de ropa</i>
									</td>
									<td>
										<i>Lava prendas pequeñas</i>
									</td>
									<td>
										<select class="form-control" name="abc_6">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<i>Lava prendas medianas y grandes</i>
									</td>
									<td>
										<select class="form-control" name="abc_7">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr><tr>
									<td colspan="2">
										<i>Usa el teléfono fijo y/o celular</i>
									</td>
									<td>
										<select class="form-control" name="abc_8">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr><tr>

									<td colspan="2">
										<i>Manejo de dinero</i>
									</td>
									<td>
										<select class="form-control" name="abc_9">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<i>Realiza compra de artículos</i>
									</td>
									<td>
										<select class="form-control" name="abc_10">
											<option value="Independiente">Independiente</option>
											<option value="Semi-independiente">Semi-independiente</option>
											<option value="Dependiente">Dependiente</option>
										</select>
									</td>
								</tr>
							</table>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!--Anamnesis-->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#is" >INTEGRACIÓN SENSORIAL</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
				<section class="collapse" id="is">
					<article class="col-xs-12">
						<table class="table table-bordered">
							<tr>
								<td colspan="3"></td>
								<td class="text-center"><strong>Observaciones</strong></td>
							</tr>
							<tr>
								<td rowspan="4" ><h3 class="texto-vertical-3">Sistema Auditivo</h3></td>
								<td>
									<p>Reacciona de forma negativa a los sonidos fuertes e inesperados</p>
								</td>
								<td class="col-xs-1">
									<select class="form-control" name="is_auditivo1">
										<option value="SI">SI</option>
										<option value="NO">NO</option>
									</select>
								</td>
								<td rowspan="4" class="col-xs-6">
									<textarea class="form-control" name="obs_isauditivo" rows="10" id="comment" ></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<p>Se tapa las orejas con frecuencia ante los ruidos</p>
								</td>
								<td class="col-xs-1">
									<select class="form-control" name="is_auditivo2">
										<option value="SI">SI</option>
										<option value="NO">NO</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<p>Se distrae ante los sonidos de fondo o cualquier ruido</p>
								</td>
								<td class="col-xs-1">
									<select class="form-control" name="is_auditivo3">
										<option value="SI">SI</option>
										<option value="NO">NO</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<p>Se angustia y sobreexita en entorno muy ruidoso o con mucha gente</p>
								</td>
								<td class="col-xs-1">
									<select class="form-control" name="is_auditivo4">
										<option value="SI">SI</option>
										<option value="NO">NO</option>
									</select>
								</td>
							</tr>
							<tr>
								<td rowspan="3" ><h3 class="texto-vertical-3">Visual</h3></td>
								<td>
									<p>Le molesta mucho la luz</p>
								</td>
								<td class="col-xs-1">
									<select class="form-control" name="is_visual1">
										<option value="SI">SI</option>
										<option value="NO">NO</option>
									</select>
								</td>
								<td rowspan="3" class="col-xs-6">
									<textarea class="form-control" name="obs_isvisual" rows="10" id="comment" ></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<p>Tiene dificultad para subir y bajar escaleras</p>
								</td>
								<td class="col-xs-1">
									<select class="form-control" name="is_visual2">
										<option value="SI">SI</option>
										<option value="NO">NO</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<p>No mira a los ojos (Evita el contacto visual)</p>
								</td>
								<td class="col-xs-1">
									<select class="form-control" name="is_visual3">
										<option value="SI">SI</option>
										<option value="NO">NO</option>
									</select>
								</td>
							</tr>
							<tr>
								<td rowspan="4" ><h3 class="texto-vertical-3">Gustativo y Olfativo</h3></td>
								<td>
									<p>Evita ciertos alimentos que son tipicos en la dieta infantil</p>
								</td>
								<td class="col-xs-1">
									<select class="form-control" name="is_gusolf1">
										<option value="SI">SI</option>
										<option value="NO">NO</option>
									</select>
								</td>
								<td rowspan="4" class="col-xs-6">
									<textarea class="form-control" name="obs_isgusolf" rows="10" id="comment" ></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<p>Siempre olfatea los objetos aunque no sean comida</p>
								</td>
								<td class="col-xs-1">
									<select class="form-control" name="is_gusolf2">
										<option value="SI">SI</option>
										<option value="NO">NO</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<p>Le dan asco ciertos alimentos por su textura</p>
								</td>
								<td class="col-xs-1">
									<select class="form-control" name="is_gusolf3">
										<option value="SI">SI</option>
										<option value="NO">NO</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<p>Le dan asco o le molestan determinados olores fuertes</p>
								</td>
								<td class="col-xs-1">
									<select class="form-control" name="is_gusolf4">
										<option value="SI">SI</option>
										<option value="NO">NO</option>
									</select>
								</td>
							</tr>
							<tr>
								<td rowspan="4" ><h3 class="texto-vertical-3">Vestibular</h3></td>
								<td>
									<p>Se muestra ansioso y temeroso cuando es elevado del suelo (Cuando sus pies se separan del suelo)</p>
								</td>
								<td class="col-xs-1">
									<select class="form-control" name="is_vestibular1">
										<option value="SI">SI</option>
										<option value="NO">NO</option>
									</select>
								</td>
								<td rowspan="4" class="col-xs-6">
									<textarea class="form-control" name="obs_isvestibular" rows="10" id="comment" ></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<p>Constantemente busca actividades que le proporcione movimiento</p>
								</td>
								<td class="col-xs-1">
									<select class="form-control" name="is_vestibular2">
										<option value="SI">SI</option>
										<option value="NO">NO</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<p>Siempre busca el movimient, no puede parar de moverse</p>
								</td>
								<td class="col-xs-1">
									<select class="form-control" name="is_vestibular3">
										<option value="SI">SI</option>
										<option value="NO">NO</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<p>Es demasiado miedoso, se mueve por el espacio con inseguridad</p>
								</td>
								<td class="col-xs-1">
									<select class="form-control" name="is_vestibular4">
										<option value="SI">SI</option>
										<option value="NO">NO</option>
									</select>
								</td>
							</tr>
							<td rowspan="3" ><h3 class="texto-vertical-3">Propioceptivo</h3></td>
							<td>
								<p>Choca con las personas, los objetos o muebles con frecuencia</p>
							</td>
							<td class="col-xs-1">
								<select class="form-control" name="is_propio1">
									<option value="SI">SI</option>
									<option value="NO">NO</option>
								</select>
							</td>
							<td rowspan="3" class="col-xs-6">
								<textarea class="form-control" name="obs_ispropio" rows="10" id="comment" ></textarea>
							</td>
						</tr>
						<tr>
							<td>
								<p>Es más flexible, flácido, se cansa con facilidad</p>
							</td>
							<td class="col-xs-1">
								<select class="form-control" name="is_propio2">
									<option value="SI">SI</option>
									<option value="NO">NO</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<p>Camina en puntillas, tiene mal control postural</p>
							</td>
							<td class="col-xs-1">
								<select class="form-control" name="is_propio3">
									<option value="SI">SI</option>
									<option value="NO">NO</option>
								</select>
							</td>
						</tr>
						<td rowspan="5" ><h3 class="texto-vertical-3">Tactil</h3></td>
						<td>
							<p>Evita los juegos sucios con manipulacion de elementos como barro, plastilina, pintura de dedos</p>
						</td>
						<td class="col-xs-1">
							<select class="form-control" name="is_tactil1">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</td>
						<td rowspan="5" class="col-xs-6">
							<textarea class="form-control" name="obs_istactil" rows="11" id="comment" ></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<p>Es sensible ante determinadas prendas de vestir</p>
						</td>
						<td class="col-xs-1">
							<select class="form-control" name="is_tactil2">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<p>Siempre está tocando las personas buscando el contacto físico</p>
						</td>
						<td class="col-xs-1">
							<select class="form-control" name="is_tactil3">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<p>Le disgusta caminar descalzo, sobre la arena, sobre la hierba</p>
						</td>
						<td class="col-xs-1">
							<select class="form-control" name="is_tactil4">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<p>Es insensible al dolor, no se quejaaunque la herida sea importante</p>
						</td>
						<td class="col-xs-1">
							<select class="form-control" name="is_tactil5">
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
						</td>
					</tr>
						</table>
					</article>

				</section>
			</section>

	<div class="row text-center">
	  	<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
