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

			case 'A':
				$sql="INSERT INTO autorizacion_hosp (id_adm_hosp, finicial, ffinal, num_autorizacion, clase_usuario,zeps, codx_autorizacion, dx_autorizacion, estado_autorizacion) VALUES
				('".$_POST["idadmhosp"]."','".$_POST["finicial"]."','".$_POST["ffinal"]."','".$_POST["numautori"]."','".$_POST["cusuario"]."','".$_POST["zeps"]."','".$_POST["cdxp"]."','".$_POST["descridxp"]."','Realizada')";
				$subtitulo="Adicionado";
			break;
			case 'E':
				$sql="INSERT INTO hc_hospitalario (id_adm_hosp,freg_hchosp,hreg_hchosp,motivo_consulta,enfer_actual,his_personal,his_familiar,perso_premorbida,ant_personales,ant_patologico,ant_quirurgico,ant_toxicologico,ant_farmaco,ant_gineco,ant_psiquiatrico,ant_hospitalario,ant_traumatologico,ant_familiar,otros_ant,estado_general,ta,fr,fc,so,peso,talla,temperatura,imc,cabcuello,torax,ext_superiores,ext_inferiores,abdomen,neurologico,cardiopulmunar,genitourinario,examen_mental,analisis,finalidad,causa_externa,plantratamiento,Resp_hchosp,especialidad,estado_hchosp) VALUES
				('".$_POST["idadmhosp"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["motivoconsulta"]."','".$_POST["enferactual"]."','".$_POST["hpersonal"]."','".$_POST["hfamiliar"]."','".$_POST["ppremorbida"]."','".$_POST["antpersonal"]."','".$_POST["antpatologico"]."','".$_POST["antquirurgico"]."','".$_POST["anttoxicologicos"]."','".$_POST["antfarmacologico"]."','".$_POST["antgineco"]."','".$_POST["antpsiquiatrico"]."','".$_POST["anthospitalario"]."','".$_POST["anttrauma"]."','".$_POST["antfami"]."','".$_POST["antotros"]."','".$_POST["estadogen"]."','".$_POST["ta"]."','".$_POST["fr"]."','".$_POST["fc"]."','".$_POST["sao2"]."','".$_POST["peso"]."','".$_POST["talla"]."','".$_POST["temperatura"]."','".$_POST["imc"]."','".$_POST["cabezacuello"]."','".$_POST["torax"]."','".$_POST["extsup"]."','".$_POST["extinfe"]."','".$_POST["abdomen"]."','".$_POST["neurologico"]."','".$_POST["cardiopulmonar"]."','".$_POST["genitourinario"]."','".$_POST["exmental"]."','".$_POST["analisis"]."','".$_POST["finconsulta"]."','".$_POST["causaexterna"]."','".$_POST["plant"]."','".$_SESSION["AUT"]["nombre"]."','".$_SESSION["AUT"]["especialidad"]."','Realizada')";
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
		case 'A':
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,estadocivil,edad,lateralidad,profesion,religion,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_usuario,tipo_afiliacion,ocupacion,dep_residencia,mun_residencia,zona_residencia,nivel,via_ingreso,s.nom_sedes FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips  WHERE a.id_adm_hosp=".$_GET["idadmhosp"];			$color="green";
			$boton="Crear Autorización";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$form1='formularios/creaautoriext_reh.php';
			$subtitulo='Creación de autorización externa';
			break;
			case 'E':
			$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,estadocivil,edad,lateralidad,profesion,religion,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,tipo_usuario,tipo_afiliacion,ocupacion,dep_residencia,mun_residencia,zona_residencia,nivel,via_ingreso,s.nom_sedes FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips  WHERE a.id_adm_hosp=".$_GET["idadmhosp"];			$boton="Actualizar";
			$boton="Generació Detalle";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$form1='formularios/detalleautoriext_reh.php';
			$subtitulo='Generación detalles autorización Externa';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","lateralidad"=>"","profesion"=>"","religion"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"","zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");
			}
		}else{
				$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","lateralidad"=>"","profesion"=>"","religion"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"","zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");
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
		<?php include($form1);?>

<?php
}else{
	echo $subtitulo;
// nivel 1?>
<div class="panel panel-default">
<div class="panel-body">

<table class="table table-responsive">
	<tr>

		<th id="th-estilo2">IDENTIFICACIÓN</th>
		<th id="th-estilo2">NOMBRES Y APELLIDOS</th>
		<th id="th-estilo3">ID ADMISION</th>
		<th id="th-estilo1">TIPO TERAPIA</th>
		<th id="th-estilo2">ID EVOLUCION</th>
		<th id="th-estilo2">FECHA EVOLUCION</th>
		<th id="th-estilo3">EVOLUCION</th>


	</tr>

	<?php


	$sql="select    a.doc_pac,

        a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2 paciente,

        b.id_adm_hosp                                                        id_adm_hosp,

        b.fingreso_hosp                                                       fecha_ingreso,

        b.fegreso_hosp                                                        fecha_egreso,

        'FISIO'                                                                                           tipo_terapia,

        e.id_evofisio_reh                                    id,

                                e.freg_evofisio_reh                       fecha_evo,

        e.evolucionfisio_reh                              evolucion,

        e.id_user                                                                     id_user,

        f.nombre                                                                     nombre_usuario

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)

                                inner join evo_fisio_reh e on (e.id_adm_hosp = b.id_adm_hosp)

                    inner join user f on (f.id_user = e.id_user)

