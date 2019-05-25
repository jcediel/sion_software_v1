
<div id="consulta_notas_<?php echo $fila_detalle["id_d_aut_dom"]?>_vencida" class="modal fade" role="dialog">
 <div class="modal-dialog modal-lg">
   <!-- Modal content-->
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Registros realizados en orden vencida</h4>
     </div>
     <div class="modal-body">
       <div id="tabs_consulta_nota1">
         <ul>
           <li><a href="#tabs-1">Notas Realizadas</a></li>
           <li><a href="#tabs-2">Signos vitales</a></li>
           <li><a href="#tabs-3">Administración Medicamentos</a></li>
         </ul>
           <div id="tabs-1" class="panel-body">
             <section class="row">
               <?php

                ?>

               <?php
               $idd=$fila_detalle["id_d_aut_dom"];
               $f1=$fila_detalle["finicio"];
               $f2=$fila_detalle["ffinal"];
               $id=$fila["id_adm_hosp"];
               $turno=$fila_detalle["intervalo"];
               if ($turno == 3) {
                 $sql_nota="SELECT a.id_enf_dom3,id_adm_hosp, freg_reg, freg3, hnota1, nota1, hnota2, nota2, hnota3, nota3, estado_nota,
                              u.nombre
                 FROM enferdom3 a INNER join user u on a.id_user=u.id_user
                 WHERE a.id_adm_hosp=$id  and estado_nota='Realizada' and id_d_aut_dom=$idd  ORDER by a.freg3 ASC";
                   //echo $sql;
                 if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
                   foreach ($tabla_nota as $fila_nota) {
                     echo'<section class="panel-body">
                           <article class="col-md-8">';
                     echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom3'].'">Nota del '.$fila_nota["freg3"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                     echo'</article>';
                     echo'<article class="col-md-4">';
                     echo'<p  class="col-md-12"><a href="Funcion_base/borrar_nota3.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_nota['id_enf_dom3'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                     echo'</article>';
                     echo'</section>';

                     echo'<section id="nota'.$fila_nota['id_enf_dom3'].'" class="collapse">';
                     echo"<article class='col-md-6'>\n";
                       echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg3"].'</strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-6'>";
                       echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota1"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota2"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["hnota3"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
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
                     echo'<section class="panel-body">
                           <article class="col-md-8">';
                     echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom6'].'">Nota del '.$fila_nota["freg6"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                     echo'</article>';
                     echo'<article class="col-md-4">';
                     echo'<p class="col-md-12"><a href="Funcion_base/borrar_nota6.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_nota['id_enf_dom6'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                     echo'</article>';
                     echo'</section>';

                     echo'<section id="nota'.$fila_nota['id_enf_dom6'].'" class="collapse">';
                     echo"<article class='col-md-6'>\n";
                       echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg6"].'</strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-6'>";
                       echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
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
                     echo'<section class="panel-body">
                           <article class="col-md-8">';
                     echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom8'].'">Nota del '.$fila_nota["freg8"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                     echo'</article>';
                     echo'<article class="col-md-4">';
                     echo'<p class="col-md-12"><a href="Funcion_base/borrar_nota8.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_nota['id_enf_dom8'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                     echo'</article>';
                     echo'</section>';

                     echo'<section id="nota'.$fila_nota['id_enf_dom8'].'" class="collapse">';
                     echo"<article class='col-md-6'>\n";
                       echo'<p class="text-center text-"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg8"].'</strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-6'>";
                       echo'<p class="text-center success"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota7"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota7"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota8"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota8"].' </p>';
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
                     echo'<section class="panel-body">
                           <article class="col-md-8">';
                     echo'<p class="col-md-12"><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#nota'.$fila_nota['id_enf_dom12'].'">Nota del '.$fila_nota["freg12"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                     echo'</article>';
                     echo'<article class="col-md-4">';
                     echo'<p class="col-md-12"><a href="Funcion_base/borrar_nota12.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_nota['id_enf_dom12'].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                     echo'</article>';
                     echo'</section>';

                     echo'<section id="nota'.$fila_nota['id_enf_dom12'].'" class="collapse">';
                     echo"<article class='col-md-6'>\n";
                       echo'<p class="text-danger"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg12"].'</strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-6'>";
                       echo'<p class="text-danger"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota7"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota7"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota8"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota8"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota9"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota9"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota10"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota10"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota11"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota11"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota12"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota12"].' </p>';
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
                                   hnota7, nota7, hnota8, nota8, hnota9, nota9, hnota10, nota10, hnota11, nota11, hnota12, nota12, estado_nota,
                              u.nombre
                 FROM enferdom12 a INNER join user u on a.id_user=u.id_user
                 WHERE a.id_adm_hosp=$id and a.freg12 BETWEEN '$f1' and '$f2' and estado_nota='Realizada'  and id_d_aut_dom=$idd order by a.freg12 ASC";
                   //echo $sql_nota;
                 if ($tabla_nota=$bd1->sub_tuplas($sql_nota)){
                   foreach ($tabla_nota as $fila_nota) {
                     echo'<section class="panel-body">
                           <article class="col-md-8">';
                     echo'<p><button  data-toggle="collapse" class="btn btn-primary text-center col-md-12" data-target="#nota'.$fila_nota['id_enf_dom12'].'">Nota del '.$fila_nota["freg12"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                     echo'</article>';
                     echo'<article class="col-md-4">';
                     echo'<p><a href="Funcion_base/borrar_nota12.php?idadmhosp='.$fila["id_adm_hosp"].'&doc='.$fila["doc_pac"].'&id='.$fila_nota['id_enf_dom12'].'&resp='.$_SESSION['AUT']['id_user'].'"><button  type="button" class="btn btn-danger" ><span class="fa fa-trash"></span> Invalidar</button></a></p>';
                     echo'</article>';
                     echo'</section>';

                     echo'<section id="nota'.$fila_nota['id_enf_dom12'].'" class="collapse">';
                     echo"<article class='col-md-6'>\n";
                       echo'<p class="text-danger"><strong><span class="fa fa-calendar"></span> '.$fila_nota["freg12"].'</strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-6'>";
                       echo'<p class="text-danger"><strong><span class="fa fa-nurse"></span> '.$fila_nota["nombre"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota1"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota1"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota2"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota2"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota3"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota3"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota4"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota4"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota5"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota5"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota6"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota6"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota7"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota7"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota8"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota8"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota9"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota9"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota10"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota10"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota11"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota11"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<p class="text-success"><strong><span class="fa fa-time"></span> '.$fila_nota["hnota12"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<p class="text-left"> '.$fila_nota["nota12"].' </p>';
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
           <div id="tabs-2" class="panel-body">
             <section class="row">
               <?php
               $f1=$fila_detalle["finicio"];
               $f2=$fila_detalle["ffinal"];
               $id=$fila["id_adm_hosp"];
                 $sql_signos="SELECT a.id_signos_vitales, freg_sv, hreg_sv, tas_s, tad_s, tm_s, fc_s, fr_s, temp_s,
                                       spo_s,glucometria, estado_sv, resp_sv, obs_signos,
                                     u.nombre
                 FROM signos_vitales a INNER join user u on a.id_user=u.id_user
                 WHERE a.id_adm_hosp=$id and a.freg_sv BETWEEN '$f1' and '$f2' and estado_sv='Realizada' order by a.freg_sv ASC";
                   //echo $sql;
                 if ($tabla_signos=$bd1->sub_tuplas($sql_signos)){
                   foreach ($tabla_signos as $fila_signos) {
                     echo'<section class="panel-body">
                           <article class="col-md-12">';
                     echo'<p><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#sv'.$fila_signos['id_signos_vitales'].'">Signos del '.$fila_signos["freg_sv"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                     echo'</article>';

                     echo'</section>';
                     echo'<section id="sv'.$fila_signos['id_signos_vitales'].'" class="collapse">';
                     echo"<article class='col-md-6'>\n";
                       echo'<p class="text-center"><strong><span class="fa fa-calendar"></span> '.$fila_signos["freg_sv"].' '.$fila_signos["hreg_sv"].'</strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-6'>";
                       echo'<p class="text-center"><strong><span class="fa fa-nurse"></span> '.$fila_signos["nombre"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-2'>";
                       echo'<p><span class="fa fa-signature text-success"></span> <strong>TAS:</strong>'.$fila_signos["tas_s"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-2'>";
                       echo'<p><span class="fa fa-signature text-success"></span> <strong>TAD:</strong>'.$fila_signos["tad_s"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-2'>";
                       echo'<p><span class="fa fa-signature text-success"></span> <strong>TAM:</strong>'.$fila_signos["tm_s"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-2'>";
                       echo'<p><span class="fa fa-signature text-success"></span> <strong>FC:</strong>'.$fila_signos["fc_s"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-2'>";
                       echo'<p><span class="fa fa-signature text-success"></span> <strong>FR:</strong>'.$fila_signos["fr_s"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-2'>";
                       echo'<p><span class="fa fa-signature text-success"></span> <strong>TEMP:</strong>'.$fila_signos["temp_s"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-2'>";
                       echo'<p><span class="fa fa-signature text-success"></span> <strong>SPO2:</strong>'.$fila_signos["spo_s"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-3'>";
                       echo'<p><span class="fa fa-signature text-success"></span> <strong>GLUCOMETRIA:</strong>'.$fila_signos["glucometria"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-12'>";
                       echo'<p><span class="fa fa-signature text-success"></span> <strong>Observación:</strong>'.$fila_signos["obs_signos"].' </p>';
                     echo"</article>";
                     echo'</section>';
                   }
                 }

                ?>
             </section>
           </div>
           <div id="tabs-3" class="panel-body">
             <section class="row">
               <?php
               $f1=$fila_detalle["finicio"];
               $f2=$fila_detalle["ffinal"];
               $id=$fila["id_adm_hosp"];
                 $sql_med="SELECT a.id_adm_med_dom, freg, hreg, medicamento, via, frecuencia, dosis, obs_medicamento,
                                  u.nombre
                 FROM administracion_med_dom a INNER join user u on a.id_user=u.id_user
                 WHERE a.id_adm_hosp=$id and a.freg BETWEEN '$f1' and '$f2' and estado_adm_med='Realizada' order by a.freg ASC";
                   //echo $sql;
                 if ($tabla_med=$bd1->sub_tuplas($sql_med)){
                   foreach ($tabla_med as $fila_med) {
                     echo'<section class="panel-body">
                           <article class="col-md-12">';
                     echo'<p><button data-toggle="collapse" class="btn btn-primary text-center" data-target="#admmed'.$fila_med['id_adm_med_dom'].'">Medicamentos del '.$fila_med["freg"].'<span class="glyphicon glyphicon-arrow-down"></span> </button></p>';
                     echo'</article>';

                     echo'</section>';
                     echo'<section id="admmed'.$fila_med['id_adm_med_dom'].'" class="collapse">';
                     echo"<article class='col-md-6'>\n";
                       echo'<p class="text-center"><strong><span class="fa fa-calendar"></span> '.$fila_med["freg"].' '.$fila_med["hreg"].'</strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-6'>";
                       echo'<p class="text-center"><strong><span class="fa fa-nurse"></span> '.$fila_med["nombre"].' </strong></p>';
                     echo"</article>";
                     echo"<article class='col-md-8'>";
                       echo'<label>Medicamento:</label>';
                       echo'<p><span class="fa fa-pills text-danger"></span> '.$fila_med["medicamento"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                     echo'<label>Vía:</label>';
                       echo'<p><span class="fa fa-pills text-danger"></span> '.$fila_med["via"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                     echo'<label>Frecuencia:</label>';
                       echo'<p><span class="fa fa-pills text-danger"></span> '.$fila_med["frecuencia"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-4'>";
                       echo'<label>Dosis:</label>';
                       echo'<p><span class="fa fa-pills text-danger"></span> '.$fila_med["dosis"].' </p>';
                     echo"</article>";
                     echo"<article class='col-md-12'>";
                       echo'<label>Observación:</label>';
                       echo'<p><span class="fa fa-pills text-danger"></span> '.$fila_med["obs_medicamento"].' </p>';
                     echo"</article>";
                     echo'</section>';
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
