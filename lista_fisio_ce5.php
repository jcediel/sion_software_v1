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
			case 'VI':
				/*$adm=$_POST['idadmhosp'];
				$sql_valini="SELECT id_valini_ce,freg,tterapia FROM val_ini_ce WHERE id_adm_hosp=$adm and tterapia='FISIOTERAPIA'";
				if ($tabla_valini=$bd1->sub_tuplas($sql_valini)){
					foreach ($tabla_valini as $fila_valini) {

					}
				}*/
				$sql="INSERT INTO val_ini_ce (id_adm_hosp, id_user, freg, hreg, m_consulta, e_actual, ant_alergicos, ant_patologico, ant_quirurgico, ant_toxicologico,
					ant_farmaco, ant_gineco, ant_psiquiatrico, ant_hospitalario, ant_traumatologico, ant_familiar, otros_ant, Valoracion, dxp, tdxp, dx1, tdx1, dx2, tdx2,
					dx3, tdx3, tterapia, recomendaciones,plan_tratamiento,estado_valini) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["m_consulta"]."', '".$_POST["e_actual"]."',
				'".$_POST["antalergico"]."', '".$_POST["antpatologico"]."', '".$_POST["antquirurgico"]."', '".$_POST["anttoxicologicos"]."','".$_POST["antfarmacologico"]."',
				'".$_POST["antgineco"]."', '".$_POST["antpsiquiatrico"]."', '".$_POST["anthospitalario"]."', '".$_POST["anttrauma"]."', '".$_POST["antfami"]."',
				'".$_POST["antotros"]."', '".$_POST["valoracion"]."','".$_POST["dx"]."', '".$_POST["tdx"]."', '".$_POST["dx1"]."', '".$_POST["tdx1"]."', '".$_POST["dx2"]."', '".$_POST["tdx2"]."',
				'".$_POST["dx3"]."', '".$_POST["tdx3"]."', '".$_SESSION["AUT"]["especialidad"]."','".$_POST["recomendaciones"]."', '".$_POST["plan_tratamiento"]."','Realizada')";
				$subtitulo="Valoracion inicial";
				$subtitulo1="Adicionado";
			break;
			case 'CONTROL':
				$sql="INSERT INTO evo_fisio_ce ( id_adm_hosp, id_user,freg_evofisio_ce, hreg_evofisio_ce, evolucionfisio_ce, estado_evofisio_ce) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["evoto"]."','Realizada')";
				$subtitulo="EVolucion";
				$subtitulo1="Adicionado";
				$subtitulo2="Terapia Fisica";
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
		case 'VI':
		$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
		b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
		j.nom_eps
		from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente

					left join eps j on (j.id_eps=b.id_eps)
		where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Valoracion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$doc=$_REQUEST['doc'];
			$opcion=$_REQUEST['opcion'];
			$form1='formulariosCE/valini.php';
			$subtitulo='Valoracion inicial Terapia Fisica';
			break;
			case 'CONTROL':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
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
			$doc=$_REQUEST['doc'];
			$opcion=$_REQUEST['opcion'];
			$form1='formulariosCE/evo_fisio_ce5.php';
			$subtitulo='Evolucion Diaria Terapia Fisica';
			break;

		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].hreg.value > document.forms[0].fecha.value){
					alert("Enfermero (a) <?php echo $_SESSION["AUT"]["nombre"]?>, NO puede adelantar el tiempo.");
					document.forms[0].hreg.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
		<script type="text/javascript" src="/js/jquery.js"></script>
		<div class="alert alert-info animated bounceInRight">
			<?php echo $subtitulo;?>
		</div>
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
<section class="panel-default">
<section class="panel-heading"><h4>FISIOTERAPIA Consulta externa</h4></section>
<section class="panel-body">
	<?php include('censo_reh.php');?>
</section>
<section class="panel-body col-md-12">
	<form>
		<div class="row">
			<div class="col-lg-6">
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
			<div class="col-lg-6">
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
<section class="panel-body">
<table class="table table-bordered">
	<tr>
		<th class="danger">PACIENTE</th>
		<th class="danger">INGRESO</th>
		<th class="danger">AUTORIZADO</th>
		<th class="danger">ACCIONES</th>
	</tr>

	<?php
	if (isset($_REQUEST["doc"])){
	$doc=$_REQUEST["doc"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
							 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
							 s.nom_sedes,
							 d.nom_eps
				FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
												 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
												 LEFT JOIN eps d on a.id_eps=d.id_eps
				WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Activo' and tipo_servicio='Consulta externa REH'";

	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {

			echo"<tr >\n";
			echo'<td class="text-center">
						<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
						<p><strong>ADM: </strong> '.$fila["id_adm_hosp"].'</p>
						<p><strong>'.$fila["tdoc_pac"].' :</strong> '.$fila["doc_pac"].'</p>
					 </td>';
					 echo'<td class="text-LEFT">
		 						<p><strong>FECHA INGRESO: </strong> '.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].' </p>
		 						<p><strong>SEDE: </strong> '.$fila["nom_sedes"].'</p>
		 						<p><strong>EPS: </strong> '.$fila["nom_eps"].'</p>
		 					 </td>';
			echo'<td class="text-left"><i>servicios autorizados</i></td>';
			echo'<th class="text-right">';
						$adm=$fila['id_adm_hosp'];
						$sql_valini="SELECT id_valini_ce,freg,tterapia FROM val_ini_ce WHERE id_adm_hosp=$adm and tterapia='FISIOTERAPIA'";

						if ($tabla_valini=$bd1->sub_tuplas($sql_valini)){
							foreach ($tabla_valini as $fila_valini ) {
								echo'<p>Valoración inicial registrada el '.$fila_valini['freg'].'</p>';
								echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CONTROL&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Control</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Consulta externa REH&doc='.$fila["doc_pac"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-flask"></span> Ayuda Dx</button></a></p>';
							}
						}else {
							echo '<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Valoración Inicial</button></a></p>';
							echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CONTROL&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Control</button></a></p>
							<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Consulta externa REH&doc='.$fila["doc_pac"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-flask"></span> Ayuda Dx</button></a></p>';
						}
			echo'</th>';
			echo "</tr>\n";
		}
	}
}

if (isset($_REQUEST["nom"])){
	$doc=$_REQUEST["nom"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
							 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
							 s.nom_sedes,
							 d.nom_eps
				FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
												 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
												 LEFT JOIN eps d on a.id_eps=d.id_eps
			  WHERE p.nom_completo LIKE '%".$doc."%' and a.estado_adm_hosp='Activo'  and a.tipo_servicio='Consulta externa REH'";
				//echo $sql;
	if ($tabla=$bd1->sub_tuplas($sql)){
		foreach ($tabla as $fila ) {
			echo"<tr >\n";
			echo'<td class="text-center">
						<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
						<p><strong>ADM: </strong> '.$fila["id_adm_hosp"].'</p>
						<p><strong>'.$fila["tdoc_pac"].' :</strong> '.$fila["doc_pac"].'</p>
					 </td>';
			echo'<td class="text-LEFT">
		 				<p><strong>FECHA INGRESO: </strong> '.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].' </p>
		 				<p><strong>SEDE: </strong> '.$fila["nom_sedes"].'</p>
		 				<p><strong>EPS: </strong> '.$fila["nom_eps"].'</p>
		 			 </td>';
			echo'<td class="text-left"><i>servicios autorizados</i></td>';
			echo'<th class="text-right">';
						$adm=$fila['id_adm_hosp'];
						$sql_valini="SELECT id_valini_ce,freg FROM val_ini_ce WHERE id_adm_hosp=$adm and tterapia='FISIOTERAPIA'";
						if ($tabla_valini=$bd1->sub_tuplas($sql_valini)){
							foreach ($tabla_valini as $fila_valini ) {
								echo'<p>Valoración inicial registrada el '.$fila_valini['freg'].'</p>';
								echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CONTROL&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Control</button></a></p>
								<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Consulta externa REH&doc='.$fila["doc_pac"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-flask"></span> Ayuda Dx</button></a></p>';
							}
						}else {
							echo '<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Valoración Inicial</button></a></p>';
							echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CONTROL&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Control</button></a></p>
							<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Consulta externa REH&doc='.$fila["doc_pac"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-flask"></span> Ayuda Dx</button></a></p>';
						}
			echo'</th>';
			echo "</tr>\n";
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
