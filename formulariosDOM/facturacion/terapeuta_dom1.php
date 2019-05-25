
<div id="consulta_terapeuta_<?php echo $fila_detalle["id_d_aut_dom"]?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Registros realizados</h4>
      </div>
        <div class="modal-body">
          <div id="tabs_consulta_terapeuta">
            <ul>
              <li><a href="#tabs-1">Evoluciones terapeuticas</a></li>
              <li><a href="#tabs-2">Valoraciones terapeuticas</a></li>
            </ul>
            <div id="tabs-1" class="panel-body">
              <section class="row">
                <?php
                $espec=$fila_profesionales["especialidad"];
                if ($espec=='FISIOTERAPIA') {
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
                }
                 ?>
              </section>
            </div>
          </div>
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>

    </div>

  </div>

<?php
