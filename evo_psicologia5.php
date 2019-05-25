
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
				$sql="INSERT INTO evo_psicologia (id_adm_hosp,id_user,freg_evo_psico,hreg_evo_psico,tipo_sesion,obj_sesion,actividades,resultado,obs_evo_psico,estado_evo_psico,resp_evo_psico) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["tsesion"]."','".$_POST["objsesion"]."','".$_POST["actividades"]."','".$_POST["resultado"]."','".$_POST["obsevopsico"]."','Realizada','".$_SESSION["AUT"]["nombre"]."')";
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
			$color="yellow";
			$boton="Crear";
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
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"","zona_residencia"=>"","nivel"=>"","tipo_servicio"=>"","resp_admhosp"=>"","descripestadoc"=>"","descriafiliado"=>"","descritusuario"=>"","descriocu"=>"", "descripdep"=>"", "descrimuni"=>"", "descripuedad"=>"", "nom_eps"=>"");$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","lateralidad"=>"","profesion"=>"","religion"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"","zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");

			}
		}else{
			$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"","zona_residencia"=>"","nivel"=>"","tipo_servicio"=>"","resp_admhosp"=>"","descripestadoc"=>"","descriafiliado"=>"","descritusuario"=>"","descriocu"=>"", "descripdep"=>"", "descrimuni"=>"", "descripuedad"=>"", "nom_eps"=>"");$fila=array("id_paciente"=>"","tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","fotopac"=>"","estadocivil"=>"","lateralidad"=>"","profesion"=>"","religion"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","tipo_usuario"=>"","tipo_afiliacion"=>"","ocupacion"=>"","dep_residencia"=>"","mun_residencia"=>"","zona_residencia"=>"","nivel"=>"","via_ingreso"=>"");

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
<form action="<?php echo PROGRAMA;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
<section class="panel-body">
	<?php
		include("consulta_paciente.php");
	?>
</section>

	<article>
		<h4 id="th-estilot">Datos de Evolución Psicología</h4>
		<?php include("consulta_rapida.php");?>
	<section class="panel-body"> <!--Anamnesis-->

		<section >
			<article class="col-xs-3">
				<label for="">Fecha de registro:</label>
				<input type="text" name="freg" value="<?php echo $date;?>" class="form-control" <?php echo $atributo1?> >
			</article>
			<article class="col-xs-3">
				<label for="">Hora de registro</label>
				<input type="text" name="hreg" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo1?>>
			</article>
			<br>
			<article class="col-xs-10">
				<label for="">Tipo de sesión: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
				<select class="form-control" name="tsesion">
					<option value="Valoracion">Valoración</option>
					<option value="psicoterapia">Psicoterapia</option>
				</select>
			</article>
			<article class="col-xs-10">
				<label >Objetivo de la sesión: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
				<textarea class="form-control" name="objsesion" rows="6" id="comment" required=""></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">Actividades: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
				<textarea class="form-control" name="actividades" rows="6" id="comment" required=""></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">Resultado de la sesión: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
				<textarea class="form-control" name="resultado" rows="6" id="comment" required=""></textarea>
			</article>
			<article class="col-xs-10">
				<label for="">Observaciones: <span class="fa fa-info-circle" data-toggle="popover" title="" data-content=""></span></label>
				<textarea class="form-control" name="obsevopsico" rows="6" id="comment" required=""></textarea>
			</article>
		</section>
</section>

	<div class="row text-center">
	  	<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="hidden" class="btn btn-primary" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
		<input type="hidden" class="btn btn-primary" name="operacion" Value="<?php echo $_GET["mante"];?>"/>
	</div>
  </section>
</form>
<?php
}else{
	echo '<div class="alert alert-success animated bounceInRight">';
	echo $subtitulo;
	echo '</div>';
// nivel 1?>
<div class="panel panel-default">
<div class="panel-body">

<table class="table table-bordered">
	<tr>
		<th colspan="2" id="th-estilo4">Ayudas DX</th>
		<th id="th-estilo1">ID</th>
		<th id="th-estilo1">IDENTIFICACIÓN</th>
		<th id="th-estilo2">NOMBRES Y APELLIDOS</th>
		<th id="th-estilo3">FOTO</th>
		<th id="th-estilo4">Evolución psicologia</th>
	</tr>
	<?php
	if (isset($_REQUEST["idadmhosp"])){
	$codadm=$_REQUEST["idadmhosp"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,s.nom_sedes FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips  WHERE a.id_adm_hosp=".$codadm;

	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {

			echo"<tr >\n";
			echo'<th class="text-left" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=X&idpac='.$fila["id_paciente"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-flask"></span></button></a></th>';
			echo'<th class="text-left" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=X&idpac='.$fila["id_paciente"].'"><button type="button" class="btn btn-primary" ><span class="fa fa-tint"></span></button></a></th>';
			echo'<td class="text-center">'.$fila["id_paciente"].'</td>';
			echo'<td class="text-center">'.$fila["tdoc_pac"].': '.$fila["doc_pac"].'</td>';
			echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
			echo'<td class="text-center"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login cursor1" data-toggle="modal" data-target="#modalpac"> </td>';
			echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
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
