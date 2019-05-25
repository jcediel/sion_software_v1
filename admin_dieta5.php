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
				$sql="UPDATE convenios SET id_eps='".$_POST["id_eps"]."',id_ips='".$_POST["id_ips"]."',finicial='".$_POST["finicial"]."',ffinal='".$_POST["ffinal"]."',nom_convenio='".$_POST["nom_convenio"]."',estado_convenio='".$_POST["estado_convenio"]."' WHERE id_convenios=".$_POST["id_conve"];
				$subtitulo="Actualizado";
			break;
			case 'X':

				$sql="UPDATE dieta SET estado_dieta='Inactiva', feliminacion='".date('Y-m-d')."', resp_elim='".$_SESSION["AUT"]["id_user"]."'  WHERE id_dieta='".$_POST["id_dieta"]."'";
				$subtitulo="Eliminado";
			break;
			case 'A':
				$sql="INSERT INTO dieta (id_adm_hosp, id_user, tipo_dieta, obs_dieta, estado_dieta) VALUES
				('".$_POST["id_adm_hosp"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["tipo_dieta"]."','".$_POST["obs_dieta"]."','Activa')";
				$subtitulo="Adicionado";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro fue $subtitulo con exito!";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="El registro NO fue $subtitulo !!! .";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {

			case 'X':
			$sql="SELECT id_dieta,id_adm_hosp,tipo_dieta,obs_dieta FROM  dieta where id_dieta=".$_GET["idd"];
			//echo $sql;
			$color="red";
			$boton="Eliminar Dieta";
			$atributo1=' readonly="readonly"';
			$atributo2=' readonly="readonly"';
			$atributo3=' disabled="disabled"';
      $doc=$_REQUEST['doc'];
      $idadm=$_REQUEST['ida'];
			$subtitulo='Confirmación para eliminar dieta';
			break;
			case 'A':
			$sql="";
			$color="yellow";
			$boton="Agregar Dieta";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3='';
      $doc=$_REQUEST['doc'];
      $idadm=$_REQUEST['ida'];
			$subtitulo='Registro de dieta';
			break;
		}

		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_dieta"=>"","id_adm_hosp"=>"","tipo_dieta"=>"","obs_dieta"=>"");

			}
		}else{
				$fila=array("id_dieta"=>"","id_adm_hosp"=>"","tipo_dieta"=>"","obs_dieta"=>"");
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nom_convenio.value == ""){
					alert("Se requiere el nombre del Convenio!!!!!!!!!!");
					document.forms[0].nom_convenio.focus();				// Ubicar el cursor
					return(false);
				}
				if (document.forms[0].finicial.value == ""){
					alert("Se requiere diligenciar la fecha inicial del contrato");
					document.forms[0].finicial.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?opcion=164&idadmhosp='.$idadm.'&doc='.$doc;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section class="panel panel-default">
		<section class="panel-heading">
				<h3><?php echo $subtitulo;?></h3>
		</section>
		<section class="panel panel-body">
			<article class="col-xs-1">
		  	<label  for="">ID:</label>
		  	<input type="text"  name="id_dieta" class="form-control" value="<?php echo $fila["id_dieta"];?>"<?php echo $atributo1;?>/>
        <input type="hidden"  name="id_adm_hosp" class="form-control" value="<?php echo $_REQUEST["ida"];?>"<?php echo $atributo1;?>/>
		  </article>
      <article class="col-xs-3">
				<label>Selecccionar tipo dieta:</label><br>
				<select name="tipo_dieta" class="form-control" <?php echo atributo3; ?>>
					<option value="<?php echo $fila['tipo_dieta']; ?>"><?php echo $fila['tipo_dieta']; ?></option>
					<?php
					$sql="SELECT coddieta,nom_dieta from tipo_dieta ORDER BY coddieta ASC";
					if($tabla=$bd1->sub_tuplas($sql)){
						foreach ($tabla as $fila2) {
							if ($fila["nom_dieta"]==$fila2["nom_dieta"]){
								$sw=' selected="selected"';
							}else{
								$sw="";
							}
						echo '<option value="'.$fila2["nom_dieta"].'"'.$sw.'>'.$fila2["nom_dieta"].'</option>';
						}
					}
					?>
				</select>
			</article>
			<article class="col-xs-8">
				<label class="text-center">Observación Dieta:</label><br>
				<textarea name="obs_dieta" class="form-control" rows="4"></textarea>
			</article>
		</section>
	</section>

	<div class="row text-center">
	  	<input type="submit" class="btn btn-primary" name="aceptar" Value="<?php echo $boton; ?>" />
		<input type="reset" class="btn btn-primary" Value="Reestablecer"/>
		<input type="submit" class="btn btn-primary" name="aceptar" Value="Descartar"/>
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
<section class="panel panel-default">
  <section class="panel-body">
    <?php
      $doc=$_REQUEST['doc'];
      $ida=$_REQUEST['ida'];
     ?>
      <a class="btn btn-success" href="<?php echo PROGRAMA.'?doc='.$doc.'&buscar=Consultar&opcion=34';?>"><span class="glyphicon glyphicon-triangle-left">Regresar a consultar paciente</span></a>
  </section>
<section class="panel-body">
<table class="table table-responsive">
	<tr>
		<th></th>
    <th>PACIENTE</th>
		<th>TIPO DIETA</th>
		<th>OBSERVACION</th>
    <th>ESTADO</th>
	</tr>

	<?php
  $doc=$_REQUEST['doc'];
  $ida=$_REQUEST['idadmhosp'];
	$sql="SELECT a.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,
               b.id_adm_hosp,
               c.*
        FROM pacientes a inner JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
                          inner join dieta c on c.id_adm_hosp=b.id_adm_hosp
        WHERE c.id_adm_hosp=$ida";

if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {
		echo"<tr>\n";
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=X&idd='.$fila["id_dieta"].'&doc='.$doc.'&ida='.$ida.'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Eliminar Dieta</button></a></th>';
    echo'<td class="text-left">
          <p>'.$fila["nom1"].' '.$fila["nom2"].' '.$fila["ape1"].' '.$fila["ape2"].'</p>
          <p><strong>'.$fila["tdoc_pac"].': </strong> '.$fila["doc_pac"].'</p>
         </td>';
		echo'<td class="text-left">'.$fila["tipo_dieta"].'</td>';
    echo'<td class="text-left">'.$fila["obs_dieta"].'</td>';
		echo'<td class="text-center">'.$fila["estado_dieta"].'</td>';
		echo "</tr>\n";
	}
}
	?>
	<tr>
		<th colspan="11" class="text-center"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&doc='.$doc.'&ida='.$ida?>" align="center" ><button type="button" class="btn btn-primary" >Adicionar Dieta</button>
		</a></th>
	<tr>
</table>
</section>
</section>
	<?php
}
?>
