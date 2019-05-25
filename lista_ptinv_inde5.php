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

			case 'PTINV':
			if ($_SESSION["AUT"]["especialidad"]=='ADMINISTRATIVO') {
				$sql="";
				$msg='LA ESPECIELIDAD DE SU PERFIL NO LE PERMITE REALIZAR REGISTROS ASISTENCIALES';
				$subtitulo="Plan Trimestral Individual ";
				$subtitulo1="Adicionado";
				$subtitulo2="Demencias";

			}else {
				$sql="INSERT INTO plan_individual_dem (id_ptgen_dem, id_user, servicio, freg_ptinv_dem, obj_dem, act1_dem, atc2_dem, estado_ptinv_dem) VALUES
				('".$_POST["idgen"]."','".$_SESSION["AUT"]["id_user"]."','".$_SESSION["AUT"]["especialidad"]."','".$_POST["freg"]."','".$_POST["obespec"]."','".$_POST["actividad1"]."','".$_POST["actividad2"]."','Realizada')";
				$subtitulo="Plan Trimestral Individual ";
				$subtitulo1="Adicionado";
				$subtitulo2="Demencias";
			}
			break;
		}
		echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El formato de $subtitulo en $subtitulo2 fue $subtitulo1 con exito!";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El formato de $subtitulo en $subtitulo2 NO fue $subtitulo1 !!!. $msg";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {

			case 'PTINV':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,b.id_eps ideps,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps,
      h.nom_sedes,
      i.descripuedad,
			max(id_ptgen_dem) id,max(freg_ptgen_dem) fecha, m.fvence_ptgen_dem, max(obj_general_dem) objetivo, m.estado_ptgen_dem
      from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
                        inner join eps j on (j.id_eps=b.id_eps)
                        inner join sedes_ips h on (h.id_sedes_ips=b.id_sedes_ips)
                        left join uedad i on (i.coduedad=a.uedad)
												left join plan_general_dem m on (m.id_adm_hosp=b.id_adm_hosp)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and m.estado_ptgen_dem='Realizada'" ;
			$boton="Agregar plan trimestral";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
      $return=$_GET['return'];
      $consulta='include ("consulta_rapidaDEM.php")';

      $servicio='Demencias';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='FormulariosINDE/plan_inde.php';
			$subtitulo='Plan Trimestral ';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
			$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","ideps"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id"=>"","fecha"=>"", "fvence_ptgen_dem"=>"", "objetivo"=>"", "estado_ptgen_dem"=>"");
			print_r($fila);
			}
		}else{
			$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","ideps"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id"=>"","fecha"=>"", "fvence_ptgen_dem"=>"", "objetivo"=>"", "estado_ptgen_dem"=>"");
			print_r($fila);
			}

		?>
<script src = "js/sha3.js"></script>

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
<div class="panel-default">
<section class="panel-heading"><h4>Gestion de planes individuales trimestrales</h4></section>
<div class="panel-body">

<table class="table table-bordered">
	<tr>
		<th id="th-estilo4">Historico</th>
		<th id="th-estilo1">ID</th>
		<th id="th-estilo1">Fecha regristro</th>
		<th id="th-estilo1">Fecha Vencimiento</th>
		<th id="th-estilo1">Objetivo General</th>
		<th id="th-estilo1">Modulo</th>
		<th id="th-estilo4">Agregar Plan individual</th>

	</tr>

	<?php
	if (isset($_REQUEST["idadmhosp"])){
	$doc=$_REQUEST["idadmohosp"];
	$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
	b.id_adm_hosp,b.id_eps ideps,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
	j.nom_eps,
	h.nom_sedes,
	i.descripuedad,
	max(id_ptgen_dem) id,max(freg_ptgen_dem) fecha, max(fvence_ptgen_dem) vence,MAX(obj_general_dem) objetivo,max(modulo) modulo

	from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
										inner join eps j on (j.id_eps=b.id_eps)
										inner join sedes_ips h on (h.id_sedes_ips=b.id_sedes_ips)
										left join uedad i on (i.coduedad=a.uedad)
										left join plan_general_dem m on (m.id_adm_hosp=b.id_adm_hosp)
	where b.id_adm_hosp ='".$_GET['idadmhosp']."' and m.estado_ptgen_dem='Realizada' GROUP BY m.id_ptgen_dem";

	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {
			if ($fila["modulo"]=='Afecto') {
				echo"<tr >\n";
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HIST&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-book"></span></button></a></th>';
				echo'<td class="text-center alert-info">'.$fila["id"].'</td>';
				echo'<td class="text-center alert-info">'.$fila["fecha"].'</td>';
				echo'<td class="text-center alert-info">'.$fila["vence"].'</td>';
				echo'<td class="text-center alert-info">'.$fila["objetivo"].'</td>';
				echo'<td class="text-center alert-info">'.$fila["modulo"].'</td>';
				echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PTINV&idadmhosp='.$fila["id_adm_hosp"].'&id='.$fila["id"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo "</tr>\n";
			}
			if ($fila["modulo"]=='Cognitivo') {
				echo"<tr >\n";
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HIST&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-book"></span></button></a></th>';
				echo'<td class="text-center alert-success">'.$fila["id"].'</td>';
				echo'<td class="text-center alert-success">'.$fila["fecha"].'</td>';
				echo'<td class="text-center alert-success">'.$fila["vence"].'</td>';
				echo'<td class="text-center alert-success">'.$fila["objetivo"].'</td>';
				echo'<td class="text-center alert-success">'.$fila["modulo"].'</td>';
				echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PTINV&idadmhosp='.$fila["id_adm_hosp"].'&id='.$fila["id"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo "</tr>\n";
			}
			if ($fila["modulo"]=='Biologico') {
				echo"<tr >\n";
				echo'<th class="text-center alert-warning"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HIST&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-book"></span></button></a></th>';
				echo'<td class="text-center alert-warning">'.$fila["id"].'</td>';
				echo'<td class="text-center alert-warning">'.$fila["fecha"].'</td>';
				echo'<td class="text-center alert-warning">'.$fila["vence"].'</td>';
				echo'<td class="text-center alert-warning">'.$fila["objetivo"].'</td>';
				echo'<td class="text-center alert-warning">'.$fila["modulo"].'</td>';
				echo'<th class="text-center alert-warning"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PTINV&idadmhosp='.$fila["id_adm_hosp"].'&id='.$fila["id"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
				echo "</tr>\n";
			}
			if ($fila["modulo"]=='Sociofamiliar') {
				echo"<tr >\n";
				echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HIST&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-book"></span></button></a></th>';
				echo'<td class="text-center alert-danger">'.$fila["id"].'</td>';
				echo'<td class="text-center alert-danger">'.$fila["fecha"].'</td>';
				echo'<td class="text-center alert-danger">'.$fila["vence"].'</td>';
				echo'<td class="text-center alert-danger">'.$fila["objetivo"].'</td>';
				echo'<td class="text-center alert-danger">'.$fila["modulo"].'</td>';
				echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PTINV&idadmhosp='.$fila["id_adm_hosp"].'&id='.$fila["id"].'"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
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
