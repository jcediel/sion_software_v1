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
    <link rel="stylesheet" href="./medicacion/css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="./medicacion/css/main.css" />

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="./medicacion/js/jquery-ui.min.js"></script>

 	</head>
 	<body>
    <?php
      $idadmhosp=$_REQUEST['idadmhosp'];
      $servicio=$_REQUEST['servicio'];
      $atencion=$_REQUEST['atencion'];
      $idm=$_REQUEST['idm'];
      $sede=$_REQUEST['sede'];
      $doc=$_REQUEST['doc'];
      $tf=$_REQUEST['tf'];
      $bod=$_REQUEST['bod'];
    ?>
  <?php include('consulta_ultimaEvo.php') ?>

    <section class="col-xs-7">
        <a class="btn btn-primary" href="<?php echo PROGRAMA.'?opcion=153&idm='.$idm.'&idadmhosp='.$idadmhosp.'&servicio='.$servicio.'&doc='.$doc.'&atencion='.$atencion.'&sede='.$sede.'&bod='.$bod.'&atencion='.$atencion.'&tf='.$tf;?>"><span class="glyphicon glyphicon-triangle-left">Regresar a listado de Formula</span></a>
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
							    <th class="alert alert-info">MEDICAMENTO</th>
							    <th class="alert alert-info">Via administracion</th>
							    <th class="alert alert-info">Frecuencia</th>
							    <th class="alert alert-info">6am-8am</th>
                  <th class="alert alert-info">12m-2pm</th>
                  <th class="alert alert-info">6pm-8pm</th>
                  <th class="alert alert-info">10pm-12pm</th>
                  <th class="alert alert-info">Observacion</th>
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
                      <input class="form-control" type='hidden' id='idmfmedhosp' required name='idmfmedhosp[]' value="<?php echo $_REQUEST['idm'];?>" <?php echo $atributo1; ?>/>
                    </article>
                  </td>
						    	<td class="col-xs-2">
                    <select class="form-control" id='via' required name='via[]' required="">
                      <option value=""></option>
                      <option value="intravenosa">intravenosa</option>
                      <option value="oral">oral</option>
                      <option value="intramuscular">Intramuscular</option>
                      <option value="sublingual">sublingual</option>
                      <option value="topica">Topica</option>
                      <option value="transdermica">Transdermica</option>
                      <option value="oftalmica">Oftalmica</option>
                      <option value="otica">itica</option>
                      <option value="intranasal">Intranasal</option>
                      <option value="inhalatoria">Inhalatoria</option>
                      <option value="rectal">Rectal</option>
                      <option value="vaginal">Vaginal</option>
                      <option value="subcutanea">Subcutanea</option>
                      <option value="pañales">pañales</option>
						    	  </select>
						    	</td>
						    	<td>
                    <select class="form-control" id='f' required name='f[]' required="">
                      <option value=""></option>
						    	    <option value="24">24 Horas</option>
                      <option value="12">12 Horas</option>
                      <option value="8">8 Horas</option>
                      <option value="6">6 Horas</option>
                      <option value="4">4 Horas</option>
						    	  </select>
						    	</td>
                  <td class="col-xs-1"><input class="form-control" type='number' id='dosis1' name='dosis1[]' value='0'/> <input class="form-control" type='hidden' id='estadomed' name='estado[]' value='Solicitado'/> </td>
									<td class="col-xs-1"><input class="form-control" type='number' id='dosis2' name='dosis2[]' value='0'/> </td>
									<td class="col-xs-1"><input class="form-control" type='number' id='dosis3' name='dosis3[]' value='0'/> </td>
									<td class="col-xs-1"><input class="form-control" type='number' id='dosis4' name='dosis4[]' value='0'/> </td>
									<td class="col-xs-3"><textarea class="form-control" type='text' id='obsfmedhosp' required name='obsfmedhosp[]' rows="4"/></textarea> </td>
						  	</tr>
					  	</table>
					  	<button type="button" class='btn btn-danger btn-lg delete'>- Eliminar Medicamento</button>
						<button type="button" class='btn btn-success btn-lg addmore'>+ Adicionar Medicamento</button>
					</div>
          <br>
          <div class="col-xs-12 text-center">
            <input type="submit" name="insertar" value="Guardar Medicamentos" class="btn btn-primary btn-lg"/>
          </div>
				</form>
		</div>
	</div><!-- /container -->

	<div class="clearfix"></div>

    <!-- /Footer -->
    <script src="./medicacion/js/auto.js"></script>
    <?php

      //////////////////////// PRESIONAR EL BOT�N //////////////////////////
      if(isset($_POST['insertar']))

      {

      $items1 = ($_POST['idmfmedhosp']);
      $items2 = ($_POST['countryname']);
      $items3 = ($_POST['via']);
      $items4 = ($_POST['f']);
      $items5 = ($_POST['dosis1']);
      $items6 = ($_POST['dosis2']);
      $items7 = ($_POST['dosis3']);
      $items8 = ($_POST['dosis4']);
      $items9 = ($_POST['obsfmedhosp']);
      $items10 = ($_POST['estado']);
      $items11 = ($_POST['country_no']);


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
          $item11 = current($items11);

          ////// ASIGNARLOS A VARIABLES ///////////////////
          $idmfmedhosp=(( $item1 !== false) ? $item1 : ", &nbsp;");
          $countryname=(( $item2 !== false) ? $item2 : ", &nbsp;");
          $via=(( $item3 !== false) ? $item3 : ", &nbsp;");
          $f=(( $item4 !== false) ? $item4 : ", &nbsp;");
          $dosis1=(( $item5 !== false) ? $item5 : ", &nbsp;");
          $dosis2=(( $item6 !== false) ? $item6 : ", &nbsp;");
          $dosis3=(( $item7 !== false) ? $item7 : ", &nbsp;");
          $dosis4=(( $item8 !== false) ? $item8 : ", &nbsp;");
          $obsfmedhosp=(( $item9 !== false) ? $item9 : ", &nbsp;");
          $estado=(( $item10 !== false) ? $item10 : ", &nbsp;");
          $country_no=(( $item11 !== false) ? $item11 : ", &nbsp;");

          //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIoN ////////
          $valores="('$idmfmedhosp','$countryname','$via','$f','$dosis1','$dosis2','$dosis3','$dosis4','$obsfmedhosp','$estado','$country_no'),";

          //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCI�N SUBSTR EN LA ULTIMA FILA /////////////////////
          $valoresQ= substr($valores, 0, -1);

          ///////// QUERY DE INSERCI�N ////////////////////////////
          $sql = "INSERT INTO d_fmedhosp (id_m_fmedhosp, medicamento, via, frecuencia, dosis1, dosis2, dosis3, dosis4, obsfmedhosp,estado_med,cod_med)
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
          $item10 = next( $items10 );
          $item11 = next( $items11 );

          // Check terminator
          if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false&& $item7 === false&& $item8 === false&& $item9 === false&& $item10 === false && $item11 === false) break;

      }

      }

    ?>
  </body>
</html>
