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
						$fotopE=",fotopac='".PACIENTES.$archivo."'";
						$fotopA1=",fotopac";
						$fotopA2=",'".PACIENTES.$archivo."'";
						}
				}
			}
			//print_r($_FILES);
			$docE="";$docA1="";$docA2="";
			if (isset($_FILES["foto"])){
				if (is_uploaded_file($_FILES["foto"]["tmp_name"])){
					$cfoto=explode(".",$_FILES["foto"]["name"]);
					$archivo=$_POST["nomdoc"].".".$cfoto[count($cfoto)-1];
					if(move_uploaded_file($_FILES["foto"]["tmp_name"],WEBE.DOCPAC.$archivo)){
						$docE=",foto='".DOCPAC.$archivo."'";
						$docA=',foto';
						$docb=",'".DOCPAC.$archivo."'";
						}
				}
			}
			switch ($_POST["operacion"]) {
				case 'ACO':
					$sql="INSERT INTO info_acompanante (id_adm_hosp,nombre_aco,dir_aco,tel_aco,parentesco_aco) VALUES
					('".$_POST["idadm"]."','".$_POST["nombre"]."','".$_POST["direccion"]."','".$_POST["telefono"]."',
					'".$_POST["parentesco"]."')";
					$subtitulo="El registro de Acompañante ";
					$subtitulo1="Adicionado";
				break;
			case 'E':
				$nom_completo=$_POST['nom1'].' '.$_POST['nom2'].' '.$_POST['ape1'].' '.$_POST['ape2'];
				$fecha=$_POST["fnacimiento"];
				$segundos= strtotime('now') - strtotime($fecha);
				$diferencia_dias=intval($segundos /60/60/24);
				$dias=ceil($diferencia_dias/365);
				$sql="UPDATE pacientes SET tdoc_pac='".$_POST["tdocpac"]."',doc_pac='".$_POST["docpac"]."',nom1='".$_POST["nom1"]."',
				nom2='".$_POST["nom2"]."',ape1='".$_POST["ape1"]."',ape2='".$_POST["ape2"]."',
				fnacimiento='".$_POST["fnacimiento"]."',edad='".$dias."',uedad='1',dir_pac='".$_POST["dirpac"]."',tel_pac='".$_POST["telpac"]."',
				email_pac='".$_POST["emailpac"]."',
				estadocivil='".$_POST["estadocivil"]."',genero='".$_POST["genero"]."',rh='".$_POST["rh"]."',etnia='".$_POST["etnia"]."',
				lateralidad='".$_POST["lateralidad"]."',profesion='".$_POST["profesion"]."',religion='".$_POST["religion"]."'$fotopE,
				nom_completo='$nom_completo' WHERE id_paciente=".$_POST["idpaci"];
				$subtitulo="El registro del paciente ";
				$subtitulo1="Actualizado";
			break;
			case 'A':
				$nom_completo=$_POST['nom1'].' '.$_POST['nom2'].' '.$_POST['ape1'].' '.$_POST['ape2'];
				$fecha=$_POST["fnacimiento"];
				$segundos= strtotime('now') - strtotime($fecha);
				$diferencia_dias=intval($segundos /60/60/24);
				$dias=floor($diferencia_dias/365);
				$sql="INSERT INTO pacientes (tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fnacimiento,edad,uedad,dir_pac,tel_pac,email_pac,estadocivil,
					genero,rh,etnia,lateralidad,profesion$fotopA1,religion,estado_pac,nom_completo) VALUES
				('".$_POST["tdocpac"]."','".$_POST["docpac"]."','".$_POST["nom1"]."','".$_POST["nom2"]."','".$_POST["ape1"]."',
				'".$_POST["ape2"]."','".$_POST["fnacimiento"]."','".$dias."','1','".$_POST["dirpac"]."',
				'".$_POST["telpac"]."','".$_POST["emailpac"]."','".$_POST["estadocivil"]."','".$_POST["genero"]."','".$_POST["rh"]."',
				'".$_POST["etnia"]."','".$_POST["lateralidad"]."','".$_POST["profesion"]."','".$_POST["religion"]."'$fotopA2,
				'".$_POST["estado_pac"]."','$nom_completo')";
				$subtitulo="El regitro del paciente ";
				$subtitulo1="Adicionado";
			break;
			case 'ACU':
				$sql="INSERT INTO info_acudiente (id_adm_hosp,nombre_acu,dir_acu,tel_acu,parentesco_acu) VALUES
				('".$_POST["idadm"]."','".$_POST["nombre"]."','".$_POST["direccion"]."','".$_POST["telefono"]."',
				'".$_POST["parentesco"]."')";
				$subtitulo="El registro de ACUDIENTE ";
				$subtitulo1="Adicionado";
			break;
			case 'DOC':
				$sql="INSERT INTO info_documentacion (id_paciente,nombre_doc$docA)
				VALUES ('".$_POST["idpac"]."','".$_POST["nomdoc"]."'$docb)";
				$subtitulo="El soporte documental ";
				$subtitulo1="Cargado";
			break;
			case 'ADM':

				$sql="INSERT INTO adm_hospitalario ( id_eps, id_paciente, id_sedes_ips, fingreso_hosp, hingreso_hosp,
					tipo_usuario, tipo_afiliacion, ocupacion, dep_residencia, mun_residencia, zona_residencia, nivel,
					via_ingreso, tipo_servicio,resp_admhosp,estado_adm_hosp )
				VALUES ('".$_POST["id_eps"]."', '".$_POST["id_paciente"]."', '".$_POST["id_sedes_ips"]."',
				'".$_POST["fingreso_hosp"]."','".$_POST["hingreso_hosp"]."','".$_POST["tipo_usuario"]."',
				'".$_POST["tipo_afiliacion"]."', '".$_POST["ocupacion"]."', '".$_POST["dep_residencia"]."',
				'".$_POST["mun_residencia"]."', '".$_POST["zona_residencia"]."', '".$_POST["nivel"]."','".$_POST["via_ingreso"]."',
				 '".$_POST["servicio"]."','".$_SESSION["AUT"]["id_user"]."','Activo')";
				 $sql2="UPDATE referencia SET estado_referencia=6 WHERE id_referencia='".$_POST["id_referencia"]."'";
				 $serv=$_POST['tipo_servicio'];
				$subtitulo="El registro de admisión en servicio ".$serv;
				$subtitulo1="REALIZADO";
				$subtitulo2="Referecia cerrada";
			break;
			case 'EGR':
			$fecha=$_POST["finicial"];
			$segundos= strtotime('now') - strtotime($fecha);
			$diferencia_dias=intval($segundos/60/60/24);
			$salida=$_POST['esalida'];
			//echo $salida;
			if ($salida=='Salida Parcial') {
				$sql1="INSERT INTO historico_salida_parcial (id_adm_hosp,resp_reg) VALUES ('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]['id_user']."')";
				$sql2="UPDATE adm_hospitalario SET estado_salida='".$_POST["esalida"]."',
											fegreso_hosp='".$_POST["fegreso"]."',hegreso_hosp='".$_POST["hegreso"]."',
											resp_log_egreso='".$_SESSION["AUT"]["id_user"]."'
				WHERE id_adm_hosp='".$_POST["idadmhosp"]."'";
				$subtitulo="El Proceso de egreso  ";
				$subtitulo1="realizado";
			}else {

				$sql="UPDATE cama SET estado_cama='Libre' WHERE id_cama='".$_POST["idc"]."' ";
				$sql1="UPDATE ubipaciente SET ffinal='".$_POST["fegreso"]."',total_destancia='".$diferencia_dias."'
								WHERE id_ubipaciente='".$_POST["idu"]."' ";
				$sql2="UPDATE adm_hospitalario set fegreso_hosp='".$_POST["fegreso"]."',hegreso_hosp='".$_POST["hegreso"]."',
				estado_salida='".$_POST["esalida"]."',via_salida='".$_POST["viasalida"]."',medsalida='".$_SESSION["AUT"]["nombre"]."',
				estado_adm_hosp='Parcial',resp_log_egreso='".$_SESSION["AUT"]["id_user"]."'
				WHERE id_adm_hosp='".$_POST["idadmhosp"]."'";
				$subtitulo="El Proceso de egreso  ";
				$subtitulo1="realizado";
			}
			break;
			case 'EDITADM':
				$sql="UPDATE adm_hospitalario SET id_eps='".$_POST["id_eps"]."',id_sedes_ips='".$_POST["id_sedes_ips"]."' ,dep_residencia='".$_POST["dep_residencia"]."',mun_residencia='".$_POST["mun_residencia"]."',
											tipo_usuario='".$_POST["tipo_usuario"]."' ,tipo_afiliacion='".$_POST["tipo_afiliacion"]."' ,zona_residencia='".$_POST["zona_residencia"]."',nivel='".$_POST["nivel"]."'
							WHERE id_adm_hosp='".$_POST["idadm"]."'";
			break;
			case 'PARCIAL':
				$sql1="UPDATE historico_salida_parcial SET fecha_regreso='".$_POST["fecha_regreso"]."'
							 WHERE id_h_sparcial='".$_POST["id_h_sparcial"]."'";
				$sql2="UPDATE adm_hospitalario SET estado_salida = NULL,fegreso_hosp = NULL,hegreso_hosp = NULL,resp_log_egreso='".$_SESSION["AUT"]["id_user"]."'
				WHERE id_adm_hosp='".$_POST["idadmhosp"]."'";
				$subtitulo="Paciente retorna a proceso de hospitalización  ";
				$subtitulo1="realizado";
			break;
		}
		echo $sql.'  query 1: ';
	echo $sql1.'  query 2: ';
  	echo $sql2.' query 3: ';
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo fue $subtitulo1 con exito!";
			$check='si';
			if ($bd1->consulta($sql2)) {

				if ($bd1->consulta($sql1)) {
					$subtitulo="$subtitulo fue $subtitulo1 con exito!";
					$check='si';
				}
			}
		}else{
			$subtitulo="$subtitulo NO fue $subtitulo1 !!! .";
			$check='no';
		}
	}
}
if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'E':
			$sql="SELECT a.id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil,
									 genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena,
									 b.tipo,descri_tipo
						FROM pacientes a LEFT JOIN tdocumentos b on a.tdoc_pac=b.tipo
						WHERE id_paciente=".$_GET["idpac"];
						//echo $sql;
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$option=17;
			$doc=$_REQUEST['doc'];
			$servicio=$_REQUEST['servicio'];
			$form1='admision/add_paciente.php';
			$subtitulo='Edicion o actualizacion de datos del paciente';
			break;
			case 'DOC':
				$sql="SELECT a.id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil,
										 genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena,
										 b.id_adm_hosp
							FROM pacientes a LEFT JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
							WHERE a.id_paciente=".$_GET["idpac"];
							//echo $sql;
				$color="green";
				$boton="Cargar Documento";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$option=17;
				$doc=$_REQUEST['doc'];
				$servicio=$_REQUEST['servicio'];
				$form1='admision/add_documentos.php';
				$subtitulo='Cargar documentos del paciente';
				break;
			case 'ACU':
			$pac=$_GET['idadm'];
				$sql="SELECT a.id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil,
										 genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena,
										 c.id_adm_hosp
							FROM pacientes a INNER JOIN adm_hospitalario c on a.id_paciente=c.id_paciente
							WHERE c.id_adm_hosp=$pac and c.estado_adm_hosp='Activo'";
							//echo $sql;
				$color="green";
				$boton="Agregar acudiente";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$option=17;
				$doc=$_REQUEST['doc'];
				$servicio=$_REQUEST['servicio'];
				$form1='admision/add_acudiente.php';
				$subtitulo='Registro de acudiente';
			break;
			case 'ACO':
			$pac=$_GET['idadm'];
				$sql="SELECT a.id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil,
										 genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena,
										 c.id_adm_hosp
							FROM pacientes a INNER JOIN adm_hospitalario c on a.id_paciente=c.id_paciente
							WHERE c.id_adm_hosp=$pac and c.estado_adm_hosp='Activo'";
							//echo $sql;
				$color="green";
				$boton="Agregar Acompañante";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$option=17;
				$doc=$_REQUEST['doc'];
				$servicio=$_REQUEST['servicio'];
				$form1='admision/add_acompanante.php';
				$subtitulo='Registro de Acompañante';
			break;
			case 'ADM':
			$sql="SELECT a.id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil,
									 genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena,nom_completo,
									 b.tipo,descri_tipo
						FROM pacientes a LEFT JOIN tdocumentos b on a.tdoc_pac=b.tipo
						WHERE id_paciente=".$_GET["idpac"];
			$color="yellow";
			$boton="Registrar Admisión";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$option=17;
			$doc=$_REQUEST['doc'];
			$servicio=$_REQUEST['servicio'];
			$form1='admision/add_admision.php';
			$subtitulo='Registro de admisiones';
			break;
			case 'EDITADM':
			$idadm=$_REQUEST['idadm'];
			$sql="SELECT  b.id_adm_hosp,b.id_eps codeps,b.id_sedes_ips sede,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
										b.tipo_usuario tuser,b.tipo_afiliacion tafil,zona_residencia,nivel,tipo_servicio,resp_admhosp,
										b.ocupacion ocp, b.dep_residencia dep, b.mun_residencia mun,
										d.descriafiliado,
										e.descritusuario,
										f.descriocu,
										g.descripdep,
										h.descrimuni,
										j.nom_eps,
										k.nom_sedes
						FROM adm_hospitalario b inner join eps j on (j.id_eps=b.id_eps)
						      left join tusuario e on (e.codtusuario=b.tipo_usuario)
						      left join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
						      left join ocupacion f on (f.codocu=b.ocupacion)
						      left join departamento g on (g.coddep=b.dep_residencia)
						      left join municipios h on (h.codmuni=b.mun_residencia)
									LEFT JOIN sedes_ips k on k.id_sedes_ips=b.id_sedes_ips
						WHERE id_adm_hosp=$idadm";
			$color="yellow";
			$boton="Actualizar Admisión";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$option=17;
			$doc=$_REQUEST['doc'];
			$servicio=$_REQUEST['servicio'];
			$form1='admision/edit_admision.php';
			$subtitulo='Edición de datos en admisión';
			break;
			case 'PARCIAL':
			$pac=$_GET['idadm'];
			$sql="SELECT a.id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil,
									 genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena,
									 c.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
									 b.id_ubipaciente,b.id_cama idc,finicial,ffinal,
									 d.nom_cama,
									 e.nom_hab,
									 f.nom_pabellon,
									 g.nom_piso
						FROM pacientes a INNER JOIN adm_hospitalario c on a.id_paciente=c.id_paciente
														 LEFT JOIN ubipaciente b on b.id_adm_hosp=c.id_adm_hosp
														 LEFT JOIN cama d on d.id_cama=b.id_cama
														 LEFT JOIN habitacion e on e.id_habitacion=d.id_habitacion
														 LEFT JOIN pabellon f on f.id_pabellon=e.id_pabellon
														 LEFT JOIN piso g on g.id_piso=f.id_piso
						WHERE c.id_adm_hosp=$pac and c.estado_adm_hosp='Activo'";
						//echo $sql;
			$color="green";
			$boton="Hospitalizar paciente";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$option=17;
			$doc=$_REQUEST['doc'];
			$servicio=$_REQUEST['servicio'];
			$form1='admision/reg_parcial.php';
			$subtitulo='Regreso del paciente al servicio hospitalario';
			break;
			case 'EGR':
			$pac=$_GET['idadm'];
			$sql="SELECT a.id_paciente, tdoc_pac, doc_pac, nom1, nom2, ape1, ape2, fnacimiento, edad, uedad, dir_pac, tel_pac, email_pac, estadocivil,
									 genero, rh, etnia, lateralidad, profesion, religion, fotopac, estado_pac, cie, descricie, zonapac, ipsordena,
									 c.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
									 b.id_ubipaciente,b.id_cama idc,finicial,ffinal,
									 d.nom_cama,
									 e.nom_hab,
									 f.nom_pabellon,
									 g.nom_piso
						FROM pacientes a INNER JOIN adm_hospitalario c on a.id_paciente=c.id_paciente
														 LEFT JOIN ubipaciente b on b.id_adm_hosp=c.id_adm_hosp
														 LEFT JOIN cama d on d.id_cama=b.id_cama
														 LEFT JOIN habitacion e on e.id_habitacion=d.id_habitacion
														 LEFT JOIN pabellon f on f.id_pabellon=e.id_pabellon
														 LEFT JOIN piso g on g.id_piso=f.id_piso
						WHERE c.id_adm_hosp=$pac and c.estado_adm_hosp='Activo'";
						//echo $sql;
			$color="green";
			$boton="Egresar paciente";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$option=17;
			$doc=$_REQUEST['doc'];
			$servicio=$_REQUEST['servicio'];
			$form1='admision/egreso.php';
			$subtitulo='Egreso del paciente';
			break;
			case 'A':
			$sql="";
			$color="yellow";
			$boton="Crear Paciente";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y-m-d');
			$option=17;
			$doc=$_REQUEST['doc'];
			$servicio=$_REQUEST['servicio'];
			$form1='admision/add_paciente.php';
			$subtitulo='Registro de datos básicos del paciente';
			break;
		}
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_paciente"=>"", "tdoc_pac"=>"", "doc_pac"=>"", "nom1"=>"", "nom2"=>"", "ape1"=>"", "ape2"=>"", "fnacimiento"=>"", "edad"=>"",
				"uedad"=>"", "dir_pac"=>"", "tel_pac"=>"", "email_pac"=>"", "estadocivil"=>"", "genero"=>"", "rh"=>"", "etnia"=>"", "lateralidad"=>"",
				"profesion"=>"", "religion"=>"", "fotopac"=>"", "estado_pac"=>"", "cie"=>"", "descricie"=>"", "zonapac"=>"", "ipsordena"=>"", "tipo"=>"",
				"descri_tipo"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","id_ubipaciente"=>"","finicial"=>"","ffinal"=>"","nom_cama"=>"",
				"nom_hab"=>"","nom_pabellon"=>"","nom_piso"=>"","idc"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"","zona_residencia"=>"",
				"nivel"=>"","tipo_servicio"=>"","resp_admhosp"=>"","descripestadoc"=>"","descriafiliado"=>"","descritusuario"=>"","descriocu"=>"","descripdep"=>"","descrimuni"=>"",
				"descripuedad"=>"","nom_eps"=>"","nom_sedes"=>"","codeps"=>"","sede"=>"","tuser"=>"","tafil"=>"","ocp"=>"","dep"=>"","mun"=>"");
			}
		}else{
				$fila=array("id_paciente"=>"", "tdoc_pac"=>"", "doc_pac"=>"", "nom1"=>"", "nom2"=>"", "ape1"=>"", "ape2"=>"", "fnacimiento"=>"", "edad"=>"",
				"uedad"=>"", "dir_pac"=>"", "tel_pac"=>"", "email_pac"=>"", "estadocivil"=>"", "genero"=>"", "rh"=>"", "etnia"=>"", "lateralidad"=>"",
				"profesion"=>"", "religion"=>"", "fotopac"=>"", "estado_pac"=>"", "cie"=>"", "descricie"=>"", "zonapac"=>"", "ipsordena"=>"", "tipo"=>"",
				"descri_tipo"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","id_ubipaciente"=>"","finicial"=>"","ffinal"=>"","nom_cama"=>"",
				"nom_hab"=>"","nom_pabellon"=>"","nom_piso"=>"","idc"=>"",	"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"","zona_residencia"=>"",
				"nivel"=>"","tipo_servicio"=>"","resp_admhosp"=>"","descripestadoc"=>"","descriafiliado"=>"","descritusuario"=>"","descriocu"=>"","descripdep"=>"","descrimuni"=>"",
				"descripuedad"=>"","nom_eps"=>"","nom_sedes"=>"","codeps"=>"","sede"=>"","tuser"=>"","tafil"=>"","ocp"=>"","dep"=>"","mun"=>"");
			}
		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nom_cliente.value == ""){
					alert("Se requiere el nombre del cliente!");
					document.forms[0].nom_cliente.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
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
<section class="panel panel-default">
		<section class="panel-body">
			<?php
				include("consulta_rapida1.php");
			?>
		</section>
		<section class="panel-heading"><h4>Admisiones y registro SION Software</h4></section>
		<section class="col-xs-12">
			<form>
				<section class="panel-body col-xs-12">
					<section class="col-md-7">
						<article class="col-xs-12 input-group">
							<span class="input-group-addon" id="sizing-addon1">#</span>
							<input type="text" class="form-control" placeholder="Digite documento de identidad" name="doc" aria-describedby="basic-addon1">
						</article>
						<article class="col-xs-12 input-group">
							<span class="input-group-addon" id="sizing-addon1">Tipo Servicio:</span>
							<select required name="servicio" class="form-control" aria-describedby="basic-addon1">
								<option value=""></option>
								<?php
								$user=$_SESSION['AUT']['id_perfil'];
								if ($user==10 || $user==78  || $user==1) {
									$sql="SELECT id_serv,nomserv from tipo_servicio WHERE id_serv in (1,2,6) ORDER BY id_serv ASC";
				          if($tabla=$bd1->sub_tuplas($sql)){
				            foreach ($tabla as $fila2) {
				              if ($fila["nomserv"]==$fila2["nomserv"]){
				                $sw=' selected="selected"';
				              }else{
				                $sw="";
				              }
				            echo '<option value="'.$fila2["nomserv"].'"'.$sw.'>'.$fila2["nomserv"].'</option>';
				            }
				          }
								}
								if ($user==80 || $user==1) {
									$sql="SELECT id_serv,nomserv from tipo_servicio WHERE id_serv in (5,7) ORDER BY id_serv ASC";
				          if($tabla=$bd1->sub_tuplas($sql)){
				            foreach ($tabla as $fila2) {
				              if ($fila["nomserv"]==$fila2["nomserv"]){
				                $sw=' selected="selected"';
				              }else{
				                $sw="";
				              }
				            echo '<option value="'.$fila2["nomserv"].'"'.$sw.'>'.$fila2["nomserv"].'</option>';
				            }
				          }
								}
								if ($user==81 || $user==1) {
									$sql="SELECT id_serv,nomserv from tipo_servicio WHERE id_serv in (8,9,10,11,12,13,14,15) ORDER BY id_serv ASC";
				          if($tabla=$bd1->sub_tuplas($sql)){
				            foreach ($tabla as $fila2) {
				              if ($fila["nomserv"]==$fila2["nomserv"]){
				                $sw=' selected="selected"';
				              }else{
				                $sw="";
				              }
				            echo '<option value="'.$fila2["nomserv"].'"'.$sw.'>'.$fila2["nomserv"].'</option>';
				            }
				          }
								}
			          ?>
							</select>
						</article>
						<br>
						<div class="text-center animated bounceIn col-xs-12">
							<input type="submit" name="buscar" class="btn btn-warning" value="Buscar">
							<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
						</div>
					</section>
					<section class="col-md-5">
						<article class="col-md-4">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#s_parcial"><span class="fa fa-list fa-2x"></span> Pacientes <br> Salida Parcial</button>

							<div id="s_parcial" class="modal fade" role="dialog">
							  <div class="modal-dialog modal-lg">

							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">Pacientes en Salida Parcial</h4>
							      </div>
							      <div class="modal-body">
											<table class="table table-bordered" id="Exportar_a_Excel">
												<tr>
													<td class="text-center"><strong>Identificacion</strong></td>
													<td class="text-center"><strong>Nombre completo</strong></td>
													<td class="text-center"><strong>EPS</strong></td>
													<td class="text-center"><strong>SEDE</strong></td>
												</tr>
												<?php

												$sqlhd="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,fotopac,
												b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,zona_residencia,nivel,tipo_servicio,resp_admhosp,
												c.descripestadoc,
												d.descriafiliado,
												e.descritusuario,
												f.descriocu,
												i.descripuedad,
												j.nom_eps,
												k.ddxp,
												l.id_sedes_ips,nom_sedes
												from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
															left join estado_civil c on (c.codestadoc = a.estadocivil)
															inner join tusuario e on (e.codtusuario=b.tipo_usuario)
															inner join tafiliado d on (d.codafiliado=b.tipo_afiliacion)
															inner join ocupacion f on (f.codocu=b.ocupacion)
															inner join uedad i on (i.coduedad=a.uedad)
															left join eps j on (j.id_eps=b.id_eps)
															left join sedes_ips l on (l.id_sedes_ips=b.id_sedes_ips)
															left join hc_hospdia k on (k.id_adm_hosp=b.id_adm_hosp)


												where b.id_sedes_ips in ('2','8') and b.estado_adm_hosp='Activo' and tipo_servicio='Hospitalario' and estado_salida='Salida Parcial' order by a.doc_pac,b.id_sedes_ips ASC";
													//echo $sql;
												if ($tablahd=$bd1->sub_tuplas($sqlhd)){
													foreach ($tablahd as $filahd ) {
														if ($filahd['id_sedes_ips']==2) {
															echo"<tr >\n";
															echo'<td class="text-center ">
																		<p class="btn-xs"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PARCIAL&idadm='.$filahd["id_adm_hosp"].'&ser='.$filahd["id_serv"].'&doc='.$filahd["doc_pac"].'"><button type="button" class="btn btn-danger sombra_movil"><span class="fa fa-hospital-o"></span> Regreso<br>Hospitalario</button></a></p>
																	 </td>';
															echo'<td class="text-left ">
																		<p>'.$filahd["nom1"].' '.$filahd["nom2"].' '.$filahd["ape1"].' '.$filahd["ape2"].'</p>
																		<p><strong><span class="fa fa-user-md"></span> '.$filahd["tdoc_pac"].' : '.$filahd["doc_pac"].' </strong></p>
																	 </td>';
															echo'<td class="text-left "> '.$filahd["nom_eps"].'</td>';
															echo'<td class="text-left "> '.$filahd["nom_sedes"].'</td>';
															echo '</tr>';
														}
														if ($filahd['id_sedes_ips']==8) {
															echo"<tr >\n";
															echo'<td class="text-center">
																		<p class="btn-xs"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=PARCIAL&idadm='.$filahd["id_adm_hosp"].'&ser='.$filahd["id_serv"].'&doc='.$filahd["doc_pac"].'"><button type="button" class="btn btn-danger sombra_movil"><span class="fa fa-hospital-o"></span> Regreso<br>Hospitalario</button></a></p>
																	 </td>';
															echo'<td class="text-left">
																		<p>'.$filahd["nom1"].' '.$filahd["nom2"].' '.$filahd["ape1"].' '.$filahd["ape2"].'</p>
																		<p><strong><span class="fa fa-user-md"></span> '.$filahd["tdoc_pac"].' : '.$filahd["doc_pac"].' </strong></p>
																	 </td>';
															echo'<td class="text-left"> '.$filahd["nom_eps"].'</td>';
															echo'<td class="text-left"> '.$filahd["nom_sedes"].'</td>';
															echo '</tr>';
														}

													}
												}
												?>
											</table>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							      </div>
							    </div>

							  </div>
							</div>
						</article>
					</section>
				</section>
			</form>
		</section>

		<section>
			<table class="table table-bordered">
				<tr>

					<th>PACIENTE</th>
					<th>FOTO</th>
					<th>ADMISION ACTUAL</th>
					<th></th>
				</tr>

				<?php
				if (isset($_REQUEST["doc"])){
				$fecha=$_REQUEST["doc"];
				$sql="SELECT id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac
							FROM pacientes
							WHERE doc_pac='".$fecha."'";
					//echo $sql;
				if ($tabla=$bd1->sub_tuplas($sql)){
					foreach ($tabla as $fila ) {
							echo"<tr >\n";
							echo'<td class="text-center col-xs-3">
										<p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
										<p><strong>'.$fila["tdoc_pac"].':</strong> '.$fila["doc_pac"].' <strong>ID:</strong>'.$fila["id_paciente"].'</p>
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idpac='.$fila["id_paciente"].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-edit"></span> Editar paciente</button></a></p>
									 </td>';
							echo'<td class="text-center col-xs-1">
										<img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac">
									 </td>';
							echo'<td class="text-center col-xs-5">';
							$pac=$fila['id_paciente'];
							$servicio=$_REQUEST['servicio'];
							$sql2="SELECT a.id_paciente,
														b.id_adm_hosp,fingreso_hosp,fegreso_hosp,tipo_servicio,estado_adm_hosp,estado_salida,
														c.id_serv,nomserv
									FROM pacientes a LEFT JOIN adm_hospitalario b on (a.id_paciente=b.id_paciente)
																	 INNER JOIN tipo_servicio c on b.tipo_servicio=c.nomserv
									WHERE a.id_paciente=$pac and b.tipo_servicio in ('$servicio') and b.estado_adm_hosp='Activo'";
								//echo $sql2;
									if ($tabla2=$bd1->sub_tuplas($sql2)){
										foreach ($tabla2 as $fila2 ) {
											if ($fila2['estado_adm_hosp']=='Activo' ) {
												echo'
												<section class="col-xs-12 alert alert-danger">
													<p></p>
													<p>Tiene servicio ACTIVO. En <strong>'.$fila2['tipo_servicio'].'</strong>. <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EDITADM&idadm='.$fila2["id_adm_hosp"].'&ser='.$fila2["id_serv"].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-danger sombra_movil"><span class="fa fa-edit"></span> Editar</button></a></p>
													<p>'.$fila2['fingreso_hosp'].' '.$fila2['fegreso_hosp'].'</p>';
													if ($fila['estado_salida']=='Salida Parcial') {
														echo'<p>Paciente en salida parcial</p>';
													}
													echo'<article class="col-xs-4">
																<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EGR&idadm='.$fila2["id_adm_hosp"].'&ser='.$fila2["id_serv"].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-danger sombra_movil"><span class="fa fa-ban"></span> Generar<br>Egreso</button></a>
															 </article>';
													$adm=$fila2['id_adm_hosp'];
													$sql3="SELECT b.id_adm_hosp,fingreso_hosp,fegreso_hosp,tipo_servicio,estado_adm_hosp,
																				c.id_infoacu,parentesco_acu,nombre_acu
															FROM adm_hospitalario b LEFT JOIN info_acudiente c on (c.id_adm_hosp=b.id_adm_hosp)
															WHERE b.id_adm_hosp=$adm Limit 1";
															//echo $sql3;
															if ($tabla3=$bd1->sub_tuplas($sql3)){
																foreach ($tabla3 as $fila3 ) {
																	if ($fila3['id_infoacu']=='') {
																		echo'<article class="col-xs-4">
																					<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ACU&idadm='.$fila2["id_adm_hosp"].'&ser='.$fila2["id_serv"].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-warning sombra_movil"><span class="fa fa-users"></span> Registrar<br>Acudiente</button></a>
																				 </article>';
																	}else {
																		echo'<article class="col-xs-4 alert alert-success">
																					<p><strong>Ya registra acudiente</strong></p>
																				 </article>';
																	}
																}
															}
															$adm=$fila2['id_adm_hosp'];
															$sql4="SELECT b.id_adm_hosp,fingreso_hosp,fegreso_hosp,tipo_servicio,estado_adm_hosp,
																						c.id_infoaco,parentesco_aco,nombre_aco
																	FROM adm_hospitalario b LEFT JOIN info_acompanante c on (c.id_adm_hosp=b.id_adm_hosp)
																	WHERE b.id_adm_hosp=$adm Limit 1";
																	//echo $sql3;
																	if ($tabla4=$bd1->sub_tuplas($sql4)){
																		foreach ($tabla4 as $fila4 ) {
																			if ($fila4['id_infoaco']=='') {
																				echo'<article class="col-xs-4">
																							<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ACO&idadm='.$fila2["id_adm_hosp"].'&ser='.$fila2["id_serv"].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-warning sombra_movil"><span class="fa fa-users"></span> Registrar<br>Acompañante</button></a>																						 </article>';
																			}else {
																				echo'<article class="col-xs-4 alert alert-success">
																							<p><strong>Ya registra Acompañante</strong></p>
																						 </article>';
																			}
																		}
																	}
												echo'</section>';
											}
										}
									}else {
										echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=ADM&idpac='.$fila["id_paciente"].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-success sombra_movil"><span class="fa fa-play"></span> Admisión</button></a>';
									}

							echo'</td>';// fin modulo de admision

							echo'<th class="text-center col-xs-3">';// Modulo de cargue de documentos
							echo'<article  class="col-xs-12">
										<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOC&idpac='.$fila["id_paciente"].'&idadm='.$fila2['id_adm_hosp'].'&doc='.$fila["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-success sombra_movil"><span class="fa fa-file-text"></span> <p>Cargar documentos</p></button></a></p>
									 </article>
									 <article class="col-xs-12 text-center">
									 <h4>Documentos Cargados al paciente</h4>';
									 $adm=$fila['id_paciente'];
		 							$sql4="SELECT b.id_paciente,
		 														c.id_infodocs,nombre_doc,foto
		 									FROM pacientes b LEFT JOIN info_documentacion c on (c.id_paciente=b.id_paciente)
		 									WHERE b.id_paciente=$adm";
		 									//echo $sql4;
		 									if ($tabla4=$bd1->sub_tuplas($sql4)){
		 										foreach ($tabla4 as $fila4 ) {
													$idadm=$fila2['id_adm_hosp'];
													$idpaciente=$fila['id_paciente'];
		 											if ($fila4['id_infodocs']!='') {

														if ($fila4['nombre_doc']==$fila["id_paciente"].'_Documento Identidad' && $fila4['foto']!='') {
															echo'<p class="col-xs-12 fa fa-check animated fadeInLeft text-success borde_p"> Doc. Identidad</p>
																	 <p><a href="/docpaciente/'.$idpaciente.'_Documento Identidad.pdf"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-file-pdf-o"></span> </button></a></p>';
														}
														if ($fila4['nombre_doc']==$fila2['id_adm_hosp'].'_Autorizacion EPS' && $fila4['foto']!='') {
															echo'<p class="col-xs-12 fa fa-check animated fadeInLeft text-success borde_p"> Autorizacion EPS</p>
															<p><a href="'.$idadm.'_Autorizacion EPS.pdf"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-file-pdf-o"></span> </button></a></p>';
														}
														if ($fila4['nombre_doc']==$fila2['id_adm_hosp'].'_Consentimiento Informado' && $fila4['foto']!='') {
															echo'<p class="col-xs-12 fa fa-check animated fadeInLeft text-success borde_p"> Consentimiento Informado</p>
															<p><a href="/docpaciente/'.$idadm.'_Consentimiento Ingreso.pdf"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-file-pdf-o"></span> </button></a></p>';
														}
														if ($fila4['nombre_doc']==$fila2['id_adm_hosp'].'_Consentimiento Traslado' && $fila4['foto']!='') {
															echo'<p class="col-xs-12 fa fa-check animated fadeInLeft text-success borde_p"> Consentimiento Traslado</p>
															<p><a href="/docpaciente/'.$idadm.'_Consentimiento Informado.pdf"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-file-pdf-o"></span> </button></a></p>';
														}
														if ($fila4['nombre_doc']==$fila2['id_adm_hosp'].'_Consentimiento Procedimientos' && $fila4['foto']!='') {
															echo'<p class="col-xs-12 fa fa-check animated fadeInLeft text-success borde_p"> Consentimiento Procedimientos</p>
															<p><a href="/docpaciente/'.$idadm.'_Consentimiento Traslado.pdf"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-file-pdf-o"></span> </button></a></p>';
														}
														if ($fila4['nombre_doc']==$fila2['id_adm_hosp'].'_Epicrisis' && $fila4['foto']!='') {
															echo'<p class="col-xs-12 fa fa-check animated fadeInLeft text-success borde_p"> Epicrisis</p>
															<p><a href="/docpaciente/'.$idadm.'_Epicrisis.pdf"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-file-pdf-o"></span> </button></a></p>';
														}
														if ($fila4['nombre_doc']==$fila2['id_adm_hosp'].'_Pagare' && $fila4['foto']!='') {
															echo'<p class="col-xs-12 fa fa-check animated fadeInLeft text-success borde_p"> Pagare</p>
															<p><a href="/docpaciente/'.$idadm.'_Pagare.pdf"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-file-pdf-o"></span> </button></a></p>';
														}
		 											}
		 										}
		 									}
							echo'</article></th>';
							echo "</tr>\n";
					}
				}
			}
				?>

				<tr>
					<th colspan="14" class="text-center"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&doc='.$_REQUEST['doc'].'&servicio='.$_REQUEST['servicio'];?>"><button type="button" class="btn btn-primary fa fa-user-plus"> Creación Nuevo Paciente</button>
					</a></th>
				</tr>
			</table>

		</section>
</section>

	<?php
}
?>
