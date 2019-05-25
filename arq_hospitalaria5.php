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
<section class="panel panel-default">
	<section class="panel-heading"><h4>Arquitectura Hospitalaria Clínica Emmanuel</h4></section>
  <section class="panel-body">
    <section class="col-xs-6">
  		<form>
  			<section class="panel-body">
  				<article class="col-xs-12 input-group">
  					<span class="input-group-addon fa fa-user" id="basic-addon1"></span>
    				<select name="sedes" class="form-control" aria-describedby="basic-addon1" <?php echo atributo3; ?>>
              <option value ="0">------- Seleccione Sede ------</option>
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
  				<br>
  				<div>
  					<input type="submit" name="buscar" class="btn btn-warning" value="Buscar">
  					<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
  				</div>
  			</section>
  		</form>
  	</section>
  </section>

  <section class="panel-body"> <!--Arq. faca-->
    <button data-toggle="collapse" class="btn btn-primary" data-target="#UCA">UCA </strong><span class="glyphicon glyphicon-arrow-down"></span> </button>
    <section id="UCA" class="collapse">
      <section class="panel-body">
    		<table class="table table-responsive table-bordered">
    		<tr>
    			<th class="text-center info">HABITACION</th>
    			<th class="text-center info">PACIENTE</th>
    			<th class="text-center info">EPS</th>
    		</tr>
        <?php
  			$sede=$_REQUEST["sedes"];

  			$sql="SELECT a.id_paciente,tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,edad,descricie,fotopac,
  									 b.id_adm_hosp,fingreso_hosp,hingreso_hosp,fegreso_hosp,hegreso_hosp,tipo_servicio,
  									 c.nom_sedes,
  									 d.nom_eps,
                     e.id_piso,nom_piso,
                     f.id_pabellon,nom_pabellon,
                     g.id_habitacion,nom_habitacion,
                     h.id_cama,nom_cama
  						FROM pacientes a LEFT JOIN adm_hospitalario b on a.id_paciente=b.id_paciente
  													   LEFT JOIN sedes_ips c on b.id_sedes_ips=c.id_sedes_ips
  														 left join eps d on b.id_eps=d.id_eps
                               INNER JOIN piso e on c.id_sedes_ips=e.id_sedes_ips
                               INNER JOIN pabellon f on f.id_piso=e.id_piso
                               INNER JOIN habitacion g on g.id_pabellon=f.id_pabellon
                               INNER JOIN cama h on h.id_habitacion=g.id_habitacion
  						WHERE e.id_sedes_ips='".$sede."'  and tipo_servicio='Hospitalario' ";
echo $sql;
  			if ($tabla=$bd1->sub_tuplas($sql)){

  				foreach ($tabla as $fila ) {

  					echo"<tr >\n";
  					echo'<td class="text-center"><strong>'.$fila["nom_habitacion"].' </strong>- '.$fila["nom_cama"].'</td>';
  					echo "</tr>\n";
  				}
  			}
  			?>
  	   </table>
      </section>
    </section>
  </section>

</section>
	<?php
}
?>
