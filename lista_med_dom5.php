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
			case 'HC':
			$ant=$_POST['id_hc_principal'];
			if ($ant=='') {
				$tallat=$_POST["talla"] * $_POST["talla"];
				$imc=$_POST["peso"] / $tallat;
				$tam1=$_POST["tad"] * 2;
				$tam2=$tam1 + $_POST["tds"];
				$tamt=$tam2/3;
				$sql="INSERT INTO hcini_dom (id_adm_hosp, id_user,id_d_aut_dom, freg_hchosp, hreg_hchosp, tipo_hc, motivo_consulta, enfer_actual,tas, tad, fc,
					 fr, so2, peso, talla, glasgow, gucometria, imc, rxs, cabcuello, torax, ext, abdomen,
						neurologico, genitourinario, barthel, weefim, cruzroja, raisberg, karnell, grossmotor, norton, honenyahr,fac, analisis,
						finalidad, causa_externa, dxp, tdxp, dx1, tdx1, dx2, tdx2, dx3, tdx3, plan_manejo, estado_hchosp,
						cant_valmed, periodo_valmed,cant_enfer, temp_valenf, periodo_valenf, cant_fisio, cant_fono, cant_to, cant_resp) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idd"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["tipo_hc"]."',
				'".$_POST["motivo_consulta"]."', '".$_POST["enfer_actual"]."','".$_POST["tas"]."', '".$_POST["tad"]."', '".$_POST["fc"]."',
				 '".$_POST["fr"]."', '".$_POST["so2"]."',
				'".$_POST["peso"]."', '".$_POST["talla"]."', '".$_POST["glasgow"]."', '".$_POST["gucometria"]."', '$imc', '".$_POST["rxs"]."',
				'".$_POST["cabezacuello"]."', '".$_POST["torax"]."', '".$_POST["ext"]."', '".$_POST["abdomen"]."', '".$_POST["neurologico"]."',
				'".$_POST["genitourinario"]."', '".$_POST["barthel"]."', '".$_POST["wee_fim"]."', '".$_POST["cruz_roja"]."',
				'".$_POST["reisberg"]."', '".$_POST["karnell"]."', '".$_POST["gross_motor"]."', '".$_POST["norton"]."', '".$_POST["honen_yahr"]."'
				,'".$_POST["fac"]."', '".$_POST["analisis"]."', '".$_POST["finconsulta"]."', '".$_POST["causaexterna"]."',
				'".$_POST["dx"]."', '".$_POST["tdx"]."', '".$_POST["dx1"]."', '".$_POST["tdx1"]."', '".$_POST["dx2"]."', '".$_POST["tdx2"]."',
				'".$_POST["dx3"]."', '".$_POST["tdx3"]."', '".$_POST["plant"]."','Realizada', '".$_POST["cant_valmed"]."','".$_POST["periodo_valmed"]."',
				'".$_POST["cant_enfer"]."', '".$_POST["temp_valenf"]."', '".$_POST["periodo_valenf"]."', '".$_POST["cant_fisio"]."', '".$_POST["cant_fono"]."'
				, '".$_POST["cant_to"]."', '".$_POST["cant_resp"]."')";
					$subtitulo="Historia Clinica pacientes domiciliarios";
					$subtitulo1="Adicionado";

				$sql1="INSERT INTO hc_principal (id_paciente, ant_alergicos, ant_patologicos, ant_quirurgico, ant_toxicologico, ant_farmaco,
																				 ant_gineco, ant_psiquiatrico, ant_hospitalario, ant_traumatologico, ant_familiar, otros_ant)
							VALUES ('".$_POST["paciente"]."','".$_POST["ant_alergicos"]."','".$_POST["ant_patologicos"]."','".$_POST["ant_quirurgico"]."','".$_POST["ant_toxicologico"]."',
								'".$_POST["ant_farmaco"]."','".$_POST["ant_gineco"]."','".$_POST["ant_psiquiatrico"]."','".$_POST["ant_hospitalario"]."','".$_POST["ant_traumatologico"]."',
								'".$_POST["ant_familiar"]."','".$_POST["otros_ant"]."')";
				$subtitulo="Antecedentes";
				$subtitulo1="Adicionados";

			}
			if ($ant!='') {
				$tallat=$_POST["talla"] * $_POST["talla"];
				$imc=$_POST["peso"] / $tallat;
				$tam1=$_POST["tad"] * 2;
				$tam2=$tam1 + $_POST["tds"];
				$tamt=$tam2/3;
				$sql="INSERT INTO hcini_dom (id_adm_hosp, id_user,id_d_aut_dom, freg_hchosp, hreg_hchosp, tipo_hc, motivo_consulta, enfer_actual,tas, tad, fc,
					 fr, so2, peso, talla, glasgow, gucometria, imc, rxs, cabcuello, torax, ext, abdomen,
						neurologico, genitourinario, barthel, weefim, cruzroja, raisberg, karnell, grossmotor, norton, honenyahr,fac, analisis,
						finalidad, causa_externa, dxp, tdxp, dx1, tdx1, dx2, tdx2, dx3, tdx3, plan_manejo, estado_hchosp,
						cant_valmed, periodo_valmed,cant_enfer, temp_valenf, periodo_valenf, cant_fisio, cant_fono, cant_to, cant_resp) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["idd"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["tipo_hc"]."',
				'".$_POST["motivo_consulta"]."', '".$_POST["enfer_actual"]."','".$_POST["tas"]."', '".$_POST["tad"]."', '".$_POST["fc"]."',
				 '".$_POST["fr"]."', '".$_POST["so2"]."','".$_POST["peso"]."', '".$_POST["talla"]."', '".$_POST["glasgow"]."', '".$_POST["gucometria"]."', '$imc', '".$_POST["rxs"]."',
				'".$_POST["cabezacuello"]."', '".$_POST["torax"]."', '".$_POST["ext"]."', '".$_POST["abdomen"]."', '".$_POST["neurologico"]."',
				'".$_POST["genitourinario"]."', '".$_POST["barthel"]."', '".$_POST["wee_fim"]."', '".$_POST["cruz_roja"]."',
				'".$_POST["reisberg"]."', '".$_POST["karnell"]."', '".$_POST["gross_motor"]."', '".$_POST["norton"]."', '".$_POST["honen_yahr"]."',
				'".$_POST["fac"]."', '".$_POST["analisis"]."', '".$_POST["finconsulta"]."', '".$_POST["causaexterna"]."',
				'".$_POST["dx"]."', '".$_POST["tdx"]."', '".$_POST["dx1"]."', '".$_POST["tdx1"]."', '".$_POST["dx2"]."', '".$_POST["tdx2"]."',
				'".$_POST["dx3"]."', '".$_POST["tdx3"]."', '".$_POST["plant"]."','Realizada', '".$_POST["cant_valmed"]."','".$_POST["periodo_valmed"]."',
				'".$_POST["cant_enfer"]."', '".$_POST["temp_valenf"]."', '".$_POST["periodo_valenf"]."', '".$_POST["cant_fisio"]."', '".$_POST["cant_fono"]."'
				, '".$_POST["cant_to"]."', '".$_POST["cant_resp"]."')";
					$subtitulo="Historia Clinica pacientes domiciliarios";
					$subtitulo1="Adicionado";
					$sql1="UPDATE hc_principal SET ant_alergicos='".$_POST["ant_alergicos"]."', ant_patologicos='".$_POST["ant_patologicos"]."', ant_quirurgico='".$_POST["ant_quirurgico"]."',
						 															 ant_toxicologico='".$_POST["ant_toxicologico"]."', ant_farmaco='".$_POST["ant_farmaco"]."',ant_gineco='".$_POST["ant_gineco"]."',
																					 ant_psiquiatrico='".$_POST["ant_psiquiatrico"]."', ant_hospitalario='".$_POST["ant_hospitalario"]."', ant_traumatologico='".$_POST["ant_traumatologico"]."',
																					 ant_familiar='".$_POST["ant_familiar"]."', otros_ant='".$_POST["otros_ant"]."' WHERE id_paciente='".$_POST["paciente"]."' ";

					$subtitulo="Antecedentes";
					$subtitulo1="Adicionados";
			}


			break;

			case 'HCM1':
			$pi=$_POST['pesoinicio'];
			$pa=$_POST['pesoactual'];

			$gana=$pa-$pi;
				$sql="INSERT INTO hc_maternas_pv(id_adm_hosp,id_user,freg,hreg,mc1,mc4,mc5,mc6,mc7,fr1,fr2,fr3,fr4,fr5,fr6,menarquia,ciclos,fum,pfprevia,
					cpreconcepcional,egestacional,fpp,ant_patologicos,ant_quirurgicos,ant_familiares,ant_toxicologicos,ant_transfucionales,pfposterior,metodopf,g,p,a,
					c,e,v,m,g1,g2,g3,g4,g5,p1,p2,p3,p4,p5,a1,a2,a3,a4,a5,c1,c2,c3,c4,c5,e1,e2,e3,e4,e5,v1,v2,v3,v4,v5,m1,m2,m3,movfetal,actuterina,amniorrea,sangvaginal,
					sinturinarios,fvaginal,sintrespiratorios,fiebre,sanganormal,cual,cefalea,fosfenos,acufenos,edemas,epigastralgia,obs_rxs,hemoclasi1,toxoplasma1,serologia1,
					vih1,rubeola1,urocultivo1,frotis1,glicemia1,hemoglobina1,hepatitisb1,hemoclasi2,toxoplasma2,serologia2,vih2,rubeola2,urocultivo2,frotis2,glicemia2,hemoglobina2,
					hepatitisb2,hemoclasi3,toxoplasma3,serologia3,vih3,rubeola3,urocultivo3,frotis3,glicemia3,hemoglobina3,hepatitisb3,fecha1,fecha2,fecha3,egesta1,egesta2,egesta3,
					bfetal1,bfetal2,bfetal3,placenta1,placenta2,placenta3,talla,pesoinicio,imcinicio,pesoactual,clasipeso,ganaciapeso,ta,fc,fr,t,glucometria,cardiopulmonar,au,
					presentacionfeto,situacionfetal,fcf,obs_abdomen,edemasvaso,varices,dxp,tdxp,dx1,tdx1,dx2,tdx2,dx3,tdx3,patoasociada,patoidentificada,pm1,pm2,pm3,pm4,pm5,
					obsgeneral,vrp,vro)
 				VALUES
				 ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["mc1"]."','".$_POST["mc4"]."','".$_POST["mc5"]."',
				 '".$_POST["mc6"]."','".$_POST["mc7"]."','".$_POST["fr1"]."','".$_POST["fr2"]."','".$_POST["fr3"]."','".$_POST["fr4"]."','".$_POST["fr5"]."','".$_POST["fr6"]."'
				,'".$_POST["menarquia"]."','".$_POST["ciclos"]."','".$_POST["fum"]."','".$_POST["pfprevia"]."','".$_POST["cpreconcepcional"]."','".$_POST["egestacional"]."'
				,'".$_POST["fpp"]."','".$_POST["ant_patologicos"]."','".$_POST["ant_quirurgicos"]."','".$_POST["ant_familiares"]."','".$_POST["ant_toxicologicos"]."','".$_POST["ant_transfucionales"]."'
				,'".$_POST["pfposterior"]."','".$_POST["metodopf"]."','".$_POST["g"]."','".$_POST["p"]."','".$_POST["a"]."','".$_POST["c"]."','".$_POST["e"]."','".$_POST["v"]."'
				,'".$_POST["m"]."','".$_POST["g1"]."','".$_POST["g2"]."','".$_POST["g3"]."','".$_POST["g4"]."','".$_POST["g5"]."','".$_POST["p1"]."','".$_POST["p2"]."'
				,'".$_POST["p3"]."','".$_POST["p4"]."','".$_POST["p5"]."','".$_POST["a1"]."','".$_POST["a2"]."','".$_POST["a3"]."','".$_POST["a4"]."','".$_POST["a5"]."'
				,'".$_POST["c1"]."','".$_POST["c2"]."','".$_POST["c3"]."','".$_POST["c4"]."','".$_POST["c5"]."','".$_POST["e1"]."','".$_POST["e2"]."','".$_POST["e3"]."'
				,'".$_POST["e4"]."','".$_POST["e5"]."','".$_POST["v1"]."','".$_POST["v2"]."','".$_POST["v3"]."','".$_POST["v4"]."','".$_POST["v5"]."','".$_POST["m1"]."'
				,'".$_POST["m2"]."','".$_POST["m3"]."','".$_POST["movfetal"]."','".$_POST["actuterina"]."','".$_POST["amniorrea"]."','".$_POST["sangvaginal"]."','".$_POST["sinturinarios"]."'
				,'".$_POST["fvaginal"]."','".$_POST["sintrespiratorios"]."','".$_POST["fiebre"]."','".$_POST["sanganormal"]."','".$_POST["cual"]."','".$_POST["cefalea"]."','".$_POST["fosfenos"]."'
				,'".$_POST["acufenos"]."','".$_POST["edemas"]."','".$_POST["epigastralgia"]."','".$_POST["obs_rxs"]."','".$_POST["hemoclasi1"]."','".$_POST["toxoplasma1"]."','".$_POST["serologia1"]."'
				,'".$_POST["vih1"]."','".$_POST["rubeola1"]."','".$_POST["urocultivo1"]."','".$_POST["frotis1"]."','".$_POST["glicemia1"]."','".$_POST["hemoglobina1"]."','".$_POST["hepatitisb1"]."'
				,'".$_POST["hemoclasi2"]."','".$_POST["toxoplasma2"]."','".$_POST["serologia2"]."','".$_POST["vih2"]."','".$_POST["rubeola2"]."','".$_POST["urocultivo2"]."','".$_POST["frotis2"]."'
				,'".$_POST["glicemia2"]."','".$_POST["hemoglobina2"]."','".$_POST["hepatitisb2"]."','".$_POST["hemoclasi3"]."','".$_POST["toxoplasma3"]."','".$_POST["serologia3"]."'
				,'".$_POST["vih3"]."','".$_POST["rubeola3"]."','".$_POST["urocultivo3"]."','".$_POST["frotis3"]."','".$_POST["glicemia3"]."','".$_POST["hemoglobina3"]."','".$_POST["hepatitisb3"]."','".$_POST["fecha1"]."'
				,'".$_POST["fecha2"]."','".$_POST["fecha3"]."','".$_POST["egesta1"]."','".$_POST["egesta2"]."','".$_POST["egesta3"]."','".$_POST["bfetal1"]."','".$_POST["bfetal2"]."','".$_POST["bfetal3"]."'
				,'".$_POST["placenta1"]."','".$_POST["placenta2"]."','".$_POST["placenta3"]."','".$_POST["talla"]."','".$_POST["pesoinicio"]."','".$_POST["imcinicio"]."','".$_POST["pesoactual"]."'
				,'".$_POST["clasipeso"]."','$gana','".$_POST["ta"]."','".$_POST["fc"]."','".$_POST["fr"]."','".$_POST["t"]."','".$_POST["glucometria"]."','".$_POST["cardiopulmonar"]."'
				,'".$_POST["au"]."','".$_POST["presentacionfeto"]."','".$_POST["situacionfetal"]."','".$_POST["fcf"]."','".$_POST["obs_abdomen"]."','".$_POST["edemasvaso"]."','".$_POST["varices"]."'
				,'".$_POST["dxp"]."','".$_POST["tdxp"]."','".$_POST["dx1"]."','".$_POST["tdx1"]."','".$_POST["dx2"]."','".$_POST["tdx2"]."','".$_POST["dx3"]."','".$_POST["tdx3"]."'
				,'".$_POST["patoasociada"]."','".$_POST["patoidentificada"]."','".$_POST["pm1"]."','".$_POST["pm2"]."','".$_POST["pm3"]."','".$_POST["pm4"]."','".$_POST["pm5"]."','".$_POST["obsgeneral"]."'
				,'".$_POST["vrp"]."','".$_POST["vro"]."')";
				$subtitulo="Historia Clinica maternas";
				$subtitulo1="Adicionado";
			break;
			case 'JM':

			$sql="INSERT INTO junta_medica_dom (  id_hchosp, id_user, freg, hreg,
				medico1, medico2, objetivo_junta, concepto_junta, estado_junta_dom) VALUES
			('".$_POST["id_hchosp"]."','".$_SESSION["AUT"]["id_user"]."',
			 '".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["medico1"]."','".$_POST["medico2"]."',
			 '".$_POST["objetivo_junta"]."','".$_POST["concepto_junta"]."',1)";
				$subtitulo="Junta medica ";
				$subtitulo1="Adicionado";

			break;

		}
		//echo $sql;
		//echo $sql1;
		if ($bd1->consulta($sql)){
			$subtitulo="El formato de $subtitulo fue $subtitulo1 con exito!";
		$check='si';
		if ($bd1->consulta($sql1)) {
				$subtitulo="$subtitulo  $subtitulo1 con exito!";
				$check='si';
		}
		}else{
			$subtitulo="El formato de $subtitulo en $subtitulo2 NO fue $subtitulo1 !!! .";
		$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'HC':
    $sql="SELECT a.id_paciente,tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
    j.nom_eps
    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                left join eps j on (j.id_eps=b.id_eps)
    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar HC ingreso";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return=$_REQUEST['doc'];
			$form1='formulariosDOM/MEDICO/hc_med_dom.php';
			$subtitulo='Historia Clinica Medicina general Servicio Domiciliario';
		break;
		case 'JM':
			$idd=$_REQUEST['idd'];
	    $sql="SELECT id_hchosp,id_d_aut_dom
				    FROM hcini_dom
	    			WHERE id_d_aut_dom =$idd" ;
				$boton="Guardar Junta";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$return=$_REQUEST['doc'];
				$form1='formulariosDOM/MEDICO/junta_medica_dom.php';
				$subtitulo='Junta medica para Historia Clinica Domiciliarios';
				break;
			case 'EVO':
	    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
	    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
	    j.nom_eps
	    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
	                left join eps j on (j.id_eps=b.id_eps)
	    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
				$boton="Agregar Nota Aclaratoria";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$return=$_REQUEST['doc'];
				$form1='formulariosDOM/nota_aclaratoria.php';
				$subtitulo='Nota Aclaratoria';
				break;
			case 'HCM1':
				$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
				b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
				j.nom_eps
				from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
										left join eps j on (j.id_eps=b.id_eps)
				where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
				$boton="Agregar HC materna";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$return=$_REQUEST['doc'];
				$form1='formulariosDOM/add_hcmaternas.php';
				$subtitulo='Historia Clinica';
			break;
			case 'ADX':
      $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Ayuda Diagnostica";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$return=70;
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formulariosDOM/ord_med_dom.php';
			$subtitulo='Solicitud de Ordenes Medicas Servicio Domiciliarios (Procedimientos y laboratorios)';
			break;

		}
			//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"",
				"dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_sedes_ips"=>"","id_hcdom"=>"",
				"id_d_aut_dom"=>"");
			}
		}else{
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"",
				"dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"","id_sedes_ips"=>"","id_hcdom"=>"",
				"id_d_aut_dom"=>"");
			}

		?>


		<?php include($form1);?>

