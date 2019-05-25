
<?php
////////////////// CONEXION A LA BASE DE DATOS //////////////////

$host = 'localhost';
$basededatos = 'emmanuelips';
$usuario = 'root';
$contraseña = '515t3m45';



$conexion = new mysqli($host, $usuario,$contraseña, $basededatos);
if ($conexion -> connect_errno) {
die( "Fallo la conexión : (" . $conexion -> mysqli_connect_errno()
. ") " . $conexion -> mysqli_connect_error());
}
  ///////////////////CONSULTA DE LOS ALUMNOS///////////////////////

$alumnos="SELECT * FROM alumnos order by id_alumno";
$queryAlumnos= $conexion->query($alumnos);


?>

<html lang="es">

	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
		<!DOCTYPE html>
		<html>
		 <head>
		 	<meta charset="UTF-8">
			<script src="js/jquery-3.1.1.min.js" charset="utf-8"></script>
			<script src="js/jquery-ui.min.js" charset="utf-8"></script>
			<script>

    		$(function(){

				// Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
				$("#adicional").on('click', function(){
					$("#tabla tbody tr:eq(1)").clone().removeClass('fila-fija').appendTo("#tabla");
					$(".buscar").attr("id",'buscar');
				});

				// Evento que selecciona la fila y la elimina
				$(document).on("click",".eliminar",function(){
					var parent = $(this).parents().get(0);
					$(parent).remove();
				});

			});
		</script>



	</head>

	<body>
    <?php $idpresentacion=$_REQUEST['idpresentacion']; ?>
    <div class="container">
      <!-- Trigger the modal with a button -->
      <button type="button" class=" btn btn-info btn-lg sombra_movil " data-toggle="modal" data-target="#myModal">Consultar Procedimientos registrados
				<span class="badge animated shake danger">
					<?php
					$idpprod=$_REQUEST['idpresentacion'];
					$sql="SELECT p.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,dir_pac,zonificacion,
											 h.id_presentacion_dom,
											 count(a.id_pprocedimiento) prod,a.cups,frecuencia,jornada,cantidad,obs_cups,
											 b.id_pprofesional,finicial,ffinal,
											 c.nombre,
											 d.descupsmin
								FROM pacientes p INNER JOIN presentacion_dom h on p.id_paciente=h.id_paciente
																 LEFT JOIN pprocedimiento a on h.id_presentacion_dom=a.id_presentacion_dom
																 LEFT JOIN pprofesional b on a.id_pprocedimiento=b.id_pprocedimiento
																 LEFT JOIN user c on b.id_user=c.id_user
																 LEFT JOIN cups d on a.cups=d.codcups
								WHERE h.id_presentacion_dom=".$idpprod;
				if ($tabla=$bd1->sub_tuplas($sql)){
					foreach ($tabla as $fila) {
					echo $fila["prod"];
					}
				}
					 ?>
				</span>

			</button>
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Procedimientos registrados </h4>
            </div>
            <div class="modal-body ">
              <table class="table table-responsive table-bordered">
            		<tr>
            			<th class="info text-center">ID</th>
            			<th class="info text-center">PROCEDIMIENTO</th>
            			<th class="info text-center">FRECUENCIA</th>
            			<th class="info text-center">JORNADA</th>
            			<th class="info text-center">CANTIDAD</th>
            			<th class="info text-center">OBSERVACION</th>
            			<th class="info text-center">PROFESIONAL</th>
            			<th class="info text-center">RANGO DE ATENCIÓN</th>
            		</tr>

            		<?php
								$idpresentacion=$_REQUEST['idpresentacion'];
            		$idpprod=$_REQUEST['idpresentacion'];
                $idpac=$_REQUEST['idpac'];

            		$sql1="SELECT p.tdoc_pac,doc_pac,nom1,nom2,ape1,ape2,dir_pac,zonificacion,
            								 h.id_presentacion_dom,a.id_pprocedimiento,cups,frecuencia,jornada,cantidad,obs_cups,
            								 b.id_pprofesional,finicial,ffinal,
            								 c.nombre,
            								 d.descupsmin
            					FROM pacientes p INNER JOIN presentacion_dom h on p.id_paciente=h.id_paciente
            													 LEFT JOIN pprocedimiento a on h.id_presentacion_dom=a.id_presentacion_dom
            													 LEFT JOIN pprofesional b on a.id_pprocedimiento=b.id_pprocedimiento
            													 LEFT JOIN user c on b.id_user=c.id_user
            													 LEFT JOIN cups d on a.cups=d.codcups
            					WHERE h.id_presentacion_dom=".$idpprod;
            					//echo $sql;
            	if ($tabla=$bd1->sub_tuplas($sql1)){
            		foreach ($tabla as $fila ) {
            			if ($fila['id_pprofesional']=='') {
            				echo"<tr>\n";
            				echo'<td class="text-right alert-danger">'.$fila["id_pprocedimiento"].'</td>';
            				echo'<td class="text-left alert-danger">'.$fila["descupsmin"].'</td>';
            				echo'<td class="text-left alert-danger">'.$fila["frecuencia"].'</td>';
            				echo'<td class="text-left alert-danger">'.$fila["jornada"].'</td>';
            				echo'<td class="text-left alert-danger">'.$fila["cantidad"].'</td>';
            				echo'<td class="text-left alert-danger">'.$fila["obs_cups"].'</td>';
            				echo'<td class="text-left alert-danger">SIN PROFESIONAL</td>';
            				echo'<td class="text-left alert-danger">SIN PROFESIONAL</td>';
            				echo "</tr>\n";
            			}else {
            				echo"<tr>\n";
            				echo'<td class="text-right alert-info">'.$fila["id_pprocedimiento"].'</td>';
            				echo'<td class="text-left alert-info">'.$fila["descupsmin"].'</td>';
            				echo'<td class="text-left alert-info">'.$fila["frecuencia"].'</td>';
            				echo'<td class="text-left alert-info">'.$fila["jornada"].'</td>';
            				echo'<td class="text-left alert-info">'.$fila["cantidad"].'</td>';
            				echo'<td class="text-left alert-info">'.$fila["obs_cups"].'</td>';
            				echo'<td class="text-left alert-info">'.$fila["nombre"].'</td>';
            				echo'<td class="text-left alert-info">'.$fila["finicial"].' | '.$fila["ffinal"].'</td>';
            				echo "</tr>\n";
            			}
            		}
            	}
            		?>
            	</table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              <?php
              echo '<a href="'.PROGRAMA.'?opcion=143&idpresentacion='.$idpresentacion.'&idpac='.$idpac.'"><button type="button" class="btn btn-success" ><span class="fa fa-user-md"></span> Asignar profesionales</button></a>';
               ?>
            </div>
          </div>
        </div>
      </div>
      </div>
      <?php
        $doc=$_REQUEST['doc'];
        $idpac=$_REQUEST['idpac'];
        $idpresentacion=$_REQUEST['idpresentacion'];
       ?>
			<form  method="post" >
				<h3 class="alert alert-success">Registro de procedimientos -- Presentación pacientes Domiciliarios</h3>
        <table class="table table-bordered"  id="tabla">
					<tr class="success" id="fila-fija">
						<th>ID</th>
						<th>PROCEDIMIENTO</th>
						<th>FRECUENCIA</th>
						<th>JORNADA</th>
						<th>CANTIDAD</th>
						<th>OBSERVACION</th>
					</tr>
					<tr >
						<td class="col-xs-1"><input class="form-control" required name="id[]" value="<?php echo $_GET['idpresentacion'];?>" readonly='readonly'/></td>
						<td class="col-xs-5">
							<select class="form-control buscar"  required name="cups[]" readonly='readonly'>
								<?php
								$sql="SELECT codcups,codcupsmin,descupsmin from cups WHERE codcups in (6981	,
