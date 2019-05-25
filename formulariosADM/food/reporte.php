<section class="panel panel-default">
  <section class="card-header">
    <h2><?php echo $subtitulo; ?></h2>
  </section><br>
  <section class="panel-body">
    <form>
    <section class="col-md-12">
        <article class="col-md-3">
          <label>Fecha inicial:</label>
          <input type="date" class="form-control" name="fecha1">
        </article>
        <article class="col-md-3">
          <label>Fecha Final:</label>
          <input type="date" class="form-control" name="fecha2">
        </article>
        <article class="col-md-2">
          <label for="">Seleccione SEDE:</label>
          <select class="form-control input-sm" required="" name="sede">
            <option value="1,2,3,4,5,6,7,8,9,10,11,12">Todas</option>
            <?php
            $sql="SELECT id_sedes_ips,nom_sedes from sedes_ips where estado_sedes='Activo' ORDER BY id_sedes_ips ASC";
            if($tabla=$bd1->sub_tuplas($sql)){
              foreach ($tabla as $fila2) {
                if ($fila["id_sedes_ips"]==$fila2["id_sedes_ips"]){
                  $sw=' selected="selected"';
                }else{
                  $sw="";
                }
              echo '<option value="'.$fila2["id_sedes_ips"].'"'.$sw.'>'.$fila2["nom_sedes"].'</option>';
              }
            }
            ?>
          </select>
        </article>
          <article class="col-md-2">
          <label>Identificación:</label>
          <input type="text" class="form-control" name="doc">
        </article>
        <div class="row col-md-2">
          <br>
          <input type="submit" name="buscar" class="btn btn-primary " value="Buscar">
          <input type="hidden" name="opcion" Value="<?php echo $_GET["opcion"];?>"/>
          <input type="hidden" name="mante" Value="<?php echo $_GET["mante"];?>"/>
        </div>
    </section>
    </form>
  </section>
  <section class="panel-body">

    <table class="table table striped">
      <tr>
        <td colspan="4">
          <a href="rptexcel/ADM/rptFood1.php?f1=<?php echo $_GET['fecha1'] ?>&f2=<?php echo $_GET['fecha2'] ?>&sede=<?php echo $_GET['sede'] ?>">
          <button type="button" class="btn btn-success " ><span class="fa fa-file-excel-o"></span> Exportar Excel</button></a>
          <a href="rptpdf/ADM/rptFood1.php?f1=<?php echo $_GET['fecha1'] ?>&f2=<?php echo $_GET['fecha2'] ?>&sede=<?php echo $_GET['sede'] ?>">
          <button type="button" class="btn btn-danger " ><span class="fa fa-file-pdf-o"></span> Exportar pdf</button></a>
        </td>
      </tr>
      <tr class="fuente_titulo_tabla">
        <th class="text-center text-primary">DATOS USUARIO</th>
        <th class="text-center text-primary">CANTIDAD</th>
        <th class="text-center text-primary">VALOR TOTAL</th>
        <th class="text-center text-primary">ACCION</th>
      </tr>
      <?php
      $finicial=$_GET['fecha1'];
      $ffinal=$_GET['fecha2'];
      $sede=$_GET['sede'];
      $doc=$_GET['doc'];
      if ($doc!='') {
       $sql_user="SELECT count(a.id_food) cuantos,c.costo_food, b.nombre, b.doc, b.id_user, b.foto, e.nombre_perfil, f.nom_sedes, b.cuenta
                   FROM food a
                       INNER JOIN user b on a.id_user=b.id_user
                       INNER JOIN grupo_food c on b.id_grupo_food=c.id_grupo_food
                       INNER JOIN aux_user_sedes d on b.id_user=d.id_user
                       INNER JOIN perfil e on b.id_perfil=e.id_perfil
                       INNER JOIN sedes_ips f on d.id_sede=f.id_sedes_ips
                   WHERE b.doc='$doc' and estado_food in (1,2) and freg_food BETWEEN '$finicial' and '$ffinal' and estado='activo'
                   GROUP BY a.id_user ORDER BY 1 DESC";
      }else{
        $sql_user="SELECT count(a.id_food) cuantos,c.costo_food, b.nombre, b.doc, b.id_user, b.foto, e.nombre_perfil, f.nom_sedes, b.cuenta
                   FROM food a
                       INNER JOIN user b on a.id_user=b.id_user
                       INNER JOIN grupo_food c on b.id_grupo_food=c.id_grupo_food
                       INNER JOIN aux_user_sedes d on b.id_user=d.id_user
                       INNER JOIN perfil e on b.id_perfil=e.id_perfil
                       INNER JOIN sedes_ips f on d.id_sede=f.id_sedes_ips
                   WHERE d.id_sede='$sede' and estado_food in (1,2) and freg_food BETWEEN '$finicial' and '$ffinal' and estado='activo'
                   GROUP BY a.id_user ORDER BY 1 DESC";
      }       //echo $sql_user;
        if ($tablau=$bd1->sub_tuplas($sql_user)){
          foreach ($tablau as $filau) {
            echo '<tr>';
              echo '<td class="col-md-3 text-center">';
                      $foto=$filau['foto'];
                      if (isset($foto)) {
                        echo'<img class="media-object" width="300px" src="/'.$foto.'" alt="..."><br>';
                      }else {
                        echo'<img class="media-object" width="95px" src="/fotos/nofoto.png" alt="...">';
                      }
                      echo '<p><strong>Nombre: </strong>'.$filau['nombre'].'</p>';
                      echo '<p><strong>Documento: </strong>'.$filau['doc'].'</p>
                      <p><strong>Perfil: </strong>'.$filau['nombre_perfil'].'</p>
                    </td>';
              echo '<td class="col-md-3">';
                    echo '<article class="text-center">
                            <h4>Cantidad solicitada</h4>
                            <h3 class="alert alert-info"><strong>'.$filau['cuantos'].'</strong></h3>
                          </article>';
              echo '</td>';
              echo '<td class="col-md-3">';
                    $cant=$filau['cuantos'];
                    $precio=$filau['costo_food'];
                    $total=$cant*$precio;
                    echo '<article class="text-center">
                            <h4>Precio total</h4>
                            <h3 class="alert alert-info"><strong>'.$total.'</strong></h3>
                          </article>';
              echo '</td>';
              echo '<td class="col-md-3">';
              ?>
              <article class="text-center">
                <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#sedeus_<?php echo $filau['id_user'] ?>"><span class="fa fa-number fa-2x"></span> DETALLE</button></p>
                 <div id="sedeus_<?php echo $filau['id_user'] ?>" class="modal fade" role="dialog">
                   <div class="modal-dialog text-left">
                     <div class="modal-content">
                       <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                         <h4 class="modal-title">Historio de almuerzos</h4>
                       </div>
                       <div class="modal-body">
                            <table class="table table striped">
                              <tr class="fuente_titulo_tabla">
                                <th class="text-center text-primary">FECHA</th>
                                <th class="text-center text-primary">ESTADO</th>
                              </tr>
                             <?php
                             $user=$filau['id_user'];
                             $sql_historico="SELECT b.freg_food,b.hreg,b.estado_food
               												      FROM food b
               														  INNER JOIN user a on b.id_user=a.id_user
                     											  WHERE a.id_user=$user and freg_food BETWEEN '$finicial' and '$ffinal'
                     											  group by id_food";
                                      $i=1;
               												// echo $sql_historico;
               							if ($tablau=$bd1->sub_tuplas($sql_historico)){
               								foreach ($tablau as $fila_food) {
                                $estado_food=$fila_food['estado_food'];
                                echo '<tr>';
                                 echo '<td class="col-md-6">';
                                   echo' <p class="text-center"><strong>'.$i++.'. Fecha:</strong> '.$fila_food['freg_food'].'</p>';
                                   echo' <p class="text-center"><strong> Hora:</strong>'.$fila_food['hreg'].'</p>';
                                 echo '</td>';
                                 echo '<td class="col-md-6">';
                                           if ($estado_food==1) {
                                             echo '<h5 class="text-center alert alert-info"><Strong>Estado:</Strong> Solicitado';
                                           }
                                           if ($estado_food==2) {
                                             echo '<h5 class="text-center alert alert-success"><Strong>Estado:</Strong> Entregado';
                                           }
                                           if ($estado_food==3) {
                                             echo '<h5 class="text-center alert alert-danger"><Strong>Estado:</Strong> Cancelado';
                                           }
                                  echo '</td>';
                                echo '<tr>';
                                }
                              }else {
                                 echo '<h5 class="text-center alert alert-danger"><Strong>Estado:</Strong> El usuario no tiene historico de pedidos';
                              }
                            ?>
                          </table>
                      </div>
                     <div class="modal-footer">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                     </div>
                   </div>
                 </div>
               </div>
              </article>
              <?php
              echo '</td>';
              echo '</tr>';
          }
        }
       ?>
    </table>
  </section>
</section>
