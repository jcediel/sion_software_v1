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
				$tallat=$_POST["talla"] * $_POST["talla"];
				$imc=$_POST["peso"] / $tallat;
				$tam1=$_POST["tad"] * 2;
				$tam2=$tam1 + $_POST["tds"];
				$tamt=$tam2/3;
				$dxp=substr($_POST['dx'], 0,4);
				$dx1=substr($_POST['dx1'], 0,4);
				$dx2=substr($_POST['dx2'], 0,4);
				$dx3=substr($_POST['dx3'], 0,4);
				$sql="INSERT INTO hc_hospitalario (id_adm_hosp,id_user,freg_hchosp,hreg_hchosp,motivo_consulta,enfer_actual,his_personal,his_familiar,
					perso_premorbida,ant_alergicos,ant_patologico,ant_quirurgico,ant_toxicologico,ant_farmaco,ant_gineco,ant_psiquiatrico,ant_hospitalario,
					ant_traumatologico,ant_familiar,otros_ant,estado_general,tad,tas,tam,fr,fc,so,peso,talla,temperatura,imc,cabcuello,torax,ext,abdomen,
					neurologico,genitourinario,examen_mental,analisis,finalidad,causa_externa,dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,
					dx3,ddx3,tdx3,plantratamiento,tipo_atencion,especialidad,estado_hchosp) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["motivoconsulta"]."',
				'".$_POST["enferactual"]."','".$_POST["hpersonal"]."','".$_POST["hfamiliar"]."','".$_POST["ppremorbida"]."','".$_POST["antalergico"]."',
				'".$_POST["antpatologico"]."','".$_POST["antquirurgico"]."','".$_POST["anttoxicologicos"]."','".$_POST["antfarmacologico"]."',
				'".$_POST["antgineco"]."','".$_POST["antpsiquiatrico"]."','".$_POST["anthospitalario"]."','".$_POST["anttrauma"]."','".$_POST["antfami"]."',
				'".$_POST["antotros"]."','".$_POST["estadogen"]."','".$_POST["tad"]."','".$_POST["tas"]."','$tamt','".$_POST["fr"]."','".$_POST["fc"]."',
				'".$_POST["sao2"]."','".$_POST["peso"]."','".$_POST["talla"]."','".$_POST["temperatura"]."','$imc','".$_POST["cabezacuello"]."',
				'".$_POST["torax"]."','".$_POST["extsup"]."','".$_POST["abdomen"]."','".$_POST["neurologico"]."','".$_POST["genitourinario"]."',
				'".$_POST["exmental"]."','".$_POST["analisis"]."','".$_POST["finconsulta"]."','".$_POST["causaexterna"]."',
				'$dxp','".$_POST["dx"]."','".$_POST["tdx"]."','$dx1','".$_POST["dx1"]."','".$_POST["tdx1"]."','$dx2',
				'".$_POST["dx2"]."','".$_POST["tdx2"]."','$dx3','".$_POST["dx3"]."','".$_POST["tdx3"]."','".$_POST["plant"]."','Hospitalario',
				'".$_SESSION["AUT"]["especialidad"]."','Realizada')";
					$subtitulo="Historia Clinica de ingreso";
					$subtitulo1="Adicionado";
				break;
				case 'EVO':
				$dxp=substr($_POST['dx'], 0,4);
				$dx1=substr($_POST['dx1'], 0,4);
				$dx2=substr($_POST['dx2'], 0,4);
				$dx3=substr($_POST['dx3'], 0,4);
					$sql="INSERT INTO evolucion_medica (id_adm_hosp,id_user,freg_evomed,hreg_evomed,objetivo,subjetivo,analisis_evomed,plan_tratamiento,
						                                  dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,resp_evomed,estado_evomed,justificacion_hosp,servicio,tipo_evo) VALUES
					('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["objetivo"]."',
					'".$_POST["subjetivo"]."','".$_POST["analisis"]."','".$_POST["plantratamiento"]."','$dxp','".$_POST["dx"]."','".$_POST["tdx"]."',
					'$dx1','".$_POST["dx1"]."','".$_POST["tdx1"]."','$dx2','".$_POST["dx2"]."','".$_POST["tdx2"]."',
					'".$_SESSION["AUT"]["nombre"]."','Realizada','".$_POST["justificacion_hosp"]."','Hospitalario','Evolucion')";
					$subtitulo="Evolución Medica";
					$subtitulo1="Adicionado";
				break;
				case 'EVOCP':
				$dxp=substr($_POST['dx'], 0,4);
				$dx1=substr($_POST['dx1'], 0,4);
				$dx2=substr($_POST['dx2'], 0,4);
				$dx3=substr($_POST['dx3'], 0,4);
					$sql="INSERT INTO evolucion_medica (id_adm_hosp,id_user,freg_evomed,hreg_evomed,objetivo,subjetivo,analisis_evomed,plan_tratamiento,
						                                  dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,resp_evomed,estado_evomed,justificacion_hosp,servicio,tipo_evo) VALUES
					('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["objetivo"]."',
					'".$_POST["subjetivo"]."','".$_POST["analisis"]."','".$_POST["plantratamiento"]."','$dxp','".$_POST["dx"]."','".$_POST["tdx"]."',
					'$dx1','".$_POST["dx1"]."','".$_POST["tdx1"]."','$dx2','".$_POST["dx2"]."','".$_POST["tdx2"]."',
					'".$_SESSION["AUT"]["nombre"]."','Realizada','".$_POST["justificacion_hosp"]."','Hospitalario','Evolucion')";
					$subtitulo="Evolución Medica";
					$subtitulo1="Adicionado";
				break;
				case 'EVOCM':
				$dxp=substr($_POST['dx'], 0,4);
				$dx1=substr($_POST['dx1'], 0,4);
				$dx2=substr($_POST['dx2'], 0,4);
				$dx3=substr($_POST['dx3'], 0,4);
					$sql="INSERT INTO evolucion_medica (id_adm_hosp,id_user,freg_evomed,hreg_evomed,objetivo,subjetivo,analisis_evomed,plan_tratamiento,
						                                  dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,resp_evomed,estado_evomed,justificacion_hosp,servicio,tipo_evo) VALUES
					('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["objetivo"]."',
					'".$_POST["subjetivo"]."','".$_POST["analisis"]."','".$_POST["plantratamiento"]."','$dxp','".$_POST["dx"]."','".$_POST["tdx"]."',
					'$dx1','".$_POST["dx1"]."','".$_POST["tdx1"]."','$dx2','".$_POST["dx2"]."','".$_POST["tdx2"]."',
					'".$_SESSION["AUT"]["nombre"]."','Realizada','".$_POST["justificacion_hosp"]."','Hospitalario','Evolucion')";
					$subtitulo="Evolución Medica";
					$subtitulo1="Adicionado";
				break;
				case 'NOTAJEFE':
					$sql="INSERT INTO nota_enfermeria (id_adm_hosp,id_user,freg_nota,hreg_nota,descripnota,estado_nota,resp_nota) VALUES
					('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["notaenfermeria"]."','Realizada',
					'".$_SESSION["AUT"]["nombre"]."')";
					$subtitulo="Adicionado";
				break;
				case 'NOTAAUX':
					$sql="INSERT INTO nota_enfermeria (id_adm_hosp,id_user,freg_nota,hreg_nota,descripnota,estado_nota,resp_nota) VALUES
					('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["notaenfermeria"]."','Realizada',
					'".$_SESSION["AUT"]["nombre"]."')";
					$subtitulo="Adicionado";
				break;
				case 'EVOTO':
					$sql="INSERT INTO evo_to (id_adm_hosp,id_user,freg_evoto,hreg_evoto,obj_sesion,actividades,resultado,evolucion_to,estado_evoto,resp_evoto) VALUES
					('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["objsesion"]."','".$_POST["actividades"]."','".$_POST["resultado"]."',
					'".$_POST["objsesion"]."' '".$_POST["actividades"]."' '".$_POST["resultado"]."','Realizada','".$_SESSION["AUT"]["nombre"]."')";
					$subtitulo="Adicionado";
				break;
				case 'EVOPSICOLOGIA':
					$sql="INSERT INTO evo_psicologia (id_adm_hosp,id_user,freg_evo_psico,hreg_evo_psico,tipo_sesion,obj_sesion,actividades,
						resultado,obs_evo_psico,estado_evo_psico,resp_evo_psico) VALUES
					('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["tsesion"]."',
					'".$_POST["objsesion"]."','".$_POST["actividades"]."','".$_POST["resultado"]."' , '".$_POST["obsevopsico"]."','Realizada','".$_SESSION["AUT"]["nombre"]."')";
					$subtitulo="Adicionado";
				break;

		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El formato de $subtitulo fue $subtitulo1 con exito!";
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
		case 'HC':
	    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
	    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
	    j.nom_eps
	    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
	                left join eps j on (j.id_eps=b.id_eps)
	    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar HC faltante";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$form1='formulariosALT/hcingreso.php';
			$subtitulo='Admisiones sin historia clínica de ingreso';
		break;
		case 'EVO':
	    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
	    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
	    j.nom_eps
	    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
	                left join eps j on (j.id_eps=b.id_eps)
	    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			//echo $sql;
			$boton="Agregar evolucion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return1=2;
			$form1='formulariosALT/evo.php';
			$subtitulo='Registro de evoluciones pendientes';
		break;
		case 'EVOCP':
	    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
	    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
	    j.nom_eps
	    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
	                left join eps j on (j.id_eps=b.id_eps)
	    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar evolucion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return1=7;
			$form1='formulariosALT/evo.php';
			$subtitulo='Registro de evoluciones pendientes';
		break;
		case 'EVOTO':
	    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
	    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
	    j.nom_eps
	    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
	                left join eps j on (j.id_eps=b.id_eps)
	    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar evolucion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return1=4;
			$form1='formulariosALT/evoto.php';
			$subtitulo='Registro de evoluciones pendientes';
		break;
		case 'EVOPSICOLOGIA':
	    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
	    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
	    j.nom_eps
	    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
	                left join eps j on (j.id_eps=b.id_eps)
	    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar evolucion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return1=3;
			$form1='formulariosALT/evopsico.php';
			$subtitulo='Registro de evoluciones pendientes';
		break;
		case 'EVOCM':
	    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
	    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
	    j.nom_eps
	    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
	                left join eps j on (j.id_eps=b.id_eps)
	    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar evolucion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return1=8;
			$form1='formulariosALT/evo.php';
			$subtitulo='Registro de evoluciones pendientes';
		break;
		case 'NOTAJEFE':
	    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
	    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
	    j.nom_eps
	    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
	                left join eps j on (j.id_eps=b.id_eps)
	    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar evolucion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return1=$_REQUEST['rpt'];
			$form1='formulariosALT/nota.php';
			$subtitulo='Registro de evoluciones pendientes';
		break;
		case 'NOTAAUX':
	    $sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
	    b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
	    j.nom_eps
	    from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
	                left join eps j on (j.id_eps=b.id_eps)
	    where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$boton="Agregar evolucion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$return1=6;
			$form1='formulariosALT/nota.php';
			$subtitulo='Registro de evoluciones pendientes';
		break;

		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"",
        "dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>""
				,"religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"",
        "dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>""
				,"religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
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
  <section class="panel-heading">
    <h4>Alertas de Salud Mental Servicio Hospitalario</h4>
  </section>
  <section class="panel-body">
		<div id="tabs_alertas">
			<ul>
				<li><a href="#tabs-1">HC ingreso <span class="badge">
		        <?php
		        $sql="SELECT d.doc_pac,d.nom1,' ',d.nom2,' ',d.ape1,' ',d.ape2 paciente ,count(c.id_adm_hosp) cuantas,c.fingreso_hosp,c.fegreso_hosp,c.tipo_servicio,if(c.id_sedes_ips=2,'Faca','Bogota')  sede
		              FROM adm_hospitalario c,pacientes d
		              where c.fingreso_hosp > '2017-12-01' and c.tipo_servicio = 'Hospitalario'
		                                                   and c.id_sedes_ips in (2,8)
		                                                   and d.id_paciente = c.id_paciente
		                                                   and not exists (select 1 from hc_hospitalario  b where b.id_adm_hosp = c.id_adm_hosp)
		              ORDER by 1";
		      if ($tabla=$bd1->sub_tuplas($sql)){
		        foreach ($tabla as $fila ) {
		        echo $fila["cuantas"];
		        }
		      }
		      ?>
		      </span></a></li>
				<li><a href="#tabs-2">Psiquiatria <span class="badge">
		      <?php
		      $sql="SELECT DISTINCT 'PSIQUIATRIA',d.doc_pac,d.nom1,d.nom2,d.ape1,d.ape2
		                                 ,count(DISTINCT d.doc_pac,a.fecha) cuantas
		                                 ,c.fingreso_hosp
		                                 ,c.fegreso_hosp
		                                 ,a.fecha
		                                 ,a.mes
		                                 ,c.tipo_servicio
		                                 ,if(c.id_sedes_ips=2,'Faca','Bogota')  sede,
		                                 c.id_eps,c.clase_dx_hosp
		            FROM calendario a,adm_hospitalario c,pacientes d
		            WHERE c.tipo_servicio = 'Hospitalario'
		                              and a.año = 2019
		                             	and a.mes =12
		                              and c.id_sedes_ips in (2,8)
		                              and c.id_adm_hosp = a.id_adm_hosp
		                              and a.fecha > c.fingreso_hosp and a.fecha <=
		                              IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
		                              and (IFNULL(c.clase_dx_hosp,'JAJAJA') not in ('Institucionalizado'))

		                              and d.id_paciente = c.id_paciente
		                              and not exists ( select 1 from evolucion_medica  b, user e
		                                                             where b.id_adm_hosp = a.id_adm_hosp
		                                                             and b.freg_evomed = a.fecha
		                                                 and b.id_user = e.id_user
		                                                 and e.id_perfil in (3,49))
		                              order by c.id_eps desc";
		    if ($tabla=$bd1->sub_tuplas($sql)){
		      foreach ($tabla as $fila ) {
		        echo $fila["cuantas"];
		      }
		    }
		    ?>
		    </span></a></li>
				<li><a href="#tabs-3">Medicina General CRONICOS <span class="badge">
		      <?php
		      $sql="SELECT 'MEDICO GENERAL',d.doc_pac,concat(d.nom1,' ',d.nom2,' ',d.ape1,' ',d.ape2) paciente
		            ,count(a.id_adm_hosp) cuantas,c.fingreso_hosp,c.fegreso_hosp,a.fecha,a.mes,c.tipo_servicio,
		            if(c.id_sedes_ips=2,'Faca','Bogota')  sede
		            FROM calendario a,adm_hospitalario c,pacientes d
		            where c.tipo_servicio = 'Hospitalario' and a.año = 2019
		            and a.mes =2
								and c.id_sedes_ips in (2,8)
		            and c.id_adm_hosp = a.id_adm_hosp
		            and a.fecha > c.fingreso_hosp and a.fecha <= IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
		            and  (IFNULL(c.clase_dx_hosp,'JAJAJA') in ('Institucionalizado') )
		            and d.id_paciente = c.id_paciente
		            and not exists
		            ( select 1 from evolucion_medica  b, user e
		                  where b.id_adm_hosp = a.id_adm_hosp and b.freg_evomed = a.fecha
		                  and b.id_user = e.id_user  and e.id_perfil in (4,48,1))
		                  order by d.doc_pac,a.fecha asc";
		    if ($tabla=$bd1->sub_tuplas($sql)){
		      foreach ($tabla as $fila ) {
		      echo $fila["cuantas"];
		      }
		    }
		    ?>
		      </span></a>
				</li>
				<li><a href="#tabs-4">Psiquiatria CRONICOS <span class="badge">
		      <?php
		      $sql="SELECT DISTINCT 'PSIQUIATRIA',
		            if(c.id_sedes_ips=2,'Faca','Bogota')  sede
		            ,d.doc_pac,d.nom1,d.nom2,d.ape1,d.ape2
		                                           ,count(DISTINCT d.doc_pac, a.semana) cuantas
		                                           ,c.fingreso_hosp
		                                           ,c.fegreso_hosp
		                                           ,a.mes
		                                           ,a.semana
		                                           ,c.tipo_servicio
		                                           ,makedate(año,(semana-1)*7+2) fecha_ini_semana
		                                           ,makedate(año,(semana-1)*7+8) fecha_fin_semana
		            FROM calendario a,adm_hospitalario c,pacientes d,eps e
		            WHERE c.tipo_servicio = 'Hospitalario'
		            and a.año = 2019
		            and a.mes =2
		            and c.id_sedes_ips in (2,8)
		            and c.id_adm_hosp = a.id_adm_hosp
		            and a.fecha > c.fingreso_hosp and a.fecha <=
		            IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
		            and  (IFNULL(c.clase_dx_hosp,'JAJAJA') in ('Institucionalizado') )
		            and d.id_paciente = c.id_paciente
		            and not exists (select 1 from evolucion_medica b, user e
		                                     where b.id_adm_hosp = a.id_adm_hosp
		                                     and WEEK(b.freg_evomed) = a.semana
		                                     and b.id_user = e.id_user
		                                     and e.id_perfil in (3,49))
																				 and e.id_eps=c.id_eps
		            order by makedate(año,(semana-1)*7+2) asc,d.doc_pac";
		    if ($tabla=$bd1->sub_tuplas($sql)){
		      foreach ($tabla as $fila ) {
		      echo $fila["cuantas"];
		      }
		    }
		    ?>
		      </span></a>
				</li>
				<li><a href="#tabs-5">Psicologia <span class="badge">
		      <?php
		      $sql_psico="SELECT d.doc_pac ,d.nom1,' ',d.nom2,' ',d.ape1,' ',d.ape2 paciente,
								count(a.id_adm_hosp) cuantas,c.fingreso_hosp,c.fegreso_hosp,a.fecha,
								a.mes,if(c.id_sedes_ips=2,'Faca','Bogota')  sede
		            FROM calendario a,adm_hospitalario c,pacientes d
		            WHERE c.tipo_servicio = 'Hospitalario' and a.año = 2019
		            and a.mes =2
		and a.fecha not in ('2018-01-01','2018-01-06','2018-01-07','2018-01-08','2018-01-13','2018-01-14','2018-01-20',
		'2018-01-21','2018-01-27','2018-01-28','2018-02-03','2018-02-04','2018-02-10','2018-02-11','2018-02-17',
		'2018-02-18','2018-02-24','2018-02-25','2018-03-03','2018-03-04','2018-03-10','2018-03-11','2018-03-17',
		'2018-03-18','2018-03-24','2018-03-25','2018-03-19','2018-03-29','2018-03-30','2018-03-31',
		'2018-04-01','2018-04-08','2018-04-14','2018-04-15','2018-04-21','2018-04-22','2018-04-28',
		'2018-04-29','2018-05-01','2018-05-05','2018-05-06','2018-05-12','2018-05-13','2018-05-14','2018-05-19','2018-05-20',
		'2018-05-26','2018-05-27','2018-06-02',
		'2018-06-03','2018-06-04','2018-06-09','2018-06-10','2018-06-11','2018-06-16','2018-06-17','2018-06-23','2018-06-24',
		'2018-06-30','2018-07-01','2018-07-07','2018-07-08','2018-07-14','2018-07-15','2018-07-20','2018-07-21','2018-07-22',
		'2018-07-28','2018-07-29','2018-07-02','2018-08-04','2018-08-05','2018-08-07','2018-08-11',
		'2018-08-12','2018-08-18','2018-08-19','2018-08-20','2018-08-25','2018-08-26','2018-09-01','2018-09-02','2018-09-08',
		'2018-09-09','2018-09-15','2018-09-16','2018-09-22','2018-09-23','2018-09-29',
		'2018-09-30','2018-10-06','2018-10-07','2018-10-13','2018-10-14','2018-10-15','2018-10-20','2018-10-21','2018-10-27',
		'2018-10-28','2018-11-03','2018-11-04','2018-11-08','2018-11-09','2018-11-15','2018-11-16',
		'2018-11-22','2018-11-23','2018-11-05','2018-11-12','2018-11-24','2018-11-25','2018-12-01','2018-12-02',
		'2018-12-08','2018-12-09','2018-12-15','2018-12-16','2018-12-22','2018-12-23','2018-12-25','2018-12-29','2018-12-30')
		and c.id_sedes_ips in (2,8)
		and c.id_adm_hosp = a.id_adm_hosp
		and a.fecha > c.fingreso_hosp and a.fecha <= IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
		and d.id_paciente = c.id_paciente
		and not exists (select 1 from evo_psicologia  b where b.id_adm_hosp = a.id_adm_hosp and b.freg_evo_psico = a.fecha)
		order by 2";
		    if ($tabla_psico=$bd1->sub_tuplas($sql_psico)){
		      foreach ($tabla_psico as $fila_psico ) {
		      echo $fila_psico["cuantas"];
		      }
		    }
		    ?>
		      </span></a></li>
				<li><a href="#tabs-6">Terapia Ocupacional <span class="badge">
		      <?php
		      $sql="SELECT d.doc_pac ,d.nom1,' ',d.nom2,' ',d.ape1,' ',d.ape2 paciente,count(a.id_adm_hosp) cuantas,c.fingreso_hosp,c.fegreso_hosp,a.fecha,a.mes,if(c.id_sedes_ips=2,'Faca','Bogota')  sede
		            FROM calendario a,adm_hospitalario c,pacientes d
		            WHERE c.tipo_servicio = 'Hospitalario' and a.año = 2019
		            and a.mes =2
		and a.fecha not in ('2018-01-01','2018-01-06','2018-01-07','2018-01-08','2018-01-13','2018-01-14','2018-01-20',
		'2018-01-21','2018-01-27','2018-01-28','2018-02-03','2018-02-04','2018-02-10','2018-02-11','2018-02-17',
		'2018-02-18','2018-02-24','2018-02-25','2018-03-03','2018-03-04','2018-03-10','2018-03-11','2018-03-17',
		'2018-03-18','2018-03-24','2018-03-25','2018-03-19','2018-03-29','2018-03-30','2018-03-31',
		'2018-04-01','2018-04-08','2018-04-07','2018-04-14','2018-04-15','2018-04-21','2018-04-22','2018-04-28',
		'2018-04-29','2018-05-01','2018-05-05','2018-05-06','2018-05-12','2018-05-13','2018-05-14','2018-05-19','2018-05-20',
		'2018-05-26','2018-05-27','2018-06-02',
		'2018-06-03','2018-06-04','2018-06-09','2018-06-10','2018-06-11','2018-06-16','2018-06-17','2018-06-23','2018-06-24',
		'2018-06-30','2018-07-01','2018-07-07','2018-07-08','2018-07-14','2018-07-15','2018-07-20','2018-07-21','2018-07-22',
		'2018-07-28','2018-07-29','2018-07-02','2018-08-04','2018-08-05','2018-08-07','2018-08-11',
		'2018-08-12','2018-08-18','2018-08-19','2018-08-20','2018-08-25','2018-08-26','2018-09-01','2018-09-02','2018-09-08',
		'2018-09-09','2018-09-15','2018-09-16','2018-09-22','2018-09-23','2018-09-29',
		'2018-09-30','2018-10-06','2018-10-07','2018-10-13','2018-10-14','2018-10-15','2018-10-20','2018-10-21','2018-10-27',
		'2018-10-28','2018-11-03','2018-11-04','2018-11-08','2018-11-09','2018-11-15','2018-11-16',
		'2018-11-22','2018-11-23','2018-11-05','2018-11-12','2018-11-24','2018-11-25','2018-12-01','2018-12-02',
		'2018-12-08','2018-12-09','2018-12-15','2018-12-16','2018-12-22','2018-12-23','2018-12-25','2018-12-29','2018-12-30')
		and c.id_sedes_ips in (2,8)
		and c.id_adm_hosp = a.id_adm_hosp
		and a.fecha > c.fingreso_hosp and a.fecha <= IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
		and d.id_paciente = c.id_paciente
		and not exists (select 1 from evo_to  b where b.id_adm_hosp = a.id_adm_hosp and b.freg_evoto = a.fecha)
		order by 2";
		      if ($tabla=$bd1->sub_tuplas($sql)){
		        foreach ($tabla as $fila ) {
		        echo $fila["cuantas"];
		        }
		      }
		      ?>
		      </span></a></li>
				<li><a href="#tabs-7">Jefe Enfermeria Faca   <span class="badge">
			      <?php
			      $sql="SELECT d.doc_pac,d.nom1,d.nom2,d.ape1,d.ape2,count(a.id_adm_hosp) cuantas,c.fingreso_hosp,c.fegreso_hosp,a.fecha,a.mes,if(c.id_sedes_ips=2,'Faca','Bogota')  sede
			                    FROM calendario a,adm_hospitalario c,pacientes d
			                    WHERE c.tipo_servicio = 'Hospitalario' and a.año = 2019
			                                                           and a.mes =2
			                                                           and c.id_sedes_ips in (2)
			                                                           and c.id_adm_hosp = a.id_adm_hosp
			                                                           and a.fecha > c.fingreso_hosp
			                                                           and a.fecha <= IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
			                                           and d.id_paciente = c.id_paciente and not exists
			                      (select 1 from nota_enfermeria  b, user f where b.id_adm_hosp = a.id_adm_hosp
			                                                           and b.freg_nota= a.fecha
			                                                           and b.id_user= f.id_user
			                                                           and f.id_perfil in (5,1)) order by 9";
			    if ($tabla=$bd1->sub_tuplas($sql)){
			      foreach ($tabla as $fila ) {
			      echo $fila["cuantas"];
			      }
			    }
			    ?>
			      </span></a></li>
				<li><a href="#8">Jefe Enfermeria BTA <span class="badge">
		      <?php
		      $sql="SELECT d.doc_pac,d.nom1,d.nom2,d.ape1,d.ape2,count(a.id_adm_hosp) cuantas,c.fingreso_hosp,c.fegreso_hosp,a.fecha,a.mes,if(c.id_sedes_ips=2,'Faca','Bogota')  sede
		                    FROM calendario a,adm_hospitalario c,pacientes d
		                    WHERE c.tipo_servicio = 'Hospitalario' and a.año = 2019
		                                                           and a.mes =2
		                                                           and c.id_sedes_ips in (8)
		                                                           and c.id_adm_hosp = a.id_adm_hosp
		                                                           and a.fecha > c.fingreso_hosp
		                                                           and a.fecha <= IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
		                                           and d.id_paciente = c.id_paciente and not exists
		                      (select 1 from nota_enfermeria  b, user f where b.id_adm_hosp = a.id_adm_hosp
		                                                           and b.freg_nota= a.fecha
		                                                           and b.id_user= f.id_user
		                                                           and f.id_perfil in (5,1)) order by 9";
		    if ($tabla=$bd1->sub_tuplas($sql)){
		      foreach ($tabla as $fila ) {
		      echo $fila["cuantas"];
		      }
		    }
		    ?>
		      </span></a></li>
				<li><a href="#tabs-9">Aux. Enfermeria <span class="badge">
		      <?php
		      $sql="SELECT d.doc_pac,d.nom1,d.nom2,d.ape1,d.ape2,count(a.id_adm_hosp) cuantas,c.fingreso_hosp,c.fegreso_hosp,a.fecha,a.mes,if(c.id_sedes_ips=2,'Faca','Bogota')  sede
		                    FROM calendario a,adm_hospitalario c,pacientes d
		                    WHERE c.tipo_servicio = 'Hospitalario' and a.año = 2019
		                                         and a.mes =2
		                                                           and c.id_sedes_ips in (2,8)
		                                                           and c.id_adm_hosp = a.id_adm_hosp
		                                                           and a.fecha > c.fingreso_hosp
		                                                           and a.fecha <= IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
		                                           and d.id_paciente = c.id_paciente and not exists
		                      (select 1 from nota_enfermeria  b, user f where b.id_adm_hosp = a.id_adm_hosp
		                                                           and b.freg_nota= a.fecha
		                                                           and b.id_user= f.id_user
		                                                           and f.id_perfil=6) order by 9";
		    if ($tabla=$bd1->sub_tuplas($sql)){
		      foreach ($tabla as $fila ) {
		      echo $fila["cuantas"];
		      }
		    }
		    ?>
		      </span></a></li>
			</ul>
				<div id="tabs-1" class="panel-body">
					<table class="table table-responsive table-bordered table-hover">
		        <tr>
		          <th class="info">PACIENTE</th>
		          <th class="info text-center">INGRESO / EGRESO</th>
		          <th class="info text-center">MOTIVO SALIDA</th>
		          <th class="info">SEDE</th>
							<th></th>
		        </tr>
		        <?php
		        $sql="SELECT d.doc_pac,d.nom1,' ',d.nom2,' ',d.ape1,' ',d.ape2 ,
		                     c.id_adm_hosp,c.fingreso_hosp,c.fegreso_hosp,c.tipo_servicio,
												 if(c.id_sedes_ips=2,'Facatativa','Bogota')  sede,
												 c.via_salida
		              FROM adm_hospitalario c,pacientes d
		              where c.fingreso_hosp > '2017-01-01' and c.tipo_servicio = 'Hospitalario'
		                                                   and c.id_sedes_ips in (2,8)
		                                                   and d.id_paciente = c.id_paciente
	and not exists (select 1 from hc_hospitalario  b where b.id_adm_hosp = c.id_adm_hosp)
		              ORDER by 1 ASC";
		        if ($tabla=$bd1->sub_tuplas($sql)){
		          //echo $sql;
		          foreach ($tabla as $fila ) {
		            echo"<tr >\n";
		            echo'<td class="text-center">
		                  <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
		                  <p><strong>DI: </strong>'.$fila["doc_pac"].'</p>
		                  <p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
		                 </td>';
								echo'<td class="text-center">
				              <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>';
											if ($fila['fegreso_hosp']=='') {
												echo'<p class="alert alert-danger"><strong>PACIENTE SIN EGRESO</strong></p>';
											}else {
												echo'<p ><strong>Egreso: </strong>'.$fila["fegreso_hosp"].'</p>';
											}
				        echo'</td>';
								echo'<td class="text-center">
								      <p>'.$fila["via_salida"].'</p>
								     </td>';
							 	echo'<td class="text-center">
				 						  <p>'.$fila["sede"].'</p>
				 						 </td>';
							 	echo'<td class="text-center">
			 		 			 			 <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=HC&doc='.$fila["doc_pac"].'&idadmhosp='.$fila["id_adm_hosp"].'&fecha='.$fila["fingreso_hosp"].'"><button type="button" class="btn btn-success" ><span class="fa fa-edit"></span> Actualizar</button></a>
			 		 			 		 </td>';
		            echo "</tr>\n";
		          }
		        }
		        ?>
		      </table>
				</div>
				<div id="tabs-2" class="panel-body">
					<table class="table table-responsive table-bordered table-hover">
		        <tr>
		          <th class="info">PACIENTE</th>
		          <th class="info text-center">INGRESO / EGRESO</th>
		          <th class="info text-center">FECHA FALTANTE</th>
		          <th class="info">SEDE</th>
							<th></th>
		        </tr>
		        <?php
		        $sql="SELECT DISTINCT 'PSIQUIATRIA',d.doc_pac,d.nom1,d.nom2,d.ape1,d.ape2
																			 ,a.id_adm_hosp
																			 ,c.fingreso_hosp
																			 ,c.fegreso_hosp
																			 ,a.fecha
																			 ,a.mes
																			 ,c.tipo_servicio
																			 ,e.nom_eps
									,if(c.id_sedes_ips=2,'Faca','Bogota')  sede,
									c.id_eps,c.clase_dx_hosp
									FROM calendario a,adm_hospitalario c,pacientes d,eps e

									WHERE c.tipo_servicio = 'Hospitalario'
									and a.año = 2019
									and a.mes =12
									and c.id_sedes_ips in (2,8)
									and c.id_adm_hosp = a.id_adm_hosp
									and a.fecha > c.fingreso_hosp and a.fecha <=
									IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
									and (IFNULL(c.clase_dx_hosp,'JAJAJA') not in ('Institucionalizado'))

									and d.id_paciente = c.id_paciente
									and not exists ( select 1 from evolucion_medica  b, user e
																								 where b.id_adm_hosp = a.id_adm_hosp
																								 and b.freg_evomed = a.fecha
																		 and b.id_user = e.id_user
																		 and e.id_perfil in (3,49))
									and e.id_eps=c.id_eps
									ORDER BY d.doc_pac,fecha ASC";
						$i=1;
		        if ($tabla=$bd1->sub_tuplas($sql)){
		          //echo $sql;
		          foreach ($tabla as $fila ) {
		            echo"<tr >\n";
		            echo'<td class="text-center">
		                  <p>'.$i++.'--'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
		                  <p><strong>DI: </strong>'.$fila["doc_pac"].'</p>
		                  <p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
											<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
		                 </td>';
								echo'<td class="text-center">
				              <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>';
											if ($fila['fegreso_hosp']=='') {
												echo'<p class="alert alert-danger"><strong>PACIENTE SIN EGRESO</strong></p>';
											}else {
												echo'<p ><strong>Egreso: </strong>'.$fila["fegreso_hosp"].'</p>';
											}
				        echo'</td>';
								echo'<td class="text-center">
								      <p>'.$fila["fecha"].'</p>
								     </td>';
							 	echo'<td class="text-center">
				 						  <p>'.$fila["sede"].'</p>
				 						 </td>';
								echo'<td class="text-center">
			 			 					<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&id='.$idtraslado.'&idadmhosp='.$fila["id_adm_hosp"].'&fecha='.$fila["fecha"].'"><button type="button" class="btn btn-success" ><span class="fa fa-edit"></span> Actualizar</button></a>
			 			 			 </td>';
		            echo "</tr>\n";
		          }
		        }
		        ?>
		      </table>
				</div>
				<div id="tabs-3" class="panel-body">
					<table class="table table-responsive table-bordered table-hover">
		        <tr>
		          <th class="info">PACIENTE</th>
		          <th class="info text-center">INGRESO / EGRESO</th>
		          <th class="info text-center">FECHA FALTANTE</th>
		          <th class="info">SEDE</th>
							<th></th>
		        </tr>
		        <?php
						$sql="SELECT 'MEDICO GENERAL',d.doc_pac,
									concat(d.nom1,' ',d.nom2,' ',d.ape1,' ',d.ape2) paciente
									,a.id_adm_hosp,c.fingreso_hosp,c.fegreso_hosp,a.fecha,a.mes,c.tipo_servicio,e.nom_eps,
									if(c.id_sedes_ips=2,'Faca','Bogota')  sede
									from calendario a,adm_hospitalario c,pacientes d,eps e
									where  c.tipo_servicio = 'Hospitalario' and a.año = 2019   and a.mes =2
									and c.id_sedes_ips in (2,8) and c.id_adm_hosp = a.id_adm_hosp
									and a.fecha > c.fingreso_hosp and a.fecha <= IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
									and  (IFNULL(c.clase_dx_hosp,'JAJAJA') in ('Institucionalizado'))
									and d.id_paciente = c.id_paciente
									and not exists ( select 1 from evolucion_medica  b, user e
																where b.id_adm_hosp = a.id_adm_hosp
																and b.freg_evomed = a.fecha
										and b.id_user = e.id_user
										and e.id_perfil in (4,48,1))
										and e.id_eps=c.id_eps order by d.doc_pac,a.fecha ASC";
										   //echo $sql;
						$i=1;
		        if ($tabla=$bd1->sub_tuplas($sql)){
		          foreach ($tabla as $fila ) {
		            echo"<tr >\n";
		            echo'<td class="text-center">
		                  <p>'.$i++.'--'.$fila["paciente"].'</p>
		                  <p><strong>DI: </strong>'.$fila["doc_pac"].'</p>
		                  <p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
											<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
		                 </td>';
								echo'<td class="text-center">
				              <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>';
											if ($fila['fegreso_hosp']=='') {
												echo'<p class="alert alert-danger"><strong>PACIENTE SIN EGRESO</strong></p>';
											}else {
												echo'<p ><strong>Egreso: </strong>'.$fila["fegreso_hosp"].'</p>';
											}
				        echo'</td>';
								echo'<td class="text-center">
								      <p>'.$fila["fecha"].'</p>
								     </td>';
							 	echo'<td class="text-center">
				 						  <p>'.$fila["sede"].'</p>
				 						 </td>';
								echo'<td class="text-center">
			 			 					<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVOCM&id='.$idtraslado.'&idadmhosp='.$fila["id_adm_hosp"].'&fecha='.$fila["fecha"].'"><button type="button" class="btn btn-success" ><span class="fa fa-edit"></span> Actualizar</button></a>
			 			 			 </td>';
		            echo "</tr>\n";
		          }
		        }
		        ?>
		      </table>
				</div>
				<div id="tabs-4" class="panel-body">
					<table class="table table-responsive table-bordered table-hover">
		        <tr>
		          <th class="info">PACIENTE</th>
		          <th class="info text-center">INGRESO / EGRESO</th>
		          <th class="info text-center">FECHA FALTANTE</th>
		          <th class="info">SEDE</th>
							<th></th>
		        </tr>
		        <?php
						$sql="SELECT DISTINCT 'PSIQUIATRIA',if(c.id_sedes_ips=2,'Faca','Bogota')  sede
									,d.doc_pac,d.nom1,d.nom2,d.ape1,d.ape2
																 ,a.id_adm_hosp
																 ,c.fingreso_hosp
																 ,c.fegreso_hosp
																 ,a.mes
																 ,a.semana
																 ,c.tipo_servicio,
																 e.nom_eps
																 ,makedate(año,(semana-1)*7+2) fecha_ini_semana
																 ,makedate(año,(semana-1)*7+8) fecha_fin_semana
									FROM calendario a,adm_hospitalario c,pacientes d,eps e
									WHERE c.tipo_servicio = 'Hospitalario'
												and a.año = 2019
												and a.mes =12
												and c.id_sedes_ips in (2,8)
												and c.id_adm_hosp = a.id_adm_hosp
												and a.fecha > c.fingreso_hosp and a.fecha <= IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
												and  IFNULL(c.clase_dx_hosp,'JAJAJA') in ('Institucionalizado')
												and d.id_paciente = c.id_paciente
												and not exists ( select 1 from evolucion_medica  b, user e
														where b.id_adm_hosp = a.id_adm_hosp
														and WEEK(b.freg_evomed) = a.semana
														and b.id_user = e.id_user
														and e.id_perfil in (3,49))
														and e.id_eps=c.id_eps
												ORDER BY makedate(año,(semana-1)*7+2) asc,d.doc_pac";
						$i=1;
		        if ($tabla=$bd1->sub_tuplas($sql)){
		          echo $sql;
		          foreach ($tabla as $fila ) {
		            echo"<tr >\n";
		            echo'<td class="text-center">
		                  <p>'.$i++.'--'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
		                  <p><strong>DI: </strong>'.$fila["doc_pac"].'</p>
		                  <p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
											<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
		                 </td>';
								echo'<td class="text-center">
				              <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>';
											if ($fila['fegreso_hosp']=='') {
												echo'<p class="alert alert-danger"><strong>PACIENTE SIN EGRESO</strong></p>';
											}else {
												echo'<p ><strong>Egreso: </strong>'.$fila["fegreso_hosp"].'</p>';
											}
				        echo'</td>';
								echo'<td class="text-center">
								      <p>'.$fila["fecha_ini_semana"].' -- '.$fila["fecha_fin_semana"].'</p>
								     </td>';
							 	echo'<td class="text-center">
				 						  <p>'.$fila["sede"].'</p>
				 						 </td>';
								echo'<td class="text-center">
			 			 					<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVOCP&id='.$idtraslado.'&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-success" ><span class="fa fa-edit"></span> Actualizar</button></a>
			 			 			 </td>';
		            echo "</tr>\n";
		          }
		        }
		        ?>
		      </table>
				</div>
				<div id="tabs-5" class="panel-body">
					<table class="table table-responsive table-bordered table-hover">
		        <tr>
		          <th class="info">PACIENTE</th>
		          <th class="info text-center">INGRESO / EGRESO</th>
		          <th class="info text-center">FECHA FALTANTE</th>
		          <th class="info">SEDE</th>
							<th></th>
		        </tr>
		        <?php
						$sql="SELECT d.doc_pac ,d.nom1,' ',d.nom2,' ',d.ape1,' ',d.ape2 paciente,
						a.id_adm_hosp,c.fingreso_hosp,c.fegreso_hosp,a.fecha,a.mes,e.nom_eps,
						if(c.id_sedes_ips=2,'Facatativa','Bogota')  sede
									FROM calendario a,adm_hospitalario c,pacientes d,eps e
									WHERE c.tipo_servicio = 'Hospitalario' and a.año = 2019
									and a.mes =12
									and a.fecha not in ('2018-01-01','2018-01-06','2018-01-07','2018-01-08','2018-01-13','2018-01-14','2018-01-20',
									'2018-01-21','2018-01-27','2018-01-28','2018-02-03','2018-02-04','2018-02-10','2018-02-11','2018-02-17',
									'2018-02-18','2018-02-24','2018-02-25','2018-03-03','2018-03-04','2018-03-10','2018-03-11','2018-03-17',
									'2018-03-18','2018-03-24','2018-03-25','2018-03-19','2018-03-29','2018-03-30','2018-03-31',
									'2018-04-01','2018-04-08','2018-04-07','2018-04-14','2018-04-15','2018-04-21','2018-04-22','2018-04-28',
									'2018-04-29','2018-05-01','2018-05-05','2018-05-06','2018-05-12','2018-05-13','2018-05-14','2018-05-19','2018-05-20',
									'2018-05-26','2018-05-27','2018-06-02',
									'2018-06-03','2018-06-04','2018-06-09','2018-06-10','2018-06-11','2018-06-16','2018-06-17','2018-06-23','2018-06-24',
									'2018-06-30','2018-07-01','2018-07-07','2018-07-08','2018-07-14','2018-07-15','2018-07-20','2018-07-21','2018-07-22',
									'2018-07-28','2018-07-29','2018-07-02','2018-08-04','2018-08-05','2018-08-07','2018-08-11',
									'2018-08-12','2018-08-18','2018-08-19','2018-08-20','2018-08-25','2018-08-26','2018-09-01','2018-09-02','2018-09-08',
									'2018-09-09','2018-09-15','2018-09-16','2018-09-22','2018-09-23','2018-09-29',
									'2018-09-30','2018-10-06','2018-10-07','2018-10-13','2018-10-14','2018-10-15','2018-10-20','2018-10-21','2018-10-27',
									'2018-10-28','2018-11-03','2018-11-04','2018-11-08','2018-11-09','2018-11-15','2018-11-16',
									'2018-11-22','2018-11-23','2018-11-05','2018-11-12','2018-11-24','2018-11-25','2018-12-01','2018-12-02',
									'2018-12-08','2018-12-09','2018-12-15','2018-12-16','2018-12-22','2018-12-23','2018-12-25','2018-12-29','2018-12-30')
									and c.id_sedes_ips in (2,8)
									and c.id_adm_hosp = a.id_adm_hosp
									and a.fecha > c.fingreso_hosp and a.fecha <= IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
									and d.id_paciente = c.id_paciente
									and not exists (select 1 from evo_psicologia  b where b.id_adm_hosp = a.id_adm_hosp and b.freg_evo_psico = a.fecha)
									and e.id_eps=c.id_eps
									order by 2";
						$i=1;
		        if ($tabla=$bd1->sub_tuplas($sql)){
		          //echo $sql;
		          foreach ($tabla as $fila ) {
		            echo"<tr >\n";
		            echo'<td class="text-center">
		                  <p>'.$i++.'--'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
		                  <p><strong>DI: </strong>'.$fila["doc_pac"].'</p>
		                  <p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
											<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
		                 </td>';
								echo'<td class="text-center">
				              <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>';
											if ($fila['fegreso_hosp']=='') {
												echo'<p class="alert alert-danger"><strong>PACIENTE SIN EGRESO</strong></p>';
											}else {
												echo'<p ><strong>Egreso: </strong>'.$fila["fegreso_hosp"].'</p>';
											}
				        echo'</td>';
								echo'<td class="text-center">
								      <p>'.$fila["fecha"].'</p>
								     </td>';
							 	echo'<td class="text-center">
				 						  <p>'.$fila["sede"].'</p>
				 						 </td>';
								echo'<td class="text-center">
			 			 					<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVOPSICOLOGIA&id='.$idtraslado.'&idadmhosp='.$fila["id_adm_hosp"].'&fecha='.$fila["fecha"].'"><button type="button" class="btn btn-success" ><span class="fa fa-edit"></span> Actualizar</button></a>
			 			 			 </td>';
		            echo "</tr>\n";
		          }
		        }
		        ?>
		      </table>
				</div>
				<div id="tabs-6" class="panel-body">
					<table class="table table-responsive table-bordered table-hover">
		        <tr>
		          <th class="info">PACIENTE</th>
		          <th class="info text-center">INGRESO / EGRESO</th>
		          <th class="info text-center">FECHA FALTANTE</th>
		          <th class="info">SEDE</th>
							<th></th>
		        </tr>
		        <?php
						$sql="SELECT d.doc_pac ,d.nom1,' ',d.nom2,' ',d.ape1,' ',d.ape2 paciente,
						a.id_adm_hosp,c.fingreso_hosp,c.fegreso_hosp,a.fecha,a.mes,e.nom_eps,
						if(c.id_sedes_ips=2,'Facatativa','Bogota')  sede
									FROM calendario a,adm_hospitalario c,pacientes d,eps e
									WHERE c.tipo_servicio = 'Hospitalario' and a.año = 2019
									and a.mes =12
									and a.fecha not in ('2018-01-01','2018-01-06','2018-01-07','2018-01-08','2018-01-13','2018-01-14','2018-01-20',
									'2018-01-21','2018-01-27','2018-01-28','2018-02-03','2018-02-04','2018-02-10','2018-02-11','2018-02-17',
									'2018-02-18','2018-02-24','2018-02-25','2018-03-03','2018-03-04','2018-03-10','2018-03-11','2018-03-17',
									'2018-03-18','2018-03-24','2018-03-25','2018-03-19','2018-03-29','2018-03-30','2018-03-31',
									'2018-04-01','2018-04-08','2018-04-07','2018-04-14','2018-04-15','2018-04-21','2018-04-22','2018-04-28',
									'2018-04-29','2018-05-01','2018-05-05','2018-05-06','2018-05-12','2018-05-13','2018-05-14','2018-05-19','2018-05-20',
									'2018-05-26','2018-05-27','2018-06-02',
									'2018-06-03','2018-06-04','2018-06-09','2018-06-10','2018-06-11','2018-06-16','2018-06-17','2018-06-23','2018-06-24',
									'2018-06-30','2018-07-01','2018-07-07','2018-07-08','2018-07-14','2018-07-15','2018-07-20','2018-07-21','2018-07-22',
									'2018-07-28','2018-07-29','2018-07-02','2018-08-04','2018-08-05','2018-08-07','2018-08-11',
									'2018-08-12','2018-08-18','2018-08-19','2018-08-20','2018-08-25','2018-08-26','2018-09-01','2018-09-02','2018-09-08',
									'2018-09-09','2018-09-15','2018-09-16','2018-09-22','2018-09-23','2018-09-29',
									'2018-09-30','2018-10-06','2018-10-07','2018-10-13','2018-10-14','2018-10-15','2018-10-20','2018-10-21','2018-10-27',
									'2018-10-28','2018-11-03','2018-11-04','2018-11-08','2018-11-09','2018-11-15','2018-11-16',
									'2018-11-22','2018-11-23','2018-11-05','2018-11-12','2018-11-24','2018-11-25','2018-12-01','2018-12-02',
									'2018-12-08','2018-12-09','2018-12-15','2018-12-16','2018-12-22','2018-12-23','2018-12-25','2018-12-29','2018-12-30')
									and c.id_sedes_ips in (2,8)
									and c.id_adm_hosp = a.id_adm_hosp
									and a.fecha > c.fingreso_hosp and a.fecha <= IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
									and d.id_paciente = c.id_paciente
									and not exists (select 1 from evo_to  b where b.id_adm_hosp = a.id_adm_hosp and b.freg_evoto = a.fecha)
									and e.id_eps=c.id_eps
									order by 2";
							$i=1;
		        if ($tabla=$bd1->sub_tuplas($sql)){
		          //echo $sql;
		          foreach ($tabla as $fila ) {
		            echo"<tr >\n";
		            echo'<td class="text-center">
		                  <p>'.$i++.'--'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
		                  <p><strong>DI: </strong>'.$fila["doc_pac"].'</p>
		                  <p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
											<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
		                 </td>';
								echo'<td class="text-center">
				              <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>';
											if ($fila['fegreso_hosp']=='') {
												echo'<p class="alert alert-danger"><strong>PACIENTE SIN EGRESO</strong></p>';
											}else {
												echo'<p ><strong>Egreso: </strong>'.$fila["fegreso_hosp"].'</p>';
											}
				        echo'</td>';
								echo'<td class="text-center">
								      <p>'.$fila["fecha"].'</p>
								     </td>';
							 	echo'<td class="text-center">
				 						  <p>'.$fila["sede"].'</p>
				 						 </td>';
								echo'<td class="text-center">
			 			 					<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVOTO&id='.$idtraslado.'&idadmhosp='.$fila["id_adm_hosp"].'&fecha='.$fila["fecha"].'"><button type="button" class="btn btn-success" ><span class="fa fa-edit"></span> Actualizar</button></a>
			 			 			 </td>';
		            echo "</tr>\n";
		          }
		        }
		        ?>
		      </table>
				</div>
				<div id="tabs-7" class="panel-body">
					<table class="table table-responsive table-bordered table-hover">
		        <tr>
		          <th class="info">PACIENTE</th>
		          <th class="info text-center">INGRESO / EGRESO</th>
		          <th class="info text-center">FECHA FALTANTE</th>
		          <th class="info">SEDE</th>
							<th></th>
		        </tr>
		        <?php
						$sql="SELECT d.doc_pac,d.nom1,d.nom2,d.ape1,d.ape2,a.id_adm_hosp,c.fingreso_hosp,c.fegreso_hosp,e.nom_eps,
						a.fecha,a.mes,if(c.id_sedes_ips=2,'Faca','Bogota') sede
									FROM calendario a,adm_hospitalario c,pacientes d,eps e
									WHERE c.tipo_servicio = 'Hospitalario' and a.año = 2019
																												 and a.mes =2
																												 and c.id_sedes_ips in (2)
																												 and c.id_adm_hosp = a.id_adm_hosp
																												 and a.fecha > c.fingreso_hosp
																												 and a.fecha <= IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
																												 and d.id_paciente = c.id_paciente and not exists
									(SELECT 1 from nota_enfermeria b, user f
									WHERE b.id_adm_hosp = a.id_adm_hosp and b.freg_nota= a.fecha and b.id_user= f.id_user and f.id_perfil in (5,1))
									and e.id_eps=c.id_eps
									order by 1";
						$i=1;
		        if ($tabla=$bd1->sub_tuplas($sql)){
		          //echo $sql;
		          foreach ($tabla as $fila ) {
		            echo"<tr >\n";
		            echo'<td class="text-center">
		                  <p>'.$i++.'--'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
		                  <p><strong>DI: </strong>'.$fila["doc_pac"].'</p>
		                  <p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
											<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
		                 </td>';
								echo'<td class="text-center">
				              <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>';
											if ($fila['fegreso_hosp']=='') {
												echo'<p class="alert alert-danger"><strong>PACIENTE SIN EGRESO</strong></p>';
											}else {
												echo'<p ><strong>Egreso: </strong>'.$fila["fegreso_hosp"].'</p>';
											}
				        echo'</td>';
								echo'<td class="text-center">
								      <p>'.$fila["fecha"].'</p>
								     </td>';
							 	echo'<td class="text-center">
				 						  <p>'.$fila["sede"].'</p>
				 						 </td>';
								echo'<td class="text-center">
			 			 					<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NOTAJEFE&id='.$idtraslado.'&idadmhosp='.$fila["id_adm_hosp"].'&fecha='.$fila["fecha"].'"><button type="button" class="btn btn-success" ><span class="fa fa-edit"></span> Actualizar</button></a>
			 			 			 </td>';
		            echo "</tr>\n";
		          }
		        }
		        ?>
		      </table>
				</div>
				<div id="8" class="panel-body">
					<table class="table table-responsive table-bordered table-hover">
		        <tr>
		          <th class="info">PACIENTE</th>
		          <th class="info text-center">INGRESO / EGRESO</th>
		          <th class="info text-center">FECHA FALTANTE</th>
		          <th class="info">SEDE</th>
							<th></th>
		        </tr>
		        <?php
						$sql="SELECT d.doc_pac,d.nom1,d.nom2,d.ape1,d.ape2,a.id_adm_hosp,c.fingreso_hosp,c.fegreso_hosp,e.nom_eps,
												a.fecha,a.mes,if(c.id_sedes_ips=2,'Faca','Bogota') sede
									FROM calendario a,adm_hospitalario c,pacientes d,eps e
									WHERE c.tipo_servicio = 'Hospitalario' and a.año = 2019
																												 and a.mes =2
																												 and c.id_sedes_ips in (8)
																												 and c.id_adm_hosp = a.id_adm_hosp
																												 and a.fecha > c.fingreso_hosp
																												 and a.fecha <= IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
																												 and d.id_paciente = c.id_paciente and not exists
									(SELECT 1 from nota_enfermeria b, user f
										WHERE b.id_adm_hosp = a.id_adm_hosp and b.freg_nota= a.fecha
										and b.id_user= f.id_user and f.id_perfil in (5,1))
										and e.id_eps=c.id_eps
										order by 1";
							$i=1;
		        if ($tabla=$bd1->sub_tuplas($sql)){
		          //echo $sql;
		          foreach ($tabla as $fila ) {
		            echo"<tr >\n";
		            echo'<td class="text-center">
		                  <p>'.$i++.'--'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
		                  <p><strong>DI: </strong>'.$fila["doc_pac"].'</p>
		                  <p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
											<p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
		                 </td>';
								echo'<td class="text-center">
				              <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>';
											if ($fila['fegreso_hosp']=='') {
												echo'<p class="alert alert-danger"><strong>PACIENTE SIN EGRESO</strong></p>';
											}else {
												echo'<p ><strong>Egreso: </strong>'.$fila["fegreso_hosp"].'</p>';
											}
				        echo'</td>';
								echo'<td class="text-center">
								      <p>'.$fila["fecha"].'</p>
								     </td>';
							 	echo'<td class="text-center">
				 						  <p>'.$fila["sede"].'</p>
				 						 </td>';
								echo'<td class="text-center">
			 			 					<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NOTAJEFE&id='.$idtraslado.'&idadmhosp='.$fila["id_adm_hosp"].'&fecha='.$fila["fecha"].'&rpt='.$_REQUEST["rpt"].'"><button type="button" class="btn btn-success" ><span class="fa fa-edit"></span> Actualizar</button></a>
			 			 			 </td>';
		            echo "</tr>\n";
		          }
		        }
		        ?>
		      </table>
				</div>
				<div id="tabs-9" class="panel-body">
					<table class="table table-responsive table-bordered table-hover">
		        <tr>
		          <th class="info">PACIENTE</th>
		          <th class="info text-center">INGRESO / EGRESO</th>
		          <th class="info text-center">FECHA FALTANTE</th>
		          <th class="info">SEDE</th>
							<th></th>
		        </tr>
		        <?php
						$sql="SELECT d.doc_pac,d.nom1,d.nom2,d.ape1,d.ape2,a.id_adm_hosp,
						c.fingreso_hosp,c.fegreso_hosp,a.fecha,a.mes,e.nom_eps,if(c.id_sedes_ips=2,'Faca','Bogota')  sede
									FROM calendario a,adm_hospitalario c,pacientes d,eps e
									WHERE c.tipo_servicio = 'Hospitalario' and a.año = 2019
																			 and a.mes =2
																												 and c.id_sedes_ips in (2,8)
																												 and c.id_adm_hosp = a.id_adm_hosp
																												 and a.fecha > c.fingreso_hosp
																												 and a.fecha <= IFNULL(c.fegreso_hosp,(CURRENT_DATE-1))
																				 and d.id_paciente = c.id_paciente and not exists
										(select 1 from nota_enfermeria  b, user f where b.id_adm_hosp = a.id_adm_hosp
																												 and b.freg_nota= a.fecha
																												 and b.id_user= f.id_user
																												 and f.id_perfil=6)
																												 and e.id_eps=c.id_eps
										order by 9";
							$i=1;
		        if ($tabla=$bd1->sub_tuplas($sql)){
		          //echo $sql;
		          foreach ($tabla as $fila ) {
		            echo"<tr >\n";
		            echo'<td class="text-center">
		                  <p>'.$i++.'--'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
		                  <p><strong>DI: </strong>'.$fila["doc_pac"].'</p>
		                  <p><strong>ADM: </strong>'.$fila["id_adm_hosp"].'</p>
											<p><strong>EPS: </strong>'.$fila["nom_eps	"].'</p>
		                 </td>';
								echo'<td class="text-center">
				              <p><strong>Ingreso: </strong>'.$fila["fingreso_hosp"].'</p>';
											if ($fila['fegreso_hosp']=='') {
												echo'<p class="alert alert-danger"><strong>PACIENTE SIN EGRESO</strong></p>';
											}else {
												echo'<p ><strong>Egreso: </strong>'.$fila["fegreso_hosp"].'</p>';
											}
				        echo'</td>';
								echo'<td class="text-center">
								      <p>'.$fila["fecha"].'</p>
								     </td>';
							 	echo'<td class="text-center">
				 						  <p>'.$fila["sede"].'</p>
				 						 </td>';
								echo'<td class="text-center">
			 			 					<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=NOTAAUX&id='.$idtraslado.'&idadmhosp='.$fila["id_adm_hosp"].'&fecha='.$fila["fecha"].'"><button type="button" class="btn btn-success" ><span class="fa fa-edit"></span> Actualizar</button></a>
			 			 			 </td>';
		            echo "</tr>\n";
		          }
		        }
		        ?>
		      </table>
				</div>
		</div>
	</section>
</section>
	<?php
}
?>
