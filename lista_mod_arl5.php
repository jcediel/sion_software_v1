<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["fotopac"])){
				if (is_uploaded_file($_FILES["fotopac"]["tmp_name"])){
					$cfoto=explode(".",$_FILES["fotopac"]["name"]);
					$archivo=$_POST["docpac"].".".$cfoto[count($cfoto)-1];
					if(move_uploaded_file($_FILES["fotopac"]["tmp_name"],LOG.PACIENTES.$archivo)){
						$fotoE=",fotopac='".PACIENTES.$archivo."'";
						$fotoA1=",fotopac";
						$fotoA2=",'".PACIENTES.$archivo."'";
						}
				}
			}
			switch ($_POST["operacion"]) {

			case 'FONOC':
				$sql="UPDATE evo_fono_ce
							SET freg_evofono_ce='".$_POST["freg"]."',hreg_evofono_ce='".$_POST["hreg"]."',
									evolucionfono_ce='".$_POST["evolucion"]."',estado_evofono_ce ='".$_POST['estado']."'
							WHERE id_evofono_ce=".$_POST["idevolucion"];
				$subtitulo="Actualizado";
			break;
			case 'TOC':
			$sql="UPDATE evo_to_ce
						SET freg_evoto_ce='".$_POST["freg"]."',hreg_evoto_ce='".$_POST["hreg"]."',
								evolucionto_ce='".$_POST["evolucion"]."',estado_evoto_ce ='".$_POST['estado']."'
						WHERE id_evoto_ce=".$_POST["idevolucion"];
			$subtitulo="Actualizado";
			break;
			case 'FISIOC':
			$sql="UPDATE evo_fisio_ce
						SET freg_evofisio_ce='".$_POST["freg"]."',hreg_evofisio_ce='".$_POST["hreg"]."',
								evolucionfisio_ce='".$_POST["evolucion"]."',estado_evofisio_ce ='".$_POST['estado']."'
						WHERE id_evofisio_ce=".$_POST["idevolucion"];
			$subtitulo="Actualizado";
			break;
			case 'RESPC':
			$sql="UPDATE evo_tr_ce
						SET freg_evotr_ce='".$_POST["freg"]."',hreg_evotr_ce='".$_POST["hreg"]."',
								evoluciontr_ce='".$_POST["evolucion"]."',estado_evotr_ce ='".$_POST['estado']."'
						WHERE id_evotr_ce=".$_POST["idevolucion"];
			$subtitulo="Actualizado";
			break;
			case 'ARL':
			$sql="UPDATE evolucion_arl
						SET freg_evo_arl='".$_POST["freg"]."',hreg_evo_arl='".$_POST["hreg"]."',
								evolucion_arl='".$_POST["evolucion"]."',estado_evo_arl ='".$_POST['estado']."'
						WHERE id_evoarl=".$_POST["idevolucion"];
			$subtitulo="Actualizado";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro fue $subtitulo con exito!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El registro NO fue $subtitulo !!! .";
		}
	}
}
if (isset($_GET["mante"])){
	///nivel 2
	switch ($_GET["mante"]) {
		case 'FISIOC':
			$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
									 e.id_evofisio_ce id, e.freg_evofisio_ce fecha_evo,e.hreg_evofisio_ce hora_evo,e.evolucionfisio_ce evolucion,e.estado_evofisio_ce estado,e.id_user id_user,
									 f.nombre nombre_usuario, f.firma firmat,
									 g.nom_eps eps,
									 h.nom_sedes sedes
						FROM pacientes a INNER JOIN adm_hospitalario b on (b.id_paciente = a.id_paciente)
														 LEFT JOIN evo_fisio_ce e on (e.id_adm_hosp = b.id_adm_hosp)
														 INNER JOIN user f on (f.id_user = e.id_user)
														 INNER JOIN eps g on (g.id_eps = b.id_eps)
														 INNER JOIN sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
						where b.tipo_servicio in ('Consulta externa REH') and e.id_evofisio_ce='".$_REQUEST['idevo']."'";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de Evolucion '.$_REQUEST['tterapia'].' en servicio '.$_GET['tservicio'];
			$doc=$_GET["doc"];
			$mes=$_GET["mes"];
			$f1=$_GET["f1"];
			$f2=$_GET["f2"];
		break;
		case 'FONOC':
			$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia,
									 e.id_evofono_ce id, e.freg_evofono_ce fecha_evo,e.hreg_evofono_ce hora_evo,e.evolucionfono_ce evolucion,e.estado_evofono_ce estado,e.id_user id_user,
									 f.nombre nombre_usuario, f.firma firmat,
									 g.nom_eps eps,
									 h.nom_sedes sedes
						FROM pacientes a INNER JOIN adm_hospitalario b on (b.id_paciente = a.id_paciente)
														 LEFT JOIN evo_fono_ce e on (e.id_adm_hosp = b.id_adm_hosp)
														 INNER JOIN user f on (f.id_user = e.id_user)
														 INNER JOIN eps g on (g.id_eps = b.id_eps)
														 INNER JOIN sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
						where b.tipo_servicio in ('Consulta externa REH') and e.id_evofono_ce='".$_REQUEST['idevo']."'";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de Evolucion '.$_REQUEST['tterapia'].' en servicio '.$_GET['tservicio'];
			$doc=$_GET["doc"];
			$mes=$_GET["mes"];
			$f1=$_GET["f1"];
			$f2=$_GET["f2"];
		break;
		case 'TOC':
			$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
									 e.id_evoto_ce id, e.freg_evoto_ce fecha_evo,e.hreg_evoto_ce hora_evo,e.evolucionto_ce evolucion,e.estado_evoto_ce estado,e.id_user id_user,
									 f.nombre nombre_usuario, f.firma firmat,
									 g.nom_eps eps,
									 h.nom_sedes sedes
						FROM pacientes a INNER JOIN adm_hospitalario b on (b.id_paciente = a.id_paciente)
														 LEFT JOIN evo_to_ce e on (e.id_adm_hosp = b.id_adm_hosp)
														 INNER JOIN user f on (f.id_user = e.id_user)
														 INNER JOIN eps g on (g.id_eps = b.id_eps)
														 INNER JOIN sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
						where b.tipo_servicio in ('Consulta externa REH') and e.id_evoto_ce='".$_REQUEST['idevo']."'";
						//echo $sql;
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de Evolucion '.$_REQUEST['tterapia'].' en servicio '.$_GET['tservicio'];
			$doc=$_GET["doc"];
			$mes=$_GET["mes"];
			$f1=$_GET["f1"];
			$f2=$_GET["f2"];
		break;
		case 'RESPC':
			$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia,
									 e.id_evotr_ce id, e.freg_evotr_ce fecha_evo,e.hreg_evotr_ce hora_evo,e.evoluciontr_ce evolucion,e.estado_evotr_ce estado,e.id_user id_user,
									 f.nombre nombre_usuario, f.firma firmat,
									 g.nom_eps eps,
									 h.nom_sedes sedes
						FROM pacientes a INNER JOIN adm_hospitalario b on (b.id_paciente = a.id_paciente)
														 LEFT JOIN evo_tr_ce e on (e.id_adm_hosp = b.id_adm_hosp)
														 INNER JOIN user f on (f.id_user = e.id_user)
														 INNER JOIN eps g on (g.id_eps = b.id_eps)
														 INNER JOIN sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
						where b.tipo_servicio in ('Consulta externa REH') and e.id_evotr_ce='".$_REQUEST['idevo']."'";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de Evolucion '.$_REQUEST['tterapia'].' en servicio '.$_GET['tservicio'];
			$doc=$_GET["doc"];
			$mes=$_GET["mes"];
			$f1=$_GET["f1"];
			$f2=$_GET["f2"];
		break;
		case 'ARL':
			$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2 paciente, b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia,
									 e.id_evoarl id, e.freg_evo_arl fecha_evo,e.hreg_evo_arl hora_evo,e.evolucion_arl evolucion,e.estado_evo_arl estado,e.id_user id_user,
									 f.nombre nombre_usuario, f.firma firmat,
									 g.nom_eps eps,
									 h.nom_sedes sedes
						FROM pacientes a INNER JOIN adm_hospitalario b on (b.id_paciente = a.id_paciente)
														 LEFT JOIN evolucion_arl e on (e.id_adm_hosp = b.id_adm_hosp)
														 INNER JOIN user f on (f.id_user = e.id_user)
														 INNER JOIN eps g on (g.id_eps = b.id_eps)
														 INNER JOIN sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
						where b.tipo_servicio in ('ARL') and e.id_evoarl='".$_REQUEST['idevo']."'";
						//echo $sql;
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de Evolucion '.$_REQUEST['tterapia'].' en servicio '.$_GET['tservicio'];
			$doc=$_GET["doc"];
			$mes=$_GET["mes"];
			$f1=$_GET["f1"];
			$f2=$_GET["f2"];
		break;
}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("doc_pac"=>"","nom1"=>"",' ',"nom2"=>"",' ',"ape1"=>"",' ',"ape2"=>"", "id_adm_hosp"=>"" ,"id"=>"" ,"fecha_evo"=>"" ,
				"hora_evo"=>"" ,"evolucion"=>"","estado"=>"");
			}
		}else{
				$fila=array("doc_pac"=>"","nom1"=>"",' ',"nom2"=>"",' ',"ape1"=>"",' ',"ape2"=>"", "id_adm_hosp"=>"" ,"id"=>"" ,"fecha_evo"=>"" ,
				"hora_evo"=>"" ,"evolucion"=>"","estado"=>"");
			}
		?>
		<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nom_cliente.value == ""){
						alert("Se requiere el nombre del cliente!");
						document.forms[0].nom_cliente.focus();				// Ubicar el cursor
						return(false);
				}
			}
		</script>


