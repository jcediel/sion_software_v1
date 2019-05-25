<form action="<?php echo PROGRAMA;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
	  <?php
	    include("consulta_paciente.php");
	  ?>
	</section>

		<article>
			<h4 id="th-estilot">Datos de Valoración inicial Terapia Ocupacional Domiciliarios</h4>

				<section class="panel-body"> <!---->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#anamnesis" >Motivo de Consulta</a>
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
							<input type="time" name="hreg" value="<?php echo $date1 ;?>" class="form-control" >
						</article>
						<article class="col-xs-12">
							<label for="">Motivo de consulta:</label>
							<textarea name="motivo_consulta" class="form-control" rows="5" cols="40"></textarea>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!---->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#aspectofisico" >Aspecto Fisico (Amplitud Muscular, Fuerza Muscular Resistencia)</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="aspectofisico">
						<article class="col-xs-12">
							<table class="table table-bordered">
								<tr>
									<td>SEGMENTO</td>
									<td>A.A HEM. DERECHO</td>
									<td>A.A HEM. IZQUIERDA</td>
									<td>F.M HEM. DERECHO</td>
									<td>F.M HEM. IZQUIRDA</td>
								</tr>
								<tr>
									<td colspan="5" class="text-center">
										CUELLO
									</td>
								</tr>
								<tr>
                  <td>FLEXION</td>
                  <td><select class="form-control" name="cuello1_aa_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="cuello1_aa_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="cuello1_fm_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="cuello1_fm_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>EXTENSION</td>
                  <td><select class="form-control" name="cuello2_aa_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="cuello2_aa_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="cuello2_fm_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="cuello2_fm_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>INCLINACION LATERAL</td>
                  <td><select class="form-control" name="cuello3_aa_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="cuello3_aa_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="cuello3_fm_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="cuello3_fm_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
									<td colspan="5" class="text-center">
										ESCAPATULA
									</td>
								</tr>
								<tr>
                  <td>ELEVACION</td>
                  <td><select class="form-control" name="esca1_aa_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="esca1_aa_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="esca1_fm_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="esca1_fm_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>ABD</td>
                  <td><select class="form-control" name="esca2_aa_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="esca2_aa_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="esca2_fm_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="esca2_fm_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>ADD</td>
                  <td><select class="form-control" name="esca3_aa_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="esca3_aa_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="esca3_fm_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="esca3_fm_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>DEPRESION</td>
                  <td><select class="form-control" name="esca4_aa_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="esca4_aa_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="esca4_fm_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="esca4_fm_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
									<td colspan="5" class="text-center">
										HOMBRO
									</td>
								</tr>
								<tr>
                  <td>FLEXION(90 y 180 grados)</td>
                  <td><select class="form-control" name="hom1_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom1_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom1_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom1_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>EXTENSION(45 grados)</td>
                  <td><select class="form-control" name="hom2_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom2_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom2_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom2_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>ABD(180 grados)</td>
                  <td><select class="form-control" name="hom3_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom3_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom3_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom3_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>ABD Horizontal(90 grados)</td>
                  <td><select class="form-control" name="hom4_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom4_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom4_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom4_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>Rotacion Externa(90 grados)</td>
                  <td><select class="form-control" name="hom5_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom5_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom5_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom5_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>Rotacion interna(45 grados)</td>
                  <td><select class="form-control" name="hom6_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom6_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom6_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="hom6_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
									<td colspan="5" class="text-center">
										CODO
									</td>
								</tr>
								<tr>
                  <td>Flexion(150 grados)</td>
                  <td><select class="form-control" name="codo1_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="codo1_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="codo1_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="codo1_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>EXTENSION(150 a 0)</td>
                  <td><select class="form-control" name="codo2_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="codo2_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="codo2_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="codo2_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>Supinacion(90)</td>
                  <td><select class="form-control" name="codo3_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="codo3_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="codo3_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="codo3_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>Pronacion(80)</td>
                  <td><select class="form-control" name="codo4_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="codo4_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="codo4_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="codo4_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
									<td colspan="5" class="text-center">MUÑECA</td>
								</tr>
								<tr>
                  <td>Flexion(80)</td>
                  <td><select class="form-control" name="mun1_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="mun1_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="mun1_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="mun1_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>EXTENSION(70)</td>
                  <td><select class="form-control" name="mun2_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="mun2_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="mun2_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="mun2_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
									<td colspan="5" class="text-center">
										DEDOS
									</td>
								</tr>
								<tr>
                  <td>Flexion(90)</td>
                  <td><select class="form-control" name="dedo1_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="dedo1_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="dedo1_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="dedo1_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>EXTENSION(90 a 0)</td>
                  <td><select class="form-control" name="dedo2_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="dedo2_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="dedo2_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="dedo2_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>ABD(en centimetros)</td>
                  <td><select class="form-control" name="dedo3_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="dedo3_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="dedo3_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="dedo3_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>ADD</td>
                  <td><select class="form-control" name="dedo4_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="dedo4_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="dedo4_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="dedo4_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
									<td colspan="5" class="text-center">
										TRONCO
									</td>
								</tr>
								<tr>
                  <td>Flexion</td>
                  <td><select class="form-control" name="tronco1_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="tronco1_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="tronco1_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="tronco1_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>EXTENSION</td>
                  <td><select class="form-control" name="tronco2_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="tronco2_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="tronco2_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="tronco2_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
									<td colspan="5" class="text-center">
										MMII
									</td>
								</tr>
								<tr>
                  <td>Cadera</td>
                  <td><select class="form-control" name="mmii1_a_d	">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="mmii1_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="mmii1_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="mmii1_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>Rodilla</td>
                  <td><select class="form-control" name="mmii2_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="mmii2_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="mmii2_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="mmii2_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
								<tr>
                  <td>Cuello de pie</td>
                  <td><select class="form-control" name="mmii3_a_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="mmii3_a_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="mmii3_f_d">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                  <td><select class="form-control" name="mmii3_f_i">
										<option value="No funcional">No funcional</option>
										<option value="Semi-funcional">Semi-funcional</option>
										<option value="Funcional">Funcional</option>
									</select></td>
                </tr>
							</table>

						</article>
						<article class="col-xs-12">
							<label for="">Observaciones</label>
							<textarea name="obs_aspfisico" rows="8" cols="40"></textarea>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!---->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#medidadsespeciales" >Medidas Especiales</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="medidadsespeciales">
						<article class="col-xs-12">
							<table class="table table-bordered">
								<tr>
									<td>ASPECTOS A MEDIR EN CENTIMETROS</td>
									<td>MSD</td>
									<td>MSI</td>
								</tr>
								<tr>
									<td>
										Separacion del primer espacio
									</td>
									<td>
										<input type="text" class="form-control" name="me1_msd" value="">
									</td>
									<td>
										<input type="text" class="form-control" name="me1_msi" value="">
									</td>
								</tr>
								<tr>
									<td>
										Distancia uña palma
									</td>
									<td>
										<input type="text" class="form-control" name="me2_msd" value="">
									</td>
									<td>
										<input type="text" class="form-control" name="me2_msi" value="">
									</td>
								</tr>
								<tr>
									<td>
										Centimetros de oposicion
									</td>
									<td>
										<input type="text" class="form-control" name="me3_msd" value="">
									</td>
									<td>
										<input type="text" class="form-control" name="me3_msi" value="">
									</td>
								</tr>
							</table>
						</article>
					</section>
				</section>
				<section class="panel-body"> <!---->
					<div class="botonhc">
							<a data-toggle="collapse" class="ac" data-target="#areafuncional" >Area Funcional</a>
							<span class="glyphicon glyphicon-arrow-down"></span>
							<span class="badge">OK</span>
					</div>
					<section class="collapse" id="areafuncional">
						<article class="col-xs-12">
							<label for="">Habilidades motoras superiores</label>
							<textarea class="form-control" name="hab_mot_sup" rows="8" cols="40"></textarea>
						</article>
						<article class="col-xs-12">
							<label for="">Habilidades motoras inferiores</label>
							<textarea class="form-control" name="hab_mot_inf" rows="8" cols="40"></textarea>
						</article>
						<article class="col-xs-12">
							<label for="">Habilidades motoras integrales</label>
							<textarea class="form-control" name="hab_mot_int" rows="8" cols="40"></textarea>
						</article>
					</section>
				</section>
	<div class="row text-center">
	  	<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>

</form>
