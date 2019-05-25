<?php
////////////////// CONEXION A LA BASE DE DATOS PARA GUARDADO COMPLETO //////////////////

$host = 'localhost';
$basededatos = 'kg';
$usuario = 'root';
$contraseña = '515t3m45';

$conexion = new mysqli($host, $usuario,$contraseña, $basededatos);
if ($conexion -> connect_errno) {
die( "Fallo la conexion : (" . $conexion -> mysqli_connect_errno()
. ") " . $conexion -> mysqli_connect_error());
}

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
    <link rel="stylesheet" href="./procedimientos/css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="./procedimientos/css/main.css" />

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="./procedimientos/js/jquery-ui.min.js"></script>

 	</head>
 	<body>
    <?php
      $idadmhosp=$_REQUEST['idadmhosp'];
      $servicio=$_REQUEST['servicio'];
      $doc=$_REQUEST['doc'];
      $tf=$_REQUEST['tf'];
    ?>
  <?php include('consulta_ultimaEvo.php') ?>

    <section class="col-sm-7">
        <a class="btn btn-primary" href="<?php echo PROGRAMA.'?doc='.$_REQUEST['doc'].'&servicio='.$_REQUEST['servicio'].'&buscar=Buscar&opcion='.$_REQUEST['opcion'].'';?>">
          <span class="glyphicon glyphicon-triangle-left">Regresar a modulo de admisiones</span></a>
    </section>
    <br>
	<div class="container-fluid">
		<div class="row main-content">
      <?php
        $idadmhosp=$_REQUEST['idadmhosp'];
        $doc=$_REQUEST['doc'];
       ?>
				<form  method='post' >
					<div class="row">
					  <table class="table table-bordered">
							<tr>
							    <th class="text-center alert alert-info"><input class='check_all' type='checkbox' onclick="select_all()"/></th>
							    <th class="text-center alert alert-info">#</th>
                  <th class="text-center alert alert-info">Procedimiento</th>
                  <th class="text-center alert alert-info">Cantidad</th>
							    <th class="text-center alert alert-info">Observación</th>
							</tr>
							<tr>
						    	<td><input type='checkbox' class='case'/></td>
						    	<td><span id='snum'>1.</span></td>
						   	 	<td>
                    <article class="col-sm-12">
                      <textarea class="form-control" id='countryname_1' name='countryname[]' rows="3"></textarea>
                    </article>
                    <article class="col-sm-6 form-group">
                      <input class="form-control" type='hidden' id='country_no_1' name='country_no[]'/> <!--id_producto-->
                    </article>
                    <article class="col-sm-3 form-group">
                      <input class="form-control" type='hidden' id='phone_code_1' name='phone_code[]'/> <!--pos o no pos-->
                    </article>
                    <article class="col-sm-3 form-group">
                      <input class="form-control" type='hidden' id='country_code_1' name='country_code[]'/> <!--alto o no alto costo-->
                    </article>
                    <article class="col-sm-3 form-group">
                      <input class="form-control" type='hidden' id='idm_prod' required name='idm_prod[]' value="<?php echo $_REQUEST['idm'];?>" <?php echo $atributo1; ?>/>
                    </article>
                  </td>
                  <td>
                    <input type="number" class="form-control" required name="cantidad[]">
                    <textarea id='profesional' name='profesional[]' rows="5" class="form-control" ></textarea>
						    	</td>
						    	<td>
                    <textarea id='observacion' name='observacion[]' rows="5" class="form-control" ></textarea>
                    <input type="hidden" id='estado' name='estado[]' value="1">
						    	</td>
						  	</tr>
					  	</table>
              <div class="col-sm-6">
                <button type="button" class='btn btn-danger fa fa-minus delete'>Borrar Procedimiento</button>
                <button type="button" class='btn btn-success fa fa-plus addmore'>Agregar Procedimiento</button>
					  	</div>
              <div class="col-sm-6 text-right">
                <input type="submit" name="insertar" value="Guardar Procedimientos" class="btn btn-primary"/>
              </div>
				</form>
		</div>
	</div><!-- /container -->

	<div class="clearfix"></div>

    <!-- /Footer -->
    <script src="./procedimientos/js/auto.js"></script>
    <?php

      //////////////////////// PRESIONAR EL BOT�N //////////////////////////
      if(isset($_POST['insertar']))

      {

      $items1 = ($_POST['idm_prod']);
      $items2 = ($_POST['country_no']);
      $items3 = ($_POST['countryname']);
      $items4 = ($_POST['cantidad']);
      $items5 = ($_POST['observacion']);
      $items6 = ($_POST['estado']);

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
          $idm_prod=(( $item1 !== false) ? $item1 : ", &nbsp;");
          $country_no=(( $item2 !== false) ? $item2 : ", &nbsp;");
          $countryname=(( $item3 !== false) ? $item3 : ", &nbsp;");
          $cantidad=(( $item4 !== false) ? $item4 : ", &nbsp;");
          $observacion=(( $item5 !== false) ? $item5 : ", &nbsp;");
          $estado=(( $item6 !== false) ? $item6 : ", &nbsp;");


          //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIoN ////////
          $valores="('$idm_prod','$country_no','$countryname','$cantidad','$observacion','$estado'),";

          //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCI�N SUBSTR EN LA ULTIMA FILA /////////////////////
          $valoresQ= substr($valores, 0, -1);

          ///////// QUERY DE INSERCI�N ////////////////////////////
          $sql = "INSERT INTO detalle_aut (id_m_aut, cups_d_aut, procedimiento_d_aut, cant_d_aut,obs_d_aut, estado_d_aut)
        VALUES $valoresQ;";
        echo $sql;

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
  </body>
</html>
