<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
			case 'TRASLADO':
					$fecha=$_POST["finicial"];
					$segundos= strtotime('now') - strtotime($fecha);
					$diferencia_dias=intval($segundos/60/60/24);
					$dias=floor($diferencia_dias/365);

					$sql="UPDATE cama SET estado_cama='Libre' WHERE id_cama='".$_POST["id_cama"]."' ";
					$sql1="UPDATE ubipaciente SET ffinal='".$_POST["ffinal"]."',total_destancia='".$dias."' WHERE id_ubipaciente='".$_POST["id_ubipaciente"]."' ";
					$subtitulo1="La habitación se encuentra <strong>LIBRE</strong>. Puede proceder con la nueva asignación del paciente.";
			break;
			case 'SIG':
			$tam1=$_POST["tad"] * 2;
			$tam2=$tam1 + $_POST["tas"];
			$tamt=$tam2/3;
			$sql="INSERT INTO signos_vitales (id_adm_hosp,id_user,freg_sv,hreg_sv,tas_s,tad_s,tm_s,fc_s,fr_s,
				temp_s,spo_s,estado_sv,resp_sv) VALUES
			('".$_POST["idadm"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["tas"]."','".$_POST["tad"]."',
			'$tamt','".$_POST["fc"]."','".$_POST["fr"]."','".$_POST["temp"]."','".$_POST["sat"]."',
			'Realizada','".$_SESSION["AUT"]["nombre"]."')";
			$subtitulo="Adicionado";
			break;
			case 'X':
				$sql="SELECT logo from cliente where id=".$_POST["idcli"];

				$sql="DELETE FROM cliente WHERE id_cliente=".$_POST["idcli"];
				$subtitulo="Eliminado";
			break;
			case 'A':
				$sql="INSERT INTO nota_enfermeria (id_adm_hosp,id_user,freg_nota,hreg_nota,descripnota,estado_nota,resp_nota) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["notaenfermeria"]."','Realizada',
				'".$_SESSION["AUT"]["nombre"]."')";
				$subtitulo="Adicionado";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro de enfermería fue <strong>$subtitulo</strong> con exito.";
			$check='si';
			if ($bd1->consulta($sql1)) {
				$subtitulo="$subtitulo $subtitulo1";
				$check='si';
			}
		}else{
			$subtitulo="El registro de enfermeria <strong>NO fue $subtitulo !!!</strong> .";
			$check='no';
		}

	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
			case 'A':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$color="yellow";
			$boton="Agregar Nota";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['doc'];
			$return1=173;
			$form1='FormulariosINDE/nota_enfermeria.php';
			$subtitulo='';
			break;
			case 'TRASLADO':
      $sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 b.id_adm_hosp,fingreso_hosp,
									 c.id_ubipaciente,c.id_cama idc,finicial,
									 d.nom_cama,
									 e.nom_hab,
									 f.nom_pabellon,
									 g.nom_piso
					FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
													 INNER JOIN ubipaciente c on b.id_adm_hosp=c.id_adm_hosp
													 INNER JOIN cama d on d.id_cama=c.id_cama
													 INNER JOIN habitacion e on e.id_habitacion=d.id_habitacion
													 INNER JOIN pabellon f on f.id_pabellon=e.id_pabellon
													 INNER JOIN piso g on g.id_piso=f.id_piso
					WHERE c.id_ubipaciente='".$_GET["idubi"]."' ";
			$color="yellow";
			$boton="Finalizar Ubicación";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['idadmhosp'];
			$return1=$_REQUEST['sede'];
			$return2=$_REQUEST['doc'];
			$form1='formulariosHOSP/traslado_bed.php';
			$subtitulo='';
			break;
			case 'SIG':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$color="yellow";
			$boton="Agregar Signos vitales";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$option=173;
			$form1='FormulariosINDE/signos_vitales.php';
			$subtitulo='';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"",
				"genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"",
				"id_ubipaciente"=>"","idc"=>"","fnicial"=>"","nom_cama"=>"","nom_hab"=>"","nom_pabellon"=>"","nom_piso"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"",
				"genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"",
				"id_ubipaciente"=>"","idc"=>"","fnicial"=>"","nom_cama"=>"","nom_hab"=>"","nom_pabellon"=>"","nom_piso"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>

		function validar(){
			if (document.forms[0].hreg.value > document.forms[0].fecha.value){
				alert("Jefe (a) <?php echo $_SESSION["AUT"]["nombre"]?>, NO puede adelantar el tiempo.");
				document.forms[0].hreg.focus();				// Ubicar el cursor
				return(false);
			}
		}
		</script>
		<script type="text/javascript" src="/js/jquery.js"></script>
		<?php include ($form1);?>
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
	<section class="panel-heading">
		<h3>Registro de enfermeria INDE</h3>
	</section>
