<?php
if ($tterapia=='890111') {
  $validar_cantidad="SELECT count('id_d_aut_dom') realizado FROM evo_fisio_dom WHERE id_d_aut_dom=$id_vcant and estado_evofisio_dom='Realizada'";
  if ($tablavalidar_cantidad=$bd1->sub_tuplas($validar_cantidad)){
    foreach ($tablavalidar_cantidad as $filavalidar_cantidad) {
      $realizado=$filavalidar_cantidad['realizado'];
      $cantidad=$fila_detalle['cantidad'];
      if ($realizado < $cantidad) { // INICIO validacion de cantida VS realizado
        if ($hoy >= $fini && $hoy <= $ffin ) {
          echo'<td class="text-left">';
          echo'<p><strong>ID procedimiento: </strong> '.$fila_detalle["id_d_aut_dom"].'</p>';
          echo'<p><strong>CUPS: </strong> '.$fila_detalle["cups"].' '.$fila_detalle["procedimiento"].'</p>';
          echo'<p><strong>CANTIDAD AUTORIZADA: </strong> '.$fila_detalle["cantidad"].' <strong>INTERVALO:</strong> '.$fila_detalle["intervalo"].' Minutos</p>';
          echo'<p><strong class="text-danger">VIGENCIA AUTORIZACIÓN: </strong> '.$fila_detalle["finicio"].' -- '.$fila_detalle["ffinal"].'</p>';
          echo'</td>';
          $idd=$fila_detalle['id_d_aut_dom'];
          $sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
          if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
            foreach ($tabla_profesional as $fila_profesional) {
              $supernum=$_SESSION['AUT']['supernum'];
              $realizador=$_SESSION['AUT']['id_user'];
              $prof_autorizado=$fila_profesional['profesional'];
              if ($realizador == $prof_autorizado || $supernum==1) {
                echo'<th class="text-center">';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&servicio=Domiciliarios"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración Inicial</button></a></p>
                     <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&=servicio=Domiciliarios"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
                     <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
                     ?>
                     <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Historico de Evoluciones</h4>
                            </div>
                            <div class="modal-body">
                              <?php
                                $idd=$fila_detalle["id_d_aut_dom"];
                                $sql_evolucion="SELECT a.id_evofisio_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evofisio_dom,
                                                       hreg_evofisio_dom, hreg_regfisio_dom, hfin_evofisio_dom, evolucionfisio_dom, estado_evofisio_dom,
                                                       b.nombre
                                                FROM evo_fisio_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evofisio_dom='Realizada'";
                                if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                                  foreach ($tabla_evolucion as $fila_evolucion) {
                                    echo'<section class="panel-body">
                                          <article class="col-md-8">';
                                    echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evofisio_'.$fila_evolucion['id_evofisio_dom'].'">Evolucion '.$fila_evolucion["freg_evofisio_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                                    echo'</article>';
                                    echo'<article class="col-md-4">';
                                    echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evofisio_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evofisio_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                                    echo'</article>';
                                    echo'</section>';
                                    echo'<section id="evofisio_'.$fila_evolucion['id_evofisio_dom'].'" class="collapse">';
                                    echo"<article class='col-md-6'>\n";
                                      echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evofisio_dom"].'</strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-6'>";
                                      echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-3'>";
                                      echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evofisio_dom"].' </strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-9'>";
                                      echo'<p class="text-left"> '.$fila_evolucion["evolucionfisio_dom"].' </p>';
                                    echo"</article>";

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
                     <?php
                echo'</th>';
              }else {
                echo'<th class="text-center">';
                echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span>Es posible que usted no este asociado a este procedimiento.</p>';
                echo'</th>';
              }
            }
          }else {
            echo'<th class="text-center">';
            echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> No hay profesional asignado o usted no esta asociado a este procedimiento.</p>';
            echo'</th>';
          }// fin validacion profesional
        }else {
          echo'<th class="text-center">
          <article class="alert alert-danger animated bounceIn col-md-12">
           <p>Este procedimiento corresponde al ID:'.$fila_detalle['id_d_aut_dom'].'</p>
           <p>Fecha inicio:'.$fila_detalle['finicio'].'</p>
           <p>Fecha final:'.$fila_detalle['ffinal'].'</p>
          </article>
          ';            
              $ffinal=$fila_detalle['ffinal'];
              $hoy = date("Y-m-d",strtotime($ffinal."+ 3 days")) ;
            $hoy1=date('Y-m-d');
            if ($hoy1 <= $hoy) {
              $idd=$fila_detalle['id_d_aut_dom'];
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&=servicio=Domiciliarios"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
                   <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
                   ?>
                   <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Historico de Evoluciones</h4>
                          </div>
                          <div class="modal-body">
                            <?php
                              $idd=$fila_detalle["id_d_aut_dom"];
                              $sql_evolucion="SELECT a.id_evofisio_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evofisio_dom,
                                                     hreg_evofisio_dom, hreg_regfisio_dom, hfin_evofisio_dom, evolucionfisio_dom, estado_evofisio_dom,
                                                     b.nombre
                                              FROM evo_fisio_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evofisio_dom='Realizada'";
                              if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                                foreach ($tabla_evolucion as $fila_evolucion) {
                                  echo'<section class="panel-body">
                                        <article class="col-md-8">';
                                  echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evofisio_'.$fila_evolucion['id_evofisio_dom'].'">Evolucion '.$fila_evolucion["freg_evofisio_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                                  echo'</article>';
                                  echo'<article class="col-md-4">';
                                  echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evofisio_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evofisio_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                                  echo'</article>';
                                  echo'</section>';
                                  echo'<section id="evofisio_'.$fila_evolucion['id_evofisio_dom'].'" class="collapse">';
                                  echo"<article class='col-md-6'>\n";
                                    echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evofisio_dom"].'</strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-6'>";
                                    echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-3'>";
                                    echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evofisio_dom"].' </strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-9'>";
                                    echo'<p class="text-left"> '.$fila_evolucion["evolucionfisio_dom"].' </p>';
                                  echo"</article>";

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
                   <?php
            }
          echo'</th>';
          echo'<th class="text-center">
                <p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p>
               </th>';
        }
      }else {// FIN validacion de cantida VS realizado
        echo'<th class="text-center">
              <p class="alert alert-danger animated bounceIn">
              <span class="fa fa-ban fa-4x"></span> La cantidad realizada no puede superar la cantidad autorizada</p>
              <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
              ?>
              <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                 <div class="modal-dialog">

                   <!-- Modal content-->
                   <div class="modal-content">
                     <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title">Historico de Evoluciones</h4>
                     </div>
                     <div class="modal-body">
                       <?php
                         $idd=$fila_detalle["id_d_aut_dom"];
                         $sql_evolucion="SELECT a.id_evofisio_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evofisio_dom,
                                                hreg_evofisio_dom, hreg_regfisio_dom, hfin_evofisio_dom, evolucionfisio_dom, estado_evofisio_dom,
                                                b.nombre
                                         FROM evo_fisio_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evofisio_dom='Realizada'";
                         if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                           foreach ($tabla_evolucion as $fila_evolucion) {
                             echo'<section class="panel-body">
                                   <article class="col-md-8">';
                             echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evofisio_'.$fila_evolucion['id_evofisio_dom'].'">Evolucion '.$fila_evolucion["freg_evofisio_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                             echo'</article>';
                             echo'<article class="col-md-4">';
                             echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evofisio_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evofisio_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                             echo'</article>';
                             echo'</section>';
                             echo'<section id="evofisio_'.$fila_evolucion['id_evofisio_dom'].'" class="collapse">';
                             echo"<article class='col-md-6'>\n";
                               echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evofisio_dom"].'</strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-6'>";
                               echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-3'>";
                               echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evofisio_dom"].' </strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-9'>";
                               echo'<p class="text-left"> '.$fila_evolucion["evolucionfisio_dom"].' </p>';
                             echo"</article>";

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
              <?php
          echo'</th>';
      }
    }
  }
}

if ($tterapia=='890110') {
  $validar_cantidad="SELECT count('id_d_aut_dom') realizado FROM evo_fono_dom WHERE id_d_aut_dom=$id_vcant and estado_evofono_dom='Realizada'";
  if ($tablavalidar_cantidad=$bd1->sub_tuplas($validar_cantidad)){
    foreach ($tablavalidar_cantidad as $filavalidar_cantidad) {
      $realizado=$filavalidar_cantidad['realizado'];
      $cantidad=$fila_detalle['cantidad'];
      if ($realizado < $cantidad) { // INICIO validacion de cantida VS realizado
        if ($hoy >= $fini && $hoy <= $ffin ) {
          echo'<td class="text-left">';
          echo'<p><strong>ID procedimiento: </strong> '.$fila_detalle["id_d_aut_dom"].'</p>';
          echo'<p><strong>CUPS: </strong> '.$fila_detalle["cups"].' '.$fila_detalle["procedimiento"].'</p>';
          echo'<p><strong>CANTIDAD AUTORIZADA: </strong> '.$fila_detalle["cantidad"].' <strong>INTERVALO:</strong> '.$fila_detalle["intervalo"].' Minutos</p>';
          echo'<p><strong class="text-danger">VIGENCIA AUTORIZACIÓN: </strong> '.$fila_detalle["finicio"].' -- '.$fila_detalle["ffinal"].'</p>';
          echo'</td>';
          $idd=$fila_detalle['id_d_aut_dom'];
          $sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
          if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
            foreach ($tabla_profesional as $fila_profesional) {
              $supernum=$_SESSION['AUT']['supernum'];
              $realizador=$_SESSION['AUT']['id_user'];
              $prof_autorizado=$fila_profesional['profesional'];
              if ($realizador == $prof_autorizado || $supernum==1) {
                echo'<th class="text-center">';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&servicio=Domiciliarios"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración Inicial</button></a></p>
                     <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&=servicio=Domiciliarios"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
                     <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
                     ?>
                     <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Historico de Evoluciones</h4>
                            </div>
                            <div class="modal-body">
                              <?php
                                $idd=$fila_detalle["id_d_aut_dom"];
                                $sql_evolucion="SELECT a.id_evofono_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evofono_dom,
                                                       hreg_evofono_dom, hreg_regfono_dom, hfin_evofono_dom, evolucionfono_dom, estado_evofono_dom,
                                                       b.nombre
                                                FROM evo_fono_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evofono_dom='Realizada'";
                                if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                                  foreach ($tabla_evolucion as $fila_evolucion) {
                                    echo'<section class="panel-body">
                                          <article class="col-md-8">';
                                    echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evofono_'.$fila_evolucion['id_evofono_dom'].'">Evolucion '.$fila_evolucion["freg_evofono_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                                    echo'</article>';
                                    echo'<article class="col-md-4">';
                                    echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evofono_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evofono_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                                    echo'</article>';
                                    echo'</section>';
                                    echo'<section id="evofono_'.$fila_evolucion['id_evofono_dom'].'" class="collapse">';
                                    echo"<article class='col-md-6'>\n";
                                      echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evofono_dom"].'</strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-6'>";
                                      echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-3'>";
                                      echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evofono_dom"].' </strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-9'>";
                                      echo'<p class="text-left"> '.$fila_evolucion["evolucionfono_dom"].' </p>';
                                    echo"</article>";

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
                     <?php
                echo'</th>';
              }else {
                echo'<th class="text-center">';
                echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span>Es posible que usted no este asociado a este procedimiento.</p>';
                echo'</th>';
              }
            }
          }else {
            echo'<th class="text-center">';
            echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> No hay profesional asignado o usted no esta asociado a este procedimiento.</p>';
            echo'</th>';
          }// fin validacion profesional
        }else {
          echo'<th class="text-center">
          <article class="alert alert-danger animated bounceIn col-md-12">
           <p>Este procedimiento corresponde al ID:'.$fila_detalle['id_d_aut_dom'].'</p>
           <p>Fecha inicio:'.$fila_detalle['finicio'].'</p>
           <p>Fecha final:'.$fila_detalle['ffinal'].'</p>
          </article>
          ';


            $ffinal=$fila_detalle['ffinal'];
            $hoy = date("Y-m-d",strtotime($ffinal."+ 3 days")) ;
            $hoy1=date('Y-m-d');
            if ($hoy1 <= $hoy) {
              $idd=$fila_detalle['id_d_aut_dom'];
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&=servicio=Domiciliarios"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
                   <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
                   ?>
                   <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Historico de Evoluciones</h4>
                          </div>
                          <div class="modal-body">
                            <?php
                              $idd=$fila_detalle["id_d_aut_dom"];
                              $sql_evolucion="SELECT a.id_evofono_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evofono_dom,
                                                     hreg_evofono_dom, hreg_regfono_dom, hfin_evofono_dom, evolucionfono_dom, estado_evofono_dom,
                                                     b.nombre
                                              FROM evo_fono_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evofono_dom='Realizada'";
                              if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                                foreach ($tabla_evolucion as $fila_evolucion) {
                                  echo'<section class="panel-body">
                                        <article class="col-md-8">';
                                  echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evofono_'.$fila_evolucion['id_evofono_dom'].'">Evolucion '.$fila_evolucion["freg_evofono_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                                  echo'</article>';
                                  echo'<article class="col-md-4">';
                                  echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evofono_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evofono_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                                  echo'</article>';
                                  echo'</section>';
                                  echo'<section id="evofono_'.$fila_evolucion['id_evofono_dom'].'" class="collapse">';
                                  echo"<article class='col-md-6'>\n";
                                    echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evofono_dom"].'</strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-6'>";
                                    echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-3'>";
                                    echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evofono_dom"].' </strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-9'>";
                                    echo'<p class="text-left"> '.$fila_evolucion["evolucionfono_dom"].' </p>';
                                  echo"</article>";

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
                   <?php
            }
          echo'</th>';

          echo'<th class="text-center"><p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p></th>';
        }
      }else {// FIN validacion de cantida VS realizado
        echo'<th class="text-center">
              <p class="alert alert-danger animated bounceIn">
              <span class="fa fa-ban fa-4x"></span> La cantidad realizada no puede superar la cantidad autorizada</p>
              <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
              ?>
              <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                 <div class="modal-dialog">

                   <!-- Modal content-->
                   <div class="modal-content">
                     <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title">Historico de Evoluciones</h4>
                     </div>
                     <div class="modal-body">
                       <?php
                         $idd=$fila_detalle["id_d_aut_dom"];
                         $sql_evolucion="SELECT a.id_evofono_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evofono_dom,
                                                hreg_evofono_dom, hreg_regfono_dom, hfin_evofono_dom, evolucionfono_dom, estado_evofono_dom,
                                                b.nombre
                                         FROM evo_fono_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evofono_dom='Realizada'";
                         if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                           foreach ($tabla_evolucion as $fila_evolucion) {
                             echo'<section class="panel-body">
                                   <article class="col-md-8">';
                             echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evofono_'.$fila_evolucion['id_evofono_dom'].'">Evolucion '.$fila_evolucion["freg_evofono_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                             echo'</article>';
                             echo'<article class="col-md-4">';
                             echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evofono_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evofono_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                             echo'</article>';
                             echo'</section>';
                             echo'<section id="evofono_'.$fila_evolucion['id_evofono_dom'].'" class="collapse">';
                             echo"<article class='col-md-6'>\n";
                               echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evofono_dom"].'</strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-6'>";
                               echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-3'>";
                               echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evofono_dom"].' </strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-9'>";
                               echo'<p class="text-left"> '.$fila_evolucion["evolucionfono_dom"].' </p>';
                             echo"</article>";

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
              <?php
        echo'</th>';
      }
    }
  }
}

if ($tterapia=='890113') {
  $validar_cantidad="SELECT count('id_d_aut_dom') realizado FROM evo_to_dom WHERE id_d_aut_dom=$id_vcant and estado_evoto_dom='Realizada'";
  if ($tablavalidar_cantidad=$bd1->sub_tuplas($validar_cantidad)){
    foreach ($tablavalidar_cantidad as $filavalidar_cantidad) {
      $realizado=$filavalidar_cantidad['realizado'];
      $cantidad=$fila_detalle['cantidad'];
      if ($realizado < $cantidad) { // INICIO validacion de cantida VS realizado
        if ($hoy >= $fini && $hoy <= $ffin ) {
          echo'<td class="text-left">';
          echo'<p><strong>ID procedimiento: </strong> '.$fila_detalle["id_d_aut_dom"].'</p>';
          echo'<p><strong>CUPS: </strong> '.$fila_detalle["cups"].' '.$fila_detalle["procedimiento"].'</p>';
          echo'<p><strong>CANTIDAD AUTORIZADA: </strong> '.$fila_detalle["cantidad"].' <strong>INTERVALO:</strong> '.$fila_detalle["intervalo"].' Minutos</p>';
          echo'<p><strong class="text-danger">VIGENCIA AUTORIZACIÓN: </strong> '.$fila_detalle["finicio"].' -- '.$fila_detalle["ffinal"].'</p>';
          echo'</td>';
          $idd=$fila_detalle['id_d_aut_dom'];
          $sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
          if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
            foreach ($tabla_profesional as $fila_profesional) {
              $supernum=$_SESSION['AUT']['supernum'];
              $realizador=$_SESSION['AUT']['id_user'];
              $prof_autorizado=$fila_profesional['profesional'];
              if ($realizador == $prof_autorizado || $supernum==1) {
                echo'<th class="text-center">';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&servicio=Domiciliarios"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración Inicial</button></a></p>
                     <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&=servicio=Domiciliarios"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
                     <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
                     ?>
                     <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Historico de Evoluciones</h4>
                            </div>
                            <div class="modal-body">
                              <?php
                                $idd=$fila_detalle["id_d_aut_dom"];
                                $sql_evolucion="SELECT a.id_evoto_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evoto_dom,
                                                       hreg_evoto_dom, hreg_regto_dom, hfin_evoto_dom, evolucionto_dom, estado_evoto_dom,
                                                       b.nombre
                                                FROM evo_to_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evoto_dom='Realizada'";
                                if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                                  foreach ($tabla_evolucion as $fila_evolucion) {
                                    echo'<section class="panel-body">
                                          <article class="col-md-8">';
                                    echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evoto_'.$fila_evolucion['id_evoto_dom'].'">Evolucion '.$fila_evolucion["freg_evoto_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                                    echo'</article>';
                                    echo'<article class="col-md-4">';
                                    echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evoto_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evoto_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                                    echo'</article>';
                                    echo'</section>';
                                    echo'<section id="evoto_'.$fila_evolucion['id_evoto_dom'].'" class="collapse">';
                                    echo"<article class='col-md-6'>\n";
                                      echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evoto_dom"].'</strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-6'>";
                                      echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-3'>";
                                      echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evoto_dom"].' </strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-9'>";
                                      echo'<p class="text-left"> '.$fila_evolucion["evolucionto_dom"].' </p>';
                                    echo"</article>";

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
                     <?php
                echo'</th>';
              }else {
                echo'<th class="text-center">';
                echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span>Es posible que usted no este asociado a este procedimiento.</p>';
                echo'</th>';
              }
            }
          }else {
            echo'<th class="text-center">';
            echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> No hay profesional asignado o usted no esta asociado a este procedimiento.</p>';
            echo'</th>';
          }// fin validacion profesional
        }else {
          echo'<th class="text-center">
          <article class="alert alert-danger animated bounceIn col-md-12">
           <p>Este procedimiento corresponde al ID:'.$fila_detalle['id_d_aut_dom'].'</p>
           <p>Fecha inicio:'.$fila_detalle['finicio'].'</p>
           <p>Fecha final:'.$fila_detalle['ffinal'].'</p>
          </article>
          ';

            $ffinal=$fila_detalle['ffinal'];
            $hoy = date("Y-m-d",strtotime($ffinal."+ 3 days")) ;
            $hoy1=date('Y-m-d');
            if ($hoy1 <= $hoy) {
              $idd=$fila_detalle['id_d_aut_dom'];
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&=servicio=Domiciliarios"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
                   <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
                   ?>
                   <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Historico de Evoluciones</h4>
                          </div>
                          <div class="modal-body">
                            <?php
                              $idd=$fila_detalle["id_d_aut_dom"];
                              $sql_evolucion="SELECT a.id_evoto_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evoto_dom,
                                                     hreg_evoto_dom, hreg_regto_dom, hfin_evoto_dom, evolucionto_dom, estado_evoto_dom,
                                                     b.nombre
                                              FROM evo_to_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evoto_dom='Realizada'";
                              if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                                foreach ($tabla_evolucion as $fila_evolucion) {
                                  echo'<section class="panel-body">
                                        <article class="col-md-8">';
                                  echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evoto_'.$fila_evolucion['id_evoto_dom'].'">Evolucion '.$fila_evolucion["freg_evoto_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                                  echo'</article>';
                                  echo'<article class="col-md-4">';
                                  echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evoto_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evoto_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                                  echo'</article>';
                                  echo'</section>';
                                  echo'<section id="evoto_'.$fila_evolucion['id_evoto_dom'].'" class="collapse">';
                                  echo"<article class='col-md-6'>\n";
                                    echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evoto_dom"].'</strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-6'>";
                                    echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-3'>";
                                    echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evoto_dom"].' </strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-9'>";
                                    echo'<p class="text-left"> '.$fila_evolucion["evolucionto_dom"].' </p>';
                                  echo"</article>";

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
                   <?php
            }
          echo'</th>';

          echo'<th class="text-center"><p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p></th>';
        }
      }else {// FIN validacion de cantida VS realizado
        echo'<th class="text-center">
              <p class="alert alert-danger animated bounceIn">
              <span class="fa fa-ban fa-4x"></span> La cantidad realizada no puede superar la cantidad autorizada</p>
              <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
              ?>
              <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                 <div class="modal-dialog">

                   <!-- Modal content-->
                   <div class="modal-content">
                     <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title">Historico de Evoluciones</h4>
                     </div>
                     <div class="modal-body">
                       <?php
                         $idd=$fila_detalle["id_d_aut_dom"];
                         $sql_evolucion="SELECT a.id_evoto_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evoto_dom,
                                                hreg_evoto_dom, hreg_regto_dom, hfin_evoto_dom, evolucionto_dom, estado_evoto_dom,
                                                b.nombre
                                         FROM evo_to_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evoto_dom='Realizada'";
                         if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                           foreach ($tabla_evolucion as $fila_evolucion) {
                             echo'<section class="panel-body">
                                   <article class="col-md-8">';
                             echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evoto_'.$fila_evolucion['id_evoto_dom'].'">Evolucion '.$fila_evolucion["freg_evoto_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                             echo'</article>';
                             echo'<article class="col-md-4">';
                             echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evoto_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evoto_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                             echo'</article>';
                             echo'</section>';
                             echo'<section id="evoto_'.$fila_evolucion['id_evoto_dom'].'" class="collapse">';
                             echo"<article class='col-md-6'>\n";
                               echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evoto_dom"].'</strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-6'>";
                               echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-3'>";
                               echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evoto_dom"].' </strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-9'>";
                               echo'<p class="text-left"> '.$fila_evolucion["evolucionto_dom"].' </p>';
                             echo"</article>";

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
              <?php
        echo'</th>';
      }
    }
  }
}

if ($tterapia=='890114') {
  $validar_cantidad="SELECT count('id_d_aut_dom') realizado FROM evo_tr_dom WHERE id_d_aut_dom=$id_vcant and estado_evotr_dom='Realizada'";
  if ($tablavalidar_cantidad=$bd1->sub_tuplas($validar_cantidad)){
    foreach ($tablavalidar_cantidad as $filavalidar_cantidad) {
      $realizado=$filavalidar_cantidad['realizado'];
      $cantidad=$fila_detalle['cantidad'];
      if ($realizado < $cantidad) { // INICIO validacion de cantida VS realizado
        if ($hoy >= $fini && $hoy <= $ffin ) {
          echo'<td class="text-left">';
          echo'<p><strong>ID procedimiento: </strong> '.$fila_detalle["id_d_aut_dom"].'</p>';
          echo'<p><strong>CUPS: </strong> '.$fila_detalle["cups"].' '.$fila_detalle["procedimiento"].'</p>';
          echo'<p><strong>CANTIDAD AUTORIZADA: </strong> '.$fila_detalle["cantidad"].' <strong>INTERVALO:</strong> '.$fila_detalle["intervalo"].' Minutos</p>';
          echo'<p><strong class="text-danger">VIGENCIA AUTORIZACIÓN: </strong> '.$fila_detalle["finicio"].' -- '.$fila_detalle["ffinal"].'</p>';
          echo'</td>';
          $idd=$fila_detalle['id_d_aut_dom'];
          $sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
          if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
            foreach ($tabla_profesional as $fila_profesional) {
              $supernum=$_SESSION['AUT']['supernum'];
              $realizador=$_SESSION['AUT']['id_user'];
              $prof_autorizado=$fila_profesional['profesional'];
              if ($realizador == $prof_autorizado || $supernum==1) {
                echo'<th class="text-center">';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&servicio=Domiciliarios"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración Inicial</button></a></p>
                     <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&=servicio=Domiciliarios"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
                     <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
                     ?>
                     <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Historico de Evoluciones</h4>
                            </div>
                            <div class="modal-body">
                              <?php
                                $idd=$fila_detalle["id_d_aut_dom"];
                                $sql_evolucion="SELECT a.id_evotr_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evotr_dom,
                                                       hreg_evotr_dom, hreg_regto_dom, hfin_evotr_dom, evolucionto_dom, estado_evotr_dom,
                                                       b.nombre
                                                FROM evo_tr_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evotr_dom='Realizada'";
                                if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                                  foreach ($tabla_evolucion as $fila_evolucion) {
                                    echo'<section class="panel-body">
                                          <article class="col-md-8">';
                                    echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evotr_'.$fila_evolucion['id_evotr_dom'].'">Evolucion '.$fila_evolucion["freg_evotr_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                                    echo'</article>';
                                    echo'<article class="col-md-4">';
                                    echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evotr_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evotr_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                                    echo'</article>';
                                    echo'</section>';
                                    echo'<section id="evotr_'.$fila_evolucion['id_evotr_dom'].'" class="collapse">';
                                    echo"<article class='col-md-6'>\n";
                                      echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evotr_dom"].'</strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-6'>";
                                      echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-3'>";
                                      echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evotr_dom"].' </strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-9'>";
                                      echo'<p class="text-left"> '.$fila_evolucion["evoluciontr_dom"].' </p>';
                                    echo"</article>";

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
                     <?php
                echo'</th>';
              }else {
                echo'<th class="text-center">';
                echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span>Es posible que usted no este asociado a este procedimiento.</p>';
                echo'</th>';
              }
            }
          }else {
            echo'<th class="text-center">';
            echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> No hay profesional asignado o usted no esta asociado a este procedimiento.</p>';
            echo'</th>';
          }// fin validacion profesional
        }else {
          echo'<th class="text-center">
          <article class="alert alert-danger animated bounceIn col-md-12">
           <p>Este procedimiento corresponde al ID:'.$fila_detalle['id_d_aut_dom'].'</p>
           <p>Fecha inicio:'.$fila_detalle['finicio'].'</p>
           <p>Fecha final:'.$fila_detalle['ffinal'].'</p>
          </article>
          ';

            $ffinal=$fila_detalle['ffinal'];
            $hoy = date("Y-m-d",strtotime($ffinal."+ 3 days")) ;
            $hoy1=date('Y-m-d');
            if ($hoy1 <= $hoy) {
              $idd=$fila_detalle['id_d_aut_dom'];
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&=servicio=Domiciliarios"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
                   <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
                   ?>
                   <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Historico de Evoluciones</h4>
                          </div>
                          <div class="modal-body">
                            <?php
                              $idd=$fila_detalle["id_d_aut_dom"];
                              $sql_evolucion="SELECT a.id_evotr_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evotr_dom,
                                                     hreg_evotr_dom, hreg_regto_dom, hfin_evotr_dom, evolucionto_dom, estado_evotr_dom,
                                                     b.nombre
                                              FROM evo_to_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evoto_dom='Realizada'";
                              if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                                foreach ($tabla_evolucion as $fila_evolucion) {
                                  echo'<section class="panel-body">
                                        <article class="col-md-8">';
                                  echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evoto_'.$fila_evolucion['id_evoto_dom'].'">Evolucion '.$fila_evolucion["freg_evoto_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                                  echo'</article>';
                                  echo'<article class="col-md-4">';
                                  echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evoto_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evoto_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                                  echo'</article>';
                                  echo'</section>';
                                  echo'<section id="evoto_'.$fila_evolucion['id_evoto_dom'].'" class="collapse">';
                                  echo"<article class='col-md-6'>\n";
                                    echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evoto_dom"].'</strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-6'>";
                                    echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-3'>";
                                    echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evoto_dom"].' </strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-9'>";
                                    echo'<p class="text-left"> '.$fila_evolucion["evolucionto_dom"].' </p>';
                                  echo"</article>";

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
                   <?php
            }

          echo'</th>';

          echo'<th class="text-center"><p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p></th>';
        }
      }else {// FIN validacion de cantida VS realizado
        echo'<th class="text-center">
              <p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> La cantidad realizada no puede superar la cantidad autorizada</p>
              <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
              ?>
              <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                 <div class="modal-dialog">

                   <!-- Modal content-->
                   <div class="modal-content">
                     <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title">Historico de Evoluciones</h4>
                     </div>
                     <div class="modal-body">
                       <?php
                         $idd=$fila_detalle["id_d_aut_dom"];
                         $sql_evolucion="SELECT a.id_evotr_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evotr_dom,
                                                hreg_evotr_dom, hreg_regto_dom, hfin_evotr_dom, evolucionto_dom, estado_evotr_dom,
                                                b.nombre
                                         FROM evo_to_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evoto_dom='Realizada'";
                         if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                           foreach ($tabla_evolucion as $fila_evolucion) {
                             echo'<section class="panel-body">
                                   <article class="col-md-8">';
                             echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evoto_'.$fila_evolucion['id_evoto_dom'].'">Evolucion '.$fila_evolucion["freg_evoto_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                             echo'</article>';
                             echo'<article class="col-md-4">';
                             echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evoto_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evoto_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                             echo'</article>';
                             echo'</section>';
                             echo'<section id="evoto_'.$fila_evolucion['id_evoto_dom'].'" class="collapse">';
                             echo"<article class='col-md-6'>\n";
                               echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evoto_dom"].'</strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-6'>";
                               echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-3'>";
                               echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evoto_dom"].' </strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-9'>";
                               echo'<p class="text-left"> '.$fila_evolucion["evolucionto_dom"].' </p>';
                             echo"</article>";

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
              <?php
        echo'</th>';
      }
    }
  }
}

if ($tterapia=='890112') {
  $validar_cantidad="SELECT count('id_d_aut_dom') realizado FROM evo_tr_dom WHERE id_d_aut_dom=$id_vcant and estado_evotr_dom='Realizada'";
  if ($tablavalidar_cantidad=$bd1->sub_tuplas($validar_cantidad)){
    foreach ($tablavalidar_cantidad as $filavalidar_cantidad) {
      $realizado=$filavalidar_cantidad['realizado'];
      $cantidad=$fila_detalle['cantidad'];
      if ($realizado < $cantidad) { // INICIO validacion de cantida VS realizado
        if ($hoy >= $fini && $hoy <= $ffin ) {
          echo'<td class="text-left">';
          echo'<p><strong>ID procedimiento: </strong> '.$fila_detalle["id_d_aut_dom"].'</p>';
          echo'<p><strong>CUPS: </strong> '.$fila_detalle["cups"].' '.$fila_detalle["procedimiento"].'</p>';
          echo'<p><strong>CANTIDAD AUTORIZADA: </strong> '.$fila_detalle["cantidad"].' <strong>INTERVALO:</strong> '.$fila_detalle["intervalo"].' Minutos</p>';
          echo'<p><strong class="text-danger">VIGENCIA AUTORIZACIÓN: </strong> '.$fila_detalle["finicio"].' -- '.$fila_detalle["ffinal"].'</p>';
          echo'</td>';
          $idd=$fila_detalle['id_d_aut_dom'];
          $sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
          if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
            foreach ($tabla_profesional as $fila_profesional) {
              $supernum=$_SESSION['AUT']['supernum'];
              $realizador=$_SESSION['AUT']['id_user'];
              $prof_autorizado=$fila_profesional['profesional'];
              if ($realizador == $prof_autorizado || $supernum==1) {
                echo'<th class="text-center">';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&servicio=Domiciliarios"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración Inicial</button></a></p>
                     <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&=servicio=Domiciliarios"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
                     <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
                     ?>
                     <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Historico de Evoluciones</h4>
                            </div>
                            <div class="modal-body">
                              <?php
                                $idd=$fila_detalle["id_d_aut_dom"];
                                $sql_evolucion="SELECT a.id_evotr_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evotr_dom,
                                                       hreg_evotr_dom, hreg_regtr_dom, hfin_evotr_dom, evoluciontr_dom, estado_evotr_dom,
                                                       b.nombre
                                                FROM evo_tr_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evotr_dom='Realizada'";
                                if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                                  foreach ($tabla_evolucion as $fila_evolucion) {
                                    echo'<section class="panel-body">
                                          <article class="col-md-8">';
                                    echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evoto_'.$fila_evolucion['id_evotr_dom'].'">Evolucion '.$fila_evolucion["freg_evotr_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                                    echo'</article>';
                                    echo'<article class="col-md-4">';
                                    echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evotr_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evotr_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                                    echo'</article>';
                                    echo'</section>';
                                    echo'<section id="evotr_'.$fila_evolucion['id_evotr_dom'].'" class="collapse">';
                                    echo"<article class='col-md-6'>\n";
                                      echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evotr_dom"].'</strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-6'>";
                                      echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-3'>";
                                      echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evotr_dom"].' </strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-9'>";
                                      echo'<p class="text-left"> '.$fila_evolucion["evoluciontr_dom"].' </p>';
                                    echo"</article>";

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
                     <?php
                echo'</th>';
              }else {
                echo'<th class="text-center">';
                echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span>Es posible que usted no este asociado a este procedimiento.</p>';
                echo'</th>';
              }
            }
          }else {
            echo'<th class="text-center">';
            echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> No hay profesional asignado o usted no esta asociado a este procedimiento.</p>';
            echo'</th>';
          }// fin validacion profesional
        }else {
          echo'<th class="text-center">
          <article class="alert alert-danger animated bounceIn col-md-12">
           <p>Este procedimiento corresponde al ID:'.$fila_detalle['id_d_aut_dom'].'</p>
           <p>Fecha inicio:'.$fila_detalle['finicio'].'</p>
           <p>Fecha final:'.$fila_detalle['ffinal'].'</p>
          </article>
          ';

            $ffinal=$fila_detalle['ffinal'];
            $hoy = date("Y-m-d",strtotime($ffinal."+ 3 days")) ;
            $hoy1=date('Y-m-d');
            if ($hoy1 <= $hoy) {
              $idd=$fila_detalle['id_d_aut_dom'];
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&=servicio=Domiciliarios"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
                   <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
                   ?>
                   <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Historico de Evoluciones</h4>
                          </div>
                          <div class="modal-body">
                            <?php
                              $idd=$fila_detalle["id_d_aut_dom"];
                              $sql_evolucion="SELECT a.id_evotr_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evotr_dom,
                                                     hreg_evotr_dom, hreg_regto_dom, hfin_evotr_dom, evoluciontr_dom, estado_evotr_dom,
                                                     b.nombre
                                              FROM evo_tr_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evotr_dom='Realizada'";
                              if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                                foreach ($tabla_evolucion as $fila_evolucion) {
                                  echo'<section class="panel-body">
                                        <article class="col-md-8">';
                                  echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evotr_'.$fila_evolucion['id_evotr_dom'].'">Evolucion '.$fila_evolucion["freg_evotr_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                                  echo'</article>';
                                  echo'<article class="col-md-4">';
                                  echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evotr_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evotr_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                                  echo'</article>';
                                  echo'</section>';
                                  echo'<section id="evotr_'.$fila_evolucion['id_evotr_dom'].'" class="collapse">';
                                  echo"<article class='col-md-6'>\n";
                                    echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evotr_dom"].'</strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-6'>";
                                    echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-3'>";
                                    echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evotr_dom"].' </strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-9'>";
                                    echo'<p class="text-left"> '.$fila_evolucion["evoluciontr_dom"].' </p>';
                                  echo"</article>";

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
                   <?php
            }

          echo'</th>';

          echo'<th class="text-center"><p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p></th>';
        }
      }else {// FIN validacion de cantida VS realizado
        echo'<th class="text-center">
              <p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> La cantidad realizada no puede superar la cantidad autorizada</p>
              <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
              ?>
              <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                 <div class="modal-dialog">

                   <!-- Modal content-->
                   <div class="modal-content">
                     <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title">Historico de Evoluciones</h4>
                     </div>
                     <div class="modal-body">
                       <?php
                         $idd=$fila_detalle["id_d_aut_dom"];
                         $sql_evolucion="SELECT a.id_evotr_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evotr_dom,
                                                hreg_evotr_dom, hreg_regto_dom, hfin_evotr_dom, evoluciontr_dom, estado_evotr_dom,
                                                b.nombre
                                         FROM evo_tr_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evotr_dom='Realizada'";
                         if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                           foreach ($tabla_evolucion as $fila_evolucion) {
                             echo'<section class="panel-body">
                                   <article class="col-md-8">';
                             echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evotr_'.$fila_evolucion['id_evotr_dom'].'">Evolucion '.$fila_evolucion["freg_evotr_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                             echo'</article>';
                             echo'<article class="col-md-4">';
                             echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evotr_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evotr_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                             echo'</article>';
                             echo'</section>';
                             echo'<section id="evotr_'.$fila_evolucion['id_evotr_dom'].'" class="collapse">';
                             echo"<article class='col-md-6'>\n";
                               echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evotr_dom"].'</strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-6'>";
                               echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-3'>";
                               echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evotr_dom"].' </strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-9'>";
                               echo'<p class="text-left"> '.$fila_evolucion["evoluciontr_dom"].' </p>';
                             echo"</article>";

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
              <?php
        echo'</th>';
      }
    }
  }
}


if ($tterapia=='890106') {
  $validar_cantidad="SELECT count('id_d_aut_dom') realizado FROM evo_nutri_dom WHERE id_d_aut_dom=$id_vcant and estado_evonutri_dom='Realizada'";
  if ($tablavalidar_cantidad=$bd1->sub_tuplas($validar_cantidad)){
    foreach ($tablavalidar_cantidad as $filavalidar_cantidad) {
      $realizado=$filavalidar_cantidad['realizado'];
      $cantidad=$fila_detalle['cantidad'];
      if ($realizado < $cantidad) { // INICIO validacion de cantida VS realizado
        if ($hoy >= $fini && $hoy <= $ffin ) {
          echo'<td class="text-left">';
          echo'<p><strong>ID procedimiento: </strong> '.$fila_detalle["id_d_aut_dom"].'</p>';
          echo'<p><strong>CUPS: </strong> '.$fila_detalle["cups"].' '.$fila_detalle["procedimiento"].'</p>';
          echo'<p><strong>CANTIDAD AUTORIZADA: </strong> '.$fila_detalle["cantidad"].' <strong>INTERVALO:</strong> '.$fila_detalle["intervalo"].' Minutos</p>';
          echo'<p><strong class="text-danger">VIGENCIA AUTORIZACIÓN: </strong> '.$fila_detalle["finicio"].' -- '.$fila_detalle["ffinal"].'</p>';
          echo'</td>';
          $idd=$fila_detalle['id_d_aut_dom'];
          $sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
          if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
            foreach ($tabla_profesional as $fila_profesional) {
              $supernum=$_SESSION['AUT']['supernum'];
              $realizador=$_SESSION['AUT']['id_user'];
              $prof_autorizado=$fila_profesional['profesional'];
              if ($realizador == $prof_autorizado || $supernum==1) {
                echo'<th class="text-center">';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&servicio=Domiciliarios"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración Inicial</button></a></p>
                     <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&=servicio=Domiciliarios&t='.$fila_detalle["intervalo"].'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
                     <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
                     ?>
                     <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Historico de Evoluciones</h4>
                            </div>
                            <div class="modal-body">
                              <?php
                                $idd=$fila_detalle["id_d_aut_dom"];
                                $sql_evolucion="SELECT a.id_evonutri_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evonutri_dom,
                                                       hreg_evonutri_dom, hreg_regnutri_dom, hfin_evonutri_dom, evolucionnutri_dom, estado_evonutri_dom,
                                                       b.nombre
                                                FROM evo_nutri_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evonutri_dom='Realizada'";
                                if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                                  foreach ($tabla_evolucion as $fila_evolucion) {
                                    echo'<section class="panel-body">
                                          <article class="col-md-8">';
                                    echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evonutri_'.$fila_evolucion['id_evonutri_dom'].'">Evolucion '.$fila_evolucion["freg_evonutri_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                                    echo'</article>';
                                    echo'<article class="col-md-4">';
                                    echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evonutri_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evonutri_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                                    echo'</article>';
                                    echo'</section>';
                                    echo'<section id="evonutri_'.$fila_evolucion['id_evonutri_dom'].'" class="collapse">';
                                    echo"<article class='col-md-6'>\n";
                                      echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evonutri_dom"].'</strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-6'>";
                                      echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-3'>";
                                      echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evonutri_dom"].' </strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-9'>";
                                      echo'<p class="text-left"> '.$fila_evolucion["evolucionnutri_dom"].' </p>';
                                    echo"</article>";

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
                     <?php
                echo'</th>';
              }else {
                echo'<th class="text-center">';
                echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span>Es posible que usted no este asociado a este procedimiento.</p>';
                echo'</th>';
              }
            }
          }else {
            echo'<th class="text-center">';
            echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> No hay profesional asignado o usted no esta asociado a este procedimiento.</p>';
            echo'</th>';
          }// fin validacion profesional
        }else {
          echo'<th class="text-center">
          <article class="alert alert-danger animated bounceIn col-md-12">
           <p>Este procedimiento corresponde al ID:'.$fila_detalle['id_d_aut_dom'].'</p>
           <p>Fecha inicio:'.$fila_detalle['finicio'].'</p>
           <p>Fecha final:'.$fila_detalle['ffinal'].'</p>
          </article>
          ';

            $ffinal=$fila_detalle['ffinal'];
            $hoy = date("Y-m-d",strtotime($ffinal."+ 3 days")) ;
            $hoy1=date('Y-m-d');
            if ($hoy1 <= $hoy) {
              $idd=$fila_detalle['id_d_aut_dom'];
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&=servicio=Domiciliarios&t='.$fila_detalle["intervalo"].'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
                   <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
                   ?>
                   <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Historico de Evoluciones</h4>
                          </div>
                          <div class="modal-body">
                            <?php
                              $idd=$fila_detalle["id_d_aut_dom"];
                              $sql_evolucion="SELECT a.id_evonutri_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evonutri_dom,
                                                     hreg_evonutri_dom, hreg_regnutri_dom, hfin_evonutri_dom, evolucionnutri_dom, estado_evonutri_dom,
                                                     b.nombre
                                              FROM evo_nutri_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evonutri_dom='Realizada'";
                              if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                                foreach ($tabla_evolucion as $fila_evolucion) {
                                  echo'<section class="panel-body">
                                        <article class="col-md-8">';
                                  echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evonutri_'.$fila_evolucion['id_evonutri_dom'].'">Evolucion '.$fila_evolucion["freg_evonutri_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                                  echo'</article>';
                                  echo'<article class="col-md-4">';
                                  echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evonutri_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evonutri_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                                  echo'</article>';
                                  echo'</section>';
                                  echo'<section id="evonutri_'.$fila_evolucion['id_evonutri_dom'].'" class="collapse">';
                                  echo"<article class='col-md-6'>\n";
                                    echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evonutri_dom"].'</strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-6'>";
                                    echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-3'>";
                                    echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evonutri_dom"].' </strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-9'>";
                                    echo'<p class="text-left"> '.$fila_evolucion["evolucionnutri_dom"].' </p>';
                                  echo"</article>";

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
                   <?php
            }

          echo'</th>';

          echo'<th class="text-center"><p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p></th>';
        }
      }else {// FIN validacion de cantida VS realizado
        echo'<th class="text-center">
              <p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> La cantidad realizada no puede superar la cantidad autorizada</p>
              <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
              ?>
              <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                 <div class="modal-dialog">

                   <!-- Modal content-->
                   <div class="modal-content">
                     <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title">Historico de Evoluciones</h4>
                     </div>
                     <div class="modal-body">
                       <?php
                         $idd=$fila_detalle["id_d_aut_dom"];
                         $sql_evolucion="SELECT a.id_evonutri_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evonutri_dom,
                                                hreg_evonutri_dom, hreg_regnutri_dom, hfin_evonutri_dom, evolucionnutri_dom, estado_evonutri_dom,
                                                b.nombre
                                         FROM evo_nutri_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evonutri_dom='Realizada'";
                         if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                           foreach ($tabla_evolucion as $fila_evolucion) {
                             echo'<section class="panel-body">
                                   <article class="col-md-8">';
                             echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evonutri_'.$fila_evolucion['id_evonutri_dom'].'">Evolucion '.$fila_evolucion["freg_evonutri_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                             echo'</article>';
                             echo'<article class="col-md-4">';
                             echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evonutri_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evonutri_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                             echo'</article>';
                             echo'</section>';
                             echo'<section id="evonutri_'.$fila_evolucion['id_evonutri_dom'].'" class="collapse">';
                             echo"<article class='col-md-6'>\n";
                               echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evonutri_dom"].'</strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-6'>";
                               echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-3'>";
                               echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evonutri_dom"].' </strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-9'>";
                               echo'<p class="text-left"> '.$fila_evolucion["evolucionnutri_dom"].' </p>';
                             echo"</article>";

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
              <?php
        echo'</th>';
      }
    }
  }
}

if ($tterapia=='890108') {
  $validar_cantidad="SELECT count('id_d_aut_dom') realizado FROM evo_psico_dom WHERE id_d_aut_dom=$id_vcant and estado_evopsico_dom='Realizada'";
  if ($tablavalidar_cantidad=$bd1->sub_tuplas($validar_cantidad)){
    foreach ($tablavalidar_cantidad as $filavalidar_cantidad) {
      $realizado=$filavalidar_cantidad['realizado'];
      $cantidad=$fila_detalle['cantidad'];
      if ($realizado < $cantidad) { // INICIO validacion de cantida VS realizado
        if ($hoy >= $fini && $hoy <= $ffin ) {
          echo'<td class="text-left">';
          echo'<p><strong>ID procedimiento: </strong> '.$fila_detalle["id_d_aut_dom"].'</p>';
          echo'<p><strong>CUPS: </strong> '.$fila_detalle["cups"].' '.$fila_detalle["procedimiento"].'</p>';
          echo'<p><strong>CANTIDAD AUTORIZADA: </strong> '.$fila_detalle["cantidad"].' <strong>INTERVALO:</strong> '.$fila_detalle["intervalo"].' Minutos</p>';
          echo'<p><strong class="text-danger">VIGENCIA AUTORIZACIÓN: </strong> '.$fila_detalle["finicio"].' -- '.$fila_detalle["ffinal"].'</p>';
          echo'</td>';
          $idd=$fila_detalle['id_d_aut_dom'];
          $sql_profesional="SELECT profesional FROM profesional_d_dom WHERE id_d_aut_dom=$idd and estado_profesional=1";
          if ($tabla_profesional=$bd1->sub_tuplas($sql_profesional)){
            foreach ($tabla_profesional as $fila_profesional) {
              $supernum=$_SESSION['AUT']['supernum'];
              $realizador=$_SESSION['AUT']['id_user'];
              $prof_autorizado=$fila_profesional['profesional'];
              if ($realizador == $prof_autorizado || $supernum==1) {
                echo'<th class="text-center">';
                echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=VI&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&servicio=Domiciliarios"><button type="button" class="btn btn-primary sombra_movil" ><span class="fa fa-plus-circle"></span> Valoración Inicial</button></a></p>
                     <p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&=servicio=Domiciliarios&t='.$fila_detalle["intervalo"].'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
                     <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
                     ?>
                     <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Historico de Evoluciones</h4>
                            </div>
                            <div class="modal-body">
                              <?php
                                $idd=$fila_detalle["id_d_aut_dom"];
                                $sql_evolucion="SELECT a.id_evopsico_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evopsico_dom,
                                                       hreg_evopsico_dom, hreg_regpsico_dom, hfin_evopsico_dom, evolucionpsico_dom, estado_evopsico_dom,
                                                       b.nombre
                                                FROM evo_psico_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evopsico_dom='Realizada'";
                                if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                                  foreach ($tabla_evolucion as $fila_evolucion) {
                                    echo'<section class="panel-body">
                                          <article class="col-md-8">';
                                    echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evopsico_'.$fila_evolucion['id_evopsico_dom'].'">Evolucion '.$fila_evolucion["freg_evopsico_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                                    echo'</article>';
                                    echo'<article class="col-md-4">';
                                    echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evopsico_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evopsico_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                                    echo'</article>';
                                    echo'</section>';
                                    echo'<section id="evopsico_'.$fila_evolucion['id_evopsico_dom'].'" class="collapse">';
                                    echo"<article class='col-md-6'>\n";
                                      echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evopsico_dom"].'</strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-6'>";
                                      echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-3'>";
                                      echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evopsico_dom"].' </strong></p>';
                                    echo"</article>";
                                    echo"<article class='col-md-9'>";
                                      echo'<p class="text-left"> '.$fila_evolucion["evolucionpsico_dom"].' </p>';
                                    echo"</article>";

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
                     <?php
                echo'</th>';
              }else {
                echo'<th class="text-center">';
                echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span>Es posible que usted no este asociado a este procedimiento.</p>';
                echo'</th>';
              }
            }
          }else {
            echo'<th class="text-center">';
            echo'<p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> No hay profesional asignado o usted no esta asociado a este procedimiento.</p>';
            echo'</th>';
          }// fin validacion profesional
        }else {
          echo'<th class="text-center">
          <article class="alert alert-danger animated bounceIn col-md-12">
           <p>Este procedimiento corresponde al ID:'.$fila_detalle['id_d_aut_dom'].'</p>
           <p>Fecha inicio:'.$fila_detalle['finicio'].'</p>
           <p>Fecha final:'.$fila_detalle['ffinal'].'</p>
          </article>
          ';

            $ffinal=$fila_detalle['ffinal'];
            $hoy = date("Y-m-d",strtotime($ffinal."+ 3 days")) ;
            $hoy1=date('Y-m-d');
            if ($hoy1 <= $hoy) {
              $idd=$fila_detalle['id_d_aut_dom'];
              echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=EVO&idadmhosp='.$fila["id_adm_hosp"].'&idd='.$fila_detalle["id_d_aut_dom"].'&doc='.$fila["doc_pac"].'&=servicio=Domiciliarios&t='.$fila_detalle["intervalo"].'"><button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-plus-circle"></span> Evolución</button></a></p>
                   <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
                   ?>
                   <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Historico de Evoluciones</h4>
                          </div>
                          <div class="modal-body">
                            <?php
                              $idd=$fila_detalle["id_d_aut_dom"];
                              $sql_evolucion="SELECT a.id_evopsico_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evopsico_dom,
                                                     hreg_evopsico_dom, hreg_regpsico_dom, hfin_evopsico_dom, evolucionpsico_dom, estado_evopsico_dom,
                                                     b.nombre
                                              FROM evo_psico_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evopsico_dom='Realizada'";
                              if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                                foreach ($tabla_evolucion as $fila_evolucion) {
                                  echo'<section class="panel-body">
                                        <article class="col-md-8">';
                                  echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evopsico_'.$fila_evolucion['id_evopsico_dom'].'">Evolucion '.$fila_evolucion["freg_evopsico_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                                  echo'</article>';
                                  echo'<article class="col-md-4">';
                                  echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evopsico_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evopsico_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                                  echo'</article>';
                                  echo'</section>';
                                  echo'<section id="evopsico_'.$fila_evolucion['id_evopsico_dom'].'" class="collapse">';
                                  echo"<article class='col-md-6'>\n";
                                    echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evopsico_dom"].'</strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-6'>";
                                    echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-3'>";
                                    echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evopsico_dom"].' </strong></p>';
                                  echo"</article>";
                                  echo"<article class='col-md-9'>";
                                    echo'<p class="text-left"> '.$fila_evolucion["evolucionpsico_dom"].' </p>';
                                  echo"</article>";

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
                   <?php
            }

          echo'</th>';

          echo'<th class="text-center"><p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span></p></th>';
        }
      }else {// FIN validacion de cantida VS realizado
        echo'<th class="text-center">
              <p class="alert alert-danger animated bounceIn"><span class="fa fa-ban fa-4x"></span> La cantidad realizada no puede superar la cantidad autorizada</p>
              <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#evolucion_'.$fila_detalle["id_d_aut_dom"].'"><span class="fa fa-search"></span> Consultar Evoluciones</button></p>';
              ?>
              <div id="<?php echo 'evolucion_'.$fila_detalle["id_d_aut_dom"] ?>" class="modal fade" role="dialog">
                 <div class="modal-dialog">

                   <!-- Modal content-->
                   <div class="modal-content">
                     <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title">Historico de Evoluciones</h4>
                     </div>
                     <div class="modal-body">
                       <?php
                         $idd=$fila_detalle["id_d_aut_dom"];
                         $sql_evolucion="SELECT a.id_evopsico_dom, id_adm_hosp,  id_d_aut_dom, freg_reg, freg_evopsico_dom,
                                                hreg_evopsico_dom, hreg_regpsico_dom, hfin_evopsico_dom, evolucionpsico_dom, estado_evopsico_dom,
                                                b.nombre
                                         FROM evo_psico_dom a inner join user b on a.id_user=b.id_user WHERE a.id_d_aut_dom=$idd and estado_evopsico_dom='Realizada'";
                         if ($tabla_evolucion=$bd1->sub_tuplas($sql_evolucion)){
                           foreach ($tabla_evolucion as $fila_evolucion) {
                             echo'<section class="panel-body">
                                   <article class="col-md-8">';
                             echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#evopsico_'.$fila_evolucion['id_evopsico_dom'].'">Evolucion '.$fila_evolucion["freg_evopsico_dom"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                             echo'</article>';
                             echo'<article class="col-md-4">';
                             echo'<p  class="col-md-12"><a href="Funcion_base/borrar_evopsico_dom.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_evolucion['id_evopsico_dom'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                             echo'</article>';
                             echo'</section>';
                             echo'<section id="evopsico_'.$fila_evolucion['id_evopsico_dom'].'" class="collapse">';
                             echo"<article class='col-md-6'>\n";
                               echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_evolucion["freg_evopsico_dom"].'</strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-6'>";
                               echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["nombre"].' </strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-3'>";
                               echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_evolucion["hreg_evopsico_dom"].' </strong></p>';
                             echo"</article>";
                             echo"<article class='col-md-9'>";
                               echo'<p class="text-left"> '.$fila_evolucion["evolucionpsico_dom"].' </p>';
                             echo"</article>";

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
              <?php
        echo'</th>';
      }
    }
  }
}
 ?>
