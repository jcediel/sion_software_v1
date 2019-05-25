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


		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El formato de $subtitulo en $subtitulo2 fue $subtitulo1 con exito!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El formato de $subtitulo en $subtitulo2 NO fue $subtitulo1 !!! .";
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
			$boton="Agregar Valoración";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/valinipsico__reh.php';
			$subtitulo='Valoracion inicial Psicologia';
			break;
			case 'EVO':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Evolución";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/evo_psico_reh5.php';
			$subtitulo='Evolución Diaria Psicologia';
			break;
			case 'IM':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Informe Mensual";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/impsico_reh5.php';
			$subtitulo='Informe Mensual Psicologia';
			break;
			case 'PT':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Plan tratamiento";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/planfono_reh.php';
			$subtitulo='Plan Trimestral Psicologia ';
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
	echo '<div class="alert alert-success animated bounceInRight">';
	echo $subtitulo;
	echo '</div>';
// nivel 1?>
<div class="panel-default">
<div class="panel-body">

<table class="table table-bordered">
	<tr>
		<th class="info">Orden de servicio</th>
		<th class="info">Proccedimiento</th>
		<th class="info">Estado</th>
		<th class="info text-center" colspan="2">Acciones</th>
	</tr>

	<?php
	if (isset($_REQUEST["idpac"])){
	$idpac=$_REQUEST["idpac"];
	$sql="SELECT a.id_adm_hosp,id_paciente,id_sedes_ips,tipo_servicio,
							 b.id_master_prod,fecha_orden, servicio, tipo_atencion, dx, tdx, estado_orden,
							 c.id_d_procedimiento,procedimiento,observacion,estado_prod,freg_inter,nota_inter
				FROM adm_hospitalario a left join master_procedimiento b on a.id_adm_hosp=b.id_adm_hosp
																inner join detalle_procedimiento c on b.id_master_prod=c.id_master_prod
				WHERE a.id_paciente='".$_REQUEST['idpac']."' and b.tipo_atencion='Hospitalario' order by fecha_orden DESC";
//echo $sql;
	if ($tabla=$bd1->sub_tuplas($sql)){

		foreach ($tabla as $fila ) {
			if ($fila['estado_prod']=='Solicitado') {
				echo"<tr>\n";
			  echo'<td class="text-right warning"><strong>Orden #:</strong>'.$fila["id_master_prod"].' <strong>Fecha registro:</strong>'.$fila["fecha_orden"].' <strong>Atención:</strong>'.$fila["tipo_atencion"].'</td>';
			  echo'<td class="text-left warning">'.$fila["procedimiento"].'</td>';
				echo'<td class="text-left hidden">'.$fila["id_d_procedimiento"].'</td>';
				echo'<td class="text-left warning animated jello">'.$fila["estado_prod"].'</td>';
				$id=$fila['id_master_prod'];
			  $idadm=$fila['id_adm_hosp'];
			  echo'<th class="text-center warning" ><a href="rpt_ordenhosp.php?idadmhosp='.$idadm.'&idm='.$id.'&idd='.$fila["id_d_procedimiento"].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Imprimir Orden</button></a></th>';
				echo'<th class="text-center warning" ><span class="fa fa-ban"></span></a></th>';
			  echo "</tr>\n";
			}
			if ($fila['estado_prod']=='Procesado') {
				echo"<tr>\n";
				echo'<td class="text-right success"><strong>Orden #:</strong>'.$fila["id_master_prod"].' <strong>Fecha registro:</strong>'.$fila["fecha_orden"].' <strong>Atención:</strong>'.$fila["tipo_atencion"].'</td>';
				echo'<td class="text-left success">'.$fila["procedimiento"].'</td>';
				echo'<td class="text-left hidden">'.$fila["id_d_procedimiento"].'</td>';
				echo'<td class="text-left success animated jello">'.$fila["estado_prod"].'</td>';
				$id=$fila['id_master_prod'];
				$idadm=$fila['id_adm_hosp'];
				echo'<th class="text-center success" ><a href="rpt_ordenhosp.php?idadmhosp='.$idadm.'&idm='.$id.'&idd='.$fila["id_d_procedimiento"].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Imprimir Orden</button></a></th>';
				echo'<th class="text-center success" ><a href="rpt_ordenhosp.php?idadmhosp='.$idadm.'&idm='.$id.'&idd='.$fila["id_d_procedimiento"].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Imprimir Resultado</button></a></th>';
				echo "</tr>\n";
			}
			if ($fila['estado_prod']=='Interpretado') {
				echo"<tr>\n";
				echo'<td class="text-right info"><strong>Orden #:</strong>'.$fila["id_master_prod"].' <strong>Fecha registro:</strong>'.$fila["fecha_orden"].' <strong>Atención:</strong>'.$fila["tipo_atencion"].'</td>';
				echo'<td class="text-left info">'.$fila["procedimiento"].'</td>';
				echo'<td class="text-left hidden">'.$fila["id_d_procedimiento"].'</td>';
				echo'<td class="text-left info animated jello">'.$fila["estado_prod"].'</td>';
				$id=$fila['id_master_prod'];
				$idadm=$fila['id_adm_hosp'];
				echo'<th class="text-center info" ><a href="rpt_ordenhosp.php?idadmhosp='.$idadm.'&idm='.$id.'&idd='.$fila["id_d_procedimiento"].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Imprimir Orden</button></a></th>';
				echo'<th class="text-center info" ><a href="rpt_ordenhosp.php?idadmhosp='.$idadm.'&idm='.$id.'&idd='.$fila["id_d_procedimiento"].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-file-pdf-o"></span> Imprimir Resultado</button></a></th>';
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