6982	,
6983	,
6984	,
6985	,
6986	,
6987	,
6988	,
6989	,
6990	,
6991	,
6992	,
6993	,
6994	,
6995	,
6996	,
6997	,
6998	,
6999	,
7000	,
7001	,
7002	,
7003	,
7004	,
7005	,
7006	,
7007	,
7008	,
7009	,
7010	,
7011	,
7012	,
7013	,
7014	,
5057	,
5058	,
5056	,
5059	) ORDER BY codcupsmin ASC";

								if($tabla=$bd1->sub_tuplas($sql)){
									foreach ($tabla as $fila2) {
										if ($fila["codcups"]==$fila2["codcups"]){
											$sw=' selected="selected"';
										}else{
											$sw="";
										}
									echo '<option value="'.$fila2["codcups"].'"'.$sw.'>'.$fila2["descupsmin"].' | '.$fila2["codcupsmin"].'</option>';
									}
								}
								?>
							</select>

						</td>
						<td class="col-xs-1">
							<select class="form-control" required name="frecuencia[]" readonly='readonly'>
								<option value=""></option>
								<option value="20">20 Minutos</option>
								<option value="30">30 Minutos</option>
								<option value="40">40 Minutos</option>
								<option value="60">60 Minutos</option>
								<option value="3">3 Horas</option>
								<option value="6">6 Horas</option>
								<option value="8">8 Horas</option>
								<option value="12">12 Horas</option>
								<option value="24">24 Horas</option>
								<option value="0">No aplica</option>
							</select>
						</td>
						<td class="col-xs-1">
							<select class="form-control" required name="jornada[]" readonly='readonly'>
								<option value=""></option>
								<option value="Diurno">Diurno</option>
								<option value="Nocturno">Nocturno</option>
								<option value="No aplica">No aplica</option>
							</select>
						</td>
						<td class="col-xs-1"><input type='number' class="form-control" required name="cantidad[]" /></td>
						<td class="col-xs-5"><textarea required name="obs_cups[]" class="form-control" rows="3" ></textarea></td>
						<td class="eliminar"><button type="button" class="btn btn-danger"><span class="fa fa-trash"></span> Eliminar</button></td>
					</tr>
				</table>

				<div class="col-xs-6 text-left">
					<input type="submit" name="insertar" value="Guardar Procedimientos" class="btn btn-primary btn-lg"/>
				</div>
        <div class="col-xs-6 text-right">
          <button id="adicional" name="adicional" type="button" class="btn btn-warning btn-md"><span class="fa fa-plus"></span> Agregar procedimiento</button>
        </div>
        <div class="col-xs-12 text-center panel-body">
          <?php
            echo'<a href="'.PROGRAMA.'?opcion=143&idpresentacion='.$idpresentacion.'&idpac='.$idpac.'"><button type="button" class="btn btn-success sombra_movil btn-lg" ><span class="fa fa-user-md"></span> Proceda con asignación de profesionales</button></a>';
           ?>
        </div>
			</form>

			<?php

				//////////////////////// PRESIONAR EL BOTÓN //////////////////////////
				if(isset($_POST['insertar']))

				{


				$items1 = ($_POST['id']);
				$items2 = ($_POST['cups']);
				$items3 = ($_POST['frecuencia']);
				$items4 = ($_POST['jornada']);
				$items5 = ($_POST['cantidad']);
				$items6 = ($_POST['obs_cups']);

				///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
				while(true) {

				    //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
				    $item1 = current($items1);
				    $item2 = current($items2);
				    $item3 = current($items3);
				    $item4 = current($items4);
						$item5 = current($items5);
						$item6 = current($items6);

				    ////// ASIGNARLOS A VARIABLES ///////////////////
				    $id=(( $item1 !== false) ? $item1 : ", &nbsp;");
				    $cups=(( $item2 !== false) ? $item2 : ", &nbsp;");
				    $frec=(( $item3 !== false) ? $item3 : ", &nbsp;");
				    $jor=(( $item4 !== false) ? $item4 : ", &nbsp;");
						$cant=(( $item5 !== false) ? $item5 : ", &nbsp;");
            $obs=(( $item6 !== false) ? $item6 : ", &nbsp;");

				    //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
				    $valores='('.$id.',"'.$cups.'","'.$frec.'","'.$jor.'","'.$cant.'","'.$obs.'"),';

				    //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
				    $valoresQ= substr($valores, 0, -1);

				    ///////// QUERY DE INSERCIÓN ////////////////////////////
				    $sql = "INSERT INTO pprocedimiento (id_presentacion_dom,cups, frecuencia,jornada,cantidad,obs_cups )
					VALUES $valoresQ";
          //echo $sql;

					$sqlRes=$conexion->query($sql) or mysql_error();


				    // Up! Next Value
				    $item1 = next( $items1 );
				    $item2 = next( $items2 );
				    $item3 = next( $items3 );
				    $item4 = next( $items4 );
            $item5 = next( $items5 );
            $item6 = next( $items6 );

				    // Check terminator
				    if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false) break;

				}

				}

			?>



		</section>

		<footer>
		</footer>
	</body>

</html>
