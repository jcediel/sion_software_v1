<h1 class="fuente_titulo text-center">Admisión servicio de hospitalización</h1>
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
			$sql="INSERT INTO adm_hospitalario (id_eps,id_paciente,id_sedes_ips,fingreso_hosp,hingreso_hosp,tipo_usuario,tipo_afiliacion,ocupacion,
				dep_residencia,mun_residencia,zona_residencia,nivel,via_ingreso,tipo_servicio,resp_admhosp,estado_adm_hosp) VALUES
			('".$_POST["ideps"]."','".$_POST["idpaci"]."','".$_POST["sedes"]."','".$_POST["fingreso"]."','".$_POST["hingreso"]."','".$_POST["tusuario"]."',
			'".$_POST["tafiliacion"]."','".$_POST["ocupacion"]."','".$_POST["dep"]."','".$_POST["mun"]."','".$_POST["zona"]."','".$_POST["nivel"]."',
			'".$_POST["viaingreso"]."','".$_POST["tservicio"]."','".$_SESSION["AUT"]["nombre"]."','".$_POST["estadoadmhosp"]."');
			";
			$subtitulo="Adicionado";
			break;
			case 'X':
				$sql="SELECT logoips from ips where id_ips=".$_POST["idips"];
				if (!$fila=$bd1->sub_fila($sql)){
					$fila=array("logo"=> "");
				}
				$sql="DELETE FROM ips WHERE id_ips=".$_POST["idips"];
				$subtitulo="Eliminado";
			break;
			case 'A':

			break;
		}
		echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="El registro fue $subtitulo con exito!";
			if($_POST["operacion"]=="X"){
				if(is_file($fila["logoips"])){
					unlink($fila["logoips"]);
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
			$sql="SELECT id_eps,nom_eps,doc_eps,cod_eps,logo FROM  eps where id_eps=".$_GET["ideps"];
      $sql2="SELECT id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,fotopac FROM  pacientes where id_pac=".$_GET["idpac"];
			$color="green";
			$boton="Agregar";
			$atributo1=' readonly="readonly"';
			$atributo2='';
			$atributo3=' disabled="disabled"';
			$subtitulo='Ingreso del paciente al servicio de hospitalización';
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
				$fila=array("id_eps"=>"","nom_eps"=>"","doc_eps"=>"","tel_eps"=>"","dir_eps"=>"","cod_eps"=>"","logo"=>"","estado_eps"=>"" );
			}
		}else{
				$fila=array("id_eps"=>"","nom_eps"=>"","doc_eps"=>"","tel_eps"=>"","dir_eps"=>"","cod_eps"=>"","logo"=>"","estado_eps"=>"" );
			}

		?>
<script src = "js/sha3.js"></script>
		<script>
			function validar(){
				if (document.forms[0].nom_ips.value == ""){
					alert("Se requiere el nombre de la IPS!");
					document.forms[0].nom_ips.focus();				// Ubicar el cursor
					return(false);
				}
			}
		</script>
