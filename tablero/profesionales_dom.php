<section class="panel-body">
  <h1 class=" animated zoomIn">Hola, <?php echo $_SESSION['AUT']['nombre'] ?></h1>
  <p class="lead">Aqui puede realizar consulta de los pacientes asignados por Emmanuel IPS.</p>
  <hr class="my-4">
  <article class="col-md-12">
    <button data-toggle="collapse" class="btn btn-info btn-lg text-center" data-target="#Pacaut">Consulte AQUI los pacientes que tiene autorizados <br><span class="glyphicon glyphicon-arrow-down"></span> </button>
  </article>

  <section class="panel-body">
    <article class="col-md-12">
      <section id="Pacaut" class="collapse">
        <?php
        echo'<table class="table table-bordered">
        <tr>
          <th>#</th>
          <th>PACIENTE</th>
          <th>INGRESO</th>
          <th>AUTORIZACION</th>
          <th>SESIONES</th>
          <th></th>
        </tr>
          ';
        $user=$_SESSION['AUT']['id_user'];
        $sql="SELECT h.nom_eps,b.tdoc_pac,b.doc_pac, b.nom_completo,b.tel_pac,b.dir_pac, c.tipo_usuario,b.zonificacion,
                     c.mun_residencia,c.dep_residencia,i.descrimuni,c.zona_residencia,
                     IFNULL(c.id_adm_hosp,0),d.id_m_aut_dom, IFNULL(e.id_d_aut_dom,0),
                     e.freg, e.cups, e.procedimiento, e.cantidad, e.finicio, e.ffinal,
                     e.num_aut_externa, e.estado_d_aut_dom, e.intervalo,
                     e.temporalidad,g.nombre profesional,
                     j.nom_sedes,
                     cantidad_sesion_dom(e.cups,c.id_adm_hosp,CAST(e.finicio AS DATE),CAST(e.ffinal AS DATE)) sesiones

              from adm_hospitalario c INNER JOIN m_aut_dom d on (d.id_adm_hosp = c.id_adm_hosp)
                                      INNER JOIN d_aut_dom e on (e.id_m_aut_dom = d.id_m_aut_dom
                                               and CURRENT_DATE BETWEEN
                                              CAST(e.finicio AS DATE) AND CAST(e.ffinal  AS DATE))
                                      INNER JOIN pacientes b on (c.id_paciente = b.id_paciente)
                                      INNER JOIN eps h on (h.id_eps = c.id_eps)
                                      INNER JOIN sedes_ips j on (j.id_sedes_ips = c.id_sedes_ips)
                                      LEFT  JOIN profesional_d_dom f on (f.id_d_aut_dom = e.id_d_aut_dom)
                                      LEFT  JOIN user g on (g.id_user = f.profesional)
                                      LEFT  JOIN municipios i on (i.codmuni = c.mun_residencia)
              where c.tipo_servicio = 'Domiciliarios' and c.estado_adm_hosp = 'Activo' and f.profesional=$user
              ";
            $i=1;
            if ($tabla=$bd1->sub_tuplas($sql)){
              foreach ($tabla as $fila) {
                echo"<tr >\n";
                echo'<td class="text-center">
                      <p>'.$i++.'<p>
                     </td>';
                echo'<td class="text-left">
                      <p>'.$fila["nom_completo"].'<p>
                      <p><strong>'.$fila["tdoc_pac"].' </strong>: '.$fila["doc_pac"].'</p>
                      <p><strong>Tel: </strong>: '.$fila["tel_pac"].'</p>
                      <p><strong>Dirección: </strong> '.$fila["dir_pac"].' '.$fila["descrimuni"].'</p>
                     </td>';
                echo'<td class="text-left">
                      <p><strong>ADM: </strong>'.$fila["IFNULL(c.id_adm_hosp,0)"].'</p>
                      <p><strong>EPS: </strong>'.$fila["nom_eps"].'</p>
                      <p><strong>SEDE: </strong>'.$fila["nom_sedes"].'</p>';
                echo'</td>';
                echo'<td class="text-left">
                      <p><strong>ID M: </strong>'.$fila["id_m_aut_dom"].'</p>
                      <p><strong>ID D: </strong>'.$fila["IFNULL(e.id_d_aut_dom,0)"].'</p>
                      <p><strong>Intervalo/turno: </strong>'.$fila["intervalo"].'</p>
                      <p><strong>Tipo Paciente: </strong>'.$fila["nomclaseusuario"].'</p>
                      <p><strong>'.$fila["cups"].' </strong>'.$fila["procedimiento"].'</p>
                      <p><strong>Vigencia: </strong>'.$fila["finicio"].' -- '.$fila["ffinal"].'</p>
                     </td>';
                echo'<td class="text-center">
                      <p><strong>Autorizado: </strong>'.$fila["cantidad"].'</p>
                      <p><strong>Realizado: </strong>'.$fila["sesiones"].'</p>
                     </td>';
                echo'<td class="text-center">

                     </td>';
                echo "</tr>\n";
              }
            }
        ?>
         </table>
      </section>
    </article>
  </section>
  <section class="panel-body ">
    <section class="col-md-6 col-sm-12">
      <section class="panel panel-primary">
       <section class="panel-heading"><h1>Anuncios Generales</h1></section>
       <section class="panel-body">
         <?php
         $servicio='Domiciliarios';
         $sql_ag="SELECT a.id_anuncio,a.servicio,a.tipo_anuncio,a.freg,a.hreg,a.titulo,a.anuncio,a.estado,a.f_elimina,a.resp_elimina ,
                         b.nombre
                       FROM anuncios a inner join user b on a.id_user=b.id_user
                       WHERE a.estado=1 and a.tipo_anuncio=1 and a.id_user=125 ORDER BY a.freg DESC ";
         if ($tabla_ag=$bd1->sub_tuplas($sql_ag)){
           foreach ($tabla_ag as $fila_ag) {
               echo'<i>';
               echo'<article class="col-md-12 animated bounceIn alert alert-info">
                     <strong>'.$fila_ag["titulo"].'</strong>
                     <p class="text-justify">'.$fila_ag["anuncio"].'</p>
                     <p><a href="anuncios/leido_anuncio.php?id='.$fila_ag["id_anuncio"].'&resp='.$_SESSION['AUT']['id_user'].'"><button type="button" class="btn btn-info" ><span class="fa fa-envelope-open-text"></span> Anuncio Leido</button></a></p>
                    </article>
                    </i>';
           }
         }
          ?>
       </section>
     </section>
    </section>

    <section class="col-md-6 col-sm-12">
      <section class="panel panel-warning">
       <section class="panel-heading"><h1>Anuncios Capacitación</h1></section>
         <section class="panel-body">
           <?php
           $servicio='Domiciliarios';
           $sql_ag="SELECT a.id_anuncio,a.servicio,a.tipo_anuncio,a.freg,a.hreg,a.titulo,a.anuncio,a.estado,a.f_elimina,a.resp_elimina ,
                           b.nombre
                         FROM anuncios a inner join user b on a.id_user=b.id_user
                         WHERE a.estado=1 and a.tipo_anuncio=3  and a.grupo_vista in (2,9) ORDER BY a.freg DESC ";

           if ($tabla_ag=$bd1->sub_tuplas($sql_ag)){
             foreach ($tabla_ag as $fila_ag ) {
              echo'<article class="col-md-12 animated bounceIn alert alert-warning">
                    <p><strong>'.$fila_ag["titulo"].'</strong></p>
                    <p class="text-justify">'.$fila_ag["anuncio"].'</p>';

              $id=$fila_ag["id_anuncio"];
              $sql_doc="SELECT id_s_anuncio,id_anuncio,id_user,freg_anuncio,hreg_anuncio,nombre_soporte,soporte_anuncio
                        FROM soporte_anuncio
                        WHERE id_anuncio=$id";
               //echo $sql_doc;
              if ($tabla_doc=$bd1->sub_tuplas($sql_doc)){
                foreach ($tabla_doc as $fila_doc) {
                  $soporte=$fila_doc['soporte_anuncio'];
                  $sop=substr($soporte, -3);
                  if ($sop=='jpg' || $sop=='JPG' || $sop=='png') {
                      echo'
                      <a href="/'.$fila_doc['soporte_anuncio'].'" target="_blank">
                        <button type="button" class="btn btn-warning btn-md" ><span class="fa fa-file-image"></span> Ver imagen</button>
                      </a>';
                    }
                    if ($sop=='pdf') {
                      echo'
                      <a href="/'.$fila_doc['soporte_anuncio'].'" target="_blank">
                      <button type="button" class="btn btn-warning btn-md" ><span class="fa fa-file-pdf"></span> Ver PDF</button>
                      </a>';
                    }
                    if ($sop=='mp4') {
                      echo'
                      <a href="/'.$fila_doc['soporte_anuncio'].'" target="_blank">
                      <button type="button" class="btn btn-warning btn-md" ><span class="fa fa-file-video"></span> Ver Video</button>
                      </a>';
                    }
                    if ($sop=='ppt' || $sop=='pptx' || $sop=='PPT' || $sop=='PPTX' ) {
                      echo'
                      <a href="/'.$fila_doc['soporte_anuncio'].'" target="_blank">
                      <button type="button" class="btn btn-warning btn-md" ><span class="fa fa-file-powerpoint"></span> Ver Power Point</button>
                      </a>';
                    }
                  }
                }else {
                  echo'<i class="text-primary animated bounceIn">No existen soporte para este anuncio de CAPACITACION</i>';
                }
                echo '
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#link_'.$fila_ag["id_anuncio"].'"><span class="fa fa-link"></span> VER link</button>
                ';
                // MODAL Y VALIDACION DE CUESTIONARIOS
                $ida=$fila_ag["id_anuncio"];
                $user=$_SESSION['AUT']['id_user'];
                $sql_validar="SELECT a.id_cuestionario cuestionario,b.id_rta_cuestionario,freg_rta
                              FROM cuestionario a inner join respuesta_cuestionario b on a.id_cuestionario=b.id_cuestionario
                              WHERE  a.id_anuncio=$ida and resp_contesta=$user";
                              //echo $sql_validar;
                if ($tabla_validar=$bd1->sub_tuplas($sql_validar)){
                  foreach ($tabla_validar as $fila_validar) {
                    $cuestion=$fila_validar['cuestionario'];
                    if ($cuestion=='') {
                      $id=$fila_ag["id_anuncio"];
                      $sql_cuestionario="SELECT id_cuestionario, id_anuncio, resp_crea, freg_crea, hreg_crea,
                      pregunta1, rta11, estado11, rta12, estado12, rta13, estado13, rta14, estado14,
                      pregunta2, rta21, estado21, rta22, estado22, rta23, estado23, rta24, estado24,
                      pregunta3, rta31, estado31, rta32, estado32, rta33, estado33, rta34, estado34,
                      pregunta4, rta41, estado41, rta42, estado42, rta43, estado43, rta44, estado44,
                      pregunta5, rta51, estado51, rta52, estado52, rta53, estado53, rta54, estado54, vencimiento_cuestionario
                      FROM cuestionario
                      WHERE id_anuncio=$id";
                      //echo $sql_cuestionario;
                      if ($tabla_cuestionario=$bd1->sub_tuplas($sql_cuestionario)){
                        foreach ($tabla_cuestionario as $fila_cuestionario) {
                          $idc=$fila_cuestionario['id_cuestionario'];
                          if ($idc!='') {
                            $hoy=date('Y-m-d');
                            $f_validar=$fila_cuestionario['vencimiento_cuestionario'];
                            if ($f_validar >= $hoy) {
                              $fecha=date('Y-m-d');
                              $hora=date('H:i');
                              echo'<button type="button" class="btn btn-success" data-toggle="modal" data-target="#cuestionario_'.$fila_cuestionario['id_cuestionario'].'"><span class="fa fa-user-graduate"></span> Adherencia capacitación</button>
                              ';

                            }else {
                              echo'
                              <p>El cuestionario se ha vencido</p>';
                            }
                          }else {
                            echo'<button type="button" class="btn btn-success" data-toggle="modal" data-target="#cuestionario_'.$fila_cuestionario['id_cuestionario'].'"><span class="fa fa-user-graduate"></span> Adherencia capacitación</button>
                            ';
                          }

                        }
                      }else {

                      }
                      echo'</article>';
                      echo'<div id="cuestionario_'.$fila_cuestionario['id_cuestionario'].'" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                      <div class="modal-content">
                      <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Registro de adherencia a capacitacion # '.$fila_cuestionario['id_cuestionario'].'</h4>
                      </div>
                      <div class="modal-body">
                      <form action="Funcion_base/adherencia_capacitacion.php" method="POST">';
                      ?>
                      <section class="panel-body">
                        <section class="col-md-6">
                          <p><strong>Pregunta 1:</strong></p>
                          <p><?php echo $fila_cuestionario['pregunta1'] ?></p>
                          <input type="hidden" name="id_cuestionario" value="<?php echo $fila_cuestionario['id_cuestionario'] ?>">
                          <input type="hidden" name="resp_contesta" value="<?php echo $_SESSION['AUT']['id_user'] ?>">
                        </section>
                        <section class="col-md-6">
                          <article class="col-md-12">
                            <select class="form-control" required name="rta1">
                              <option value="<?php echo $fila_cuestionario['estado11'] ?>"><?php echo $fila_cuestionario['rta11'] ?></option>
                              <option value="<?php echo $fila_cuestionario['estado12'] ?>"><?php echo $fila_cuestionario['rta12'] ?></option>
                              <option value="<?php echo $fila_cuestionario['estado13'] ?>"><?php echo $fila_cuestionario['rta13'] ?></option>
                              <option value="<?php echo $fila_cuestionario['estado14'] ?>"><?php echo $fila_cuestionario['rta14'] ?></option>
                            </select>
                          </article>
                        </section>
                      </section>
                      <section class="panel-body">
                        <section class="col-md-6">
                          <p><strong>Pregunta 2:</strong></p>
                          <p><?php echo $fila_cuestionario['pregunta2'] ?></p>
                        </section>
                        <section class="col-md-6">
                          <article class="col-md-12">
                            <select class="form-control" required name="rta2">
                              <option value="<?php echo $fila_cuestionario['estado21'] ?>"><?php echo $fila_cuestionario['rta21'] ?></option>
                              <option value="<?php echo $fila_cuestionario['estado22'] ?>"><?php echo $fila_cuestionario['rta22'] ?></option>
                              <option value="<?php echo $fila_cuestionario['estado23'] ?>"><?php echo $fila_cuestionario['rta23'] ?></option>
                              <option value="<?php echo $fila_cuestionario['estado24'] ?>"><?php echo $fila_cuestionario['rta24'] ?></option>
                            </select>
                          </article>
                        </section>
                      </section>
                      <section class="panel-body">
                        <section class="col-md-6">
                          <p><strong>Pregunta 3:</strong></p>
                          <p><?php echo $fila_cuestionario['pregunta3'] ?></p>
                        </section>
                        <section class="col-md-6">
                          <article class="col-md-12">
                            <select class="form-control" required name="rta3">
                              <option value="<?php echo $fila_cuestionario['estado31'] ?>"><?php echo $fila_cuestionario['rta31'] ?></option>
                              <option value="<?php echo $fila_cuestionario['estado32'] ?>"><?php echo $fila_cuestionario['rta32'] ?></option>
                              <option value="<?php echo $fila_cuestionario['estado33'] ?>"><?php echo $fila_cuestionario['rta33'] ?></option>
                              <option value="<?php echo $fila_cuestionario['estado34'] ?>"><?php echo $fila_cuestionario['rta34'] ?></option>
                            </select>
                          </article>
                        </section>
                      </section>
                      <section class="panel-body">
                        <section class="col-md-6">
                          <p><strong>Pregunta 4:</strong></p>
                          <p><?php echo $fila_cuestionario['pregunta4'] ?></p>
                        </section>
                        <section class="col-md-6">
                          <article class="col-md-12">
                            <select class="form-control" required name="rta4">
                              <option value="<?php echo $fila_cuestionario['estado41'] ?>"><?php echo $fila_cuestionario['rta41'] ?></option>
                              <option value="<?php echo $fila_cuestionario['estado42'] ?>"><?php echo $fila_cuestionario['rta42'] ?></option>
                              <option value="<?php echo $fila_cuestionario['estado43'] ?>"><?php echo $fila_cuestionario['rta43'] ?></option>
                              <option value="<?php echo $fila_cuestionario['estado44'] ?>"><?php echo $fila_cuestionario['rta44'] ?></option>
                            </select>
                          </article>
                        </section>
                      </section>
                      <section class="panel-body">
                        <section class="col-md-6">
                          <p><strong>Pregunta 5:</strong></p>
                          <p><?php echo $fila_cuestionario['pregunta5'] ?></p>
                        </section>
                        <section class="col-md-6">
                          <article class="col-md-12">
                            <select class="form-control" required name="rta5">
                              <option value="<?php echo $fila_cuestionario['estado51'] ?>"><?php echo $fila_cuestionario['rta51'] ?></option>
                              <option value="<?php echo $fila_cuestionario['estado52'] ?>"><?php echo $fila_cuestionario['rta52'] ?></option>
                              <option value="<?php echo $fila_cuestionario['estado53'] ?>"><?php echo $fila_cuestionario['rta53'] ?></option>
                              <option value="<?php echo $fila_cuestionario['estado54'] ?>"><?php echo $fila_cuestionario['rta54'] ?></option>
                            </select>
                          </article>
                        </section>
                      </section>
                      <?php
                      echo'<section class="panel-body">
                      <article class="col-md-12">
                      <input type="submit" value="Guardar">
                      </article>
                      </section>
                      </form>';
                      echo'</div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      </div>
                      </div>

                      </div>
                      </div>';
                    }else {
                      echo'<i class="text-danger">Ya resolvio este cuestionario.</i>';
                    }

                  }
                }else {
                  $id=$fila_ag["id_anuncio"];
                  $sql_cuestionario="SELECT id_cuestionario, id_anuncio, resp_crea, freg_crea, hreg_crea,
                  pregunta1, rta11, estado11, rta12, estado12, rta13, estado13, rta14, estado14,
                  pregunta2, rta21, estado21, rta22, estado22, rta23, estado23, rta24, estado24,
                  pregunta3, rta31, estado31, rta32, estado32, rta33, estado33, rta34, estado34,
                  pregunta4, rta41, estado41, rta42, estado42, rta43, estado43, rta44, estado44,
                  pregunta5, rta51, estado51, rta52, estado52, rta53, estado53, rta54, estado54, vencimiento_cuestionario
                  FROM cuestionario
                  WHERE id_anuncio=$id";
                  //echo $sql_cuestionario;
                  if ($tabla_cuestionario=$bd1->sub_tuplas($sql_cuestionario)){
                    foreach ($tabla_cuestionario as $fila_cuestionario) {
                      $idc=$fila_cuestionario['id_cuestionario'];
                      if ($idc!='') {
                        $hoy=date('Y-m-d');
                        $f_validar=$fila_cuestionario['vencimiento_cuestionario'];
                        if ($f_validar >= $hoy) {
                          $fecha=date('Y-m-d');
                          $hora=date('H:i');
                          echo'<button type="button" class="btn btn-success" data-toggle="modal" data-target="#cuestionario_'.$fila_cuestionario['id_cuestionario'].'_2"><span class="fa fa-user-graduate"></span> Adherencia capacitación</button>';

                        }else {
                          echo'
                          <p>No hay cuestionario1</p>';
                        }
                      }else {
                        echo'<button type="button" class="btn btn-success" data-toggle="modal" data-target="#cuestionario_'.$fila_cuestionario['id_cuestionario'].'_2"><span class="fa fa-user-graduate"></span> Adherencia capacitación</button>';
                      }

                    }
                  }else {

                  }
                }

            echo'</article>';
            echo'<div id="cuestionario_'.$fila_cuestionario['id_cuestionario'].'_2" class="modal fade" role="dialog">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Registro de adherencia a capacitacion # '.$fila_cuestionario['id_cuestionario'].'</h4>
            </div>
            <div class="modal-body">
            <form action="Funcion_base/adherencia_capacitacion.php" method="POST">';
            ?>
            <section class="panel-body">
              <section class="col-md-6">
                <p><strong>Pregunta 1:</strong></p>
                <p><?php echo $fila_cuestionario['pregunta1'] ?></p>
                <input type="hidden" name="id_cuestionario" value="<?php echo $fila_cuestionario['id_cuestionario'] ?>">
                <input type="hidden" name="resp_contesta" value="<?php echo $_SESSION['AUT']['id_user'] ?>">
              </section>
              <section class="col-md-6">
                <article class="col-md-12">
                  <select class="form-control" required name="rta1">
                    <option value="<?php echo $fila_cuestionario['estado11'] ?>"><?php echo $fila_cuestionario['rta11'] ?></option>
                    <option value="<?php echo $fila_cuestionario['estado12'] ?>"><?php echo $fila_cuestionario['rta12'] ?></option>
                    <option value="<?php echo $fila_cuestionario['estado13'] ?>"><?php echo $fila_cuestionario['rta13'] ?></option>
                    <option value="<?php echo $fila_cuestionario['estado14'] ?>"><?php echo $fila_cuestionario['rta14'] ?></option>
                  </select>
                </article>
              </section>
            </section>
            <section class="panel-body">
              <section class="col-md-6">
                <p><strong>Pregunta 2:</strong></p>
                <p><?php echo $fila_cuestionario['pregunta2'] ?></p>
              </section>
              <section class="col-md-6">
                <article class="col-md-12">
                  <select class="form-control" required name="rta2">
                    <option value="<?php echo $fila_cuestionario['estado21'] ?>"><?php echo $fila_cuestionario['rta21'] ?></option>
                    <option value="<?php echo $fila_cuestionario['estado22'] ?>"><?php echo $fila_cuestionario['rta22'] ?></option>
                    <option value="<?php echo $fila_cuestionario['estado23'] ?>"><?php echo $fila_cuestionario['rta23'] ?></option>
                    <option value="<?php echo $fila_cuestionario['estado24'] ?>"><?php echo $fila_cuestionario['rta24'] ?></option>
                  </select>
                </article>
              </section>
            </section>
            <section class="panel-body">
              <section class="col-md-6">
                <p><strong>Pregunta 3:</strong></p>
                <p><?php echo $fila_cuestionario['pregunta3'] ?></p>
              </section>
              <section class="col-md-6">
                <article class="col-md-12">
                  <select class="form-control" required name="rta3">
                    <option value="<?php echo $fila_cuestionario['estado31'] ?>"><?php echo $fila_cuestionario['rta31'] ?></option>
                    <option value="<?php echo $fila_cuestionario['estado32'] ?>"><?php echo $fila_cuestionario['rta32'] ?></option>
                    <option value="<?php echo $fila_cuestionario['estado33'] ?>"><?php echo $fila_cuestionario['rta33'] ?></option>
                    <option value="<?php echo $fila_cuestionario['estado34'] ?>"><?php echo $fila_cuestionario['rta34'] ?></option>
                  </select>
                </article>
              </section>
            </section>
            <section class="panel-body">
              <section class="col-md-6">
                <p><strong>Pregunta 4:</strong></p>
                <p><?php echo $fila_cuestionario['pregunta4'] ?></p>
              </section>
              <section class="col-md-6">
                <article class="col-md-12">
                  <select class="form-control" required name="rta4">
                    <option value="<?php echo $fila_cuestionario['estado41'] ?>"><?php echo $fila_cuestionario['rta41'] ?></option>
                    <option value="<?php echo $fila_cuestionario['estado42'] ?>"><?php echo $fila_cuestionario['rta42'] ?></option>
                    <option value="<?php echo $fila_cuestionario['estado43'] ?>"><?php echo $fila_cuestionario['rta43'] ?></option>
                    <option value="<?php echo $fila_cuestionario['estado44'] ?>"><?php echo $fila_cuestionario['rta44'] ?></option>
                  </select>
                </article>
              </section>
            </section>
            <section class="panel-body">
              <section class="col-md-6">
                <p><strong>Pregunta 5:</strong></p>
                <p><?php echo $fila_cuestionario['pregunta5'] ?></p>
              </section>
              <section class="col-md-6">
                <article class="col-md-12">
                  <select class="form-control" required name="rta5">
                    <option value="<?php echo $fila_cuestionario['estado51'] ?>"><?php echo $fila_cuestionario['rta51'] ?></option>
                    <option value="<?php echo $fila_cuestionario['estado52'] ?>"><?php echo $fila_cuestionario['rta52'] ?></option>
                    <option value="<?php echo $fila_cuestionario['estado53'] ?>"><?php echo $fila_cuestionario['rta53'] ?></option>
                    <option value="<?php echo $fila_cuestionario['estado54'] ?>"><?php echo $fila_cuestionario['rta54'] ?></option>
                  </select>
                </article>
              </section>
            </section>
            <?php
            echo'<section class="panel-body">
            <article class="col-md-12">
            <input type="submit" value="Guardar">
            </article>
            </section>
            </form>';
            echo'</div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
            </div>

            </div>
            </div>';
             }
           } // fin primner sql ag
           echo '
           <div id="link_'.$fila_ag["id_anuncio"].'" class="modal fade" role="dialog">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Agregar Link al anuncio</h4>
                 </div>
                 <div class="modal-body">';
                 $d=$fila_ag['id_anuncio'];
                 $sql_l="SELECT a.id_link_anuncio, id_anuncio, freg, hreg, resp, link,
                                   b.nombre
                             FROM link_anuncio a left join user b on a.resp=b.id_user

                             WHERE a.id_anuncio=$d and estado_link=1";
                             //echo $sql_vista;
                 if ($tabla_l=$bd1->sub_tuplas($sql_l)){
                   foreach ($tabla_l as $fila_l) {
                     echo'<p>'.$fila_l['freg'].' '.$fila_l['hreg'].' <a href="'.$fila_l['link'].'"  target="_blank">'.$fila_l['link'].'</a></p>';
                   }
                 }
           echo' </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>
               </div>
             </div>
           </div>';
              ?>
         </section>
       </section>
    </section>

  </section>
