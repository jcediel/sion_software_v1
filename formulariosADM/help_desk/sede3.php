<?php
$usuario=$_SESSION['AUT']['id_user'];
if ($usuario==2138|| 1) {
  $sede='8';
  ?>
  <section class="panel-body">
    <section class="col-md-12">
      <article class="col-md-4 text-center ">
        <button type="button" class="btn btn-warning text-center" data-toggle="modal" data-target="#tickets_p_<?php echo $sede ?>">
          <span class="fa fa-ticket-alt fa-3x">
          </span> <span class="badge animated shake">
            <?php
            $usuario=$_SESSION['l']["id_user"];
            $sql_c_p="SELECT count(a.id_hdesk) cuantos
                      FROM help_desk a inner join user b on a.id_user=b.id_user
                                       inner join aux_user_sedes c on c.id_user=b.id_user
                      WHERE estado_soporte=2 and c.id_sede in ($sede) group by id_hdesk";
                      //echo $sql_c_p;
                          $i=1;
            if ($tabla_c_p=$bd1->sub_tuplas($sql_c_p)){
              foreach ($tabla_c_p as $fila_c_p) {
                echo''.$fila_c_p['cuantos'].'';
              }
            }
            ?>
          </span>
          <br>Tickets Pendiente</button>
          <div id="tickets_p_<?php echo $sede?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg text-left">
              <!-- Modal content de casos pendientes-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Casos pendientes de solucionar</h4>
                </div>
                <div class="modal-body">
                  <?php
                  $usuario=$_SESSION['AUT']["id_user"];
                  $sql_pendiente="SELECT hl.id_hdesk,hl.freg_hdesk, hl.descripcion,hl.tipo_soporte,hl.estado_soporte,hl.rta_hdesk1,
                                         hl.observacion_hdesk1,hl.user_rta1,hl.frta1,hl.rta_hdesk2, hl.observacion_hdesk2,
                                         hl.user_rta2,hl.frta2,hl.hrta2,a.nombre realiza,rta1.nombre respon1,rta2.nombre respon2
                                FROM help_desk hl
                                            inner join user u on (hl.id_user=u.id_user)
                                            inner join aux_user_sedes ax on (u.id_user=ax.id_user)
                                            inner join sedes_ips sp on (ax.id_sede=sp.id_sedes_ips)
                                            inner JOIN user a on hl.id_user=a.id_user
                                            LEFT JOIN user rta1 on rta1.id_user=hl.user_rta1
                                            LEFT JOIN user rta2 on rta2.id_user=hl.user_rta2
                                where sp.id_sedes_ips in ($sede) and hl.estado_soporte in (2)
                                group by id_hdesk
                                ORDER BY hl.freg_hdesk ASC";
                                //echo $sql_pendiente;
                                $i=1;
                  if ($tabla_pendiente=$bd1->sub_tuplas($sql_pendiente)){
                    foreach ($tabla_pendiente as $fila_pendiente) {
                      echo'<section class="panel-body">';
                        echo'<article class="col-md-7 ">
                              <p><strong class="lead"># '.$i++.'</strong> || <strong>Fecha Radicado:</strong> '.$fila_pendiente['freg_hdesk'].'</p>
                              <p><strong>Problema:</strong> '.$fila_pendiente['descripcion'].'</p>
                             </article>';// aqui se ve el problema inicial
                        echo'<article class="col-md-5 ">
                              <p><strong>Caso creado por:</strong> '.$fila_pendiente['realiza'].'</p>
                            </article>';
                        echo'<article class="col-md-12 ">';
                              $idhdesk=$fila_pendiente['id_hdesk'];
                              $sql_soporte="SELECT id_s_hdesk, id_hdesk, id_user, freg_hdesk, hreg_hdesk, nombre_soporte, soporte_hdesk
                                            FROM soporte_hdesk WHERE id_hdesk=$idhdesk";
                                            if ($tabla_soporte=$bd1->sub_tuplas($sql_soporte)){
                                              foreach ($tabla_soporte as $fila_soporte) {
                                                $soporte=$fila_soporte['soporte_hdesk'];
                                                $sop=substr($soporte, -3);
                                                if ($sop=='png' || $sop=='jpg' || $sop=='JPG') {
                                                  echo'
                                                    <a href="'.$fila_soporte['soporte_hdesk'].'">
                                                      <button type="button" class="btn btn-warning btn-md" >
                                                      <span class="fa fa-file-image fa-2x"></span> Ver imagen</button>
                                                    </a>';
                                                }
                                                if ($sop=='pdf') {
                                                  echo'
                                                    <a href="'.$fila_soporte['soporte_hdesk'].'">
                                                      <button type="button" class="btn btn-warning btn-md" >
                                                      <span class="fa fa-file-pdf fa-2x"></span> Ver Documento</button>
                                                    </a>';
                                                }
                                                if ($sop=='mp4') {
                                                  echo'
                                                    <a href="'.$fila_soporte['soporte_hdesk'].'">
                                                      <button type="button" class="btn btn-warning btn-md" >
                                                      <span class="fa fa-file-video fa-2x"></span> Ver Video</button>
                                                    </a>';
                                                }
                                              }
                                            }
                            echo'</article><br>';
                             echo'<br><article class="col-md-12 alert alert-warning">
                                  <div class="media">
                                    <div class="media-right media-middle">
                                      <a href="#">';
                                      $foto=$_SESSION['AUT']['foto'];
                                      if (isset($foto)) {
                                        echo'<img class="media-object" width="50px" src="'.$_SESSION['AUT']['foto'].'" alt="...">';
                                      }else {
                                        echo'<img class="media-object" width="50px" src="fotos/nofoto.png" alt="...">';
                                      }
                                 echo'</a>
                                    </div>
                                      <div class="media-body">
                                      <h4 class="media-heading">'.$fila_pendiente['respon1'].'</h4>
                                      <p><strong>Respuesta1: </strong>'.$fila_pendiente['rta_hdesk1'].'</p>
                                      <p><strong>Observación: </strong>'.$fila_pendiente['observacion_hdesk1'].'</p>
                                      <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=RESPUESTA2HD&id='.$fila_pendiente['id_hdesk'].'">
                                      <button type="button type="button" class="btn btn-info">
                                      <span class="fa fa-edit"></span>Respuesta 2</button></a></p>
                                    </div>
                                  </div>
                                 </article>';// se ve la primera respuesta
                      echo'</section>';
                    }
                  }
                   ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>
      </article>
      <!--modal tickets resueltos-->
      <article class="col-md-4 text-center">
        <button type="button" class="btn btn-info text-center" data-toggle="modal" data-target="#tickets_r_<?php echo $sede?>">
          <span class="fa fa-ticket-alt fa-3x">
          </span> <span class="badge animated shake">
            <?php
            $usuario=$_SESSION['AUT']["id_user"];
            $sql_c_r="SELECT COUNT(a.id_hdesk) cuantos
                      FROM help_desk a inner join user b on a.id_user=b.id_user
                                       inner join aux_user_sedes c on c.id_user=b.id_user
                      WHERE estado_soporte=3 and c.id_sede in ($sede)";
                      //echo $sql_c_p;
                          $i=1;
            if ($tabla_c_r=$bd1->sub_tuplas($sql_c_r)){
              foreach ($tabla_c_r as $fila_c_r) {
                echo''.$fila_c_r['cuantos'].'';
              }
            }
            ?>
          </span>
          <br>Tickets Resueltos </button>
          <div id="tickets_r_<?php echo $sede?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg text-left">
              <!-- Modal content de casos pendientes-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Casos resueltos, pendientes por cerrar</h4>
                </div>
                <div class="modal-body">
                  <?php
                  $usuario=$_SESSION['AUT']["id_user"];
                  $sql_resueltos="SELECT hl.id_hdesk,hl.freg_hdesk, hl.descripcion,hl.tipo_soporte,hl.estado_soporte,hl.rta_hdesk1,
                                         hl.observacion_hdesk1,hl.user_rta1,hl.frta1,hl.rta_hdesk2, hl.observacion_hdesk2,
                                         hl.user_rta2,hl.frta2,hl.hrta2,a.nombre realiza,rta1.nombre respon1,rta2.nombre respon2
                                FROM help_desk hl
                                            inner join user u on (hl.id_user=u.id_user)
                                            inner join aux_user_sedes ax on (u.id_user=ax.id_user)
                                            inner join sedes_ips sp on (ax.id_sede=sp.id_sedes_ips)
                                            inner JOIN user a on hl.id_user=a.id_user
                                            LEFT JOIN user rta1 on rta1.id_user=hl.user_rta1
                                            LEFT JOIN user rta2 on rta2.id_user=hl.user_rta2
                                where sp.id_sedes_ips in ($sede) and hl.estado_soporte in (3)
                                group by id_hdesk
                                ORDER BY hl.freg_hdesk ASC";
                                //echo $sql_pendiente;
                                $i=1;
                  if ($tabla_resueltos=$bd1->sub_tuplas($sql_resueltos)){
                    foreach ($tabla_resueltos as $fila_resueltos) {
                      echo'<section class="panel-body">';
                        echo'<article class="col-md-7 ">
                              <p><strong class="lead"># '.$i++.'</strong> || <strong>Fecha Radicado:</strong> '.$fila_resueltos['freg_hdesk'].'</p>
                              <p><strong>Problema:</strong> '.$fila_resueltos['descripcion'].'</p>
                             </article>';// aqui se ve el problema inicial
                        echo'<article class="col-md-5 ">
                              <p><strong>Caso creado por:</strong> '.$fila_resueltos['realiza'].'</p>
                            </article>';
                        echo'<article class="col-md-12 ">';
                              $idhdesk=$fila_resueltos['id_hdesk'];
                              $sql_soporte="SELECT id_s_hdesk, id_hdesk, id_user, freg_hdesk, hreg_hdesk, nombre_soporte, soporte_hdesk
                                            FROM soporte_hdesk WHERE id_hdesk=$idhdesk";
                                            if ($tabla_soporte=$bd1->sub_tuplas($sql_soporte)){
                                              foreach ($tabla_soporte as $fila_soporte) {
                                                $soporte=$fila_soporte['soporte_hdesk'];
                                                $sop=substr($soporte, -3);
                                                if ($sop=='png' || $sop=='jpg' || $sop=='JPG') {
                                                  echo'
                                                    <a href="'.$fila_soporte['soporte_hdesk'].'">
                                                      <button type="button" class="btn btn-info btn-md" >
                                                      <span class="fa fa-file-image fa-2x"></span> Ver imagen</button>
                                                    </a>';
                                                }
                                                if ($sop=='pdf') {
                                                  echo'
                                                    <a href="'.$fila_soporte['soporte_hdesk'].'">
                                                      <button type="button" class="btn btn-warning btn-md" >
                                                      <span class="fa fa-file-pdf fa-2x"></span> Ver Documento</button>
                                                    </a>';
                                                }
                                                if ($sop=='mp4') {
                                                  echo'
                                                    <a href="'.$fila_soporte['soporte_hdesk'].'">
                                                      <button type="button" class="btn btn-warning btn-md" >
                                                      <span class="fa fa-file-video fa-2x"></span> Ver Video</button>
                                                    </a>';
                                                }
                                              }
                                            }
                            echo'</article>';
                             echo'<article class="col-md-12 alert alert-info">
                                  <div class="media">
                                    <div class="media-right media-middle">
                                      <a href="#">';
                                      $foto=$_SESSION['AUT']['foto'];
                                      if (isset($foto)) {
                                        echo'<img class="media-object" width="50px" src="'.$_SESSION['AUT']['foto'].'" alt="...">';
                                      }else {
                                        echo'<img class="media-object" width="50px" src="fotos/nofoto.png" alt="...">';
                                      }
                                 echo'</a>
                                    </div>
                                      <div class="media-body">
                                      <h4 class="media-heading">'.$fila_resueltos['respon1'].'</h4>
                                      <p><strong>Respuesta 1: </strong>'.$fila_resueltos['rta_hdesk1'].'</p>
                                      <p><strong>Observación 1: </strong>'.$fila_resueltos['observacion_hdesk1'].'</p>
                                    </div>
                                  </div>
                                 </article>';
                                 $rta2=$fila_resueltos['rta_hdesk2'];
                                 if (isset($rta2)) {
                                   echo'<article class="col-md-12 alert alert-info">
                                        <div class="media">
                                          <div class="media-right media-middle">
                                            <a href="#">';
                                            $foto=$_SESSION['AUT']['foto'];
                                            if (isset($foto)) {
                                              echo'<img class="media-object" width="50px" src="'.$_SESSION['AUT']['foto'].'" alt="...">';
                                            }else {
                                              echo'<img class="media-object" width="50px" src="fotos/nofoto.png" alt="...">';
                                            }
                                       echo'</a>
                                          </div>
                                            <div class="media-body">
                                            <h4 class="media-heading">'.$fila_resueltos['respon2'].'</h4>
                                            <p><strong>Respuesta 2: </strong>'.$fila_resueltos['rta_hdesk2'].'</p>
                                            <p><strong>Observación 2: </strong>'.$fila_resueltos['observacion_hdesk2'].'</p>
                                          </div>
                                        </div>
                                       </article>';
                                 }else {
                                }// se ve la primera respuesta
                      echo'</section>';
                    }
                  }
                   ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>
      </article>
      <!--modal tickets cerrados-->
      <article class="col-md-4 text-center">
        <button type="button" class="btn btn-success text-center" data-toggle="modal" data-target="#tickets_c_<?php echo $sede?>">
          <span class="fa fa-ticket-alt fa-3x">
          </span> <span class="badge animated shake">
            <?php
            $usuario=$_SESSION['AUT']["id_user"];
            $sql_c_c="SELECT COUNT(a.id_hdesk) cuantos
                      FROM help_desk a inner join user b on a.id_user=b.id_user
                                       inner join aux_user_sedes c on c.id_user=b.id_user
                      WHERE estado_soporte=4 and c.id_sede in ($sede)";
                          //echo $sql_c_r;
                          $i=1;
            if ($tabla_c_c=$bd1->sub_tuplas($sql_c_c)){
              foreach ($tabla_c_c as $fila_c_c) {
                echo''.$fila_c_c['cuantos'].'';
              }
            }
            ?>
          </span>
          <br>Tickets Cerrados   </button>
          <div id="tickets_c_<?php echo $sede?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg text-left">
              <!-- Modal content de casos pendientes-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Casos cerrados</h4>
                </div>
                <div class="modal-body">
                  <?php
                  $usuario=$_SESSION['AUT']["id_user"];
                  $sql_cerrados="SELECT hl.id_hdesk,hl.freg_hdesk, hl.descripcion,hl.tipo_soporte,hl.estado_soporte,hl.rta_hdesk1,
                                         hl.observacion_hdesk1,hl.user_rta1,hl.frta1,hl.rta_hdesk2, hl.observacion_hdesk2,
                                         hl.user_rta2,hl.frta2,hl.hrta2,a.nombre realiza,rta1.nombre respon1,rta2.nombre respon2
                                FROM help_desk hl
                                            inner join user u on (hl.id_user=u.id_user)
                                            inner join aux_user_sedes ax on (u.id_user=ax.id_user)
                                            inner join sedes_ips sp on (ax.id_sede=sp.id_sedes_ips)
                                            inner JOIN user a on hl.id_user=a.id_user
                                            LEFT JOIN user rta1 on rta1.id_user=hl.user_rta1
                                            LEFT JOIN user rta2 on rta2.id_user=hl.user_rta2
                                where sp.id_sedes_ips in ($sede) and hl.estado_soporte in (4)
                                group by id_hdesk
                                ORDER BY hl.freg_hdesk ASC";
                                //echo $sql_pendiente;
                                $i=1;
                  if ($tabla_cerrados=$bd1->sub_tuplas($sql_cerrados)){
                    foreach ($tabla_cerrados as $fila_cerrados) {
                      echo'<section class="panel-body">';
                        echo'<article class="col-md-7 ">
                              <p><strong class="lead"># '.$i++.'</strong> || <strong>Fecha Radicado:</strong> '.$fila_cerrados['freg_hdesk'].'</p>
                              <p><strong>Problema:</strong> '.$fila_cerrados['descripcion'].'</p>
                             </article>';// aqui se ve el problema inicial
                        echo'<article class="col-md-5 ">
                              <p><strong>Caso creado por:</strong> '.$fila_cerrados['realiza'].'</p>
                            </article>';
                        echo'<article class="col-md-12 ">';
                              $idhdesk=$fila_cerrados['id_hdesk'];
                              $sql_soporte="SELECT id_s_hdesk, id_hdesk, id_user, freg_hdesk, hreg_hdesk, nombre_soporte, soporte_hdesk
                                            FROM soporte_hdesk WHERE id_hdesk=$idhdesk";
                                            if ($tabla_soporte=$bd1->sub_tuplas($sql_soporte)){
                                              foreach ($tabla_soporte as $fila_soporte) {
                                                $soporte=$fila_soporte['soporte_hdesk'];
                                                $sop=substr($soporte, -3);
                                                if ($sop=='png' || $sop=='jpg' || $sop=='JPG') {
                                                  echo'
                                                    <a href="'.$fila_soporte['soporte_hdesk'].'">
                                                      <button type="button" class="btn btn-info btn-md" >
                                                      <span class="fa fa-file-image fa-2x"></span> Ver imagen</button>
                                                    </a>';
                                                }
                                                if ($sop=='pdf') {
                                                  echo'
                                                    <a href="'.$fila_soporte['soporte_hdesk'].'">
                                                      <button type="button" class="btn btn-warning btn-md" >
                                                      <span class="fa fa-file-pdf fa-2x"></span> Ver Documento</button>
                                                    </a>';
                                                }
                                                if ($sop=='mp4') {
                                                  echo'
                                                    <a href="'.$fila_soporte['soporte_hdesk'].'">
                                                      <button type="button" class="btn btn-warning btn-md" >
                                                      <span class="fa fa-file-video fa-2x"></span> Ver Video</button>
                                                    </a>';
                                                }
                                              }
                                            }
                            echo'</article>';
                             echo'<article class="col-md-12 alert alert-success">
                                  <div class="media">
                                    <div class="media-right media-middle">
                                      <a href="#">';
                                      $foto=$_SESSION['AUT']['foto'];
                                      if (isset($foto)) {
                                        echo'<img class="media-object" width="50px" src="'.$_SESSION['AUT']['foto'].'" alt="...">';
                                      }else {
                                        echo'<img class="media-object" width="50px" src="fotos/nofoto.png" alt="...">';
                                      }
                                 echo'</a>
                                    </div>
                                      <div class="media-body">
                                      <h4 class="media-heading">'.$fila_cerrados['respon1'].'</h4>
                                      <p><strong>Respuesta 1: </strong>'.$fila_cerrados['rta_hdesk1'].'</p>
                                      <p><strong>Observación 1: </strong>'.$fila_cerrados['observacion_hdesk1'].'</p>
                                    </div>
                                  </div>
                                 </article>';
                                $rta2=$fila_cerrados['rta_hdesk2'];
                                if ($rta2=='') {
                                }else {
                                 echo'<article class="col-md-12 alert alert-success">
                                      <div class="media">
                                        <div class="media-right media-middle">
                                          <a href="#">';
                                          $foto=$_SESSION['AUT']['foto'];
                                          if (isset($foto)) {
                                            echo'<img class="media-object" src="'.$_SESSION['AUT']['foto'].'" alt="...">';
                                          }else {
                                            echo'<img class="media-object" width="50px" src="fotos/nofoto.png" alt="...">';
                                          }
                                     echo'</a>
                                        </div>
                                          <div class="media-body">
                                          <h4 class="media-heading">'.$fila_cerrados['respon2'].'</h4>
                                          <p><strong>Respuesta 2: </strong>'.$fila_cerrados['rta_hdesk2'].'</p>
                                          <p><strong>Observación 2: </strong>'.$fila_cerrados['observacion_hdesk2'].'</p>
                                        </div>
                                      </div>
                                     </article>';}// se ve la primera respuesta
                      echo'</section>';
                    }
                  }
                   ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <br>
      </article><br>
      <section class="panel-body"><br> <!--Inicio de tabla consulta de soportes abiertos -->
             <table class="table table-striped"><br>
               <tr  class="fuente_titulo_tabla"><br>
                <th class="text-center text-primary">CASO</th>
                <th class="text-center text-primary">DETALLES</th>
                <th class="text-center text-primary">ESTADO</th>
              </tr>
              <?php
              // consulta para casos activos
              $usuario=$_SESSION['AUT']["id_user"];
              $sql_usuario="SELECT hl.id_hdesk,hl.freg_hdesk, hl.descripcion,hl.tipo_soporte,hl.estado_soporte,hl.rta_hdesk1,
                                     hl.observacion_hdesk1,hl.user_rta1,hl.frta1,hl.rta_hdesk2, hl.observacion_hdesk2,
                                     hl.user_rta2,hl.frta2,hl.hrta2,a.nombre realiza,rta1.nombre respon1,rta2.nombre respon2
                            FROM help_desk hl
                                        inner join user u on (hl.id_user=u.id_user)
                                        inner join aux_user_sedes ax on (u.id_user=ax.id_user)
                                        inner join sedes_ips sp on (ax.id_sede=sp.id_sedes_ips)
                                        inner JOIN user a on hl.id_user=a.id_user
                                        LEFT JOIN user rta1 on rta1.id_user=hl.user_rta1
                                        LEFT JOIN user rta2 on rta2.id_user=hl.user_rta2
                            where sp.id_sedes_ips in ($sede) and hl.estado_soporte in (1)
                            group by id_hdesk
                            ORDER BY hl.freg_hdesk ASC";
                            $i=1;
              if ($tablau=$bd1->sub_tuplas($sql_usuario)){
                foreach ($tablau as $filau) {
                  $estado_hdesk=$filau['estado_soporte'];
                  if ($estado_hdesk==1) {
                    echo'<tr>';
                    echo'<td class="col-md-2" >
                          <h5 class="text-center alert alert-danger"><strong>'.$i++.'</strong></></h5>
                          <p><strong>Fecha Registro: </strong>'.$filau['freg_hdesk'].'</p>
                          <p><strong>Hora Registro: </strong>'.$filau['hreg_hdesk'].'</p>
                         </td>';
                     echo'<td>
                           <h5><p class="alert alert-danger"><strong>Realiza: </strong>'.$filau['realiza'].'</p></h5>
                            <p><strong>Tipo Soporte: </strong>';
                             $tipo=$filau['tipo_soporte'];
                             if ($tipo==1) {
                               echo'SION';
                             }
                             if ($tipo==2) {
                               echo'Equipo';
                             }
                      echo'</p>
                           <p><strong>Problema: </strong>'.$filau['descripcion'].'</p>
                          </td>';
                      echo'<td class="col-md-3 text-center">
                              <h5 class="alert alert-danger"><p>Ticket ACTIVO</p></h5>
                                <!-- boton para carga de evidencias-->
                               <p><button type="button" class="btn btn-primary alert alert-info" data-toggle="modal" data-target="#soportes_hdesk_'.$filau['id_hdesk'].'"><span class="fa fa-upload"></span> Detalle</button></p>
                               <div id="soportes_hdesk_'.$filau['id_hdesk'].'" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg text-left">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Evidencias para Ticket # '.$filau['id_hdesk'].'</h4>
                                     </div>
                                    <div class="modal-body">';
                                    $id=$filau['id_hdesk'];
                                       $sql_doc="SELECT id_s_hdesk,id_hdesk,id_user,freg_hdesk,hreg_hdesk,
                                                        nombre_soporte,soporte_hdesk
                                                 FROM soporte_hdesk
                                                 WHERE id_hdesk=$id";
                                      //echo $sql_doc;
                                       if ($tabla_doc=$bd1->sub_tuplas($sql_doc)){
                                         foreach ($tabla_doc as $fila_doc ) {
                                           echo'<section class="panel-body">';
                                             echo'<article class="col-md-6">';
                                               echo'<p><strong>Fecha Registro: </strong>'.$fila_doc['freg_hdesk'].' - '.$fila_doc['hreg_hdesk'].'</p>';
                                               echo'<p><strong>Nombre: </strong>'.$fila_doc['nombre_soporte'].'</p>';
                                             echo'</article>';
                                             echo'<article class="col-md-6">';
                                               echo'<p><img src="'.$fila_doc['soporte_hdesk'].'" width="100%"></p>';
                                               echo'<p>';
                                               $soporte=$fila_doc['soporte_hdesk'];
                                               $sop=substr($soporte, -3);
                                                      if ($sop=='jpg' || $sop=='JPG' || $sop=='png') {
                                                        echo'
                                                          <a href="'.$fila_doc['soporte_hdesk'].'">
                                                            <button type="button" class="btn btn-warning btn-md" ><span class="fa fa-file-image"></span> Ver imagen</button>
                                                          </a>';
                                                      }
                                                      if ($sop=='pdf') {
                                                        echo'
                                                          <a href="'.$fila_doc['soporte_hdesk'].'">
                                                            <button type="button" class="btn btn-warning btn-md" ><span class="fa fa-file-pdf"></span> Ver PDF</button>
                                                          </a>';
                                                      }
                                                      if ($sop=='mp4') {
                                                        echo'
                                                          <a href="'.$fila_doc['soporte_hdesk'].'">
                                                            <button type="button" class="btn btn-warning btn-md" ><span class="fa fa-file-video"></span> Ver Video</button>
                                                          </a>';
                                                      }
                                              echo'';
                                             echo'</article>';
                                           echo'</section>';
                                         }
                                       }else {
                                        echo'<p>No existen evidencias de este ticket</p>';
                                       }
                                    echo'</div>
                                    <div class="modal-footer">
                                    <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=RESPUESTAHD&id='.$filau['id_hdesk'].'">
                                   <button type="button type="button" class="btn btn-warning"><span class="fa fa-edit"></span> Respuesta</button></a></p>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>';
                          echo'</tr>';
                              }
                            }
                          }
                            ?>
                    </table>
                  </section>
                </section>
            </section>
  <?php
}
 ?>
