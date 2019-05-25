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
			$tallat=$_POST["talla"] * $_POST["talla"];
			$imc=$_POST["peso"] / $tallat;
				$sql="INSERT INTO val_nutricion (id_adm_hosp, id_user, freg_nutri, hreg_nutri, motivo_nutri, val_nutricional, dx_nutricional, plan_nutricional, estado_nutri,peso,talla,imc) VALUES
				('".$_POST["idadmhosp"]."',
'".$_SESSION["AUT"]["id_user"]."',
'".$_POST["freg_nutri"]."'	,
'".$_POST["hreg_nutri"]."'	,
'".$_POST["motivonutri"]."',
'".$_POST["val_nutri"]."',
'".$_POST["dxnutri"]."',
'".$_POST["plan_nutri"]."','Realizada','".$_POST["peso"]."','".$_POST["talla"]."',$imc)";
				$subtitulo="Valoración inicial";
				$subtitulo1="Adicionado";
				$subtitulo2="Nutrición";
			break;
			case 'EVO':
				$tallat=$_POST["talla"] * $_POST["talla"];
				$imc=$_POST["peso"] / $tallat;
				if ($imc=='') {
					$sql="INSERT INTO evo_nutrism (id_adm_hosp, id_user, freg_nutrice_sm, hreg_nutrice_sm,
						evolucion_nutri, estado_evonutri) VALUES
					('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."',
						'".$_POST["hreg"]."','".$_POST["evoto"]."','Realizada')";
					$subtitulo="Evolución";
					$subtitulo1="Adicionado";
					$subtitulo2="Nutrición y Dietética";
				}
				if ($imc!='') {
					$sql="INSERT INTO evo_nutrism (id_adm_hosp, id_user, freg_nutrice_sm, hreg_nutrice_sm,
						evolucion_nutri, estado_evonutri,peso,talla,imc,dx_nutricional) VALUES
					('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."',
					 '".$_POST["hreg"]."','".$_POST["evoto"]."','Realizada',
					 '".$_POST["peso"]."','".$_POST["talla"]."',$imc,'".$_POST["dx_nutrion"]."')";
					$subtitulo="Evolución";
					$subtitulo1="Adicionado";
					$subtitulo2="Nutrición y Dietética";
				}

			break;

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
			$doc=$_REQUEST['doc'];
			$opcion=$_REQUEST['opcion'];
			$form1='formulariosHOSP/NUTRICION/valini_nutri.php';
			$subtitulo='Valoracion inicial  Nutrición';
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
			$doc=$_REQUEST['doc'];
			$opcion=$_REQUEST['opcion'];
			$form1='formulariosHOSP/NUTRICION/evo_nutri.php';
			$subtitulo='Evolución Diaria  Nutrición';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"",
				"dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"",
				"dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
			}

		?>
		<?php include($form1);?>