<form action="<?php echo PROGRAMA.'?fecha1='.$f1.'&fecha2='.$f2.'&mes='.$mes.'&doc='.$doc.'&buscar=Consultar&opcion=79';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
		<section class="panel-heading">
			<h3><?php echo $subtitulo; ?></h3>
		</section>
		<section class="panel-success">
			<section class="panel-heading">
				<h4>Datos del paciente</h4>
			</section>
			<table class="table table-bordered">

			  <?php
			$doc=$_REQUEST['doc'];
			  $sql1="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
			               b.id_adm_hosp,fingreso_hosp,tipo_servicio,
										 c.nom_eps,
										 d.nom_sedes

			      FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
			                       INNER JOIN eps c on b.id_eps=c.id_eps
			                       INNER JOIN sedes_ips d on d.id_sedes_ips=b.id_sedes_ips

			      WHERE b.estado_adm_hosp='Activo' and a.doc_pac=$doc ";
			      //echo $sql;
			if ($tabla1=$bd1->sub_tuplas($sql1)){
			  foreach ($tabla1 as $fila1 ) {

			        echo"<tr >\n";
			        echo'<td class="text-center">
			                <p>'.$fila1["nom1"].' '.$fila1["nom2"].' '.$fila1["ape1"].' '.$fila1["ape2"].'</p>
			                <p><strong>'.$fila1["tdoc_pac"].':</strong> '.$fila1["doc_pac"].'</p>
			             </td>';
			        echo'<td class="text-left">
										 <article class="col-xs-6">
											<p><strong>EPS: </strong>'.$fila1["nom_eps"].'</p>
			                <p><strong>SEDE: </strong>'.$fila1["nom_sedes"].'</p>
										 </article>
										 <article class="col-xs-6">
											<p><strong>Servicio: </strong>'.$fila1["tipo_servicio"].'</p>
										 </article>
			             </td>';
			        echo'<td class="text-center"><img src="'.$fila1["fotopac"].'"alt ="foto" class="image_piso" > </td>';
			        // aqui sería pertinente colocar un boton que me muestre un modal con todas las dosificaciones hechas al paciente en el mes
			        echo"</tr >\n";

			  }
			}
			?>
			</table>
		</section>
		<section class="panel-success">
			<section class="panel-heading">
				<h4>Datos de evolución</h4>
			</section>
			<section class="panel-body">
				<article class="col-xs-2">
					<label for="">Fecha de registro:</label>
					<input type="date" name="freg" value="<?php echo $fila["fecha_evo"] ;?>" class="form-control" >
					<input type="hidden" name="idevolucion" value="<?php echo $fila["id"] ;?>" class="form-control" >

				</article>
				<article class="col-xs-2">
					<label for="">Hora de registro</label>
					<input type="time" name="hreg" value="<?php echo $fila["hora_evo"]  ;?>" class="form-control" >
				</article>
				<article class="col-xs-5">
					<label >Evolucion: <span class="fa fa-info-circle" data-toggle="popover" title="Consolidado de la realidad del paciente" data-content=""></span></label>
					<textarea class="form-control" name="evolucion" rows="6" id="comment" ><?php echo $fila["evolucion"];?></textarea>
				</article>
				<article class="col-xs-3">
					<label for="">Estado :</label>
					<select class="form-control" name="estado">
						<?php
						if ($fila['estado']=='Realizada') {
							echo'<option value='.$fila['estado'].'>'.$fila['estado'].'</option>';
							echo'<option value="Cancelada">Cancelada</option>';
						}else {
							echo'<option value='.$fila['estado'].'>'.$fila['estado'].'</option>';
							echo'<option value="Realizada">Realizada</option>';
						}
						 ?>
					</select>

				</article>
				<br>
				<div class="row text-center col-xs-3">
					<br>
				  <input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
					<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
					<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
				</div>
			</section>
		</section>
	</section>