where

                b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo'

union

select    a.doc_pac,

        a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2 paciente,

        b.id_adm_hosp                                                        id_adm_hosp,

        b.fingreso_hosp                                                       fecha_ingreso,

        b.fegreso_hosp                                                        fecha_egreso,

        'FONO'                                                                                          tipo_terapia,

        f.id_evofono_reh                                    id,

                                f.freg_evofono_reh                       fecha_evo,

        f.evolucionfono_reh                                              evolucion,

        f.id_user                                                                      id_user,

        g.nombre                                                                    nombre_usuario

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)

                                inner join evo_fono_reh f on (f.id_adm_hosp = b.id_adm_hosp)

                    inner join user g on (g.id_user = f.id_user)

where

                b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo'

union

select    a.doc_pac,

        a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2 paciente,

        b.id_adm_hosp                                                        id_adm_hosp,

        b.fingreso_hosp                                                       fecha_ingreso,

        b.fegreso_hosp                                                        fecha_egreso,

        'OCUPA'                                                                                       tipo_terapia,

        g.id_evoto_reh                                                        id,

                                g.freg_evoto_reh                                            fecha_evo,

        g.evolucionto_reh                                   evolucion,

        g.id_user                                                                     id_user,

        h.nombre                                                                    nombre_usuario

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)

                                inner join evo_to_reh g on (g.id_adm_hosp = b.id_adm_hosp)

                    inner join user h on (h.id_user = g.id_user)

where

                b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo'

union

select    a.doc_pac,

        a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2 paciente,

        b.id_adm_hosp                                                        id_adm_hosp,

        b.fingreso_hosp                                                       fecha_ingreso,

        b.fegreso_hosp                                                        fecha_egreso,

        'PSICO'                                                                                          tipo_terapia,

        h.id_evopsico                                                            id,

                                h.freg_evopsico_reh                     fecha_evo,

        h.evolucionpsico_reh                            evolucion,

        h.id_user                                                                     id_user,

        i.nombre                                                                     nombre_usuario

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)

                                                                                inner join evo_psico_reh h on (h.id_adm_hosp = b.id_adm_hosp)

                    inner join user i on (i.id_user = h.id_user)

where

                b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo'

union

