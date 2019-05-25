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
				$sql="INSERT INTO ruta (id_sedes_ips, conductor, auxiliar,resp_creacion, nom_ruta, descripcion, jornada, capacidad, estado_ruta) VALUES
				('".$_POST["id_sedes_ips"]."','".$_POST["conductor"]."','".$_POST["auxiliar"]."','".$_SESSION["AUT"]["id_user"]."','".$_POST["nom_ruta"]."','".$_POST["descripcion"]."','".$_POST["jornada"]."',
				 '".$_POST["capacidad"]."', 'Activo')";
				$subtitulo=$_POST['nom_ruta'];
				$subtitulo1="Adicionada";
			break;
		}
		//echo $sql;
		if ($bd1->consulta($sql)){
			$subtitulo="La ruta $subtitulo fue  $subtitulo1 con exito!";
			$check='si';
			if($_POST["operacion"]=="X"){
			if(is_file($fila["logo"])){
				unlink($fila["logo"]);
			}
			}
		}else{
			$subtitulo="La ruta $subtitulo NO fue $subtitulo1. Comuniquese con soporte";
			$check='no';
		}
	}
}

if (isset($_GET["mante"])){					///nivel 2
	switch ($_GET["mante"]) {

			case 'A':
      $idr=$_REQUEST['idr'];
			$sql="SELECT a.id_rutas, id_sedes_ips, conductor, auxiliar, fcreacion, resp_creacion, nom_ruta, descripcion, jornada, capacidad, estado_ruta
                   b.nombre auxiliar
              FROM ruta a LEFT JOIN user b on a.id_user=b.id_user
              WHERE id_ruta = $idr " ;
				$boton="Crear Ruta";
				$atributo1=' readonly="readonly"';
				$atributo2='';
				$atributo3='';
				$date=date('Y-m-d');
				$date1=date('H:i');
				$opcion=$_REQUEST['opcion'];
				$doc=$_REQUEST['doc'];
				$form1='Control_reh/rutas/add_ruta.php';
				$subtitulo='Creación de ruta';
				break;
				case 'E':
	      $idr=$_REQUEST['idr'];
				$sql="SELECT a.id_rutas, id_sedes_ips, conductor, auxiliar, fcreacion, resp_creacion, nom_ruta, descripcion, jornada, capacidad, estado_ruta
	                   b.nombre auxiliar
	              FROM ruta a LEFT JOIN user b on a.id_user=b.id_user
	              WHERE id_ruta = $idr " ;
					$boton="Actualizar Ruta";
					$atributo1=' readonly="readonly"';
					$atributo2='';
					$atributo3='';
					$date=date('Y-m-d');
					$date1=date('H:i');
					$opcion=$_REQUEST['opcion'];
					$doc=$_REQUEST['doc'];
					$ruta=$_REQUEST['ruta'];
					$form1='Control_reh/rutas/add_ruta.php';
					$subtitulo='Actualizar datos de ruta';
					break;

		}
//echo $sql;
		if($sql!=""){
			if (!$fila=$bd1->sub_fila($sql)){
				$fila=array("id_rutas"=>"","id_sedes_ips"=>"","conductor"=>"","auxiliar"=>"","fcreacion"=>"","resp_creacion"=>"","nom_ruta"=>"","descripcion"=>"","jornada"=>"","capacidad"=>"","estado_ruta"=>"",
				"auxiliar"=>"");
			}
		}else{
      $fila=array("id_rutas"=>"","id_sedes_ips"=>"","conductor"=>"","auxiliar"=>"","fcreacion"=>"","resp_creacion"=>"","nom_ruta"=>"","descripcion"=>"","jornada"=>"","capacidad"=>"","estado_ruta"=>"",
      "auxiliar"=>"");
			}

		?>

		<script type="text/javascript" src="/js/jquery.js"></script>
		<div class="alert alert-info animated bounceInRight">		</div>
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
<section class="panel panel-default">
	<section class="panel-heading">
		<h2>Administración de rutas <?php echo $_REQUEST['servicio'] ?></h2>
	</section>
	<section class="panel-body">
		<section class="panel-body">
			<section class="col-md-4">
				<form>
					<div class="row">
					  <div class="col-lg-12">
					    <div class="input-group">
								<input type="text" class="form-control" required name="ruta" placeholder="NOMBRE RUTA" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
					      <span class="input-group-btn">
										<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
										<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
					      </span>
					    </div><!-- /input-group -->
					  </div><!-- /.col-lg-6 -->
					</div>
				</form>
			</section>
			<section class="col-md-4">
				<form>
					<div class="row">
					  <div class="col-lg-12">
					    <div class="input-group">
								<input type="text" class="form-control" required name="ruta" placeholder="NOMBRE RUTA" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
					      <span class="input-group-btn">
										<input type="submit" name="buscar" class="btn btn-primary" value="Consultar">
										<input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
					      </span>
					    </div><!-- /input-group -->
					  </div><!-- /.col-lg-6 -->
					</div>
				</form>
			</section>
		</section>
		<section class="panel panel-body">
			<table class="table table-responsive">

      <?php
        $ruta=$_REQUEST['ruta'];
        $sql = "SELECT a.id_rutas, id_sedes_ips, conductor, auxiliar, fcreacion, resp_creacion, nom_ruta, descripcion, jornada, capacidad, estado_ruta,
                       b.nombre,
											 c.nombre_conductor

                FROM ruta a LEFT JOIN user b on a.auxiliar=b.id_user
														LEFT JOIN conductor c on a.conductor=c.id_conductor
                WHERE nom_ruta LIKE '%".$ruta."%'";
								//echo $sql;
        if ($tabla=$bd1->sub_tuplas($sql)){
           foreach ($tabla as $fila ) {
             echo '<tr>
						 				<th class="info"></th>
     					      <th class="info">NOMBRE RUTA</th>
     					      <th class="info">DESCRIPCION</th>
     					      <th class="info">CONDUCTOR</th>
     					      <th class="info">AUXILIAR</th>
     					      <th class="info" colspan="3"></th>
     				       </tr>';
             echo '<tr>';
						 echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=X&idr='.$fila["id_rutas"].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span></button></a></th>';
             echo '<td>'.$fila['nom_ruta'].'</td>';
             echo '<td>'.$fila['descripcion'].'</td>';
             echo '<td>'.$fila['nombre_conductor'].'</td>';
             echo '<td>'.$fila['nombre'].'</td>';
						 echo'<th class="text-center"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idr='.$fila["id_rutas"].'"><button type="button" class="btn btn-warning" ><span class="fa fa-edit"></span> Editar ruta</button></a></th>';
             echo '</tr>';
           }
        }else {
          echo '<p class="alert alert-danger animated bounce"><span class="fa fa-warning fa-2x"></span> La ruta que esta buscando no se encuentra registrada, compruebe el nombre digitado.</p>';
        }

       ?>
       <tr>
     		<th colspan="8" class="text-center">
          <a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A'?>" align="center" ><button type="button" class="btn btn-primary" ><span class="fa fa-plus"></span> Agregar Ruta</button></a>
        </th>
     	 </tr>
      </table>
		</section>
	</section>
</section>
		<?php
	}
	?>
