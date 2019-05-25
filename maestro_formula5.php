<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["logo"])){
				if (is_uploaded_file($_FILES["logo"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["logo"]["name"]);
					$archivo=$_POST["nom_eps"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["logo"]["tmp_name"],LOG.LOGOS.$archivo)){
						$fotoE=",logo='".LOGOS.$archivo."'";
						$fotoA1=",logo";
						$fotoA2=",'".LOGOS.$archivo."'";
						}
				}
			}

			switch ($_POST["operacion"]) {
			case 'INTER':
				$idord=$_POST['idord'];
				$sql="UPDATE ord_med_hosp SET freg_inter='".$_POST["freg"]."',interpretacion='".$_POST["interpretacion"]."',freg_inter='".$_POST["nom_ips"]."',estado_ord_med_hosp='Interpretado' WHERE id_ord_med_hosp=".$_POST['idord'];
				$subtitulo="Interpretacion";
				$sub2='agregada';
			break;
			case 'X':
				$sql="SELECT logo from eps where id_eps=".$_POST["ideps"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="DELETE FROM eps WHERE id_eps=".$_POST["ideps"];
				$subtitulo="Eliminado";
			break;
			case 'A':
				$sql="INSERT INTO ord_med_hosp (id_adm_hosp, id_user, freg_ord_med_hosp, hreg_ord_med_hosp, ts_ord_med_hosp	, dx, procedimiento,obs_proc,estado_ord_med_hosp) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["tiposervicio"]."','".$_POST["dx"]."','".$_POST["cups"]."','".$_POST["obs_proc"]."','Solicitado')";
				$subtitulo="Orden de servicio";
				$sub2='agregada';
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="La $subtitulo fue $sub2 con exito!";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="La $subtitulo  NO fue $sub2 con exito!!!!!!!!!!!!!";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'INTER':
		$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
		b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
		j.nom_eps,
		k.id_sedes_ips,nom_sedes,
		h.id_ordmedhosp, id_adm_hosp, id_user, freg_ordmedhosp, hreg_ordmedhosp, servicio, dx, estado_ordmedhosp
		from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
								inner join eps j on (j.id_eps=b.id_eps)
								inner join sedes_ips k on (k.id_sedes_ips=b.id_sedes_ips)
								left join ordenmed_hospitalario h on (h.id_adm_hosp=b.id_adm_hosp)
		where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and h.id_ordmedhosp='".$_GET["idordhosp"]."'" ;
			$color="green";
			$boton="Agregar Interpretacion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$form1='formularios/add_interpretacion.php';
			$subtitulo='Interpretacion de ayudas diagnosticas';
			break;

			case 'A':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps,
			k.id_sedes_ips,nom_sedes
      from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
                  inner join eps j on (j.id_eps=b.id_eps)
									inner join sedes_ips k on (k.id_sedes_ips=b.id_sedes_ips)

      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$color="yellow";
			$boton="Adicionar Procedimiento";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$return=139;
			$form1='formularios/formula_medica.php';
			$subtitulo='Creacion de orden de servicio';
			break;
		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_eps"=>"","nom_eps"=>"","doc_eps"=>"","tel_eps"=>"","dir_eps"=>"","cod_eps"=>"","logo"=>"","estado_eps"=>"" );

			}
		}else{
				$fila=array("id_eps"=>"","nom_eps"=>"","doc_eps"=>"","tel_eps"=>"","dir_eps"=>"","cod_eps"=>"","logo"=>"","estado_eps"=>"" );
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nom_eps.value == ""){
					alert("Se requiere el nombre de la EPS!");
					document.forms[0].nom_EPS.focus();				// Ubicar el cursor
					return(false);
				}

			}
		</script>
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

<div class="panel panel-default">
	<section class="panel-heading"><h4>Listado de Formulas medicas en <?php echo $_REQUEST['servicio'];?></h4></section>