</form>

<?php
}else{
	echo '<div class="alert alert-success animated bounceInRight">';
	echo $subtitulo;
	echo '</div>';
// nivel 1?>
<div class="panel-default">
<div class="panel-body">
	<section class="panel panel-default" class="col-xs-12" >
		<form>
			<section class="panel-body">
					<article class="col-xs-2">
						<label>Fecha inicial:</label>
						<input type="date" class="form-control" value="<?php echo $_GET["f1"];?>" name="fecha1">
					</article>
					<article class="col-xs-2">
						<label>Fecha Final:</label>
						<input type="date" class="form-control" value="<?php echo $_GET["f2"];?>" name="fecha2">
					</article>
					<article class="col-xs-2">
							<label for="">Seleccione mes:</label>
							<select class="form-control" name="mes">
								<option value="enero">enero</option>
								<option value="febrero">febrero</option>
								<option value="marzo">marzo</option>
								<option value="abril">abril</option>
								<option value="mayo">mayo</option>
								<option value="junio">junio</option>
								<option value="julio">julio</option>
								<option value="agosto">agosto</option>
								<option value="septiembre">septiembre</option>
								<option value="octubre">octubre</option>
								<option value="noviembre">noviembre</option>
								<option value="diciembre">diciembre</option>

							</select>
					</article>
					<article class="col-xs-3">
						<label for="">Numero de identificacion:</label>
							<input type="text" class="form-control" name="doc" value="<?php echo $_GET["docu"];?>" placeholder="Digite Identificacion">
					</article>
					<div class="col-xs-3">
						<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
						<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
					</div>
			</section>
	  </form>
		<br>
	<table class="table table-bordered">

	<tr>
		<th class="danger">PACIENTE</th>
		<th class="danger">TIPO TERAPIA</th>
		<th class="danger">EVOLUCION</th>
		<th class="danger">PROFESIONAL</th>
		<th></th>
	</tr>

	<?php
	if (isset($_REQUEST["doc"])){
	$doc=$_REQUEST["doc"];
	$f1=$_REQUEST["fecha1"];
	$f2=$_REQUEST["fecha2"];
	$sql="SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,
							 b.id_adm_hosp id_adm_hosp,tipo_servicio,
							 e.id_evoarl id, e.freg_evo_arl fecha_evo,e.hreg_evo_arl hora_evo,e.evolucion_arl evolucion,e.estado_evo_arl estado,espec_evo_arl tterapia,
							 f.nombre nombre_usuario, f.firma firmat,
							 g.nom_eps eps,
							 h.nom_sedes sedes
				FROM pacientes a INNER JOIN adm_hospitalario b on (b.id_paciente = a.id_paciente)
												 LEFT JOIN evolucion_arl e on (e.id_adm_hosp = b.id_adm_hosp)
												 INNER JOIN user f on (f.id_user = e.id_user)
												 INNER JOIN eps g on (g.id_eps = b.id_eps)
												 INNER JOIN sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
				WHERE  b.tipo_servicio in ('ARL','Consulta externa REH') and a.doc_pac='".$doc."' and e.freg_evo_arl BETWEEN '".$f1."' and '".$f2."'

				UNION

				SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,
										 b.id_adm_hosp id_adm_hosp,tipo_servicio,
										 e.id_evofisio_ce id, e.freg_evofisio_ce fecha_evo,e.hreg_evofisio_ce hora_evo,e.evolucionfisio_ce evolucion,e.estado_evofisio_ce estado,'FISIOTERAPIA' tterapia,
										 f.nombre nombre_usuario, f.firma firmat,
										 g.nom_eps eps,
										 h.nom_sedes sedes
				FROM pacientes a INNER JOIN adm_hospitalario b on (b.id_paciente = a.id_paciente)
										     LEFT JOIN evo_fisio_ce e on (e.id_adm_hosp = b.id_adm_hosp)
										     INNER JOIN user f on (f.id_user = e.id_user)
										     INNER JOIN eps g on (g.id_eps = b.id_eps)
										     INNER JOIN sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
				WHERE  b.tipo_servicio in ('ARL','Consulta externa REH') and a.doc_pac='".$doc."' and e.freg_evofisio_ce BETWEEN '".$f1."' and '".$f2."'
				UNION

				SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,
										 b.id_adm_hosp id_adm_hosp,tipo_servicio,
										 e.id_evofono_ce id, e.freg_evofono_ce fecha_evo,e.hreg_evofono_ce hora_evo,e.evolucionfono_ce evolucion,e.estado_evofono_ce estado,'FONOAUDIOLOGIA' tterapia,
										 f.nombre nombre_usuario, f.firma firmat,
										 g.nom_eps eps,
										 h.nom_sedes sedes
				FROM pacientes a INNER JOIN adm_hospitalario b on (b.id_paciente = a.id_paciente)
										     LEFT JOIN evo_fono_ce e on (e.id_adm_hosp = b.id_adm_hosp)
										     INNER JOIN user f on (f.id_user = e.id_user)
										     INNER JOIN eps g on (g.id_eps = b.id_eps)
										     INNER JOIN sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
				WHERE  b.tipo_servicio in ('ARL','Consulta externa REH') and a.doc_pac='".$doc."' and e.freg_evofono_ce BETWEEN '".$f1."' and '".$f2."'
				UNION

				SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,
										 b.id_adm_hosp id_adm_hosp,tipo_servicio,
										 e.id_evoto_ce id, e.freg_evoto_ce fecha_evo,e.hreg_evoto_ce hora_evo,e.evolucionto_ce evolucion,e.estado_evoto_ce estado,'TERAPIA OCUPACIONAL' tterapia,
										 f.nombre nombre_usuario, f.firma firmat,
										 g.nom_eps eps,
										 h.nom_sedes sedes
				FROM pacientes a INNER JOIN adm_hospitalario b on (b.id_paciente = a.id_paciente)
										     LEFT JOIN evo_to_ce e on (e.id_adm_hosp = b.id_adm_hosp)
										     INNER JOIN user f on (f.id_user = e.id_user)
										     INNER JOIN eps g on (g.id_eps = b.id_eps)
										     INNER JOIN sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
				WHERE  b.tipo_servicio in ('ARL','Consulta externa REH') and a.doc_pac='".$doc."' and e.freg_evoto_ce BETWEEN '".$f1."' and '".$f2."'
				UNION

				SELECT a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,
										 b.id_adm_hosp id_adm_hosp,tipo_servicio,
										 e.id_evotr_ce id, e.freg_evotr_ce fecha_evo,e.hreg_evotr_ce hora_evo,e.evoluciontr_ce evolucion,e.estado_evotr_ce estado,'RESPIRATORIA' tterapia,
										 f.nombre nombre_usuario, f.firma firmat,
										 g.nom_eps eps,
										 h.nom_sedes sedes
				FROM pacientes a INNER JOIN adm_hospitalario b on (b.id_paciente = a.id_paciente)
										     LEFT JOIN evo_tr_ce e on (e.id_adm_hosp = b.id_adm_hosp)
										     INNER JOIN user f on (f.id_user = e.id_user)
										     INNER JOIN eps g on (g.id_eps = b.id_eps)
										     INNER JOIN sedes_ips h on (h.id_sedes_ips = b.id_sedes_ips)
				WHERE  b.tipo_servicio in ('ARL','Consulta externa REH') and a.doc_pac='".$doc."' and e.freg_evotr_ce BETWEEN '".$f1."' and '".$f2."'
		order by 7,9 ASC	";
		//echo $sql;
	if ($tabla=$bd1->sub_tuplas($sql)){
		foreach ($tabla as $fila ) {
			if ($fila['estado']=='Cancelada') {
				echo"<tr >\n";
				echo'<td class="text-center alert-danger">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p>'.$fila["doc_pac"].'</p>
							<p>'.$fila["estado"].'</p>
						 </td>';
				echo'<td class="text-center alert-danger"><p>'.$fila["tterapia"].'</p><p class="text-primary">'.$fila["tipo_servicio"].'</p></td>';
				echo'<td class="text-justify alert-danger">
							<p><strong>ID EVO:</strong>'.$fila["id"].'</p>
							<p><strong>Fecha:</strong>'.$fila["fecha_evo"].' -<strong> Hora:</strong>'.$fila["hora_evo"].'</p>
							<p>'.$fila["evolucion"].'</p>
						 </td>';
				echo'<td class="text-center alert-danger">'.$fila["nombre_usuario"].'</td>';
				$edad=$fila["doc_pac"];
				$cie=$fila["descricie"];
				if ($fila["tterapia"]=='FISIOTERAPIA' && $fila['tipo_servicio']=='Consulta externa REH') {
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FISIOC
					&idevo='.$fila["id"].'&tterapia='.$fila["tterapia"].'&mes='.$fila["mes"].'
					&tservicio='.$fila["tipo_servicio"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
								<button type="button" class="btn btn-primary sombra_movil" >
								<span class="fa fa-edit"></span></button></a>
							 </th>';
				}
				if ($fila["tterapia"]=='TERAPIA OCUPACIONAL' && $fila['tipo_servicio']=='Consulta externa REH') {
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TOC
					&idevo='.$fila["id"].'&tterapia='.$fila["tterapia"].'&mes='.$fila["mes"].'
					&tservicio='.$fila["tipo_servicio"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
					<button type="button" class="btn btn-primary sombra_movil" >
					<span class="fa fa-edit"></span></button></a></th>';
				}
				if ($fila["tterapia"]=='FONOAUDIOLOGIA' && $fila['tipo_servicio']=='Consulta externa REH') {
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FONOC&idevo='.$fila["id"].'&tterapia='.$fila["tterapia"].'&mes='.$fila["mes"].'&tservicio='.$fila["tipo_servicio"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
					<button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
				}
				if ($fila["tterapia"]=='RESPIRATORIA' && $fila['tipo_servicio']=='Consulta externa REH') {
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=RESPC&idevo='.$fila["id"].'&tterapia='.$fila["tterapia"].'&mes='.$fila["mes"].'&tservicio='.$fila["tipo_servicio"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
					<button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
				}
				//COMPLEMENTARIAS
				if ($fila['tipo_servicio']=='ARL') {
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ARL&idevo='.$fila["id"].'&tterapia='.$fila["tterapia"].'&mes='.$fila["mes"].'&tservicio='.$fila["tipo_servicio"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
					<button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
				}
				echo "</tr>\n";
			}else {
				echo"<tr >\n";
				echo'<td class="text-center ">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p>'.$fila["doc_pac"].'</p>
							<p>'.$fila["estado"].'</p>
						 </td>';
				echo'<td class="text-center "><p>'.$fila["tterapia"].'</p><p class="text-primary">'.$fila["tipo_servicio"].'</p></td>';
				echo'<td class="text-justify ">
							<p><strong>ID EVO:</strong>'.$fila["id"].'</p>
							<p><strong>Fecha:</strong>'.$fila["fecha_evo"].' -<strong> Hora:</strong>'.$fila["hora_evo"].'</p>
							<p>'.$fila["evolucion"].'</p>
						 </td>';
				echo'<td class="text-center ">'.$fila["nombre_usuario"].'</td>';
				$edad=$fila["doc_pac"];
				$cie=$fila["descricie"];
				if ($fila["tterapia"]=='FISIOTERAPIA' && $fila['tipo_servicio']=='Consulta externa REH') {
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FISIOC&idevo='.$fila["id"].'&tterapia='.$fila["tterapia"].'&mes='.$fila["mes"].'&tservicio='.$fila["tipo_servicio"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
								<button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-edit"></span></button></a>
							 </th>';
				}
				if ($fila["tterapia"]=='TERAPIA OCUPACIONAL' && $fila['tipo_servicio']=='Consulta externa REH') {
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=TOC
					&idevo='.$fila["id"].'&tterapia='.$fila["tterapia"].'&mes='.$fila["mes"].'
					&tservicio='.$fila["tipo_servicio"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
					<button type="button" class="btn btn-primary sombra_movil" >
					<span class="fa fa-edit"></span></button></a></th>';
				}
				if ($fila["tterapia"]=='FONOAUDIOLOGIA' && $fila['tipo_servicio']=='Consulta externa REH') {
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=FONOC&idevo='.$fila["id"].'&tterapia='.$fila["tterapia"].'&mes='.$fila["mes"].'&tservicio='.$fila["tipo_servicio"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
					<button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
				}
				if ($fila["tterapia"]=='RESPIRATORIA' && $fila['tipo_servicio']=='Consulta externa REH') {
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=RESPC&idevo='.$fila["id"].'&tterapia='.$fila["tterapia"].'&mes='.$fila["mes"].'&tservicio='.$fila["tipo_servicio"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
					<button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
				}
				//COMPLEMENTARIAS
				if ($fila['tipo_servicio']=='ARL') {
					echo'<th class="text-center "><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ARL&idevo='.$fila["id"].'&tterapia='.$fila["tterapia"].'&mes='.$fila["mes"].'&tservicio='.$fila["tipo_servicio"].'&doc='.$fila["doc_pac"].'&f1='.$f1.'&f2='.$f2.'">
					<button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-edit"></span></button></a></th>';
				}
				echo "</tr>\n";
			}
		}
		$fechaactual=$_REQUEST["mes"];
		$y=date('Y');
		//echo $fechaactual;
		if ($fechaactual=='enero') {
			$f1=$y.'-01-01';
			$f2=$y.'-01-31';
		}
		if ($fechaactual=='febrero') {
			$f1=$y.'-02-01';
			$f2=$y.'-02-31';
		}
		if ($fechaactual=='marzo') {
			$f1=$y.'-03-01';
			$f2=$y.'-03-31';
		}
		if ($fechaactual=='abril') {
			$f1=$y.'-04-01';
			$f2=$y.'-04-31';
		}
		if ($fechaactual=='mayo') {
			$f1=$y.'-05-01';
			$f2=$y.'-05-31';
		}
		if ($fechaactual=='junio') {
			$f1=$y.'-06-01';
			$f2=$y.'-06-31';
		}
		if ($fechaactual=='julio') {
			$f1=$y.'-07-01';
			$f2=$y.'-07-31';
		}
		if ($fechaactual=='agosto') {
			$f1=$y.'-08-01';
			$f2=$y.'-08-31';
		}
		if ($fechaactual=='septiembre') {
			$f1=$y.'-09-01';
			$f2=$y.'-09-31';
		}
		if ($fechaactual=='octubre') {
			$f1=$y.'-10-01';
			$f2=$y.'-10-31';
		}
		if ($fechaactual=='noviembre') {
			$f1=$y.'-11-01';
			$f2=$y.'-11-31';
		}
		if ($fechaactual=='diciembre') {
			$f1=$y.'-12-01';
			$f2=$y.'-12-31';
		}
		$id=$fila["id_adm_hosp"];
		$sql1="select b.id_adm_hosp id_adm_hosp,espec_evo_arl tipo_terapia, count(b.id_adm_hosp) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join evolucion_arl e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."'  and e.estado_evo_arl='Realizada' and e.freg_evo_arl between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp
		union
		select b.id_adm_hosp id_adm_hosp,'TERAPIA OCUPACIONAL' tipo_terapia, count(b.id_adm_hosp) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join evo_to_ce e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."'  and e.estado_evoto_ce='Realizada' and e.freg_evoto_ce between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp
		union
		select b.id_adm_hosp id_adm_hosp,'FONOAUDIOLOGIA' tipo_terapia, count(b.id_adm_hosp) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join evo_fono_ce e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."'  and e.estado_evofono_ce='Realizada' and e.freg_evofono_ce between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp
		union
		select b.id_adm_hosp id_adm_hosp,'RESPIRATORIA' tipo_terapia, count(b.id_adm_hosp) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join evo_tr_ce e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."'  and e.estado_evotr_ce='Realizada' and e.freg_evotr_ce between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp
		union
		select b.id_adm_hosp id_adm_hosp,'FISIOTERAPIA' tipo_terapia, count(b.id_adm_hosp) cuantas
		from pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)
										 inner join evo_fisio_ce e on (e.id_adm_hosp = b.id_adm_hosp)
		where b.id_adm_hosp='".$id."'  and e.estado_evofisio_ce='Realizada' and e.freg_evofisio_ce between '".$f1."' and '".$f2."'
		group by b.id_adm_hosp

		";
		//echo $sql1;
		if ($tabla=$bd1->sub_tuplas($sql1)){
			foreach ($tabla as $fila1 ) {
				echo"<tr> \n";
				echo'<td class="text-center alert-info">Evoluciones realizadas de: '.$fila1["tipo_terapia"].'</td>';
				echo'<td class="text-center">'.$fila1["cuantas"].'</td>';
				echo "</tr>\n";
			}
		}
	}
}
	?>

</table>

</div>
</div>
	<?php
}
?>
