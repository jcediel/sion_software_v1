<?php
$subtitulo="";
	if(isset($_POST["operacion"])){	//nivel3
		if($_POST["aceptar"]!="Descartar"){
			//print_r($_FILES);

			switch ($_POST["operacion"]) {
			case 'E':
			$sql="UPDATE traslados
						SET fprog_recibido='".$_POST["fprog"]."', hprog_recibido='".$_POST["hprog"]."', destino='".$_POST["sedes"]."',
								obs_recibido='".$_POST["obs_recibido"]."', estado_traslado='Completado', resp_recibido='".$_SESSION["AUT"]["nombre"]."'
						WHERE id_traslado='".$_POST["id_traslado"]."'";
			$sql1="UPDATE adm_hospitalario SET id_sedes_ips='".$_POST["sedes"]."' WHERE id_adm_hosp='".$_POST["idadm"]."'";
			$subtitulo="Traslado interno de pacientes realizado";
			break;

		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="$subtitulo con exito!";
			$check='si';
				if ($bd1->consulta($sql1)) {
					$subtitulo="$subtitulo. OK!!!";
					$check='si';
				}
		}else{
			$subtitulo="$subtitulo";
		$check='no';
		}

	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {
		case 'E':
		$sql="SELECT a.tdoc_pac,a.doc_pac,nom1,nom2,ape1,ape2,edad,fnacimiento,dir_pac,tel_pac,rh,email_pac,genero,lateralidad,religion,fotopac,
		b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,
		j.nom_eps
		from pacientes a left join adm_hospitalario b on a.id_paciente=b.id_paciente
								left join eps j on (j.id_eps=b.id_eps)
		where b.id_adm_hosp ='".$_GET["idadmhosp"]."'" ;
			$color="green";
			$boton="Aceptar Paciente";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='';
			$date=date('Y-m-d');
			$date1=date('H:i');
			$freg='hidden';
			$freg1='text';
			$valor='hidden';
			$valor1='text';
			$ext='text';

			break;

			case 'A':
			$sql="";
			$color="yellow";
			$boton="Crear";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
			$subtitulo='Adicionar lista';
			$date=date('Y-m-d');
			$date1=date('H:i');

			break;
		}
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"",
				"dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
			}
		}else{
				$fila=array("tdoc_pac"=>"","doc_pac"=>"","nom1"=>"","nom2"=>"","ape1"=>"","ape2"=>"","edad"=>"","fnacimiento"=>"",
				"dir_pac"=>"","tel_pac"=>"","rh"=>"","email_pac"=>"","genero"=>"","lateralidad"=>"","religion"=>"","fotopac"=>"",
				"id_adm_hosp"=>"","fingreso_hosp"=>"","hingreso_hosp"=>"","fegreso_hosp"=>"","hegreso_hosp"=>"", "nom_eps"=>"");
			}
		?>
<form action="<?php echo PROGRAMA.'?&opcion=29';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel-body">
		<?php
			include("consulta_paciente.php");
		?>
	</section>
	<?php include("consulta_rapida.php");?>

	<section class="panel-body">
			<article class="col-xs-3">
				<label for="">Fecha de recepcion:</label>
				<input type="date" name="fprog" value="<?php echo $date ;?>" class="form-control" <?php echo $atributo2;?> >
				<input type="hidden" name="id_traslado" value="<?php echo $_GET["id"] ;?>" class="form-control"  >
				<input type="hidden" name="idadm" value="<?php echo $_GET["idadmhosp"] ;?>" class="form-control"  >
			</article>
			<article class="col-xs-2">
				<label for="">Hora de recepcion:</label>
				<input type="time" name="hprog" value="<?php echo $date1 ;?>" class="form-control" <?php echo $atributo2;?>>
			</article>
	</section>
	<section class="panel-body">
		<article class="col-xs-3">
			<label for="">Seleccione Sede de destino:</label>
			<select name="sedes" class="form-control" <?php echo atributo3; ?>>
				<?php
				$sql="SELECT id_sedes_ips,nom_sedes from sedes_ips where estado_sedes= 'Activo' ORDER BY id_sedes_ips ASC";
				if($tabla=$bd1->sub_tuplas($sql)){
					foreach ($tabla as $fila2) {
						if ($fila["id_sedes_ips"]==$fila2["id_sedes_ips"]){
							$sw=' selected="selected"';
						}else{
							$sw="";
						}
					echo '<option value="'.$fila2["id_sedes_ips"].'"'.$sw.'>'.$fila2["nom_sedes"].'</option>';
					}
				}
				?>
		</select>
		</article>
	</section>
	<section class="panel-body">
		<article class="col-xs-10">
			<label for="">Observaciones de recepcion del paciente:</label>
			<textarea class="form-control" name="obs_recibido" rows="6" id="comment" ></textarea>
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
	<div class="col-xs-7">
			<a class="btn btn-primary" href="<?php echo PROGRAMA.'?opcion=29';?>"><span class="glyphicon glyphicon-triangle-left">IR a menu Trabajo social</span></a>
	</div>
	<br>
<div class="panel panel-body">

<table class="table table-responsive">
	<tr>
		<th class="info">ADMISION</th>
		<th class="info">NOMBRE COMPLETO</th>
		<th class="info">FECHA Y HORA INGRESO</th>
		<th class="info">FECHA TRASLADO</th>
		<th class="info">QUIEN SOLICITA TRASLADO</th>
		<th class="info">ESTADO TRASLADO</th>
		<th class="info">Accion</th>
	</tr>
	<?php

	$sql="SELECT p.nom1,nom2,ape1,ape2,fotopac,
	a.id_adm_hosp,fingreso_hosp,hingreso_hosp,
	t.id_traslado,fprog_envio,hprog_envio,estado_traslado,
	u.nombre

	FROM pacientes p inner JOIN adm_hospitalario a on p.id_paciente=a.id_paciente
									 inner JOIN traslados t on a.id_adm_hosp=t.id_adm_hosp
									 inner join user u on t.id_user=u.id_user

	WHERE a.tipo_servicio='Hospitalario' and t.estado_traslado='Enviado'";
	if ($tabla=$bd1->sub_tuplas($sql)){
		//echo $sql;
		foreach ($tabla as $fila ) {
			echo"<tr >\n";
			echo'<td class="text-center Warning">'.$fila["id_adm_hosp"].'</td>';
			echo'<td class="text-center Warning">'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</td>';
			echo'<td class="text-center Warning">'.$fila["fingreso_hosp"].' '.$fila["hingreso_hosp"].'</td>';
			echo'<td class="text-center Warning">'.$fila["fprog_envio"].' '.$fila["hprog_envio"].'</td>';
			echo'<td class="text-center Warning">'.$fila["nombre"].'</td>';
			echo'<td class="text-center Warning">'.$fila["estado_traslado"].'</td>';
			$idtraslado=$fila["id_traslado"];
			echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&id='.$idtraslado.'&idadmhosp='.$fila["id_adm_hosp"].'"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-square-o"></span></button></a></th>';
			echo "</tr>\n";
		}
	}

	?>
	</table>
	<br>

  </section>
</div>
</div>
	<?php
}
?>
