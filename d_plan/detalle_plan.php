<?php
////////////////// CONEXION A LA BASE DE DATOS PARA GUARDADO COMPLETO //////////////////

$host = 'localhost';
$basededatos = 'emmanuelips';
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

    <title></title>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="./d_plan/css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="./d_plan/css/main.css" />

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="./d_plan/js/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
 	</head>
 	<body>
    <?php
      $idadmhosp=$_REQUEST['idadmhosp'];
      $servicio=$_REQUEST['servicio'];
      $doc=$_REQUEST['doc'];
      $tf=$_REQUEST['tf'];
    ?>
    <section class="col-xs-12">
      <article class="col-xs-4">
        <label>TOTAL SESIONES AUTORIZADAS:</label>
        <p><?php echo $fila['total_sesion'] ?></p>
      </article>
      <article class="col-xs-4">
        <label>TOTAL HORAS AUTORIZADAS:</label>
        <p><?php echo $fila['total_hora'] ?></p>
      </article>
      <article class="col-xs-4">
        <p class="text-center"><a class="btn btn-primary" href="<?php echo PROGRAMA.'?opcion=178&sede='.$sede.'&servicio='.$servicio.'&doc='.$doc.'&eps='.$eps;?>">
          <span class="glyphicon glyphicon-triangle-left">Regresar a listado de planes</span>
        </a></p>
      </article>

    </section>
    <br>
	<div class="container-fluid">
		<div class="row main-content">
      <?php
        $idadmhosp=$_REQUEST['idadmhosp'];
        $doc=$_REQUEST['doc'];

       ?>

				<form  method='post' >
					<div class="table-responsive">

					  	<table class="table table-bordered">

              <tr>
							    <th class="alert alert-info"><input class='check_all' type='checkbox' onclick="select_all()"/></th>
							    <th class="alert alert-info">#</th>
							    <th class="alert alert-info">PROCEDIMIENTO</th>
							    <th class="alert alert-info">SESIONES</th>
							    <th class="alert alert-info">JORNADA</th>
							    <th class="alert alert-info">OBSERVACION</th>

							</tr>
							<tr>
						    	<td ><input type='checkbox' class='case'/></td>
						    	<td ><span id='snum'>1.</span></td>
						   	 	<td class="col-xs-3">
                    <article class="col-xs-12">
                      <textarea class="form-control" id='countryname_1' name='countryname[]' rows="3"></textarea>
                    </article>
                    <article class="col-xs-3 form-group">
                      <input class="form-control" type='hidden' id='country_no_1' name='country_no[]'/> <!--id_producto-->
                    </article>
                    <article class="col-xs-3 form-group">
                      <input class="form-control" type='hidden' id='phone_code_1' name='phone_code[]'/> <!--pos o no pos-->
                    </article>
                    <article class="col-xs-3 form-group">
                      <input class="form-control" type='hidden' id='country_code_1' name='country_code[]'/> <!--alto o no alto costo-->
                    </article>
                    <article class="col-xs-3 form-group">
                      <input class="form-control" type='hidden' id='idmplan' required name='idmplan[]' value="<?php echo $_REQUEST['idm'];?>" <?php echo $atributo1; ?>/>
                    </article>
                  </td>
						    	<td class="col-xs-2">
                    <input type="number" class="form-control" required name="sesion[]" id="sesion" value="">
                    <input class="form-control" type='hidden' id='resp_reg' required name='resp_reg[]' value="<?php echo $_SESSION['AUT']['id_user'];?>" <?php echo $atributo1; ?>/>
                    <input class="form-control" type='hidden' id='estado' required name='estado[]' value="solicitado" <?php echo $atributo1; ?>/>
						    	</td>
						    	<td>
                    <select class="form-control" id='jornada' required name='jornada[]' required="">
                      <option value=""></option>
						    	    <option value="mañana">Mañana</option>
                      <option value="tarde">Tarde</option>
						    	  </select>
						    	</td>
									<td class="col-xs-3"><textarea class="form-control" type='text' id='obs_detalle' name='obs_detalle[]' rows="4"/></textarea> </td>
						  	</tr>
					  	</table>
					  	<button type="button" class='btn btn-danger btn-lg delete'>- Eliminar procedimiento</button>
						<button type="button" class='btn btn-success btn-lg addmore'>+ Adicionar procedimiento</button>
					</div>
          <br>
          <div class="col-xs-12 text-center">
            <input type="submit" name="insertar" value="Guardar Procedimientos" class="btn btn-primary btn-lg"/>
          </div>
				</form>
		</div>
	</div><!-- /container -->

	<div class="clearfix"></div>

    <!-- /Footer -->
    <script src="./d_plan/js/auto.js"></script>
    <?php

      //////////////////////// PRESIONAR EL BOT�N //////////////////////////
      if(isset($_POST['insertar']))

      {

      $items1 = ($_POST['idmplan']);
      $items2 = ($_POST['country_no']);
      $items3 = ($_POST['countryname']);
      $items4 = ($_POST['sesion']);
      $items5 = ($_POST['jornada']);
      $items6 = ($_POST['obs_detalle']);
      $items7 = ($_POST['estado']);



      ///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
      while(true) {

          //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
          $item1 = current($items1);
          $item2 = current($items2);
          $item3 = current($items3);
          $item4 = current($items4);
          $item5 = current($items5);
          $item6 = current($items6);
          $item7 = current($items7);




          ////// ASIGNARLOS A VARIABLES ///////////////////
          $idmplan=(( $item1 !== false) ? $item1 : ", &nbsp;");
          $country_no=(( $item2 !== false) ? $item2 : ", &nbsp;");
          $countryname=(( $item3 !== false) ? $item3 : ", &nbsp;");
          $sesion=(( $item4 !== false) ? $item4 : ", &nbsp;");
          $jornada=(( $item5 !== false) ? $item5 : ", &nbsp;");
          $obs_detalle=(( $item6 !== false) ? $item6 : ", &nbsp;");
          $estado=(( $item7 !== false) ? $item7 : ", &nbsp;");


          //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIoN ////////
          $valores="('$idmplan','$country_no','$countryname','$sesion','$jornada','$obs_detalle','$estado'),";

          //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCI�N SUBSTR EN LA ULTIMA FILA /////////////////////
          $valoresQ= substr($valores, 0, -1);

          ///////// QUERY DE INSERCI�N ////////////////////////////
          $sql = "INSERT INTO d_plan (id_m_plan, cups, descrip_cups, sesion, jornada, obs_detalle, estado_d_plan	)
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
          $item7 = next( $items7 );

          // Check terminator
          if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false && $item7 === false) break;

      }

      }

    ?>
  </body>
</html>
