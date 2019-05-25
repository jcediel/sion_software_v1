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
			$servicio=$_SESSION["AUT"]["id_user"];
				if ($servicio=='TERAPIA OCUPACIONAL') {
					$sql="INSERT INTO terapia_ocupacional_ce (  id_adm_hosp, id_user, freg_to_ce, hreg_to_ce, motivo_consulta, cuello1_aa_d,
						cuello1_aa_i, cuello1_fm_d, cuello1_fm_i, cuello2_aa_d, cuello2_aa_i, cuello2_fm_d, cuello2_fm_i, cuello3_aa_d, cuello3_aa_i,
						cuello3_fm_d, cuello3_fm_i, esca1_aa_d, esca1_aa_i, esca1_fm_d, esca1_fm_i, esca2_aa_d, esca2_aa_i, esca2_fm_d, esca2_fm_i,
						esca3_aa_d, esca3_aa_i, esca3_fm_d, esca3_fm_i, esca4_aa_d, esca4_aa_i, esca4_fm_d, esca4_fm_i, hom1_a_d, hom1_a_i, hom1_f_d,
						hom1_f_i, hom2_a_d, hom2_a_i, hom2_f_d, hom2_f_i, hom3_a_d, hom3_a_i, hom3_f_d, hom3_f_i, hom4_a_d, hom4_a_i, hom4_f_d, hom4_f_i,
						hom5_a_d, hom5_a_i, hom5_f_d, hom5_f_i, hom6_a_d, hom6_a_i, hom6_f_d, hom6_f_i, codo1_a_d, codo1_a_i, codo1_f_d, codo1_f_i, codo2_a_d,
						codo2_a_i, codo2_f_d, codo2_f_i, codo3_a_d, codo3_a_i, codo3_f_d, codo3_f_i, codo4_a_d, codo4_a_i, codo4_f_d, codo4_f_i, mun1_a_d, mun1_a_i,
						 mun1_f_d, mun1_f_i, mun2_a_d, mun2_a_i, mun2_f_d, mun2_f_i, dedo1_a_d, dedo1_a_i, dedo1_f_d, dedo1_f_i, dedo2_a_d, dedo2_a_i,
						 dedo2_f_d, dedo2_f_i, dedo3_a_d, dedo3_a_i, dedo3_f_d, dedo3_f_i, dedo4_a_d, dedo4_a_i, dedo4_f_d, dedo4_f_i, tronco1_a_d,
						 tronco1_a_i, tronco1_f_d, tronco1_f_i, tronco2_a_d, tronco2_a_i, tronco2_f_d, tronco2_f_i, mmii1_a_d, mmii1_a_i, mmii1_f_d,
						  mmii1_f_i, mmii2_a_d, mmii2_a_i, mmii2_f_d, mmii2_f_i, mmii3_a_d, mmii3_a_i, mmii3_f_d, mmii3_f_i, obs_aspfisico, me1_msd,
							me1_msi, me2_msd, me2_msi, me3_msd, me3_msi, hab_mot_sup, hab_mot_inf, hab_mot_int, estado_to_ce) VALUES
					('".$_POST["idadmhosp"]."',
	'".$_SESSION["AUT"]["id_user"]."',
	'".$_POST["freg"]."',
	'".$_POST["hreg"]."',
	'".$_POST["motivo_consulta"]."',
	'".$_POST["cuello1_aa_d"]."',
	'".$_POST["cuello1_aa_i"]."',
	'".$_POST["cuello1_fm_d"]."',
	'".$_POST["cuello1_fm_i"]."',
	'".$_POST["cuello2_aa_d"]."',
	'".$_POST["cuello2_aa_i"]."',
	'".$_POST["cuello2_fm_d"]."',
	'".$_POST["cuello2_fm_i"]."',
	'".$_POST["cuello3_aa_d"]."',
	'".$_POST["cuello3_aa_i"]."',
	'".$_POST["cuello3_fm_d"]."',
	'".$_POST["cuello3_fm_i"]."',
	'".$_POST["esca1_aa_d"]."',
	'".$_POST["esca1_aa_i"]."',
	'".$_POST["esca1_fm_d"]."',
	'".$_POST["esca1_fm_i"]."',
	'".$_POST["esca2_aa_d"]."',
	'".$_POST["esca2_aa_i"]."',
	'".$_POST["esca2_fm_d"]."',
	'".$_POST["esca2_fm_i"]."',
	'".$_POST["esca3_aa_d"]."',
	'".$_POST["esca3_aa_i"]."',
	'".$_POST["esca3_fm_d"]."',
	'".$_POST["esca3_fm_i"]."',
	'".$_POST["esca4_aa_d"]."',
	'".$_POST["esca4_aa_i"]."',
	'".$_POST["esca4_fm_d"]."',
	'".$_POST["esca4_fm_i"]."',
	'".$_POST["hom1_a_d"]."',
	'".$_POST["hom1_a_i"]."',
	'".$_POST["hom1_f_d"]."',
	'".$_POST["hom1_f_i"]."',
	'".$_POST["hom2_a_d"]."',
	'".$_POST["hom2_a_i"]."',
	'".$_POST["hom2_f_d"]."',
	'".$_POST["hom2_f_i"]."',
	'".$_POST["hom3_a_d"]."',
	'".$_POST["hom3_a_i"]."',
	'".$_POST["hom3_f_d"]."',
	'".$_POST["hom3_f_i"]."',
	'".$_POST["hom4_a_d"]."',
	'".$_POST["hom4_a_i"]."',
	'".$_POST["hom4_f_d"]."',
	'".$_POST["hom4_f_i"]."',
	'".$_POST["hom5_a_d"]."',
	'".$_POST["hom5_a_i"]."',
	'".$_POST["hom5_f_d"]."',
	'".$_POST["hom5_f_i"]."',
	'".$_POST["hom6_a_d"]."',
	'".$_POST["hom6_a_i"]."',
	'".$_POST["hom6_f_d"]."',
	'".$_POST["hom6_f_i"]."',
	'".$_POST["codo1_a_d"]."',
	'".$_POST["codo1_a_i"]."',
	'".$_POST["codo1_f_d"]."',
	'".$_POST["codo1_f_i"]."',
	'".$_POST["codo2_a_d"]."',
	'".$_POST["codo2_a_i"]."',
	'".$_POST["codo2_f_d"]."',
	'".$_POST["codo2_f_i"]."',
	'".$_POST["codo3_a_d"]."',
	'".$_POST["codo3_a_i"]."',
	'".$_POST["codo3_f_d"]."',
	'".$_POST["codo3_f_i"]."',
	'".$_POST["codo4_a_d"]."',
	'".$_POST["codo4_a_i"]."',
	'".$_POST["codo4_f_d"]."',
	'".$_POST["codo4_f_i"]."',
	'".$_POST["mun1_a_d"]."',
	'".$_POST["mun1_a_i"]."',
	'".$_POST["mun1_f_d"]."',
	'".$_POST["mun1_f_i"]."',
	'".$_POST["mun2_a_d"]."',
	'".$_POST["mun2_a_i"]."',
	'".$_POST["mun2_f_d"]."',
	'".$_POST["mun2_f_i"]."',
	'".$_POST["dedo1_a_d"]."',
	'".$_POST["dedo1_a_i"]."',
	'".$_POST["dedo1_f_d"]."',
	'".$_POST["dedo1_f_i"]."',
	'".$_POST["dedo2_a_d"]."',
	'".$_POST["dedo2_a_i"]."',
	'".$_POST["dedo2_f_d"]."',
	'".$_POST["dedo2_f_i"]."',
	'".$_POST["dedo3_a_d"]."',
	'".$_POST["dedo3_a_i"]."',
	'".$_POST["dedo3_f_d"]."',
	'".$_POST["dedo3_f_i"]."',
	'".$_POST["dedo4_a_d"]."',
	'".$_POST["dedo4_a_i"]."',
	'".$_POST["dedo4_f_d"]."',
	'".$_POST["dedo4_f_i"]."',
	'".$_POST["tronco1_a_d"]."',
	'".$_POST["tronco1_a_i"]."',
	'".$_POST["tronco1_f_d"]."',
	'".$_POST["tronco1_f_i"]."',
	'".$_POST["tronco2_a_d"]."',
	'".$_POST["tronco2_a_i"]."',
	'".$_POST["tronco2_f_d"]."',
	'".$_POST["tronco2_f_i"]."',
	'".$_POST["mmii1_a_d"]."',
	'".$_POST["mmii1_a_i"]."',
	'".$_POST["mmii1_f_d"]."',
	'".$_POST["mmii1_f_i"]."',
	'".$_POST["mmii2_a_d"]."',
	'".$_POST["mmii2_a_i"]."',
	'".$_POST["mmii2_f_d"]."',
	'".$_POST["mmii2_f_i"]."',
	'".$_POST["mmii3_a_d"]."',
	'".$_POST["mmii3_a_i"]."',
	'".$_POST["mmii3_f_d"]."',
	'".$_POST["mmii3_f_i"]."',
	'".$_POST["obs_aspfisico"]."',
	'".$_POST["me1_msd"]."',
	'".$_POST["me1_msi"]."',
	'".$_POST["me2_msd"]."',
	'".$_POST["me2_msi"]."',
	'".$_POST["me3_msd"]."',
	'".$_POST["me3_msi"]."',
	'".$_POST["hab_mot_sup"]."',
	'".$_POST["hab_mot_inf"]."',
	'".$_POST["hab_mot_int"]."',
	'Realizada')";
	$subtitulo="Valoracion inicial";
		$subtitulo1="Adicionado";
					$subtitulo2="Terapia Ocupacional";
					}
					if ($servicio=='FISIOTERAPIA') {
						$sql="INSERT INTO fisioterapia_ce ( id_adm_hosp,id_user,freg_fisio_ce, hreg_fisio_ce, motivo_consulta, ant_patologico,
						ant_traumaticos, ant_toxicologico, ant_quirurgico, ant_farmacologico, ant_ocupacional, ant_familiar, apoyo_dx, dolor, pf,
						 sencibilidad, fosteomuscular, postura, marcha, dx_fisioterapeutico, pron_fisioterapeutico, plan_intervencion, obj_terapeutico,
						 estado_fisio_ce ) VALUES
						('".$_POST["idadmhosp"]."',
		'".$_SESSION["AUT"]["id_user"]."',
		'".$_POST["freg"]."',
		'".$_POST["hreg"]."',
		'".$_POST["motivo_consulta"]."',
		'".$_POST["ant_patologico"]."',
		'".$_POST["ant_traumaticos"]."',
		'".$_POST["ant_toxicologico"]."',
		'".$_POST["ant_quirurgico"]."',
		'".$_POST["ant_farmacologico"]."',
		'".$_POST["ant_ocupacional"]."',
		'".$_POST["ant_familiar"]."',
		'".$_POST["apoyo_dx"]."',
		'".$_POST["dolor"]."',
		'".$_POST["pf"]."',
		'".$_POST["sencibilidad"]."',
		'".$_POST["fosteomuscular"]."',
		'".$_POST["postura"]."',
		'".$_POST["marcha"]."',
		'".$_POST["dx_fisioterapeutico"]."',
		'".$_POST["pron_fisioterapeutico"]."',
		'".$_POST["plan_intervencion"]."',
		'".$_POST["obj_terapeutico"]."',
		'Realizada')";
						$subtitulo="Valoracion inicial";
						$subtitulo1="Adicionado";
						$subtitulo2="Terapia Fisica";
					}
					if ($servicio=='FONOAUDIOLOGIA') {
						$sql="INSERT INTO fonoaudiologia_ce (id_adm_hosp, id_user, freg_fisio_ce, hreg_fisio_ce, motivo_consulta, ant_patologico,
						ant_traumaticos, ant_toxicologico, ant_quirurgico, ant_farmacologico, ant_ocupacional, ant_familiar, apoyo_dx, dolor, pf,
						sencibilidad, fosteomuscular, postura, marcha, dx_fisioterapeutico, pron_fisioterapeutico, plan_intervencion, obj_terapeutico,
						estado_fisio_ce) VALUES
						('".$_POST["id_adm_hosp"]."',
		'".$_SESSION["AUT"]["id_user"]."',
		'".$_POST["freg"]."',
		'".$_POST["hreg"]."',
		'".$_POST["tmuscular_i"]."',
		'".$_POST["sencibilidad_i"]."',
		'".$_POST["sfacial_i"]."',
		'".$_POST["labios_i"]."',
		'".$_POST["maxilar_i"]."',
		'".$_POST["paladar_i"]."',
		'".$_POST["sialorrea_i"]."',
		'".$_POST["resp_i"]."',
		'".$_POST["toclusion_i"]."',
		'".$_POST["praxia1"]."',
		'".$_POST["praxia2"]."',
		'".$_POST["praxia3"]."',
		'".$_POST["praxia4"]."',
		'".$_POST["praxia5"]."',
		'".$_POST["praxia6"]."',
		'".$_POST["praxia7"]."',
		'".$_POST["praxia8"]."',
		'".$_POST["praxia9"]."',
		'".$_POST["praxia10"]."',
		'".$_POST["praxia11"]."',
		'".$_POST["desa_lingue"]."',
		'".$_POST["test_arti"]."',
		'".$_POST["f_alimenticias"]."',
		'".$_POST["nseman1"]."',
		'".$_POST["nseman2"]."',
		'".$_POST["nseman3"]."',
		'".$_POST["nseman4"]."',
		'".$_POST["nseman5"]."',
		'".$_POST["nseman6"]."',
		'".$_POST["nsintac1"]."',
		'".$_POST["nsintac2"]."',
		'".$_POST["nsintac3"]."',
		'".$_POST["nsintac4"]."',
		'".$_POST["nsintac5"]."',
		'".$_POST["nsintac6"]."',
		'".$_POST["nprag1"]."',
		'".$_POST["nprag2"]."',
		'".$_POST["nprag3"]."',
		'".$_POST["nprag4"]."',
		'".$_POST["nprag5"]."',
		'".$_POST["nprag6"]."',
		'".$_POST["nprag7"]."',
		'".$_POST["nprag8"]."',
		'".$_POST["senso1"]."',
		'".$_POST["senso2"]."',
		'".$_POST["senso3"]."',
		'".$_POST["senso4"]."',
		'".$_POST["senso5"]."',
		'".$_POST["senso6"]."',
		'".$_POST["senso7"]."',
		'".$_POST["senso8"]."',
		'".$_POST["codlectoescrito"]."',
		'".$_POST["dxcomunicativo"]."','Realizada')";

					$subtitulo="Valoracion inicial";
						$subtitulo1="Adicionado";
						$subtitulo2="Fonoaudiologia";
						}
						if ($servicio=='PSICOLOGIA') {
							$sql="INSERT INTO psicologia_ce ( id_adm_hosp ,  id_user ,  freg_psico_ce ,  hreg_psico_ce ,  motivo_consulta ,
							remitido_por ,  antecedentes ,  examen_mental ,  personal_social ,  area_familiar ,  area_laboral ,  area_emocional ,
							observaciones ,  plan_tratamiento ,  estado_psico_ce ) VALUES
							('".$_POST["idadmhosp"]."',
			'".$_SESSION["AUT"]["id_user"]."',
			'".$_POST["freg"]."',
			'".$_POST["hreg"]."',
			'".$_POST["motivo_consulta"]."',
			'".$_POST["remitido_por"]."',
			'".$_POST["antecedentes"]."',
			'".$_POST["examen_mental"]."',
			'".$_POST["personal_social"]."',
			'".$_POST["area_familiar"]."',
			'".$_POST["area_laboral"]."',
			'".$_POST["area_emocional"]."',
			'".$_POST["observaciones"]."',
			'".$_POST["plan_tratamiento"]."',
			'Realizada')";
							$subtitulo="Valoracion inicial";
							$subtitulo1="Adicionado";
							$subtitulo2="Psicologia";
						}
			break;
			case 'EVO':
				$sql="INSERT INTO evolucion_arl (id_adm_hosp, id_user, freg_evo_arl, hreg_evo_arl, evolucion_arl, espec_evo_arl,estado_evo_arl) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["evoto"]."','".$_SESSION["AUT"]["especialidad"]."','Realizada')";
				$subtitulo="EVolución";
				$subtitulo1="Adicionado";
				$subtitulo2=$_SESSION["AUT"]["especialidad"];
			break;
			case 'IM':
				$sql="INSERT INTO im_arl (id_adm_hosp, id_user, freg_im_arl, hreg_im_arl, coddx_arl, descridx_arl,informe_arl,especialidad_arl, estado_im_arl) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["fregimto"]."','".$_POST["hregimto"]."','".$_POST["cdxp"]."','".$_POST["descridxp"]."','".$_POST["informe"]."','".$_SESSION["AUT"]["especialidad"]."','Realizada')";
				$subtitulo="Informe Mensual";
				$subtitulo1="Adicionado";
				$subtitulo2=$_SESSION["AUT"]["especialidad"];
			break;
			case 'PT':
				$sql="INSERT INTO planintervencion_arl(id_adm_hosp, id_user, freg_pt_arl, hreg_pt_arl, obgen_arl, obespec1_arl, espec_pt_arl, estado_pt_arl) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["fregptto"]."','".$_POST["hregptto"]."','".$_POST["obgen_reh"]."','".$_POST["obespec1_reh"]."','".$_SESSION["AUT"]["especialidad"]."','Realizada')";
				$subtitulo="Plan Trimestral";
				$subtitulo1="Adicionado";
				$subtitulo2=$_SESSION["AUT"]["especialidad"];
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){

			$subtitulo="El formato agregado con exito";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El formato de $subtitulo en  Area $subtitulo2 NO fue $subtitulo1 !!! .";
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'VI':
		$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
		b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
		c.descripestadoc,
		d.descriafiliado,
		e.descritusuario,
		f.descriocu,
		g.descripdep,
		h.descrimuni,
		i.descripuedad,
		j.nom_eps
		from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
					left join estado_civil c on (c.codestadoc = a.estadocivil)
					left join tusuario e on (e.codtusuario=b.tipo_usuario)
					left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
					left join ocupacion f on (f.codocu=b.ocupacion)
					left join departamento g on (g.coddep=b.dep_residencia)
					left join municipios h on (h.codmuni=b.mun_residencia)
					left join uedad i on (i.coduedad=a.uedad)
					left join eps j on (j.id_eps=b.id_eps)
		where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Valoración";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$area=$_SESSION["AUT"]["especialidad"];
			$date=date('Y-m-d');
			$date1=date('H:i');
			if ($area=='TERAPIA OCUPACIONAL') {
				$form1='formularios/valinito_ce.php';
				$subtitulo='Valoracion inicial Servicio ARL';
			}
			if ($area=='FISIOTERAPIA') {
				$form1='formularios/valinifisio_ce.php';
				$subtitulo='Valoracion inicial Servicio ARL';
			}
			if ($area=='PSICOLOGIA') {
				$form1='formularios/valinipsico_ce.php';
				$subtitulo='Valoracion inicial Servicio ARL';
			}
			if ($area=='FONOAUDIOLOGIA') {
				$form1='formularios/valinifono_ce.php';
				$subtitulo='Valoracion inicial Servicio ARL';
			}

			break;
			case 'EVO':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
			c.descripestadoc,
			d.descriafiliado,
			e.descritusuario,
			f.descriocu,
			g.descripdep,
			h.descrimuni,
			i.descripuedad,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
			      left join estado_civil c on (c.codestadoc = a.estadocivil)
			      left join tusuario e on (e.codtusuario=b.tipo_usuario)
			      left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
			      left join ocupacion f on (f.codocu=b.ocupacion)
			      left join departamento g on (g.coddep=b.dep_residencia)
			      left join municipios h on (h.codmuni=b.mun_residencia)
			      left join uedad i on (i.coduedad=a.uedad)
			      left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Evolución";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/evo_arl.php';
			$subtitulo='Evolución servicio ARL';
			break;
			case 'IM':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
			c.descripestadoc,
			d.descriafiliado,
			e.descritusuario,
			f.descriocu,
			g.descripdep,
			h.descrimuni,
			i.descripuedad,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
			      left join estado_civil c on (c.codestadoc = a.estadocivil)
			      left join tusuario e on (e.codtusuario=b.tipo_usuario)
			      left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
			      left join ocupacion f on (f.codocu=b.ocupacion)
			      left join departamento g on (g.coddep=b.dep_residencia)
			      left join municipios h on (h.codmuni=b.mun_residencia)
			      left join uedad i on (i.coduedad=a.uedad)
			      left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Informe Mensual";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/im_arl.php';
			$subtitulo='Informe Mensual servicio ARL';
			break;
			case 'PT':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
			b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
			c.descripestadoc,
			d.descriafiliado,
			e.descritusuario,
			f.descriocu,
			g.descripdep,
			h.descrimuni,
			i.descripuedad,
			j.nom_eps
			from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
			      left join estado_civil c on (c.codestadoc = a.estadocivil)
			      left join tusuario e on (e.codtusuario=b.tipo_usuario)
			      left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
			      left join ocupacion f on (f.codocu=b.ocupacion)
			      left join departamento g on (g.coddep=b.dep_residencia)
			      left join municipios h on (h.codmuni=b.mun_residencia)
			      left join uedad i on (i.coduedad=a.uedad)
			      left join eps j on (j.id_eps=b.id_eps)
			where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar Plan intervencion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formularios/plan_arl.php';
			$subtitulo='Plan Trimestral servicio ARL';
			break;

		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"","zona_residencia"=>"","nivel"=>"","tipo_servicio"=>"","resp_admhosp"=>"","descripestadoc"=>"","descriafiliado"=>"","descritusuario"=>"","descriocu"=>"", "descripdep"=>"", "descrimuni"=>"", "descripuedad"=>"", "nom_eps"=>"");$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","lateralidad"=>"","profesion"=>"","religion"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"","zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");

			}
		}else{
			$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"","zona_residencia"=>"","nivel"=>"","tipo_servicio"=>"","resp_admhosp"=>"","descripestadoc"=>"","descriafiliado"=>"","descritusuario"=>"","descriocu"=>"", "descripdep"=>"", "descrimuni"=>"", "descripuedad"=>"", "nom_eps"=>"");$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","lateralidad"=>"","profesion"=>"","religion"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"","zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");

			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].hreg.value > document.forms[0].fecha.value){
					alert("Profesional (a) <?php echo $_SESSION["AUT"]["nombre"]?>, NO puede adelantar el tiempo.");
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
	<section class="panel panel-default" class="col-xs-7">
		<form class="navbar-form navbar-center" role="search" >
        	<section class="form-group col-xs-3">
          		<input type="text" class="form-control" name="doc" placeholder="Digite Identificacion">
        	</section>
        	<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
        	<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
    </form>
		<form class="navbar-form navbar-center" role="search">
					<section class="form-group col-xs-3">
							<input type="text" class="form-control" name="nom" placeholder="Digite Nombre paciente">
					</section>
					<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
					<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		</form>
	</section>
<table class="table table-bordered">
	<tr>
		<th id="th-estilo1">ADMISION</th>
		<th id="th-estilo1">IDENTIFICACION</th>
		<th id="th-estilo2">NOMBRES Y APELLIDOS</th>
		<th id="th-estilo3">FECHA INGRESO</th>
		<th id="th-estilo3">FOTO</th>
		<th id="th-estilo4">Valoracion inicial</th>
		<th id="th-estilo4">Evolucion</th>
		<th id="th-estilo4">Informe Mensual</th>
		<th id="th-estilo4">Plan trimestral</th>
	</tr>

	<?php
	if (isset($_REQUEST["doc"])){
	$doc=$_REQUEST["doc"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,s.nom_sedes FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips  WHERE p.doc_pac='".$doc."' and a.estado_adm_hosp='Activo' and tipo_servicio='ARL'";

	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {

			echo"<tr >\n";
			echo'<td class="text-center">'.$fila["id_adm_hosp"].'</td>';
			echo'<td class="text-center">'.$fila["doc_pac"].'</td>';
			echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
			echo'<td class="text-center">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
			echo'<td class="text-center"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
			echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
			echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
			echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=IM&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
			echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PT&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';

			echo "</tr>\n";
		}
	}
}	if (isset($_REQUEST["nom"])){
	$doc=$_REQUEST["nom"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,s.nom_sedes FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips  WHERE p.nom1 LIKE '%".$doc."%' and a.estado_adm_hosp='Activo'  and tipo_servicio='ARL'";

	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {

			echo"<tr >\n";
			echo'<td class="text-center">'.$fila["id_adm_hosp"].'</td>';
			echo'<td class="text-center">'.$fila["doc_pac"].'</td>';
			echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
			echo'<td class="text-center">'.$fila["fingreso_hosp"].' | '.$fila["hingreso_hosp"].'</td>';
			echo'<td class="text-center"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
			echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
			echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
			echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=IM&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-danger sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
			echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PT&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-info sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';

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