<form action="<?php echo PROGRAMA.'?opcion=17';?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
	<section>
		<marquee class="fuente1 banermarquee">
			<?php echo $subtitulo;?>
		</marquee>
	</section>
	<section class="panel panel-default">

		<section class="panel panel-body" id="sectpac"> <!--section de paciente-->
      <article class="col-xs-2">
		  	<label  for="">ID:</label>
		  	<input type="text"  name="idpaci" class="form-control" value="<?php echo $_GET["idpac"];?>"<?php echo $atributo2;?>/>
		  </article>
      <article class="col-xs-6">
        <label for="">Nombre Completo:</label>
        <input type="text" name="nompac" class="form-control text-center" value="<?php echo $_GET["nompac"];?>"<?php echo $atributo3;?>/>
      </article>
			<figure class="col-xs-3">
				<img src="<?php echo $_GET["foto"];?>" alt ="foto" class="image_logo_admision">
			</figure>
    </section>

		<section class="panel panel-body" id="secteps"><!--section de eps-->
			<article class="col-xs-3">
		  	<label  for="">ID:</label>
		  	<input type="text"  name="ideps" class="form-control" value="<?php echo $fila["id_eps"];?>"<?php echo $atributo2;?>/>
		  </article>
		  <article class="col-xs-6">
		  	<label for="">Nombre EPS:</label>
		  	<input type="text" name="nomeps" class="form-control" value="<?php echo $fila["nom_eps"];?>"<?php echo $atributo2?>/>
		  </article>
			<figure class="col-xs-3">
		  	<img src="<?php echo $fila["logo"];?>" alt ="foto" class="image_logo_admision">
		  </figure>
			<article class="col-xs-12">
		  	<label for="">Seleccione Sedes:</label>
				<select name="sedes" class="form-control" <?php echo atributo3; ?>>
					<?php
					$sql="SELECT id_sedes_ips,nom_sedes from sedes_ips ORDER BY id_sedes_ips ASC";
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
			<article class="col-xs-12">
		  	<label for="">Seleccione Convenio:</label>
				<select name="convenio" class="form-control" <?php echo atributo3; ?>>
					<?php
					$sql="SELECT id_convenios,nom_convenio from convenios ORDER BY id_convenios ASC";
					if($tabla=$bd1->sub_tuplas($sql)){
						foreach ($tabla as $fila2) {
							if ($fila["id_convenios"]==$fila2["id_convenios"]){
								$sw=' selected="selected"';
							}else{
								$sw="";
							}
						echo '<option value="'.$fila2["id_convenios"].'"'.$sw.'>'.$fila2["nom_convenio"].'</option>';
						}
					}
					?>
			</select>
		  </article>
		</section>
		<section>
			<label class="banertitle">
				Datos de Admisión
			</label>
		</section>
		<section class="panel panel-body">
			<article class="col-xs-2">
		  	<label for="">Fecha Ingreso:</label>
		  	<input type="date" name="fingreso" class="form-control" value="<?php echo date('Y-m-d');?>"<?php echo $atributo1;?>/>
		  </article>
			<article class="col-xs-2">
		  	<label for="">Hora Ingreso:</label>
		  	<input type="time" name="hingreso" class="form-control" value="<?php echo date('H:m:s');?>"<?php echo $atributo1;?>/>
		  </article>
			<article class="col-xs-3">
		  	<label for="">Tipo Usuario:</label>
		  	<select name="tusuario" class="form-control" <?php echo atributo3; ?>>
					<?php
					$sql="SELECT codtusuario,descritusuario from tusuario ORDER BY codtusuario ASC";
					if($tabla=$bd1->sub_tuplas($sql)){
						foreach ($tabla as $fila2) {
							if ($fila["codtusuario"]==$fila2["codtusuario"]){
								$sw=' selected="selected"';
							}else{
								$sw="";
							}
						echo '<option value="'.$fila2["codtusuario"].'"'.$sw.'>'.$fila2["descritusuario"].'</option>';
						}
					}
					?>
			</select>
		  </article>
			<article class="col-xs-2">
		  	<label for="">Departamento:</label>
				<select id="pais" class="form-control" name="dep">
            <option value="0">Elige una opción...</option>
        </select>
		  </article>
			<article class="col-xs-2">
				<label for="">Municipio:</label>
				<select id="estado" class="form-control" name="mun">
            <option value="0">Elige una opción...</option>
        </select>
			</article>
			<article class="col-xs-6">
				<label for="">Ocupación:</label>
				<select name="ocupacion" class="form-control" <?php echo atributo3; ?>>
					<?php
					$sql="SELECT codocu,descriocu from ocupacion ORDER BY codocu DESC";
					if($tabla=$bd1->sub_tuplas($sql)){
						foreach ($tabla as $fila2) {
							if ($fila["codocu"]==$fila2["codocu"]){
								$sw=' selected="selected"';
							}else{
								$sw="";
							}
						echo '<option value="'.$fila2["codocu"].'"'.$sw.'>'.$fila2["descriocu"].'</option>';
						}
					}
					?>
			</select>
			</article>
			<article class="col-xs-3">
				<label for="">Zona Residencia:</label>
				<select name="zona" class="form-control" <?php echo atributo3; ?>>
					<?php
					$sql="SELECT codzona,zona from zona ORDER BY codzona DESC";
					if($tabla=$bd1->sub_tuplas($sql)){
						foreach ($tabla as $fila2) {
							if ($fila["codzona"]==$fila2["codzona"]){
								$sw=' selected="selected"';
							}else{
								$sw="";
							}
						echo '<option value="'.$fila2["codzona"].'"'.$sw.'>'.$fila2["zona"].'</option>';
						}
					}
					?>
			</select>
			</article>
			<article class="col-xs-3">
				<label for="">Tipo Afiliación:</label>
				<select name="tafiliacion" class="form-control" <?php echo atributo3; ?>>
					<?php
					$sql="SELECT codafiliado,descriafiliado from tafiliado ORDER BY codafiliado DESC";
					if($tabla=$bd1->sub_tuplas($sql)){
						foreach ($tabla as $fila2) {
							if ($fila["codafiliado"]==$fila2["codafiliado"]){
								$sw=' selected="selected"';
							}else{
								$sw="";
							}
						echo '<option value="'.$fila2["codafiliado"].'"'.$sw.'>'.$fila2["descriafiliado"].'</option>';
						}
					}
					?>
			</select>
			</article>
			<article class="col-xs-2">
				<label for="">Nivel / CATEGORIA:</label>
				<select class="form-control" name="nivel">
					<option value="A"> A</option>
					<option value="B"> B</option>
					<option value="C"> C</option>
					<option value="Nivel 1"> Nivel 1</option>
					<option value="Nivel 2"> Nivel 2</option>
					<option value="Nivel 3"> Nivel 3</option>
					<option value="Nivel 4"> Nivel 4</option>
					<option value="Nivel 5"> Nivel 5</option>
					<option value="Nivel 6"> Nivel 6</option>
				</select>
			</article>

			<article class="col-xs-3">
				<label for="">Vía Ingreso:</label>
				<select name="viaingreso" class="form-control" <?php echo atributo3; ?>>
					<?php
					$sql="SELECT codvia,descrivia from viaingreso ORDER BY codvia DESC";
					if($tabla=$bd1->sub_tuplas($sql)){
						foreach ($tabla as $fila2) {
							if ($fila["codvia"]==$fila2["codvia"]){
								$sw=' selected="selected"';
							}else{
								$sw="";
							}
						echo '<option value="'.$fila2["codvia"].'"'.$sw.'>'.$fila2["descrivia"].'</option>';
						}
					}
					?>
			</select>
			</article>
			<article class="col-xs-3">
				<label for="">Tipo Servicio:</label>
				<select name="tservicio" class="form-control" <?php echo atributo3; ?>>
					<?php
					$sql="SELECT id_serv,nomserv from tipo_servicio ORDER BY id_serv ASC";
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
					?>
			</select>
			</article>
			<article class="col-xs-3">
				<label for="">Estado Admisión:</label>
				<input type="text" class="form-control" name="estadoadmhosp" value="Activo" <?php echo atributo3; ?>>
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
echo '<div class="alert alert-success animated bounceInRight">';
	echo $subtitulo;
