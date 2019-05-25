<h1>Gestion de inventarios en Medicamentos</h1>
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

    case 'A':
    $fv=$_POST['fvencimiento'];
    $fecha=$fv;
    $segundos= strtotime($fecha) - strtotime('now');
    $diferencia_dias=intval($segundos/60/60/24);

    if ($diferencia_dias>'365') {
      $semaforo='Verde';
      $f=date('Y-m-d H:m');
      $sql="INSERT INTO producto_medicamento( id_generico_med, id_bodega, id_user, fcreacion, nom_med,concentracion, presentacion, ffarma, atc, cum, lote, reg_invima, laboratorio, ffabricacion,fvencimiento, factura, precio_compra, cantidad, codbarra, semaforo, clase_pos, clase_regulado,clase_psiquiatrico, estado_pro_med, id_proveedor) values
      ('".$_POST["id_gen"]."','".$_POST["id_bodega"]."','".$_SESSION["AUT"]["id_user"]."','$f','".$_POST["nom_med"]."','".$_POST["concentracion"]."', '".$_POST["presentacion"]."', '".$_POST["ffarma"]."', '".$_POST["atc"]."', '".$_POST["cum"]."', '".$_POST["lote"]."', '".$_POST["reg_invima"]."', '".$_POST["laboratorio"]."', '".$_POST["ffabricacion"]."','".$_POST["fvencimiento"]."', '".$_POST["factura"]."', '".$_POST["precio_compra"]."', '".$_POST["cantidad"]."', '".$_POST["codbarra"]."', '$semaforo', '".$_POST["clase_pos"]."', '".$_POST["clase_regulado"]."','".$_POST["clase_psiquiatrico"]."', 'Activo', '".$_POST["id_proveedor"]."')";
      $subtitulo1="El medicamento";
      $subtitulo="Adicionado";
      $t=$_POST['nombog'];
    }
    if ($diferencia_dias >= '183' && $diferencia_dias <= '365') {
      $semaforo='Amarillo';
      $f=date('Y-m-d H:m');
      $sql="INSERT INTO producto_medicamento( id_generico_med, id_bodega, id_user, fcreacion, nom_med,concentracion, presentacion, ffarma, atc, cum, lote, reg_invima, laboratorio, ffabricacion,fvencimiento, factura, precio_compra, cantidad, codbarra, semaforo, clase_pos, clase_regulado,clase_psiquiatrico, estado_pro_med, id_proveedor) values
      ('".$_POST["id_gen"]."','".$_POST["id_bodega"]."','".$_SESSION["AUT"]["id_user"]."','$f','".$_POST["nom_med"]."','".$_POST["concentracion"]."', '".$_POST["presentacion"]."', '".$_POST["ffarma"]."', '".$_POST["atc"]."', '".$_POST["cum"]."', '".$_POST["lote"]."', '".$_POST["reg_invima"]."', '".$_POST["laboratorio"]."', '".$_POST["ffabricacion"]."','".$_POST["fvencimiento"]."', '".$_POST["factura"]."', '".$_POST["precio_compra"]."', '".$_POST["cantidad"]."', '".$_POST["codbarra"]."', '$semaforo', '".$_POST["clase_pos"]."', '".$_POST["clase_regulado"]."','".$_POST["clase_psiquiatrico"]."', 'Activo', '".$_POST["id_proveedor"]."')";
        $subtitulo1="El medicamento";
      $subtitulo="Adicionado";
      $t=$_POST['nombog'];
    }
    if ($diferencia_dias < '183') {
      $semaforo='Rojo';
      $f=date('Y-m-d H:m');
      $sql="INSERT INTO producto_medicamento( id_generico_med, id_bodega, id_user, fcreacion, nom_med,concentracion, presentacion, ffarma, atc, cum, lote, reg_invima, laboratorio, ffabricacion,fvencimiento, factura, precio_compra, cantidad, codbarra, semaforo, clase_pos, clase_regulado,clase_psiquiatrico, estado_pro_med, id_proveedor) values
      ('".$_POST["id_gen"]."','".$_POST["id_bodega"]."','".$_SESSION["AUT"]["id_user"]."','$f','".$_POST["nom_med"]."','".$_POST["concentracion"]."', '".$_POST["presentacion"]."', '".$_POST["ffarma"]."', '".$_POST["atc"]."', '".$_POST["cum"]."', '".$_POST["lote"]."', '".$_POST["reg_invima"]."', '".$_POST["laboratorio"]."', '".$_POST["ffabricacion"]."','".$_POST["fvencimiento"]."', '".$_POST["factura"]."', '".$_POST["precio_compra"]."', '".$_POST["cantidad"]."', '".$_POST["codbarra"]."', '$semaforo', '".$_POST["clase_pos"]."', '".$_POST["clase_regulado"]."','".$_POST["clase_psiquiatrico"]."', 'Activo', '".$_POST["id_proveedor"]."')";
      $subtitulo1="El medicamento";
      $subtitulo="Adicionado";
      $t=$_POST['nombog'];
    }
    break;

  }