<div class="panel-body">
	<section class="col-md-4">
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
	<section class="panel-body">
	    <?php
	    if (isset($_REQUEST["doc"])){
	    $doc=$_REQUEST["doc"];
	    $sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
	                 b.id_adm_hosp,fingreso_hosp,
	                 c.id_ubipaciente,c.id_cama idc,finicial,ffinal,
	                 d.nom_cama,
	                 e.nom_hab,
	                 f.nom_pabellon,
	                 g.nom_piso
	        FROM pacientes a INNER JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
	                         INNER JOIN ubipaciente c on b.id_adm_hosp=c.id_adm_hosp
	                         INNER JOIN cama d on d.id_cama=c.id_cama
	                         INNER JOIN habitacion e on e.id_habitacion=d.id_habitacion
	                         INNER JOIN pabellon f on f.id_pabellon=e.id_pabellon
	                         INNER JOIN piso g on g.id_piso=f.id_piso
	        WHERE a.doc_pac='".$_GET["doc"]."' and c.ffinal is null";
					//echo $sql;
				if ($tabla=$bd1->sub_tuplas($sql)){
					foreach ($tabla as $fila1 ) {
					}
				}
		  }
	    ?>

	</section>

<table class="table table-bordered">
	<tr>
		<th class="info">PACIENTE</th>
		<th class="info">INGRESO</th>
		<th class="info">FOTO</th>
		<th class="info"></th>

	</tr>

	<?php
	if (isset($_REQUEST["doc"])){
	$doc=$_REQUEST["doc"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
							 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
							 s.id_sedes_ips ids,nom_sedes
				FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
												 INNER JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips

				WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Activo'
        and tipo_servicio in ('Demencias','AVD','Consulta externa INDE','Medicina General INDE')";
//echo $sql;
	if ($tabla=$bd1->sub_tuplas($sql)){
//print_r($bd1);
		foreach ($tabla as $fila ) {
				echo"<tr >\n";
				echo'<td class="text-left ">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
							<p><strong>AMD: </strong>'.$fila["id_adm_hosp"].'</p>
						 </td>';
				echo'<td class="text-center">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-center"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
				echo'<th class="text-left">
							<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila['doc_pac'].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Registro<br>Enfermeria</button></a></p>
							<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>
						 </th>';
				echo "</tr>\n";
		}
	}
}
if (isset($_REQUEST["nom"])){
	$doc=$_REQUEST["nom"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
							 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
							 s.id_sedes_ips ids,nom_sedes
				FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
				WHERE p.nom1='".$doc."' and a.estado_adm_hosp='Activo'
        and tipo_servicio in ('Demencias','AVD','Consulta externa INDE','Medicina General INDE')";

	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {
			echo"<tr >\n";
			echo'<td class="text-LEFT">
						<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
						<p><strong>'.$fila["tdoc_pac"].': </strong>'.$fila["doc_pac"].'</p>
						<p><strong>AMD: </strong>'.$fila["id_adm_hosp"].'</p>
					 </td>';
			echo'<td class="text-center ">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
			echo'<td class="text-center"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
			echo'<th class="text-LEFT">
						<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila['doc_pac'].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Registro<br>Enfermeria</button></a></p>
						<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=SIG&idadmhosp='.$fila["id_adm_hosp"].'&sede='.$fila['ids'].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-info sombra_movil " ><span class="fa fa-stethoscope"></span> Signos<br>vitales</button></a></p>
					 </th>';
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