<div class="panel-body">
<table class="table table-responsive table-bordered">
	<tr>
		<th id="th-estilo2">ID</th>
		<th id="th-estilo2">SERVICIO</th>
		<th id="th-estilo2">BODEGA</th>
		<th id="th-estilo2">FECHA REGISTRO</th>
		<th id="th-estilo2">FECHA EJECUCION</th>
		<th id="th-estilo2">TIPO FORMULA</th>
		<th id="th-estilo2">DX</th>
		<th id="th-estilo2">ESTADO</th>
		<th colspan="2" id="th-estilo4">ACCIONES</th>
	</tr>

	<?php
	$idadmhosp=$_REQUEST['idadmhosp'];
	$servicio=$_REQUEST['servicio'];
	$sql="SELECT a.*,b.nom_bodega FROM maestro_formula a INNER JOIN bodega b on a.id_bodega=b.id_bodega WHERE id_adm_hosp =".$idadmhosp;

if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {
		if ($fila['estado_ord_med_hosp']=='Solicitado') {
			echo"<tr>\n";
			echo'<td class="text-right alert-success">'.$fila["id_mformula"].'</td>';
			echo'<td class="text-left alert-success">'.$servicio.'</td>';
			echo'<td class="text-left alert-success">'.$fila["nom_bodega"].' | '.$fila["hreg_ord_med_hosp"].'</td>';
			echo'<td class="text-left alert-success">'.$fila["freg_mformula"].'</td>';
			echo'<td class="text-left alert-success">'.$fila["fejec_mformula"].'</td>';
			echo'<td class="text-left alert-success">'.$fila["tipo_formula"].'</td>';
			echo'<td class="text-left alert-success">'.$fila["dx"].'</td>';
			echo'<td class="text-left alert-success">'.$fila["estado_mformula"].'</td>';
			echo'<th class="text-center alert-success"><a href="rpt_formula.php?idformula='.$fila["id_mformula"].'&idadmhosp='.$idadmhosp.'"><button type="button" class="btn btn-success" ><span class="fa fa-print"></span></button></a></th>';
			echo'<th class="text-center alert-success"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=INTER&idorden='.$fila["id_ord_med_hosp"].'&idadmhosp='.$idadmhosp.'"><button type="button" class="btn btn-primary" ><span class="fa fa-pencil-square-o"></span></button></a></th>';
			echo "</tr>\n";
		}

		if ($fila['estado_ord_med_hosp']=='Interpretado') {
			echo"<tr>\n";
			echo'<td class="text-right alert-info">'.$fila["id_ord_med_hosp"].'</td>';
			echo'<td class="text-left alert-info">'.$fila["ts_ord_med_hosp"].'</td>';
			echo'<td class="text-left alert-info">'.$fila["freg_ord_med_hosp"].' | '.$fila["hreg_ord_med_hosp"].'</td>';
			echo'<td class="text-left alert-info">'.$fila["dx"].'</td>';
			echo'<td class="text-left alert-info">'.$fila["procedimiento"].'</td>';
			echo'<td class="text-left alert-info">'.$fila["obs_proc"].'</td>';
			echo'<td class="text-left alert-info">'.$fila["estado_ord_med_hosp"].'</td>';
			echo'<th class="text-center alert-info"><a href="rpt_ordenhosp.php?idordhosp='.$fila["id_ord_med_hosp"].'&idadmhosp='.$idadmhosp.'"><button type="button" class="btn btn-success" ><span class="fa fa-print"></span></button></a></th>';
			echo'<th class="text-center alert-info"><span class="fa fa-ban"></span></th>';
			echo "</tr>\n";
		}
	}
}
	?>
	<tr>
		<th colspan="11" class="text-center"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&servicio='.$servicio.'&mante=A&idadmhosp='.$idadmhosp?>" align="center" ><button type="button" class="btn btn-primary" >Crear Formula medica</button>
		</a></th>
	<tr>
</table>
</div>
</div>
	<?php
}
?>
