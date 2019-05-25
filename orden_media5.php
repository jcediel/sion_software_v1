<h1 class="fuente_titulo text-center">Ordenes Medicas</h1>
<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);
			$fotoE="";$fotoA1="";$fotoA2="";
			if (isset($_FILES["logo"])){
				if (is_uploaded_file($_FILES["logo"]["tmp_name"])){

					$cfoto=explode(".",$_FILES["logo"]["name"]);
					$archivo=$_POST["doc_ips"].".".$cfoto[count($cfoto)-1];

					if(move_uploaded_file($_FILES["logo"]["tmp_name"],LOG.LOGOS.$archivo)){
						$fotoE=",logo='".LOGOS.$archivo."'";
						$fotoA1=",logoips";
						$fotoA2=",'".LOGOS.$archivo."'";
						}
				}
			}

			switch ($_POST["operacion"]) {
			case 'E':
			$sql="INSERT INTO ord_med_ambu (id_adm_hosp, id_user, freg_ord_med_ambu, hreg_ord_med_ambu, ts_ord_med_ambu, procedimiento, procedimiento1, procedimiento2, procedimiento3, procedimiento4, procedimiento5, procedimiento6, procedimiento7, estado_ord_med_ambu, obs_proc, obs_proc1, obs_proc2, obs_proc3, obs_proc4, obs_proc5, obs_proc6, obs_proc7 ) VALUES
			('".$_POST["idadmhosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["freg"]."','".$_POST["hreg"]."','".$_POST["tiposervicio"]."','".$_POST["cups"]."','".$_POST["cups1"]."','".$_POST["cups2"]."','".$_POST["cups3"]."','".$_POST["cups4"]."','".$_POST["cups5"]."','".$_POST["cups6"]."','".$_POST["cups7"]."','Realizada','".$_POST["obs_proc"]."','".$_POST["obs_proc1"]."','".$_POST["obs_proc2"]."','".$_POST["obs_proc3"]."','".$_POST["obs_proc4"]."','".$_POST["obs_proc5"]."','".$_POST["obs_proc6"]."','".$_POST["obs_proc7"]."')";
			$subtitulo="Generada";
			break;
			case 'X':
				$sql="SELECT logoips from ips where id_ips=".$_POST["idips"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="DELETE FROM ips WHERE id_ips=".$_POST["idips"];
				$subtitulo="Eliminado";
			break;
			
	//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="La Orden Medica del paciente fue $subtitulo con EXITO!";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logoips"])){
				unlink($fila["logoips"]);
			}
			}
		}else{
			$subtitulo="La Orden Medica del paciente NO fue $subtitulo !!! .";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'E':
			$sql="SELECT p.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,a.id_adm_hosp,fingreso_hosp,hingreso_hosp FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente WHERE a.id_adm_hosp=".$_GET["idadmhosp"];
			$color="green";
			$boton="Generar ordenens medicas";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3=' disabled="disabled"';
			$subtitulo='Generación de Ordenes medicas';
			$date=date('Y-m-d');
			$date1=date('H:i');
			break;
			case 'X':
			$sql="SELECT id_ips,nom_ips,doc_ips,tel_ips,dir_ips,logoips,estado_ips FROM  ips where id_ips=".$_GET["idips"];
			$color="red";
			$boton="Eliminar";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
			$subtitulo='Confirmación para eliminar de datos de IPS';
			break;
			case 'A':
			$sql="";
			$color="yellow";
			$boton="Crear";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Creación de IPS';
			break;
		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"");
			}

		?>

<form action="<?php echo PROGRAMA.'?opcion=83';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section>
		<marquee class="fuente1 banermarquee">
			<?php echo $subtitulo;?>
		</marquee>
	</section>
	<section class="panel panel-default">
	<section class="panel-body">
		<article class="col-xs-3">
			<label for="">Fecha Registro:</label>
			<input type="text" name="freg" class="form-control" value="<?php echo date('Y-m-d');?>" <?php echo $atributo1; ?>>
			<input type="hidden" name="idadmhosp" class="form-control" value="<?php echo $_GET["idadmhosp"];?>" <?php echo $atributo1;?>/>
		</article>
		<article class="col-xs-3">
			<label for="">Hora Registro:</label>
			<input type="text" name="hreg" class="form-control" value="<?php echo date('H:m');?>" <?php echo $atributo1; ?>>
		</article>
		<article class="col-xs-3">
			<label for="">Tipo de servicio:</label>
			<input type="text" name="tiposervicio" class="form-control" value="Ambulatoria" <?php echo $atributo1; ?>>
		</article>
	</section>
	<section class='panel-body'>
		<article class="col-xs-12">
			<?php include("cupsbusqueda.php");?>
		</article>
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
<div class="panel-body">
	<table class="table table-responsive">
		<tr>

			<th id="th-estilo1">ID ADM</th>
			<th id="th-estilo1">NOMBRE Y APELLIDOS</th>
			<th id="th-estilo2">HC  </th>
			<th id="th-estilo1">FECHA Y HORA INGRESO</th>
			<th id="th-estilo2">FOTO</th>
			<th id="th-estilo4">Generar orden medica</th>
		</tr>
		<?php
		if (isset($_REQUEST["idadmhosp"])){
		$idpaciente=$_GET["idadmhosp"];
		$sql="SELECT p.nom1,nom2,ape1,ape2,fotopac,a.id_adm_hosp,fingreso_hosp,hingreso_hosp,h.id_hchosp FROM pacientes p LEFT JOIN adm_hospitalario a on p.id_paciente=a.id_paciente LEFT JOIN hc_hospitalario h on a.id_adm_hosp=h.id_adm_hosp WHERE a.id_adm_hosp='".$idpaciente."' and a.tipo_servicio='Hospitalario'";
		if ($tabla=$bd1->sub_tuplas($sql)){
			//echo $sql;
			foreach ($tabla as $fila ) {
				echo"<tr >\n";

				echo'<td class="text-center info">'.$fila["id_adm_hosp"].'</td>';
				echo'<td class="text-center info">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
				echo'<td class="text-center info">'.$fila["id_hchosp"].'</td>';
				echo'<td class="text-center info">'.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</td>';
				echo'<td class="text-left info"><img src="'.$fila["fotopac"].'"alt ="foto" class="image_login"> </td>';
				echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idhc='.$fila["id_hchosp"].'&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-square-o"></span></button></a></th>';
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
