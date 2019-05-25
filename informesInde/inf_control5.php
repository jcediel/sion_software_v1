<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["logo"])){
				if (is_uploaded_file($_FILES["logo"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["logo"]["name"]);
					$archivo=$_POST["doc_ips"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["logo"]["tmp_name"],LOG.LOGOS.$archivo)){
						$fotoE=",logo='".LOGOS.$archivo."'";
						$fotoA1=",logoips";
						$fotoA2=",'".LOGOS.$archivo."'";
						}
				}
			}

			switch ($_POST["operacion"]) {
			case 'E':
				$sql="UPDATE ips SET nom_ips='".$_POST["nom_ips"]."',doc_ips='".$_POST["doc_ips"]."',tel_ips='".$_POST["tel_ips"]."',dir_ips='".$_POST["dir_ips"]."'$fotoE,estado_ips='".$_POST["estado_ips"]."' WHERE id_ips=".$_POST["idips"];
				$subtitulo="Actualizado";
			break;
			case 'X':
				$sql="SELECT logoips from ips where id_ips=".$_POST["idips"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="DELETE FROM ips WHERE id_ips=".$_POST["idips"];
				$subtitulo="Eliminado";
			break;
			case 'A':
				$sql="INSERT INTO ips (nom_ips,doc_ips,tel_ips,dir_ips$fotoA1,estado_ips) VALUES
				('".$_POST["nom_ips"]."','".$_POST["doc_ips"]."','".$_POST["tel_ips"]."','".$_POST["dir_ips"]."'$fotoA2,'".$_POST["estado_ips"]."')";
				$subtitulo="Adicionado";
			break;
		}
		echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro fue $subtitulo con exito!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logoips"])){
				unlink($fila["logoips"]);
			}
			}
		}else{
			$subtitulo="El registro NO fue $subtitulo !!! .";
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'E':
			$sql="SELECT id_ips,nom_ips,doc_ips,tel_ips,dir_ips,logoips,estado_ips FROM  ips where id_ips=".$_GET["idips"];
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de datos de IPS';
			break;
			case 'X':
			$sql="SELECT id_ips,nom_ips,doc_ips,tel_ips,dir_ips,logoips,estado_ips FROM  ips where id_ips=".$_GET["idips"];
			$color="red";
			$boton="Eliminar";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$subtitulo='Confirmación para eliminar de datos de IPS';
			break;
			case 'A':
			$sql="";
			$color="yellow";
			$boton="Crear";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Creación de IPS';
			break;
		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_ips"=>"","nom_ips"=>"","doc_ips"=>"","tel_ips"=>"","dir_ips"=>"","logo"=>"","estado_ips"=>"" );

			}
		}else{
				$fila=array("id_ips"=>"","nom_ips"=>"","doc_ips"=>"","tel_ips"=>"","dir_ips"=>"","logo"=>"","estado_ips"=>"" );
			}

		?>

