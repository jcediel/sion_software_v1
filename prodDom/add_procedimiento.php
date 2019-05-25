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
    <meta name="description" content="jquery autocomplete">
	<meta name="keywords" content="jquery autocomplete">
	<meta name="author" content="muni">
    <title>SION software </title>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="./prodDom/css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="./prodDom/css/main.css" />

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="./prodDom/js/jquery-ui.min.js"></script>

 	</head>
 	<body>
    <?php
      $idadmhosp=$_REQUEST['idadmhosp'];
      $servicio=$_REQUEST['servicio'];
      $doc=$_REQUEST['doc'];
      $tf=$_REQUEST['tf'];
    ?>
    <section class="col-xs-7">
        <a class="btn btn-primary" href="<?php echo PROGRAMA.'?opcion=183&doc='.$_REQUEST['doc'].'';?>">
          <span class="glyphicon glyphicon-triangle-left">Regresar a paciente</span></a>
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
                  <th class="col-xs-5 text-center info">Procedimiento</th>
                  <th class="col-xs-5 text-center info">Detalles</th>
                  <th class="col-xs-5 text-center info">Fechas</th>
							</tr>
							<tr>
						    	<td ><input type='checkbox' class='case'/></td>
						    	<td ><span id='snum'>1.</span></td>
						   	 	<td class="col-xs-3">
                    <article class="col-xs-12">
                      <label>Escriba palabra clave o CUPS y seleccione del listado:</label>
                      <textarea class="form-control" id='countryname_1' required name='countryname[]' rows="3"></textarea>
                    </article>
                    <article class="col-xs-12  form-group">
                      <label>CUPS seleccionado:</label>
                      <input class="form-control" type='text' id='country_no_1' name='country_no[]'/> <!--cups-->
                    </article>
                    <article class="col-xs-12  form-group">
                      <label>Servicio:</label>
                      <input class="form-control" type='text' id='phone_code_1' name='phone_code[]'/> <!--CLASIFICACION EN TIPO PROCEDIMIENTO-->
                    </article>
                    <article class="col-xs-12  form-group">
                      <input class="form-control" type='hidden' id='country_code_1' name='country_code[]'/> <!--alto o no alto costo-->
                    </article>
                    <article class="col-xs-12  form-group">
                      <input class="form-control" type='text' id='idm_prod' required name='idm_prod[]' value="<?php echo $_REQUEST['idm'];?>" <?php echo $atributo1; ?>/>
                    </article>
                  </td>
						    	<td class="col-xs-2">
                    <label for="">Cantidad sesiones:</label>
                    <input type="number" class="form-control" required name="cantidad[]" value="">
                    <label for="">Intervalo:</label>
                    <select class="form-control" id='intervalo' required name="intervalo[]" >
                      <option value=""></option>
                      <option value="40">40 minutos</option>
                      <option value="60">60 minutos</option>
                      <option value="3">3 horas</option>
                      <option value="6">6 horas</option>
                      <option value="8">8 horas</option>
                      <option value="12">12 horas</option>
                      <option value="24">24 horas</option>
                    </select>
                    <label>Temporalidad:</label>
                    <select class="form-control"  name="temporalidad[]">
                      <option value=""></option>
                      <option value="0">No aplica </option>
                      <option value="L-V">L-V</option>
                      <option value="L-S">L-S</option>
                      <option value="D-D">D-D</option>
                    </select>
                    <label for=""># autorización:</label>
                    <input type="text" class="form-control" name="aut_externo[]" value="">
                    <input type="hidden" id='estado' name='estado[]' value="1">
						    	</td>
                  <td>
                    <label for="">Fecha inicial:</label>
                    <input class="form-control" type='date' id='fecha' required name='f_inicio[]' value=""/>
                    <label for="">Fecha final:</label>
                    <input class="form-control" type='date' id='fecha' required name='f_final[]' value=""/>
                  </td>
						  	</tr>
					  	</table>
              <button type="button" class='btn btn-danger fa fa-minus delete'> Borrar Procedimiento</button>
              <button type="button" class='btn btn-success fa fa-plus addmore'> Agregar Procedimiento</button>
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
    <script src="./prodDom/js/auto.js"></script>
    <?php

      //////////////////////// PRESIONAR EL BOT�N //////////////////////////
      if(isset($_POST['insertar']))

      {

      $items1 = ($_POST['idm_prod']);
      $items2 = ($_POST['country_no']);
      $items3 = ($_POST['countryname']);
      $items4 = ($_POST['cantidad']);
      $items5 = ($_POST['aut_externo']);
      $items6 = ($_POST['f_inicio']);
      $items7 = ($_POST['f_final']);
      $items8 = ($_POST['estado']);
      $items9 = ($_POST['intervalo']);
      $items10 = ($_POST['temporalidad']);
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
          $item8 = current($items8);
          $item9 = current($items9);
          $item10 = current($items10);


          ////// ASIGNARLOS A VARIABLES ///////////////////
          $idm_prod=(( $item1 !== false) ? $item1 : ", &nbsp;");
          $country_no=(( $item2 !== false) ? $item2 : ", &nbsp;");
          $countryname=(( $item3 !== false) ? $item3 : ", &nbsp;");
          $cantidad=(( $item4 !== false) ? $item4 : ", &nbsp;");
          $aut_externo=(( $item5 !== false) ? $item5 : ", &nbsp;");
          $finicio=(( $item6 !== false) ? $item6 : ", &nbsp;");
          $ffinal=(( $item7 !== false) ? $item7 : ", &nbsp;");
          $estado=(( $item8 !== false) ? $item8 : ", &nbsp;");
          $intervalo=(( $item9 !== false) ? $item9 : ", &nbsp;");
          $temporalidad=(( $item10 !== false) ? $item10 : ", &nbsp;");

          //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIoN ////////
          $valores="('$idm_prod','$country_no','$countryname','$cantidad','$finicio','$ffinal','$aut_externo','$estado','$intervalo','$temporalidad'),";

          //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCI�N SUBSTR EN LA ULTIMA FILA /////////////////////
          $valoresQ= substr($valores, 0, -1);

          ///////// QUERY DE INSERCI�N ////////////////////////////
          $sql = "INSERT INTO d_aut_dom (id_m_aut_dom, cups, procedimiento, cantidad, finicio, ffinal, num_aut_externa, estado_d_aut_dom,intervalo,temporalidad)
        VALUES $valoresQ;";
        //echo $sql;

        $sqlRes=$conexion->query($sql) or mysql_error();


          // Up! Next Value
          $item1 = next( $items1 );
          $item2 = next( $items2 );
          $item3 = next( $items3 );
          $item4 = next( $items4 );
          $item5 = next( $items5 );
          $item6 = next( $items6 );
          $item7 = next( $items7 );
          $item8 = next( $items8 );
          $item9 = next( $items9 );
          $item10 = next( $items10);


          // Check terminator
          if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false  && $item6 === false  && $item7 === false && $item8 === false && $item9 === false && $item10 === false) break;
      }
      }
    ?>
  </body>
</html>
