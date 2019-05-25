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
    <title>jquery autocomplete using ajax php mysql </title>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="./detalle_cups/css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="./detalle_cups/css/main.css" />

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="./detalle_cups/js/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
 	</head>
 	<body>
    <?php
      $idadmhosp=$_REQUEST['idadmhosp'];
      $servicio=$_REQUEST['servicio'];
      $doc=$_REQUEST['doc'];
      $tf=$_REQUEST['tf'];
    ?>
    <section class="col-xs-7">
        <a class="btn btn-primary" href="<?php echo PROGRAMA.'?opcion=31&idadm='.$_REQUEST['idadm'].'&servicio='.$_REQUEST['servicio'].'&doc='.$_REQUEST['doc'].'';?>">
          <span class="glyphicon glyphicon-triangle-left">Regresar a Orden de autorización</span></a>
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
							    <th class="alert alert-info col-xs-1"><input class='check_all' type='checkbox' onclick="select_all()"/></th>
							    <th class="alert alert-info col-xs-1">#</th>
                  <th class="col-xs-4 text-center info">PROCEDIMIENTO</th>
                  <th class="col-xs-6 text-center info">INFORMACION</th>
							</tr>
							<tr>
						    	<td class="col-xs-1"><input type='checkbox' class='case'/></td>
						    	<td class="col-xs-1"><span id='snum'>1.</span></td>
						   	 	<td class="col-xs-5">
                    <article class="col-xs-12">
                      <textarea class="form-control" id='countryname_1' name='countryname[]' rows="3"></textarea>
                    </article>
                    <article class="col-xs-3 form-group">
                      <input class="form-control" type='text' id='phone_code_1' name='phone_code[]'/> <!--pos o no pos-->
                    </article>
                    <article class="col-xs-3 form-group">
                      <input class="form-control" type='text' id='country_code_1' name='country_code[]'/> <!--alto o no alto costo-->
                    </article>
                  </td>
                  <td class="col-xs-6">
                    <article class="col-xs-3">
                      <label>Cantidad:</label>
                      <input class="form-control" type='number' id='cantidad' name='cantidad[]'/>
                    </article>
                    <article class="col-xs-3">
                      <label for="">CUPS</label>
                      <input class="form-control" type='text' id='country_no_1' name='country_no[]'/> <!--id_producto-->
                    </article>
                    <article class="col-xs-3">
                      <label for="">ID AUT:</label>
                      <input class="form-control" type='text' id='iddautori' required name='iddautori[]' value="<?php echo $_REQUEST['idm'];?>" <?php echo $atributo1; ?>/>
                    </article>
                    <article class="col-xs-5">
                      <label for="">Intervalo:</label>
                      <select class="form-control" id='intervalo' required name='intervalo[]'>
                        <option value=""></option>
                        <option value="60">60 MINUTOS</option>
                        <option value="40">40 MINUTOS</option>
                        <option value="30">30 MINUTOS</option>
                        <option value="20">20 MINUTOS</option>
                        <option value="15">15 MINUTOS</option>
                        <option value="10">10 MINUTOS</option>
                        <option value="0">NO APLICA</option>
                      </select>
                      <input type="hidden" id='estado' name='estado[]' value="Solicitado">
                    </article>
                  </td>
						  	</tr>
					  	</table>
              <button type="button" class='btn btn-danger btn-lg fa fa-minus fa-2x delete'>Borrar Procedimiento</button>
              <button type="button" class='btn btn-success btn-lg fa fa-plus fa-2x addmore'>Agregar Procedimiento</button>
					</div>
          <br>
          <div class="col-xs-12 text-center">
            <input type="submit" name="insertar" value="Guardar Procedimientos" class="btn btn-primary btn-lg"/>
          </div>
				</form>
		</div>
	</div>

	<div class="clearfix"></div>
    <script src="./detalle_cups/js/auto.js"></script>
    <?php

      if(isset($_POST['insertar']))

      {

      $items1 = ($_POST['iddautori']);
      $items2 = ($_POST['country_no']);
      $items3 = ($_POST['countryname']);
      $items4 = ($_POST['intervalo']);
      $items5 = ($_POST['cantidad']);
      $items6 = ($_POST['estado']);

      while(true) {

          $item1 = current($items1);
          $item2 = current($items2);
          $item3 = current($items3);
          $item4 = current($items4);
          $item5 = current($items5);
          $item6 = current($items6);

          $id_m_autori=(( $item1 !== false) ? $item1 : ", &nbsp;");
          $cod_cups=(( $item2 !== false) ? $item2 : ", &nbsp;");
          $cups=(( $item3 !== false) ? $item3 : ", &nbsp;");
          $frecuencia=(( $item4 !== false) ? $item4 : ", &nbsp;");
          $cantidad=(( $item5 !== false) ? $item5 : ", &nbsp;");
          $estado=(( $item6 !== false) ? $item6 : ", &nbsp;");

          $valores="('$id_m_autori','$cod_cups','$cups','$frecuencia','$cantidad','$estado'),";

          $valoresQ= substr($valores, 0, -1);

          $sql = "INSERT INTO d_autorizacion (id_m_autori, cod_cups, cups, frecuencia, cantidad, estado_d_autori)
        VALUES $valoresQ;";
        //echo $sql;

        $sqlRes=$conexion->query($sql) or mysql_error();

          $item1 = next( $items1 );
          $item2 = next( $items2 );
          $item3 = next( $items3 );
          $item4 = next( $items4 );
          $item5 = next( $items5 );
          $item6 = next( $items6 );

          if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false )
          break;
      }
    }
    ?>
  </body>
</html>
