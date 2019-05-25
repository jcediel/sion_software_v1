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

			case 'EVO':
				$sql="INSERT INTO post_hospitalizado (id_adm_hosp, id_user, obs_posthosp ) VALUES
				('".$_POST["id_adm_hosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["obs_posthosp"]."')";
				$subtitulo="Post - Hospitalización";
				$subtitulo1="Adicionado";
				$subtitulo2="Trabajo social";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El formato de $subtitulo en $subtitulo2 fue $subtitulo1 con exito!";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El formato de $subtitulo en $subtitulo2 NO fue $subtitulo1 !!! .";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {

			case 'EVO':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,
			tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
									left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
				$boton="Agregar Evolucion";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$form1='formulariosHOSP/postventa.php';
				$subtitulo='Registro de post-hospitalización';
				break;

		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"",
				"edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"",
				"lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"",
				"fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"",
				"edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"",
				"lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"",
				"fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
			}

		?>

		<?php include($form1);?>

<?php
}else{
	if ($check=='si') {
		echo '<div class="alert alert-success animated bounceInRight">';
		echo $subtitulo;
		echo '</div>';
	}else {
		echo '<div class="alert alert-danger animated bounceInRight">';
		echo $subtitulo;
		echo '</div>';
	}
// nivel 1?>
<section class="panel panel-default">
	<section class="panel-heading"><h3>Registro Trabajo Social post Hospitalización (Salud Mental)</h3></section>
	<section class="panel-body">
		<section class="col-md-6">
			<form>
				<div class="row">
					<div class="col-lg-12">
						<div class="input-group">
							<input type="text" class="form-control" name="doc" placeholder="Digite identificación">
							<span class="input-group-btn">
									<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
									<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
							</span>
						</div><!-- /input-group -->
					</div><!-- /.col-lg-6 -->
				</div>
			</form>
			<br>
			<form>
				<div class="row">
					<div class="col-lg-12">
						<div class="input-group">
							<input type="text" class="form-control" name="nom" placeholder="Digite nombre o apellidos">
							<span class="input-group-btn">
									<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
									<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
							</span>
						</div><!-- /input-group -->
					</div><!-- /.col-lg-6 -->
				</div>
			</form>
		</section>
	</section>
	<section class="panel-body">

		<table class="table table-bordered table-responsive">
			<tr>
				<th class="info">ADMISIÓN</th>
				<th class="info">IDENTIFICACION</th>
				<th class="info">NOMBRES Y APELLIDOS</th>
				<th class="info">FECHA INGRESO</th>
				<th class="info">FECHA EGRESO</th>
				<th class="info"></th>
			</tr>

			<?php
			if (isset($_REQUEST["doc"])){
			$doc=$_REQUEST["doc"];
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
									 s.nom_sedes
						FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
						WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Parcial' and tipo_servicio in ('Hospital dia','Hospitalario')";

			if ($tabla=$bd1->sub_tuplas($sql)){
				//echo $sql;
				foreach ($tabla as $fila ) {

					echo"<tr >\n";
					echo'<td class="text-center">'.$fila["id_adm_hosp"].'</td>';
					echo'<td class="text-center">'.$fila["doc_pac"].'</td>';
					echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
					echo'<td class="text-center">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
					echo'<td class="text-center">'.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'</td>';
					echo'<th class="text-center">
								<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-stethoscope"></span></button></a>
							 </th>';
					echo "</tr>\n";
				}
			}
			}	if (isset($_REQUEST["nom"])){
			$doc=$_REQUEST["nom"];
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
									 s.nom_sedes
						FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
						WHERE p.nom1 LIKE '%".$doc."%' and a.estado_adm_hosp='Parcial' and tipo_servicio in ('Hospital dia','Hospitalario')";

			if ($tabla=$bd1->sub_tuplas($sql)){
				//echo $sql;
				foreach ($tabla as $fila ) {

					echo"<tr >\n";
					echo'<td class="text-center">'.$fila["id_adm_hosp"].'</td>';
					echo'<td class="text-center">'.$fila["doc_pac"].'</td>';
					echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
					echo'<td class="text-center">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
					echo'<td class="text-center">'.$fila["fegreso_hosp"].' | '.$fila["hegreso_hosp"].'</td>';
					echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Hospitalario"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-stethoscope"></span></button></a></th>';
					echo "</tr>\n";
				}
			}
			}
			?>
		<table>
	</section>
</section>

	<?php
}
?>