<?php
}else{
	echo '<div class="alert alert-success animated bounceInRight">';
	echo $subtitulo;
	echo '</div>';
// nivel 1?>
<section class="panel-default">
	<section class="panel-body">
	<section class="panel-body">
		<?php
			include("consulta_rapida1.php");
		?>
	</section>
	<section class="panel-body">
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
		<section class="col-md-4">
			<div class="row">
				<div class="col-lg-12">
					<div class="input-group">
						<?php
							echo'<a href="'.PROGRAMA.'?opcion=181"><button type="button" class="btn btn-info" ><span class="fa fa-search fa-2x"></span> Multievolución</button></a>';
						?>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-6 -->
			</div>
		</section>
		<section class="col-md-4">

		</section>
	</section>
<table class="table table-bordered">
	<tr>
		<th>PACIENTE</th>
		<th>INGRESO</th>
		<th>UBICACION</th>
		<th>FOTO</th>
		<th></th>

	</tr>

	<?php
	if (isset($_REQUEST["doc"])){
	$doc=$_REQUEST["doc"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
							 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
							 s.nom_sedes
				FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
				WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Activo' and tipo_servicio='Hospitalario'";

	if ($tabla=$bd1->sub_tuplas($sql)){
		foreach ($tabla as $fila) {
			echo"<tr >\n";
			echo'<td class="text-left">
						<article class="col-md-8">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].':</strong> '.$fila["doc_pac"].'</p>
							<p><strong>AMD:</strong>'.$fila["id_adm_hosp"].'</p>
						</article>
						<article class="col-md-4">
							<p><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"></p>
						</article>
					 </td>';
			echo'<td class="text-center">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
			echo'<td class="text-center">';
						$adm=$fila['id_adm_hosp'];
						$sqlu="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac doc_pac,concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,
						               concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi

						      FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
						                              left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
						                              left join cama g on (g.id_cama = f.id_cama )
						                              left join habitacion h on (h.id_habitacion = g.id_habitacion )
						                              left join pabellon i on ( i.id_pabellon = h.id_pabellon )
						                              left join piso j on (j.id_piso = i.id_piso )
						                              left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )
						      WHERE b.id_adm_hosp=$adm and f.ffinal is null ";
							if ($tablau=$bd1->sub_tuplas($sqlu)){
								foreach ($tablau as $filau ) {
									echo'<p><strong>'.$filau["habi"].'</strong></p>';
								}
							}
			echo'</td>';
			echo'<th class="text-left">';
			$adm=$fila['id_adm_hosp'];
			$sqlvi="SELECT a.id_val_nutri, freg_nutri,
										 f.nombre
						FROM adm_hospitalario b inner join val_nutricion a on (a.id_adm_hosp = b.id_adm_hosp)
																		left join user f on (f.id_user = a.id_user)

						WHERE b.id_adm_hosp=$adm";
			//echo $sqlvi;
				if ($tablavi=$bd1->sub_tuplas($sqlvi)){
					foreach ($tablavi as $filavi ) {
						if ($filavi['id_val_nutri']!='') {
							echo'<p class="alert alert-info">Valoración registrada el '.$filavi['freg_nutri'].' por '.$filavi['nombre'].'<p>';
						}else {
							echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&servicio=Hospitalario&atencion=Hospitalario"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración</button></a></p>';
						}
					}
				}else {
					echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&servicio=Hospitalario&atencion=Hospitalario"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración</button></a></p>';
				}
			echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&servicio=Hospitalario&atencion=Hospitalario"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>
						<p><a href="'.PROGRAMA.'?opcion=164&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&servicio=Hospitalario&atencion=Hospitalario"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-cutlery" </span> Dieta</button></a></p>
					 </th>';
			echo "</tr>\n";
		}
	}
}	if (isset($_REQUEST["nom"])){
	$doc=$_REQUEST["nom"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
							 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
							 s.nom_sedes
				FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
				 WHERE p.nom_completo LIKE '%".$doc."%' and a.estado_adm_hosp='Activo'  and tipo_servicio='Hospitalario'";

	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {
			echo"<tr >\n";
			echo'<td class="text-left">
						<article class="col-md-8">
							<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
							<p><strong>'.$fila["tdoc_pac"].':</strong> '.$fila["doc_pac"].'</p>
							<p><strong>AMD:</strong>'.$fila["id_adm_hosp"].'</p>
						</article>
						<article class="col-md-4">
							<p><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"></p>
						</article>
					 </td>';
			echo'<td class="text-center">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
			echo'<td class="text-center">';
						$sdm=$fila['id_adm_hosp'];
						$sqlu="SELECT IF(b.id_sedes_ips='8','Bogota','Faca') sede,a.doc_pac doc_pac,concat(a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2) paciente,
													 concat(j.nom_piso,' ',i.nom_pabellon,' ',h.nom_hab,' ',g.nom_cama) habi

									FROM adm_hospitalario b inner join pacientes a on (a.id_paciente = b.id_paciente)
																					left join ubipaciente f on (f.id_adm_hosp = b.id_adm_hosp and f.ffinal is null)
																					left join cama g on (g.id_cama = f.id_cama )
																					left join habitacion h on (h.id_habitacion = g.id_habitacion )
																					left join pabellon i on ( i.id_pabellon = h.id_pabellon )
																					left join piso j on (j.id_piso = i.id_piso )
																					left join sedes_ips k on (k.id_sedes_ips= j.id_sedes_ips )
									WHERE b.id_adm_hosp=$adm and f.ffinal is null ";
							if ($tablau=$bd1->sub_tuplas($sqlu)){
								foreach ($tablau as $filau ) {
									echo'<p><strong>'.$filau["habi"].'</strong></p>';
								}
							}
			echo'</td>';
			echo'<th class="text-left">';
			$adm=$fila['id_adm_hosp'];
			$sqlvi="SELECT a.id_val_nutri, freg_nutri,
										 f.nombre
						FROM adm_hospitalario b inner join val_nutricion a on (a.id_adm_hosp = b.id_adm_hosp)
																		left join user f on (f.id_user = a.id_user)

						WHERE b.id_adm_hosp=$adm";
			//echo $sqlvi;
				if ($tablavi=$bd1->sub_tuplas($sqlvi)){
					foreach ($tablavi as $filavi ) {
						if ($filavi['id_val_nutri']!='') {
							echo'<p class="alert alert-info">Valoración registrada el '.$filavi['freg_nutri'].' por '.$filavi['nombre'].'<p>';
						}else {
							echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&servicio=Hospitalario&atencion=Hospitalario"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración</button></a></p>';
						}
					}
				}else {
					echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&servicio=Hospitalario&atencion=Hospitalario"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración</button></a></p>';
				}
			echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&servicio=Hospitalario&atencion=Hospitalario"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-stethoscope"></span> Evolución</button></a></p>
						<p><a href="'.PROGRAMA.'?opcion=164&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&servicio=Hospitalario&atencion=Hospitalario"><button type="button" class="btn btn-success sombra_movil" ><span class="fa fa-cutlery" </span> Dieta</button></a></p>
					 </th>';
			echo "</tr>\n";
		}
	}
}
	?>

</table>

</section>
</section>
	<?php
}
?>
