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
				case 'CAMBIOP':
					$presentacion=$_REQUEST['idpresentacion'];
					$pac=$_REQUEST['idpac'];
					$doc=$_POST['docpac'];
					$hora=date('H:m');
					$sql="UPDATE presentacion_dom SET estado_presentacion='".$_POST["estprod"]."',obs_respuesta='".$_POST["obs_pprocedimiento"]."',haceptacion='$hora' WHERE id_presentacion_dom=".$_POST['idpresentacion'];
					$subtitulo="Estado del procedimiento en:";
					$sub2=$_POST['estado_presentacion'];
					$sub3='<a href="'.PROGRAMA.'?placa='.$doc.'&buscar=Consultar&opcion=138"><button type="button" class="btn btn-primary" ><span class="fa fa-arrow-left"></span> Regresar a Presentación</button></a>';

				break;
			case 'CAMBIO':
				$presentacion=$_REQUEST['idpresentacion'];
				$pac=$_REQUEST['idpac'];
				$sql="UPDATE pprocedimiento SET estado_prod='".$_POST["estprod"]."',obs_pprocedimiento='".$_POST["obs_pprocedimiento"]."' WHERE id_pprocedimiento=".$_POST['idproced'];
				$subtitulo="Estado del procedimiento en:";
				$sub2=$_POST['estado_presentacion'];
				$sub3='<a href="'.PROGRAMA.'?opcion=142&idpresentacion='.$idpresentacion.'&idpac='.$pac.'"><button type="button" class="btn btn-primary" ><span class="fa fa-arrow-left"></span> Regresar a Presentación</button></a>';
			break;
			case 'X':
				$sql="SELECT logo from eps where id_eps=".$_POST["ideps"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="DELETE FROM eps WHERE id_eps=".$_POST["ideps"];
				$subtitulo="Eliminado";
			break;
			case 'E':
				$presentacion=$_REQUEST['idpresentacion'];
				$pac=$_REQUEST['idpac'];
				$sql="UPDATE pprofesional SET id_pprocedimiento='".$_POST["proc"]."', id_user='".$_POST["id_user"]."', finicial='".$_POST["finicial"]."', ffinal='".$_POST["ffinal"]."', notificacion='".$_POST["notificacion"]."' WHERE id_pprocedimiento='".$_POST["proc"]."' ";
				$subtitulo="Profesional";
				$sub2='Actualizado';
				$sub3='<a href="'.PROGRAMA.'?opcion=142&idpresentacion='.$presentacion.'&idpac='.$pac.'"><button type="button" class="btn btn-primary" ><span class="fa fa-arrow-left"></span> Regresar a selección de procedimientos</button></a>';
			break;
			case 'A':
				$presentacion=$_REQUEST['idpresentacion'];
				$pac=$_REQUEST['idpac'];
				$sql="INSERT INTO pprofesional (id_pprocedimiento, id_user, finicial, ffinal, notificacion) VALUES
				('".$_POST["proc"]."','".$_POST["id_user"]."','".$_POST["finicial"]."','".$_POST["ffinal"]."','".$_POST["notificacion"]."')";
				$subtitulo="Profesional";
				$sub2='agregado';
				$sub3='<a href="'.PROGRAMA.'?opcion=142&idpresentacion='.$presentacion.'&idpac='.$pac.'"><button type="button" class="btn btn-primary" ><span class="fa fa-arrow-left"></span> Regresar a selección de procedimientos</button></a>';
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo $sub2. Actualizado con exito! $sub3";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="$subtitulo $sub2 ";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'CAMBIOP':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,zonificacion,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps,
			k.id_sedes_ips,nom_sedes,
			l.nom_barrio
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
									left join sedes_ips k on (k.id_sedes_ips=b.id_sedes_ips)
									inner join barrio l on (l.id_barrio=a.zonificacion)

      where a.id_paciente ='".$_REQUEST['idpac']."'";
			$boton="Aceptar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$return=138;
			$return2=$_REQUEST['idpresentacion'];
			$return3=$_REQUEST['idpac'];
			$return4=$_REQUEST['idpprod'];
			$form1='formulariosDOM/upt_estado_presentacion.php';
			$subtitulo='Aceptación del paciente en el servicio domiciliario';
		break;
		case 'CAMBIO':
			$sql="";
			$boton="Aceptar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$return=143;
			$return2=$_REQUEST['idpresentacion'];
			$return3=$_REQUEST['idpac'];
			$return4=$_REQUEST['idpprod'];
			$form1='formulariosDOM/upt_estado_procedimiento.php';
			$subtitulo='Fase de procedimientos Presentación servicios domiciliarios';
			break;
			case 'E':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,zonificacion,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps,
			k.id_sedes_ips,nom_sedes,
			l.nom_barrio,
			m.id_presentacion_dom
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
									left join sedes_ips k on (k.id_sedes_ips=b.id_sedes_ips)
									inner join barrio l on (l.id_barrio=a.zonificacion)
									inner join presentacion_dom m on (m.id_paciente=a.id_paciente)

      where a.id_paciente ='".$_REQUEST['idpac']."' and m.estado_presentacion='Presentado'";
			//echo $sql;
			$color="yellow";
			$boton="Editar Profesional";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$return=143;
			$return2=$_REQUEST['idpresentacion'];
			$return3=$_REQUEST['idpac'];
			$form1='formulariosDOM/add_profesional.php';
			$subtitulo='Opciones de profesionales en la zona';
			break;
			case 'A':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,zonificacion,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps,
			k.id_sedes_ips,nom_sedes,
			l.nom_barrio,
			m.id_presentacion_dom
      from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
                  left join eps j on (j.id_eps=b.id_eps)
									left join sedes_ips k on (k.id_sedes_ips=b.id_sedes_ips)
									inner join barrio l on (l.id_barrio=a.zonificacion)
									inner join presentacion_dom m on (m.id_paciente=a.id_paciente)

      where a.id_paciente ='".$_REQUEST['idpac']."' ";
			//echo $sql;
			$color="yellow";
			$boton="Adicionar Profesional";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$return=143;
			$return2=$_REQUEST['idpresentacion'];
			$return3=$_REQUEST['idpac'];
			$form1='formulariosDOM/add_profesional.php';
			$subtitulo='Opciones de profesionales en la zona';
			break;
		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_eps"=>"", "tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","zonificacion"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"","nom_eps"=>"","id_sedes_ips"=>"","nom_sedes"=>"","nom_barrio"=>"");

			}
		}else{
				$fila=array("id_eps"=>"", "tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","zonificacion"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"","nom_eps"=>"","id_sedes_ips"=>"","nom_sedes"=>"","nom_barrio"=>"");
			}

		?>
		<script src = "js/sha3.js"></script>
				<script>
					function validar(){
						if (document.forms[0].ffinal.value < document.forms[0].finicial.value){
							alert("UPSSSSS. La fecha final no puede ser menor a la fecha inicial");
							document.forms[0].ffinal.focus();				// Ubicar el cursor
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
	<section class="panel-heading"><h4>Asignación de profesionales</h4></section>
<section class="panel-body">
	<table class="table table-responsive table-bordered">
		<tr>
			<th class="info text-center">ID</th>
			<th class="info text-center">PROCEDIMIENTO</th>
			<th class="info text-center">FRECUENCIA</th>
			<th class="info text-center">JORNADA</th>
			<th class="info text-center">CANTIDAD</th>
			<th class="info text-center">OBSERVACION</th>
			<th class="info text-center">ESTADO</th>
			<th class="info text-center">PROFESIONAL</th>
			<th class="info text-center">RANGO DE ATENCIÓN</th>
			<th class="info text-center"></th>
			<th class="info text-center"></th>

		</tr>

		<?php
		$presentacion=$_REQUEST['idpresentacion'];
		$sql="SELECT p.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,dir_pac,zonificacion,
								 h.id_presentacion_dom,a.id_pprocedimiento,cups,frecuencia,jornada,cantidad,obs_cups,estado_prod,
								 b.id_pprofesional,finicial,ffinal,
								 c.nombre,
								 d.descupsmin
					FROM pacientes p INNER JOIN presentacion_dom h on p.id_paciente=h.id_paciente
													 INNER JOIN pprocedimiento a on h.id_presentacion_dom=a.id_presentacion_dom
													 LEFT JOIN pprofesional b on a.id_pprocedimiento=b.id_pprocedimiento
													 LEFT JOIN user c on b.id_user=c.id_user
													 LEFT JOIN cups d on a.cups=d.codcups
					WHERE h.id_presentacion_dom='$presentacion' ";
					//echo $sql;
	if ($tabla=$bd1->sub_tuplas($sql)){
		foreach ($tabla as $fila ) {
			if ($fila['id_pprofesional']=='') {
				echo"<tr>\n";
				echo'<td class="text-right alert-danger">'.$fila["id_pprocedimiento"].'</td>';
				echo'<td class="text-left alert-danger">'.$fila["descupsmin"].'</td>';
				echo'<td class="text-left alert-danger">'.$fila["frecuencia"].'</td>';
				echo'<td class="text-left alert-danger">'.$fila["jornada"].'</td>';
				echo'<td class="text-left alert-danger">'.$fila["cantidad"].'</td>';
				echo'<td class="text-left alert-danger">'.$fila["obs_cups"].'</td>';
				if ($fila['estado_prod']=='') {
					echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CAMBIO&idpprod='.$fila["id_pprocedimiento"].'&idpac='.$_REQUEST["idpac"].'&idpresentacion='.$_REQUEST["idpresentacion"].'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-check"></span> Definir proceso</button></a></th>';
					echo'<td class="text-left alert-danger">SIN PROFESIONAL</td>';
					echo'<td class="text-left alert-danger">SIN PROFESIONAL</td>';
					echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idpprod='.$fila["id_pprocedimiento"].'&idpac='.$_REQUEST["idpac"].'&idpresentacion='.$_REQUEST["idpresentacion"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Asignar profesional</button></a></th>';
					echo'<th class="text-center alert-danger"><span class="fa fa-ban"></span></th>';
					echo "</tr>\n";
				}
				if ($fila['estado_prod']=='Asignada') {
					echo'<th class="text-center alert-danger">Asignada</th>';
					echo'<td class="text-left alert-danger">SIN PROFESIONAL</td>';
					echo'<td class="text-left alert-danger">SIN PROFESIONAL</td>';
					echo'<th class="text-center alert-danger"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idpprod='.$fila["id_pprocedimiento"].'&idpac='.$_REQUEST["idpac"].'&idpresentacion='.$_REQUEST["idpresentacion"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Asignar profesional</button></a></th>';
					echo'<th class="text-center alert-danger"><span class="fa fa-ban"></span></th>';
					echo "</tr>\n";
				}
				if ($fila['estado_prod']=='Cancelado'){
					echo'<td class="text-left alert-danger"><strong>'.$fila['estado_prod'].'</strong></td>';
					echo'<td class="text-left alert-danger">SIN PROFESIONAL</td>';
					echo'<td class="text-left alert-danger">SIN PROFESIONAL</td>';
					echo'<th class="text-center alert-danger"><span class="fa fa-ban"></span></th>';
					echo'<th class="text-center alert-danger"><span class="fa fa-ban"></span></th>';
					echo "</tr>\n";
				}

			}else {
				echo"<tr>\n";
				echo'<td class="text-right alert-warning">'.$fila["id_pprocedimiento"].'</td>';
				echo'<td class="text-left alert-warning">'.$fila["descupsmin"].'</td>';
				echo'<td class="text-left alert-warning">'.$fila["frecuencia"].'</td>';
				echo'<td class="text-left alert-warning">'.$fila["jornada"].'</td>';
				echo'<td class="text-left alert-warning">'.$fila["cantidad"].'</td>';
				echo'<td class="text-left alert-warning">'.$fila["obs_cups"].'</td>';
				if ($fila['estado_prod']=='') {
					echo'<th class="text-center alert-warning"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CAMBIO&idpprod='.$fila["id_pprocedimiento"].'&idpac='.$_REQUEST["idpac"].'&idpresentacion='.$_REQUEST["idpresentacion"].'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-check"></span> Definir proceso</button></a></th>';
					echo'<td class="text-left alert-warning">'.$fila["nombre"].'</td>';
					echo'<td class="text-left alert-warning">'.$fila["finicial"].' | '.$fila["ffinal"].'</td>';
					echo'<th class="text-center alert-warning"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idpprod='.$fila["id_pprocedimiento"].'&idpac='.$_REQUEST["idpac"].'&idpresentacion='.$_REQUEST["idpresentacion"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Asignar profesional</button></a></th>';
					echo'<th class="text-center alert-warning"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idpprod='.$fila["id_pprocedimiento"].'&idpac='.$_REQUEST["idpac"].'&idpresentacion='.$_REQUEST["idpresentacion"].'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-edit"></span> Editar profesional</button></a></th>';
					echo "</tr>\n";
				}
				if ($fila['estado_prod']=='Asignada') {
					echo'<th class="text-center alert-warning">Asignada</th>';
					echo'<td class="text-left alert-warning">'.$fila["nombre"].'</td>';
					echo'<td class="text-left alert-warning">'.$fila["finicial"].' | '.$fila["ffinal"].'</td>';
					echo'<th class="text-center alert-warning"><span class="fa fa-ban"></span></th>';
					echo'<th class="text-center alert-warning"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idpprod='.$fila["id_pprocedimiento"].'&idpac='.$_REQUEST["idpac"].'&idpresentacion='.$_REQUEST["idpresentacion"].'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-edit"></span> Editar profesional</button></a></th>';
					echo "</tr>\n";
				}
				if ($fila['estado_prod']=='Cancelado'){
					echo'<td class="text-left alert-danger"><strong>'.$fila['estado_prod'].'</strong></td>';
					echo'<td class="text-left alert-danger">'.$fila["nombre"].'</td>';
					echo'<td class="text-left alert-danger">'.$fila["finicial"].' | '.$fila["ffinal"].'</td>';
					echo'<th class="text-center alert-danger"><span class="fa fa-ban"></span></th>';
					echo "</tr>\n";
				}
			}
		}
	}

		?>
	</table>
	<div class="col-xs-12 text-center">
		<a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=CAMBIOP&idpresentacion='.$_REQUEST['idpresentacion'].'&idpac='.$_REQUEST['idpac'];?>"><button type="button" class="btn btn-danger btn-lg" >Aceptación o denegación de la presentación</button></a>
	</div>
</section>

</div>
	<?php
}
?>
