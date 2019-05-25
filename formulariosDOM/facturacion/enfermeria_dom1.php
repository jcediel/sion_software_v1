
<div id="consulta_notas_<?php echo $fila_detalle["id_d_aut_dom"]?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Registros realizados</h4>
      </div>
      <div class="modal-body">
        <div id="tabs_consulta_nota">
          <ul>
            <li><a href="#tabs-1">Notas Realizadas</a></li>
          </ul>
            <div id="tabs-1" class="panel-body">
              <section class="row">
                <?php

                 ?>

                <?php
                $idd=$fila_detalle["id_d_aut_dom"];
                $f1=$fila_detalle["finicio"];
                $f2=$fila_detalle["ffinal"];
                $id=$fila_detalle["id_adm_hosp"];
                $turno=$fila_detalle["intervalo"];
                if ($turno == 3) {
                  $sql_nota="SELECT a.id_enf_dom3,id_adm_hosp, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota,
                               u.nombre
                  FROM enferdom3 a INNER join user u on a.id_user=u.id_user
                  WHERE a.id_adm_hosp=$id  and estado_nota='Realizada' and id_d_aut_dom=$idd ORDER by a.freg3 ASC";
                    //echo $sql;
                  if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
                    foreach ($tabla_nota as $fila_nota) {
                      echo'<section class="panel-body">';
                      echo'<article class="col-md-6">';
                      echo'<p  class="col-md-12"><a href="Funcion_base/borrar_nota3.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_nota['id_enf_dom3'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                      echo'</article>';
                      echo"<article class='col-md-3'>\n";
                        echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg3"].'</strong></p>';
                      echo"</article>";
                      echo"<article class='col-md-3'>";
                        echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota1"].' </strong></p>';
                      echo"</article>";
                      echo'</section>';
                    }
                  }else {
                    echo"<article class='col-md-12'>";
                      echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
                    echo"</article>";
                  }
                }
                if ($turno == 6) {
                  $sql_nota="SELECT a.id_enf_dom6,id_adm_hosp, freg_reg, freg6, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6, estado_nota,
                               u.nombre
                  FROM enferdom6 a INNER join user u on a.id_user=u.id_user
                  WHERE a.id_adm_hosp=$id  and estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg6 ASC";
                    //echo $sql;
                  if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
                    foreach ($tabla_nota as $fila_nota) {
                      echo'<section class="panel-body">';
                      echo'<article class="col-md-6">';
                      echo'<p class="col-md-12"><a href="Funcion_base/borrar_nota6.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_nota['id_enf_dom6'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                      echo'</article>';
                      echo"<article class='col-md-3'>\n";
                        echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg6"].'</strong></p>';
                      echo"</article>";
                      echo"<article class='col-md-3'>";
                        echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
                      echo"</article>";
                      echo'</section>';
                    }
                  }else {
                    echo"<article class='col-md-12'>";
                      echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
                    echo"</article>";
                  }
                }
                if ($turno == 8) {
                  $sql_nota="SELECT a.id_enf_dom8,id_adm_hosp, freg_reg, freg8, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6, estado_nota,hnota7, nota7, hnota8, nota8,
                               u.nombre
                  FROM enferdom8 a INNER join user u on a.id_user=u.id_user
                  WHERE a.id_adm_hosp=$id  and estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg8 ASC";
                    //echo $sql;
                  if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
                    foreach ($tabla_nota as $fila_nota) {
                      echo'<section class="panel-body">';
                      echo'<article class="col-md-6">';
                      echo'<p class="col-md-12"><a href="Funcion_base/borrar_nota8.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_nota['id_enf_dom8'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                      echo'</article>';
                      echo"<article class='col-md-3'>\n";
                        echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg8"].'</strong></p>';
                      echo"</article>";
                      echo"<article class='col-md-3'>";
                        echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
                      echo"</article>";
                      echo'</section>';
                    }
                  }else {
                    echo"<article class='col-md-12'>";
                      echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
                    echo"</article>";
                  }
                }
                if ($turno == 12) {
                  $sql_nota="SELECT a.id_enf_dom12,id_adm_hosp, freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6,
                                    hnota7, nota7, hnota8, nota8, hnota9, nota9, hnota10, nota10, hnota11, nota11, hnota12, nota12, estado_nota,
                               u.nombre
                  FROM enferdom12 a INNER join user u on a.id_user=u.id_user
                  WHERE a.id_adm_hosp=$id and estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg12 ASC";
                  //echo $sql_nota;
                    //echo $fila_detalle["id_d_aut_dom"];
                  if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
                    foreach ($tabla_nota as $fila_nota) {
                      echo'<section class="panel-body">';
                      echo'<article class="col-md-6">';
                      echo'<p class="col-md-12"><a href="Funcion_base/borrar_nota12.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_nota['id_enf_dom12'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                      echo'</article>';
                      echo"<article class='col-md-3'>\n";
                        echo'<p class="text-danger"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg12"].'</strong></p>';
                      echo"</article>";
                      echo"<article class='col-md-3'>";
                        echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
                      echo"</article>";
                      echo'</section>';

                    }
                  }else {
                    echo"<article class='col-md-12'>";
                      echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
                    echo"</article>";
                  }
                }
                if ($turno == 24) {
                  $sql_nota="SELECT a.id_enf_dom12,id_adm_hosp, freg_reg, freg12, hnota1, nota1, hnota2, nota2, hnota3, nota3, hnota4, nota4, hnota5, nota5, hnota6, nota6,
                                    hnota7, nota7, hnota8, nota8, hnota9, nota9, hnota10, nota10, hnota11, nota11, hnota12, nota12, estado_nota,tipo_nota,
                               u.nombre
                  FROM enferdom12 a INNER join user u on a.id_user=u.id_user
                  WHERE estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg12,a.hnota1 ASC";
                    //echo $sql_nota;
                  if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
                    foreach ($tabla_nota as $fila_nota) {
                      echo'<section class="panel-body">';
                      echo'<article class="col-md-4">';
                      echo'<p><a href="Funcion_base/borrar_nota12.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_nota['id_enf_dom12'].'&resp='.$_SESSION['AUT']['id_user'].'"><button  type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                      echo'</article>';
                      echo"<article class='col-md-3'>\n";
                        echo'<p class="text-danger"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg12"].'</strong></p>';
                      echo"</article>";
                      echo"<article class='col-md-3'>";
                        echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
                      echo"</article>";
                      echo"<article class='col-md-2'>";
                        echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["tipo_nota"].' </strong></p>';
                      echo"</article>";
                      echo'</section>';

                    }
                  }else {
                    echo"<article class='col-md-12'>";
                      echo'<p class="text-left">No hay registro de notas de enfermeria</p>';
                    echo"</article>";
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
