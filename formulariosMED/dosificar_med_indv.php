<form action="<?php echo PROGRAMA.'?opcion=152&idadmhosp='.$return2.'&servicio=Hospitalario&f='.$return1.'&doc='.$return.'&sede='.$return3.'&bod='.$return4;?>" method="POST" enctype="multipart/form-data" onsubmit="return validar()" role="form" class="form-horizontal">
  <section class="panel panel-default">
    <section class="panel-heading">
      <h3><?php echo $subtitulo; ?></h4>
    </section>
    <section class="panel-body">
      <article class="col-xs-2">
  	  	<label for="">ID:</label>
  	  	<input type="text"  name="idd" class="form-control" value="<?php echo $fila["id_d_fmedhosp"];?>"<?php echo $atributo1;?>/>
  	  </article>
  	  <article class="col-xs-3">
  	  	<label for="">Franja despachada:</label>
  	  	<input type="text" name="nom_dosi" class="form-control" value="<?php echo $_GET['dosis'];?>" <?php echo $atributo1;?>>
      </article>
      <article class="col-xs-3">
  	  	<label for="">Cantidad Despachada:</label>
        <?php
          $dosis=$_REQUEST['dosis'];
          if ($dosis=='6am-8am') {
            ?>
            <input type="text" name="cant_dosi" class="form-control" value="<?php echo $fila['dosis1'];?>" >
            <?php
          }
          if ($dosis=='12m-2pm') {
            ?>
            <input type="text" name="cant_dosi" class="form-control" value="<?php echo $fila['dosis2'];?>" >
            <?php
          }
          if ($dosis=='6pm-8pm') {
            ?>
            <input type="text" name="cant_dosi" class="form-control" value="<?php echo $fila['dosis3'];?>" >
            <?php
          }
          if ($dosis=='10pm-12pm') {
            ?>
            <input type="text" name="cant_dosi" class="form-control" value="<?php echo $fila['dosis4'];?>" >
            <?php
          }
         ?>
      </article>
      <article class="col-xs-3">
  	  	<label for="">Fecha Despacho:</label>
        <?php $fecha= $_REQUEST['fbus'] ?>
  	  	<input type="date" name="freg_farmacia" class="form-control" value="<?php echo $fecha;?>" <?php echo $atributo1;?>>
      </article>
    </section>
    <section class="panel-body">
      <label for="">Seleccione detalle:</label>
      <option value=""></option>
      <?php
      $id=$fila['id_d_fmedhosp'];
      $sql_cod="SELECT cod_med FROM d_fmedhosp WHERE id_d_fmedhosp=$id";
      //echo $sql_cod;
      if ($tabla_cod=$bd1->sub_tuplas($sql_cod)){
       foreach ($tabla_cod as $fila_cod ) {
         ?>
         <select class="form-control" required name="detalle_despacho">
           <option value=""></option>
           <?php
           $id_producto=$fila_cod['cod_med'];
           $bodega=$_REQUEST['bod'];

           $sql="SELECT id_dproducto,nom_completa,laboratorio,cantidad,fvencimiento,lote,total_fraccion
                 FROM d_producto
                 WHERE id_producto = $id_producto and id_bodega=$bodega ORDER BY cantidad ASC";

          if($tabla=$bd1->sub_tuplas($sql)){
            foreach ($tabla as $fila2) {

               $vencimiento=$fila2['fvencimiento'];
               $segundos= strtotime($vencimiento) - strtotime('now');
               $diferencia_dias=intval($segundos /60/60/24);
               $dias=ceil($diferencia_dias);

               if ($dias>0 && $dias<=183) {
                 if ($fila["id_dproducto"]==$fila2["id_dproducto"]){
                  $sw=' selected="selected"';
                }else{
                  $sw="";
                }
              echo '<option class="text-danger" value="'.$fila2["id_dproducto"].'"'.$sw.'><strong>'.$fila2["nom_completa"].' - '.$fila2["laboratorio"].' vencimiento: '.$fila2["fvencimiento"].'  Lote:'.$fila2["lote"].' - UNIDADES='.$fila2["cantidad"].'  - FRACCION='.$fila2["total_fraccion"].' </strong></option>';

               }

               if ($dias>183 && $dias<=365) {
                 if ($fila["id_dproducto"]==$fila2["id_dproducto"]){
                  $sw=' selected="selected"';
                }else{
                  $sw="";
                }
              echo '<option class="text-warning" value="'.$fila2["id_dproducto"].'"'.$sw.'><strong>'.$fila2["nom_completa"].' - '.$fila2["laboratorio"].' vencimiento: '.$fila2["fvencimiento"].'  Lote:'.$fila2["lote"].' - UNIDADES='.$fila2["cantidad"].'  - FRACCION='.$fila2["total_fraccion"].' </strong></option>';
               }

               if ($dias>365) {
                 if ($fila["id_dproducto"]==$fila2["id_dproducto"]){
                  $sw=' selected="selected"';
                }else{
                  $sw="";
                }
              echo '<option class="text-success" value="'.$fila2["id_dproducto"].'"'.$sw.'><strong>'.$fila2["nom_completa"].' - '.$fila2["laboratorio"].' vencimiento: '.$fila2["fvencimiento"].'  Lote:'.$fila2["lote"].' - UNIDADES='.$fila2["cantidad"].'  - FRACCION='.$fila2["total_fraccion"].' </strong></option>';
               }

            }
          }

           ?>
         </select>
         <?php
       }
      }else {
        echo "No hay detalle de medicamentos disponible";
      }
       ?>
    </section>
    <?php
      $mipres_validacion=$mipres;
      if ($mipres_validacion==1) {
        echo'<p class="alert alert-danger"><span class="fa fa-ban fa-2x animated jello"></span> No esposible el despacho de este medicamento porque
        no se ha diligenciado mipres. <strong>'.$_SESSION['AUT']['nombre'].'</strong>, solicite al medico soporte de mipres en sistema.</p>';
      }else {
        echo'<div class="row text-center">
    		  <input type="submit" class="btn btn-primary btn-lg" name="aceptar" Value="'.$boton.'" />
    			<input type="hidden" class="btn btn-primary" name="opcion" Value="'.$_GET["opcion"].'"/>
    			<input type="hidden" class="btn btn-primary" name="operacion" Value="'.$_GET["mante"].'"/>
    		</div>';
      }
     ?>

  </section>
</form>
