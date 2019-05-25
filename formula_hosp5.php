
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
				$sql="";
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
				$sql="INSERT INTO evolucion_medica (id_adm_hosp,id_user,freg_evomed,hreg_evomed,objetivo,subjetivo,analisis_evomed,plan_tratamiento,remision_sintomas,conciencia_enfermedad,adherencia_terapeutica,dxp,ddxp,tdxp,dx1,ddx1,tdx1,dx2,ddx2,tdx2,resp_evomed,estado_evomed) VALUES
				('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["objetivo"]."','".$_POST["subjetivo"]."','".$_POST["analisis"]."','".$_POST["plantratamiento"]."','".$_POST["remision_sintomas"]."','".$_POST["conciencia_enfermedad"]."','".$_POST["adherencia_terapeutica"]."','".$_POST["cdxp"]."','".$_POST["descridxp"]."','".$_POST["tdxp"]."','".$_POST["cdx1"]."','".$_POST["descridx1"]."','".$_POST["tdx1"]."','".$_POST["cdx2"]."','".$_POST["descridx2"]."','".$_POST["tdx2"]."','".$_SESSION["AUT"]["nombre"]."','Realizada')";
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
			$subtitulo='Creacion de formula';
			break;
			case 'A':
			$sql="" ;
			$color="yellow";
			$boton="Agregar Formula";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='disabled';
			$date=date('Y/m/d');
			$date1=date('H:i');
			$form1='formularios/ordenverbal.php';
			$subtitulo='Creacion de formula';
			break;
		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"","zona_residencia"=>"","nivel"=>"","tipo_servicio"=>"","resp_admhosp"=>"","descripestadoc"=>"","descriafiliado"=>"","descritusuario"=>"","descriocu"=>"", "descripdep"=>"", "descrimuni"=>"", "descripuedad"=>"", "nom_eps"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"","dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"","zona_residencia"=>"","nivel"=>"","tipo_servicio"=>"","resp_admhosp"=>"","descripestadoc"=>"","descriafiliado"=>"","descritusuario"=>"","descriocu"=>"", "descripdep"=>"", "descrimuni"=>"", "descripuedad"=>"", "nom_eps"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
<?php include($form1);?>
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

		<th id="th-estilo1">ID</th>
		<th id="th-estilo1">Paciente</th>
		<th id="th-estilo2">Bodega</th>
		<th id="th-estilo3">Tipo de formula</th>
		<th id="th-estilo4">Fecha inicial</th>
		<th id="th-estilo4">Fecha final</th>
		<th id="th-estilo4">Accion</th>
	</tr>
	<?php
	if (isset($_REQUEST["idadmhosp"])){
	$codadm=$_REQUEST["idadmhosp"];
	$sql="SELECT p.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,s.id_bodega,nom_sedes,b.nom_bodega,f.id_formula_hosp,tipo_formula,finicial,ffinal,estado_formula_hosp FROM pacientes p INNER JOIN adm_hospitalario a on p.id_paciente=a.id_paciente INNER JOIN sedes_ips s on a.id_sedes_ips=s.id_sedes_ips INNER JOIN bodega b on b.id_sedes_ips=s.id_sedes_ips INNER JOIN formula_hospitalaria f on f.id_adm_hosp=a.id_adm_hosp  WHERE a.id_adm_hosp=".$codadm;
	echo $sql;
	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {

			echo"<tr >\n";
			echo'<td class="text-center">'.$fila["id_adm_hosp"].'</td>';
			echo'<td class="text-center">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
			echo'<td class="text-center">'.$fila["nom_bodega"].'</td>';
			echo'<td class="text-center">'.$fila["tipo_formula"].'</td>';
			echo'<td class="text-center">'.$fila["finicial"].'</td>';
			echo'<td class="text-center">'.$fila["ffinal"].'</td>';
			echo'<td class="text-center hidden">'.$fila["id_bodega"].'</td>';
			echo'<td class="text-center hidden">'.$fila["id_formula_hosp"].'</td>';
			echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span></button></a></th>';
					echo "</tr>\n";
		}
	}
	}

	?>
	<tr>
		<th colspan="14" class="text-center"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idadmhosp'.$fila["id_adm_hosp"].';?>"><button type="button" class="btn btn-primary" >Nuevo Formula</button>
		</a></th>
	</tr>
	</table>
	</div>
	</div>
	<?php
	}
	?>
