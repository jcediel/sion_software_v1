<h1>Gestion de inventarios en Dispositivos medicos</h1>
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

    /*case 'INVMED':
    $fv=$_POST['fvencimiento'];
    $fecha=$fv;
    $segundos= strtotime($fecha) - strtotime('now');
    $diferencia_dias=intval($segundos/60/60/24);

    if ($diferencia_dias>'365') {
      $semaforo='verde';
      $f=date('Y-m-d H:m');
      $sql="INSERT INTO subpro_medicametos( id_user, id_pro_med, id_proveedor, fcreacion, cod_atc, prin_activo, concentracion, presentacion, clas_pos, clas_controlado, clas_psiquiatrico, ffabricacion, fvencimiento, lote, reg_invima, laboratorio, cum, num_factura, precio_compra, cantidad_total, cod_barras, semaforo, estado_inv_med) values
      ('".$_SESSION["AUT"]["id_user"]."','".$_POST["idb"]."','".$_POST["id_proveedor"]."','$f','".$_POST["cod_atc"]."','".$_POST["prin_activo"]."','".$_POST["concentracion"]."','".$_POST["presentacion"]."','".$_POST["clas_pos"]."','".$_POST["clas_controlado"]."','".$_POST["clas_psiquiatrico"]."','".$_POST["ffabricacion"]."','".$_POST["fvencimiento"]."','".$_POST["lote"]."','".$_POST["reg_invima"]."','".$_POST["laboratorio"]."','".$_POST["cum"]."','".$_POST["num_factura"]."','".$_POST["precio_compra"]."','".$_POST["cantidad_total"]."','".$_POST["cod_barras"]."','$semaforo','Activo')";
      $subtitulo1="El medicamento";
      $subtitulo="Adicionado";
      $t=$_POST['nombog'];
    }
    if ($diferencia_dias >= '183' && $diferencia_dias <= '365') {
      $semaforo='Amarillo';
      $f=date('Y-m-d H:m');
      $sql="INSERT INTO subpro_medicametos( id_user, id_pro_med, id_proveedor, fcreacion, cod_atc, prin_activo, concentracion, presentacion, clas_pos, clas_controlado, clas_psiquiatrico, ffabricacion, fvencimiento, lote, reg_invima, laboratorio, cum, num_factura, precio_compra, cantidad_total, cod_barras, semaforo, estado_inv_med) values
      ('".$_SESSION["AUT"]["id_user"]."','".$_POST["idb"]."','".$_POST["id_proveedor"]."','$f','".$_POST["cod_atc"]."','".$_POST["prin_activo"]."','".$_POST["concentracion"]."','".$_POST["presentacion"]."','".$_POST["clas_pos"]."','".$_POST["clas_controlado"]."','".$_POST["clas_psiquiatrico"]."','".$_POST["ffabricacion"]."','".$_POST["fvencimiento"]."','".$_POST["lote"]."','".$_POST["reg_invima"]."','".$_POST["laboratorio"]."','".$_POST["cum"]."','".$_POST["num_factura"]."','".$_POST["precio_compra"]."','".$_POST["cantidad_total"]."','".$_POST["cod_barras"]."','$semaforo','Activo')";
      $subtitulo1="El medicamento";
      $subtitulo="Adicionado";
      $t=$_POST['nombog'];
    }
    if ($diferencia_dias < '183') {
      $semaforo='Rojo';
      $f=date('Y-m-d H:m');
      $sql="INSERT INTO subpro_medicametos( id_user, id_pro_med, id_proveedor, fcreacion, cod_atc, prin_activo, concentracion, presentacion, clas_pos, clas_controlado, clas_psiquiatrico, ffabricacion, fvencimiento, lote, reg_invima, laboratorio, cum, num_factura, precio_compra, cantidad_total, cod_barras, semaforo, estado_inv_med) values
      ('".$_SESSION["AUT"]["id_user"]."','".$_POST["idb"]."','".$_POST["id_proveedor"]."','$f','".$_POST["cod_atc"]."','".$_POST["prin_activo"]."','".$_POST["concentracion"]."','".$_POST["presentacion"]."','".$_POST["clas_pos"]."','".$_POST["clas_controlado"]."','".$_POST["clas_psiquiatrico"]."','".$_POST["ffabricacion"]."','".$_POST["fvencimiento"]."','".$_POST["lote"]."','".$_POST["reg_invima"]."','".$_POST["laboratorio"]."','".$_POST["cum"]."','".$_POST["num_factura"]."','".$_POST["precio_compra"]."','".$_POST["cantidad_total"]."','".$_POST["cod_barras"]."','$semaforo','Activo')";
      $subtitulo1="El medicamento";
      $subtitulo="Adicionado";
      $t=$_POST['nombog'];
    }
    break;*/

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
    $sql="SELECT id_generico_ins,nom_generico FROM generico_medicamento  where id_generico_ins='".$_GET['idgenerico']."'";
    $color="green";
    $boton="Actualizar Generico";
    $atributo1=' readonly="readonly"';
    $atributo2='readonly="readonly"';
    $atributo3='';
    $date=date('Y-m-d');
    $date1=date('H:i');
    $form1='formularios/agr_generico.php';
    $subtitulo='Edicion del Generico';
    break;

    case 'A':
    $sql="SELECT * from generico_insumos where id_generico_ins=".$_GET['id_gen'];
    $color="yellow";
    $boton="Crear Producto";
    $atributo1=' readonly="readonly"';
    $atributo2='';
    $atributo3='';
    $date=date();
    $date=date('Y-m-d');
    $date1=date('H:i');
    $form1='formularios/inv_insumos.php';
    $subtitulo='Creacion de productos (Medicamentos)';
    break;
  }

  if($sql!=""){
    if (!$fila=$bd1->sub_fila($sql)){

      $fila=array("id_generico_ins"=>"", "nom_generico"=>"");

    }
  }else{
      $fila=array("id_generico_ins"=>"", "nom_generico"=>"");
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
      <th id="th-estilo4">Edicion producto</th>
      <th id="th-estilo1">PRODUCTO</th>
      <th id="th-estilo1">FABRICANTE</th>
      <th id="th-estilo1">SEMAFORIZACION</th>
      <th id="th-estilo4">Ver detalles</th>
    </tr>

    <?php

  if (isset($_REQUEST["idgen"])){
    $doc=$_REQUEST["idgen"];
    $sql="SELECT id_pro_ins,id_generico_ins,nom_insumo,fabricante,semaforo where producto_insumos from id_generico_ins=".$doc;

    if ($tabla=$bd1->sub_tuplas($sql)){

      foreach ($tabla as $fila ) {
//echo $sql;
        echo"<tr >	\n";
        echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=E&idgenerico='.$fila["id_generico_ins"].'"><button type="button" class="btn btn-primary sombra_movil " ><span class="fa fa-pencil"></span></button></a></th>';
        echo'<td class="text-center">'.$fila["nom_insumo"].' </td>';
        echo'<td class="text-center">'.$fila["fabricante"].'</td>';
        echo'<td class="text-center">'.$fila["semaforo"].'</td>';
        echo'<th class="text-center" ><a href="'.PROGRAMA.'?opcion=94&idgen='.$fila["id_generico_ins"].'"><button type="button" class="btn btn-success sombra_movil " ><span class="fa fa-flask"></span></button></a></th>';
        echo "</tr>\n";
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