select    a.doc_pac,

        a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2 paciente,

        b.id_adm_hosp                                                        id_adm_hosp,

        b.fingreso_hosp                                                       fecha_ingreso,

        b.fegreso_hosp                                                        fecha_egreso,

        'HIDRO'                                                                                         tipo_terapia,

        i.id_evohidro_reh                                                   id,

                                i.freg_evohidro_reh                       fecha_evo,

        i.evolucionhidro_reh                              evolucion,

        i.id_user                                                                      id_user,

        j.nombre                                                                     nombre_usuario

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)

                                                                                inner join evo_hidro_reh i on (i.id_adm_hosp = b.id_adm_hosp)

                    inner join user j on (j.id_user = i.id_user)

where

                b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo'

union

select    a.doc_pac,

        a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2 paciente,

        b.id_adm_hosp                                                        id_adm_hosp,

        b.fingreso_hosp                                                       fecha_ingreso,

        b.fegreso_hosp                                                        fecha_egreso,

        'TAP'                                                                                              tipo_terapia,

        j.id_evotap_reh                                                       id,

                                j.freg_evotap_reh                          fecha_evo,

        j.evoluciontap_reh                                 evolucion,

        j.id_user                                                                      id_user,

        k.nombre                                                                    nombre_usuario

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)



                                                                                inner join evo_tap_reh j on (j.id_adm_hosp = b.id_adm_hosp)

                    inner join user k on (k.id_user = j.id_user)

where

                b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo'

union

select    a.doc_pac,

        a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2 paciente,

        b.id_adm_hosp                                                        id_adm_hosp,

        b.fingreso_hosp                                                       fecha_ingreso,

        b.fegreso_hosp                                                        fecha_egreso,

        'MUSICO'                                                                     tipo_terapia,

        k.id_evomusico_reh                                                              id,

                                k.freg_evomusico_reh                                  fecha_evo,

        k.evolucionmusico_reh                         evolucion,

        k.id_user                                                                     id_user,

        l.nombre                                                                     nombre_usuario

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)

                                                                                inner join evo_musico_reh k on (k.id_adm_hosp = b.id_adm_hosp)

                    inner join user l on (l.id_user = k.id_user)

where

                b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo'

union

select    a.doc_pac,

        a.nom1,' ',a.nom2,' ',a.ape1,' ',a.ape2 paciente,

        b.id_adm_hosp                                                        id_adm_hosp,

        b.fingreso_hosp                                                       fecha_ingreso,

        b.fegreso_hosp                                                        fecha_egreso,

        'EQUINO'                                                                     tipo_terapia,

        l.id_evoequino_reh                                                                id,

                                l.freg_evoequino_reh                   fecha_evo,

        l.evolucionequino_reh          evolucion,

        l.id_user                                                                      id_user,

        m.nombre                                                                  nombre_usuario

from      pacientes a inner join adm_hospitalario b on (b.id_paciente = a.id_paciente)

                                                                                inner join evo_equino_reh l on (l.id_adm_hosp = b.id_adm_hosp)

                    inner join user m on (m.id_user = l.id_user)

where

                b.tipo_servicio = 'Rehabilitacion'

and b.estado_adm_hosp = 'Activo'

order by 1,12,14


 ";

	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {

				echo"<tr >\n";

				echo'<td class="text-center alert-success">'.$fila["doc_pac"].'</td>';
				echo'<td class="text-center alert-success">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
				echo'<td class="text-center alert-success">'.$fila["id_adm_hosp"].'</td>';
				echo'<td class="text-center alert-success">'.$fila["tipo_terapia"].'</td>';
				echo'<td class="text-center alert-success">'.$fila["id"].'</td>';
				echo'<td class="text-center alert-success">'.$fila["fecha_evo"].' </td>';
				echo'<td class="text-center alert-success">'.$fila["evolucion"].'</td>';
				echo "</tr>\n";
		


		}
	}


	?>

</table>
</div>
</div>
	<?php
}
?>
