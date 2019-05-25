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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="jquery autocomplete">
	<meta name="keywords" content="jquery autocomplete">
	<meta name="author" content="muni">

	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->

    <link rel="stylesheet" type="text/css" href="autocomplete1/css/jquery-ui.min.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="autocomplete1/js/jquery-ui.min.js"></script>


 	</head>
 	<body>
    <?php
      $idadmhosp=$_REQUEST['idadmhosp'];
      $servicio=$_REQUEST['servicio'];
      $doc=$_REQUEST['doc'];
    ?>
    <?php include('consulta_ultimaEvo.php') ?>
    <section class="col-xs-7">
        <a class="btn btn-primary" href="<?php echo PROGRAMA.'?opcion=133&idadmhosp='.$_REQUEST['idadmhosp'].'&servicio='.$_REQUEST['servicio'].'&atencion='.$_REQUEST['atencion'].'&doc='.$_REQUEST['doc'].'';?>"><span class="glyphicon glyphicon-triangle-left">Regresar a consultar orden de servicio</span></a>
    </section>
    <br>

	<div class="container-fluid panel panel-default">
    <section class="panel-heading"><h4>Generacion de ayudas diagnosticas y orden de servicio</h4></section>
		<div class="row main-content">
				<form method='post' >
					<div class="table-responsive">
					  	<table class="table table-bordered">
							<tr>
							    <th><input class='check_all' type='checkbox' onclick="select_all()"/></th>
							    <th class="info">No</th>
                  <th class="col-xs-1 text-center info">ID</th>
							    <th class="col-xs-5 text-center info">Procedimiento</th>
							    <th class="col-xs-6 text-center info">Observación</th>
							</tr>
							<tr>
						    	<td><input type='checkbox' class='case'/></td>
						    	<td><span id='snum'>1.</span></td>
                  <td><input class="form-control" type='text' id='idmfmedhosp' required name='idmfmedhosp[]' value="<?php echo $_REQUEST['idm'];?>" <?php echo $atributo1; ?>/></td>
						   	 	<td><input class="form-control" type='text' id='countryname_1' required name='countryname[]'/>
                  <input class="form-control" type='hidden' id='codmed' required name='codmed[]'/></td>

						    	<td>
                    <textarea id='phone_code_1' required name='phone_code[]' class="form-control" rows="4" ></textarea>
                    <input type="hidden" name="estado" value="solicitado">
                  </td>
						  	</tr>
					  	</table>
              <div class="col-xs-12 text-left">
                <button type="button" class='btn btn-danger delete'>- Borrar Procedimiento</button>
                <button type="button" class='btn btn-success addmore'>+ Agregar Procedimiento</button>
              </div>
              <div class="col-xs-12 text-center">
                <input type="submit" name="insertar" value="Guardar Procedimiento" class="btn btn-primary btn-lg"/>
              </div>
					</div>
				</form>
		</div>
	</div><!-- /container -->
    <script src="autocomplete1/js/auto0.js"></script>
    <?php

      //////////////////////// PRESIONAR EL BOTÓN //////////////////////////
      if(isset($_POST['insertar']))

      {

      $items1 = ($_POST['idmfmedhosp']);
      $items2 = ($_POST['countryname']);
      $items3 = ($_POST['phone_code']);
      $items4 = ($_POST['estado']);



      ///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
      while(true) {

          //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
          $item1 = current($items1);
          $item2 = current($items2);
          $item3 = current($items3);
          $item4 = current($items4);


          ////// ASIGNARLOS A VARIABLES ///////////////////
          $idmfmedhosp=(( $item1 !== false) ? $item1 : ", &nbsp;");
          $countryname=(( $item2 !== false) ? $item2 : ", &nbsp;");
          $phone_code=(( $item3 !== false) ? $item3 : ", &nbsp;");
          $estado=(( $item4 !== false) ? $item4 : ", &nbsp;");


          //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
          $valores='('.$idmfmedhosp.',"'.$countryname.'","'.$phone_code.'","Solicitado"),';

          //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
          $valoresQ= substr($valores, 0, -1);

          ///////// QUERY DE INSERCIÓN ////////////////////////////
          $sql = "INSERT INTO detalle_procedimiento (id_master_prod, procedimiento, observacion, estado_prod)
        VALUES $valoresQ;";
        //echo $sql;

        $sqlRes=$conexion->query($sql) or mysql_error();


          // Up! Next Value
          $item1 = next( $items1 );
          $item2 = next( $items2 );
          $item3 = next( $items3 );
          $item4 = next( $items4 );


          // Check terminator
          if($item1 === false && $item2 === false && $item3 === false && $item4 === false ) break;

      }

      }

    ?>
  </body>
</html>
