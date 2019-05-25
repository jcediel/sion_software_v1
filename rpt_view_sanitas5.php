
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
			case 'E':
				$sql="UPDATE vehiculos SET id_rutas='".$_POST["idruta"]."',id_provexpreso='".$_POST["idprove"]."',tipo_vehiculo='".$_POST["doc_cliente"]."',placa='".$_POST["mail_cliente"]."',num_interno='".$_POST["tel_cliente"]."',modelo='".$_POST["dir_cliente"]."',capacidad='".$_POST["estado_cliente"]."',conductor='".$_POST["porciento_tiquetes"]."',contacto_conductor='".$_POST["porciento_expresos"]."',estado_vehiculo='".$_POST["porciento_alimentacion"]."' WHERE id_vehiculo=".$_POST["idveh"];
				$subtitulo="Actualizado";
			break;
			case 'X':
				$sql="SELECT logo from cliente where id=".$_POST["idcli"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="DELETE FROM cliente WHERE id_cliente=".$_POST["idcli"];
				$subtitulo="Eliminado";
			break;
			case 'A':
				$tam1=$_POST["tad"] * 2;
				$tam2=$tam1 + $_POST["tds"];
				$tamt=$tam2/3;
				$sql="INSERT INTO hc_hospitalario (id_adm_hosp,id_user,freg_hchosp,hreg_hchosp,motivo_consulta,enfer_actual,his_personal,his_familiar,perso_premorbida,ant_alergicos,ant_patologico,ant_quirurgico,ant_toxicologico,ant_farmaco,ant_gineco,ant_psiquiatrico,ant_hospitalario,ant_traumatologico,ant_familiar,otros_ant,estado_general,tad,tas,tam,fr,fc,so,peso,talla,temperatura,imc,cabcuello,torax,ext,abdomen,neurologico,genitourinario,examen_mental,analisis,finalidad,causa_externa,plantratamiento,Resp_hchosp,especialidad,estado_hchosp) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["motivoconsulta"]."','".$_POST["enferactual"]."','".$_POST["hpersonal"]."','".$_POST["hfamiliar"]."','".$_POST["ppremorbida"]."','".$_POST["antalergico"]."','".$_POST["antpatologico"]."','".$_POST["antquirurgico"]."','".$_POST["anttoxicologicos"]."','".$_POST["antfarmacologico"]."','".$_POST["antgineco"]."','".$_POST["antpsiquiatrico"]."','".$_POST["anthospitalario"]."','".$_POST["anttrauma"]."','".$_POST["antfami"]."','".$_POST["antotros"]."','".$_POST["estadogen"]."','".$_POST["tad"]."','".$_POST["tas"]."','$tamt','".$_POST["fr"]."','".$_POST["fc"]."','".$_POST["sao2"]."','".$_POST["peso"]."','".$_POST["talla"]."','".$_POST["temperatura"]."','$imc2','".$_POST["cabezacuello"]."','".$_POST["torax"]."','".$_POST["extsup"]."','".$_POST["abdomen"]."','".$_POST["neurologico"]."','".$_POST["genitourinario"]."','".$_POST["exmental"]."','".$_POST["analisis"]."','".$_POST["finconsulta"]."','".$_POST["causaexterna"]."','".$_POST["plant"]."','".$_SESSION["AUT"]["nombre"]."','".$_SESSION["AUT"]["especialidad"]."','Realizada')";
				$subtitulo="Adicionado";

			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro fue $subtitulo con exito!";
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El registro NO fue $subtitulo !!! .";
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'E':
			$sql="SELECT s.".$_GET["idveh"];
			$color="green";
			$boton="Actualizar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Edición de datos del Vehículo';
			break;
			case 'X':
			$sql="";
			$color="red";
			$boton="Eliminar";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$subtitulo='Confirmación para eliminar de datos del Vehículo';
			break;
			case 'A':
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,estadocivil,edad,lateralidad,profesion,religion,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_usuario,tipo_afiliacion,ocupacion,dep_residencia,mun_residencia,zona_residencia,nivel,via_ingreso,s.nom_sedes FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips  WHERE a.id_adm_hosp=".$_GET["idadmhosp"];
			$color="yellow";
			$boton="Agregar HC";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y/m/d');
			$date1=date('H:i');
			$subtitulo='';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","edad"=>"","lateralidad"=>"","profesion"=>"","religion"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"","zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");
			}
		}else{
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","edad"=>"","lateralidad"=>"","profesion"=>"","religion"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"","zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");
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
		<script type="text/javascript" src="/js/jquery.js"></script>
		<style>
		b{color:blue;}
		#resultado{width:600px;border:solid 1px #dadada;text-align:justify;padding:5px;}
		</style>
		<script src="ajax.js"></script>


<?php
}else{
	echo $subtitulo;
// nivel 1?>
<div class="panel-default">
<section class="panel-heading"><h4>Informe de auditoria semanal Sanitas EPS</h4></section>
<div class="panel-body">

	<table class="table table-responsive table-bordered table-sm">
	<tr>
		<th>Total Pacientes:</th>

	<?php
	$sql1="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fnacimiento,edad,genero,
	   count(b.id_adm_hosp) cuantos,b.fingreso_hosp,fegreso_hosp,tipo_servicio,estado_adm_hosp

FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente


				WHERE b.id_sedes_ips in (2,8) and b.id_eps=13
																			and b.tipo_servicio='Hospitalario'
																			and b.estado_adm_hosp='Activo'

	";
	if ($tabla=$bd1->sub_tuplas($sql1)){

		foreach ($tabla as $fila1 ) {


			echo'<td class="text-center">'.$fila1["cuantos"].'</td>';


		}
	}
	 ?>
 		<th>Total Sede Bogota:</th>

 	<?php
 	$sql1="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fnacimiento,edad,genero,
 	   count(b.id_adm_hosp) cuantos,b.fingreso_hosp,fegreso_hosp,tipo_servicio,estado_adm_hosp

 FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente


 				WHERE b.id_sedes_ips in (8) and b.id_eps=13
 																			and b.tipo_servicio='Hospitalario'
 																			and b.estado_adm_hosp='Activo'

 	";
 	if ($tabla=$bd1->sub_tuplas($sql1)){

 		foreach ($tabla as $fila1 ) {


 			echo'<td class="text-center">'.$fila1["cuantos"].'</td>';


 		}
 	}
 	 ?>
 		<th>Total Sede Facatativa:</th>

 	<?php
 	$sql1="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fnacimiento,edad,genero,
 	   count(b.id_adm_hosp) cuantos,b.fingreso_hosp,fegreso_hosp,tipo_servicio,estado_adm_hosp

 FROM pacientes a INNER JOIN adm_hospitalario b on a.id_paciente=b.id_paciente


 				WHERE b.id_sedes_ips in (2) and b.id_eps=13
 																			and b.tipo_servicio='Hospitalario'
 																			and b.estado_adm_hosp='Activo'

 	";
 	if ($tabla=$bd1->sub_tuplas($sql1)){

 		foreach ($tabla as $fila1 ) {


 			echo'<td class="text-center">'.$fila1["cuantos"].'</td>';
 			echo "</tr>\n";

 		}
 	}
 	 ?>

	<tr>
		<th>CRONICO</th>
		<th>FECHA INGRESO</th>
		<th>FECHA ACTUAL</th>
		<th>DIAS</th>
		<th>IDENTIFICACION</th>
		<th>1 APELLIDO</th>
    <th>2 APELLIDO</th>
    <th>1 NOMBRE</th>
    <th>2 NOMBRE</th>
		<th>FECHA NACIMIENTO</th>
		<th>SEXO</th>
    <th>ESPECILIDAD</th>
    <th>dx ingreso</th>
    <th>dx 2</th>
    <th>dx 3</th>
    <th>dx 4</th>
    <th>fecha egreso</th>
		<th>ESTADO CLINICO EGRESO</th>
    <th>CONTROL DE SINTOMAS AL EGRESO</th>
    <th>MANEJO FARMACOLOGICO EGRESO</th>
		<th>SEDE</th>

	</tr>

	<?php

	$f1=$_REQUEST["fecha1"];
	$f2=$_REQUEST["fecha2"];
	$sql="SELECT 	a.tdoc_pac,a.doc_pac,a.nom1,a.nom2,a.ape1,a.ape2,a.fnacimiento,a.edad,a.genero,
 								b.id_adm_hosp,b.fingreso_hosp,b.fegreso_hosp,b.tipo_servicio,b.estado_adm_hosp,
    						c.ddxp dhc,c.ddx1 dx1,c.ddx2 dx2,c.ddx3 dx3,c.clasificacion_dx,
								e.subjetivo_epicrisis,objetivo_epicrisis,analisis_epicrisis,plant_epicrisis,ddxp_epi,
    						f.nom_eps,
								g.nom_sedes,id_evomed,subjetivo,objetivo,analisis_evomed,plan_tratamiento
FROM adm_hospitalario b 	INNER 	JOIN pacientes a		on
a.id_paciente	= b.id_paciente
                 	INNER 	JOIN eps f 				on
f.id_eps			= b.id_eps
                 	INNER 	JOIN sedes_ips g 		on
g.id_sedes_ips	= b.id_sedes_ips
                 	INNER   JOIN evolucion_medica d on
b.id_adm_hosp=d.id_adm_hosp
					LEFT 	JOIN hc_hospitalario c 	on
b.id_adm_hosp=c.id_adm_hosp
                 	LEFT 	JOIN epicrisis e 		on
c.id_adm_hosp=b.id_adm_hosp
WHERE b.id_sedes_ips in (2,8) and b.id_eps=13
and b.tipo_servicio='Hospitalario'
and b.estado_adm_hosp='Activo'
and d.id_evomed IN (select max(id_evomed) FROM evolucion_medica f WHERE
f.id_adm_hosp=b.id_adm_hosp)
ORDER by b.fingreso_hosp ASC
	";
		//echo $sql;
	if ($tabla=$bd1->sub_tuplas($sql)){

		foreach ($tabla as $fila ) {
				$fi=$fila['fingreso_hosp'];
				$fa=date('Y-m-d');
				$fecha=$fila['fingreso_hosp'];
				$segundos=strtotime($fecha) - strtotime('now');
				$diferencia_dias=intval($segundos/60/60/24)*(-1);
				$ff=$fila['fegreso_hosp'];
				$fecha1=$fila['fingreso_hosp'];
				$segundos1=strtotime($fecha1) - strtotime($ff);
				$diferencia_dias1=intval($segundos1/60/60/24)*(-1);
				if ($fila['estado_adm_hosp']=='Activo') {
					if ($diferencia_dias>30) {
						echo"<tr >\n";
						echo'<td class="text-center alert-danger animated shake">CRONICO</td>';
						echo'<td class="text-center alert-info">'.$fila["fingreso_hosp"].'</td>';
		        echo'<td class="text-center alert-info">'.$fa.'</td>';
		        echo'<td class="text-center alert-info">'.$diferencia_dias.'</td>';
		        echo'<td class="text-center alert-info">'.$fila["doc_pac"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["ape1"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["ape2"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["nom1"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["nom2"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["fnacimiento"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["genero"].'</td>';
		        echo'<td class="text-center alert-info">Psiquiatria</td>';
		        echo'<td class="text-center alert-info">'.$fila["dhc"].'</td>';
						echo'<td class="text-center alert-info">'.$fila["dx1"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["dx2"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["dx3"].'</td>';
		        echo'<td class="text-center alert-info">No tiene egreso</td>';
						echo'<td class="text-center alert-info">'.$fila["analisis_evomed"].'</td>';

		        echo'<td class="text-center alert-info">'.$fila["plan_tratamiento"].'</td>';
						echo'<td class="text-center alert-info">'.$fila["plan_tratamiento"].'</td>';
						echo'<td class="text-center alert-info">'.$fila["nom_sedes"].'</td>';
						$edad=$fila["doc_pac"];
						$idpaciente=$fila["id_paciente"];
						$cie=$fila["edad"];
						$eps=$fila["nom_eps"];
						echo "</tr>\n";
					}else {
						echo"<tr >\n";
						echo'<td class="text-center alert-info"> </td>';
						echo'<td class="text-center alert-info">'.$fila["fingreso_hosp"].'</td>';
		        echo'<td class="text-center alert-info">'.$fa.'</td>';
		        echo'<td class="text-center alert-info">'.$diferencia_dias.'</td>';
		        echo'<td class="text-center alert-info">'.$fila["doc_pac"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["ape1"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["ape2"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["nom1"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["nom2"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["fnacimiento"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["genero"].'</td>';
		        echo'<td class="text-center alert-info">Psiquiatria</td>';
		        echo'<td class="text-center alert-info">'.$fila["dhc"].'</td>';
						echo'<td class="text-center alert-info">'.$fila["dx1"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["dx2"].'</td>';
		        echo'<td class="text-center alert-info">'.$fila["dx3"].'</td>';
		        echo'<td class="text-center alert-info">No tiene egreso</td>';
						echo'<td class="text-center alert-info">'.$fila["analisis_evomed"].'</td>';

		        echo'<td class="text-center alert-info">'.$fila["plan_tratamiento"].'</td>';
						echo'<td class="text-center alert-info">'.$fila["plan_tratamiento"].'</td>';
						echo'<td class="text-center alert-info">'.$fila["nom_sedes"].'</td>';
						$edad=$fila["doc_pac"];
						$idpaciente=$fila["id_paciente"];
						$cie=$fila["edad"];
						$eps=$fila["nom_eps"];
						echo "</tr>\n";
					}

				}else {
					echo"<tr >\n";
					echo'<td class="text-center alert-warning">'.$fila["fingreso_hosp"].'</td>';
	        echo'<td class="text-center alert-warning">'.$fa.'</td>';
	        echo'<td class="text-center alert-warning">'.$diferencia_dias1.'</td>';
	        echo'<td class="text-center alert-warning">'.$fila["doc_pac"].'</td>';
	        echo'<td class="text-center alert-warning">'.$fila["ape1"].'</td>';
	        echo'<td class="text-center alert-warning">'.$fila["ape2"].'</td>';
	        echo'<td class="text-center alert-warning">'.$fila["nom1"].'</td>';
	        echo'<td class="text-center alert-warning">'.$fila["nom2"].'</td>';
	        echo'<td class="text-center alert-warning">'.$fila["fnacimiento"].'</td>';
	        echo'<td class="text-center alert-warning">'.$fila["genero"].'</td>';
	        echo'<td class="text-center alert-warning">Psiquiatria</td>';
	        echo'<td class="text-center alert-warning">'.$fila["dhc"].'</td>';
					echo'<td class="text-center alert-warning">'.$fila["dx1"].'</td>';
	        echo'<td class="text-center alert-warning">'.$fila["dx2"].'</td>';
	        echo'<td class="text-center alert-warning">'.$fila["dx3"].'</td>';
	        echo'<td class="text-center alert-warning">'.$fila["fegreso_hosp"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["analisis_evomed"].'</td>';

					echo'<td class="text-center alert-info">'.$fila["plan_tratamiento"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["plan_tratamiento"].'</td>';
					echo'<td class="text-center alert-info">'.$fila["nom_sedes"].'</td>';
					$edad=$fila["doc_pac"];
					$idpaciente=$fila["id_paciente"];
					$cie=$fila["edad"];
					$eps=$fila["nom_eps"];
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