echo '</div>';
// nivel 1?>
<div class="panel panel-default">
<div class="panel-body">
<table class="table table-responsive">
	<tr>
		<th id="th-estilo1"></th>
		<th id="th-estilo2">ID</th>
		<th id="th-estilo3">NOMBRE EPS</th>
		<th id="th-estilo1">DOCUMENTO EPS</th>
		<th id="th-estilo2">CODIGO EPS</th>
		<th id="th-estilo3">LOGO</th>
	</tr>

	<?php

  $pac=$_REQUEST["idpac"];
	$nom=$_REQUEST["nompac"];
	$foto=$_REQUEST["foto"];
	$sql="SELECT id_eps,nom_eps,doc_eps,cod_eps,logo FROM eps where estado_eps='Activo'";

if ($tabla=$bd1->sub_tuplas($sql)){
	foreach ($tabla as $fila ) {
		echo"<tr>\n";
		echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&ideps='.$fila["id_eps"].'&idpac='.$pac.'&nompac='.$nom.'&foto='.$foto.'"><button type="button" class="btn btn-warning" ><span class="fa fa-user-plus"></span></button></a></th>';
		echo'<td class="text-center">'.$fila["id_eps"].'</td>';
		echo'<td class="text-center">'.$fila["nom_eps"].'</td>';
		echo'<td class="text-center">'.$fila["doc_eps"].'</td>';
    echo'<td class="text-center">'.$fila["cod_eps"].'</td>';
		echo'<td class="text-center"><img src="'.$fila["logo"].'"alt ="logo" class="image_logo"> </td>';
    echo'<td class="text-center hidden">'.$pac.'</td>';
		echo'<td class="text-center hidden">'.$nom.'</td>';
		echo'<td class="text-center hidden">'.$foto.'</td>';
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