<?php
}else{
if ($check=='si') {
	echo'<section>';
	echo '<script>swal("EXCELENTE !!! '.$subtitulo.'","","success")</script>';
	echo'</section>';
}if ($check=='no') {
	echo'<section>';
	echo '<script>swal("DEBES REVISAR EL PROCESO !!! '.$subtitulo.'","","error")</script>';
	echo'</section>';
}
// nivel 1?>
<section class="panel-default">
	<section class="panel-heading"><h4>Medicina general Servicios Domiciliarios</h4></section>
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

	</section>
	<section class="panel-body">
		<table class="table table-bordered">
			<tr>
				<th class="info">PACIENTE</th>
				<th class="info">INGRESO</th>
				<th class="info">SERVICIOS <br> AUTORIZADOS</th>
				<th class="info">Registro asistencial</th>
			</tr>

			<?php
			if (isset($_REQUEST["doc"])){
			$doc=$_REQUEST["doc"];
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
									 s.nom_sedes,
									 e.nom_eps,e.id_eps ide
						FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
														 INNER JOIN eps e on a.id_eps=e.id_eps
					  WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Activo' and tipo_servicio='Domiciliarios' ";

			if ($tabla=$bd1->sub_tuplas($sql)){
				foreach ($tabla as $fila) {


					echo"<tr>	\n";
					echo'<td class="text-center">
								<p><strong>NOMBRE: </strong> '.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
								<p><strong>IDENTIFICACIÓN: </strong> '.$fila["tdoc_pac"].' '.$fila["doc_pac"].'</p>
								<p><strong>AMD: </strong> '.$fila["id_adm_hosp"].'</p>
							 </td>';
					echo'<td class="text-left">
								<p><strong>FECHA INGRESO: </strong> '.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].' </p>
								<p><strong>SEDE: </strong> '.$fila["nom_sedes"].'</p>
								<p><strong>EPS: </strong> '.$fila["nom_eps"].'</p>
							 </td>';

								$adm=$fila['id_adm_hosp'];
								$hoy=date('Y-m-d');
								$profesional=$_SESSION['AUT']['id_user'];
								$sql_detalle="SELECT a.id_m_aut_dom, id_adm_hosp, zona_paciente,cdx_presentacion,dx_presentacion,
																		 b.id_d_aut_dom, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa, estado_d_aut_dom, intervalo, temporalidad, profesional, f_prof,
																		 c.nomclaseusuario
															FROM m_aut_dom a INNER JOIN d_aut_dom b on a.id_m_aut_dom=b.id_m_aut_dom
																							 INNER JOIN clase_usuario c on a.tipo_paciente=c.id_cusuario
															WHERE a.id_adm_hosp=$adm and b.estado_d_aut_dom in (1,2) and b.cups='890101'";
								//echo $sql_detalle;
								if ($tabla_detalle=$bd1->sub_tuplas($sql_detalle)){
									foreach ($tabla_detalle as $fila_detalle) {
										$hoy=date('Y-m-d');
										$fini=$fila_detalle['finicio'];
										$ffin=$fila_detalle['ffinal'];
										if ($hoy >= $fini && $hoy <= $ffin ) {
											echo'<td class="text-left">';
											echo'<p><strong>ID: </strong> '.$fila_detalle["id_d_aut_dom"].'</p>';
											echo'<p><strong>CUPS: </strong> '.$fila_detalle["cups"].' '.$fila_detalle["procedimiento"].'</p>';
											echo'<p><strong>CANTIDAD AUTORIZADA: </strong> '.$fila_detalle["cantidad"].' <strong>INTERVALO:</strong> '.$fila_detalle["intervalo"].' Min</p>';
											echo'<p class="text-danger"><strong>VIGENCIA AUTORIZACIÓN: </strong> '.$fila_detalle["finicio"].' -- '.$fila_detalle["ffinal"].'</p>';
											echo'</td>';
											$idd=$fila_detalle['id_d_aut_dom'];
											$sql_validar_hc="SELECT count(id_hchosp) cuantas_hc FROM hcini_dom where id_d_aut_dom=$idd";
											if ($tabla_validar_hc=$bd1->sub_tuplas($sql_validar_hc)){
												foreach ($tabla_validar_hc as $fila_validar_hc) {
													$hc_hechas=$fila_validar_hc['cuantas_hc'];
													$hc_autorizada=$fila_detalle['cantidad'];
													if ($hc_hechas < $hc_autorizada) {
														$idd=$fila_detalle['id_d_aut_dom'];
														$sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
														//echo $sql_profesional;
														if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
															foreach ($tabla_profesional as $fila_profesional) {
																$realizador=$_SESSION['AUT']['id_user'];
																$prof_autorizado=$fila_profesional['profesional'];

																if ($realizador === $prof_autorizado) {

																	echo'<th class="text-center">';
																	echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&servicio=Domiciliarios"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Historia Clínica</button></a></p>';
																	echo'<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Domiciliarios&atencion=Domiciliarios&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success" ><span class="fa fa-flask"></span> Ordenes Medicas</button></a></p>
																			 <p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Domiciliarios&atencion=Domiciliarios&doc='.$fila["doc_pac"].'&sede='.$fila['ids'].'&tf=N"><button type="button" class="btn btn-danger " ><span class="fa fa-pills"></span> Formula Medica</button></a></p>';
																	echo'</th>';
																}else {
																	echo'<th class="text-center">';
																	echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p>';
																	echo'</th>';
																}

															}
														}// fin validacion profesional
													}else {
														$idd=$fila_detalle['id_d_aut_dom'];
														$sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
														//echo $sql_profesional;
														if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
															foreach ($tabla_profesional as $fila_profesional) {
																$realizador=$_SESSION['AUT']['id_user'];
																$prof_autorizado=$fila_profesional['profesional'];

																if ($realizador === $prof_autorizado) {

																	echo'<th class="text-center">';
																	echo '<p>No mas hc, ya no tiene mas autorización</p>';
																	echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=JM&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success" ><span class="fa fa-plus-circle"></span> Junta Medica</button></a></p>';
																	echo'<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Domiciliarios&atencion=Domiciliarios&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success" ><span class="fa fa-flask"></span> Ordenes Medicas</button></a></p>
																			 <p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Domiciliarios&atencion=Domiciliarios&doc='.$fila["doc_pac"].'&sede='.$fila['ids'].'&tf=N"><button type="button" class="btn btn-danger " ><span class="fa fa-pills"></span> Formula Medica</button></a></p>';
																	echo'</th>';
																}else {
																	echo'<th class="text-center">';
																	echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p>';
																	echo'</th>';
																}
															}
														}// fin validacion profesional
													}//validacion para que no se pase de lo autorizado.
												}
											}else {
												$idd=$fila_detalle['id_d_aut_dom'];
												$sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
												//echo $sql_profesional;
												if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
													foreach ($tabla_profesional as $fila_profesional) {
														$realizador=$_SESSION['AUT']['id_user'];
														$prof_autorizado=$fila_profesional['profesional'];

														if ($realizador === $prof_autorizado) {

															echo'<th class="text-center">';
															echo '<p>No mas hc, ya no tiene mas autorización</p>';
															echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=JM&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success" ><span class="fa fa-plus-circle"></span> Junta Medica</button></a></p>';
															echo'<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Domiciliarios&atencion=Domiciliarios&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success" ><span class="fa fa-flask"></span> Ordenes Medicas</button></a></p>
																	 <p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Domiciliarios&atencion=Domiciliarios&doc='.$fila["doc_pac"].'&sede='.$fila['ids'].'&tf=N"><button type="button" class="btn btn-danger " ><span class="fa fa-pills"></span> Formula Medica</button></a></p>';
															echo'</th>';
														}else {
															echo'<th class="text-center">';
															echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p>';
															echo'</th>';
														}
													}
												}// fin validacion profesional
											}

										}else {

											echo'<th class="text-center">';
											$ffinal=$fila_detalle['ffinal'];
											$hoy = date("Y-m-d",strtotime($ffinal."+ 15 days")) ;
											$hoy1=date('Y-m-d');
											if ($hoy1 <= $hoy) {
												$idd=$fila_detalle['id_d_aut_dom'];
												echo'
												<p class="alert alert-danger animated bounceIn">El procedimiento YA supero el limite de fecha. Tienes la ultima oportunidad.</p>
												<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&servicio=Domiciliarios"><button type="button" class="btn btn-warning" ><span class="fa fa-plus-circle"></span> Historia Clínica</button></a></p>
												';

											}else {
												echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-frown fa-2x"></span> Ya se cerro la Orden</p>';
											}
											echo'</th>';
											echo'<th class="text-center"><p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p></th>';
										}

									}
								}else {
									echo'<th class="text-center">
												<p>El paciente no tiene servicios autorizados para Medicina General</p>
											 </th>';
								}


					echo "</tr>\n";
				}
			}
		}
		if (isset($_REQUEST["nom"])){
			$doc=$_REQUEST["nom"];
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,
									 a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
									 s.nom_sedes,
									 e.nom_eps,e.id_eps ide
						FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
														 LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips
														 INNER JOIN eps e on a.id_eps=e.id_eps
			WHERE p.nom_completo LIKE '%".$doc."%' and a.estado_adm_hosp='Activo'  and tipo_servicio='Domiciliarios' ";
//echo $sql;
			if ($tabla=$bd1->sub_tuplas($sql)){

				foreach ($tabla as $fila ) {


										echo"<tr>	\n";
										echo'<td class="text-center">
													<p><strong>NOMBRE: </strong> '.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
													<p><strong>IDENTIFICACIÓN: </strong> '.$fila["tdoc_pac"].' '.$fila["doc_pac"].'</p>
													<p><strong>AMD: </strong> '.$fila["id_adm_hosp"].'</p>
												 </td>';
										echo'<td class="text-left">
													<p><strong>FECHA INGRESO: </strong> '.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].' </p>
													<p><strong>SEDE: </strong> '.$fila["nom_sedes"].'</p>
													<p><strong>EPS: </strong> '.$fila["nom_eps"].'</p>
												 </td>';

													$adm=$fila['id_adm_hosp'];
													$hoy=date('Y-m-d');
													$profesional=$_SESSION['AUT']['id_user'];
													$sql_detalle="SELECT a.id_m_aut_dom, id_adm_hosp, zona_paciente,cdx_presentacion,dx_presentacion,
																							 b.id_d_aut_dom, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa, estado_d_aut_dom, intervalo, temporalidad, profesional, f_prof,
																							 c.nomclaseusuario
																				FROM m_aut_dom a INNER JOIN d_aut_dom b on a.id_m_aut_dom=b.id_m_aut_dom
																												 INNER JOIN clase_usuario c on a.tipo_paciente=c.id_cusuario
																				WHERE a.id_adm_hosp=$adm and b.estado_d_aut_dom in (1,2) and b.cups='890101'";
													//echo $sql_detalle;
													if ($tabla_detalle=$bd1->sub_tuplas($sql_detalle)){
														foreach ($tabla_detalle as $fila_detalle) {
															$hoy=date('Y-m-d');
															$fini=$fila_detalle['finicio'];
															$ffin=$fila_detalle['ffinal'];
															if ($hoy >= $fini && $hoy <= $ffin ) {
																echo'<td class="text-left">';
																echo'<p><strong>ID: </strong> '.$fila_detalle["id_d_aut_dom"].'</p>';
																echo'<p><strong>CUPS: </strong> '.$fila_detalle["cups"].' '.$fila_detalle["procedimiento"].'</p>';
																echo'<p><strong>CANTIDAD AUTORIZADA: </strong> '.$fila_detalle["cantidad"].' <strong>INTERVALO:</strong> '.$fila_detalle["intervalo"].' Min</p>';
																$d=$fila_detalle["id_d_aut_dom"];
																$sql_cuantos="SELECT count(id_d_aut_dom) cuantos FROM hcini_dom FROM id_d_aut_dom=$d and estado_hchosp='Realizada'";
																if ($tabla_cuantos=$bd1->sub_tuplas($sql_cuantos)){
																	foreach ($tabla_cuantos as $fila_cuantos) {
																		echo '<h3><strong class="text-danger"> Avance: </strong>'.$fila_cuantos['cuantos'].'</h3>';
																	}
																}else {
																	echo '<small><strong class="text-danger">Creemos que deberías avanzar en el proceso</strong></small>';
																}

																echo'<h3 class="text-danger"><strong>VIGENCIA AUTORIZACIÓN: </strong> '.$fila_detalle["finicio"].' -- '.$fila_detalle["ffinal"].'</h3>';
																echo'</td>';
																$avance=$fila_cuantos['cuantos'];
																$meta=$fila_detalle["cantidad"];
																if ($avance < $meta) {
																	$idd=$fila_detalle['id_d_aut_dom'];
																	$sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
																	//echo $sql_profesional;
																	if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
																		foreach ($tabla_profesional as $fila_profesional) {
																			$realizador=$_SESSION['AUT']['id_user'];
																			$prof_autorizado=$fila_profesional['profesional'];

																			if ($realizador === $prof_autorizado) {
																				echo'<th class="text-center">';
																				echo '<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&servicio=Domiciliarios"><button type="button" class="btn btn-primary" ><span class="fa fa-plus-circle"></span> Historia Clínica</button></a></p>';
																				echo'<p><a href="'.PROGRAMA.'?opcion=133&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Domiciliarios&atencion=Domiciliarios&doc='.$fila["doc_pac"].'"><button type="button" class="btn btn-success" ><span class="fa fa-flask"></span> Ordenes Medicas</button></a></p>
																				     <p><a href="'.PROGRAMA.'?opcion=151&idadmhosp='.$fila["id_adm_hosp"].'&servicio=Domiciliarios&atencion=Domiciliarios&doc='.$fila["doc_pac"].'&sede='.$fila['ids'].'&tf=N"><button type="button" class="btn btn-danger " ><span class="fa fa-pills"></span> Formula Medica</button></a></p>';
																				echo'</th>';
																			}else {
																				echo'<th class="text-center">';
																				echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p>';
																				echo'</th>';
																			}

																		}
																	}// fin validacion profesional
																}

															}else {

																echo'<th class="text-center">';
																$ffinal=$fila_detalle['ffinal'];
																$hoy = date("Y-m-d",strtotime($ffinal."+ 15 days")) ;
																$hoy1=date('Y-m-d');
																if ($hoy1 <= $hoy) {
																	$idd=$fila_detalle['id_d_aut_dom'];
																	echo'
																	<p class="alert alert-danger animated bounceIn">El procedimiento YA supero el limite de fecha. Tienes la ultima oportunidad.</p>
																	<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&servicio=Domiciliarios"><button type="button" class="btn btn-warning" ><span class="fa fa-plus-circle"></span> Historia Clínica</button></a></p>
																	';

																}else {
																	echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-frown fa-2x"></span> Ya se cerro la Orden</p>';
																}
																echo'</th>';
																echo'<th class="text-center"><p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p></th>';
															}

														}
													}else {
														echo'<th class="text-center">
																	<p>El paciente no tiene servicios autorizados para Medicina General</p>
																 </th>';
													}


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