<?php
}else{
	echo $subtitulo;
// nivel 1?>
<section class="panel panel-default">
	<section class="panel-heading">
		<h2>Informes de control INDE</h2>
	</section>
	<section class="panel-body">
		<section class="panel-body">
			<section class="col-md-12">
				<form>
					<div class="row">
						<div class="col-md-3">
								<label for="">Fecha inicial: </label>
								<input type="date" class="form-control" name="f1">
						</div><!-- /.col-lg-6 -->
						<div class="col-md-3">
								<label for="">Fecha final: </label>
								<input type="date" class="form-control" name="f2">
						</div>
						<div class="col-md-3">
							<label for="">Tipo reporte: </label>
							<select class="form-control" required name="reporte">
								<option value=""></option>
								<option value="1">Atención en medicina general</option>
							</select>
						</div>
						<div class="col-md-4">
							<label for="">Filtro EPS: </label>
							<select class="form-control input-sm" required="" name="eps">
			          <option value="12,13,14,15,16,17,18,19,20,21,22,23,24,25">Todas</option>
			          <?php
			          $sql="SELECT id_eps,nom_eps from eps where estado_eps='Activo' ORDER BY id_eps ASC";
			          if($tabla=$bd1->sub_tuplas($sql)){
			            foreach ($tabla as $fila2) {
			              if ($fila["id_eps"]==$fila2["id_eps"]){
			                $sw=' selected="selected"';
			              }else{
			                $sw="";
			              }
			            echo '<option value="'.$fila2["id_eps"].'"'.$sw.'>'.$fila2["nom_eps"].'</option>';
			            }
			          }
			          ?>
			        </select>
						</div>
						<div class="col-md-4">
							<label for="">Filtro SEDES: </label>
							<select class="form-control input-sm" required="" name="sede">
			          <option value="4,5">Todas</option>
			          <?php
			          $sql="SELECT id_sedes_ips,nom_sedes FROM sedes_ips WHERE estado_sedes='Activo' and id_sedes_ips in (4,5) ORDER BY id_sedes_ips ASC";
			          if($tabla=$bd1->sub_tuplas($sql)){
			            foreach ($tabla as $fila2) {
			              if ($fila["id_sedes_ips"]==$fila2["id_sedes_ips"]){
			                $sw=' selected="selected"';
			              }else{
			                $sw="";
			              }
			            echo '<option value="'.$fila2["id_sedes_ips"].'"'.$sw.'>'.$fila2["nom_sedes"].'</option>';
			            }
			          }
			          ?>
			        </select>
						</div>
						<div class="col-md-3">
							<br>
							<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
							<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
						</div>
					</div>
				</form>
			</section>
		</section>
		<section class="panel-body">
			<table class="table table-bordered table-responsive">
				<?php
				$f1=$_REQUEST['f1'];
				$f2=$_REQUEST['f2'];
				$reporte=$_REQUEST['reporte'];
				$eps=$_REQUEST['eps'];
				$sede=$_REQUEST['sede'];
				if ($reporte==1) {
					echo '<tr>
								 <td colspan="4" class="success"><h4>ATENCIÓN MEDICINA GENERAL</h4></td>
								 <td class="text-right success">
								 	<a href="rptexcel/rptinde1.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
									<button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
									<a href="rptpdf/rptinde1.php?f1='.$_REQUEST["f1"].'&f2='.$_REQUEST["f2"].'&eps='.$_REQUEST["eps"].'&sede='.$_REQUEST["sede"].'">
									<button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
								 </td>
								</tr>
								<tr>
								 <th class="text-center">#</th>
								 <th class="text-center">PACIENTE</th>
								 <th class="text-center">SEDE/EPS</th>
								 <th class="text-center">REGISTRO</th>
								 <th class="text-center">EVOLUCION</th>
								</tr>';
					$sql1="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
												b.id_adm_hosp,fnacimiento,
												c.nom_sedes,
												d.nom_eps,
												e.freg_evomed, hreg_evomed, objetivo, subjetivo, analisis_evomed, plan_tratamiento, ddxp, tdxp, ddx1, tdx1, ddx2, tdx2, resp_evomed, estado_evomed
								 FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
								 									INNER JOIN sedes_ips c on c.id_sedes_ips=b.id_sedes_ips
																	INNER JOIN eps d on d.id_eps=b.id_eps
																	INNER JOIN evo_medgen_inde e on e.id_adm_hosp=b.id_adm_hosp
								 WHERE b.id_eps in ($eps) and b.id_sedes_ips in ($sede)
								 													and b.tipo_servicio='Medicina General INDE'
																					and e.freg_evomed BETWEEN '$f1' and '$f2'
								 ORDER BY 2,9 ASC";
				}
				//echo $sql1;
				$i=1;
				if ($tabla=$bd1->sub_tuplas($sql1)){
					foreach ($tabla as $fila1) {
						if ($reporte==1) {
							$fecha=$fila["fnacimiento"];
							$segundos= strtotime('now') - strtotime($fecha);
							$diferencia_dias=intval($segundos /60/60/24);
							$dias=floor($diferencia_dias/365);
							echo"<tr >\n";
								echo'<td class="text-center text-danger"><strong>'.$i++.'</strong>
										 </td>';
								echo'<td class="text-center">
											<p>'.$fila1["nom1"].' '.$fila1["nom2"].' '.$fila1["ape1"].' '.$fila1["ape2"].'</p>
											<p><strong>'.$fila1["tdoc_pac"].' </strong>: '.$fila1["doc_pac"].'  <strong> ADM: </strong>'.$fila1["id_adm_hosp"].'</p>
										 </td>';
								echo'<td class="text-left">
								      <p><strong>EPS: </strong> '.$fila1["nom_eps"].' <strong>SEDE: </strong>'.$fila1["nom_sedes"].'</p>
										 </td>';
								echo'<td class="text-left">
		 								  <p><strong>Fecha registro: </strong> '.$fila1["freg_evomed"].'</p>
											<p><strong>Hora registro: </strong>'.$fila1["hreg_evomed"].'</p>
		 								 </td>';
							  echo'<td class="text-justify">
										  <p><strong>Objetivo: </strong> <br><small>'.$fila1["objetivo"].'</small></p>
										  <p><strong>Subjetivo: </strong> <br><small>'.$fila1["subjetivo"].'</small></p>
											<p><strong>Analisis: </strong> <br><small>'.$fila1["analisis_evomed"].'</small></p>
											<p><strong>Plan tratamiento: </strong> <br><small>'.$fila1["plan_tratamiento"].'</small></p>
											<p><strong>Dxp: </strong> <br>'.$fila1["ddxp"].' '.$fila1["tdxp"].'</p>
											<p><strong>Dx1: </strong> <br>'.$fila1["ddx1"].' '.$fila1["tdx1"].'</p>
											<p><strong>Dx2: </strong> <br>'.$fila1["ddx2"].' '.$fila1["tdx2"].'</p>
										 </td>';
							echo "</tr>\n";
						}
					}
				}
				 ?>
			</table>
		</section>
	</section>
</section>
	<?php
}
?>