echo $sql;
  if ($bd1->consulta($sql)){
    $subtitulo="$subtitulo1 fue  $subtitulo con exito al inventario de $t.";
    $check='si';
    if($_POST["operacion"]=="X"){
    if(is_file($fila["logo"])){
      unlink($fila["logo"]);
    }
    }
  }else{
    $subtitulo="$subtitulo1 NO fue  $subtitulo con exito al inventario de $t.";
    $check='no';
  }
}
}

if (isset($_GET["mante"])){					///nivel 2
  switch ($_GET["mante"]) {
  case 'E':
    $sql="SELECT a.id_generico_med,nom_generico,b.* from generico_medicamento a INNER JOIN producto_medicamento b on a.id_generico_med=b.id_generico_med where id_pro_med=".$_GET['idproducto'];
    $color="green";
    $boton="Actualizar Generico";
    $atributo1=' readonly="readonly"';
    $atributo2='readonly="readonly"';
    $atributo3='';
    $date=date('Y-m-d');
    $date1=date('H:i');
    $form1='formularios/inv_medicamentos.php';
    $subtitulo='Edicion del producto';
    break;

    case 'A':
    $sql="SELECT * from generico_medicamento where id_generico_med= ".$_GET['idgen'];
    $color="yellow";
    $boton="Crear Producto";
    $atributo1=' readonly="readonly"';
    $atributo2='';
    $atributo3='';
    $date=date();
    $date=date('Y-m-d');
    $date1=date('H:i');
    $form1='formularios/inv_medicamentos.php';
    $subtitulo='Creacion de productos (Medicamentos)';
    break;
  }
  if($sql!=""){
    if (!$fila=$bd1->sub_fila($sql)){

      $fila=array("id_generico_med"=>"", "nom_generico"=>"","id_pro_med"=>"", "id_bodega"=>"", "id_user"=>"", "fcreacion"=>"", "nom_med"=>"", "concentracion"=>"", "presentacion"=>"", "ffarma"=>"", "atc"=>"", "cum"=>"", "lote"=>"", "reg_invima"=>"", "laboratorio"=>"", "ffabricacion"=>"", "fvencimiento"=>"", "factura"=>"", "precio_compra"=>"", "cantidad"=>"", "codbarra"=>"", "semaforo"=>"", "clase_pos"=>"", "clase_regulado"=>"", "clase_psiquiatrico"=>"", "estado_pro_med"=>"", "id_proveedor"=>"");

    }
  }else{
      $fila=array("id_generico_med"=>"", "nom_generico"=>"","id_pro_med"=>"", "id_bodega"=>"", "id_user"=>"", "fcreacion"=>"", "nom_med"=>"", "concentracion"=>"", "presentacion"=>"", "ffarma"=>"", "atc"=>"", "cum"=>"", "lote"=>"", "reg_invima"=>"", "laboratorio"=>"", "ffabricacion"=>"", "fvencimiento"=>"", "factura"=>"", "precio_compra"=>"", "cantidad"=>"", "codbarra"=>"", "semaforo"=>"", "clase_pos"=>"", "clase_regulado"=>"", "clase_psiquiatrico"=>"", "estado_pro_med"=>"", "id_proveedor"=>"");
    }

  ?>
<script src = "js/sha3.js"></script>
  <script>
    function validar(){
      if (document.forms[0].nom_pro_med.value == ""){
        alert("Se requiere el nombre de ");
        document.forms[0].nom_pro_med.focus();				// Ubicar el cursor
        return(false);
      }
      if (document.forms[0].cantidad_total.value == ""){
        alert("Se requiere cantidad inicial");
        document.forms[0].cantidad_total.focus();				// Ubicar el cursor
        return(false);
      }
    }
  </script>
  <div class="alert alert-info animated bounceInRight">
    <?php echo $subtitulo;?>
  </div>
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
}// nivel 1?>
<div class="panel-default">

  <table class="table table-responsive">
    <tr>
      <th id="th-estilo4">Editar producto</th>
      <th id="th-estilo1">PRODUCTO</th>
      <th id="th-estilo1">LABORATORIO</th>
      <th id="th-estilo1">SEMAFORIZACION</th>
      <th id="th-estilo1">CANTIDAD</th>
      <th id="th-estilo4">Ver detalles</th>
    </tr>

    <?php

  if (isset($_REQUEST["idgen"])){
    $doc=$_REQUEST["idgen"];
    $sql="SELECT id_pro_med, id_generico_med, id_bodega, id_user, fcreacion, nom_med, concentracion, presentacion, ffarma, atc, cum, lote, reg_invima, laboratorio, ffabricacion, fvencimiento, factura, precio_compra, cantidad, codbarra, semaforo, clase_pos, clase_regulado, clase_psiquiatrico, estado_pro_med, id_proveedor from producto_medicamento where id_generico_med=".$doc;

    if ($tabla=$bd1->sub_tuplas($sql)){

      foreach ($tabla as $fila ) {
        if ($fila['semaforo']=='Verde') {
          echo"<tr>\n";
          $idpro=$fila['id_pro_med'];
          echo'<th class="text-center alert-success" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idproducto='.$idpro.'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-pencil"></span></button></a></th>';
          echo'<td class="text-center alert-success">'.$fila["nom_med"].' '.$fila["concentracion"].' '.$fila["presentacion"].'</td>';
          echo'<td class="text-center alert-success">'.$fila["laboratorio"].'</td>';
          echo'<td class="text-center alert-success">'.$fila["semaforo"].'</td>';
          echo'<td class="text-center alert-success">'.$fila["cantidad"].'</td>';
          echo'<th class="text-center alert-success" ><a class="btn btn-success" data-toggle="modal" data-target="#detalle_producto" type="button" ><span class="fa fa-eye"></span></a></th>';
          echo "</tr>\n";
        }
        if ($fila['semaforo']=='Amarillo') {
          echo"<tr >	\n";
          echo'<th class="text-center alert-warning" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idgenerico='.$fila["id_generico_med"].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-pencil"></span></button></a></th>';
          echo'<td class="text-center alert-warning">'.$fila["nom_med"].' '.$fila["concentracion"].' '.$fila["presentacion"].'</td>';
          echo'<td class="text-center alert-warning">'.$fila["laboratorio"].'</td>';
          echo'<td class="text-center alert-warning">'.$fila["semaforo"].'</td>';
          echo'<td class="text-center alert-success">'.$fila["cantidad"].'</td>';
          echo'<th class="text-center alert-success" ><a class="btn btn-success" data-toggle="modal" data-target="#detalle_producto" type="button" ><span class="fa fa-eye"></span></a></th>';
          echo "</tr>\n";
        }
        if ($fila['semaforo']=='Rojo') {
          echo"<tr >	\n";
          echo'<th class="text-center alert-danger" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idgenerico='.$fila["id_generico_med"].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-pencil"></span></button></a></th>';
          echo'<td class="text-center alert-danger">'.$fila["nom_med"].' '.$fila["concentracion"].' '.$fila["presentacion"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["laboratorio"].'</td>';
          echo'<td class="text-center alert-danger">'.$fila["semaforo"].'</td>';
          echo'<td class="text-center alert-success">'.$fila["cantidad"].'</td>';
          echo'<th class="text-center alert-success" ><a class="btn btn-success" data-toggle="modal" data-target="#detalle_producto" type="button" ><span class="fa fa-eye"></span></a></th>';
          echo "</tr>\n";
        }
      }
    }
  }
    ?>
    <tr>
      <th colspan="11" class="text-center"><a href="<?php echo PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=A&idgen='.$_REQUEST["idgen"].''?>" align="center" ><button type="button" class="btn btn-primary" >Nuevo Producto</button></a></th>
    </tr>
  </table>
  </div>

    <?php
  }
  ?>
  <section class="modal fade" id="detalle_producto" role="dialog">
    <section class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Detalle producto seleccionado</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tr>

            </tr>
            <?php
            if (isset($_REQUEST["idgen"])){
            $id=$_REQUEST["idgen"];
            $sql="SELECT * from producto_medicamento where id_generico_med=".$id;
              //echo $sql;
            if ($tabla=$bd1->sub_tuplas($sql)){
              //echo $sql;
              foreach ($tabla as $fila ) {

                echo"<tr>\n";
                echo'<td class="text-center info"><b>Principio activo</b></td>';
                echo'<td class="text-left">'.$fila["nom_med"].' '.$fila["concentracion"].' '.$fila["ffarma"].' '.$fila["presentacion"].'</td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info" ><b>Laboratorio</b></td>';
                echo'<td class="text-center info" ><b>Fecha vencimiento</b></td>';
                echo'<td class="text-center info" ><b>CUM</b></td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-left">'.$fila["laboratorio"].'</td>';
                echo'<td class="text-left">'.$fila["fvencimiento"].'</td>';
                echo'<td class="text-left">'.$fila["cum"].'</td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-center info" ><b>ATC</b></td>';
                echo'<td class="text-center info" ><b>Registro INVIMA</b></td>';
                echo'<td class="text-center info" ><b>Cantidad</b></td>';
                echo '</tr>';
                echo"<tr >\n";
                echo'<td class="text-left">'.$fila["atc"].'</td>';
                echo'<td class="text-left">'.$fila["reg_invima"].'</td>';
                echo'<td class="text-left">'.$fila["cantidad"].'</td>';
                echo '</tr>';
                echo '<tr>';
                echo'<td class="text-center info" ><b>Semaforizacion</b></td>';
                echo'<td class="text-left">'.$fila["semaforo"].'</td>';
                echo '</tr>';

              }
            }
          }
            ?>
          </table>
        </div>
      </div>
    </section>
  </section>
