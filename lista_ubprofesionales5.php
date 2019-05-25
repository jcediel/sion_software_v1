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
			case 'INTER':
				$idord=$_POST['idord'];
				$sql="UPDATE ord_med_hosp SET freg_inter='".$_POST["freg"]."',interpretacion='".$_POST["interpretacion"]."',freg_inter='".$_POST["nom_ips"]."',estado_ord_med_hosp='Interpretado' WHERE id_ord_med_hosp=".$_POST['idord'];
				$subtitulo="Interpretacion";
				$sub2='agregada';
			break;
			case 'X':
				$sql="SELECT logo from eps where id_eps=".$_POST["ideps"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="DELETE FROM eps WHERE id_eps=".$_POST["ideps"];
				$subtitulo="Eliminado";
			break;
			case 'A':
				$sql="INSERT INTO zonificacion (id_user, id_barrio) VALUES
				('".$_POST["iduserzona"]."','".$_POST["zonificacion"]."')";
				$subtitulo="Zona de acción";
				$sub2='agregada';
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="La $subtitulo fue $sub2 con exito!";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="La $subtitulo  NO fue $sub2 con exito!!!!!!!!!!!!!";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'INTER':
		$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
		b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
		j.nom_eps,
		k.id_sedes_ips,nom_sedes,
		h.id_ordmedhosp, id_adm_hosp, id_user, freg_ordmedhosp, hreg_ordmedhosp, servicio, dx, estado_ordmedhosp
		from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
								inner join eps j on (j.id_eps=b.id_eps)
								inner join sedes_ips k on (k.id_sedes_ips=b.id_sedes_ips)
								left join ordenmed_hospitalario h on (h.id_adm_hosp=b.id_adm_hosp)
		where b.id_adm_hosp ='".$_GET["idadmhosp"]."' and h.id_ordmedhosp='".$_GET["idordhosp"]."'" ;
			$color="green";
			$boton="Agregar Interpretacion";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$form1='formularios/add_interpretacion.php';
			$subtitulo='Interpretacion de ayudas diagnosticas';
			break;

			case 'A':
			$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
      b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
      j.nom_eps,
			k.id_sedes_ips,nom_sedes
      from pacientes a inner join adm_hospitalario b on a.id_paciente=b.id_paciente
                  inner join eps j on (j.id_eps=b.id_eps)
									inner join sedes_ips k on (k.id_sedes_ips=b.id_sedes_ips)

      where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$color="yellow";
			$boton="Adicionar Zona de acción";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
      $return=144;
			$return2=$_REQUEST['iduser'];
			$form1='formulariosDOM/add_zona.php';
			$subtitulo='Asignación de zona de acción';
			break;
		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_eps"=>"","nom_eps"=>"","doc_eps"=>"","tel_eps"=>"","dir_eps"=>"","cod_eps"=>"","logo"=>"","estado_eps"=>"" );

			}
		}else{
				$fila=array("id_eps"=>"","nom_eps"=>"","doc_eps"=>"","tel_eps"=>"","dir_eps"=>"","cod_eps"=>"","logo"=>"","estado_eps"=>"" );
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nom_eps.value == ""){
					alert("Se requiere el nombre de la EPS!");
					document.forms[0].nom_EPS.focus();				// Ubicar el cursor
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
	<section class="panel-heading"><h4>Listado de zonas asignadas al profesional</h4></section>
<div class="panel-body">
<table class="table table-responsive table-bordered">
	<tr>
		<th id="th-estilo2">ID</th>
		<th id="th-estilo2">ZONA DE ACCIÓN</th>
		<th id="th-estilo4">ACCIONES</th>
	</tr>

	<?php
	$iduser=$_REQUEST['iduser'];
	$sql="SELECT a.id_zoni,b.nom_barrio FROM zonificacion a inner join barrio b on a.id_barrio=b.id_barrio WHERE a.id_user =".$iduser;
	//echo $sql;
if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {

			echo"<tr>\n";
			echo'<td class="text-right alert-info">'.$fila["id_zoni"].'</td>';
			echo'<td class="text-left alert-info">'.$fila["nom_barrio"].'</td>';
			echo'<th class="text-center alert-info"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=X&idzona='.$fila["id_zona"].'&idadmhosp='.$idadmhosp.'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span></button></a></th>';
			echo "</tr>\n";
	}
}
	?>
	<tr>
		<th colspan="11" class="text-center"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&servicio='.$servicio.'&mante=A&iduser='.$iduser?>" align="center" ><button type="button" class="btn btn-primary" >Adicionar Zona</button>
		</a></th>
	<tr>
</table>
</div>
</div>
	<?php
}
?>
